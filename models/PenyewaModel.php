<?php

include_once('../db/database.php');

class PenyewaModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function addPenyewa($nomor_penyewa, $nama, $jk, $alamat)
    {
        $sql = "INSERT INTO penyewa (nomor_penyewa, nama, jk, alamat) VALUES (:nomor_penyewa, :nama, :jk, :alamat)";
        $params = array(
          ":nomor_penyewa" => $nomor_penyewa,
          ":nama" => $nama,
          ":jk" => $jk,
          ":alamat" => $alamat
        );

        $result = $this->db->executeQuery($sql, $params);
        return json_encode($result ? ["success" => true, "message" => "Insert successful"] : ["success" => false, "message" => "Insert failed"]);
    }

    public function getPenyewa($id)
    {
        $sql = "SELECT * FROM penyewa WHERE id = :id";
        $params = array(":id" => $id);
        return $this->db->executeQuery($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updatePenyewa($id, $nomor_penyewa, $nama, $jk, $alamat)
    {
        $sql = "UPDATE penyewa SET nomor_penyewa = :nomor_penyewa, nama = :nama, jk = :jk, alamat = :alamat WHERE id = :id";
        $params = array(
          ":nomor_penyewa" => $nomor_penyewa,
          ":nama" => $nama,
          ":jk" => $jk,
          ":alamat" => $alamat,
          ":id" => $id
        );
        $result = $this->db->executeQuery($sql, $params);
        return json_encode($result ? ["success" => true, "message" => "Update successful"] : ["success" => false, "message" => "Update failed"]);
    }

    public function deletePenyewa($id)
    {
        $sql = "DELETE FROM penyewa WHERE id = :id";
        $params = array(":id" => $id);
        $result = $this->db->executeQuery($sql, $params);
        return json_encode($result ? ["success" => true, "message" => "Delete successful"] : ["success" => false, "message" => "Delete failed"]);
    }

    public function getPenyewaList($alamat = '')
    {
        // Jika ada filter alamat
        if ($alamat) {
            $sql = "SELECT * FROM penyewa WHERE alamat LIKE :alamat";
            $params = [':alamat' => '%' . $alamat . '%'];
        } else {
            $sql = "SELECT * FROM penyewa LIMIT 100";
            $params = [];
        }
        
        return $this->db->executeQuery($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDataCombo()
    {
        $sql = 'SELECT * FROM penyewa';
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
}
