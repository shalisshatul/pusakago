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
        GROUP_CONCAT(buku.judul SEPARATOR ", ") as judul,
        IFNULL(pengiriman.status, "-") as status_pengiriman
    ');

        $builder->join('users', 'users.id = peminjaman.id', 'left');

        $builder->join('detail_peminjaman', 'detail_peminjaman.id_peminjaman = peminjaman.id_peminjaman', 'left');
        $builder->join('buku', 'buku.id_buku = detail_peminjaman.id_buku', 'left');

        $builder->join('pengiriman', 'pengiriman.id_peminjaman = peminjaman.id_peminjaman', 'left');

        $builder->groupBy('peminjaman.id_peminjaman');

        if (session()->get('role') == 'anggota') {
            $builder->where('peminjaman.id', session()->get('id'));
        }

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
        $tanggal_pinjam = $this->request->getPost('tanggal_pinjam');
        $metode = $this->request->getPost('metode');
        $id_buku_list = $this->request->getPost('id_buku');

        if (!is_array($id_buku_list)) {
            $id_buku_list = [$id_buku_list];
        }

        $tanggal_kembali = date('Y-m-d', strtotime($tanggal_pinjam . ' +5 days'));

        // 🔥 WAJIB: awalnya MENUNGGU
        $status = 'menunggu';

        // SIMPAN HEADER
        $this->peminjaman->insert([
            'tanggal_pinjam'  => $tanggal_pinjam,
            'tanggal_kembali' => $tanggal_kembali,
            'status'          => $status,
            'id'              => session()->get('id'),
            'metode'          => $metode
        ]);

        $id_peminjaman = $this->peminjaman->getInsertID();

        // SIMPAN DETAIL
        $detailModel = new \App\Models\DetailPeminjamanModel();

        foreach ($id_buku_list as $id_buku) {
            $detailModel->insert([
                'id_peminjaman' => $id_peminjaman,
                'id_buku'       => $id_buku,
                'jumlah'        => 1
            ]);
        }

        return redirect()->to('/peminjaman')
            ->with('success', 'Data berhasil disimpan');
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
        $peminjamanModel = new \App\Models\PeminjamanModel();
        $pengembalianModel = new \App\Models\PengembalianModel();

        $peminjaman = $peminjamanModel->find($id);

        $tanggal_pinjam = $peminjaman['tanggal_pinjam'];
        $tanggal_kembali = date('Y-m-d');

        if (strtotime($tanggal_kembali) < strtotime($tanggal_pinjam)) {
            $tanggal_kembali = $tanggal_pinjam;
        }

        $selisih = (strtotime($tanggal_kembali) - strtotime($tanggal_pinjam)) / (60 * 60 * 24);

        $denda = 0;
        if ($selisih > 5) {
            $denda = ($selisih - 5) * 1000;
        }

        $pengembalianModel->save([
            'id_peminjaman'        => $id,
            'tanggal_dikembalikan' => $tanggal_kembali,
            'denda'                => $denda
        ]);

        $peminjamanModel->update($id, [
            'status' => 'dikembalikan',
            'tanggal_kembali' => $tanggal_kembali
        ]);

        return redirect()->to('/pengembalian');
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
        $this->peminjaman->update($id, [
            'status' => 'dipinjam'
        ]);

        return redirect()->to('/peminjaman')
            ->with('success', 'Peminjaman disetujui');
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
