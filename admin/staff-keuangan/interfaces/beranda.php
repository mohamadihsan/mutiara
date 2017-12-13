<title>Beranda</title>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<div class="row">
        <div class="jumbotron jumbotron-fluid">
			<div class="container">
				<center>
		        <div class="col-md-3 col-sm-6 col-xs-12">
		          	<div class="info-box bg-green">
		            	<span class="info-box-icon"><i class="fa fa-money fa-2x"></i></span>

		            	<div class="info-box-content">
		              		<span class="info-box-text">Konfirmasi</span>
		              		<span class="info-box-number"><?= $jumlah_konfirmasi_pemesanan_hari_ini ?></span>

		              		<div class="progress">
		                		<div class="progress-bar" style="width: 70%"></div>
		              		</div>
		                  	<span class="progress-description">
		                    	Pemesanan Produk (hari ini)
		                  	</span>
		            	</div>
		            	<!-- /.info-box-content -->
		          	</div>
		          	<!-- /.info-box -->
		        </div>
		        <!-- /.col -->
		        <div class="col-md-3 col-sm-6 col-xs-12">
		          	<div class="info-box bg-red">
		            	<span class="info-box-icon"><i class="fa fa-money fa-2x"></i></span>

		            	<div class="info-box-content">
		              		<span class="info-box-text">Konfirmasi</span>
		              		<span class="info-box-number"><?= $jumlah_konfimrasi_pemesanan_bahan_baku_hari_ini ?></span>

		              		<div class="progress">
		                		<div class="progress-bar" style="width: 70%"></div>
		              		</div>
		                  	<span class="progress-description">
		                    	Pemesanan Bahan Baku (hari ini)
		                  	</span>
		            	</div>
		            	<!-- /.info-box-content -->
		          	</div>
		          	<!-- /.info-box -->
		        </div>
		        <!-- /.col -->
		        </center>
		        
		    </div>
		</div>	
	</div>  
</div>
<!-- /.content-wrapper -->