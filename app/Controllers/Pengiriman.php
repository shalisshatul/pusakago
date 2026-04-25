<?php

namespace App\Controllers;

class Pengiriman extends BaseController
{
    public function antar($id)
    {
        $db = \Config\Database::connect();
    
        $db->table('pengiriman')
            ->where('id_peminjaman', $id)
            ->update([
                'status' => 'dikirim',
                'tanggal_kirim' => date('Y-m-d'),
                'id' => session()->get('id') // 🔥 petugas login
            ]);
    
        return redirect()->back()->with('success', 'Buku sedang dikirim');
    }
    
    public function sampai($id)
    {
        $db = \Config\Database::connect();
    
        $peminjamanModel = new \App\Models\PeminjamanModel();
    
        // =========================
        // 🔥 CEK TRANSAKSI (WAJIB BAYAR)
        // =========================
        $transaksi = $db->table('transaksi')
            ->where('id_peminjaman', $id)
            ->where('jenis', 'pengiriman')
            ->get()
            ->getRowArray();
    
        if (!$transaksi || $transaksi['status'] != 'sudah_bayar') {
            return redirect()->back()->with('error', 'Harus bayar ongkir dulu');
        }
    
        // =========================
        // 🔥 CEK DATA PEMINJAMAN
        // =========================
        $peminjaman = $peminjamanModel->find($id);
    
        if (!$peminjaman) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
    
        // ❌ cegah double klik
        if ($peminjaman['status'] == 'dipinjam') {
            return redirect()->back()->with('error', 'Sudah diproses');
        }
    
        // =========================
        // 🔥 UPDATE STATUS PENGIRIMAN
        // =========================
        $db->table('pengiriman')
            ->where('id_peminjaman', $id)
            ->update(['status' => 'sampai']);
    
        // =========================
        // 🔥 AMBIL DETAIL BUKU
        // =========================
        $detail = $db->table('detail_peminjaman')
            ->where('id_peminjaman', $id)
            ->get()
            ->getResultArray();
    
        // =========================
        // 🔥 TANGGAL PINJAM
        // =========================
        $tanggal_pinjam = date('Y-m-d');
        $tanggal_kembali = date('Y-m-d', strtotime('+5 days'));
    
        // =========================
        // 🔥 UPDATE PEMINJAMAN
        // =========================
        $peminjamanModel->update($id, [
            'status' => 'dipinjam',
            'tanggal_pinjam' => $tanggal_pinjam,
            'tanggal_kembali' => $tanggal_kembali
        ]);
    
        // =========================
        // 🔥 KURANGI STOK
        // =========================
        foreach ($detail as $d) {
            $db->table('buku')
                ->where('id_buku', $d['id_buku'])
                ->set('tersedia', 'tersedia - ' . (int)$d['jumlah'], false)
                ->update();
        }
    
        return redirect()->to('/peminjaman')
            ->with('success', 'Buku sudah diterima & status menjadi dipinjam');
    }
    public function delete($id)
{
    if (session()->get('role') != 'admin') {
        return redirect()->back()->with('error', 'Tidak diizinkan');
    }

    $db = \Config\Database::connect();

    $db->table('pengembalian')->delete(['id_pengembalian' => $id]);

    return redirect()->to('/pengembalian')
        ->with('success', 'Data berhasil dihapus');
}

}
