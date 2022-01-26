<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>KMS BKN</title>
  
  <link rel="stylesheet" href="assets_forum/assets/css/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="assets_forum/assets/vendor/bootstrap-select/dist/css/bootstrap-select.css">
  <link rel="stylesheet" href="assets_forum/assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css">
  
  <!-- DataTables -->
  <link rel="stylesheet" href="assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  
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
  
</head>
<style>
  .cke_inner{
    display: none !important;
  }

  .dropdown-menu{
    margin-top: 10px !important;
  }
	
</style>

<?php
include 'koneksi.php';
session_start();
$file = basename($_SERVER['PHP_SELF']);


if(!isset($_SESSION['member_status'])){
	
  
  // halaman yg dilindungi jika member belum login
  $lindungi = array('verifikasi.php','verifikator.php','postingan_member.php','posting.php','posting_edit.php','member.php','member_logout.php','member_profil.php','member_password.php');
  // periksa halaman, jika belum login ke halaman di atas, maka alihkan halaman
  if(in_array($file, $lindungi)){
    header("location:index.php");
  }
  if($file == "posting.php"){
	header("location:index.php");
    //header("location:masuk.php?alert=login-dulu");
  }

}else{

  // halaman yg tidak boleh diakses jika member sudah login
  $lindungi = array('masuk.php','daftar.php');
  // periksa halaman, jika sudah dan mengakses halaman di atas, maka alihkan halaman
  if(in_array($file, $lindungi)){
    header("location:index.php");
  }

}

?>
<body class="bg-secondary">

<?php
	function fsize($file){
		$a = array("b", "Kb", "Mb", "Gb", "Tb", "Pb");
		$pos = 0;
		$size = filesize($file);
		
		while($size >= 1024){
			$size /= 1024;
			$pos++;
		}
		
		return round($size,2)." ".$a[$pos];
	}
	
	$jumlahkomentar = 0;
	?>

  <header>

    <nav class="navbar navbar-expand-lg navbar-dark bg-default mb-4">
      <div class="container-fluid">
        <div class="row">
          <img src="gambar/sistem/logo.png" height="55px" class="ml-3">
          <a class="navbar-brand float-right ml-3 mb-0" href="index.php" style="font-size: 14pt;">
            KNOWLEDGE MANAGEMENT <b style="color: orange">SYSTEM</b><br>            
            <small class="mt-0" style="font-size: 10pt; color: lightgray">Kantor Regional XII Badan Kepegawaian Negara</small>
          </a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-default" aria-controls="navbar-default" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
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

            <li class="nav-item">
              <a class="nav-link p-1 nav-link-icon" style="font-size:11pt;font-weight:bold" href="index.php">
                <i class="fa fa-home fa-2x"></i>
              </a>
            </li>
            
			<!-- 
            <li class="nav-item mr-5">
              <a class="nav-link p-1 nav-link-icon" style="font-size:11pt;font-weight:bold" href="login.php">
                ADMIN 
              </a>
            </li>
            -->
            

            <?php 
            if(isset($_SESSION['member_status'])){
              $id_member = $_SESSION['member_id'];
			  $nama_member = $_SESSION['member_nama'];
			  $level_member = $_SESSION['member_level'];
              $member = mysqli_query($koneksi,"select * from member where member_id='$id_member'");
              $c = mysqli_fetch_assoc($member);
              ?>

              <li class="nav-item dropdown">
                <a class="nav-link nav-link-icon" href="#" style="padding:7px;font-size:10pt;font-weight:bold" id="navbar-default_dropdown_1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                  <?php 
                  if($c['member_foto'] == ""){
                    ?>
                    <img class="img-fluid rounded-circle shadow" style="width: 22px;height: 22px" src="gambar/sistem/member.png">
                    <?php
                  }else{
                    ?>
                    <img class="img-fluid rounded-circle shadow" style="width: 22px;height: 22px" src="gambar/member/<?php echo $c['member_foto'] ?>">
                    <?php
                  }
                  ?>
                  &nbsp;
                  <?php echo $c['member_nama']; ?> 
                  <i class="fa fa-caret-down"></i>
                  <span class="nav-link-inner--text d-lg-none">Settings</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbar-default_dropdown_1">
                  <a class="dropdown-item" href="<?php echo $level_member ?>.php">Dashboard</a>
                  <a class="dropdown-item" href="member_profil.php">Profil</a>
                  <a class="dropdown-item" href="list_member.php">Member</a>
                  <a class="dropdown-item" href="member_password.php">Ganti Password</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="member_logout.php">Logout</a>
                </div>
              </li>

              <?php
            }else{
              ?>
              <li class="nav-item">
                <a class="nav-link nav-link-icon btn-primary" style="padding:7px;font-size:10pt;font-weight:bold" href="masuk.php">
                  &nbsp;
                  <i class="fa fa-sign-in"></i> &nbsp; LOGIN
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