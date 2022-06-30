<?php
include_once "library/inc.connection.php";
include_once "library/inc.library.php";

$filterSql	= "";
// Membaca variabel form
$KeyWord	= isset($_GET['KeyWord']) ? $_GET['KeyWord'] : '';
$txtKeyword	= isset($_POST['txtKeyword']) ? $_POST['txtKeyword'] : $KeyWord;

// Jika tombol Cari diklik
if(isset($_POST['btnCari'])){
	if($_POST) {
         // Skrip pencarian
		$filterSql = "WHERE nm_homestay LIKE '%$txtKeyword%' OR nm_homestay LIKE '$txtKeyword%'";
	}
}
else {
	if($KeyWord){
         // Skrip pencarian
		$filterSql = "WHERE nm_homestay LIKE '%$txtKeyword%' OR nm_homestay LIKE '$txtKeyword%'";
	}
	else {
		$filterSql = "";
	}
} 

# Nomor Halaman (Paging)
$baris	= 10;
$hal 	= isset($_GET['hal']) ? $_GET['hal'] : 1;
$pageSql= "SELECT * FROM homestay $filterSql ORDER BY kd_homestay DESC";
$pageQry= mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jml	= mysql_num_rows($pageQry);
$maks	= ceil($jml/$baris);
$mulai	= $baris * ($hal-1);
?>
<html>
<head>
</head>
<body>
<table width="100%" border="0" cellspacing="1" cellpadding="3">
  <tr>
    <td colspan="2" align="center" bgcolor="#CCCCCC" scope="col"><strong>HASIL PENCARIAN </strong> " <?php echo $txtKeyword; ?> "</td>
  </tr>
<?php
// Menampilkan daftar homestay
$homestay2Sql = "SELECT homestay.*,  kategori.nm_kategori FROM homestay 
			LEFT JOIN kategori ON homestay.kd_kategori=kategori.kd_kategori 
			$filterSql 
			ORDER BY homestay.kd_homestay ASC LIMIT $mulai, $baris";
$homestay2Qry = mysql_query($homestay2Sql, $koneksidb) or die ("Gagal Query".mysql_error()); 
$nomor = 0;
while ($homestay2Data = mysql_fetch_array($homestay2Qry)) {
  $nomor++;
  $Kodehomestay = $homestay2Data['kd_homestay'];
  $KodeKategori = $homestay2Data['kd_kategori'];
  
  // Menampilkan gambar utama
  if ($homestay2Data['file_gambar']=="") {
		$fileGambar = "noimage.jpg";
  }
  else {
		$fileGambar	= $homestay2Data['file_gambar'];
  }
  
// Warna baris data
if($nomor%2==1) { $warna=""; } else {$warna="#F5F5F5";}
?>
  <tr>
    <td width="24%" align="center">
		<a href="?open=homestay-Lihat&Kode=<?php echo $Kodehomestay; ?>">
		<img src="img-homestay/<?php echo $fileGambar; ?>" width="100" border="0"> </a> <br>
		<div class='harga'>Rp. <?php echo format_angka($homestay2Data['harga_jual']); ?> </div> <br>
		<a href="?open=homestay-Beli&Kode=<?php echo $Kodehomestay; ?>" class="button orange small"> <strong>Booking</strong></a>	</td>
    <td width="76%" valign="top">
		<a href="?open=homestay-Lihat&Kode=<?php echo $Kodehomestay; ?>">
	  <div class='judul'> <?php echo $homestay2Data['nm_homestay']; ?> </div> </a>
		<p><?php echo substr($homestay2Data['keterangan'], 0, 200); ?> ....</p>
		<p><strong>Stok :</strong> <?php echo $homestay2Data['stok']; ?></p>
	<strong>Kategori :</strong> <a href="?open=Kategori-homestay&Kode=<?php echo $KodeKategori; ?>"> <?php echo $homestay2Data['nm_kategori']; ?> </a>	</td>
  </tr>
<?php } ?>
  <tr>
    <td colspan="2" align="center"><b>Pages:
      <?php
	for ($h = 1; $h <= $maks; $h++) {
			echo "[  <a href='?open=homestay-Pencarian&KeyWord=$txtKeyword&hal=$h'>$h</a> ]";
	}
	?>
    </b></td>
  </tr>
</table>
</body>
</html>
