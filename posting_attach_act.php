<?php 
include 'koneksi.php';
session_start();
$id_member = $_SESSION['member_id'];
$nama_member = $_SESSION['member_nama'];

date_default_timezone_set('Asia/Jakarta');

$tanggal = date('Y/m/d H:i:s');
$member = $_SESSION['member_id'];
$kategori  = $_POST['kategori'];
$judul  = $_POST['judul'];
$isi  = $_POST['isi'];
$dibaca  = 0;
$step  = 0;

mysqli_query($koneksi, "insert into posting values (NULL,'$tanggal','$member','$kategori','$judul','$isi','$dibaca','$step')");



$limit = 1000 * 1024 * 1024;
//$ekstensi =  array('png','jpg','jpeg','gif');
$jumlahFile = count($_FILES['attach']['name']);

for($x=0; $x<$jumlahFile; $x++){
	$namafile = $_FILES['attach']['name'][$x];
	$tmp = $_FILES['attach']['tmp_name'][$x];
	//$tipe_file = pathinfo($namafile, PATHINFO_EXTENSION);
	$ukuran = $_FILES['attach']['size'][$x];	
	if($ukuran > $limit){
		header("location:index_bymember.php?alert=gagal_ukuran");		
	}else{
		//if(!in_array($tipe_file, $ekstensi)){
		//	header("location:index.php?alert=gagal_ektensi");			
		//}else{		
			move_uploaded_file($tmp, 'attachment/'.date('d-m-Y').'-'.$namafile);
			$attach = date('d-m-Y').'-'.$namafile;
			
			$data = mysqli_query($koneksi,"select * from posting order by posting_id DESC LIMIT 1");
            $d = mysqli_fetch_array($data);
			$id_posting = $d['posting_id'];
					
			mysqli_query($koneksi,"INSERT INTO attachment VALUES(NULL, '$id_posting', $attach, NOW())");
			//header("location:index.php?alert=simpan");
			header("location:index_bymember.php?alert=posting&nama=$nama_member");
			}
	
}



