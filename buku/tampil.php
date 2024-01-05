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
    <title>Daftar Buku</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
<?php include('../index.php'); ?>
    <h2>Daftar Buku</h2>
    <a href="tambah.php" class="btn btn-primary mb-3">Tambah Buku</a>
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID Buku</th>
                <th>Judul Buku</th>
                <th>Penulis Buku</th>
                <th>Penerbit Buku</th>
                <th>Tahun Terbit</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
                // Sertakan file koneksi.php
                include('../koneksi.php');

                // Query untuk mendapatkan data buku
                $query = "SELECT * FROM Buku";
                $result = $conn->query($query);

                // Tampilkan data buku
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$row['id_buku']}</td>";
                    echo "<td>{$row['judul_buku']}</td>";
                    echo "<td>{$row['penulis']}</td>";
                    echo "<td>{$row['penerbit']}</td>";
                    echo "<td>{$row['tahun_terbit']}</td>";
                    echo "<td>
                            <a href='ubah.php?id={$row['id_buku']}' class='btn btn-warning'>Ubah</a>
                            <a href='hapus.php?id={$row['id_buku']}' class='btn btn-danger'>Hapus</a>
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
