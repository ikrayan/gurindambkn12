<?php include 'header.php'; ?>


<!-- Box Search image-->
<div class="bgSearch mb-3" style="height: 20%">
	<div class="centered col-lg-12">
	 	<center><br>
		<h4 class="text-white mt-0 mb-3" style="line-height: 1.1; font-style: italic; font-family: Baskerville, Palatino Linotype, Palatino, Century Schoolbook L, Times New Roman, serif"><b>"If you have knowledge, let others light their candles in it"</b></h4><small>&nbsp;Margaret Fuller</small>
		<!--<span class="text-white mb-3">KANTOR REGIONAL XII BKN</span>-->
		</center>
	</div>
</div>

<div class="container col-lg-9">

  <div class="row">

    <div class="col-lg-9">    
        
		<!-- search box -->
	  	<?php if(isset($_SESSION['member_status'])){ //jika login ?>
		  
		  	<div class="form-group">
				<form action="indexQ.php" method="get">
					<div class="form-row mb-1">
					  <div class="col-lg-12 mb-1">
						 <div class="input-group input-group-alternative">
							<div class="input-group-append">
							  <span class="input-group-text shadow"><i class="fa fa-search"></i></span>
							</div>
							 <input class="form-control shadow pl-2" name="cari" placeholder=" Cari di sini .." type="text">
						 </div>
					  </div>
					 </div>
					  <!--<div class="col-lg-12 mb-2" style="cursor: pointer;">
					  	<span class="btn btn-sm btn-block m-1" id="btn_extra_down"><i class="fa fa-2x fa-caret-down"></i></span>
					  	<span class="btn btn-sm btn-block m-1" id="btn_extra_up"><i class="fa fa-2x fa-caret-up"></i></span>
					  </div>-->
					
					<div class="form-row mt-3" id="extra">
						<div class="col-lg-4 mb-2">
							<select class="selectpicker form-control shadow" name="kategori" id="kategori" data-live-search="true">
								<option value="all">Kategori</option>
								<option class="dropdown-divider bg-light" disabled></option>
								<?php 
								$data = mysqli_query($koneksi,"SELECT * FROM kategori ORDER BY kategori_nama ASC");
								while($d = mysqli_fetch_array($data)){ ?>
								<option value="<?php echo $d['kategori_id']; ?>"><?php echo $d['kategori_nama']; ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="col-lg-2 mb-2">
							<select class="form-control shadow" name="jenis" id="jenis">
								<option value="">Semua Jenis</option>
								<option value="regulasi">Regulasi</option>
								<option value="knowledge">Knowledge</option>								
							</select>
						</div>					 
						<div class="col-lg-2 mb-2">
							<select class="form-control shadow" name="visibil" id="visibil">
								<option value="">Semua Viewer</option>
								<option value="publik">Publik</option>
								<option value="internal">Internal</option>
							</select>
						</div>
						
						<div class="col-lg-2 mb-2">
							<input class="form-control shadow" name="cariTags" placeholder="Tags..." type="text">
						</div>
						<div class="col-lg-2 mb-2">
							<button class="btn btn-primary btn-block shadow" value="submit">Cari</button>
						</div>
					</div>
				</form>
			</div>
			
			<?php }else{ //jika belum login ?>
			
			<div class="form-group">
				<form action="indexQ.php" method="get">
					<div class="form-row mb-1">
					  <div class="col-lg-12 mb-1">
						 <div class="input-group input-group-alternative">
							<div class="input-group-append">
							  <span class="input-group-text shadow"><i class="fa fa-search"></i></span>
							</div>
							 <input class="form-control shadow pl-2" name="cari" placeholder=" Cari di sini .." type="text">
						 </div>
					  </div>
					 </div>
					  <!--<div class="col-lg-12 mb-2" style="cursor: pointer;">
					  	<span class="btn btn-sm btn-block m-1" id="btn_extra_down"><i class="fa fa-2x fa-caret-down"></i></span>
					  	<span class="btn btn-sm btn-block m-1" id="btn_extra_up"><i class="fa fa-2x fa-caret-up"></i></span>
					  </div>-->
					
					
					<!--<div class="col-lg-2 mb-2">
							<select class="form-control shadow" name="tipe" id="tipe">								
								<option value="">Semua Tipe</option>
								<option value="pdf">Pdf</option>
								<option value="word">Word</option>
								<option value="excel">Excel</option>
								<option value="ppt">Powerpoint</option>
								<option value="image">Image</option>
								<option value="audio">Audio</option>
								<option value="video">Video</option>
								<option value="program">Program</option>
								<option value="rar">Zip/Rar</option>
								<option value="other">Lainnya</option>
			case "pdf":
				echo "pdf";
				break;
				
			case "doc": case "docx":
				echo "word";
				break;					
					
			case "xls": case "xlsx":
				echo "excel";
				break;						
					
			case "ppt": case "pptx":
				echo "powerpoint";
				break;
									
			case "jpg": case "jpeg": case "png": case "tif": case "tiff": case "bmp": case "gif": case "eps": case "raw":
				echo "image";
				break;					
				
			case "mp3": case "aac": case "ogg": case "flac": case "alac": case "wav": case "pcm":
				echo "audio";
				break;
					
			case "mp4": case "flv": case "mpg": case "mpeg": case "mkv": case "mov": case "avi": case "wmv": case "avchd": case "webM":
				echo "video";
				break;					
					
			case "exe":
				echo "code";
				break;					
				
			case "zip": case "rar":
				echo "zip";
				break;					
				
			case "psd": case "ai": case "cdr":
				echo "picture";
				break;					
				
			default:
				echo "archive";
				break;								
							</select>
						</div> -->
					<div class="form-row mt-3" id="extra">
						<div class="col-lg-6 mb-2">
							<select class="selectpicker form-control shadow" name="kategori" id="kategori" data-live-search="true">
								<option value="all">Kategori</option>
								<?php 
								$data = mysqli_query($koneksi,"SELECT * FROM kategori ORDER BY kategori_nama ASC");
								while($d = mysqli_fetch_array($data)){ ?>
								<option value="<?php echo $d['kategori_id']; ?>"><?php echo $d['kategori_nama']; ?></option>
								<?php } ?>
							</select>
						</div>
						
						<div class="col-lg-2 mb-2">
							<select class="form-control shadow" name="jenis" id="jenis">								
								<option value="">Semua Jenis</option>
								<option value="regulasi">Regulasi</option>
								<option value="knowledge">Knowledge</option>								
							</select>
						</div>
						<div class="col-lg-2 mb-2">
							<input class="form-control shadow" name="cariTags" placeholder="Tags..." type="text">
						</div>
						<div class="col-lg-2 mb-2">
							<button class="btn btn-primary btn-block shadow" value="submit">Cari</button>
						</div>
					</div>
				</form>
			</div>
			<?php } ?>
		
	<!-- end search box -->
	
	<hr class="mt-n2 mb-3">
	<div class="card mb-3">
        <div class="card-body shadow">		
        
		<!-- URUTAN 
        <div class="btn-group pull-right mb-3">
          <div class="dropdown">
            Urutkan : &nbsp;
            <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <?php /* if(isset($_GET['urutan']) && $_GET['urutan'] == "terpopuler"){echo "Terpopuler";}else{echo "Terbaru";} ?>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
             <?php 
             if(isset($_GET['cari'])){
          		$cari = $_GET['cari'];
				 if(isset($_GET['visibel'])){
					$visibel = $_GET['visibel']; ?>
             		<a class="dropdown-item" href="?urutan=terbaru&cari=<?php echo $cari; ?>&visibel=<?php echo $visibel; ?>">Terbaru</a>
					<a class="dropdown-item" href="?urutan=terpopuler&cari=<?php echo $cari; ?>&visibel=<?php echo $visibel; ?>">Terpopuler</a>
				  <?php }else{ ?>
					  <a class="dropdown-item" href="?urutan=terbaru&cari=<?php echo $cari; ?>">Terbaru</a>
					  <a class="dropdown-item" href="?urutan=terpopuler&cari=<?php echo $cari; ?>">Terpopuler</a>
              <?php }
			 }else{ ?>
				  <a class="dropdown-item" href="?urutan=terbaru">Terbaru</a>
				  <a class="dropdown-item" href="?urutan=terpopuler">Terpopuler</a>
              <?php } 
				  */ ?>
            </div>
          </div>
        </div>
        -->
        
            <?php
            //$halaman = 10;
            //$page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
            //$mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
            //$result = mysqli_query($koneksi, "SELECT * FROM posting where posting_step=2");
            //$total = mysqli_num_rows($result);
            //$pages = ceil($total/$halaman);  
			$bagianWhere = "";

			if (isset($_GET['cari'])){
			   $cari = $_GET['cari'];
					if(!empty($cari)){
						echo "-> Kata yang dicari : <b>".$cari."</b><br>";
						if (empty($bagianWhere)){
							$bagianWhere .= "and posting_judul like '%$cari%'";
					    }else{
							$bagianWhere .= " and posting_judul like '%$cari%'";
						}
					}
			}
			
			if (isset($_GET['jenis'])){
			   $jenis = $_GET['jenis'];
				if(empty($jenis)){
					$bagianWhere;
				}else{
					echo "-> Jenis : <b>".$jenis."</b><br>";
									
				    if (empty($bagianWhere)){
							$bagianWhere .= "and posting_jenis = '$jenis'";
					   }else{
							$bagianWhere .= " and posting_jenis = '$jenis'";
					   }
				}
			}
			
			if (isset($_GET['kategori'])){
			   $kategori = $_GET['kategori'];
				if($kategori=="all"){
					$bagianWhere;
				}else{
					$kat = mysqli_query($koneksi,"SELECT * FROM kategori WHERE kategori_id='$kategori'");
 						while($k = mysqli_fetch_array($kat)){
						echo "-> Kategori : <b>".$k['kategori_nama']."</b><br>";
						}
					
				   if (empty($bagianWhere)){
						$bagianWhere .= "and kategori_id = '$kategori'";
				   }else{
						$bagianWhere .= " and kategori_id = '$kategori'";
				   }
				}
			}
			
			if (isset($_GET['visibil'])){
			   $visibil = $_GET['visibil'];
				if(empty($visibil)){
					$bagianWhere;
				}else{
					echo "-> Akses : <b>".$visibil."</b><br>";
									
				   if (empty($bagianWhere)){
						$bagianWhere .= "and posting_visibility = '$visibil'";
				   }else{
						$bagianWhere .= " and posting_visibility = '$visibil'";
				   }
				}
			}
			
			if (isset($_GET['tipeFile'])){
			   	$tipeFile = $_GET['tipeFile'];
				
					if (empty($bagianWhere)){
							$bagianWhere .= "and $tipeFile";
					    }else{
							$bagianWhere .= " and $tipeFile";
						}
					
			}
			
			if (isset($_GET['cariTags'])){
			   $cariTags = $_GET['cariTags'];
					if(!empty($cariTags)){
						echo "-> Tags : <b>".$cariTags."</b><br>";
						if (empty($bagianWhere)){
							$bagianWhere .= "and posting_tags like '%$cariTags%'";
					    }else{
							$bagianWhere .= " and posting_tags like '%$cariTags%'";
						}
					}
			}
			 
		// end logika form cari	  ?>
		<br>
		<div class="table-responsive">
		<table class="table table-striped" id="table-posting-datatable">
          <thead>
            <tr>
              <th>Id</th>
              <th>Judul</th>
              <th><i class="fa fa-eye"></i></th>
              <th><i class="fa fa-comment"></i></th>
              <!-- <th><center>Author</center></th> 
              <th>Created</th> -->
            </tr>
          </thead>
          <tbody>
		
		<?php	  
		if(isset($_SESSION['member_status'])){ //Jika login
			if (isset($_GET['kategori'])){
				$data = mysqli_query($koneksi, "select * from posting,attachment,kategori,user where posting_step=2 and posting_id=attach_posting and posting_member=PNS_ID and kategori_id=posting_kategori ".$bagianWhere);
				//echo "select * from posting,kategori,member where posting_visibility='publik' and posting_step=2 and posting_member=member_id and kategori_id=posting_kategori ".$bagianWhere;
				$total = mysqli_num_rows($data);
			}else{
				$data = mysqli_query($koneksi, "select * from posting,attachment,kategori,user where posting_step=2 and posting_id=attach_posting and posting_member=PNS_ID and kategori_id=posting_kategori order by posting_id DESC");
				$total = mysqli_num_rows($data);
			}

		}else{ //Jika tidak login
			
			if (isset($_GET['kategori'])){
				$data = mysqli_query($koneksi, "select * from posting,attachment,kategori,user where posting_visibility='publik' and posting_id=attach_posting and posting_step=2 and posting_member=PNS_ID and kategori_id=posting_kategori ".$bagianWhere);
				//echo "select * from posting,kategori,member where posting_visibility='publik' and posting_step=2 and posting_member=member_id and kategori_id=posting_kategori ".$bagianWhere;
				$total = mysqli_num_rows($data);
			}else{
				$data = mysqli_query($koneksi, "select * from posting,attachment,kategori,user where posting_visibility='publik' and posting_id=attach_posting and posting_step=2 and posting_member=PNS_ID and kategori_id=posting_kategori order by posting_id DESC");
				$total = mysqli_num_rows($data);
			}

		}
			
			//end logic sql   
			//$pages = ceil($total/$halaman);
            //$no = $mulai+1;
			
            while($d = mysqli_fetch_array($data)){
				$fnQ = $d['attach_name'];
				$ftQ = pathinfo($fnQ, PATHINFO_EXTENSION);
              ?>

              <tr>
                <td>
                	<?php echo $d['posting_id']; ?>
                </td>
                <td> 
                	<div class="d-flex align-items-start">
                		<i class="fa fa-3x text-black-50 fa-file-<?php ikon($ftQ); ?>-o mr-2"></i>
						<div class="justify-content-start mt-n1">
						
							<?php
							$fileVideo = array('mp4','mkv','mov','mpg','mpeg','flv','m4v');
								if(in_array($ftQ, $fileVideo)){ ?>
									<a target="_blank" href="video.php?id_posting=<?php echo $d['posting_id']; ?>&video=<?php echo $d['attach_name']; ?>">
							<?php	
								}else{
							?>
									<a href="diskusi.php?id_posting=<?php echo $d['posting_id']; ?>" target="_blank">
							<?php 
								}
							?>
								<h6 class="text-dark mb-1"><?php echo $d['posting_judul'] ?></h6>
							</a>
							<span class="text-black-50"><small>[<?php echo date('d-M-Y',strtotime($d['posting_tanggal'])) ?>]</small></span>
							
					<?php if($d['posting_visibility']=="publik"){ ?>
							<div class="badge badge-success"><i class="fa fa-arrow-up"></i>&nbsp;<?php echo $d['posting_visibility'] ?></div>
					<?php }else{ ?>
							<div class="badge badge-warning"><i class="fa fa-arrow-down"></i>&nbsp;<?php echo $d['posting_visibility'] ?></div>
					<?php } 
					?>                  
						  <div class="badge badge-primary"><i class="fa fa-bookmark"></i>&nbsp;<?php echo $d['kategori_nama'] ?></div>
             			
              				<!-- Mulai Tags -->
							<?php 
							if(!empty($d['posting_tags'])){
								$tags = explode(",",$d['posting_tags']);
								for($t=0; $t < count($tags); $t++){
									echo "<span class='badge badge-secondary border'><i class='fa fa-tag'></i> ".$tags[$t]."</span>";
								}
							}
							?>     		

							<!-- Akhir Tags-->
               			</div>
					</div>			
                </td>
              <td>
                <span class="badge bg-success text-white mt-3"><b><?php echo $d['posting_dibaca'] ?></b></span>
              </td>
              <td>
                <span class="badge bg-success text-white mt-3">
                  <?php 
                  $id_posting = $d['posting_id'];
                  $jumlah_diskusi = mysqli_query($koneksi,"select * from diskusi where diskusi_posting='$id_posting'");
                  echo mysqli_num_rows($jumlah_diskusi);
                  ?>
                </span>
              </td>
              <!--
			  <td>
                  <a href="detail_member.php?id=<?php /* echo $d['member_id']; ?>">
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
                    <small class="ml-2 text-dark"><?php echo ucfirst($d['member_nama']) */ ?></small>  
                  </center>
                </a>
              </td> 
              <td>
              	<i><small><?php //echo date('d-M-Y H:i:s',strtotime($d['posting_tanggal'])) ?></small></i>
              </td> -->
            </tr>

            <?php 
          }
          ?>

        </tbody>
      </table>
	 </div>
    </div>
  </div>
</div>

<?php include 'sidebar.php'; ?>

</div>
</div>

<?php include 'footer.php'; ?>
