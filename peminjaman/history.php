<?php
// Sertakan file koneksi.php
include('../koneksi.php');

// Query untuk mendapatkan data peminjaman dengan informasi pengguna dan buku
$query = "SELECT Peminjaman.id_peminjaman, Pengguna.nama_pengguna, Buku.judul_buku, Peminjaman.tanggal_peminjaman, Peminjaman.tanggal_pengembalian FROM Peminjaman 
            JOIN Pengguna ON Peminjaman.id_pengguna = Pengguna.id_pengguna 
            JOIN Buku ON Peminjaman.id_buku = Buku.id_buku";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histori Peminjaman</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<?php include('../index.php'); ?>

<div class="container mt-5">
    <h2>Histori Peminjaman Buku</h2>
    
    <table class="table border">
        <thead>
            <tr>
                <th>ID Peminjaman</th>
                <th>Nama Pengguna</th>
                <th>Judul Buku</th>
                <th>Tanggal Peminjaman</th>
                <th>Tanggal Pengembalian</th>
            </tr>
        </thead>
        <tbody>
            <?php
                // Tampilkan data histori peminjaman
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$row['id_peminjaman']}</td>";
                    echo "<td>{$row['nama_pengguna']}</td>";
                    echo "<td>{$row['judul_buku']}</td>";
                    echo "<td>{$row['tanggal_peminjaman']}</td>";
                    echo "<td>{$row['tanggal_pengembalian']}</td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>

    <!-- Tombol Cetak -->
    <button class="btn btn-primary" onclick="cetakHistori()">Cetak Histori</button>
    <a href="tampil.php" class="btn btn-secondary  float-end">Kembali</a>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
function cetakHistori() {
    window.print();
}
</script>

</body>
</html>

<?php
// Tutup koneksi
$conn->close();
?>
