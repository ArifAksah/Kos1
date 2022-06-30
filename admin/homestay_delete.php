<?php
# Validasi: halaman ini boleh diakses hanya yang sudah Login
include_once "../library/inc.sesadmin.php";

// Periksa data Kode pada URL
if(empty($_GET['Kode'])){
	echo "<b>Data yang dihapus tidak ada</b>";
}
else {
	// Membaca Kode homestay dari URL
	$Kode	= $_GET['Kode'];
	
	// Membaca file gambar dari Database
	$mySql = "SELECT * FROM homestay WHERE kd_homestay='$Kode'";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query 1 salah : ".mysql_error());
	$myData= mysql_fetch_array($myQry);
	
	// Memeriksa data Gambar dari database
	if(! $myData['file_gambar']=="") {
		if(file_exists("../img-homestay/".$myData['file_gambar'])) {
			// Jika file gambarnya ada pada folder, maka file gambar dihapus
			unlink("../img-homestay/".$myData['file_gambar']); 
		}
	}
	
	// Menghapus data dari database
	$mySql = "DELETE FROM homestay WHERE kd_homestay='$Kode'";
	$myQry = mysql_query($mySql, $koneksidb) or die ("Query 2 salah".mysql_error());
	if($myQry){
		echo "<meta http-equiv='refresh' content='0; url=?open=homestay-Data'>";
	}
}
?>