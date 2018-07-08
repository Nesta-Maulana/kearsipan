<?php
	require '../../init.php';
	$aksi 	= base64_decode($_GET['aksi']);
	switch ($aksi) {
		case 'user-masuk':
			$username	= antiInject($_POST['username']);
			$password	= antiInject(base64_encode($_POST['password']));
			$cekusername= mysql_query("SELECT * FROM users WHERE username='$username'");
			$sqljml 	= mysql_num_rows($cekusername);
			if ($sqljml == 1) 
			{
				$usernya 			= mysql_fetch_object($cekusername);
				$passworddatabase 	= $usernya->password;
				if ($password === $passworddatabase) 
				{
					$user 			= mysql_fetch_object(mysql_query("SELECT * FROM users WHERE username='$username' AND password='$password'"));
					mysql_query("INSERT INTO log_aktivitas(`user_id`,`id_aktivitas`,`waktu`) VALUES('$user->id','1',NULL)");
					if ($user->fullname === 'System') 
					{
						$_SESSION[sha1('system')] 	= base64_encode($user->username);
						$_SESSION[sha1('login')]	= "Selamat Datang , ".$user->fullname;
						$_SESSION[sha1('header')]	= "administrator/index";
						header('location:'.baseurl());
					}
					else
					{
						if ($user->status_account !== '0') 
						{
							if ($user->confirm_account !== '0') 
							{
								if ($user->id_level == '1') 
								{
									$_SESSION[sha1('admin')] 	= base64_encode($user->username);
									$_SESSION[sha1('login')]	= "Selamat Datang , ".$user->fullname;
									$_SESSION[sha1('header')]	= "administrator/index";
									header('location:'.baseurl());
								}else if ($user->id_level == '2') 
								{
									$_SESSION[sha1('sekretaris')] 	= base64_encode($user->username);
									$_SESSION[sha1('login')]		= "Selamat Datang , ".$user->fullname;
									$_SESSION[sha1('header')]		= "sekretaris/index";
									header('location:'.baseurl());
								}else if ($user->id_level == '3') 
								{
									$_SESSION[sha1('pimpinan')] 	= base64_encode($user->username);
									$_SESSION[sha1('login')]		= "Selamat Datang , ".$user->fullname;
									$_SESSION[sha1('header')]		= "pimpinan/index";
									header('location:'.baseurl());
								}else if ($user->id_level == '2') 
								{
									$_SESSION[sha1('staff')] 	= base64_encode($user->username);
									$_SESSION[sha1('login')]		= "Selamat Datang , ".$user->fullname;
									$_SESSION[sha1('header')]		= "staff/index";
									header('location:'.baseurl());
								}
							}
							else
							{
								if ($user->id_level == '1') 
								{
									$_SESSION[sha1('admin')] 	= base64_encode($user->username);
									$_SESSION[sha1('header')]		= "administrator/konfirmasi-akun";
								}else if ($user->id_level == '2') 
								{
									$_SESSION[sha1('sekretaris')] 	= base64_encode($user->username);
									$_SESSION[sha1('header')]		= "sekretaris/konfirmasi-akun";

								}else if ($user->id_level == '3') 
								{
									$_SESSION[sha1('pimpinan')] 	= base64_encode($user->username);
									$_SESSION[sha1('header')]		= "pimpinan/konfirmasi-akun";
									
								}else if ($user->id_level == '4') 
								{
									$_SESSION[sha1('staff')] 	= base64_encode($user->username);
									$_SESSION[sha1('header')]		= "staff/konfirmasi-akun";
								}
								$_SESSION[sha1('login')]		= "Selamat Datang , Silahkan Konfirmasi Akun Anda Terlebih Dahulu".$user->fullname;
								header('location:'.baseurl());
							}
						}
						else
						{
							$_SESSION['aksi']		= "Akun Anda Tidak Aktif Silahkan Hubungi Administrator";
							header('location:'.baseurl());
						}
					}
				}
				else
				{
					if ($usernya->username !=='system') 
					{
						$salah 		= $usernya->error_password+1;
						mysql_query("UPDATE users SET error_password='$salah' WHERE username='$usernya->username'");
						$cekjmlerror = mysql_fetch_object(mysql_query("SELECT * FROM users WHERE username='$usernya->username'"));
						if ($cekjmlerror->error_password >= 3) 
						{
							mysql_query("UPDATE users SET status_account='0' WHERE username='$cekjmlerror->username'");
							$_SESSION['aksi'] = "Akun Anda Telah Terkunci Harap Hubungi Administrator";
							header('location:'.baseurl());
						} 
						else
						{
							$_SESSION['aksi'] = "Password tidak sesuai dengan username , Jumlah Salah Password Anda Adalah ".$cekjmlerror->error_password;
							header('location:'.baseurl());
						}
					}
					else
					{
						$salah 		= $usernya->error_password+1;
						mysql_query("UPDATE users SET error_password='$salah' WHERE username='$usernya->username'");
						$cekjmlerror = mysql_fetch_object(mysql_query("SELECT * FROM users WHERE username='$usernya->username'"));
						if ($cekjmlerror->error_password >= 3) 
						{
							mysql_query("UPDATE users SET error_password='0' WHERE username='$cekjmlerror->username'");
							$_SESSION['aksi'] = "Harap Gunakan Akun Personal Anda , Jangan Coba-Coba Menggunakan Akun Administrator";
							header('location:'.baseurl());
						} 
						else
						{
							$_SESSION['aksi'] = "Password tidak sesuai dengan username , Jumlah Salah Password Anda Adalah ".$cekjmlerror->error_password;
							header('location:'.baseurl());
						}
					}
				}
			}
			else
			{
				$_SESSION['aksi'] = "Username Tidak Terdaftar";
				header('location:'.baseurl());
			}

		break;
		case 'user-keluar':
			$level = base64_decode($_GET['id']);
			if ($level ==='1') 
			{
				$_SESSION[sha1('administrator')] = '';
				$_SESSION[sha1('system')] = '';
			}else if($level =='2') 
			{
				$_SESSION[sha1('sekretaris')]='';
			}elseif($level =='3') 
			{
				$_SESSION[sha1('pimpinan')] = '';
			}elseif($level =='4') 
			{
				$_SESSION[sha1('staff')] = '';
			}
			$_SESSION['logout'] = "Berhasil Keluar , Sampai Jumpa kembali";
			header('location:'.baseurl());
		break;
		case 'konfirmasi-akun':
			$pass_lama = base64_encode(antiInject($_POST['pass_lama']));
			$id_user   = $_POST['id_user'];	
			$id_level  = $_POST['id_level'];
			if ($id_level==='1') 
			{
				$level ='admin';
			}else if($id_level==='2') {
				$level ='sekretaris';
			}else if($id_level==='3') 
			{
				$level ='pimpinan';
			}else if($id_level==='4') 
			{
				$level ='staff';
			}	
			if (mysql_num_rows(mysql_query("SELECT * FROM users WHERE id='$id_user' AND password='$pass_lama'"))>0) 
			{
				$baru 	= base64_encode(antiInject($_POST['pass_baru']));
				$baru2 	= base64_encode(antiInject($_POST['password_baru']));
				if ($baru == $baru2) 
				{
					mysql_query("UPDATE users SET password='$baru',confirm_account='1' WHERE id='$id_user'");
					$_SESSION['act'] = "Kata Sandi Berhasil Di Ubah";
					//echo $level;
					header('location:'.baseurl($level.'/index'));
				}
				else
				{
					$_SESSION['aksi'] = "Kata Sandi Baru dan Konfirmasi Kata Sandi Baru tidak Sesuai";
					header('location:'.baseurl($level.'/konfirmasi-akun'));
				}
			}	
			else
			{
				$_SESSION['aksi'] = "Kata Sandi Lama Tidak Sesuai";
				header('location:'.baseurl($level.'/konfirmasi-akun'));
			}
		break;
	}
?>