<?php

interface KontrakView
{
    public function tampilPembalap($listPembalap): string;
    public function tampilFormPembalap($data = null): string;
}

?>