<?php

$host = "localhost";
$username = "root";
$password = ""; 
$database = "uaswebrumnan";

// Membuat koneksi ke database
$conn = new mysqli($host, $username, $password, $database);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Set karakter set ke UTF-8
$conn->set_charset("utf8");

?>
