<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CV.Mekar Sari</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- jQuery 2.2.3 -->
    <script src="assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link href="assets/icons/font-awesome/styles.min.css" rel="stylesheet">
    <!-- icomoon -->
    <link href="assets/icons/icomoon/styles.css" rel="stylesheet">
    <!-- DataTables -->
    <!-- <link rel="stylesheet" href="assets/plugins/datatables/dataTables.bootstrap.css"> -->
    <!-- Datatables -->
    <link href="assets/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
    folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="assets/dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="assets/plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="assets/plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="assets/plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="assets/plugins/daterangepicker/daterangepicker.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="assets/plugins/select2/select2.min.css">
    <!-- gritter notification -->
    <link rel="stylesheet" href="assets/vendors/gritter/jquery.gritter.css" />
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition skin-green-light sidebar-mini">
    <div class="wrapper">
      <header class="main-header">
        <!-- Logo -->
        <a href="" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini">CMS</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg">CV.MEKAR SARI</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="assets/images/katapanda.jpg" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?= ucwords($_SESSION['session_nama_panggilan']) ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                    <p>
                      <?= ucwords($_SESSION['session_nama_lengkap']) ?> - <?= ucwords($_SESSION['session_jabatan']) ?>
                      <small>CV.Mekar Sari</small>
                    </p>
                  </li>
                  <!-- Menu Body -->
                  <li class="user-body">
                    <div class="row">
                      <div class="col-xs-4 text-center">
                        <a href="?menu=profil" class="btn btn-default btn-flat btn-sm"><i class="fa fa-user text-success"></i> Profil</a>
                      </div>
                      <div class="col-xs-4 text-center">
                        
                      </div>
                      <div class="col-xs-4 text-center">
                        <a href="functions/logout.php" class="btn btn-default btn-flat btn-sm"><i class="fa fa-sign-out text-danger"></i> Keluar</a>
                      </div>
                    </div>
                    <!-- /.row -->
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="assets/images/katapanda.jpg" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p>Hallo, <?= ucwords($_SESSION['session_nama_panggilan']) ?></p>
            <i class="fa fa-circle text-success"></i> Online
          </div>
        </div>
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <ul class="sidebar-menu">
            <li class="header">MENU UTAMA</li>

            <li class="<?php if($_GET['menu']=='beranda') echo 'active'; ?>">
              <a href="?menu=beranda">
                <i class="fa fa-home text-green"></i> <span>Beranda</span>
              </a>
            </li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>