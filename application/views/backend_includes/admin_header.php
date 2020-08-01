<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Jyoti_task | <?php echo $title;?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="shortcut icon" href="<?php echo base_url().LOGO; ?>favicon.png" />
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url().CDN_BACK_DIST_CSS;?>bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url().CDN_BACK_DIST_CSS;?>AdminLTE.min.css">
  <!-- Material Design -->
  <link rel="stylesheet" href="<?php echo base_url().CDN_BACK_DIST_CSS;?>bootstrap-material-design.min.css">
  <link rel="stylesheet" href="<?php echo base_url().CDN_BACK_DIST_CSS;?>ripples.min.css">
  <link rel="stylesheet" href="<?php echo base_url().CDN_BACK_DIST_CSS;?>MaterialAdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo base_url().CDN_BACK_PLUGINS;?>datatables/dataTables.bootstrap.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
 
  <!-- MaterialAdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url().CDN_BACK_DIST_CSS;?>skins/skin-black.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
  <link href="<?php echo base_url().CDN_BACK_PLUGINS;?>croping/css/main.css" rel="stylesheet">
  <link href="<?php echo base_url().CDN_BACK_PLUGINS;?>croping/css/cropper.css" rel="stylesheet">
  <!-- jQuery 2.2.3 -->
  <script src="<?php echo base_url().CDN_BACK_DIST_JS;?>jquery-2.2.3.min.js"></script>
  

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-black sidebar-mini">
<div class="preloader" style="display: none;">
  <div class="loadinner">
    <img src="<?php echo base_url().LOGO; ?>loader.png">
  </div>
</div>
<!-- Site wrapper -->
<div class="wrapper">
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url();?>">
  <header class="main-header">
   <!-- Logo -->
    <a href="../../index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">DASH</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">Dashboard</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <!-- Notifications: style can be found in dropdown.less -->
          <!-- Tasks: style can be found in dropdown.less --> 
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo base_url().LOGO; ?>avatar2.png" class="user-image" alt="User Image">
              <span class="hidden-xs">Jyoti</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo base_url().LOGO; ?>avatar2.png" class="img-circle" alt="User Image">

                <p>
                  Dashboard <br> <small>Inforamation</small>
                  <small>2020</small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="#" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <ul class="sidebar-menu">
        
        <li class="treeview">
          <a href="<?php echo base_url();?>dashboard">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
