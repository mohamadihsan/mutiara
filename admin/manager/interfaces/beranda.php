<?php  

/*jumlah seluruh pelanggan*/
$sql = "
SELECT COUNT(*) as jumlah_seluruh_pelanggan 
FROM pelanggan
";
$result = mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$jumlah_seluruh_pelanggan = $row['jumlah_seluruh_pelanggan'];

/*jumlah seluruh pegawai*/
$sql = "
SELECT COUNT(*) as jumlah_seluruh_pegawai 
FROM pegawai
";
$result = mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$jumlah_seluruh_pegawai = $row['jumlah_seluruh_pegawai'];

/*jumlah seluruh produk*/
$sql = "
SELECT COUNT(*) as jumlah_seluruh_barang 
FROM produk
";
$result = mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$jumlah_seluruh_barang = $row['jumlah_seluruh_barang'];

/*jumlah seluruh supplier*/
$sql = "
SELECT COUNT(*) as jumlah_seluruh_supplier 
FROM supplier
";
$result = mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$jumlah_seluruh_supplier = $row['jumlah_seluruh_supplier'];

?>


<title>Beranda</title>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<div class="row">
        <div class="jumbotron jumbotron-fluid">
			<div class="container">
				
		        <div class="col-md-3 col-sm-6 col-xs-12">
		          	<div class="info-box bg-blue">
		            	<span class="info-box-icon"><i class="fa fa-users fa-2x"></i></span>

		            	<div class="info-box-content">
		              		<span class="info-box-text">Pegawai</span>
		              		<span class="info-box-number"><?= $jumlah_seluruh_pegawai ?></span>

		              		<div class="progress">
		                		<div class="progress-bar" style="width: 70%"></div>
		              		</div>
		                  	<span class="progress-description">
		                    	orang
		                  	</span>
		            	</div>
		            	<!-- /.info-box-content -->
		          	</div>
		          	<!-- /.info-box -->
		        </div>
		        <!-- /.col -->
	        <div class="col-md-3 col-sm-6 col-xs-12">
	          	<div class="info-box bg-green">
		            	<span class="info-box-icon"><i class="fa fa-cube fa-2x"></i></span>

		            	<div class="info-box-content">
		              		<span class="info-box-text">Barang/Produk</span>
		              		<span class="info-box-number"><?= $jumlah_seluruh_barang ?></span>

		              		<div class="progress">
		                		<div class="progress-bar" style="width: 70%"></div>
		              		</div>
		                	<span class="progress-description">
		                    	jenis
		                	</span>
		            	</div>
		            	<!-- /.info-box-content -->
		          	</div>
		          	<!-- /.info-box -->
		        </div>
		        <!-- /.col -->
		        <div class="col-md-3 col-sm-6 col-xs-12">
		          	<div class="info-box bg-red">
		            	<span class="info-box-icon"><i class="fa fa-building fa-2x"></i></span>

		            	<div class="info-box-content">
		              		<span class="info-box-text">Supplier</span>
		              		<span class="info-box-number"><?= $jumlah_seluruh_supplier ?></span>

		              		<div class="progress">
		                		<div class="progress-bar" style="width: 70%"></div>
		              		</div>
		                  	<span class="progress-description">
		                    	supplier
		                  	</span>
		            	</div>
		            	<!-- /.info-box-content -->
		          	</div>
		          	<!-- /.info-box -->
		        </div>
		        <!-- /.col -->
		        <div class="col-md-3 col-sm-6 col-xs-12">
		          	<div class="info-box bg-yellow">
		            	<span class="info-box-icon"><i class="fa fa-user fa-2x"></i></span>

		            	<div class="info-box-content">
		              		<span class="info-box-text">Pelanggan</span>
		              		<span class="info-box-number"><?= $jumlah_seluruh_pelanggan ?></span>

		              		<div class="progress">
		                		<div class="progress-bar" style="width: 70%"></div>
		              		</div>
		                  	<span class="progress-description">
		                    	orang
		                  	</span>
		            	</div>
		            	<!-- /.info-box-content -->
		          	</div>
		          	<!-- /.info-box -->
		        </div>
    			<!-- /.col -->
    			<div class="col-md-12">
		          	<div class="box box-warning">
		            	<div class="box-header">
		              		<h3 class="box-title text-bold">Penjualan Produk</h3>

		              		<div class="box-tools pull-right">
		                		<!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
		              		</div>
		              		<!-- /.box-tools -->
		            	</div>
		            	<!-- /.box-header -->
		            	<div class="box-body">
	              			<font class='text-warning'> Penjualan produk bulan sekarang dibandingkan dengan hasil penjualan produk bulan kemarin.</font><br>
	              			<table class="table table-responsive" width="40%">
	              				<thead>
	              					<tr>
	              						<th width="5%">No</th>
	              						<th width="30%">Bulan Ini</th>
	              						<th>Bulan Sebelumnya</th>
	              					</tr>
	              				</thead>
	              				<tbody>
	              					<tr>
	              						<td>1</td>
	              						<td>800 Kecap Botol</td>
	              						<td>1000 Kecap Botol</td>
	              					</tr>
	              					<tr>
	              						<td>2</td>
	              						<td>520 Kecap Plastik</td>
	              						<td>890 Kecap Plastik</td>
	              					</tr>
	              				</tbody>
	              			</table>

	              			<a href="?menu=laporan-penjualan" class="btn btn-xs btn-default" title="">Lihat</a>
		              			
		            	</div>
		            	<!-- /.box-body -->
		          	</div>
		          	<!-- /.box -->
		        </div>
			</div>
		</div>
	</div>  
</div>
<!-- /.content-wrapper -->