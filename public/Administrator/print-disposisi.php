<?php
	require 	'../../lib/init.php';
	$id_surat 	= base64_decode($_GET['id']);
	$isi_surat	= mysql_fetch_object(mysql_query("SELECT * FROM surat where id='$id_surat'"));
	$disposisi 	= mysql_fetch_object(mysql_query("SELECT * FROM disposisi WHERE surat_id='$id_surat'"));
	$user 		= mysql_fetch_object(mysql_query("SELECT * FROM users WHERE id='$disposisi->disposisi_dari'"));
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
</head>
<body onload="window.print()" style="width: 29.7cm;height: auto;">
	<table style="border: 1px solid black;">
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
				<h6>Telp./Whatsapp: <br>0899-5445-740</h6>
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
	</table>
	<table>
		<tr>
			<td>
				<table style="border:1px solid black">
					<tr>
						<td colspan="3" style="text-align: center;font-size: 20px;font-weight: bold">
							Surat Masuk Dari <?=$isi_surat->surat_dari?>
							<hr>
						</td>
					</tr>
					<tr>
						<td>Perihal Surat</td>
						<td>:</td>
						<td><?=$isi_surat->surat_subjek?></td>
					</tr>
					<tr>
						<td>Tanggal Surat</td>
						<td>:</td>
						<td><?=$isi_surat->surat_tanggal?></td>
					</tr>
					<tr>
						<td>Deskripsi Surat</td>
						<td>:</td>
						<td><?=htmlspecialchars_decode($isi_surat->deskripsi)?></td>
					</tr>
					<tr>
						<td>Deskripsi Lanjutan</td>
						<td>:</td>
						<td><?=htmlspecialchars_decode($disposisi->deskripsi)?></td>
					</tr>
					<tr>
						<td>Didiposisikan Oleh</td>
						<td>:</td>
						<td><?=htmlspecialchars_decode($user->fullname)?></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td></td>
					</tr>
				</table>
			</td>
			<td>
				<table style="border:1px solid black">
					<tr>
						<td colspan="3" style="font-size: 20px;font-weight: bold; text-align: center">
							Di Disposisikan Kepada
							<hr>
						</td>
					</tr>
			<?php
				$sql 	= "SELECT *,users.id as usernya,jabatan FROM users INNER JOIN jabatan ON users.id_jabatan = jabatan.id WHERE id_level='4' AND status_account='1'";
				$jalan 	= mysql_query($sql);
				while ($data = mysql_fetch_object($jalan)) { ?>
				<tr>
						<td colspan="2" ><?=$data->fullname?></td>
				<?php 
					$detail = mysql_query("SELECT * FROM disposisi_detail WHERE disposisi_id='$disposisi->id'");
					while ($baca =mysql_fetch_array($detail)) 
					{
						if ($baca['disposisi_untuk']==$data->usernya) 
						{ ?>
						<td style="text-align: center;">
							<i class="material-icons">verified_user</i>
						</td>
					<?php 
						}
						else
						{ ?>

						<td style="text-align: center;">
							<i class="fa fa-square-o" style="font-size: 1.3rem"></i>
						</td>
					<?php }
					};
					 ?>
				</tr>	
			<?php	}
			?>
				</table>
			</td>
		</tr>
	</table>
	
	
</body>
</html>
