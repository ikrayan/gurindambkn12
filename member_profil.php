<?php include 'header.php'; ?>


<div class="container">

  <div class="row">

    <?php include 'member_menu.php'; ?>

    <div class="col-lg-9">

      <div class="card">
        <div class="card-header">
          <h6 class="m-0">Profil</h6>
        </div>
        <div class="card-body">

          <?php 
          if(isset($_GET['alert'])){
            if($_GET['alert'] == "berhasil"){
              echo "<div class='alert alert-success'>Profil anda berhasil diubah.</div>";
            }else if($_GET['alert'] == "gagal"){
              echo "<div class='alert alert-danger'>Profil gagal diubah. file gambar tidak diizinkan.</div>";
            }
          }
          ?>

          <?php 
          $id_member = $_SESSION['member_id'];
          $member = mysqli_query($koneksi,"select * from user where PNS_ID='$id_member'");
          while($i = mysqli_fetch_array($member)){
            ?>

            <form action="member_profil_update.php" method="post" enctype="multipart/form-data">
			  <div class="form-group">
                <label for="">Username</label>
                <input type="text" class="form-control" required="required" name="username" placeholder="Masukkan username .." value="<?php echo $i['USERNAME'] ?>">
              </div> 
             
              <div class="form-group">
                <label for="">Email</label>
                <input type="email" class="form-control" required="required" name="email" placeholder="Masukkan email .." value="<?php echo $i['EMAIL'] ?>">
              </div>

              <div class="form-group">
                <label for="">HP</label>
                <input type="number" class="form-control" required="required" name="hp" placeholder="Masukkan no.hp .." value="<?php echo $i['NOMOR_HP'] ?>">
              </div>
              
              <div class="form-group">
                <label for="">Unit Kerja</label>
              	<select class="selectpicker form-control" name="unor" id="unor" data-live-search="true" required>
              	   <option value="<?php echo $i['UNOR_NAMA'] ?>"><?php echo $i['UNOR_NAMA'] ?></option>
					<?php 
					$data = mysqli_query($koneksi,"select * from m_unor order by ID ASC");
					while($d = mysqli_fetch_array($data)){
					  ?>
					  <option value="<?php echo $d['NAMA_UNOR'] ?>"><?php echo $d['NAMA_UNOR'] ?></option>
					  <?php 
					}
					?>
				  </select>
			  </div>
             <br>
              <div class="form-group">
                <label for="">Foto Profil</label>
                <input type="file" name="foto">
                <Br/>
                <i><small>Kosongkan jika tidak ingin mengubah foto profil.</small></i>
              </div>
	
              <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Ubah Profil">
			  </div>
			
			</form>
			
             <button class="btn btn-danger" onClick="history.back()">Batal</button>
			  				
            <?php 
          }
          ?>

          <br/>

        </div>
      </div>

    </div>


  </div>
</div>

<?php include 'footer.php'; ?>
