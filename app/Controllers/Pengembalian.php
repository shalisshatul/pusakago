<?php

namespace App\Controllers;

use App\Models\PengembalianModel;

class Pengembalian extends BaseController
{
    public function index()
{
    $db = \Config\Database::connect();

    $data['pengembalian'] = $db->table('pengembalian')
        ->select('
            pengembalian.*,
            peminjaman.tanggal_pinjam,
            peminjaman.tanggal_kembali,
            users.nama
        ')
        ->join('peminjaman', 'peminjaman.id_peminjaman = pengembalian.id_peminjaman', 'left')
        ->join('users', 'users.id = peminjaman.id', 'left')
        ->get()
        ->getResultArray();

    return view('pengembalian/index', $data);
}


    public function create($id_peminjaman)
    {
        $data['id_peminjaman'] = $id_peminjaman;

        return view('pengembalian/create', $data);
    }

    public function store()
    {
        $model = new \App\Models\PengembalianModel();
    
        $tanggal_dikembalikan = $this->request->getPost('tanggal_dikembalikan');
        $tanggal_kembali = $this->request->getPost('tanggal_kembali');
    
        // hitung denda (contoh 1000 per hari telat)
        $denda = 0;
        if ($tanggal_dikembalikan > $tanggal_kembali) {
            $telat = (strtotime($tanggal_dikembalikan) - strtotime($tanggal_kembali)) / 86400;
            $denda = $telat * 1000;
        }
    
        $model->save([
            'id_peminjaman' => $this->request->getPost('id_peminjaman'),
            'tanggal_dikembalikan' => $tanggal_dikembalikan,
            'denda' => $denda
        ]);
    
        return redirect()->to('/pengembalian');
    }
    
    
}
