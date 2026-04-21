<?php

namespace App\Controllers;

use App\Models\PengembalianModel;

class Pengembalian extends BaseController
{
    public function create($id_peminjaman)
    {
        $data['id_peminjaman'] = $id_peminjaman;

        return view('pengembalian/create', $data);
    }

    public function store()
    {
        $model = new PengembalianModel();

        $model->save([
            'id_peminjaman'        => $this->request->getPost('id_peminjaman'),
            'tanggal_dikembalikan' => $this->request->getPost('tanggal_dikembalikan'),
            'denda'                => $this->request->getPost('denda'),
        ]);

        // update status peminjaman
        $db = \Config\Database::connect();
        $db->table('peminjaman')
            ->where('id_peminjaman', $this->request->getPost('id_peminjaman'))
            ->update(['status' => 'dikembalikan']);

        return redirect()->to('/peminjaman')->with('success', 'Buku berhasil dikembalikan');
    }
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
            ->join('peminjaman', 'peminjaman.id_peminjaman = pengembalian.id_peminjaman')
            ->join('users', 'users.id = peminjaman.id')
            ->get()
            ->getResultArray();

        return view('pengembalian/index', $data);
    }
}
