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
        <h2>Ingresos de venta&nbsp;&nbsp;&nbsp;<strong>-</strong>
        <input id="TxtFechaInicio" readonly class="FechaUI" style="width:130px;"/>   
        <button class="btn btn-sm btn-primary pull-right m-t-n-xs " title="Exportar a Excel" type="button" onclick="exportarReporte()"><strong><i class="fa fa-file-excel-o" aria-hidden="true" style="font-size: 15px"></i></strong></button>
        </h2>        
      </div>
   </div>
   <br>
   <div class="row wrapper border-bottom white-bg page-heading">
      <div class="col-lg-12">
        <br>
        <div class="table-responsive">
          <table class="table table-bordered" id="TbIngresoDeVenta">
            <thead>
              <tr>
                <th style="width: 45px">N</th>
                <th style="width: 80px">FECHA</th>
                <th>PRODUCTO</th>
                <th class="text-right" style="width: 125px">CANTIDAD</th>
                <th class="text-right" style="width: 125px">VENTA</th>
                <th class="text-right" style="width: 125px">TOTAL</th>
              </tr>
            </thead>
            <tbody></tbody>
            <tfoot></tfoot>
          </table>
        </div>
      </div>
   </div>
</div>

<script>

var TxtFechaInicio = $('#TxtFechaInicio');
var CuerpoTbIngresoDeVenta = $('#TbIngresoDeVenta tbody');
var FootTbIngresoDeVenta = $('#TbIngresoDeVenta tfoot');


$(document).ajaxStart(function(event, jqXHR, settings) {
	$('#msjload').fadeIn();
});
$(document).ajaxComplete(function(event, jqXHR, settings) {
	$('#msjload').fadeOut();
});

$(document).ready(function(){
    TxtFechaInicio.val(FechaHoraHoy(1));

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
    }).inputmask('dd/mm/yyyy', { placeholder: '__/__/____ __:__' });

    ListarUtilidadDeVenta();

    TxtFechaInicio.change(function(){
      ListarUtilidadDeVenta();
    })
});

function ListarUtilidadDeVenta() {
  var Procedimiento = 'ProcVentaReporte';
  var Parametros = FechaMySQL(TxtFechaInicio.val());
  var Indice = 12;
  var URL = URL_BASE + 'Registros/procGeneral';
  var Data = {
    parametros: Parametros,
    indice: Indice,
    nombreProcedimiento: Procedimiento
  };
  //
  $.post(URL, Data, function (Data) {
    CuerpoTbIngresoDeVenta.empty();
    FootTbIngresoDeVenta.empty();
    var FilasHTML = '';
    var strFoot = '';

    var totalCantidad = 0;
    var totalVenta = 0;
    var totalTotal = 0;
    
    //
    $.each(Data, function(i) {
      FilasHTML += '<tr>' +
                      '<td>' + (i + 1) + '</td>' +
                      '<td>' + this.FechaVenta + '</td>' +
                      '<td>' + this.NomProducto + '</td>' +
                      '<td class="text-right">' + Number(this.Cantidad).toFixed(2) + '</td>' +
                      '<td class="text-right">' + Number(this.Venta).toFixed(2) + '</td>' +
                      '<td class="text-right">' + Number(this.Total).toFixed(2) + '</td>' +
                    '</tr>';

      totalCantidad += (this.Cantidad == null || this.Cantidad == '' ? Number(0) : Number(this.Cantidad));
      totalVenta += (this.Venta == null || this.Venta == '' ? Number(0) : Number(this.Venta));
      totalTotal += (this.Total == null || this.Total == '' ? Number(0) : Number(this.Total));
    });
    CuerpoTbIngresoDeVenta.append(FilasHTML);

    //armando tfoot (totales)
    strFoot += '<tr>'+
                  '<th colspan="3">TOTALES</th>' +
                  '<th class="text-right" style="text-align:right">'+ Number(totalCantidad).toFixed(2) +'</th>' +
                  '<th class="text-right" style="text-align:right">'+ Number(totalVenta).toFixed(2)  +'</th>' +
                  '<th class="text-right" style="text-align:right">'+ Number(totalTotal).toFixed(2)  +'</th>' +
                '</tr>';
    FootTbIngresoDeVenta.append(strFoot);
  }, "JSON");
}

function exportarReporte(){
    var opciones = {
        sistema: 'REPORTE INGRESOS DE VENTA',
        title: 'REPORTE INGRESOS DE VENTA',
        filename: 'REPORTE INGRESOS DE VENTA',
        empresa: 'PRUEBA',
    }

    var parametros = {
        ruc: '',
        nomUsuario: '',
        //fechaInicio: $('#txtFecha').val(),
        //usuarioImpresion: $("#cmbCajaGestion option:selected").text()
    }
    fnExcelReport("TbIngresoDeVenta", opciones, parametros, "REPORTE INGRESOS DE VENTA");
  }
</script>