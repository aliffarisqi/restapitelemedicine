<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class JenisLifestyle extends ResourceController
{
    protected $modelName = 'App\Models\JenisLifestyleModels';
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

        $jenisLifestyle = new \App\Entities\JenisLifestyle();
        $jenisLifestyle->fill($data);
        if ($this->model->save($jenisLifestyle)) {
            return $this->respondCreated($jenisLifestyle, 'jenis Lifestyle Created');
        }
    }
    public function update($id_jenislifestyle = null)
    {
        $data = $this->request->getRawInput();
        $data['id_jenis_lifestyle'] = $id_jenislifestyle;
        if (!$this->model->findById($id_jenislifestyle)) {
            return $this->fail('ID ' . $id_jenislifestyle . ' tidak ditemukan');
        }


        $jenisLifestyle = new \App\Entities\JenisLifestyle();
        $jenisLifestyle->fill($data);
        if ($this->model->save($jenisLifestyle)) {
            return $this->respondUpdated($jenisLifestyle, 'jenis Lifestyle Update');
        }
    }
    public function delete($id_jenislifestyle = null)
    {
        if (!$this->model->findById($id_jenislifestyle)) {
            return $this->fail('ID ' . $id_jenislifestyle . ' Tidak ditemukan');
        }
        if ($this->model->delete($id_jenislifestyle)) {
            return $this->respondDeleted(['id_jenis_lifestyle ' => $id_jenislifestyle . ' Deleted']);
        }
    }
    public function show($id_jenislifestyle = null)
    {
        $data = $this->model->findById($id_jenislifestyle);
        if ($data) {
            return $this->respond($data);
        }
        return $this->fail('ID ' . $id_jenislifestyle . ' tidak ditemukan');
    }
}
