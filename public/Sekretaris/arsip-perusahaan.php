<?php
	if (!empty($_SESSION['filter'])) 
	{
		$filternya = $_SESSION['filter'];
		if ($filternya=='pdf'||$filternya=='xls') {
			$filter='';
			$_SESSION['tanggal_akhir'] ='';
			$_SESSION['tanggal_awal']='';
		}
	}
	else
	{
		$filternya='view';
		$_SESSION['tanggal_awal']=date('d-m-Y');
		$_SESSION['tanggal_akhir']=date('d-m-Y');
	}
?>
<div class="row">
	<div class="col l12">
		<div class="card">
			<div class="card-content">
				<div class="card-title">
					Arsip Perusahaan
					<hr>
				</div>
				<div class="row">
					<div class="col l12">
						<div class="card">
							<div class="card-content">
								<div class="card-title">Filter Tanggal
									<div class="right">
										<input type="submit" name="kembali"	value="Kembali" onclick="document.location.href='<?=baseurl('sekretaris/index')?>'" class="btn deep-purple darken-4">
									</div>
								</div>
								<div class="row">		
									<div class="col l12">
										<form method="post" action="<?=baseurl('sekretaris/sekretaris-aksi/'.base64_encode('filter-tampil'))?>">
											<table>
												<tr>
													<td>
														<input type="text" class="datepicker" name="tanggal_awal" id="tanggal_awal" placeholder="Dari Tanggal" <?php if (!empty($_SESSION['tanggal_awal'])): ?>
															value="<?=$_SESSION['tanggal_awal']?>"
														<?php endif ?>>
													</td>
													<td style="text-align: center;font-size: 20px">Sampai</td>
													<td>
														<input type="text" class="datepicker" name="tanggal_akhir" id="tanggal_akhir" placeholder="Tanggal" <?php if (!empty($_SESSION['tanggal_akhir'])): ?>
															value="<?=$_SESSION['tanggal_akhir']?>"
														<?php endif ?>>	
													</td>
													<td style="width: 10%">
														<select name="filter">
															<option disabled selected>Format</option>
															<option <?php if ($filternya=='view'): ?>
																selected
															<?php endif ?>>View</option>
															<option <?php if ($filternya == 'XLS'): ?>
																selected
															<?php endif ?>>XLS</option>
															<option <?php if ($filternya=='PDF'): ?>
																selected
															<?php endif ?>>PDF</option>
														</select>
													</td>
													<td style="width: 10%">
														<input type="submit" name="report" value="Lihat" class="btn deep-purple darken-4 waves-effect">
													</td>
												</tr>
											</table>
										</form>
									</div>
								</div>			
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col l12">
						<?php if ($filternya=='view'): ?>
						<table>
							<thead>
								<tr>
									<th>Nomor Surat</th>
									<th>Surat Dari</th>
									<th>Surat Untuk</th>
									<th>Tanggal Surat</th>
									<th>Perihal</th>
									<th>Deskripsi</th>
									<th>Aksi</th>
								</tr>
							</thead>
						<?php

						$halaman = 10; //batasan halaman
						$page = isset($_GET['halaman'])? (int)$_GET["halaman"]:1;
						$mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
						$query = mysql_query("select * from surat LIMIT $mulai, $halaman");
						$sql = mysql_query("select * from surat");
						$total = mysql_num_rows($sql);
						$pages = ceil($total/$halaman);
						
						while ($data = mysql_fetch_object($query)) 
						{ ?>
						 	<tr>
						 		<td><?=$data->surat_kode?></td>
						 		<td><?=$data->surat_dari?></td>
						 		<td><?=$data->surat_untuk?></td>
						 		<td><?=$data->surat_tanggal?></td>
						 		<td><?=$data->surat_subjek?></td>
						 		<td><?=substr(htmlspecialchars_decode($data->deskripsi), 0,40)?>..</td>
						 		<td><a href="<?=baseurl('sekretaris/lihat-surat/'.base64_encode($data->surat_kode))?>">Lihat</a></td>
						 	</tr>

						<?php } ?>

						</table>
							<?php 	
						for ($i=1; $i<=$pages ; $i++){ ?>
						 <a href="?halaman=<?php echo $i; ?>" class="btn deep-purple"><?php echo $i; ?></a>

						 <?php } ?>

						<?php endif ?>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>