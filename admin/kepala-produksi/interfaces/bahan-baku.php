<title>Bahan Baku</title>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 style="opacity: 0">
        .
      </h1>
      <ol class="breadcrumb">
        <li><a href="?menu=beranda"><i class="fa fa-home"></i> Beranda</a></li>
        <li class="active">Bahan Baku</li>
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
		              	<li class="active"><a href="#tab_2-2" data-toggle="tab">Daftar Bahan Baku</a></li>
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
		             	<li class="pull-left header"><i class="fa fa-building"></i> Daftar Bahan Baku</li>
		            </ul>
		            <div class="tab-content">
		              	<div class="tab-pane active" id="tab_2-2">
		                	<table id="example1" class="table table-striped table-bordered dt-responsive nowrap">
				                <thead>
				                <tr class="bg-success">
				                  	<th width="5%">No</th>
				                  	<th>Kode</th>
				                  	<th>Nama</th>
				                  	<th width="10%">Satuan</th>
				                  	<th class="text-center" width="10%">Status</th>
				                  	<th></th>
				                </tr>
				                </thead>
				                <tbody>

					                <?php
					                $sql = "SELECT id, kode, nama, satuan FROM bahan_baku";
									$result = mysqli_query($conn, $sql);

									if (mysqli_num_rows($result) > 0) {
										$no = 1;
									    // keluarkan data dalam variabel row
									    while($row = mysqli_fetch_assoc($result)) {
									    	$id = $row['id'];
									    	$kode = $row['kode'];
									    	$nama = $row['nama'];
									    	$satuan = $row['satuan'];

									    	/*cek status ketersediaan bahan baku*/
									    	$sql_stok = "SELECT SUM(stok) as jumlah_stok FROM detail_bahan_baku WHERE id_bahan_baku='$id'";
											$hasil = mysqli_query($conn, $sql_stok);
											$data = mysqli_fetch_assoc($hasil);
											if ($data['jumlah_stok'] > 0) {
												$status = '<span class="label label-success">tersedia</span>';
											}else{
												$status = '<span class="label label-danger">kosong</span>';
											}
									        ?>
									        <tr>
							                  	<td><?= $no++; ?></td>
							                  	<td><?= strtoupper($row['kode']) ?></td>
							                  	<td><?= ucwords($row['nama']) ?></td>
							                  	<td><?= ucwords($row['satuan']) ?></td>
							                  	<td class="text-center"><?= $status ?></td>
							                  	<td width="10%" class="text-right">
							                  		<!-- <button class="btn btn-sm btn-default" title="Detail Barang" data-toggle="modal" data-target="#modalDetail" onclick="return detail('<?= $id ?>','<?= $kode ?>','<?= $nama ?>','<?= $satuan ?>')"><i class="fa fa-file-text-o"></i></button> -->
							                  		<a href="?id=<?= $id ?>&menu=detail-bahan-baku" class="btn btn-sm btn-default" title="Detail Barang"><i class="fa fa-file-text-o"></i></a>
							                  		<button class="btn btn-sm btn-warning" title="Ubah Data" data-toggle="modal" data-target="#modalUbah" onclick="return ubah('<?= $id ?>','<?= $kode ?>','<?= $nama ?>','<?= $satuan ?>')"><i class="fa fa-edit"></i></button>
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
	                  	<label for="inputNama" class="col-sm-3">Nama Barang</label>
	                  	<div class="col-sm-9">
	                  		<div class="input-group">
				                <span class="input-group-addon"><i class="fa fa-cubes"></i></span>
				                <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama Barang" required="" autofocus="">
			            	</div>
			            </div>
	                </div>
	                <div class="form-group">
	                  	<label for="inputSatuan" class="col-sm-3">Satuan</label>
	                  	<div class="col-sm-9">
	                  		<div class="input-group">
				                <span class="input-group-addon"><i class="fa fa-check"></i></span>
				                <input type="text" name="satuan" id="satuan" class="form-control" placeholder="Misal : kilogram" required="">
			            	</div>
			            </div>
	                </div>
		        </div>
		        <div class="modal-footer">
		          	<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
		          	<button type="submit" class="btn btn-success" name="simpan_bahan_baku">Simpan</button>
		        </div>
	        </form>
    	</div>
	</div>
</div>

<!-- Modal Ubah -->
<div class="modal fade" id="modalUbah" role="dialog">
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
	                  	<label for="inputKode" class="col-sm-3">Kode Barang</label>
	                  	<div class="col-sm-9">
	                  		<div class="input-group">
				                <span class="input-group-addon"><i class="fa fa-check"></i></span>
				                <input type="text" name="u_kode" id="u_kode" class="form-control" placeholder="Kode Barang" required="" disabled="">
			            	</div>
			            </div>
	                </div>

		          	<div class="form-group">
	                  	<label for="inputNama" class="col-sm-3">Nama Barang</label>
	                  	<div class="col-sm-9">
	                  		<div class="input-group">
				                <span class="input-group-addon"><i class="fa fa-cubes"></i></span>
				                <input type="text" name="u_nama" id="u_nama" class="form-control" placeholder="Nama Barang" required="" autofocus="">
			            	</div>
			            </div>
	                </div>
	                <div class="form-group">
	                  	<label for="inputSatuan" class="col-sm-3">Satuan</label>
	                  	<div class="col-sm-9">
	                  		<div class="input-group">
				                <span class="input-group-addon"><i class="fa fa-check"></i></span>
				                <input type="text" name="u_satuan" id="u_satuan" class="form-control" placeholder="Misal : kilogram" required="">
			            	</div>
			            </div>
	                </div>
		        </div>
		        <div class="modal-footer">
		          	<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
		          	<button type="submit" class="btn btn-success" name="ubah_bahan_baku">Simpan Perubahan</button>
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
		          	<button type="submit" class="btn btn-danger" name="hapus_bahan_baku">Hapus</button>
		        </div>
	        </form>
    	</div>
	</div>
</div>

<!-- Modal Detail -->
<div class="modal fade" id="modalDetail" role="dialog">
    <div class="modal-dialog modal-md">
      	<div class="modal-content">
        	<div class="modal-header">
	          	<button type="button" class="close" data-dismiss="modal">&times;</button>
	          	<h4 class="modal-title"><i class="fa fa-file-text-o text-black"></i> Detail Barang</h4>
	        </div>
	        <form action="" method="post" accept-charset="utf-8" class="form-horizontal">
	        	<div class="modal-body">
		          	<div class="form-group">
	                  	<label for="inputKode" class="col-sm-3">Kode Barang</label>
	                  	<div class="col-sm-9">
	                  		<div class="input-group">
				                <span class="input-group-addon">:</span>
				                <input type="text" name="d_kode" id="d_kode" class="form-control" placeholder="Kode Barang" required="" disabled="">
			            	</div>
			            </div>
	                </div>
		          	<div class="form-group">
	                  	<label for="inputNama" class="col-sm-3">Nama Barang</label>
	                  	<div class="col-sm-9">
	                  		<div class="input-group">
				                <span class="input-group-addon">:</span>
				                <input type="text" name="d_nama" id="d_nama" class="form-control" placeholder="Nama Barang" required="" disabled="">
			            	</div>
			            </div>
	                </div>
	                <div class="form-group">
	                  	<label for="inputDetail" class="col-sm-3">Stok / Kadaluarsa</label>
	                  	<div id="tampilData"></div>
	                </div>
		        </div>
		        <div class="modal-footer">
		          	<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
		        </div>
	        </form>
    	</div>
	</div>
</div>


<script type="text/javascript">
	
	function ubah(id, kode, nama, satuan){
		$('.modal-body input[name=id]').val(id);
		$('.modal-body input[name=u_kode]').val(kode);
		$('.modal-body input[name=u_nama]').val(nama);
		$('.modal-body input[name=u_satuan]').val(satuan);
	}

	function hapus(id){
		$('.modal-body input[name=id]').val(id);
	}

	function detail(id, kode, nama, satuan){
		$('.modal-body input[name=d_kode]').val(kode);
		$('.modal-body input[name=d_nama]').val(nama);
		$('.modal-body input[name=d_satuan]').val(satuan);

		<?php $id_bb = "?>"+ 11 +"<?php " ?>
		var data = '<?php
		$sql = "SELECT stok, tanggal_kadaluarsa, satuan FROM detail_bahan_baku, bahan_baku WHERE bahan_baku.id=detail_bahan_baku.id_bahan_baku AND id_bahan_baku=$id_bb";
		$result = mysqli_query($conn, $sql);
		while ($row=mysqli_fetch_assoc($result)) {
			$stok = $row["stok"];
			$tanggal_kadaluarsa = $row["tanggal_kadaluarsa"]; 
			$satuan = $row["satuan"]; ?>'+
			'<div class="col-sm-4">'+
          		'<div class="input-group">'+
	                '<span class="input-group-addon"><i class="fa fa-cubes"></i></span>'+
	                '<input type="text" name="d_stok" id="d_stok" class="form-control" value="<?= $stok.' '.strtolower($satuan) ?>" placeholder="" required="" disabled="">'+
            	'</div>'+
            '</div>'+
            '<div class="col-sm-1">'+
          		'<div class="input-group">'+
	                '<span class="input-group-addon">/</span>'+
            	'</div>'+
            '</div>'+
            '<div class="col-sm-4">'+
          		'<div class="input-group">'+
	                '<span class="input-group-addon"><i class="fa fa-calendar"></i></span>'+
	                '<input type="text" name="d_tanggal_kadaluarsa" id="d_tanggal_kadaluarsa" class="form-control" value="<?= Tanggal($tanggal_kadaluarsa) ?>" placeholder="" required="" disabled="">'+
            	'</div>'+
            '</div>'+
      		'<label for="inputDetail" class="col-sm-3"></label>'+
			'<?php 
		}
		?>'
		document.getElementById("tampilData").innerHTML = data;
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
