<?php //include 'header.php'; 
?>

</div>
<!--tutup div container-->

<!-- Modal welcome -->
<div class="modal" id="welcome" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header mb-0">
				<h5 class="modal-title mb-0" style="line-height: 1.4"><b>Selamat Datang</b><br><?php echo $_SESSION['member_nama']; ?></h5>
				<button class="btn btn-sm mt-2 mb-0" data-dismiss="modal" aria-label="Close"><i class="fa fa-2x fa-close"></i></button>
			</div>
			<div class="modal-body">
				<p>Hello</p>
			</div>
			<!--<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">
			  Close
			</button>
		  </div>-->
		</div>
	</div>
</div>
<!-- Akhir Modal welcome -->

<!-- Modal notif login -->
<div class="modal" id="notifLogin" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header mb-0">
				<h5 class="modal-title mb-0"><b>Notifikasi</b></h5>
			</div>
			<div class="modal-body my-0">
				Maaf, silahkan login terlebih dahulu untuk melihat postingan ini !
			</div>
			<div class="modal-footer">
				<div class="row justify-content-end mx-2 my-0">
					<a href="index.php" class="btn btn-secondary"><i class="fa fa-home"></i>&nbsp;Kembali</a>
					<a href="masuk.php?id_posting=<?php echo $id_posting; ?>" class="btn btn-primary"><i class="fa fa-sign-in"></i>&nbsp;Login</a>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Akhir notif login -->

<?php
$posting = mysqli_query($koneksi, "SELECT * FROM posting ORDER BY posting_id DESC LIMIT 1");
while ($p = mysqli_fetch_array($posting)) {
	$idPostingJS = $p['posting_id'];
}
?>

<!-- Modal posting -->
<div id="modalPosting" class="modal fade" role="dialog" aria-hidden="true" tabindex="-1">
	<div class="modal-dialog modal-lg" role="form">
		<!-- konten modal-->
		<div class="modal-content">
			<div class="d-flex justify-content-center mt-3 mb-0">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btnCM">
					<span aria-hidden="true"><i class="fa fa-close"></i></span>
				</button>
			</div>
			<div class="row justify-content-center m-3">

				<div class="col-lg-4 mb-3" id="btn_knowledge">
					<div class="card card-body shadow bg-primary text-white" style="cursor: pointer;">
						<div class="clearfix">
							<div class="pull-left">
								<h5 class="text-white"><b>KNOWLEDGE</b></h5>
							</div>
							<div class="pull-right">
								<i class="fa fa-2x fa-book"></i>
							</div>
						</div>
					</div>
				</div>

				<div class="col-lg-4 mb-3" id="btn_forum">
					<div class="card card-body shadow bg-warning text-white" style="cursor: pointer;">
						<div class="clearfix">
							<div class="pull-left">
								<h5 class="text-white"><b>FORUM</b></h5>
							</div>
							<div class="pull-right">
								<i class="fa fa-2x fa-forumbee"></i>
							</div>
						</div>
					</div>
				</div>

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

			<!-- mulai div form knowledge -->
			<div id="divFormKnowledge">

				<!-- heading modal -->
				<div class="modal-header mb-n3 mt-n4">
					<h5 class="modal-title text-black-50 ml-3"><b>.: Form Tambah Knowledge</b></h5>
				</div>

				<!-- body modal -->
				<div class="modal-body mb-0">

					<!-- mulai form input knowledge -->

					<form id="formKnowledge" method="post" enctype="multipart/form-data">

						<div class="table-responsive">
							<table class="table">
								<tr>
									<th><b>Jenis</b></th>
									<td><select name="jenis" class="form-control col-lg-3" id="jenis">
											<option value="knowledge">Knowledge</option>
											<option value="regulasi">Regulasi</option>
										</select>
									</td>
								</tr>
								<tr>
									<th><b>Kategori</b></th>
									<td>
										<select class="selectpicker form-control" name="kategori" id="kategori" data-live-search="true" required>
											<?php
											$data = mysqli_query($koneksi, "select * from kategori order by kategori_jenis ASC, kategori_nama ASC");
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
									<td><input type="text" class="form-control" name="judul" id="judul" placeholder="Masukkan judul .." required></td>
								</tr>
								<tr>
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
									<td><textarea class="form-control" id="editor_forum" name="isi" required></textarea></td>
								</tr>
								<tr>
									<th><b>Tags</b><br><small><i>(Pisahkan dengan koma)</i></small></th>
									<td><input type="text" class="form-control" name="tags" id="tags" placeholder="tag1,tag2,..."></td>
								</tr>
								<tr>
									<th></th>
									<td>
										<div class="d-flex justify-content-end">
											<button class="btn btn-secondary mb-3 col-lg-6" data-dismiss="modal" aria-label="Close" id="batalPosting">Batal</button>
											<button type="submit" id="btnSimpanPosting" class="btn btn-primary mb-3 col-lg-6" data-backdrop="static" data-keyboard="false">Simpan</button>
										</div>
									</td>
								</tr>
							</table>
						</div>
					</form>
				</div>

			</div>
			<!-- akhir div form input knowledge data-toggle="modal"  data-target="#myModal" -->

			<!-- mulai div form forum -->
			<div id="divFormForum">

				<!-- heading modal -->
				<div class="modal-header mb-n3 mt-n4">
					<h5 class="modal-title text-black-50 ml-3"><b>.: Form Tambah Forum</b></h5>
				</div>

				<!-- body modal -->
				<div class="modal-body mb-0">

					<!-- mulai form input forum -->

					<form id="formForum" method="post" enctype="multipart/form-data">

						<div class="table-responsive">
							<table class="table">
								<tr>
									<th><b>Kategori</b></th>
									<td>
										<select class="selectpicker form-control" name="kategori" id="kategori" data-live-search="true" required>
											<?php
											$data = mysqli_query($koneksi, "select * from kategori order by kategori_jenis ASC, kategori_nama ASC");
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
									<th><b>Judul Forum</b></th>
									<td><input type="text" class="form-control" name="judul" id="judul" placeholder="Masukkan judul .." required></td>
								</tr>
								<tr>
									<th><b>Detail Forum</b></th>
									<td><textarea class="form-control" id="editor_forum2" name="isi" required></textarea></td>
								</tr>
								<tr>
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
									<th><b>Tags</b><br><small><i>(Pisahkan dengan koma)</i></small></th>
									<td><input type="text" class="form-control" name="tags" id="tags" placeholder="tag1,tag2,..."></td>
								</tr>
								<tr>
									<th></th>
									<td>
										<div class="d-flex justify-content-end">
											<button class="btn btn-secondary mb-3 col-lg-6" data-dismiss="modal" aria-label="Close" id="batalPosting">Batal</button>
											<button type="submit" id="btnSimpanPosting" class="btn btn-primary mb-3 col-lg-6" data-backdrop="static" data-keyboard="false">Simpan</button>
										</div>
									</td>
								</tr>
							</table>
						</div>
					</form>
				</div>

			</div>
			<!-- akhir div form forum -->

			<!-- mulai div form faq -->
			<div id="divFormFAQ">

				<!-- heading modal -->
				<div class="modal-header mb-n3 mt-n4">
					<h5 class="modal-title text-black-50 ml-3"><b>.: Form Tambah FAQ</b></h5>
				</div>

				<!-- body modal -->
				<div class="modal-body">

					<!-- mulai form input faq -->

					<form id="formFAQ" method="post">

						<div class="table-responsive">
							<table class="table">
								<tr>
									<th><b>Kategori</b></th>
									<td>
										<select class="selectpicker form-control" name="kategoriFAQ" id="kategoriFAQ" data-live-search="true" required>
											<?php
											$data = mysqli_query($koneksi, "select * from kategori order by kategori_jenis ASC, kategori_nama ASC");
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
									<th><b>Topik</b></th>
									<td>
										<select class="selectpicker form-control mb-2" name="topik" id="topik" data-live-search="true">
											<option value="pilih">Pilih Topik</option>
											<option value="tambahTopik">+ Tambah Topik Baru</option>
											<?php
											$datat = mysqli_query($koneksi, "select * from faq_topik order by faq_topik_id DESC");
											while ($dt = mysqli_fetch_array($datat)) {
											?>
												<option value="<?php echo $dt['faq_topik_id'] ?>"><?php echo $dt['faq_topik'] ?></option>
											<?php
											}
											?>
										</select>
										<br>
										<!--<a href="#" id="btnAddTopik"><small><b class="text-black-50">+ Tambah topik baru</b></small></a>-->
										<input type="text" class="form-control mt-2" name="addTopik" id="addTopik" placeholder="Masukkan topik baru ..">
									</td>
								</tr>
								<tr>
									<th><b>Akses</b></th>
									<td><select name="viewer" class="form-control col-lg-2" id="viewer">
											<option value="publik">Publik</option>
											<option value="internal">Internal</option>
										</select>
									</td>
								</tr>
								<tr>
									<th><b>Pertanyaan</b></th>
									<td><textarea class="form-control" id="editor_Q" name="isi_Q" required></textarea></td>
								</tr>
								<tr>
									<th><b>Jawaban</b></th>
									<td><textarea class="form-control" id="editor_A" name="isi_A" required></textarea></td>
								</tr>
								<tr>
									<th></th>
									<td>
										<div class="d-flex justify-content-end">
											<button class="btn btn-secondary mb-3 col-lg-6" id="btnBatalFAQ" data-dismiss="modal" aria-label="Close">Batal</button>
											<button type="submit" id="btnSimpanFAQ" class="btn btn-primary mb-3 col-lg-6">Simpan</button>
										</div>
									</td>
								</tr>
							</table>
						</div>
					</form>
				</div>

			</div>
			<!-- akhir div form input  faq -->
			<hr class="m-0 shadow">
			<div class="modal-footer m-0 py-3 shadow">
				<b>GURINDAM XII BKN</b>
			</div>
		</div>

	</div>
</div>
<!-- end Modal posting -->

<!-- Modal PROCESSING -->
<div id="myModal" class="modal" role="dialog" aria-hidden="true" tabindex="-1">
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
			<!-- footer modal -->
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal" id="btnBatalProses">Batalkan</button>
			</div>
		</div>
	</div>
</div>
<!-- end Modal PROCESSING -->

<!--Modal chekced success-->
<div id="suksesgif" class="modal fade" role="dialog" aria-hidden="true" tabindex="-1">
	<div class="modal-dialog">
		<!-- konten modal-->
		<div class="modal-content">
			<img src="gambar/check.gif" />
		</div>
	</div>
</div>
<!--End Modal chekced success-->

<!--modal laporkan-->
<div id="modalReport" class="modal fade" role="dialog" aria-hidden="true" tabindex="-1">
	<div class="modal-dialog">
		<!-- konten modal-->
		<div class="modal-content">
			<!-- heading modal -->
			<div class="modal-header mb-0">
				<h5 class="modal-title mb-0" style="line-height: 1.4">Form Lapor Posting</h5>
				<button class="btn btn-sm" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
			</div>
			<!-- body modal -->
			<div class="modal-body">
				<i class="fa fa-2x fa-warning"></i>&nbsp;Under Construction
			</div>
			<!-- footer modal -->
			<div class="modal-footer">
				<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Batalkan</button>
				<button type="button" class="btn btn-sm btn-primary">Kirim</button>
			</div>
		</div>
	</div>
</div>
<!--end modal laporkan-->

<footer class="mt-3">
	<div class="navbar-light bg-light py-3">
		<center>
			<p class="text-muted text-center m-0" style="font-size: 11pt;font-weight: bold">
				<b>GURINDAM - Gapura Pembelajaran Individu Aktif Mandiri</b>
			</p>
		</center>
	</div>
</footer>

<script src="assets_forum/assets/vendor/jquery/jquery.min.js"></script>
<script src="assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="assets_forum/assets/vendor/popper/popper.min.js"></script>
<script src="assets/bower_components/ckeditor/ckeditor.js"></script>
<script src="assets_forum/assets/vendor/headroom/headroom.min.js"></script>
<script src="assets_forum/assets/js/argon.js?v=1.1.0"></script>
<script src="assets_forum/assets/vendor/bootstrap/bootstrap.min.js"></script>
<script src="assets_forum/assets/vendor/bootstrap-select/js/bootstrap-select.js"></script>
<link rel="stylesheet" href="assets_forum/summernote2/summernote-bs4.css">
<script src="assets_forum/summernote2/summernote-bs4.js"></script>


<!--
<script src="http://malsup.github.com/jquery.form.js"></script> 
<script src="assets/bower_components/jquery-ui/jquery-ui.min.js"></script>
<script src="assets_forum/assets/vendor/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="assets_forum/assets/vendor/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="assets/dist/js/adminlte.min.js"></script>
<script src="assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
-->
<?php
if (isset($_GET['alert'])) {
	if ($_GET['alert'] == "sukses") {
		echo "<script>
					 $(document).ready(function(){
						 $('#welcome').modal('show');
					 });
				</script>";
	}

	if ($_GET['alert'] == "login") {
		echo "<script>
					 $(document).ready(function(){
						 $('#notifLogin').modal('show');
					 });
				</script>";
	}
}
?>

<?php // include 'assets_forum/footerForms.php'; 
?>

<script>
	$(document).ready(function() {

		$('#btnSimpanPosting').click(function() {
			let a = document.forms["formKnowledge"]["judul"].value;
			let b = document.forms["formKnowledge"]["isi"].value;

			if (a == null || a == "", b == null || b == "") {
				alert("Formnya diisi dulu ya !");
				return false;
			}

			let r = confirm("Yakin Simpan Posting");
			if (r == true) {
				$("#myModal").modal();
			} else {
				return false;
			}
		});

		$('#btnUpdatePosting').click(function() {
			let a = document.forms["formEditKnowledge"]["judul"].value;
			let b = document.forms["formEditKnowledge"]["isi"].value;

			if (a == null || a == "", b == null || b == "") {
				alert("Form Editnya diisi dulu ya !");
				return false;
			}

			let r = confirm("Yakin Simpan Posting");
			if (r == true) {
				$("#myModal").modal();
			} else {
				return false;
			}
		});

		$('#btnSimpanFAQ').click(function() {
			let a = document.forms["formFAQ"]["isi_Q"].value;
			let b = document.forms["formFAQ"]["isi_A"].value;
			let t = document.forms["formFAQ"]["topik"].value;
			let at = document.forms["formFAQ"]["addTopik"].value;

			if (a == null || a == "", b == null || b == "") {
				alert("Formnya diisi dulu ya !");
				return false;
			}
			if (t == "pilih" & (at == null || at == "")) {
				alert("Silahkan pilih topik atau tambah topik baru !");
				return false;
			}
		});

		$('#batalPosting').click(function() {
			$('#fileku').val('');
			$('#judul').val('');
			$("#divFormKnowledge").hide();
		});

		$('#btnBatalFAQ').click(function() {
			$('#judul').val('');
			$('#addTopik').val('');
			$('#editor_Q').text('');
			$('#editor_A').text('');
			$("#divFormFAQ").hide();
		});

		$('#topik').on('change', function() {
			if (this.value == "tambahTopik") {
				$("#addTopik").toggle("fast");
			} else {
				$("#addTopik").hide();
			}
		});

		$('#table-datatable').DataTable({
			'paging': true,
			'lengthChange': true,
			'searching': false,
			'ordering': true,
			'info': true,
			'autoWidth': false,
		});

		$('#table-posting-datatable').DataTable({
			'paging': true,
			'lengthChange': true,
			'searching': false,
			'ordering': true,
			'info': true,
			'autoWidth': false,
			'pageLength': 10,
			'order': [
				[0, "desc"]
			],
			'columnDefs': [{
				"targets": [0],
				"visible": false,
				"searchable": false
			}]
		});

		$('#table-attach-datatable').DataTable({
			'paging': true,
			'lengthChange': false,
			'searching': true,
			'ordering': true,
			'info': false,
			'autoWidth': false,
			'pageLength': 5,
			'order': [
				[0, "asc"]
			],

		});

		$("#komentar").hide();
		$("#divFormKnowledge").hide();
		$("#divFormFAQ").hide();
		$("#divFormForum").hide();
		$("#addTopik").hide();
		$("#btn_extra_up").hide();
		//$("#extra").hide();

		$("#tombol_komen").click(function() {
			$("#komentar").toggle("fast");
			$("#tombol_komen").toggle("fast");
		})

		$("#btn_batal_simpan_komentar").click(function() {
			$("#tombol_komen").toggle("fast");
			$("#komentar").hide();
		})

		$("#btn_knowledge").click(function() {
			$("#divFormKnowledge").toggle("fast");
			$("#divFormFAQ").hide();
			$("#divFormForum").hide();
		})

		$("#btn_forum").click(function() {
			$("#divFormForum").toggle("fast");
			$("#divFormFAQ").hide();
			$("#divFormKnowledge").hide();
		})

		$("#btn_faq").click(function() {
			$("#divFormFAQ").toggle("fast");
			$("#divFormKnowledge").hide();
			$("#divFormForum").hide();
		})

		/*
			 $("#btnAddTopik").click(function() {
			    $("#addTopik").toggle("fast");
				document.getElementById("topik").selectedIndex = 0;
			 })
			 */

		$("#btnCM").click(function() {
			$("#divFormKnowledge").hide();
			$("#divFormFAQ").hide();
			$('#judul').val('');
		})

		$("#btn_extra_down").click(function() {
			$("#btn_extra_up").toggle("fast");
			$("#btn_extra_down").hide();
			$("#extra").toggle("fast");
		})

		$("#btn_extra_up").click(function() {
			$("#btn_extra_down").toggle("fast");
			$("#btn_extra_up").hide();
			$("#btn_extra_up").hide();
			$("#extra").toggle("fast");
		})

		//looping komentar diskusi
		var jmlkomen = <?php echo json_encode($jumlahkomentar) ?>;
		for (let i = 1; i <= jmlkomen; i++) {
			$("#komentar_edit".concat(i)).hide();

			$("#btn_edit_komentar".concat(i)).click(function() {
				$("#isi_komentar".concat(i)).toggle("fast");
				$("#komentar_edit".concat(i)).toggle("fast");
			})

			$("#btn_batal_edit_komentar".concat(i)).click(function() {
				$("#isi_komentar".concat(i)).toggle("fast");
				$("#komentar_edit".concat(i)).toggle("fast");
			})

			$('#editor_komentar'.concat(i)).summernote({
				height: '100px',
				callbacks: {
					onImageUpload: function(image) {
						uploadImage2(image[0]);
						console.log(image[0]);
					},
					onMediaDelete: function(target) {
						deleteImage2(target[0].src);
					}
				}
			});

			function uploadImage2(image) {
				var data = new FormData();
				data.append("file", image);

				$.ajax({
					url: 'summernote_upload.php',
					cache: false,
					contentType: false,
					processData: false,
					data: data,
					type: "post",
					success: function(url) {
						var image = $('<img>').attr('src', 'https://' + url);
						$('#editor_komentar'.concat(i)).summernote("insertNode", image[0]);
					},
					error: function(data) {
						console.log(data);
					}
				});

			}

			function deleteImage2(src) {
				$.ajax({
					data: {
						src: src
					},
					type: "POST",
					url: "summernote_delete.php",
					cache: false,
					success: function(response) {
						console.log(response);
					}
				});
			}

		}
		// akhir looping komentar diskusi

		$('#editor_forum').summernote({
			height: '150px',
			callbacks: {
				onImageUpload: function(image) {
					uploadImage(image[0]);
					console.log(image[0]);
				},
				onMediaDelete: function(target) {
					deleteImage(target[0].src);
				}
			}
		});

		$('#editor_forum2').summernote({
			height: '150px',
			callbacks: {
				onImageUpload: function(image) {
					uploadImage(image[0]);
					console.log(image[0]);
				},
				onMediaDelete: function(target) {
					deleteImage(target[0].src);
				}
			}
		});

		$('#editor_Q').summernote({
			height: '100px',
			callbacks: {
				onImageUpload: function(image) {
					uploadImage(image[0]);
					console.log(image[0]);
				},
				onMediaDelete: function(target) {
					deleteImage(target[0].src);
				}
			}
		});

		$('#editor_A').summernote({
			height: '100px',
			callbacks: {
				onImageUpload: function(image) {
					uploadImage(image[0]);
					console.log(image[0]);
				},
				onMediaDelete: function(target) {
					deleteImage(target[0].src);
				}
			}
		});

		$('#editor_komen').summernote({
			height: '100px',
			callbacks: {
				onImageUpload: function(image) {
					uploadImage(image[0]);
					console.log(image[0]);
				},
				onMediaDelete: function(target) {
					deleteImage(target[0].src);
				}
			}
		});

		function uploadImage(image) {
			var data = new FormData();
			data.append("file", image);

			$.ajax({
				url: 'summernote_upload.php',
				cache: false,
				contentType: false,
				processData: false,
				data: data,
				type: "post",
				success: function(url) {
					var image = $('<img>').attr('src', 'https://' + url);
					$('#editor_forum').summernote("insertNode", image[0]);
					$('#editor_komen').summernote("insertNode", image[0]);
					$('#editor_share').summernote("insertNode", image[0]);
				},
				error: function(data) {
					console.log(data);
				}
			});

		}

		function deleteImage(src) {
			$.ajax({
				data: {
					src: src
				},
				type: "POST",
				url: "summernote_delete.php",
				cache: false,
				success: function(response) {
					console.log(response);
				}
			});
		}
		/*
		// Javascript to enable link to tab
		var hash = location.hash.replace(/^#/, '');  // ^ means starting, meaning only match the first hash
		if (hash) {
			$('.nav-tabs a[href="#' + hash + '"]').tab('show');
		} 

		// Change hash for page-reload
		$('.nav-tabs a').on('shown.bs.tab', function (e) {
			window.location.hash = e.target.hash;
		})
		*/
	});
</script>