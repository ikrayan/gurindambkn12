<?php 
include 'koneksi.php';

$id = $_GET['id'];
$viewer = $_GET['visibility'];

if($viewer=="publik"){
	$viewer = "internal";
}else{
	$viewer = "publik";
}

mysqli_query($koneksi, "UPDATE posting SET posting_visibility='$viewer' WHERE posting_id='$id'");

header("location:admin/diskusi.php");
	


