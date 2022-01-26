<?php include 'header.php'; ?>


<div class="container col-lg-8">

  <div class="row">

    <?php include 'member_menu.php'; ?>

    <div class="col-lg-9">

      <div class="card mt-3 shadow">
        <div class="card-header">
          <div class="d-flex justify-content-between">
            <h5 class="m-0"><b>Dashboard Verifikator</b></h5>
            <div class="pull-right">
              <a data-toggle="modal" data-target="#modalPosting" data-backdrop="static" data-keyboard="false" style="cursor: pointer;"><button class="btn">+ BUAT POSTING</button></a>
            </div>
          </div>
        </div>
        <div class="card-body mb-n3">
          <!-- role -->
          <table>
            <tr class="d-flex align-content-center">
              <th class="mr-2">
                <b>Role Verifikasi Saya :</b>
              </th>
              <td>
                <?php
                $roles = mysqli_query($koneksi, "select * from v_roles where PNS_ID='$id_member'");
                $myRole = "";
                while ($ro = mysqli_fetch_array($roles)) {
                  $myRole .= $ro['role'] . ",";
                }
                $myRoles = substr($myRole, 0, -1);

                $role = mysqli_query($koneksi, "select * from kategori, v_roles where kategori_id=role and PNS_ID='$id_member'");
                while ($r = mysqli_fetch_array($role)) {
                  echo "<span class='badge badge-primary m-1'>" . $r['kategori_nama'] . "</span>";
                }
                ?>
              </td>
            </tr>
          </table>
          <hr class="mt-3 mb-4">
          <div class="row">
            <div class="col-lg-4 mb-3">
              <div class="card card-body shadow bg-primary text-white">
                <?php
                $id_member = $_SESSION['member_id'];
                $posting = mysqli_query($koneksi, "select * from posting where posting_member='$id_member'");
                ?>
                <div class="clearfix">
                  <div class="pull-left">
                    <h2 class="text-white"><b><?php echo mysqli_num_rows($posting) ?></b></h2>
                  </div>
                  <div class="pull-right mt-2">
                    <i class="fa fa-3x fa-upload text-white-50"></i>
                  </div>
                </div>
                <a class="text-white" href="admin/postingan_member.php?id_member=<?php echo $id_member; ?>"><small>Jumlah Posting Saya</small></a>
              </div>
            </div>

            <div class="col-lg-4 mb-3">
              <div class="card card-body shadow bg-success text-white">
                <?php
                $id_member = $_SESSION['member_id'];
                $diskusi = mysqli_query($koneksi, "select * from diskusi where diskusi_member='$id_member'");
                ?>
                <div class="clearfix">
                  <div class="pull-left">
                    <h2 class="text-white"><b><?php echo mysqli_num_rows($diskusi) ?></b></h2>
                  </div>
                  <div class="pull-right mt-2">
                    <i class="fa fa-3x fa-comments text-white-50"></i>
                  </div>
                </div>
                <a class="text-white" href="admin/komentar_member.php?id_member=<?php echo $id_member; ?>"><small>Jumlah Komentar Saya</small></a>
              </div>
            </div>


            <div class="col-lg-4 mb-3">
              <div class="card card-body shadow bg-warning text-white">
                <?php
                // print_r($myRoles);
                $id_member = $_SESSION['member_id'];
                $diskusi = mysqli_query($koneksi, "select * from posting where posting_step=1 and posting_kategori in ($myRoles)");

                ?>
                <div class="clearfix">
                  <div class="pull-left">
                    <h2 class="text-white"><b><?php echo mysqli_num_rows($diskusi) ?></b></h2>
                  </div>
                  <div class="pull-right mt-2">
                    <i class="fa fa-3x fa-check-square text-white-50"></i>
                  </div>
                </div>
                <a class="text-white" href="admin/verifikasi.php?id_member=<?php echo $id_member; ?>&roles=<?php echo $myRoles; ?>"> <small>Jumlah Verifikasi Baru</small></a>
              </div>
            </div>

          </div>

          <br />

        </div>
      </div>
      <!-- tabel verifikasi
      <div class="card">
       
       <?php /*
         if(isset($_GET['alert'])){
          if($_GET['alert'] == "publish"){
            echo "<div class='alert alert-success text-center'>Posting berhasil dipublish.</div>";
		  }elseif($_GET['alert'] == "tolak"){
            echo "<div class='alert alert-success text-center'>Posting berhasil ditolak.</div>";
		  }
        }
        ?>
       
        <div class="card-header">
          <h6 class="m-0"><b>List Verifikasi</b></h6>
        </div>
        <div class="card-body">
        
        <div class="table-responsive">      
       	<table id="tableverif" class="table table-hover table-sm">
          <thead class="table-light">
            <tr>
              <th>Judul Posting</th>
              <th>Kategori</th>
              <th><center>Author</center></th>
              <th><center>Terima</center></th>
			  <th><center>Tolak</center></th>
            </tr>
          </thead>
          <tbody>
        <?php 
			$halaman = 10;
            $page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
            $mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
            $result = mysqli_query($koneksi, "SELECT * FROM posting where posting_step=2");
            $total = mysqli_num_rows($result);
            $pages = ceil($total/$halaman);  
					
        	$data = mysqli_query($koneksi,"select * from posting,kategori,member where posting_step=1 and posting_member=member_id and kategori_id=posting_kategori order by posting_id desc LIMIT $mulai, $halaman");
			
			$no =$mulai+1;

            while($d = mysqli_fetch_array($data)){
				$id_posting = $d['posting_id'];
        ?>
        	 <tr>
                <td>
                  <a href="diskusi.php?id=<?php echo $d['posting_id']; ?>"><?php echo $d['posting_judul'] ?></a>
                  <br/><i><small><?php echo date('d-M-Y H:i:s',strtotime($d['posting_tanggal'])) ?></small></i>
                </td>
                <td>
                  <a href="kategori.php?id=<?php echo $d['kategori_id']; ?>">
                    <div class="badge badge-warning"><?php echo $d['kategori_nama'] ?></div>
                  </a>
                </td>
                <td>
                  <a href="detail_member.php?id=<?php echo $d['member_id']; ?>">
                   <center>
                    <?php 
                    if($d['member_foto'] == ""){
                      ?>
                      <img class="img-fluid rounded-circle shadow" style="width: 35px;height: 35px" src="gambar/sistem/member.png">
                      <?php
                    }else{
                      ?>
                      <img class="img-fluid rounded-circle shadow" style="width: 35px;height: 35px" src="gambar/member/<?php echo $d['member_foto'] ?>">
                      <?php
                    }
                    ?>
                    <br>
                    <small class="ml-2 text-dark"><?php echo ucfirst($d['member_nama']) ?></small>  
                  </center>
                </a>
              </td>
              <td>
                <center><button class='btn btn-success btn-sm shadow' data-toggle="modal" data-target="#modal-notification"><i class='fa fa-check' aria-hidden='true'></i></button></center>
              </td>
              <td>
                <center><button class='btn btn-danger btn-sm shadow' data-toggle="modal" data-target="#modal-notification2"><i class='fa fa-close' aria-hidden='true'></i></button></center>
              </td>
            </tr>

           <div class="modal fade" id="modal-notification" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
                <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                  <div class="modal-content bg-gradient-primary">
                    <div class="modal-header">
                      <h6 class="modal-title" id="modal-title-notification">Perhatian!</h6>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="py-3 text-center">
                        <i class="ni ni-bell-55 ni-3x"></i>
                        <h4 class="heading mt-4">APAKAH ANDA YAKIN INGIN MENYETUJUI POSTINGAN INI ?</h4>
                        <p>Klik Oke untuk memposting diskusi, dan klik 'Batalkan' untuk membatalkan</p>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Batalkan</button>
                      <a href="posting_acc_act.php?id=<?php echo $id_posting; ?>"> <input type="button" class="btn btn-white" value="Oke, Setujui Posting!"></a>
                    </div>
                  </div>
                </div>
              </div>
           
           <div class="modal fade" id="modal-notification2" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
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
                        <h4 class="heading mt-4">APAKAH ANDA YAKIN INGIN MENOLAK POSTINGAN INI ?</h4>
                        <p>Klik Oke untuk menolak posting ini, dan klik 'Batalkan' untuk membatalkan</p>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Batalkan</button>
                      <a href="posting_tolak_act.php?id=<?php echo $id_posting; ?>"> <input type="button" class="btn btn-white" value="Oke, Tolak Posting!"></a>
                    </div>
                  </div>
                </div>
              </div>
           
            <?php 
          }
          ?>

        </tbody>
      </table>
			</div>
		</div>
	  </div>
	  -->
	  <!--
	  <nav aria-label="...">
        <ul class="pagination justify-content-center">


          <?php /*for ($i=1; $i<=$pages ; $i++){ ?>
            <?php if($page==$i){ ?>
              <li class="page-item active">
                <a class="page-link" href="#"><?php echo $i; ?> <span class="sr-only">(current)</span></a>
              </li>
            <?php }else{ ?>

              <?php 
              if(isset($_GET['cari'])){
                $cari = $_GET['cari'];
                $c = "&cari=".$cari;
              }else{
                $c = "";
              }
              if(isset($_GET['urutan']) && $_GET['urutan'] == "terpopuler"){
                ?>
                <li class="page-item"><a class="page-link" href="?halaman=<?php echo $i; ?>&urutan=terpopuler<?php echo $c ?>"><?php echo $i; ?></a></li>
                <?php 
              }else{
                ?>
                <li class="page-item"><a class="page-link" href="?halaman=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                <?php
              }
              ?>

            <?php } ?>
          <?php } */ ?>
        </ul>
      </nav>
	  -->
    </div>


  </div>
</div>

<?php include 'footer.php'; ?>