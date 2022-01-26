<?php include 'header.php'; ?>

	<?php 
         if(isset($_GET['alert'])){
          if($_GET['alert'] == "gagal_ukuran"){
            echo "<script>window.alert('Ukuran melebihi ketentuan');</script>";
          }
        }
     ?>

<div class="container col-lg-10">

  <div class="row">

    <div class="col-lg-9">

      <div class="card">
        <div class="card-header">
          <h5 class="m-0"><b>Buat Posting Baru</b></h5>
        </div>
        <div class="card-body">
			<div class="row justify-content-md-center">
				<div class="col-4" id="btn_knowledge">
					<div class="card card-body shadow bg-primary text-white">
					 <div class="clearfix">
						<div class="pull-left">
							<h5 class="text-white"><b>Knowledge</b></h5>
						</div>
               	 		<div class="pull-right">
							<i class="fa fa-2x fa-file"></i>
						</div>
                	 </div>
					</div>
				<br/>
				</div>
				<div class="col-4" id="btn_masalah">
				  <div class="card card-body shadow bg-danger text-white">
					<div class="clearfix">
						<div class="pull-left">
							<h5 class="text-white"><b>Permasalahan</b></h5>
						</div>
               	 		<div class="pull-right">
							<i class="fa fa-2x fa-archive"></i>
						</div>
                	 </div>
					</div>
				<br/>
				</div>
			</div>
			
		<!-- mulai form input knowledge -->
		<div id="form-knowledge">
          <form action="posting_act.php" method="post" enctype="multipart/form-data">
          <h5 class="text-black-50"><b>.: Tambah Data Knowledge</b></h5>
           <table class="table">
           	<tr>
           	 	<th><b>Judul</b></th>
           	 	<td><input type="text" class="form-control" required="required" name="judul" placeholder="Masukkan judul .."></td>
           	</tr>
           	<tr>
           	 	<th><b>Kategori Fungsi</b></th>
           	 	<td>
				   <select class="selectpicker form-control" name="kategori" id="kategori" data-live-search="true" required>
					<?php 
					$data = mysqli_query($koneksi,"select * from kategori order by kategori_nama ASC");
					while($d = mysqli_fetch_array($data)){
					  ?>
					  <option value="<?php echo $d['kategori_id'] ?>"><?php echo $d['kategori_nama'] ?></option>
					  <?php 
					}
					?>
				  </select>
              	</td>
           	</tr>
           	<tr>
           		<th><b>Jadikan Publik</b></th>
           		<td><input type="checkbox" name="visibility" value="publik"></td>
           	</tr>
           	<tr>
           		<th><b>Attachment</b><br><small><i>(Max Size: 10mb)</i></small></th>
           		<td>
           			<input type="file" name="attach[]" multiple />
           			<!--<progress id="progressBar" value="0" max="100"></progress>
					<p id="status"></p>
					<p id="total"></p>-->
           		</td>
           	</tr>
           	<tr>
           		<th><b>Deskripsi</b></th>
           		<td><textarea class="form-control" id="editor_forum" required name="isi" placeholder="Masukkan isi diskusi .."></textarea></td>
           	</tr>
            
		</table>
            <div class="form-group">

              <button type="button" class="btn btn-primary btn-block mb-3" data-toggle="modal" data-target="#modal-notification">Simpan</button>
              <button type="button" class="btn btn-danger btn-block mb-3" onclick="history.back();">Batal</button>
              
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
                        <h4 class="heading mt-4">APAKAH ANDA YAKIN INGIN MEMPOSTING ?</h4>
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
        <!-- akhir form input knowledge -->
        
        <!-- mulai form input masalah -->
        <div id="form-masalah">
          <form action="posting_masalah_act.php" method="post" enctype="multipart/form-data">
           <h5 class="text-black-50"><b>.: Tambah Data Permasalahan</b></h5>
            <table class="table">
            	<tr>
					<th><b>Status Permasalahan</b></th>
					<td>
					   <select class="form-control" name="masalah" id="masalah" required>						
						  <option value="proses">Sedang Dalam Proses</option>
						  <option value="selesai">Telah Dilakukan</option>
					  </select>
					</td>
				</tr>
				<tr>
					<th><b>Judul</b></th>
					<td><input type="text" class="form-control" required="required" name="judul" placeholder="Masukkan judul .."></td>
				</tr>
				<tr>
					<th><b>Kategori Fungsi</b></th>
					<td>
					   <select class="selectpicker form-control" name="kategori" id="kategori" data-live-search="true" required>
						<?php 
						$data = mysqli_query($koneksi,"select * from kategori order by kategori_nama ASC");
						while($d = mysqli_fetch_array($data)){
						  ?>
						  <option value="<?php echo $d['kategori_id'] ?>"><?php echo $d['kategori_nama'] ?></option>
						  <?php 
						}
						?>
					  </select>
					</td>
				</tr>
				<tr>
					<th><b>Attachment</b></th>
					<td><input class="form-control-file" type="file" name="attach[]" multiple /></td>
				</tr>
				<tr>
					<th><b>Uraian Permasalahan</b></th>
					<td><textarea class="form-control" id="editor_masalah" name="isi_masalah"></textarea></td>
				</tr>
          		<tr>
					<th><b>Saran dan Tindaklanjut</b></th>
					<td><textarea class="form-control" id="editor_saran" name="isi_saran"></textarea></td>
				</tr>
           </table>

            <div class="form-group">

              <button type="button" class="btn btn-primary btn-block mb-3" data-toggle="modal" data-target="#modal-notification">Simpan Permasalahan</button>
              <button type="button" class="btn btn-danger btn-block mb-3" onclick="history.back();">Batal</button>
              
              <div class="modal fade" id="modal-notification2" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
                <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                  <div class="modal-content bg-gradient-danger">
                    <div class="modal-header">
                      <h6 class="modal-title" id="modal-title-notification2">Perhatian!</h6>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="py-3 text-center">
                        <i class="ni ni-bell-55 ni-3x"></i>
                        <h4 class="heading mt-4">APAKAH ANDA YAKIN INGIN MEMPOSTING ?</h4>
                        <p>Klik 'Oke, Posting Sekarang!' untuk memposting masalah, dan klik 'Batalkan' untuk membatalkan posting.</p>
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
        <!-- akhir form input masalah -->

        </div>
      </div>

    </div>

    <?php include 'sidebar.php'; ?>

  </div>
</div>

<?php include 'footer_old.php'; ?>
