<?php 
include 'koneksi.php';
session_start();
if(isset($_POST['daftar'])){
    $username= $_POST['username'];
    $password= md5($_POST['password']);
    $email = $_POST['email'];
    $namalengkap = $_POST['namalengkap'];
    $alamat = $_POST['alamat'];
    

    $sql=mysqli_query($con,"SELECT * FROM user WHERE Username='$username' AND Email='$email'");
    $cek=mysqli_num_rows($sql);

    if($cek===0){
            $query=mysqli_query($con,"INSERT INTO user VALUES ('','$username','$password','$email','$namalengkap','$alamat')");
            echo "<script>alert('Anda Berhasil Mendaftar');window.location='../login.php';</script>";
        }else{
            echo "<script>alert('Username atau Email Sudah Terdaftar');window.location='../register.php';</script>";
        }  
    }
?>