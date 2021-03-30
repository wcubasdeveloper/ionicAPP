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
  .TextoDerecha {
    text-align: right !important;
  }
  .TamanioTotales {
    font-size: 16px;
  }
  .Link{
    color:blue;
  }
  .Link:hover{
    cursor:pointer;
    text-decoration:underline;
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
  .product-imitation{
    padding:0px;
  }
</style>
<?php
    $CodUsuario = $_SESSION['codusuario'];
    $CodPersona = $_SESSION['CodPersona'];
?>
<div class="row">
   <div class="row wrapper border-bottom white-bg page-heading">
      <div class="col-lg-12">
        <h2>Pedidos&nbsp;&nbsp;&nbsp;<strong id="StnCantidadRegistros">-</strong>
          <input id="TxtFechaInicio" readonly class="FechaUI" style="width:130px;"/>
          <input id="TxtFechaFin" readonly class="FechaUI" style="width:130px;"/>
          <button class="btn btn-sm btn-success m-t-n-xs" type="button" onclick="" ><strong>Consultar</strong></button>
          <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="button" data-toggle="modal" data-target="#DivPedido" ><strong>Nuevo</strong></button>
        </h2>
      </div>
   </div>
   <br>
   <div class="row wrapper border-bottom white-bg page-heading">
      <div class="col-lg-12">
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row" id="contenedorVendedores">
                <div class="col-md-3" hidden>
                    <div class="ibox">
                        <div class="ibox-content product-box">
                            <div class="product-imitation" style="padding: 2px; background-color: #1bb394; color: black;" >
                            </div>
                            <div class="product-desc">
                                <p class="text-center"><i class="fa fa-user-circle-o" aria-hidden="true" style="font-size: 70px;"></i></p>
                                <a href="#" class="product-name text-center">WILLIAM C.</a>
                               <br>
                                <table style="width: 100%;font-size: 14px;">
                                  <tr>
                                    <td><i class="fa fa-money"></i></td>
                                    <td>Total Venta</td>
                                    <td class="text-right">130</td>
                                  </tr>
                                  <tr>
                                    <td><i class="fa fa-cubes"></i></td>
                                    <td>Cantidad Productos</td>
                                    <td class="text-right" >130</td>
                                  </tr>
                                </table>

                                <div class="small m-t-xs" hidden>
                                    Many desktop publishing packages and web page editors now.
                                </div>
                                <div class="m-t text-righ">
                                    <a href="#" class="btn btn-xs btn-outline btn-primary">Ver <i class="fa fa-long-arrow-right"></i> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>




            </div>

        </div>

      </div>
   </div>
</div>
<!-- Modal Registrar Pedido-->
<div class="modal fade" id="DivPedido" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document" style="min-width:80%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="defaultModalLabel">Registrar Pedido</h4>
      </div>
      <div class="modal-body">
        <div class="body">
          <form class="form-vertical">
            <div class="row clearfix">
              <div class="col-md-3 form-control-label">
                <label for="TxtFechaPedido">Fecha:</label>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <div class="form-line">
                    <input id="TxtFechaPedido" readonly type="text" value="" class="form-control FechaUI" required="">
                  </div>
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-md-3 form-control-label">
                <label for="SelCliente">Cliente:</label>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <div class="form-line">
                    <select id="SelCliente" class="form-control m-b" data-live-search="true"></select>
                  </div>
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-md-3 form-control-label">
                <label for="SelDocumentoVenta">Doc. Venta:</label>
              </div>
              <div class="col-md-9 form-inline">
                <div class="form-group">
                  <select id="SelDocumentoVenta" class="form-control m-b" >
                    <option value="1">NOTA DE VENTA</option>
                    <option value="2">BOLETA VENTA</option>
                    <option value="3">FACTURA</option>
                  </select>
                  <select id="SelVentaCondicion" class="form-control m-b" >
                    <option value="1">CONTADO</option>
                    <option value="2">CRÉDITO</option>
                  </select>
                </div>
              </div>
            </div>
            <!-- <div class="row clearfix">
              <div class="col-md-3 form-control-label">
                <label for="SelAlmacen">Almacen:</label>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <div class="form-line">
                    <select id="SelAlmacen" class="form-control m-b">
                      <option value="1">Almacen Central</option>
                    </select>
                  </div>
                </div>
              </div>
            </div> -->
            <div class="row clearfix">
              <div class="col-md-3 form-control-label">
                <label for="TxtComentario">Comentario:</label>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <div class="form-line">
                    <textarea id="TxtComentario" class="form-control rounded-0" rows="2" placeholder="Ingrese comentario..."></textarea>
                  </div>
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-md-3 form-control-label">
                <label for="TxtComentario">Producto:</label>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <div class="form-line">
                    <select id="SelProducto" data-live-search="true"></select>
                    <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="button" data-toggle="modal" onclick="AgregarProducto()"><strong>Agregar</strong></button>
                  </div>
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-md-12 table-wrapper-scroll-y">
                <div class="form-group">
                  <table class="table table-bordered" id="TbPedidoDetalle">
                    <thead>
                      <tr>
                        <th class="tdN">N</th>
                        <th>PRODUCTO</th>
                        <th class="Importe">CANTIDAD</th>
                        <th class="Importe">P.UNIT</th>
                        <th class="Importe">SUBTOTAL</th>
                        <th class="tdN"></th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                      <tr>
                        <td colspan="6"></td>
                      </tr>
                      <tr>
                        <td colspan="3"></td>
                        <td style="text-align:right;font-size:16px;"><b>SUBTOTAL</b></td>
                        <td id="TdSubTotal" style="text-align:right;font-size:16px;font-weight:bold;"></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td colspan="3"></td>
                        <td style="text-align:right;font-size:16px;"><b>IGV</b></td>
                        <td id="TdIGV" style="text-align:right;font-size:16px;font-weight:bold;"></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td colspan="3"></td>
                        <td style="text-align:right;font-size:16px;"><b>TOTAL</b></td>
                        <td id="TdTotal" style="text-align:right;font-size:16px;font-weight:bold;"></td>
                        <td></td>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="BtnGuardar" class="btn btn-w-m btn-primary" onclick="GuardarPedido();">Guardar</button>
        <button type="button" id="BtnCerrar" class="btn btn-w-m btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal Ver Detalle de Pedido-->
<div class="modal fade" id="DivVerPedido" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header ui-draggable-handle">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="defaultModalLabel">Detalle de Pedido</h4>
      </div>
      <div class="modal-body">
        <div class="body">
          <form class="form-vertical">
            <div class="row clearfix">
              <div class="col-md-3 form-control-label">
                <label>NRoPedido:</label>
              </div>
              <div class="col-md-7">
                <div class="form-group">
                  <div class="form-line">
                    <label class="DatoLimpiar" id="LblNroPedidoVendedor"></label>
                  </div>
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-md-3 form-control-label">
                <label>Fecha:</label>
              </div>
              <div class="col-md-7">
                <div class="form-group">
                  <div class="form-line">
                    <label class="DatoLimpiar" id="LblFechaPedido"></label>
                  </div>
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-md-3 form-control-label">
                <label>Cliente:</label>
              </div>
              <div class="col-md-7">
                <div class="form-group">
                  <div class="form-line">
                    <label class="DatoLimpiar" id="LblCliente"></label>
                  </div>
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-md-3 form-control-label">
                <label>Doc. Venta:</label>
              </div>
              <div class="col-md-7">
                <div class="form-group">
                  <div class="form-line">
                    <label class="DatoLimpiar" id="LblDocumentoVenta"></label>
                  </div>
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-md-3 form-control-label">
                <label for="">Vendedor:</label>
              </div>
              <div class="col-md-7">
                <div class="form-group">
                  <div class="form-line">
                    <label class="DatoLimpiar" id="LblVendedor"></label>
                  </div>
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-md-3 form-control-label">
                <label for="">F.Registro:</label>
              </div>
              <div class="col-md-7">
                <div class="form-group">
                  <div class="form-line">
                    <label class="DatoLimpiar" id="LblFechaCreacion"></label>
                  </div>
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-md-3 form-control-label">
                <label for="">Estado:</label>
              </div>
              <div class="col-md-7">
                <div class="form-group">
                  <div class="form-line">
                    <label class="DatoLimpiar" id="LblNomEstado"></label>
                  </div>
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-md-12">
                <div class="form-group">
                  <table class="table table-bordered table-wrapper-scroll-y" id="TbPedidoDetalleVista">
                    <thead>
                      <tr>
                        <th class="col-md-1">N</th>
                        <th class="col-md-8">PRODUCTO</th>
                        <th class="col-md-3">CANTIDAD</th>
                        <th class="col-md-3">P.UNIT</th>
                        <th class="col-md-3">TOTAL</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-md-8 form-control-label">
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <div class="form-line TextoDerecha">
                    <label>Sub Total</label>
                  </div>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <div class="form-line TextoDerecha TamanioTotales">
                    <label class="DatoLimpiar" id="LblSubTotal"></label>
                  </div>
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-md-8 form-control-label">
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <div class="form-line TextoDerecha">
                    <label>IGV</label>
                  </div>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <div class="form-line TextoDerecha TamanioTotales">
                    <label class="DatoLimpiar" id="LblIGV"></label>
                  </div>
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-md-8 form-control-label">
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <div class="form-line TextoDerecha">
                    <label>Total</label>
                  </div>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <div class="form-line TextoDerecha TamanioTotales">
                    <label class="DatoLimpiar" id="LblTotal"></label>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-w-m btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal Anular Pedido-->
<div class="modal fade" id="DivAnularPedido" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header ui-draggable-handle">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 style="font-weight:100" >Anular registro</h4>
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
            <button id="BtnAnularSI" type="button" class="btn btn-w-m btn-primary" onclick="AnularPedido();">SI</button>
            <button type="button" class="btn btn-w-m btn-danger" data-dismiss="modal">NO</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
//
var TxtFechaInicio = $("#TxtFechaInicio");
var TxtFechaFin = $("#TxtFechaFin");
var TbPedidoCuerpo = $('#TbPedido tbody');
var TbPedidoPie = $('#TbPedido tfoot');
var TbPedidoDetalleVistaCuerpo = $('#TbPedidoDetalleVista tbody');
var TbPedidoDetalleCuerpo = $('#TbPedidoDetalle tbody');
var TbPedidoDetallePie = $('#TbPedidoDetalle tfoot');
var SelCliente = $("#SelCliente");
var SelDocumentoVenta = $("#SelDocumentoVenta");
var SelProducto = $("#SelProducto");
var TxtFechaPedido = $("#TxtFechaPedido");
var TxtComentario = $("#TxtComentario");
var BtnGuardar = $("#BtnGuardar");
var TxtMotivoAnulacion = $('#TxtMotivoAnulacion');
var BtnAnularSI = $('#BtnAnularSI');
var TdSubTotal = $('#TdSubTotal');
var TdIGV = $('#TdIGV');
var TdTotal = $('#TdTotal');
var SelVentaCondicion = $('#SelVentaCondicion');

var CodPedidoAnular = 0;
/********************* */

// $(".Decimal").inputmask('Regex', {regex: "^[0-9]{1,6}(\\.\\d{1,2})?$"});

$(document).ajaxStart(function(event, jqXHR, settings) {
	$('#msjload').fadeIn();
});
$(document).ajaxComplete(function(event, jqXHR, settings) {
	$('#msjload').fadeOut();
});
$(document).ready(function(){
  TxtFechaInicio.val(FechaHoraHoy(1));
  TxtFechaFin.val(FechaHoraHoy(1));
  TxtFechaPedido.val(FechaHoraHoy(1));
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
  //ListaPedido();
  //ListaProducto();
  //ListaCliente();
  listarVendedores();
});
var CodUsuario = '<?php echo $CodUsuario;?>';
var CodPersona = '<?php echo $CodPersona;?>';
//
/********************************************** */

function listarVendedores(){

  var Procedimiento = 'ProcPersona';
  var Parametros = 1;
  var Indice = 13;
  var URL = URL_BASE +'Registros/procGeneral';
  var Data = {
    parametros: Parametros,
    indice: Indice,
    nombreProcedimiento: Procedimiento
  };
  //
  $.post(URL, Data, function(Data) {
    console.log('RPTA',Data)
    $('#contenedorVendedores').empty();
    var strHTMLvendedor = '';
    $.each(Data, function(){
      strHTMLvendedor += 
            '<div class="col-md-3">' +
                    '<div class="ibox">'+
                        '<div class="ibox-content product-box">'+
                            '<div class="product-imitation" style="padding: 2px; background-color: #1bb394; color: black;" >'+
                            '</div>'+
                            '<div class="product-desc">'+
                                '<p class="text-center"><i class="fa fa-user-circle-o" aria-hidden="true" style="font-size: 70px;"></i></p>'+
                                '<a href="#" class="product-name text-center">'+ this.NomPersona +'</a>'+
                              '<br>'+
                                '<table style="width: 100%;font-size: 14px;">'+
                                  '<tr>'+
                                    '<td><i class="fa fa-money"></i></td>'+
                                    '<td>Total Venta</td>'+
                                    '<td class="text-right">'+ this.Total +'</td>'+
                                  '</tr>'+
                                  '<tr>'+
                                    '<td><i class="fa fa-cubes"></i></td>'+
                                    '<td>Cantidad Productos</td>'+
                                    '<td class="text-right" >'+ this.CantidadProductos +'</td>'+
                                  '</tr>'+
                                '</table>'+
                                '<div class="m-t text-righ">'+
                                    '<a href="#" class="btn btn-xs btn-outline btn-primary">Ver <i class="fa fa-long-arrow-right"></i> </a>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
            '</div>'
    })
    $('#contenedorVendedores').append(strHTMLvendedor);
  },'JSON');
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

