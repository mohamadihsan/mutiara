<?php  

/*jumlah seluruh produk*/
$sql = "
SELECT COUNT(*) as jumlah_seluruh_barang 
FROM produk
";
$result = mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$jumlah_seluruh_barang = $row['jumlah_seluruh_barang'];


/*jumlah seluruh bahan baku*/
$sql = "
SELECT COUNT(*) as jumlah_seluruh_bahan_baku 
FROM bahan_baku
";
$result = mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$jumlah_seluruh_bahan_baku = $row['jumlah_seluruh_bahan_baku'];

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
				<center>
				<div class="col-md-3 col-sm-6 col-xs-12">
		          	<div class="info-box bg-yellow">
		            	<span class="info-box-icon"><i class="fa fa-bar-chart fa-2x"></i></span>

		            	<div class="info-box-content">
		              		<span class="info-box-text">Kebutuhan Bahan</span>
		              		<span class="info-box-number">-</span>

		              		<div class="progress">
		                		<div class="progress-bar" style="width: 70%"></div>
		              		</div>
		                  	<span class="progress-description">
		                    	<center><a href="?menu=kebutuhan" class="btn btn-xs btn-default" title="">Cek Peramalan</a></center>
		                  	</span>
		            	</div>
		            	<!-- /.info-box-content -->
		          	</div>
		          	<!-- /.info-box -->
		        </div>
    			<!-- /.col -->
    			<div class="col-md-3 col-sm-6 col-xs-12">
		          	<div class="info-box bg-blue">
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
		          	<div class="info-box bg-green">
		            	<span class="info-box-icon"><i class="fa fa-cubes fa-2x"></i></span>

		            	<div class="info-box-content">
		              		<span class="info-box-text">Bahan Baku</span>
		              		<span class="info-box-number"><?= $jumlah_seluruh_bahan_baku ?></span>

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
		        </center>
		        <div class="col-md-12">
		          	<div class="box box-warning">
		            	<div class="box-header">
		              		<h3 class="box-title text-bold">Monitoring Stok Bahan Baku</h3>

		              		<div class="box-tools pull-right">
		                		<!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
		              		</div>
		              		<!-- /.box-tools -->
		            	</div>
		            	<!-- /.box-header -->
		            	<div class="box-body">
		              		<?php  
		              		if ($jumlah_bahan_baku_kosong>0) {
		              			echo "<font class='text-warning'> Ada ".$jumlah_bahan_baku_kosong.' jenis bahan baku yang habis </font>';
		              			?>
		              			<a href="?menu=bahan-baku" class="btn btn-xs btn-default" title="">Lihat</a>
		              			<?php
		              		}else{
		              			echo "<font class='text-success'>Stok bahan baku digudang masih tersedia</font>";
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