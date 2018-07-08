<?php
	require '../../lib/init.php';
	$id_level = base64_decode($_POST['id_level']);
	if ($id_level == '4') 
	{
		$_SESSION['level'] == $_POST['id_level'];
	}
?>