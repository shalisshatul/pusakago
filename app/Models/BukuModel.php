<?php

namespace App\Models;

use CodeIgniter\Model;

class BukuModel extends Model
{
    protected $table = 'buku';
    protected $primaryKey = 'id_buku';
    protected $allowedFields = [
        'isbn','judul','id_kategori','id_penulis','id_penerbit',
        'tahun_terbit','jumlah','tersedia','deskripsi','cover'
    ];

    public function getBuku($keyword = null)
    {
        $builder = $this->db->table('buku');

        // 🔥 SELECT (TAMBAH RAK)
        $builder->select('
            buku.*, 
            kategori.nama_kategori, 
            penulis.nama_penulis, 
            penerbit.nama_penerbit,
            rak.nama_rak
        ');

        // 🔗 JOIN
        $builder->join('kategori', 'kategori.id_kategori = buku.id_kategori', 'left');
        $builder->join('penulis', 'penulis.id_penulis = buku.id_penulis', 'left');
        $builder->join('penerbit', 'penerbit.id_penerbit = buku.id_penerbit', 'left');
        $builder->join('rak_buku', 'rak_buku.id_buku = buku.id_buku', 'left');
        $builder->join('rak', 'rak.id_rak = rak_buku.id_rak', 'left');
        $builder->select('buku.*, kategori.nama_kategori, penulis.nama_penulis, penerbit.nama_penerbit, rak.nama_rak');
        // 🔍 SEARCH (FIX)
        if ($keyword) {
            $builder->groupStart()
                ->like('buku.judul', $keyword)
                ->orLike('buku.isbn', $keyword)
                ->orLike('kategori.nama_kategori', $keyword)
                ->orLike('penulis.nama_penulis', $keyword)
                ->orLike('penerbit.nama_penerbit', $keyword)
                ->orLike('buku.tahun_terbit', $keyword)
            ->groupEnd();
        }

        return $builder->get()->getResultArray();
    }

    public function detail($id)
    {
        return $this->db->table('buku')
            ->select('
                buku.*,
                kategori.nama_kategori,
                penulis.nama_penulis,
                penerbit.nama_penerbit,
                rak.nama_rak
            ')
            ->join('kategori', 'kategori.id_kategori = buku.id_kategori', 'left')
            ->join('penulis', 'penulis.id_penulis = buku.id_penulis', 'left')
            ->join('penerbit', 'penerbit.id_penerbit = buku.id_penerbit', 'left')
            ->join('rak_buku', 'rak_buku.id_buku = buku.id_buku', 'left')
            ->join('rak', 'rak.id_rak = rak_buku.id_rak', 'left')
            ->where('buku.id_buku', $id)
            ->get()
            ->getRowArray();
    }
}