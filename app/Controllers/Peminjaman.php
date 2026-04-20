<?php

namespace App\Controllers;

use App\Models\PeminjamanModel;

class Peminjaman extends BaseController
{
    protected $peminjaman;

    public function __construct()
    {
        $this->peminjaman = new PeminjamanModel();
    }

    // READ (tampilan data)
    public function index()
    {
        $db = \Config\Database::connect();
    
        $builder = $db->table('peminjaman');
    
        $builder->select('peminjaman.*, users.nama');
        $builder->join('users', 'users.id = peminjaman.id');
    
        $data['peminjaman'] = $builder->get()->getResultArray();
    
        return view('peminjaman/index', $data);
    }
    // CREATE (form tambah)
    public function create()
{
    $bukuModel = new \App\Models\BukuModel();

    $data['buku'] = $bukuModel->findAll();

    return view('peminjaman/create', $data);
}

    // STORE (simpan data)
    public function store()
{
    $this->peminjaman->save([
        'tanggal_pinjam' => date('Y-m-d'),
        'tanggal_kembali' => null,
        'status' => 'dipinjam',
        'id' => session()->get('id'),
        'id_buku' => $this->request->getPost('id_buku')
    ]);

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
    public function kembalikan($id)
    {
        $this->peminjaman->update($id, [
            'status' => 'dikembalikan',
            'tanggal_kembali' => date('Y-m-d')
        ]);
    
        return redirect()->to('/peminjaman');
    }
    public function detail($id)
{
    $data['peminjaman'] = $this->peminjaman->find($id);

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