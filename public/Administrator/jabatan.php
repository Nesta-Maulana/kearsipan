<?php
	if (empty($_GET['id'])) {
		$url = baseurl('administrator/administrator-aksi/'.base64_encode('tambah-jabatan'));
	}
	else
	{
		$url = baseurl('administrator/administrator-aksi/'.base64_encode('ubah-jabatan').'/'.$_GET['id']);
	}
?>
<form method="post" action="<?=$url?>">
<div class="row">
	<div class="col l12" >
		<div class="card" style="background-color: rgba(255,255,255,0.3);">
			<div class="card-content">
				<div class="row">
					<div class="col l6">
						<div class="card">
							<div class="card-content">
								<div class="card-title">
									Data Jabatan
									<hr>
								</div>
								<input type="hidden" name="id_user" value="<?=$userdata->id?>">

								<div class="input-field">
									<input type="text" name="jabatan" id="fullname" class="validate" autocomplete="off" maxlength="20" <?php if (!empty($_SESSION['jabatan'])): ?>
										value="<?=$_SESSION['jabatan']?>"
									<?php endif ?>>
									<label for="fullname">Nama Jabatan</label>
								</div>
								<div class="input-field">
									<input type="submit" name="simpan" value="Kembali" class="btn waves-light waves-effect " style="background-color: #001F24" onclick="document.location.href='<?=baseurl('administrator/kelola-aplikasi')?>'">
									<input type="submit" name="simpan" value="Simpan" class="btn waves-light waves-effect " style="background-color: #001F24">
								</div>
							</div>
						</div>
					</div>
					<div class="col l6">
						<input type="text" name="pencarian" placeholder="Pencarian" onchange="submit()" class="col l10">
						<input type="submit" name="cari" value="cari" class="btn blue darken-4 col l2">
						<table class="stripped">
							<thead>
								<tr>
									<th>Jabatan</th>
									<th style="text-align: center;">Aksi</th>	
								</tr>
							</thead>
							<tbody>
								<?php
								$a=1;
							$sql = mysql_query("SELECT * from jabatan");
							while ($data_user = mysql_fetch_object($sql)) { ?>
								<tr>
									<td><?=$a?></td>		
									<td><?=$data_user->jabatan?></td>
									<td>
										<a href="<?=baseurl('administrator/administrator-aksi/').base64_encode('edit-jabatan').'/'.base64_encode($data_user->id)?>">
											edit
										</a>

										<a onclick="return confirm('Apakah anda yakin akan menghapus <?=$data_user->jabatan?>')" href="<?=baseurl('administrator/administrator-aksi/').base64_encode('hapus-jabatan').'/'.base64_encode($data_user->id)?>">
											hapus
										</a>
									</td>	
								</tr>
						<?php
						$a++;	
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

<?php if (!empty($_SESSION['aksi'])): ?>
		<div class="dialog" id="aksi">
			<?=$_SESSION['aksi']?>
		</div>
		<script type="text/javascript">
			setTimeout(function(){
				document.getElementById('aksi').classList.add('remove');
			},3000);
		</script>
	<?php $_SESSION['aksi']=''; endif ?>