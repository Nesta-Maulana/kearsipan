<?php 
	$id_surat 	= base64_decode($_GET['id']);
	$isi_surat	= mysql_fetch_object(mysql_query("SELECT *,surat.id as idnya, jenis_surat,tipe,fullname FROM surat INNER JOIN jenis_surat ON surat.jenis_id = jenis_surat.id INNER JOIN tipe_surat ON surat.tipe_id = tipe_surat.id INNER JOIN users ON surat.user_id = users.id WHERE surat.surat_kode='$id_surat'"));
	if ($isi_surat->jenis_id =='1') 
	{
		$surat='surat-masuk';
	}
	else
	{
		$surat='surat-keluar';
	}
?>
<div class="row">
	<div class="col l10 offset-l1">
		<div class="card">
			<div class="card-content ">
				<div class="row">
					<div class="col l12 right">
						<a href="<?=baseurl('download-surat-pdf/'.base64_encode($id_surat))?>" target="_blank">
							<button class="btn deep-purple darken-4">Download Laporan Surat</button>
						</a>
						
					</div>
					
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col l10 offset-l1">
		<div class="card">
			<div class="card-content" >
				<div class="row">		
					<div class="col l2 left">
						<img style="width: 200px;height: 150px;" src="<?=asset('images/logo/pandawa-logo.png')?>">
					</div>
					<div class="col l6"><br>
						<span style="font-size: 30px;font-weight: bold;font-family: 'Times New Roman' sans-serif; color:#111;">
							PT . PANDAWA 165 TECHNOLOGIES
						</span><br>
						<span style="font-size: 24px;font-weight: inherit;font-family: 'Times New Roman' sans-serif; color:#333;">
							For The Future Of Islamic Technologies 
						</span><br>
						<span style="font-size: 20px;font-weight: thin;font-family: 'Times New Roman' sans-serif; color:#444;">
							"Berdoa , Berusaha , Bersyukur" 
						</span>
					</div>
					<div class="col l4"><br>
						<p style="text-align: right;">
							Jalan Batutulis Kelurahan Batutulis <br>
							Telp./Whatsapp : 0899-5445-740 <br>
							Email : projectpandawa165@gmail.com
							Instagram : @pandawa_
						</p>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col l12 center">
						<h5>Form <?=$isi_surat->jenis_surat?> <?php if($isi_surat->jenis_surat=='Surat Masuk'){ echo 'Dari '.$isi_surat->surat_dari; }else{echo 'Kepada '.$isi_surat->surat_untuk; } ?> </h5>
					</div>
					<hr>
				</div>			
				<div class="row">
					<div class="col l12">
						<div class="right" >
							<p style="text-align: justify;">
								<?=long_tanggal_indo($isi_surat->surat_tanggal);?><br>
								Kepada <br>
								<?=$isi_surat->surat_untuk;?>
							</p>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col l12">
						<p>
							No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?=$isi_surat->surat_kode?>
						</p>
						<p>
							Perihal : <?=$isi_surat->surat_subjek?>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col l10 offset-l1">
						<?=htmlspecialchars_decode($isi_surat->deskripsi);?> 
					</div>
				</div>
				<br><br><br><br>
				<div class="row">
					<div class="col l10 offset-l1">
						Mengetahui ,<br><br><br>
						<h6><?=$isi_surat->surat_dari?></h6>  
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
	$cekdisposisi = mysql_query("SELECT * FROM disposisi WHERE surat_id ='$isi_surat->idnya'");
		if (mysql_num_rows($cekdisposisi) > 0) { 
				$disposisi = mysql_fetch_object($cekdisposisi);
			?>	
	<div class="row">
		<div class="col l10 offset-l1">
			<div class="card">
				<div class="card-content">
					
				<div class="card-title">
					Telah Didisposisikan Kepada
					<hr>
				</div>
				<table class="bordered striped" style="font-size: 25px;">
					<tr>
						<td>Catatan</td>
						<td>:</td>
						<td><?=$disposisi->deskripsi?></td>
					</tr>
				</table>
				<table class="bordered striped">
					<tr>
						<th>Kepada</th>
						<th>Waktu</th>
						<th>Dilihat Pada</th>
					</tr>
				<?php 

				
				$disposisibaca = mysql_query("SELECT *,users.fullname FROM disposisi_detail INNER JOIN users ON users.id = disposisi_detail.disposisi_untuk WHERE disposisi_id='$disposisi->id'");
				while ($disposisi_detail = mysql_fetch_object($disposisibaca)) { ?>
					<tr>
						<td><?=$disposisi_detail->fullname?></td>
						<td><?=long_tanggal_indo(substr($disposisi->disposisi_waktu, 0,10)).' '.substr($disposisi->disposisi_waktu, 11,20)?></td>
						<td>
							<?php 
							if ($disposisi_detail->waktu_lihat !=='') {
								echo long_tanggal_indo(substr($disposisi_detail->waktu_lihat, 0,10)).' '.substr($disposisi_detail->waktu_lihat, 11,20);
							}
							else
							{
								echo "BELUM DIBACA";
							}
							 ?>
						</td>
					</tr>						

				<?php 
				}
			?>

				</table>

				</div>
			</div>
		</div>
	</div>
						<?php 
						}
					?>

<div class="row">
	<div class="col l10 offset-l1">
		<div class="card">
			<div class="card-content ">
				<div class="card-title">
					File Pendukung
				</div>
				<div class="row">
				<table class="bordered striped">
				<?php
					$sql = mysql_query("SELECT * FROM surat_file WHERE surat_kode='$id_surat'");
					while ($file = mysql_fetch_object($sql)) {?>
						<tr>
							<td><?=$file->file?></td>
							<td style="text-align: right;">
								<a href="<?=asset('document/surat-masuk/'.$file->file)?>" target="_blank">Lihat File</a> || 
								<a href="<?=asset('document/surat-masuk/'.$file->file)?>" download>Download File</a>
							</td>
						</tr>
					<?php } ?>
				</table>
				</div>
			</div>
		</div>
	</div>
</div>
<?php 
	if (!empty($_SESSION['berhasil_disposisi'])) 
	{?>
	<div class="dialog" id="berhasil_disposisi">
		<?=$_SESSION['berhasil_disposisi']?>
	</div>
	<script type="text/javascript">
		setTimeout(function(){
			document.getElementById('berhasil_disposisi').classList.add('remove');
		},3000);
	</script>
<?php $_SESSION['berhasil_disposisi']='';	}
?>
<?php 
	if (!empty($_SESSION['gagal'])) 
	{?>
	<div class="dialog" id="gagal">
		<?=$_SESSION['gagal']?>
	</div>
	<script type="text/javascript">
		setTimeout(function(){
			document.getElementById('gagal').classList.add('remove');
		},3000);
	</script>
<?php $_SESSION['gagal']='';	}
?>