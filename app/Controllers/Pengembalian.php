<?php

namespace App\Controllers;

use App\Models\PengembalianModel;

class Pengembalian extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('pengembalian');
    
        $builder->select('
            pengembalian.*,
            peminjaman.tanggal_pinjam,
            users.nama,
            buku.judul
        ');
    
        $builder->join('peminjaman', 'peminjaman.id_peminjaman = pengembalian.id_peminjaman');
        $builder->join('users', 'users.id = peminjaman.id');
        $builder->join('buku', 'buku.id_buku = peminjaman.id_buku');
    
        $builder->orderBy('pengembalian.id_pengembalian', 'DESC');
    
        $data['pengembalian'] = $builder->get()->getResultArray();
    
        return view('pengembalian/index', $data);
    }
    

    public function edit($id)
    {
        $model = new PengembalianModel();
        $data['pengembalian'] = $model->find($id);

        return view('pengembalian/edit', $data);
    }

    public function update($id)
    {
        $model = new PengembalianModel();

        $model->update($id, [
            'id_peminjaman' => $this->request->getPost('id_peminjaman'),
            'tanggal_dikembalikan' => $this->request->getPost('tanggal_dikembalikan'),
            'denda' => $this->request->getPost('denda')
        ]);

        return redirect()->to('/pengembalian');
    }

    public function delete($id)
    {
        // ❌ blok kalau bukan admin
        if (session()->get('role') != 'admin') {
            return redirect()->to('/pengembalian')
                ->with('error', 'Tidak diizinkan');
        }
    
        $model = new PengembalianModel();
        $model->delete($id);
    
        return redirect()->to('/pengembalian')
            ->with('success', 'Data berhasil dihapus');
    }
    
}
