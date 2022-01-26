<?php 
$src = $_POST['src'];

$aa = explode("/", $src);
$aaa = end($aa);

if(unlink("./gambar/diskusi/".$aaa)){
	echo 'File Delete Successfully';
}
echo $src;
?>