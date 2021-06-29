<?php

namespace App\Models;

use CodeIgniter\Model;

class TekananDarahModels extends Model
{
    protected $table = 'tekanan_darah';
    protected $primaryKey = 'id_tekanan_darah';
    protected $allowedFields = [
        'id_data_pasien', 'sistole', 'diastole', 'tanggal', 'jam', 'note_td', 'nyeri_tengkuk', 'pusing'
    ];
    // protected $returnType = 'App\Entities\Users';
    protected $useTimestamps = false;

    public function findById($idTekananDarah)
    {
        $data = $this->find($idTekananDarah);
        if ($data) {
            return $data;
        }
        return false;
    }
}
