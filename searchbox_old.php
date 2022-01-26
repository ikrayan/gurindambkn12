<!-- search box -->
	  	<?php if(isset($_SESSION['member_status'])){ //jika login ?>
		  
		  	<div class="form-group">
				<form action="indexQ.php" method="get" target="_blank">
					<div class="form-row mb-1">
					  <div class="col-lg-12 mb-1">
						 <div class="input-group input-group-alternative">
							<div class="input-group-append">
							  <span class="input-group-text shadow"><i class="fa fa-search"></i></span>
							</div>
							 <input class="form-control shadow pl-2" name="cari" placeholder="Cari di sini .." type="text">
						 </div>
					  </div>
					 </div>
					  <div class="col-lg-12 mb-2" style="cursor: pointer;">
					  	<span class="btn btn-sm btn-block m-1" id="btn_extra_down"><i class="fa fa-2x fa-caret-down"></i></span>
					  	<span class="btn btn-sm btn-block m-1" id="btn_extra_up"><i class="fa fa-2x fa-caret-up"></i></span>
					  </div>
					
					<div class="form-row ml-1 mt-2" id="extra">
						<!--<div class="col-lg-2 mb-2">> Pencarian Lanjutan</div>-->
						<div class="col-lg-2 mb-2">
							<select class="form-control shadow" name="jenis" id="jenis">
								<option value="">Semua Jenis</option>
								<option value="regulasi">Regulasi</option>
								<option value="knowledge">Knowledge</option>								
								
							</select>
						</div>					 
						<div class="col-lg-2 mb-2">
							<select class="form-control shadow" name="visibil" id="visibil">
								<option value="">Semua Akses</option>
								<option value="publik">Publik</option>
								<option value="internal">Internal</option>
							</select>
						</div>
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
				<form action="indexQ.php" method="get" target="_blank">
					<div class="form-row mb-1">
					  <div class="col-lg-12 mb-2">
						 <div class="input-group input-group-alternative">
							<div class="input-group-append">
							  <span class="input-group-text shadow"><i class="fa fa-search"></i></span>
							</div>
							 <input class="form-control shadow pl-2" name="cari" placeholder=" Cari di sini .." type="text">
						 </div>
					  </div>
					 </div>
					  <div class="col-lg-12 mb-2" style="cursor: pointer;">
					  	<span class="btn btn-sm btn-block m-1" id="btn_extra_down"><i class="fa fa-2x fa-caret-down"></i></span>
					  	<span class="btn btn-sm btn-block m-1" id="btn_extra_up"><i class="fa fa-2x fa-caret-up"></i></span>
					  </div>
					
					
					<div class="form-row ml-1 mt-2" id="extra">					   
						<!--<div class="col-lg-2 mb-2">> Pencarian Lanjutan</div>-->
						<div class="col-lg-2 mb-2">
							<select class="form-control shadow" name="jenis" id="jenis">								
								<option value="">Semua Jenis</option>
								<option value="regulasi">Regulasi</option>
								<option value="knowledge">Knowledge</option>								
								
							</select>
						</div>	
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