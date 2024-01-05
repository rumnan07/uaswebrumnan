<?php
session_start();

if($_SESSION['login'] == false){

    header('location: ../auth/login.php');

}
?>

<?php
// Sertakan file koneksi.php
include('../koneksi.php');

// Periksa apakah parameter id_buku diberikan
if (isset($_GET['id'])) {
    $id_buku = $_GET['id'];

    // Query untuk menghapus data buku berdasarkan id_buku
    $query = "DELETE FROM Buku WHERE id_buku = $id_buku";

    if ($conn->query($query) === TRUE) {
        // Redirect kembali ke tampil.php setelah berhasil menghapus buku
        header("Location: tampil.php");
        exit();
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
} else {
    echo "<p>ID Buku tidak diberikan.</p>";
}

// Tutup koneksi
$conn->close();
?>
