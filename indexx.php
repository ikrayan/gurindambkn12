<?php include 'header.php'; ?>

<!-- Box Search image-->
<div class="bgSearch mb-3">
	<!--<img src="gambar/carousel/carousel1.jpg" alt="..." class="d-block w-100">-->
	<div class="centered col-lg-12">
	 	<center>
		<h5 class="text-white mt-0 mb-3" style="line-height: 1.2; font-style: italic; font-family: Baskerville, Palatino Linotype, Palatino, Century Schoolbook L, Times New Roman, serif"><b>"If you have knowledge, let others light their candles in it"</b><small>&nbsp;Margaret Fuller</small></h5>
		<!--<h6 class="text-white mb-3">KANTOR REGIONAL XII BADAN KEPEGAWAIAN NEGARA</h6>-->
		</center>
		
		<!--search box new-->
		<?php if(isset($_SESSION['member_status'])){ //jika login ?>
		  
		  	<div class="form-group">
				<form action="indexQ.php" method="get" target="_blank">
					<input type="hidden" name="kategori" value="all">
					<div class="form-row mb-0 justify-content-center">
					  <div class="col-lg-6 mb-0">
						 <!--<div class="input-group input-group-alternative">-->
							<input class="form-control shadow pl-3" name="cari" placeholder="Search..." type="search" style="border-radius: 25px; text-align: center" autocomplete="off">
							<!--<span class="input-group-text shadow"><i class="fa fa-search mt-2"></i></span>
							<div class="input-group-append"></div>-->
						 <!--</div>-->
					 </div>
					</div>
				</form>
			</div>
			
			<?php }else{ //jika belum login ?>
			
			<div class="form-group">
				<form action="indexQ.php" method="get" target="_blank">
					<input type="hidden" name="kategori" value="all">
					<div class="form-row mb-0 justify-content-center">
					  <div class="col-lg-6 mb-0">
						 <!--<div class="input-group input-group-alternative">-->
							<input class="form-control shadow pl-3" name="cari" placeholder="Search..." type="search" style="border-radius: 25px; text-align: center" autocomplete="off">
							<!--<span class="input-group-text shadow"><i class="fa fa-search mt-2"></i></span>
							<div class="input-group-append"></div>-->
						 <!--</div>-->
					  </div>
					</div>
				</form>
			</div>
			
			<?php } ?>
		<!--end search box new-->
			<center>
				  <a href="indexQ.php?kategori=all"><i class="fa fa-caret-right text-white mr-1"></i><small class="text-white" style="cursor: pointer;">Advanced Search</small></a>
					 <!-- <div class="col-lg-1 mb-2" style="cursor: pointer;">
					  	<span class="btn btn-sm btn-block m-1" id="btn_extra_down"><i class="fa fa-2x fa-caret-down text-white"></i></span>
					  	<span class="btn btn-sm btn-block m-1" id="btn_extra_up"><i class="fa fa-2x fa-caret-up text-white"></i></span>
					  </div>-->
			</center>
	</div>
</div>
<!-- END Box Search image-->

<!--Posting Terbaru-->
<div class="container col-lg-9">
	<div class="card mb-4">
      	<div class="card-header pb-3 pt-3">
      		<div class="d-flex justify-content-center">
			<h5 class="mb-0">.: <b>Posting</b>Terbaru :.</h5>
			</div>
		</div>
		<div class="card-body px-3 shadow">
		<?php 
			if(isset($_SESSION['member_status'])){ //Jika login
				$datalatest = mysqli_query($koneksi, "select * from posting, attachment, kategori where posting_kategori=kategori_id and posting_step=2 and posting_id=attach_posting order by posting_id DESC LIMIT 6");	
				
			}else{ //Jika tidak login
				$datalatest = mysqli_query($koneksi, "select * from posting, attachment, kategori where posting_kategori=kategori_id and posting_visibility='publik' and posting_step=2 and posting_id=attach_posting order by posting_id DESC LIMIT 6");
			}			
			//end logic sql
			if(mysqli_num_rows($datalatest)>0){				
			?>
				<div class="d-flex flex-wrap ml-n1">
			
			<?php
			while($listlatest = mysqli_fetch_array($datalatest)){
				$fnl = $listlatest['attach_name'];
				$ftl = pathinfo($fnl, PATHINFO_EXTENSION);
				//$ft = substr($listshare['attach_name'], -3, 3);
			?>				
				<div class="d-flex col-lg-4 mb-4 align-items-start">
					<i class="fa fa-2x text-black-50 fa-file-<?php ikon($ftl); ?>-o mr-2 mt-2"></i>
					<div class="justify-content-start pl-2 pt-0" style="border-left: 1px solid grey;">
						<a href="indexQ.php?kategori=<?php echo $listlatest['kategori_id']; ?>" target="_blank">
						<span class="badge text-black-50 mx-n1"><i class="fa mr-1 fa-bookmark"></i><?php echo $listlatest['kategori_nama']; ?></span></a>
						<span class="badge text-black-50 mx-n1"><i class="fa mr-1 fa-book"></i><?php echo $listlatest['posting_jenis']; ?></span>
						<br>
						<?php
							$fileVideo = array('mp4','mkv','mov','mpg','mpeg','flv','m4v');
							if(in_array($ftl, $fileVideo)){ ?>
								<a target="_blank" href="video.php?id_posting=<?php echo $listlatest['posting_id']; ?>&video=<?php echo $listlatest['attach_name']; ?>">
						<?php	
							}else{
						?>
								<a target="_blank" href="diskusi.php?id_posting=<?php echo $listlatest['posting_id']; ?>">
						<?php 
							}
						?>
							<span class="text-black-50"><?php echo strtoupper($listlatest['posting_judul']); ?></span></a>
							<span class="badge"><i class="fa fa-eye mr-1"></i><?php echo $listlatest['posting_dibaca']; ?></span>
					</div>			
				</div>
						
			<?php
			}
			?>	
				</div>
				<a href="indexQ.php?kategori=all" target="_blank" class="text-black-50 d-flex justify-content-end"><small>Tampilkan semua >></small></a>
			<?php	
			}else{
				echo "<small><i>Belum ada data</i></small>";
			}
			?>
		</div>
	</div>
</div>
<!--Akhir Posting Terbaru-->

<div class="container col-lg-9">
  <div class="row">
    <div class="col-lg-9">      

         
	
<!-- Video Terbaru -->
	<div class="card mb-4">
     	
      	<div class="card-header py-3 px-3 bgSearch">
      		<div class="row py-2 px-1" style="background: hsla(180,0%,0%,0.4)">
      			<h4 class="mb-0 ml-3 text-white">Our<b>Video</b></h4>
      		</div>
		</div>
    	
     	<div class="card-body px-3 shadow">
  			<?php
			//$fileVideo = array('mp4','mkv','mov','mpg','mpeg','flv');
			$isVideo = "RIGHT(attach_name,4) IN ('.mp4','.mkv','.mov','.mpg','mpeg','.flv','.m4v')";
			$isNotVideo = "RIGHT(attach_name,4) NOT IN ('.mp4','.mkv','.mov','.mpg','mpeg','.flv','.m4v')";
			
			if(isset($_SESSION['member_status'])){ //Jika login
				$datavideo = mysqli_query($koneksi, "select * from posting, attachment where $isVideo and posting_step=2 and posting_id=attach_posting order by posting_id DESC LIMIT 6");	
				
			}else{ //Jika tidak login
				$datavideo = mysqli_query($koneksi, "select * from posting, attachment where $isVideo and posting_visibility='publik' and posting_step=2 and posting_id=attach_posting order by posting_id DESC LIMIT 6");
			}			
			//end logic sql
			if(mysqli_num_rows($datavideo)>0){
			?>
				<div class="d-flex flex-wrap">
			
			<?php
			while($listvideo = mysqli_fetch_array($datavideo)){
				/* $filename = $listvideo['attach_name'];
				$ext = pathinfo($filename, PATHINFO_EXTENSION);

				if($ext=="mp4" || $ext=="mkv" || $ext=="mpg" || $ext=="mpeg" || $ext=="mov"){ */
			?>
				<div class="col-lg-4 mb-4">
					<a target="_blank" href="video.php?id_posting=<?php echo $listvideo['posting_id']; ?>&video=<?php echo $listvideo['attach_name']; ?>">
					<video width="400" height="180" class="mb-0" muted>
						<source src="attachment/<?php echo $listvideo['attach_name']; ?>" type="video/mp4" />
					</video>
					<!--<iframe src="attachment/<?php// echo $listvideo['attach_name']; ?>" allowfullscreen="true" frameborder="0" name="Oneplayer iframe" title="<?php// echo $listvideo['posting_judul']; ?>" style="height: 100%; width: 100%;"></iframe>-->					
					<br>
					
					<span class="text-black-50"><?php echo ucfirst($listvideo['posting_judul']); ?></span>
					</a>
					<span class="badge ml-n1"><i class="fa fa-eye mr-1"></i><?php echo $listvideo['posting_dibaca']; ?></span>
				</div>				
			<?php
			}
			?>	
				</div>
				<a href="indexQ.php?tipeFile=<?php echo $isVideo; ?>&kategori=all" target="_blank" class="text-black-50 d-flex justify-content-end"><small>Tampilkan semua >></small></a>
			<?php	
			}else{
				echo "<small><i>Belum ada data video</i></small>";
			}
			?>
		</div>
	</div>
 <!-- Batas Video Terbaru -->
  	
 <!-- Lets Share -->
  	<div class="card mb-4">
     	<div class="card-header py-3 px-3 bgSearch">
      		<div class="row py-2 px-1" style="background: hsla(180,0%,0%,0.4)">
      			<h4 class="mb-0 ml-3 text-white">Lets<b>Share</b></h4>
      		</div>
		</div>
     	
      	<!--<div class="card-header pb-3 pt-3">
      	  <div class="clearfix">
      	  	<div class="pull-left">
				<h5 class="mb-0">.: Our<b>Knowledge</b></h5>
			</div>
	  		<?php 
			//if(isset($_SESSION['member_status'])){
			?>
		  	<div class="pull-right">
		  		<a data-toggle="modal" data-target="#modalPosting" data-backdrop="static" data-keyboard="false" style="cursor: pointer;">
		  		<i class="fa fa-2x fa-plus-square text-black-50"></i></a>
			</div>
			<?php
			//}
			?>
		  </div>  
		</div>-->
     	
     	<div class="card-body px-3 shadow">
  			<?php 
			if(isset($_SESSION['member_status'])){ //Jika login
				$datashare = mysqli_query($koneksi, "select * from posting, attachment where posting_kategori='0' and posting_step=2 and posting_id=attach_posting and $isNotVideo order by posting_id DESC LIMIT 8");	
				
			}else{ //Jika tidak login
				$datashare = mysqli_query($koneksi, "select * from posting, attachment where posting_kategori='0' and posting_visibility='publik' and posting_step=2 and posting_id=attach_posting and $isNotVideo order by posting_id DESC LIMIT 8");
			}			
			//end logic sql
			if(mysqli_num_rows($datashare)>0){				
			?>
				<div class="d-flex flex-wrap">
			
			<?php
			while($listshare = mysqli_fetch_array($datashare)){
				$fn = $listshare['attach_name'];
				$ft = pathinfo($fn, PATHINFO_EXTENSION);
				//$ft = substr($listshare['attach_name'], -3, 3);
			?>				
				<div class="d-flex align-items-center col-lg-6 mb-4">
					<i class="fa fa-2x text-black-50 fa-file-<?php ikon($ft); ?>-o mr-2"></i>
					<div class="justify-content-start">
						<a target="_blank" href="diskusi.php?id_posting=<?php echo $listshare['posting_id']; ?>"><span class="text-black-50"><?php echo strtoupper($listshare['posting_judul']); ?></span></a>
						<span class="badge"><i class="fa fa-eye mr-1"></i><?php echo $listshare['posting_dibaca']; ?></span>	
					</div>			
				</div>
						
			<?php
			}
			?>	
				</div>
				<a href="indexQ.php?kategori=0" target="_blank" class="text-black-50 d-flex justify-content-end"><small>Tampilkan semua >></small></a>
			<?php	
			}else{
				echo "<small><i>Belum ada data</i></small>";
			}
			?>
		</div>
	</div>
 <!-- Batas Lets Share -->
 
 <!-- Our INfografis -->
	<div class="card mb-4">
      	<div class="card-header py-3 px-3 bgSearch">
      		<div class="row py-2 px-1" style="background: hsla(180,0%,0%,0.4)">
      			<h4 class="mb-0 ml-3 text-white">Our<b>Infograph</b></h4>
      		</div>
		</div>
		
		<div class="card-body px-3 shadow">
		
			<?php
			//$fileVideo = array('mp4','mkv','mov','mpg','mpeg','flv');
			//$isImage = "RIGHT(attach_name,4) IN ('.jpg','jpeg','.png','.tif','tiff','.bmp','.gif','.eps','.raw')";
			//$isNotImage = "RIGHT(attach_name,4) NOT IN ('.jpg','jpeg','.png','.tif','tiff','.bmp','.gif','.eps','.raw')";
			
			if(isset($_SESSION['member_status'])){ //Jika login
				$dataimg = mysqli_query($koneksi, "select * from posting, attachment where posting_judul like '%INFOGRAFIS%' and posting_step=2 and posting_id=attach_posting order by posting_id DESC LIMIT 8");	
				
			}else{ //Jika tidak login
				$dataimg = mysqli_query($koneksi, "select * from posting, attachment where posting_judul like '%INFOGRAFIS%' and posting_visibility='publik' and posting_step=2 and posting_id=attach_posting order by posting_id DESC LIMIT 8");
			}			
			//end logic sql
			if(mysqli_num_rows($dataimg)>0){
			?>
				<div class="d-flex flex-wrap">
			
			<?php
			while($listimg = mysqli_fetch_array($dataimg)){
				$fni = $listimg['attach_name'];
				$fti = pathinfo($fni, PATHINFO_EXTENSION);
				
			?>
				<div class="d-flex align-items-center col-lg-6 mb-4">
					<i class="fa fa-2x text-black-50 fa-file-<?php ikon($fti); ?>-o mr-2"></i>
					<div class="justify-content-start">
						<a target="_blank" href="diskusi.php?id_posting=<?php echo $listimg['posting_id']; ?>"><span class="text-black-50"><?php echo strtoupper($listimg['posting_judul']); ?></span></a>
						<span class="badge"><i class="fa fa-eye mr-1"></i><?php echo $listimg['posting_dibaca']; ?></span>	
					</div>			
				</div>
						
			<?php
			}
			?>	
				</div>
				<a href="indexQ.php?tipeFile=infografis&kategori=all" target="_blank" class="text-black-50 d-flex justify-content-end"><small>Tampilkan semua >></small></a>
			<?php	
			}else{
				echo "<small><i>Belum ada data infografis</i></small>";
			}
			?>
		</div>
	</div>
 <!-- Batas Our INfografis -->
 
 <!-- Aspek Manajemen ASN -->  
    <div class="card mb-4">
       	<div class="card-header py-3 px-3 bgSearch">
      		<div class="row py-2 px-1" style="background: hsla(180,0%,0%,0.4)">
      			<h4 class="mb-0 ml-3 text-white">Manajemen<b>ASN</b></h4>
      		</div>
		</div>
       
        <div class="card-body px-3 shadow">	
						
		<?php
			
			$kat = mysqli_query($koneksi, "SELECT * FROM kategori WHERE kategori_jenis='Manajemen ASN' ORDER BY kategori_nama");
			$jmlkat = mysqli_num_rows($kat);
			$lis = 0;
			
            while($k = mysqli_fetch_array($kat)){
				$lis++;				
        ?>
        
<!-- Tampilkan kategori fungsi -->
   		<div id=<?php echo $k['kategori_id']; ?>>
  		  <div id=<?php echo "katMenu".$lis ?> class="mb-2" style="cursor: pointer;" onmouseover="style.backgroundColor='#EEEEEE'" onmouseout="style.backgroundColor='transparent'">
   		  	<h6 class="mb-n3 text-black-50">&nbsp;
   		  		<i class="fa fa-caret-right" id=<?php echo "caretRight".$lis ?>></i>
   		  		<i class="fa fa-caret-down" id=<?php echo "caretDown".$lis ?>></i>
   		  			<b><?php echo $k['kategori_nama']; ?></b>
   		  	</h6><br>
		  </div>
  		  	
   		  	<div id=<?php echo "katContent".$lis ?>>
				<ul class="nav nav-tabs ml-3" id="myTab" role="tablist">
			  	  <!-- tab regulasi -->
				  <li class="nav-item">
					<a class="nav-link active" id=<?php echo "regulasi-tab".$lis; ?> data-toggle="tab" href=<?php echo "#regulasi".$lis; ?> role="tab" aria-controls="regulasi" aria-selected="true"><small><b>Regulasi</b></small></a>
				  </li>
				  <!-- tab knowledge -->
				  <li class="nav-item">
					<a class="nav-link" id=<?php echo "knowledge-tab".$lis; ?> data-toggle="tab" href=<?php echo "#knowledge".$lis; ?> role="tab" aria-controls="knowledge" aria-selected="false"><small><b>Knowledge</b></small></a>
				  </li>
				  <!-- tab media 
				  <li class="nav-item">
					<a class="nav-link" id=<?php //echo "media-tab".$lis; ?> data-toggle="tab" href=<?php //echo "#media".$lis; ?> role="tab" aria-controls="media" aria-selected="false"><small><b>Media</b></small></a>
				  </li> -->
				  <!-- tab faq -->
				  <li class="nav-item">
					<a class="nav-link" id=<?php echo "faq-tab".$lis; ?> data-toggle="tab" href=<?php echo "#faq".$lis; ?> role="tab" aria-controls="faq" aria-selected="false"><small><b>FAQ</b></small></a>
				  </li>
				</ul>
				
				<div class="tab-content" id="myTabContent">
				
		<!-- isi tab regulasi -->
				  <div class="tab-pane fade show active" role="tabpanel" id=<?php echo "regulasi".$lis; ?>  aria-labelledby=<?php echo "regulasi-tab".$lis ?>>
				  
			<?php 
			if(isset($_SESSION['member_status'])){ //Jika login
				$datareg = mysqli_query($koneksi, "select * from posting, attachment where posting_jenis='regulasi' and posting_id=attach_posting and posting_step=2 and posting_kategori=$k[kategori_id] order by posting_id DESC LIMIT 5");	
				
			}else{ //Jika tidak login
				$datareg = mysqli_query($koneksi, "select * from posting, attachment where posting_jenis='regulasi' and posting_id=attach_posting and posting_visibility='publik' and posting_step=2 and posting_kategori=$k[kategori_id] order by posting_id DESC LIMIT 5");
			}			
			//end logic sql
			if(mysqli_num_rows($datareg)>0){
			?>
				<div class="d-flex flex-wrap ml-3 mt-4">
			
			<?php
			while($listreg = mysqli_fetch_array($datareg)){
				$fn1 = $listreg['attach_name'];
				$ft1 = pathinfo($fn1, PATHINFO_EXTENSION);
				//$ft1 = substr($listreg['attach_name'], -3, 3);
			?>	
			
				<div class="d-flex align-items-center col-lg-6 mb-3">
					<i class="fa fa-2x text-black-50 fa-file-<?php ikon($ft1); ?>-o mr-2"></i>
					<div class="justify-content-start">
						<a target="_blank" href="diskusi.php?id_posting=<?php echo $listreg['posting_id']; ?>"><span class="text-black-50"><?php echo strtoupper($listreg['posting_judul']); ?></span></a>
						<span class="badge bg-secondary"><i class="fa fa-eye mr-1"></i><?php echo $listreg['posting_dibaca']; ?></span>
					</div>
				</div>	
						
			<?php
			}
			?>	
				</div>
				<a href="indexQ.php?kategori=<?php echo $k['kategori_id']; ?>&jenis=regulasi" target="_blank" class="text-black-50 d-flex justify-content-end"><small>Tampilkan semua >></small></a>
			<?php	
			}else{
				echo "<br><span class='pl-4'><small><i>Belum ada data</i></small></span>";
			}
			?>
				  </div>
				
		<!-- isi tab knowledge -->
				  <div class="tab-pane fade" role="tabpanel" id=<?php echo "knowledge".$lis; ?> aria-labelledby=<?php echo "knowledge-tab".$lis ?>>
				  	
			<?php 
			if(isset($_SESSION['member_status'])){ //Jika login
				$datadok = mysqli_query($koneksi, "select * from posting, attachment where posting_jenis='knowledge' and posting_id=attach_posting and posting_step=2 and posting_kategori=$k[kategori_id] order by posting_id DESC LIMIT 5");	
				
			}else{ //Jika tidak login
				$datadok = mysqli_query($koneksi, "select * from posting, attachment where posting_jenis='knowledge' and posting_id=attach_posting  and posting_visibility='publik' and posting_step=2 and posting_kategori=$k[kategori_id] order by posting_id DESC LIMIT 5");
			}			
			//end logic sql
			if(mysqli_num_rows($datadok)>0){
			?>
				<div class="d-flex flex-wrap ml-3 mt-4">
			
			<?php
			while($listdok = mysqli_fetch_array($datadok)){
				$fn2 = $listdok['attach_name'];
				$ft2 = pathinfo($fn2, PATHINFO_EXTENSION);
				//$ft2 = substr($listdok['attach_name'], -3, 3);
			?>			
				<div class="d-flex align-items-center col-lg-6 mb-3">
					<i class="fa fa-2x text-black-50 fa-file-<?php ikon($ft2); ?>-o mr-2"></i>
					<div class="justify-content-start">
						<?php
							$fileVideo = array('mp4','mkv','mov','mpg','mpeg','flv','m4v');
							if(in_array($ft2, $fileVideo)){ ?>
								<a target="_blank" href="video.php?id_posting=<?php echo $listdok['posting_id']; ?>&video=<?php echo $listdok['attach_name']; ?>">
						<?php	
							}else{
						?>
								<a target="_blank" href="diskusi.php?id_posting=<?php echo $listdok['posting_id']; ?>">
						<?php 
							}
						?>
						<span class="text-black-50"><?php echo strtoupper($listdok['posting_judul']); ?></span></a>
						<span class="badge bg-secondary"><i class="fa fa-eye mr-1"></i><?php echo $listdok['posting_dibaca']; ?></span>
					</div>
				</div>	
						
			<?php
			}
			?>	
				</div>
				<a href="indexQ.php?kategori=<?php echo $k['kategori_id']; ?>&jenis=knowledge" target="_blank" class="text-black-50 d-flex justify-content-end"><small>Tampilkan semua >></small></a>
			<?php
			}else{
				echo "<br><span class='pl-4'><small><i>Belum ada data</i></small></span>";
			}
			?>
				  	
				  </div>
				
		<!-- isi tab faq -->
				  <div class="tab-pane fade" role="tabpanel" id=<?php echo "faq".$lis; ?> aria-labelledby=<?php echo "faq-tab".$lis ?>>
				  	<br><span class='pl-4'><small><i>Belum ada data FAQ</i></small></span>
				  </div>
				</div>
				<hr class="ml-3 mt-4 mb-3 bg-dark">
			</div>
			
		</div>
   		
    <!-- Akhir Tampilkan kategori fungsi -->

        <?php 
          }
        ?>
    </div>
  </div>
<!-- Akhir Aspek Manajemen ASN -->
</div>

<?php include 'sidebar.php'; ?>

</div>
</div>

<?php include 'footer.php'; ?>
