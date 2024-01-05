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
    <title>Daftar Pengguna</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
<?php include('../index.php'); ?>
    <h2>Daftar Pengguna</h2>
    <a href="tambah.php" class="btn btn-primary mb-3 float-end">Tambah Pengguna</a> 
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Pengguna</th>
                <th>Email</th>
                <th>Alamat</th>
                <th>Telpon</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
                // Sertakan file koneksi.php
                include('../koneksi.php');

                // Query untuk mendapatkan data pengguna
                $query = "SELECT * FROM Pengguna";
                $result = $conn->query($query);

                // Tampilkan data pengguna
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$row['id_pengguna']}</td>";
                    echo "<td>{$row['nama_pengguna']}</td>";
                    echo "<td>{$row['email']}</td>"; // Perbaikan di sini
                    echo "<td>{$row['alamat']}</td>"; // Perbaikan di sini
                    echo "<td>{$row['telpon']}</td>"; // Perbaikan di sini
                    echo "<td>
                            <a href='ubah.php?id={$row['id_pengguna']}' class='btn btn-warning'>Ubah</a>
                            <a href='hapus.php?id={$row['id_pengguna']}' class='btn btn-danger'>Hapus</a>
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
