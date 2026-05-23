<?php
include 'cek_login.php';
include 'koneksi.php';

if ($_SESSION['role'] != 'admin') {
    die("Akses ditolak");
}

$id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM produk WHERE id=?");

$stmt->bind_param("i", $id);

$stmt->execute();

header("Location: index.php");
?>