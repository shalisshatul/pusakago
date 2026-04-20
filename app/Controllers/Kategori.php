<?php

namespace App\Controllers;
namespace App\Controllers;
use App\Models\KategoriModel;

class Kategori extends BaseController
{public function index()
    {
        $model = new \App\Models\KategoriModel();
    
        $keyword = $this->request->getGet('keyword');
    
        if ($keyword) {
            $data['kategori'] = $model
                ->like('nama_kategori', $keyword)
                ->where('is_deleted', 0)
                ->findAll();
        } else {
            $data['kategori'] = $model
                ->where('is_deleted', 0)
                ->findAll();
        }
    
        return view('kategori/index', $data);
    }
    public function create()
    {
        return view('kategori/create');
    }

    public function store()
    {
        $model = new KategoriModel();
        $model->insert([
            'nama_kategori' => $this->request->getPost('nama_kategori')
        ]);
        return redirect()->to('/kategori');
    }

    public function edit($id)
    {
        $model = new \App\Models\KategoriModel();
        
        $data['kategori'] = $model->find($id);
    
        return view('kategori/edit', $data);
    }
    public function update($id)
    {
        $model = new KategoriModel();
        $model->update($id, [
            'nama_kategori' => $this->request->getPost('nama_kategori')
        ]);
        return redirect()->to('/kategori');
    }

    public function delete($id)
    {
        $model = new \App\Models\KategoriModel();
    
        $model->update($id, [
            'is_deleted' => 1
        ]);
    
        return redirect()->to('/kategori');
    }
}