<?php

// Menggunakan kontrak view dan model yang sesuai untuk Tim
include_once ("KontrakViewTim.php");
include_once ("models/Tim.php");

class ViewTim implements KontrakViewTim{

    public function __construct(){
        // Konstruktor kosong
    }

    // Method untuk menampilkan daftar tim
    public function tampilTim($listTim): string
    {
        // Build table rows
        $tbody = '';
        $no = 1;
        foreach($listTim as $tim){
            $tbody .= '<tr>';
            $tbody .= '<td class="col-id">'. $no .'</td>';
            $tbody .= '<td>'. htmlspecialchars($tim->getNama()) .'</td>';
            $tbody .= '<td>'. htmlspecialchars($tim->getTahunTerbentuk()) .'</td>';
            // Perhatikan link Edit: harus menyertakan entity=tim
            $tbody .= '<td class="col-actions">
                        <a href="index.php?entity=tim&screen=edit&id='. $tim->getId() .'" class="btn btn-edit">Edit</a>
                        <button data-id="'. $tim->getId() .'" class="btn btn-delete">Hapus</button>
                    </td>';
            $tbody .= '</tr>';
            $no++;
        }

        // Load the page template (skin_tim.html) and inject rows + total count
        $templatePath = __DIR__ . '/../template/skin_tim.html';
        $template = '';
        if (file_exists($templatePath)) {
            $template = file_get_contents($templatePath);
            $template = str_replace('<!-- PHP will inject rows here -->', $tbody, $template);
            $total = count($listTim);
            $template = str_replace('Total:', 'Total: ' . $total, $template);
            return $template;
        }

        // Fallback: just return the rows if template is missing
        return $tbody;
    }

    // Method untuk menampilkan form tambah/ubah tim
    public function tampilFormTim($data = null): string {
        $templatePath = __DIR__ . '/../template/form_tim.html';
        
        if (!file_exists($templatePath)) {
            return "Template form_tim.html tidak ditemukan.";
        }

        $template = file_get_contents($templatePath);
        
        // Nilai default
        $title = 'Tambah Tim Baru';
        $id_val = '';
        $nama_val = '';
        $tahunTerbentuk_val = '';
        $action = 'add'; 

        if ($data) {
            $action = 'edit';
            $title = 'Ubah Data Tim';
            $id_val = htmlspecialchars($data['id']);
            $nama_val = htmlspecialchars($data['nama']);
            $tahunTerbentuk_val = htmlspecialchars($data['tahunTerbentuk']);
        }

        // 1. Mengganti Judul Form
        $template = str_replace('<!-- FORM_TITLE -->', $title, $template);

        // 2. Mengganti Hidden Fields (Action dan ID)
        // Asumsi form_tim.html memiliki placeholder: value="[FORM_ACTION]" dan value="[FORM_ID]"
        $template = str_replace('value="[FORM_ACTION]"', 'value="' . $action . '"', $template);
        $template = str_replace('value="[FORM_ID]"', 'value="' . $id_val . '"', $template);
        
        // 3. Mengganti Input Fields
        // Asumsi form_tim.html memiliki placeholder: value="" untuk input yang relevan
        $template = str_replace('name="nama" type="text" placeholder="Nama tim" value=""', 'name="nama" type="text" placeholder="Nama tim" value="' . $nama_val . '"', $template);
        $template = str_replace('name="tahunTerbentuk" type="number" placeholder="Tahun (mis. 2005)" value=""', 'name="tahunTerbentuk" type="number" placeholder="Tahun (mis. 2005)" value="' . $tahunTerbentuk_val . '"', $template);
        
        return $template;
    }
}

?>