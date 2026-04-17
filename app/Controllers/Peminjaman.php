<?php

namespace App\Controllers;

use App\Models\PeminjamanModel;
use App\Models\DetailModel;
use Config\Database;

class Peminjaman extends BaseController
{
    protected $peminjaman;

    public function __construct()
    {
        $this->peminjaman = new PeminjamanModel();
    }

    // =========================
    // 📥 PINJAM (MASUK KERANJANG)
    // =========================
    public function pinjam($id_buku)
    {
        $id_user = session()->get('id');

        // 1. buat peminjaman (status masih pending)
        $this->peminjaman->insert([
            'id_user' => $id_user,
            'tanggal_pinjam' => date('Y-m-d'),
            'tanggal_kembali' => date('Y-m-d', strtotime('+7 days')),
            'status' => 'dipinjam'
        ]);

        $id_peminjaman = $this->peminjaman->insertID();

        // 2. detail peminjaman
        $detail = new DetailModel();
        $detail->insert([
            'id_peminjaman' => $id_peminjaman,
            'id_buku' => $id_buku,
            'jumlah' => 1
        ]);

        return redirect()->to(base_url('peminjaman/keranjang'))
            ->with('success', 'Buku masuk keranjang peminjaman');
    }

   // 🛒 KERANJANG ANGGOTA
    public function keranjang()
    {
        $id_user = session()->get('id');

        $db = Database::connect();

        $data['keranjang'] = $db->table('peminjaman')
            ->join('detail_peminjaman', 'detail_peminjaman.id_peminjaman = peminjaman.id_peminjaman')
            ->join('buku', 'buku.id_buku = detail_peminjaman.id_buku')
            ->where('peminjaman.id', $id_user)
            ->get()
            ->getResultArray();

        return view('peminjaman/keranjang', $data);
    }

    // =========================
    // 📋 LIST (PETUGAS)
    // =========================
    public function index()
    {
        $data['peminjaman'] = $this->peminjaman->findAll();
        return view('peminjaman/index', $data);
    }

    // =========================
    // ✅ KONFIRMASI PETUGAS
    // =========================
    public function konfirmasi($id)
    {
        $this->peminjaman->update($id, [
            'status' => 'dipinjam',
            'tanggal_pinjam' => date('Y-m-d'),
            'tanggal_kembali' => date('Y-m-d', strtotime('+7 days'))
        ]);

        return redirect()->back()->with('success', 'Peminjaman disetujui');
    }

    // =========================
    // 🔁 KEMBALIKAN + DENDA
    // =========================
    public function kembalikan($id)
    {
        $peminjaman = $this->peminjaman->find($id);

        $today = date('Y-m-d');
        $telat = (strtotime($today) - strtotime($peminjaman['tanggal_kembali'])) / 86400;

        $denda = ($telat > 0) ? $telat * 1000 : 0;

        $db = Database::connect();

        // simpan pengembalian
        $db->table('pengembalian')->insert([
            'id_peminjaman' => $id,
            'tanggal_dikembalikan' => $today,
            'denda' => $denda
        ]);

        // update status
        $this->peminjaman->update($id, [
            'status' => 'dikembalikan'
        ]);

        return redirect()->back()->with('success', 'Buku dikembalikan. Denda: ' . $denda);
    }
}