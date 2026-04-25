<?php
namespace App\Controllers;

class Denda extends BaseController
{
    public function index($id_pengembalian)
    {
        $db = \Config\Database::connect();

        $data['denda'] = $db->table('pengembalian')
            ->select('pengembalian.*, users.nama')
            ->join('peminjaman', 'peminjaman.id_peminjaman = pengembalian.id_peminjaman')
            ->join('users', 'users.id = peminjaman.id')
            ->where('pengembalian.id_pengembalian', $id_pengembalian)
            ->get()
            ->getRowArray();

        return view('denda/index', $data);
    }

    public function bayar()
{
    $db = \Config\Database::connect();

    $id_pengembalian = $this->request->getPost('id_pengembalian');
    $jumlah = $this->request->getPost('jumlah_denda');
    $metode = $this->request->getPost('metode');

    $bukti = null;

    // 🔥 upload bukti jika QRIS
    if ($metode == 'qris') {
        $file = $this->request->getFile('bukti');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $bukti = $file->getRandomName();
            $file->move(FCPATH . 'uploads', $bukti);
        }
    }

    // 🔥 CEK APAKAH DATA DENDA SUDAH ADA
    $cek = $db->table('denda')
        ->where('id_pengembalian', $id_pengembalian)
        ->get()
        ->getRow();

    // 🔥 DATA YANG AKAN DISIMPAN
    $data = [
        'id_pengembalian'  => $id_pengembalian,
        'jumlah_denda'     => $jumlah,
        'metode'           => $metode,
        'status'           => 'sudah_bayar'
    ];

    // hanya simpan bukti kalau ada
    if ($bukti !== null) {
        $data['bukti_pembayaran'] = $bukti;
    }

    // 🔥 INSERT / UPDATE (UPSERT)
    if ($cek) {
        $db->table('denda')
            ->where('id_pengembalian', $id_pengembalian)
            ->update($data);
    } else {
        $db->table('denda')->insert($data);
    }

    return redirect()->to('/pengembalian')
        ->with('success', 'Denda berhasil dibayar');
}

    
}
