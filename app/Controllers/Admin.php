<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Admin extends ResourceController
{
    protected $modelName = 'App\Models\AdminModels';
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
        $validate = $this->validation->run($data, 'admin');

        $errors = $this->validation->getErrors();
        if ($errors) {
            return $this->fail($errors);
        }

        $admin = new \App\Entities\Admin();
        $admin->fill($data);
        if ($this->model->save($admin)) {
            return $this->respondCreated($admin, 'admin Created');
        }
    }
    public function update($id_admin = null)
    {
        $data = $this->request->getRawInput();
        $data['id_admin'] = $id_admin;
        if (!$this->model->findById($id_admin)) {
            return $this->fail('ID ' . $id_admin . ' tidak ditemukan');
        }
        $validate = $this->validation->run($data, 'admin_update');
        $errors = $this->validation->getErrors();
        if ($errors) {
            return $this->fail($errors);
        }

        $admin = new \App\Entities\Admin();
        $admin->fill($data);
        if ($this->model->save($admin)) {
            return $this->respondUpdated($admin, 'Admin Update');
        }
    }
    public function delete($id_admin = null)
    {
        if (!$this->model->findById($id_admin)) {
            return $this->fail('ID ' . $id_admin . ' Tidak ditemukan');
        }
        if ($this->model->delete($id_admin)) {
            return $this->respondDeleted(['id_admin ' => $id_admin . ' Deleted']);
        }
    }
    public function show($id_admin = null)
    {
        $data = $this->model->findById($id_admin);
        if ($data) {
            return $this->respond($data);
        }
        return $this->fail('ID ' . $id_admin . ' tidak ditemukan');
    }
}
