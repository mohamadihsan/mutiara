<?php 

//tambah data
if (isset($_POST['simpan_pelanggan'])) {

	//inisialisasi
	$kode 			= strtoupper(addslashes(trim($_POST['kode'])));
	$nama 			= ucwords(addslashes(trim($_POST['nama'])));
	$kota 			= addslashes(trim($_POST['kota']));
	$alamat 		= addslashes(trim($_POST['alamat']));
	$no_telp 		= ucwords(addslashes(trim($_POST['no_telp'])));
	$email 			= addslashes(trim($_POST['email']));
	$nama_pengguna 	= addslashes(trim($_POST['nama_pengguna']));
	$kata_sandi 	= addslashes(trim($_POST['kata_sandi']));
	$kata_sandi 	= md5($kata_sandi);

	

	$sql = "INSERT INTO pelanggan (kode, nama, kota, alamat, no_telp, email, nama_pengguna, kata_sandi) VALUES ('$kode', '$nama', '$kota', '$alamat', '$no_telp', '$email', '$nama_pengguna', '$kata_sandi')";

	if (mysqli_query($conn, $sql)) {
	    $_SESSION['simpan_berhasil'] = true;
	} else {
	    $_SESSION['simpan_gagal'] = true;
	}
}

//ubah data 
if (isset($_POST['ubah_pelanggan'])) {

	//inisialisasi
	$id 			= $_POST['id'];
	$nama 			= ucwords(addslashes(trim($_POST['u_nama'])));
	$kota 			= addslashes(trim($_POST['u_kota']));
	$alamat 		= addslashes(trim($_POST['u_alamat']));
	$no_telp 		= ucwords(addslashes(trim($_POST['u_no_telp'])));
	$email 			= addslashes(trim($_POST['u_email']));

	$sql = "UPDATE pelanggan SET nama='$nama', kota='$kota', alamat='$alamat', no_telp='$no_telp', email='$email' WHERE id='$id'";

	if (mysqli_query($conn, $sql)) {
	    $_SESSION['ubah_berhasil'] = true;
	} else {
		$_SESSION['ubah_gagal'] = true;
	}
}

//hapus data
if (isset($_POST['hapus_pelanggan'])) {
	$id 	= $_POST['id'];

	$sql 	= "DELETE FROM pelanggan WHERE id='$id'";

	if (mysqli_query($conn, $sql)) {
	    $_SESSION['hapus_berhasil'] = true;
	} else {
		$_SESSION['hapus_gagal'] = true;
	}
}

?>
