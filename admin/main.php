<style type="text/css">
<!--
body,th {
	color; #;
}
body {
	background-color: #F0F0AB;
	background-image: url(../images/background1.png);
}
-->
</style><?php
if(! empty($_SESION['SES_ADMIN'])) {
	echo "<h2 style='margin:-5px 0px 5px 0px; padding:0px;'>Selamat datang </h2></p>";
	echo "<b> Anda login sebagai Administrator";
	exit;
}
else {
	echo "<centre><h2 style='margin:-5px 0px 5px 0px; padding:0px;'></h2></p>";
	echo "<b><center> Silahkan <a href='?open=Login' alt='Login'>login </a>untuk mengakses sistem ini ";	
}
?>