<?php
include_once('../models/PenyewaModel.php');

class PenyewaController
{
    private $model;

    public function __construct()
    {
        $this->model = new PenyewaModel();
    }

    public function addPenyewa($nomor_penyewa, $nama, $jk, $alamat)
    {
        return $this->model->addPenyewa($nomor_penyewa, $nama, $jk, $alamat);
    }

    public function getPenyewa($id)
    {
        return $this->model->getPenyewa($id);
    }

    public function Show($id)
    {
        $rows = $this->model->getPenyewa($id);
        foreach($rows as $row){
            $val = $row['nama'];
        }
        return $val;
    }

    public function updatePenyewa($id, $nomor_penyewa, $nama, $jk, $alamat)
    {
        return $this->model->updatePenyewa($id, $nomor_penyewa, $nama, $jk, $alamat);
    }

    public function deletePenyewa($id)
    {
        return $this->model->deletePenyewa($id);
    }

    public function getPenyewaList($alamat = '')
    {
        return $this->model->getPenyewaList($alamat);
    }
    
    public function getDataCombo()
    {
        return $this->model->getDataCombo();
    }
}
