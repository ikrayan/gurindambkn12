<?php 
include 'koneksi.php';
$id_attach = $_GET['id_attach'];
$id_posting = $_GET['id_posting'];
$id_member = $_GET['id_member'];

$target = mysqli_query($koneksi, "select * from attachment where attach_id='$id_attach'");
while ($del = mysqli_fetch_array($target)){
	$hapusfile = "attachment/".$del['attach_name'];
	if (file_exists($hapusfile)) {
		unlink($hapusfile);
	}
}

mysqli_query($koneksi, "delete from attachment where attach_id='$id_attach'");

header("location:posting_edit.php?id_posting=$id_posting");
