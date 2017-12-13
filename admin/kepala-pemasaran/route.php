<?php  
	
	$menu = (isset($_GET['menu'])) ? $_GET['menu'] : '';	

	switch ($menu) {

		case 'beranda':
			include_once 'interfaces/beranda.php';
			break;

		case 'detail-produk':
			include_once 'interfaces/detail-produk.php';
			break;

		case 'laporan-penjualan':
			include_once 'interfaces/laporan-penjualan.php';
			break;

		case 'laporan-pelanggan':
			include_once 'interfaces/laporan-pelanggan.php';
			break;		

		case 'profil':
			include_once 'pages/profil/profil.php';
			break;
			
		case 'pemesanan-produk':
			include_once 'interfaces/pemesanan-produk.php';
			break;	

		case 'produk':
			include_once 'interfaces/produk.php';
			break;

		case 'pelanggan':
			include_once 'interfaces/pelanggan.php';
			break;						

		default:
			include_once 'interfaces/beranda.php';
			break;
	}
?>