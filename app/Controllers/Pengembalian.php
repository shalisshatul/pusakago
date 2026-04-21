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

        $model->save([
            'id_peminjaman' => $this->request->getPost('id_peminjaman'),
            'tanggal_kembali' => $this->request->getPost('tanggal_kembali'),
            'denda' => $this->request->getPost('denda'),
            'status' => 'Menunggu'
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
            'tanggal_kembali' => $this->request->getPost('tanggal_kembali'),
            'denda' => $this->request->getPost('denda'),
            'status' => $this->request->getPost('status')
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
