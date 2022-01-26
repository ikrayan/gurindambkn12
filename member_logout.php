<?php 

include 'koneksi.php';

session_start();

$id_member = $_SESSION['member_id'];

mysqli_query($koneksi, "UPDATE log_user SET logout=NOW() WHERE log_pns_id='$id_member' order by login desc limit 1");

	unset($_SESSION['member_id']);
	unset($_SESSION['member_nama']);
	unset($_SESSION['member_status']);
	unset($_SESSION['member_level']);
	unset($_SESSION['member_jabatan']);
	unset($_SESSION['member_unor']);
	unset($_SESSION['LAST_ACTIVITY']);

session_destroy();
	
	unset($_SESSION['member_id']);
	unset($_SESSION['member_nama']);
	unset($_SESSION['member_status']);
	unset($_SESSION['member_level']);
	unset($_SESSION['member_jabatan']);
	unset($_SESSION['member_unor']);
	unset($_SESSION['LAST_ACTIVITY']);

header("location:index.php");
?>