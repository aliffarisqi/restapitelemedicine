<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class KuesionerPasien extends ResourceController
{
    protected $modelName = 'App\Models\KuesionerPasienModels';
    protected $format = 'json';

    public function __construct()
    {
        $this->validation = \Config\Services::validation();
    }
    public function index()
    {
        return $this->respond($this->model->findAll());
    }
    public function create()
    {
        $data = $this->request->getPost();
        $kuesionerPasien = new \App\Entities\KuesionerPasien();
        $kuesionerPasien->fill($data);
        if ($this->model->save($kuesionerPasien)) {
            return $this->respondCreated($kuesionerPasien, 'data Pasien Created');
        }
    }
    public function update($idKuesionerPasien = null)
    {
        $data = $this->request->getRawInput();
        $data['id_kuesioner_pasien'] = $idKuesionerPasien;
        if (!$this->model->findById($idKuesionerPasien)) {
            return $this->fail('ID ' . $idKuesionerPasien . ' tidak ditemukan');
        }
        $dataPasien = new \App\Entities\KuesionerPasien();
        $dataPasien->fill($data);
        if ($this->model->save($dataPasien)) {
            return $this->respondUpdated($dataPasien, 'daa$dataPasien Update');
        }
    }
    public function delete($idKuesionerPasien = null)
    {
        if (!$this->model->findById($idKuesionerPasien)) {
            return $this->fail('ID ' . $idKuesionerPasien . ' Tidak ditemukan');
        }
        if ($this->model->delete($idKuesionerPasien)) {
            return $this->respondDeleted(['id_kuesioner_pasien ' => $idKuesionerPasien . ' Deleted']);
        }
    }
    public function show($idKuesionerPasien = null)
    {
        $data = $this->model->findById($idKuesionerPasien);
        if ($data) {
            return $this->respond($data);
        }
        return $this->fail('ID ' . $idKuesionerPasien . ' tidak ditemukan');
    }
}
