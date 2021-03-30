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
        <h2>Reporte detallado &nbsp;&nbsp;&nbsp;<strong id="StnCantidadRegistros">-</strong>
          <input id="TxtFechaInicio" readonly class="FechaUI" style="width:130px;"/>
          <input id="TxtFechaFin" readonly class="FechaUI" style="width:130px;"/>
          <select id="SelEstado">
            <option value="0">TODOS</option>
            <option value="1">ACTIVO</option>
            <option value="3">ANULADO</option>
          </select>
          <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="button" onclick="ListaVenta()"><strong>Consulta</strong></button>
        </h2>
      </div>

   </div>
   <br>
   <div class="row wrapper border-bottom white-bg page-heading">
      <div class="col-lg-12">
        <br>
        <div class="table-responsive">
          <table class="table table-bordered" id="TbReporteDetallado">
              <thead>
                <tr>
                  <th>N</th>
                  <th>FECHA</th>
                  <th>DOCUMENTO</th>
                  <th>CLIENTE</th>
                  <th>VENDEDOR</th>
                  <th>PROD.</th>
                  <th style="text-align:right">SUBTOTAL</th>
                  <th style="text-align:right">IGV</th>
                  <th style="text-align:right">TOTAL</th>
                  <th style="text-align:right">GANAN.</th>
                  <th style="text-align:right">COMIS.</th>
                  <!-- <th>U.CREACIÓN</th>
                  <th>F.CREACIÓN</th> -->
                  <th>F.PAGO</th>
                  <th>ESTADO</th>
                  <th style="width:66px"></th>
                </tr>
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
<!-- Modal Anular Venta-->
<div class="modal fade" id="DivAnularVenta" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header ui-draggable-handle">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 style="font-weight:100" >Anular Venta</h4>
      </div>
      <div>
        <div>
          <div class="modal-body">
            <div class="body">
              <form class="form-vertical">
                  <div class="row clearfix">
                      <div class="col-md-12 form-control-label">
                        <h4>Motivo</h4>
                        <textarea id="TxtMotivoAnulacion" class="form-control" rows="2" id="comment"></textarea>
                      </div>

                  </div>
              </form>
            </div>
          </div>
          <div class="modal-footer">
            <button id="BtnAnularSI" type="button" class="btn btn-w-m btn-primary" onclick="AnularVenta();">SI</button>
            <button type="button" class="btn btn-w-m btn-danger" data-dismiss="modal">NO</button>
          </div>
        </div>
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
var TxtMotivoAnulacion = $('#TxtMotivoAnulacion');
var BtnAnularSI = $('#BtnAnularSI');
var CodVentaAnular = 0;
//
$(document).ajaxStart(function(event, jqXHR, settings) {
	$('#msjload').fadeIn();
});

$(document).ajaxComplete(function(event, jqXHR, settings) {
	$('#msjload').fadeOut();
});

$(document).ready(function(){

  //TxtFechaInicio.val(PrimerDiaMes(FechaHoraHoy(1)));
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
  ListaVenta();
});
var CodUsuario = '<?php echo $CodUsuario;?>';
//
function ListaVenta() {
  var FechaInicio =  FechaMySQL(TxtFechaInicio.val());
  var FechaFin = FechaMySQL(TxtFechaFin.val());
  var CodEstado = SelEstado.val();
  var Procedimiento = 'ProcVenta';
  var Parametros = FechaInicio + '|' + FechaFin + '|' + CodEstado;
  var Indice = 22;
  var SumaSubTotal = 0, SumaIGV = 0, SumaTotal = 0, SumaGanancia = 0;
  var URL = URL_BASE + 'Registros/procGeneral';
  var Data = {
    parametros: Parametros,
    indice: Indice,
    nombreProcedimiento: Procedimiento
  };
  //
  $.post(URL, Data, function (Data) {
    //
    TbReporteDetalladoCuerpo.empty();
    TbReporteDetalladoPie.empty();
    var FilasHTML = '';
    var PieHTML = '';
    var CantidadFilas = Data.length;
    //
    $.each(Data, function(i) {
      FilasHTML += '<tr data-codventa="' + this.CodVenta +'" >' +
        '<td>' + (i + 1) + '</td>' +
        '<td>' + this.FechaVenta  + '</td>' +
        '<td>' + this.Documento  + '</td>' +
        '<td>' + this.Cliente + '</td>' +
        '<td>' + this.Vendedor + '</td>' +
        '<td>' + this.ProductosVendidos + '</td>' +
        '<td style="text-align:right">' + this.SubTotal + '</td>' +
        '<td style="text-align:right">' + this.IGV + '</td>' +
        '<td style="text-align:right">' + this.Total + '</td>' +
        '<td style="text-align:right">' + this.Ganancia + '</td>' +
        '<td style="text-align:right">' + this.Comision + '</td>' +
        // '<td>' + this.NomUsuario + '</td>' +
        // '<td>' + this.FechaCreacion + '</td>' +
        '<td>' + this.NomFormaPago + '</td>' +
        '<td>' + this.NomEstado + '</td>' +
        '<td>' +
        '<button data-codventa="' + this.CodVenta + '" type="button" class="btn btn-warning btn-xs" onclick="ConsultaVoucherVenta(' + this.CodVenta + ');"><i class="fa fa-print"></i></button> '
      if (this.CodEstado == 1) {
        FilasHTML += '<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#DivAnularVenta" onclick="CodigoVenta(' + this.CodVenta + ');"><i class="fa fa-trash"></i></button>'
      } 
        //'<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#DivAnularVenta" onclick="CodigoVenta(' + this.CodVenta + ');"><i class="fa fa-trash"></i></button>' +
      FilasHTML += '</td>' +
        '</tr>';
      //
      if (this.CodEstado == 1) {
        SumaSubTotal += parseFloat(this.SubTotal);
        SumaIGV += parseFloat(this.IGV);
        SumaTotal += parseFloat(this.Total);
        SumaGanancia += parseFloat(this.Ganancia);
      }
    });
    PieHTML = '<tr>' +
      '<td colspan="6"></td>' +
      '<td style="text-align:right">' + SumaSubTotal.toFixed(2) + '</td>' +
      '<td style="text-align:right">' + SumaIGV.toFixed(2) + '</td>' +
      '<td style="text-align:right">' + SumaTotal.toFixed(2) + '</td>' +
      '<td style="text-align:right">' + SumaGanancia.toFixed(2) + '</td>' +
      '<td colspan="2"></td>' +
    '</tr>';
    TbReporteDetalladoCuerpo.append(FilasHTML);
    TbReporteDetalladoPie.append(PieHTML);
    $('#StnCantidadRegistros').text(CantidadFilas);
    
    // toastr.success('Registros cargados correctamente', 'Nota')
  }, "JSON");
}
function ConsultaVoucherVenta(CodVenta) {
  $('#TbVentaDetalle tbody').empty();
  var Procedimiento = 'ProcVenta';
  var Parametros = CodVenta;
  var Indice = 17;
  var URL = URL_BASE +'Registros/procGeneral';
  var Data = {
      parametros: Parametros,
      indice: Indice,
      nombreProcedimiento: Procedimiento
  };
  $.post(URL, Data, function (Data) {
    var NomUsuario = '<?php echo $_SESSION['username'];?>';
    //
    $('#NomUsuario').text(NomUsuario);
    $('#NomEmpresa').text(Data[0].NomEmpresa);
    $('#RucEmpresa').text(Data[0].RucEmpresa);
    $('#DireccionEmpresa').text(Data[0].DireccionEmpresa);
    $('#NomDocumento').text(Data[0].NomDocumento);
    $('#Documento').text(Data[0].Documento);
    $('#FechaEmision').text(Data[0].FechaEmision);
    $('#HoraEmision').text(Data[0].HoraEmision);
    $('#NomCaja').text(Data[0].NomCaja);
    $('#TipoMoneda').text(Data[0].TipoMoneda);
    $('#Cliente').text(Data[0].Cliente);
    $('#SubTotal').text(Data[0].SubTotal);
    $('#IGV').text(Data[0].IGV);
    $('#Total').text(Data[0].Total);
    $('#NomVendedor').text(Data[0].Vendedor);
    // Detalle
    var DetalleVenta = ConvertirAMatriz(Data[0].Detalle);
    var CantidadFilas = DetalleVenta.length, TablaHTML = '', SumaTotal = 0;
    //
    for (var i = 0; i < CantidadFilas; i++){
      N = DetalleVenta[i][0];
      Producto = DetalleVenta[i][1];
      Cantidad = DetalleVenta[i][2];
      Precio = DetalleVenta[i][3];
      Total = DetalleVenta[i][4];
      ImporteTotal = parseFloat(Total);
      //
      TablaHTML +=
        '<div class="N" style="float:left;">' + N + '</div>' +
        '<div class="Descripcion">' + Producto + '</div>' +
        '<div class="Sangria"></div>' +
        '<div class="Cantidad">' + Cantidad + '</div>' +
        '<div class="PUnit">' + Precio + '</div>' +
        '<div class="Total">' + Total + '</div>';
      //
      SumaTotal += ImporteTotal;
    }
    $('#DivVentaDetalle').html(TablaHTML);
    //
    $('#impresionBoleto').printArea()
  },'JSON');
}
function ConvertirAMatriz(Datos, SeparadorColumna = '|', SeparadorFila = '~') {
  var Filas = String(Datos).split(SeparadorFila);
  var CantFilas = Filas.length - 1;
  var Matriz = new Array(CantFilas);
  for (j = 0; j <= CantFilas; j++) {
    Matriz[j] = String(Filas[j]).split(SeparadorColumna);
  }
  return Matriz;
}
function CodigoVenta(CodVenta) {
  CodVentaAnular = CodVenta;
}
function AnularVenta(CodVenta) {
  var MotivoAnulacion = TxtMotivoAnulacion.val();
  if (MotivoAnulacion == '') {
    toastr.warning('Debe ingresar motivo!');
    TxtMotivoAnulacion.focus();
    return;
  }
  // Bloquear el Botón SI
  BtnAnularSI.attr("disabled", true);

  var Procedimiento = 'ProcVenta';
  var Parametros = CodVentaAnular + '|' + CodUsuario + '|' + MotivoAnulacion;
  var Indice = 40;
  var URL = URL_BASE + 'Venta/ProcVentaAnularTran';
  var Data = {
    Procedimiento: Procedimiento,
    Parametros: Parametros,
    Indice: Indice
  };
  //
  $.post(URL, Data, function(Data) {
    //
    var CodResultado = Data.CodResultado,
        DesResultado = Data.DesResultado;
    //
    if (CodResultado == 1) {
      // $('#BtnCerrar').trigger('click');
      $('#DivAnularVenta').modal('hide');
      ListaVenta();
      // Limpia
      TxtMotivoAnulacion.val('');
      toastr.success(DesResultado, 'Éxito');
    } else {
      toastr.error(DesResultado, 'Error');
    }
    // Habilita botón
    BtnAnularSI.removeAttr("disabled");
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

