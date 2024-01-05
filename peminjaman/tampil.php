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
    <title>Daftar Peminjaman</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
<?php include('../index.php'); ?>
    <h2>Daftar Peminjaman</h2>
    <a href="tambah.php" class="btn btn-primary mb-3">Tambah Peminjaman</a>
    <a href="history.php" class="btn btn-success mb-3">Riwayat</a>
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID Peminjaman</th>
                <th>Nama Pengguna</th>
                <th>Judul Buku</th>
                <th>Tanggal Peminjaman</th>
                <th>Tanggal Pengembalian</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
                // Sertakan file koneksi.php
                include('../koneksi.php');

                // Query untuk mendapatkan data peminjaman dengan informasi pengguna dan buku
                $query = "SELECT Peminjaman.id_peminjaman, Pengguna.nama_pengguna, Buku.judul_buku, Peminjaman.tanggal_peminjaman, Peminjaman.tanggal_pengembalian FROM Peminjaman 
                            JOIN Pengguna ON Peminjaman.id_pengguna = Pengguna.id_pengguna 
                            JOIN Buku ON Peminjaman.id_buku = Buku.id_buku";
                $result = $conn->query($query);

                // Tampilkan data peminjaman
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$row['id_peminjaman']}</td>";
                    echo "<td>{$row['nama_pengguna']}</td>";
                    echo "<td>{$row['judul_buku']}</td>";
                    echo "<td>{$row['tanggal_peminjaman']}</td>";
                    echo "<td>{$row['tanggal_pengembalian']}</td>";
                    echo "<td>
                            <a href='ubah.php?id={$row['id_peminjaman']}' class='btn btn-warning'>Ubah</a>
                            <a href='hapus.php?id={$row['id_peminjaman']}' class='btn btn-danger'>Hapus</a>
                            </td>";
                    echo "</tr>";
                }

                // Tutup koneksi
                $conn->close();
            ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
