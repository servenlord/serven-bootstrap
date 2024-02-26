<?php 
include '../config/koneksi.php';
session_start();
if (!isset($_SESSION['userid'])) {
    echo "<script>alert('Anda harus login untuk Melakukan Like dan Komentar');window.location='../index.php'</script>";
}

$fotoid = $_POST['fotoid'];
$userid = $_SESSION['userid'];
$isikomentar = $_POST['isikomentar'];
$tanggalkomentar = date('Y-m-d');

$query = mysqli_query($con,"INSERT INTO komentarfoto VALUES ('', '$fotoid', '$userid', '$isikomentar','$tanggalkomentar')");

echo "<script>location.href='../user/index.php';</script>";
?>