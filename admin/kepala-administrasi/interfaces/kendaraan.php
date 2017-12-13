<title>Kendaraan</title>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 style="opacity: 1">
        Data Kendaraan
      </h1>
      
      <ol class="breadcrumb">
        <li><a href="?menu=beranda"><i class="fa fa-home"></i> Beranda</a></li>
        <li class="active">Data Kendaraan</li>
      </ol>
    </section>
	<!-- Main content -->
    <section class="content">
      	<div class="row">
        	<div class="col-xs-12">
	            <div class="nav-tabs-custom">
		            <ul class="nav nav-tabs pull-right">
		              	<li><a href="" data-toggle="modal" data-target="#modalTambah" class="text-bold"><i class="fa fa-plus text-success"></i> Tambah</a></li>
		              	<li class="active"><a href="#tab_2-2" data-toggle="tab">Daftar Kendaraan</a></li>
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
		             	<!-- <li class="pull-left header"><i class="fa fa-building"></i> Data Kendaraan</li> -->
		            </ul>
		            <div class="tab-content">
		              	<div class="tab-pane active" id="tab_2-2">
			            	<table id="example1" class="table table-striped table-bordered dt-responsive nowrap">
				                <thead>
				                <tr class="bg-success">
				                  	<th width="5%">No</th>
				                  	<th>Plat Nomor</th>
				                  	<th>Nama Kendaraan</th>
				                  	<th>Tujuan Pengiriman</th>
				                  	<th>Kapasitas</th>
				                  	<th>Supir</th>
				                  	<th></th>
				                </tr>
				                </thead>
				                <tbody>

					                <?php
					                $sql = "SELECT kendaraan.id, plat_nomor, nama, tujuan_pengiriman, kapasitas, supir, nama_lengkap FROM kendaraan, pegawai WHERE pegawai.id=kendaraan.supir";
									$result = mysqli_query($conn, $sql);

									if (mysqli_num_rows($result) > 0) {
										$no = 1;
									    // keluarkan data dalam variabel row
									    while($row = mysqli_fetch_assoc($result)) {
									    	$id = $row['id'];
									    	$plat_nomor = $row['plat_nomor'];
									    	$nama = $row['nama'];
									    	$tujuan_pengiriman = $row['tujuan_pengiriman'];
									    	$kapasitas = $row['kapasitas'];
									    	$supir = $row['supir'];
									    	$nama_lengkap = $row['nama_lengkap'];
									    	?>
									        <tr>
							                  	<td><?= $no++; ?></td>
							                  	<td><?= strtoupper($plat_nomor) ?></td>
							                  	<td><?= ucwords($nama) ?></td>
							                  	<td><?= ucwords($tujuan_pengiriman) ?></td>
							                  	<td><?= $kapasitas ?></td>
							                  	<td><?= ucwords($nama_lengkap) ?></td>
							                  	<td width="10%" class="text-right">
							                  		<button class="btn btn-sm btn-warning" title="Ubah Data Kendaraan" data-toggle="modal" data-target="#modalUbahKendaraan" onclick="return ubah('<?= $id ?>','<?= $plat_nomor ?>','<?= $nama ?>','<?= $tujuan_pengiriman ?>','<?= $kapasitas ?>','<?= $supir ?>')"><i class="fa fa-edit"></i></button>
							                  		<button class="btn btn-sm btn-danger" title="Hapus Data" data-toggle="modal" data-target="#modalHapus" onclick="return hapus('<?= $id ?>')"><i class="fa fa-trash"></i></button>
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
    <!-- /.content -->  
</div>
<!-- /.content-wrapper -->

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" role="dialog">
    <div class="modal-dialog modal-md">
      	<div class="modal-content">
        	<div class="modal-header">
	          	<button type="button" class="close" data-dismiss="modal">&times;</button>
	          	<h4 class="modal-title"><i class="fa fa-plus text-success"></i> Tambah Data</h4>
	        </div>
	        <form action="" method="post" accept-charset="utf-8" class="form-horizontal">
	        	<div class="modal-body">
	        		<div class="form-group">
	                  	<label for="inputNip" class="col-sm-4">Plat Nomor</label>
	                  	<div class="col-sm-8">
		                  	<div class="input-group">
		                  		<span class="input-group-addon"><i class="fa fa-check"></i></span>
				                <input type="text" name="plat_nomor" id="plat_nomor" class="form-control" placeholder="Plat Nomor" required="">
				            </div>
				        </div>   
	                </div>
	        		<div class="form-group">
	                  	<label for="inputNip" class="col-sm-4">Nama Kendaraan</label>
	                  	<div class="col-sm-8">
		                  	<div class="input-group">
		                  		<span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
				                <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama Kendaraan" required="">
				            </div>
				        </div>   
	                </div>
	                <div class="form-group">
	                  	<label for="inputJabatan" class="col-sm-4">Tujuan Pengiriman</label>
	                  	<div class="col-sm-8">
	                  		<div class="input-group">
				                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
				                <select class="form-control select" style="width: 100%;" name="tujuan_pengiriman" id="tujuan_pengiriman" required="">	
				                	<option value="dalam kota">Dalam Kota</option>
				                	<option value="luar kota">Luar Kota</option>
				                </select>	
				            </div>
			            </div>
	                </div>
	                <div class="form-group">
	                  	<label for="inputNamaPanggilan" class="col-sm-4">Kapasitas</label>
	                  	<div class="col-sm-8">
		                  	<div class="input-group">
		                  		<span class="input-group-addon"><i class="fa fa-cubes"></i></span>
				                <input type="number" name="kapasitas" id="kapasitas" class="form-control" placeholder="Kapasitas" required="">
		                  		<span class="input-group-addon">buah</span>
				            </div>
				        </div>   
	                </div>
	                <div class="form-group">
	                  	<label for="inputJabatan" class="col-sm-4">Supir</label>
	                  	<div class="col-sm-8">
	                  		<div class="input-group">
				                <span class="input-group-addon"><i class="fa fa-user"></i></span>
				                <select class="form-control select" style="width: 100%;" name="supir" id="supir" required="">
				                	<?php
				                	$sql = "SELECT id, nip, nama_lengkap FROM pegawai WHERE jabatan='staff promosi'";
				                	$result = mysqli_query($conn, $sql);
				                	while ($row=mysqli_fetch_assoc($result)) {
				                		?>
				                		<option value="<?= $row['id'] ?>"><?= strtoupper($row['nip']).' - '.ucwords($row['nama_lengkap']) ?></option>
				                		<?php
				                	}
				                	?>
				                </select>	
				            </div>
			            </div>
	                </div>
		        </div>
		        <div class="modal-footer">
		        	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			          	<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
			          	<button type="submit" class="btn btn-success" name="simpan_kendaraan">Simpan</button>
		        	</div>
		        </div>
	        </form>
    	</div>
	</div>
</div>

<!-- Modal Ubah -->
<div class="modal fade" id="modalUbahKendaraan" role="dialog">
    <div class="modal-dialog modal-md">
      	<div class="modal-content">
        	<div class="modal-header">
	          	<button type="button" class="close" data-dismiss="modal">&times;</button>
	          	<h4 class="modal-title"><i class="fa fa-edit text-warning"></i> Ubah Data Karyawan</h4>
	        </div>
	        <form action="" method="post" accept-charset="utf-8" class="form-horizontal">
	        	<div class="modal-body">

	        		<!-- ID  -->
	        		<input type="hidden" name="id" id="id" class="form-control" placeholder="" required="">

	        		<div class="form-group">
	                  	<label for="inputNip" class="col-sm-4">Plat Nomor</label>
	                  	<div class="col-sm-8">
		                  	<div class="input-group">
		                  		<span class="input-group-addon"><i class="fa fa-check"></i></span>
				                <input type="text" name="u_plat_nomor" id="u_plat_nomor" class="form-control" placeholder="Plat Nomor" required="">
				            </div>
				        </div>   
	                </div>
	        		<div class="form-group">
	                  	<label for="inputNip" class="col-sm-4">Nama Kendaraan</label>
	                  	<div class="col-sm-8">
		                  	<div class="input-group">
		                  		<span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
				                <input type="text" name="u_nama" id="u_nama" class="form-control" placeholder="Nama Kendaraan" required="">
				            </div>
				        </div>   
	                </div>
	                <div class="form-group">
	                  	<label for="inputJabatan" class="col-sm-4">Tujuan Pengiriman</label>
	                  	<div class="col-sm-8">
	                  		<div class="input-group">
				                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
				                <select class="form-control select" style="width: 100%;" name="u_tujuan_pengiriman" id="u_tujuan_pengiriman" required="">	
				                	<option value="dalam kota">Dalam Kota</option>
				                	<option value="luar kota">Luar Kota</option>
				                </select>	
				            </div>
			            </div>
	                </div>
	                <div class="form-group">
	                  	<label for="inputNamaPanggilan" class="col-sm-4">Kapasitas</label>
	                  	<div class="col-sm-8">
		                  	<div class="input-group">
		                  		<span class="input-group-addon"><i class="fa fa-cubes"></i></span>
				                <input type="number" name="u_kapasitas" id="u_kapasitas" class="form-control" placeholder="Kapasitas" required="">
		                  		<span class="input-group-addon">buah</span>
				            </div>
				        </div>   
	                </div>
	                <div class="form-group">
	                  	<label for="inputJabatan" class="col-sm-4">Supir</label>
	                  	<div class="col-sm-8">
	                  		<div class="input-group">
				                <span class="input-group-addon"><i class="fa fa-user"></i></span>
				                <select class="form-control select" style="width: 100%;" name="u_supir" id="u_supir" required="">	
				                	<?php
				                	$sql = "SELECT id, nip, nama_lengkap FROM pegawai WHERE jabatan='staff promosi'";
				                	$result = mysqli_query($conn, $sql);
				                	while ($row=mysqli_fetch_assoc($result)) {
				                		?>
				                		<option value="<?= $row['id'] ?>"><?= strtoupper($row['nip']).' - '.ucwords($row['nama_lengkap']) ?></option>
				                		<?php
				                	}
				                	?>
				                </select>	
				            </div>
			            </div>
	                </div>
		        </div>
		        <div class="modal-footer">
		          	<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
		          	<button type="submit" class="btn btn-success" name="ubah_kendaraan">Simpan Perubahan</button>
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
		          	<button type="submit" class="btn btn-danger" name="hapus_kendaraan">Hapus</button>
		        </div>
	        </form>
    	</div>
	</div>
</div>


<script type="text/javascript">
	
	function ubah(id, plat_nomor, nama, tujuan_pengiriman, kapasitas, supir){
		$('.modal-body input[name=id]').val(id);
		$('.modal-body input[name=u_plat_nomor]').val(plat_nomor);
		$('.modal-body input[name=u_nama]').val(nama);
		$('.modal-body select[name=u_tujuan_pengiriman]').val(tujuan_pengiriman);
		$('.modal-body input[name=u_kapasitas]').val(kapasitas);
		$('.modal-body select[name=u_supir]').val(supir);
	}

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
