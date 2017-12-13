<?php  

/*inisialisais*/
$hari_ini = date('Y-m-d');

/*jumlah pemesanan produk hari ini*/
$sql = "
SELECT COUNT(*) as jumlah_pemesanan_hari_ini 
FROM pemesanan_produk
WHERE DATE_FORMAT(tanggal, '%Y-%m-%d')='$hari_ini'
";
$result = mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$jumlah_pemesanan_hari_ini = $row['jumlah_pemesanan_hari_ini'];


/*jumlah retur produk hari ini*/
$sql = "
SELECT COUNT(*) as jumlah_retur_barang_hari_ini 
FROM retur_penjualan
WHERE DATE_FORMAT(tanggal, '%Y-%m-%d')='$hari_ini'
";
$result = mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$jumlah_retur_barang_hari_ini = $row['jumlah_retur_barang_hari_ini'];

/*jumlah seluruh pelanggan*/
$sql = "
SELECT COUNT(*) as jumlah_seluruh_pelanggan 
FROM pelanggan
";
$result = mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$jumlah_seluruh_pelanggan = $row['jumlah_seluruh_pelanggan'];

/*jumlah jadwal Pengiriman hari ini*/
$sql = "
SELECT COUNT(*) as jumlah_jadwal_pengiriman_barang_hari_ini 
FROM distribusi
WHERE DATE_FORMAT(tanggal, '%Y-%m-%d')='$hari_ini'
";
$result = mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$jumlah_jadwal_pengiriman_barang_hari_ini = $row['jumlah_jadwal_pengiriman_barang_hari_ini'];

?>

<title>Beranda</title>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<div class="row">
        <div class="jumbotron jumbotron-fluid">
			<div class="container">
				<center>
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
		        <div class="col-md-3 col-sm-6 col-xs-12">
		          	<div class="info-box bg-green">
		            	<span class="info-box-icon"><i class="fa fa-shopping-cart fa-2x"></i></span>

		            	<div class="info-box-content">
		              		<span class="info-box-text">Pemesanan Produk</span>
		              		<span class="info-box-number"><?= $jumlah_pemesanan_hari_ini ?></span>

		              		<div class="progress">
		                		<div class="progress-bar" style="width: 70%"></div>
		              		</div>
		                  	<span class="progress-description">
		                    	pesanan (hari ini)
		                  	</span>
		            	</div>
		            	<!-- /.info-box-content -->
		          	</div>
		          	<!-- /.info-box -->
		        </div>
		        <!-- /.col -->
		        <div class="col-md-3 col-sm-6 col-xs-12">
		          	<div class="info-box bg-red">
		            	<span class="info-box-icon"><i class="fa fa-mail-reply fa-2x"></i></span>

		            	<div class="info-box-content">
		              		<span class="info-box-text">Retur Barang</span>
		              		<span class="info-box-number"><?= $jumlah_retur_barang_hari_ini ?></span>

		              		<div class="progress">
		                		<div class="progress-bar" style="width: 70%"></div>
		              		</div>
		                  	<span class="progress-description">
		                    	retur (hari ini)
		                  	</span>
		            	</div>
		            	<!-- /.info-box-content -->
		          	</div>
		          	<!-- /.info-box -->
		        </div>
		        <!-- /.col -->
			
		        <div class="col-md-3 col-sm-6 col-xs-12">
		          	<div class="info-box bg-blue">
		            	<span class="info-box-icon"><i class="fa fa-truck fa-2x"></i></span>

		            	<div class="info-box-content">
		              		<span class="info-box-text">Jadwal Pengiriman</span>
		              		<span class="info-box-number"><?= $jumlah_jadwal_pengiriman_barang_hari_ini ?></span>

		              		<div class="progress">
		                		<div class="progress-bar" style="width: 70%"></div>
		              		</div>
		                	<span class="progress-description">
		                    	pesanan (hari ini)
		                	</span>
		            	</div>
		            	<!-- /.info-box-content -->
		          	</div>
		          	<!-- /.info-box -->
		        </div>
		        <!-- /.col -->
		        </center>
		        <div class="col-md-12">
		          	<div class="box box-warning">
		            	<div class="box-header">
		              		<h3 class="box-title text-bold">Ketesediaan Barang/Produk</h3>

		              		<div class="box-tools pull-right">
		                		<!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
		              		</div>
		              		<!-- /.box-tools -->
		            	</div>
		            	<!-- /.box-header -->
		            	<div class="box-body">
		              		<?php  
		              		if ($jumlah_produk_kosong>0) {
		              			echo "<font class='text-warning'> Ada ".$jumlah_produk_kosong.' jenis barang/produk yang stock out </font>';
		              			?>
		              			<a href="?menu=barang" class="btn btn-xs btn-default" title="">Lihat</a>
		              			<?php
		              		}else{
		              			echo "<font class='text-success'>Stok semua jenis barang/produk lebih dari 0</font>";
		              		}
		              		?>
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