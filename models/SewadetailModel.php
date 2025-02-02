<?php

include_once('../db/database.php');

class SewadetailModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function addSewadetail($sewa_id, $kode_alat)
    {
        $sql = "INSERT INTO sewadetail (sewa_id, kode_alat) VALUES (:sewa_id, :kode_alat)";
        $params = array(
          ":sewa_id" => $sewa_id,
          ":kode_alat" => $kode_alat
        );

        $result= $this->db->executeQuery($sql, $params);
        // Check if the insert was successful
        if ($result) {
            $response = array(
                "success" => true,
                "message" => "Insert successful"
            );
        } else {
            $response = array(
                "success" => false,
                "message" => "Insert failed"
            );
        }
    
        // Return the response as JSON
        return json_encode($response);
    }

    public function getSewadetail($id)
    {
        $sql = "SELECT P.id,P.sewa_id,P.kode_alat,B.id as idalat,B.kode_alat,B.nama,B.harga_sewa FROM `sewadetail` P left join `alat` B on (P.kode_alat=B.kode_alat) WHERE P.id = :id";
        $params = array(":id" => $id);

        return $this->db->executeQuery($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countSewadetail($id)
    {
        $sql = "SELECT count(*) as total FROM `sewadetail` WHERE sewa_id=:id";
        $params = array(":id" => $id);

        return $this->db->executeQuery($sql, $params)->fetchColumn();
    }

    public function updateSewadetail($id, $sewa_id, $kode_alat)
    {
        $sql = "UPDATE sewadetail SET sewa_id = :sewa_id, kode_alat = :kode_alat WHERE id = :id";
        $params = array(
          ":sewa_id" => $sewa_id,
          ":kode_alat" => $kode_alat,
          ":id" => $id
        );
    
        // Execute the query
        $result = $this->db->executeQuery($sql, $params);
    
        // Check if the update was successful
        if ($result) {
            $response = array(
                "success" => true,
                "message" => "Update successful"
            );
        } else {
            $response = array(
                "success" => false,
                "message" => "Update failed"
            );
        }
    
        // Return the response as JSON
        return json_encode($response);
    }
    

    public function deleteSewadetail($id)
    {
        $sql = "DELETE FROM sewadetail WHERE id = :id";
        $params = array(":id" => $id);

        $result = $this->db->executeQuery($sql, $params);
        // Check if the delete was successful
        if ($result) {
            $response = array(
                "success" => true,
                "message" => "Delete successful"
            );
        } else {
            $response = array(
                "success" => false,
                "message" => "Delete failed"
            );
        }
    
        // Return the response as JSON
        return json_encode($response);
    }

    public function getSewadetailList($id)
    {
        $sql = 'SELECT P.id,P.sewa_id,P.kode_alat,B.id as idalat,B.kode_alat,B.nama,B.harga_sewa FROM `sewadetail` P left join `alat` B on (P.kode_alat=B.kode_alat) WHERE P.sewa_id="'.$id.'"';
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDataCombo()
    {
        $sql = 'SELECT * FROM sewadetail';
        $data = array();
        $data = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}
