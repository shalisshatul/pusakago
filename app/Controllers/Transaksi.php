<?php

namespace App\Controllers;

class Transaksi extends BaseController
{
    public function index($id)
    {
        $db = \Config\Database::connect();

        $transaksi = $db->table('transaksi')
            ->where('id_peminjaman', $id)
            ->where('jenis', 'pengiriman')
            ->get()
            ->getRowArray();

        if (!$transaksi) {
            return redirect()->back()->with('error', 'Transaksi tidak ditemukan');
        }

        $data['transaksi'] = $transaksi;

        return view('transaksi/index', $data);
    }

    public function prosesBayar()
    {
        $db = \Config\Database::connect();

        $id_peminjaman = $this->request->getPost('id_peminjaman');
        $metode = $this->request->getPost('metode');

        // upload bukti jika QRIS
        if ($metode == 'qris') {
            $file = $this->request->getFile('bukti');

            if ($file && $file->isValid()) {
                $namaFile = $file->getRandomName();
                $file->move('uploads/', $namaFile);
            } else {
                return redirect()->back()->with('error', 'Upload bukti pembayaran');
            }
        }

        // update transaksi
        $db->table('transaksi')
            ->where('id_peminjaman', $id_peminjaman)
            ->update([
                'status' => 'sudah_bayar'
            ]);

        return redirect()->to('/peminjaman')
            ->with('success', 'Pembayaran berhasil');
    }
    public function bayar($id_peminjaman)
    {
        $db = \Config\Database::connect();

        // ambil data penarikan (untuk ongkir)
        $penarikan = $db->table('penarikan')
            ->where('id_peminjaman', $id_peminjaman)
            ->get()
            ->getRowArray();

        if (!$penarikan) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        // cek transaksi sudah ada atau belum
        $transaksi = $db->table('transaksi')
            ->where('id_peminjaman', $id_peminjaman)
            ->get()
            ->getRowArray();

        if (!$transaksi) {
            $db->table('transaksi')->insert([
                'id_peminjaman' => $id_peminjaman,
                'jenis' => 'ongkir',
                'jumlah' => $penarikan['ongkir'] ?? 0,
                'status' => 'belum_bayar'
            ]);

            $transaksi = $db->table('transaksi')
                ->where('id_peminjaman', $id_peminjaman)
                ->get()
                ->getRowArray();
        }

        return view('transaksi/bayar', [
            'transaksi' => $transaksi
        ]);
    }
}
