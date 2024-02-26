<?php
include '../config/koneksi.php';
session_start();
$userid = $_SESSION['userid'];
if (!isset($_SESSION['userid'])) {
    echo "<script>alert('Anda harus login untuk mengakses halaman ini');window.location='../login.php'</script>";
} ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Website Galeri Foto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <nav class="py-2 bg-body-tertiary border-bottom">
        <div class="container d-flex flex-wrap">
            <ul class="nav me-auto">
                <li class="nav-item"><a href="index.php" class="nav-link link-body-emphasis px-2" aria-current="page">Beranda</a></li>
                <li class="nav-item"><a href="home.php" class="nav-link link-body-emphasis px-2" aria-current="page">Galeri Saya</a></li>
                <li class="nav-item"><a href="album.php" class="nav-link link-body-emphasis px-2 active" aria-current="page">Album</a></li>
                <li class="nav-item"><a href="foto.php" class="nav-link link-body-emphasis px-2" aria-current="page">Foto</a></li>
            </ul>
            <ul class="nav">
                <li class="nav-item"><a href="../config/aksi_logout.php" class="btn btn-outline-danger m-1">Keluar</a></li>
            </ul>
        </div>
    </nav>
    <header class="py-3 border-bottom">
        <div class="container d-flex justify-content-center">
            <a href="#" class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto link-body-emphasis text-decoration-none">
                <span class="fs-4">Album Saya</span>
            </a>
        </div>
    </header>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card mt-2">
                    <div class="card-header">Tambah Album</div>
                        <div class="card-body">
                            <form action="../config/aksi_album.php" method="POST">
                                <label for="" class="form-label">Nama Album</label>
                                <input type="text" class="form-control" name="namaalbum" required>
                                <label for="" class="form-label">Deskripsi</label>
                                <textarea name="deskripsi" class="form-control" required></textarea>
                                <button type="submit" name="tambah" class="btn btn-primary mt-2">Tambah Album</button>
                            </form>
                        </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card mt-2">
                    <div class="card-header">Data Album</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Album</th>
                                        <th>Deskripsi</th>
                                        <th>Tanggal Dibuat</th>
                                        <th>Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    $query = mysqli_query($con, "SELECT * FROM album WHERE UserID=$userid");
                                    while ($data = mysqli_fetch_array($query)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><?php echo $data['NamaAlbum']; ?></td>
                                            <td><?php echo $data['Deskripsi']; ?></td>
                                            <td><?php echo $data['TanggalDibuat'];
                                             ?></td>
                                            <td>
                                                <!-- Button trigger modal -->
                                                <button type="submit" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ubah<?php echo $data['AlbumID'];?>">
                                                    Ubah
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="ubah<?php echo $data['AlbumID'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Data</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="../config/aksi_album.php" method="POST">
                                                                    <input type="hidden" name="albumid" value="<?php echo $data['AlbumID'];?>">
                                                                    <label for="" class="form-label">Nama Album</label>
                                                                    <input type="text" class="form-control" name="namaalbum" value="<?php echo $data['NamaAlbum'];?>" required>
                                                                    <label for="" class="form-label">Deskripsi</label>
                                                                    <textarea name="deskripsi" class="form-control" required><?php echo $data['Deskripsi'];?>
                                                                    </textarea>
                                                                
                                                            </div>
                                                            <div class="modal-footer">
                                                                
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                <button type="submit" name="edit" class="btn btn-success">Ubah Album</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapus<?php echo $data['AlbumID'];?>">
                                                    Hapus
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="hapus<?php echo $data['AlbumID'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="../config/aksi_album.php" method="POST">
                                                                    <input type="hidden" name="albumid" value="<?php echo $data['AlbumID'];?>">
                                                                    Apakah anda yakin ingin menghapus data <strong><?php echo $data['NamaAlbum'];?></strong> beserta foto yang ada didalamnya.
                                                                
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                <button type="submit" name="hapus" class="btn btn-danger">Hapus Album</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </td>
                                            <?php }?>
                                        </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="border-top bg-light fixed-bottom">
        <div class="container justify-content-center d-flex">
            <p class="mt-2 fw-lighter>&copy; About | Name </p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>