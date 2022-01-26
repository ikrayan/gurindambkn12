<?php 
include 'koneksi.php';

$id_posting = $_GET['id_posting'];
$id_verifikator = $_GET['id_verifikator'];

mysqli_query($koneksi, "update posting set posting_step=10 where posting_id=$id_posting");

header("location:admin/verifikasi.php?id_member=$id_verifikator");

?>