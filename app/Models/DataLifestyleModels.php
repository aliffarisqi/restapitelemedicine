<?php

namespace App\Models;

use CodeIgniter\Model;

class DataLifestyleModels extends Model
{
    protected $table = 'data_lifestyle';
    protected $primaryKey = 'id_datalifestyle';
    protected $allowedFields = [
        'data_pertanyaan', 'jenis_pertanyaan'
    ];
    // protected $returnType = 'App\Entities\Users';
    protected $useTimestamps = false;

    public function findById($id_datalifesyle)
    {
        $data = $this->find($id_datalifesyle);
        if ($data) {
            return $data;
        }
        return false;
    }
}
