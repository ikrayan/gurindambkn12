<?php 
include 'koneksi.php';

$id_posting = $_GET['id_posting'];
$id_member = $_GET['id_member'];

$acc_posting = mysqli_query($koneksi, "update posting set posting_step=2 where posting_id=$id_posting");

if($acc_posting){
	mysqli_query($koneksi, "delete from diskusi where diskusi_posting=$id_posting");
	
	$detailPosting = mysqli_query($koneksi, "SELECT * FROM posting where posting_id=$id_posting");
	$dp = mysqli_fetch_array($detailPosting);
	
	//kirim notifikasi wa wablast
	
	/*$cekUnit 	= mysqli_query($konek, "SELECT COUNT(c.id_distrib) AS jmlsrt, a.unit_pejabat, b.nama_pns, b.kontak FROM m_unit a INNER JOIN users b ON a.unit_pejabat=b.nip INNER JOIN ds_detil c ON c.id_distrib='$noDist' WHERE a.id_unit='$unitDist'");
	$g       	= mysqli_fetch_assoc($cekUnit);*/

	//$cektoken 	= mysqli_query($konek, "SELECT access_token FROM token WHERE id=2");
	//$f = mysqli_fetch_assoc($cektoken);
	
	//Fungsi tanggal
		$day = date('D');
		$dayList = array(
			'Sun' => 'Minggu, ',
			'Mon' => 'Senin, ',
			'Tue' => 'Selasa, ',
			'Wed' => 'Rabu, ',
			'Thu' => 'Kamis, ',
			'Fri' => 'Jumat, ',
			'Sat' => 'Sabtu, '
		);
		//echo $dayList[$day];
		$hariIndo = $dayList[$day];
	
	//akhir fungsi tanggal
	
	$tgl = date('d M Y');
	
	//$dataMember	= mysqli_query($koneksi, "SELECT * FROM user WHERE PNS_ID='$id_member'");
	$dataMember	= mysqli_query($koneksi, "SELECT * FROM user WHERE NOMOR_HP IS NOT NULL");
	while($dm   = mysqli_fetch_array($dataMember)){
	
		$curl 	= curl_init();
		$token 	= 'jpddPwYiguTpEgwuSiIC85RO0iL44YJOEZWPjsq0EynumwVbdQvPUakMAUp6Vi5E'; //$f['access_token'];
		
		if($dp['posting_jenis']!="forum"){
			$data 	= [
				'phone' => "085376377930", //$dm['NOMOR_HP'], //$g['kontak'],
				/*'message' => '*:: Notifikasi GURINDAM ::* \n\n Hai *'.$g['nama_pns'].'*, anda menerima *'.$g['jmlsrt'].'* surat baru. Segera lakukan disposisi melalui menu *Surat Masuk - Surat Unit*. Terima Kasih ðŸ™ \n\n *Salam Disruptif,* \n\n GURINDAM \n\n _#gurindam #KMS #newNormalEra #digitalinAja_',*/
				'message' => "*:: SEKILAS GURINDAM* \n *:* _".$hariIndo.$tgl."_ \n\n Hai ".$dm['NAMA'].", Gurindam ada _knowledge_ baru nih tentang *".$dp['posting_judul']."*. Kita belajar bareng yuk di https://pekanbaru.bkn.go.id/kms/diskusi.php?id_posting=".$id_posting." \n\n Oya kalau kamu punya _knowledge_ yang bermanfaat mari saling berbagi di Gurindam ya https://pekanbaru.bkn.go.id/kms/masuk.php \n\n *Salam Profesional, Bermartabat* \n #Ingat3M #LawanCovid-19 #KnowledgeManagement \n ---------------------------------------------------",
			];
		}else{
			$data 	= [
				'phone' => "085376377930", //$dm['NOMOR_HP'], //$g['kontak'],
				/*'message' => '*:: Notifikasi GURINDAM ::* \n\n Hai *'.$g['nama_pns'].'*, anda menerima *'.$g['jmlsrt'].'* surat baru. Segera lakukan disposisi melalui menu *Surat Masuk - Surat Unit*. Terima Kasih ðŸ™ \n\n *Salam Disruptif,* \n\n GURINDAM \n\n _#gurindam #KMS #newNormalEra #digitalinAja_',*/
				'message' => "*:: SEKILAS GURINDAM* \n *:* _".$hariIndo.$tgl."_ \n\n Hai ".$dm['NAMA'].", Gurindam ada _forum_ baru nih tentang *".$dp['posting_judul']."*. Berikan komentarmu ya di https://pekanbaru.bkn.go.id/kms/diskusi.php?id_posting=".$id_posting." \n\n Oya kalau kamu punya hal yang ingin kita diskusikan bersama silahkan menambahkan forum di Gurindam ya!  https://pekanbaru.bkn.go.id/kms/masuk.php \n\n *Salam Profesional, Bermartabat* \n #Ingat3M #LawanCovid-19 #KnowledgeManagement \n ---------------------------------------------------",
			];
		}
			//echo '<a href=diskusi.php?id_posting='.$id_posting.'>'.
		
			/*"? *INFO SURAT MASUK* ? \n\n Hi, ".$toWa->nama_pns." anda telah menerima ".$toWa->jml_surat." surat baru. Segera tindaklanjuti surat melalui menu *Kotak Surat - Surat Masuk*. Terima Kasih ??
                    \n --------------------------------------------- \n _We cannot solve our problems_ \n _with the same thinking we used_ \n _when we created them_ \n\n _-Albert Einsten-_ \n --------------------------------------------- 
                    \n *Salam Profesional, Bermartabat* \n #Ingat3M #LawanCovid-19 #KanregXIISuai #SELAISV3";*/
		  
		curl_setopt($curl, CURLOPT_HTTPHEADER,
			array(
				"Authorization: $token",
			)
		);
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
		curl_setopt($curl, CURLOPT_URL, "https://kemusu.wablas.com/api/send-message");
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
		$result = curl_exec($curl);
		curl_close($curl);
	
	//akhir kirim notifikasi
	}
}

if(isset($_GET['id_verifikator'])){
	$id_verifikator = $_GET['id_verifikator'];
	header("location:admin/verifikasi.php?id_member=$id_verifikator");
}

if(isset($_GET['id_member'])){
	$id_member = $_GET['id_member'];
	header("location:admin/postingan_member.php?id_member=$id_member");
}


?>