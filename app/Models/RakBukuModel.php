<?php

namespace App\Models;

use CodeIgniter\Model;

class RakBukuModel extends Model
{
    protected $table = 'rak_buku';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'id_buku',
        'id_rak'
    ];
}