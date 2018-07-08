<?php
	require '../../lib/init.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login || Kearsipan</title>
	<link rel="stylesheet" type="text/css" href="<?=asset('login_style/css/style.css')?>">
	<link rel="icon" type="icon/png" href="<?=asset('favicon.png')?>">
</head>
<body style="background-image:url('<?=asset('images/background.jpg')?>'); ">
	<form method="post" action="<?=baseurl('login/aksi-validasi-user/'.base64_encode('user-masuk'))?>">
		<div class="nama-perusahaan" >
			<h1>PT. Pandawa 165 Technologies</h1>
			<h4>For The Future Of Islamic Technologies</h4>
		</div>
		<div class="form-login" >
			<h1 class="	" style="color: white;">Kearsipan</h1>
			<div class="input-field blue">
				<input type="text" name="username" class="input" autocomplete="off" id="username" maxlength ="30" autofocus required>
				<label for="username">Nama User</label>
			</div>
			<div class="input-field " >
				<input type="password" name="password" class="input" autocomplete="off" maxlength="30" id="password" required >
				<label for="password">Kata Sandi</label>
			</div>
			<div class="input-field blue">
				<input type="submit" name="login" value="Masuk" class="btn blue" style="box-shadow: none;">
			</div>

			<div class="input-field" style="margin-top: -10px;margin-bottom: -40px;color: white;font-weight: 100;font-family: 'Times New Roman',sans-serif;">
				<h6 >Copyright &copy; 2018 || Created By : Nesta Maulana</h6>
			</div>
		</div>
	</form>
	<?php if (empty($_SESSION['aksi'])){
		$_SESSION['aksi'] = 'Selamat Datang Di Sistem Kearsipan PT Pandawa 165 Technologies';
	} ?>
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

	
	<?php if (!empty($_SESSION[sha1('login')])): ?>
		<div class="dialog" id="login"><?=$_SESSION[sha1('login')];?></div>
		<script type="text/javascript">
			setTimeout(function() {
				document.getElementById('login').classList.add('remove');
			},3000);document.location.href='<?=$_SESSION[sha1("header")];?>'
		</script>
	<?php endif ?>
	<?php if (!empty($_SESSION[sha1('logout')])): ?>
		<div class="dialog" id="logout"><?=$_SESSION['logout'];?></div>
		<script type="text/javascript">
			setTimeout(function() {
				document.getElementById('logout').classList.add('remove');
			},4000);
		</script>
	<?php $_SESSION['logout']=''; endif ?>
</body>
</html>