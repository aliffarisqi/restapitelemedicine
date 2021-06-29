<?php

namespace App\Models;

use CodeIgniter\Model;

class AlergiModels extends Model
{
    protected $table = 'alergi';
    protected $primaryKey = 'id_alergi';
    protected $allowedFields = [
        'id_pasien', 'nama_alergi', 'note_alergi'
    ];

    protected $useTimestamps = false;

    public function findById($id_alergi)
    {
        $data = $this->find($id_alergi);
        if ($data) {
            return $data;
        }
        return false;
    }
}
