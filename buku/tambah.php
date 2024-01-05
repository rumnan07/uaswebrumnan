<?php
session_start();

if($_SESSION['login'] == false){

    header('location: ../auth/login.php');

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Tambah Buku</h2>

    <?php
    // Sertakan file koneksi.php
    include('../koneksi.php');

    // Proses tambah buku
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Ambil data dari formulir
        $judul_buku = $_POST['judul_buku'];
        $penulis_buku = $_POST['penulis_buku'];
        $penerbit_buku = $_POST['penerbit_buku'];
        $tahun_terbit = $_POST['tahun_terbit'];

        // Query untuk menambahkan buku
        $query = "INSERT INTO Buku (judul_buku, penulis, penerbit, tahun_terbit) VALUES ('$judul_buku', '$penulis_buku', '$penerbit_buku', '$tahun_terbit')";

        if ($conn->query($query) === TRUE) {
            // Redirect kembali ke tampil.php setelah berhasil menambahkan buku
            header("Location: tampil.php");
            exit();
        } else {
            echo "Error: " . $query . "<br>" . $conn->error;
        }
    }
    ?>

    <form action="tambah.php" method="POST">
        <div class="form-group">
            <label for="judul_buku">Judul Buku:</label>
            <input type="text" class="form-control" id="judul_buku" name="judul_buku" required>
        </div>
        <div class="form-group">
            <label for="penulis_buku">Penulis Buku:</label>
            <input type="text" class="form-control" id="penulis_buku" name="penulis_buku" required>
        </div>
        <div class="form-group">
            <label for="penerbit_buku">Penerbit Buku:</label>
            <input type="text" class="form-control" id="penerbit_buku" name="penerbit_buku" required>
        </div>
        <div class="form-group">
            <label for="tahun_terbit">Tahun Terbit:</label>
            <input type="number" class="form-control" id="tahun_terbit" name="tahun_terbit" required>
        </div>
        <button type="submit" class="btn btn-primary">Tambah</button>
        <a href="tampil.php" class="btn btn-secondary  float-end">Kembali</a>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
