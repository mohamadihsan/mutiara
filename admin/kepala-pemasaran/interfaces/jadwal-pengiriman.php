<title>Jadwal Pengiriman</title>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 style="opacity: 1">
        Jadwal Pengiriman
      </h1>
      <ol class="breadcrumb">
        <li><a href="?menu=beranda"><i class="fa fa-home"></i> Beranda</a></li>
        <li class="active">Jadwal Pengiriman </li>
      </ol>
    </section>
	<!-- Main content -->
    <section class="content">
      	<div class="row">
        	<div class="col-xs-12">
        		<div class="nav-tabs-custom">
		            <ul class="nav nav-tabs pull-right">
		              	<li class="active"><a href="?menu=jadwal-pengiriman&analisis" class="text-bold"><i class="fa fa-plus text-success"></i> Analisis Distribusi</a></li>
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
				                  	<th>Tanggal Pengiriman</th>
				                  	<th>Kendaraan</th>
                                    <th>Alamat Pengiriman</th>
				                  	<th class="text-center" width="5%">Status Pengiriman</th>
				                </tr>
				                </thead>
				                <tbody>

					                <?php
					                $sql = "
                                    SELECT
                                    	d.id,
                                    	k.plat_nomor,
                                    	pp.nomor_faktur,
                                    	d.`status`,
                                    	d.tanggal,
                                    	p.nama,
                                    	p.alamat
                                    FROM
                                    	distribusi d
                                    LEFT JOIN pemesanan_produk pp ON pp.id = d.nomor_faktur
                                    LEFT JOIN pelanggan p ON p.id = pp.pelanggan
                                    LEFT JOIN kendaraan k ON k.id=d.kendaraan
                                    ORDER BY
                                    	d.tanggal DESC";
									$result = mysqli_query($conn, $sql);

									if (mysqli_num_rows($result) > 0) {
										$j=0;
										$no = 1;
									    // keluarkan data dalam variabel row
									    while($row = mysqli_fetch_assoc($result)) {
									    	$id = $row['id'];
									    	$nomor_faktur = $row['nomor_faktur'];
									    	$tanggal = $row['tanggal'];
									    	$plat_nomor = $row['plat_nomor'];
									    	$status = $row['status'];
									    	$nama = $row['nama'];
									    	$alamat = $row['alamat'];

									    	?>
									        <tr>
							                  	<td><?= $no++; ?></td>
							                  	<td><?= strtoupper($row['nomor_faktur']) ?></td>
							                  	<td><?= strtoupper($row['nama']) ?></td>
							                  	<td><?= Tanggal($row['tanggal']).' ('.$jam_pemesanan.')' ?></td>
                                                <td><?= $plat_nomor ?></td>
                                                <td><?= $alamat ?></td>
							                  	<td class="text-center">
							                  		<?php
							                  		if ($status=='B') {
							                  			?><span class="label label-warning">belum dikirim</span><?php
							                  		}else{
							                  			?><span class="label label-success">sudah dikirim</span><?php
							                  		}
							                  		?>
							                  	</td>
							                </tr>
									        <?php
									        $j++;
									    }
									}
					                ?>

				                </tbody>
			              	</table>

                            <?php
                            if (isset($_GET['analisis'])) {
                                $from = "Bandung";
                                $to = "Bogor";

                                $from = urlencode($from);
                                $to = urlencode($to);

                                $data = file_get_contents("http://maps.googleapis.com/maps/api/distancematrix/json?origins=$from&destinations=$to&language=id-ID&sensor=false");
                                $data = json_decode($data);

                                $time = 0;
                                $distance = 0;

                                foreach($data->rows[0]->elements as $road) {
                                    $time += $road->duration->value;
                                    $distance += $road->distance->value;
                                }

                                echo "Asal: ".$data->destination_addresses[0];

                                echo "Tujuan: ".$data->origin_addresses[0];

                                echo "Estimasi Waktu: ".$time." detik atau setara dengan " . gmdate('H', $time) . " jam " . gmdate('i', $time) . " menit";

                                echo "Jarak: ".$distance." m atau " .floor($distance / 1000). " km";

                            }?>

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


<!-- Pesan Proses Simpan  -->
<?php
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
