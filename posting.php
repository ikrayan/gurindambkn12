<?php include 'header.php'; ?>

<?php
if (isset($_GET['alert'])) {
	if ($_GET['alert'] == 'gagal_ukuran') {
		echo "<script>window.alert('Ukuran melebihi ketentuan');</script>";
	}
}
?>

<div class="container col-lg-10">

	<div class="row">

		<div class="col-lg-9">

			<div class="card shadow mb-3">
				<div class="card-header">
					<h5 class="m-0"><b>Buat Posting Baru</b></h5>
				</div>
				<div class="card-body mb-n3">

					<div class="row justify-content-center">

						<div class="col-lg-4 mb-3" id="btn_knowledge">
							<div class="card card-body shadow bg-primary text-white" style="cursor: pointer;">
								<div class="clearfix">
									<div class="pull-left">
										<h5 class="text-white"><b>Manajemen</b>ASN</h5>
									</div>
									<div class="pull-right">
										<i class="fa fa-2x fa-book"></i>
									</div>
								</div>
							</div>
						</div>

						<div class="col-lg-4 mb-3" id="btn_share">
							<div class="card card-body shadow bg-warning text-white" style="cursor: pointer;">
								<div class="clearfix">
									<div class="pull-left">
										<h5 class="text-white">Lets<b>Share</b></h5>
									</div>
									<div class="pull-right">
										<i class="fa fa-2x fa-share-square-o"></i>
									</div>
								</div>
							</div>
						</div>

						<!--
				<div class="col-lg-4 mb-3" id="btn_masalah" style="cursor: pointer;">
				  <div class="card card-body shadow bg-danger text-white">
					<div class="clearfix">
						<div class="pull-left">
							<h5 class="text-white"><b>Permasalahan</b></h5>
						</div>
               	 		<div class="pull-right">
							<i class="fa fa-2x fa-xing"></i>
						</div>
                	 </div>
					</div>
				</div>-->

						<div class="col-lg-4 mb-3" id="btn_faq">
							<div class="card card-body shadow bg-success text-white" style="cursor: pointer;">
								<div class="clearfix">
									<div class="pull-left">
										<h5 class="text-white"><b>FAQ</b></h5>
									</div>
									<div class="pull-right">
										<i class="fa fa-2x fa-question"></i>
									</div>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
			<hr class="mt-3 mb-3">

			<!-- mulai form input knowledge -->
			<div id="divFormKnowledge">
				<div class="card shadow mb-3">
					<div class="card-body">
						<h5 class="m-0 text-black-50"><b>Manajemen</b>ASN</h5>
						<br>
						<form id="formKnowledge" method="post" enctype="multipart/form-data">

							<div class="table-responsive">
								<table class="table">
									<tr>
										<th><b>Jenis</b></th>
										<td><select name="jenis" class="form-control col-lg-2" id="jenis">
												<option value="regulasi">Regulasi</option>
												<option value="dokumen">Knowledge</option>

											</select>
										</td>
									</tr>
									<tr>
										<th><b>Kategori Fungsi</b></th>
										<td>
											<select class="selectpicker form-control" name="kategori" id="kategori" data-live-search="true" required>
												<?php
												$data = mysqli_query($koneksi, "select * from kategori order by kategori_nama ASC");
												while ($d = mysqli_fetch_array($data)) {
												?>
													<option value="<?php echo $d['kategori_id'] ?>"><?php echo $d['kategori_nama'] ?></option>
												<?php
												}
												?>
											</select>
										</td>
									</tr>
									<tr>
										<th><b>Judul</b></th>
										<td><input type="text" class="form-control" required="required" name="judul" placeholder="Masukkan judul .."></td>
									</tr>

									<tr>
										<!--
           		<th><b>Jadikan Publik</b></th>
           		<td><input type="checkbox" name="visibility" value="publik"></td> -->
										<th><b>Akses</b></th>
										<td><select name="akses" class="form-control col-lg-2" id="akses">
												<option value="publik">Publik</option>
												<option value="internal">Internal</option>
												<option value="rahasia">Rahasia</option>
											</select>
										</td>
									</tr>
									<tr>
										<th><b>Attachment</b><br><small><i>(Max Size: 1 Gb)</i></small></th>
										<td>
											<input class="form-control" type="file" name="attach[]" id="fileku" multiple />
										</td>
									</tr>
									<tr>
										<th><b>Deskripsi</b></th>
										<td><textarea class="form-control" id="editor_forum" required name="isi"></textarea></td>
									</tr>

								</table>
							</div>
							<br>
							<div class="form-group">
								<button type="submit" class="btn btn-primary btn-block mb-3" data-toggle="modal" data-target="#myModal" data-backdrop="static" data-keyboard="false" onClick="return confirm('Yakin Simpan Posting ?')">Simpan</button>
								<button class="btn btn-outline-danger btn-block mb-3 " onclick="history.back();">Batal</button>
							</div>

							<!-- Modal attachment -->

							<!-- end Modal attachment -->

						</form>
					</div>
				</div>
			</div>
			<!-- akhir form input knowledge -->

			<!-- mulai form input share -->
			<div id="divFormShare">
				<div class="card shadow mb-3">
					<div class="card-body">
						<h5 class="m-0 text-black-50">Lets<b>Share</b></h5>
						<br>
						<form id="formShare" method="post" enctype="multipart/form-data">

							<div class="table-responsive">
								<table class="table">
									<input type="hidden" name="jenis" id="jenis" value="share">
									<input type="hidden" name="kategori" id="kategori" value="0">
									<tr>
										<th><b>Judul</b></th>
										<td><input type="text" class="form-control" required="required" name="judul" placeholder="Masukkan judul .."></td>
									</tr>

									<tr>
										<!--
           		<th><b>Jadikan Publik</b></th>
           		<td><input type="checkbox" name="visibility" value="publik"></td> -->
										<th><b>Akses</b></th>
										<td><select name="akses" class="form-control col-lg-2" id="akses">
												<option value="publik">Publik</option>
												<option value="internal">Internal</option>
												<option value="rahasia">Rahasia</option>
											</select>
										</td>
									</tr>
									<tr>
										<th><b>Attachment</b><br><small><i>(Max Size: 1 Gb)</i></small></th>
										<td>
											<input class="form-control" type="file" name="attach[]" id="fileku" multiple />
										</td>
									</tr>
									<tr>
										<th><b>Deskripsi</b></th>
										<td><textarea class="form-control" id="editor_share" required name="isi"></textarea></td>
									</tr>

								</table>
							</div>
							<br>
							<div class="form-group">
								<button type="submit" class="btn btn-primary btn-block mb-3" data-toggle="modal" data-target="#myModal" data-backdrop="static" data-keyboard="false" onClick="return confirm('Yakin Simpan Posting ?')">Simpan</button>
								<button class="btn btn-outline-danger btn-block mb-3 " onclick="history.back();">Batal</button>
							</div>

						</form>
					</div>
				</div>
			</div>
			<!-- akhir form input share -->

			<!-- mulai form input masalah 
        <div id="divFormMasalah">
          <div class="card shadow">
			<div class="card-body">
			<h5 class="m-0 text-black-50"><b>.: Tambah Data Permasalahan</b></h5>
			<br>
          <form id="formMasalah" method="post" enctype="multipart/form-data">
            <table class="table">
            	<tr>
					<th><b>Status Permasalahan</b></th>
					<td>
					   <select class="form-control col-lg-3" name="masalah" id="masalah" required>						
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
						<?php /*
						$data = mysqli_query($koneksi,"select * from kategori order by kategori_nama ASC");
						while($d = mysqli_fetch_array($data)){
						  ?>
						  <option value="<?php echo $d['kategori_id'] ?>"><?php echo $d['kategori_nama'] ?></option>
						  <?php 
						} */
						?>
					  </select>
					</td>
				</tr>
				<tr>
					<th><b>Attachment</b><br><small><i>(Max Size: 1 Gb)</i></small></th>
					<td><input class="form-control" type="file" name="attach[]" multiple /></td>
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
	  </div>
	</div>
        <!-- akhir form input masalah -->

			<!-- Modal attachment -->
			<div id="myModal" class="modal fade" role="dialog" aria-hidden="true" tabindex="-1">
				<div class="modal-dialog">
					<!-- konten modal-->
					<div class="modal-content">
						<!-- heading modal 
							<button type="button" class="close" data-dismiss="modal">&times;</button> -->
						<div class="modal-header">
							<h5 class="modal-title">Processing ...</h5>
						</div>
						<!-- body modal -->
						<div class="modal-body">
							<!-- progress bar -->
							<div class="col-lg-12">
								<div class="progress" style="height: 25px">
									<div id="progressBar" class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%">
										<span class="sr-only">0% Complete</span>
									</div>
								</div>
							</div>
							<!-- end progress bar data-toggle="modal" data-target="#modal-notification" -->
						</div>
						<!-- footer modal 
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Tutup Modal</button>
							</div> -->
					</div>
				</div>
			</div>
			<!-- end Modal attachment -->

		</div>

		<?php include 'sidebar.php'; ?>

	</div>
</div>

<?php include 'footer.php'; ?>