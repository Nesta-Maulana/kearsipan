<div class="row">
	<div class="col l8 offset-l2">
		<div class="card">
			<div class="card-content">
				<div class="row">
					<div style="color: #333;text-align: center;font-family: serif;font-size: 35px;">
						Selamat Datang , <?=$userdata->fullname;?>
					</div>
				</div>
				<div class="row ">
					<img style="width: 400px;margin-left: 220px;" src="<?=asset('images/logo/pandawa-logo.png')?>" >
				</div>
				<div class="row">
					<div style="color: #333;text-align: center;font-family: serif;font-size: 45px;">Sistem Kearsipan Surat Masuk Dan Keluar</div>
					<div style="color: #333;text-align: center;font-family: serif;font-size: 35px;">
						PT Pandawa 165 Technologies
					</div>
					<div style="color: #333;text-align: center;font-family: serif;font-size: 25px;">
						Created By Nesta Maulana
					</div>
					<div style="color: #333;text-align: center;font-family: serif;font-size: 20px;">
						&copy; 2017
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php if (!empty($_SESSION['act'])): ?>
		<div class="dialog" id="aksi">
			<?=$_SESSION['act']?>
		</div>
		<script type="text/javascript">
			setTimeout(function(){
				document.getElementById('aksi').classList.add('remove');
			},3000);
		</script>
	<?php $_SESSION['act']=''; endif ?>