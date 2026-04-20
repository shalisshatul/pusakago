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
            peminjaman.*,
            users.nama,
            buku.judul,
            CASE 
                WHEN peminjaman.metode = "antar" 
                THEN IFNULL(pengiriman.status, "menunggu")
                ELSE NULL
            END as status_pengiriman
        ');

        $builder->join('users', 'users.id = peminjaman.id');
        $builder->join('buku', 'buku.id_buku = peminjaman.id_buku');
        $builder->join('pengiriman', 'pengiriman.id_peminjaman = peminjaman.id_peminjaman', 'left');

        if (session()->get('role') == 'anggota') {
            $builder->where('peminjaman.id', session()->get('id'));
        }

        $builder->orderBy('peminjaman.id_peminjaman', 'DESC');

        $data['peminjaman'] = $builder->get()->getResultArray();

        return view('peminjaman/index', $data);
    }

    // CREATE
    public function create()
    {
        $bukuModel = new \App\Models\BukuModel();
        $data['buku'] = $bukuModel->findAll();

        return view('peminjaman/create', $data);
    }

    // STORE ✅ FIX TOTAL
    public function store()
    {
        // ambil input
        $tanggal_pinjam = $this->request->getPost('tanggal_pinjam');
        $metode = $this->request->getPost('metode');

        // jika kosong → hari ini
        if (!$tanggal_pinjam) {
            $tanggal_pinjam = date('Y-m-d');
        }

        // otomatis +5 hari
        $tanggal_kembali = date('Y-m-d', strtotime($tanggal_pinjam . ' +5 days'));

        // status berdasarkan metode
        $status = ($metode == 'ambil') ? 'dipinjam' : 'menunggu';

        // simpan peminjaman
        $this->peminjaman->save([
            'tanggal_pinjam'   => $tanggal_pinjam,
            'tanggal_kembali'  => $tanggal_kembali,
            'status'           => $status,
            'id'               => session()->get('id'),
            'id_buku'          => $this->request->getPost('id_buku'),
            'metode'           => $metode
        ]);

        $id_peminjaman = $this->peminjaman->getInsertID();

        // jika antar → simpan pengiriman
        if ($metode == 'antar') {

            $pengiriman = new PengirimanModel();

            $pengiriman->save([
                'id_peminjaman' => $id_peminjaman,
                'alamat'        => $this->request->getPost('alamat'),
                'biaya'         => 10000,
                'status'        => 'menunggu',
                'tanggal_kirim' => null,
                'petugas_id'    => null
            ]);
        }

        return redirect()->to('/peminjaman');
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
        $this->peminjaman->update($id, [
            'status' => 'dikembalikan',
            'tanggal_kembali' => date('Y-m-d')
        ]);

        return redirect()->to('/peminjaman');
    }

    // DETAIL
    public function detail($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('peminjaman');

        $builder->select('peminjaman.*, users.nama, buku.judul');
        $builder->join('users', 'users.id = peminjaman.id');
        $builder->join('buku', 'buku.id_buku = peminjaman.id_buku');

        $builder->where('peminjaman.id_peminjaman', $id);

        $data['peminjaman'] = $builder->get()->getRowArray();

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
}
