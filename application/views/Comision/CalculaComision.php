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
  .tdN {
    width:20px;
    text-align:center
  }
  .tdFecha {
    width:90px;
    text-align:center
  }
  .Importe{
    width:90px;
    text-align:right;
  }
</style>
<?php
    $CodUsuario = $_SESSION['codusuario'];
    $Mes = date("m");
    $Anio = date("Y");
?>
<div class="row">
   <div class="row wrapper border-bottom white-bg page-heading">
      <div class="col-lg-12">
        <h2>CONSULTA &nbsp;&nbsp;&nbsp;<strong id="StnCantidadRegistros">-</strong>
          <select id="SelMes">
            <option value="01">ENERO</option>
            <option value="02">FEBRERO</option>
            <option value="03">MARZO</option>
            <option value="04">ABRIL</option>
            <option value="05">MAYO</option>
            <option value="06">JUNIO</option>
            <option value="07">JULIO</option>
            <option value="08">AGOSTO</option>
            <option value="09">SEPTIEMBRE</option>
            <option value="10">OCTUBRE</option>
            <option value="11">NOVIEMBRE</option>
            <option value="12">DICIEMBRE</option>
          </select>
          <input id="TxtAnio" type="number" min="2018" style="width:80px;"/>
          <button class="btn btn-sm btn-success pull-right m-t-n-xs" type="button" onclick="CalcularComision()"><strong>CALCULAR</strong></button>
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
              <tr>
                <th class="tdN">N</th>
                <th style="width:100px;text-align:center">MES</th>
                <th>VENDEDOR</th>
                <th style="width:100px;text-align:right;">VENTAS</th>
                <th style="width:40px;text-align:center;">%</th>
                <th style="width:100px;text-align:right;">COMISIÓN</th>
                <th style="width:100px;text-align:right;">PAGO</th>
                <th style="width:40px;"></th>
              </tr>
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
var TbComisionCuerpo = $('#TbComision tbody');
var SelMes = $('#SelMes');
var TxtAnio = $('#TxtAnio');

$(document).ajaxStart(function(event, jqXHR, settings) {
	$('#msjload').fadeIn();
});

$(document).ajaxComplete(function(event, jqXHR, settings) {
	$('#msjload').fadeOut();
});

$(document).ready(function(){
  var Mes = '<?php echo $Mes;?>';
  var Anio = '<?php echo $Anio;?>';
  SelMes.val(Mes);
  TxtAnio.val(Anio);
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
  CalcularComision();
});
var CodUsuario = '<?php echo $CodUsuario;?>';
//
function CalcularComision() {
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
    TbComisionCuerpo.empty();
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

