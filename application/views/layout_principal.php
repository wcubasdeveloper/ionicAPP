<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	$CodUsuario = $_SESSION['codusuario'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title><?= $Titulo; ?></title>
	<link rel="icon" type="image/png" href="<?=base_url()?>images/favicon.png" sizes="32x32">

	<link href="<?=base_url()?>assets/csoftcontent/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?=base_url()?>assets/csoftcontent/font-awesome/css/font-awesome.css" rel="stylesheet">
	<link href="<?=base_url()?>assets/csoftcontent/css/animate.css" rel="stylesheet">
	<link href="<?=base_url()?>assets/csoftcontent/css/style.css" rel="stylesheet">
	<link href="<?=base_url()?>assets/csoftcontent/css/plugins/toastr/toastr.min.css"rel="stylesheet">
	<link href="<?=base_url()?>assets/csoftcontent/css/plugins/blueimp/css/blueimp-gallery.min.css"rel="stylesheet">

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

	<!--- ICHECK -->
	<script src="<?=base_url()?>assets/csoftcontent/js/plugins/iCheck/icheck.min.js"></script>
	

	<!-- Peity -->
	<script src="<?=base_url()?>assets/csoftcontent/js/plugins/peity/jquery.peity.min.js"></script>
	<!-- Peity demo -->
	<script src="<?=base_url()?>assets/csoftcontent/js/demo/peity-demo.js"></script>
	<script src="<?=base_url()?>assets/js/util/Util.js"></script>
	<script src="<?=base_url()?>assets/plugins/blockUI/jquery.blockUI.js"></script>
	<script src="<?=base_url()?>assets/js/lodash.min.js"></script>
	<script src="<?=base_url()?>assets/csoftcontent/js/plugins/blueimp/jquery.blueimp-gallery.min.js"></script>
</head>
<body class="top-navigation" >
	<?php
		$COD_USUARIO = $_SESSION['codusuario'];
	?>
  <script type="text/javascript">
		var Util = new Util();
		var URL_BASE = '<?=base_url()?>';
		var COD_USUARIO = '<?php echo $COD_USUARIO;?>';
		
		function FechaHoraHoy(SoloFecha) { // Obtiene la FechaHoraHoy
			var Fecha = new Date();
			//
			var Dia = Fecha.getDate();
				Dia = (Dia < 10 ? '0' + Dia : Dia);
			var Mes = Fecha.getMonth() + 1;
				Mes = (Mes < 10 ? '0' + Mes : Mes);
			var Anio = Fecha.getFullYear();
			var Hora = Fecha.getHours();
				Hora = (Hora < 10 ? '0' + Hora : Hora);
			var Minuto = Fecha.getMinutes();
				Minuto = (Minuto < 10 ? '0' + Minuto : Minuto);
			var Segundos = Fecha.getSeconds();
				Segundos = (Segundos < 10 ? '0' + Segundos : Segundos);
			//
			if (SoloFecha == 1) {
				// Verifica Hora
				if (Hora < 3) {
				Fecha.setDate(Fecha.getDate() - 1);
				//
				Dia = Fecha.getDate();
				Mes = Fecha.getMonth() + 1;
				Mes = (Mes < 10 ? '0' + Mes : Mes);
				Anio = Fecha.getFullYear();
				Hora = Fecha.getHours();
				Hora = (Hora < 10 ? '0' + Hora : Hora);
				Minuto = Fecha.getMinutes();
				Minuto = (Minuto < 10 ? '0' + Minuto : Minuto);
				}
				return Dia + '/' + Mes + '/' + Anio;
			}
			else if (SoloFecha == 2) {
				return Dia + '/' + Mes + '/' + Anio + ' ' + Hora + ':' + Minuto;
			}
			else {
				return Dia + '/' + Mes + '/' + Anio + ' ' + Hora + ':' + Minuto + ':' + Segundos;
			}
		}

		function FechaMySQL(Fecha) {
			var FechaArray = Fecha.split('/');
			var Fecha = FechaArray[2] + '-' + FechaArray[1] + '-' + FechaArray[0];
			return Fecha;
		}
  </script>

<div id="msjload" class="alert" style="position: fixed; z-index: 10000; left: 20%;background-color:#94c1f0;display:none;">
     <div class="fa fa-spinner fa-spin"></div> Cargando, por favor espere...
</div>

<div id="wrapper">
	<div id="page-wrapper" class="gray-bg">
		<div class="row border-bottom white-bg">
			<nav class="navbar navbar-static-top" role="navigation">
				<div class="navbar-header">
					<button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
						<i class="fa fa-reorder"></i>
					</button>
					<a href="#" class="navbar-brand"><?=$_SESSION['AbrevEmpresa'];?></a>
				</div>
				<div class="navbar-collapse collapse" id="navbar">
					<?=$_SESSION['MenuHTML'];?>
					<ul class="nav navbar-top-links navbar-right">
						<!-- <li >
							<a href="#" style="color:green;" ><i class="fa fa-home"></i><span id="txtNombreTiendaGeneral" ><?=$_SESSION['NombreTienda'];?></span></a>
						</li>
						<li>
							<a href="#"style="color:#8383e0;" ><i class="fa fa-cubes"></i><span id="txtNombreAlmacenGeneral" ><?=$_SESSION['NombreAlmacen'];?></span></a>
						</li> -->
						<li>
							<a href="<?=base_url()?>user/logout">
								<i class="fa fa-sign-out"></i> Salir
							</a>
						</li>
					</ul>
				</div>
			</nav>
		</div>
	<!-- </div>
</div>-->
				<div class="wrapper wrapper-content">
					<div class="container">
				<!--	</div>
				</div> -->
</body>
</html>