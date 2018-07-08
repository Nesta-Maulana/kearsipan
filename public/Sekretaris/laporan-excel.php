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
<body onload="" style="width: 29cm;height:21cm; ">
	<table>
		<tr>
			<td rowspan="2" colspan="4" style="font-size: 35px;">PT PANDAWA 165 TECHNOLOGIES</td>
			<td>Jl. Batutulis,Gang Mekar Jaya 2 </td>
		</tr>
		<tr>
			<td>Telp.Whatsapp: 08995445740</td>
		</tr>
		<tr>
			<td colspan="4" style="font-size: 20px">For The Future Of Islamic Technologies</td>
			<td>Email : projectpandawa165@gmail.com</td>
		</tr>

		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td>Instagram : pandawa_</td>
		</tr>
		<tr>
			<td colspan="5" style="text-align: center;">
				<p>Laporan Surat <br> Tanggal <?php echo $_SESSION['tanggal_awal'] ?> - <?=$_SESSION['tanggal_akhir']?> </p>
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