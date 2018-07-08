<div class="row">
	<div class="col l10 offset-l1">
		<div class="card">
			<div class="card-content">
				<div class="card-title">
					<i class="fa fa-bell left small"></i> <h4>Notifikasi</h4>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col l10 offset-l1">
		<div class="card">
		<?php
			$sql = mysql_query("SELECT distinct(kedatangan_surat) FROM surat order by `surat`.`kedatangan_surat` desc");
			while ($tanggal =mysql_fetch_object($sql)) 
			{
				?>
				<div class="card-title" style="margin-left: 20px;padding-top: 20px">
					<?=$tanggal->kedatangan_surat;?>
				</div>
				<?php 
				$baca 	= mysql_query("SELECT * FROM surat WHERE kedatangan_surat='$tanggal->kedatangan_surat' AND deleted_at='0000-00-00 00:00:00'");
				while ($notif = mysql_fetch_object($baca)) 
				{
					if ($notif->notifikasi =='0') 
					{ 
				?>
							<div class="card-content" >
								<a href="<?=baseurl('pimpinan/pimpinan-aksi/'.base64_encode('klik-notifikasi').'/'.base64_encode($notif->surat_kode))?>" style="border-bottom:0.3px solid white">
									<div class="row">
										<div class="col l11" style="font-size: 16px;">
											Surat Dari : <?=$notif->surat_dari?>
											<br>
											Subjek Surat : <?=$notif->surat_subjek?>
											<br>
											Deskripsi : <?=htmlspecialchars_decode($notif->deskripsi)?>
										</div>
										<div class="col l1">
												<i class="fa fa-circle left"></i>
										</div>
									</div>
								</a>
							</div>
						<?php
					}
					else
					{ ?>
					<div class="card-content" >
						<a href="<?=baseurl('pimpinan/lihat-surat/'.base64_encode($notif->surat_kode))?>" class="black-text" style="border-bottom:0.3px solid white">
							<div class="row">
								<div class="col l11" style="font-size: 16px;">
									Surat Dari : <?=$notif->surat_dari?>
									<br>
									Subjek Surat : <?=$notif->surat_subjek?>
									<br>
									Deskripsi : <?=substr(htmlspecialchars_decode($notif->deskripsi), 0,25)?>...			
								</div>
								<div class="col l1">
										<i class="fa fa-circle-o left"></i>
								</div>
							</div>
						</a>
					</div>
					
				<?php	}
					
				}
				echo "<hr>";
			}
				?>
		</div>
	</div>
</div>