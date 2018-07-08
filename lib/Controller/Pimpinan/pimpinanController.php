<?php
	require_once '../../init.php';
	$aksi = base64_decode($_GET['aksi']);
	switch ($aksi) {
		case 'tambah-surat':
			$surat_kode 			= antiInject($_POST['surat_kode']);
			$surat_tanggal 			= antiInject($_POST['surat_tanggal']);
			$tanggal_kedatangan 	= antiInject($_POST['tanggal_kedatangan']);
			$surat_subjek 			= antiInject($_POST['surat_subjek']);
			$file 					= $_FILES['file_surat'];
			$deskripsi 				= antiInject($_POST['deskripsi']);
			$filejml				= count($file['name']);
			$ekstensi 				= array('pdf','jpg','jpeg','png');
			$jenis_id 				= antiInject(base64_decode($_POST['jenis_id']));
			$user_id 				= antiInject(base64_decode($_POST['user_id']));
			$tipe_id 				= base64_decode($_POST['tipe_id']);
			if ($jenis_id=='1') 
			{
				$redirect 		= baseurl('pimpinan/surat-masuk');
				if (strtotime($tanggal_kedatangan) < strtotime($surat_tanggal)) 
				{
					$_SESSION['simpan']		='Tanggal Kedatangan Surat Salah';
					header('location:'.$redirect);
				}
				else
				{
					$cekkodesurat = mysql_num_rows(mysql_query("SELECT * FROM surat where surat_kode='$surat_kode'"));
					if ($cekkodesurat < 1) 
					{
						$surat_dari 	= antiInject($_POST['surat_dari']);
						$surat_untuk 	= "PT Pandawa Technologies";
						$directory		= 'D:/coding/xampp/htdocs/kearsipan/asset/document/surat-masuk/';
						$sql			= "INSERT INTO surat(`surat_kode`,`surat_tanggal`,`surat_dari`,`surat_untuk`,`surat_subjek`,`deskripsi`,`kedatangan_surat`,`jenis_id`,`tipe_id`,`user_id`,`created_at`) VALUES('$surat_kode','$surat_tanggal','$surat_dari','$surat_untuk','$surat_subjek','$deskripsi','$tanggal_kedatangan','1','$tipe_id','$user_id',NULL)";
						$jalan			= mysql_query($sql);
						if ($jalan == TRUE) 
						{
							mysql_query("INSERT INTO log_aktivitas(`user_id`,`id_aktivitas`,`waktu`,`deskripsi_aktivitas`) VALUES('$user_id','3',NULL,'Dari $surat_dari dengan kode surat $surat_kode ')");
							$awalfile 	= mysql_num_rows(mysql_query("SELECT * FROM surat_file"));
							$gagal 		= 0;
							for ($i=0; $i < $filejml ; $i++) 
							{ 
								$filenya 	= $file['name'][$i];
								$tmpnya		= $file['tmp_name'][$i];
								$eks 	= pathinfo($filenya,PATHINFO_EXTENSION);
								if (in_array($eks,$ekstensi)) 
								{
									move_uploaded_file($tmpnya,$directory.$filenya);
									mysql_query("INSERT INTO surat_file (`surat_kode`,`file`)VALUES('$surat_kode','$filenya')");
								}
								else
								{
									$gagal++;
								}
							}
							$akhirfile 	= mysql_num_rows(mysql_query("SELECT * FROM surat_file"));
							if ($awalfile < $akhirfile) 
							{
								if ($gagal > 0) 
								{
									$_SESSION['simpan']		='Surat Berhasil Diarsipkan '.$gagal.' File gagal di upload karena ekstensi tidak didukung';
									header('location:'.$redirect);
								}
								else
								{
									$_SESSION['simpan']		='Surat Berhasil Diarsipkan';
									header('location:'.$redirect);
								}
							}
							else
							{
								$_SESSION['simpan']		='Surat Berhasil di arsipkan tetapi File Gagal di upload';
								header('location:'.$redirect);	
							}
						}
						else
						{
							$_SESSION['simpan']		='Surat gagal di arsipkan';
							header('location:'.$redirect);
						}
					}
					else
					{
						$_SESSION['simpan']		='Surat dengan Nomor Surat tersebut sudah Diarsipkan sebelumnya, Harap cek kembali nomor surat';
						header('location:'.$redirect);
					}
				}
			}
			elseif ($jenis_id=='2') 
			{
				$redirect 		= baseurl('pimpinan/surat-keluar');
				$cekkodesurat = mysql_num_rows(mysql_query("SELECT * FROM surat where surat_kode='$surat_kode'"));
				if ($cekkodesurat < 1) 
				{
					$surat_untuk 	= antiInject($_POST['surat_untuk']);
					$surat_dari 	= "PT Pandawa Technologies";
					$directory		= 'D:/coding/xampp/htdocs/kearsipan/asset/document/surat-keluar/';
					$sql			= "INSERT INTO surat(`surat_kode`,`surat_tanggal`,`surat_dari`,`surat_untuk`,`surat_subjek`,`deskripsi`,`jenis_id`,`tipe_id`,`user_id`,`created_at`,`kedatangan_surat`) VALUES('$surat_kode','$surat_tanggal','$surat_dari','$surat_untuk','$surat_subjek','$deskripsi','2','$tipe_id','$user_id',NULL,'$surat_tanggal')";
					$jalan			= mysql_query($sql);
					if ($jalan == TRUE) 
					{
						mysql_query("INSERT INTO log_aktivitas(`user_id`,`id_aktivitas`,`waktu`,`deskripsi_aktivitas`) VALUES('$user_id','4',NULL,'untuk $surat_untuk dengan kode surat $surat_kode ')");
						$awalfile 	= mysql_num_rows(mysql_query("SELECT * FROM surat_file"));
						$gagal 		= 0;
						for ($i=0; $i < $filejml ; $i++) 
						{ 
							$filenya 	= $file['name'][$i];
							$tmpnya		= $file['tmp_name'][$i];
							$eks 	= pathinfo($filenya,PATHINFO_EXTENSION);
							if (in_array($eks,$ekstensi)) 
							{
								move_uploaded_file($tmpnya,$directory.$filenya);
								mysql_query("INSERT INTO surat_file (`surat_kode`,`file`)VALUES('$surat_kode','$filenya')");
							}
							else
							{
								$gagal++;
							}
						}
						$akhirfile 	= mysql_num_rows(mysql_query("SELECT * FROM surat_file"));
						if ($awalfile < $akhirfile) 
						{
							if ($gagal > 0) 
							{
								$_SESSION['simpan']		='Surat Berhasil Diarsipkan '.$gagal.' File gagal di upload karena ekstensi tidak didukung';
								header('location:'.$redirect);
							}
							else
							{
								$_SESSION['simpan']		='Surat Berhasil Diarsipkan';
								header('location:'.$redirect);
							}
						}
						else
						{
							$_SESSION['simpan']		='Surat Berhasil di arsipkan tetapi File Gagal di upload';
							header('location:'.$redirect);	
						}
					}
					else
					{
						$_SESSION['simpan']		='Surat gagal di arsipkan';
						header('location:'.$redirect);
					}
				}
				else
				{
					$_SESSION['simpan']		='Surat dengan Nomor Surat tersebut sudah Diarsipkan sebelumnya, Harap cek kembali nomor surat';
					header('location:'.$redirect);
				}
			}
		break;
		case 'hapus-surat':
			$id  = base64_decode($_GET['id']);
			$sql =mysql_query("SELECT * FROM disposisi WHERE surat_id='$id'");
			$idjenis =mysql_fetch_object(mysql_query("SELECT * FROM surat where id='$id'"));
			$cek = mysql_num_rows($sql);
			if ($idjenis->jenis_id=='1') {
				$redirect=baseurl('pimpinan/surat-masuk');
			}else if ($idjenis->jenis_id=='2') {
				$redirect=baseurl('pimpinan/surat-keluar');
			}
			if ($cek>0) {
				$_SESSION['simpan']		='Surat yang sudah disposisikan tidak bisa dihapus';
				header('location:'.$redirect);
			}
			else
			{
			
				$date = date('Y-m-d h:i:s');
				mysql_query("UPDATE surat SET deleted_at='$date' where id='$id'");
				$_SESSION['simpan']		='Surat berhasil dihapus';
				header('location:'.$redirect);
			}
		break;
		case 'input-head-disposisi':
			$id 		= base64_decode($_GET['id']);
			$time 		= date('d-m-Y H:i:s');
			$username	= base64_decode($_SESSION[sha1('system')]);
			$users 		= mysql_fetch_object(mysql_query("SELECT * FROM users WHERE username='$username'"));
			$id_user 	= $users->id;
			$cek 		=mysql_query("SELECT * FROM disposisi WHERE surat_id='$id'");
			if (mysql_num_rows($cek)>0) 
			{
				$disposition = mysql_fetch_object($cek);
				$_SESSION[sha1('disposisi_id')] = base64_encode($disposition->id);
				header('location:'.baseurl('pimpinan/disposisi-surat/').base64_encode($disposition->id));
			}
			else
			{
				$sql 		= "INSERT INTO disposisi(`surat_id`,`disposisi_waktu`,`disposisi_dari`,`status_id`) VALUES('$id','$time','$id_user','2')";
				$jalan 		= mysql_query($sql);
				if ($jalan > 0) 
				{
					//echo "SELECT * FROM disposition WHERE mail_id='$id'";
					$head = mysql_fetch_object(mysql_query("SELECT * FROM disposisi WHERE surat_id='$id'"));
					header('location:'.baseurl('pimpinan/disposisi-surat/').base64_encode($head->id));
				}
			}
		break;
		case 'input-detail-disposisi':
			$disposisi_id 		= base64_decode(antiInject($_POST['disposition_id']));
			$status_id 			= base64_decode(antiInject($_POST['id_status']));
			$deskripsi			= antiInject($_POST['description']);
			$disposisi_untuk 	= $_POST['disposition_for'];
			$hitung				= count($disposisi_untuk);
			$ambil 				=mysql_fetch_object(mysql_query("SELECT * FROM disposisi WHERE id='$disposisi_id'"));
			if (empty($disposisi_untuk)||empty($deskripsi)||empty($status_id)) 
			{
				$_SESSION['cek'] = "Harap Isi Lembar Disposisi Dengan Sesuai";
				header('location:'.baseurl('pimpinan/disposisi-surat/'.base64_encode($disposisi_id)));
			}
			else
			{
				$sql 	= "UPDATE disposisi SET status_id='$status_id', deskripsi='$deskripsi' WHERE id='$disposisi_id'";
				$cekawal= mysql_num_rows(mysql_query("SELECT * FROM disposisi_detail")); 	
				$update	= mysql_query($sql);
				if ($update == true) 
				{
					foreach ($disposisi_untuk as $key => $value) 
					{
						mysql_query("INSERT INTO log_aktivitas(`user_id`,`user_pengaruh`,`id_aktivitas`,`waktu`,`deskripsi_aktivitas`) VALUES('$ambil->disposisi_dari','$value','11',NULL,' Untuk ')");

						$sql = "INSERT INTO disposisi_detail(`disposisi_id`,`disposisi_untuk`) VALUES('$disposisi_id','$value');";
						//echo $sql;
						mysql_query($sql);
					}
					$akhir= mysql_num_rows(mysql_query("SELECT * FROM disposisi_detail")); 
					if ($akhir>$cekawal) 
					{
						$sql = mysql_fetch_object(mysql_query("SELECT *,surat_kode FROM disposisi INNER JOIN surat ON surat.id = disposisi.surat_id WHERE disposisi.id='$disposisi_id'"));
						$_SESSION['berhasil_disposisi'] = "Surat Berhasil Di Disposisikan";
						header('location:'.baseurl('pimpinan/lihat-surat/'.base64_encode($sql->surat_kode)));
					}
				}
				else
				{
				}
			}
		break;
		case 'batal-disposisi':
			$id 		= base64_decode($_GET['id']);
			$jalan 		= mysql_query("DELETE FROM disposisi WHERE surat_id='$id'");
			if ($jalan) 
			{
				$_SESSION['gagal'] = 'Surat batal didisposisikan';
				$surat 	= mysql_fetch_object(mysql_query("SELECT * FROM surat WHERE id='$id'"));
				header('location:'.baseurl('pimpinan/lihat-surat/'.base64_encode($surat->surat_kode)));
			}
		break;
		case 'filter-tampil':
			$filter 	= $_POST['filter'];
			if ($filter == 'View') 
			{
				$_SESSION['filter'] 		= 'view';
				$_SESSION['tanggal_awal']	= $_POST['tanggal_awal'];
				$_SESSION['tanggal_akhir']	= $_POST['tanggal_akhir'];
				header('location:'.baseurl('pimpinan/arsip-perusahaan'));
			}
			if ($filter == 'PDF') 
			{
				$_SESSION['filter'] 		= 'pdf';
				$_SESSION['tanggal_awal']	= $_POST['tanggal_awal'];
				$_SESSION['tanggal_akhir']	= $_POST['tanggal_akhir'];
				header('location:'.baseurl('print-laporan-pdf'));	
			}

			if ($filter == 'XLS') 
			{
				$_SESSION['filter'] 		= 'xls';
				$_SESSION['tanggal_awal']	= $_POST['tanggal_awal'];
				$_SESSION['tanggal_akhir']	= $_POST['tanggal_akhir'];
				header('location:'.baseurl('print-laporan-xls'));	
			}
		break;
		case 'klik-notifikasi':
			$surat_kode = base64_decode($_GET['id']);
			mysql_query("UPDATE surat SET notifikasi='1',updated_at=NULL WHERE surat_kode='$surat_kode'");
			header('location:'.baseurl('pimpinan/lihat-surat/'.base64_encode($surat_kode)));
		break;
		case 'pilih-hak-akses':
			$_SESSION['fullname']			= antiInject($_POST['fullname']); 
			$_SESSION['username'] 			= antiInject($_POST['username']); 
			$_SESSION['level'] 				= antiInject($_POST['id_level']);
			header('location:'.baseurl('pimpinan/kelola-pengguna')); 

		break;
		case 'tambah-pengguna':
			$fullname			= antiInject($_POST['fullname']); 
			$username 			= antiInject($_POST['username']); 
			$jk		 			= antiInject($_POST['jk']); 
			$password 			= base64_encode('kearsipanpandawa165'); 
			$id_level 			= base64_decode(antiInject($_POST['id_level']));
			if ($id_level =='4') {
				$jabatan 			= base64_decode(antiInject($_POST['jabatan']));
			}
			else{
				$jabatan 			= '';
			} 
			$status_account 	= $_POST['status_account']; 
			$cek_username 		= mysql_query("SELECT * FROM users WHERE username='$username'");
			$id_user			 = $_POST['id_user'];
			if (mysql_num_rows($cek_username)>0) 
			{
				$_SESSION['aksi'] = "Username Sudah Terdaftar Sebagai Akun Lain";
				header('location:'.baseurl('pimpinan/kelola-pengguna'));				
			}
			else
			{
				if ($jabatan !== '') 
				{
					$sql 				= "INSERT INTO users(`fullname`,`username`,`password`,`id_level`,`status_account`,`jk`,`id_jabatan`) VALUES('$fullname','$username','$password','$id_level','$status_account','$jk','$jabatan')";
				}
				else
				{
					$sql 				= "INSERT INTO users(`fullname`,`username`,`password`,`id_level`,`status_account`,`jk`) VALUES('$fullname','$username','$password','$id_level','$status_account','$jk')";
				}
				$jalan 				= mysql_query($sql);
				if ($jalan > 0) 
				{
					mysql_query("INSERT INTO log_aktivitas(`user_id`,`id_aktivitas`,`waktu`,`deskripsi_aktivitas`) VALUES('$id_user','9',NULL,' bernama $fullname')");
					$_SESSION['fullname']			= ''; 
					$_SESSION['username'] 			= ''; 
					$_SESSION['level'] 				= '';
					$_SESSION['aksi'] = "Pengguna Baru Berhasil Ditambahkan";
					header('location:'.baseurl('pimpinan/kelola-pengguna'));
				}
				else{
					echo $sql;
				}
			}
		break;
		case 'edit-pengguna':
			$id_user 	= base64_decode($_GET['id']);
			$user 		= mysql_fetch_object(mysql_query("SELECT * FROM users WHERE id='$id_user'"));
			$_SESSION['ubah'] 		= 'ubah';
			$_SESSION['fullname']	= $user->fullname;
			$_SESSION['username']	= $user->username;
			$_SESSION['level']		= base64_encode($user->id_level);
			$_SESSION['status_account']	= $user->status_account;
			$_SESSION['jk']	= $user->jk;
			$_SESSION['id']	= $user->id;
			

			header('location:'.baseurl('pimpinan/kelola-pengguna'.'/'.base64_encode($_SESSION['id'])));
		break;
		case 'ubah-pengguna':
			$id_pengguna		= base64_decode($_GET['id']);
			$fullname			= antiInject($_POST['fullname']); 
			$username 			= antiInject($_POST['username']); 
			$id_level 			= base64_decode(antiInject($_POST['id_level'])); 
			$status_account 	= $_POST['status_account'];
			$jk		 			= $_POST['jk'];  
			$cek_username 		= mysql_query("SELECT * FROM users WHERE id!='$id_pengguna' AND username='$username' ");
			if (mysql_num_rows($cek_username)>0) 
			{
				$_SESSION['aksi'] = "Username Sudah Terdaftar Sebagai Akun Lain";
				header('location:'.baseurl('pimpinan/kelola-pengguna/'.$_GET['id']));				
			}
			else
			{
				$sql 				= "UPDATE users SET fullname='$fullname',username='$username', id_level='$id_level', status_account='$status_account', confirm_account='0',jk='$jk' WHERE id='$id_pengguna'";
				//echo $sql;
				$jalan 				= mysql_query($sql);
				if ($jalan > 0) 
				{
					$_SESSION['ubah'] 		= '';
					$_SESSION['fullname']	= $user->fullname;
					$_SESSION['username']	= $user->username;
					$_SESSION['level']		= base64_encode($user->id_level);
					$_SESSION['status_account']	= $user->status_account;
					$_SESSION['jk']	= $user->jk;
					$_SESSION['id']	= $user->id;
					$_SESSION['aksi'] = "Data Pengguna Berhasil Diubah";
					header('location:'.baseurl('pimpinan/kelola-pengguna'));
				}
				else{
					echo $sql;
				}
			}

		break;
		case 'hapus-pengguna':
			$id_user = base64_decode($_GET['id']);
			$user 	= mysql_fetch_object(mysql_query("SELECT * from users where id='$id_user'"));
			$fullname = $user->fullname;
			$id ='1';
			mysql_query("INSERT INTO log_aktivitas(`user_id`,`id_aktivitas`,`waktu`,`deskripsi_aktivitas`) VALUES('$id','7',NULL,' dengan menghapus user bernama $fullname')");
			mysql_query("DELETE FROM users WHERE id='$id_user'");
			$_SESSION['aksi'] = 'Pengguna Berhasil Dihapus';
			header('location:'.baseurl('pimpinan/kelola-pengguna'));

		break;
		case 'tambah-jabatan':
		$id = mysql_fetch_object(mysql_query("SELECT * FROM jabatan ORDER BY id desc"));
		$idbaru = $id->id+1;
		$cek = mysql_num_rows(mysql_query("SELECT * FROM jabatan where jabatan='$_POST[jabatan]'"));
		if ($cek>0) 
		{
			$_SESSION['aksi'] = 'Jabatan sudah ada';
			header('location:'.baseurl('pimpinan/kelola-jabatan'));
		}
		else
		{
			$id_user=$_POST['id_user'];
			$jabatan = $_POST['jabatan'];
			mysql_query("INSERT INTO log_aktivitas(`user_id`,`id_aktivitas`,`waktu`,`deskripsi_aktivitas`) VALUES('$id_user','10',NULL,' Dengan nama $jabatan ')");
			mysql_query("INSERT INTO jabatan(`id`,`jabatan`) VALUES('$idbaru','$_POST[jabatan]')");
			$_SESSION['aksi'] = 'Jabatan Berhasil ditambahkan';
			header('location:'.baseurl('pimpinan/kelola-jabatan'));
		}
		break;
		case 'edit-jabatan':
			$_SESSION['id_jabatan'] = $_GET['id'];
			$id = base64_decode($_GET['id']);
			$jabatan = mysql_fetch_object(mysql_query("SELECT * FROM jabatan WHERE id='$id'"));
			$_SESSION['jabatan'] = $jabatan->jabatan;
			header('location:'.baseurl('pimpinan/kelola-jabatan/'.$_GET['id']));
		break;
		case 'ubah-jabatan':
		$id = base64_decode($_GET['id']);
		$cek = mysql_num_rows(mysql_query("SELECT * FROM jabatan where jabatan='$_POST[jabatan]'"));
		if ($cek>0) 
		{
			$_SESSION['aksi'] = 'Jabatan sudah ada';
			header('location:'.baseurl('pimpinan/kelola-jabatan/'.$_GET['id']));
		}
		else
		{
			$_SESSION['id_jabatan'] = '';
			$_SESSION['jabatan'] = '';
			$jabatan = $_POST['jabatan'];
			$cek = mysql_fetch_object(mysql_query("SELECT * FROM jabatan where id='$id'"));
			$jabatansebelum = $cek->jabatan;
			mysql_query("INSERT INTO log_aktivitas(`user_id`,`id_aktivitas`,`waktu`,`deskripsi_aktivitas`) VALUES('1','8',NULL,' Sebelumnya $jabatansebelum Menjadi $jabatan ')");
			mysql_query("UPDATE jabatan SET jabatan='$_POST[jabatan]' where id='$id'");
			$_SESSION['aksi'] = 'Berhasil Update Jabatan';
			header('location:'.baseurl('pimpinan/kelola-jabatan'));
		}
		break;

		case 'hapus-jabatan':
		
			$id_user = base64_decode($_GET['id']);
			$cek = mysql_fetch_object(mysql_query("SELECT * FROM jabatan where id='$id_user'"));
			$jabatan = $cek->jabatan;
			mysql_query("INSERT INTO log_aktivitas(`user_id`,`id_aktivitas`,`waktu`,`deskripsi_aktivitas`) VALUES('1','8',NULL,' Menghapus jabatan  $jabatan')");
			mysql_query("DELETE FROM jabatan WHERE id='$id_user'");
			$_SESSION['aksi'] = 'jabatan Berhasil Dihapus';
			header('location:'.baseurl('pimpinan/kelola-jabatan'));

		break;

	}
?>