<?php 
include 'koneksi.php';

session_start();

$id_member  = $_SESSION['member_id'];

$username  	= $_POST['username'];
$email  	= $_POST['email'];
$hp  		= $_POST['hp'];
$unor 		= $_POST['unor'];

// cek gambar
$rand = rand();
$allowed =  array('gif','png','jpg','jpeg');
$filename = $_FILES['foto']['name'];
$ext = pathinfo($filename, PATHINFO_EXTENSION);

if($filename==""){
	mysqli_query($koneksi, "update user set USERNAME='$username', EMAIL='$email', NOMOR_HP='$hp', UNOR_NAMA='$unor' where PNS_ID='$id_member'");
	header("location:member_profil.php?alert=berhasil");
}else{
	if(!in_array($ext,$allowed) ) {
		header("location:member_profil.php?alert=gagal");
	}else{
		move_uploaded_file($_FILES['foto']['tmp_name'], 'gambar/member/'.$rand.'_'.$filename);
		$x = $rand.'_'.$filename;
		mysqli_query($koneksi, "update user set USERNAME='$username', EMAIL='$email', NOMOR_HP='$hp', UNOR_NAMA='$unor', PNS_FOTO='$x' where PNS_ID='$id_member'");		
		header("location:member_profil.php?alert=berhasil");
	}
}
