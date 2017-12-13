<?php  
/*start session*/
session_start();

/*koneksi*/
require_once 'admin/functions/koneksi.php';

/*get data login supplier*/
include_once 'admin/functions/login_supplier.php';
?>

<!DOCTYPE html>
<html class="no-js">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CV.Mekar Sari</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- jQuery 2.2.3 -->
    <script src="admin/assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
    <!-- Bootstrap and Font Awesome css-->
    <link rel="stylesheet" href="assets/css/font-awesome.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- Google fonts-->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Pacifico">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700">
    <!-- Theme stylesheet-->
    <link rel="stylesheet" href="assets/css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="assets/css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="favicon.png">
    <!-- gritter notification -->
    <link rel="stylesheet" href="admin/assets/vendors/gritter/jquery.gritter.css" />
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body style="background-color: #111111">
    <div style="background-image: url('assets/img/paris.jpg')" class="main"> 
      <div class="overlay"></div>
      <div class="container">
        <p class="social"><a href="#" title="" class="facebook"><i class="fa fa-facebook"></i></a><a href="#" title="" class="twitter"><i class="fa fa-twitter"></i></a><a href="#" title="" class="instagram"><i class="fa fa-instagram"></i></a></p>
        <h1 class="cursive">CV.Mekar Sari</h1>
        <!-- <h2 class="sub">Kami menjual Produk Kecap dan Sauce</h2> -->
        <div class="mailing-list">
          <!-- <h3 class="mailing-list-heading">Silahkan Login untuk memesan produk!</h3> -->
          <div class="row">
            <form method="post" action="" class="form-inline">
              <div class="form-group">
                <label for="nama_pengguna" class="sr-only"></label>
                <input type="text" name="nama_pengguna" placeholder="Nama Pangguna" id="nama_pengguna" class="form-control transparent" required="">
              </div>
              <div class="form-group">
                <label for="kata_sandi" class="sr-only"></label>
                <input type="password" name="kata_sandi" placeholder="Kata Sandi" id="kata_sandi" class="form-control transparent" required="">
              </div>
              <button type="submit" name="login" class="btn btn-success">Login Supplier</button>
              <!-- <button class="btn btn-danger">Daftar </button> -->
            </form>
          </div>
        </div>
      </div>
      <div class="footer">
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <p>&copy;2017 CV.Mekar Sari</p>
            </div>
            <div class="col-md-6">
              <p class="credit">Code by <a href="https://www.bootstrapious.com">Bootstrapious</a><br />& <a href="https://remoteplease.com">RemotePlease</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- <button type="button" data-toggle="collapse" data-target="#style-switch" id="style-switch-button" class="btn btn-template-primary btn-sm"><i class="fa fa-cog fa-2x"></i></button> -->
    <div id="style-switch" class="collapse">
      <h4 class="text-uppercase">Select theme variant</h4>
      <form class="mb-small">
        <select name="page" id="page" class="form-control">
          <option value="">select variant</option>
          <option value="index.html">image background</option>
          <option value="video.html">video background</option>
        </select>
      </form>
    </div>
    <!-- Pesan Proses Login Gagal  -->
    <?php if (isset($_SESSION['error_login'])) {
      ?>
        <script type="text/javascript">
        $(function(){
          $.gritter.add({
              // (string | mandatory) the heading of the notification
              title: 'Gagal!',
              // (string | mandatory) the text inside the notification
              text: 'Error : Nama pengguna dan Kata sandi tidak terdaftar.',
              // (string | optional) the image to display on the left
              image: 'admin/assets/images/gagal.png',
              // (bool | optional) if you want it to fade out on its own or just sit there
              sticky: false,
              // (int | optional) the time you want it to be alive for before fading out
              time: ''
            });
        });
      </script>
        <?php
        /*unset session*/
        unset($_SESSION['error_login']);
    }
    ?>
    <!-- JAVASCRIPT FILES -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="javascripts/vendor/jquery-1.11.0.min.js"><\/script>')</script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.cookie.js"></script>
    <script src="assets/js/front.js"></script>
    <!-- gritter notification -->
    <script src="admin/assets/vendors/gritter/jquery.gritter.min.js"></script> 
    <!-- Google Analytics: change UA-XXXXX-X to be your site's ID.-->
    <script>
      (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
      function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
      e=o.createElement(i);r=o.getElementsByTagName(i)[0];
      e.src='//www.google-analytics.com/analytics.js';
      r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
      ga('create','UA-XXXXX-X');ga('send','pageview');
    </script>
  </body>
</html>