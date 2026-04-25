<?php

namespace App\Controllers;

use App\Models\BukuModel;
use App\Models\UsersModel;
use App\Models\PeminjamanModel;
use App\Models\PengembalianModel;


class Dashboard extends BaseController
{
    public function index()
    {
        $role = session()->get('role');
        $id   = session()->get('id');
    
        $db = \Config\Database::connect();
    
        $buku = new \App\Models\BukuModel();
        $user = new \App\Models\UsersModel();
        $pinjam = new \App\Models\PeminjamanModel();
        $kembali = new \App\Models\PengembalianModel();
    
        // ================= ANGGOTA =================
        if ($role == 'anggota') {
    
            $total_peminjaman = $pinjam
                ->where('user_id', $id)
                ->countAllResults();
    
            $pinjam = new \App\Models\PeminjamanModel(); // reset
    
            $total_pengembalian = $kembali
                ->where('user_id', $id)
                ->countAllResults();
    
            $kembali = new \App\Models\PengembalianModel(); // reset
    
            $row = $db->table('pengembalian')
                ->where('user_id', $id)
                ->selectSum('denda')
                ->get()
                ->getRow();
    
            $data = [
                'total_buku' => $buku->countAll(),
                'total_peminjaman' => $total_peminjaman,
                'total_pengembalian' => $total_pengembalian,
                'total_denda' => $row->denda ?? 0,
            ];
        } 
        // ================= ADMIN / PETUGAS =================
        else {
    
            $row = $db->table('pengembalian')
                ->selectSum('denda')
                ->get()
                ->getRow();
    
            $data = [
                'total_buku' => $buku->countAll(),
                'total_user' => $user->countAll(),
                'total_peminjaman' => $pinjam->countAll(),
                'total_pengembalian' => $kembali->countAll(),
                'total_denda' => $row->denda ?? 0,
            ];
        }
    
        return view('layouts/dashboard', $data);
    }
    
    public function stats()
{
    $buku = new BukuModel();
    $user = new UsersModel();
    $pinjam = new PeminjamanModel();
    $kembali = new PengembalianModel();

    return $this->response->setJSON([
        'buku' => $buku->countAll(),
        'user' => $user->countAll(),
        'dipinjam' => $pinjam->countAll(),
        'pengembalian' => $kembali->countAll(),
    ]);
}

    
}