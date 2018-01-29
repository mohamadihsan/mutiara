<title>Peramalan</title>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 style="opacity: 1">
         Peramalan (Produksi)
      </h1>
      <ol class="breadcrumb">
        <li><a href="?menu=beranda"><i class="fa fa-home"></i> Beranda</a></li>
        <li class="active"> Peramalan (Produksi)</li>
      </ol>
    </section>
	<!-- Main content -->
    <section class="content">
      	<div class="row">
        	<div class="col-xs-12">
                <?php
        		if (isset($_POST['periode'])) {
        			$post_periode = $_POST['bulan'].'-'.$_POST['tahun'];
        		}
        		?>
        		<!-- <form action="" method="post" accept-charset="utf-8">

	                <div class="form-group">
	                  	<div class="col-sm-12">
	                  		Filter Peramalan untuk periode :
	                  	</div>
	                  	<div class="col-sm-4">
	                  		<div class="">
	                  			<label for="inputBArang">Bulan</label>
				                <select class="form-control select" style="width: 100%;" name="bulan" id="bulan" required="">
				                	<option value="01" <?php if($_POST['bulan']=='01') echo "selected"; ?>>JANUARI</option>
				                	<option value="02" <?php if($_POST['bulan']=='02') echo "selected"; ?>>FEBRUARI</option>
				                	<option value="03" <?php if($_POST['bulan']=='03') echo "selected"; ?>>MARET</option>
				                	<option value="04" <?php if($_POST['bulan']=='04') echo "selected"; ?>>APRIL</option>
				                	<option value="05" <?php if($_POST['bulan']=='05') echo "selected"; ?>>MEI</option>
				                	<option value="06" <?php if($_POST['bulan']=='06') echo "selected"; ?>>JUNI</option>
				                	<option value="07" <?php if($_POST['bulan']=='07') echo "selected"; ?>>JULI</option>
				                	<option value="08" <?php if($_POST['bulan']=='08') echo "selected"; ?>>AGUSTUS</option>
				                	<option value="09" <?php if($_POST['bulan']=='09') echo "selected"; ?>>SEPTEMBER</option>
				                	<option value="10" <?php if($_POST['bulan']=='10') echo "selected"; ?>>OKTOBER</option>
				                	<option value="11" <?php if($_POST['bulan']=='11') echo "selected"; ?>>NOVEMBER</option>
				                	<option value="12" <?php if($_POST['bulan']=='12') echo "selected"; ?>>DESEMBER</option>
				                </select>
				            </div>
				        </div>
				        <div class="col-sm-3">
	                  		<div class="">
	                  			<label for="inputBArang">Tahun</label>
				                <select class="form-control select" style="width: 100%;" name="tahun" id="tahun" required="">
				                	<?php
				                	$sql = "SELECT DATE_FORMAT(tanggal, '%Y') as tahun FROM pemesanan_produk GROUP BY tahun";
				                	$result = mysqli_query($conn, $sql);
				                	while ($row=mysqli_fetch_assoc($result)) {
				                		$tahun = $row['tahun'];
				                		?>
				                		<option value="<?= $tahun ?>" <?php if($_POST['tahun']=='$tahun') ?> ><?= strtoupper($tahun) ?></option>
				                		<?php
				                	}
				                	?>
				                </select>
				            </div>
				        </div>
				        <div class="col-sm-12"><br>
				        	<button type="submit" name="periode" class="btn btn-success">Tampilkan Peramalan</button><br/><br/><br/>
				        </div>
				    </div>
        		</form> -->
	            <?php
	            if (!isset($_POST['periode'])) { ?>
	            	<hr>
	            	<div class="col-xs-12">
		            	<div class="nav-tabs-custom">
				            <div class="tab-content">
				              	<div class="tab-pane active" id="tab_2-2">
					            	<center><h3>Peramalan Produk Seluruh Periode <?= $post_periode ?></h3></center>
					            	<table id="example1" class="table table-striped table-bordered dt-responsive nowrap">
						                <thead>
						                <tr class="bg-success">
						                  	<th width="5%">No</th>
						                  	<th>Periode</th>
						                  	<th>Kode</th>
						                  	<th>Nama</th>
						                  	<th>Jenis</th>
						                  	<!-- <th width="10%">Stok Tersedia</th> -->
						                  	<th width="10%">Peramalan</th>
						                  	<!-- <th class="text-center" width="10%">Status</th> -->
						                  	<!-- <th></th> -->
						                </tr>
						                </thead>
						                <tbody>

							                <?php
							                $sql = "SELECT id, kode, nama, harga, jenis_kemasan FROM produk";
											$result = mysqli_query($conn, $sql);

											if (mysqli_num_rows($result) > 0) {
												$no = 1;
                                                $i=0;
											    // keluarkan data dalam variabel row
											    while($row = mysqli_fetch_assoc($result)) {
											    	$id 	= $row['id'];
											    	$kode 	= $row['kode'];
											    	$nama 	= $row['nama'];
											    	$harga 	= $row['harga'];
											    	$jenis_kemasan 	= $row['jenis_kemasan'];

											    	/*cari peramalan*/
											    	// $sql_peramalan = "SELECT produk, SUM(jumlah) as jumlah_penjualan, produk.kode, produk.nama, produk.jenis_kemasan, DATE_FORMAT(pemesanan_produk.tanggal, '%m-%Y') as periode FROM detail_penjualan_produk, produk, pemesanan_produk WHERE produk.id=detail_penjualan_produk.produk AND detail_penjualan_produk.faktur=pemesanan_produk.id AND detail_penjualan_produk.produk='$id' AND  DATE_FORMAT(pemesanan_produk.tanggal, '%m-%Y')='$post_periode' GROUP BY DATE_FORMAT(pemesanan_produk.tanggal, '%m-%Y'), detail_penjualan_produk.produk";
											    	// $result_peramalan = mysqli_query($conn,$sql_peramalan);
											    	// $row_peramalan = mysqli_fetch_assoc($result_peramalan);
											    	// $jumlah_penjualan = $row_peramalan['jumlah_penjualan'];
											    	// $periode = $row_peramalan['periode'];

											    	/*inisialisai periode 2 bulan sebelumnya*/
											    	// $concat_periode = $_POST['tahun'].'-'.$_POST['bulan'].'-01';
											    	// $periode_bulan_kemarin = date('m-Y', strtotime('-1 month', strtotime($concat_periode)));
											    	// $periode_dua_bulan_kemarin = date('m-Y', strtotime('-2 month', strtotime($concat_periode)));
                                                    //
											    	// /
                                                    //
											    	// /*cari penjualan produk 2 bulan kemaren*/
											    	// $sql_penjualan = "SELECT SUM(jumlah) as jumlah_penjualan FROM detail_penjualan_produk, produk, pemesanan_produk WHERE produk.id=detail_penjualan_produk.produk AND detail_penjualan_produk.faktur=pemesanan_produk.id AND detail_penjualan_produk.produk='$id' AND  DATE_FORMAT(pemesanan_produk.tanggal, '%m-%Y')='$periode_dua_bulan_kemarin' GROUP BY DATE_FORMAT(pemesanan_produk.tanggal, '%m-%Y'), detail_penjualan_produk.produk";
											    	// $result_penjualan = mysqli_query($conn,$sql_penjualan);
											    	// $row_penjualan = mysqli_fetch_assoc($result_penjualan);
											    	// $penjualan_dua_bulan_kemaren = $row_penjualan['jumlah_penjualan'];
                                                    //
                                                    //
											    	// if ($penjualan_dua_bulan_kemaren=='') {
											    	// 	$penjualan_dua_bulan_kemaren = 0;
											    	// }

											    	$alpha = 0.1;

											    	/*peramalan sebelumnya*/
											    	$sql_peramalan = "SELECT
                                                            	produk,
                                                            	produk.kode,
                                                            	produk.nama,
                                                            	produk.jenis_kemasan,
                                                            	DATE_FORMAT( pemesanan_produk.tanggal, '%m-%Y' ) AS periode,
                                                            	DATE_FORMAT( pemesanan_produk.tanggal, '%m' ) AS bulan,
                                                            	DATE_FORMAT( pemesanan_produk.tanggal, '%Y' ) AS tahun,
                                                            	SUM( jumlah ) AS jumlah_penjualan_awal
                                                            FROM
                                                            	detail_penjualan_produk
                                                            	LEFT JOIN produk ON produk.id = detail_penjualan_produk.produk
                                                            	LEFT JOIN pemesanan_produk ON pemesanan_produk.id = detail_penjualan_produk.faktur
                                                            WHERE
                                                            	produk.id = detail_penjualan_produk.produk
                                                            	AND detail_penjualan_produk.faktur = pemesanan_produk.id
                                                            	AND detail_penjualan_produk.produk = '$id'
                                                            GROUP BY
                                                            	1,
                                                            	2,
                                                            	3,
                                                            	4,
                                                            	5,
                                                            	6,
                                                            	7
                                                            ORDER BY
                                                            	7,
                                                            	6 ASC";
											    	$result_peramalan = mysqli_query($conn,$sql_peramalan);
											    	while($row_peramalan = mysqli_fetch_assoc($result_peramalan)){
                                                        $jumlah_penjualan_awal[$i] = $row_peramalan['jumlah_penjualan_awal'];
                                                        $periode[$i] = $row_peramalan['periode'];
                                                        $bulan = $row_peramalan['bulan'];
                                                        $tahun = $row_peramalan['tahun'];


                                                        if ($bulan == '01') {
                                                            $periode_min_satu = '12-'.$tahun-1;
                                                            $bulan_min_satu = '12';
                                                            $tahun = $tahun-1;
                                                        }else if ($bulan == '02') {
                                                            $periode_min_satu = '01-'.$tahun-1;
                                                            $bulan_min_satu = '01';
                                                        }else if ($bulan == '03') {
                                                            $periode_min_satu = '02-'.$tahun-1;
                                                            $bulan_min_satu = '02';
                                                        }else if ($bulan == '04') {
                                                            $periode_min_satu = '03-'.$tahun-1;
                                                            $bulan_min_satu = '03';
                                                        }else if ($bulan == '05') {
                                                            $periode_min_satu = '04-'.$tahun-1;
                                                            $bulan_min_satu = '04';
                                                        }else if ($bulan == '06') {
                                                            $periode_min_satu = '05-'.$tahun-1;
                                                            $bulan_min_satu = '05';
                                                        }else if ($bulan == '07') {
                                                            $periode_min_satu = '06-'.$tahun-1;
                                                            $bulan_min_satu = '06';
                                                        }else if ($bulan == '08') {
                                                            $periode_min_satu = '07-'.$tahun-1;
                                                            $bulan_min_satu = '07';
                                                        }else if ($bulan == '09') {
                                                            $periode_min_satu = '08-'.$tahun-1;
                                                            $bulan_min_satu = '08';
                                                        }else if ($bulan == '10') {
                                                            $periode_min_satu = '09-'.$tahun-1;
                                                            $bulan_min_satu = '09';
                                                        }else if ($bulan == '11') {
                                                            $periode_min_satu = '10-'.$tahun-1;
                                                            $bulan_min_satu = '10';
                                                        }

                                                        // *cari penjualan produk bulan kemaren*/
    											    	$sql_penj = "SELECT
                                                        	SUM( jumlah ) AS jumlah_penjualan
                                                        FROM
                                                        	detail_penjualan_produk,
                                                        	produk,
                                                        	pemesanan_produk
                                                        WHERE
                                                        	produk.id = detail_penjualan_produk.produk
                                                        	AND detail_penjualan_produk.faktur = pemesanan_produk.id
                                                        	AND detail_penjualan_produk.produk = $id
                                                        	AND DATE_FORMAT( pemesanan_produk.tanggal, '%m' ) = '$bulan_min_satu'
                                                        	AND DATE_FORMAT( pemesanan_produk.tanggal, '%Y' ) = '$tahun'
                                                        GROUP BY
                                                        	DATE_FORMAT( pemesanan_produk.tanggal, '%m-%Y' ),
                                                        	detail_penjualan_produk.produk";
    											    	$res_penjualan = mysqli_query($conn,$sql_penj);
    											    	$row_penj = mysqli_fetch_assoc($res_penjualan);
    											    	$penjualan_bulan_kemaren[$i] = $row_penj['jumlah_penjualan'];

                                                        /*validasi peramalan, jika bulan sebelumnya tidak terdapat penjualan maka anggap penjualan = 0*/
                                                        if ($penjualan_bulan_kemaren[$i]=='' OR $penjualan_bulan_kemaren[$i]==null) {
                                                            $penjualan_bulan_kemaren[$i] = 0;
                                                        }

                                                        if ($i == 0) {
                                                            $peramalan_bulan_kemarin[$i] = 0;
                                                            /*hitung peramalan selanjutnya*/
        											    	$peramalan[$i] = ceil(($alpha*$penjualan_bulan_kemaren[$i])+((1-$alpha)*$peramalan_bulan_kemarin[$i]));

                                                        }else{

                                                            if ($peramalan[$i-1] == 0) {
                                                                $peramalan[$i] = $penjualan_bulan_kemaren[$i];
                                                            }else{
                                                                /*hitung peramalan selanjutnya*/
            											    	$peramalan[$i] = ceil(($alpha*$penjualan_bulan_kemaren[$i])+((1-$alpha)*$peramalan[$i-1]));
                                                            }
                                                        }
                                                        ?>
                                                        <tr class="bg-success">
    									                  	<td><?= $no++; ?></td>
    									                  	<td><?= $periode[$i] ?></td>
    									                  	<td><?= strtoupper($row_peramalan['kode']) ?></td>
    									                  	<td><?= ucwords($row_peramalan['nama']) ?></td>
    									                  	<td><?= ucwords($row_peramalan['jenis_kemasan']) ?></td>
    									                  	<!-- <td class="text-center">0 buah</td> -->
    									                  	<td class="text-center">
    									                  		<?php
    									                  		if ($peramalan[$i]==0) {
    									                  			echo "<span class='label label-warning'>tidak didapat diramalkan</span>";
    									                  		}else{
    									                  			echo $peramalan[$i].' buah';
    									                  		}
    									                  		?>
    									                  	</td>
    									                  	<!-- <td class="text-center">
    									                  		<?php
    									                  		if ($peramalan[$i]=='') {
    									                  			echo "-";
    									                  		}else{
    									                  			echo 'wkwkw';
    									                  		}
    									                  		?>
    									                  	</td> -->
    									                  	<!-- <td width="10%" class="text-center">
    									                  		<button class="btn btn-sm btn-success" title="Pengajuan Pembelian" data-toggle="modal" data-target="#modalPengajuan" onclick="return pengajuan('<?= $id ?>')"><i class="fa fa-file-text-o"></i></button>
    									                  	</td> -->
    									                </tr>
                                                        <?php

                                                        $i++;
                                                    }

											    }
											}
							                ?>

						                </tbody>
					              	</table>
					            </div>
			              		<!-- /.tab-pane -->
			              	</div>
			            </div>
		            </div>
		            <!-- /.tab-content -->
	              	<?php
	            } ?>
       		</div>
        	<!-- /.col -->
      	</div>
      	<!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<!-- Modal Pengajuan Pengadaan' -->
<div class="modal fade" id="modalPengajuan" role="dialog">
    <div class="modal-dialog modal-md">
      	<div class="modal-content">
        	<div class="modal-header">
	          	<button type="button" class="close" data-dismiss="modal">&times;</button>
	          	<h4 class="modal-title"><i class="fa fa-file-text-o"></i> Pengajuan Pengadaan</h4>
	        </div>
	       <form action="" method="post" accept-charset="utf-8" class="form-horizontal">
	        	<div class="modal-body">

	        		<!-- ID  -->
	        		<input type="hidden" name="id" id="id" class="form-control" placeholder="" required="">

		          	<p>Kirim Pengajuan Pengadaan kepada General Manager?</p>
		        </div>
		        <div class="modal-footer">
		          	<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
		          	<button type="submit" class="btn btn-success" name="kirim_pengajuan">Kirim Pengajuan</button>
		        </div>
	        </form>
    	</div>
	</div>
</div>


<script type="text/javascript">

	function pengajuan(id){
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
	        text: 'Pengajuan Pengadaan telah dikirim.',
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
