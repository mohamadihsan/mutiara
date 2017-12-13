<?php 

//tambah data
if (isset($_POST['simpan_detail_supplier'])) {

	//inisialisasi
	$id_supplier	= $_POST['id'];
	$jenis			= $_POST['jenis'];
	$harga			= $_POST['harga'];
	$satuan 		= $_POST['satuan'];

	/*simpan ke table detail supplier*/
	$i=0;
	while ($i<count($_POST['jenis'])) {

		$sql = "INSERT INTO detail_supplier (id_supplier, jenis, harga, satuan) VALUES ('$id_supplier', '$jenis[$i]', '$harga[$i]', '$satuan[$i]')";
		
		if (mysqli_query($conn, $sql)) {
			$_SESSION['simpan_berhasil'] = true;
		} else {
		    $_SESSION['simpan_gagal'] = true;
		}
		$i++;
	}
}

//ubah data
if (isset($_POST['ubah_detail_supplier'])) {
	$id 			= $_POST['id'];
	$jenis_lama		= $_POST['jenis_lama'];
	$jenis			= $_POST['u_jenis'];
	$harga			= $_POST['u_harga'];
	$satuan 		= $_POST['u_satuan'];

	$sql = "UPDATE detail_supplier SET jenis='$jenis', harga='$harga', satuan='$satuan' WHERE id_supplier='$id' AND jenis='$jenis_lama'";

	if (mysqli_query($conn, $sql)) {
	    $_SESSION['ubah_berhasil'] = true;
	} else {
		$_SESSION['ubah_gagal'] = true;
	}
}

//hapus data
if (isset($_POST['hapus_detail_supplier'])) {
	$id 	= $_POST['id'];
	$jenis 	= $_POST['jenis'];

	$sql 	= "DELETE FROM detail_supplier WHERE id_supplier='$id' AND jenis='$jenis'";

	if (mysqli_query($conn, $sql)) {
	    $_SESSION['hapus_berhasil'] = true;
	} else {
		$_SESSION['hapus_gagal'] = true;
	}
}

?>
