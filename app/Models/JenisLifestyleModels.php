<?php

namespace App\Models;

use CodeIgniter\Model;

class JenislifestyleModels extends Model
{
    protected $table = 'jenis_lifestyle';
    protected $primaryKey = 'id_jenis_lifestyle';
    protected $allowedFields = [
        'jenis_lifestyle'
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
