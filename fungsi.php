<?php
include 'koneksi.php';
function tambah_data($data, $files)
{
    $nisn = $data['nisn'];
    $nama_siswa = $data['nama_siswa'];
    $jenis_kelamin = $data['jenis_kelamin'];

    $split = explode('.', $files['foto_siswa']['name']);
    $ekstensi = $split[count($split) - 1];
    $foto_siswa = $nisn . '.' . $ekstensi;

    $alamat = $data['alamat'];

    $dir = "img/";
    $tmpFIle = $_FILES['foto_siswa']['tmp_name'];

    move_uploaded_file($tmpFIle, $dir . $foto_siswa);

    $query = "INSERT INTO tb_siswa VALUES(null, '$nisn', '$nama_siswa', '$jenis_kelamin', '$foto_siswa', '$alamat' )";
    $sql = mysqli_query($GLOBALS['conn'], $query);

    return true;
}


function ubah_data($data, $files)
{
    $id_siswa = $data['id_siswa'];
    $nisn = $data['nisn'];
    $nama_siswa = $data['nama_siswa'];
    $jenis_kelamin = $data['jenis_kelamin'];
    $alamat = $data['alamat'];

    $queryShow = "SELECT * FROM tb_siswa WHERE id = '$id_siswa'";
    $sqlShow = mysqli_query($GLOBALS['conn'], $queryShow);
    $result = mysqli_fetch_assoc($sqlShow);

    if ($files['foto_siswa']['error'] === UPLOAD_ERR_OK) {
        $split = explode('.', $files['foto_siswa']['name']);
        $ekstensi = $split[count($split) - 1];

        $foto_siswa = $nisn . '.' . $ekstensi;        
        unlink("img/" . $result['foto_siswa']);
        move_uploaded_file($_FILES['foto_siswa']['tmp_name'], 'img/' . $foto_siswa);
    } else {
        $foto_siswa = $result['foto_siswa'];
    }

    $query = "UPDATE tb_siswa SET nisn=?, nama_siswa=?, jenis_kelamin=?, foto_siswa=?, alamat=? WHERE id=?";
    $stmt = mysqli_prepare($GLOBALS['conn'], $query);
    mysqli_stmt_bind_param($stmt, "ssssss", $nisn, $nama_siswa, $jenis_kelamin, $foto_siswa, $alamat, $id_siswa);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    return true;
}


function hapus_data($data)
{

    $id_siswa = $data['hapus'];

    $queryShow = "SELECT * FROM tb_siswa WHERE id = '$id_siswa'";
    $sqlShow = mysqli_query($GLOBALS['conn'], $queryShow);
    $result = mysqli_fetch_assoc($sqlShow);

    // var_dump($result);
    unlink("img/" . $result['foto_siswa']);

    $query = "DELETE FROM tb_siswa WHERE id = '$id_siswa'";
    $sql = mysqli_query($GLOBALS['conn'], $query);

    return true;
}
