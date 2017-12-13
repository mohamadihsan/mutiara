<?php 

//tambah data
if (isset($_POST['simpan_mk_produk'])) {

	//inisialisasi
	$id_produk 			= $_POST['id_produk'];
	$status 			= addslashes(trim($_POST['status']));
	$stok 				= $_POST['jumlah'];
	/*$tanggal_kadaluarsa	= $_POST['tanggal_kadaluarsa'];*/

	$i=0;
	while ($i<count($_POST['jumlah'])) {

		$sql = "INSERT INTO arus_produk (id_produk, status, jumlah) VALUES ('$id_produk', '$status', '$stok[$i]')";
		
		if (mysqli_multi_query($conn, $sql)) {

			if ($status=="keluar") {
				$sql_detail = "INSERT INTO detail_produk (id_produk, stok) VALUES ('$id_produk', '$stok[$i]'* -1)";
			}else{
				$sql_detail = "INSERT INTO detail_produk (id_produk, stok) VALUES ('$id_produk', '$stok[$i]')";
			}

			if (mysqli_query($conn, $sql_detail)) {
				$_SESSION['simpan_berhasil'] = true;
			}else{
				$_SESSION['simpan_gagal'] = true;
			}
		    
		} else {
		    $_SESSION['simpan_gagal'] = true;
		}
		$i++;
	}
}

//ubah data
if (isset($_POST['ubah_mk_produk'])) {
	$id 					= $_POST['id'];
	$id_produk 				= $_POST['u_id_produk'];
	$status 				= addslashes(trim($_POST['u_status']));
	$stok 					= $_POST['u_jumlah'];
	$tanggal_kadaluarsa 	= $_POST['u_tanggal_kadaluarsa'];
	
	$sql = "UPDATE arus_produk SET id_produk='$id_produk', status='$status', jumlah='$stok' WHERE id='$id'";

	if (mysqli_query($conn, $sql)) {
	    $_SESSION['ubah_berhasil'] = true;
	} else {
		$_SESSION['ubah_gagal'] = true;
	}
}

//hapus data
if (isset($_POST['hapus_mk_produk'])) {
	$id 	= $_POST['id'];

	$sql 	= "DELETE FROM arus_produk WHERE id='$id'";

	if (mysqli_query($conn, $sql)) {
	    $_SESSION['hapus_berhasil'] = true;
	} else {
		$_SESSION['hapus_gagal'] = true;
	}
}

?>
