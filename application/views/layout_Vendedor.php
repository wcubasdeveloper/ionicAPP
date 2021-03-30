<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Vendedor</title>

		<link href="<?=base_url()?>assets/csoftcontent/css/bootstrap.min.css" rel="stylesheet">
		<link href="<?=base_url()?>assets/csoftcontent/font-awesome/css/font-awesome.css" rel="stylesheet">
		<link href="<?=base_url()?>assets/csoftcontent/css/animate.css" rel="stylesheet">
		<link href="<?=base_url()?>assets/csoftcontent/css/style.css" rel="stylesheet">
		<link href="<?=base_url()?>assets/csoftcontent/css/plugins/toastr/toastr.min.css"rel="stylesheet">

    <!-- Mainly scripts -->
    <script src="<?=base_url()?>assets/csoftcontent/js/jquery-3.1.1.min.js"></script>
    <script src="<?=base_url()?>assets/csoftcontent/js/bootstrap.min.js"></script>
    <script src="<?=base_url()?>assets/csoftcontent/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?=base_url()?>assets/csoftcontent/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="<?=base_url()?>assets/csoftcontent/js/inspinia.js"></script>
    <script src="<?=base_url()?>assets/csoftcontent/js/plugins/pace/pace.min.js"></script>

    <!-- Flot -->
    <script src="<?=base_url()?>assets/csoftcontent/js/plugins/flot/jquery.flot.js"></script>
    <script src="<?=base_url()?>assets/csoftcontent/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="<?=base_url()?>assets/csoftcontent/js/plugins/flot/jquery.flot.resize.js"></script>

    <!-- ChartJS-->
    <script src="<?=base_url()?>assets/csoftcontent/js/plugins/chartJs/Chart.min.js"></script>

    <script src="<?=base_url()?>assets/csoftcontent/js/plugins/toastr/toastr.min.js"></script>

    <!-- Peity -->
    <script src="<?=base_url()?>assets/csoftcontent/js/plugins/peity/jquery.peity.min.js"></script>
    <!-- Peity demo -->
    <script src="<?=base_url()?>assets/csoftcontent/js/demo/peity-demo.js"></script>

    <script src="<?=base_url()?>assets/js/util/Util.js"></script>
    <script src="<?=base_url()?>assets/plugins/blockUI/jquery.blockUI.js"></script>

</head>
<body class="top-navigation" >
  <script type="text/javascript">
    var URL_BASE = '<?=base_url()?>';
  </script>

<div id="msjload" class="alert" style="position: fixed; z-index: 100; left: 20%;background-color:#94c1f0;display:none;">
     <div class="fa fa-spinner fa-spin"></div> Cargando, porfavor espere...
</div>

<div id="wrapper">
  <div id="page-wrapper" class="gray-bg">
    <div class="row border-bottom white-bg">
      <nav class="navbar navbar-static-top" role="navigation">
        <div class="navbar-header">
          <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
            <i class="fa fa-reorder"></i>
          </button>
          <a href="#" class="navbar-brand">PEDIDOS</a>
        </div>
        <div class="navbar-collapse collapse" id="navbar">
          <ul class="nav navbar-nav">
            <li class="dropdown">
              <a aria-expanded="false" role="button" href="<?=base_url()?>Cliente/Vendedor" class="dropdown-toggle" >Mis Clientes</span></a>
            </li>
            <li class="dropdown">
              <a aria-expanded="false" role="button" href="<?=base_url()?>Pedido/Inicio" class="dropdown-toggle" >Mis Pedidos</span></a>
            </li>
            <li class="dropdown">
              <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown">Mis Ventas <span class="caret"></span></a>
              <ul role="menu" class="dropdown-menu">
                <li><a href="<?=base_url()?>Venta/Vendedor">Por fechas</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown">Mis Comisiones <span class="caret"></span></a>
              <ul role="menu" class="dropdown-menu">
                <li><a href="<?=base_url()?>Comisiones/Inicio">Mensual</a></li>
              </ul>
            </li>
          </ul>
          <ul class="nav navbar-top-links navbar-right">
            <li>
              <a href="<?=base_url()?>user/logout">
                <i class="fa fa-sign-out"></i> Salir
              </a>
            </li>
          </ul>
        </div>
      </nav>
    </div>
<script>
  var Util = new Util();
</script>
<div class="wrapper wrapper-content">
  <div class="container">