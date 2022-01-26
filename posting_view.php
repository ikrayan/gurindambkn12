<?php include 'header.php'; ?>


<div class="container-fluid">

  <div class="row">

    <div class="col-lg-9">

      <div class="card">
        <div class="card-body">

         <?php
         $id = $_GET['id'];
         $data = mysqli_query($koneksi,"select * from posting,kategori,member where posting_member=member_id and kategori_id=posting_kategori and posting_id='$id'");
         while($d = mysqli_fetch_array($data)){
          $id_posting = $d['posting_id'];


          // update dibaca
          $posting = mysqli_query($koneksi,"select * from posting where posting_id='$id_posting'");
          $pp = mysqli_fetch_assoc($posting);
          $dibaca = $pp['posting_dibaca'];
          $dibaca_update = $dibaca+1;
          mysqli_query($koneksi,"update posting set posting_dibaca='$dibaca_update' where posting_id='$id_posting'")

          ?>
		  
          <div class="clearfix">
         	<div class="pull-left">
			  <div class="badge badge-primary"><?php echo $d['kategori_nama'] ?></div>
			  <div class="badge badge-danger"><i class="fa fa-eye"></i>&nbsp; <?php echo $d['posting_dibaca'] ?></div>

			  <h2><?php echo $d['posting_judul'] ?></h2>
			</div>
			
			<div class="pull-right">
	  			<?php 
						  
					$data = mysqli_query($koneksi,"select * from posting where posting_id='$id'");
			 				
			 		while($s = mysqli_fetch_array($data)){
						  
							$step = $s['posting_step'];
							if ($step==0){ 
								echo "<span class='badge btn-primary shadow'>Draft</span>";
							}
							elseif ($step==1){
								echo "<span class='badge btn-warning shadow'>Verifikasi</span>";
							}
							elseif ($step==10){
								echo "<span class='badge btn-danger shadow'>Ditolak</span>";
							}
							elseif ($step==2){
								echo "<span class='badge btn-success shadow'>Publish</span>";
							} ?>
							<br>
							<span class="badge btn-outline-primary shadow" ><?php echo $s['posting_visibility']; ?></span>
						
					<?php	
					}
					?>
		  		
			</div>
		  </div>
          <hr>

          <div class="clearfix">

            <div class="pull-left">
              <a href="detail_member.php?id=<?php echo $d['member_id']; ?>">
                <?php 
                if($d['member_foto'] == ""){
                  ?>
                  <img class="img-fluid rounded-circle shadow" style="width: 40px;height: 40px" src="gambar/sistem/member.png">
                  <?php
                }else{
                  ?>
                  <img class="img-fluid rounded-circle shadow" style="width: 40px;height: 40px" src="gambar/member/<?php echo $d['member_foto'] ?>">
                  <?php
                }
                ?>
                <b><span class="ml-2 text-dark"><?php echo $d['member_nama'] ?></span></b>
              </a>
            </div>

           <div class="pull-right pt-2">
             <small class="text-muted"><i><?php echo date('d-M-Y H:i:s',strtotime($d['posting_tanggal'])) ?></i></small>
           </div>

         </div>

         <br/>

         <p><?php echo $d['posting_isi'] ?></p>
		 
		 <hr>
		 
		 <?php
         	$att = mysqli_query($koneksi,"select * from attachment, posting, member where attach_posting=posting_id and posting_member=member_id and attach_posting='$id_posting'");
			if(mysqli_num_rows($att) > 0){
		 ?>
		 
		 <table class="table table-sm table-hover">
		 	<thead class="thead-light">
		 		<tr>
		 			<th>Attachment</th>
		 			<th>Ukuran</th>
		 			<!-- <th width="20%" colspan="2">Opsi</th> -->
		 		</tr>
		 	</thead>
		 	<tbody>
		 		<?php while($a = mysqli_fetch_array($att)){ 
						$file = "attachment/$a[member_id]/$a[attach_name]";
				?>
		 		<tr>
		 			<td><a href="attachment/<?php echo $a['member_id']; ?>/<?php echo $a['attach_name']; ?>" target="_blank"><?php echo $a['attach_name']; ?></td>
		 			<td><?php echo fsize($file); ?></td>
		 			<!-- <td><a href="attachment/" target="_blank"><span class="fa fa-folder"></span>Buka</a></td>
		 			<td><a href="attachment/"><span class="fa fa-download"></span>Download</a></td> -->
		 		</tr>
		 		<?php 
				} 
				?>
			</tbody>
		 </table>
		 
         <hr>
			<?php 	
			}
			?>
		 	
		<?php
			 if ($step==0 or $step==10){
			 ?>
         <a href="posting_edit.php?id=<?php echo $id_posting; ?>" onclick="return confirm('Yakin Edit Posting?')"><div class="alert alert-warning"><center><b class="text-white">Edit Posting</b></center></div></a>
		 <a href="posting_verif_act.php?id=<?php echo $id_posting; ?>&id_member=<?php echo $id_member; ?>" onclick="return confirm('Yakin Kirim ke Verifikator?')"><div class="alert alert-primary"><center><b class="text-white">Kirim ke Verifikator</b></center></div></a>
      <?php 
			 }
			?>
			
		
			<!-- komentar -->
		<?php
         $diskusi = mysqli_query($koneksi,"select * from diskusi,member where diskusi_posting='$id_posting' and diskusi_member=member_id");
         if(mysqli_num_rows($diskusi) > 0){ ?>
          
          <h5><b>.: Komentar</b></h5>
			<br>
         
          <?php
           while($dis = mysqli_fetch_array($diskusi)){
            ?>
		
		<div class="card">
            <div class="clearfix">
			 <div class="card-title">
              <div class="pull-left">
                <a href="detail_member.php?id=<?php echo $dis['member_id']; ?>">
                  <?php 
                  if($dis['member_foto'] == ""){
                    ?>
                    <img class="img-fluid rounded-circle shadow" style="width: 40px;height: 40px" src="gambar/sistem/member.png">
                    <?php
                  }else{
                    ?>
                    <img class="img-fluid rounded-circle shadow" style="width: 40px;height: 40px" src="gambar/member/<?php echo $dis['member_foto'] ?>">
                    <?php
                  }
                  ?>
                  <span class="ml-2 text-dark"><b><?php echo $dis['member_nama'] ?></b></span>
                </a>
              </div>

              <div class="pull-right pt-2">
               <small class="text-muted"> <i><?php echo date('d-M-Y H:i:s',strtotime($dis['diskusi_tanggal'])) ?></i></small>
             </div>
 			</div>
           <hr>
           	<div class="card-text">
           		<p><?php echo $dis['diskusi_isi'] ?></p>
           	</div>
			</div>
         </div>
           <br class="bg-dark"/>
           <?php 
         }
       }
      ?>
			
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
