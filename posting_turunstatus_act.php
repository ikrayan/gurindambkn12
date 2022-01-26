<?php 
include 'koneksi.php';

$id = $_GET['id'];

mysqli_query($koneksi, "UPDATE posting SET posting_step='0' WHERE posting_id='$id'");

header("location:admin/diskusi.php");
	


