<table width="100%" border="0" cellspacing="1" cellpadding="3">
  <tr>
    <td scope="col"><img src="images/homestay_lainnya.gif" border="0" /></td>
    <P>Lainnya</P>
  </tr>
  <tr>
    <th scope="col">
	<?php
	// Membaca Kode homestay pada URL
	$Kode	= $_GET['Kode'];

	// menampilkan daftar homestay
	$homestay3Sql = "SELECT homestay.*,  kategori.nm_kategori FROM homestay 
				LEFT JOIN kategori ON homestay.kd_kategori=kategori.kd_kategori 
				WHERE homestay.kd_kategori='$KodeKategori' AND homestay.kd_homestay != '$Kode' 
				ORDER BY homestay.kd_homestay DESC LIMIT 5";
	$homestay3Qry = mysql_query($homestay3Sql, $koneksidb) or die ("Gagal Query".mysql_error()); 
	$nomor = 0;
	while ($homestay3Data = mysql_fetch_array($homestay3Qry)) {
	  $nomor++;
	  $Kodehomestay = $homestay3Data['kd_homestay'];
	  $KodeKategori = $homestay3Data['kd_kategori'];

	  // menampilkan gambar utama
	  if ($homestay3Data['file_gambar']=="") {
			$fileGambar = "noimage.jpg";
	  }
	  else {
			$fileGambar	= $homestay3Data['file_gambar'];
	  }
	  
	// Warna baris data
	if($nomor%2==1) { $warna=""; } else {$warna="#F5F5F5";}
	?>
        <table width="100%" border="0" cellspacing="0" cellpadding="4">
          <tr  bgcolor="<?php echo $warna; ?>">
            <td width="19%" align="center"  valign="top"><a href="?open=homestay-Lihat&amp;Kode=<?php echo $Kodehomestay; ?>"> <img src="img-homestay/<?php echo $fileGambar; ?>" width="100" border="0" /> </a> <br />
                <div class='harga'>Rp. <?php echo format_angka($homestay3Data['harga_jual']); ?> </div>
              <br />
              <a href="?open=homestay-Beli&amp;Kode=<?php echo $Kodehomestay; ?>" class="button orange small"> <strong>Booking</strong></a> </td>
            <td width="81%" valign="top"><a href="?open=homestay-Lihat&Kode=<?php echo $Kodehomestay; ?>">
              <div class='judul'> <?php echo $homestay3Data['nm_homestay']; ?> </div>
              </a>
                <p><?php echo substr($homestay3Data['keterangan'], 0, 200); ?> ....</p>
              <p><strong>Stok :</strong> <?php echo $homestay3Data['stok']; ?></p>
              <strong>Kategori :</strong> <a href="?open=Kategori-homestay&Kode=<?php echo $KodeKategori; ?>"> <?php echo $homestay3Data['nm_kategori']; ?> </a> <br />            </td>
          </tr>
        </table>
      <?php } ?></th>
  </tr>
  
</table>
