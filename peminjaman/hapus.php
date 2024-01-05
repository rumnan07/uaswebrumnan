<?php
session_start();

if($_SESSION['login'] == false){

    header('location: ../auth/login.php');

}
?>

<?php
include('../koneksi.php');

// Periksa apakah parameter id_peminjaman diberikan
if (isset($_GET['id'])) {
    $id_peminjaman = $_GET['id'];

    // Query untuk menghapus data peminjaman berdasarkan id_peminjaman
    $query = "DELETE FROM Peminjaman WHERE id_peminjaman = $id_peminjaman";

    if ($conn->query($query) === TRUE) {
        // Redirect kembali ke tampil.php setelah berhasil menghapus peminjaman
        header("Location: tampil.php");
        exit();
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
} else {
    echo "<p>ID Peminjaman tidak diberikan.</p>";
}

// Tutup koneksi
$conn->close();
?>
