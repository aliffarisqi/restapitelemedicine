<?php

namespace App\Models;

use CodeIgniter\Model;

class RiwayatKeluargaModels extends Model
{
    protected $table = 'riwayat_keluarga';
    protected $primaryKey = 'id_riwayat_keluarga';
    protected $allowedFields = [
        'id_pasien', 'nama_penyakit', 'status_keluarga', 'tanggal_mulai', 'tanggal_selesai', 'note_keluarga'
    ];
    // protected $returnType = 'App\Entities\Users';
    protected $useTimestamps = false;

    public function findById($id_riwayat_keluarga)
    {
        $data = $this->find($id_riwayat_keluarga);
        if ($data) {
            return $data;
        }
        return false;
    }
}
