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
    <title>Ubah Peminjaman</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Ubah Peminjaman</h2>

    <?php
    // Sertakan file koneksi.php
    include('../koneksi.php');

    // Periksa apakah parameter id_peminjaman diberikan
    if (isset($_GET['id'])) {
        $id_peminjaman = $_GET['id'];

        // Query untuk mendapatkan data peminjaman dengan informasi pengguna dan buku
        $query = "SELECT Peminjaman.id_peminjaman, Peminjaman.id_pengguna, Peminjaman.id_buku, Pengguna.nama_pengguna, Buku.judul_buku, Peminjaman.tanggal_peminjaman, Peminjaman.tanggal_pengembalian 
                    FROM Peminjaman 
                    JOIN Pengguna ON Peminjaman.id_pengguna = Pengguna.id_pengguna 
                    JOIN Buku ON Peminjaman.id_buku = Buku.id_buku 
                    WHERE Peminjaman.id_peminjaman = $id_peminjaman";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            ?>

            <?php
            // Proses ubah peminjaman
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Ambil data dari formulir
                $id_pengguna = $_POST['id_pengguna'];
                $id_buku = $_POST['id_buku'];
                $tanggal_peminjaman = $_POST['tanggal_peminjaman'];
                $tanggal_pengembalian = $_POST['tanggal_pengembalian'];

                // Query untuk mengubah data peminjaman
                $query = "UPDATE Peminjaman SET id_pengguna=$id_pengguna, id_buku=$id_buku, tanggal_peminjaman='$tanggal_peminjaman', tanggal_pengembalian='$tanggal_pengembalian' WHERE id_peminjaman=$id_peminjaman";

                if ($conn->query($query) === TRUE) {
                    // Redirect kembali ke tampil.php setelah berhasil mengubah peminjaman
                    header("Location: tampil.php");
                    exit();
                } else {
                    echo "Error: " . $query . "<br>" . $conn->error;
                }
            }
            ?>

            <form action="ubah.php?id=<?php echo $id_peminjaman; ?>" method="POST">
                <div class="form-group">
                    <label for="id_pengguna">Pengguna:</label>
                    <select class="form-control" id="id_pengguna" name="id_pengguna" required>
                        <?php
                        // Ambil data pengguna
                        $query_pengguna = "SELECT * FROM Pengguna";
                        $result_pengguna = $conn->query($query_pengguna);

                        while ($row_pengguna = $result_pengguna->fetch_assoc()) {
                            $selected = ($row_pengguna['id_pengguna'] == $row['id_pengguna']) ? 'selected' : '';
                            echo "<option value='{$row_pengguna['id_pengguna']}' $selected>{$row_pengguna['nama_pengguna']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="id_buku">Buku:</label>
                    <select class="form-control" id="id_buku" name="id_buku" required>
                        <?php
                        // Ambil data buku
                        $query_buku = "SELECT * FROM Buku";
                        $result_buku = $conn->query($query_buku);

                        while ($row_buku = $result_buku->fetch_assoc()) {
                            $selected = ($row_buku['id_buku'] == $row['id_buku']) ? 'selected' : '';
                            echo "<option value='{$row_buku['id_buku']}' $selected>{$row_buku['judul_buku']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tanggal_peminjaman">Tanggal Peminjaman:</label>
                    <input type="date" class="form-control" id="tanggal_peminjaman" name="tanggal_peminjaman" value="<?php echo $row['tanggal_peminjaman']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="tanggal_pengembalian">Tanggal Pengembalian:</label>
                    <input type="date" class="form-control" id="tanggal_pengembalian" name="tanggal_pengembalian" value="<?php echo $row['tanggal_pengembalian']; ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="tampil.php" class="btn btn-secondary  float-end">Kembali</a>
            </form>

            <?php
        } else {
            echo "<p>Data tidak ditemukan.</p>";
        }
    } else {
        echo "<p>ID Peminjaman tidak diberikan.</p>";
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
