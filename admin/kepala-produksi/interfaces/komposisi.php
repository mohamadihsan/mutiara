<title>Komposisi</title>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 style="opacity: 0">
        .
      </h1>
      <ol class="breadcrumb">
        <li><a href="?menu=beranda"><i class="fa fa-home"></i> Beranda</a></li>
        <li class="active">Komposisi</li>
      </ol>
    </section>
	<!-- Main content -->
    <section class="content">
      	<div class="row">
        	<div class="col-xs-12">
        		<!-- Custom Tabs (Pulled to the right) -->
                <?php
                $id = $_GET['id'];
                $sql = "SELECT nama, kode FROM produk WHERE id='$id'";
                $result = mysqli_query($conn,$sql);
                $row = mysqli_fetch_assoc($result);
                $kode_produk = $row['kode'];
                $nama_produk = $row['nama'];
                ?>
		        <div class="nav-tabs-custom">
		            <ul class="nav nav-tabs pull-right">
		              	<li><a href="" data-toggle="modal" data-target="#modalTambah" class="text-bold"><i class="fa fa-plus text-success"></i> Tambah</a></li>
		              	<li class="active"><a href="#tab_2-2" data-toggle="tab">Komposisi</a></li>
		             	<li class="pull-left header"><i class="fa fa-cube"></i> Komposisi <?= ucwords($nama_produk) ?></li>
		            </ul>
		            <div class="tab-content">
		              	<div class="tab-pane active" id="tab_2-2">
		                	<table id="example1" class="table table-striped table-bordered dt-responsive nowrap">
				                <thead>
				                <tr class="bg-success">
				                  	<th width="5%">No</th>
				                  	<th>Bahan Baku</th>
				                  	<th width="10%">Takaran</th>
				                  	<th width="10%">Satuan</th>
				                  	<th class="text-center" width="10%"></th>
				                </tr>
				                </thead>
				                <tbody>

					                <?php
					                $sql = "SELECT
                                            	k.id_produk,
                                            	k.id_bahan_baku,
                                            	bb.kode,
                                            	bb.nama,
                                            	k.takaran,
                                            	k.satuan
                                            FROM
                                            	komposisi k
                                            LEFT JOIN bahan_baku bb ON bb.id = k.id_bahan_baku
                                            AND k.id_produk = '1'";
									$result = mysqli_query($conn, $sql);

									if (mysqli_num_rows($result) > 0) {
										$no = 1;
									    // keluarkan data dalam variabel row
									    while($row = mysqli_fetch_assoc($result)) {
									    	$id_produk		= $row['id_produk'];
									    	$id_bahan_baku	= $row['id_bahan_baku'];
									    	$kode 			= $row['kode'];
									    	$nama 			= $row['nama'];
									    	$takaran 	    = $row['takaran'];
									    	$satuan 		= $row['satuan'];

									        ?>
									        <tr>
							                  	<td><?= $no++; ?></td>
							                  	<td><?= strtoupper($row['kode']).' - '.ucwords($row['nama']) ?></td>
							                  	<td><?= $row['takaran'] ?></td>
							                  	<td><?= ucwords($row['satuan']) ?></td>
							                  	<td width="10%" class="text-right">
							                  		<!-- <a href="?id=<?= $id ?>&menu=detail-produk" class="btn btn-sm btn-default" title="Detail Barang"><i class="fa fa-file-text-o"></i></a> -->
							                  		<button class="btn btn-sm btn-warning" title="Ubah Data" data-toggle="modal" data-target="#modalUbah" onclick="return ubah('<?= $id_produk ?>','<?= $id_bahan_baku ?>','<?= $takaran ?>','<?= $satuan ?>','<?= $nama ?>')"><i class="fa fa-edit"></i></button>
							                  		<button class="btn btn-sm btn-danger" title="Hapus Data" data-toggle="modal" data-target="#modalHapus" onclick="return hapus('<?= $id_produk ?>','<?= $id_bahan_baku ?>')"><i class="fa fa-trash"></i></button>
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
                <input type="hidden" name="id_produk" id="id_produk" class="form-control" placeholder="" value="<?= $id ?>" required>
	        	<div class="modal-body">
		          	<div class="form-group">
	                  	<label for="inputNama" class="col-sm-3">Kode Barang</label>
	                  	<div class="col-sm-9">
	                  		<div class="input-group">
				                <span class="input-group-addon"><i class="fa fa-cubes"></i></span>
				                <input type="text" name="kode" id="kode" class="form-control" placeholder="Kode Barang" value="<?= $kode_produk ?>" disabled>
			            	</div>
			            </div>
	                </div>
		          	<div class="form-group">
	                  	<label for="inputNama" class="col-sm-3">Nama Barang</label>
	                  	<div class="col-sm-9">
	                  		<div class="input-group">
				                <span class="input-group-addon"><i class="fa fa-cubes"></i></span>
				                <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama Barang" value="<?= $nama_produk ?>" disabled >
			            	</div>
			            </div>
	                </div>
	                <div class="form-group">
	                  	<label for="inputNama" class="col-sm-3">Bahan Baku</label>
	                  	<div class="col-sm-9">
	                  		<div class="input-group">
				                <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
                                <select class="form-control select" name="id_bahan_baku">

                                    <?php
                                    $sql = "SELECT
                                            	bb.id,
                                            	bb.kode,
                                            	bb.nama
                                            FROM
                                            	bahan_baku bb";
                                    $result = mysqli_query($conn, $sql);
                                    while ($row=mysqli_fetch_assoc($result)) {
                                        $id = $row['id'];
                                        $kode = $row['kode'];
                                        $nama = $row['nama'];
                                        ?>
                                        <option value="<?= $id ?>"><?= $kode.' - '.$nama ?></option>
                                        <?php
                                    }
                                    ?>

                                </select>
				            </div>
			            </div>
	                </div>
	                <div class="form-group">
	                  	<label for="inputNama" class="col-sm-3">Takaran</label>
	                  	<div class="col-sm-9">
	                  		<div class="input-group">
				                <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
                                <input type="text" name="takaran" id="takaran" class="form-control" placeholder="Takaran" min="1" required="" >
				            </div>
			            </div>
	                </div>
	                <div class="form-group">
	                  	<label for="inputSatuan" class="col-sm-3">Satuan</label>
	                  	<div class="col-sm-9">
	                  		<div class="input-group">
				                <span class="input-group-addon"><i class="fa fa-check"></i></span>
				                <input type="text" name="satuan" id="satuan" class="form-control" placeholder="Misal : kg" required="">
			            	</div>
			            </div>
	                </div>
		        </div>
		        <div class="modal-footer">
		          	<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
		          	<button type="submit" class="btn btn-success" name="simpan_komposisi">Simpan</button>
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

                    <input type="hidden" name="u_id_produk" id="u_id_produk" class="form-control" placeholder="" value="<?= $id ?>" required>
    	        	<div class="modal-body">
    		          	<div class="form-group">
    	                  	<label for="inputNama" class="col-sm-3">Kode Barang</label>
    	                  	<div class="col-sm-9">
    	                  		<div class="input-group">
    				                <span class="input-group-addon"><i class="fa fa-cubes"></i></span>
    				                <input type="text" name="u_kode" id="u_kode" class="form-control" placeholder="Kode Barang" value="<?= $kode_produk ?>" disabled>
    			            	</div>
    			            </div>
    	                </div>
    		          	<div class="form-group">
    	                  	<label for="inputNama" class="col-sm-3">Nama Barang</label>
    	                  	<div class="col-sm-9">
    	                  		<div class="input-group">
    				                <span class="input-group-addon"><i class="fa fa-cubes"></i></span>
    				                <input type="text" name="u_nama" id="u_nama" class="form-control" placeholder="Nama Barang" value="" disabled >
    			            	</div>
    			            </div>
    	                </div>
    	                <div class="form-group">
    	                  	<label for="inputNama" class="col-sm-3">Bahan Baku</label>
    	                  	<div class="col-sm-9">
    	                  		<div class="input-group">
    				                <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
                                    <select class="form-control select" name="u_id_bahan_baku">

                                        <?php
                                        $sql = "SELECT
                                                	bb.id,
                                                	bb.kode,
                                                	bb.nama
                                                FROM
                                                	bahan_baku bb";
                                        $result = mysqli_query($conn, $sql);
                                        while ($row=mysqli_fetch_assoc($result)) {
                                            $id = $row['id'];
                                            $kode = $row['kode'];
                                            $nama = $row['nama'];
                                            ?>
                                            <option value="<?= $id ?>"><?= $kode.' - '.$nama ?></option>
                                            <?php
                                        }
                                        ?>

                                    </select>
    				            </div>
    			            </div>
    	                </div>
    	                <div class="form-group">
    	                  	<label for="inputNama" class="col-sm-3">Takaran</label>
    	                  	<div class="col-sm-9">
    	                  		<div class="input-group">
    				                <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
                                    <input type="text" name="u_takaran" id="u_takaran" class="form-control" placeholder="Takaran" min="1" required="" >
    				            </div>
    			            </div>
    	                </div>
    	                <div class="form-group">
    	                  	<label for="inputSatuan" class="col-sm-3">Satuan</label>
    	                  	<div class="col-sm-9">
    	                  		<div class="input-group">
    				                <span class="input-group-addon"><i class="fa fa-check"></i></span>
    				                <input type="text" name="u_satuan" id="u_satuan" class="form-control" placeholder="Misal : kg" required="">
    			            	</div>
    			            </div>
    	                </div>
    		        </div>
    		        <div class="modal-footer">
    		          	<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
    		          	<button type="submit" class="btn btn-success" name="ubah_komposisi">Ubah</button>
    		        </div>
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
	        		<input type="hidden" name="id_produk" id="id_produk" class="form-control" placeholder="" required="">
	        		<input type="hidden" name="id_bahan_baku" id="id_bahan_baku" class="form-control" placeholder="" required="">

		          	<p>Apakah anda yakin akan menghapus data ini?</p>
		        </div>
		        <div class="modal-footer">
		          	<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
		          	<button type="submit" class="btn btn-danger" name="hapus_komposisi">Hapus</button>
		        </div>
	        </form>
    	</div>
	</div>
</div>


<script type="text/javascript">

	function ubah(id_produk, id_bahan_baku, takaran, satuan, nama){
		$('.modal-body input[name=u_id_produk]').val(id_produk);
		$('.modal-body input[name=u_id_bahan_baku]').val(id_bahan_baku);
		$('.modal-body input[name=u_takaran]').val(takaran);
		$('.modal-body input[name=u_satuan]').val(satuan);
		$('.modal-body input[name=u_nama]').val(nama);
	}

	function hapus(id_produk, id_bahan_baku){
		$('.modal-body input[name=id_produk]').val(id_produk);
		$('.modal-body input[name=id_bahan_baku]').val(id_bahan_baku);
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
