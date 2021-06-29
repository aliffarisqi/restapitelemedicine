<?php

namespace App\Models;

use CodeIgniter\Model;

class PesanModels extends Model
{
    protected $table = 'pesan';
    protected $primaryKey = 'id_pesan';
    protected $allowedFields = [
        'id_pasien', 'judul_pesan', 'isi_pesan'
    ];
    // protected $returnType = 'App\Entities\Users';
    protected $useTimestamps = false;

    public function findById($id_pesan)
    {
        $data = $this->find($id_pesan);
        if ($data) {
            return $data;
        }
        return false;
    }
}
