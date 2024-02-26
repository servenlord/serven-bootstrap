<?php
session_start();
include 'koneksi.php';
if (isset($_POST['tambah'])) {
    $judulfoto = $_POST['judulfoto'];
    $deskripsi = $_POST['deskripsi'];
    $tanggalunggah = date('Y-m-d');
    $albumid = $_POST['albumid'];
    $userid = $_SESSION['userid'];
    $foto = $_FILES['lokasifile']['name'];
    if ($foto != null) {
        $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg', 'jfif');
        $x = explode('.', $foto);
        $ekstensi = strtolower(end($x));
        $file_tmp = $_FILES['lokasifile']['tmp_name'];
        $angka_acak     = rand(1, 999);
        $nama_gambar_baru = $angka_acak . '-' . $foto;
        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            move_uploaded_file($file_tmp, '../assets/foto/' . $nama_gambar_baru);
            $query = "INSERT INTO foto (JudulFoto, DeskripsiFoto, TanggalUnggah, LokasiFile, AlbumID, UserID) VALUES ('$judulfoto', '$deskripsi', '$tanggalunggah', '$nama_gambar_baru', $albumid, $userid)";
            $result = mysqli_query($con, $query);
            echo "<script>alert('Data berhasil ditambah.');window.location='../user/foto.php';</script>";
        } else {
            //jika file ekstensi tidak jpg dan png maka alert ini yang tampil
            echo "<script>alert('Ekstensi gambar yang boleh hanya jpg, png, jpeg, jfif.');window.location='../user/foto.php';</script>";
        }
    }
}

if (isset($_POST['edit'])) {
    $fotoid = $_POST['fotoid'];
    $judulfoto = $_POST['judulfoto'];
    $deskripsi = $_POST['deskripsi'];
    $tanggalunggah = date('Y-m-d');
    $albumid = $_POST['albumid'];
    $userid = $_SESSION['userid'];
    $foto = $_FILES['lokasifile']['name'];

    if ($foto == null) {
        $sql = mysqli_query($con, "UPDATE foto SET JudulFoto='$judulfoto', DeskripsiFoto='$deskripsi', TanggalUnggah='$tanggalunggah', AlbumID=$albumid WHERE FotoID='$fotoid'");
        echo "<script>alert('Update data berhasil.');window.location='../user/foto.php';</script>";
    } else {
        $query = mysqli_query($con, "SELECT * FROM foto WHERE FotoID = $fotoid");
        $data = mysqli_fetch_array($query);
        if (is_file('../assets/foto/' . $data['LokasiFile'])) {
            unlink('../assets/foto/' . $data['LokasiFile']);
        }
        $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg', 'jfif');
        $x = explode('.', $foto);
        $ekstensi = strtolower(end($x));
        $file_tmp = $_FILES['lokasifile']['tmp_name'];
        $angka_acak     = rand(1, 999);
        $nama_gambar_baru = $angka_acak . '-' . $foto;
        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            move_uploaded_file($file_tmp, '../assets/foto/' . $nama_gambar_baru);
            $query = "UPDATE foto SET JudulFoto='$judulfoto', DeskripsiFoto='$deskripsi', TanggalUnggah='$tanggalunggah', LokasiFile='$nama_gambar_baru', AlbumID=$albumid WHERE FotoID='$fotoid'";
            $result = mysqli_query($con, $query);
            echo "<script>alert('Update data berhasil.');window.location='../user/foto.php';</script>";
        } else {
            //jika file ekstensi tidak jpg dan png maka alert ini yang tampi
            echo "<script>alert('Ekstensi gambar yang boleh hanya jpg, png, jpeg, jfif.');window.location='../user/foto.php';</script>";
        }
    }
}

if (isset($_POST['hapus'])) {
    $fotoid = $_POST['fotoid'];
    $query = mysqli_query($con, "SELECT * FROM foto WHERE FotoID = $fotoid");
        $data = mysqli_fetch_array($query);
        if (is_file('../assets/foto/' . $data['LokasiFile'])) {
            unlink('../assets/foto/' . $data['LokasiFile']);
        }
    $hapusfoto = mysqli_query($con, "DELETE FROM foto WHERE FotoID=$fotoid");
    echo "<script>alert('Hapus data berhasil.');window.location='../user/foto.php';</script>";
}
