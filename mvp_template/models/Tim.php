<?php

class Tim {
    private $id;
    private $nama;
    private $tahunTerbentuk;

    public function __construct($id, $nama, $tahunTerbentuk) {
        $this->id = $id;
        $this->nama = $nama;
        $this->tahunTerbentuk = $tahunTerbentuk;
    }

    // Getter methods
    public function getId() {
        return $this->id;
    }

    public function getNama() {
        return $this->nama;
    }

    public function getTahunTerbentuk() {
        return $this->tahunTerbentuk;
    }

    // Setter methods (Opsional, ditambahkan untuk kelengkapan)
    public function setNama($nama): void {
        $this->nama = $nama;
    }

    public function setTahunTerbentuk($tahunTerbentuk): void {
        $this->tahunTerbentuk = $tahunTerbentuk;
    }
}

?>