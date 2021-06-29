<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class RiwayatObat extends ResourceController
{
    protected $modelName = 'App\Models\RiwayatObatModels';
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
        // $validate = $this->validation->run($data, 'riwayat_obat');

        // $errors = $this->validation->getErrors();
        // if ($errors) {
        //     return $this->fail($errors);
        // }

        $riwayatObat = new \App\Entities\RiwayatObat();
        $riwayatObat->fill($data);
        if ($this->model->save($riwayatObat)) {
            return $this->respondCreated($riwayatObat, 'Riwayat Obat Created');
        }
    }
    public function update($idRiwayatObat = null)
    {
        $data = $this->request->getRawInput();
        $data['id_riwayat_obat'] = $idRiwayatObat;
        if (!$this->model->findById($idRiwayatObat)) {
            return $this->fail('ID ' . $idRiwayatObat . ' tidak ditemukan');
        }
        // $validate = $this->validation->run($data, 'riwayat_obat_update');
        // $errors = $this->validation->getErrors();
        // if ($errors) {
        //     return $this->fail($errors);
        // }

        $riwayatObat = new \App\Entities\RiwayatObat();
        $riwayatObat->fill($data);
        if ($this->model->save($riwayatObat)) {
            return $this->respondUpdated($riwayatObat, 'Riwayat Obat Update');
        }
    }
    public function delete($idRiwayatObat = null)
    {
        if (!$this->model->findById($idRiwayatObat)) {
            return $this->fail('ID ' . $idRiwayatObat . ' Tidak ditemukan');
        }
        if ($this->model->delete($idRiwayatObat)) {
            return $this->respondDeleted(['id_riwayat_obat' => $idRiwayatObat . ' Deleted']);
        }
    }
    public function show($idRiwayatObat = null)
    {
        $data = $this->model->findById($idRiwayatObat);
        if ($data) {
            return $this->respond($data);
        }
        return $this->fail('ID ' . $idRiwayatObat . ' tidak ditemukan');
    }
}
