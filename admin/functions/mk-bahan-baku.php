<?php 

//tambah data
if (isset($_POST['simpan_mk_bahan_baku'])) {

	//inisialisasi
	$id_bahan_baku 		= $_POST['id_bahan_baku'];
	$status 			= addslashes(trim($_POST['status']));
	$stok 				= $_POST['jumlah'];
	/*$tanggal_kadaluarsa	= $_POST['tanggal_kadaluarsa'];*/

	$i=0;
	while ($i<count($_POST['jumlah'])) {

		$sql = "INSERT INTO arus_bahan_baku (id_bahan_baku, status, jumlah) VALUES ('$id_bahan_baku', '$status', '$stok[$i]')";
		
		if (mysqli_query($conn, $sql)) {

			if ($status=='keluar') {
				$sql_detail = "INSERT INTO detail_bahan_baku (id_bahan_baku, stok) VALUES ('$id_bahan_baku', '$stok[$i]'*-1)";
			}else{
				$sql_detail = "INSERT INTO detail_bahan_baku (id_bahan_baku, stok) VALUES ('$id_bahan_baku', '$stok[$i]')";
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
if (isset($_POST['ubah_mk_bahan_baku'])) {
	$id 					= $_POST['id'];
	$id_bahan_baku 			= $_POST['u_id_bahan_baku'];
	$status 				= addslashes(trim($_POST['u_status']));
	$stok 					= $_POST['u_jumlah'];
	$tanggal_kadaluarsa 	= $_POST['u_tanggal_kadaluarsa'];

	$sql = "UPDATE arus_bahan_baku SET id_bahan_baku='$id_bahan_baku', status='$status', jumlah='$stok' WHERE id='$id'";

	if (mysqli_query($conn, $sql)) {
	    $_SESSION['ubah_berhasil'] = true;
	} else {
		$_SESSION['ubah_gagal'] = true;
	}
}

//hapus data
if (isset($_POST['hapus_mk_bahan_baku'])) {
	$id 	= $_POST['id'];

	$sql 	= "DELETE FROM arus_bahan_baku WHERE id='$id'";

	if (mysqli_query($conn, $sql)) {
	    $_SESSION['hapus_berhasil'] = true;
	} else {
		$_SESSION['hapus_gagal'] = true;
	}
}

?>
