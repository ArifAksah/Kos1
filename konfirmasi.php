<?php
include_once "library/inc.connection.php";
include_once "library/inc.library.php";

# SAAT TOMBOL KIRIM DIKLIK
if(isset($_POST['btnKirim'])){
	// Baca variabel form
	$txtNoPemesanan	= $_POST['txtNoPemesanan'];
	$txtNoPemesanan 		= str_replace("'","&acute;",$txtNoPemesanan);
	$txtNama		= $_POST['txtNama'];
	$txtNama 		= str_replace("'","&acute;",$txtNama);
	$nama_file = $_FILES['gambar']['name'];
	$ukuran_file = $_FILES['gambar']['size'];
	$tipe_file = $_FILES['gambar']['type'];
	$tmp_file = $_FILES['gambar']['tmp_name'];
	// Set path folder tempat menyimpan gambarnya
	$path = "gambar/".$nama_file;
	move_uploaded_file($tmp_file, $path);
	
	$txtJumlahTransfer		= $_POST['txtJumlahTransfer'];
	$txtJumlahTransfer 		= str_replace(".","",$txtJumlahTransfer); // Menghilangkan karakter titik (10.000 jadi 10000)
	$txtJumlahTransfer 		= str_replace(",","",$txtJumlahTransfer); // Menghilangkan karakter koma (10,000 jadi 10000)
	$txtJumlahTransfer 		= str_replace(" ","",$txtJumlahTransfer); // Menghilangkan karakter kosong (10 000 jadi 10000)
	
	$txtKeterangan	= $_POST['txtKeterangan'];
	$txtKeterangan 	= str_replace("'","&acute;",$txtKeterangan);
	
	// Validasi form
	$pesanError = array();
	if (trim($txtNoPemesanan)=="") {
		$pesanError[] = "Data <b>No. Pemesanan</b>  masih kosong, isi sesuai dengan <b>No Pemesanan</b> Anda";
	}
	if (trim($txtNama)=="") {
		$pesanError[] = "Data <b>Nama Penerima</b>  masih kosong, isi sesuai nama akun Anda";
	}
	if (trim($txtJumlahTransfer)=="" or ! is_numeric(trim($txtJumlahTransfer))) {
		$pesanError[] = "Data <b> Jumlah Ditransfer (Rp)</b> masih kosong, dan <b> harus ditulis angka </b>";
	}
	if (trim($txtKeterangan)=="") {
		$pesanError[] = "Data <b> Keterangan </b> masih kosong";
	}

	# JIKA ADA PESAN ERROR DARI VALIDASI
	if (count($pesanError)>=1 ){
		echo "<div class='pesanError' align='left'>";
		echo "<img src='images/attention.png'> <br><hr>";
			$noPesan=0;
			foreach ($pesanError as $indeks=>$pesan_tampil) { 
			$noPesan++;
				echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";	
			} 
		echo "<br>"; 
	}
	else {
		# SIMPAN DATA KE DATABASE. Jika tidak menemukan pesan error, simpan data ke database
		// Membuat tanggal
		$tanggal	= date('Y-m-d');
		
		// Simpan data ke database
		$mySql = "INSERT INTO konfirmasi (no_pemesanan, nm_pelanggan, jumlah_transfer, keterangan,gambar, tanggal) 
				  VALUES ('$txtNoPemesanan', '$txtNama', '$txtJumlahTransfer', '$txtKeterangan','$path', '$tanggal')";
		$myQry	= mysql_query($mySql, $koneksidb) or die ("Gagal query".mysql_error());
		
		echo "<b> SUKSES ...! KONFIRMASI SUDAH DIKIRIM </b>";
		echo "<meta http-equiv='refresh' content='2; url=?open=homestay'>";
		exit;
	}	
} // End if($_POST) 
	
# REKAM DATA JIKA KOSONG FORM
$dataNoPemesanan	= isset($_POST['txtNoPemesanan']) ? $_POST['txtNoPemesanan'] : '';
$dataNama			= isset($_POST['txtNama']) ? $_POST['txtNama'] : '';
$dataJumlahTransfer	= isset($_POST['txtJumlahTransfer']) ? $_POST['txtJumlahTransfer'] : '';
$dataKeterangan 	= isset($_POST['txtKeterangan']) ? $_POST['txtKeterangan'] : '';
?>
<?php
if(isset($_POST['cek'])){
	$filter=$_POST['idfilter'];
	$konfirmasi="SELECT * from pemesanan where no_pemesanan='$filter'";
    $mykonfrimas1=mysql_query($konfirmasi,$koneksidb);
    $myKonfirmasi=mysql_fetch_array($mykonfrimas1);

}

?>
<form name="filter" type="search" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" target="_self">
	<input type="text" name="idfilter">
	<input type="submit" name="cek" value="cek">
</form>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" enctype="multipart/form-data"  target="_self">
  <table width="100%" border="0" cellpadding="4" cellspacing="0">
    <tr bgcolor="#84B9D5"> 
      <td height="22" colspan="3" bgcolor="#CCCCCC" class="HEAD"><b><font color="#FF0066">KONFIRMASI PEMBAYARAN </font></b></td>
    </tr>
    <tr>
      <td width="459"><b><font color="#FF0066">No. Pemesanan 
      </font></b></td>
      <td width="5"><b>:</b></td>
      <td width="726"><input name="txtNoPemesanan" type="text" value="<?php echo $myKonfirmasi['no_pemesanan']; ?>" size="20" maxlength="20" /></td>
    </tr>
    <tr>
      <td><b><font color="#FF0066">Nama Pelanggan </font></b></td>
      <td><b>:</b></td>
      <td><input name="txtNama" type="text" value="<?php echo $myKonfirmasi['nama_pemesan']; ?>" size="60" maxlength="100" /></td>
    </tr>
    <tr>
      <td><b><font color="#FF0066">Jumlah Transfer (Rp.) </font></b></td>
      <td><b>:</b></td>
      <td><input name="txtJumlahTransfer" type="text" value="" size="20" maxlength="12" />      </td>
    </tr>
    <tr>
      <td><b><font color="#FF0066">Keterangan</font></b></td>
      <td><b>:</b></td>
      <td><textarea name="txtKeterangan" cols="45" rows="4"><?php echo $dataKeterangan; ?></textarea></td>
    </tr>
    <tr>
      <td><b><font color="#FF0066">Bukti Pembayaran</font></b></td>
      <td><b>:</b></td>
      <td><input type="file" name="gambar"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input type="submit" name="btnKirim" value=" Kirim "></td>
    </tr>
    <tr>
      <td colspan="3"><b><font color="#666666">Catatan:</font></b><br />
      	<b><font color="#666666">*)</b>
        <b><font color="#666666">*)</b> Jika bingung dengan <b>No. Transaksi</b>, silahkan Anda Login, lalu lihatlah daftar <b>transaksi terakhir</b>, di sana Ada. </font><br />
<font color="#666666"><b>**)</b> Jumlah Transfer yang harus Anda tulis adalah sesuai dengan jumlah transfer yang telah dilakukan, gunakan 3 digit terakhir No HP Anda untuk tanda (misal : <b>Rp. 300.231</b> ).</font><br />
<br />
<font color="#666666">(<strong>231</strong> didapat dari 3 digit terakhir No HP Pemesan/ Tujuan Pengiriman juga bisa) </font></td>
    </tr>
  </table>
</form>