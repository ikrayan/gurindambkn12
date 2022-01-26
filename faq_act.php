<?php 
include 'koneksi.php';
session_start();
$id_member = $_SESSION['member_id'];
$nama_member = $_SESSION['member_nama'];
	
	date_default_timezone_set('Asia/Jakarta');
	$tanggal = date('Y/m/d H:i:s');

	$kategori 	= $_POST['kategoriFAQ'];
	$topik		= $_POST['topik'];
	$addTopik	= $_POST['addTopik'];
	$viewer		= $_POST['viewer'];
	$q			= $_POST['isi_Q'];
	$a 			= $_POST['isi_A'];
	$step  		= 0;
	
	if(empty($addTopik)){
		mysqli_query($koneksi, "insert into faq values (NULL,'$topik','$kategori','$viewer','$q','$a',NOW(),'$step','$id_member')");
	}else{		
		$datat = mysqli_query($koneksi,"select * from faq_topik order by faq_topik_id DESC");
		while($dt = mysqli_fetch_array($datat)){
			$idTopik = $dt['faq_topik_id']+1;
		}
		mysqli_query($koneksi, "insert into faq_topik values ('$idTopik','$addTopik')");
		mysqli_query($koneksi, "insert into faq values (NULL,'$idTopik','$kategori','$viewer','$q','$a','$step',NOW(),'$id_member')");
		header("location:admin/postingan_member.php?id_member=$id_member");
	}


