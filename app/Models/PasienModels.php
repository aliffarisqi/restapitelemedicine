<?php

namespace App\Models;

use CodeIgniter\Model;

class PasienModels extends Model
{
    protected $table = 'pasien';
    protected $primaryKey = 'id_pasien';
    protected $allowedFields = [
        'username_pasien', 'email_pasien', 'password_pasien'
    ];
    // protected $returnType = 'App\Entities\Users';
    protected $useTimestamps = false;

    public function findById($id_admin)
    {
        $data = $this->find($id_admin);
        if ($data) {
            return $data;
        }
        return false;
    }
}
