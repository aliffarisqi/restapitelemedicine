<?php

namespace App\Models;

use CodeIgniter\Model;

class KontenModels extends Model
{
    protected $table = 'konten';
    protected $primaryKey = 'id_konten';
    protected $allowedFields = [
        'gambar_konten', 'judul_konten', 'isi_konten', 'tanggal_publish', 'publisher'
    ];
    // protected $returnType = 'App\Entities\Users';
    protected $useTimestamps = false;

    public function findById($id_konten)
    {
        $data = $this->find($id_konten);
        if ($data) {
            return $data;
        }
        return false;
    }
}
