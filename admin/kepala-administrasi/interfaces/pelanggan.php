<title>Pelanggan</title>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 style="opacity: 1">
        Data Pelanggan
      </h1>
      
      <ol class="breadcrumb">
        <li><a href="?menu=beranda"><i class="fa fa-home"></i> Beranda</a></li>
        <li class="active">Data Pelanggan</li>
      </ol>
    </section>
	<!-- Main content -->
    <section class="content">
      	<div class="row">
        	<div class="col-xs-12">
	            <div class="nav-tabs-custom">
		            <ul class="nav nav-tabs pull-right">
		              	<li><a href="" data-toggle="modal" data-target="#modalTambah" class="text-bold"><i class="fa fa-plus text-success"></i> Tambah</a></li>
		              	<li class="active"><a href="#tab_2-2" data-toggle="tab">Daftar Pelanggan</a></li>
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
				                  	<th>Kode</th>
				                  	<th>Nama Pelanggan</th>
				                  	<th>No. Telp</th>
				                  	<th>Email</th>
				                  	<th>Status Kota</th>
				                  	<th>Alamat</th>
				                  	<th></th>
				                </tr>
				                </thead>
				                <tbody>

					                <?php
					                $sql = "SELECT id, kode, nama, kota, alamat, no_telp, email, nama_pengguna FROM pelanggan";
									$result = mysqli_query($conn, $sql);

									if (mysqli_num_rows($result) > 0) {
										$no = 1;
									    // keluarkan data dalam variabel row
									    while($row = mysqli_fetch_assoc($result)) {
									    	$id = $row['id'];
									    	$kode = $row['kode'];
									    	$nama = $row['nama'];
									    	$kota = $row['kota'];
									    	$alamat = $row['alamat'];
									    	$no_telp = $row['no_telp'];
									    	$email = $row['email'];
									    	$nama_pengguna = $row['nama_pengguna'];
									    	?>
									        <tr>
							                  	<td><?= $no++; ?></td>
							                  	<td><?= strtoupper($kode) ?></td>
							                  	<td><?= ucwords($nama) ?></td>
							                  	<td><?= $no_telp ?></td>
							                  	<td><?= $email ?></td>
							                  	<td><?= ucwords($kota) ?></td>
							                  	<td><?= $alamat ?></td>
							                  	<td width="10%" class="text-right">
							                  		<button class="btn btn-sm btn-warning" title="Ubah Data Pelanggan" data-toggle="modal" data-target="#modalUbahPelanggan" onclick="return ubah('<?= $id ?>','<?= $kode ?>','<?= $nama ?>','<?= $kota ?>','<?= $alamat ?>','<?= $no_telp ?>','<?= $email ?>','<?= $nama_pengguna ?>')"><i class="fa fa-edit"></i></button>
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
    <div class="modal-dialog modal-lg">
      	<div class="modal-content">
        	<div class="modal-header">
	          	<button type="button" class="close" data-dismiss="modal">&times;</button>
	          	<h4 class="modal-title"><i class="fa fa-plus text-success"></i> Tambah Data</h4>
	        </div>
	        <form action="" method="post" accept-charset="utf-8" class="form-horizontal">
	        	<div class="modal-body">
	        		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
		        		<fieldset>
			        		<legend>Informasi Pelanggan</legend>
			        		<div class="form-group">
			                  	<label for="inputNip" class="col-sm-4">Kode Pelanggan</label>
			                  	<?php
			                  	$sql = "SELECT id FROM pelanggan ORDER BY id DESC LIMIT 1";
			                  	$result = mysqli_query($conn, $sql);
			                  	$row=mysqli_fetch_assoc($result);
			                  	if (mysqli_num_rows($result)>0) {
			                  		$kode = $row['id']+1;
			                  		$kode = 'MS/PEL-'.$kode;
			                  	}else{
			                  		$kode = 'MS/PEL-1';
			                  	}
			                  	?>
			                  	<div class="col-sm-8">
				                  	<div class="input-group">
				                  		<span class="input-group-addon"><i class="fa fa-check"></i></span>
						                <input type="text" name="kode" id="kode" class="form-control" placeholder="Kode Pelanggan" required="" value="<?= $kode ?>" readonly="">
						            </div>
						        </div>   
			                </div>
			        		<div class="form-group">
			                  	<label for="inputNip" class="col-sm-4">Nama Pelanggan</label>
			                  	<div class="col-sm-8">
				                  	<div class="input-group">
				                  		<span class="input-group-addon"><i class="fa fa-check"></i></span>
						                <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama Pelanggan" required="">
						            </div>
						        </div>   
			                </div>
			                <div class="form-group">
			                  	<label for="inputNamaLengkap" class="col-sm-4">Nomor Telepon</label>
			                  	<div class="col-sm-8">
				                  	<div class="input-group">
				                  		<span class="input-group-addon"><i class="fa fa-child"></i></span>
						                <input type="text" name="no_telp" id="no_telp" class="form-control" placeholder="Nomor Telepon" required="">
						            </div>
						        </div>   
			                </div>
			                <div class="form-group">
			                  	<label for="inputNamaPanggilan" class="col-sm-4">Email</label>
			                  	<div class="col-sm-8">
				                  	<div class="input-group">
				                  		<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
						                <input type="email" name="email" id="email" class="form-control" placeholder="Email" required="">
						            </div>
						        </div>   
			                </div>
			                <div class="form-group">
			                  	<label for="inputJabatan" class="col-sm-4">Status Kota</label>
			                  	<div class="col-sm-8">
			                  		<div class="input-group">
						                <span class="input-group-addon"><i class="fa fa-briefcase"></i></span>
						                <select class="form-control select" style="width: 100%;" name="kota" id="kota" required="">	
						                	<option value="dalam kota">Dalam Kota</option>
						                	<option value="luar kota">Luar Kota</option>
						                </select>	
						            </div>
					            </div>
			                </div>
			                <div class="form-group">
			                  	<label for="inputNamaPanggilan" class="col-sm-4">Alamat</label>
			                  	<div class="col-sm-8">
				                  	<div class="input-group">
				                  		<span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
						               <textarea name="alamat" class="form-control" placeholder="Alamat"></textarea>
						            </div>
						        </div>   
			                </div>
			        	</fieldset>
			        </div>
			        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">	
	        			<fieldset>
	        				<legend>Data Pengguna</legend>
			        		<div class="form-group">
			                  	<label for="inputNamaPengguna" class="col-sm-4">Nama Pengguna</label>
			                  	<div class="col-sm-8">
				                  	<div class="input-group">
				                  		<span class="input-group-addon"><i class="fa fa-key"></i></span>
						                <input type="text" name="nama_pengguna" id="nama_pengguna" class="form-control" placeholder="Nama Pengguna" required="">
						            </div>
						        </div>   
			                </div>

			                <div class="form-group">
			                  	<label for="inputNamaKataSandi" class="col-sm-4">Kata Sandi</label>
			                  	<div class="col-sm-8">
				                  	<div class="input-group">
				                  		<span class="input-group-addon"><i class="fa fa-lock"></i></span>
						                <input type="password" name="kata_sandi" id="kata_sandi" class="form-control" placeholder="Kata Sandi" required="">
						            </div>
						        </div>   
			                </div>
			            </fieldset>    
	                </div>
		        </div>
		        <div class="modal-footer">
		        	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			          	<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
			          	<button type="submit" class="btn btn-success" name="simpan_pelanggan">Simpan</button>
		        	</div>
		        </div>
	        </form>
    	</div>
	</div>
</div>

<!-- Modal Ubah -->
<div class="modal fade" id="modalUbahPelanggan" role="dialog">
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
	                  	<label for="inputNip" class="col-sm-4">Kode Pelanggan</label>
	                  	<div class="col-sm-8">
		                  	<div class="input-group">
		                  		<span class="input-group-addon"><i class="fa fa-check"></i></span>
				                <input type="text" name="u_kode" id="u_kode" class="form-control" placeholder="Kode Pelanggan" required="" readonly>
				            </div>
				        </div>   
	                </div>
	        		<div class="form-group">
	                  	<label for="inputNip" class="col-sm-4">Nama Pelanggan</label>
	                  	<div class="col-sm-8">
		                  	<div class="input-group">
		                  		<span class="input-group-addon"><i class="fa fa-check"></i></span>
				                <input type="text" name="u_nama" id="u_nama" class="form-control" placeholder="Nama Pelanggan" required="">
				            </div>
				        </div>   
	                </div>
	                <div class="form-group">
	                  	<label for="inputNamaLengkap" class="col-sm-4">Nomor Telepon</label>
	                  	<div class="col-sm-8">
		                  	<div class="input-group">
		                  		<span class="input-group-addon"><i class="fa fa-child"></i></span>
				                <input type="text" name="u_no_telp" id="u_no_telp" class="form-control" placeholder="Nomor Telepon" required="">
				            </div>
				        </div>   
	                </div>
	                <div class="form-group">
	                  	<label for="inputNamaPanggilan" class="col-sm-4">Email</label>
	                  	<div class="col-sm-8">
		                  	<div class="input-group">
		                  		<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
				                <input type="email" name="u_email" id="u_email" class="form-control" placeholder="Email" required="">
				            </div>
				        </div>   
	                </div>
	                <div class="form-group">
	                  	<label for="inputJabatan" class="col-sm-4">Status Kota</label>
	                  	<div class="col-sm-8">
	                  		<div class="input-group">
				                <span class="input-group-addon"><i class="fa fa-briefcase"></i></span>
				                <select class="form-control select" style="width: 100%;" name="u_kota" id="u_kota" required="">	
				                	<option value="dalam kota">Dalam Kota</option>
				                	<option value="luar kota">Luar Kota</option>
				                </select>	
				            </div>
			            </div>
	                </div>
	                <div class="form-group">
	                  	<label for="inputNamaPanggilan" class="col-sm-4">Alamat</label>
	                  	<div class="col-sm-8">
		                  	<div class="input-group">
		                  		<span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
				               <textarea name="u_alamat" class="form-control" placeholder="Alamat"></textarea>
				            </div>
				        </div>   
	                </div>
		        </div>
		        <div class="modal-footer">
		          	<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
		          	<button type="submit" class="btn btn-success" name="ubah_pelanggan">Simpan Perubahan</button>
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
		          	<button type="submit" class="btn btn-danger" name="hapus_pelanggan">Hapus</button>
		        </div>
	        </form>
    	</div>
	</div>
</div>


<script type="text/javascript">
	
	function ubah(id, kode, nama, kota, alamat, no_telp, email, nama_pengguna){
		$('.modal-body input[name=id]').val(id);
		$('.modal-body input[name=u_kode]').val(kode);
		$('.modal-body input[name=u_nama]').val(nama);
		$('.modal-body select[name=u_kota]').val(kota);
		$('.modal-body textarea[name=u_alamat]').val(alamat);
		$('.modal-body input[name=u_no_telp]').val(no_telp);
		$('.modal-body input[name=u_email]').val(email);
		$('.modal-body input[name=u_nama_pengguna]').val(nama_pengguna);
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
