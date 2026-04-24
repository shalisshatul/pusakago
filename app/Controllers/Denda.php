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
    
        // jika QRIS upload bukti
        if ($metode == 'qris') {
            $file = $this->request->getFile('bukti');
            if ($file && $file->isValid()) {
                $bukti = $file->getRandomName();
                $file->move('uploads/', $bukti);
            }
        }
    
        // 🔥 SIMPAN / UPDATE DENDA
        $db->table('denda')->where('id_pengembalian', $id_pengembalian)->update([
            'jumlah_denda'      => $jumlah,
            'bukti_pembayaran'  => $bukti,
            'status'            => 'sudah_bayar' // 🔥 PENTING
        ]);
    
        return redirect()->to('/pengembalian')
            ->with('success', 'Denda berhasil dibayar');
    }
    

}
