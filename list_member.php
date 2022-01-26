<?php include 'header.php'; ?>

<div class="container-fluid">

  <div class="row">

    <div class="col-lg-12">

      <div class="card">
        <div class="card-header">
          <h6 class="m-0">Semua Member</h6>
        </div>
        <div class="card-body">
          <div class="row">

            <?php 
            $member = mysqli_query($koneksi,"select * from member order by member_id desc");
            while($m = mysqli_fetch_array($member)){
              ?>

              <div class="col-lg-3 mb-3">

                <a href="detail_member.php?id=<?php echo $m['member_id']; ?>" class="btn text-left btn-primary btn-block">

                 <div class="row">
                    <div class="col-lg-3">
                    <?php
                    if($m['member_foto'] == ""){
                      ?>
                      <img class="img-fluid rounded shadow" style="" src="gambar/sistem/member.png">
                      <?php
                    }else{
                      ?>
                      <img class="img-fluid rounded shadow" style="" src="gambar/member/<?php echo $m['member_foto'] ?>">
                      <?php
                    }
                    ?>
                  </div>

                  <div class="col-lg-9">
                    <b><?php echo $m['member_nama'];  ?></b>
                    <br>
                    <small>
                      <?php echo $m['member_email'];  ?>
                      <br/>
                      <?php echo $m['member_hp'];  ?>
                    </small>
                  </div>
                 </div>

                </a>
              </div>

              <?php
            }

            ?>
          </div>

          <br/>

        </div>
      </div>

    </div>

  </div>
</div>

<br/>
<br/>
<br/>
<br/>

<?php include 'footer.php'; ?>