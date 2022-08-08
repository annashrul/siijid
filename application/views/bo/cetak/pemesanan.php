<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
	<meta name="author" content="Coderthemes">
	
	<link rel="shortcut icon" href="images/favicon_1.ico">
	
	<title id="titleLuhur"></title>
	
	<!-- <link href="https://fonts.googleapis.com/css?family=Basic|Concert+One" rel="stylesheet"> -->
	<link href="https://fonts.googleapis.com/css?family=Ubuntu+Condensed" rel="stylesheet">
	<!-- Base Css Files -->
	<link href="<?=base_url().'assets/bo/'?>css/bootstrap.min.css" rel="stylesheet" />
	
	<!-- Font Icons -->
	<link href="<?=base_url().'assets/bo/'?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<link href="<?=base_url().'assets/bo/'?>assets/ionicon/css/ionicons.min.css" rel="stylesheet" />
	<link href="<?=base_url().'assets/bo/'?>css/material-design-iconic-font.min.css" rel="stylesheet">
	
	<!-- animate css -->
	<link href="<?=base_url().'assets/bo/'?>css/animate.css" rel="stylesheet" />
	
	<!-- Waves-effect -->
	<link href="<?=base_url().'assets/bo/'?>css/waves-effect.css" rel="stylesheet">
	
	<!-- Custom Files -->
	<link href="<?=base_url().'assets/bo/'?>css/helper.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url().'assets/bo/'?>css/style.css" rel="stylesheet" type="text/css" />
	
	
	<script src="<?=base_url().'assets/bo/'?>js/modernizr.min.js"></script>
	<script src="<?=base_url().'assets/bo/'?>js/jquery.min.js"></script>
	<!-- jQuery  -->

</head>
<style>
	html{font-family: 'Ubuntu Condensed', sans-serif;}
	body{
		font-family: 'Ubuntu Condensed', sans-serif;
		/*font-family: 'Concert One', cursive!important;*/
		/*font-family: 'Basic', sans-serif!important;*/
		font-size: 18px;
	}
	h1,h2,h3,h4,h5,h6,p{font-family: 'Ubuntu Condensed', sans-serif;}
	.paddingRight{padding:0px 0px 0px 10px;}
	.paddingLeft{padding:0px 10px 0px 0px;}
	.noPadding{padding:0px 0px 0px 0px;}
	.btn{font-weight: bold;}
	/*.dropdown-toggle:focus{background: linear-gradient(to right, #00c6ff, #0072ff);color:white!important;}*/
	/*.select2{border-radius: 0px!important;border:1px solid rgba(49, 126, 235, 0.5);}*/
</style>
<body>
<style>
	.formPemesanan{border-top:0px;border-left:0px;border-right:0px;background-color:white;font-size:20px;}
	.formPemesanan:focus{border-top:0px;border-left:0px;border-right:0px;border-bottom: 0px;}
	.NoHwn{height:84px;border:1px solid black;background-image: linear-gradient(90deg, #EEEEEE 50%, black 50%);color: #d35400;
		background-size: 4px;padding:5px 0px 0px 0px;}
	.Print{height:107px;border:1px solid white;width:50%;padding:25px 0px 0px 0px;background:linear-gradient(to right, #00c6ff, #0072ff);}
	.size{font-size:60px;color:white;}
	label{font-weight: normal;}
	/*textarea.form-control{border: 1px solid black;height:50px;}*/
</style>
<?php
$tes = date("Y m d");
// echo hijriahTBH($tes);
// echo "<br/>";
// echo hijriahTB($tes);
// echo "<br/>";
// echo hijriahT($tes);
?>
<div class="row">
	<div class="col-sm-12 col-xs-12">
		<div class="panel panel-default">
			<div class="row">
				<div class="panel-heading">
					<div class="col-md-12 col-sm-12 col-xs-12" style="border-bottom:2px solid black;">
						<div class="col-md-3 col-sm-3 col-xs-3 pull-left">
							<img src="<?=base_url('assets/logo-masjid.png')?>" alt="" style="height:100px;width:100px;">
						</div>
						<div class="col-md-6 col-sm-6 col-xs-6">
							<h4 class="text-center">PANITIA IDUL ADHA <?=hijriahT($tes)?></h4>
							<h4 class="text-center">MASJID <?=strtoupper($pemesan->nama_masjid)?></h4>
							<!-- <h4 class="text-center"><?=strtoupper($pemesan->alamat_masjid)?></h4> -->
							<h5 class="text-center"><?=$pemesan->alamat_masjid?></h5>
						</div>
						<div class="col-md-3 col-sm-3 col-xs-3">
							<img src="<?=base_url('assets/sapi-kambing.png')?>" alt="" height="100" width="100" style="float:right;">
						</div>
					</div>
				</div>
			</div>
			<div class="panel-heading"><h4 class="text-center">FORMULIR PEMESANAN / TITIPAN HEWAN QURBAN</h4></div>
			<div class="row">
				<div class="col-sm-12 col-xs-12">
					<div class="panel-body">
						<form class="form-horizontal" role="form">
							<div class="col-sm-8 col-xs-8 col-md-8 noPadding">
								<div class="form-group">
									<label class="col-sm-2 col-xs-2 text-left">Nama</label>
									<div class="col-sm-9 col-xs-9">
										<input type="email" class="form-control input-xs formPemesanan" id="" value="<?=$pemesan->nama_pemesan?>" readonly>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 col-xs-2 text-left">Alamat</label>
									<div class="col-sm-9 col-xs-9">
										<textarea class="form-control input-xs formPemesanan" readonly><?=$pemesan->alamat_pemesan?></textarea>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-12 col-xs-12">
										<h4 class="text-left">
											Bermaksud Melaksanakan Qurban Tahun Ini, dengan :
										</h4>
									</div>
									<div class="col-sm-6 col-xs-12">
										<ol>
											<li>Menitipkan Uang Sebesar <?='Rp '.number_format($pemesan->jumlah_uang,0,',','.');?> Untuk Dibelikan Hewan Qurban Secara Kolektif Untuk 1/7 Ekor Sapi</li>
											<li>Infaq / Shadaqoh Sebesar <?='Rp '.number_format($pemesan->jumlah_infaq,0,',','.');?></li>
										</ol>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 text-left">Catatan Khusus</label>
									<div class="col-sm-9">
										<textarea class="form-control input-xs formPemesanan" readonly><?=$pemesan->alamat_pemesan?></textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 text-left">Total</label>
									<div class="col-sm-9">
										<input type="text" class="form-control input-xs formPemesanan" id="" value="<?='Rp '.number_format($pemesan->jumlah_uang+$pemesan->jumlah_infaq,0,',','.');?> ( <?=terbilang($pemesan->jumlah_uang+$pemesan->jumlah_infaq).' Rupiah'?> )" readonly>
									</div>
								</div>
							</div>
							<div class="col-sm-4 col-xs-4 NoHwn">
								<h1 class="text-center" style="color:black;font-weight:bold;"><?=$pemesan->no_pemesanan?></h1>
							</div>
							<!-- <div class="col-sm-12 col-xs-12">
			        	<div class="col-sm-3 col-xs-3">
				        	<h4 class="text-center">
			        			Bandung, <?=hbt_indo($pemesan->tgl_pemesanan)?>
			        		</h4>
			        	</div>
			        </div -->
							<div class="col-sm-12 col-xs-12">
								<div class="col-sm-3 col-xs-3">
									<h4 class="text-center">
										Hormat Kami <br/>
										<center><img src="https://upload.wikimedia.org/wikipedia/id/4/46/Tanda_Tangan_Dahlan_Iskan.png" class="img img-responsive" style="height:40px; width:100px;"></center><br/>
										<?=$pemesan->nama_pemesan?>
										<hr/>
									</h4>
								</div>
								<div class="col-sm-6 col-xs-6"></div>
								<div class="col-sm-3 col-xs-3">
									<h4 class="text-center">
										Hormat Kami <br/>
										<center><img src="https://upload.wikimedia.org/wikipedia/id/4/46/Tanda_Tangan_Dahlan_Iskan.png" class="img img-responsive" style="height:40px; width:100px;"></center><br/>
										<?=$pemesan->nama_pengurus?>
										<hr/>
									</h4>
								</div>
								<h4 class="text-left">
									<ul>
										<li>
											Infaq yang diberikan oleh pengurban / warga akan digunakan untuk biaya operasional pelaksanaan kegiatan Idul Adha
										</li>
									</ul>
								</h4>
							</div>
						
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
  window.print();
</script>
</body>
</html>