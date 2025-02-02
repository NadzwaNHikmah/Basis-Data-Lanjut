<?php

include_once('../db/database.php');

class AlatModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function addAlat($kode_alat, $nama, $harga_sewa)
    {
        $sql = "INSERT INTO alat (kode_alat, nama, harga_sewa) VALUES (:kode_alat, :nama, :harga_sewa)";
        $params = array(
            ":kode_alat" => $kode_alat,
            ":nama" => $nama,
            ":harga_sewa" => $harga_sewa
        );

        $result = $this->db->executeQuery($sql, $params);

        if ($result) {
            return json_encode(["success" => true, "message" => "Insert successful"]);
        } else {
            return json_encode(["success" => false, "message" => "Insert failed"]);
        }
    }

    public function getAlat($id)
    {
        $sql = "SELECT * FROM alat WHERE id = :id";
        $params = array(":id" => $id);

        return $this->db->executeQuery($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateAlat($id, $kode_alat, $nama, $harga_sewa)
    {
        $sql = "UPDATE alat SET kode_alat = :kode_alat, nama = :nama, harga_sewa = :harga_sewa WHERE id = :id";
        $params = array(
            ":kode_alat" => $kode_alat,
            ":nama" => $nama,
            ":harga_sewa" => $harga_sewa,
            ":id" => $id
        );

        $result = $this->db->executeQuery($sql, $params);

        if ($result) {
            return json_encode(["success" => true, "message" => "Update successful"]);
        } else {
            return json_encode(["success" => false, "message" => "Update failed"]);
        }
    }

    public function deleteAlat($id)
    {
        $sql = "DELETE FROM alat WHERE id = :id";
        $params = array(":id" => $id);

        $result = $this->db->executeQuery($sql, $params);

        if ($result) {
            return json_encode(["success" => true, "message" => "Delete successful"]);
        } else {
            return json_encode(["success" => false, "message" => "Delete failed"]);
        }
    }

    // Update: Tambahkan parameter pencarian ke getAlatList()
    public function getAlatList($search = "")
    {
        $sql = "SELECT * FROM alat";
        $params = [];

        if (!empty($search)) {
            $sql .= " WHERE kode_alat LIKE :search OR nama LIKE :search";
            $params[":search"] = "%$search%";
        }

        return $this->db->executeQuery($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDataCombo()
    {
        $sql = 'SELECT * FROM alat';
        $data = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}
