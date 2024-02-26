<?php
    session_start();
    include 'koneksi.php';
    if(isset($_POST['tambah'])){
        $namaalbum = $_POST['namaalbum'];
        $deskripsi = $_POST['deskripsi'];
        $tanggal = date('Y-m-d');
        $userid = $_SESSION['userid'];
        

        
        $sql = mysqli_query($con,"INSERT INTO album VALUES ('','$namaalbum','$deskripsi','$tanggal','$userid')");

        echo "<script>alert('Tambah data berhasil.');window.location='../user/album.php';</script>";

    }

    if(isset($_POST['edit'])){
        $albumid = $_POST['albumid'];
        $namaalbum = $_POST['namaalbum'];
        $deskripsi = $_POST['deskripsi'];

        

        
        $sql = mysqli_query($con,"UPDATE album SET NamaAlbum='$namaalbum', Deskripsi='$deskripsi' WHERE AlbumID='$albumid'");

        echo "<script>alert('Update data berhasil.');window.location='../user/album.php';</script>";

    }

    if(isset($_POST['hapus'])){
        $albumid = $_POST['albumid'];
        $hapusfoto = mysqli_query($con,"DELETE FROM foto WHERE AlbumID='$albumid'");
        $hapusalbum = mysqli_query($con,"DELETE FROM album WHERE AlbumID='$albumid'");

        echo "<script>alert('Hapus data berhasil.');window.location='../user/album.php';</script>";

    }

?>