<?php

namespace App\Controllers;

use App\Models\BukuModel;
use App\Models\KategoriModel;
use App\Models\PenulisModel;
use App\Models\PenerbitModel;
use App\Models\RakModel;
use App\Models\RakBukuModel;

class Buku extends BaseController
{
    protected $buku;

    public function __construct()
    {
        $this->buku = new BukuModel();
    }

    public function index()
    {
        $keyword = $this->request->getGet('keyword');
    
        $data['buku'] = $this->buku->getBuku($keyword);
        $data['keyword'] = $keyword;
    
        return view('buku/index', $data);
    }
    public function create()
    {
        $data['kategori'] = (new KategoriModel())->findAll();
        $data['penulis']  = (new PenulisModel())->findAll();
        $data['penerbit'] = (new PenerbitModel())->findAll();
        $data['rak']      = (new RakModel())->findAll();

        return view('buku/create', $data);
    }

    public function store()
    {
        $kategoriModel = new KategoriModel();
        $penulisModel  = new PenulisModel();
        $penerbitModel = new PenerbitModel();
        $rakModel      = new RakModel();
        $rakBukuModel  = new RakBukuModel();

        $judul       = $this->request->getPost('judul');
        $id_kategori = $this->request->getPost('id_kategori');
        $id_penulis  = $this->request->getPost('id_penulis');
        $id_penerbit = $this->request->getPost('id_penerbit');
        $id_rak      = $this->request->getPost('id_rak');

        $kategoriBaru = $this->request->getPost('kategori_baru');
        $penulisBaru  = $this->request->getPost('penulis_baru');
        $penerbitBaru = $this->request->getPost('penerbit_baru');
        $rakBaru      = $this->request->getPost('rak_baru');

        if ($kategoriBaru) {
            $kategoriModel->insert(['nama_kategori' => $kategoriBaru]);
            $id_kategori = $kategoriModel->insertID();
        }

        if ($penulisBaru) {
            $penulisModel->insert(['nama_penulis' => $penulisBaru]);
            $id_penulis = $penulisModel->insertID();
        }

        if ($penerbitBaru) {
            $penerbitModel->insert([
                'nama_penerbit' => $penerbitBaru,
                'alamat' => ''
            ]);
            $id_penerbit = $penerbitModel->insertID();
        }

        if ($rakBaru) {
            $rakModel->insert([
                'nama_rak' => $rakBaru,
                'lokasi'   => ''
            ]);
            $id_rak = $rakModel->insertID();
        }

        $this->buku->insert([
            'judul'        => $judul,
            'id_kategori'  => $id_kategori,
            'id_penulis'   => $id_penulis,
            'id_penerbit'  => $id_penerbit,
            'tahun_terbit' => $this->request->getPost('tahun_terbit'),
            'jumlah'       => $this->request->getPost('jumlah'),
            'tersedia'     => $this->request->getPost('tersedia'),
        ]);

        $id_buku = $this->buku->insertID();

        if ($id_rak) {
            $rakBukuModel->insert([
                'id_buku' => $id_buku,
                'id_rak'  => $id_rak
            ]);
        }

        return redirect()->to('/buku')->with('success', 'Buku berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data['buku']     = $this->buku->find($id);
        $data['kategori'] = (new KategoriModel())->findAll();
        $data['penulis']  = (new PenulisModel())->findAll();
        $data['penerbit'] = (new PenerbitModel())->findAll();
        $data['rak']      = (new RakModel())->findAll();

        return view('buku/edit', $data);
    }

    public function update($id)
    {
        $kategoriModel = new KategoriModel();
        $penulisModel  = new PenulisModel();
        $penerbitModel = new PenerbitModel();
        $rakModel      = new RakModel();
        $rakBukuModel  = new RakBukuModel();
    
        // Ambil input
        $id_kategori   = $this->request->getPost('id_kategori');
        $id_penulis    = $this->request->getPost('id_penulis');
        $id_penerbit   = $this->request->getPost('id_penerbit');
        $id_rak        = $this->request->getPost('id_rak');
    
        $kategoriBaru  = $this->request->getPost('kategori_baru');
        $penulisBaru   = $this->request->getPost('penulis_baru');
        $penerbitBaru  = $this->request->getPost('penerbit_baru');
        $rakBaru       = $this->request->getPost('rak_baru');
    
        // ✅ KATEGORI
        if (!empty($kategoriBaru)) {
            $kategoriModel->insert([
                'nama_kategori' => $kategoriBaru
            ]);
            $id_kategori = $kategoriModel->insertID();
        }
    
        // ✅ PENULIS
        if (!empty($penulisBaru)) {
            $penulisModel->insert([
                'nama_penulis' => $penulisBaru
            ]);
            $id_penulis = $penulisModel->insertID();
        }
    
        // ✅ PENERBIT
        if (!empty($penerbitBaru)) {
            $penerbitModel->insert([
                'nama_penerbit' => $penerbitBaru,
                'alamat' => ''
            ]);
            $id_penerbit = $penerbitModel->insertID();
        }
    
        // ✅ RAK
        if (!empty($rakBaru)) {
            $rakModel->insert([
                'nama_rak' => $rakBaru,
                'lokasi'   => ''
            ]);
            $id_rak = $rakModel->insertID();
        }
    
        // ❗ VALIDASI (biar tidak kosong)
        if (empty($id_kategori) || empty($id_penulis) || empty($id_penerbit)) {
            return redirect()->back()->with('error', 'Kategori, Penulis, dan Penerbit wajib diisi');
        }
    
        // ✅ UPDATE BUKU
        $this->buku->update($id, [
            'judul'        => $this->request->getPost('judul'),
            'id_kategori'  => $id_kategori,
            'id_penulis'   => $id_penulis,
            'id_penerbit'  => $id_penerbit,
            'tahun_terbit' => $this->request->getPost('tahun_terbit'),
            'jumlah'       => $this->request->getPost('jumlah'),
            'tersedia'     => $this->request->getPost('tersedia'),
        ]);
    
        // 🔁 Update relasi rak
        $rakBukuModel->where('id_buku', $id)->delete();
    
        if (!empty($id_rak)) {
            $rakBukuModel->insert([
                'id_buku' => $id,
                'id_rak'  => $id_rak
            ]);
        }
    
        return redirect()->to('/buku')->with('success', 'Buku berhasil diupdate');
    }
    public function detail($id)
    {
        $data['buku'] = $this->buku
            ->select('buku.*, kategori.nama_kategori, penulis.nama_penulis, penerbit.nama_penerbit, rak.nama_rak')
            ->join('kategori', 'kategori.id_kategori = buku.id_kategori')
            ->join('penulis', 'penulis.id_penulis = buku.id_penulis')
            ->join('penerbit', 'penerbit.id_penerbit = buku.id_penerbit')
            ->join('rak_buku', 'rak_buku.id_buku = buku.id_buku', 'left')
            ->join('rak', 'rak.id_rak = rak_buku.id_rak', 'left')
            ->where('buku.id_buku', $id)
            ->first();
    
        return view('buku/detail', $data);
    }
}