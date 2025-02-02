<?php

include_once('../db/database.php');

class SewaModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function addSewa($nomor_bukti, $nomor_penyewa, $tanggal_sewa)
    {
        $sql = "INSERT INTO sewa (nomor_bukti, nomor_penyewa, tanggal_sewa) VALUES (:nomor_bukti, :nomor_penyewa, :tanggal_sewa)";
        $params = array(
          ":nomor_bukti" => $nomor_bukti,
          ":nomor_penyewa" => $nomor_penyewa,
          ":tanggal_sewa" => $tanggal_sewa
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

    public function getSewa($id)
    {
        $sql = "SELECT P.* , A.nama
                FROM sewa P 
                left join penyewa A 
                on (P.nomor_penyewa = A.nomor_penyewa) 
                WHERE P.id = :id";
        $params = array(":id" => $id);

        return $this->db->executeQuery($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateSewa($id, $nomor_bukti, $nomor_penyewa, $tanggal_sewa, $tanggal_kembali)
    {
        $sql = "UPDATE sewa SET nomor_bukti = :nomor_bukti, nomor_penyewa = :nomor_penyewa, tanggal_sewa = :tanggal_sewa, tanggal_kembali = :tanggal_kembali WHERE id = :id";
        $params = array(
          ":nomor_bukti" => $nomor_bukti,
          ":nomor_penyewa" => $nomor_penyewa,
          ":tanggal_sewa" => $tanggal_sewa,
          ":tanggal_kembali" => $tanggal_kembali,
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

    public function updateStatus($id, $status)
    {
        $sql = "UPDATE sewa SET disewa = :disewa WHERE id = :id";
        $params = array(
          ":disewa" => $status,
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

    public function updateDikembalikan($id, $status)
    {
        $date = date('Y-m-d');
        $sql = "UPDATE sewa SET dikembalikan = :dikembalikan,tanggal_kembali = :tanggal_kembali WHERE id = :id";
        $params = array(
          ":dikembalikan" => $status,
          ":tanggal_kembali" => $date,
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
    

    public function deleteSewa($id)
    {
        $sql = "DELETE FROM sewa WHERE id = :id";
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

    public function getSewaList()
    {
        $sql = 'SELECT P.id,P.nomor_bukti,P.nomor_penyewa,P.tanggal_sewa,P.tanggal_kembali,P.disewa,P.dikembalikan,A.id as idpenyewa,A.nama 
        FROM sewa P left join penyewa A on (P.nomor_penyewa = A.nomor_penyewa) limit 100';
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDataCombo()
    {
        $sql = 'SELECT * FROM sewa';
        $data = array();
        $data = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}
