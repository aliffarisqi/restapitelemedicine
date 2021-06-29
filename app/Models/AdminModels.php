<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModels extends Model
{
    protected $table = 'admin';
    protected $primaryKey = 'id_admin';
    protected $allowedFields = [
        'username_admin', 'email_admin', 'password_admin'
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
