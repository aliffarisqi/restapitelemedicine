<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Puskesmas extends ResourceController
{
    protected $modelName = 'App\Models\PuskesmasModels';
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
        $puskesmas = new \App\Entities\Puskesmas();
        $puskesmas->fill($data);
        if ($this->model->save($puskesmas)) {
            return $this->respondCreated($puskesmas, 'puskesmas Created');
        }
    }
    public function update($idpuskesmas = null)
    {
        $data = $this->request->getRawInput();
        $data['id_puskesmas'] = $idpuskesmas;
        if (!$this->model->findById($idpuskesmas)) {
            return $this->fail('ID ' . $idpuskesmas . ' tidak ditemukan');
        }
        $puskesmas = new \App\Entities\Puskesmas();
        $puskesmas->fill($data);
        if ($this->model->save($puskesmas)) {
            return $this->respondUpdated($puskesmas, 'puskesmas Update');
        }
    }
    public function delete($idpuskesmas = null)
    {
        if (!$this->model->findById($idpuskesmas)) {
            return $this->fail('ID ' . $idpuskesmas . ' Tidak ditemukan');
        }
        if ($this->model->delete($idpuskesmas)) {
            return $this->respondDeleted(['id_idpuskesmas ' => $idpuskesmas . ' Deleted']);
        }
    }
    public function show($idpuskesmas = null)
    {
        $data = $this->model->findById($idpuskesmas);
        if ($data) {
            return $this->respond($data);
        }
        return $this->fail('ID ' . $idpuskesmas . ' tidak ditemukan');
    }
}
