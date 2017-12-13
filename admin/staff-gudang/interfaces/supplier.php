<title>Supplier</title>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 style="opacity: 0">
        .
      </h1>
      <ol class="breadcrumb">
        <li><a href="?menu=beranda"><i class="fa fa-home"></i> Beranda</a></li>
        <li class="active">Supplier</li>
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
		              	<li class="active"><a href="#tab_2-2" data-toggle="tab">Daftar Supplier</a></li>
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
		             	<li class="pull-left header"><i class="fa fa-building"></i> Daftar Supplier</li>
		            </ul>
		            <div class="tab-content">
		              	<div class="tab-pane active" id="tab_2-2">
		                	<table id="example1" class="table table-striped table-bordered dt-responsive nowrap">
				                <thead>
				                <tr class="bg-success">
				                  	<th>No</th>
				                  	<th>Nama Supplier</th>
				                  	<th>Alamat</th>
				                  	<th class="text-center">Waktu Pengiriman</th>
				                  	<th></th>
				                </tr>
				                </thead>
				                <tbody>

					                <?php
					                $sql = "SELECT id, nama, alamat, waktu_pengiriman FROM supplier";
									$result = mysqli_query($conn, $sql);

									if (mysqli_num_rows($result) > 0) {
										$no = 1;
									    // keluarkan data dalam variabel row
									    while($row = mysqli_fetch_assoc($result)) {
									    	$id = $row['id'];
									    	$nama = $row['nama'];
									    	$alamat = $row['alamat'];
									    	$waktu_pengiriman = $row['waktu_pengiriman'];
									        ?>
									        <tr>
							                  	<td><?= $no++; ?></td>
							                  	<td><?= strtoupper($row['nama']) ?></td>
							                  	<td><?= $row['alamat'] ?></td>
							                  	<td class="text-center"><?= $row['waktu_pengiriman'] ?> hari</td>
							                  	<td width="10%" class="text-right">
							                  		<a href="?id=<?= $id ?>&menu=detail-supplier" class="btn btn-sm btn-default" title="Barang yang dijual"><i class="fa fa-cubes"></i></a>
							                  		<button class="btn btn-sm btn-warning" title="Ubah Data" data-toggle="modal" data-target="#modalUbah" onclick="return ubah('<?= $id ?>','<?= $nama ?>','<?= $alamat ?>','<?= $waktu_pengiriman ?>')"><i class="fa fa-edit"></i></button>
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
	          	<h4 class="modal-title"><i class="fa fa-plus text-green"></i> Tambah Data</h4>
	        </div>
	        <form action="" method="post" accept-charset="utf-8" class="form-horizontal">
	        	<div class="modal-body">
		          	<div class="form-group">
	                  	<label for="inputNama" class="col-sm-2">Nama Supplier</label>
	                  	<div class="col-sm-10">
	                  		<div class="input-group">
				                <span class="input-group-addon"><i class="fa fa-building"></i></span>
				                <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama Supplier" required="" autofocus="">
			            	</div>
			            </div>
	                </div>
	                <div class="form-group">
	                  	<label for="inputAlamat" class="col-sm-2">Alamat Supplier</label>
	                  	<div class="col-sm-10">
			            	<textarea name="alamat" id="alamat" class="form-control" rows="3" required=""></textarea>
	                	</div>
	                </div>
	                <div class="form-group">
	                  	<label for="inputWaktuPengiriman" class="col-sm-2">Waktu Pengiriman</label>
		                <div class="col-sm-10">  	
		                  	<div class="input-group">
				                <input type="number" name="waktu_pengiriman" id="waktu_pengiriman" class="form-control" min="0" placeholder="0" required="">
				                <span class="input-group-addon">hari</span>
				            </div>
				        </div>   
	                </div>
	                <div class="form-group after-add-more">
	                  	<label for="inputJenis" class="col-sm-2">Jenis Barang</label>
	                  	<div class="col-sm-4">
		                  	<div class="input-group">
				                <span class="input-group-addon"><i class="fa fa-cubes"></i></span>
				                <select class="form-control select" style="width: 100%;" name="jenis[]" id="jenis[]" required="">	
				                	<?php
				                	$sql = "SELECT id, kode, nama, satuan FROM bahan_baku";
				                	$result = mysqli_query($conn, $sql);
				                	while ($row = mysqli_fetch_assoc($result)) {
				                		?>
				                		<option value="<?= $row['id'] ?>"><?= $row['kode'].' - '.$row['nama'] ?></option>
				                		<?php
				                	} ?>
				                </select>
				                <div class="input-group-btn"> 
				                	<button class="btn btn-success add-more" type="button"><i class="fa fa-plus"></i></button>
				            	</div>
				            </div>
				        </div>   
				        <div class="col-sm-3">  	
		                  	<div class="input-group">
				                <span class="input-group-addon">Rp.</span>
				                <input type="number" name="harga[]" id="harga[]" class="form-control" min="0" placeholder="Harga" required="">
				            </div>
				        </div> 
				        <div class="col-sm-3">  
		                  	<div class="input-group">
				                <span class="input-group-addon"><i class="fa fa-check"></i></span>
				                <input type="text" name="satuan[]" id="satuan[]" class="form-control" placeholder="Misal: kilogram" required="">
				            </div>
				        </div> 
	                </div>
		        </div>
		        <div class="modal-footer">
		          	<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
		          	<button type="submit" class="btn btn-success" name="simpan_supplier">Simpan</button>
		        </div>
	        </form>
    	</div>
	</div>
</div>

<!-- Tambahkan inputan (append) di form Tambah -->
<div class="copy hide">
	<div class="form-group control-group">
  		<label for="inputJenis" class="col-sm-2"></label>
  		<div class="col-sm-4">
          	<div class="input-group">
                <span class="input-group-addon"><i class="fa fa-cubes"></i></span>
            	<select class="form-control select" style="width: 100%;" name="jenis[]" id="jenis[]" required="">	
                	<?php
                	$sql = "SELECT id, kode, nama, satuan FROM bahan_baku";
                	$result = mysqli_query($conn, $sql);
                	while ($row = mysqli_fetch_assoc($result)) {
                		?>
                		<option value="<?= $row['id'] ?>"><?= $row['kode'].' - '.$row['nama'] ?></option>
                		<?php
                	} ?>
                </select>
            	<div class="input-group-btn"> 
              		<button class="btn btn-danger remove" type="button"><i class="fa fa-trash"></i></button>
            	</div>
            </div>	
      	</div>
      	<div class="col-sm-3">
          	<div class="input-group">
                <span class="input-group-addon">Rp.</span>
                <input type="number" name="harga[]" id="harga[]" class="form-control" min="0" placeholder="Harga" required="">
            </div>	
      	</div>
      	<div class="col-sm-3">
          	<div class="input-group">
                <span class="input-group-addon"><i class="fa fa-check"></i></span>
                <input type="text" name="satuan[]" id="satuan[]" class="form-control" placeholder="Misal: kilogram" required="">
            </div>
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
	                  	<label for="inputNama" class="col-sm-3">Nama Supplier</label>
	                  	<div class="col-sm-9">
	                  		<div class="input-group">
				                <span class="input-group-addon"><i class="fa fa-building"></i></span>
				                <input type="text" name="u_nama" id="u_nama" class="form-control" placeholder="Nama Supplier" required="" autofocus="">
			            	</div>
			            </div>
	                </div>
	                <div class="form-group">
	                  	<label for="inputAlamat" class="col-sm-3">Alamat Supplier</label>
	                  	<div class="col-sm-9">
			            	<textarea name="u_alamat" id="u_alamat" class="form-control" rows="3" required=""></textarea>
	                	</div>
	                </div>
	                <div class="form-group">
	                  	<label for="inputWaktuPengiriman" class="col-sm-3">Waktu Pengiriman</label>
		                <div class="col-sm-9">  	
		                  	<div class="input-group">
				                <input type="number" name="u_waktu_pengiriman" id="u_waktu_pengiriman" class="form-control" min="0" placeholder="0" required="">
				                <span class="input-group-addon">hari</span>
				            </div>
				        </div>    
	                </div>
		        </div>
		        <div class="modal-footer">
		          	<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
		          	<button type="submit" class="btn btn-success" name="ubah_supplier">Simpan Perubahan</button>
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
		          	<button type="submit" class="btn btn-danger" name="hapus_supplier">Hapus</button>
		        </div>
	        </form>
    	</div>
	</div>
</div>

<script type="text/javascript">
	function ubah(id, nama, alamat, waktu_pengiriman){
		$('.modal-body input[name=id]').val(id);
		$('.modal-body input[name=u_nama]').val(nama);
		$('.modal-body textarea[name=u_alamat]').val(alamat);
		$('.modal-body input[name=u_waktu_pengiriman]').val(waktu_pengiriman);
	}

	function hapus(id){
		$('.modal-body input[name=id]').val(id);
	}

	$(document).ready(function() {

      	$(".add-more").click(function(){ 
          	var html = $(".copy").html();
          	$(".after-add-more").after(html);
      	});

      	$("body").on("click",".remove",function(){ 
          	$(this).parents(".control-group").remove();
      	});

    });
    
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
