<link href="<?=base_url()?>assets/csoftcontent/js/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
<script src="<?=base_url()?>assets/csoftcontent/js/plugins/bootstrap-select/bootstrap-select.min.js"></script>
<link href="<?=base_url()?>assets/csoftcontent/js/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
<script src="<?=base_url()?>assets/csoftcontent/js/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="<?=base_url()?>assets/csoftcontent/js/plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script>
<style>
  .m-b {
    margin-bottom: 5px !important;
  }
  .form-group {
    margin-bottom: 5px !important;
  }
  .m-t-n-xs {
    margin-top: 0px !important;
  }
  .alert {
    z-index: 10000 !important;
    left: 0px !important;
  }
  .table-wrapper-scroll-y {
    display: block;
    max-height: 200px;
    overflow-y: auto;
    -ms-overflow-style: -ms-autohiding-scrollbar;
  }
  .table-wrapper-scroll-y table td {
    padding: 4px !important;
    vertical-align: middle !important;
  }
</style>
<?php
    $CodUsuario = $_SESSION['codusuario'];
?>
<div class="row">
   <div class="row wrapper border-bottom white-bg page-heading">
      <div class="col-lg-12">
        <h2>Reporte Diario &nbsp;&nbsp;&nbsp;<strong id="StnCantidadRegistros">-</strong>
          <input id="TxtFechaInicio" readonly class="FechaUI" style="width:130px;"/>
          <input id="TxtFechaFin" readonly class="FechaUI" style="width:130px;"/>
          <select id="SelEstado">
            <option value="0">TODOS</option>
            <option value="1">ACTIVO</option>
            <option value="3">ANULADO</option>
          </select>
          <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="button" onclick="ConsultaReporteRango()"><strong>Consulta</strong></button>
        </h2>
      </div>
   </div>
   <br>
   <div class="row wrapper border-bottom white-bg page-heading">
      <div class="col-lg-12">
        <table class="table table-bordered" id="TbReporteRango">
            <thead>
              <tr>
                <th>N</th>
                <th>DOCUMENTO</th>
                <th>CLIENTE</th>
                <th style="text-align:right">SUBTOTAL</th>
                <th style="text-align:right">IGV</th>
                <th style="text-align:right">TOTAL</th>
                <th>U.CREACIÓN</th>
                <th>F.CREACIÓN</th>
                <th>ESTADO</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
      </div>
   </div>
</div>

<script type="text/javascript">

//
$(document).ajaxStart(function(event, jqXHR, settings) {
	$('#msjload').fadeIn();
});

$(document).ajaxComplete(function(event, jqXHR, settings) {
	$('#msjload').fadeOut();
});

$(document).ready(function(){

  TbReporteRangoCuerpo = $('#TbReporteRango tbody');
  TxtFechaInicio = $('#TxtFechaInicio');
  TxtFechaFin = $('#TxtFechaFin');
  SelEstado = $('#SelEstado');

  TxtFechaInicio.val(FechaHoraHoy(1));
  TxtFechaFin.val(FechaHoraHoy(1));
  $('.FechaUI').datepicker({
    autoSize: true,
    dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
    dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
    firstDay: 1,
    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
    monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
    dateFormat: 'dd/mm/yy',
    changeMonth: true,
    changeYear: true,
    yearRange: "-90:+0"
  }).inputmask('dd/mm/yyyy', { placeholder: '__/__/____' });
});
var CodUsuario = '<?php echo $CodUsuario;?>';
//
function ConsultaReporteRango() {
  var FechaInicio = FechaMySQL(TxtFechaInicio.val());
  var FechaFin = FechaMySQL(TxtFechaFin.val());
  var CodEstado = SelEstado.val();
  var Procedimiento = 'ProcVenta';
  var Parametros = FechaInicio + '|' + FechaFin + '|' + CodEstado;
  var Indice = 13;
  var URL = URL_BASE +'Registros/procGeneral';
  var Data = {
    parametros: Parametros,
    indice: Indice,
    nombreProcedimiento: Procedimiento
  };
  //
  $.post(URL, Data, function (Data) {
    //
    TbReporteRangoCuerpo.empty();
    var FilasHTML = '';
    var CantidadFilas = Data.length;
    //
    $.each(Data, function(i) {
      FilasHTML += '<tr data-codventa="' + this.CodVenta +'" >' +
        '<td>' + (i + 1) + '</td>' +
        '<td>' + this.Documento  + '</td>' +
        '<td>' + this.Cliente + '</td>' +
        '<td style="text-align:right">' + this.SubTotal + '</td>' +
        '<td style="text-align:right">' + this.IGV + '</td>' +
        '<td style="text-align:right">' + this.Total + '</td>' +
        '<td>' + this.NomUsuario + '</td>' +
        '<td>' + this.FechaCreacion + '</td>' +
        '<td>' + this.NomEstado + '</td>' +
      '</tr>';
    });
    TbReporteRangoCuerpo.append(FilasHTML);
    $('#StnCantidadRegistros').text(CantidadFilas);
    // toastr.success('Registros cargados correctamente', 'Nota')
  }, "JSON");
}
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
    if (Hora <= 3) {
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

