<?php 
session_start();
session_destroy();
echo "<script>alert('Anda berhasil keluar.');window.location='../index.php';</script>";
exit;
?>