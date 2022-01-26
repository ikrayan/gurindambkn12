<?php 
	if(!isset($_GET['id_posting'])){
		header("location:index.php");
	}
?>

<?php include 'header.php'; ?>

<div class="container col-lg-9">

<div class="row">

    <div class="col-lg-9">
        
         <?php
         $id_posting = $_GET['id_posting'];
		 $video = $_GET['video'];
		 if(isset($_GET['jenis'])){
			$data = mysqli_query($koneksi,"SELECT * FROM posting,user WHERE posting_id='$id_posting' AND posting_member=PNS_ID");
		 }else{
         	$data = mysqli_query($koneksi,"SELECT * FROM posting,kategori,user WHERE posting_id='$id_posting' AND posting_member=PNS_ID AND kategori_id=posting_kategori");
		 }
         while($d = mysqli_fetch_array($data)){          
		  $step = $d['posting_step'];
		  $akses = $d['posting_visibility'];

          // update dibaca
		if ($step==0 or $step==10 or $step==1){}else{
          $posting = mysqli_query($koneksi,"select * from posting where posting_id='$id_posting'");
          $pp = mysqli_fetch_assoc($posting);
          $dibaca = $pp['posting_dibaca'];
          $dibaca_update = $dibaca+1;
          mysqli_query($koneksi,"update posting set posting_dibaca='$dibaca_update' where posting_id='$id_posting'");
		}
          ?>
          
<!-- mulai konten -->
	<div class="card shadow my-3">
        <div class="card-body shadow">
        
        <video width="1280" controls>
			<source src="attachment/<?php echo $video; ?>" type="video/mp4" />
		</video>
      	
<!-- judul posting -->
      	<!-- Mulai Tags -->
      	<?php 
      	if(!empty($d['posting_tags'])){
			$tags = explode(",",$d['posting_tags']);
      
			for($t=0; $t < count($tags); $t++){
				echo "<a href='indexQ.php?cariTags=".$tags[$t]."&kategori=all' target='_blank'>
						<span class='badge text-black-50 mt-2 ml-n1'><i class='fa fa-tag'></i> ".$tags[$t]."</span>
					 </a>";
			}
		}
		?>     		
      	<!-- Akhir Tags-->
      	
       	<h5 class="mb-1" style="line-height: 1.25"><?php echo $d['posting_judul'] ?></h5>
       	
        <div class="clearfix">
        	<div class="pull-right">
				<?php 
						if($akses=="publik"){
								echo "<span class='badge text-black-50'><i class='fa fa-arrow-up'></i>&nbsp;Publik</span>&nbsp;";
							}elseif($akses=="internal"){
								echo "<span class='badge text-black-50'><i class='fa fa-arrow-down'></i>&nbsp;Internal</span>&nbsp;";
							}else{
								echo "<span class='badge text-black-50'><i class='fa fa-ban'></i>&nbsp;Rahasia</span>&nbsp;";
						}
			  
			  			if ($step==0){ 
								echo "<span class='badge badge-primary'>Draft</span>";
							}
							elseif ($step==1){
								echo "<span class='badge badge-warning'>Verifikasi</span>";
							}
							elseif ($step==10){
								echo "<span class='badge badge-danger'>Ditolak</span>";
							}
							elseif ($step==2){
								echo "<span class='badge badge-success'>Publish</span>";
							}
				?>
			  <div class="badge badge-primary"><?php echo $d['kategori_nama'] ?></div>
			  	
			</div>
        
         	<div class="pull-left mb-2">
			  <i class="fa fa-eye mr-n1 ml-1"></i>&nbsp; <?php echo $d['posting_dibaca'] ?>
			  <small class="text-muted ml-1">
            	<?php 
			 		setlocale(LC_TIME, 'id_ID.utf8');
			 		echo date('d M Y',strtotime($d['posting_tanggal']));
				?>
           	  </small>
			</div>
		</div>
<!-- akhir judul posting -->
       
        <hr class="mb-2 mt-1">
       	<a href="detail_member.php?id=<?php echo $d['PNS_ID']; ?>">
			<div class="clearfix">
				<div class="d-flex align-content-center">
						  <?php 
						  if($d['PNS_FOTO'] == ""){
							?>
							<img class="img-fluid mr-2" style="width: 40px;height: 40px" src="gambar/sistem/member.png">
							<?php
						  }else{
							?>
							<img class="img-fluid mr-2" style="width: 40px;height: 40px" src="gambar/member/<?php echo $d['PNS_FOTO'] ?>">
							<?php
						  }
						  ?>
				<div class="d-flex justify-content-start">
					<small class="text-dark">
						<b><?php echo $d['NAMA'] ?></b><br>
						<?php echo $d['JABATAN_NAMA']; ?>
					</small>

				</div>

				</div>   
			</div>
       	</a>
        <hr class="mb-0 mt-2">
        
        <!-- isi posting -->
         <div class="card-body overflow-hidden py-1 shadow">
         	<p><?php echo $d['posting_isi'] ?></p>
		 </div>
		 <!-- akhir isi posting -->
        
       <hr class="mt-0">
         
	<!-- batas konten -->		
		
      <?php if(isset($_SESSION['member_status'])){
		if($id_member == $d['PNS_ID']){
			$jen = $d['posting_jenis'];
			
			if($step==0 or $step==10){
				if($jen=="knowledge"){ //langsung publish
		?>
        	<div class="row justify-content-center">
        		<div class="alert col-lg-5 alert-success">
			 		<a href="posting_acc_act.php?id_posting=<?php echo $id_posting; ?>&id_member=<?php echo $id_member; ?>" onclick="return confirm('Yakin Posting ?')">
			 			<center><i class="fa fa-2x fa-send-o text-white mr-1"></i><b class="text-white">Publish</b></center>
			 		</a>
			 	</div>
      	<?php
				}else{
		  ?>
      		<div class="row justify-content-center">
        		<div class="alert alert-primary col-lg-5">
			 		<a href="posting_verif_act.php?id_posting=<?php echo $id_posting; ?>&id_member=<?php echo $id_member; ?>" onclick="return confirm('Yakin Kirim ke Verifikator?')">
			 			<center><i class="fa fa-2x fa-upload text-white mr-1"></i><b class="text-white">Kirim ke Verifikator</b></center>
			 		</a>
			 	</div>
      	<?php
				}
		  ?>
       			<div class="col-1"></div>
        		<div class="alert alert-warning col-lg-5">
					<a href="posting_edit.php?id_posting=<?php echo $id_posting; ?>" onclick="return confirm('Yakin Edit Posting?')">
						<center><i class="fa fa-2x fa-edit text-white mr-1"></i><b class="text-white">Edit Posting</b></center>
					</a>
			 	</div>
     		</div>
      <?php 
				} 
			}
		}
		?>
         
      <!-- Buat Komentar -->
      <?php 
      if(isset($_SESSION['member_status'])){
		  if ($step==0 or $step==10){
			  
		  }else{
        ?>
        
        <div class="text-center">
        	<a id="tombol_komen" type="button"><i class="fa fa-2x fa-comments"></i>&nbsp;Tambah<b>Komentar</b></a>
        </div>
        
        <div id="komentar">
        <form action="diskusi_act.php" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="posting" value="<?php echo $id_posting; ?>">
          <div class="form-group">
            <h6 class="ml-2"><i class="fa fa-pencil"></i>&nbsp;Tulis<b>komentar</b></h6>
            <textarea class="form-control" id="editor_komen" required name="isi" rows="3" placeholder="Masukkan komentar baru .."></textarea>
          </div>

          <div class="form-group pull-right">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-notification">Simpan Komentar</button>
            <button type="button" id="btn_batal_simpan_komentar" class="btn btn-danger">Batal</button>

            <div class="modal fade" id="modal-notification" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
              <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                <div class="modal-content bg-gradient-danger">
                  <div class="modal-header">
                    <h6 class="modal-title" id="modal-title-notification">Perhatian!</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="py-3 text-center">
                      <i class="ni ni-bell-55 ni-3x"></i>
                      <h4 class="heading mt-4">APAKAH ANDA YAKIN INGIN MENAMBAH KOMENTAR ?</h4>
                      <p>Klik 'Oke, Posting Sekarang!' untuk memposting, dan klik 'Batalkan' untuk membatalkan posting.</p>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Batalkan</button>
                    <input type="submit" class="btn btn-white" value="Oke, Posting Sekarang!">
                  </div>
                </div>
              </div>
            </div>

          </div>
        </form>
        </div>
        
      <?php
		  }
	  }
      ?>
	  <!-- akhir Buat Komentar --> 
         
         <!-- Tampilkan Komentar -->
         <?php
			$halaman = 20;
            $page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
            $mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
			$result = mysqli_query($koneksi, "SELECT * FROM diskusi,user WHERE diskusi_posting='$id_posting' and diskusi_member=PNS_ID ORDER BY diskusi_tanggal");
			$total = mysqli_num_rows($result);
			$pages = ceil($total/$halaman); 
			 
         $diskusi = mysqli_query($koneksi,"SELECT * FROM diskusi,user WHERE diskusi_posting='$id_posting' AND diskusi_member=PNS_ID ORDER BY diskusi_tanggal DESC LIMIT $mulai, $halaman");
         if(mysqli_num_rows($diskusi) > 0){			 
			$jumlahkomentar = mysqli_num_rows($diskusi);
            $no = $mulai+1;
			?>
													
		 <br>
		 <h6>.: <?php echo $total; ?>&nbsp;Komentar</h6>
		 <hr class="mb-3 mt-1">
         
         <?php
		 $nourut = 0;
         while($dis = mysqli_fetch_array($diskusi)){
			 $nourut++;
			 $id_diskusi = $dis['diskusi_id'];
         ?>
         
         <center>   
         <div class="card shadow col-lg-10">
          <table>
          	<tr>
          		<th width="85">
          			<a href="detail_member.php?id=<?php echo $dis['PNS_ID']; ?>">
					  <?php 
					  if($dis['PNS_FOTO'] == ""){
						?>
						<img class="img-fluid shadow" style="width: 65px;height: 65px" src="gambar/sistem/member.png">
						<?php
					  }else{
						?>
						<img class="img-fluid shadow" style="width: 65px;height: 65px" src="gambar/member/<?php echo $dis['PNS_FOTO'] ?>">
						<?php
					  }
					  ?>
					  
					</a>
          		</th>
          		<td>
          			<div class="card-title mb-n3">
          			<div class="clearfix">
              			<div class="pull-left">
          					<span class="text-dark"><b><?php echo $dis['NAMA'] ?></b></span>
          				</div>
          				<div class="pull-right">
							   <small class="text-muted"> <i><?php echo date('d-M-Y H:i:s',strtotime($dis['diskusi_tanggal'])) ?></i> &nbsp;</small>

							   <?php
								if(isset($_SESSION['member_status'])){
									if($dis['diskusi_member']==$id_member){
								?>
								<li class="nav-item dropdown">
									<a class="nav-link nav-link-icon" href="#" style="padding:7px;font-size:10pt;font-weight:bold" id="navbar-default_dropdown_1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<i class="fa fa-ellipsis-v"></i>
									</a>
									<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbar-default_dropdown_1">
										  <a class="dropdown-item" id=<?php echo "btn_edit_komentar".$nourut ?> href="#"><i class="fa fa-edit"></i>Edit Komentar</a>
										  <a class="dropdown-item" href="diskusi_hapus_act.php?id_posting=<?php echo $id_posting; ?>&id_diskusi=<?php echo $id_diskusi; ?>" onClick="return confirm('Yakin Hapus Komentar?')"><i class="fa fa-trash"></i>Hapus</a>
									</div>
								</li>
							<?php }} ?> 
						</div>
        			</div>
        			</div>
         		<hr class="mb-2 mt-3">
					<div class="card-text mb-n1 overflow-hidden" id=<?php echo "isi_komentar".$nourut ?>>
						<?php echo $dis['diskusi_isi']; ?>
					</div>
          		</td>
          	</tr>
         </table>
           
        <!-- Edit Komentar-->
        <div id=<?php echo "komentar_edit".$nourut ?>>
         <form action="diskusi_edit_act.php" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="posting" value="<?php echo $id_posting; ?>">
          <input type="hidden" name="id_diskusi" value="<?php echo $id_diskusi; ?>">
          <div class="form-group">
            <h6 class="ml-2"><i class="fa fa-pencil"></i>&nbsp;Edit<b>komentar</b></h6>
            <textarea class="form-control" id="<?php echo "editor_komentar".$nourut ?>" required name="isi" rows="3"><?php echo $dis['diskusi_isi']; ?></textarea>
          </div>

          <div class="form-group pull-right">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target=<?php echo "#modal-edit-komen".$nourut ?>></butto>Simpan Perubahan</button>
            <button type="button" id=<?php echo "btn_batal_edit_komentar".$nourut ?> class="btn btn-danger">Batal </button>

            <div class="modal fade" id=<?php echo "modal-edit-komen".$nourut ?> tabindex="-1" role="dialog" aria-labelledby="modal-edit-komen" aria-hidden="true">
              <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                <div class="modal-content bg-gradient-danger">
                  <div class="modal-header">
                    <h6 class="modal-title" id="modal-title-notification">Perhatian!</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="py-3 text-center">
                      <i class="ni ni-bell-55 ni-3x"></i>
                      <h4 class="heading mt-4">APAKAH ANDA YAKIN INGIN MENGEDIT KOMENTAR INI ?</h4>
                      <p>Klik 'Oke' untuk menyimpan perubahan, dan klik 'Batalkan' untuk membatalkan posting.</p>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Batalkan</button>
                    <input type="submit" class="btn btn-white" value="Oke, Simpan Perubahan!">
                  </div>
                </div>
              </div>
            </div>

          </div>
        </form>
       </div>
       
   <!-- akhir Edit Komentar--> 
   </div> <!-- card body komentar -->
   </center>
   <br/>      	
   
   <!-- pagination -->
  	<nav aria-label="...">
        <ul class="pagination justify-content-center">
        	<?php for ($i=1; $i<=$pages ; $i++){ ?>
                <?php if($page==$i){ ?>
                  <li class="page-item active">
                    <a class="page-link" href="#"><?php echo $i; ?> <span class="sr-only">(current)</span></a>
                  </li>
                <?php }else{ ?>
                  <li class="page-item">
                  	<a class="page-link" href="?halaman=<?php echo $i; ?>&id=<?php echo $id_posting ?>"><?php echo $i; ?></a>
                  </li>
                 <?php }
				} ?>
		</ul>
	</nav>
   <!-- end pagination -->
           
           <?php 
		  }
       }
      
    }
    ?>
			</div> <!-- card body content -->
  		</div> <!-- card -->
	</div> <!-- col-lg-9 -->

<?php include 'sidebar.php'; ?>

</div>
</div>

<?php include 'footer.php'; ?>
