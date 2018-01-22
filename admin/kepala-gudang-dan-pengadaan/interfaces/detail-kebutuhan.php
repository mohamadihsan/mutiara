<title>Produk</title>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 style="opacity: 0">
        .
      </h1>
      <ol class="breadcrumb">
        <li><a href="?menu=beranda"><i class="fa fa-home"></i> Beranda</a></li>
        <li class="active">Kebutuhan</li>
      </ol>
    </section>
	<!-- Main content -->
    <section class="content">
      	<div class="row">
        	<div class="col-xs-12">
        		<!-- Custom Tabs (Pulled to the right) -->
		        <div class="nav-tabs-custom">
		            <ul class="nav nav-tabs pull-right">
		              	<!-- <li><a href="" data-toggle="modal" data-target="#modalTambah" class="text-bold"><i class="fa fa-plus text-success"></i> Tambah</a></li> -->
		              	<!-- <li class="active"><a href="#tab_2-2" data-toggle="tab">Daftar Produk</a></li> -->
		             	<li class="pull-left header"><i class="fa fa-cube"></i> Daftar Kebutuhan Bahan Baku</li>
		            </ul>
		            <div class="tab-content">
		              	<div class="tab-pane active" id="tab_2-2">
                            <?php
                            $id_produk = $_GET['id'];
                            $peramalan = $_GET['f'];
                            $periode = $_GET['periode'];
                            $sql = "SELECT nama, kode, satuan FROM produk WHERE id='$id_produk'";
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_assoc($result)
                            ?>
                            <table class="table table-responsive">
                                <tr>
                                    <th width="20%">Nama Produk</th>
                                    <td>: <?= $row['kode'].' - '.$row['nama'] ?></td>
                                </tr>
                                <tr>
                                    <th>Periode Peramalan</th>
                                    <td>: <?= $periode ?></td>
                                </tr>
                                <tr>
                                    <th>Jumlah Peramalan</th>
                                    <td>: <?= $peramalan. ' '.$row['satuan'] ?></td>
                                </tr>
                            </table>
		                	<table id="example1" class="table table-striped table-bordered dt-responsive nowrap">
				                <thead>
				                <tr class="bg-success">
				                  	<th width="5%">No</th>
				                  	<th>Bahan Baku</th>
				                  	<th width="10%">Kebutuhan</th>
				                  	<th width="10%">Satuan</th>
				                </tr>
				                </thead>
				                <tbody>

					                <?php
                                    $id_produk = $_GET['id'];
                                    $peramalan = $_GET['f'];
					                $sql = "SELECT
                                            	k.id_bahan_baku,
                                            	k.takaran,
                                            	k.satuan,
                                            	bb.kode AS kode_bahan_baku,
                                            	bb.nama AS nama_bahan_baku,
                                            	p.kode AS kode_produk,
                                            	p.nama AS nama_produk
                                            FROM
                                            	komposisi k
                                            LEFT JOIN bahan_baku bb ON bb.id = k.id_bahan_baku
                                            LEFT JOIN produk p ON p.id = k.id_produk
                                            WHERE
                                            	k.id_produk = '$id_produk'";
									$result = mysqli_query($conn, $sql);

									if (mysqli_num_rows($result) > 0) {
										$no = 1;
									    // keluarkan data dalam variabel row
									    while($row = mysqli_fetch_assoc($result)) {
									    	$id_bahan_baku 		= $row['id_bahan_baku'];
									    	$takaran 			= $row['takaran'];
									    	$satuan 			= $row['satuan'];
									    	$kode_bahan_baku 	= $row['kode_bahan_baku'];
									    	$nama_bahan_baku 	= $row['nama_bahan_baku'];
									    	$kode_produk 		= $row['kode_produk'];
									    	$nama_produk 	    = $row['nama_produk'];
                                            $kebutuhan          = $takaran * $peramalan;
									        ?>
									        <tr>
							                  	<td><?= $no++; ?></td>
							                  	<td><?= $kode_bahan_baku.' - '.$nama_bahan_baku ?></td>
							                  	<td><?= $kebutuhan ?></td>
							                  	<td><?= ucwords($row['satuan']) ?></td>
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
