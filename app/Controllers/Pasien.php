<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Pasien extends ResourceController
{
    protected $modelName = 'App\Models\PasienModels';
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
        // $validate = $this->validation->run($data, 'pasien');

        // $errors = $this->validation->getErrors();
        // if ($errors) {
        //     return $this->fail($errors);
        // }

        $pasien = new \App\Entities\Pasien();
        $pasien->fill($data);
        if ($this->model->save($pasien)) {
            return $this->respondCreated($pasien, 'pasien Created');
        }
    }
    public function update($id_pasien = null)
    {
        $data = $this->request->getRawInput();
        $data['id_pasien'] = $id_pasien;
        if (!$this->model->findById($id_pasien)) {
            return $this->fail('ID ' . $id_pasien . ' tidak ditemukan');
        }
        // $validate = $this->validation->run($data, 'pasien_update');
        // $errors = $this->validation->getErrors();
        // if ($errors) {
        //     return $this->fail($errors);
        // }

        $pasien = new \App\Entities\Pasien();
        $pasien->fill($data);
        if ($this->model->save($pasien)) {
            return $this->respondUpdated($pasien, 'pasien Update');
        }
    }
    public function delete($id_pasien = null)
    {
        if (!$this->model->findById($id_pasien)) {
            return $this->fail('ID ' . $id_pasien . ' Tidak ditemukan');
        }
        if ($this->model->delete($id_pasien)) {
            return $this->respondDeleted(['id_pasien ' => $id_pasien . ' Deleted']);
        }
    }
    public function show($id_pasien = null)
    {
        $data = $this->model->findById($id_pasien);
        if ($data) {
            return $this->respond($data);
        }
        return $this->fail('ID ' . $id_pasien . ' tidak ditemukan');
    }
}
