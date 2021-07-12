<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class DataPasien extends ResourceController
{
    protected $modelName = 'App\Models\DataPasienModels';
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
        $filegambar = $this->request->getFile('gambar_pasien');
        if ($filegambar->getError() == 4) {
            $namagambar = 'default.png';
        } else {
            //generate sampul ranadom
            $namagambar = $filegambar->getRandomName();

            //pindahkan file gambar ke folder img
            $filegambar->move('img/pasien', $namagambar);
        }

        $data = [
            'id_pasien' => $this->request->getVar('id_pasien'),
            'nama' => $this->request->getVar('nama'),
            'tempat_lahir' => $this->request->getVar('tempat_lahir'),
            'tanggal_lahir' => $this->request->getVar('tanggal_lahir'),
            'alamat' => $this->request->getVar('alamat'),
            'nama_puskesmas' => $this->request->getVar('nama_puskesmas'),
            'tinggi_badan' => $this->request->getVar('tinggi_badan'),
            'berat_badan' => $this->request->getVar('berat_badan'),
            'diagnosis_pasien' => $this->request->getVar('diagnosis_pasien'),
            'gambar_pasien' => $namagambar
        ];
        $dataPasien = new \App\Entities\DataPasien();
        $dataPasien->fill($data);
        if ($this->model->save($dataPasien)) {
            return $this->respondCreated($dataPasien, 'data Pasien Created');
        }
    }
    public function update($id = null)
    {
        // $filegambar = $this->request->getFile('gambar_pasien');
        // $gambarlama = $this->request->getVar('gambarlama');
        // if ($filegambar->getError() == 4) {
        //     $namagambar = $gambarlama;
        // } else {
        //     //generate sampul ranadom
        //     $namagambar = $filegambar->getRandomName();

        //     //pindahkan file gambar ke folder img
        //     $filegambar->move('img/pasien', $namagambar);
        //     //hapus
        //     if ($gambarlama != 'default.png') {

        //         unlink('img/pasien/' . $gambarlama);
        //     }
        // }

        $data = [
            'id_pasien' => $this->request->getVar('id_pasien'),
            'nama' => $this->request->getVar('nama'),
            'tempat_lahir' => $this->request->getVar('tempat_lahir'),
            'tanggal_lahir' => $this->request->getVar('tanggal_lahir'),
            'alamat' => $this->request->getVar('alamat'),
            'nama_puskesmas' => $this->request->getVar('nama_puskesmas'),
            'tinggi_badan' => $this->request->getVar('tinggi_badan'),
            'berat_badan' => $this->request->getVar('berat_badan'),
            'diagnosis_pasien' => $this->request->getVar('diagnosis_pasien')
            //'gambar_pasien' => $namagambar
        ];
        $data['id_data_pasien'] = $id;
        if (!$this->model->findById($id)) {
            return $this->fail('ID ' . $id . ' tidak ditemukan');
        }
        $dataPasien = new \App\Entities\DataPasien();
        $dataPasien->fill($data);
        if ($this->model->save($dataPasien)) {
            return $this->respondUpdated($dataPasien, 'daa$dataPasien Update');
        }
    }
    public function delete($idDataPasien = null)
    {
        if (!$this->model->findById($idDataPasien)) {
            return $this->fail('ID ' . $idDataPasien . ' Tidak ditemukan');
        }
        $data = $this->model->findById($idDataPasien);
        if ($data['gambar_pasien'] != 'default.png') {
            //menghapus gambar
            unlink('img/pasien/' . $data['gambar_pasien']);
        }
        if ($this->model->delete($idDataPasien)) {
            return $this->respondDeleted(['id Data Pasien ' => $idDataPasien . ' Deleted']);
        }
    }
    public function show($idDataPasien = null)
    {

        $data = $this->model->findById($idDataPasien);
        if ($data) {
            return $this->respond($data);
        }
        return $this->fail('ID ' . $idDataPasien . ' tidak ditemukan');
    }
}
