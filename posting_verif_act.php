<?php 
include 'koneksi.php';

$id_posting = $_GET['id_posting'];
$id_member = $_GET['id_member'];

mysqli_query($koneksi, "update posting set posting_step=1 where posting_id=$id_posting");

header("location:admin/postingan_member.php?id_member=$id_member");

?>
