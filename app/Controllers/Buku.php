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

    // ambil input
    $id_kategori = $this->request->getPost('id_kategori');
    $id_penulis  = $this->request->getPost('id_penulis');
    $id_penerbit = $this->request->getPost('id_penerbit');
    $id_rak      = $this->request->getPost('id_rak');

    $kategoriBaru = $this->request->getPost('kategori_baru');
    $penulisBaru  = $this->request->getPost('penulis_baru');
    $penerbitBaru = $this->request->getPost('penerbit_baru');
    $rakBaru      = $this->request->getPost('rak_baru');

    // =========================
    // VALIDASI
    // =========================
    if (!$id_kategori && !$kategoriBaru) {
        return redirect()->back()->withInput()->with('error', 'Kategori wajib diisi');
    }

    if (!$id_penulis && !$penulisBaru) {
        return redirect()->back()->withInput()->with('error', 'Penulis wajib diisi');
    }

    if (!$id_penerbit && !$penerbitBaru) {
        return redirect()->back()->withInput()->with('error', 'Penerbit wajib diisi');
    }

    // =========================
    // INSERT DATA BARU
    // =========================
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

    // =========================
    // UPLOAD COVER
    // =========================
    $cover = $this->request->getFile('cover');
    $namaCover = null;

    if ($cover && $cover->isValid() && !$cover->hasMoved()) {
        $namaCover = $cover->getRandomName();
        $cover->move(FCPATH . 'uploads/buku', $namaCover);
    }

    // =========================
    // SIMPAN BUKU
    // =========================
    $this->buku->insert([
        'judul'        => $this->request->getPost('judul'),
        'isbn'         => $this->request->getPost('isbn'),
        'deskripsi'    => $this->request->getPost('deskripsi'),
        'id_kategori'  => $id_kategori,
        'id_penulis'   => $id_penulis,
        'id_penerbit'  => $id_penerbit,
        'tahun_terbit' => $this->request->getPost('tahun_terbit'),
        'jumlah'       => $this->request->getPost('jumlah'),
        'tersedia'     => $this->request->getPost('tersedia'),
        'cover'        => $namaCover
    ]);

    $id_buku = $this->buku->insertID();

    // =========================
    // SIMPAN KE RAK
    // =========================
    if (!empty($id_rak)) {
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
        $rakBukuModel = new RakBukuModel();

        $this->buku->update($id, [
            'judul'        => $this->request->getPost('judul'),
            'id_kategori'  => $this->request->getPost('id_kategori'),
            'id_penulis'   => $this->request->getPost('id_penulis'),
            'id_penerbit'  => $this->request->getPost('id_penerbit'),
            'tahun_terbit' => $this->request->getPost('tahun_terbit'),
            'jumlah'       => $this->request->getPost('jumlah'),
            'tersedia'     => $this->request->getPost('tersedia'),
            'isbn'         => $this->request->getPost('isbn'),
            'deskripsi'    => $this->request->getPost('deskripsi'),
        ]);

        $rakBukuModel->where('id_buku', $id)->delete();

        if ($this->request->getPost('id_rak')) {
            $rakBukuModel->insert([
                'id_buku' => $id,
                'id_rak'  => $this->request->getPost('id_rak')
            ]);
        }

        return redirect()->to('/buku')->with('success', 'Buku berhasil diupdate');
    }

    public function detail($id)
    {
        $bukuModel = new \App\Models\BukuModel();

        $data['buku'] = $bukuModel
            ->select('buku.*, kategori.nama_kategori, penulis.nama_penulis, penerbit.nama_penerbit')
            ->join('kategori', 'kategori.id_kategori = buku.id_kategori', 'left')
            ->join('penulis', 'penulis.id_penulis = buku.id_penulis', 'left')
            ->join('penerbit', 'penerbit.id_penerbit = buku.id_penerbit', 'left')
            ->find($id);

        $data['from'] = $this->request->getGet('from');

        return view('buku/detail', $data);
    }

    public function delete($id)
    {
        $this->buku->delete($id);

        return redirect()->to(base_url('buku'))
            ->with('success', 'Buku berhasil dihapus');
    }
}
