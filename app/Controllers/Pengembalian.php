<?php

namespace App\Controllers;

use App\Models\PengembalianModel;

class Pengembalian extends BaseController
{
    public function index()
{
    $db = \Config\Database::connect();

    $data['pengembalian'] = $db->table('pengembalian')
        ->select('
            pengembalian.*,
            peminjaman.tanggal_pinjam,
            peminjaman.tanggal_kembali,
            users.nama
        ')
        ->join('peminjaman', 'peminjaman.id_peminjaman = pengembalian.id_peminjaman')
        ->join('users', 'users.id = peminjaman.id')
        ->get()
        ->getResultArray();

    return view('pengembalian/index', $data);
}

    public function create($id_peminjaman)
    {
        $data['id_peminjaman'] = $id_peminjaman;

        return view('pengembalian/create', $data);
    }

    public function store()
    {
        $model = new PengembalianModel();
        $db = \Config\Database::connect();
    
        $id = $this->request->getPost('id_peminjaman');
        $tanggal_kembali = $this->request->getPost('tanggal_dikembalikan');
    
        // 🔥 ambil data peminjaman
        $peminjaman = $db->table('peminjaman')
            ->where('id_peminjaman', $id)
            ->get()
            ->getRowArray();
    
        // 🔥 HITUNG DENDA (pakai tenggat)
        $tenggat = $peminjaman['tanggal_kembali'];
        $denda = 0;
    
        if ($tanggal_kembali > $tenggat) {
            $selisih = (strtotime($tanggal_kembali) - strtotime($tenggat)) / 86400;
            $denda = $selisih * 1000;
        }
    
        // 🔥 SIMPAN PENGEMBALIAN
        $model->save([
            'id_peminjaman'        => $id,
            'tanggal_dikembalikan' => $tanggal_kembali,
            'denda'                => $denda,
        ]);
    
        // =========================
        // 🔥 TAMBAH STOK (INI YANG KURANG)
        // =========================
        $detail = $db->table('detail_peminjaman')
            ->where('id_peminjaman', $id)
            ->get()
            ->getResultArray();
    
        foreach ($detail as $d) {
            $db->table('buku')
                ->where('id_buku', $d['id_buku'])
                ->set('tersedia', 'tersedia + ' . (int)$d['jumlah'], false)
                ->update();
        }
    
        // 🔥 UPDATE STATUS
        $db->table('peminjaman')
            ->where('id_peminjaman', $id)
            ->update(['status' => 'dikembalikan']);
    
        return redirect()->to('/peminjaman')
            ->with('success', 'Buku berhasil dikembalikan. Denda: Rp ' . $denda);
    }
    
}
