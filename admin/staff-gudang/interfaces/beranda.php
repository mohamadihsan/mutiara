<title>Beranda</title>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<div class="row">
        <div class="jumbotron jumbotron-fluid">
			<div class="container">
				<center>
				<div class="col-md-3 col-sm-6 col-xs-12">
		          	<div class="info-box bg-blue">
		            	<span class="info-box-icon"><i class="fa fa-cubes fa-2x"></i></span>

		            	<div class="info-box-content">
		              		<span class="info-box-text">Bahan baku</span>
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
		          	<div class="info-box bg-yellow">
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
		            	<span class="info-box-icon"><i class="fa fa-exchange fa-2x"></i></span>

		            	<div class="info-box-content">
		              		<span class="info-box-text">Barang Masuk</span>
		              		<span class="info-box-number"><?= $jumlah_barang_masuk_hari_ini ?></span>

		              		<div class="progress">
		                		<div class="progress-bar" style="width: 70%"></div>
		              		</div>
		                  	<span class="progress-description">
		                    	buah (hari ini)
		                  	</span>
		            	</div>
		            	<!-- /.info-box-content -->
		          	</div>
		          	<!-- /.info-box -->
		        </div>
		        <!-- /.col -->
		        <div class="col-md-3 col-sm-6 col-xs-12">
		          	<div class="info-box bg-red">
		            	<span class="info-box-icon"><i class="fa fa-exchange fa-2x"></i></span>

		            	<div class="info-box-content">
		              		<span class="info-box-text">Barang Keluar</span>
		              		<span class="info-box-number"><?= $jumlah_barang_keluar_hari_ini ?></span>

		              		<div class="progress">
		                		<div class="progress-bar" style="width: 70%"></div>
		              		</div>
		                  	<span class="progress-description">
		                    	buah (hari ini)
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
		              		<h3 class="box-title text-bold">Monitoring Stok Barang/Produk</h3>

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