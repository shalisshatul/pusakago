<?php

namespace App\Controllers;

use App\Models\PengembalianModel;

class Pengembalian extends BaseController
{
    public function index()
    {
        $model = new PengembalianModel();
        $data['pengembalian'] = $model->findAll();

        return view('pengembalian/index', $data);
    }

    public function create()
    {
        return view('pengembalian/create');
    }

    public function store()
    {
        $model = new PengembalianModel();

        $model->insert([
            'id_peminjaman' => $this->request->getPost('id_peminjaman'),
            'tanggal_dikembalikan' => $this->request->getPost('tanggal_dikembalikan'),
            'denda' => $this->request->getPost('denda')
        ]);

        return redirect()->to('/pengembalian');
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
        $model = new PengembalianModel();
        $model->delete($id);

        return redirect()->to('/pengembalian');
    }
}
