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

        // update penarikan
        $db->table('penarikan')
            ->where('id_penarikan', $id)
            ->update([
                'status' => 'selesai'
            ]);

        // update peminjaman jadi dikembalikan
        $db->table('peminjaman')
            ->where('id_peminjaman', $penarikan['id_peminjaman'])
            ->update([
                'status' => 'dikembalikan'
            ]);

        return redirect()->back()->with('success', 'Penarikan selesai');
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
}
