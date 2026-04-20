<?php
namespace App\Models;
use CodeIgniter\Model;

class PeminjamanModel extends Model
{
    protected $table = 'peminjaman';
    protected $primaryKey = 'id_peminjaman';

    protected $allowedFields = [
        'tanggal_pinjam',
        'tanggal_kembali',
        'status',
        'id'
    ];

    public function search($keyword = null)
    {
        $builder = $this->table('peminjaman');
        $builder->join('users', 'users.id = peminjaman.id');

        if ($keyword) {
            $builder->like('users.username', $keyword);
        }

        return $builder->get()->getResultArray();
    }
}