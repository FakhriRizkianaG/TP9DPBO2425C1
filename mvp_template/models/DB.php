<?php

class DB{

    private $host = "localhost";
    private $db_name = "mvp_db";
    private $username = "root";
    private $password = "";
    
    private $conn;
    private $result;

    // Constructor untuk inisialisasi database
    function __construct($host, $db_name, $username, $password) {
        $this->host = $host;
        $this->db_name = $db_name;
        $this->username = $username;
        $this->password = $password;
        $this->conn = $this->connect();
    }

    // Method untuk membuat koneksi database
    public function connect() {

        // Inisialisasi koneksi
        $conn = null;

        // Coba koneksi dengan PDO
        try {
            // dsn dan options adalah konfigurasi koneksi PDO
            $dsn = "mysql:host={$this->host};dbname={$this->db_name};charset=utf8mb4"; // DSN untuk MySQL dengan charset UTF-8 (biar error handling lebih baik)
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,        // Aktifkan mode error exception
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,   // Set mode fetch default ke associative array
                PDO::ATTR_EMULATE_PREPARES => false,                 // Nonaktifkan emulasi prepared statements
            ];

            // Buat koneksi PDO disimpan di variabel conn
            $conn = new PDO($dsn, $this->username, $this->password, $options);
        } catch (PDOException $exception) {
            throw new RuntimeException("Koneksi gagal: " . $exception->getMessage(), 0, $exception);
        }
        return $conn;
    }

    // Method untuk mengeksekusi query dengan prepared statement
    public function executeQuery($query, $params = []) {

        // Pastikan koneksi sudah ada
        if ($this->conn === null) {
            throw new RuntimeException('No database connection. Make sure connect() succeeded.');
        }

        // Eksekusi query dengan prepared statement dengan penanganan error
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
            $this->result = $stmt;
            return $stmt;
        } catch (PDOException $e) {
            throw new RuntimeException('Query gagal: ' . $e->getMessage(), 0, $e);
        }
    }

    // Mengambil semua hasil dari query sebagai array asosiatif
    public function getAllResult() {
        // kalo gak ada result, return array kosong
        if ($this->result === null) {
            return [];
        }
        return $this->result->fetchAll(PDO::FETCH_ASSOC);
    }

    // Method untuk menutup koneksi database
    public function close() {
        $this->conn = null;
    }

}

?>