<?php

/*

    Interface ini mendefinisikan struktur dasar yang harus dimiliki oleh setiap Model 
    dalam arsitektur MVP (Model–View–Presenter).

    Interface ini berfungsi sebagai kontrak antara Presenter dan Model, 
    yang menentukan metode-metode CRUD (Create, Read, Update, Delete) 
    yang wajib diimplementasikan oleh Model.

    Dengan adanya kontrak ini, setiap anggota tim dapat 
    bekerja dengan pola yang sama, menjaga konsistensi struktur kode,  
    dan memungkinkan dikerjakan secara paralel 
    tanpa saling mengganggu bagian kode lainnya.

*/

interface KontrakModel
{
    public function getAllPembalap(): array;
    public function getPembalapById($id): ?array;

    
    // method crud pembalap
    public function addPembalap($nama, $tim, $negara, $poinMusim, $jumlahMenang): void;
    public function updatePembalap($id, $nama, $tim, $negara, $poinMusim, $jumlahMenang): void;
    public function deletePembalap($id): void;
}

?>
