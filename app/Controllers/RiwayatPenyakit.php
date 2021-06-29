<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class RiwayatPenyakit extends ResourceController
{
    protected $modelName = 'App\Models\RiwayatPenyakitModels';
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
        // $validate = $this->validation->run($data, 'riwayat_penyakit');

        // $errors = $this->validation->getErrors();
        // if ($errors) {
        //     return $this->fail($errors);
        // }

        $riwayatPenyakit = new \App\Entities\RiwayatPenyakit();
        $riwayatPenyakit->fill($data);
        if ($this->model->save($riwayatPenyakit)) {
            return $this->respondCreated($riwayatPenyakit, 'riwayatPenyakit Created');
        }
    }
    public function update($idRiwayatPenyakit = null)
    {
        $data = $this->request->getRawInput();
        $data['id_riwayat_penyakit'] = $idRiwayatPenyakit;
        if (!$this->model->findById($idRiwayatPenyakit)) {
            return $this->fail('ID ' . $idRiwayatPenyakit . ' tidak ditemukan');
        }
        // $validate = $this->validation->run($data, 'riwayat_penyakit_update');
        // $errors = $this->validation->getErrors();
        // if ($errors) {
        //     return $this->fail($errors);
        // }

        $riwayatPenyakit = new \App\Entities\RiwayatPenyakit();
        $riwayatPenyakit->fill($data);
        if ($this->model->save($riwayatPenyakit)) {
            return $this->respondUpdated($riwayatPenyakit, 'Riwayat Penyakit Update');
        }
    }
    public function delete($idRiwayatPenyakit = null)
    {
        if (!$this->model->findById($idRiwayatPenyakit)) {
            return $this->fail('ID ' . $idRiwayatPenyakit . ' Tidak ditemukan');
        }
        if ($this->model->delete($idRiwayatPenyakit)) {
            return $this->respondDeleted(['id_riwayat_penyakit ' => $idRiwayatPenyakit . ' Deleted']);
        }
    }
    public function show($idRiwayatPenyakit = null)
    {
        $data = $this->model->findById($idRiwayatPenyakit);
        if ($data) {
            return $this->respond($data);
        }
        return $this->fail('ID ' . $idRiwayatPenyakit . ' tidak ditemukan');
    }
}
