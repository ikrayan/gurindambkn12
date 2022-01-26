<?php include 'header.php'; ?>


<div class="container">

  <div class="row">

    <?php include 'member_menu.php'; ?>

    <div class="col-lg-9">

      <div class="card">
        <div class="card-header">
          <h6 class="m-0">Ganti Password</h6>
        </div>
        <div class="card-body">

          <?php 
          if(isset($_GET['alert'])){
            if($_GET['alert'] == "sukses"){
              echo "<div class='alert alert-success'>Password anda berhasil diganti!</div>";
            }
          }
          ?>

          <form action="member_password_act.php" method="post">
            <div class="form-group">
              <label for="">Masukkan Password Baru</label>
              <input type="password" class="form-control" required="required" name="password" placeholder="Masukkan password .." min="5">
            </div>

            <div class="form-group">
              <input type="submit" class="btn btn-primary" value="Ganti Password">
            </div>
          </form>
          		<button class="btn btn-danger" onClick="history.back()">Batal</button>

          <br/>

        </div>
      </div>

    </div>


  </div>
</div>

<?php include 'footer.php'; ?>
