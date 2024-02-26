<?php
include '../config/koneksi.php';
session_start();
if (!isset($_SESSION['userid'])) {
    echo "<script>alert('Anda harus login untuk Melakukan Like dan Komentar');window.location='../index.php'</script>";
}

$fotoid = $_GET['fotoid'];
$userid = $_SESSION['userid'];

$ceksuka = mysqli_query($con,"SELECT * FROM likefoto WHERE FotoID=$fotoid AND UserID=$userid");

if(mysqli_num_rows($ceksuka)==1){
    while($row = mysqli_fetch_array($ceksuka)){
        $likeid = $row['LikeID'];
        $query = mysqli_query($con,"DELETE FROM likefoto WHERE LikeID=$likeid");
        echo "<script>location.href='../user/index.php';</script>";
    }
}else{
    $tanggallike = date('Y-m-d');
$query = mysqli_query($con,"INSERT INTO likefoto VALUES ('', '$fotoid', '$userid','$tanggallike')");

echo "<script>
location.href='../user/index.php'</script>";
}
?>