<?php
include 'koneksi.php';
include 'fungsi.php';
session_start();

if (isset($_POST['aksi'])) {
    if ($_POST['aksi'] == "add") {

        // Tambah Data        
        $berhasil = tambah_data($_POST, $_FILES);

        if ($berhasil) {
            $_SESSION['eksekusi'] = "Data Berhasil DItambahkan";
            header("location: index.php");            
        } else {
            echo $berha;
        }        

    } else if ($_POST['aksi'] == "edit") {
        // Edit Data
        $berhasil = ubah_data($_POST, $_FILES);
        if($berhasil){
            $_SESSION['eksekusi'] = "Data Berhasil Diperbarui";
        header("location: index.php");        
        }else {
        echo $berhasil;
        }
    }
}

// Hapus Data
if (isset($_GET['hapus'])) {
    $berhasil = hapus_data($_GET);

    if ($berhasil) {
        $_SESSION['eksekusi'] = "Data Berhasil Dihapus";
        header("location: index.php");        
    } else {
        echo $berhasil;
    }    
}


