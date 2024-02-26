<?php
include '../config/koneksi.php';
session_start();
if (!isset($_SESSION['userid'])) {
    echo "<script>alert('Anda harus login untuk mengakses halaman ini');window.location='../login.php'</script>";
}
$userid = $_SESSION['userid']; ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Website Galeri Foto</title>
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <nav class="py-2 bg-body-tertiary border-bottom">
        <div class="container d-flex flex-wrap">
            <ul class="nav me-auto">
                <li class="nav-item"><a href="index.php" class="nav-link link-body-emphasis px-2  active" aria-current="page">Beranda</a></li>
                <li class="nav-item"><a href="home.php" class="nav-link link-body-emphasis px-2" aria-current="page">Galeri Saya</a></li>
                <li class="nav-item"><a href="album.php" class="nav-link link-body-emphasis px-2" aria-current="page">Album</a></li>
                <li class="nav-item"><a href="foto.php" class="nav-link link-body-emphasis px-2" aria-current="page">Foto</a></li>
            </ul>
            <ul class="nav">
                <li class="nav-item"><a href="../config/aksi_logout.php" class="btn btn-outline-danger m-1">Keluar</a></li>
            </ul>
        </div>
    </nav>
    <header class="py-3 mb-4 border-bottom">
        <div class="container d-flex flex-wrap justify-content-center">
            <a href="#" class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto link-body-emphasis text-decoration-none">
                <span class="fs-4">Galeri Foto Saya</span>
            </a>
        </div>
    </header>
    <div class="container mt-3 py-5">
        Album:
        <?php
        $album = mysqli_query($con, "SELECT * FROM album");
        while ($row = mysqli_fetch_array($album)) { ?>
            <a href="home.php?albumid=<?php echo $row['AlbumID']; ?>" class="btn btn-outline-primary active"><?php echo $row['NamaAlbum']; ?></a>
        <?php } ?>
        <div class="row">
            <?php
            if (isset($_GET['albumid'])) {
                $albumid = $_GET['albumid'];
                $query = mysqli_query($con, "SELECT * FROM foto INNER JOIN user ON foto.UserID=user.UserID INNER JOIN album ON foto.AlbumID = album.AlbumID WHERE foto.AlbumID='$albumid'");
                while ($data = mysqli_fetch_array($query)) { ?>
                    <div class="col-md-3 mt-2">
                        <a data-bs-toggle="modal" data-bs-target="#komentar<?php echo $data['FotoID']; ?>">
                            <div class="card mb-2">
                                <img class="card-img-top img-fluid" style="object-fit: cover;" src="../assets/foto/<?php echo $data['LokasiFile']; ?>" title="<?php echo $data['JudulFoto']; ?>">
                                <div class="card-footer text-center">
                                    <?php
                                    $fotoid = $data['FotoID'];
                                    $ceksuka = mysqli_query($con, "SELECT * FROM likefoto WHERE FotoID=$fotoid AND UserID='$userid'");
                                    if (mysqli_num_rows($ceksuka) == 1) { ?>
                                        <a href="../config/proses_like_index.php?fotoid=<?php echo $data['FotoID']; ?>" type="submit" name="batalsuka"><i class="fa fa-heart"></i></a>
                                    <?php } else { ?>
                                        <a href="../config/proses_like_index.php?fotoid=<?php echo $data['FotoID']; ?>" type="submit" name="suka"><i class="fa-regular fa-heart"></i></a>
                                    <?php }
                                    $like = mysqli_query($con, "SELECT * FROM likefoto WHERE FotoID=$fotoid");
                                    echo mysqli_num_rows($like) . ' Suka';
                                    ?>
                                    <a data-bs-toggle="modal" href="#" data-bs-target="#komentar<?php echo $data['FotoID']; ?>">
                                        <i class="fa-regular fa-comment"></i></a>
                                    <?php $jmlkomen = mysqli_query($con, "SELECT * FROM komentarfoto WHERE FotoID=$fotoid");
                                    echo mysqli_num_rows($jmlkomen) . 'Komentar';
                                    ?>
                                </div>
                            </div>
                        </a>
                        <!-- Modal -->
                        <div class="modal fade" id="komentar<?php echo $data['FotoID']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <img class="card-img-top" src="../assets/foto/<?php echo $data['LokasiFile']; ?>" title="<?php echo $data['JudulFoto']; ?>">
                                            </div>
                                            <div class="col-md-4">
                                                <div class="m-2">
                                                    <div class="overflow-auto">
                                                        <div class="sticky-top">
                                                            <strong><?php echo $data['JudulFoto']; ?></strong>
                                                            <span class="badge bg-secondary"><?php echo $data['NamaLengkap']; ?></span>
                                                            <span class="badge bg-success"><?php echo $data['TanggalUnggah']; ?></span>
                                                            <span class="badge bg-primary"><?php echo $data['NamaAlbum']; ?></span>
                                                        </div>
                                                        <hr>
                                                        <p align="left"><strong>Deskripsi: </strong><?php echo $data['DeskripsiFoto']; ?></p>
                                                        <hr>
                                                        <?php
                                                        $fotoid = $data['FotoID'];
                                                        $komentar = mysqli_query($con, "SELECT * FROM komentarfoto INNER JOIN user ON komentarfoto.UserID = user.UserID WHERE komentarfoto.FotoID = $fotoid");
                                                        while ($row = mysqli_fetch_array($komentar)) {
                                                        ?>
                                                            <p><strong><?php echo $row['NamaLengkap']; ?></strong>
                                                                <?php echo $row['IsiKomentar']; ?>
                                                            </p>
                                                        <?php } ?>
                                                        <hr>
                                                        <div class="sticky-bottom">
                                                            <form action="../config/proses_komentar_index.php" method="POST">
                                                                <div class="input-group">
                                                                    <input type="hidden" name="fotoid" value="<?php echo $data['FotoID'] ?>">
                                                                    <input type="text" name="isikomentar" class="form-control" placeholder="Tambah Komentar">
                                                                    <div class="input-group-prepend">
                                                                        <button type="submit" name="kirimkomentar" class="btn btn-outline-primary">Kirim</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
            } else {
                $query = mysqli_query($con, "SELECT * FROM foto INNER JOIN user ON foto.UserID=user.UserID INNER JOIN album ON foto.AlbumID = album.AlbumID");
                while ($data = mysqli_fetch_array($query)) {
                ?>
                    <div class="col-md-3 mt-2">
                        <a data-bs-toggle="modal" data-bs-target="#komentar<?php echo $data['FotoID']; ?>">
                            <div class="card mb-2">
                                <img class="card-img-top img-fluid" style="object-fit: cover;" src="../assets/foto/<?php echo $data['LokasiFile']; ?>" title="<?php echo $data['JudulFoto']; ?>">
                                <div class="card-footer text-center">
                                    <?php
                                    $fotoid = $data['FotoID'];
                                    $ceksuka = mysqli_query($con, "SELECT * FROM likefoto WHERE FotoID=$fotoid AND UserID='$userid'");
                                    if (mysqli_num_rows($ceksuka) == 1) { ?>
                                        <a href="../config/proses_like_index.php?fotoid=<?php echo $data['FotoID']; ?>" type="submit" name="batalsuka"><i class="fa fa-heart"></i></a>
                                    <?php } else { ?>
                                        <a href="../config/proses_like_index.php?fotoid=<?php echo $data['FotoID']; ?>" type="submit" name="suka"><i class="fa-regular fa-heart"></i></a>
                                    <?php }
                                    $like = mysqli_query($con, "SELECT * FROM likefoto WHERE FotoID=$fotoid");
                                    echo mysqli_num_rows($like) . ' Suka';
                                    ?>
                                    <a data-bs-toggle="modal" href="#" data-bs-target="#komentar<?php echo $data['FotoID']; ?>">
                                        <i class="fa-regular fa-comment"></i></a>
                                    <?php $jmlkomen = mysqli_query($con, "SELECT * FROM komentarfoto WHERE FotoID=$fotoid");
                                    echo mysqli_num_rows($jmlkomen) . 'Komentar';
                                    ?>
                                </div>
                            </div>
                        </a>
                        <!-- Modal -->
                        <div class="modal fade" id="komentar<?php echo $data['FotoID']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <img class="card-img-top" src="../assets/foto/<?php echo $data['LokasiFile']; ?>" title="<?php echo $data['JudulFoto']; ?>">
                                            </div>
                                            <div class="col-md-4">
                                                <div class="m-2">
                                                    <div class="overflow-auto">
                                                        <div class="sticky-top">
                                                            <strong><?php echo $data['JudulFoto']; ?></strong>
                                                            <span class="badge bg-secondary"><?php echo $data['NamaLengkap']; ?></span>
                                                            <span class="badge bg-success"><?php echo $data['TanggalUnggah']; ?></span>
                                                            <span class="badge bg-primary"><?php echo $data['NamaAlbum']; ?></span>
                                                        </div>
                                                        <hr>
                                                        <p align="left"><strong>Deskripsi: </strong><?php echo $data['DeskripsiFoto']; ?></p>
                                                        <hr>
                                                        <?php
                                                        $fotoid = $data['FotoID'];
                                                        $komentar = mysqli_query($con, "SELECT * FROM komentarfoto INNER JOIN user ON komentarfoto.UserID = user.UserID WHERE komentarfoto.FotoID = $fotoid");
                                                        while ($row = mysqli_fetch_array($komentar)) {
                                                        ?>
                                                            <p><strong><?php echo $row['NamaLengkap']; ?></strong>
                                                                <?php echo $row['IsiKomentar']; ?>
                                                            </p>
                                                        <?php } ?>
                                                        <hr>
                                                        <div class="sticky-bottom">
                                                            <form action="../config/proses_komentar_index.php" method="POST">
                                                                <div class="input-group">
                                                                    <input type="hidden" name="fotoid" value="<?php echo $data['FotoID'] ?>">
                                                                    <input type="text" name="isikomentar" class="form-control" placeholder="Tambah Komentar">
                                                                    <div class="input-group-prepend">
                                                                        <button type="submit" name="kirimkomentar" class="btn btn-outline-primary">Kirim</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php }
            } ?>
        </div>
    </div>

    <footer class="border-top mt-2 bg-light fixed-bottom">
        <div class="container justify-content-center d-flex">
            <p class="mt-2 fw-lighter>&copy; About | Name </p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>