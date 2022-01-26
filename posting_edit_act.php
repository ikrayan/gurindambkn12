<?php 
include 'koneksi.php';
session_start();
$id_posting = $_GET['id_posting'];
$id_member = $_SESSION['member_id'];
$nama_member = $_SESSION['member_nama'];

date_default_timezone_set('Asia/Jakarta');
$tanggal 	= date('Y/m/d H:i:s');
$jenis		= $_POST['jenis'];
$kategori  	= $_POST['kategori'];
$judul  	= $_POST['judul'];
$isi  		= $_POST['isi'];
$akses		= $_POST['akses'];
$tags		= $_POST['tags'];
/* if(isset($_POST['visibility'])){
	$visibility = $_POST['visibility'];
}else{
	$visibility = "internal";
} */

$limit = 1024000 * 1024;
//$ekstensi =  array('png','jpg','jpeg','gif');
$jumlahFile = count($_FILES['attach']['name']);

for($x=0; $x<$jumlahFile; $x++){
	$namafile = $_FILES['attach']['name'][$x];
	$tmp = $_FILES['attach']['tmp_name'][$x];
	//$tipe_file = pathinfo($namafile, PATHINFO_EXTENSION);
	$ukuran = $_FILES['attach']['size'][$x];	
	if($ukuran > $limit){
		header("location:posting_edit.php?alert=gagal_ukuran");		
	}else{
		//if(!in_array($tipe_file, $ekstensi)){
		//	header("location:index.php?alert=gagal_ektensi");			
		//}else{
			//The name of the directory that we need to create.
			$folder_member = 'attachment/';
 
			//Check if the directory already exists.
			if(!is_dir($folder_member)){
    		//Directory does not exist, so lets create it.
				mkdir($folder_member, 0755, true);
			}	
		
			move_uploaded_file($tmp, $folder_member.$namafile);
			//$attach = date('d-m-Y').'-'.$namafile;
						
			if(!empty($namafile)){
			mysqli_query($koneksi,"INSERT INTO attachment VALUES (NULL, '$id_posting', '$namafile', NOW())");
			//header("location:index.php?alert=simpan");
			}
			header("location:diskusi.php?id_posting=$id_posting");
			}
	
}
mysqli_query($koneksi, "UPDATE posting SET posting_tags='$tags', posting_jenis='$jenis', posting_tanggal='$tanggal', posting_kategori='$kategori', posting_judul='$judul', posting_isi='$isi', posting_visibility='$akses' WHERE posting_id='$id_posting'");



