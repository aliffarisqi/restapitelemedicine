<?php

namespace App\Models;

use CodeIgniter\Model;

class AnalisisRekomendasiModels extends Model
{
    protected $table = 'analisis_rekomendasi';
    protected $primaryKey = 'id_analisis';
    protected $allowedFields = [
        'id_data_pasien', 'judul', 'note_analisis', 'tanggal_analisis', 'status_analisis'
    ];
    // protected $returnType = 'App\Entities\Users';
    protected $useTimestamps = false;

    public function findById($id_analisis)
    {
        $data = $this->find($id_analisis);
        if ($data) {
            return $data;
        }
        return false;
    }
}
