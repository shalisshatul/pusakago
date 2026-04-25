<?php

namespace App\Controllers;

use App\Models\PengembalianModel;

class Pengembalian extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('pengembalian');
    
        $builder->select('
            pengembalian.*,
            users.nama,
            peminjaman.tanggal_pinjam,
            peminjaman.tanggal_kembali,
            denda.status as status_denda
        ');
    
        $builder->join('peminjaman', 'peminjaman.id_peminjaman = pengembalian.id_peminjaman');
        $builder->join('users', 'users.id = peminjaman.id');
        $builder->join('denda', 'denda.id_pengembalian = pengembalian.id_pengembalian', 'left');
    
        $builder->orderBy('pengembalian.id_pengembalian', 'DESC');
    
        $data['pengembalian'] = $builder->get()->getResultArray();
    
        return view('pengembalian/index', $data);
    }
    
    public function create($id)
    {
        $db = \Config\Database::connect();

        $data['peminjaman'] = $db->table('peminjaman')
            ->join('users', 'users.id = peminjaman.id')
            ->where('id_peminjaman', $id)
            ->get()
            ->getRowArray();

        return view('pengembalian/create', $data);
    }

    public function store()
    {
        $db = \Config\Database::connect();

        $id = $this->request->getPost('id_peminjaman');
        $tanggal_dikembalikan = $this->request->getPost('tanggal_dikembalikan');

        $peminjamanModel   = new \App\Models\PeminjamanModel();
        $pengembalianModel = new \App\Models\PengembalianModel();
        $details = $db->table('detail_peminjaman')
            ->where('id_peminjaman', $id)
            ->get()
            ->getResultArray();
        $peminjaman = $peminjamanModel->find($id);

        // =========================
        // 🔥 HITUNG DENDA
        // =========================
        $denda = 0;

        if ($peminjaman['tanggal_kembali']) {
            $tgl_kembali = strtotime($tanggal_dikembalikan);
            $tgl_tenggat = strtotime($peminjaman['tanggal_kembali']);

            if ($tgl_kembali > $tgl_tenggat) {
                $selisih = ceil(($tgl_kembali - $tgl_tenggat) / 86400);
                $denda = $selisih * 2000;
            }
        }

        // =========================
        // ✅ SIMPAN
        // =========================
        $pengembalianModel->save([
            'id_peminjaman'        => $id,
            'tanggal_dikembalikan' => $tanggal_dikembalikan,
            'denda'                => $denda
        ]);


        // =========================
        // 🔥 UPDATE STATUS
        // =========================
        $peminjamanModel->update($id, [
            'status' => 'dikembalikan'
        ]);

        // ✅ tambah stok tiap buku
        if (!empty($details)) {
            foreach ($details as $d) {

                // pastikan field ada
                if (!isset($d['id_buku'])) {
                    continue;
                }

                $db->table('buku')
                    ->where('id_buku', $d['id_buku'])
                    ->set('tersedia', 'tersedia + 1', false)
                    ->update();
            }
        }

        return redirect()->to('/pengembalian')
            ->with('success', 'Pengembalian berhasil disimpan');
    }

    public function delete($id)
    {
        // ❌ hanya admin
        if (session()->get('role') != 'admin') {
            return redirect()->back()->with('error', 'Tidak diizinkan');
        }

        $db = \Config\Database::connect();

        // hapus data pengembalian
        $db->table('pengembalian')
            ->where('id_pengembalian', $id)
            ->delete();

        return redirect()->to('/pengembalian')
            ->with('success', 'Data berhasil dihapus');
    }
    public function bayar($id)
{
    $db = \Config\Database::connect();

    $db->table('pengembalian')
        ->where('id_pengembalian', $id)
        ->update([
            'status_denda' => 'sudah_bayar'
        ]);

    return redirect()->back()->with('success', 'Denda sudah dibayar');
}

}
