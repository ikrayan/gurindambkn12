 <div class="col-lg-3">

	<?php
	 if(isset($_SESSION['member_status'])){
	 ?>
 		<a href="posting.php" class="btn btn-primary btn-block mb-4 shadow">BUAT POSTING BARU</a>
	<?php } ?>

 	<h6><b>.: Kategori</b></h6>

 	<?php 
 	$data = mysqli_query($koneksi,"SELECT * FROM kategori");
 	while($d = mysqli_fetch_array($data)){
		if(isset($_GET['cari'])){
 		?>
 		<a class="btn btn1 btn-outline-danger btn-block" href="kategori.php?id=<?php echo $d['kategori_id']; ?>&cari=<?php echo $cari; ?>">
 		
 		<?php 
		}else{ ?>
		<a class="btn btn1 btn-outline-danger btn-block" href="kategori.php?id=<?php echo $d['kategori_id']; ?>">
		<?php 
		}
			echo $d['kategori_nama']; ?>
		</a>
 		<?php 
 	}
 	?>

 	<br/>

 	<h6><b>.: Knowledge Terpopuler</b></h6>
 	<div class="card">
 		<div class="card-body">

 			<?php
			if(isset($_SESSION['member_status'])){			
 				$data = mysqli_query($koneksi,"select * from posting,kategori,member where posting_step=2 and posting_member=member_id and kategori_id=posting_kategori order by posting_dibaca desc LIMIT 5");
			}else{
				$data = mysqli_query($koneksi,"select * from posting,kategori,member where posting_visibility='publik' and posting_step=2 and posting_member=member_id and kategori_id=posting_kategori order by posting_dibaca desc LIMIT 5");
			}
			
 			while($d = mysqli_fetch_array($data)){
 				?>
 				<a style="font-size:11pt" href="diskusi.php?id=<?php echo $d['posting_id']; ?>"><?php echo $d['posting_judul'] ?></a>
 				<br/>
 				<?php 
 				if($d['member_foto'] == ""){
 					?>
 					<img class="img-fluid rounded-circle shadow" style="width: 20px;height: 20px" src="gambar/sistem/member.png">
 					<?php
 				}else{
 					?>
 					<img class="img-fluid rounded-circle shadow" style="width: 20px;height: 20px" src="gambar/member/<?php echo $d['member_foto'] ?>">
 					<?php
 				}
 				?>
 				<small class="ml-1"><?php echo $d['member_nama'] ?></small>
 				<div class="badge badge-info"><i class="fa fa-eye"></i> <?php echo $d['posting_dibaca'] ?></div> 
 				<hr class="my-2">
 				<?php 
 			}
 			?>
 		</div>
 	</div>



 </div>
