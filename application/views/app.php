<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= $tabTitle . ' | ' . APP_NAME ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?= bower('bootstrap/dist/css/bootstrap.min.css') ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= bower('font-awesome/css/font-awesome.min.css') ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= assets('css/AdminLTE.min.css') ?>">
  <link rel="stylesheet" href="<?= assets('css/skin-red.min.css') ?>">
  <link rel="stylesheet" href="<?= bower('bootstrap-timepicker/css/timepicker.min.css') ?>">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-red sidebar-mini fixed">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><?= APP_NAME ?></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><?= APP_NAME ?></span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="<?= base_url('assets/img/user2-160x160.jpg') ?>" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs"><?= sprintf("%s %s", user('firstname'), user('lastname')) ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="<?= base_url('assets/img/user2-160x160.jpg') ?>" class="img-circle" alt="User Image">

                <p>
                 <?= sprintf("%s %s", user('firstname'), user('lastname')) ?>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-right">
                  <a href="<?= site_url('logout') ?>" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <?php $this->load->view('sidebar')?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?= $contentTitle ?>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
    <?= $content ?>
      <!-- Your Page Content Here -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
        AGN &copy; 2016
    </div>
    <!-- Default to the left -->
    <strong>Petron POS 2016
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.2.0 -->
<script src="<?= bower('jquery/dist/jquery.min.js')?>" type="text/javascript"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?= bower('bootstrap/dist/js/bootstrap.min.js')?>" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="<?= bower('jquery-slimscroll/jquery.slimscroll.min.js')?>" type="text/javascript"></script>
<script src="<?= bower('moment/min/moment.min.js')?>" type="text/javascript"></script>
<script src="<?= bower('bootstrap-timepicker/js/bootstrap-timepicker.js')?>" type="text/javascript"></script>
<script src="<?= base_url('node_modules/numeral/min/numeral.min.js') ?>" type="text/javascript"></script>
<script src="<?= assets('js/app.min.js')?>" type="text/javascript"></script>
<script src="<?= assets('js/common.js')?>" type="text/javascript"></script>
</body>
</html>
