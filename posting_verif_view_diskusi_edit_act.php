<?php 
include 'koneksi.php';
session_start();

date_default_timezone_set('Asia/Jakarta');

$id_diskusi = $_POST['id_diskusi'];
$posting  = $_POST['posting'];
$tanggal = date('Y/m/d H:i:s');
$member = $_SESSION['member_id'];
$isi  = $_POST['isi'];

mysqli_query($koneksi, "UPDATE diskusi SET diskusi_isi='$isi', diskusi_tanggal='$tanggal' WHERE diskusi_id='$id_diskusi'");

header("location:posting_verif_view.php?id=$posting");
