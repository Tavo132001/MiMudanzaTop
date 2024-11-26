<?php
session_start();
include ("conexion/database.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="descargas/favicon.png" type="image/gif" />
  <title>Mi Mudanza Top | ERP</title>

  <!-- Google Font: Josefin Sans -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Josefin%20Sans:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="libreria/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="libreria/dist/css/adminlte.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="libreria/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="libreria/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="libreria/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="libreria/plugins/toastr/toastr.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="libreria/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="libreria/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <style>
    /*ESTILOS PERSONALIZADOS*/
    /*CAMBIANDO EL COLOR DE FONDO DEL MENU*/
    .main-sidebar { background-color: #3d9970 !important }

    /*CAMBIANDO EL COLOR DE FONDO DE LA BARRA SUPERIOR*/
    .navbar-white { background-color: #3d9970 !important }
    /*Verde:    #2b8a3e*/
    /*Marron:   #755139*/
    /*Azul:     #364fc7*/
    /*Morado:   #862e9c*/
    /*Rojo:     #c92a2a*/
    /*Plata:    #81a1c1*/
    /*Metalico: #616247*/
  </style>
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><span style="color: #FFFFFF;"><i class="fas fa-bars"></i></span></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="dashboard.php" class="nav-link"><span style="color: #FFFFFF;">Inicio</span></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="login.php" class="nav-link"><span style="color: #FFFFFF;">Salir</span></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
        <span style="color: #FFFFFF;"><i class="fas fa-expand-arrows-alt"></i></span>
        </a>
      </li>
      <!--
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>-->
    </ul>
  </nav>
  <!-- /.navbar -->