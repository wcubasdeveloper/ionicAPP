<link href="<?=base_url()?>assets/csoftcontent/js/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
<script src="<?=base_url()?>assets/csoftcontent/js/plugins/bootstrap-select/bootstrap-select.min.js"></script>
<link href="<?=base_url()?>assets/csoftcontent/js/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
<script src="<?=base_url()?>assets/csoftcontent/js/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="<?=base_url()?>assets/csoftcontent/js/plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script>

<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css" id="theme-styles">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

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

        <div class="form-group col-lg-6" style="padding-top: 17px;" >
           
        </div>
        <div class="col-lg-2" style="padding-top: 17px;" > 
            <label> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</label> 
            <button class="form-control btn btn-sm btn-success pull-right m-t-n-xs" style="background-color: #1c84c6;border-color: #1c84c6;color:white" type="button" onclick="cargarReporte()"><strong>Consulta</strong></button>
        </div>

        <div class="col-lg-2" style="padding-top: 17px;" > 
            <label> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</label> 
            <button id="btnCargarMantenimiento" class="form-control btn btn-sm btn-success pull-right m-t-n-xs" style="background-color: #1ab394;border-color: #1ab394;color: white;" type="button" onclick="cargarMantenimiento()">Cargar mantenimiento</button>
        </div>

      
  </div>


   <div class="row wrapper border-bottom white-bg page-heading">
      <div class="col-lg-12">
        <br>
        <div class="table-responsive">
          <table class="table table-bordered" id="tbReporte">
            <thead>
              <tr>
                <th rowspan="2" style="width: 45px">N</th>
                <th rowspan="2" >FECHA</th>
                <th rowspan="2" >PADRON</th>
                <th rowspan="2" >PLACA</th>
                <th rowspan="2" >VUELTA</th>
                <th rowspan="2" >PRODUCCIÓN</th>
                <th colspan="4" style="text-align: center;" >TOTALES</th>
                <!-- <th>FECHA CREA</th>
                <th>PRODUCTO</th>
                <th>U.MEDIDA</th>
                <th  class="text-right" >CANTIDAD</th>
                <th  class="text-right" >P.COSTO</th> -->
              </tr>
              <tr>
                <th class="text-right" >G.OPERATIVO</th>
                <th class="text-right" >G.ADM</th>
                <th class="text-right" >G.MANT</th>
                <th class="text-right" >NETO</th>
              </tr>
            </thead>
            <tbody></tbody>
            <tfoot>
                <tr>
                    <td colspan="5"><strong>TOTALES</strong> </td>
                    <td  class="text-right" ><strong id="totalProduccion" >0.00</strong></td>
                    <td  class="text-right" ><strong id="totalGastoOper" >0.00</strong></td>
                    <td  class="text-right" ><strong id="totalGastoADM" >0.00</strong></td>
                    <td  class="text-right" ><strong id="totalGastoMant" >0.00</strong></td>
                    <td  class="text-right" ><strong id="totalGastoNeto" >0.00</strong></td>
                </tr> 
            </tfoot>
          </table>
        </div>
      </div>
   </div>
</div>

<script>

var TxtFechaInicio = $('#TxtFechaInicio');
var TxtFechaFin = $('#TxtFechaFin');
//
var CuerpoTbEgresos = $('#TbEgresos tbody');
var FootTbEgresos = $('#TbEgresos tfoot');


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
    }).inputmask('dd/mm/yyyy', { placeholder: '__/__/____ __:__' });
    cargarReporte();
});


function cargarMantenimiento(){
  $('#btnCargarMantenimiento').prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Cargando...<i class="fa fa-cog fa-spin"></i>');

  var Procedimiento = 'ProcLiquidacion';
  var fechaInicio = FechaMySQL($('#TxtFechaInicio').val());
  var Parametros = fechaInicio;
  var Indice = 22;
  var URL = URL_BASE + 'Registros/procGeneral';
  var Data = {
    parametros: Parametros,
    indice: Indice,
    nombreProcedimiento: Procedimiento
  };
  //
  $.post(URL, Data, function (Data){
    $('#btnCargarMantenimiento').prop('disabled', false).html('Cargar mantenimiento');
    var codResultado = Number(Data[0].CodResultado);
    var desResultado = Data[0].DesResultado;
    //
    cargarReporte();
    //
    Swal.fire({
                icon: (codResultado == 1 ? 'success' : 'warning'),
                title: desResultado,
                showConfirmButton: false,
                timer: 2000
    });

    },'JSON');
}

function cargarReporte(){
    if ( $.fn.DataTable.isDataTable('#tbReporte') ) {
        $('#tbReporte').DataTable().destroy();
    }

  var Procedimiento = 'ProcLiquidacion';
  var fechaInicio = FechaMySQL($('#TxtFechaInicio').val());
  var Parametros = fechaInicio;
  var Indice = 10;
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

    var totalProduccion =0;
    var totalGastoOper = 0;
    var totalGastoAdm = 0;
    var totalGastoMant = 0;
    var totalNeto = 0;
    //
    var totalDeTotales = 0;
    $.each(Data, function(i) {
      
      FilasHTML += '<tr data-codProductoCategoriagestion="' + this.CodProductoCategoria +'" >' +
        '<td>' + (i + 1) + '</td>' +
        '<td>' + this.Fecha + '</td>' +
        '<td>' + (this.PadronUnidad ?this.PadronUnidad : '' ) + '</td>' +
        '<td>' + (this.PlacaUnidad ? this.PlacaUnidad  : '') + '</td>' +
        '<td>' + (this.Vueltas ? this.Vueltas : '') + '</td>' +
        '<td  class="text-right" >' + this.Produccion + '</td>' +
        '<td  class="text-right" >' + this.TotalGastoOperativo + '</td>' +
        '<td  class="text-right" >' + this.TotalGastoAdministrativo + '</td>' +
        '<td  class="text-right" >' + this.TotalGastoMantenimiento + '</td>' +
        '<td  class="text-right" >' + this.TotalNeto + '</td>' +
      '</tr>';
        //
      totalProduccion += Number(this.Produccion);
      totalGastoOper+= Number(this.TotalGastoOperativo);
      totalGastoAdm+= Number(this.TotalGastoAdministrativo);
      totalGastoMant+= Number(this.TotalGastoMantenimiento);
      totalNeto+= Number(this.TotalNeto);
    //   totalCantidad += Number(this.Cantidad);
    //   totalPrecioCosto += Number(this.PrecioCosto);
    });
    //
    $('#totalProduccion').text(totalProduccion.toFixed(2));
    $('#totalGastoOper').text(totalGastoOper.toFixed(2));
    $('#totalGastoADM').text(totalGastoAdm.toFixed(2));
    $('#totalGastoMant').text(totalGastoMant.toFixed(2)); 
    $('#totalGastoNeto').text(totalNeto.toFixed(2)); 
    //
    $('#tbReporte tbody').append(FilasHTML);
    $('#StnCantidadRegistros').text(CantidadFilas);
    // $('#totalCantidad').text(totalCantidad);
    // $('#totalCosto').text(totalPrecioCosto.toFixed(2));

    $('#tbReporte').DataTable( {
        "paging": false,
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );


  },'JSON');
}


</script>