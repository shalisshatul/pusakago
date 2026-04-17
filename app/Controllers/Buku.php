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
        $data['buku'] = $this->buku->getBuku();
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

        // ambil input
        $judul       = $this->request->getPost('judul');
        $id_kategori = $this->request->getPost('id_kategori');
        $id_penulis  = $this->request->getPost('id_penulis');
        $id_penerbit = $this->request->getPost('id_penerbit');
        $id_rak      = $this->request->getPost('id_rak');

        $kategoriBaru = $this->request->getPost('kategori_baru');
        $penulisBaru  = $this->request->getPost('penulis_baru');
        $penerbitBaru = $this->request->getPost('penerbit_baru');
        $rakBaru      = $this->request->getPost('rak_baru');

        // =====================
        // KATEGORI BARU
        // =====================
        if ($kategoriBaru) {
            $kategoriModel->insert(['nama_kategori' => $kategoriBaru]);
            $id_kategori = $kategoriModel->insertID();
        }

        // =====================
        // PENULIS BARU
        // =====================
        if ($penulisBaru) {
            $penulisModel->insert(['nama_penulis' => $penulisBaru]);
            $id_penulis = $penulisModel->insertID();
        }

        // =====================
        // PENERBIT BARU
        // =====================
        if ($penerbitBaru) {
            $penerbitModel->insert([
                'nama_penerbit' => $penerbitBaru,
                'alamat' => ''
            ]);
            $id_penerbit = $penerbitModel->insertID();
        }

        // =====================
        // RAK BARU 🔥
        // =====================
        if ($rakBaru) {
            $rakModel->insert([
                'nama_rak' => $rakBaru,
                'lokasi'   => ''
            ]);
            $id_rak = $rakModel->insertID();
        }

        // VALIDASI
        if (!$judul || !$id_kategori || !$id_penulis || !$id_penerbit) {
            return redirect()->back()->withInput()->with('error', 'Lengkapi data');
        }

        // =====================
        // SIMPAN BUKU
        // =====================
        $this->buku->insert([
            'judul'       => $judul,
            'id_kategori' => $id_kategori,
            'id_penulis'  => $id_penulis,
            'id_penerbit' => $id_penerbit,
        ]);

        $id_buku = $this->buku->insertID();

        // =====================
        // SIMPAN KE rak_buku 🔥
        // =====================
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
        $rakModel     = new RakModel();
        $rakBukuModel = new RakBukuModel();

        $id_rak   = $this->request->getPost('id_rak');
        $rakBaru  = $this->request->getPost('rak_baru');

        // rak baru
        if ($rakBaru) {
            $rakModel->insert([
                'nama_rak' => $rakBaru,
                'lokasi'   => ''
            ]);
            $id_rak = $rakModel->insertID();
        }

        // update buku
        $this->buku->update($id, [
            'judul'       => $this->request->getPost('judul'),
            'id_kategori' => $this->request->getPost('id_kategori'),
            'id_penulis'  => $this->request->getPost('id_penulis'),
            'id_penerbit' => $this->request->getPost('id_penerbit'),
        ]);

        // update relasi rak
        $rakBukuModel->where('id_buku', $id)->delete();

        if ($id_rak) {
            $rakBukuModel->insert([
                'id_buku' => $id,
                'id_rak'  => $id_rak
            ]);
        }

        return redirect()->to('/buku')->with('success', 'Buku berhasil diupdate');
    }

    public function delete($id)
    {
        $this->buku->delete($id);
        return redirect()->to('/buku')->with('success', 'Buku berhasil dihapus');
    }
    public function detail($id)
{
    $data['buku'] = $this->buku->detail($id);
    return view('buku/detail', $data);
}
}