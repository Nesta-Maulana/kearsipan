<?php
	$id			= base64_decode($_GET['id']);
	$disposisi 	= mysql_fetch_object(mysql_query("SELECT * FROM disposisi WHERE id='$id'"));
	$detail 	= mysql_query("SELECT * FROM disposisi_detail WHERE disposisi_id='$disposisi->id'");
	if (mysql_num_rows($detail)>0) 
	{
		$edit 	= 'ada';
	}
	else
	{
		$edit 	= '';
	}
	$surat 		= mysql_fetch_object(mysql_query("SELECT *,surat.id as id_surat,jenis_surat,tipe FROM surat INNER JOIN jenis_surat ON surat.jenis_id = jenis_surat.id INNER JOIN tipe_surat ON surat.tipe_id = tipe_surat.id WHERE surat.id='$disposisi->surat_id'"));
	$user 		= mysql_fetch_object(mysql_query("SELECT * FROM users WHERE id='$disposisi->disposisi_dari'"));
?>
<div class="row">
	<form method="post" action="<?=baseurl('pimpinan/pimpinan-aksi/'.base64_encode('input-detail-disposisi'))?>">
		<input type="hidden" name="disposition_id" value="<?=base64_encode($disposisi->id)?>">
		<input type="hidden" name="id_user" value="<?=base64_encode($user->id)?>">
		<div class="col l4 offset-l1">
			<div class="card">
				<div class="card-content">
					<div class="card-title" >
						<span style="font-size: 30px; font-family: 'Times New Roman',sans-serif ;">
							<i class="material-icons small left">mail</i> <?=$surat->jenis_surat?>
						</span>
						<hr>
						<span style="font-size: 20px; font-family: 'Times New Roman',sans-serif ;">Dari&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <b><?=$surat->surat_dari;?></b></span><br>
						<span style="font-size: 20px; font-family: 'Times New Roman',sans-serif ;">Subjek &nbsp;&nbsp;: <b><?=$surat->surat_subjek;?></b></span><br>
						<span style="font-size: 18px; font-family: 'Times New Roman',sans-serif ;">Tanggal Surat &nbsp;&nbsp;: <b><?=$surat->surat_tanggal;?></b></span><br>
						<span style="font-size: 18px; font-family: 'Times New Roman',sans-serif ;">Deskripsi : <p style="text-align: justify;font-weight: bold;font-size: 17px;"><?=htmlspecialchars_decode($surat->deskripsi)?></p></span>
					</div>
				</div>
			</div>
		</div>
		<div class="col l6">
			<div class="card">
				<div class="card-content">
					<div class="card-title">
						<span style="font-size: 30px; font-family: 'Times New Roman',sans-serif ;">
							<i class="material-icons small left">mail</i><i class="fa fa-mail-forward small left"></i>Lembar Disposisi
						</span>
						<hr>
					</div>
					<div class="row" style="margin-top: 30px;">
						<div class="input-field">
							<input type="text" id="username" value="<?=$user->fullname?>" readonly >
							<label for="username" class="active">Di Disposisikan Oleh </label>
						</div>
					</div>
					<div class="row">
						<label>Status Surat</label><br>
						<?php
							$sql 	= "SELECT * FROM status";
							$jalan 	= mysql_query($sql);
							$a 		= 0;
							while ($status = mysql_fetch_object($jalan)) {?>
						<input type="radio" class="with-gap" name="id_status" id="status<?=$a?>" value="<?=base64_encode($status->id)?>"<?php if ($disposisi->status_id ==$status->id): ?> checked <?php endif ?>>
						<label for="status<?=$a?>"><?=$status->status?></label>
						<?php $a++;	}
						?>
					</div>
					<div class="row">
						<label>Disposisi Untuk</label><br>
						<?php  
							$a 		= 0;
							$sql 	= "SELECT *,users.id as usernya,jabatan FROM users INNER JOIN jabatan ON users.id_jabatan = jabatan.id WHERE id_level='4' AND status_account='1'";
							$jalan 	= mysql_query($sql);
							while ($read = mysql_fetch_array($jalan)) 
							{
								?>
							<input type="checkbox" name="disposition_for[]" value="<?=$read['usernya']?>" id="disposisi<?=$a?>" <?php 
							$detail = mysql_query("SELECT * FROM disposisi_detail WHERE disposisi_id='$disposisi->id'");
							while ($baca =mysql_fetch_array($detail)) 
							{
								if ($baca['disposisi_untuk']==$read['usernya']) {
									echo "checked disabled";
								}
							};
							 ?>>
							<label for="disposisi<?=$a?>"><?=$read['fullname'].'-'.$read['jabatan']?></label>
							
							<?php
									$a++;  
								}
							?>
					</div>
					<div class="row">
						<label>Deskripsi Lanjutan</label>
						<textarea class="materialize-textarea" id="description" name="description"><?=htmlspecialchars_decode($disposisi->deskripsi)?></textarea>
						<input type="submit" name="disposisikan" class="waves-effect waves-light btn blue darken-2 right" value="Disposisi Kan">
						<?php if (!empty($edit)) 
						{ ?>
						<a href="<?=baseurl('pimpinan/lihat-surat/'.base64_encode($surat->id_surat))?>" name="kembali" class="waves-effect waves-light btn blue darken-2 right">Kembali</a>
					<?php }else{ ?>
						<a href="<?=baseurl('pimpinan/pimpinan-aksi/'.base64_encode('batal-disposisi').'/'.base64_encode($surat->id_surat))?>" name="kembali" class="waves-effect waves-light btn blue darken-2 right">Kembali</a>
						<?php } ?>
					</div>

				</div>
			</div>
		</div>		
	</form>
</div>
<?php 
	if (!empty($_SESSION['cek'])) 
	{?>
	<div class="dialog" id="cek">
		<?=$_SESSION['cek']?>
	</div>
	<script type="text/javascript">
		setTimeout(function(){
			document.getElementById('cek').classList.add('remove');
		},3000);
	</script>
<?php $_SESSION['cek']='';	}
?>