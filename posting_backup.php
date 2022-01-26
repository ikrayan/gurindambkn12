<?php include 'header.php'; ?>


<div class="container col-lg-10">

  <div class="row">

    <div class="col-lg-9">

      <div class="card">
        <div class="card-header">
          <h5 class="m-0"><b>Buat Posting Baru</b></h5>
        </div>
        <div class="card-body">


          <form action="posting_act.php" method="post" enctype="multipart/form-data">

            <div class="form-group bg-light">
              <label for=""><b>&nbsp; .: Judul</b></label>
              <input type="text" class="form-control" required="required" name="judul" placeholder="Masukkan judul ..">
            </div>
			<br>
            <div class="form-group bg-light">
              <label for=""><b>&nbsp; .: Kategori</b></label>
              <select name="kategori" class="form-control" required>
                <option value="">- Pilih Kategori</option>
                <?php 
                $data = mysqli_query($koneksi,"select * from kategori");
                while($d = mysqli_fetch_array($data)){
                  ?>
                  <option value="<?php echo $d['kategori_id'] ?>"><?php echo $d['kategori_nama'] ?></option>
                  <?php 
                }
                ?>
              </select>
            </div>
			<br>
          	<div class="form-group bg-light">
					<label for="" class="col-sm-2"><b>.: Jadikan Publik </b></label>
					<input class="form-check-input" type="checkbox" name="visibility" value="publik">
			</div>	
           	<br>
           	<div class="form-group bg-light">
					<label for=""><b>&nbsp; .: Attachment :</b></label>
					<input class="btn btn-sm" type="file" name="attach[]" multiple />
			</div>	
           	<br>
            <div class="form-group bg-light">
              <label for=""><b>&nbsp; .: Konten</b></label>
              <textarea class="form-control" id="editor_forum" required name="isi" placeholder="Masukkan isi diskusi .."></textarea>
            </div>

            <div class="form-group">

              <button type="button" class="btn btn-primary btn-block mb-3" data-toggle="modal" data-target="#modal-notification">Simpan Posting</button>
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
                        <h4 class="heading mt-4">APAKAH ANDA YAKIN INGIN MEMPOSTING DISKUSI INI ?</h4>
                        <p>Klik 'Oke, Posting Sekarang!' untuk memposting diskusi, dan klik 'Batalkan' untuk membatalkan posting.</p>
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

    <?php include 'sidebar.php'; ?>

  </div>
</div>

<?php include 'footer_old.php'; ?>
