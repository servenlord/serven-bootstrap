<?php
session_start();
$userid = $_SESSION['userid']; 
include 'koneksi.php';

if(isset($_POST['tambah'])){
    $judulfoto =$_POST['judulfoto'];
    $deskripsifoto= $_POST['deskripsi'];
    $albumid = $_POST['albumid'];
    $tanggal = Date('Y-m-d');
    $foto = $_FILES['lokasifile']['name'];

    if($foto != null){
        $ekstensi_boleh=array('jpg','png');
        $x=explode('.',$foto);
        $ekstensi=strtolower(end($x));
        $tmp_file=$_FILES['lokasifile']['tmp_name'];
        $angka_rand=rand(1,999);
        $lokasifoto=$angka_rand.'-'.$foto;

        if(in_array($ekstensi,$ektensi_bole)===true){
            move_uploaded_file($tmp_file,"../assets/foto/" . $lokasifoto);
        }
    }
}
?>