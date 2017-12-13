<?php 

if (isset($_POST['login'])) {
	$nama_pengguna 	= addslashes(trim($_POST['nama_pengguna']));
	$kata_sandi		= addslashes(trim($_POST['kata_sandi']));
	$kata_sandi		= md5($kata_sandi);

	$sql 	= "SELECT id, nip, nama_lengkap, nama_panggilan, jabatan FROM pegawai WHERE nama_pengguna='$nama_pengguna' AND kata_sandi='$kata_sandi'";
	$result	= mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		$row = mysqli_fetch_assoc($result);

		//buat session login
		$_SESSION['session_login_pegawai_cvmekarsari'] = true;
		$_SESSION['session_id'] = $row['id'];
		$_SESSION['session_nip'] = $row['nip'];
		$_SESSION['session_nama_lengkap'] = $row['nama_lengkap'];
		$_SESSION['session_nama_panggilan'] = $row['nama_panggilan'];
		$_SESSION['session_jabatan'] = $row['jabatan'];

		header('location:?menu=beranda');
	}else{
		$_SESSION['error_login'] = true;
	}	
}

?>