<?php

namespace App\Models;

use CodeIgniter\Model;

class KuesionerModels extends Model
{
    protected $table = 'kuesioner';
    protected $primaryKey = 'id_kuesioner';
    protected $allowedFields = [
        'nama_pertanyaan'
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
