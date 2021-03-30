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
            <label>Año consulta</label> 
            <select id="selectAnio" class="form-control">
              <option value="2020" >2020</option>
              <option selected="selected" value="2021" >2021</option>
            </select>
        </div>

        <div class="form-group col-lg-2" style="padding-top: 17px;">
            <label>Mes consulta</label> 
            <select id="selectMes" class="form-control">
              <option value="1" >Enero</option>
              <option value="2" >Febrero</option>
              <option value="3" >Marzo</option>
              <option value="4" >Abril</option>
              <option value="5" >Mayo</option>
              <option value="6" >Junio</option>
              <option value="7" >Julio</option>
              <option value="8" >Agosto</option>
              <option value="9" >Setiembre</option>
              <option value="10" >Octubre</option>
              <option value="11" >Noviembre</option>
              <option value="12" >Diciembre</option>

            </select>
        </div>

        <div class="form-group col-lg-6" style="padding-top: 17px;" >
           
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
            
            </thead>
            <tbody></tbody>
            <tfoot>
             
            </tfoot>
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
var mesActual = "<?=date('m')?>";
mesActual = Number(mesActual);


$(document).ajaxStart(function(event, jqXHR, settings) {
	$('#msjload').fadeIn();
});
$(document).ajaxComplete(function(event, jqXHR, settings) {
	$('#msjload').fadeOut();
});

$(document).ready(function(){
    $('#selectMes').val(mesActual);
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
  var Procedimiento = 'ProcAlmacenMovimientoReporte';
  
  var anioconsulta = $('#selectAnio').val();
  var mesconsulta = $('#selectMes').val();
  //
  var Parametros = anioconsulta + '|' + mesconsulta;

  //var Parametros =  '2021|2';
  // console.log(anioconsulta + '|' +mesconsulta )
  // console.log("prametros",Parametros )
  var Indice = 15;
  var URL = URL_BASE + 'Registros/procGeneral';
  var Data = {
    parametros: Parametros,
    indice: Indice,
    nombreProcedimiento: Procedimiento
  };
  //
  $.post(URL, Data, function (Data) {
      //armando cabecera
    $('#tbReporte thead').empty();
    $('#tbReporte tbody').empty();
    $('#tbReporte tfoot').empty();

    var totalRows = Data.length;
    if(totalRows == 0){
      toastr.warning('No hay información para mostrar.');
      return false;
    }
    var objetoCabecera = (Data.length > 0 ? Data[0] : null);
    var htmlTfoot = '';
    var htmlCabecera = '<tr>';
    var contadorCabecera = 0;
    //
    var cellTotal = '';
    var totales = [];
    Object.keys(objetoCabecera).forEach(function(key) {
        contadorCabecera++;
        htmlCabecera += '<th  '+ ( contadorCabecera > 2 ? 'class="text-right" ' : '' ) +' >'+ key+'</th>'; 
        //
        if(contadorCabecera > 2){
          cellTotal += '<th  class="montototal text-right" >0.00</th>';
          totales.push(0);
        }
        //
    });
    totales.push(0);
    cellTotal += '<th  class="montototal text-right" >0.00</th>';

    //
    htmlCabecera += '<th  class="text-right" >TOTAL</th>';
    htmlCabecera += '</tr>';
    //
    htmlTfoot += '<tr><th colspan="2" >TOTALES</th>' + cellTotal + '</tr>';

    $('#tbReporte thead').append(htmlCabecera);
    //armando detalle
    var htmlBodyTabla = '';
    var contadorRowBody = 0;
    var totalMes = 0;
    //

    $.each(Data,function(){
      var datadetalle = this;
      htmlBodyTabla +=  '<tr>';
      contadorRowBody = 0;
      totalMes = 0;
      Object.keys(objetoCabecera).forEach(function(key) {
        // console.log(datadetalle[key]);
        contadorRowBody++;
        htmlBodyTabla += '<td ' + ( contadorRowBody > 2 ? 'class="text-right montosuma" ' : '' )  +'>' +  datadetalle[key] + '</td>';
        if(contadorRowBody > 2){
          totalMes += Number(datadetalle[key]);
          
        }
      });
      htmlBodyTabla += '<td class="text-right montosuma" >'+ totalMes +'</td>';
      htmlBodyTabla += '</tr>';
    });
    $('#StnCantidadRegistros').text(Data.length);
    $('#tbReporte tbody').append(htmlBodyTabla);
    $('#tbReporte tfoot').append(htmlTfoot);
    //
    $.each($('#tbReporte tbody > tr'),function(){
        $(this).find('.montosuma').each(function(i){        
          totales[i]+= Number($(this).html());
        });
    });
    //calcularTotales("tbReporte");
    $(".montototal").each(function(i){  
      var totaldetotal  = totales[i].toFixed(2);
        $(this).html(totaldetotal);
    });
    //
    $('#tbReporte').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );

  },'JSON');
}

function calcularTotales(idTablaElement){
  $.each($('#' + idTablaElement + ' tbody > tr'),function(){
    
      $(this).find('.rowDataSd').each(function(i){        
              totals[i]+=parseInt( $(this).html());
      });
  });
}

function ListarUtilidadDeVenta() {
  var Procedimiento = 'ProcVentaReporte';
  var Parametros = FechaMySQL(TxtFechaInicio.val());
  var Indice = 13;
  var URL = URL_BASE + 'Registros/procGeneral';
  var Data = {
    parametros: Parametros,
    indice: Indice,
    nombreProcedimiento: Procedimiento
  };
  //
  $.post(URL, Data, function (Data) {
    CuerpoTbEgresos.empty();
    FootTbEgresos.empty();
    var FilasHTML = '';
    var strFoot = '';

    var totalCantidad = 0;
    var totalPrecio = 0;
    var totalTotal = 0;
    
    //
    $.each(Data, function(i) {
      FilasHTML += '<tr>' +
                      '<td>' + (i + 1) + '</td>' +
                      '<td>' + this.NomProducto + '</td>' +
                      '<td class="text-right">' + Number(this.Cantidad).toFixed(2) + '</td>' +
                      '<td class="text-right">' + Number(this.Precio).toFixed(2) + '</td>' +
                      '<td class="text-right">' + Number(this.Total).toFixed(2) + '</td>' +
                    '</tr>';

      totalCantidad += (this.Cantidad == null || this.Cantidad == '' ? Number(0) : Number(this.Cantidad));
      totalPrecio += (this.Precio == null || this.Precio == '' ? Number(0) : Number(this.Precio));
      totalTotal += (this.Total == null || this.Total == '' ? Number(0) : Number(this.Total));
    });
    CuerpoTbEgresos.append(FilasHTML);

    //armando tfoot (totales)
    strFoot += '<tr>'+
                  '<th colspan="2">TOTALES</th>' +
                  '<th class="text-right" style="text-align:right">'+ Number(totalCantidad).toFixed(2) +'</th>' +
                  '<th class="text-right" style="text-align:right">'+ Number(totalPrecio).toFixed(2)  +'</th>' +
                  '<th class="text-right" style="text-align:right">'+ Number(totalTotal).toFixed(2)  +'</th>' +
                '</tr>';
                FootTbEgresos.append(strFoot);
  }, "JSON");
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