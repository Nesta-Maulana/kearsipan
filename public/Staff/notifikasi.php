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
				$baca 	= mysql_query("SELECT *,disposisi_detail.id as disposisi_detailnya,disposisi.deskripsi as deskripsi_lanjutan,surat.deskripsi as deskripsi_surat,surat.kedatangan_surat,surat.surat_kode,surat.surat_dari,surat.surat_subjek,users.fullname FROM disposisi_detail INNER JOIN disposisi ON disposisi.id=disposisi_detail.disposisi_id INNER JOIN surat ON surat.id=disposisi.surat_id INNER JOIN users ON users.id=disposisi.disposisi_dari WHERE disposisi_untuk='$userdata->id' order by notifikasi asc");
				while ($notif = mysql_fetch_object($baca)) 
				{
					if ($notif->notifikasi =='0') 
					{ 
				?>			

					<div class="card-title" style="margin-left: 20px;padding-top: 20px">
						<?=$notif->kedatangan_surat;?>
					</div>
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
						<div class="card-title" style="margin-left: 20px;padding-top: 20px">
						<?=$notif->kedatangan_surat;?>
					</div>
					<div class="card-content" >
						<a href="<?=baseurl('staff/lihat-surat/'.base64_encode($notif->surat_kode))?>" class="black-text" style="border-bottom:0.3px solid white">
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
					
				}?>
		</div>
	</div>
</div>