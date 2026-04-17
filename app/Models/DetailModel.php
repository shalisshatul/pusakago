<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailModel extends Model
{
    protected $table = 'detail_peminjaman'; // nama tabel kamu
    protected $primaryKey = 'id_detail';

    protected $allowedFields = [
        'id_peminjaman',
        'id_buku',
        'jumlah'
    ];
}