<title>Pembelian Bahan Baku</title>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 style="opacity: 1">
        Pembelian Bahan Baku
      </h1>
      <ol class="breadcrumb">
        <li><a href="?menu=beranda"><i class="fa fa-home"></i> Beranda</a></li>
        <li class="active">Pembelian Bahan Baku </li>
      </ol>
    </section>
	<!-- Main content -->
    <?php
    if (isset($_GET['detail'])) {
        $get_id = $_GET['detail'];

        $sql = "
        SELECT
            pembelian_bahan_baku.id,
            pembelian_bahan_baku.nomor_faktur,
            pembelian_bahan_baku.tanggal,
            pembelian_bahan_baku.status_pembelian,
            pembelian_bahan_baku.status_pembayaran,
            supplier.nama,
            supplier.waktu_pengiriman,
            supplier.alamat,
            DATE_FORMAT(tanggal, '%H:%i:%s') AS jam_pemesanan
        FROM
            pembelian_bahan_baku
        LEFT JOIN detail_pembelian_bahan_baku ON detail_pembelian_bahan_baku.faktur = pembelian_bahan_baku.id
        LEFT JOIN supplier ON pembelian_bahan_baku.supplier = supplier.id
        WHERE pembelian_bahan_baku.id='$get_id'
        ORDER BY
            tanggal DESC";
        $result = mysqli_query($conn, $sql);
        // keluarkan data dalam variabel row
        $row = mysqli_fetch_assoc($result);
        $id = $row['id'];
        $nomor_faktur = $row['nomor_faktur'];
        $status_pembelian = $row['status_pembelian'];
        $status_pembayaran = $row['status_pembayaran'];
        $tanggal = $row['tanggal'];
        $nama = $row['nama'];
        $alamat = $row['alamat'];
        $jam_pemesanan = $row['jam_pemesanan'];
        $jam_pembayaran = $row['jam_pembayaran'];

        if ($status_pembelian=='f') {
            $status_pembelian = '<label class="label label-danger">belum disetujui</label>';
        }else{
            $status_pembelian = '<label class="label label-success">sudah disetujui</label>';
        }

        if ($status_pembayaran=='f') {
            $status_pembayaran = '<label class="label label-danger">belum dibayar</label>';
        }else{
            $status_pembayaran = '<label class="label label-success">sudah dibayar</label>';
        } ?>

        <section class="invoice">
          <!-- title row -->
          <div class="row">
            <div class="col-xs-12">
              <h2 class="page-header">
                <i class="fa fa-file-text-o"></i> Faktur Pembelian.
                <small class="pull-right">Tanggal: <?= Tanggal($tanggal) ?></small>
              </h2>
            </div>
            <!-- /.col -->
          </div>
          <!-- info row -->
          <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
              Kepada
              <address>
                <strong>CV.Mutiara Timur.</strong><br>
                Cianjur<br>
                <!-- Telp: (804) 123-5432<br> -->
                <!-- Email: info@almasaeedstudio.com -->
              </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
              Dari
              <address>
                <strong><?= $nama ?></strong><br>
                <?= $alamat ?>
              </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
              <b>No. Faktur : <?= $nomor_faktur ?></b><br>
              <br>
              <b>Tgl Pembayaran:</b> <?= Tanggal($tanggal_pembayaran) ?><br>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

            <?php
            $sql = "SELECT
                	bb.kode,
                	bb.nama,
                	dpbb.harga,
                	dpbb.jumlah,
                	dpbb.satuan
                FROM
                	detail_pembelian_bahan_baku dpbb
                LEFT JOIN bahan_baku bb ON bb.id = dpbb.bahan_baku
                WHERE dpbb.faktur='$get_id'";
            $result = mysqli_query($conn, $sql);

          ?>
          <!-- Table row -->
          <div class="row">
            <div class="col-xs-12 table-responsive">
              <table class="table table-striped">
                <thead>
                <tr>
                  <th>Qty</th>
                  <th>Barang</th>
                  <th>Harga</th>
                  <th>Satuan</th>
                  <th>Subtotal</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                    $no=1;
                    $total = 0;
                    while ($row=mysqli_fetch_assoc($result)) {
                        $kode = $row['kode'];
                        $nama = $row['nama'];
                        $harga = $row['harga'];
                        $jumlah = $row['jumlah'];
                        $satuan = $row['satuan'];

                        $total = $total + ($jumlah*$harga);
                        ?>

                        <tr>
                          <td><?= $jumlah ?></td>
                          <td><?= $kode.' - '.$nama ?></td>
                          <td><?= Rupiah($harga) ?></td>
                          <td><?= $satuan ?></td>
                          <td><?= Rupiah($jumlah*$harga) ?></td>
                        </tr>

                        <?php
                    }
                    ?>
                </tbody>
              </table>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

          <div class="row">
            <!-- accepted payments column -->
            <div class="col-xs-6">

              <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                Terima kasih sudah melakukan pembelian di perusahaan kami.<br /><br /><strong>CV.Mutiara Timur</strong>
              </p>
            </div>
            <!-- /.col -->
            <div class="col-xs-6">
              <p class="lead">Dibayar <?= Tanggal($tanggal_pembayaran) ?></p>

              <div class="table-responsive">
                <table class="table">
                  <!-- <tr>
                    <th style="width:50%">Subtotal:</th>
                    <td>$250.30</td>
                  </tr>
                  <tr>
                    <th>Tax (9.3%)</th>
                    <td>$10.34</td>
                  </tr>
                  <tr>
                    <th>Shipping:</th>
                    <td>$5.80</td>
                  </tr> -->
                  <tr>
                    <th>Total:</th>
                    <td>Rp.<?= Rupiah($total) ?></td>
                  </tr>
                </table>
              </div>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

          <!-- this row will not appear when printing -->
          <!-- <div class="row no-print">
            <div class="col-xs-12">
              <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
              <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment
              </button>
              <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
                <i class="fa fa-download"></i> Generate PDF
              </button>
            </div>
          </div> -->
        </section>
        <?php
    }else{
        ?>
        <section class="content">
          	<div class="row">
            	<div class="col-xs-12">
            		<div class="nav-tabs-custom">
    		            <ul class="nav nav-tabs pull-right">
    		              	<li class="active"><a href="" data-toggle="modal" data-target="#modalTambah" class="text-bold"><i class="fa fa-plus text-success"></i> Tambah</a></li>
    		              	<li class="active"><a href="#tab_2-2" data-toggle="tab">Daftar Pembelian</a></li>
    		            </ul>
    		            <div class="tab-content">
    		              	<div class="tab-pane active" id="tab_2-2">
    			            	<table id="example1" class="table table-striped table-bordered dt-responsive nowrap">
    				                <thead>
    				                <tr class="bg-success">
    				                  	<th width="5%">No</th>
    				                  	<th>Nomor Faktur</th>
    				                  	<th>Supplier</th>
    				                  	<th>Tanggal Pembelian</th>
    				                  	<th class="text-center">Status Pembelian</th>
    				                  	<th class="text-center">Status Pembayaran</th>
    				                  	<th></th>
    				                </tr>
    				                </thead>
    				                <tbody>

    					                <?php
    					                $sql = "
                                        SELECT
                                        	pembelian_bahan_baku.id,
                                        	pembelian_bahan_baku.nomor_faktur,
                                        	pembelian_bahan_baku.tanggal,
                                        	pembelian_bahan_baku.status_pembelian,
                                        	pembelian_bahan_baku.status_pembayaran,
                                        	supplier.nama,
                                        	supplier.waktu_pengiriman,
                                        	DATE_FORMAT(tanggal, '%H:%i:%s') AS jam_pemesanan
                                        FROM
                                        	pembelian_bahan_baku
                                        LEFT JOIN detail_pembelian_bahan_baku ON detail_pembelian_bahan_baku.faktur = pembelian_bahan_baku.id
                                        LEFT JOIN supplier ON pembelian_bahan_baku.supplier = supplier.id
                                        GROUP BY 1,2,3,4,5,6,7,8
                                        ORDER BY
                                        	tanggal DESC";
    									$result = mysqli_query($conn, $sql);

    									if (mysqli_num_rows($result) > 0) {
    										$no = 1;
    									    // keluarkan data dalam variabel row
    									    while($row = mysqli_fetch_assoc($result)) {
    									    	$id = $row['id'];
    									    	$nomor_faktur = $row['nomor_faktur'];
    									    	$status_pembelian = $row['status_pembelian'];
    									    	$status_pembayaran = $row['status_pembayaran'];
    									    	$tanggal = $row['tanggal'];
    									    	$nama = $row['nama'];
    									    	$jam_pemesanan = $row['jam_pemesanan'];
    									    	$jam_pembayaran = $row['jam_pembayaran'];

    									    	if ($status_pembelian=='f') {
    									    		$status_pembelian = '<label class="label label-danger">belum disetujui</label>';
    									    	}else{
    									    		$status_pembelian = '<label class="label label-success">sudah disetujui</label>';
    									    	}

                                                if ($status_pembayaran=='f') {
    									    		$status_pembayaran = '<label class="label label-danger">belum dibayar</label>';
    									    	}else{
    									    		$status_pembayaran = '<label class="label label-success">sudah dibayar</label>';
    									    	}
    									    	?>
    									        <tr>
    							                  	<td><?= $no++; ?></td>
    							                  	<td><?= strtoupper($row['nomor_faktur']) ?></td>
    							                  	<td><?= strtoupper($row['nama']) ?></td>
    							                  	<td><?= Tanggal($row['tanggal']) ?></td>
    							                  	<td class="text-center"><?= $status_pembelian ?></td>
    							                  	<td class="text-center"><?= $status_pembayaran ?></td>
    							                  	<td width="10%" class="text-center">
    							                  		<a class="btn btn-sm btn-default" title="Detail Pembelian" href="?menu=pembelian-bahan-baku&detail=<?= $id ?>"><i class="fa fa-file-text-o"></i></a>
    							                  	</td>
    							                </tr>
    									        <?php
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
        <?php
    } ?>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" role="dialog">
    <div class="modal-dialog modal-lg">
      	<div class="modal-content">
        	<div class="modal-header">
	          	<button type="button" class="close" data-dismiss="modal">&times;</button>
	          	<h4 class="modal-title"><i class="fa fa-plus text-success"></i> Tambah Pembelian Bahan Baku</h4>
	        </div>
	        <form action="" method="post" accept-charset="utf-8" class="form-horizontal">
	        	<div class="modal-body">

	                <div class="form-group">
	                  	<div class="col-sm-8">
	                  		<label for="inputBArang">Supplier</label>
	                  		<div class="input-group">
				                <span class="input-group-addon"><i class="fa fa-user"></i></span>
				                <select class="form-control select2" style="width: 100%;" name="supplier" id="supplier" required="">
				                	<?php
				                	$sql = "SELECT id, nama FROM supplier ORDER BY nama ASC";
				                	$result = mysqli_query($conn, $sql);
				                	$i=0;
				                	while ($row=mysqli_fetch_assoc($result)) {
				                		?>
				                		<option value="<?= $row['id'] ?>"><?= strtoupper($row['nama']) ?></option>
				                		<?php
				                	}
				                	?>
				                </select>
				            </div>
				        </div>
				        <div class="col-sm-4">
				        	<label for="inputBArang">Metode Pembayaran</label>
	                  		<div class="input-group">
				                <span class="input-group-addon"><i class="fa fa-money"></i></span>
				                <select class="form-control select" style="width: 100%;" name="metode_pembayaran" id="metode_pembayaran" required="">
				                	<option value="cash">Cash</option>
				                	<!-- <option value="jatuh tempo">Jatuh Tempo</option> -->
				                </select>
				            </div>
				        </div>
	                </div>
	                <label for="inputBArang">Barang</label>
	                <div class="form-group after-add-more">
	                  	<div class="col-sm-8">
	                  		<div class="input-group">
				                <span class="input-group-addon"><i class="fa fa-cubes"></i></span>
				                <select class="form-control select" style="width: 100%;" name="bahan_baku[]" id="bahan_baku[]" required="">
				                	<?php
				                	$sql = "SELECT
                                            	bb.id,
                                            	bb.kode,
                                            	bb.nama,
                                            	ds.id_supplier,
                                            	ds.jenis,
                                            	ds.harga,
                                            	ds.satuan,
                                            	s.nama as nama_supplier
                                            FROM
                                            	bahan_baku bb
                                            LEFT JOIN detail_supplier ds ON ds.jenis = bb.id
                                            LEFT JOIN supplier s ON s.id = ds.id_supplier
                                            ORDER BY
                                            	bb.nama";
				                	$result = mysqli_query($conn, $sql);
				                	$i=0;
				                	while ($row=mysqli_fetch_assoc($result)) {
				                		?>
				                		<option value="<?= $row['id'] ?>"><?= strtoupper($row['kode']).' - '.ucwords($row['nama']).' (satuan '.$row['satuan'].')' ?></option>
				                		<?php
				                	}
				                	?>
				                </select>
				            </div>
				        </div>
				        <div class="col-sm-4">
		                  	<div class="input-group">
				                <input type="number" name="jumlah[]" id="jumlah[]" class="form-control" placeholder="Jumlah" min="1" required="">
				                <div class="input-group-btn">
				                	<button class="btn btn-success add-more" type="button"><i class="fa fa-plus"></i></button>
				            	</div>
				            </div>
				        </div>
	                </div>

		        </div>
		        <div class="modal-footer">
		          	<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
		          	<button type="submit" class="btn btn-success" name="simpan_pemesanan">Simpan</button>
		        </div>
	        </form>
    	</div>
	</div>
</div>

<!-- Tambahkan inputan (append) di Form Tambah-->
<div class="copy hide">
	<div class="form-group control-group">
		<div class="col-sm-8">
      		<div class="input-group">
                <span class="input-group-addon"><i class="fa fa-cubes"></i></span>
                <select class="form-control select" style="width: 100%;" name="bahan_baku[]" id="bahan_baku[]" required="">
                    <?php
                    $sql = "SELECT
                                bb.id,
                                bb.kode,
                                bb.nama,
                                ds.id_supplier,
                                ds.jenis,
                                ds.harga,
                                ds.satuan,
                                s.nama as nama_supplier
                            FROM
                                bahan_baku bb
                            LEFT JOIN detail_supplier ds ON ds.jenis = bb.id
                            LEFT JOIN supplier s ON s.id = ds.id_supplier
                            ORDER BY
                                bb.nama";
                    $result = mysqli_query($conn, $sql);
                    $i=0;
                    while ($row=mysqli_fetch_assoc($result)) {
                        ?>
                        <option value="<?= $row['id'] ?>"><?= strtoupper($row['kode']).' - '.ucwords($row['nama']).' (satuan '.$row['satuan'].')' ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="col-sm-4">
          	<div class="input-group">
                <input type="number" name="jumlah[]" id="jumlah[]" class="form-control" placeholder="Jumlah" min="1" required="">
                <!-- <span class="input-group-addon">buah</span> -->
                <div class="input-group-btn">
              		<button class="btn btn-danger remove" type="button"><i class="fa fa-trash"></i></button>
            	</div>
            </div>
        </div>
  		<label for="inputJenis" class="col-sm-3"></label>
    </div>
</div>

<!-- Modal Ubah -->
<div class="modal fade" id="modalUbah" role="dialog">
    <div class="modal-dialog modal-lg">
      	<div class="modal-content">
        	<div class="modal-header bg-yellow">
	          	<button type="button" class="close" data-dismiss="modal">&times;</button>
	          	<h4 class="modal-title"><i class="fa fa-edit text-yellow"></i> Ubah Data</h4>
	        </div>
	        <form action="" method="post" accept-charset="utf-8" class="form-horizontal">
	        	<div class="modal-body">

	        		<!-- ID  -->
	        		<input type="hidden" name="id" id="id" class="form-control" placeholder="" required="">

		          	<label for="inputBarang">Data Barang Masuk</label>
	                <div class="form-group">
	                  	<div class="col-sm-9">
	                  		<div class="input-group">
				                <span class="input-group-addon"><i class="fa fa-cubes"></i></span>
				                <select class="form-control select" style="width: 100%;" name="u_bahan_baku" id="u_bahan_baku" required="">
				                	<?php
				                	$sql = "SELECT id, kode, nama, jenis_kemasan, satuan FROM produk";
				                	$result = mysqli_query($conn, $sql);
				                	while ($row=mysqli_fetch_assoc($result)) {
				                		?>
				                		<option value="<?= $row['id'] ?>"><?= strtoupper($row['kode']).' - '.ucwords($row['nama']).' '.$row['jenis_kemasan'].' (satuan '.$row['satuan'].')' ?></option>
				                		<?php
				                	}
				                	?>
				                </select>
				            </div>
				        </div>
				        <div class="col-sm-3">
		                  	<div class="input-group">
				                <input type="number" name="u_jumlah" id="u_jumlah" class="form-control" placeholder="Jumlah" min="1" required="">
				            	<span class="input-group-addon">buah</span>
				            </div>
				        </div>
	                </div>
		        </div>
		        <div class="modal-footer">
		          	<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
		          	<button type="submit" class="btn btn-warning" name="ubah_barang_masuk">Simpan Perubahan</button>
		        </div>
	        </form>
    	</div>
	</div>
</div>

<!-- Modal Hapus' -->
<div class="modal fade" id="modalHapus" role="dialog">
    <div class="modal-dialog modal-md">
      	<div class="modal-content">
        	<div class="modal-header">
	          	<button type="button" class="close" data-dismiss="modal">&times;</button>
	          	<h4 class="modal-title"><i class="fa fa-trash text-red"></i> Hapus Data</h4>
	        </div>
	       <form action="" method="post" accept-charset="utf-8" class="form-horizontal">
	        	<div class="modal-body">

	        		<!-- ID  -->
	        		<input type="hidden" name="id" id="id" class="form-control" placeholder="" required="">

		          	<p>Apakah anda yakin akan menghapus data ini?</p>
		        </div>
		        <div class="modal-footer">
		          	<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
		          	<button type="submit" class="btn btn-danger" name="hapus_barang_masuk">Hapus</button>
		        </div>
	        </form>
    	</div>
	</div>
</div>

<!-- Modal Persetujuan' -->
<div class="modal fade" id="modalKonfirmasi" role="dialog">
    <div class="modal-dialog modal-md">
      	<div class="modal-content">
        	<div class="modal-header">
	          	<button type="button" class="close" data-dismiss="modal">&times;</button>
	          	<h4 class="modal-title"><i class="fa fa-check text-success"></i> Konfirmasi</h4>
	        </div>
	       <form action="" method="post" accept-charset="utf-8" class="form-horizontal">
	        	<div class="modal-body">

	        		<!-- ID  -->
	        		<input type="hidden" name="id" id="id" class="form-control" placeholder="" required="">

		          	<p>Konfirmasi penerimaan PO?</p>
		        </div>
		        <div class="modal-footer">
		          	<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
		          	<button type="submit" class="btn btn-success" name="terima_po">Terima</button>
		        </div>
	        </form>
    	</div>
	</div>
</div>

<!-- Modal Detail PO -->
<div class="modal fade" id="modalDetailPO" role="dialog">
    <div class="modal-dialog modal-lmd">
      	<div class="modal-content">
        	<div class="modal-header bg-default">
	          	<button type="button" class="close" data-dismiss="modal">&times;</button>
	          	<h2 class="modal-title text-center">Purchase Order</h2>
	        </div>
	        <form action="" method="post" accept-charset="utf-8" class="form-horizontal">
	        	<div class="modal-body">
	        		<!-- ID  -->
	        		<input type="hidden" name="id" id="id" class="form-control" placeholder="" required="">
	        		<input type="hidden" name="tanggal" id="tanggal" class="form-control" placeholder="" required="">
	        		<div id="detail_pemesanan"></div>
		        </div>
		        <br/><br/><br/><br/>
		        <div id='html_footer'></div>
	        </form>
    	</div>
	</div>
</div>



<script type="text/javascript">

	function ubah(id, bahan_baku, status, jumlah){
		$('.modal-body input[name=id]').val(id);
		$('.modal-body select[name=u_bahan_baku]').val(bahan_baku);
		$('.modal-body input[name=u_status]').val(status);
		$('.modal-body input[name=u_jumlah]').val(jumlah);
		if(status=="masuk"){
			var input = "<input type='radio' name='u_status' id='u_status' class='flat-red' value='masuk' checked><b class='text-success'>MASUK</b><input type='radio' name='u_status' id='u_status' class='flat-red' value='keluar'><b class='text-danger'>KELUAR</b>"
		}else{
			var input = "<input type='radio' name='u_status' id='u_status' class='flat-red' value='masuk'><b class='text-success'>MASUK</b><input type='radio' name='u_status' id='u_status' class='flat-red' value='keluar' checked><b class='text-danger'>KELUAR</b>"
		}
		document.getElementById("input").innerHTML = input;
	}

	function hapus(id){
		$('.modal-body input[name=id]').val(id);
	}

	function konfirmasi(id){
		$('.modal-body input[name=id]').val(id);
	}

	function detail_pemesanan(id, nomor_faktur, tanggal_pembayaran, metode_pembayaran, tanggal, nama, kode, jam_pemesanan, jam_pembayaran, status_po) {
		document.cookie = "cookie_id="+id;
		document.cookie = "cookie_status_po="+status_po;

		$('.modal-body input[name=id]').val(id);
		$('.modal-body input[name=tanggal]').val(tanggal);

		<?php
		$id_po = $_COOKIE['cookie_id'];
		$status_po = $_COOKIE['cookie_status_po'];
		$sql_detail = "SELECT
                        	dpp.produk,
                        	dpp.jumlah,
                        	dpp.harga,
                        	p.kode AS kode_barang,
                        	p.nama AS nama_barang
                        FROM
                        	produk p,
                        	detail_penjualan_produk dpp
                        WHERE
                        	dpp.produk = p.id
                        AND dpp.faktur = '$id_po'";
    	$result_detail = mysqli_query($conn, $sql_detail);
    	$jumlah_barang = mysqli_num_rows($result_detail);
    	$i=0;
    	while($row_detail = mysqli_fetch_assoc($result_detail)){
	    	$bahan_baku[$i] = $row_detail['bahan_baku'];
	    	$jumlah[$i] = $row_detail['jumlah'];
	    	$harga[$i] = $row_detail['harga'];
	    	$kode_barang[$i] = $row_detail['kode_barang'];
	    	$nama_barang[$i] = $row_detail['nama_barang'];
    		$i++;
    	}
    	?>

		var html_po =
		"<div class='col-md-12'>" +
			"<table class='table table-responsive'>" +
				"<tr>" +
					"<td class='text-bold'>Nomor PO</td>" +
					"<td>: "+ nomor_faktur +"</td>" +
					"<td class='text-bold'>Tgl PO</td>" +
					"<td>: "+ tanggal +"</td>" +
				"</tr>" +
				"<tr>" +
					"<td class='text-bold'>Supplier</td>" +
					"<td>: "+ kode + " " + nama +"</td>" +
					"<td class='text-bold'>Tgl Pembayaran</td>" +
					"<td>: "+ tanggal_pembayaran +"</td>" +
				"</tr>" +
				"<tr>" +
					"<td class='text-bold'>Pembayaran</td>" +
					"<td>: "+ metode_pembayaran +"</td>" +
					"<td></td>" +
					"<td></td>" +
				"</tr>" +
			"</table>" +
		"</div>"+
		"<div class='col-md-12'>" +
			"<table class='table table-responsive'>" +
				"<tr>" +
					"<th width='5%'>No</th>" +
					"<th>Barang</th>" +
					"<th>Qty</th>" +
					"<th>Harga</th>" +
					"<th>Sub Total</th>" +
				"</tr>" +

				<?php
				$i=0;
				$no=1;
				while ($i < $jumlah_barang) {
					$sub_total[$i] = $jumlah[$i]*$harga[$i];
					$grand_total = $grand_total + $sub_total[$i];
					?>
					"<tr>" +
						"<td><?= ''.$no++ ?></td>" +
						"<td><?= ''.$nama_barang[$i] ?></td>" +
						"<td><?= ''.$jumlah[$i] ?></td>" +
						"<td><?= ''.$harga[$i] ?></td>" +
						"<td>Rp.<?= ''.$sub_total[$i] ?></td>" +
					"</tr>" +
					<?php
					$i++;
				}
				?>

				"<tr>" +
					"<td colspan='4'class='text-right text-bold'>TOTAL</td>" +
					"<td class='text-bold'>Rp. <?= ''.$grand_total ?></td>" +
				"</tr>" +
			"</table>" +
		"</div>"

		document.getElementById("detail_pemesanan").innerHTML = html_po;

		var html_footer =
		"<div class=''>" +
        	"<table class='table table-responsive'>" +
        	"<tr>" +
          		"<td class='text-right'>" +
          			"<button type='button' class='btn btn-default' data-dismiss='modal'>Tutup</button>" +
          			"<a href='?menu=detail-pemesanan-produk' class='btn btn-primary'>Detail</a>" +
          			<?php if ($status_po=='belum disetujui'){ ?>
          				"<button type='submit' class='btn btn-success' name='terima_po'>Terima</button>" +
          			<?php }else{ ?>
          				"<button type='button' class='btn btn-primary' disabled>Sudah disetujui</button>" +
          			<?php } ?>
          		"</td>" +
        	"</tr>" +
        	"</table>" +
        "</div>"

        document.getElementById("html_footer").innerHTML = html_footer;
	}

	$(document).ready(function() {

      	$(".add-more").click(function(){
          	var html = $(".copy").html();
          	$(".after-add-more").after(html);
      	});

      	$("body").on("click",".remove",function(){
          	$(this).parents(".control-group").remove();
      	});

    });

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    });
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
