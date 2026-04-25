<?php

namespace App\Controllers;
use App\Models\PenerbitModel;

class Penerbit extends BaseController
{
    public function index()
    {
        $model = new PenerbitModel();

        $keyword = $this->request->getGet('keyword');

        $builder = $model->where('is_deleted', 0);

        if ($keyword) {
            $builder->like('nama_penerbit', $keyword);
        }

        $data['penerbit'] = $builder->findAll();

        return view('penerbit/index', $data);
    }

    public function store()
    {
        $model = new PenerbitModel();

        if (!$this->request->getPost('nama_penerbit')) {
            return redirect()->back()->with('error', 'Nama penerbit wajib diisi');
        }

        $model->insert([
            'nama_penerbit' => $this->request->getPost('nama_penerbit'),
            'alamat'        => $this->request->getPost('alamat')
        ]);

        return redirect()->to('/penerbit')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $model = new PenerbitModel();

        $data['penerbit'] = $model->find($id);

        return view('penerbit/edit', $data);
    }

    public function update($id)
    {
        $model = new PenerbitModel();

        $model->update($id, [
            'nama_penerbit' => $this->request->getPost('nama_penerbit'),
            'alamat'        => $this->request->getPost('alamat')
        ]);

        return redirect()->to('/penerbit');
    }

    public function delete($id)
    {
        $model = new PenerbitModel();

        $model->update($id, [
            'is_deleted' => 1
        ]);

        return redirect()->to('/penerbit');
    }
}
