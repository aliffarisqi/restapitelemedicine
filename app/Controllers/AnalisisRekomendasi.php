<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class AnalisisRekomendasi extends ResourceController
{
    protected $modelName = 'App\Models\AnalisisRekomendasiModels';
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
        // $validate = $this->validation->run($data, 'analisis_rekomendasi');

        // $errors = $this->validation->getErrors();
        // if ($errors) {
        //     return $this->fail($errors);
        // }

        $analisisRekomendasi = new \App\Entities\AnalisisRekomendasi();
        $analisisRekomendasi->fill($data);
        if ($this->model->save($analisisRekomendasi)) {
            return $this->respondCreated($analisisRekomendasi, 'analisis Rekomendasi Created');
        }
    }
    public function update($id_analisis = null)
    {
        $data = $this->request->getRawInput();
        $data['id_analisis'] = $id_analisis;
        if (!$this->model->findById($id_analisis)) {
            return $this->fail('ID ' . $id_analisis . ' tidak ditemukan');
        }
        // $validate = $this->validation->run($data, 'admin_update');
        // $errors = $this->validation->getErrors();
        // if ($errors) {
        //     return $this->fail($errors);
        // }

        $analisis_rekomendasi = new \App\Entities\Admin();
        $analisis_rekomendasi->fill($data);
        if ($this->model->save($analisis_rekomendasi)) {
            return $this->respondUpdated($analisis_rekomendasi, 'Admin Update');
        }
    }
    public function delete($id_analisis = null)
    {
        if (!$this->model->findById($id_analisis)) {
            return $this->fail('ID ' . $id_analisis . ' Tidak ditemukan');
        }
        if ($this->model->delete($id_analisis)) {
            return $this->respondDeleted(['id_analisis ' => $id_analisis . ' Deleted']);
        }
    }
    public function show($id_analisis = null)
    {
        $data = $this->model->findById($id_analisis);
        if ($data) {
            return $this->respond($data);
        }
        return $this->fail('ID ' . $id_analisis . ' tidak ditemukan');
    }
}
