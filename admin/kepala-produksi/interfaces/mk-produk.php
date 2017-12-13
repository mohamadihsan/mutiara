<title>Barang Masuk & Keluar</title>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 style="opacity: 0">
        .
      </h1>
      <ol class="breadcrumb">
        <li><a href="?menu=beranda"><i class="fa fa-home"></i> Beranda</a></li>
        <li class="active">Masuk & Keluar Produk</li>
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
		              	<li class="active"><a href="#tab_2-2" data-toggle="tab">Barang Masuk & Keluar</a></li>
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
		             	<li class="pull-left header"><i class="fa fa-building"></i> Barang Masuk & Keluar <small>(Produk)</small></li>
		            </ul>
		            <div class="tab-content">
		              	<div class="tab-pane active" id="tab_2-2">
		                	<table id="example1" class="table table-striped table-bordered dt-responsive nowrap">
				                <thead>
				                <tr class="bg-success">
				                  	<th width="5%">No</th>
				                  	<th>Kode</th>
				                  	<th>Nama</th>
				                  	<th class="text-center">Jumlah</th>
				                  	<th class="text-center">Status</th>
				                  	<th>Waktu</th>
				                  	<th></th>
				                </tr>
				                </thead>
				                <tbody>

					                <?php
					                $sql = "SELECT arus_produk.id, arus_produk.id_produk, kode, nama, jenis_kemasan, satuan, waktu, status, jumlah,  DATE_FORMAT(waktu, '%H:%i:%s') AS jam FROM produk, arus_produk WHERE produk.id=arus_produk.id_produk";
									$result = mysqli_query($conn, $sql);

									if (mysqli_num_rows($result) > 0) {
										$no = 1;
									    // keluarkan data dalam variabel row
									    while($row = mysqli_fetch_assoc($result)) {
									    	$id = $row['id'];
									    	$id_produk = $row['id_produk'];
									    	$kode = $row['kode'];
									    	$nama = $row['nama'];
									    	$satuan = $row['satuan'];
									    	$jenis_kemasan = $row['jenis_kemasan'];
									    	$waktu = $row['waktu'];
									    	$jam = $row['jam'];
									    	$status = $row['status'];
									    	$jumlah = $row['jumlah'];

									    	if ($status == "masuk") {
												$cetak_status = '<span class="label label-success">masuk</span>';
											}else{
												$cetak_status = '<span class="label label-danger">keluar</span>';
											}
									    	?>
									        <tr>
							                  	<td><?= $no++; ?></td>
							                  	<td><?= strtoupper($row['kode']) ?></td>
							                  	<td><?= ucwords($row['nama']).' '.strtolower($jenis_kemasan) ?></td>
							                  	<td class="text-center"><?= $row['jumlah'].' '.ucwords($row['satuan']) ?></td>
							                  	<td class="text-center"><?= $cetak_status ?></td>
							                  	<td><?= Tanggal($row['waktu']).' ('.$jam.')' ?></td>
							                  	<td width="10%" class="text-right">
							                  		<button class="btn btn-sm btn-warning" title="Ubah Data" data-toggle="modal" data-target="#modalUbah" onclick="return ubah('<?= $id ?>','<?= $id_produk ?>','<?= $status ?>','<?= $jumlah ?>')"><i class="fa fa-edit"></i></button>
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
	                  	<label for="inputNama" class="col-sm-3">Barang</label>
	                  	<div class="col-sm-9">
	                  		<div class="input-group">
				                <span class="input-group-addon"><i class="fa fa-cubes"></i></span>
				                <select class="form-control select2" style="width: 100%;" name="id_produk" id="id_produk" required="">	
				                	<?php  
				                	$sql = "SELECT id, kode, nama, jenis_kemasan, satuan FROM produk";
				                	$result = mysqli_query($conn, $sql);
				                	while ($row=mysqli_fetch_assoc($result)) {
				                		?>
				                		<option value="<?= $row['id'] ?>"><?= strtoupper($row['kode']).' - '.ucwords($row['nama']).' '.strtolower($row['jenis_kemasan']) ?></option>
				                		<?php
				                	}
				                	?>
				                </select>
				            </div>
			            </div>
	                </div>
		          	<div class="form-group">
	                  	<label for="inputNama" class="col-sm-3">Status</label>
	                  	<div class="col-sm-9">
			                <input type="radio" name="status" id="status" class="flat-red" value="masuk" checked=""><b class="text-success">MASUK</b>
			                <input type="radio" name="status" id="status" class="flat-red" value="keluar"><b class="text-danger">KELUAR</b>
			            </div>
	                </div>
	                <div class="form-group after-add-more">
	                  	<label for="inputJenis" class="col-sm-3">Detail Barang</label>
	                  	<div class="col-sm-4">
		                  	<div class="input-group">
				                <input type="number" name="jumlah[]" id="jumlah[]" class="form-control" placeholder="Jumlah Brg" min="1" required="">
				                <div class="input-group-btn"> 
				                	<button class="btn btn-success add-more" type="button"><i class="fa fa-plus"></i></button>
				            	</div>
				            </div>
				        </div>   
				        <div class="col-sm-5">  	
		                  	<!-- <div class="input-group date">
					                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
					                <input type="text" class="form-control pull-right" id="datepicker" placeholder="Tanggal Kadaluarsa Barang">
					            </div> -->
				            <div class="input-group">
				                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
				                <input type="date" class="form-control pull-right" name="tanggal_kadaluarsa[]" id="tanggal_kadaluarsa[]" placeholder="Tanggal Kadaluarsa Barang">
				            </div>
				            <span class="help-block text-sm text-success">*Tanggal Kadaluarsa</span>
				        </div> 
	                </div>
	                
		        </div>
		        <div class="modal-footer">
		          	<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
		          	<button type="submit" class="btn btn-success" name="simpan_mk_produk">Simpan</button>
		        </div>
	        </form>
    	</div>
	</div>
</div>

<!-- Tambahkan inputan (append) di Form Tambah-->
<div class="copy hide">
	<div class="form-group control-group">
  		<label for="inputJenis" class="col-sm-3"></label>
      	<div class="col-sm-4">
          	<div class="input-group">
                <input type="number" name="jumlah[]" id="jumlah[]" class="form-control" placeholder="Jumlah Barang" min="1" required="">
                <div class="input-group-btn"> 
              		<button class="btn btn-danger remove" type="button"><i class="fa fa-trash"></i></button>
            	</div>
            </div>
        </div>   
        <div class="col-sm-5">  	
          	<!-- <div class="input-group date">
                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                <input type="text" class="form-control pull-right" id="datepicker" placeholder="Tanggal Kadaluarsa Barang">
            </div> -->
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                <input type="date" class="form-control pull-right" name="tanggal_kadaluarsa[]" id="tanggal_kadaluarsa[]" placeholder="Tanggal Kadaluarsa Barang">
            </div>
        	<span class="help-block text-sm text-success">*Tanggal Kadaluarsa</span>
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
	                  	<label for="inputNama" class="col-sm-3">Barang</label>
	                  	<div class="col-sm-9">
	                  		<div class="input-group">
				                <span class="input-group-addon"><i class="fa fa-cubes"></i></span>
				                <select class="form-control select" style="width: 100%;" name="u_id_produk" id="u_id_produk" required="">	
				                	<?php  
				                	$sql = "SELECT id, kode, nama, jenis_kemasan, satuan FROM produk";
				                	$result = mysqli_query($conn, $sql);
				                	while ($row=mysqli_fetch_assoc($result)) {
				                		?>
				                		<option value="<?= $row['id'] ?>"><?= strtoupper($row['kode']).' - '.ucwords($row['nama']).' '.strtolower($row['jenis_kemasan']) ?></option>
				                		<?php
				                	}
				                	?>
				                </select>
				            </div>
			            </div>
	                </div>
		          	<div class="form-group">
	                  	<label for="inputStatus" class="col-sm-3">Status</label>
	                  	<div class="col-sm-9">
			                <div id="input"></div>
			            </div>
	                </div>
	                <div class="form-group">
	                  	<label for="inputJumlah" class="col-sm-3">Jumlah Barang</label>
	                  	<div class="col-sm-9">
		                  	<div class="input-group">
				                <input type="number" name="u_jumlah" id="u_jumlah" class="form-control" placeholder="Jumlah Brg" min="1" required="">
				                <span class="input-group-addon"><i class="fa fa-cubes"></i></span>
				            </div>
				        </div>   
	                </div>
		        </div>
		        <div class="modal-footer">
		          	<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
		          	<button type="submit" class="btn btn-success" name="ubah_mk_produk">Simpan Perubahan</button>
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
		          	<button type="submit" class="btn btn-danger" name="hapus_mk_produk">Hapus</button>
		        </div>
	        </form>
    	</div>
	</div>
</div>


<script type="text/javascript">
	
	function ubah(id, id_produk, status, jumlah){
		$('.modal-body input[name=id]').val(id);
		$('.modal-body select[name=u_id_produk]').val(id_produk);
		$('.modal-body input[name=u_status]').val(status);
		$('.modal-body input[name=u_jumlah]').val(jumlah);
		if(status=="masuk"){
			var input = "<input type='radio' name='u_status' id='u_status' class='flat-red' value='masuk' checked><b class='text-success'>MASUK</b><input type='radio' name='u_status' id='u_status' class='flat-red' value='keluar'><b class='text-danger'>KELUAR</b>"
		}else{
			var input = "<input type='radio' name='u_status' id='u_status' class='flat-red' value='masuk'><b class='text-success'>MASUK</b><input type='radio' name='u_status' id='u_status' class='flat-red' value='keluar' checked><b class='text-danger'>KELUAR</b>"
		}
		document.getElementById("input").innerHTML = input;
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

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
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
