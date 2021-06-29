<?php

namespace App\Models;

use CodeIgniter\Model;

class LifestylePasienModels extends Model
{
    protected $table = 'lifestyle_pasien';
    protected $primaryKey = 'id_lifestyle_pasien';
    protected $allowedFields = [
        'id_datalifestyle', 'id_data_pasien', 'status_lifestyle'
    ];
    // protected $returnType = 'App\Entities\Users';
    protected $useTimestamps = false;

    public function findById($id_lifestyle_pasien)
    {
        $data = $this->find($id_lifestyle_pasien);
        if ($data) {
            return $data;
        }
        return false;
    }
}
