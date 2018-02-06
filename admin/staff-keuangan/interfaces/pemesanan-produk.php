<title>Pemesanan Produk</title>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 style="opacity: 1">
        Pemesanan Produk
      </h1>
      <ol class="breadcrumb">
        <li><a href="?menu=beranda"><i class="fa fa-home"></i> Beranda</a></li>
        <li class="active">Pemesanan Produk </li>
      </ol>
    </section>
	<!-- Main content -->
    <section class="content">
      	<div class="row">
        	<div class="col-xs-12">
        		<div class="nav-tabs-custom">
		            <ul class="nav nav-tabs pull-right">
		              	<li class="active"><a href="#tab_2-2" data-toggle="tab">Daftar Pemesanan</a></li>
		            </ul>
		            <div class="tab-content">
		              	<div class="tab-pane active" id="tab_2-2">
			            	<table id="example1" class="table table-striped table-bordered dt-responsive nowrap">
				                <thead>
				                <tr class="bg-success">
				                  	<th width="5%">No</th>
				                  	<th>Nomor Faktur</th>
				                  	<th>Pelanggan</th>
				                  	<th>Tanggal Pemesanan</th>
				                  	<th>Tanggal Pembayaran</th>
				                  	<th class="text-center">Metode Pembayaran</th>
				                  	<th></th>
				                </tr>
				                </thead>
				                <tbody>

					                <?php
					                $sql = "
					                SELECT pemesanan_produk.id, pemesanan_produk.nomor_faktur, pemesanan_produk.tanggal_pembayaran, pemesanan_produk.metode_pembayaran, pemesanan_produk.tanggal, pemesanan_produk.status_pembayaran, pelanggan.nama, pelanggan.kode,  DATE_FORMAT(tanggal, '%H:%i:%s') AS jam_pemesanan, DATE_FORMAT(tanggal_pembayaran, '%H:%i:%s') AS jam_pembayaran, pegawai.nip, pegawai.nama_panggilan
					                FROM pemesanan_produk
					                LEFT JOIN pelanggan ON pemesanan_produk.pelanggan=pelanggan.id
					                LEFT JOIN pegawai ON pemesanan_produk.pegawai=pegawai.id
					                ORDER BY tanggal DESC";
									$result = mysqli_query($conn, $sql);

									if (mysqli_num_rows($result) > 0) {
										$j=0;
										$no = 1;
									    // keluarkan data dalam variabel row
									    while($row = mysqli_fetch_assoc($result)) {
									    	$id = $row['id'];
									    	$nomor_faktur = $row['nomor_faktur'];
									    	$tanggal_pembayaran = $row['tanggal_pembayaran'];
									    	$metode_pembayaran = $row['metode_pembayaran'];
									    	$status_pembayaran = $row['status_pembayaran'];
									    	$tanggal = $row['tanggal'];
									    	$nama = $row['nama'];
									    	$nama_panggilan = $row['nama_panggilan'];
									    	$kode = $row['kode'];
									    	$jam_pemesanan = $row['jam_pemesanan'];
									    	$jam_pembayaran = $row['jam_pembayaran'];
									    	$nip = $row['nip'];
									    	$nama_panggilan = $row['nama_panggilan'];

									    	$sql_status_po = "SELECT id FROM pemesanan_produk WHERE id='$id'";
									    	$result_status_po=mysqli_query($conn,$sql_status_po);
									    	$jml=mysqli_num_rows($result_status_po);
									    	if ($jml==0) {
									    		$status_po[$j] = 'belum disetujui';
									    	}else{
									    		$status_po[$j] = 'sudah disetujui';
									    	}
									    	?>
									        <tr>
							                  	<td><?= $no++; ?></td>
							                  	<td><?= strtoupper($row['nomor_faktur']) ?></td>
							                  	<td><?= strtoupper($row['nama']) ?></td>
							                  	<td><?= Tanggal($row['tanggal']).' ('.$jam_pemesanan.')' ?></td>
							                  	<td>
							                  		<?php
							                  		if($row['tanggal_pembayaran']==null){
							                  			echo "-";
						                  			}else{
						                  				echo Tanggal($row['tanggal_pembayaran']).' ('.$jam_pembayaran.')';
						                  			} ?>
						                  		</td>
							                  	<td class="text-center"><?= strtoupper($metode_pembayaran) ?></td>
                                                <?php
                                                if($row['tanggal_pembayaran']==null){ ?>
                                                    <td width="10%" class="text-center">
    							                  		<button class="btn btn-sm btn-success" title="Konfirmasi" data-toggle="modal" data-target="#modalKonfirmasi" onclick="return konfirmasi('<?= $id ?>', '<?= $nomor_faktur ?>')"><i class="fa fa-check"></i> Konfirmasi</button>
    							                  	</td>
                                                    <?php
                                                }else{ ?>
                                                    <td></td>
                                                    <?php
                                                }?>

							                </tr>
									        <?php
									        $j++;
									    }
									}
					                ?>

				                </tbody>
			              	</table>
			            </div>
		              	<!-- /.tab-pane -->
		            </div>
		            <!-- /.tab-content -->
		        </div>
		        <!-- nav-tabs-custom -->
       		</div>
        	<!-- /.col -->
      	</div>
      	<!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<!-- Modal Pembayaran' -->
<div class="modal fade" id="modalKonfirmasi" role="dialog">
    <div class="modal-dialog modal-sm">
      	<div class="modal-content">
        	<div class="modal-header">
	          	<button type="button" class="close" data-dismiss="modal">&times;</button>
	          	<h4 class="modal-title"><i class="fa fa-check text-success"></i> Konfirmasi</h4>
	        </div>
	       <form action="" method="post" accept-charset="utf-8" class="form-horizontal">
	        	<div class="modal-body">

	        		<!-- ID  -->
	        		<input type="hidden" name="id" id="id" class="form-control" placeholder="" required="">

		          	<p>Konfirmasi pembayaran?</p>
                    <input type="date" name="tanggal_pembayaran" value="<?= date('Y-m-d')?>" class="form-control">
		        </div>
		        <div class="modal-footer">
		          	<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
		          	<button type="submit" class="btn btn-success" name="konfirmasi_pembayaran">Konfirmasi</button>
		        </div>
	        </form>
    	</div>
	</div>
</div>

<script type="text/javascript">

	function hapus(id){
		$('.modal-body input[name=id]').val(id);
	}

	function konfirmasi(id, nomor_faktur){
		$('.modal-body input[name=id]').val(id);
		$('.modal-body input[name=nomor_faktur]').val(nomor_faktur);
	}

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    });
</script>


<!-- Pesan Proses Simpan  -->
<?php
// simpan konfirmasi pembayaran
if (isset($_POST['konfirmasi_pembayaran'])) {
    $id = $_POST['id'];
    $status_pembayaran = 'S';
    $tanggal_pembayaran = $_POST['tanggal_pembayaran'];
    $sql = "UPDATE pemesanan_produk SET tanggal_pembayaran='$tanggal_pembayaran', status_pembayaran='$status_pembayaran' WHERE id='$id'";
    if (mysqli_query($conn,$sql)) {

        // cek kapasitas
        $sql = "SELECT SUM(jumlah) as kapasitas FROM detail_penjualan_produk WHERE faktur='$id'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $kapasitas = $row['kapasitas'];

        // pilih kendaraan
        $sql = "SELECT id FROM kendaraan WHERE kapasitas >= '$kapasitas' ORDER BY kapasitas ASC LIMIT 1";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $kendaraan = $row['id'];

        // penentuan tanggal
        $sql = "SELECT tanggal_pembayaran FROM pemesanan_produk WHERE id='$id'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $tanggal_pembayaran = $row['tanggal_pembayaran'];
        $jam_pembayaran = date('H', strtotime($tanggal_pembayaran));
        if ($jam_pembayaran > 16) {
            $tanggal = date('Y-m-d', strtotime('+1 days', strtotime($tanggal_pembayaran)));
        }else{
            $tanggal = $tanggal_pembayaran;
        }

        $status = '0';
        // insert distribusi
        $sql = "INSERT INTO distribusi(nomor_faktur, kendaraan, tanggal, status) VALUES('$id', '$kendaraan', '$tanggal', '$status')";
        mysqli_query($conn, $sql);

        $_SESSION['simpan_berhasil'] = true;
    }else{
        $_SESSION['simpan_gagal'] = true;
    }

}


if (isset($_SESSION['simpan_berhasil'])) {
	?>
    <script type="text/javascript">
	  $(function(){
	    $.gritter.add({
	        // (string | mandatory) the heading of the notification
	        title: 'Sukses!',
	        // (string | mandatory) the text inside the notification
	        text: 'Data berhasil disimpan.',
	        // (string | optional) the image to display on the left
	        image: 'assets/images/berhasil.png',
	        // (bool | optional) if you want it to fade out on its own or just sit there
	        sticky: false,
	        // (int | optional) the time you want it to be alive for before fading out
	        time: ''
	      });
	  });
	</script>
    <?php
    /*unset session*/
    unset($_SESSION['simpan_berhasil']);
}else if (isset($_SESSION['simpan_gagal'])) {
	?>
    <script type="text/javascript">
	  $(function(){
	    $.gritter.add({
	        // (string | mandatory) the heading of the notification
	        title: 'Gagal!',
	        // (string | mandatory) the text inside the notification
	        text: 'Error : Terjadi kesalahan saat menyimpan data.',
	        // (string | optional) the image to display on the left
	        image: 'assets/images/gagal.png',
	        // (bool | optional) if you want it to fade out on its own or just sit there
	        sticky: false,
	        // (int | optional) the time you want it to be alive for before fading out
	        time: ''
	      });
	  });
	</script>
    <?php
    /*unset session*/
    unset($_SESSION['simpan_gagal']);
}
?>

<!-- Pesan Proses Ubah  -->
<?php
if (isset($_SESSION['ubah_berhasil'])) {
	?>
    <script type="text/javascript">
	  $(function(){
	    $.gritter.add({
	        // (string | mandatory) the heading of the notification
	        title: 'Sukses!',
	        // (string | mandatory) the text inside the notification
	        text: 'Data berhasil diperbaharui.',
	        // (string | optional) the image to display on the left
	        image: 'assets/images/berhasil.png',
	        // (bool | optional) if you want it to fade out on its own or just sit there
	        sticky: false,
	        // (int | optional) the time you want it to be alive for before fading out
	        time: ''
	      });
	  });
	</script>
    <?php
    /*unset session*/
    unset($_SESSION['ubah_berhasil']);
}else if (isset($_SESSION['ubah_gagal'])) {
	?>
    <script type="text/javascript">
	  $(function(){
	    $.gritter.add({
	        // (string | mandatory) the heading of the notification
	        title: 'Gagal!',
	        // (string | mandatory) the text inside the notification
	        text: 'Error : Terjadi kesalahan saat memperbaharui data.',
	        // (string | optional) the image to display on the left
	        image: 'assets/images/gagal.png',
	        // (bool | optional) if you want it to fade out on its own or just sit there
	        sticky: false,
	        // (int | optional) the time you want it to be alive for before fading out
	        time: ''
	      });
	  });
	</script>
    <?php
    /*unset session*/
    unset($_SESSION['ubah_gagal']);
}
?>

<!-- Pesan Proses Hapus  -->
<?php
if (isset($_SESSION['hapus_berhasil'])) {
	?>
    <script type="text/javascript">
	  $(function(){
	    $.gritter.add({
	        // (string | mandatory) the heading of the notification
	        title: 'Sukses!',
	        // (string | mandatory) the text inside the notification
	        text: 'Data berhasil dihapus.',
	        // (string | optional) the image to display on the left
	        image: 'assets/images/berhasil.png',
	        // (bool | optional) if you want it to fade out on its own or just sit there
	        sticky: false,
	        // (int | optional) the time you want it to be alive for before fading out
	        time: ''
	      });
	  });
	</script>
    <?php
    /*unset session*/
    unset($_SESSION['hapus_berhasil']);
}else if (isset($_SESSION['hapus_gagal'])) {
	?>
    <script type="text/javascript">
	  $(function(){
	    $.gritter.add({
	        // (string | mandatory) the heading of the notification
	        title: 'Gagal!',
	        // (string | mandatory) the text inside the notification
	        text: 'Error: Terjadi kesalahan saat menghapus data.',
	        // (string | optional) the image to display on the left
	        image: 'assets/images/gagal.png',
	        // (bool | optional) if you want it to fade out on its own or just sit there
	        sticky: false,
	        // (int | optional) the time you want it to be alive for before fading out
	        time: ''
	      });
	  });
	</script>
    <?php
    /*unset session*/
    unset($_SESSION['hapus_gagal']);
}
?>
