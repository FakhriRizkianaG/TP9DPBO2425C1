<?php

interface KontrakModelTim {
    // Metode untuk mengambil semua data tim
    public function getAllTim(): array;

    // Metode untuk mengambil data tim berdasarkan ID
    public function getTimById($id): ?array;

    // Metode untuk menambah data tim
    public function addTim($nama, $tahunTerbentuk): void;

    // Metode untuk mengubah data tim
    public function updateTim($id, $nama, $tahunTerbentuk): void;

    // Metode untuk menghapus data tim
    public function deleteTim($id): void;
}

?>