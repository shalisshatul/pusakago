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
                'tanggal_kirim' => date('Y-m-d')
            ]);

        return redirect()->back()->with('success', 'Buku sedang dikirim');
    }

    public function sampai($id)
    {
        $db = \Config\Database::connect();

        $db->table('pengiriman')
            ->where('id_peminjaman', $id)
            ->update(['status' => 'sampai']);

        return redirect()->back()->with('success', 'Buku sudah sampai');
    }
}
