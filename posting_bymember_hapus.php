<?php 
include 'koneksi.php';
$id = $_GET['id'];
$nama = $_GET['nama'];
$id_member = $_GET['id_member'];

mysqli_query($koneksi, "delete from posting where posting_id='$id'");
mysqli_query($koneksi, "delete from diskusi where diskusi_posting='$id'");

$target = mysqli_query($koneksi, "select * from attachment where attach_posting='$id'");
while ($del = mysqli_fetch_array($target)){
	$hapusfile = "attachment/".$del['attach_name'];
	if (file_exists($hapusfile)) {
		unlink($hapusfile);
	}
}

mysqli_query($koneksi, "delete from attachment where attach_posting='$id'");

header("location:admin/postingan_member.php?id_member=$id_member");
