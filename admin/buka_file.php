<?php
if(isset($_GET['open'])) {
	switch($_GET['open']){				
		case '' :				
			if(!file_exists ("main.php")) die ("Empty Main Page!"); 
			include "main.php"; break;
			
		case 'Login' :				
			if(!file_exists ("login.php")) die ("Sorry Empty Page!"); 
			include "login.php"; break;
		case 'Login-Validasi' :				
			if(!file_exists ("login_validasi.php")) die ("Sorry Empty Page!"); 
			include "login_validasi.php"; break; 
			
		case 'Logout' :				
			if(!file_exists ("login_out.php")) die ("Sorry Empty Page!"); 
			include "login_out.php"; break;		
			
		case 'Halaman-Utama' :				
			if(!file_exists ("main.php")) die ("Sorry Empty Page!"); 
			include "main.php";	 break;		
		
		# DATA PASSWORD
		case 'Password-Admin' :				
			if(!file_exists ("password_admin.php")) die ("Sorry Empty Page!"); 
			include "password_admin.php"; break;						

				# DATA KATEGORI
		case 'Kategori-Data' :
			if(!file_exists ("kategori_data.php")) die ("Sorry Empty Page!"); 
			include "kategori_data.php"; break;		
		case 'Kategori-Add' :
			if(!file_exists ("kategori_add.php")) die ("Sorry Empty Page!"); 
			include "kategori_add.php";	 break;		
		case 'Kategori-Delete' :
			if(!file_exists ("kategori_delete.php")) die ("Sorry Empty Page!"); 
			include "kategori_delete.php"; break;		
		case 'Kategori-Edit' :
			if(!file_exists ("kategori_edit.php")) die ("Sorry Empty Page!"); 
			include "kategori_edit.php"; break;
		
		# DATA homestay
		case 'homestay-Data':				
			if(!file_exists ("homestay_data.php")) die ("Sorry Empty Page!"); 
			include "homestay_data.php"; break;		
		case 'homestay-Add':
			if(!file_exists ("homestay_add.php")) die ("Sorry Empty Page!"); 
			include "homestay_add.php"; break;		
		case 'homestay-Delete':
			if(!file_exists ("homestay_delete.php")) die ("Sorry Empty Page!"); 
			include "homestay_delete.php"; break;	
		case 'homestay-Edit':
			if(!file_exists ("homestay_edit.php")) die ("Sorry Empty Page!"); 
			include "homestay_edit.php"; break;

		
		# PELANGGAN
		case 'Pelanggan-Data' :
			if(!file_exists ("pelanggan_data.php")) die ("Sorry Empty Page!"); 
			include "pelanggan_data.php"; break;
		case 'Pelanggan-Delete' :
			if(!file_exists ("pelanggan_delete.php")) die ("Sorry Empty Page!"); 
			include "pelanggan_delete.php"; break;

		# DATA
		case 'Konfirmasi-Transfer' :				
			if(!file_exists ("konfirmasi_transfer.php")) die ("Sorry Empty Page!"); 
			include "konfirmasi_transfer.php"; break;
		case 'Konfirmasi-Delete' :
			if(!file_exists ("konfirmasi_delete.php")) die ("Sorry Empty Page!"); 
			include "konfirmasi_delete.php"; break;
		
		# ADMIN PEMESANAN
		case 'Pemesanan-homestay' :				
			if(!file_exists ("pemesanan_tampil.php")) die ("Sorry Empty Page!"); 
			include "pemesanan_tampil.php"; break;
		case 'Pemesanan-Lihat' :				
			if(!file_exists ("pemesanan_lihat.php")) die ("Sorry Empty Page!"); 
			include "pemesanan_lihat.php"; break;
		case 'Pemesanan-Bayar' :				
			if(!file_exists ("pemesanan_bayar.php")) die ("Sorry Empty Page!"); 
			include "pemesanan_bayar.php"; break;
					
		# MASTER DATA
		case 'Laporan' :	
			if(!file_exists ("menu_laporan.php")) die ("Sorry Empty Page!"); 
				include "menu_laporan.php";	break;						
		
			# INFORMASI DAN LAPORAN
			case 'Laporan-asuransi' :				
				if(!file_exists ("laporan_asuransi.php")) die ("Sorry Empty Page!"); 
				include "laporan_asuransi.php"; break;	
				
			case 'Laporan-Kategori' :				
				if(!file_exists ("laporan_kategori.php")) die ("Sorry Empty Page!"); 
				include "laporan_kategori.php"; break;	
					
			case 'Laporan-homestay' :	
				if(!file_exists ("laporan_homestay.php")) die ("Sorry Empty Page!"); 
				include "laporan_homestay.php"; break;
				
			case 'Laporan-Pelanggan' :
				if(!file_exists ("laporan_pelanggan.php")) die ("Sorry Empty Page!"); 
				include "laporan_pelanggan.php"; break;
				
			case 'Laporan-Pemesanan-Periode' :
				if(!file_exists ("laporan_pemesanan_periode.php")) die ("Sorry Empty Page!"); 
				include "laporan_pemesanan_periode.php"; break;
				
			case 'Laporan-Pemesanan-Lunas-Periode' :
				if(!file_exists ("laporan_pemesanan_lunas_periode.php")) die ("Sorry Empty Page!"); 
				include "laporan_pemesanan_lunas_periode.php"; break;
			
			case 'Laporan-Pemesanan-Lunas-Tanggal' :				
				if(!file_exists ("laporan_pemesanan_lunas_tanggal.php")) die ("Sorry Empty Page!"); 
				include "laporan_pemesanan_lunas_tanggal.php"; break;			
						
		default:
			if(!file_exists ("main.php")) die ("Empty Main Page!"); 
			include "main.php";	 break;
	}
}
else {
	if(!file_exists ("main.php")) die ("Empty Main Page!"); 
			include "main.php";	 
}
?>