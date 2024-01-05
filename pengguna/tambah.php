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
    <title>Tambah Pengguna</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Tambah Pengguna</h2>

    <?php
    // Sertakan file koneksi.php
    include('../koneksi.php');

    // Proses tambah pengguna
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Ambil data dari formulir
        $nama = $_POST['nama_pengguna'];
        $email = $_POST['email'];
        $alamat = $_POST['alamat'];
        $telpon = $_POST['telpon'];

        // Query untuk menambahkan pengguna
        $query = "INSERT INTO Pengguna (nama_pengguna, email, alamat, telpon) VALUES ('$nama', '$email', '$alamat', '$telpon')";

        if ($conn->query($query) === TRUE) {
            // Redirect kembali ke tampil.php setelah berhasil menambahkan pengguna
            header("Location: tampil.php");
            exit();
        } else {
            echo "Error: " . $query . "<br>" . $conn->error;
        }
    }
    ?>

    <form action="tambah.php" method="POST">
        <div class="form-group">
            <label for="nama_pengguna">Nama Pengguna:</label>
            <input type="text" class="form-control" id="nama_pengguna" name="nama_pengguna" required>
        </div>
        <div class="form-group">
            <label for="email">Email Pengguna:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat Pengguna:</label>
            <textarea class="form-control" id="alamat" name="alamat"></textarea>
        </div>
        <div class="form-group">
            <label for="telpon">Telepon Pengguna:</label>
            <input type="tel" class="form-control" id="telpon" name="telpon">
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
