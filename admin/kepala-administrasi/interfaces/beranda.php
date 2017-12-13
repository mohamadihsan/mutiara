<?php  

/*jumlah seluruh pegawai*/
$sql = "
SELECT COUNT(*) as jumlah_seluruh_pegawai 
FROM pegawai
";
$result = mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$jumlah_seluruh_pegawai = $row['jumlah_seluruh_pegawai'];


/*jumlah seluruh kendaraan*/
$sql = "
SELECT COUNT(*) as jumlah_seluruh_kendaraan 
FROM kendaraan
";
$result = mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$jumlah_seluruh_kendaraan = $row['jumlah_seluruh_kendaraan'];

?>

<title>Beranda</title>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<div class="row">
		<center>
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
			          	<div class="info-box bg-yellow">
			            	<span class="info-box-icon"><i class="fa fa-truck fa-2x"></i></span>

			            	<div class="info-box-content">
			              		<span class="info-box-text">Kendaraan</span>
			              		<span class="info-box-number"><?= $jumlah_seluruh_kendaraan ?></span>

			              		<div class="progress">
			                		<div class="progress-bar" style="width: 70%"></div>
			              		</div>
			                  	<span class="progress-description">
			                    	buah
			                  	</span>
			            	</div>
			            	<!-- /.info-box-content -->
			          	</div>
			          	<!-- /.info-box -->
			        </div>
			        <!-- /.col -->
				</div>
			</div>
		</center>
	</div>  
</div>
<!-- /.content-wrapper -->