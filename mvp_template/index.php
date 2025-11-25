<?php

// 1. INCLUDE MODEL, VIEW, PRESENTER UNTUK PEMBALAP
include_once("models/DB.php");
include_once("models/TabelPembalap.php");
include_once("views/ViewPembalap.php");
include_once("presenters/PresenterPembalap.php");

// 2. INCLUDE MODEL, VIEW, PRESENTER UNTUK TIM
// Memastikan semua file Tim sudah di-include
include_once("models/TabelTim.php"); 
include_once("views/ViewTim.php");
include_once("presenters/PresenterTim.php"); 
include_once("models/Tim.php"); // Pastikan model Tim di-load

// --- INISIALISASI ---

// Konfigurasi Database (Ganti sesuai DB Anda)
$DB_HOST = 'localhost';
$DB_NAME = 'mvp_db';
$DB_USER = 'root';
$DB_PASS = '';

// Inisialisasi Presenter Pembalap
$tabelPembalap = new TabelPembalap($DB_HOST, $DB_NAME, $DB_USER, $DB_PASS);
$viewPembalap = new ViewPembalap();
$presenterPembalap = new PresenterPembalap($tabelPembalap, $viewPembalap);

// Inisialisasi Presenter Tim
$tabelTim = new TabelTim($DB_HOST, $DB_NAME, $DB_USER, $DB_PASS);
$viewTim = new ViewTim();
$presenterTim = new PresenterTim($tabelTim, $viewTim);


// --- ROUTING UTAMA ---

$entity = $_REQUEST['entity'] ?? 'pembalap'; // Default ke pembalap


// A. TANGANI AKSI POST (ADD, EDIT, DELETE)
if(isset($_POST['action'])){
    $action = $_POST['action'];
    $id = $_POST['id'] ?? null;
    
    // Logika CRUD Pembalap
    if ($entity == 'pembalap') {
        $nama = $_POST['nama'] ?? '';
        $tim = $_POST['tim'] ?? '';
        $negara = $_POST['negara'] ?? '';
        $poinMusim = $_POST['poinMusim'] ?? 0;
        $jumlahMenang = $_POST['jumlahMenang'] ?? 0;

        if($action == 'add'){
            $presenterPembalap->tambahPembalap($nama, $tim, $negara, $poinMusim, $jumlahMenang);
        } else if($action == 'edit' && $id !== null){
            $presenterPembalap->ubahPembalap($id, $nama, $tim, $negara, $poinMusim, $jumlahMenang);
        } else if($action == 'delete' && $id !== null){ // Hapus Pembalap
            $presenterPembalap->hapusPembalap($id);
        }
    } 
    // Logika CRUD Tim
    else if ($entity == 'tim') {
        $nama = $_POST['nama'] ?? '';
        $tahunTerbentuk = $_POST['tahunTerbentuk'] ?? '';
        
        if($action == 'add'){
            $presenterTim->tambahTim($nama, $tahunTerbentuk);
        } else if($action == 'edit' && $id !== null){
            $presenterTim->ubahTim($id, $nama, $tahunTerbentuk);
        } 
        // PERBAIKAN: Tangani 'deleteTim' yang dikirim dari JS di skin_tim.html
        else if($action == 'deleteTim' && $id !== null){ 
            $presenterTim->hapusTim($id);
        }
    }

    // Redirect kembali ke entitas yang sedang aktif
    header("Location: index.php?entity=" . $entity);
    exit();

} 
// B. TANGANI AKSI GET (TAMPILKAN FORM)
else if(isset($_GET['screen'])){
    $id = isset($_GET['id']) ? (int)$_GET['id'] : null;

    if ($entity == 'pembalap') {
        // Pembalap menggunakan tampilkanFormPembalap
        $html = $presenterPembalap->tampilkanFormPembalap($id);
    } else {
        // Tim menggunakan tampilkanFormTim
        $html = $presenterTim->tampilkanFormTim($id);
    }
    
    echo $html;

} 
// C. DEFAULT: Tampilkan daftar
else{
    // Tambahkan menu tab di atas tabel
    $nav = '
        <div class="container" style="padding: 0 18px 0 18px; max-width: 980px; margin: 36px auto;">
            <a href="index.php?entity=pembalap" style="margin-right: 15px; text-decoration: none; font-weight: '.($entity == 'pembalap' ? 'bold; color: #2563eb;' : 'normal; color: #6b7280;').'">Pembalap</a>
            <a href="index.php?entity=tim" style="text-decoration: none; font-weight: '.($entity == 'tim' ? 'bold; color: #2563eb;' : 'normal; color: #6b7280;').'">Tim</a>
        </div>';

    echo $nav;
    
    // Tampilkan tabel berdasarkan entitas
    $html = ($entity == 'tim') ? $presenterTim->tampilkanTim() : $presenterPembalap->tampilkanPembalap();
    echo $html;
}