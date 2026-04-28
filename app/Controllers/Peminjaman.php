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

        // ======================
        // USER ANGGOTA
        // ======================
        $builder->join('users as user_anggota', 'user_anggota.id = peminjaman.id', 'left');

        // ======================
        // PETUGAS PENYETUJU
        // ======================
        $builder->join('users as petugas', 'petugas.id = peminjaman.petugas_id', 'left');

        // ======================
        // DETAIL + BUKU
        // ======================
        $builder->join('detail_peminjaman', 'detail_peminjaman.id_peminjaman = peminjaman.id_peminjaman', 'left');
        $builder->join('buku', 'buku.id_buku = detail_peminjaman.id_buku', 'left');

        // ======================
        // PENGIRIMAN
        // ======================
        $builder->join('pengiriman', 'pengiriman.id_peminjaman = peminjaman.id_peminjaman', 'left');

        // 🔥 PETUGAS PENGANTAR
        $builder->join('users as petugas_kirim', 'petugas_kirim.id = pengiriman.petugas_id', 'left');

        // ======================
        // SELECT DATA
        // ======================
        $builder->select('
            peminjaman.id_peminjaman,
            peminjaman.tanggal_pinjam,
            peminjaman.tanggal_kembali,
            peminjaman.status,
            peminjaman.metode,
    
            user_anggota.nama as nama,
            petugas.nama as nama_petugas,
            petugas_kirim.nama as nama_petugas_kirim,
    
            GROUP_CONCAT(DISTINCT buku.judul SEPARATOR ", ") as judul,
            IFNULL(pengiriman.status, "-") as status_pengiriman
        ');

        // ======================
        // FILTER ANGGOTA
        // ======================
        if (session()->get('role') == 'anggota') {
            $builder->where('peminjaman.id', session()->get('id'));
        }

        // ======================
        // GROUP & ORDER
        // ======================
        $builder->groupBy('peminjaman.id_peminjaman');
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

    public function store()
    {
        $db = \Config\Database::connect();

        $metode = $this->request->getPost('metode');
        $id_buku_list = $this->request->getPost('id_buku');

        if (!$id_buku_list) {
            return redirect()->back()->with('error', 'Pilih minimal 1 buku');
        }

        if (!is_array($id_buku_list)) {
            $id_buku_list = [$id_buku_list];
        }

        $id_buku_list = array_unique($id_buku_list);

        // =========================
        // STATUS PEMINJAMAN
        // =========================
        $tanggal_pinjam = null;
        $tanggal_kembali = null;

        if ($metode == 'ambil') {
            $status = 'menunggu';
        } else {
            $status = 'menunggu';
        }

        // =========================
        // SIMPAN PEMINJAMAN
        // =========================
        $this->peminjaman->insert([
            'tanggal_pinjam'  => $tanggal_pinjam,
            'tanggal_kembali' => $tanggal_kembali,
            'status'          => $status,
            'id'              => session()->get('id'),
            'metode'          => $metode
        ]);

        $id_peminjaman = $this->peminjaman->getInsertID();

        // =========================
        // 🚚 JIKA ANTAR
        // =========================
        if ($metode == 'antar') {

            $alamat = $this->request->getPost('alamat');
            $biaya = 10000;

            // 🔥 PENGIRIMAN
            $db->table('pengiriman')->insert([
                'id_peminjaman' => $id_peminjaman,
                'alamat'        => $alamat,
                'biaya'         => $biaya,
                'status'        => 'menunggu'
            ]);

            // =========================
            // 🔥 PENARIKAN OTOMATIS (INI YANG KITA TAMBAH)
            // =========================
            $db->table('penarikan')->insert([
                'id_peminjaman' => $id_peminjaman,
                'alamat'        => $alamat,
                'biaya'         => $biaya,
                'status'        => 'menunggu',
                'petugas_id'    => null // nanti diisi saat proses
            ]);

            // =========================
            // TRANSAKSI
            // =========================
            $db->table('transaksi')->insert([
                'id_peminjaman' => $id_peminjaman,
                'jenis'         => 'pengiriman',
                'jumlah'        => $biaya,
                'status'        => 'belum_bayar'
            ]);
        }

        // =========================
        // DETAIL BUKU
        // =========================
        $detailModel = new \App\Models\DetailPeminjamanModel();

        foreach ($id_buku_list as $id_buku) {
            $detailModel->insert([
                'id_peminjaman' => $id_peminjaman,
                'id_buku'       => $id_buku,
                'jumlah'        => 1
            ]);
        }

        // =========================
        // STOK (HANYA AMBIL)
        // =========================
        if ($metode == 'ambil') {
            foreach ($id_buku_list as $id_buku) {
                $db->table('buku')
                    ->where('id_buku', $id_buku)
                    ->set('tersedia', 'tersedia - 1', false)
                    ->update();
            }
        }

        // =========================
        // PESAN
        // =========================
        $pesan = ($metode == 'ambil')
            ? 'Buku berhasil dipinjam'
            : 'Menunggu pengiriman';

        return redirect()->to('/peminjaman')
            ->with('success', $pesan);
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
    public function setujui($id)
    {
        $db = \Config\Database::connect();

        $db->table('peminjaman')
            ->where('id_peminjaman', $id)
            ->update([
                'status' => 'dipinjam',
                'tanggal_pinjam' => date('Y-m-d'),
                'tanggal_kembali' => date('Y-m-d', strtotime('+5 days')),
                'petugas_id' => session()->get('id')
            ]);

        return redirect()->back()->with('success', 'Disetujui');
    }



    public function kembalikan($id)
    {
        $db = \Config\Database::connect();

        $peminjamanModel   = new \App\Models\PeminjamanModel();
        $pengembalianModel = new \App\Models\PengembalianModel();

        $peminjaman = $peminjamanModel->find($id);

        if (!$peminjaman) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        if ($peminjaman['status'] == 'dikembalikan') {
            return redirect()->back()->with('error', 'Sudah dikembalikan');
        }

        // ======================
        // TANGGAL
        // ======================
        $tanggal_dikembalikan = date('Y-m-d');
        $tenggat = $peminjaman['tanggal_kembali'];

        // ======================
        // DENDA 2000 / HARI
        // ======================
        $denda = 0;

        if (!empty($tenggat)) {
            $tgl_kembali = strtotime($tanggal_dikembalikan);
            $tgl_tenggat = strtotime($tenggat);

            if ($tgl_kembali > $tgl_tenggat) {
                $selisih_hari = ceil(($tgl_kembali - $tgl_tenggat) / 86400);
                $denda = $selisih_hari * 2000;
            }
        }

        // ======================
        // SIMPAN PENGEMBALIAN
        // ======================
        $pengembalianModel->save([
            'id_peminjaman'        => $id,
            'tanggal_dikembalikan' => $tanggal_dikembalikan,
            'denda'                => $denda
        ]);

        // ======================
        // AMBIL DETAIL BUKU
        // ======================
        $detail = $db->table('detail_peminjaman')
            ->where('id_peminjaman', $id)
            ->get()
            ->getResultArray();

        // ======================
        // TAMBAH STOK BUKU
        // ======================
        foreach ($detail as $d) {
            $db->table('buku')
                ->where('id_buku', $d['id_buku'])
                ->set('tersedia', 'tersedia + ' . (int)$d['jumlah'], false)
                ->update();
        }

        // ======================
        // UPDATE STATUS PEMINJAMAN
        // ======================
        $peminjamanModel->update($id, [
            'status' => 'dikembalikan'
        ]);

        return redirect()->to('/pengembalian')
            ->with('success', 'Buku berhasil dikembalikan');
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

        return redirect()->to('/peminjaman')->with('success', 'Data berhasil dihapus');
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
    public function selesai($id)
    {
        $model = new \App\Models\PeminjamanModel();

        $model->update($id, [
            'status' => 'selesai',
            'tanggal_kembali' => date('Y-m-d')
        ]);

        return redirect()->to('/peminjaman')->with('success', 'Peminjaman selesai');
    }
}
