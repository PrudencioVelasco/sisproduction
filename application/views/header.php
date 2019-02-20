<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistema de Producción Woori</title>
  <!-- Bootstrap core CSS -->
  <link href="<?php echo base_url();?>/assets/principal/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url();?>/assets/fonts/css/font-awesome.min.css" rel="stylesheet">
  <link href="<?php echo base_url();?>/assets/css/animate.min.css" rel="stylesheet">
  <!-- Custom styling plus plugins -->
  <link href="<?php echo base_url();?>/assets/css/custom.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/css/maps/jquery-jvectormap-2.0.3.css" />
  <link href="<?php echo base_url();?>/assets/css/icheck/flat/green.css" rel="stylesheet">
  <link href="<?php echo base_url();?>/assets/css/floatexamples.css" rel="stylesheet" />
  <!-- Scripts -->
  <script src="<?php echo base_url()?>/assets/js/vue/vue.min.js"></script>
  <script src="<?php echo base_url()?>/assets/js/axios/axios.min.js"></script>
  <script src="<?php echo base_url();?>/assets/js/pagination/pagination.js"></script>
  <script src="<?php echo base_url()?>/assets/js/jquery/jquery-3.3.1.min.js"></script>
  <!-- SweetAlert -->
  <script src="<?php echo base_url();?>/assets/js/sweetalert2/dist/sweetalert2.min.js"></script>
  <link rel="stylesheet" href="<?php echo base_url();?>/assets/js/sweetalert2/dist/sweetalert2.min.css">
  <!-- select2 -->
  <link href="<?php echo base_url();?>/assets/css/select/select2.min.css" rel="stylesheet">
  <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
      <![endif]-->
      <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <style type="text/css">
        .modal-mask {
          position: fixed;
          z-index: 9998;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          background-color: rgba(0, 0, 0, .5);
          display: table;
          transition: opacity .3s ease;
        }
        .modal-wrapper {
          display: table-cell;
          vertical-align: middle;
        }
      </style>
    </head>
    <body class="nav-md">
      <div class="container body">
        <div class="main_container">
          <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
              <div class="navbar nav_title" style="border: 0;">
                <a href="#" class="site_title"><i class="fa fa-product-hunt" aria-hidden="true"></i><span> Producción</span></a>
              </div>
              <div class="clearfix"></div>
              <!-- menu prile quick info -->
              <div class="profile">
                <div class="profile_pic">
                  <img src="<?php echo base_url();?>/assets/images/user.png" alt="..." class="img-circle profile_img">
                </div>
                <div class="profile_info">
                  <span>Bienvenido,</span>
                  <h2 style="padding-top: 10px"><?php echo $this->session->usuario
                  ?></h2>
                </div>
              </div>
              <!-- /menu prile quick info -->
              <br />
              <!-- sidebar menu -->
              <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                <div class="menu_section">
                  <h3><?php echo $this->session->rol
                  ?></h3>
                  <ul class="nav side-menu">
                    <li><a href="<?= base_url('/admin/index') ?>"><i class="fa fa-home"></i> Inicio</a> </li>
                    <li><a href="<?= base_url('/parte/index') ?>"><i class="fa fa-archive" aria-hidden="true"></i> Packing</a> </li>
                    <li><a href="<?= base_url('/calidad/index') ?>"><i class="fa fa-thumbs-o-up"></i> Calidad</a> </li>
                    <li><a href="<?= base_url('/bodega/index') ?>"><i class="fa fa-home"></i> Almacen</a> </li>
                    <li><a href="<?= base_url('/salida/index') ?>"><i class="fa fa-sign-out" aria-hidden="true"></i>Salida</a> </li>
                    <li><a><i class="fa fa-folder-open" aria-hidden="true"></i> Catalogo <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu" style="display: none"> 
                        <li><a href="<?= base_url('/client/index') ?>"> Cliente</a> </li>
                        <li><a href="<?= base_url('/turno/index') ?>"> Turno</a> </li>
                        <li><a href="<?= base_url('/user/index') ?>"> Usuario</a> </li>
                      </ul>
                    </li>
                    <li><a><i class="fa fa-bar-chart" aria-hidden="true"></i> Reporte <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu" style="display: none"> 
                        <li><a href="<?= base_url('/reporte/packing') ?>"> Packing</a> </li>
                        <li><a href="<?= base_url('/reporte/calidad') ?>"> Calidad</a> </li>
                        <li><a href="<?= base_url('/reporte/bodega') ?>"> Almacen</a> </li>
                      </ul>
                    </li>
                    <li><a href="<?= base_url('/inventario/index') ?>"><i class="fa fa-check-square-o" aria-hidden="true"></i> Inventario</a> </li>
                  </ul>
                </div>
              </div>
              <!-- /sidebar menu --> 
            </div>
          </div>

          <!-- top navigation -->
          <div class="top_nav">
            <div class="nav_menu">
              <nav class="" role="navigation">
                <div class="nav toggle">
                  <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                </div>
                <ul class="nav navbar-nav navbar-right">
                  <li class="">
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                      <img src="<?php echo base_url();?>/assets/images/user.png" alt=""><?php echo $this->session->name; ?>
                      <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                      <li><a href="<?= base_url('/login/logout') ?>"><i class="fa fa-sign-out pull-right"></i> Salir</a>
                      </li>
                    </ul>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
          <!-- /top navigation -->
