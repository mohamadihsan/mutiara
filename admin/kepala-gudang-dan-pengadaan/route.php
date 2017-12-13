<?php  
	
	$menu = (isset($_GET['menu'])) ? $_GET['menu'] : '';	

	switch ($menu) {

		case 'bahan-baku':
			include_once 'interfaces/bahan-baku.php';
			break;

		case 'beranda':
			include_once 'interfaces/beranda.php';
			break;

		case 'detail-bahan-baku':
			include_once 'interfaces/detail-bahan-baku.php';
			break;

		case 'detail-produk':
			include_once 'interfaces/detail-produk.php';
			break;

		case 'detail-supplier':
			include_once 'interfaces/detail-supplier.php';
			break;			
			
		case 'profil':
			include_once 'pages/profil/profil.php';
			break;

		case 'kebutuhan':
			include_once 'interfaces/kebutuhan.php';
			break;

		case 'mk-bahan-baku':
			include_once 'interfaces/mk-bahan-baku.php';
			break;
			
		case 'mk-produk':
			include_once 'interfaces/mk-produk.php';
			break;
			
		case 'pembelian-bahan-baku':
			include_once 'interfaces/pembelian-bahan-baku.php';
			break;	

		case 'produk':
			include_once 'interfaces/produk.php';
			break;

		case 'supplier':
			include_once 'interfaces/supplier.php';
			break;						

		default:
			include_once 'interfaces/beranda.php';
			break;
	}
?>