<title>Detail Barang</title>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 style="opacity: 0">
        .
      </h1>
      <ol class="breadcrumb">
        <li><a href="?menu=beranda"><i class="fa fa-home"></i> Beranda</a></li>
        <li><a href="?menu=produk"><i class="fa fa-cube"></i> Produk</a></li>
        <li class="active">Detail</li>
      </ol>
    </section>
	<!-- Main content -->
    <section class="content">
      	<div class="row">
        	<div class="col-xs-12">
        		<!-- Custom Tabs (Pulled to the right) -->
		        <div class="nav-tabs-custom">
		            <ul class="nav nav-tabs pull-right">
		              	<li><a href="?menu=produk" class="text-bold"><i class="fa fa-arrow-left text-black"></i> Kembali</a></li>
		              	<li class="active"><a href="#tab_2-2" data-toggle="tab">Detail Barang</a></li>
		              	<!-- <li class="dropdown">
		                	<a class="dropdown-toggle" data-toggle="dropdown" href="#">
		                  		Dropdown <span class="caret"></span>
		                	</a>
		                	<ul class="dropdown-menu">
			                  	<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a></li>
			                  	<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
			                  	<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a></li>
			                  	<li role="presentation" class="divider"></li>
			                  	<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Separated link</a></li>
		                	</ul>
		              	</li> -->
		             	<li class="pull-left header"><i class="fa fa-file-text-o"></i> Detail Barang</li>
		            </ul>
		            <div class="tab-content">
		              	<div class="tab-pane active" id="tab_2-2">
		                	<table id="example1" class="table table-striped table-bordered dt-responsive nowrap">
				                <thead>
				                <tr class="bg-success">
				                  	<th width="5%">No</th>
				                  	<th>Barang</th>
				                  	<th>Kemasan</th>
				                  	<th width="10%">Stok</th>
				                  	<th>Tanggal Kadaluarsa</th>
				                  	<th class="text-center" width="10%">Status</th>
				                </tr>
				                </thead>
				                <tbody>

					                <?php
					                $id = $_GET['id'];
					                $sql = "SELECT kode, nama, jenis_kemasan, satuan, SUM(stok) as stok, tanggal_kadaluarsa FROM produk, detail_produk WHERE produk.id=detail_produk.id_produk AND id='$id' GROUP BY tanggal_kadaluarsa";
									$result = mysqli_query($conn, $sql);

									if (mysqli_num_rows($result) > 0) {
										$no = 1;
									    // keluarkan data dalam variabel row
									    while($row = mysqli_fetch_assoc($result)) {
									    	$kode = $row['kode'];
									    	$nama = $row['nama'];
									    	$jenis_kemasan = $row['jenis_kemasan'];
									    	$satuan = $row['satuan'];
									    	$stok = $row['stok'];
									    	$tanggal_kadaluarsa = $row['tanggal_kadaluarsa'];

									    	/*total stok*/
									    	$total_persediaan = $total_persediaan + $row['stok'];

									    	if ($stok > 0) {
									    		/*cek status kadaluarsa barang*/
												if (date('Y-m-d', strtotime($tanggal_kadaluarsa)) >= date('Y-m-d')) {
													$status = '<span class="label label-success">aman</span>';
												}else{
													$status = '<span class="label label-danger">kadaluarsa</span>';
												}
										        ?>
										        <tr>
								                  	<td><?= $no++; ?></td>
								                  	<td><?= strtoupper($row['kode']).' - '.ucwords($row['nama']) ?></td>
								                  	<td><?= strtolower($row['jenis_kemasan']) ?></td>
								                  	<td><?= $row['stok'].' '.strtolower($row['satuan']) ?></td>
								                  	<td><?= Tanggal($row['tanggal_kadaluarsa']) ?></td>
								                  	<td class="text-center"><?= $status ?></td>
								                </tr>
										        <?php
									    	}
									    }
									}
					                ?>
				                
				                </tbody>
				                <tfoot>
				                	<tr>
				                		<th colspan="3" rowspan="" headers="" scope="" class="text-center">TOTAL STOK</th>
				                		<th colspan="3" rowspan="" headers="" scope=""><?= $total_persediaan.' '.strtolower($satuan) ?></th>
				                	</tr>
				                </tfoot>
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