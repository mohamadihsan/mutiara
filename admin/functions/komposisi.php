<?php

//tambah data
if (isset($_POST['simpan_komposisi'])) {

	//inisialisasi
	$id_produk 	= addslashes(trim($_POST['id_produk']));
	$id_bahan_baku 	= addslashes(trim($_POST['id_bahan_baku']));
	$takaran 	= addslashes(trim($_POST['takaran']));
	$satuan = addslashes(trim($_POST['satuan']));

	$sql = "INSERT INTO komposisi(id_produk, id_bahan_baku, takaran, satuan) VALUES ('$id_produk', '$id_bahan_baku', '$takaran', '$satuan')";

	if (mysqli_query($conn, $sql)) {
	    $_SESSION['simpan_berhasil'] = true;
	} else {
	    $_SESSION['simpan_gagal'] = true;
	}
}

//ubah data
if (isset($_POST['ubah_komposisi'])) {
	$id_produk 	= addslashes(trim($_POST['u_id_produk']));
	$id_bahan_baku 	= addslashes(trim($_POST['u_id_bahan_baku']));
	$takaran 	= addslashes(trim($_POST['u_takaran']));
	$satuan = addslashes(trim($_POST['u_satuan']));

	$sql = "UPDATE komposisi SET id_produk='$id_produk', id_bahan_baku='$id_bahan_baku', takaran='$takaran', satuan='$satuan' WHERE id_produk='$id_produk' AND id_bahan_baku='$id_bahan_baku'";

	if (mysqli_query($conn, $sql)) {
	    $_SESSION['ubah_berhasil'] = true;
	} else {
		$_SESSION['ubah_gagal'] = true;
	}
}

//hapus data
if (isset($_POST['hapus_komposisi'])) {
	$id_produk 	= $_POST['id_produk'];
	$id_bahan_baku 	= $_POST['id_bahan_baku'];

	$sql 	= "DELETE FROM komposisi WHERE id_produk='$id_produk' AND id_bahan_baku='$id_bahan_baku'";

	if (mysqli_query($conn, $sql)) {
	    $_SESSION['hapus_berhasil'] = true;
	} else {
		$_SESSION['hapus_gagal'] = true;
	}
}

?>
