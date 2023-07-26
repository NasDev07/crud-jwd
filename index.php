<?php
include 'koneksi.php';
session_start();

$query = "SELECT * FROM tb_siswa";
$sql = mysqli_query($conn, $query);
$no = 0;

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
    <!-- datatables -->
    <link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-1.13.5/datatables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-1.13.5/datatables.min.js"></script>
</head>

<script>
    $(document).ready(function() {
        $('#dt').DataTable();
    });
</script>

<body>

    <!-- Navbar -->
    <nav class="navbar bg-light">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                JWD | Nasruddin
            </a>
        </div>
    </nav>

    <!-- Judul -->
    <div class="container">
        <h1 class="mt-3 text-center">Data Siswa</h1>
        <figure class="text-center">
            <blockquote class="blockquote">
                <p>Berisi Data Yang sudah tersimpan di database</p>
            </blockquote>
            <figcaption class="blockquote-footer">
                CRUD <cite title="Source Title">Create Read Update Delete</cite>
            </figcaption>
        </figure>
        <a href="kelola.php" type="button" class="btn btn-primary my-2"><i class="bi bi-plus-circle"></i> Tambah Data</a>

        <!-- Message -->
        <?php
        if (isset($_SESSION['eksekusi'])) :
        ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Message </strong> <?php echo $_SESSION['eksekusi'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
            session_destroy();
        endif;
        ?>

        <div class="table-responsive">
            <table id="dt" class="table align-middle cell-border hover">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">No</th>
                        <th scope="col">NISN</th>
                        <th scope="col">Nama Siswa</th>
                        <th scope="col">Jenis Kelamin</th>
                        <th scope="col">Foto Siswa</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($result = mysqli_fetch_assoc($sql)) {
                    ?>
                        <tr>
                            <th scope="row" class="text-center"><?php echo ++$no ?></th>
                            <td><?php echo $result['nisn'] ?></td>
                            <td><?php echo $result['nama_siswa'] ?></td>
                            <td><?php echo $result['jenis_kelamin'] ?></td>
                            <td>
                                <img src="img/<?php echo $result['foto_siswa'] ?>" alt="" width="50" class="rounded-5">
                            </td>
                            <td><?php echo $result['alamat'] ?></td>
                            <td>
                                <a href="kelola.php?ubah=<?php echo $result['id'] ?>" type="button" class="btn btn-success btn-sm"><i class="bi bi-pencil-square"></i></a>

                                <a href="proses.php?hapus=<?php echo $result['id'] ?>" type="button" class="btn btn-danger btn-sm" onClick="return confirm('Apakah Yakin Ingin menghapus???')"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>