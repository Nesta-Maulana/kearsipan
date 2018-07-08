<?php 
	require_once '../../lib/init.php';
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
<body onload="window.print()" style="width: 29cm;height:21cm; ">
	<table>
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
				<h5>Laporan Surat <br> Tanggal <?php echo $_SESSION['tanggal_awal'] ?> - <?=$_SESSION['tanggal_akhir']?> </h5>
			<hr>
			</td>
		</tr>
	</table>
	<table>
			<tr>
				<th>Nomor Surat</th>
				<th>Surat Dari</th>
				<th>Surat Untuk</th>
				<th>Tanggal Surat</th>
				<th>Perihal</th>
			</tr>
		<?php
			$sql = mysql_query("select * from surat");
			while ($data = mysql_fetch_object($sql)) 
			{ ?>
			 	<tr>
			 		<td><?=$data->surat_kode?></td>
			 		<td><?=$data->surat_dari?></td>
			 		<td><?=$data->surat_untuk?></td>
			 		<td><?=$data->surat_tanggal?></td>
			 		<td><?=$data->surat_subjek?></td>
			 	</tr>
			<?php } ?>			
	</table>
</body>
</html>