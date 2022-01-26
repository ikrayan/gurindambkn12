<?php include 'header.php'; ?>


<div class="container col-lg-9">

  <div class="row">

    <div class="col-lg-9">

      <div class="card">
        <div class="card-body shadow-lg">

         <?php
         $id_posting = $_GET['id_posting'];
		 $id_verifikator = $_GET['id_verifikator'];
         $data = mysqli_query($koneksi,"select * from posting,kategori,user where posting_member=PNS_ID and kategori_id=posting_kategori and posting_id='$id_posting'");
         while($d = mysqli_fetch_array($data)){
          $id_member = $d['posting_member'];
		  $step = $d['posting_step'];
		  $akses = $d['posting_visibility']; 
          ?>
		  
  <!-- mulai konten -->	
        <div class="clearfix mb-n4">
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
			  <div class="badge badge-danger"><i class="fa fa-eye"></i>&nbsp; <?php echo $d['posting_dibaca'] ?></div>	
			</div>
        	
        	
        <!-- judul posting -->
         	<div class="pull-left">
			  <h2 class="ml-1 mb-0" style="line-height: 1.25"><?php echo $d['posting_judul'] ?></h2>
			  <small class="text-muted ml-2">
            	<?php 
			 		setlocale(LC_TIME, 'id_ID.utf8');
			 		echo "Dibuat pada : ".date('d M Y - H:i:s',strtotime($d['posting_tanggal']));
				?>
           	  </small>
			</div>
		<!-- akhir judul posting -->	
			
		</div> 
               
         <hr class="mb-0"/>
         
         <!-- isi posting -->
         <div class="card-body shadow-lg overflow-hidden">
         	<p><?php echo $d['posting_isi'] ?></p>
		 </div>
		 <!-- akhir isi posting -->
		 
		 <?php
         	$att = mysqli_query($koneksi,"select * from attachment,posting,user where attach_posting=posting_id and posting_member=PNS_ID and attach_posting='$id_posting'");
			if(mysqli_num_rows($att) > 0){
		 ?>
		 <div class="card-body mb-n4">
		 <table class="table table-sm table-hover">
		 	<thead class="thead-light">
		 		<tr>
		 			<th>Attachment</th>
		 			<th>Size</th>
		 			<!-- <th width="20%" colspan="2">Opsi</th> -->
		 		</tr>
		 	</thead>
		 	<tbody>
		 		<?php while($a = mysqli_fetch_array($att)){ 
						$file = "attachment/$a[attach_type]/$a[attach_name]";
				?>
		 		<tr>
		 			<td><a href="attachment/<?php echo $a['attach_type']; ?>/<?php echo $a['attach_name']; ?>" target="_blank"><?php echo $a['attach_name']; ?></td>
		 			<td><?php echo fsize($file); ?></td>
		 			<!-- <td><a href="attachment/" target="_blank"><span class="fa fa-folder"></span>Buka</a></td>
		 			<td><a href="attachment/"><span class="fa fa-download"></span>Download</a></td> -->
		 		</tr>
		 		<?php 
				} 
				?>
			</tbody>
		 </table>
		</div>
     	<?php 	
			}
		?>
      
       <hr class="bg-light shadow-lg mb-2">
       <!--
        <div class="clearfix mb-n4 shadow-lg">

            <div class="pull-left">
              <a href="detail_member.php?id=<?php //echo $d['PNS_ID']; ?>">
                <b><small class="ml-2 text-dark"><b><?php //echo $d['NAMA'] ?></b></small></b>
              </a>
            </div>
            <div class="pull-right">
            	<small class="text-muted mr-2"><?php //echo $d['JABATAN_NAMA']; ?></small>         	
            </div>

         </div>-->
       <div class="clearfix mb-n4 shadow-lg bg-light">
		   <center>
				<a href="detail_member.php?id=<?php echo $d['PNS_ID']; ?>">
					<b><small class="ml-2 text-dark">Author :&nbsp;<b><?php echo $d['NAMA'] ?></b>&nbsp;-&nbsp;<?php echo $d['JABATAN_NAMA']; ?></small></b>
				</a>
		   </center>
	   </div>
        
       <hr class="bg-light shadow-lg">
         
	<!-- batas konten -->	
	
		 <!-- Buat Komentar -->
      <?php 
      if(isset($_SESSION['member_status'])){
		  if ($step==0 or $step==10){
			  
		  }else{
        ?>
        
        <div class="text-center">
        	<a id="tombol_komen" type="button"><i class="fa fa-2x fa-comments"></i>&nbsp;Beri Review</a>
        </div>
        
        <div id="komentar">
        <form action="posting_verif_view_act.php" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="id_posting" value="<?php echo $id_posting; ?>">
          <div class="form-group">
            <h6 class="ml-2"><i class="fa fa-pencil"></i>&nbsp;Tulis<b>Review</b></h6>
            <textarea class="form-control" id="editor_komen" required name="isi" rows="3" placeholder="Masukkan komentar baru .."></textarea>
          </div>

          <div class="form-group pull-right">
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-notification">Simpan Review</button>
            <button type="button" id="btn_batal_simpan_komentar" class="btn btn-danger btn-sm">Batal</button>

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
        <br>
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
			$result = mysqli_query($koneksi, "select * from diskusi,user where diskusi_posting='$id_posting' and diskusi_member=PNS_ID order by diskusi_tanggal");
			$total = mysqli_num_rows($result);
			$pages = ceil($total/$halaman); 
			 
         $diskusi = mysqli_query($koneksi,"select * from diskusi,user where diskusi_posting='$id_posting' and diskusi_member=PNS_ID order by diskusi_tanggal DESC");
         if(mysqli_num_rows($diskusi) > 0){ 
			$jumlahkomentar = mysqli_num_rows($diskusi);
			$no = $mulai+1;
			?>
		 
		 <br>																						
		 <h6>.: <?php echo $jumlahkomentar; ?>&nbsp;Review Verifikator</h6>
		 <hr class="mb-n1"/>
         
         <?php
		 $nourut = 0;
         while($dis = mysqli_fetch_array($diskusi)){
			 $nourut++;
			 $id_diskusi = $dis['diskusi_id'];
         ?>
            
         <div class="card shadow">
            <div class="clearfix">
			 <div class="card-title">
              <div class="pull-left">
                <a href="detail_member.php?id=<?php echo $dis['PNS_ID']; ?>">
                  <?php 
                  if($dis['PNS_FOTO'] == ""){
                    ?>
                    <img class="img-fluid rounded-circle shadow" style="width: 40px;height: 40px" src="gambar/sistem/member.png">
                    <?php
                  }else{
                    ?>
                    <img class="img-fluid rounded-circle shadow" style="width: 40px;height: 40px" src="gambar/member/<?php echo $dis['PNS_FOTO'] ?>">
                    <?php
                  }
                  ?>
                  <span class="ml-2 text-dark"><b><?php echo $dis['NAMA'] ?></b></span>
                </a>
              </div>

              <div class="pull-right">
               <small class="text-muted"> <i><?php echo date('d-M-Y H:i:s',strtotime($dis['diskusi_tanggal'])) ?></i> &nbsp;</small>
               
           <?php
			if(isset($_SESSION['member_status'])){
				if($dis['diskusi_member']=$id_member){
			?>
                <li class="nav-item dropdown">
                	<a class="nav-link nav-link-icon" href="#" style="padding:7px;font-size:10pt;font-weight:bold" id="navbar-default_dropdown_1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="fa fa-ellipsis-v"></i>
					</a>
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbar-default_dropdown_1">
						  <a class="dropdown-item" id=<?php echo "btn_edit_komentar".$nourut ?> href="#"><i class="fa fa-edit"></i>Edit Komentar</a>
						  <a class="dropdown-item" href="posting_verif_view_diskusi_hapus_act.php?id_posting=<?php echo $id_posting; ?>&id_diskusi=<?php echo $id_diskusi; ?>" onClick="return confirm('Yakin Hapus Komentar?')"><i class="fa fa-trash"></i>Hapus</a>
					</div>
				</li>
			<?php 
				}
			} 
			?> 
            
             </div>
 			</div>
           <hr class="mb-2">
           	<div class="card-text mb-n1" id=<?php echo "isi_komentar".$nourut ?>>
				<table>
					<tr>
						<td>&nbsp;&nbsp;&nbsp;</td>
						<td><p><?php echo $dis['diskusi_isi']; ?></p></td>
					</tr>
				</table>
           	</div>
           	           	
        <!-- Edit Komentar-->
        <div id=<?php echo "komentar_edit".$nourut ?>>
         <form action="posting_verif_view_diskusi_edit_act.php" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="posting" value="<?php echo $id_posting; ?>">
          <input type="hidden" name="id_diskusi" value="<?php echo $id_diskusi; ?>">
          <div class="form-group">
            <h6 class="ml-2"><i class="fa fa-pencil"></i>&nbsp;Edit<b>Review</b></h6>
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
        
        </div>
         </div>
          <br> 
           <?php 
         }
       }
      ?>
      
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

      
      <hr class="bg-light mb-3"/>
        
         <button type="button" class="btn btn-success btn-block mb-3" data-toggle="modal" data-target="#modal-terima">TERIMA DAN PUBLISH</button>
         <button type="button" class="btn btn-danger btn-block mb-3" data-toggle="modal" data-target="#modal-tolak">TOLAK</button>
		 
		 <div class="modal fade" id="modal-terima" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
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
                        <h4 class="heading mt-4">APAKAH ANDA YAKIN MEMPUBLISH POSTINGAN INI ?</h4>
                        <p>Klik Oke untuk mempublish posting, dan klik 'Batalkan' untuk membatalkan</p>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Batalkan</button>
                      <a href="posting_acc_act.php?id_posting=<?php echo $id_posting; ?>&id_verifikator=<?php echo $id_verifikator; ?>"> <input type="button" class="btn btn-white" value="Oke, Publish Posting!"></a>
                    </div>
                  </div>
                </div>
           </div>
           
           <div class="modal fade" id="modal-tolak" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
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
                        <h4 class="heading mt-4">APAKAH ANDA YAKIN INGIN MENOLAK POSTINGAN INI ?</h4>
                        <p>Klik Oke untuk menolak posting, dan klik 'Batalkan' untuk membatalkan</p>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Batalkan</button>
                      <a href="posting_tolak_act.php?id_posting=<?php echo $id_posting; ?>&id_verifikator=<?php echo $id_verifikator; ?>"> <input type="button" class="btn btn-white" value="Oke, Tolak Posting!"></a>
                    </div>
                  </div>
                </div>
           </div>
		 	 	 
	<?php
    }
    ?>
    
	
  </div>
</div>

</div>

<?php include 'sidebar.php'; ?>

</div>
</div>

<?php include 'footer.php'; ?>
