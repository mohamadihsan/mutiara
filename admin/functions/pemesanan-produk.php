<?php 

//tambah data purchase order
if (isset($_POST['simpan_pemesanan'])) {

	//inisialisasi
	$id_barang 		= $_POST['id_barang'];
	$jumlah 		= $_POST['jumlah'];
	$nomor_faktur = 'F/'.date('dmy-His').'/MS';
	$metode_pembayaran = $_POST['metode_pembayaran'];
	$pelanggan = $_POST['pelanggan'];
	$pegawai = $_POST['pegawai'];
	$status_pesanan = 'B';
	$status_pembayaran = 'B';

	/*insert purchase order*/
	$sql = "INSERT INTO pemesanan_produk (nomor_faktur, pelanggan, pegawai, status_pesanan, status_pembayaran, metode_pembayaran) VALUES ('$nomor_faktur', '$pelanggan', '$pegawai', '$status_pesanan', '$status_pembayaran', '$metode_pembayaran')";
	if (mysqli_query($conn, $sql)){
		$id_pemesanan = mysqli_insert_id($conn);
		
		/*insert detail purchase order*/
		$i=0;
		while ($i<count($_POST['id_barang'])) {

			$sql_harga = "SELECT harga FROM barang WHERE id='$id_barang[$i]'";
			$result_harga = mysqli_query($conn, $sql_harga);
			$row_harga = mysqli_fetch_assoc($result_harga);
			$harga[$i] = $row_harga['harga'];

			$sql = "INSERT INTO detail_pemesanan (id_pemesanan, id_barang, jumlah, harga) VALUES ('$id_pemesanan', '$id_barang[$i]', '$jumlah[$i]', '$harga[$i]')";
			
			if (mysqli_query($conn, $sql)) {

				if ($i==count($_POST['id_barang'])-1) {
					$_SESSION['simpan_berhasil'] = true;
				}else{
					$_SESSION['simpan_gagal'] = true;
				}
			    
			} else {
			    $_SESSION['simpan_gagal'] = true;
			}
			$i++;
		}
	}else {
	    $_SESSION['simpan_gagal'] = true;
	}

}

//create invoice
if (isset($_POST['terima_po'])) {

	//inisialisasi
	$id_pemesanan 		= $_POST['id'];
	$tanggal 		= $_POST['tanggal_purchase_order'];
	$no_invoice = 'INV/'.date('dmy-His').'/CG';
	$id_pegawai = $_SESSION['session_id_pegawai'];


	/*cek tanggal awal pemesanan*/
	$sql = "SELECT tanggal_purchase_order FROM pemesanan_produk WHERE id='$id_pemesanan'";
	$result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_assoc($result);
	$tanggal_purchase_order = $row['tanggal_purchase_order'];

	/*penentuan tanggal pengiriman*/
	$tanggal_pengiriman = date('Y-m-d', strtotime('+2 days', strtotime($tanggal_purchase_order)));

	/*insert invoice*/
	$sql = "INSERT INTO faktur_penjualan (no_invoice, id_pemesanan, id_pegawai) VALUES ('$no_invoice', '$id_pemesanan', '$id_pegawai')";
	if (mysqli_query($conn, $sql)){
		$id_faktur_penjualan = mysqli_insert_id($conn);
		$status = 'B';

		/*cek tempat tujuan pengiriman*/
		$sql = "SELECT kota, alamat FROM pelanggan, pemesanan_produk WHERE pemesanan_produk.pelanggan=pelanggan.id AND pemesanan_produk.id='$id_pemesanan'";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);
		$kota = $row['kota'];
		$alamat = $row['alamat'];

		/*cek jumlah pemesanan*/
		$sql = "SELECT SUM(jumlah) as jumlah FROM detail_pemesanan WHERE id_pemesanan='$id_pemesanan'";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);
		$jumlah = $row['jumlah'];

		/*cek kapasitas kendaraan*/
		$sql = "SELECT id as id_kendaraan FROM kendaraan WHERE kapasitas>='$jumlah' AND tujuan_pengiriman='$kota' LIMIT 1";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);
		if(mysqli_num_rows($result)>0){
			$id_kendaraan = $row['id_kendaraan'];
		}else{
			$id_kendaraan = NULL;
		}
		/*simpan tanggal pengiriman*/
		$sql = "INSERT INTO pengiriman (tanggal, lokasi, id_kendaraan, id_faktur_penjualan, status) VALUES ('$tanggal_pengiriman', '$alamat', '$id_kendaraan', '$id_faktur_penjualan', '$status')";
		if (mysqli_query($conn, $sql)){
			$_SESSION['simpan_berhasil'] = true;
		}else {
		    $_SESSION['simpan_gagal'] = true;
		}
	}else {
	    $_SESSION['simpan_gagal'] = true;
	}

}

//ubah data
if (isset($_POST['ubah_barang_masuk']) OR isset($_POST['ubah_barang_keluar'])) {
	$id 			= $_POST['id'];
	$id_barang 		= $_POST['u_id_barang'];
	$jumlah 		= $_POST['u_jumlah'];

	$sql = "UPDATE arus_barang SET id_barang='$id_barang', jumlah='$jumlah' WHERE id='$id'";

	if (mysqli_query($conn, $sql)) {
	    $_SESSION['ubah_berhasil'] = true;
	} else {
		$_SESSION['ubah_gagal'] = true;
	}
}

//hapus data
if (isset($_POST['hapus_barang_masuk']) OR isset($_POST['hapus_barang_keluar'])) {
	$id 	= $_POST['id'];

	$sql 	= "DELETE FROM arus_barang WHERE id='$id'";

	if (mysqli_query($conn, $sql)) {
	    $_SESSION['hapus_berhasil'] = true;
	} else {
		$_SESSION['hapus_gagal'] = true;
	}
}

?>
