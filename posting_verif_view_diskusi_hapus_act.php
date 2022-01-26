<?php 
include 'koneksi.php';

$id_diskusi = $_GET['id_diskusi'];
$posting = $_GET['id_posting'];

mysqli_query($koneksi, "delete from diskusi where diskusi_id='$id_diskusi'");

header("location:posting_verif_view.php?id=$posting");
