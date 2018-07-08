<?php
	if (empty($_GET['id'])) 
	{
		$url = base64_encode('tambah-pengguna');
	}
	else
	{
		$id  	= base64_decode($_GET['id']);
		$edit 	= mysql_fetch_object(mysql_query("SELECT * FROM users WHERE id='$id'"));
		$url	= base64_encode('ubah-pengguna');
	}
?>
<div class="row">
	<form method="post" action="<?php if(!empty($edit)){
		echo baseurl('admin/adminController/'.$url.'/'.base64_encode($_GET['id']));
	}else
	{
		echo baseurl('admin/adminController/'.$url);
	} ?>">
		<div class="col l4 offset-l1">
			<div class="card">
				<div class="card-content">
					<div class="card-title">
						Kelola Pengguna
						<hr style="width: 180px;margin-left: 1px">
					</div>
					<div class="input-field">
						<input type="text" name="fullname" id="fullname" class="validate" autocomplete="off" maxlength="30" value="<?php if (!empty($edit)): echo $edit->fullname; endif ?>">
						<label for="fullname" class="<?php if (!empty($edit)): echo'active'; endif ?>">Nama Lengkap</label>
					</div>
					<div class="input-field">
						<input type="text" maxlength="50" name="username" id="username" class="validate" autocomplete="off" value="<?php if (!empty($edit)): echo $edit->username; endif ?>">
						<label  class="<?php if (!empty($edit)): echo'active'; endif ?>" for="username">Nama Pengguna</label>
					</div>
					<div class="input-field">
						<select name="id_level">
							<option selected disabled>Hak Akses</option>
					<?php
						$sql 	= "SELECT * FROM level";
						$jalan 	= mysql_query($sql);
						while ($level = mysql_fetch_object($jalan)) { ?>
						<option value="<?=base64_encode($level->id)?>" 
							<?php if (!empty($edit)) 
							{
								if ($edit->id_level==$level->id) 
								{ ?>
								selected
								<?php 
								} 
							} ?>
							><?=$level->level?></option>
					<?php	}
					?>
						</select>
					</div>
					<div class="input-field">
						<select name="status_account">
							<option selected disabled>Status Akun</option>
							<option value="<?=base64_encode('1')?>" <?php 
								if (!empty($edit)) {
									if ($edit->status_account =='1') {
										echo 'selected';
									}
								}
							 ?>>Aktif</option>
							<option value="<?=base64_encode('0')?>" <?php if (!empty($edit)) {
									if ($edit->status_account =='0') {
										echo 'selected';
									}
								}
							 ?>>Tidak Aktif</option>
						</select>
					</div>
					<div class="input-field">
						<input type="submit" name="simpan" value="Simpan" class="waves-effect waves-light blue darken-3 btn">
					</div>
				</div>
			</div>
		</div>
	</form>
	<div class="col l6">
		<div class="card">
			<div class="card-content">
				<table id="table">
					<thead>
						<tr>
							<th>Nama Lengkap</th>
							<th>Nama Pengguna</th>
							<th>Hak Akses</th>
							<th>Status</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
					<?php
					$sql = mysql_query("SELECT *,users.id as id_user,level FROM users INNER JOIN level ON users.id_level=level.id WHERE users.id != '1' AND users.id != '$user->id'");
					while ($data_user = mysql_fetch_object($sql)) { 
						if ($data_user->id != $user->id) { ?>
						<tr>
							<td><?=$data_user->fullname?></td>		
							<td><?=$data_user->username?></td>		
							<td><?=$data_user->level?></td>		
							<td><?php if ($data_user->status_account == '0'){echo "Tidak Aktif";}else{echo"Aktif";} ?></td>	
							<td>
								<a href="<?=baseurl('admin/kelola-pengguna/'.base64_encode($data_user->id_user))?>">
									<i class="fa fa-pencil" style="font-size: 1.4rem"></i>
								</a>
							</td>	
						</tr>
				<?php	
						}
					}
					?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
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