<?php

namespace App\Models;

use CodeIgniter\Model;

class RiwayatPenyakitModels extends Model
{
    protected $table = 'riwayat_penyakit';
    protected $primaryKey = 'id_riwayat_penyakit';
    protected $allowedFields = [
        'id_pasien', 'nama_penyakit', 'tanggal_mulai', 'tanggal_selesai', 'note_penyakit'
    ];
    // protected $returnType = 'App\Entities\Users';
    protected $useTimestamps = false;

    public function findById($idRiwayatPenyakit)
    {
        $data = $this->find($idRiwayatPenyakit);
        if ($data) {
            return $data;
        }
        return false;
    }
}
