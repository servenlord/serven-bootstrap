<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap demo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
  <nav class="py-2 bg-body-tertiary border-bottom">
    <div class="container d-flex flex-wrap">
      <ul class="nav me-auto">
        <li class="nav-item"><a href="index.php" class="nav-link link-body-emphasis px-2 active" aria-current="page">Beranda</a></li>
      </ul>
      <ul class="nav">
        <li class="nav-item"><a href="login.php" class="btn btn-outline-primary m-1 active">Masuk</a></li>
        <li class="nav-item"><a href="register.php" class="btn btn btn-outline-primary m-1">Daftar</a></li>
      </ul>
    </div>
  </nav>
  <header class="py-3 mb-4 border-bottom">
    <div class="container d-flex flex-wrap justify-content-center">
      <a href="#" class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto link-body-emphasis text-decoration-none">
        <span class="fs-4">GaleriFoto</span>
      </a>
    </div>
  </header>
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-md-5">
        <div class="card">
          <div class="card-body bg-light">
            <div class="text-center">
              <h5>Login Aplikasi</h5>
            </div>
            <form action="config/aksi_login.php" method="POST">
              <label for="" class="form-label">Username</label>
              <input type="text" class="form-control" name="username" required>
              <label for="" class="form-label">Password</label>
              <input type="password" class="form-control" name="password" required>
              <div class="d-grid mt-2">
                <button class="btn btn-primary" type="submit" name="kirim">Masuk</button>
              </div>
            </form>
            <hr>
            <p>Belum punya akun? <a href="register.php">Daftar disini!</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <footer class="border-top mt-2 bg-light fixed-bottom">
    <div class="container justify-content-center d-flex">
      <p>&copy; About | Name </p>
    </div>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>