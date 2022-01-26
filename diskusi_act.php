<?php 
include 'koneksi.php';
session_start();

date_default_timezone_set('Asia/Jakarta');

$posting  = $_POST['posting'];
$tanggal = date('Y/m/d H:i:s');
$member = $_SESSION['member_id'];
$isi  = $_POST['isi'];

mysqli_query($koneksi, "insert into diskusi values (NULL,'$posting','$tanggal','$member','$isi')");

header("location:diskusi.php?id_posting=$posting");
