<?php
	require '../../lib/init.php';
	if (empty($_SESSION[sha1('sekretaris')])) 
	{
		$_SESSION['aksi'] = 'Harap Login Terlebih Dahulu';
		header('location:'.baseurl());
	}
	else
	{
		$username 	= base64_decode($_SESSION[sha1('sekretaris')]);
		$userdata 		= mysql_fetch_object(mysql_query("SELECT * FROM users WHERE username='$username'"));
		$_SESSION[sha1('header')] = '';
		$_SESSION[sha1('login')]	= '';
	} 
	$menu 		= $_GET['menu'];
	$id_user	= base64_encode($userdata->id);
	switch ($menu) 
	{
		case 'index':
			$inc = 'home.php';	
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
		case 'konfirmasi-akun':
			$inc = "../Login/konfirmasi-akun.php";
			$href = 'javascript:void(0)';
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
			<a href="javascript:void(0)" class="collapsible-header"><i class="material-icons left">home</i>Beranda</a>
		</li>
      	<li class="no-padding <?php if (!empty($surat)): ?>
      		active
      	<?php endif ?>">
        	<ul class="collapsible collapsible-accordion">
	          	<li>
	            	<a href="javascript:void(0)" class="collapsible-header"><i class="material-icons">mail</i>Surat Menyurat</a>
	        		<div class="collapsible-body">
	              		<ul>
	                		<li><a href="<?=baseurl('sekretaris/surat-masuk')?>">Surat Masuk</a></li>
	                		<li><a href="<?=baseurl('sekretaris/surat-keluar')?>">Surat Keluar</a></li>
	                		<li><a href="<?=baseurl('sekretaris/arsip-perusahaan')?>">Arsip Perusahaan</a></li>
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
				<a href="<?=baseurl('sekretaris/index')?>" class="brand-logo">KEARSIPAN</a>
			</li>
		</ul>
		<div class="nav-wrapper container">
			<ul class="hide-on-med-and-down right">
				<li class="dropdown-button" data-activates="logoutnya" id="logout">
					<i class="material-icons left">account_circle</i><?=$userdata->fullname?>
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
