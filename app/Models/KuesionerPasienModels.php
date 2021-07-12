<?php

namespace App\Models;

use CodeIgniter\Model;

class KuesionerPasienModels extends Model
{
    protected $table = 'kuesioner_pasien';
    protected $primaryKey = 'id_kuesioner_pasien';
    protected $allowedFields = [
        'id_pasien', 'idpertanyaan', 'hasil'
    ];
    // protected $returnType = 'App\Entities\Users';
    protected $useTimestamps = false;

    public function findById($id)
    {
        $data = $this->find($id);
        if ($data) {
            return $data;
        }
        return false;
    }
}
