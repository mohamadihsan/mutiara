<?php 

//tambah data
if (isset($_POST['simpan_bahan_baku'])) {

	/*get last id bahan baku*/
	$sql 	= "SELECT id FROM bahan_baku ORDER BY id DESC LIMIT 1";
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
	$kode 	= 'MS/BB/'.$no_urut;
	$nama 	= ucwords(addslashes(trim($_POST['nama'])));
	$satuan = ucwords(addslashes(trim($_POST['satuan'])));

	$sql = "INSERT INTO bahan_baku (kode, nama, satuan) VALUES ('$kode', '$nama', '$satuan')";

	if (mysqli_query($conn, $sql)) {
	    $_SESSION['simpan_berhasil'] = true;
	} else {
	    $_SESSION['simpan_gagal'] = true;
	}
}

//ubah data
if (isset($_POST['ubah_bahan_baku'])) {
	$id 	= $_POST['id'];
	$nama 	= ucwords(addslashes(trim($_POST['u_nama'])));
	$satuan = ucwords(addslashes(trim($_POST['u_satuan'])));

	$sql = "UPDATE bahan_baku SET nama='$nama', satuan='$satuan' WHERE id='$id'";

	if (mysqli_query($conn, $sql)) {
	    $_SESSION['ubah_berhasil'] = true;
	} else {
		$_SESSION['ubah_gagal'] = true;
	}
}

//hapus data
if (isset($_POST['hapus_bahan_baku'])) {
	$id 	= $_POST['id'];

	$sql 	= "DELETE FROM bahan_baku WHERE id='$id'";

	if (mysqli_query($conn, $sql)) {
	    $_SESSION['hapus_berhasil'] = true;
	} else {
		$_SESSION['hapus_gagal'] = true;
	}
}

?>
