<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class LifestylePasien extends ResourceController
{
    protected $modelName = 'App\Models\LifestylePasienModels';
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
        // $validate = $this->validation->run($data, 'lifestyle_pasien');

        // $errors = $this->validation->getErrors();
        // if ($errors) {
        //     return $this->fail($errors);
        // }

        $lifestylePasien = new \App\Entities\LifestylePasien();
        $lifestylePasien->fill($data);
        if ($this->model->save($lifestylePasien)) {
            return $this->respondCreated($lifestylePasien, 'lifestyle Pasien Created');
        }
    }
    public function update($id_lifestyle_pasien = null)
    {
        $data = $this->request->getRawInput();
        $data['id_lifestyle_pasien'] = $id_lifestyle_pasien;
        if (!$this->model->findById($id_lifestyle_pasien)) {
            return $this->fail('ID ' . $id_lifestyle_pasien . ' tidak ditemukan');
        }
        // $validate = $this->validation->run($data, 'lifestyle_pasien_update');
        // $errors = $this->validation->getErrors();
        // if ($errors) {
        //     return $this->fail($errors);
        // }

        $lifestylePasien = new \App\Entities\LifestylePasien();
        $lifestylePasien->fill($data);
        if ($this->model->save($lifestylePasien)) {
            return $this->respondUpdated($lifestylePasien, 'lifestyle Pasien Update');
        }
    }
    public function delete($id_lifestyle_pasien = null)
    {
        if (!$this->model->findById($id_lifestyle_pasien)) {
            return $this->fail('ID ' . $id_lifestyle_pasien . ' Tidak ditemukan');
        }
        if ($this->model->delete($id_lifestyle_pasien)) {
            return $this->respondDeleted(['id_lifestyle_pasien ' => $id_lifestyle_pasien . ' Deleted']);
        }
    }
    public function show($id_lifestyle_pasien = null)
    {
        $data = $this->model->findById($id_lifestyle_pasien);
        if ($data) {
            return $this->respond($data);
        }
        return $this->fail('ID ' . $id_lifestyle_pasien . ' tidak ditemukan');
    }
}
