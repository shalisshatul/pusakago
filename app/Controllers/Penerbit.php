<?php

namespace App\Controllers;
use App\Models\PenerbitModel;

class Penerbit extends BaseController
{
    public function index()
{
    $model = new \App\Models\PenerbitModel();

    $keyword = $this->request->getGet('keyword');

    if ($keyword) {
        $data['penerbit'] = $model
            ->like('nama_penerbit', $keyword)
            ->where('is_deleted', 0)
            ->findAll();
    } else {
        $data['penerbit'] = $model
            ->where('is_deleted', 0)
            ->findAll();
    }

    return view('penerbit/index', $data);
}
    public function store()
    {
        $model = new \App\Models\PenerbitModel();
    
        $model->insert([
            'nama_penerbit' => $this->request->getPost('nama_penerbit'),
            'alamat' => $this->request->getPost('alamat')
        ]);
    
        return redirect()->to('/penerbit');
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
            'alamat' => $this->request->getPost('alamat')
        ]);

        return redirect()->to('/penerbit');
    }

    public function delete($id)
{
    $model = new \App\Models\PenerbitModel();

    $model->update($id, [
        'is_deleted' => 1
    ]);

    return redirect()->to('/penerbit');
}
}