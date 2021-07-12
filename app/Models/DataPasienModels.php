<?php

namespace App\Models;

use CodeIgniter\Model;

class DataPasienModels extends Model
{
    protected $table = 'data_pasien';
    protected $primaryKey = 'id_data_pasien';
    protected $allowedFields = [
        'id_pasien', 'nama', 'tempat_lahir', 'tanggal_lahir', 'alamat', 'nama_puskesmas', 'tinggi_badan', 'berat_badan', 'diagnosis_pasien', 'gambar_pasien'
    ];
    // protected $returnType = 'App\Entities\Users';
    //protected $useTimestamps = false;

    public function findById($idDataPasien)
    {
        $data = $this->find($idDataPasien);
        if ($data) {
            return $data;
        }
        return false;
    }
}
