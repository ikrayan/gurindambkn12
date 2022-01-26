<?php 
include 'koneksi.php';
$nama  = $_POST['nama'];
$email = $_POST['email'];
$hp = $_POST['hp'];
$alamat = $_POST['alamat'];
$password = md5($_POST['password']);

$cek_email = mysqli_query($koneksi,"select * from member where member_email='$email'");
if(mysqli_num_rows($cek_email) > 0){
	header("location:daftar.php?alert=duplikat");
}else{
	mysqli_query($koneksi, "insert into member values (NULL,'$nama','$email','$hp','$password','$alamat','','member')");
	header("location:masuk.php?alert=terdaftar");
}
