<?php
session_start();
// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=laporan-".$_SESSION['tanggal_awal']."-".$_SESSION['tanggal_akhir'].".xls");
 
// Tambahkan table
include 'laporan-excel.php';
?>