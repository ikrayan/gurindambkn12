<?php 
// menghubungkan dengan koneksi
include 'koneksi.php';

session_start();

$id_member = $_SESSION['member_id'];
$password = md5($_POST['password']);

mysqli_query($koneksi,"update user set PASSWORD='$password' where PNS_ID='$id_member'");

header("location:member_password.php?alert=sukses");