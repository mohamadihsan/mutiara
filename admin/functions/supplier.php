<?php 

//tambah data
if (isset($_POST['simpan_supplier'])) {

	//inisialisasi
	$nama 				= strtoupper(addslashes(trim($_POST['nama'])));
	$alamat 			= addslashes(trim($_POST['alamat']));
	$waktu_pengiriman 	= addslashes(trim($_POST['waktu_pengiriman']));
	$nama_pengguna 		= addslashes(trim($_POST['nama_pengguna']));
	$kata_sandi 		= md5(addslashes(trim($_POST['kata_sandi'])));
	$jenis				= $_POST['jenis'];
	$harga				= $_POST['harga'];
	$satuan 			= $_POST['satuan'];

	/*simpan ke table supplier*/
	$sql = "INSERT INTO supplier (nama, alamat, waktu_pengiriman, nama_pengguna, kata_sandi) VALUES ('$nama', '$alamat', '$waktu_pengiriman', '$nama_pengguna', '$kata_sandi')";
	mysqli_query($conn, $sql);
	$id_supplier = mysqli_insert_id($conn);

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
if (isset($_POST['ubah_supplier'])) {
	$id 				= $_POST['id'];
	$nama 				= strtoupper(addslashes(trim($_POST['u_nama'])));
	$alamat 			= addslashes(trim($_POST['u_alamat']));
	$waktu_pengiriman 	= addslashes(trim($_POST['u_waktu_pengiriman']));

	$sql = "UPDATE supplier SET nama='$nama', alamat='$alamat', waktu_pengiriman='$waktu_pengiriman' WHERE id='$id'";

	if (mysqli_query($conn, $sql)) {
	    $_SESSION['ubah_berhasil'] = true;
	} else {
		$_SESSION['ubah_gagal'] = true;
	}
}

//hapus data
if (isset($_POST['hapus_supplier'])) {
	$id 	= $_POST['id'];

	$sql 	= "DELETE FROM supplier WHERE id='$id'";

	if (mysqli_query($conn, $sql)) {
	    $_SESSION['hapus_berhasil'] = true;
	} else {
		$_SESSION['hapus_gagal'] = true;
	}
}

?>
