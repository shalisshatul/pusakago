<?php

namespace App\Controllers;

use App\Models\PeminjamanModel;
use App\Models\PengirimanModel;

class Peminjaman extends BaseController
{
    protected $peminjaman;

    public function __construct()
    {
        $this->peminjaman = new PeminjamanModel();
    }

    // READ
    public function index()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('peminjaman');
    
        $builder->select('
            peminjaman.id_peminjaman,
            peminjaman.tanggal_pinjam,
            peminjaman.tanggal_kembali,
            peminjaman.status,
            peminjaman.metode,
            users.nama,
    
            GROUP_CONCAT(DISTINCT buku.judul SEPARATOR ", ") as judul,
    
            IFNULL(pengiriman.status, "-") as status_pengiriman
        ');
    
        // 🔥 JOIN USER
        $builder->join('users', 'users.id = peminjaman.id', 'left');
    
        // 🔥 JOIN DETAIL & BUKU
        $builder->join('detail_peminjaman', 'detail_peminjaman.id_peminjaman = peminjaman.id_peminjaman', 'left');
        $builder->join('buku', 'buku.id_buku = detail_peminjaman.id_buku', 'left');
    
        // 🔥 JOIN PENGIRIMAN (INI YANG KAMU MAKSUD)
        $builder->join('pengiriman', 'pengiriman.id_peminjaman = peminjaman.id_peminjaman', 'left');
    
        // 🔥 FILTER USER (ANGGOTA)
        if (session()->get('role') == 'anggota') {
            $builder->where('peminjaman.id', session()->get('id'));
        }
    
        // 🔥 GROUP BY (WAJIB karena pakai GROUP_CONCAT)
        $builder->groupBy('peminjaman.id_peminjaman');
    
        // 🔥 URUTAN
        $builder->orderBy('peminjaman.id_peminjaman', 'DESC');
    
        $data['peminjaman'] = $builder->get()->getResultArray();
    
        return view('peminjaman/index', $data);
    }
    


    public function create()
    {
        $bukuModel = new \App\Models\BukuModel();

        $data['buku'] = $bukuModel
            ->select('buku.*, kategori.nama_kategori, penulis.nama_penulis, penerbit.nama_penerbit')
            ->join('kategori', 'kategori.id_kategori = buku.id_kategori', 'left')
            ->join('penulis', 'penulis.id_penulis = buku.id_penulis', 'left')
            ->join('penerbit', 'penerbit.id_penerbit = buku.id_penerbit', 'left')
            ->findAll();

        return view('peminjaman/create', $data);
    }

    // STORE (MULTI BUKU FIX)
    public function store()
    {
        $db = \Config\Database::connect();
    
        $metode = $this->request->getPost('metode');
        $id_buku_list = $this->request->getPost('id_buku');
    
        // ❌ validasi kosong
        if (!$id_buku_list) {
            return redirect()->back()->with('error', 'Pilih minimal 1 buku');
        }
    
        if (!is_array($id_buku_list)) {
            $id_buku_list = [$id_buku_list];
        }
    
        // 🔥 hilangkan duplikat (biar tidak double insert)
        $id_buku_list = array_unique($id_buku_list);
    
        // status awal
        $status = 'menunggu';
    
        // 🔥 simpan peminjaman
        $this->peminjaman->insert([
            'tanggal_pinjam'  => null,
            'tanggal_kembali' => null,
            'status'          => $status,
            'id'              => session()->get('id'),
            'metode'          => $metode
        ]);
    
        $id_peminjaman = $this->peminjaman->getInsertID();
        $db = \Config\Database::connect();

// 🔥 CEK JIKA METODE ANTAR
if ($metode == 'antar') {

    $alamat = $this->request->getPost('alamat'); // dari form
    $biaya = 10000; // bisa kamu ubah nanti

    // 🔥 SIMPAN KE PENGIRIMAN
    $db->table('pengiriman')->insert([
        'id_peminjaman' => $id_peminjaman,
        'alamat'        => $alamat,
        'biaya'         => $biaya,
        'status'        => 'menunggu'
    ]);

    // 🔥 SIMPAN KE TRANSAKSI
    $db->table('transaksi')->insert([
        'id_peminjaman' => $id_peminjaman,
        'jenis'         => 'pengiriman',
        'jumlah'        => $biaya
    ]);
}

    
        $detailModel = new \App\Models\DetailPeminjamanModel();
    
        // 🔥 simpan detail buku
        foreach ($id_buku_list as $id_buku) {
            $detailModel->insert([
                'id_peminjaman' => $id_peminjaman,
                'id_buku'       => $id_buku,
                'jumlah'        => 1
            ]);
        }
    
        return redirect()->to('/peminjaman')
            ->with('success', 'Menunggu persetujuan admin');
    }
    

    // UPDATE
    public function update($id)
    {
        $this->peminjaman->update($id, [
            'tanggal_pinjam'  => $this->request->getPost('tanggal_pinjam'),
            'tanggal_kembali' => $this->request->getPost('tanggal_kembali'),
            'status'          => $this->request->getPost('status'),
            'id'              => $this->request->getPost('id')
        ]);

        return redirect()->to('/peminjaman');
    }

    // KEMBALIKAN
    public function kembalikan($id)
{
    $db = \Config\Database::connect();

    $peminjamanModel = new \App\Models\PeminjamanModel();
    $pengembalianModel = new \App\Models\PengembalianModel();

    $peminjaman = $peminjamanModel->find($id);

    // ❌ cegah kalau belum disetujui
    if (!$peminjaman || !$peminjaman['tanggal_pinjam']) {
        return redirect()->back()->with('error', 'Belum disetujui');
    }

    // ❌ cegah double klik
    if ($peminjaman['status'] == 'dikembalikan') {
        return redirect()->back()->with('error', 'Sudah dikembalikan');
    }

    $tanggal_kembali = date('Y-m-d');

    // ✅ simpan pengembalian
    $pengembalianModel->save([
        'id_peminjaman'        => $id,
        'tanggal_dikembalikan' => $tanggal_kembali,
        'denda'                => 0
    ]);

    // 🔥 AMBIL DETAIL BUKU
    $detail = $db->table('detail_peminjaman')
        ->where('id_peminjaman', $id)
        ->get()
        ->getResultArray();

    // ❗ DEBUG (sementara aktifkan kalau masih error)
    // dd($detail);

    // 🔥 TAMBAH STOK
    foreach ($detail as $d) {
        $db->table('buku')
            ->where('id_buku', $d['id_buku'])
            ->set('tersedia', 'tersedia + ' . (int)$d['jumlah'], false)
            ->update();
    }

    // ✅ update status
    $peminjamanModel->update($id, [
        'status' => 'dikembalikan',
        'tanggal_kembali' => $tanggal_kembali
    ]);

    return redirect()->to('/pengembalian')
        ->with('success', 'Buku dikembalikan & stok bertambah');
}

    // DETAIL
    public function detail($id)
    {
        $db = \Config\Database::connect();

        $builder = $db->table('peminjaman');

        $builder->select('peminjaman.*, users.nama');

        $builder->join('users', 'users.id = peminjaman.id', 'left');

        $builder->where('peminjaman.id_peminjaman', $id);

        $peminjaman = $builder->get()->getRowArray();

        // ambil semua buku dari detail_peminjaman
        $buku = $db->table('detail_peminjaman')
            ->select('buku.judul')
            ->join('buku', 'buku.id_buku = detail_peminjaman.id_buku')
            ->where('detail_peminjaman.id_peminjaman', $id)
            ->get()
            ->getResultArray();

        $judul = array_column($buku, 'judul');

        $peminjaman['judul'] = implode(', ', $judul);

        $data['peminjaman'] = $peminjaman;

        return view('peminjaman/detail', $data);
    }

    // DELETE
    public function delete($id)
    {
        if (session()->get('role') != 'admin') {
            return redirect()->to('/peminjaman')->with('error', 'Tidak diizinkan');
        }

        $this->peminjaman->delete($id);

        return redirect()->to('/peminjaman');
    }

    // PRINT
    public function print($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('peminjaman');

        $builder->select('
            peminjaman.*,
            users.nama,
            buku.judul,
            pengiriman.alamat,
            IFNULL(pengiriman.status, "menunggu") as status_pengiriman
        ');

        $builder->join('users', 'users.id = peminjaman.id');
        $builder->join('buku', 'buku.id_buku = peminjaman.id_buku');
        $builder->join('pengiriman', 'pengiriman.id_peminjaman = peminjaman.id_peminjaman', 'left');

        $builder->where('peminjaman.id_peminjaman', $id);

        $data['peminjaman'] = $builder->get()->getRowArray();

        return view('peminjaman/print', $data);
    }
    public function setujui($id)
    {
        $db = \Config\Database::connect();
    
        // 🔥 ambil semua buku yg dipinjam
        $detail = $db->table('detail_peminjaman')
            ->where('id_peminjaman', $id)
            ->get()
            ->getResultArray();
    
        // ❌ VALIDASI STOK DULU
        foreach ($detail as $d) {
            $buku = $db->table('buku')
                ->where('id_buku', $d['id_buku'])
                ->get()
                ->getRowArray();
    
            if (!$buku || $buku['tersedia'] < $d['jumlah']) {
                return redirect()->back()
                    ->with('error', 'Stok buku "' . ($buku['judul'] ?? '-') . '" tidak cukup');
            }
        }
    
        // ✅ kalau stok aman → lanjut approve
        $tanggal_pinjam = date('Y-m-d');
        $tanggal_kembali = date('Y-m-d', strtotime('+5 days'));
    
        $this->peminjaman->update($id, [
            'status' => 'dipinjam',
            'tanggal_pinjam' => $tanggal_pinjam,
            'tanggal_kembali' => $tanggal_kembali
        ]);
    
        // 🔥 kurangi stok
        foreach ($detail as $d) {
            $db->table('buku')
                ->where('id_buku', $d['id_buku'])
                ->set('tersedia', 'tersedia - ' . (int)$d['jumlah'], false)
                ->update();
        }
    
        return redirect()->to('/peminjaman')
            ->with('success', 'Peminjaman disetujui & stok berkurang');
    }
    
    public function tolak($id)
    {
        $this->peminjaman->update($id, [
            'status' => 'ditolak'
        ]);

        return redirect()->to('/peminjaman')
            ->with('success', 'Peminjaman ditolak');
    }
}
