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
                        <?php
                        if (isset($_GET['tanggal'])) {
                            ?>
                            <li class="active"><a href="?menu=jadwal-pengiriman" class="text-bold"><i class="fa fa-arrow-left text-success"></i> Kembali</a></li>
    		              	<?php
                        }else{
                            ?>
                            <li class="active"><a href="" data-toggle="modal" data-target="#modalAnalisis" class="text-bold"><i class="fa fa-plus text-success"></i> Analisis Distribusi</a></li>
    		              	<?php
                        }
                        ?>
		              	<li class="active"><a href="#tab_2-2" data-toggle="tab">Daftar Pemesanan</a></li>
		            </ul>
		            <div class="tab-content">
		              	<div class="tab-pane active" id="tab_2-2">

                            <?php
                            if (isset($_GET['analisis'])) {


                                // echo "Estimasi Waktu: ".$time." detik atau setara dengan " . gmdate('H', $time) . " jam " . gmdate('i', $time) . " menit";
                                //
                                // echo "Jarak: ".$distance." m atau " .floor($distance / 1000). " km";

                                $tanggal_analisis = $_GET['tanggal'];

                                $sql = "SELECT
                                	d.id,
                                	pp.nomor_faktur,
                                	pl.nama,
                                	pl.provinsi,
                                	pl.kabupaten,
                                	pl.kecamatan,
                                	pl.alamat,
                                	k.plat_nomor,
                                	pg.nama_lengkap,
                                	DATE_FORMAT(d.tanggal, '%Y-%m-%d') AS tanggal_pengiriman,
                                	d.status as status_pengiriman
                                FROM
                                	distribusi d
                                LEFT JOIN pemesanan_produk pp ON pp.id = d.nomor_faktur
                                LEFT JOIN pelanggan pl ON pl.id = pp.pelanggan
                                LEFT JOIN kendaraan k ON k.id = d.kendaraan
                                LEFT JOIN pegawai pg ON pg.id = k.supir
                                WHERE
                                	DATE_FORMAT(d.tanggal, '%Y-%m-%d') = '$tanggal_analisis'
                                ORDER BY k.plat_nomor ";

                                $result = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($result)>0) {
                                    ?>

                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Faktur</th>
                                                <th>Kendaraan</th>
                                                <th>Supir</th>
                                                <th width="40%">Alamat</th>
                                                <th>Jarak</th>
                                                <th>Estimasi</th>
                                                <th width="10%">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            $i=0;
                                            $alamat_perusahaan = "Jl. Raya Cipanas Kecamatan Cipanas Kabupaten Cianjur";
                                            $alamat_perusahaan_lengkap = "Jl. Raya Cipanas Kp.Belakang RT.03 RW.01 Desa Sindanglaya Kecamatan Cipanas Kabupaten Cianjur";
                                            $susunan = $alamat_perusahaan;
                                            while ($row=mysqli_fetch_assoc($result)) {
                                                $id = $row['id'];
                                                $nomor_faktur = $row['nomor_faktur'];
                                                $nama = $row['nama'];
                                                $provinsi = $row['provinsi'];
                                                $kabupaten = $row['kabupaten'];
                                                $kecamatan = $row['kecamatan'];
                                                $alamat = $row['alamat'];
                                                $plat_nomor[$i] = $row['plat_nomor'];
                                                $nama_supir = $row['nama_lengkap'];
                                                $tanggal_pengiriman = $row['tanggal_pengiriman'];
                                                $status_pengiriman = $row['status_pengiriman'];

                                                if ($i==0) {
                                                    $cara_pengiriman = '<div class="label label-success">dikirim</div>';
                                                }else{
                                                    if ($plat_nomor[$i] == $plat_nomor[$i-1]) {
                                                        $cara_pengiriman = '<div class="label label-success">dikirim bersamaan</div>';
                                                    }else{
                                                        $cara_pengiriman = '<div class="label label-success">dikirim terpisah</div>';
                                                    }
                                                }

                                                $from = $alamat_perusahaan;
                                                $to = $alamat;

                                                if ($i != 0) {
                                                    $to = $alamat.' '.$provinsi;
                                                }

                                                $from = urlencode($from);
                                                $to = urlencode($to);

                                                $data = file_get_contents("http://maps.googleapis.com/maps/api/distancematrix/json?origins=$from&destinations=$to&language=id-ID&sensor=false");
                                                $data = json_decode($data);

                                                $time = 0;
                                                $distance[$i] = 0;

                                                foreach($data->rows[0]->elements as $road) {
                                                    $time += $road->duration->value;
                                                    $distance[$i] += $road->distance->value;
                                                }

                                                if ($distance[$i] > $distance[$i-1]) {
                                                    $susunan = $susunan.'  =============>>>  '.$alamat;
                                                }
                                                ?>

                                                <tr>
                                                    <td><?= $nomor_faktur ?></td>
                                                    <td><?= $plat_nomor[$i] ?></td>
                                                    <td><?= $nama_supir ?></td>
                                                    <td><?= $alamat.' '.$provinsi.' '.$kabupaten.' '.$kecamatan ?></td>
                                                    <td><?= floor($distance[$i] / 1000). " km" ?></td>
                                                    <td><?= gmdate('H', $time) . " jam " . gmdate('i', $time) . " menit" ?></td>
                                                    <td><?= $cara_pengiriman ?></td>
                                                </tr>

                                                <?php
                                                $i++;
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    <br />
                                    <?php
                                    // echo "Asal: ".$data->destination_addresses[0];
                                    // echo "<b>AWAL KEBERANGKATAN : </b><br>".$data->origin_addresses[0].'<br /><br />';
                                    echo "<b>ANALISIS DISTRIBUSI TANGGAL: </b><br>".Tanggal($tanggal_analisis).'<br /><br />';
                                    echo "<b>AWAL KEBERANGKATAN : </b><br>".$alamat_perusahaan_lengkap.'<br /><br />';
                                    echo "<b>SUSUNAN PENGIRIMAN : </b><br>".$susunan.'<br /><br />';
                                }else{
                                    echo "Data tidak ditemukan";
                                }
                            }else{
                                ?>
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
                                        <th></th>
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
    							                  		if ($status == '0') {
    							                  			?><span class="label label-warning">belum dikirim</span><?php
    							                  		}else{
    							                  			?><span class="label label-success">sudah dikirim</span><?php
    							                  		}
    							                  		?>
    							                  	</td>
                                                    <td>
                                                        <?php
                                                        if ($status=='0') {
                                                            ?>
                                                            <button class="btn btn-sm btn-success" title="Update" data-toggle="modal" data-target="#modalHapus" onclick="return hapus('<?= $id ?>')"><i class="fa fa-truck"></i></button>
                                                            <?php
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

<div class="modal fade" id="modalAnalisis" role="dialog">
    <div class="modal-dialog modal-sm">
      	<div class="modal-content">
        	<div class="modal-header">
	          	<button type="button" class="close" data-dismiss="modal">&times;</button>
	          	<h4 class="modal-title"><i class="fa fa-file-text-o text-primary"></i> Konfirmasi</h4>
	        </div>
	       <form action="?menu=jadwal-pengiriman&analisis" method="get" accept-charset="utf-8" class="form-horizontal">
	        	<div class="modal-body">

	        		<!-- ID  -->
	        		<input type="hidden" name="analisis" id="analisis" value="true" class="form-control" placeholder="" required="">
	        		<input type="hidden" name="menu" id="menu" value="jadwal-pengiriman" class="form-control" placeholder="" required="">

		          	<p>Analisis distribusi tanggal:</p>
	        		<input type="date" name="tanggal" id="tanggal" value="<?= date('Y-m-d') ?>" class="form-control" placeholder="" required="">
		        </div>
		        <div class="modal-footer">
		          	<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
		          	<button type="submit" class="btn btn-primary">Submit</button>
		        </div>
	        </form>
    	</div>
	</div>
</div>

<div class="modal fade" id="modalHapus" role="dialog">
    <div class="modal-dialog modal-md">
      	<div class="modal-content">
        	<div class="modal-header">
	          	<button type="button" class="close" data-dismiss="modal">&times;</button>
	          	<h4 class="modal-title"><i class="fa fa-user text-success"></i> Update Status</h4>
	        </div>
	       <form action="" method="post" accept-charset="utf-8" class="form-horizontal">
	        	<div class="modal-body">

	        		<!-- ID  -->
	        		<input type="hidden" name="id" id="id" class="form-control" placeholder="" required="">

		          	<p>Update status bahwa barang sudah diterima pelanggan?</p>
		        </div>
		        <div class="modal-footer">
		          	<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
		          	<button type="submit" class="btn btn-success" name="validasi_penerimaan">Update</button>
		        </div>
	        </form>
    	</div>
	</div>
</div>

<script type="text/javascript">

	function hapus(id){
		$('.modal-body input[name=id]').val(id);
	}
</script>

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
