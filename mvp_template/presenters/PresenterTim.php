<?php

// Asumsi lokasi file:
// KontrakPresenterTim.php berada di direktori yang sama
// TabelTim.php dan Tim.php berada di ../models/
// ViewTim.php berada di ../views/

include_once(__DIR__ . "/KontrakPresenterTim.php");
include_once(__DIR__ . "/../models/TabelTim.php");
include_once(__DIR__ . "/../models/Tim.php");
include_once(__DIR__ . "/../views/ViewTim.php");

class PresenterTim implements KontrakPresenterTim
{
    private $tabelTim; // Instance dari TabelTim (Model)
    private $viewTim;  // Instance dari ViewTim (View)
    private $listTim = []; // Menyimpan array objek Tim

    public function __construct(TabelTim $tabelTim, $viewTim)
    {
        $this->tabelTim = $tabelTim;
        $this->viewTim = $viewTim;
    }

    // Method untuk initialisasi list tim dari database
    public function initListTim()
    {
        // Dapatkan data tim dari database (array asosiatif)
        $data = $this->tabelTim->getAllTim();

        // Buat objek Tim dan simpan di listTim
        $this->listTim = [];
        foreach ($data as $item){
            $tim = new Tim(
                $item['id'],
                $item['nama'],
                $item['tahunTerbentuk']
            );
            $this->listTim[] = $tim;
        }
    }

    // Method untuk menampilkan daftar tim menggunakan View
    public function tampilkanTim(): string
    {
        $this->initListTim(); // Load data sebelum ditampilkan
        return $this->viewTim->tampilTim($this->listTim);
    }

    // Method untuk menampilkan form tambah/ubah tim
    public function tampilkanFormTim($id = null): string
    {
        $data = null;
        $action = 'add';
        
        if ($id !== null){
            // Dapatkan data tim berdasarkan ID untuk mode edit
            $data = $this->tabelTim->getTimById($id);
            $action = 'edit';
        }
        // Asumsi ViewTim memiliki method tampilFormTim($data, $action)
        return $this->viewTim->tampilFormTim($data, $action);
    }

    // Implementasi Metode CRUD

    public function tambahTim($nama, $tahunTerbentuk): void {
        $this->tabelTim->addTim($nama, $tahunTerbentuk);
    }
    
    public function ubahTim($id, $nama, $tahunTerbentuk): void {
        $this->tabelTim->updateTim($id, $nama, $tahunTerbentuk);
    }
    
    public function hapusTim($id): void {
        $this->tabelTim->deleteTim($id);
    }
}

?>