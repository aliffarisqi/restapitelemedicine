<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Alergi extends ResourceController
{
    protected $modelName = 'App\Models\AlergiModels';
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

        // $validate = $this->validation->run($data, 'admin');
        // $errors = $this->validation->run($data, 'alergi');
        // if ($errors) {
        //     return $this->fail($errors);
        // }

        $alergi = new \App\Entities\Alergi();
        $alergi->fill($data);
        if ($this->model->save($alergi)) {
            return $this->respondCreated($alergi, 'data alergi added');
        }
    }
    public function update($id_alergi = null)
    {
        $data = $this->request->getRawInput();
        $data['id_alergi'] = $id_alergi;
        if (!$this->model->findById($id_alergi)) {
            return $this->fail('ID ' . $id_alergi . ' Tidak ditemukan');
        }
        // $validate = $this->validation->run($data, 'alergi_update');
        // $errors = $this->validation->getErrors();
        // if($errors){
        //     return $this->fail($errors);
        // }

        $alergi = new \App\Entities\Alergi();
        $alergi->fill($data);
        if ($this->model->save($alergi)) {
            return $this->respondUpdated($alergi, ' Alergi succes update');
        }
    }
    public function delete($id_alergi = null)
    {
        if (!$this->model->findById($id_alergi)) {
            return $this->fail('ID ' . $id_alergi . ' Tidak Ditemukan ');
        }
        if ($this->model->delete($id_alergi)) {
            return $this->respondDeleted(['id_alergi ' => $id_alergi . ' Deleted']);
        }
    }
    public function show($id_alergi = null)
    {
        $data = $this->model->findById($id_alergi);
        if ($data) {
            return $this->respond($data);
        }
        return $this->fail('ID ' . $id_alergi . ' tidak ditemukan');
    }
}
