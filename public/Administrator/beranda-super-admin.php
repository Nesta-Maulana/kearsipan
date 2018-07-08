<div class="row">
	<div class="col l12">
		<div class="card" style="background-color: rgba(255,255,255,0.3);">
			<div class="card-content">
				<div class="card-title">
					<i class="material-icons left">dashboard</i>Dashboard Admin
					<hr>
				</div>
				<div class="row">
					<div class="col l3">
						 <div class="card blue darken-4">
				            <div class="card-content white-text center">
				                <i class="fa fa-mail-reply medium"></i>
				                <i class="material-icons small">mail</i>
				            </div>
				            <div class="card-action center">
				                <a class="white-text" href="<?=baseurl('administrator/surat-masuk')?>">Surat Masuk</a>
				            </div>
				            <div class="card-panel">
				                Nesta Maulana, Anda bisa melihat keseluruhan surat masuk ke/dari perusahan ini.
				            </div>
				        </div>
					</div>
					<div class="col l3">
						 <div class="card green darken-4">
				            <div class="card-content white-text center">
				                <i class="material-icons small">mail</i>
				                <i class="fa fa-folder-open medium"></i>
				            </div>
				            <div class="card-action center">
				                <a class="white-text" href="<?=baseurl('administrator/arsip-perusahaan')?>">Arsip Perusahaan</a>
				            </div>
				            <div class="card-panel">
				                Nesta Maulana, Anda bisa melihat keseluruhan surat masuk dan keluar ke/dari perusahan ini.
				            </div>
				        </div>
					</div>
					<div class="col l3">
						 <div class="card red darken-4">
				            <div class="card-content white-text center">
				                <i class="material-icons small">mail</i>
				                <i class="fa fa-mail-forward medium"></i>
				            </div>
				            <div class="card-action center">
				                <a class="white-text" href="<?=baseurl('administrator/surat-keluar')?>">Surat Keluar</a>
				            </div>
				            <div class="card-panel">
				                Nesta Maulana, Anda bisa melihat keseluruhan surat masuk dan keluar ke/dari perusahan ini.
				            </div>
				        </div>
					</div>
					<div class="col l3">
						 <div class="card purple darken-4">
				            <div class="card-content white-text center">
				                <i class="fa fa-gears medium"></i>
				            </div>
				            <div class="card-action center">
				                <a href="<?=baseurl('administrator/kelola-aplikasi')?>" class="white-text" href="">Kelola Data Aplikasi</a>
				            </div>
				            <div class="card-panel">
				                Nesta Maulana, Anda adalah orang yang berhak mengelola seluruh data aplikasi ini.
				            </div>
				        </div>
					</div>

				</div>

				<div class="row">
					<div class="col l6">
						<div class="card" style="" le="background-color:rgba(255,255,255,0.5);">
							<div class="card-content" >
								<div class="card-title">Data Surat</div>
								<table>
									<tr>
										<td style="width: 40%;">
											 <div class="card blue darken-4">
									            <div class="card-content white-text center">
									                <i class="fa fa-reply medium"></i>
									                <i class="material-icons small">mail</i>
									            </div>
									            <div class="card-action center white-text">
									            	Jumlah Surat Masuk Hari Ini
									            </div>
									            <div class="card-panel center">
									            <?php
									            	$date=date('d-m-Y');
									            	$todaymail = mysql_num_rows(mysql_query("SELECT * FROM surat WHERE jenis_id='1'"));
									            ?>
									                <h5><?=$todaymail?></h5>
									            </div>
									        </div>

										</td>
										<td style="width: 40%;">
											<div class="card red darken-4">
									            <div class="card-content white-text center">
									                <i class="material-icons small">mail</i>
									                <i class="fa fa-mail-forward medium"></i>
									            </div>
									            <div class="card-action center white-text">
									            	Jumlah Surat Keluar Hari Ini
									            </div>
									            <div class="card-panel center">
								            	 <?php
									            	$date=date('d-m-Y');
									            	$todaymailout = mysql_num_rows(mysql_query("SELECT * FROM surat WHERE jenis_id='2'"));
									            ?>
									                <h5><?=$todaymailout?></h5>
									            </div>
									        </div>
										</td>
									</tr>
									<tr>
										<td style="width: 40%;">
											<div class="card green darken-4">
									            <div class="card-content white-text center">
									                <i class="material-icons small">mail</i>
									                <i class="fa fa-folder-open medium"></i>
									            </div>
									            <div class="card-action center white-text">
									            	Jumlah Surat Diperusahaan
									            </div>
									            <div class="card-panel center">
									           	<?php
								            	$allmail = mysql_num_rows(mysql_query("SELECT * FROM surat"));

									           	?>
									                <h5><?=$allmail?></h5>
									            </div>
									        </div>
										</td>
										<td style="width: 40%;">
											<div class="card orange darken-4">
									            <div class="card-content white-text center">
									                <i class="material-icons small">mail</i>
									                <i class="fa fa-forward medium"></i>
									            </div>
									            <div class="card-action center white-text">
									            	Surat Yang Di Disposisikan
									            </div>
									            <?php
									            	$maildisposisi =mysql_num_rows(mysql_query("SELECT * FROM disposisi"));
									            ?>
									            <div class="card-panel center">
									                <h5><?=$maildisposisi?></h5>
									            </div>
									        </div>
										</td>
									</tr>
								</table>
							</div>
						</div>
					</div>
					<div class="col l6">
						<div class="card">
							<div class="card-content" style="overflow-y: auto;height: 728px">
								<div class="card-title">
									Aktivitas Terbaru
								</div>
							<?php
								$sql 	= "SELECT *,aktivitas,fullname FROM log_aktivitas INNER JOIN kode_aktivitas ON kode_aktivitas.kode_aktivitas=log_aktivitas.id_aktivitas INNER JOIN users ON users.id = log_aktivitas.user_id order by waktu desc";
								$jalan 	= mysql_query($sql);
								while ($read = mysql_fetch_object($jalan)) {
									if (!empty($read->user_pengaruh)) 
									{
										$usernya = mysql_fetch_object(mysql_query("SELECT * FROM users WHERE id='$read->user_pengaruh'"));
									}
								 ?>
									<?php if ($read->id_aktivitas==='1' or $read->id_aktivitas==='2' or $read->id_aktivitas==='7' or $read->id_aktivitas==='8' or $read->id_aktivitas==='9' or $read->id_aktivitas==='2' or $read->id_aktivitas==='10'): ?>
										<div class="row">	
											<div class="card-content deep-purple darken-4 white-text">
												<p style="text-align: left;"><?=$read->waktu?></p>
												<p><?=$read->fullname?>, <?=$read->aktivitas?> <?=$read->deskripsi_aktivitas?></p>
											</div>
										</div>
									<?php endif ?>
									<?php if ($read->id_aktivitas==='3'): ?>
										<div class="row">
											<div class="card-content blue darken-4 white-text">
												<p style="text-align: left;"><?=$read->waktu?></p>
												<p><?=$read->fullname.', '.$read->aktivitas.' '.$read->deskripsi_aktivitas?></p>
											</div>
										</div>
									<?php endif ?>
									<?php if ($read->id_aktivitas==='4'): ?>
										<div class="row">
											<div class="card-content red darken-4 white-text">
												<p style="text-align: left;"><?=$read->waktu?></p>
												<p><?=$read->fullname.', '.$read->aktivitas.' '.$read->deskripsi_aktivitas?></p>
											</div>
										</div>
									<?php endif ?>
									<?php if ($read->id_aktivitas==='11'): ?>
										<div class="row">
											<div class="card-content orange darken-4 white-text">
												<p style="text-align: left;"><?=$read->waktu?></p>
												<p><?=$read->fullname.', '.$read->aktivitas.' '.$read->deskripsi_aktivitas.' '.$usernya->fullname?></p>
											</div>
										</div>
									<?php endif ?>
							<?php	}
							?>
								
								
								<!-- <div class="row">
									<div class="card-content orange darken-4 white-text">
										<p style="text-align: left;">20-10-2018 10:09:10</p>
										<p>Nesta Maulana, Mendiposisikan surat kepada Auto bot dengan surat bla bla bla</p>
									</div>
								</div>
								<div class="row">
									<div class="card-content pink darken-4 white-text">
										<p style="text-align: left;">20-10-2018 10:09:10</p>
										<p>Nesta Maulana, telah membaca surat yang didisposisikan untuknya telah membaca surat yang didisposisikan untuknya </p>
									</div>
								</div>
								<div class="row">	
									<div class="card-content blue darken-4 white-text">
										<p style="text-align: left;">20-10-2018 10:09:10</p>
										<p>Nesta Maulana, Menambahkan surat masuk dengan kode #LTR00190Nesta Maulana, Menambahkan surat masuk dengan kode #LTR00190</p>
									</div>
								</div> -->
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>