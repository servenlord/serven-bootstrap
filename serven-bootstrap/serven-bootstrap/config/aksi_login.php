<?php 
include 'koneksi.php';
session_start();
if(isset($_POST['kirim'])){
    $username= $_POST['username'];
    $password= md5($_POST['password']);

    $sql=mysqli_query($con,"SELECT * FROM user WHERE Username='$username' AND Password='$password'");
    $cek=mysqli_num_rows($sql);

    if($cek===1){
        while($data=mysqli_fetch_array($sql)){
            $_SESSION['userid'] = $data['UserID'];
            $_SESSION['username'] =$data['Username'];
            $username = $data['Username'];
        }
        echo "<script>alert('Selamat datang user $username');location.href='../user/index.php';</script>";
    }else{
        echo "<script>alert('Password Atau Username Salah');location.href='../login.php'</script>";
    }
}
?>