<?php  
	error_reporting(0);
	session_start();
	require_once 'functions/koneksi.php';

	/*cek session*/
	if (empty($_SESSION['session_login_pegawai_cvmekarsari'])) {
		
		if ($_GET['menu']=='lupa-katasandi') {
			include_once 'functions/lupa-katasandi.php';
			include_once 'pages/lupa-katasandi/_header.php';
			include_once 'pages/lupa-katasandi/lupa-katasandi.php';
			include_once 'pages/lupa-katasandi/_footer.php';
		}else{
			include_once 'functions/login.php';
			include_once 'pages/login/_header.php';
			include_once 'pages/login/login.php';
			include_once 'pages/login/_footer.php';
		}
	}else{	
		
		$session_jabatan = $_SESSION['session_jabatan']; 
			
		switch ($session_jabatan) {

			case 'kepala administrasi':
				include_once 'functions/kendaraan.php';
				include_once 'functions/pelanggan.php';
				include_once 'functions/pengguna.php';
				include_once 'functions/supplier.php';
				include_once 'kepala-administrasi/interfaces/_header.php';
				include_once 'kepala-administrasi/route.php';
				include_once 'kepala-administrasi/interfaces/_footer.php';
				break;

			case 'kepala gudang dan pengadaan':
				include_once 'functions/bahan-baku.php';
				include_once 'functions/detail-supplier.php';
				include_once 'functions/mk-bahan-baku.php';
				include_once 'functions/mk-produk.php';
				include_once 'functions/produk.php';
				include_once 'functions/supplier.php';
				include_once 'kepala-gudang-dan-pengadaan/interfaces/_header.php';
				include_once 'kepala-gudang-dan-pengadaan/route.php';
				include_once 'kepala-gudang-dan-pengadaan/interfaces/_footer.php';
				break;	

			case 'kepala pemasaran':
				include_once 'functions/pelanggan.php';
				include_once 'functions/pemesanan-produk.php';
				include_once 'kepala-pemasaran/interfaces/_header.php';
				include_once 'kepala-pemasaran/route.php';
				include_once 'kepala-pemasaran/interfaces/_footer.php';
				break;

			case 'kepala produksi':
				include_once 'functions/produk.php';
				include_once 'kepala-produksi/interfaces/_header.php';
				include_once 'kepala-produksi/route.php';
				include_once 'kepala-produksi/interfaces/_footer.php';
				break;

			case 'manager':
				include_once 'manager/interfaces/_header.php';
				include_once 'manager/route.php';
				include_once 'manager/interfaces/_footer.php';
				break;

			case 'staff gudang':
				include_once 'functions/bahan-baku.php';
				include_once 'functions/detail-supplier.php';
				include_once 'functions/mk-bahan-baku.php';
				include_once 'functions/mk-produk.php';
				include_once 'functions/produk.php';
				include_once 'functions/supplier.php';
				include_once 'staff-gudang/interfaces/_header.php';
				include_once 'staff-gudang/route.php';
				include_once 'staff-gudang/interfaces/_footer.php';
				break;

			case 'staff keuangan':
				include_once 'staff-keuangan/interfaces/_header.php';
				include_once 'staff-keuangan/route.php';
				include_once 'staff-keuangan/interfaces/_footer.php';
				break;

			case 'supplier':
				include_once 'supplier/interfaces/_header.php';
				include_once 'supplier/route.php';
				include_once 'supplier/interfaces/_footer.php';
				break;

			default:
				include_once 'pages/error/_header.php';
				include_once 'pages/error/error.php';
				include_once 'pages/error/_footer.php';
				break;
		}
	}
	
?>