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
    <title>Tambah Peminjaman</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Tambah Peminjaman</h2>

    <?php
    // Sertakan file koneksi.php
    include('../koneksi.php');

    // Proses tambah peminjaman
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Ambil data dari formulir
        $id_pengguna = $_POST['id_pengguna'];
        $id_buku = $_POST['id_buku'];
        $tanggal_peminjaman = $_POST['tanggal_peminjaman'];
        $tanggal_pengembalian = $_POST['tanggal_pengembalian'];

        // Query untuk menambahkan peminjaman
        $query = "INSERT INTO Peminjaman (id_pengguna, id_buku, tanggal_peminjaman, tanggal_pengembalian) 
                    VALUES ('$id_pengguna', '$id_buku', '$tanggal_peminjaman', '$tanggal_pengembalian')";

        if ($conn->query($query) === TRUE) {
            // Redirect kembali ke tampil.php setelah berhasil menambahkan peminjaman
            header("Location: tampil.php");
            exit();
        } else {
            echo "Error: " . $query . "<br>" . $conn->error;
        }
    }
    ?>

    <form action="tambah.php" method="POST">
        <div class="form-group">
            <label for="id_pengguna">Pengguna:</label>
            <select class="form-control" id="id_pengguna" name="id_pengguna" required>
                <?php
                // Query untuk mendapatkan data pengguna
                $query_pengguna = "SELECT * FROM Pengguna";
                $result_pengguna = $conn->query($query_pengguna);

                // Tampilkan data pengguna sebagai pilihan dropdown
                while ($row_pengguna = $result_pengguna->fetch_assoc()) {
                    echo "<option value='{$row_pengguna['id_pengguna']}'>{$row_pengguna['nama_pengguna']}</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="id_buku">Buku:</label>
            <select class="form-control" id="id_buku" name="id_buku" required>
                <?php
                // Query untuk mendapatkan data buku
                $query_buku = "SELECT * FROM Buku";
                $result_buku = $conn->query($query_buku);

                // Tampilkan data buku sebagai pilihan dropdown
                while ($row_buku = $result_buku->fetch_assoc()) {
                    echo "<option value='{$row_buku['id_buku']}'>{$row_buku['judul_buku']}</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="tanggal_peminjaman">Tanggal Peminjaman:</label>
            <input type="date" class="form-control" id="tanggal_peminjaman" name="tanggal_peminjaman" required>
        </div>
        <div class="form-group">
            <label for="tanggal_pengembalian">Tanggal Pengembalian:</label>
            <input type="date" class="form-control" id="tanggal_pengembalian" name="tanggal_pengembalian" required>
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
