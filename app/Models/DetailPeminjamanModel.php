<?php
namespace App\Models;
use CodeIgniter\Model;

class DetailPeminjamanModel extends Model
{
    protected $table = 'detail_peminjaman';
    protected $primaryKey = 'id_detail';

    protected $allowedFields = ['id_peminjaman','id_buku','jumlah'];

    public function getKeranjang($idUser)
    {
        return $this->db->table('detail_peminjaman')
            ->select('detail_peminjaman.*, buku.judul, peminjaman.status, peminjaman.id_peminjaman')
            ->join('peminjaman', 'peminjaman.id_peminjaman = detail_peminjaman.id_peminjaman')
            ->join('buku', 'buku.id_buku = detail_peminjaman.id_buku')
            ->where('peminjaman.id', $idUser)
            ->where('peminjaman.status', 'keranjang')
            ->get()->getResultArray();
    }
}