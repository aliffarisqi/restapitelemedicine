<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Konten extends ResourceController
{
    protected $modelName = 'App\Models\KontenModels';
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
        // $validate = $this->validation->run($data, 'konten');

        // $errors = $this->validation->getErrors();
        // if ($errors) {
        //     return $this->fail($errors);
        // }

        $konten = new \App\Entities\Konten();
        $konten->fill($data);
        if ($this->model->save($konten)) {
            return $this->respondCreated($konten, 'konten Created');
        }
    }
    public function update($id_konten = null)
    {
        $data = $this->request->getRawInput();
        $data['id_konten'] = $id_konten;
        if (!$this->model->findById($id_konten)) {
            return $this->fail('ID ' . $id_konten . ' tidak ditemukan');
        }
        // $validate = $this->validation->run($data, 'konten_update');
        // $errors = $this->validation->getErrors();
        // if ($errors) {
        //     return $this->fail($errors);
        // }

        $konten = new \App\Entities\Konten();
        $konten->fill($data);
        if ($this->model->save($konten)) {
            return $this->respondUpdated($konten, 'konten Update');
        }
    }
    public function delete($id_konten = null)
    {
        if (!$this->model->findById($id_konten)) {
            return $this->fail('ID ' . $id_konten . ' Tidak ditemukan');
        }
        if ($this->model->delete($id_konten)) {
            return $this->respondDeleted(['id_konten ' => $id_konten . ' Deleted']);
        }
    }
    public function show($id_konten = null)
    {
        $data = $this->model->findById($id_konten);
        if ($data) {
            return $this->respond($data);
        }
        return $this->fail('ID ' . $id_konten . ' tidak ditemukan');
    }
}
