<?php
include_once "inc.session.php";
include_once "library/inc.connection.php";
include_once "library/inc.library.php";

// Baca Kode Pelanggan yang Login
$Kodepelanggan	= $_SESSION['SES_PELANGGAN'];

# TOMBOL SIMPAN DIKLIK
if(isset($_POST['btnSimpan'])){
	$arrData = count($_POST['txtJum']); 
	$jumlah = 1;
	for ($i=0; $i < $arrData; $i++) {
		# Melewati biar tidak 0 atau minus
		if ($_POST['txtJum'][$i] < 1) {
			$jumlah = 1;
		}
		else {
			$jumlah = $_POST['txtJum'][$i];
		}
					
		# Simpan Perubahan
		$KodeBrg	= $_POST['txtKodeH'][$i];
		$tanggal	= date('Y-m-d');
		$jam		= date('G:i:s');
		
		$sql = "UPDATE tmp_keranjang SET jumlah='$jumlah', tanggal='$tanggal' 
				WHERE kd_homestay='$KodeBrg' AND kd_pelanggan='$Kodepelanggan'";
		$query = mysql_query($sql, $koneksidb);
	}
	// Refresh
	echo "<meta http-equiv='refresh' content='0; url=?open=Keranjang-Belanja'>";
	exit;	
}

# MENGHAPUS DATA homestay YANG ADA DI KERANJANG
// Membaca Kode dari URL
if(isset($_GET['aksi']) and trim($_GET['aksi'])=="Hapus"){ 
	// Membaca Id data yang dihapus
	$idHapus	= $_GET['idHapus'];
	
	// Menghapus data keranjang sesuai Kode yang dibaca di URL
	$mySql = "DELETE FROM tmp_keranjang  WHERE id='$idHapus' AND kd_pelanggan='$Kodepelanggan'";
	$myQry = mysql_query($mySql, $koneksidb) or die ("Eror hapus data".mysql_error());
	if($myQry){
		echo "<meta http-equiv='refresh' content='0; url=?open=Keranjang-Belanja'>";
	}
}

# MEMERIKSA DATA DALAM KERANJANG
$cekSql = "SELECT * FROM tmp_keranjang WHERE  kd_pelanggan='$Kodepelanggan'";
$cekQry = mysql_query($cekSql, $koneksidb) or die (mysql_error());
$cekQty = mysql_num_rows($cekQry);
if($cekQty < 1){
	echo "<br><br>";
	echo "<center>";
	echo "<b> KERANJANG BELANJA KOSONG </b>";
	echo "<center>";
	
	// Jika Keranjang masih Kosong, maka halaman Refresh ke data homestay
	echo "<meta http-equiv='refresh' content='2; url=?page=homestay'>";
	exit;
}
?>
<html>
<head>
<title>Rincian Booking</title>
<body>
<table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td align="center"><b> Rincian Pemesanan  </b> </td>
  </tr>
</table>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
  <table width="99%" border="0" align="center" cellpadding="2" cellspacing="0" class="border">
    <tr> 
      <td width="86" height="22" align="center" bgcolor="#CCCCCC"><strong>Gambar</strong></td>
      <td width="686" bgcolor="#CCCCCC"><b>Nama Kost Rumah</b></td>
      <td width="164" align="right" bgcolor="#CCCCCC"><b><b>Harga (Rp)</b></b></td>
      <td width="76" align="center" bgcolor="#CCCCCC"><b>Jumlah<b></b></b></td>
      <td width="150" align="right" bgcolor="#CCCCCC"><b>Total (Rp)</b></td>
      <td width="16" align="center" bgcolor="#CCCCCC"><img src="images/aksi.gif" width="14" height="14"></td>
    </tr>
	<?php
	// Menampilkan data homestay dari tmp_keranjang (Keranjang Belanja)
	$mySql = "SELECT homestay.nm_homestay, homestay.file_gambar, kategori.nm_kategori, tmp_keranjang.*
			FROM tmp_keranjang
			LEFT JOIN homestay ON tmp_keranjang.kd_homestay=homestay.kd_homestay
			LEFT JOIN kategori ON homestay.kd_kategori=kategori.kd_kategori 
			WHERE tmp_keranjang.kd_pelanggan='$Kodepelanggan' 
			ORDER BY tmp_keranjang.id";
	$myQry = mysql_query($mySql, $koneksidb) or die ("Gagal SQL".mysql_error());
	$total = 0; $grandTotal = 0;
	$no	= 0;
	while ($myData = mysql_fetch_array($myQry)) {
	  $no++;
	  // Menghitung sub total harga
	  $total 		= $myData['harga'] * $myData['jumlah'];
	  $grandTotal	= $grandTotal + $total;
	  
	  // Menampilkan gambar
	  if ($myData['file_gambar']=="") {
			$fileGambar = "img-homestay/noimage.jpg";
	  }
	  else {
			$fileGambar	= $myData['file_gambar'];
	  }
	  
	  #Kode homestay
	  $Kode = $myData['kd_homestay'];
	?>
    <tr> 
      <td rowspan="3" align="center" valign="top"> 
        <img src="img-homestay/<?php echo $fileGambar; ?>" width="70" border="1" ></td>
      <td><a href="?open=homestay-Lihat&Kode=<?php echo $Kode; ?>" target="_blank"><strong><?php echo $myData['nm_homestay']; ?></strong></a></td>
      <td align="right">Rp.<?php echo format_angka($myData['harga']); ?></td>
      <td align="center"><input name="txtJum[]" type="text" value="<?php echo $myData['jumlah']; ?>" size="2" maxlength="2">
        <input name="txtKodeH[]" type="hidden" value="<?php echo $myData['kd_homestay']; ?>"></td>
      <td align="right"><span>Rp. <?php echo format_angka($total); ?></span></td>
      <td><a href="?open=Keranjang-Belanja&aksi=Hapus&idHapus=<?php echo $myData['id'];?>"><img src="images/hapus.gif" alt="Hapus data ini dari keranjang" width="16" height="16" border="0"></a></td>
    </tr>
    <tr>
      <td>Kategori :  <?php echo $myData['nm_kategori']; ?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
	<?php } ?>
    <tr>
      <td align="center" valign="top">&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="2" align="right"><strong>GRAND TOTAL   : </strong></td>
      <td align="right" bgcolor="#CCCCCC"> <strong><?php echo "Rp. ".format_angka($grandTotal); ?></strong> </td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input name="btnSimpan" type="submit" value=" Ubah Data"></td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td colspan="6" align="center">
	  <a href="?open=Transaksi-Proses"><img src="images/btn_lanjutkan.jpg" alt="Lanjutkan Transaksi (Checkout)" border="0"></a></td>
    </tr>
  </table>
</form>
  <table width="99%" border="0" align="center" cellpadding="0" cellspacing="0" class="border">
    <tr> 
    <td height="22" colspan="2" bgcolor="#CCCCCC">&nbsp;&nbsp;<b>Keterangan Tombol</b></td>
    </tr>
      <td width="21%" align="center"><input type="button" name="Button" value=" Simpan "></td>
      <td width="79%">Klik tombol ini untuk menyimpan perubahan jumlah Rumah Kost yang akan Di pesan.</td>
    </tr>
    <tr> 
      <td align="center">
	  
	  <a href=index.php?open=homestay><input name="btnKembali" type="submit" value="Kembali"></a>
      <td>Tombol <strong>Checkout</strong>, klik tombol ini jika Anda sudah selesai memilih Rumah Kost dan ingin melanjutkan 
        transaksi selanjutnya.</td>
    </tr>
  </table>
