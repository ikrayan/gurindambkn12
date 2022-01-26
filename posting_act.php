<?php 
include 'koneksi.php';
session_start();
$id_member = $_SESSION['member_id'];
$nama_member = $_SESSION['member_nama'];
		
	date_default_timezone_set('Asia/Jakarta');
	$tanggal = date('Y/m/d H:i:s');
	//$tipeFile	= $_POST['fileType'];
	$jenis		= $_POST['jenis'];
	$kategori   = $_POST['kategori'];
	$judul  	= $_POST['judul'];
	$akses 		= $_POST['akses'];
	$isi  		= $_POST['isi'];
	$tags		= $_POST['tags'];
	$dibaca  	= 0;
	$step  		= 0;
	$likes		= 0;

	$data = mysqli_query($koneksi,"select * from posting order by posting_id DESC LIMIT 1");
	$d = mysqli_fetch_array($data);
	$id_posting1 = $d['posting_id']+1;

	$limit = 1024000 * 1024;
	$jumlahFile = count($_FILES['attach']['name']);

	for($x=0; $x<$jumlahFile; $x++){
		$namafile = $_FILES['attach']['name'][$x];
		$tmp = $_FILES['attach']['tmp_name'][$x];
	
			//The name of the directory that we need to create.
			//$folder_member = 'attachment/'.$id_member.'/';
			$folderFile = 'attachment/';
			
			//Check if the directory already exists.
			if(!is_dir($folderFile)){
    		//Directory does not exist, so lets create it.
				mkdir($folderFile, 0755, true);
			}	
		
			move_uploaded_file($tmp, $folderFile.$namafile);
			//$attach = date('d-m-Y').'-'.$namafile;
			
			if(!empty($namafile)){
			$attach = mysqli_query($koneksi,"INSERT INTO attachment VALUES (NULL, '$id_posting1', '$namafile', NOW())");
				if(!$attach){
					echo "<script>alert('Something error!')</script>";
				}
			}
			
	}
	
	mysqli_query($koneksi, "insert into posting values ('$id_posting1','$tanggal','$id_member','$kategori','$judul','$isi','$dibaca','$step','$akses','$jenis','$likes','$tags')");
	//header("location:admin/postingan_member.php?id_member=$id_member");
	//echo "<script>alert('Posting berhasil disimpan !');</script>";
?>


