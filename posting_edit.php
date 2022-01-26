<?php include 'header.php'; ?>
     
<div class="container col-lg-9">

  <div class="row">

    <div class="col-lg-9">

      <div class="card">
        <div class="card-header">
          <h5 class="m-0"><b>Edit Posting</b></h5>
        </div>
        <div class="card-body">

		<?php
         $id_posting = $_GET['id_posting'];
         $data = mysqli_query($koneksi,"SELECT * FROM posting,kategori WHERE posting_kategori=kategori_id AND posting_id='$id_posting'");
         while($d = mysqli_fetch_array($data)){
		?>
          
        <form id="formEditKnowledge" method="post" enctype="multipart/form-data">
          <h5 class="text-black-50"><b>.: Edit Data Knowledge</b></h5>
          <div class="table-responsive">
           <table class="table">
           	<tr>
				<th><b>Jenis</b></th>
				<td><select name="jenis" class="form-control col-lg-3" id="jenis">
					<?php
			 			if($d['posting_jenis']=='knowledge'){
							echo "<option value='knowledge'>Knowledge</option>";
							echo "<option value='regulasi'>Regulasi</option>";
						}else{
							echo "<option value='regulasi'>Regulasi</option>";
							echo "<option value='knowledge'>Knowledge</option>";
						}
					?>
					</select>
				</td>
			</tr>           	
           	<tr>
           	 	<th><b>Kategori</b></th>
           	 	<td>
				   <select class="selectpicker form-control" name="kategori" id="kategori" data-live-search="true" required>
				    <option value="<?php echo $d['posting_kategori']; ?>"><?php echo $d['kategori_nama']; ?></option>
					<?php 
					$datak = mysqli_query($koneksi,"select * from kategori order by kategori_nama ASC");
					while($k = mysqli_fetch_array($datak)){
					  ?>
					  <option value="<?php echo $k['kategori_id'] ?>"><?php echo $k['kategori_nama'] ?></option>
					  <?php 
					}
					?>
				  </select>
              	</td>
           	</tr>
           	<tr>
           	 	<th><b>Judul</b></th>
           	 	<td><input type="text" class="form-control" required name="judul" value="<?php echo $d['posting_judul']; ?>"></td>
           	</tr>
           	<tr>
           		<th><b>Akses</b></th>
           		<td><select name="akses" class="form-control col-lg-2" id="akses">
           				<option value="<?php echo $d['posting_visibility']; ?>"><?php echo $d['posting_visibility']; ?></option>
           				<option value="publik">Publik</option>
           				<option value="internal">Internal</option>
           				<option value="rahasia">Rahasia</option>
           			</select>
				</td>
           	</tr>
           	
           	<?php
				 $att = mysqli_query($koneksi,"select * from attachment where attach_posting='$id_posting'");
				 if(mysqli_num_rows($att) > 0){
			?>
           	<tr>
           		<th><b>Attachment</b></th>
           		<td>
           		
          		<div class="table-responsive">
				 <table class="table table-sm table-hover">
					<thead class="thead-light">
						<tr>
							<th>Attachment</th>
							<th>Ukuran</th>
							<th>Opsi</th>
						</tr>
					</thead>
					<tbody>
						<?php while($a = mysqli_fetch_array($att)){ 
								$file = "attachment/$a[attach_name]";
						?>
						<tr>
							<td><a href="attachment/<?php echo $a['attach_name']; ?>" target="_blank"><?php echo $a['attach_name']; ?></td>
							<td><?php echo fsize($file); ?></td>
							<td><a href="attachment_hapus.php?id_attach=<?php echo $a['attach_id']; ?>&id_posting=<?php echo $id_posting; ?>&id_member=<?php echo $id_member; ?>" onclick="return confirm('Hapus Attachment?')"><span class="fa fa-trash-o"></span></a></td>
						<!-- <td><a href="attachment/"><span class="fa fa-download"></span>Download</a></td> -->
						</tr>
						<?php 
						}  
						?>
					</tbody>
				 </table>
				 </div>
          		</td>
           	</tr>
           	<?php 
				}
				?>
          	
           	<tr>
           		<th><b>Tambah Attachment</b><br><small><i>(Max Size: 1 Gb)</i></small></th>
           		<td>
           			<input type="file" class="form-control" name="attach[]" multiple />
           		</td>
           	</tr>
           	<tr>
           		<th><b>Deskripsi</b></th>
           		<td><textarea class="form-control" id="editor_forum" required name="isi"><?php echo $d['posting_isi']; ?></textarea></td>
           	</tr>
           	<tr>
				<th><b>Tags</b><br><small><i>(Pisahkan dengan koma)</i></small></th>
				<td><input type="text" class="form-control" name="tags" id="tags" value="<?php echo $d['posting_tags']; ?>"></td>
			</tr>
           	<tr>
				<th></th>
				<td>
					<div class="d-flex justify-content-end">
						<button class="btn btn-secondary mb-3 col-lg-6" onclick="history.back();">Batal</button>
						<button type="submit" id="btnUpdatePosting" class="btn btn-primary mb-3 col-lg-6" data-backdrop="static" data-keyboard="false">Simpan</button>
					</div>
				</td>
			</tr>	
           </table>
		</div>      
   	
   	<!-- Modal PROCESSING -->
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
							<!-- footer modal -->
							<div class="modal-footer">
								<button type="button" class="btn btn-danger" data-dismiss="modal" id="btnBatalProses">Batalkan</button>
							</div>
						</div>
					</div>
				</div>
    <!-- end Modal PROCESSING -->
   		 
   		 </form>
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
