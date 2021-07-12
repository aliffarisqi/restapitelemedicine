<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Kuesioner extends ResourceController
{
    protected $modelName = 'App\Models\KuesionerModels';
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

        $kuesioner = new \App\Entities\Kuesioner();
        $kuesioner->fill($data);
        if ($this->model->save($kuesioner)) {
            return $this->respondCreated($kuesioner, 'Kuesioner Created');
        }
    }
    public function update($id_kuesioner = null)
    {
        $data = $this->request->getRawInput();
        $data['id_kuesioner'] = $id_kuesioner;
        if (!$this->model->findById($id_kuesioner)) {
            return $this->fail('ID ' . $id_kuesioner . ' tidak ditemukan');
        }


        $kuesioner = new \App\Entities\Kuesioner();
        $kuesioner->fill($data);
        if ($this->model->save($kuesioner)) {
            return $this->respondUpdated($kuesioner, 'Kuesioner Update');
        }
    }
    public function delete($id_kuesioner = null)
    {
        if (!$this->model->findById($id_kuesioner)) {
            return $this->fail('ID ' . $id_kuesioner . ' Tidak ditemukan');
        }
        if ($this->model->delete($id_kuesioner)) {
            return $this->respondDeleted(['id_kuesioner' => $id_kuesioner . ' Deleted']);
        }
    }
    public function show($id_kuesioner = null)
    {
        $data = $this->model->findById($id_kuesioner);
        if ($data) {
            return $this->respond($data);
        }
        return $this->fail('ID ' . $id_kuesioner . ' tidak ditemukan');
    }
}
