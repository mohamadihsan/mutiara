<?php  
	
	$menu = (isset($_GET['menu'])) ? $_GET['menu'] : '';	

	switch ($menu) {

		case 'beranda':
			include_once 'interfaces/beranda.php';
			break;

		case 'pemesanan-produk':
			include_once 'interfaces/pemesanan-produk.php';
			break;

		case 'pembelian-bahan-baku':
			include_once 'interfaces/pembelian-bahan-baku.php';
			break;						

		default:
			include_once 'interfaces/beranda.php';
			break;
	}
?>