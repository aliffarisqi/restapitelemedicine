<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class DataPasien extends ResourceController
{
    protected $modelName = 'App\Models\DataPasienModels';
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
        // $validate = $this->validation->run($data, 'data_pasien');

        // $errors = $this->validation->getErrors();
        // if ($errors) {
        //     return $this->fail($errors);
        // }

        $dataPasien = new \App\Entities\DataPasien();
        $dataPasien->fill($data);
        if ($this->model->save($dataPasien)) {
            return $this->respondCreated($dataPasien, 'data Pasien Created');
        }
    }
    public function update($idDataPasien = null)
    {
        $data = $this->request->getRawInput();
        $data['id_data_pasien'] = $idDataPasien;
        if (!$this->model->findById($idDataPasien)) {
            return $this->fail('ID ' . $idDataPasien . ' tidak ditemukan');
        }
        // $validate = $this->validation->run($data, 'data_pasien_update');
        // $errors = $this->validation->getErrors();
        // if ($errors) {
        //     return $this->fail($errors);
        // }

        $dataPasien = new \App\Entities\DataPasien();
        $dataPasien->fill($data);
        if ($this->model->save($dataPasien)) {
            return $this->respondUpdated($dataPasien, 'daa$dataPasien Update');
        }
    }
    public function delete($idDataPasien = null)
    {
        if (!$this->model->findById($idDataPasien)) {
            return $this->fail('ID ' . $idDataPasien . ' Tidak ditemukan');
        }
        if ($this->model->delete($idDataPasien)) {
            return $this->respondDeleted(['id Data Pasien ' => $idDataPasien . ' Deleted']);
        }
    }
    public function show($idDataPasien = null)
    {
        $data = $this->model->findById($idDataPasien);
        if ($data) {
            return $this->respond($data);
        }
        return $this->fail('ID ' . $idDataPasien . ' tidak ditemukan');
    }
}
