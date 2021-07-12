<?php

namespace App\Models;

use CodeIgniter\Model;

class ObatModels extends Model
{
    protected $table = 'obat';
    protected $primaryKey = 'id_obat';
    protected $allowedFields = [
        'nama_obat'
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
