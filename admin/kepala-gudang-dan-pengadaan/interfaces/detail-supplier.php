<title>Detail Supplier</title>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 style="opacity: 0">
        .
      </h1>
      <ol class="breadcrumb">
        <li><a href="?menu=beranda"><i class="fa fa-home"></i> Beranda</a></li>
        <li><a href="?menu=supplier"><i class="fa fa-building-o"></i> Supplier</a></li>
        <li class="active">Barang yang dijual</li>
      </ol>
    </section>
	<!-- Main content -->
    <section class="content">
      	<div class="row">
        	<div class="col-xs-12">
        		<!-- Custom Tabs (Pulled to the right) -->
		        <div class="nav-tabs-custom">
		            <ul class="nav nav-tabs pull-right">
		              	<li><a href="?menu=supplier" class="text-bold"><i class="fa fa-arrow-left text-black"></i> Kembali</a></li>
		              	<li><a href="" data-toggle="modal" data-target="#modalTambah" class="text-bold"><i class="fa fa-plus text-success"></i> Tambah</a></li>
		              	<li class="active"><a href="#tab_2-2" data-toggle="tab">Data Barang yang dijual</a></li>
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
		             	<li class="pull-left header"><i class="fa fa-file-text-o"></i> Daftar Barang</li>
		            </ul>
		            <div class="tab-content">
		              	<div class="tab-pane active" id="tab_2-2">
		                	<table id="example1" class="table table-striped table-bordered dt-responsive nowrap">
				                <thead>
				                <tr class="bg-success">
				                  	<th width="5%">No</th>
				                  	<th>Supplier</th>
				                  	<th>Barang</th>
				                  	<th width="15%">Harga</th>
				                  	<th width="10%">Satuan</th>
				                  	<th></th>
				                </tr>
				                </thead>
				                <tbody>

					                <?php
					                $id = $_GET['id'];
					                $sql = "SELECT supplier.nama, alamat, waktu_pengiriman, id_supplier, jenis, harga, detail_supplier.satuan, kode, bahan_baku.nama as nama_barang  FROM supplier, detail_supplier, bahan_baku WHERE supplier.id=detail_supplier.id_supplier AND detail_supplier.jenis=bahan_baku.id AND supplier.id='$id'";
									$result = mysqli_query($conn, $sql);

									if (mysqli_num_rows($result) > 0) {
										$no = 1;
									    // keluarkan data dalam variabel row
									    while($row = mysqli_fetch_assoc($result)) {
									    	$nama = $row['nama'];
									    	$alamat = $row['alamat'];
									    	$waktu_pengiriman = $row['waktu_pengiriman'];
									    	$id = $row['id_supplier'];
									    	$jenis = $row['jenis'];
									    	$harga = $row['harga'];
									    	$satuan = $row['satuan'];
									    	$kode = $row['kode'];
									    	$nama_barang = $row['nama_barang'];
									        ?>
									        <tr>
							                  	<td><?= $no++; ?></td>
							                  	<td><?= strtoupper($row['nama']) ?></td>
							                  	<td><?= strtoupper($row['kode']).' - '.ucwords($row['nama_barang']) ?></td>
							                  	<td>Rp.<?= Rupiah($harga) ?></td>
							                  	<td>/<?= strtolower($row['satuan']) ?></td>
							                  	<td width="10%" class="text-right">
							                  		<button class="btn btn-sm btn-warning" title="Ubah Data" data-toggle="modal" data-target="#modalUbah" onclick="return ubah('<?= $id ?>','<?= $jenis ?>','<?= $harga ?>','<?= $satuan ?>')"><i class="fa fa-edit"></i></button>
							                  		<button class="btn btn-sm btn-danger" title="Hapus Data" data-toggle="modal" data-target="#modalHapus" onclick="return hapus('<?= $id ?>','<?= $jenis ?>')"><i class="fa fa-trash"></i></button>
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

	        		<!-- ID  -->
	        		<input type="hidden" name="id" id="id" class="form-control" value="<?= $_GET['id'] ?>" placeholder="" required="">

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
		          	<button type="submit" class="btn btn-success" name="simpan_detail_supplier">Simpan</button>
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
    <div class="modal-dialog modal-lg">
      	<div class="modal-content">
        	<div class="modal-header">
	          	<button type="button" class="close" data-dismiss="modal">&times;</button>
	          	<h4 class="modal-title"><i class="fa fa-edit text-yellow"></i> Ubah Data</h4>
	        </div>
	        <form action="" method="post" accept-charset="utf-8" class="form-horizontal">
	        	<div class="modal-body">

	        		<!-- ID  -->
	        		<input type="hidden" name="id" id="id" class="form-control" placeholder="" required="">
	        		<!-- Jenis Lama  -->
	        		<input type="hidden" name="jenis_lama" id="jenis_lama" class="form-control" placeholder="" required="">

		          	<div class="form-group">
	                  	<label for="inputJenis" class="col-sm-2">Jenis Barang</label>
	                  	<div class="col-sm-4">
		                  	<div class="input-group">
				                <span class="input-group-addon"><i class="fa fa-cubes"></i></span>
				                <select class="form-control select" style="width: 100%;" name="u_jenis" id="u_jenis" required="">	
				                	<?php
				                	$sql = "SELECT id, kode, nama, satuan FROM bahan_baku";
				                	$result = mysqli_query($conn, $sql);
				                	while ($row = mysqli_fetch_assoc($result)) {
				                		?>
				                		<option value="<?= $row['id'] ?>"><?= $row['kode'].' - '.$row['nama'] ?></option>
				                		<?php
				                	} ?>
				                </select>
				            </div>
				        </div>   
				        <div class="col-sm-3">  	
		                  	<div class="input-group">
				                <span class="input-group-addon">Rp.</span>
				                <input type="number" name="u_harga" id="u_harga" class="form-control" min="0" placeholder="Harga" required="">
				            </div>
				        </div> 
				        <div class="col-sm-3">  
		                  	<div class="input-group">
				                <span class="input-group-addon"><i class="fa fa-check"></i></span>
				                <input type="text" name="u_satuan" id="u_satuan" class="form-control" placeholder="Misal: kilogram" required="">
				            </div>
				        </div> 
	                </div>
		        </div>
		        <div class="modal-footer">
		          	<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
		          	<button type="submit" class="btn btn-success" name="ubah_detail_supplier">Simpan Perubahan</button>
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
	        		<!-- Jenis -->
	        		<input type="hidden" name="jenis" id="jenis" class="form-control" placeholder="" required="">

		          	<p>Apakah anda yakin akan menghapus data ini?</p>
		        </div>
		        <div class="modal-footer">
		          	<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
		          	<button type="submit" class="btn btn-danger" name="hapus_detail_supplier">Hapus</button>
		        </div>
	        </form>
    	</div>
	</div>
</div>

<script type="text/javascript">
	function ubah(id, jenis, harga, satuan){
		$('.modal-body input[name=id]').val(id);
		$('.modal-body select[name=u_jenis]').val(jenis);
		$('.modal-body input[name=jenis_lama]').val(jenis);
		$('.modal-body input[name=u_harga]').val(harga);
		$('.modal-body input[name=u_satuan]').val(satuan);
	}

	function hapus(id,jenis){
		$('.modal-body input[name=id]').val(id);
		$('.modal-body input[name=jenis]').val(jenis);
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