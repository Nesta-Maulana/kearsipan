<?php
	$url	= baseurl('administrator/administrator-aksi/'.base64_encode('tambah-surat')); 
?>
<form method="post" enctype="multipart/form-data" action="<?=$url?>">
<div class="row">
	<div class="col l12">
		<div class="card" style="background-color: rgba(255,255,255,0.3);">
			<div class="card-content">
				<div class="card-title center">
					Form Surat Keluar
				</div>
				<input type="hidden" name="jenis_id" value="<?=base64_encode('2')?>">
				<input type="hidden" name="user_id" value="<?=base64_encode($userdata->id)?>">	
				<div class="row">
					<div class="col l6">
						<div class="card">
							<div class="card-content">
								<div class="input-field">
									<input type="text" class="validate" name="surat_kode" maxlength="30" autocomplete="off" id="surat_kode" required>
									<label for="surat_kode">Nomor Surat</label>
								</div>

								<div class="input-field">
									<input type="text" class="datepicker" name="surat_tanggal" maxlength="20" autocomplete="off" id="surat_tanggal" required>
									<label for="surat_tanggal">Tanggal Surat</label>
								</div>

								<div class="input-field">
									<input type="text" class="validate" name="surat_untuk" maxlength="50" autocomplete="off" id="surat_untuk" required>
									<label for="surat_untuk">Surat Untuk</label>
								</div>

								<div class="input-field">
									<input type="text" class="validate" name="surat_subjek" maxlength="30" autocomplete="off" id="surat_subjek" required>
									<label for="surat_subjek">Perihal</label>
								</div>

								<div class="input-field">
									<select name="tipe_id">
										<option disabled selected>Jenis Surat</option>
										<?php
											$sql = mysql_query("SELECT * FROM `tipe_surat`");
											while ($tipe = mysql_fetch_object($sql)) { ?>
										<option value="<?=base64_encode($tipe->id)?>"><?=$tipe->tipe?></option>
										<?php	} ?>
									</select>
								</div>
								<div class="file-field input-field">
									<div class="btn deep-purple darken-4">
										<span>File</span>
										<input type="file" name="file_surat[]" multiple="">
									</div>
									<div class="file-path-wrapper">
										<input class="file-path validate" type="text">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col l6">
						<div class="card">
							<div class="card-content">
								<div class="card-title" style="font-size: 14px">
									Deskripsi
								</div>
								<div class="input-field">
									<textarea id="apa" name="deskripsi"></textarea>
								</div>
								<div class="input-field">
									<input type="submit" name="simpan" value="Kembali Ke Beranda" class="btn waves-effect waves-ligth deep-purple darken-4" onclick="document.location.href='<?=baseurl('administrator/index')?>'">
									<input type="submit" name="simpan" value="Arsipkan" class="btn waves-effect waves-ligth deep-purple darken-4">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
						<div class="col l12">	
							<table class="bordered">
								<thead>
									<tr>
										<th>Nomor Surat</th>
										<th>Tanggal Surat</th>
										<th>Surat Untuk</th>
										<th>Perihal</th>
										<th>Deskripsi</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
					<?php
						$today=date('d-m-Y');
						$sql 	= "SELECT * FROM surat WHERE jenis_id='2' AND surat_tanggal='$today' AND  deleted_at='0000-00-00 00:00:00'";
						$jalan 	= mysql_query($sql);
						$cek	= mysql_num_rows($jalan);
						if ($cek>0)
						{
							while ($surat = mysql_fetch_object($jalan)) { ?>
									<tr>
										<td><?=$surat->surat_kode?></td>
										<td><?=long_tanggal_indo($surat->surat_tanggal)?></td>
										<td><?=$surat->surat_untuk?></td>
										<td><?=$surat->surat_subjek?></td>
										<td><?=substr(htmlspecialchars_decode($surat->deskripsi), 0,50)?></td>
										<td>
											<a href="<?=baseurl('administrator/lihat-surat/'.base64_encode($surat->surat_kode))?>">Lihat ||</a>
											<a href="<?=baseurl('administrator/administrator-aksi/'.base64_encode('hapus-surat').'/'.base64_encode($surat->id))?>">Hapus</a>
										</td>
									</tr>
					<?php	}
					
						}else{ ?>
						<tr>
							<td colspan="6" style="text-align: center">Tidak ada data</td>
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
	</div>
</div>
</form>

<?php if (!empty($_SESSION['simpan'])): ?>
	<div class="dialog" id="aksi">
		<?=$_SESSION['simpan']?>
	</div>
	<script type="text/javascript">
		setTimeout(function(){
			document.getElementById('aksi').classList.add('remove');
		},3000);
	</script>
<?php $_SESSION['simpan']=''; endif ?>	