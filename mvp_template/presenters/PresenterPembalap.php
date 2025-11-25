<?php

include_once(__DIR__ . "/KontrakPresenter.php");
include_once(__DIR__ . "/../models/TabelPembalap.php");
include_once(__DIR__ . "/../models/Pembalap.php");
include_once(__DIR__ . "/../views/ViewPembalap.php");

class PresenterPembalap implements KontrakPresenter
{
    // Model PembalapQuery untuk operasi database
    private $tabelPembalap; // Instance dari TabelPembalap (Model)
    private $viewPembalap; // Instance dari ViewPembalap (View)

    // Data list pembalap
    private $listPembalap = []; // Menyimpan array objek Pembalap

    public function __construct($tabelPembalap, $viewPembalap)
    {
        $this->tabelPembalap = $tabelPembalap;
        $this->viewPembalap = $viewPembalap;
        // Tidak perlu initListPembalap di sini, panggil sebelum tampilkan
    }

    // Method untuk initialisasi list pembalap dari database
    public function initListPembalap()
    {
        //dapatkan data pembalap dari database
        $data = $this->tabelPembalap->getAllPembalap();

        //Buat objek pembalap dan simpan di listPembalap
        $this->listPembalap = [];
        foreach ($data as $item){
            $pembalap = new Pembalap(
                $item['id'],
                $item['nama'],
                $item['tim'],
                $item['negara'],
                $item['poinMusim'],
                $item['jumlahMenang'],
            );
            $this->listPembalap[] = $pembalap;
        }
    }

    // Method untuk menampilkan daftar pembalap menggunakan View
    public function tampilkanPembalap(): string
    {
        $this->initListPembalap(); // Pastikan list di-load sebelum ditampilkan
        return $this->viewPembalap->tampilPembalap($this->listPembalap);
    }

    // Method untuk menampilkan form
    public function tampilkanFormPembalap($id = null): string
    {
        $data = null;
        $action = 'add'; // Default action
        if ($id !== null){
            $data = $this->tabelPembalap->getPembalapbyId($id);
            $action = 'edit'; // Change action if editing
        }
        return $this->viewPembalap->tampilFormPembalap($data, $action); // Asumsi ViewPembalap diubah
    }

    // ==========================================================
    // Implementasi Metode CRUD
    // ==========================================================

    public function tambahPembalap($nama, $tim, $negara, $poinMusim, $jumlahMenang): void {
        // Melakukan sanitasi input, jika perlu, sebelum dikirim ke model
        $poinMusim = (int) $poinMusim;
        $jumlahMenang = (int) $jumlahMenang;
        
        $this->tabelPembalap->addPembalap($nama, $tim, $negara, $poinMusim, $jumlahMenang);
    }
    
    public function ubahPembalap($id, $nama, $tim, $negara, $poinMusim, $jumlahMenang): void {
        // Melakukan sanitasi input, jika perlu
        $id = (int) $id;
        $poinMusim = (int) $poinMusim;
        $jumlahMenang = (int) $jumlahMenang;

        $this->tabelPembalap->updatePembalap($id, $nama, $tim, $negara, $poinMusim, $jumlahMenang);
    }
    
    public function hapusPembalap($id): void {
        $id = (int) $id;
        $this->tabelPembalap->deletePembalap($id);
    }
}

?>