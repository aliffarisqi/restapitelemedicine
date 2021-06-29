<?php

namespace App\Models;

use CodeIgniter\Model;

class RiwayatObatModels extends Model
{
    protected $table = 'riwayat_obat';
    protected $primaryKey = 'id_riwayat_obat';
    protected $allowedFields = [
        'id_pesan', 'nama_obat', 'pemakaian_obat', 'note_obat'
    ];
    // protected $returnType = 'App\Entities\Users';
    protected $useTimestamps = false;

    public function findById($idRiwayatObat)
    {
        $data = $this->find($idRiwayatObat);
        if ($data) {
            return $data;
        }
        return false;
    }
}
