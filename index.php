<?php
session_start();
include_once "library/inc.connection.php";
include_once "library/inc.library.php";
?>
<html>
<head>
<title>Kost  </title>
<meta name="robots" content="index, follow">

<meta name="description" content="">

<meta name="keywords" content="">

<link href="style/styles_user.css" rel="stylesheet" type="text/css">
<link href="style/button.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="js.popupWindow.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><style type="text/css">
<!--
body {
	background-color: #1686f8;
	background-image: url(images/background3.png);
}
-->
</style></head>
<body topmargin="3">
<table width="900" border="0" align="center" cellpadding="1" cellspacing="3" bordercolor="#FFFFCC" class="border">
  <tr bgcolor="#FFFFFF">
    <td height="24" align="right" bgcolor="#F5F5F5"><?php include "inc.login_status.php"; ?></td>
  </tr>
  <tr>
    <td height="43" bgcolor="#FFFFFF"><a href="?open=Home"><h1>Cari Hunian Kost Rumah  Di sekitar Seputar Daerah Makassar</h1></td>
  </tr>
</table>
<table width="900" border="0" align="center" cellpadding="1" cellspacing="3">
  <tr bgcolor="#FFFFFF" class="header"> 
    
    <td width="200" align="center" bgcolor="#F5F5F5"><a href="?open=Home" target="_self"><font color="#040404"><b>BERANDA</b></font></a></td>

    <td width="160" align="center" bgcolor="#F5F5F5"><a href="?open=homestay" target="_self"><font color="#040404"><b>KOST</b></font></a></td>

      <td width="160" align="center" bgcolor="#F5F5F5"><a href="?open=Panduan" target="_self"><font color="#040404"><b>CARA PEMESANAN</b></font></a></td>

    <td width="160" align="center" bgcolor="#F5F5F5"><a href="?open=Konfirmasi" target="_self"><font color="#040404"><b>KONFIRMASI</b></font></a></td>
     
     
  </tr>
</table>
<table width="900" border="0" align="center" cellpadding="0" cellspacing="0">
    <td height="5" colspan="3" align="center" bgcolor="#fafbfc" class=""> 
	<form action="?open=homestay-Pencarian" method="post" name="form1">
	<strong><font color="#040404"></font></strong> 
  
  <br>
	<input name="txtKeyword" type="text" size="30" maxlength="100">
	<input type="submit" name="btnCari" value=" Cari "> 
	</form>
</td>
  <tr> 
    <td width="182" bgcolor="#FFFFFF">&nbsp;</td>
    <td width="5" bgcolor="#FFFFFF">&nbsp;</td>
    <td width="611" align="right" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr> 
    <td align="center" valign="top" bgcolor="#FFFFFF"  class="utama">
	<table width="80%" border="0" cellpadding="1" cellspacing="3">
    
    </table> <?php include "login.php"; ?>
	<table width="100%" border="0" cellpadding="1" cellspacing="3">
      <tr>
        <td align="center" valign="top" bgcolor="#FFFFFF"></td>
      </tr>
      <tr align="center">
        <td width="167" height="22" bgcolor="#FFCCCC" class="head"><font color="#040404"><b> Kategori Lokasi </b></font></td>
      </tr>
      <tr>
        <td height="18" align="center" valign="top" bgcolor="#FFFFFF">
		<table width="98%" border="0" align="center" cellpadding="1" cellspacing="3">
         <?php
		  $mySql = "SELECT * FROM kategori ORDER BY nm_kategori";
		  $myQry = mysql_query($mySql, $koneksidb) or die ("Query salah : ".mysql_error());
		  while($myData = mysql_fetch_array($myQry)) {
		  	$Kode = $myData['kd_kategori'];
		  ?>
            <tr>
              <td width="8%"><img src="images/ikon.png" width="9" height="9"></td>
              <td width="92%"><b> <?php echo "<a href=?open=homestay-Kategori&Kode=$Kode>$myData[nm_kategori]</a>"; ?> </b></td>
            </tr>
            <?php
		  }
		  ?>
        </table></td>
      </tr>
      
      <tr>
        <td height="18" align="center" valign="top" bgcolor="#FFFFFF">&nbsp;</td>
      </tr>
    </table></td>
    <td>&nbsp;</td>
    <td align="center" valign="top" bgcolor="#FFFFFF" class="utama">
	<?php include "buka_file.php"; ?></td>
  </tr>
  <tr> 
    <td height="4">&nbsp;</td>
    <td height="4">&nbsp;</td>
    <td height="4">&nbsp;</td>
  </tr>
  <tr> 
    <td colspan="3" align="center" bgcolor="#F5F5F5" class="FOOT">&nbsp;</td>
  </tr>
</table>
</body>
</html>
