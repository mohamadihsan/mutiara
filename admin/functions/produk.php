<?php 

//tambah data
if (isset($_POST['simpan_produk'])) {

	/*get last id bahan baku*/
	$sql 	= "SELECT id FROM produk ORDER BY id DESC LIMIT 1";
	$result = mysqli_query($conn, $sql);
	$row 	= mysqli_fetch_assoc($result);

	$id = $row['id'];
	//kombinasi no urut
	if ($id >= 0 AND $id < 10) {
		if ($id == 0) {
			$id = 1;
		}
		$no_urut = '000'.$id;
	}else if ($id >= 10 AND $id < 100) {
		$no_urut = '00'.$id;
	}else if ($id >= 100 AND $id < 1000) {
		$no_urut = '0'.$id;
	}else{
		$no_urut = $id;
	}

	//inisialisasi
	$kode 			= 'MS/P/'.$no_urut;
	$nama 			= ucwords(addslashes(trim($_POST['nama'])));
	$jenis_kemasan 	= ucwords(addslashes(trim($_POST['jenis_kemasan'])));
	$satuan 		= ucwords(addslashes(trim($_POST['satuan'])));
	$harga			= addslashes(trim($_POST['harga']));


	$sql = "INSERT INTO produk (kode, nama, jenis_kemasan, harga, satuan) VALUES ('$kode', '$nama', '$jenis_kemasan', '$harga', '$satuan')";

	if (mysqli_query($conn, $sql)) {
	    $_SESSION['simpan_berhasil'] = true;
	} else {
	    $_SESSION['simpan_gagal'] = true;
	}
}

//ubah data
if (isset($_POST['ubah_produk'])) {
	$id 			= $_POST['id'];
	$nama 			= ucwords(addslashes(trim($_POST['u_nama'])));
	$jenis_kemasan 	= ucwords(addslashes(trim($_POST['u_jenis_kemasan'])));
	$satuan 		= ucwords(addslashes(trim($_POST['u_satuan'])));
	$harga 			= addslashes(trim($_POST['u_harga']));

	$sql = "UPDATE produk SET nama='$nama', jenis_kemasan='$jenis_kemasan', harga='$harga', satuan='$satuan' WHERE id='$id'";

	if (mysqli_query($conn, $sql)) {
	    $_SESSION['ubah_berhasil'] = true;
	} else {
		$_SESSION['ubah_gagal'] = true;
	}
}

//hapus data
if (isset($_POST['hapus_produk'])) {
	$id 	= $_POST['id'];

	$sql 	= "DELETE FROM produk WHERE id='$id'";

	if (mysqli_query($conn, $sql)) {
	    $_SESSION['hapus_berhasil'] = true;
	} else {
		$_SESSION['hapus_gagal'] = true;
	}
}

?>
