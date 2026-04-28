<?php

namespace App\Controllers;

use App\Models\PenarikanModel;

class Penarikan extends BaseController
{
    protected $penarikan;

    public function __construct()
    {
        $this->penarikan = new PenarikanModel();
    }

    // =====================
    // INDEX
    // =====================
    public function index()
    {
        $db = \Config\Database::connect();

        $builder = $db->table('penarikan');

        $builder->join('peminjaman', 'peminjaman.id_peminjaman = penarikan.id_peminjaman', 'left');
        $builder->join('users', 'users.id = penarikan.petugas_id', 'left');

        $builder->select('
            penarikan.*,
            peminjaman.tanggal_pinjam,
            peminjaman.tanggal_kembali,
            users.nama as nama_petugas
        ');

        $data['penarikan'] = $builder->get()->getResultArray();

        return view('penarikan/index', $data);
    }

    // =====================
    // PROSES
    // =====================
    public function proses($id)
    {
        $this->penarikan->update($id, [
            'status' => 'diproses',
            'petugas_id' => session()->get('id')
        ]);

        return redirect()->back();
    }

    // =====================
    // AMBIL
    // =====================
    public function ambil($id)
    {
        $this->penarikan->update($id, [
            'status' => 'diambil',
            'tanggal_ambil' => date('Y-m-d')
        ]);

        return redirect()->back();
    }

    // =====================
    // SELESAI
    // =====================
    public function selesai($id)
    {
        $db = \Config\Database::connect();

        $penarikan = $db->table('penarikan')
            ->where('id_penarikan', $id)
            ->get()
            ->getRowArray();

        if (!$penarikan) {
            return redirect()->back();
        }

        // CEK PEMBAYARAN
        if (($penarikan['status_bayar'] ?? '') != 'dibayar') {
            return redirect()->back()->with('error', 'Belum dibayar!');
        }

        // =====================
        // 1. UPDATE PENARIKAN
        // =====================
        $db->table('penarikan')
            ->where('id_penarikan', $id)
            ->update([
                'status' => 'selesai'
            ]);

        // =====================
        // 2. UPDATE PEMINJAMAN
        // =====================
        $db->table('peminjaman')
            ->where('id_peminjaman', $penarikan['id_peminjaman'])
            ->update([
                'status' => 'dikembalikan'
            ]);

        // =====================
        // 3. INSERT PENGEMBALIAN (FIX SESUAI TABEL KAMU)
        // =====================
        $db->table('pengembalian')->insert([
            'id_peminjaman' => $penarikan['id_peminjaman'],
            'tanggal_dikembalikan' => date('Y-m-d'),
            'denda' => 0,
            'status_denda' => 'belum_bayar'
        ]);

        // =====================
        // 4. TAMBAH STOK BUKU
        // =====================
        $peminjaman = $db->table('peminjaman')
            ->where('id_peminjaman', $penarikan['id_peminjaman'])
            ->get()
            ->getRowArray();

        if ($peminjaman && isset($peminjaman['id_buku'])) {
            $db->table('buku')
                ->where('id_buku', $peminjaman['id_buku'])
                ->set('stok', 'stok+1', false)
                ->update();
        }

        return redirect()->back()->with('success', 'Pengembalian berhasil & stok bertambah');
    }

    // =====================
    // HAPUS
    // =====================
    public function hapus($id)
    {
        if (session()->get('role') != 'petugas') {
            return redirect()->back();
        }

        $db = \Config\Database::connect();

        $db->table('penarikan')
            ->where('id_penarikan', $id)
            ->delete();

        return redirect()->back()->with('success', 'Data dihapus');
    }
    public function detail($id)
    {
        $data['penarikan'] = $this->penarikan
            ->select('
            penarikan.*,
            anggota.nama as nama_anggota,
            petugas.nama as nama_petugas,
            transaksi.bukti,
            transaksi.jumlah as jumlah_bayar
        ')
            ->join('peminjaman', 'peminjaman.id_peminjaman = penarikan.id_peminjaman', 'left')

            // ✔️ FIX: relasi user (anggota)
            ->join('users as anggota', 'anggota.id = peminjaman.id', 'left')

            // ✔️ FIX: relasi petugas
            ->join('users as petugas', 'petugas.id = penarikan.petugas_id', 'left')

            ->join('transaksi', 'transaksi.id_peminjaman = penarikan.id_peminjaman', 'left')
            ->where('penarikan.id_penarikan', $id)
            ->first();

        return view('penarikan/detail', $data);
    }
}
