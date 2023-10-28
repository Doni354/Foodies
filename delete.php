<?php
// Konfigurasi koneksi database
$host = 'localhost';
$user = 'root'; // Ganti dengan username database Anda
$pass = ''; // Ganti dengan password database Anda
$dbname = 'shop_db'; // Ganti dengan nama database Anda

// Buat koneksi ke database
$conn = new mysqli($host, $user, $pass, $dbname);

// Periksa koneksi database
if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}

if (isset($_GET['order_id'])) {
    // ambil id dari query string
    $id = $_GET['order_id'];

    // buat query hapus
    $sql = "DELETE FROM `order` WHERE order_id = $id"; // Sesuaikan dengan nama tabel dan kolom yang benar

    if ($conn->query($sql) === TRUE) {
        header('Location: order.php');
    } else {
        die("Gagal menghapus: " . $conn->error);
    }
} else {
    die("Akses dilarang...");
}

// Tutup koneksi database
$conn->close();
?>
