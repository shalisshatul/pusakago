<?php

namespace App\Models;

use CodeIgniter\Model;

class PeminjamanModel extends Model
{
    protected $table = 'peminjaman';
    protected $primaryKey = 'id_peminjaman';

    protected $allowedFields = [
        'id',
        'tanggal_pinjam',
        'tanggal_kembali',
        'status',
        'status_konfirmasi'
    ];
}