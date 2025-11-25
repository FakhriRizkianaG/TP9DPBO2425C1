<?php

// Asumsi KontrakModelTim.php dan models/DB.php sudah ada di direktori yang sesuai
include_once ("KontrakModelTim.php");
include_once ("DB.php"); // Asumsi DB.php berada di models/

class TabelTim extends DB implements KontrakModelTim {

    public function __construct($host, $db_name, $username, $password) {
        parent::__construct($host, $db_name, $username, $password);
    }

    public function getAllTim(): array {
        $query = "SELECT * FROM tim";
        $this->executeQuery($query);
        return $this->getAllResult();
    }

    public function getTimById($id): ?array {
        $query = "SELECT * FROM tim WHERE id = :id";
        $this->executeQuery($query, ['id' => $id]);
        $results = $this->getAllResult();
        return $results[0] ?? null;
    }

    public function addTim($nama, $tahunTerbentuk): void {
        $query = "INSERT INTO tim (nama, tahunTerbentuk) VALUES (:nama, :tahunTerbentuk)";
        
        $params = [
            'nama' => $nama,
            'tahunTerbentuk' => (int)$tahunTerbentuk
        ];
        $this->executeQuery($query, $params);
    }

    public function updateTim($id, $nama, $tahunTerbentuk): void {
        $query = "UPDATE tim SET nama = :nama, tahunTerbentuk = :tahunTerbentuk WHERE id = :id";
        
        $params = [
            'id' => (int)$id,
            'nama' => $nama,
            'tahunTerbentuk' => (int)$tahunTerbentuk
        ];
        $this->executeQuery($query, $params);
    }

    public function deleteTim($id): void {
        $query = "DELETE FROM tim WHERE id = :id";
        $this->executeQuery($query, ['id' => (int)$id]);
    }
}

?>