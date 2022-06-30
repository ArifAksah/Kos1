<?php
// Membaca Kode dari URL
if(isset($_GET['Kode'])){
	$Kode	= $_GET['Kode'];
	
	// Menampilkan data sesuai Kode dari URL
	$lihatSql = "SELECT homestay.*, kategori.nm_kategori FROM homestay 
				LEFT JOIN kategori ON homestay.kd_kategori=kategori.kd_kategori
				WHERE homestay.kd_homestay='$Kode'";
	
	$lihatQry = mysql_query($lihatSql, $koneksidb) or die ("Data Gagal Ditampilkan ..!");
	$no=0;
	$lihatData = mysql_fetch_array($lihatQry);
	  $no++;
	  $Kodehomestay= $lihatData['kd_homestay'];
	  $KodeKategori = $lihatData['kd_kategori'];
	  	  
	  // Membaca gambar utama
	  if ($lihatData['file_gambar']=="") {
			$fileGambar = "noimage.jpg";
	  }
	  else {
			$fileGambar	= $lihatData['file_gambar'];
	  }
} 
else {
	// Jika variabel Kode tidak ada di URL
	echo "Kode homestay tidak ada ";
	
	// Refresh
	echo "<meta http-equiv='refresh' content='2; url=index.php'>";
	exit;
}
?>
<table width="99%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td width="21%" align="Left" valign="top">
	<img src="img-homestay/<?php echo $fileGambar; ?>" width="200" border="0" /><br />
    <br>
    <center><a href="?open=homestay-Beli&Kode=<?php echo $Kodehomestay; ?>" class="button orange small"> <strong>Booking</strong></a> </td></center>
    <td width="79%" align="LEFT" valign="top">
	<table width="99%" border="0" cellspacing="2" cellpadding="3">

        
        <tr> 
          <td width="24%"><b>Nama  </b></td>
          <td width="1%">:</td>
          <td width="75%"><b><?php echo $lihatData['nm_homestay']; ?></b> </td>
        </tr>
        <tr> 
          <td><b>Harga (Rp.)</b></td>
          <td>:</td>
        <td><?php echo format_angka($lihatData['harga_jual']); ?></td>
        </tr>
        <tr> 
          <td><b>Stok Kamar</b></td>
          <td>:</td>
          <td><?php echo $lihatData['stok']; ?></td>
        </tr>
        <tr> 
          <td><b>Lokasi </b></td>
          <td>:</td>
          <td><?php echo $lihatData['nm_kategori']; ?></td>
        </tr>
        <tr> 
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td colspan="3" valign="top"><?php echo $lihatData['keterangan']; ?></td>
        </tr>
      </table></td>
  </tr>
</table>
<a href=index.php?open=homestay> Lainnya >>></a>

