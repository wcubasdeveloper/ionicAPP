<link href="<?=base_url()?>assets/csoftcontent/js/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
<script src="<?=base_url()?>assets/csoftcontent/js/plugins/bootstrap-select/bootstrap-select.min.js"></script>
<link href="<?=base_url()?>assets/csoftcontent/js/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
<script src="<?=base_url()?>assets/csoftcontent/js/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="<?=base_url()?>assets/csoftcontent/js/plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script>

<link href="<?=base_url()?>assets/plugins/datatables/datatables.min.css" rel="stylesheet" />
<script src="<?=base_url()?>assets/plugins/datatables/datatables.min.js"></script>

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
      <div class="col-lg-8">
          <ol class="breadcrumb" style="padding-top: 15px;">
              <li class="breadcrumb-item">
                  <a href="<?=base_url()?>/Inicio/inicio">Inicio</a>
              </li>
              <li class="active breadcrumb-item">
                  <strong><?=str_replace("%20", " ", $Titulo); ?></strong>
              </li>
          </ol>
          <h2>(<strong id="StnCantidadRegistros">-</strong>) <?=str_replace("%20", " ", $Titulo); ?> </h2>
      
      </div>
      <div class="col-lg-4">

      </div>
  </div>

  <div class="row wrapper border-bottom white-bg page-heading form-group">
        <div class="form-group col-lg-2" style="padding-top: 17px;">
            <label>Fecha inicio</label> 
            <input id="TxtFechaInicio" placeholder="Fecha inicio" readonly class="FechaUI form-control" style="width:130px;"/>
        </div>

   

        <div class="form-group col-lg-8" style="padding-top: 17px;" >
           
        </div>

        <div class="col-lg-2" style="padding-top: 17px;" > 
            <label> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</label> 
            <button class="form-control btn btn-sm btn-success pull-right m-t-n-xs" style="background-color: #1c84c6;border-color: #1c84c6;color:white" type="button" onclick="cargarReporte()"><strong>Consulta</strong></button>
        </div>
  </div>


   <div class="row wrapper border-bottom white-bg page-heading">
      <div class="col-lg-12">
        <br>
        <div class="table-responsive">
          <table class="table table-bordered" id="tbReporte">
            <thead>
              <tr>
                <th style="width: 45px">N</th>
                <th>FECHA</th>
                <th>PAD</th>
                <!-- <th>PLACA</th> -->
                <!-- <th>PERSONA</th> -->
                <!-- <th>MOV. MOTIVO</th> -->
                <th>USUARIO</th>
                <!-- <th>F. CREA</th> -->
                <th>PRODUCTO</th>
                <th>UNI MED</th>
                <th class="text-right" >CANT</th>
                <th class="text-right" >COSTO</th>
                <th class="text-right" >TOTAL</th>
              </tr>
            </thead>
            <tbody></tbody>
            <!-- <tfoot>
                <tr>
                    <td colspan="6">TOTALES</td>
                    <td id="totalCantidad" class="text-right" >0.00</td>
                    <td id="totalCosto" class="text-right" >0.00</td>
                    <td id="totalTotal" class="text-right" >0.00</td>
                </tr>
            </tfoot> -->
          </table>
        </div>
      </div>
   </div>
</div>

<script>

var TxtFechaInicio = $('#TxtFechaInicio');
var TxtFechaFin = $('#TxtFechaFin');

var CuerpoTbEgresos = $('#TbEgresos tbody');
var FootTbEgresos = $('#TbEgresos tfoot');
var SelProducto = $("#SelProducto");

$(document).ajaxStart(function(event, jqXHR, settings) {
	$('#msjload').fadeIn();
});
$(document).ajaxComplete(function(event, jqXHR, settings) {
	$('#msjload').fadeOut();
});

$(document).ready(function(){
    $('title').text("<?=str_replace("%20", " ", $Titulo); ?>");
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
    }).inputmask('dd/mm/yyyy', { placeholder: '__/__/____ __:__' });

    cargarReporte();
});





function cargarReporte(){
    if ( $.fn.DataTable.isDataTable('#tbReporte') ) {
    $('#tbReporte').DataTable().destroy();
  }

    //CALL ProcAlmacenMovimientoReporte('2021-01-01|2021-03-01|1', 11);
  var Procedimiento = 'ProcAlmacenMovimientoReporte';
  var fechaInicio = FechaMySQL($('#TxtFechaInicio').val());
  var Parametros = fechaInicio;
 
  var Indice = 13;
  var URL = URL_BASE + 'Registros/procGeneral';
  var Data = {
    parametros: Parametros,
    indice: Indice,
    nombreProcedimiento: Procedimiento
  };
  //
  $.post(URL, Data, function (Data) {

    $('#tbReporte tbody').empty();
    var FilasHTML = '';
    var CantidadFilas = Data.length;

    var totalCantidad =0;
    var totalPrecioCosto = 0;
    var totalTotal =0;
    //
    $.each(Data, function(i) {
      FilasHTML += '<tr data-codProductoCategoriagestion="' + this.CodProductoCategoria +'" >' +
        '<td>' + (i + 1) + '</td>' +
        '<td>' + this.Fecha + '</td>' +
        '<td>' + this.PadronUnidad + '</td>' +
        // '<td>' + this.PlacaUnidad + '</td>' +
        // '<td>' + this.NombrePersona + '</td>' +
        // '<td>' + this.NomAlmacenMovimientoMotivo + '</td>' +
        '<td>' + this.NomUsuario + '</td>' +
        // '<td>' + this.FechaCreacion + '</td>' +
        '<td>' + this.NomProducto + '</td>' +
        '<td>' + this.NomProductoUM + '</td>' +
        '<td class="text-right" style="width:70px;" >' + this.Cantidad + '</td>' +
        '<td class="text-right" style="width:70px;" >' + this.PrecioCosto + '</td>' +
        '<td class="text-right" style="width:70px;" >' + this.PrecioCostoTotal + '</td>' +
      '</tr>';

      totalCantidad += Number(this.Cantidad);
      totalPrecioCosto += Number(this.PrecioCosto);
      totalTotal  += Number(this.PrecioCostoTotal);
    });
    // FilasHTML += '<tr>'+
    //                   '<td>'+ ''+ '</td>' + 
    //                   '<td>'+ 'TOTALES'+ '</td>' + 
    //                   '<td>'+ ''+ '</td>' + 
    //                   '<td>'+ ''+ '</td>' + 
    //                   '<td>'+ ''+ '</td>' + 
    //                   '<td>'+ ''+ '</td>' + 
    //                   '<td class="text-right" >'+  totalCantidad.toFixed(2) + '</td>' + 
    //                   '<td class="text-right" >'+ totalPrecioCosto.toFixed(2) + '</td>' + 
    //                   '<td class="text-right" >'+ totalTotal.toFixed(2) + '</td>' + 
    //               '</tr>';

    $('#tbReporte tbody').append(FilasHTML); 
    $('<tr>'+
                      '<td>'+ CantidadFilas+ '</td>' + 
                      '<td><strong>'+ 'TOTALES'+ '</strong></td>' + 
                      '<td>'+ ''+ '</td>' + 
                      '<td>'+ ''+ '</td>' + 
                      '<td>'+ ''+ '</td>' + 
                      '<td>'+ ''+ '</td>' + 
                      '<td class="text-right" ><strong>'+  totalCantidad.toFixed(2) + '</strong></td>' + 
                      '<td class="text-right" ><strong>'+ totalPrecioCosto.toFixed(2) + '</strong></td>' + 
                      '<td class="text-right" ><strong>'+ totalTotal.toFixed(2) + '</strong></td>' + 
                  '</tr>').appendTo('#tbReporte tbody');

    $('#StnCantidadRegistros').text(CantidadFilas);
    // $('#totalCantidad').text(totalCantidad);
    // $('#totalCosto').text(totalPrecioCosto.toFixed(2));
    // $('#totalTotal').text(totalTotal.toFixed(2));

    $('#tbReporte').DataTable( {
        "paging": false,
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel',
            {
              extend: 'pdf',
              text: 'PDF',
              title: function () { return  "Salidas de almacen fecha " + $('#TxtFechaInicio').val(); },
              customize : function(doc) {doc.pageMargins = [10, 10, 10,10 ]; }
            }
        ]
    } );
  },'JSON');
}

function exportarReporte(){
    var opciones = {
        sistema: 'REPORTE EGRESOS',
        title: 'REPORTE EGRESOS',
        filename: 'REPORTE EGRESOS',
        empresa: 'PRUEBA',
    }

    var parametros = {
        ruc: '',
        nomUsuario: '',
        //fechaInicio: $('#txtFecha').val(),
        //usuarioImpresion: $("#cmbCajaGestion option:selected").text()
    }
    fnExcelReport("TbEgresos", opciones, parametros, "REPORTE EGRESOS");
}

</script>