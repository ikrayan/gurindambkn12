<?php
$time = $_SERVER['REQUEST_TIME'];

/**
* for a 30 minute timeout, specified in seconds
*/
$timeout_duration = 1800;

/**
* Here we look for the user's LAST_ACTIVITY timestamp. If
* it's set and indicates our $timeout_duration has passed,
* blow away any previous $_SESSION data and start a new one.
*/
if (isset($_SESSION['member_status']) && 
   ($time - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
    session_start();
    
    
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
	
	echo "
	<script>alert('Ups Sesi kamu telah berakhir, Silahkan Login lagi ya !');
			location.reload();
			window.location.href = 'index.php';
	</script>";
	
	
}
/**
* Finally, update LAST_ACTIVITY so that our timeout
* is based on it and not the user's login time.
*/
$_SESSION['LAST_ACTIVITY'] = $time;
?>