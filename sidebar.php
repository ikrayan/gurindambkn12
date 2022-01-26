<div class="col-xl-3">

	<div class="mt-3">
		<center>
			<video width="480" controls muted loop>
				<source src="attachment/Kembangkan Inovasi, Tingkatkan Pelayanan Kanreg XII BKN.mp4" type="video/mp4" />
			</video>
		</center>
		<!--<iframe src="attachment/13/Video Tutorial KPO.mp4" allowfullscreen="true" frameborder="0" name="Oneplayer iframe" title="" style="height: 100%; width: 100%;"></iframe>-->
	</div>
	<?php /*
	 if(isset($_SESSION['member_status'])){
	 ?>
 		<a href="posting.php" class="btn btn-warning btn-block mb-4 shadow">+ BUAT POSTING BARU</a>
 		<hr class="mt-3 mb-3"/>
	<?php } */ ?>

	<hr class="my-2">

	<!--sticky post-->
	<?php
	if (isset($_SESSION['member_status'])) {
		$data = mysqli_query($koneksi, "select * from posting,sticky where posting_step=2 and posting_id=sticky_posting and sticky_status='y' order by posting_id desc LIMIT 5");
	} else {
		$data = mysqli_query($koneksi, "select * from posting,sticky where posting_visibility='publik' and posting_step=2 and posting_id=sticky_posting and sticky_status='y' order by posting_id desc LIMIT 5");
	}

	if (mysqli_num_rows($data) > 0) {
	?>

		<h5 class="ml-3"><i class="fa fa-sticky-note mr-2 shadow-sm" style="color: orange;"></i><b>Sticky</b>Post</h5>
		<div class="card mb-3">
			<div class="card-body shadow py-3">

				<?php
				while ($d = mysqli_fetch_array($data)) {

					// Logika IKON
					$ids = $d['posting_id'];
					$qs = mysqli_query($koneksi, "select * from attachment where attach_posting=$ids");
					if (mysqli_num_rows($qs) > 0 && mysqli_num_rows($qs) < 2) {
						while ($ikons = mysqli_fetch_array($qs)) {
							$fns = $ikons['attach_name'];
							$fts = pathinfo($fns, PATHINFO_EXTENSION);
						}
					} elseif (mysqli_num_rows($qs) > 1) {
						$fts = "multi";
					}
					// end Logika IKON

					$fileVideo = array('mp4', 'mkv', 'mov', 'mpg', 'mpeg', 'flv', 'm4v');
					if (in_array($fts, $fileVideo)) { ?>
						<a style="font-size:11pt; color: black" href="video.php?id_posting=<?php echo $d['posting_id']; ?>&video=<?php echo $fnl; ?>">
						<?php
					} else {
						?>
							<a style="font-size:11pt; color: black" href="diskusi.php?id_posting=<?php echo $d['posting_id']; ?>">
							<?php
						}
							?>

							<small class="text-black-50"><?php echo ucfirst($d['posting_judul']); ?></small>
							<span class="badge"><i class="fa fa-eye"></i> <?php echo $d['posting_dibaca'] ?></span>
							</a>
							<br />
							<?php /*
 				if($d['PNS_FOTO'] == ""){
 					?>
 					<img class="img-fluid rounded-circle shadow" style="width: 20px;height: 20px" src="gambar/sistem/member.png">
 					<?php
 				}else{
 					?>
 					<img class="img-fluid rounded-circle shadow" style="width: 20px;height: 20px" src="gambar/member/<?php echo $d['PNS_FOTO'] ?>">
 					<?php
 				} 
				<small class="ml-1"><?php echo $d['NAMA'] ?></small>
				*/
							?>
							<hr class="my-2">


						<?php
					}
						?>
			</div>
		</div>
	<?php
	}
	?>
	<!--akhir sticky post-->

	<hr class="my-2">

	<!--list forum -->


	<?php
	if (isset($_SESSION['member_status'])) {
		$dataF = mysqli_query($koneksi, "select * from posting,user where posting_member=PNS_ID and posting_step=2 and posting_jenis='forum' order by posting_id desc LIMIT 5");
	} else {
		$dataF = mysqli_query($koneksi, "select * from posting,user where posting_member=PNS_ID and posting_visibility='publik' and posting_step=2 and posting_jenis='forum' order by posting_id desc LIMIT 5");
	}

	if (mysqli_num_rows($dataF) > 0) {
	?>

		<h5 class="ml-3"><i class="fa fa-forumbee mr-2 shadow-sm" style="color: dodgerblue;"></i><b>Forum</b>Diskusi</h5>
		<div class="card mb-3">
			<div class="card-body shadow py-3">

				<?php
				while ($dF = mysqli_fetch_array($dataF)) {
				?>

					<a style="font-size:11pt; color: black" href="diskusi.php?id_posting=<?php echo $dF['posting_id']; ?>">
						<small class="text-black-50"><?php echo ucfirst($dF['posting_judul']); ?></small>
						<span class="badge"><i class="fa fa-eye"></i> <?php echo $dF['posting_dibaca'] ?></span>
					</a>
					<br />
					<a href="detail_member.php?id=<?php echo $dF['PNS_ID']; ?>">
						<span class="text-black-50" style="font-size: 8pt">[<i>Author: <?php echo $dF['NAMA'] ?></i>]</span>
					</a>
				<?php
				}
				?>

				<hr class="my-2">
			<?php
		} else {
			echo "<i class='text-black-50'>Belum ada data Forum</i>";
		}
			?>
			</div>
		</div>
		<!--akhir forum -->

		<hr class="my-2">

		<!--data Populer-->
		<?php
		if (isset($_SESSION['member_status'])) {
			$data = mysqli_query($koneksi, "select * from posting,kategori,user where posting_step=2 and posting_member=PNS_ID and kategori_id=posting_kategori order by posting_dibaca desc LIMIT 5");
		} else {
			$data = mysqli_query($koneksi, "select * from posting,kategori,user where posting_visibility='publik' and posting_step=2 and posting_member=PNS_ID and kategori_id=posting_kategori order by posting_dibaca desc LIMIT 5");
		}

		if (mysqli_num_rows($data) > 0) {
		?>

			<h5 class="ml-3"><i class="fa fa-podcast mr-2 shadow-sm" style="color: green"></i>Data<b>Populer</b></h5>
			<div class="card">
				<div class="card-body shadow py-3">

					<?php
					while ($d = mysqli_fetch_array($data)) {
					?>
						<a style="font-size:11pt; color: black" href="diskusi.php?id_posting=<?php echo $d['posting_id']; ?>">
							<small class="text-black-50"><?php echo ucfirst($d['posting_judul']); ?></small>
						</a>
						<span class="badge"><i class="fa fa-eye"></i> <?php echo $d['posting_dibaca'] ?></span>
						<br />
						<?php /*
 				if($d['PNS_FOTO'] == ""){
 					?>
 					<img class="img-fluid rounded-circle shadow" style="width: 20px;height: 20px" src="gambar/sistem/member.png">
 					<?php
 				}else{
 					?>
 					<img class="img-fluid rounded-circle shadow" style="width: 20px;height: 20px" src="gambar/member/<?php echo $d['PNS_FOTO'] ?>">
 					<?php
 				} 
				<small class="ml-1"><?php echo $d['NAMA'] ?></small>
				*/
						?>
						<hr class="my-2">


					<?php
					}
					?>
				</div>
			</div>
		<?php
		}
		?>
		<!-- akhir data Populer-->
</div>