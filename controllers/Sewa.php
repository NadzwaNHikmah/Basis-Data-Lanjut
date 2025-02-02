<?php
include_once('../models/SewaModel.php');

class SewaController
{
    private $model;

    public function __construct()
    {
        $this->model = new SewaModel();
    }

    public function addSewa($nomor_bukti, $nomor_penyewa, $tanggal_sewa)
    {
        return $this->model->addSewa($nomor_bukti, $nomor_penyewa, $tanggal_sewa);
    }

    public function getSewa($id)
    {
        return $this->model->getSewa($id);
    }

    public function Show($id)
    {
        $rows = $this->model->getSewa($id);
        foreach($rows as $row){
            $val = $row['nama'];
        }
        return $val;
    }

    public function updateSewa($id, $nomor_bukti, $nomor_penyewa, $tanggal_sewa, $tanggal_kembali)
    {
        return $this->model->updateSewa($id, $nomor_bukti, $nomor_penyewa, $tanggal_sewa, $tanggal_kembali);
    }

    public function updateStatus($id, $status)
    {
        return $this->model->updateStatus($id, $status);
    }

    public function updateDikembalikan($id, $status)
    {
        return $this->model->updateDikembalikan($id, $status);
    }

    public function deleteSewa($id)
    {
        return $this->model->deleteSewa($id);
    }

    // Modifikasi getSewaList agar mendukung filter berdasarkan tanggal
    public function getSewaList($start_date = null, $end_date = null)
    {
        return $this->model->getSewaList($start_date, $end_date);
    }
    
    public function getDataCombo()
    {
        return $this->model->getDataCombo();
    }
}
