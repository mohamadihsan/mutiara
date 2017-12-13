<title>Pengguna</title>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 style="opacity: 0">
        .
      </h1>
      <ol class="breadcrumb">
        <li><a href="?menu=beranda"><i class="fa fa-home"></i> Beranda</a></li>
        <li class="active">Pengolahan Pengguna</li>
      </ol>
    </section>
	<!-- Main content -->
    <section class="content">
      	<div class="row">
        	<div class="col-xs-12">
        		<!-- Custom Tabs (Pulled to the right) -->
		        <div class="nav-tabs-custom">
		            <ul class="nav nav-tabs pull-right">
		              	<li><a href="" data-toggle="modal" data-target="#modalTambah" class="text-bold"><i class="fa fa-plus text-success"></i> Tambah</a></li>
		              	<li class="active"><a href="#tab_2-2" data-toggle="tab">Data Pengguna</a></li>
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
		             	<li class="pull-left header"><i class="fa fa-building"></i> Data Pengguna</li>
		            </ul>
		            <div class="tab-content">
		              	<div class="tab-pane active" id="tab_2-2">
		                	<table id="example1" class="table table-striped table-bordered dt-responsive nowrap">
				                <thead>
				                <tr class="bg-success">
				                  	<th width="5%">No</th>
				                  	<th>Nomor Induk</th>
				                  	<th>Nama Lengkap</th>
				                  	<th>Nama Panggilan</th>
				                  	<th>Jabatan</th>
				                  	<th>Nama Pengguna</th>
				                  	<th></th>
				                </tr>
				                </thead>
				                <tbody>

					                <?php
					                $sql = "SELECT id, nip, nama_lengkap, nama_panggilan, jabatan, nama_pengguna, kata_sandi FROM pegawai WHERE jabatan NOT IN ('administrator')";
									$result = mysqli_query($conn, $sql);

									if (mysqli_num_rows($result) > 0) {
										$no = 1;
									    // keluarkan data dalam variabel row
									    while($row = mysqli_fetch_assoc($result)) {
									    	$id = $row['id'];
									    	$nip = $row['nip'];
									    	$nama_lengkap = $row['nama_lengkap'];
									    	$nama_panggilan = $row['nama_panggilan'];
									    	$jabatan = $row['jabatan'];
									    	$nama_pengguna = $row['nama_pengguna'];
									    	$kata_sandi = $row['kata_sandi'];
									    	?>
									        <tr>
							                  	<td><?= $no++; ?></td>
							                  	<td><?= strtoupper($row['nip']) ?></td>
							                  	<td><?= ucwords($row['nama_lengkap']) ?></td>
							                  	<td><?= ucwords($row['nama_panggilan']) ?></td>
							                  	<td><?= ucwords($row['jabatan']) ?></td>
							                  	<td><?= $row['nama_pengguna'] ?></td>
							                  	<td width="10%" class="text-right">
							                  		<button class="btn btn-sm btn-warning" title="Ubah Data Pegawai" data-toggle="modal" data-target="#modalUbahPegawai" onclick="return ubah('<?= $id ?>','<?= $nip ?>','<?= $nama_lengkap ?>','<?= $nama_panggilan ?>','<?= $jabatan ?>','<?= $nama_pengguna ?>')"><i class="fa fa-edit"></i></button>
							                  		<button class="btn btn-sm btn-success" title="Ubah Data Pengguna" data-toggle="modal" data-target="#modalUbahPengguna" onclick="return ubah('<?= $id ?>','<?= $nip ?>','<?= $nama_lengkap ?>','<?= $nama_panggilan ?>','<?= $jabatan ?>','<?= $nama_pengguna ?>')"><i class="fa fa-lock"></i></button>
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
	          	<h4 class="modal-title"><i class="fa fa-plus text-green"></i> Tambah Data</h4>
	        </div>
	        <form action="" method="post" accept-charset="utf-8" class="form-horizontal">
	        	<div class="modal-body">
	        		<div class="form-group">
	                  	<label for="inputNip" class="col-sm-3">Nomor Induk</label>
	                  	<div class="col-sm-9">
		                  	<div class="input-group">
		                  		<span class="input-group-addon"><i class="fa fa-check"></i></span>
				                <input type="text" name="nip" id="nip" class="form-control" placeholder="Nomor Induk" required="">
				            </div>
				        </div>   
	                </div>
	                <div class="form-group">
	                  	<label for="inputNamaLengkap" class="col-sm-3">Nama Lengkap</label>
	                  	<div class="col-sm-9">
		                  	<div class="input-group">
		                  		<span class="input-group-addon"><i class="fa fa-child"></i></span>
				                <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control" placeholder="Nama Lengkap" required="">
				            </div>
				        </div>   
	                </div>
	                <div class="form-group">
	                  	<label for="inputNamaPanggilan" class="col-sm-3">Nama Panggilan</label>
	                  	<div class="col-sm-9">
		                  	<div class="input-group">
		                  		<span class="input-group-addon"><i class="fa fa-user"></i></span>
				                <input type="text" name="nama_panggilan" id="nama_panggilan" class="form-control" placeholder="Nama Panggilan" required="">
				            </div>
				        </div>   
	                </div>
	        		<div class="form-group">
	                  	<label for="inputJabatan" class="col-sm-3">Jabatan</label>
	                  	<div class="col-sm-9">
	                  		<div class="input-group">
				                <span class="input-group-addon"><i class="fa fa-briefcase"></i></span>
				                <select class="form-control select2" style="width: 100%;" name="jabatan" id="jabatan" required="">	
				                	<option value="pemilik">Pemilik</option>
				                	<option value="manager">Manager</option>
				                	<option value="kepala pemasaran">Kepala Pemasaran</option>
				                	<option value="kepala administrasi">Kepala Administrasi</option>
				                	<option value="kepala produksi">Kepala Produksi</option>
				                	<option value="kepala gudang dan pengadaan">Kepala Gudang dan Pengadaan</option>
				                	<option value="staff penerimaan">Staff Penerimaan</option>
				                	<option value="staff promosi">Staff Promosi</option>
				                	<option value="staff keuangan">Staff Keuangan</option>
				                	<option value="staff pengolahan data">Staff Pengolahan Data</option>
				                	<option value="staff produksi">Staff Produksi</option>
				                	<option value="staff gudang">Staff Gudang</option>
				                </select>
				            </div>
			            </div>
	                </div>
	                <div class="form-group">
	                  	<label for="inputNamaPengguna" class="col-sm-3">Nama Pengguna</label>
	                  	<div class="col-sm-9">
		                  	<div class="input-group">
		                  		<span class="input-group-addon"><i class="fa fa-key"></i></span>
				                <input type="text" name="nama_pengguna" id="nama_pengguna" class="form-control" placeholder="Nama Pengguna" required="">
				            </div>
				        </div>   
	                </div>

	                <div class="form-group">
	                  	<label for="inputNamaKataSandi" class="col-sm-3">Kata Sandi</label>
	                  	<div class="col-sm-9">
		                  	<div class="input-group">
		                  		<span class="input-group-addon"><i class="fa fa-lock"></i></span>
				                <input type="password" name="kata_sandi" id="kata_sandi" class="form-control" placeholder="Kata Sandi" required="">
				            </div>
				        </div>   
	                </div>
	                
		        </div>
		        <div class="modal-footer">
		          	<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
		          	<button type="submit" class="btn btn-success" name="simpan_pengguna">Simpan</button>
		        </div>
	        </form>
    	</div>
	</div>
</div>

<!-- Modal Ubah Pegawai -->
<div class="modal fade" id="modalUbahPegawai" role="dialog">
    <div class="modal-dialog modal-md">
      	<div class="modal-content">
        	<div class="modal-header">
	          	<button type="button" class="close" data-dismiss="modal">&times;</button>
	          	<h4 class="modal-title"><i class="fa fa-edit text-yellow"></i> Ubah Data</h4>
	        </div>
	        <form action="" method="post" accept-charset="utf-8" class="form-horizontal">
	        	<div class="modal-body">

	        		<!-- ID  -->
	        		<input type="hidden" name="id" id="id" class="form-control" placeholder="" required="">

	        		<div class="form-group">
	                  	<label for="inputNip" class="col-sm-3">Nomor Induk</label>
	                  	<div class="col-sm-9">
		                  	<div class="input-group">
		                  		<span class="input-group-addon"><i class="fa fa-check"></i></span>
				                <input type="text" name="u_nip" id="u_nip" class="form-control" placeholder="Nomor Induk" required="">
				            </div>
				        </div>   
	                </div>
	                <div class="form-group">
	                  	<label for="inputNamaLengkap" class="col-sm-3">Nama Lengkap</label>
	                  	<div class="col-sm-9">
		                  	<div class="input-group">
		                  		<span class="input-group-addon"><i class="fa fa-child"></i></span>
				                <input type="text" name="u_nama_lengkap" id="u_nama_lengkap" class="form-control" placeholder="Nama Lengkap" required="">
				            </div>
				        </div>   
	                </div>
	                <div class="form-group">
	                  	<label for="inputNamaPanggilan" class="col-sm-3">Nama Panggilan</label>
	                  	<div class="col-sm-9">
		                  	<div class="input-group">
		                  		<span class="input-group-addon"><i class="fa fa-user"></i></span>
				                <input type="text" name="u_nama_panggilan" id="u_nama_panggilan" class="form-control" placeholder="Nama Panggilan" required="">
				            </div>
				        </div>   
	                </div>
	        		<div class="form-group">
	                  	<label for="inputJabatan" class="col-sm-3">Jabatan</label>
	                  	<div class="col-sm-9">
	                  		<div class="input-group">
				                <span class="input-group-addon"><i class="fa fa-briefcase"></i></span>
				                <select class="form-control select" style="width: 100%;" name="u_jabatan" id="u_jabatan" required="">	
				                	<option value="pemilik">Pemilik</option>
				                	<option value="manager">Manager</option>
				                	<option value="kepala pemasaran">Kepala Pemasaran</option>
				                	<option value="kepala administrasi">Kepala Administrasi</option>
				                	<option value="kepala produksi">Kepala Produksi</option>
				                	<option value="kepala gudang dan pengadaan">Kepala Gudang dan Pengadaan</option>
				                	<option value="staff penerimaan">Staff Penerimaan</option>
				                	<option value="staff promosi">Staff Promosi</option>
				                	<option value="staff keuangan">Staff Keuangan</option>
				                	<option value="staff pengolahan data">Staff Pengolahan Data</option>
				                	<option value="staff produksi">Staff Produksi</option>
				                	<option value="staff gudang">Staff Gudang</option>
				                </select>
				            </div>
			            </div>
	                </div>
		        </div>
		        <div class="modal-footer">
		          	<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
		          	<button type="submit" class="btn btn-success" name="ubah_pegawai">Simpan Perubahan</button>
		        </div>
	        </form>
    	</div>
	</div>
</div>

<!-- Modal Ubah Pengguna -->
<div class="modal fade" id="modalUbahPengguna" role="dialog">
    <div class="modal-dialog modal-md">
      	<div class="modal-content">
        	<div class="modal-header">
	          	<button type="button" class="close" data-dismiss="modal">&times;</button>
	          	<h4 class="modal-title"><i class="fa fa-edit text-yellow"></i> Ubah Data</h4>
	        </div>
	        <form action="" method="post" accept-charset="utf-8" class="form-horizontal">
	        	<div class="modal-body">

	        		<!-- ID  -->
	        		<input type="hidden" name="id" id="id" class="form-control" placeholder="" required="">

	        		<div class="form-group">
	                  	<label for="inputNamaPengguna" class="col-sm-3">Nama Pengguna</label>
	                  	<div class="col-sm-9">
		                  	<div class="input-group">
		                  		<span class="input-group-addon"><i class="fa fa-key"></i></span>
				                <input type="text" name="u_nama_pengguna" id="u_nama_pengguna" class="form-control" placeholder="Nama Pengguna" required="">
				            </div>
				        </div>   
	                </div>

	                <div class="form-group">
	                  	<label for="inputNamaKataSandi" class="col-sm-3">Kata Sandi</label>
	                  	<div class="col-sm-9">
		                  	<div class="input-group">
		                  		<span class="input-group-addon"><i class="fa fa-lock"></i></span>
				                <input type="password" name="u_kata_sandi" id="u_kata_sandi" class="form-control" placeholder="Kata Sandi" required="">
				            </div>
				        </div>   
	                </div>
		        </div>
		        <div class="modal-footer">
		          	<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
		          	<button type="submit" class="btn btn-success" name="ubah_pengguna">Simpan Perubahan</button>
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
		          	<button type="submit" class="btn btn-danger" name="hapus_pengguna">Hapus</button>
		        </div>
	        </form>
    	</div>
	</div>
</div>


<script type="text/javascript">
	
	function ubah(id, nip, nama_lengkap, nama_panggilan, jabatan, nama_pengguna){
		$('.modal-body input[name=id]').val(id);
		$('.modal-body input[name=u_nip]').val(nip);
		$('.modal-body input[name=u_nama_lengkap]').val(nama_lengkap);
		$('.modal-body input[name=u_nama_panggilan]').val(nama_panggilan);
		$('.modal-body select[name=u_jabatan]').val(jabatan);
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
