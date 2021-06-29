<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class DataLifestyle extends ResourceController
{
    protected $modelName = 'App\Models\DataLifestyleModels';
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
        // $validate = $this->validation->run($data, 'data_lifestyle');

        // $errors = $this->validation->getErrors();
        // if ($errors) {
        //     return $this->fail($errors);
        // }

        $dataLifestyle = new \App\Entities\DataLifestyle();
        $dataLifestyle->fill($data);
        if ($this->model->save($dataLifestyle)) {
            return $this->respondCreated($dataLifestyle, 'dataLifestyle Created');
        }
    }
    public function update($id_datalifestyle = null)
    {
        $data = $this->request->getRawInput();
        $data['id_datalifestyle'] = $id_datalifestyle;
        if (!$this->model->findById($id_datalifestyle)) {
            return $this->fail('ID ' . $id_datalifestyle . ' tidak ditemukan');
        }
        // $validate = $this->validation->run($data, 'datalifestyle_update');
        // $errors = $this->validation->getErrors();
        // if ($errors) {
        //     return $this->fail($errors);
        // }

        $datalifestyle = new \App\Entities\DataLifestyle();
        $datalifestyle->fill($data);
        if ($this->model->save($datalifestyle)) {
            return $this->respondUpdated($datalifestyle, 'datalifestyle Update');
        }
    }
    public function delete($id_datalifestyle = null)
    {
        if (!$this->model->findById($id_datalifestyle)) {
            return $this->fail('ID ' . $id_datalifestyle . ' Tidak ditemukan');
        }
        if ($this->model->delete($id_datalifestyle)) {
            return $this->respondDeleted(['id_datalifestyle ' => $id_datalifestyle . ' Deleted']);
        }
    }
    public function show($id_datalifestyle = null)
    {
        $data = $this->model->findById($id_datalifestyle);
        if ($data) {
            return $this->respond($data);
        }
        return $this->fail('ID ' . $id_datalifestyle . ' tidak ditemukan');
    }
}
