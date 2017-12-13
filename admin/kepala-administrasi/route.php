<?php  
	
	$menu = (isset($_GET['menu'])) ? $_GET['menu'] : '';	

	switch ($menu) {

		case 'beranda':
			include_once 'interfaces/beranda.php';
			break;
			
		case 'profil':
			include_once 'pages/profil/profil.php';
			break;	

		case 'pelanggan':
			include_once 'interfaces/pelanggan.php';
			break;

		case 'pengguna':
			include_once 'interfaces/pengguna.php';
			break;

		case 'supplier':
			include_once 'interfaces/supplier.php';
			break;	
			
		case 'kendaraan':
			include_once 'interfaces/kendaraan.php';
			break;

		default:
			include_once 'interfaces/beranda.php';
			break;
	}
?>