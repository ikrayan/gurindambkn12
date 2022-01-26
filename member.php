<?php include 'header.php'; ?>


<div class="container col-xl-8">

  <div class="row">

    <?php include 'member_menu.php'; ?>

    <div class="col-xl-9">

      <div class="card mt-3 shadow">
        <div class="card-header">
          <h6 class="m-0"><b>Dashboard</b></h6>
          <div class="pull-right">
            <a data-toggle="modal" data-target="#modalPosting" data-backdrop="static" data-keyboard="false" style="cursor: pointer;"><button class="btn">+ BUAT POSTING</button></a>
          </div>
        </div>
        <div class="card-body mb-n3">

          <div class="row">
            <div class="col-lg-6 mb-3">
              <div class="card card-body shadow bg-primary text-white">
                <?php 
                $id_member = $_SESSION['member_id'];
				
                $posting = mysqli_query($koneksi,"select * from posting where posting_member='$id_member'");
                ?>
                <div class="clearfix">
					<div class="pull-left">
                	<h2 class="text-white"><b><?php echo mysqli_num_rows($posting) ?></b></h2>
                	</div>
					<div class="pull-right mt-2">
					<i class="fa fa-upload fa-3x text-white-50"></i>
					</div>
                </div>
                <a class="text-white" href="admin/postingan_member.php?id_member=<?php echo $id_member; ?>&nama=<?php echo $nama_member; ?>">
              	<small>Jumlah Posting Saya</small></a>
              </div>
            </div>

             <div class="col-lg-6 mb-3">
              <div class="card card-body shadow bg-success text-white">
                <?php 
                $id_member = $_SESSION['member_id'];
                $diskusi = mysqli_query($koneksi,"select * from diskusi where diskusi_member='$id_member'");
                ?>
                <div class="clearfix">
					<div class="pull-left">
                	<h2 class="text-white"><b><?php echo mysqli_num_rows($diskusi) ?></b></h2>
                	</div>
					<div class="pull-right mt-2">
					<i class="fa fa-comments fa-3x text-white-50"></i>
					</div>
                </div>
                <a class="text-white" href="admin/komentar_member.php?id_member=<?php echo $id_member; ?>"><small>Jumlah Komentar Saya</small></a>
              </div>
            </div>

            
          </div>

          <br/>

        </div>
      </div>

    </div>


  </div>
</div>

<?php include 'footer.php'; ?>
