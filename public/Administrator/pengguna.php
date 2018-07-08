<?php
	if (empty($_SESSION['ubah'])) 
	{
		if (!empty($_SESSION['level']))
		{		
			$url = baseurl('administrator/administrator-aksi/'.base64_encode('tambah-pengguna'));
		}
		else
		{
			$url = baseurl('administrator/administrator-aksi/'.base64_encode('pilih-hak-akses'));
		}	
	}
	else
	{
		$url = baseurl('administrator/administrator-aksi/'.base64_encode('ubah-pengguna').'/'.$_GET['id']);
	}
?>
<form method="post" action="<?=$url?>">
<div class="row">
	<div class="col l12" >
		<div class="card" style="background-color: rgba(255,255,255,0.3);">
			<div class="card-content">
				<div class="row">
					<div class="col l4">
						<div class="card">
							<div class="card-content">
								<div class="card-title">
									Data User
									<hr>
								</div>
								<input type="hidden" name="id_user" value="<?=$userdata->id?>">
								<div class="input-field">
									<input type="text" name="fullname" id="fullname" class="validate" autocomplete="off" maxlength="50" <?php if (!empty($_SESSION['fullname'])): ?>
										value="<?=$_SESSION['fullname']?>"
									<?php endif ?>>
									<label for="fullname">Nama Lengkap</label>
								</div>
								<div class="input-field">
									<input type="text" name="username" id="username" class="validate" autocomplete="off" maxlength="30" <?php if (!empty($_SESSION['username'])): ?>
										value="<?=$_SESSION['username']?>"
									<?php endif ?>>
									<label for="username">Nama Pengguna</label>
								</div>
								<div class="input-field">
										<select name="id_level" id="id_level" onchange="submit()">
											<option selected disabled>Pilih Level</option>
											<?php
												$sql 	= "SELECT * FROM level";
												$jalan 	= mysql_query($sql);
												while ($data = mysql_fetch_object($jalan)) { ?>
											<option value="<?=base64_encode($data->id)?>" <?php if (!empty($_SESSION['level']) AND $_SESSION['level'] == base64_encode($data->id)) {
												echo "selected";
											} ?>><?=$data->level?></option>
											<?php	}
											?>
										</select>
									</div> 
							<?php
									if (!empty($_SESSION['level']) && base64_decode($_SESSION['level']) == '4') 
									{ ?>
										<div class="input-field">
											<select name="jabatan">
												<option selected disabled>Pilih Jabatan</option>
												<?php
													$sql 	= "SELECT * FROM jabatan";
													$jalan 	= mysql_query($sql);
													while ($data = mysql_fetch_object($jalan)) { ?>
												<option value="<?=base64_encode($data->id)?>"><?=$data->jabatan?></option>
												<?php	}
												?>
											</select>
										</div>
								<?php	}
								?> 

								<div class="input-field">
									<select name="status_account">
										<option selected disabled>Pilih Status</option>
										<option value="1" <?php if (!empty($_SESSION['ubah'])&&$_SESSION['status_account']=='1'): ?>
											selected
										<?php endif ?>>Aktif</option>
										<option value="0" <?php if (!empty($_SESSION['ubah'])&&$_SESSION['status_account']=='0'): ?>
											selected
										<?php endif ?>>Tidak Aktif</option>
									</select>
								</div>
							    <p>
							      <input name="jk" type="radio" value="L" id="L" <?php if (!empty($_SESSION['ubah']) && $_SESSION['jk']=='L'): ?>
											checked
										<?php endif ?>/>
							      <label for="L">Laki-Laki</label>
							      <input name="jk" type="radio" value="P" id="P"<?php if (!empty($_SESSION['ubah']) && $_SESSION['jk']=='P'): ?>
											checked
										<?php endif ?> />
							      <label for="P">Perempuan</label>
							    </p>

<!-- 								<div class="input-field">
									<input type="radio" class="" name="jk" value="L"> Laki - Laki
									<input type="radio" name="jk" value="P"> Perempuan
								</div> -->
								<div class="input-field">
									<a class="btn waves-light waves-effect " style="background-color: #001F24" onclick="document.location.href='<?=baseurl('administrator/kelola-aplikasi')?>'">Kembali</a>
									<input type="submit" name="simpan" value="Simpan" class="btn waves-light waves-effect " style="background-color: #001F24">
								</div>
							</div>
						</div>
					</div>
					<div class="col l8">
						<input type="text" name="pencarian" placeholder="Pencarian" onchange="submit()" class="col l10">
						<input type="submit" name="cari" value="cari" class="btn blue darken-4 col l2">
						<table class="stripped">
							<thead>
								<tr>
									<th>Nama Lengkap</th>
									<th>Nama Pengguna</th>
									<th>Jabatan</th>
									<th>Hak Akses</th>
									<th>Status Akun</th>
									<th style="text-align: center;">Aksi</th>	
								</tr>
							</thead>
							<tbody>
							<?php
							$halaman = 8; //batasan halaman
							if (empty($_SESSION['ubah'])) {
								$page = isset($_GET['id'])? (int)$_GET["id"]:1;
								$mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
							}
							else
							{
								$page = 1;
								$mulai = 0;
							}
							$query =mysql_query("SELECT *,users.id as id_user,jabatan,level FROM users LEFT JOIN level ON level.id = users.id_level LEFT JOIN jabatan ON jabatan.id =users.id_jabatan WHERE users.id!= '1' LIMIT $mulai, $halaman");
							$sql = mysql_query("select * from users");
							$total = mysql_num_rows($sql);
							$pages = ceil($total/$halaman);
								while ($data = mysql_fetch_object($query)) { ?>
								<tr>
									<td><?=$data->fullname?></td>
									<td><?=$data->username?></td>
									<td><?=$data->jabatan?></td>
									<td><?=$data->level?></td>
									<td>
										<?php if ($data->status_account=='1'): ?>
											Aktif
										<?php endif ?>

										<?php if ($data->status_account=='0'): ?>
											Tidak Aktif
										<?php endif ?>
									</td>
									<td><a href="<?=baseurl('administrator/administrator-aksi/'.base64_encode('edit-pengguna').'/'.base64_encode($data->id_user))?>">Ubah</a> || <a onclick="return confirm('Apakah anda yakin akan menghapus <?=$data->fullname?>?')" href="<?=baseurl('administrator/administrator-aksi/'.base64_encode('hapus-pengguna').'/'.base64_encode($data->id_user))?>">Hapus</a></td>
								</tr>	
							<?php	}
							?>
							</tbody>	
						</table>
							<?php 	
						for ($i=1; $i<=$pages ; $i++){ ?>
						 <a href="<?=baseurl('administrator/kelola-pengguna/'.$i)?>" class="btn deep-purple"><?php echo $i; ?></a>

						 <?php } ?>
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