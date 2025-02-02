<?php
include_once('../models/SewadetailModel.php');

class SewadetailController
{
    private $model;

    public function __construct()
    {
        $this->model = new SewadetailModel();
    }

    public function addSewadetail($sewa_id, $kode_alat)
    {
        return $this->model->addSewadetail($sewa_id, $kode_alat);
    }

    public function getSewadetail($id)
    {
        return $this->model->getSewadetail($id);
    }

    public function countSewadetail($id)
    {
        return $this->model->countSewadetail($id);
    }

    public function Show($id)
    {
        $rows = $this->model->getSewadetail($id);
        foreach($rows as $row){
            $val = $row['nama'];
        }
        return $val;
    }

    public function updateSewadetail($id, $sewa_id, $kode_alat)
    {
        return $this->model->updateSewadetail($id, $sewa_id, $kode_alat);
    }

    public function deleteSewadetail($id)
    {
        return $this->model->deleteSewadetail($id);
    }

    public function getSewadetailList($id)
    {
        return $this->model->getSewadetailList($id);
    }
    
    public function getDataCombo()
    {
        return $this->model->getDataCombo();
    }
}
