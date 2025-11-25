
<?php
require_once __DIR__ . '/../models/DB.php';


interface KontrakPresenterTim {
    // Metode untuk initialisasi dan memuat data tim
    public function initListTim();

    // Metode untuk menampilkan daftar tim ke View
    public function tampilkanTim(): string;

    // Metode untuk menampilkan form tambah/ubah tim
    public function tampilkanFormTim($id = null): string;

    // Metode CRUD
    public function tambahTim($nama, $tahunTerbentuk): void;
    public function ubahTim($id, $nama, $tahunTerbentuk): void;
    public function hapusTim($id): void;
}

?>