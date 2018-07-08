<div class="row">
	<div class="col l10 offset-l1">
		<div class="card">
			<div class="card-content">
				<div class="card-title center">
					Konfirmasi Akun
					<hr style="width: 200px;">
				</div>
				<form method="post" action="<?=baseurl('login/aksi-validasi-user/'.base64_encode('konfirmasi-akun'))?>">
				<div class="row">
					<div class="col l8 offset-l2">
						<div class="card">
							<div class="card-content grey lighten-3">
								<div class="input-field">
									<input type="text" value="<?=$userdata->fullname?>" id="nama" readonly>
									<label class="active" for="nama">Nama Lengkap</label>
								</div>
								<div class="input-field">
									<input type="text" value="<?=$userdata->username?>" id="nama" readonly>
									<label for="nama" class="active">Username</label>
								</div>
								<div class="input-field">
									<input type="password" name="pass_lama" id="pass" class="validate" minlength="6">
									<label for="pass">Kata Sandi Lama</label>
								</div>
								<div class="input-field">
									<input type="password" name="pass_baru" id="baru" class="validate" minlength="6">
									<label for="baru">Kata Sandi Baru</label>
								</div>
								<div class="input-field">
									<input type="password" name="password_baru" id="pass_baru" class="validate" minlength="6">
									<label for="pass_baru">Konfirmasi Kata Sandi</label>
								</div>
								<div class="input-field">
									<input type="submit" name="ubah" class="waves-effect waves-light btn blue darken-3" value="Konfirmasi">
								</div>
								<input type="hidden" name="id_level" value="<?=$userdata->id_level?>">
								<input type="hidden" name="id_user" value="<?=$userdata->id?>">
							</div>
						</div>
					</div>
				</div>
				</form>
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