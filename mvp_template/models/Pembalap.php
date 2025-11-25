<?php

class Pembalap{

    private $id;
    private $nama;
    private $tim;
    private $negara;
    private $poinMusim;
    private $jumlahMenang;


    public function __construct($id, $nama, $tim, $negara, $poinMusim, $jumlahMenang){
        $this->id = $id;
        $this->nama = $nama;
        $this->tim = $tim;
        $this->negara = $negara;
        $this->poinMusim = $poinMusim;
        $this->jumlahMenang = $jumlahMenang;
    }

    public function getId(){
        return $this->id;
    }
    public function getNama(){
        return $this->nama;
    }
    public function getTim(){
        return $this->tim;
    }
    public function getNegara(){
        return $this->negara;
    }
    public function getPoinMusim(){
        return $this->poinMusim;
    }
    public function getJumlahMenang(){
        return $this->jumlahMenang;
    }

    public function setNama($nama){
        $this->nama = $nama;
    }
    public function setTim($tim){
        $this->tim = $tim;
    }
    public function setNegara($negara){
        $this->negara = $negara;
    }
    public function setPoinMusim($poinMusim){
        $this->poinMusim = $poinMusim;
    }
    public function setJumlahMenang($jumlahMenang){
        $this->jumlahMenang = $jumlahMenang;
    }
}
?>