<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>GURINDAM</title>

  <link rel="stylesheet" href="assets/bootstrap-4.6.0-dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets_forum/assets/css/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.24/datatables.min.css" />
  <link rel="stylesheet" href="assets_forum/assets/vendor/bootstrap-select/dist/css/bootstrap-select.css">
  <link rel="stylesheet" href="assets_forum/assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css">
  <link href="assets_forum/assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <link type="text/css" href="assets_forum/assets/css/argon.css?v=1.1.0" rel="stylesheet">
  <link href="assets_forum/assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
</head>

<style>
  .cke_inner {
    display: none !important;
  }

  .dropdown-menu {
    margin-top: 10px !important;
  }
</style>

<?php
include 'koneksi.php';
session_start();
$file = basename($_SERVER['PHP_SELF']);


if (!isset($_SESSION['member_status'])) {

  // halaman yg dilindungi jika member belum login
  $lindungi = array('verifikator.php', 'member.php', 'member_logout.php', 'member_profil.php', 'member_password.php');
  // periksa halaman, jika belum login ke halaman di atas, maka alihkan halaman
  if (in_array($file, $lindungi)) {
    header("location:index.php");
  }
  if ($file == "posting.php") {
    header("location:masuk.php?alert=login-dulu");
  }
} else {

  // halaman yg tidak boleh diakses jika member sudah login
  $lindungi = array('masuk.php', 'daftar.php');
  // periksa halaman, jika sudah dan mengakses halaman di atas, maka alihkan halaman
  if (in_array($file, $lindungi)) {
    header("location:member.php");
  }
}

?>

<body style="background-color:whitesmoke;">

  <header>

    <nav class="navbar navbar-expand-lg navbar-light shadow">
      <div class="container-fluid m-n1">
        <div class="row">
          <div class="d-flex align-content-center">
            <a class="text-dark" href="index.php" style="font-size: 14pt; text-decoration: none">
              <img src="gambar/sistem/logo.png" height="32px" class="ml-4 mb-0 mr-2">
              <b>GURINDAM </b>
              <!-- |<span style="color: orange">KANREGXII</span><b>BKN</b>
					<small> KANREG XII BKN</small> -->
            </a>
          </div>
        </div>
      </div>
    </nav>

  </header>

  <div class="container-fluid" style="background: url(gambar/carousel/gedung-kantor-blur.jpg); background-size: cover;">

    <div class="row justify-content-center">

      <div class="col-lg-4">

        <div class="card my-5">
          <div class="card-header pb-1 pt-3">
            <h5>
              <center><b>LOGIN</b></center>
            </h5>
          </div>

          <div class="card-body">

            <?php
            if (isset($_GET['id_posting'])) {
              $id_posting = $_GET['id_posting'];
            } else {
              $id_posting = 0;
            }

            if (isset($_GET['alert'])) {
              if ($_GET['alert'] == "terdaftar") {
            ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <span class="alert-inner--icon"><i class="ni ni-bell-55"></i></span>
                  <span class="alert-inner--text"><strong>Pendaftaran Berhasil.</strong> Silahkan login!</span>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
              <?php
              } elseif ($_GET['alert'] == "gagal") {
              ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <span class="alert-inner--icon"><i class="ni ni-bell-55"></i></span>
                  <span class="alert-inner--text"><strong>Email dan Password salah!</strong> coba lagi!</span>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
              <?php
              } elseif ($_GET['alert'] == "login-dulu") {
              ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <span class="alert-inner--icon"><i class="ni ni-bell-55"></i></span>
                  <span class="alert-inner--text"><strong>Warning!</strong> <br /> Silahkan login terlebih dulu</span>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
            <?php
              }
            }
            ?>

            <form action="masuk_act.php" method="post">

              <input name="ip" type="hidden" id="ip" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>">
              <input name="dest" type="hidden" id="dest" value="<?php echo $id_posting; ?>">

              <div class="form-group">
                <label for=""><i class="mx-1 fa fa-user-circle"></i><b>NIP / Username</b></label>
                <input type="text" class="form-control" required="required" name="email" placeholder="Masukkan email / NIP .." autocomplete="off">
              </div>

              <div class="form-group">
                <label for=""><i class="mx-1 fa fa-key"></i><b>Password</b></label>
                <input type="password" class="form-control" name="password" placeholder="Masukkan password .." autocomplete="off">
              </div>

              <div class="form-group pull-right mt-3 mb-0">
                <a href="index.php" class="btn btn-secondary">Batal</a>
                <input type="submit" class="btn btn-dark" value="Login">
              </div>

            </form>

          </div>
        </div>

      </div>

    </div>
  </div>
</body>
<?php include 'footer.php'; ?>