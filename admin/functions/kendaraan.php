<?php 

//tambah data
if (isset($_POST['simpan_kendaraan'])) {

	//inisialisasi
	$plat_nomor 	= strtoupper(addslashes(trim($_POST['plat_nomor'])));
	$nama 			= strtoupper(addslashes(trim($_POST['nama'])));
	$tujuan_pengiriman 	= addslashes(trim($_POST['tujuan_pengiriman']));
	$kapasitas 		= addslashes(trim($_POST['kapasitas']));
	$supir 		= addslashes(trim($_POST['supir']));

	$sql = "INSERT INTO kendaraan (plat_nomor, nama, tujuan_pengiriman, kapasitas, supir) VALUES ('$plat_nomor', '$nama', '$tujuan_pengiriman', '$kapasitas', '$supir')";

	if (mysqli_query($conn, $sql)) {
	    $_SESSION['simpan_berhasil'] = true;
	} else {
	    $_SESSION['simpan_gagal'] = true;
	}
}

//ubah data 
if (isset($_POST['ubah_kendaraan'])) {

	//inisialisasi
	$id 			= $_POST['id'];
	$plat_nomor 	= strtoupper(addslashes(trim($_POST['u_plat_nomor'])));
	$nama 			= strtoupper(addslashes(trim($_POST['u_nama'])));
	$tujuan_pengiriman 	= addslashes(trim($_POST['u_tujuan_pengiriman']));
	$kapasitas 		= addslashes(trim($_POST['u_kapasitas']));
	$supir 		= addslashes(trim($_POST['u_supir']));

	$sql = "UPDATE kendaraan SET plat_nomor='$plat_nomor', nama='$nama', tujuan_pengiriman='$tujuan_pengiriman', kapasitas='$kapasitas', supir='$supir' WHERE id='$id'";

	if (mysqli_query($conn, $sql)) {
	    $_SESSION['ubah_berhasil'] = true;
	} else {
		$_SESSION['ubah_gagal'] = true;
	}
}

//hapus data
if (isset($_POST['hapus_kendaraan'])) {
	$id 	= $_POST['id'];

	$sql 	= "DELETE FROM kendaraan WHERE id='$id'";

	if (mysqli_query($conn, $sql)) {
	    $_SESSION['hapus_berhasil'] = true;
	} else {
		$_SESSION['hapus_gagal'] = true;
	}
}

?>
