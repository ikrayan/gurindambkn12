<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>GURINDAM</title>

  <link rel="stylesheet" href="assets/bootstrap-4.6.0-dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets_forum/assets/css/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="assets_forum/assets/datatables-1.10.24.min.css" />
  <!--<link rel="stylesheet" href="assets_forum/assets/css/bootstrap/bootstrap.min.css">-->
  <link rel="stylesheet" href="assets_forum/assets/vendor/bootstrap-select/dist/css/bootstrap-select.css">
  <link rel="stylesheet" href="assets_forum/assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css">

  <!-- DataTables -->
  <!--<link rel="stylesheet" href="assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">-->

  <link href="assets_forum/assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <link type="text/css" href="assets_forum/assets/css/argon.css?v=1.1.0" rel="stylesheet">
  <link href="assets_forum/assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
  <!--
  <link rel="stylesheet" href="assets/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="assets/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="assets/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="assets/bower_components/morris.js/morris.css">
  <link rel="stylesheet" href="assets/bower_components/jvectormap/jquery-jvectormap.css">
  <link rel="stylesheet" href="assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  -->
  <style>
    .carousel-inner {
      margin: auto;
      max-height: 550px;
      max-width: 1550px;
    }

    .carousel-inner .img {
      max-width: 1550px;
      max-height: 550px;
    }

    #modalPosting .modal-dialog {
      overflow-y: initial !important
    }

    #modalPosting .modal-body {
      height: 650px;
      overflow-y: auto;
    }

    #myModal .modal-body {
      height: auto;
      overflow-y: auto;
    }

    .cke_inner {
      display: none !important;
    }

    .dropdown-menu {
      margin-top: 10px !important;
    }

    .flex-even {
      flex: 1;
    }

    video {
      max-width: 100%;
      max-height: 720px;
    }

    body,
    html {
      height: 100%;
      margin: 0;
    }

    .bgSearch {

      overflow: auto;
      /* The image used */
      background-image: url("gambar/carousel/gedung-kantor-blur.jpg");
      /* Full height */
      height: 25%;

      /* Center and scale the image nicely */
      background-attachment: fixed;
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
    }

    .darken-with-text {
      margin: 0;
      color: white;
      z-index: 1;
    }

    /* Centered text */
    .centered {
      position: absolute;
      top: 11%;
      left: 50%;
      transform: translate(-50%, 0%);
      color: white;
    }

    a:link {
      text-decoration: none;
    }

    a:visited {
      text-decoration: none;
    }

    a:hover {
      font-weight: bold;
    }

    small:hover {
      font-weight: bold;
    }

    a:active {
      text-decoration: underline;
    }
  </style>

</head>


<?php
include 'koneksi.php';
session_start();
$file = basename($_SERVER['PHP_SELF']);

if (!isset($_SESSION['member_status'])) {

  // halaman yg dilindungi jika member belum login
  $lindungi = array('verifikasi.php', 'verifikator.php', 'postingan_member.php', 'posting.php', 'posting_edit.php', 'member.php', 'member_logout.php', 'member_profil.php', 'member_password.php');
  // periksa halaman, jika belum login ke halaman di atas, maka alihkan halaman
  if (in_array($file, $lindungi)) {
    header("location:index.php");
  }
  if ($file == "posting.php") {
    header("location:index.php");
    //header("location:masuk.php?alert=login-dulu");
  }
} else {

  // halaman yg tidak boleh diakses jika member sudah login
  $lindungi = array('masuk.php', 'daftar.php');
  // periksa halaman, jika sudah dan mengakses halaman di atas, maka alihkan halaman
  if (in_array($file, $lindungi)) {
    header("location:index.php");
  }
}
?>

<?php
function fsize($file)
{
  $a = array("b", "Kb", "Mb", "Gb", "Tb", "Pb");
  $pos = 0;
  $size = filesize($file);

  while ($size >= 1024) {
    $size /= 1024;
    $pos++;
  }

  return round($size, 2) . " " . $a[$pos];
}

$jumlahkomentar = 0;

function ikon($ext)
{
  switch ($ext) {
    case "pdf":
      echo "file-pdf";
      break;

    case "doc":
    case "docx":
      echo "file-word";
      break;

    case "xls":
    case "xlsx":
      echo "file-excel";
      break;

    case "ppt":
    case "pptx":
      echo "file-powerpoint";
      break;

    case "jpg":
    case "jpeg":
    case "png":
    case "tif":
    case "tiff":
    case "bmp":
    case "gif":
    case "eps":
    case "raw":
      echo "file-image";
      break;

    case "mp3":
    case "aac":
    case "ogg":
    case "flac":
    case "alac":
    case "wav":
    case "pcm":
      echo "file-audio";
      break;

    case "mp4":
    case "flv":
    case "mpg":
    case "mpeg":
    case "mkv":
    case "mov":
    case "avi":
    case "wmv":
    case "avchd":
    case "webM":
    case "m4v":
      echo "file-video";
      break;

    case "exe":
      echo "file-code";
      break;

    case "zip":
    case "rar":
      echo "file-zip";
      break;

    case "psd":
    case "ai":
    case "cdr":
      echo "file-picture";
      break;

    case "multi":
      echo "file";
      break;

    default:
      echo "newspaper";
      break;
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
        <button class="navbar-toggler bg-dark" type="button" data-toggle="collapse" data-target="#navbar-default" aria-controls="navbar-default" aria-expanded="false" aria-label="Toggle navigation">
          <!--<span class="navbar-toggler-icon"></span>--><i class="fa text-white fa-navicon"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbar-default">
          <div class="navbar-collapse-header">
            <div class="row">
              <div class="col-6 collapse-brand">
                <a href="index.php">
                  <img src="gambar/sistem/logo.png">
                </a>
              </div>
              <div class="col-6 collapse-close">
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-default" aria-controls="navbar-default" aria-expanded="false" aria-label="Toggle navigation">
                  <span></span>
                  <span></span>
                </button>
              </div>
            </div>
          </div>

          <ul class="navbar-nav ml-lg-auto">

            <!--<li class="nav-item">
              <a class="nav-link p-1 nav-link-icon" style="font-size:11pt;font-weight:bold" href="index.php">
                <i class="fa fa-home fa-2x"></i>
              </a>
            </li>-->

            <!-- 
            <li class="nav-item mr-5">
              <a class="nav-link p-1 nav-link-icon" style="font-size:11pt;font-weight:bold" href="login.php">
                ADMIN 
              </a>
            </li>
            -->


            <?php
            if (isset($_SESSION['member_status'])) {
              $id_member = $_SESSION['member_id'];
              $nama_member = $_SESSION['member_nama'];
              $level_member = $_SESSION['member_level'];
              $jabatan = $_SESSION['member_jabatan'];

              $member = mysqli_query($koneksi, "select * from user where PNS_ID='$id_member'");
              $c = mysqli_fetch_assoc($member);
            ?>

              <li class="nav-item dropdown">
                <a class="nav-link nav-link-icon" href="#" style="padding:7px;font-size:10pt;font-weight:bold" id="navbar-default_dropdown_1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                  <?php
                  if ($c['PNS_FOTO'] == "") {
                  ?>
                    <img class="img-fluid rounded-circle shadow" style="width: 22px;height: 22px" src="gambar/sistem/member.png">
                  <?php
                  } else {
                  ?>
                    <img class="img-fluid rounded-circle shadow" style="width: 22px;height: 22px" src="gambar/member/<?php echo $c['PNS_FOTO'] ?>">
                  <?php
                  }
                  ?>
                  &nbsp;
                  <?php echo $c['NAMA']; ?>
                  <i class="fa fa-caret-down"></i>
                  <span class="nav-link-inner--text d-lg-none">Settings</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbar-default_dropdown_1">
                  <a class="dropdown-item" data-toggle="modal" data-target="#modalPosting" data-backdrop="static" data-keyboard="false" style="cursor: pointer;">+ Buat Posting</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="<?php echo $level_member ?>.php">Dashboard</a>
                  <a class="dropdown-item" href="member_profil.php">Profil</a>
                  <a class="dropdown-item" href="list_member.php">Member</a>
                  <a class="dropdown-item" href="member_password.php">Ganti Password</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="member_logout.php">Logout</a>
                </div>
              </li>

            <?php
            } else {
            ?>
              <li class="nav-item">
                <a class="nav-link nav-link-icon btn-dark" style="padding:7px;font-size:10pt;font-weight:bold" href="masuk.php">
                  &nbsp;
                  <i class="fa fa-sign-in text-white"></i> &nbsp; <b class="text-white">LOGIN</b>
                  &nbsp;
                </a>
              </li>
              <!--
              <li class="nav-item">
                <a class="nav-link nav-link-icon btn-success" style="padding:7px;font-size:10pt;font-weight:bold" href="daftar.php">
                  &nbsp;
                  <i class="fa fa-sign-out"></i> &nbsp; DAFTAR
                  &nbsp;
                </a>
              </li> -->
            <?php
            }
            ?>

          </ul>
        </div>
      </div>
    </nav>
  </header>
  <?php include 'session_timer.php'; ?>