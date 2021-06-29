<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Pesan extends ResourceController
{
    protected $modelName = 'App\Models\PesanModels';
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
        // $validate = $this->validation->run($data, 'pesan');

        // $errors = $this->validation->getErrors();
        // if ($errors) {
        //     return $this->fail($errors);
        // }

        $pesan = new \App\Entities\Pesan();
        $pesan->fill($data);
        if ($this->model->save($pesan)) {
            return $this->respondCreated($pesan, 'pesan Created');
        }
    }
    public function update($id_pesan = null)
    {
        $data = $this->request->getRawInput();
        $data['id_pesan'] = $id_pesan;
        if (!$this->model->findById($id_pesan)) {
            return $this->fail('ID ' . $id_pesan . ' tidak ditemukan');
        }
        // $validate = $this->validation->run($data, 'pesan_update');
        // $errors = $this->validation->getErrors();
        // if ($errors) {
        //     return $this->fail($errors);
        // }

        $pesan = new \App\Entities\Pesan();
        $pesan->fill($data);
        if ($this->model->save($pesan)) {
            return $this->respondUpdated($pesan, 'pesan Update');
        }
    }
    public function delete($id_pesan = null)
    {
        if (!$this->model->findById($id_pesan)) {
            return $this->fail('ID ' . $id_pesan . ' Tidak ditemukan');
        }
        if ($this->model->delete($id_pesan)) {
            return $this->respondDeleted(['id_pesan ' => $id_pesan . ' Deleted']);
        }
    }
    public function show($id_pesan = null)
    {
        $data = $this->model->findById($id_pesan);
        if ($data) {
            return $this->respond($data);
        }
        return $this->fail('ID ' . $id_pesan . ' tidak ditemukan');
    }
}
