<?php

interface KontrakViewTim {
    // Metode untuk menampilkan daftar tim
    public function tampilTim($listTim): string;

    // Metode untuk menampilkan form tambah/ubah tim
    public function tampilFormTim($data = null): string;
}

?>