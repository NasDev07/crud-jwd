<?php
    include 'koneksi.php';
    session_start();

    $id_siswa = '';
    $nisn = '';
    $nama_siswa = '';
    $jenis_kelamin = '';
    $alamat = '';

    if (isset($_GET['ubah'])) {
        $id_siswa = $_GET['ubah'];

        $query = "SELECT * FROM tb_siswa WHERE id = '$id_siswa'";
        $sql = mysqli_query($conn, $query);

        $result = mysqli_fetch_assoc($sql);

        $nisn = $result['nisn'];
        $nama_siswa = $result['nama_siswa'];
        $jenis_kelamin = $result['jenis_kelamin'];
        $alamat = $result['alamat'];
        
    }
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>JWD Nasruddin</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- Icon Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar bg-light">
        <div class="container">
            <a class="navbar-brand" href="index.html">
                JWD | Nasruddin
            </a>
        </div>
    </nav>

    <!-- Judul -->
    <div class="container mt-4">
        <form method="post" action="proses.php" enctype="multipart/form-data">
            <input type="hidden" value="<?php echo $id_siswa ?>" name="id_siswa">
            <div class="mb-3 row">
                <label for="nisn" class="col-sm-2 col-form-label">NISN</label>
                <div class="col-sm-10">
                    <input required type="number" class="form-control" id="nisn" name="nisn" placeholder="Ex: 20018000" value="<?php echo $nisn ?>">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="nama_siswa" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                    <input required type="text" name="nama_siswa" class="form-control" id="nama_siswa" placeholder="Ex: Nasruddin" value="<?php echo $nama_siswa ?>">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="jenis_kelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                <div class="col-sm-10">
                    <select required id="jenis_kelamin" name="jenis_kelamin" class="form-select">                        
                        <option <?php if($jenis_kelamin == 'Laki-Laki'){echo "selected";} ?> value="Laki-Laki">Laki-Laki</option>
                        <option <?php if($jenis_kelamin == 'Perempuan'){echo "selected";} ?> value="Perempuan">Perempuan</option>
                    </select>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="foto_siswa" class="col-sm-2 col-form-label">Foto Siswa</label>
                <div class="col-sm-10">
                    <input <?php if(!isset($_GET['ubah'])){echo "required";} ?> class="form-control" type="file" id="foto_siswa" name="foto_siswa" accept="image/*">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="alamat" class="col-sm-2 col-form-label">Alamat Lengkap</label>
                <div class="col-sm-10">
                    <textarea required class="form-control" id="alamat" name="alamat" rows="3"><?php echo $alamat ?></textarea>
                </div>
            </div>

            <div class="mb-3 row mt-4">
                <div class="col">
                    <?php
                    if (isset($_GET['ubah'])) {
                    ?>
                        <button type="submit" name="aksi" value="edit" class="btn btn-primary"><i class="bi bi-save"></i> Simpan Perubahan</button>
                    <?php
                    } else {
                    ?>
                        <button type="submit" name="aksi" value="add" class="btn btn-primary"><i class="bi bi-save"></i> Tambahkan</button>
                    <?php
                    }
                    ?>
                    <a href="index.php" type="button" class="btn btn-danger"><i class="bi bi-reply"></i></a>
                </div>
            </div>
        </form>
    </div>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>