 <?php
	require '../../lib/init.php';
	if (empty($_SESSION[sha1('admin')]) && empty($_SESSION[sha1('system')])) 
	{
		$_SESSION['aksi'] = 'Harap Login Terlebih Dahulu';
		header('location:'.baseurl());
	}
	else
	{
		$_SESSION[sha1('header')] = '';
		$_SESSION[sha1('login')]	= '';
		if (!empty($_SESSION[sha1('system')]) && empty($_SESSION[sha1('admin')])) 
		{
			$username 			= base64_decode($_SESSION[sha1('system')]);
			$userdata 			= mysql_fetch_object(mysql_query("SELECT * FROM users WHERE username='$username'"));
		}
		else if(!empty($_SESSION[sha1('admin')]) && empty($_SESSION[sha1('system')]))
		{
			$username 			= $_SESSION[sha1('admin')];
			$userdata 			= mysql_fetch_object(mysql_query("SELECT * FROM users WHERE username='$username'"));
		} 
	}
	$hitungnotif = mysql_num_rows(mysql_query("SELECT * FROM surat WHERE notifikasi='0' AND deleted_at='0000-00-00 00:00:00'"));
	$menu 	= $_GET['menu'];
	switch ($menu) 
	{

		case 'index':
			if (!empty($_SESSION[sha1('system')]) && empty($_SESSION[sha1('admin')])) 
			{
				$inc = 'beranda-super-admin.php';
			}
			else if(!empty($_SESSION[sha1('admin')]) && empty($_SESSION[sha1('system')]))
			{
				$inc = 'beranda-admin.php';
			}
			$beranda='active';
		break;
		case 'kelola-aplikasi':
			$inc = 'aplikasi.php';
			$aplikasi = 'active';
		break;
		case 'kelola-pengguna':
			$inc = 'pengguna.php';
			$aplikasi = 'active';
		break;
		case 'kelola-jabatan':
			$aplikasi = 'active';
			$inc = 'jabatan.php';
		break;
		case 'surat-masuk':
			$inc = 'surat-masuk.php';
			$surat='active';
		break;
		case 'surat-keluar':
			$inc = 'surat-keluar.php';
			$surat='active';
		break;
		case 'lihat-surat':
			$inc = 'lihat-surat.php';
			$surat='active';
		break;

		case 'disposisi-surat':
			$inc = 'disposisi.php';
			$surat='active';
		break;
		case 'arsip-perusahaan':
			$inc = 'arsip-perusahaan.php';
			$surat='active';
		break;
		case 'notifikasi':
			$inc = 'notifikasi.php';
		break;
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Kearsipan || Wikrama</title>
	<link rel="stylesheet" type="text/css" href="<?=asset('dashboard_style/css/icon/icon.css');?>">
	<link rel="stylesheet" type="text/css" href="<?=asset('dashboard_style/css/icon/font-awesome.min.css');?>">
	<link rel="stylesheet" type="text/css" href="<?=asset('dashboard_style/css/materialize.min.css');?>">
	<link rel="stylesheet" type="text/css" href="<?=asset('dashboard_style/css/materialize.css');?>">
	<link rel="stylesheet" type="text/css" href="<?=asset('dashboard_style/plugins/dataTables.material.min.css')?>">
	<script type="text/javascript" src="<?=asset('dashboard_style/js/jquery.min.js')?>"></script>
</head>
<body class="grey lighten-2">
	<ul id="navigasi" class="side-nav">
		<li>
			<div class="user-view">
				<div class="background">
					<img src="<?=asset('images/background.jpg')?>">	
				</div>
				<a href="#!"><img src="<?php
						if($userdata->jk == 'L')
						{
							echo asset('images/user-1.png');
						}
						else
						{
							echo asset('images/user-2.png');
						}
				?>" class="circle"></a>
				<a href="#!"><span class="white-text name"><?=$userdata->fullname?></span></a>
				<a href="#!"><span class="white-text email"><i class="fa fa-circle" style="color:green"></i>&nbsp;&nbsp;&nbsp;Online</span></a>
			</div>	
		</li>
		<li class="no-padding <?php if (!empty($beranda)): ?>
			active
		<?php endif ?>">
			<a href="<?=baseurl('administrator/index')?>" class="collapsible-header"><i class="material-icons left">home</i>Beranda</a>
		</li>
      	<li class="no-padding <?php if (!empty($surat)): ?>
      		active
      	<?php endif ?>">
        	<ul class="collapsible collapsible-accordion">
	          	<li>
	            	<a href="javascript:void(0)" class="collapsible-header"><i class="material-icons">mail</i>Surat Menyurat</a>
	        		<div class="collapsible-body">
	              		<ul>
	                		<li><a href="<?=baseurl('administrator/surat-masuk')?>">Surat Masuk</a></li>
	                		<li><a href="<?=baseurl('administrator/surat-keluar')?>">Surat Keluar</a></li>
	                		<li><a href="<?=baseurl('administrator/arsip-perusahaan')?>">Arsip Perusahaan</a></li>
	              		</ul>
	            	</div>
	          </li>
        	</ul>
      	</li>
      	<li class="no-padding <?php if (!empty($aplikasi)): ?>
      		active
      	<?php endif ?>">
        	<ul class="collapsible collapsible-accordion">
	          	<li>
	            	<a href="javascript:void(0)" class="collapsible-header"><i class="fa fa-gears"></i>Kelola Aplikasi</a>
	        		<div class="collapsible-body">
	              		<ul>
	                		<li><a href="<?=baseurl('administrator/surat-masuk')?>">Kelola Pengguna</a></li>
	                		<li><a href="<?=baseurl('administrator/surat-keluar')?>">Kelola Jabatan</a></li>
	              		</ul>
	            	</div>
	          </li>
        	</ul>
      	</li>
	</ul>

	<nav style="background-color: #001F24;">
		<ul class="hide-on-med-and-down">
			<li><a href="javascript:void(0)" data-activates="navigasi" class="buka"><i class="material-icons left">menu</i></a></li>
			<li style="font-family: 'Times New Roman',sans-serif;">
				<a href="<?=baseurl('administrator/index')?>" class="brand-logo">KEARSIPAN</a>
			</li>
		</ul>
		<div class="nav-wrapper container">
			<ul class="hide-on-med-and-down right">
				<li class="dropdown-button" data-activates="notifikasi" id="notif" style="padding-right: 10px;">
					<i class="fa fa-bell left" style="font-size: 1.2rem;"></i>Notifikasi <?php if ($hitungnotif>0): ?>
						<span class="new badge" style="margin-top: 10px;"><?=$hitungnotif?></span>
					<?php endif ?>	
					<ul class="dropdown-content" id="notifikasi"  style="min-width: 450px;margin-top: 70px">
						<?php
						$sql 	= mysql_query("SELECT * FROM surat WHERE deleted_at='0000-00-00 00:00:00' order by notifikasi asc");
						$a 		=0;
						while ($notif = mysql_fetch_object($sql)) 
						{
							if ($notif->notifikasi =='0') 
							{ ?>
									<li  style="background-color:#001F24;">
										<div class="card-content" style="background-color:#001F24; ">
											<a href="<?=baseurl('administrator/administrator-aksi/'.base64_encode('klik-notifikasi').'/'.base64_encode($notif->surat_kode))?>" style="border-bottom:0.3px solid white">
												<div class="row">
													<div class="col l11" style="font-size: 12px;">
														Surat Dari : <?=$notif->surat_dari?>
														<br>
														Subjek Surat : <?=$notif->surat_subjek?>
														<br>
														Deskripsi : <?=substr(htmlspecialchars_decode($notif->deskripsi), 0,25)?>...
													</div>
													<div class="col l1">
															<i class="fa fa-circle left"></i>
													</div>
												</div>
											</a>
										</div>
									</li>
							<?php	
							}
							else
							{ ?>
						<li>
							<div class="card-content">
								<a href="<?=baseurl('lihat-surat/'.base64_encode($notif->surat_kode))?>" class="black-text" style="border-bottom:0.3px solid white">
									<div class="row">
										<div class="col l11" style="font-size: 12px;">
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
							
						</li>
						<?php	}
						$a++;
								if ($a==3) 
								{
									break;
								}
							
						}
						?>
						<div class="card-action center ">
							<a href="<?=baseurl('administrator/notifikasi')?>" class="black-text">Lihat Semua</a>	
						</div>
					</ul>
				</li>
				<li class="dropdown-button" data-activates="logoutnya" id="logout">
					<i class="material-icons left">account_circle</i>Nesta Maulana
					<ul class="dropdown-content" id="logoutnya" style="">

						<li><a href="<?=baseurl('login/aksi-validasi-user/'.base64_encode('user-keluar').'/'.base64_encode($userdata->id_level))?>" style="color: #fff;background-color: #001F24;">	
								Keluar</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</nav>	
	<section>
		<?php include $inc; ?>
	</section>
	<script type="text/javascript" src="<?=asset('dashboard_style/js/materialize.min.js')?>"></script>
	<script type="text/javascript" src="<?=asset('dashboard_style/plugins/jquery.dataTables.min.js')?>"></script>
	<script type="text/javascript" src="<?=asset('dashboard_style/plugins/dataTables.material.min.js')?>"></script>
	<script type="text/javascript" src="<?=asset('dashboard_style/plugins/jquery.validate.min.js')?>"></script>
	<script type="text/javascript" src="<?=asset('dashboard_style/plugins/jquery.validate.js')?>"></script>
	<script type="text/javascript" src="<?=asset('dashboard_style/plugins/ckeditor/ckeditor.js')?>"></script>

	<script type="text/javascript">
		$(".buka").sideNav();
		$(document).ready(function() {
			$("select").material_select();
		});
		$('.datepicker').pickadate({
			format:'dd-mm-yyyy',
			selectMonths:true,
			selectYears:5,
			max:'Today',
			clear:'Clear',
			close:'Ok',
			closeOnSelect:true
		});
		$("#logout").dropdown({
			inDuration:300,
			outDuration:300,
			hover:true,
			belowOrigin:true,
			constrain_width:true
		});
		$("#notif").dropdown({
			inDuration:300,
			outDuration:300,
			constrain_width:true
		});
		CKEDITOR.replace('apa');
		$(document).ready(function() {
		    $('#tablenya').DataTable( {
		        columnDefs: [
		            {
		                targets: [ 0, 1, 2 ],
		                className: 'mdl-data-table__cell--non-numeric'
		            }
		        ]
		    } );
		} );
	</script>
	<script type="text/javascript" src="<?=asset('dashboard_style/js/init.js')?>"></script>
</body>
</html>
