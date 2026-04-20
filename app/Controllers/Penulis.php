<?php

namespace App\Controllers;

use App\Models\PenulisModel;

class Penulis extends BaseController
{
    public function index()
{
    $model = new \App\Models\PenulisModel();

    $keyword = $this->request->getGet('keyword');

    if ($keyword) {
        $data['penulis'] = $model
            ->like('nama_penulis', $keyword)
            ->where('is_deleted', 0)
            ->findAll();
    } else {
        $data['penulis'] = $model
            ->where('is_deleted', 0)
            ->findAll();
    }

    return view('penulis/index', $data);
}

    public function create()
    {
        return view('penulis/create');
    }

    public function store()
{
    $model = new \App\Models\PenulisModel();

    $nama = $this->request->getPost('nama_penulis');

    if (!$nama) {
        return redirect()->back()->with('error', 'Nama penulis wajib diisi');
    }

    $model->insert([
        'nama_penulis' => $nama
    ]);

    return redirect()->to('/penulis');
}
    public function edit($id)
    {
        $model = new PenulisModel();
        $data['penulis'] = $model->find($id);

        return view('penulis/edit', $data);
    }

    public function update($id)
    {
        $model = new \App\Models\PenulisModel();
    
        $data = [
            'nama_penulis' => $this->request->getPost('nama_penulis')
        ];
    
        // CEK KALAU KOSONG (INI PENTING)
        if (!$data['nama_penulis']) {
            return redirect()->back()->with('error', 'Data tidak boleh kosong');
        }
    
        $model->update($id, $data);
    
        return redirect()->to('/penulis');
    }
    public function delete($id)
    {
        $model = new \App\Models\PenulisModel();
    
        $model->update($id, [
            'is_deleted' => 1
        ]);
    
        return redirect()->to('/penulis');
    }
    }
