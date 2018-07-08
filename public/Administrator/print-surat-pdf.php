<?php 
	require_once '../../lib/init.php';
	require_once '../../asset/dompdf/dompdf_config.inc.php';	
	$id_surat 	= base64_decode($_GET['id']);
	$isi_surat	= mysql_fetch_object(mysql_query("SELECT *,jenis_surat,tipe,fullname FROM surat INNER JOIN jenis_surat ON surat.jenis_id = jenis_surat.id INNER JOIN tipe_surat ON surat.tipe_id = tipe_surat.id INNER JOIN users ON surat.user_id = users.id WHERE surat.surat_kode='$id_surat'"));
	if ($isi_surat->jenis_id =='1') 
	{
		$surat='surat-masuk';
	}
	else
	{
		$surat='surat-keluar';
	}
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="<?=asset('dashboard_style/css/icon/icon.css');?>">
	<link rel="stylesheet" type="text/css" href="<?=asset('dashboard_style/css/icon/font-awesome.min.css');?>">
	<link rel="stylesheet" type="text/css" href="<?=asset('dashboard_style/css/materialize.min.css');?>">
	<link rel="stylesheet" type="text/css" href="<?=asset('dashboard_style/css/materialize.css');?>">
	<style type="text/css">
		h6{
			font-size: 13px;
		}
	</style>
</head>
<body onload="window.print()" style="width: 29cm;width: ">
	<table style="border:1px solid black;">
		<tr>
			<td rowspan="2">
				<img style="width: 200px;height: 150px;" src="<?=asset('images/logo/pandawa-logo.png')?>">
			</td>
			<td colspan="2" style="font-size: 30px;font-weight: bold;font-family: 'Times New Roman' sans-serif; color:#111;" width="100%">
				<div style="margin-top: -12px">
					PT . PANDAWA 165 TECHNOLOGIES
				</div>
			</td>
			<td rowspan="2" colspan="3" >
				<h6>Jl. Batutulis Kelurahan Batutulis</h6>
				<h6>Telp./Whatsapp: 0899-5445-740</h6>
				<h6 style="font-size: 15px">Email: projectpandawa165@gmail.com</h6>
				<h6>Instagram : @pandawa_</h6>
				
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<div style="margin-top: -50px">
					<span style="font-size: 16px;font-weight: inherit;font-family: 'Times New Roman' sans-serif; color:#333;">
						For The Future Of Islamic Technologies 
					</span><br>
				</div>
			</td>
		</tr>
		<tr>
			<td colspan="6" style="text-align: center;">
			<hr>
				<h5>Form <?=$isi_surat->jenis_surat?> <?php if($isi_surat->jenis_surat=='Surat Masuk'){ echo 'Dari '.$isi_surat->surat_dari; }else{echo 'Kepada '.$isi_surat->surat_untuk; } ?> </h5>
			<hr>
			</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td>
					<h6 style="text-align: justify;">
						<?=long_tanggal_indo($isi_surat->surat_tanggal);?><br>
						Kepada <br>
						<?=$isi_surat->surat_untuk;?>
					</h6>
			</td>
		</tr>
		<tr>
			<td colspan="6" >
				No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?=$isi_surat->surat_kode?><br>
				Perihal : <?=$isi_surat->surat_subjek?>
			</td>
		</tr>
		<tr>
			<td></td>
			<td colspan="5" style="text-align: justify;">
				<?=htmlspecialchars_decode($isi_surat->deskripsi);?> 
			</td>
		</tr>
		<tr>
			<td colspan="6"></td>
		</tr>
		<tr>
			<td></td>
			<td colspan="5">
				Mengetahui ,<br><br><br><br>
				<h6><?=$isi_surat->surat_dari?></h6>  
			</td>
		</tr>
	</table>
</body>
</html>