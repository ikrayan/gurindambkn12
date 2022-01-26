<!-- ASIDE -->
<div class="col-lg-3 my-3">


	<?php
	$id_member = $_SESSION['member_id'];
	$level_member = $_SESSION['member_level'];
	
	$member = mysqli_query($koneksi,"select * from user where PNS_ID='$id_member'");
	$c = mysqli_fetch_assoc($member);

	if($c['PNS_FOTO'] == ""){
		?>
		<center><img class="img-fluid rounde shadow" src="gambar/sistem/member.png"></center>
		<?php
	}else{
		?>
		<center><img class="img-fluid rounde shadow" src="gambar/member/<?php echo $c['PNS_FOTO'] ?>"></center>
		<?php
	}
	?>

	<center>
		<h5 class="my-4 m-1"><?php echo $c['NAMA']; ?></h5>
		<h7 class="my-4 m-1" id="verif"><b><?php echo $c['JABATAN_NAMA']; ?></b></h7>
	</center>
	<br>
	
	<div class="menu">
		<ul class="list-group">
			<li class="list-group-item"><a class="text-default btn-block" href="<?php echo $level_member ?>.php"> <i class="fa fa-home"></i> &nbsp; <b>Dashboard</b></a></li>
			<li class="list-group-item"><a class="text-default btn-block" href="member_profil.php"> <i class="fa fa-user"></i> &nbsp; <b>Profil Saya</b></a></li>
			<li class="list-group-item"><a class="text-default btn-block" href="member_password.php"> <i class="fa fa-lock"></i> &nbsp; <b>Ganti Password</b></a></li>
			<li class="list-group-item"><a class="text-default btn-block" href="member_logout.php"> <i class="fa fa-sign-out"></i> &nbsp; <b>Keluar</b></a></li>
		</ul>
	</div>
</div>
<!-- /ASIDE -->
