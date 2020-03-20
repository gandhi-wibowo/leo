<?php
if(!empty($_GET['open'])){$open=trim($_GET['open']);}else{$open="";}

	switch($open)  
	{
		case '' : include 'index.php'; break;
		case 'home' : include 'splash.php'; break;
		
		//user
		case 'user_data' : include 'data_master/user_data.php'; break;
		case 'user_add' : include 'data_master/user_add.php'; break;
		case 'user_edit' : include 'data_master/user_edit.php'; break;

		//Menu Personil
		case 'personil' : include 'menu_personil/personil.php'; break;
		case 'menu_personil_edit' : include 'menu_personil/menu_personil_edit.php'; break;
		case 'pkp_data_personil' : include 'menu_personil/pkp_data_personil.php'; break;
		case 'hasil_pkp_data_personil' : include 'menu_personil/hasil_pkp_data_personil.php'; break;
		case 'konseling_tambahan_pkp_data_personil' : include 'menu_personil/konseling_tambahan_pkp_data_personil.php'; break;
		case 'amasalah_data_personil' : include 'menu_personil/amasalah_data_personil.php'; break;
		case 'hasil_amasalah_data_personil' : include 'menu_personil/hasil_amasalah_data_personil.php'; break;
		
		
				

		//Personil
		case 'personil_data' : include 'data_personil/personil_data.php'; break;
		case 'pkp_personil_data' : include 'data_master/pkp_personil_data.php'; break;
		case 'amasalah_personil_data' : include 'data_master/amasalah_personil_data.php'; break;
		
		case 'personil_add' : include 'data_personil/personil_add.php'; break;
		case 'personil_edit' : include 'data_personil/personil_edit.php'; break;
		case 'upload_personil' : include 'data_personil/upload_personil.php'; break;
		case 'upload_personil_aksi' : include 'data_personil/upload_personil_aksi.php'; break;
		
		//Konseling Tambahan
		case 'konseling_tambahan_pkp_data' : include 'data_konseling_tambahan/konseling_tambahan_pkp_data.php'; break;
		case 'konseling_tambahan_pkp_add' : include 'data_konseling_tambahan/konseling_tambahan_pkp_add.php'; break;
		case 'konseling_tambahan_pkp_edit' : include 'data_konseling_tambahan/konseling_tambahan_pkp_edit.php'; break;
		

		//PKP
		case 'pkp_data' : include 'data_master/pkp_data.php'; break;
		case 'pkp_add' : include 'data_master/pkp_add.php'; break;
		case 'pkp_edit' : include 'data_master/pkp_edit.php'; break;
		case 'hasil_pkp_add' : include 'data_master/hasil_pkp_add.php'; break;
		case 'hasil_pkp_edit' : include 'data_master/hasil_pkp_edit.php'; break;
		case 'hasil_pkp_data' : include 'data_master/hasil_pkp_data.php'; break;


		//BINLAT
		case 'binlat_data' : include 'data_master/binlat_data.php'; break;
		case 'binlat_add' : include 'data_master/binlat_add.php'; break;
		case 'binlat_edit' : include 'data_master/binlat_edit.php'; break;
		case 'upload_binlat' : include 'data_master/upload_binlat.php'; break;
		case 'upload_binlat_aksi' : include 'data_master/upload_binlat_aksi.php'; break;

		//KONSELING ANGGOTA BERMASALAH
		case 'amasalah_data' : include 'data_master/amasalah_data.php'; break;
		case 'amasalah_add' : include 'data_master/amasalah_add.php'; break;
		case 'amasalah_edit' : include 'data_master/amasalah_edit.php'; break;
		case 'hasil_amasalah_data' : include 'data_master/hasil_amasalah_data.php'; break;
		case 'hasil_amasalah_add' : include 'data_master/hasil_amasalah_add.php'; break;
		case 'hasil_amasalah_edit' : include 'data_master/hasil_amasalah_edit.php'; break;

		//chat
		case 'chat' : include 'chat/chat.php'; break;
		case 'chat2' : include 'chat/chat2.php'; break;
		case 'pesan' : include 'chat/pesan.php'; break;
		case 'sms' : include 'chat/sms.php'; break;
		case 'hapus' : include 'chat/hapus.php'; break;

		//laporan
		case 'laporan_pkp' : include 'laporan/laporan_pkp.php'; break;
		case 'cetak_hasil_binlat' : include 'laporan/cetak_hasil_binlat.php'; break;
		case 'cetak_hasil_amasalah' : include 'laporan/cetak_hasil_amasalah.php'; break;
		
		case 'logout' : include 'logout.php'; break;
	}
?>
