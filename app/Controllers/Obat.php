<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Obat extends ResourceController
{
    protected $modelName = 'App\Models\ObatModels';
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
        $obat = new \App\Entities\Obat();
        $obat->fill($data);
        if ($this->model->save($obat)) {
            return $this->respondCreated($obat, 'obat Created');
        }
    }
    public function update($idobat = null)
    {
        $data = $this->request->getRawInput();
        $data['id_obat'] = $idobat;
        if (!$this->model->findById($idobat)) {
            return $this->fail('ID ' . $idobat . ' tidak ditemukan');
        }
        $obat = new \App\Entities\Obat();
        $obat->fill($data);
        if ($this->model->save($obat)) {
            return $this->respondUpdated($obat, 'obat Update');
        }
    }
    public function delete($idobat = null)
    {
        if (!$this->model->findById($idobat)) {
            return $this->fail('ID ' . $idobat . ' Tidak ditemukan');
        }
        if ($this->model->delete($idobat)) {
            return $this->respondDeleted(['id_obat ' => $idobat . ' Deleted']);
        }
    }
    public function show($idobat = null)
    {
        $data = $this->model->findById($idobat);
        if ($data) {
            return $this->respond($data);
        }
        return $this->fail('ID ' . $idobat . ' tidak ditemukan');
    }
}
