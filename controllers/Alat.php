<?php
include_once('../models/AlatModel.php');

class AlatController
{
    private $model;

    public function __construct()
    {
        $this->model = new AlatModel();
    }

    public function addAlat($kode_alat, $nama, $harga_sewa)
    {
        return $this->model->addAlat($kode_alat, $nama, $harga_sewa);
    }

    public function getAlat($id)
    {
        return $this->model->getAlat($id);
    }

    public function Show($id)
    {
        $rows = $this->model->getAlat($id);
        foreach($rows as $row){
            $val = $row['nama'];
        }
        return $val;
    }

    public function updateAlat($id, $kode_alat, $nama, $harga_sewa)
    {
        return $this->model->updateAlat($id, $kode_alat, $nama, $harga_sewa);
    }

    public function deleteAlat($id)
    {
        return $this->model->deleteAlat($id);
    }

    public function getAlatList($search = "")
    {
        return $this->model->getAlatList($search);
    }
    
    public function getDataCombo()
    {
        return $this->model->getDataCombo();
    }
}
