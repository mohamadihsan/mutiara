<?php
/*start session*/
session_start();

/*koneksi*/
require_once 'admin/functions/koneksi.php';

/*get data login supplier*/
include_once 'admin/functions/login_supplier.php';
?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Tracking - Mutiara Timur</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/css/form-elements.css">
        <link rel="stylesheet" href="assets/css/style.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="assets/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">

    </head>

    <body>

        <!-- Top content -->
        <div class="top-content">
            <div class="container">

                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2 text">
                        <h1>Tracking Barang <strong>Mutiara Timur</strong></h1>
                        <div class="description">
                       	    <p>
                                Layanan untuk memantau pesanan produk dengan mudah!
                            </p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3 form-box"> -->
                    <div class="">
                        <form action="" method="post">
                            <div class="form-group">
                                <input type="text" name="nomor_faktur" value="<?php if(isset($_POST['nomor_faktur'])) echo $_POST['nomor_faktur'] ?>" class="form-control" placeholder="Silahkan masukkan Nomor Faktur Pesananan Anda...">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                        <?php
                        if (isset($_POST['nomor_faktur'])) {
                            $nomor_faktur_post = $_POST['nomor_faktur'];

                            // set time region
                    		date_default_timezone_set("Asia/Bangkok");

                    		function Tanggal($tanggal) {
                    			$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
                    			$tahun = substr($tanggal, 0, 4);
                    			$bulan = substr($tanggal, 5, 2);
                    			$tgl = substr($tanggal, 8, 2);

                    			$hasil = $tgl . " " . $BulanIndo[(int) $bulan - 1] . " " . $tahun;
                    			return ($hasil);
                    		}

                    		function Rupiah($rupiah) {
                    			//format rupiah
                    			$jumlah_desimal = "2";
                    			$pemisah_desimal = ",";
                    			$pemisah_ribuan = ".";

                    			$hasil = number_format($rupiah, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
                    			return ($hasil);
                    		}

                            $sql = "
                            SELECT
                            	pemesanan_produk.id,
                            	pemesanan_produk.nomor_faktur,
                            	pemesanan_produk.tanggal_pembayaran,
                            	pemesanan_produk.metode_pembayaran,
                            	pemesanan_produk.tanggal,
                            	pemesanan_produk.status_pembayaran,
                            	pelanggan.nama,
                            	pelanggan.kode,
                            	DATE_FORMAT(pemesanan_produk.tanggal, '%H:%i:%s') AS jam_pemesanan,
                            	DATE_FORMAT(
                            		tanggal_pembayaran,
                            		'%H:%i:%s'
                            	) AS jam_pembayaran,
                            	pegawai.nip,
                            	pegawai.nama_panggilan,
                            	pelanggan.alamat,
                            	distribusi.status as status_pengiriman,
                            	distribusi.tanggal AS tanggal_pengiriman
                            FROM
                            	pemesanan_produk
                            LEFT JOIN pelanggan ON pemesanan_produk.pelanggan = pelanggan.id
                            LEFT JOIN pegawai ON pemesanan_produk.pegawai = pegawai.id
                            LEFT JOIN distribusi ON distribusi.nomor_faktur = pemesanan_produk.id
                            WHERE
                            	pemesanan_produk.nomor_faktur = '$nomor_faktur_post'
                            ORDER BY
                            	tanggal DESC";
                            $result = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($result) > 0) {
                                // keluarkan data dalam variabel row
                                $row = mysqli_fetch_assoc($result);
                                $id = $row['id'];
                                $nomor_faktur = $row['nomor_faktur'];
                                $tanggal_pembayaran = $row['tanggal_pembayaran'];
                                $metode_pembayaran = $row['metode_pembayaran'];
                                $status_pembayaran = $row['status_pembayaran'];
                                $tanggal = $row['tanggal'];
                                $nama = $row['nama'];
                                $nama = $row['nama'];
                                $kode = $row['kode'];
                                $jam_pemesanan = $row['jam_pemesanan'];
                                $jam_pembayaran = $row['jam_pembayaran'];
                                $nip = $row['nip'];
                                $alamat = $row['alamat'];
                                $status_pengiriman = $row['status_pengiriman'];
                                $tanggal_pengiriman = $row['tanggal_pengiriman'];

                                $sql_status_po = "SELECT id FROM pemesanan_produk WHERE id='$id'";
                                $result_status_po=mysqli_query($conn,$sql_status_po);
                                $jml=mysqli_num_rows($result_status_po);
                                if ($jml==0) {
                                    $status_po = 'belum disetujui';
                                }else{
                                    $status_po = 'sudah disetujui';
                                }

                                if ($tanggal_pembayaran == null) {
                                    $status = 'Menunggu Pembayaran';
                                }else if($status_pengiriman != '0'){
                                    $status = 'Sudah dikirim';
                                }else{
                                    $status = 'Sedang diproses';
                                }

                                if(date('Y-m-d',strtotime($tanggal_pengiriman)) < date('Y-m-d')){
                                    $status = 'Sudah diterima';
                                }
                                ?>
                                <form role="form" action="" method="post" class="f1">
                            		<div class="f1-steps">
                            			<div class="f1-progress">
                            			    <div class="f1-progress-line" data-now-value="16.66" data-number-of-steps="4" style="width: 16.66%;"></div>
                            			</div>
                            			<div class="f1-step active">
                            				<div class="f1-step-icon"><i class="fa fa-money"></i></div>
                            				<p>Pembayaran</p>
                            			</div>
                            			<div class="f1-step <?php if($tanggal_pembayaran!=null) echo 'active' ?>">
                            				<div class="f1-step-icon"><i class="fa fa-cubes"></i></div>
                            				<p>Sedang diproses</p>
                            			</div>
                            		    <div class="f1-step <?php if($status=='Sudah dikirim') echo 'active' ?>">
                            				<div class="f1-step-icon"><i class="fa fa-truck"></i></div>
                            				<p>Sudah Dikirim</p>
                            			</div>
                            		</div>
                                    <div class="f1-steps">
                            			<!-- <div class="f1-progress">
                            			    <div class="f1-progress-line" data-now-value="16.66" data-number-of-steps="1" style="width: 0%;"></div>
                            			</div> -->
                            			<div class="f1-step ">
                            				<div class=""></div>
                            				<p></p>
                            			</div>
                            		    <div class="f1-step <?php if($status=='Sudah diterima') echo 'active' ?>">
                            				<div class="f1-step-icon"><i class="fa fa-user"></i></div>
                            				<p>Diterima</p>
                            			</div>
                            		</div>

                            		<fieldset>
                            		    <h4>Detail Pesanan:</h4>
                            			<table class="table table-responsive">
                                            <tr>
                                                <th>No. Faktur</th>
                                                <td>: <?= $nomor_faktur ?></td>
                                            </tr>
                                            <tr>
                                                <th>Tanggal Pemesanan</th>
                                                <td>: <?= Tanggal($tanggal) ?></td>
                                            </tr>
                                            <tr>
                                                <th>Tanggal Pengiriman</th>
                                                <td>: <?= Tanggal($tanggal_pengiriman) ?></td>
                                            </tr>
                                            <tr>
                                                <th>Nama Pelanggan</th>
                                                <td>: <?= $nama ?></td>
                                            </tr>
                                            <tr>
                                                <th>Alamat</th>
                                                <td>: <?= $alamat ?></td>
                                            </tr>
                                            <tr>
                                                <th>Status</th>
                                                <td>: <?= $status ?></td>
                                            </tr>
                                        </table>
                                    </fieldset>
                            	</form>
                                <?php
                            }else{
                                ?>
                                <p>Data tidak ditemukan</p>
                                <?php
                            }
                        }
                        ?>

                    </div>
                </div>

            </div>
        </div>


        <!-- Javascript -->
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/retina-1.1.0.min.js"></script>
        <script src="assets/js/scripts.js"></script>

        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->

    </body>

</html>
