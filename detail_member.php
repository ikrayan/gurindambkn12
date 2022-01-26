<?php include 'header.php'; ?>


<div class="container">

  <div class="row">


    <div class="col-lg-12">

      <div class="card">
        <div class="card-header">
          <h6 class="m-0">Tentang Member</h6>
        </div>
        <div class="card-body">

          <?php 
          $id_member = $_GET['id'];
          $member = mysqli_query($koneksi,"select * from member where member_id='$id_member'");
          $c = mysqli_fetch_assoc($member);

          if($c['member_foto'] == ""){
            ?>
            <center><img class="img-fluid rounde shadow" style="width: 20%" src="gambar/sistem/member.png"></center>
            <?php
          }else{
            ?>
            <center><img class="img-fluid rounde shadow" style="width: 20%" src="gambar/member/<?php echo $c['member_foto'] ?>"></center>
            <?php
          }
          ?>
          <br/>
          <center>
            <h5><?php echo $c['member_nama'];  ?></h5>
            <p>
              <?php echo $c['member_email'];  ?>
              <br/>
              <?php echo $c['member_hp'];  ?>
            </p>
          </center>

          <div class="row">
            <div class="col-lg-6">
              <div class="card card-body shadow bg-primary text-white">
                <?php 
                $posting = mysqli_query($koneksi,"select * from posting where posting_member='$id_member'");
                ?>
                <h4 class="text-white"><?php echo mysqli_num_rows($posting) ?></h4>
                <small>Jumlah Posting/Diskusi</small>
              </div>
            </div>

            <div class="col-lg-6">
              <div class="card card-body shadow bg-success text-white">
                <?php 
                $diskusi = mysqli_query($koneksi,"select * from diskusi where diskusi_member='$id_member'");
                ?>
                <h4 class="text-white"><?php echo mysqli_num_rows($diskusi) ?></h4>
                <small>Jumlah Komentar Pada Diskusi</small>
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
