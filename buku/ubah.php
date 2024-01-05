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
    <title>Ubah Buku</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Ubah Buku</h2>

    <?php
    // Sertakan file koneksi.php
    include('../koneksi.php');

    // Periksa apakah parameter id_buku diberikan
    if (isset($_GET['id'])) {
        $id_buku = $_GET['id'];

        // Query untuk mendapatkan data buku berdasarkan id_buku
        $query = "SELECT * FROM Buku WHERE id_buku = $id_buku";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            ?>

            <?php
            // Proses ubah buku
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Ambil data dari formulir
                $judul_buku = $_POST['judul_buku'];
                $penulis_buku = $_POST['penulis_buku'];
                $penerbit_buku = $_POST['penerbit_buku'];
                $tahun_terbit = $_POST['tahun_terbit'];

                // Query untuk mengubah data buku
                $query = "UPDATE Buku SET judul_buku='$judul_buku', penulis='$penulis_buku', penerbit='$penerbit_buku', tahun_terbit='$tahun_terbit' WHERE id_buku=$id_buku";

                if ($conn->query($query) === TRUE) {
                    // Redirect kembali ke tampil.php setelah berhasil mengubah buku
                    header("Location: tampil.php");
                    exit();
                } else {
                    echo "Error: " . $query . "<br>" . $conn->error;
                }
            }
            ?>

            <form action="ubah.php?id=<?php echo $id_buku; ?>" method="POST">
                <div class="form-group">
                    <label for="judul_buku">Judul Buku:</label>
                    <input type="text" class="form-control" id="judul_buku" name="judul_buku" value="<?php echo $row['judul_buku']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="penulis">Penulis Buku:</label>
                    <input type="text" class="form-control" id="penulis" name="penulis" value="<?php echo $row['penulis']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="penerbit">Penerbit Buku:</label>
                    <input type="text" class="form-control" id="penerbit" name="penerbit" value="<?php echo $row['penerbit']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="tahun_terbit">Tahun Terbit:</label>
                    <input type="number" class="form-control" id="tahun_terbit" name="tahun_terbit" value="<?php echo $row['tahun_terbit']; ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="tampil.php" class="btn btn-secondary  float-end">Kembali</a>
            </form>

            <?php
        } else {
            echo "<p>Data tidak ditemukan.</p>";
        }
    } else {
        echo "<p>ID Buku tidak diberikan.</p>";
    }

    // Tutup koneksi
    $conn->close();
    ?>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
