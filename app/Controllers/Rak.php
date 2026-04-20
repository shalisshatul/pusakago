<?php

namespace App\Controllers;
use App\Models\RakModel;

class Rak extends BaseController
{
    public function index()
    {
        $model = new RakModel();
    
        $keyword = $this->request->getGet('keyword');
    
        if ($keyword) {
            $data['rak'] = $model->like('nama_rak', $keyword)->findAll();
        } else {
            $data['rak'] = $model->findAll();
        }
    
        return view('rak/index', $data);
    }
    public function store()
    {
        $model = new RakModel();

        $model->insert([
            'nama_rak' => $this->request->getPost('nama_rak'),
            'lokasi'   => $this->request->getPost('lokasi')
        ]);

        return redirect()->to('/rak');
    }

    public function edit($id)
    {
        $model = new RakModel();

        $data['rak'] = $model->find($id);

        return view('rak/edit', $data);
    }

    public function update($id)
    {
        $model = new RakModel();

        $model->update($id, [
            'nama_rak' => $this->request->getPost('nama_rak'),
            'lokasi'   => $this->request->getPost('lokasi')
        ]);

        return redirect()->to('/rak');
    }

    public function delete($id)
    {
        $model = new RakModel();

        // SOFT DELETE
        $model->update($id, [
            'is_deleted' => 1
        ]);

        return redirect()->to('/rak');
    }
}