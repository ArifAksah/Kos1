<?php
include_once "library/inc.connection.php";
include_once "library/inc.library.php";

# Nomor Halaman (Paging)
$baris = 10;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 1;
$pageSql = "SELECT * FROM homestay";
$pageQry = mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$maks	 = ceil($jml/$baris);
$mulai	= $baris * ($hal-1); 
?>
<html>
<head>
<link href="style/user.css" rel="stylesheet" type="text/css">
</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="2">
  <tr>
 <img src="images/kostkost.jpg" width="700" height="300"></a></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="1" cellpadding="3">
  <tr>
    
  </tr>


<?php
// Menampilkan daftar homestay
$homestaySql = "SELECT homestay.*,  kategori.nm_kategori FROM homestay 
			LEFT JOIN kategori ON homestay.kd_kategori=kategori.kd_kategori 
			ORDER BY homestay.kd_homestay ASC LIMIT $mulai, $baris";
$homestayQry = mysql_query($homestaySql, $koneksidb) or die ("Gagal Query".mysql_error()); 
$nomor = 0;
while ($homestayData = mysql_fetch_array($homestayQry)) {
	$nomor++;
	$Kodehomestay = $homestayData['kd_homestay'];
	$KodeKategori = $homestayData['kd_kategori'];
	
	// Membaca file gambar
	if ($homestayData['file_gambar']=="") {
		$fileGambar = "noimage.jpg";
	}
	else {
		$fileGambar	= $homestayData['file_gambar'];
	}
  
	// Warna baris data
	if($nomor%2==1) { $warna=""; } else {$warna="#F5F5F5";}
?>
  <tr>
    <td width="30%" align="center">

	  <a href="?open=homestay-Lihat&Kode=<?php echo $Kodehomestay; ?>">


<br>
<div class='judul'><?php echo $homestayData['nm_homestay']; ?> </div>
<br>
	  <center><img src="img-homestay/<?php echo $fileGambar; ?>" width="50%" border="0"> </a> <br></center>
      <div class='harga'>Rp. <?php echo format_angka($homestayData['harga_jual']); ?> </div><br>
      <?php
      if($homestayData['stok']>0){
      	echo "<a href='?open=homestay-Beli&Kode=$Kodehomestay' class='button orange small'> <strong>Booking</strong></a>";
      }else{
      	echo '<h2>Hunian Penuh</h2>';
      }

      ?> </td>
    <td width="81%" valign="top">
	  <a href="?open=homestay-Lihat&Kode=<?php echo $Kodehomestay; ?>">
      
      </a>
      <hr>
   <br>   
	  <p><?php echo substr($homestayData['keterangan'], 0, 200); ?> ....</p>
      <p><strong>Stok :</strong> <?php echo $homestayData['stok']; ?></p>
    <strong>Lokasi :</strong> <a href="?open=Kategori-homestay&Kode=<?php echo $KodeKategori; ?>"> <?php echo $homestayData['nm_kategori']; ?> </a></td>
  </tr>
<?php } ?>
  <tr>
    <td colspan="2" align="center" bgcolor="#F5F5F5">
	<b>Halaman:
    <?php
	for ($h = 1; $h <= $maks; $h++) {
			echo "[  <a href='?hal=$h'>$h</a> ]";
	}
	?>
    </b></td>
  </tr>
</table>
</body>
</html>
