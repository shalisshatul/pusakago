<?php
namespace App\Controllers;

use App\Models\PeminjamanModel;
use App\Models\DetailPeminjamanModel;

class Peminjaman extends BaseController
{
    protected $peminjaman;
    protected $detail;

    public function __construct()
    {
        $this->peminjaman = new PeminjamanModel();
        $this->detail = new DetailPeminjamanModel();
    }

    // ================== INDEX (SEMUA DI SINI) ==================
    public function index()
    {
        $keyword = $this->request->getGet('keyword');
        $idUser  = session()->get('id');
        $role    = session()->get('role');

        // default biar tidak undefined
        $data['peminjaman'] = [];
        $data['keranjang']  = [];

        if ($role == 'admin' || $role == 'petugas') {
            // ADMIN
            $data['peminjaman'] = $this->peminjaman->search($keyword);
        } else {
            // ANGGOTA → peminjaman
            $data['peminjaman'] = $this->peminjaman
                ->where('id', $idUser)
                ->where('status !=', 'keranjang')
                ->findAll();

            // ANGGOTA → keranjang
            $data['keranjang'] = $this->detail->getKeranjang($idUser);
        }

        return view('peminjaman/index', $data);
    }

    // ================== PINJAM ==================
    public function pinjam($id_buku)
    {
        $idUser = session()->get('id');

        $cek = $this->peminjaman
            ->where('id', $idUser)
            ->where('status', 'keranjang')
            ->first();

        if (!$cek) {
            $id_peminjaman = $this->peminjaman->insert([
                'tanggal_pinjam' => date('Y-m-d'),
                'status' => 'keranjang',
                'id' => $idUser
            ]);
        } else {
            $id_peminjaman = $cek['id_peminjaman'];
        }

        $this->detail->insert([
            'id_peminjaman' => $id_peminjaman,
            'id_buku' => $id_buku,
            'jumlah' => 1
        ]);

        return redirect()->to('/peminjaman');
    }

    // ================== AJUKAN ==================
    public function ajukan()
    {
        $idUser = session()->get('id');

        $this->peminjaman
            ->where('id', $idUser)
            ->where('status', 'keranjang')
            ->set(['status' => 'dipinjam'])
            ->update();

        return redirect()->to('/peminjaman');
    }

    // ================== SELESAI ==================
    public function selesai($id)
    {
        $this->peminjaman->update($id, [
            'status' => 'dikembalikan',
            'tanggal_kembali' => date('Y-m-d')
        ]);

        return redirect()->to('/peminjaman');
    }
}