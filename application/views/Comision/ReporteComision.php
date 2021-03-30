<link href="<?=base_url()?>assets/csoftcontent/js/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
<script src="<?=base_url()?>assets/csoftcontent/js/plugins/bootstrap-select/bootstrap-select.min.js"></script>
<link href="<?=base_url()?>assets/csoftcontent/js/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
<script src="<?=base_url()?>assets/csoftcontent/js/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="<?=base_url()?>assets/csoftcontent/js/plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script>
<script src="<?=base_url()?>assets/csoftcontent/js/plugins/print/Print.js"></script>
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
        <h2>Fecha consulta &nbsp;&nbsp;&nbsp;<strong id="StnCantidadRegistros">-</strong>
          <input id="TxtFechaInicio" readonly class="FechaUI" style="width:130px;"/>
          <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="button" onclick="ConsultaReporteComision()"><strong>Consulta</strong></button>
        </h2>
      </div>

   </div>
   <br>
   <div class="row wrapper border-bottom white-bg page-heading">
      <div class="col-lg-12">
        <br>
        <div class="table-responsive">
          <table class="table table-bordered" id="TbReporteComision">
              <thead>
              </thead>
              <tbody>
              </tbody>
              <tfoot>
              </tfoot>
          </table>
        </div>
      </div>
   </div>
</div>

<script type="text/javascript">


var TbReporteDetalladoCuerpo = $('#TbReporteDetallado tbody');
var TbReporteDetalladoPie = $('#TbReporteDetallado tfoot');
var TxtFechaInicio = $('#TxtFechaInicio');
var TxtFechaFin = $('#TxtFechaFin');
var SelEstado = $('#SelEstado');

//
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
  }).inputmask('dd/mm/yyyy', { placeholder: '__/__/____' });
  ConsultaReporteComision();
});
var CodUsuario = '<?php echo $CodUsuario;?>';
//
function ConsultaReporteComision(){
  var fechaConsulta = FechaMySQL(TxtFechaInicio.val());
  var URL = URL_BASE + 'Registros/procGeneral';
  var Data = {
    parametros: fechaConsulta,
    indice: 10,
    nombreProcedimiento: 'ProcVentaReporte'
  };
  //
  $.post(URL, Data, function (Data) {
    //armando cabecera de la tabla
    $('#TbReporteComision thead').empty();
    $('#TbReporteComision tbody').empty();
    $('#TbReporteComision tfoot').empty();

    var grupoProductos = _.groupBy(Data, function (d) { return d.NomProducto });
    var strHTMLThead = '<tr>' + '<th>ANF</th>';
    $.each(grupoProductos,function(producto, data){
      var precioVentaProducto = data[0].PrecioVentaProducto;
      strHTMLThead += '<th style="text-align:right" >' + producto + ' (' + precioVentaProducto + ')' +'</th>';
    });
    strHTMLThead += '<th style="text-align:right" >COMISIÓN</th>';
    strHTMLThead += '</tr>';
    $('#TbReporteComision thead').append(strHTMLThead);
    //armando detalle de la tabla
    var agrupadoPorPersona =  _.groupBy(Data, function (d) { return d.NomPersona });
    var strHTMLTbody = '';
    $.each(agrupadoPorPersona ,function(persona, data){
      strHTMLTbody +='<tr>';
      var personaVendedor = persona;
      var totalComision = 0;
      //
      strHTMLTbody +='<td>'+ persona +'</td>';
      $.each(grupoProductos, function(nombreProducto){
        var comisionProducto = this[0].Comision;
        var precioVentaProducto = this[0].PrecioVentaProducto;
        
        var objProductoVendido = cantidadProductoVendido(nombreProducto, data);
        strHTMLTbody +='<td data-nombreproducto="'+ nombreProducto +'" data-pventa="'+ precioVentaProducto +'" style="text-align:right" >'+ objProductoVendido.cantidad +'</td>';
        totalComision += comisionProducto * objProductoVendido.cantidad;
      })
      strHTMLTbody +='<td class="comision" style="text-align:right">'+ Number(totalComision).toFixed(2) +'</td>';
      strHTMLTbody += '</tr>';
      //var grupoProductosVendidos = _.groupBy(data, function (d) { return d.NomProducto });
    });
    $('#TbReporteComision tbody').append(strHTMLTbody);
    
    //armando tfoot (totales)
    var strHTMLTfoot = '<tr>';
    strHTMLTfoot += '<th>TOTAL</th>';
    $.each(grupoProductos, function(){
      var nombreProducto = this[0].NomProducto;
      var precioVentaProducto = Number(this[0].PrecioVentaProducto);
      var objRptaCantidadTotal  = cantidadProductoPorTabla(nombreProducto);
      var totalVentaProducto = (precioVentaProducto * objRptaCantidadTotal.cantidadEnTabla).toFixed(2)
      //console.log('objRptaCantidadTotal',objRptaCantidadTotal);
      strHTMLTfoot += '<th style="text-align:right" >' + totalVentaProducto + '</th>';
    });
    //totalizando la comisión
    var totalComision = 0;
    $.each($('.comision'),function(){
      totalComision += Number($(this).text())
    })
    strHTMLTfoot += '<th style="text-align:right" >' + Number(totalComision).toFixed(2) + '</th>';
    strHTMLTfoot += '</tr>';
    $('#TbReporteComision tfoot').append(strHTMLTfoot);

  },'JSON');
}

function cantidadProductoPorTabla(nombreProducto){
  var rpta = {
    nombreProducto : nombreProducto,
    cantidadEnTabla : 0
  }
  $.each($('#TbReporteComision tbody > tr'),function(){
    $.each($(this).find('td'),function(){
      var dataNombreProducto = $(this).attr('data-nombreproducto');
      if(dataNombreProducto == nombreProducto){
        rpta.cantidadEnTabla += Number($(this).text());
      }
    })
    //console.log('dataNombreProducto--',dataNombreProducto);
  });
  return rpta;
}

function cantidadProductoVendido(nombreProducto, data){
  var productoVendido = {
    cantidad: 0,
    producto: nombreProducto,
  }
  var Cantidad = 0;
  $.each(data, function(){
    if(nombreProducto == this.NomProducto){
      Cantidad = this.Cantidad
      productoVendido.cantidad += parseFloat(Cantidad);
    }
  });
  return productoVendido;
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
function PrimerDiaMes(Fecha) {
  var FechaArray = Fecha.split('/');
  var Fecha = 1 + '/' + FechaArray[1] + '/' + FechaArray[2];
  return Fecha;
}
</script>