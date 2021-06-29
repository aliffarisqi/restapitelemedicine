<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class RiwayatKeluarga extends ResourceController
{
    protected $modelName = 'App\Models\RiwayatKeluargaModels';
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
        // $validate = $this->validation->run($data, 'riwayat_keluarga');

        // $errors = $this->validation->getErrors();
        // if ($errors) {
        //     return $this->fail($errors);
        // }

        $riwayatKeluarga = new \App\Entities\RiwayatKeluarga();
        $riwayatKeluarga->fill($data);
        if ($this->model->save($riwayatKeluarga)) {
            return $this->respondCreated($riwayatKeluarga, 'Riwayat Keluarga Created');
        }
    }
    public function update($idRiwayatKeluarga = null)
    {
        $data = $this->request->getRawInput();
        $data['id_riwayat_keluarga'] = $idRiwayatKeluarga;
        if (!$this->model->findById($idRiwayatKeluarga)) {
            return $this->fail('ID ' . $idRiwayatKeluarga . ' tidak ditemukan');
        }
        // $validate = $this->validation->run($data, 'riwayat_keluarga_update');
        // $errors = $this->validation->getErrors();
        // if ($errors) {
        //     return $this->fail($errors);
        // }

        $riwayatKeluarga = new \App\Entities\RiwayatKeluarga();
        $riwayatKeluarga->fill($data);
        if ($this->model->save($riwayatKeluarga)) {
            return $this->respondUpdated($riwayatKeluarga, 'Riwayat Keluarga Update');
        }
    }
    public function delete($idRiwayatKeluarga = null)
    {
        if (!$this->model->findById($idRiwayatKeluarga)) {
            return $this->fail('ID ' . $idRiwayatKeluarga . ' Tidak ditemukan');
        }
        if ($this->model->delete($idRiwayatKeluarga)) {
            return $this->respondDeleted(['id_riwayat_keluarga ' => $idRiwayatKeluarga . ' Deleted']);
        }
    }
    public function show($idRiwayatKeluarga = null)
    {
        $data = $this->model->findById($idRiwayatKeluarga);
        if ($data) {
            return $this->respond($data);
        }
        return $this->fail('ID ' . $idRiwayatKeluarga . ' tidak ditemukan');
    }
}
