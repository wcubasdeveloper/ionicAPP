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
    max-height: 400px;
    overflow-y: auto;
    -ms-overflow-style: -ms-autohiding-scrollbar;
  }
  .table-wrapper-scroll-y table td {
    padding: 4px !important;
    vertical-align: middle !important;
  }
  .table-wrapper-scroll-y table td > input {
    text-align: right !important;
  }
  .TextoDerecha {
    text-align: right !important;
  }
  .TamanioTotales {
    font-size: 16px;
  }
</style>
<?php
    $CodUsuario = $_SESSION['codusuario'];
?>
<div class="row">
   <div class="row wrapper border-bottom white-bg page-heading">
      <div class="col-lg-12">
        <h2>Movimiento diario&nbsp;&nbsp;&nbsp;<strong id="StnCantidadRegistros">-</strong>
          <input id="TxtFechaOperacion" readonly class="FechaUI" style="width:130px;"/>
          
        </h2>
      </div>
   </div>
   <br>
   <div class="row wrapper border-bottom white-bg page-heading">
      <div class="col-lg-12">
        <br>
        <div class="table-responsive">
          <table class="table table-bordered" id="TbCajaGestion">
            <thead>
              <tr>
                <th>N</th>
                <th>FECHA</th>
                <th>USUARIO</th>
                <th>TIPO</th>
                <th>CONCEPTO</th>
                <th style="text-align:right">IMPORTE</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
              <tr>
                <td colspan="5" style="text-align:right">TOTAL CAJA</td>
                <td id="TdTotalCaja" style="text-align:right"></td>
              </tr>
              <tr>
                <td colspan="5" style="text-align:right">TOTAL TARJETA</td>
                <td id="TdTotalTarjeta" style="text-align:right"></td>
              </tr>
              <tr>
                <td colspan="5" style="text-align:right">TOTAL EFECTIVO</td>
                <td id="TdTotalEfectivo" style="text-align:right"></td>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
   </div>
</div>

<script type="text/javascript">
//
  var TxtFechaOperacion = $('#TxtFechaOperacion');
  var CuerpoTbCajaGestion = $('#TbCajaGestion tbody');
  var TdTotalCaja = $('#TdTotalCaja');
  var TdTotalTarjeta = $('#TdTotalTarjeta');
  var TdTotalEfectivo = $('#TdTotalEfectivo');
  /********************* */

  $(document).ajaxStart(function(event, jqXHR, settings) {
    $('#msjload').fadeIn();
  });
  $(document).ajaxComplete(function(event, jqXHR, settings) {
    $('#msjload').fadeOut();
  });
  $(document).ready(function(){
    TxtFechaOperacion.val(FechaHoraHoy(1)).change(function(){
      ListarCajaGestion();
    });
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
    $(".Decimal").inputmask('Regex', {regex: "^[0-9]{1,6}(\\.\\d{1,2})?$"});
    ListarCajaGestion();
  });
var CodUsuario = '<?php echo $CodUsuario;?>';
//
function ListarCajaGestion() {
  var FechaOperacion = FechaMySQL(TxtFechaOperacion.val());
  var Procedimiento = 'ProcCajaGestionReporte';
  var Parametros = FechaOperacion;
  var Indice = 10;
  var URL = URL_BASE + 'Registros/procGeneral';
  var Data = {
    parametros: Parametros,
    indice: Indice,
    nombreProcedimiento: Procedimiento
  };
  //
  $.post(URL, Data, function (Data) {
    //
    CuerpoTbCajaGestion.empty();
    var FilasHTML = '';
    var CantidadFilas = Data.length;
    var SumaTotal = 0;
    //
    $.each(Data, function(i) {
      FilasHTML += '<tr>' +
        '<td>' + (i + 1) + '</td>' +
        '<td>' + this.Fecha + '</td>' +
        '<td>' + this.NomUsuario + '</td>' +
        '<td>' + this.Tipo + '</td>' +
        '<td>' + this.Concepto + '</td>' +
        '<td style="text-align:right">' + this.Importe + '</td>';
      '</tr>';
      //
      SumaTotal += parseFloat(this.Importe);
    });
    CuerpoTbCajaGestion.append(FilasHTML);
    TdTotalCaja.html(SumaTotal.toFixed(2));
    $('#StnCantidadRegistros').text(CantidadFilas);
    // Carga Total de tarjeta
    CargaTotalTarjeta();
  }, "JSON");
}
//
function CargaTotalTarjeta() {
  var FechaOperacion = FechaMySQL(TxtFechaOperacion.val());
  var Procedimiento = 'ProcCajaGestionReporte';
  var Parametros = FechaOperacion;
  var Indice = 11;
  var URL = URL_BASE + 'Registros/procGeneral';
  var Data = {
    parametros: Parametros,
    indice: Indice,
    nombreProcedimiento: Procedimiento
  };
  //
  $.post(URL, Data, function (Data) {
    //
    TdTotalTarjeta.html('');
    TdTotalEfectivo.html('');
    //
    $.each(Data, function(i) {
      var TotalCaja = parseFloat(TdTotalCaja.html());
      var TotalTarjeta = parseFloat(this.TotalTarjeta);
      var TotalEfectivo = TotalCaja - TotalTarjeta;
      //
      TdTotalTarjeta.html(TotalTarjeta.toFixed(2));
      TdTotalEfectivo.html(TotalEfectivo.toFixed(2));
    });
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