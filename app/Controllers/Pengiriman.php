<?php

namespace App\Controllers;

use App\Models\PengirimanModel;

class Pengiriman extends BaseController
{
    public function antar($id_peminjaman)
    {
        $model = new PengirimanModel();

        $model->where('id_peminjaman', $id_peminjaman)
              ->set([
                  'status' => 'dikirim',
                  'tanggal_kirim' => date('Y-m-d'),
                  'petugas_id' => session()->get('id')
              ])
              ->update();

        return redirect()->to('/peminjaman');
    }

    public function sampai($id_peminjaman)
    {
        $pengiriman = new \App\Models\PengirimanModel();
        $peminjaman = new \App\Models\PeminjamanModel();
    
        // update pengiriman
        $pengiriman->where('id_peminjaman', $id_peminjaman)
                   ->set([
                       'status' => 'sampai'
                   ])
                   ->update();
    
        // ✅ TAMBAHKAN INI (PENTING)
        $peminjaman->update($id_peminjaman, [
            'status' => 'dipinjam'
        ]);
    
        return redirect()->to('/peminjaman');
    }
    
}
