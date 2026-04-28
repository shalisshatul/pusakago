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

        $buku = new BukuModel();
        $user = new UsersModel();
        $pinjam = new PeminjamanModel();
        $kembali = new PengembalianModel();

        // ================= ANGGOTA =================
        if ($role == 'anggota') {

            $total_peminjaman = $pinjam
                ->where('id', $id) // ✅ FIX DI SINI
                ->countAllResults();

            $pinjam = new PeminjamanModel();

            $total_pengembalian = $db->table('pengembalian')
                ->join('peminjaman', 'peminjaman.id_peminjaman = pengembalian.id_peminjaman')
                ->where('peminjaman.id', $id) // ✅ FIX
                ->countAllResults();

            $row = $db->table('pengembalian')
                ->join('peminjaman', 'peminjaman.id_peminjaman = pengembalian.id_peminjaman')
                ->where('peminjaman.id', $id) // ✅ FIX
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

    // 🔥 REALTIME STATS
    public function stats()
    {
        $role = session()->get('role');
        $id   = session()->get('id');

        $db = \Config\Database::connect();

        $buku = new BukuModel();
        $user = new UsersModel();
        $pinjam = new PeminjamanModel();
        $kembali = new PengembalianModel();

        if ($role == 'anggota') {

            $dipinjam = $pinjam->where('id', $id)->countAllResults();

            $pengembalian = $db->table('pengembalian')
                ->join('peminjaman', 'peminjaman.id_peminjaman = pengembalian.id_peminjaman')
                ->where('peminjaman.id', $id)
                ->countAllResults();

            $row = $db->table('pengembalian')
                ->join('peminjaman', 'peminjaman.id_peminjaman = pengembalian.id_peminjaman')
                ->where('peminjaman.id', $id)
                ->selectSum('denda')
                ->get()
                ->getRow();

            return $this->response->setJSON([
                'buku' => $buku->countAll(),
                'dipinjam' => $dipinjam,
                'pengembalian' => $pengembalian,
                'denda' => $row->denda ?? 0,
            ]);
        }

        return $this->response->setJSON([
            'buku' => $buku->countAll(),
            'user' => $user->countAll(),
            'dipinjam' => $pinjam->countAll(),
            'pengembalian' => $kembali->countAll(),
            'denda' => $db->table('pengembalian')->selectSum('denda')->get()->getRow()->denda ?? 0,
        ]);
    }

    // 🔥 CHART
    public function chart()
    {
        $role = session()->get('role');
        $id   = session()->get('id');

        $db = \Config\Database::connect();

        if ($role == 'anggota') {
            $query = $db->query("
                SELECT 
                    MONTH(p.tanggal_pinjam) as bulan,
                    COUNT(*) as total,
                    SUM(pg.denda) as total_denda
                FROM peminjaman p
                LEFT JOIN pengembalian pg 
                    ON p.id_peminjaman = pg.id_peminjaman
                WHERE p.id = $id
                GROUP BY MONTH(p.tanggal_pinjam)
                ORDER BY bulan
            ");
        } else {
            $query = $db->query("
                SELECT 
                    MONTH(p.tanggal_pinjam) as bulan,
                    COUNT(*) as total,
                    SUM(pg.denda) as total_denda
                FROM peminjaman p
                LEFT JOIN pengembalian pg 
                    ON p.id_peminjaman = pg.id_peminjaman
                GROUP BY MONTH(p.tanggal_pinjam)
                ORDER BY bulan
            ");
        }

        $data = $query->getResult();

        $labels = [];
        $peminjaman = [];
        $denda = [];

        foreach ($data as $d) {
            $labels[] = date('M', mktime(0, 0, 0, $d->bulan, 1));
            $peminjaman[] = (int)$d->total;
            $denda[] = (int)$d->total_denda;
        }

        return $this->response->setJSON([
            'labels' => $labels,
            'peminjaman' => $peminjaman,
            'denda' => $denda
        ]);
    }
}
