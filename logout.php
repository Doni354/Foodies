<?php

$servername = "localhost"; // Ganti dengan nama server database Anda
$username = "root"; // Ganti dengan nama pengguna database Anda
$password = ""; // Ganti dengan kata sandi database Anda
$database = "shop_db"; // Ganti dengan nama database Anda

// Membuat koneksi ke database
$conn = new mysqli($servername, $username, $password, $database);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Nama tabel yang akan dihapus semua data
$tableName = "cart";

// Query SQL untuk menghapus semua data dari tabel
$sql = "DELETE FROM $tableName";

if ($conn->query($sql) === TRUE) {
    echo "Semua data dalam tabel berhasil dihapus";
} else {
    echo "Error: " . $conn->error;
}

// Menutup koneksi database
$conn->close();
?>
<?php
session_start();
session_destroy();
header("Location: login.php");
exit();

?>
