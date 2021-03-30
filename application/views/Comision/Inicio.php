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
        <h2>PEDIDOS &nbsp;&nbsp;&nbsp;<strong id="StnCantidadRegistros">-</strong>
          <input id="TxtFechaInicio" readonly class="FechaUI" style="width:130px;"/>
          <input id="TxtFechaFin" readonly class="FechaUI" style="width:130px;"/>
          <button class="btn btn-sm btn-success pull-right m-t-n-xs" type="button" onclick="ListaComisionPorPersona()"><strong>Consulta</strong></button>
        </h2>
      </div>
   </div>
   <br>
   <div class="row wrapper border-bottom white-bg page-heading">
      <div class="col-lg-12">
        <br>
        <div class="table-responsive">
          <table class="table table-bordered" id="TbComision">
            <thead>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
   </div>
</div>

<script type="text/javascript">
//
var TbComisionCabecera = $('#TbComision thead');
var TbComisionCuerpo = $('#TbComision tbody');
var TxtFechaInicio = $('#TxtFechaInicio');
var TxtFechaFin = $('#TxtFechaFin');

$(document).ajaxStart(function(event, jqXHR, settings) {
	$('#msjload').fadeIn();
});

$(document).ajaxComplete(function(event, jqXHR, settings) {
	$('#msjload').fadeOut();
});

$(document).ready(function(){
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
  //
  ListaComisionPorPersona();
});
var CodUsuario = '<?php echo $CodUsuario;?>';
//
function ListaComisionPorPersona() {
  var FechaInicio =  FechaMySQL(TxtFechaInicio.val());
  var FechaFin = FechaMySQL(TxtFechaFin.val());
  var Procedimiento = 'ProcVenta';
  var Parametros = FechaInicio + '|' + FechaFin;
  var Indice = 18;
  var URL = URL_BASE + 'Registros/procGeneral';
  var Data = {
    parametros: Parametros,
    indice: Indice,
    nombreProcedimiento: Procedimiento
  };
  //
  $.post(URL, Data, function (Data) {
    //
    TbComisionCabecera.empty();
    TbComisionCuerpo.empty();

    FilaCabecera = '<tr>' +
      '<th>N</th>' +
      '<th>VENDEDOR</th>' +
      '<th>SUBTOTAL</th>' +
      '<th>IGV</th>' +
      '<th>TOTAL</th>' +
      '<th>GANACIA</th>' +
      '<th>COMISIÓN</th>' +
    '</tr>';
    TbComisionCabecera.append(FilaCabecera);
    //
    var FilasHTML = '';
    var CantidadFilas = Data.length;
    //
    $.each(Data, function(i) {
      FilasHTML += '<tr>' +
        '<td>' + (i + 1) + '</td>' +
        '<td>' + this.Vendedor  + '</td>' +
        '<td>' + this.SubTotal  + '</td>' +
        '<td>' + this.Igv + '</td>' +
        '<td>' + this.Total + '</td>' +
        '<td>' + this.Ganancia + '</td>' +
        '<td>' + this.Comision + '</td>' +
      '</tr>';
    });
    TbComisionCuerpo.append(FilasHTML);
    $('#StnCantidadRegistros').text(CantidadFilas);
    // toastr.success('Registros cargados correctamente', 'Nota')
  }, "JSON");
}
/********************************************** */
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
function split(val) {
  return val.split(/,\s*/);
}
</script>

