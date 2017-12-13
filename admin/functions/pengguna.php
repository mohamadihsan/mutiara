<?php 

//tambah data
if (isset($_POST['simpan_pengguna'])) {

	//inisialisasi
	$nip 			= ucwords(addslashes(trim($_POST['nip'])));
	$nama_lengkap 	= ucwords(addslashes(trim($_POST['nama_lengkap'])));
	$nama_panggilan = ucwords(addslashes(trim($_POST['nama_panggilan'])));
	$jabatan 		= ucwords(addslashes(trim($_POST['jabatan'])));
	$nama_pengguna 	= addslashes(trim($_POST['nama_pengguna']));
	$kata_sandi 	= addslashes(trim($_POST['kata_sandi']));
	$kata_sandi 	= md5($kata_sandi);

	$sql = "INSERT INTO pegawai (nip, nama_lengkap, nama_panggilan, jabatan, nama_pengguna, kata_sandi) VALUES ('$nip', '$nama_lengkap', '$nama_panggilan', '$jabatan', '$nama_pengguna', '$kata_sandi')";

	if (mysqli_query($conn, $sql)) {
	    $_SESSION['simpan_berhasil'] = true;
	} else {
	    $_SESSION['simpan_gagal'] = true;
	}
}

//ubah data pegawai
if (isset($_POST['ubah_pegawai'])) {

	//inisialisasi
	$id 			= $_POST['id'];
	$nip 			= ucwords(addslashes(trim($_POST['u_nip'])));
	$nama_lengkap 	= ucwords(addslashes(trim($_POST['u_nama_lengkap'])));
	$nama_panggilan = ucwords(addslashes(trim($_POST['u_nama_panggilan'])));
	$jabatan 		= ucwords(addslashes(trim($_POST['u_jabatan'])));

	$sql = "UPDATE pegawai SET nip='$nip', nama_lengkap='$nama_lengkap', nama_panggilan='$nama_panggilan', jabatan='$jabatan' WHERE id='$id'";

	if (mysqli_query($conn, $sql)) {
	    $_SESSION['ubah_berhasil'] = true;
	} else {
		$_SESSION['ubah_gagal'] = true;
	}
}

//ubah data pengguna
if (isset($_POST['ubah_pengguna'])) {
	//inisialisasi
	$id 			= $_POST['id'];
	$nama_pengguna 	= addslashes(trim($_POST['u_nama_pengguna']));
	$kata_sandi 	= addslashes(trim($_POST['u_kata_sandi']));
	$kata_sandi 	= md5($kata_sandi);

	$sql = "UPDATE pegawai SET nama_pengguna='$nama_pengguna', kata_sandi='$kata_sandi' WHERE id='$id'";

	if (mysqli_query($conn, $sql)) {
	    $_SESSION['ubah_berhasil'] = true;
	} else {
		$_SESSION['ubah_gagal'] = true;
	}
}

//hapus data
if (isset($_POST['hapus_pengguna'])) {
	$id 	= $_POST['id'];

	$sql 	= "DELETE FROM pegawai WHERE id='$id'";

	if (mysqli_query($conn, $sql)) {
	    $_SESSION['hapus_berhasil'] = true;
	} else {
		$_SESSION['hapus_gagal'] = true;
	}
}

?>
