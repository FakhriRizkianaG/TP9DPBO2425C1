<?php

/*

    Interface ini mendefinisikan struktur dasar yang harus dimiliki oleh setiap Presenter 
    dalam arsitektur MVP (Model–View–Presenter).

    Interface ini berfungsi sebagai kontrak antara View dan Presenter, 
    yang menentukan metode-metode CRUD (Create, Read, Update, Delete) 
    yang wajib diimplementasikan oleh Presenter .

    Dengan adanya kontrak ini, setiap anggota tim dapat 
    bekerja dengan pola yang sama, menjaga konsistensi struktur kode,  
    dan memungkinkan dikerjakan secara paralel 
    tanpa saling mengganggu bagian kode lainnya.

*/
require_once __DIR__ . '/../models/DB.php';

interface KontrakPresenter
{
    // method untuk tampilkan pembalap
    public function tampilkanPembalap(): string;

    // method untuk tampilkan form pembalap
    public function tampilkanFormPembalap($id = null): string;


    // method untuk CRUD pembalap
    public function tambahPembalap($nama, $tim, $negara, $poinMusim, $jumlahMenang): void;
    public function ubahPembalap($id, $nama, $tim, $negara, $poinMusim, $jumlahMenang): void;
    public function hapusPembalap($id): void;
}
