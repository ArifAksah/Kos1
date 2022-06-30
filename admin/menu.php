<?php
# JIKA DIKENALI YANG LOGIN ADMIN
if(isset($_SESSION['SES_ADMIN'])){
?>
<style type="text/css">

.style1 {color: red}

</style>

	<ul>
	<li><a href='?open' title='Halaman Utama' class="style1"><font color="#080fa5"> Home </font></a></li>
	<li><a href='?open=Password-Admin' title='Password Admin'><font color="#080fa5"> Password Admin </font></a></li>
	<li><a href='?open=Kategori-Data' title='Kategori' target="_self"><font color="#080fa5">Data Kategori</font></a></li>
	<li><a href='?open=homestay-Data' title='homestay' target="_self"><font color="#080fa5">Data Kos</font></a></li>
	<li><a href='?open=Pelanggan-Data' title='Pelanggan' target="_self"><font color="#080fa5">Data Pelanggan</font></a></li>
	<li><a href='?open=Pemesanan-homestay' title='Pemesanan homestay' target="_self"><font color="#080fa5">Pemesanan  </font></a></li>
	<li><a href='?open=Konfirmasi-Transfer' title='Konfirmasi Transfer' target="_self"><font color="#080fa5">Konfirmasi Transfer</font></a></li>
	<li><a href='?open=Laporan' title='Laporan' target="_self"><font color="#080fa5">Laporan</font></a></li>
	<li><a href='?open=Logout' title='Logout (Exit)'><font color="#080fa5">Logout</font></a></li>
	</ul>
<?php
} 
else {
// JIKA BELUM ADA YANG LOGIN
?>
<!--
	<ul>
	<li><a href='?open=Login' title='Login' target="_self">Login</a></li>
	</ul>
	<!-->
<?php } ?>