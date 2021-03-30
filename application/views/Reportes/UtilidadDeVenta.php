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
        <h2>Utilidad de venta&nbsp;&nbsp;&nbsp;<strong>-</strong>
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
          <table class="table table-bordered" id="TbUtilidadDeVenta">
            <thead>
              <tr>
                <th>N</th>
                <th>PRODUCTO</th>
                <th class="text-right" style="width: 125px">CANTIDAD</th>
                <th class="text-right" style="width: 125px">COSTO</th>
                <th class="text-right" style="width: 125px">COSTO VENTA</th>
                <th class="text-right" style="width: 125px">VENTA</th>
                <th class="text-right" style="width: 125px">UTILIDAD</th>
                <th class="text-right" style="width: 125px">COMISIÓN</th>
                <th class="text-right" style="width: 125px">UTILIDAD TOTAL</th>
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
var CuerpoTbUtilidadDeVenta = $('#TbUtilidadDeVenta tbody');
var FootTbUtilidadDeVenta = $('#TbUtilidadDeVenta tfoot');


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
  var Indice = 11;
  var URL = URL_BASE + 'Registros/procGeneral';
  var Data = {
    parametros: Parametros,
    indice: Indice,
    nombreProcedimiento: Procedimiento
  };
  //
  $.post(URL, Data, function (Data) {
    CuerpoTbUtilidadDeVenta.empty();
    FootTbUtilidadDeVenta.empty();
    var FilasHTML = '';
    var strFoot = '';

    var totalCantidad = 0;
    var totalCosto = 0;
    var totalCostoVentas = 0;
    var totalVenta = 0;
    var totalUtilidad = 0;
    var totalComision = 0;
    var totalUtilidadTotal = 0;
    
    //
    $.each(Data, function(i) {
      FilasHTML += '<tr>' +
                      '<td>' + (i + 1) + '</td>' +
                      '<td>' + this.NomProducto + '</td>' +
                      '<td class="text-right">' + Number(this.Cantidad).toFixed(2) + '</td>' +
                      '<td class="text-right">' + Number(this.Costo).toFixed(2) + '</td>' +
                      '<td class="text-right">' + Number(this.CostoVentas).toFixed(2) + '</td>' +
                      '<td class="text-right">' + Number(this.Venta).toFixed(2) + '</td>' +
                      '<td class="text-right">' + Number(this.Utilidad).toFixed(2) + '</td>' +
                      '<td class="text-right">' + Number(this.Comision).toFixed(2) + '</td>' +
                      '<td class="text-right">' + Number(this.UtilidadTotal).toFixed(2) + '</td>' +
                    '</tr>';

      totalCantidad += (this.Cantidad == null || this.Cantidad == '' ? Number(0) : Number(this.Cantidad));
      totalCosto += (this.Costo == null || this.Costo == '' ? Number(0) : Number(this.Costo));
      totalCostoVentas += (this.CostoVentas == null || this.CostoVentas == '' ? Number(0) : Number(this.CostoVentas));
      totalVenta += (this.Venta == null || this.Venta == '' ? Number(0) : Number(this.Venta));
      totalUtilidad += (this.Utilidad == null || this.Utilidad == '' ? Number(0) : Number(this.Utilidad));
      totalComision += (this.Comision == null || this.Comision == '' ? Number(0) : Number(this.Comision));
      totalUtilidadTotal += (this.UtilidadTotal == null || this.UtilidadTotal == '' ? Number(0) : Number(this.UtilidadTotal));
    });
    CuerpoTbUtilidadDeVenta.append(FilasHTML);

    //armando tfoot (totales)
    strFoot += '<tr>'+
                  '<th colspan="2">TOTALES</th>' +
                  '<th class="text-right" style="text-align:right">'+ Number(totalCantidad).toFixed(2) +'</th>' +
                  '<th class="text-right" style="text-align:right">'+ Number(totalCosto).toFixed(2)  +'</th>' +
                  '<th class="text-right" style="text-align:right">'+ Number(totalCostoVentas).toFixed(2)  +'</th>' +
                  '<th class="text-right" style="text-align:right">'+ Number(totalVenta).toFixed(2)  +'</th>' +
                  '<th class="text-right" style="text-align:right">'+ Number(totalUtilidad).toFixed(2)  +'</th>' +
                  '<th class="text-right" style="text-align:right">'+ Number(totalComision).toFixed(2)  +'</th>' +
                  '<th class="text-right" style="text-align:right">'+ Number(totalUtilidadTotal).toFixed(2)  +'</th>' +
                '</tr>';
    FootTbUtilidadDeVenta.append(strFoot);
  }, "JSON");
}


function exportarReporte(){
    var opciones = {
        sistema: 'REPORTE UTILIDAD DE VENTA',
        title: 'REPORTE UTILIDAD DE VENTA',
        filename: 'REPORTE UTILIDAD DE VENTA',
        empresa: 'PRUEBA',
    }

    var parametros = {
        ruc: '',
        nomUsuario: '',
        //fechaInicio: $('#txtFecha').val(),
        //usuarioImpresion: $("#cmbCajaGestion option:selected").text()
    }
    fnExcelReport("TbUtilidadDeVenta", opciones, parametros, "REPORTE UTILIDAD DE VENTA");
}

</script>