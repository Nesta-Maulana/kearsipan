<?php
	function baseurl($url ='')
	{
		$baseurl 	= 'Http://'.$_SERVER['HTTP_HOST'].'/kearsipan'.'/'.$url;
		return $baseurl;
	}
	function asset($file ='')
	{
		$asset 		= baseurl().'asset/'.$file ;
		return $asset;
	}
	function antiInject($text='')
	{
		$filter 	= strip_tags(stripslashes(htmlspecialchars($text, ENT_QUOTES)));
		return $filter; 
	}
		function long_bulan_indo($bulan)
	{
		if($bulan == '1' || $bulan == '01'){echo"Januari";}
		else if($bulan == '2' || $bulan == '02'){echo"Februari";}
		else if($bulan == '3' || $bulan == '03'){echo"Maret";}
		else if($bulan == '4' || $bulan == '04'){echo"April";}
		else if($bulan == '5' || $bulan == '05'){echo"Mei";}
		else if($bulan == '6' || $bulan == '06'){echo"Juni";}
		else if($bulan == '7' || $bulan == '07'){echo"Juli";}
		else if($bulan == '8' || $bulan == '08'){echo"Agustus";}
		else if($bulan == '9' || $bulan == '09'){echo"September";}
		else if($bulan == '10'){echo"Oktober";}
		else if($bulan == '11'){echo"November";}
		else if($bulan == '12'){echo"Desember";}
	}
	function sort_bulan_indo($bulan)
	{
		if($bulan == '1' || $bulan == '01'){echo"Jan";}
		else if($bulan == '2' || $bulan == '02'){echo"Feb";}
		else if($bulan == '3' || $bulan == '03'){echo"Mar";}
		else if($bulan == '4' || $bulan == '04'){echo"Apr";}
		else if($bulan == '5' || $bulan == '05'){echo"Mei";}
		else if($bulan == '6' || $bulan == '06'){echo"Jun";}
		else if($bulan == '7' || $bulan == '07'){echo"Jul";}
		else if($bulan == '8' || $bulan == '08'){echo"Ags";}
		else if($bulan == '9' || $bulan == '09'){echo"Sep";}
		else if($bulan == '10'){echo"Okt";}
		else if($bulan == '11'){echo"Nov";}
		else if($bulan == '12'){echo"Des";}
	}

	function long_tanggal_indo($tanggal)
	{
		$pecah=explode("-",$tanggal);
		$bulan=$pecah['1'];
		if($bulan == '1' || $bulan == '01'){echo"$pecah[0] Januari $pecah[2]";}
		else if($bulan == '2' || $bulan == '02'){echo"$pecah[0] Februari $pecah[2]";}
		else if($bulan == '3' || $bulan == '03'){echo"$pecah[0] Maret $pecah[2]";}
		else if($bulan == '4' || $bulan == '04'){echo"$pecah[0] April $pecah[2]";}
		else if($bulan == '5' || $bulan == '05'){echo"$pecah[0] Mei $pecah[2]";}
		else if($bulan == '6' || $bulan == '06'){echo"$pecah[0] Juni $pecah[2]";}
		else if($bulan == '7' || $bulan == '07'){echo"$pecah[0] Juli $pecah[2]";}
		else if($bulan == '8' || $bulan == '08'){echo"$pecah[0] Agustus $pecah[2]";}
		else if($bulan == '9' || $bulan == '09'){echo"$pecah[0] September $pecah[2]";}
		else if($bulan == '10'){echo"$pecah[0] Oktober $pecah[2]";}
		else if($bulan == '11'){echo"$pecah[0] November $pecah[2]";}
		else if($bulan == '12'){echo"$pecah[0] Desember $pecah[2]";}
		
	}

?>