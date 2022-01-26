<?php 
include 'koneksi.php';
session_start();

date_default_timezone_set('Asia/Jakarta');

$id_posting  = $_POST['id_posting'];
$tanggal = date('Y/m/d H:i:s');
$member = $_SESSION['member_id'];
$isi  = $_POST['isi'];

mysqli_query($koneksi, "insert into diskusi values (NULL,'$id_posting','$tanggal','$member','$isi')");

header("location:posting_verif_view.php?id_posting=$id_posting");
