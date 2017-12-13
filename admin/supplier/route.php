<?php  
	
	$menu = (isset($_GET['menu'])) ? $_GET['menu'] : '';	

	switch ($menu) {

		case 'beranda':
			include_once 'interfaces/beranda.php';
			break;

		case 'barang-yang-dijual':
			include_once 'interfaces/barang-yang-dijual.php';
			break;

		case 'daftar-pesanan':
			include_once 'interfaces/daftar-pesanan.php';
			break;						

		default:
			include_once 'interfaces/beranda.php';
			break;
	}
?>