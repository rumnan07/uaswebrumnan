<?php
session_start();

if($_SESSION['login'] == false){

    header('location: ../auth/login.php');

}
?>

<?php
// Sertakan file koneksi.php
include('../koneksi.php');

// Periksa apakah parameter id_pengguna diberikan
if (isset($_GET['id'])) {
    $id_pengguna = $_GET['id'];

    // Query untuk menghapus pengguna berdasarkan id_pengguna
    $query = "DELETE FROM Pengguna WHERE id_pengguna = $id_pengguna";
    if ($conn->query($query) === TRUE) {
        // Redirect kembali ke tampil.php setelah menghapus
        header("Location: tampil.php");
        exit();
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
} else {
    echo "<p>ID Pengguna tidak diberikan.</p>";
}

// Tutup koneksi
$conn->close();
?>
