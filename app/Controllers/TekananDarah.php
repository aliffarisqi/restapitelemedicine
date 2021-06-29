<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class TekananDarah extends ResourceController
{
    protected $modelName = 'App\Models\TekananDarahModels';
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
        // $validate = $this->validation->run($data, 'tekanan_darah');

        // $errors = $this->validation->getErrors();
        // if ($errors) {
        //     return $this->fail($errors);
        // }

        $tekananDarah = new \App\Entities\TekananDarah();
        $tekananDarah->fill($data);
        if ($this->model->save($tekananDarah)) {
            return $this->respondCreated($tekananDarah, 'Tekanan Darah Created');
        }
    }
    public function update($idTekananDarah = null)
    {
        $data = $this->request->getRawInput();
        $data['id_tekanan_darah'] = $idTekananDarah;
        if (!$this->model->findById($idTekananDarah)) {
            return $this->fail('ID ' . $idTekananDarah . ' tidak ditemukan');
        }
        // $validate = $this->validation->run($data, 'tekanan_darah_update');
        // $errors = $this->validation->getErrors();
        // if ($errors) {
        //     return $this->fail($errors);
        // }

        $tekananDarah = new \App\Entities\TekananDarah();
        $tekananDarah->fill($data);
        if ($this->model->save($tekananDarah)) {
            return $this->respondUpdated($tekananDarah, 'tekananDarah Update');
        }
    }
    public function delete($idTekananDarah = null)
    {
        if (!$this->model->findById($idTekananDarah)) {
            return $this->fail('ID ' . $idTekananDarah . ' Tidak ditemukan');
        }
        if ($this->model->delete($idTekananDarah)) {
            return $this->respondDeleted(['id_tekanan_darah' => $idTekananDarah . ' Deleted']);
        }
    }
    public function show($idTekananDarah = null)
    {
        $data = $this->model->findById($idTekananDarah);
        if ($data) {
            return $this->respond($data);
        }
        return $this->fail('ID ' . $idTekananDarah . ' tidak ditemukan');
    }
}
