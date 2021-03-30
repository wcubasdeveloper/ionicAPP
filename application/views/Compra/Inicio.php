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
                  <strong><?=$Titulo?></strong>
              </li>
          </ol>
          <h2>(<strong id="StnCantidadRegistros">-</strong>) Compras <i title="Agregar nueva compra" data-toggle="modal" data-target="#DivCompra" onclick="NuevoCompra()"   style="cursor:pointer;color:#1ab394" class="fa fa-plus"></i> </h2>
      
      </div>
      <div class="col-lg-4">

      </div>
  </div>

  <div class="row wrapper border-bottom white-bg page-heading form-group">
    <label class="col-lg-2 col-form-label" style="padding-top: 26px;" >Fecha consulta</label>
    <div class="col-lg-2" style="padding-top: 17px;" >
      <input id="TxtFechaInicio" placeholder="Fecha inicio" readonly class="FechaUI form-control" style="width:130px;"/>
    </div>

    <div class="col-lg-2" style="padding-top: 17px;" >
      <input id="TxtFechaFin"  readonly placeholder="Fecha fin" class="FechaUI form-control" style="width:130px;"/>
    </div>

    <div class="col-lg-6" style="padding-top: 17px;" >
      <button class="btn btn-sm btn-success pull-right m-t-n-xs" type="button" onclick="ListaCompra()"><strong>Consulta</strong></button>
    </div>
  </div>


  <!-- <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
      <h2>Compras&nbsp;&nbsp;&nbsp;<strong id="StnCantidadRegistros">-</strong>
        <input id="TxtFechaInicio" readonly class="FechaUI" style="width:130px;"/>
        <input id="TxtFechaFin" readonly class="FechaUI" style="width:130px;"/>
        <button class="btn btn-sm btn-success pull-right m-t-n-xs" type="button" onclick="ListaCompra()"><strong>Consulta</strong></button>
      </h2>
    </div>
  </div> -->

  <br>
  <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
      <br>
      <div class="table-responsive">
        <table class="table table-bordered" id="TbCompra">
          <thead>
            <tr>
              <th>N</th>
              <th>FECHA</th>
              <th>PROVEEDOR</th>
              <th>RUC</th>
              <th>DOCUMENTO</th>
              <th class="text-right"  >SUB TOTAL</th>
              <th class="text-right"  >IGV</th>
              <th class="text-right"  >TOTAL</th>
              <th>U.REACIÓN</th>
              <th>F.CREACIÓN</th>
              <th>ESTADO</th>
              <th  style="width:90px;">ACCIONES</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- Modal Registrar Compra-->
<div class="modal fade" id="DivCompra" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document" style="width:750px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="defaultModalLabel">Registrar Compra</h4>
      </div>
      <div class="modal-body">
        <div class="body">
          <form class="form-vertical">
            <div class="row clearfix">
              <div class="col-md-3 form-control-label">
                <label for="TxtFechaCompra">Fecha:</label>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <div class="form-line">
                    <input id="TxtFechaCompra" readonly type="text" value="" class="form-control FechaUI" required="">
                  </div>
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-md-3 form-control-label">
                <label for="SelProveedor">Proveedor:</label>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <div class="form-line">
                    <select id="SelProveedor" class="form-control m-b" data-live-search="true"></select>
                  </div>
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-md-3 form-control-label">
                <label for="SelDocumento">Documento:</label>
              </div>
              <div class="col-md-9 form-inline">
                <div class="form-group">
                    <select id="SelDocumento" class="form-control m-b" >
                      <option value="2">BOLETA VENTA</option>
                      <option value="3">FACTURA</option>
                      <option value="1">R.INTERNO</option>
                    </select>
                </div>
                <div class="form-group">
                    <input id="TxtSerie" class="form-control m-b" maxlength="4" style="width:80px;" />
                </div>
                <div class="form-group">
                  <input id="TxtNumero" class="form-control m-b" type="number" maxlength="20" style="width:120px;" />
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-md-3 form-control-label">
                <label for="SelAlmacen">Almacen:</label>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <div class="form-line">
                    <select id="SelAlmacen" class="form-control m-b"></select>
                  </div>
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-md-3 form-control-label">
                <label for="TxtComentario">Comentario:</label>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <div class="form-line">
                    <textarea id="TxtComentario" class="form-control rounded-0" rows="2" placeholder="Ingrese texto..."></textarea>
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
                  <table class="table table-bordered" id="TbCompraDetalle">
                    <thead>
                      <tr>
                        <th class="col-md-1">N</th>
                        <th class="col-md-6">PRODUCTO</th>
                        <th class="col-md-1">UM</th>
                        <th class="col-md-1">CANTIDAD</th>
                        <th class="col-md-1">P.UNIT</th>
                        <th class="col-md-1">TOTAL</th>
                        <th class="col-md-1">QUITAR</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="BtnGuardar" class="btn btn-w-m btn-primary" onclick="GuardarCompra();">Guardar</button>
        <button type="button" id="BtnCerrar" class="btn btn-w-m btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Ver Detalle de Compra-->
<div class="modal fade" id="DivVerCompra" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header ui-draggable-handle">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="defaultModalLabel">Detalle de compra</h4>
      </div>
      <div class="modal-body">
        <div class="body">
          <form class="form-vertical">
            <div class="row clearfix">
              <div class="col-md-3 form-control-label">
                <label>Fecha:</label>
              </div>
              <div class="col-md-7">
                <div class="form-group">
                  <div class="form-line">
                    <label class="DatoLimpiar" id="LblFechaCompra"></label>
                  </div>
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-md-3 form-control-label">
                <label>Proveedor:</label>
              </div>
              <div class="col-md-7">
                <div class="form-group">
                  <div class="form-line">
                    <label class="DatoLimpiar" id="LblNomProveedor"></label>
                  </div>
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-md-3 form-control-label">
                <label>Documento:</label>
              </div>
              <div class="col-md-7">
                <div class="form-group">
                  <div class="form-line">
                    <label class="DatoLimpiar" id="LblDocumento"></label>
                  </div>
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-md-3 form-control-label">
                <label for="">Usuario:</label>
              </div>
              <div class="col-md-7">
                <div class="form-group">
                  <div class="form-line">
                    <label class="DatoLimpiar" id="LblNomUsuario"></label>
                  </div>
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-md-3 form-control-label">
                <label for="">Creación:</label>
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
                  <table class="table table-bordered table-wrapper-scroll-y" id="TbCompraDetalleVista">
                    <thead>
                      <tr>
                        <th class="col-md-1">N</th>
                        <th class="col-md-8">PRODUCTO</th>
                        <th class="col-md-3">CANTIDAD</th>
                        <th class="col-md-3" style="text-align:right"  >P.UNIT</th>
                        <th class="col-md-3" style="text-align:right" >TOTAL</th>
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
<!-- Modal Anular Compra-->
<div class="modal fade" id="DivAnularCompra" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header ui-draggable-handle">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 style="font-weight:100" >Anular compra</h4>
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
            <button id="BtnAnularSI" type="button" class="btn btn-w-m btn-primary" onclick="AnularCompra();">SI</button>
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
var TbCompraCuerpo = $('#TbCompra tbody');
var TbCompraDetalleVistaCuerpo = $('#TbCompraDetalleVista tbody');
var TbCompraDetalleCuerpo = $('#TbCompraDetalle tbody');
var SelProveedor = $("#SelProveedor");
var SelDocumento = $("#SelDocumento");
var SelAlmacen = $('#SelAlmacen');
var SelProducto = $("#SelProducto");
var TxtFechaCompra = $("#TxtFechaCompra");
var TxtSerie = $('#TxtSerie');
var TxtNumero = $('#TxtNumero');
var TxtComentario = $("#TxtComentario");
var BtnGuardar = $("#BtnGuardar");
var TxtMotivoAnulacion = $('#TxtMotivoAnulacion');
var BtnAnularSI = $('#BtnAnularSI');
var CodCompraAnular = 0;

$(document).ajaxStart(function(event, jqXHR, settings) {
	$('#msjload').fadeIn();
});
$(document).ajaxComplete(function(event, jqXHR, settings) {
	$('#msjload').fadeOut();
});
$(document).ready(function(){
  TxtFechaInicio.val(PrimerDiaMes(FechaHoraHoy(1)));
  TxtFechaFin.val(FechaHoraHoy(1));
  TxtFechaCompra.val(FechaHoraHoy(1));
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
  ListaCompra();
  ListaAlmacen();
  ListaProducto();
  ListaProveedor();
});
var CodUsuario = '<?php echo $CodUsuario;?>';
//
function ListaCompra() {
  var FechaInicio = FechaMySQL(TxtFechaInicio.val());
  var FechaFin = FechaMySQL(TxtFechaFin.val());
  var Procedimiento = 'ProcCompra';
  var Parametros = FechaInicio + '|' + FechaFin;
  var Indice = 10;
  var URL = URL_BASE +'Registros/procGeneral';
  var Data = {
    parametros: Parametros,
    indice: Indice,
    nombreProcedimiento: Procedimiento
  };
  //
  $.post(URL, Data, function (Data) {
    //
    TbCompraCuerpo.empty();
    var FilasHTML = '';
    var CantidadFilas = Data.length;
    //
    $.each(Data, function(i) {
      FilasHTML += '<tr data-codcompra="' + this.CodCompra +'" >' +
        '<td>' + (i + 1) + '</td>' +
        '<td>' + this.FechaCompra + '</td>' +
        '<td>' + this.NomProveedor + '</td>' +
        '<td>' + this.RucProveedor + '</td>' +
        '<td>' + this.Documento + '</td>' +
        '<td class="text-right"  >' + this.SubTotal + '</td>' +
        '<td class="text-right"  >' + this.IGV + '</td>' +
        '<td class="text-right"  >' + this.Total + '</td>' +
        '<td>' + this.NomUsuario + '</td>' +
        '<td>' + this.FechaCreacion + '</td>' +
        '<td>' + this.NomEstado + '</td>' +
        '<td>' +
          '<button data-codcompra="' + this.CodCompra + '"' +
            ' type="button"class="btn btn-warning btn-xs" data-toggle="modal" data-target="#DivVerCompra" onclick="VerCompra($(this))"><i class="fa fa-edit"></i></button>' +
          '&nbsp;&nbsp;'+
          '<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#DivAnularCompra" onclick="CodigoCompra(' + this.CodCompra + ');"><i class="fa fa-trash"></i></button>' +
        '</td>' +
      '</tr>';
    });
    TbCompraCuerpo.append(FilasHTML);
    $('#StnCantidadRegistros').text(CantidadFilas);
    // toastr.success('Registros cargados correctamente', 'Nota')
  }, "JSON");
}
function VerCompra(element) {
  var CodCompra = element.attr('data-codcompra');
  var Procedimiento = 'ProcCompra';
  var Parametros = CodCompra;
  var Indice = 11;
  var URL = URL_BASE +'Registros/procGeneral';
  var Data = {
    parametros: Parametros,
    indice: Indice,
    nombreProcedimiento: Procedimiento
  };
  // LimpiarLabels
  $('.DatoLimpiar').html('');
  TbCompraDetalleVistaCuerpo.empty();
  //
  $.post(URL, Data, function (Data) {
    //
    var FechaCompra = Data[0].FechaCompra,
        NomProveedor = Data[0].NomProveedor,
        RucProveedor = Data[0].RucProveedor,
        Documento = Data[0].Documento,
        SubTotal = Data[0].SubTotal,
        IGV = Data[0].IGV,
        Total = Data[0].Total,
        NomUsuario = Data[0].NomUsuario,
        FechaCreacion = Data[0].FechaCreacion,
        NomEstado = Data[0].NomEstado;
    //
    $('#LblFechaCompra').html(FechaCompra);
    $('#LblNomProveedor').html(NomProveedor);
    $('#LblRUCProveedor').html(RucProveedor);
    $('#LblDocumento').html(Documento);
    $('#LblSubTotal').html(SubTotal);
    $('#LblIGV').html(IGV);
    $('#LblTotal').html(Total);
    $('#LblNomUsuario').html(NomUsuario);
    $('#LblFechaCreacion').html(FechaCreacion);
    $('#LblNomEstado').html(NomEstado);
  }, "JSON");
  // Consulta Detalle de almacen
  Procedimiento = 'ProcCompraDetalle';
  Parametros = CodCompra;
  Indice = 10;
  URL = URL_BASE +'Registros/procGeneral';
  Data = {
    parametros: Parametros,
    indice: Indice,
    nombreProcedimiento: Procedimiento
  };
  $.post(URL, Data, function (Data) {
    var FilasHTML = '';
    //
    $.each(Data, function(i) {
      FilasHTML += '<tr>'+
        '<td>' + (i + 1) + '</td>'+
        '<td>' + this.NomProducto  + '</td>'+
        '<td>' + this.Cantidad + '</td>'+
        '<td>' + this.PrecioCosto + '</td>'+
        '<td>' + this.Total + '</td>'+
      '</tr>';
    });
    TbCompraDetalleVistaCuerpo.append(FilasHTML);
    //
  }, "JSON");
}
function ListaProducto() {
  var Procedimiento = 'ProcProducto';
  var Parametros = 0;
  var Indice = 12;
  var URL = URL_BASE +'Registros/procGeneral';
  var Data = {
    parametros: Parametros,
    indice: Indice,
    nombreProcedimiento: Procedimiento
  };
  $.post(URL, Data, function (Data) {
    var OptionHTML = '';
    //
    $.each(Data, function(i) {
      OptionHTML += '<option data-um="'+ this.NomProductoUM +'" value="' + this.CodProducto +'" >' + this.NomProducto + '</option>';
    });
    SelProducto.append(OptionHTML);
    SelProducto.selectpicker("refresh");
  },'JSON');
}
function ListaAlmacen() {
  var Procedimiento = 'ProcAlmacenMovimiento';
  var Parametros = 0;
  var Indice = 13;
  var URL = URL_BASE + 'Registros/procGeneral';
  var Data = {
    parametros: Parametros,
    indice: Indice,
    nombreProcedimiento: Procedimiento
  };
  $.post(URL, Data, function (Data) {
    var OptionHTML = '';
    //
    $.each(Data, function(i) {
      OptionHTML += '<option value="' + this.CodAlmacen +'" >' + this.NomAlmacen + '</option>';
    });
    SelAlmacen.append(OptionHTML);
  },'JSON');
}
function ListaProveedor() {
  var Procedimiento = 'ProcProveedor';
  var Parametros = 0;
  var Indice = 11;
  var URL = URL_BASE +'Registros/procGeneral';
  var Data = {
    parametros: Parametros,
    indice: Indice,
    nombreProcedimiento: Procedimiento
  };
  $.post(URL, Data, function (Data) {
    var OptionHTML = '';
    //
    $.each(Data, function(i) {
      OptionHTML += '<option value="' + this.Codigo +'" >' + this.Nombre + '</option>';
    });
    SelProveedor.append(OptionHTML);
    SelProveedor.selectpicker("refresh");
  },'JSON');
}
function AgregarProducto() {
  var CodProducto = SelProducto.val();
  var NomProducto = SelProducto.find(':selected').text();
  var unidadMedidaProducto =  SelProducto.find(':selected').attr('data-um');

  var ProductoRepetido = 0;
  // Verifica si el producto ya está en la lista.
  TbCompraDetalleCuerpo.children('tr').each(function(i) {
    var CodProductoTabla = $(this).data('codproducto');
    if (CodProducto == CodProductoTabla) {
      ProductoRepetido = 1;
      return;
    }
  });
  if (ProductoRepetido == 1) {
    toastr.warning('El producto ya se encuentra en la lista!');
    return;
  }
  
  var Cantidad = '<input type="number" style="width:90px;text-align: right;" onClick="this.select()" onkeypress="cambiarFocusTablaCompraDetalle($(this).parent().parent(), event);" onkeyup="ObtenerPrecioCosto(this.parentNode.parentNode, event, $(this));" min="1" value="1"/>';
  var SubTotal = '<input type="number" style="text-align: right;" class="Decimal" onClick="this.select()" onkeyup="ObtenerPrecioCosto(this.parentNode.parentNode, event, $(this));" autofocus style="width:90px;" min="1" value="1"/>';
  var FilaHTML = '';
  var NroFila = TbCompraDetalleCuerpo.children('tr').length + 1;
  FilaHTML = '<tr data-codproducto="' + CodProducto + '">' +
    '<td>' + NroFila + '</td>' +
    '<td>' + NomProducto + '</td>' +
    '<td>' + unidadMedidaProducto + '</td>' +
    '<td  style="text-align:right">' + Cantidad + '</td>' +
    '<td  style="text-align:right" >' + '1' + '</td>' +
    '<td  style="text-align:right" >' + SubTotal + '</td>' +
    '<td><button type="button" class="btn btn-danger btn-xs" onclick="QuitarFila(this.parentNode.parentNode);"><i class="fa fa-trash"></i></button></td>' +
  '</tr>';
  TbCompraDetalleCuerpo.append(FilaHTML);
  $('#TbCompraDetalle tbody').find('tr').eq( NroFila - 1 ).find('td').eq(2).find('input').eq(0).select().focus();

}

function cambiarFocusTablaCompraDetalle(elementoTr, e){

    if(e.which == 13) {
        elementoTr.find('td').eq(5).find('input').eq(0).select().focus();
    }

}

function ObtenerPrecioCosto(Fila, e, elemento) {
  ///
  var Cantidad = parseFloat(Fila.cells[3].children[0].value);
  var SubTotal = parseFloat(Fila.cells[5].children[0].value);
  //
  //
  if(SubTotal == 0){
    $(Fila.cells[5].children[0]).val(1);
  }

  if(Cantidad == 0){
    elemento.val(1).select().focus();
    Cantidad = 1
  }
  //
  if (isNaN(Cantidad) == 1 ) {  elemento.val(1).select().focus(); Cantidad = 1; return; }
  if (isNaN(SubTotal) == 1 ) { elemento.val(1).select().focus(); Cantidad = 1; return; }
  //
  var PrecioCosto =  SubTotal / Cantidad;
  // Setea en la fila el PrecioCosto
  Fila.cells[4].innerHTML = PrecioCosto.toFixed(2);
}


function QuitarFila(Fila) {
  $(Fila).remove();
  // Reordenar Nro Item
  TbCompraDetalleCuerpo.children('tr').each(function (i) {
    this.cells[0].innerHTML = (i + 1);
  });
}
function NuevoCompra() {
  
}
function GuardarCompra() {
  //
  var FechaCompra = TxtFechaCompra.val();
  var Serie = TxtSerie.val();
  var Numero = TxtNumero.val();
  var Comentario = TxtComentario.val();
  //
  if(FechaCompra == ""){
    toastr.warning('Debe ingresar Fecha, hasta el colocar plugin!');
    TxtFechaCompra.focus();
    return;
  }
  if(Serie == ""){
    toastr.warning('Debe ingresar Serie del documento!');
    TxtSerie.focus();
    return;
  }
  if(Numero == ""){
    toastr.warning('Debe ingresar número del documento!');
    TxtNumero.focus();
    return;
  }
  if(Comentario == ""){
    toastr.warning('Debe ingresar comentario!');
    TxtComentario.focus();
    return;
  }
  if (TbCompraDetalleCuerpo.children('tr').length == 0) {
    toastr.warning('Debe agregar por lo menos 1 producto!');
    return;
  }
  var ValidacionDetalle = 1;
  var InputFocus;
  TbCompraDetalleCuerpo.children('tr').each(function (i) {
    //
    var Cantidad = this.cells[3].children[0].value;
    var SubTotal = this.cells[5].children[0].value;
    if (Cantidad == '') { ValidacionDetalle = 0; InputFocus = this.cells[3].children[0]; return; }
    if (SubTotal == '') { ValidacionDetalle = 0; InputFocus = this.cells[5].children[0]; return; }
  });
  if (ValidacionDetalle == 0) {
    $(InputFocus).focus();
    toastr.warning('El campo no debe estar vacio');
    return;
  }
  //Bloquea botón al guardar
  BtnGuardar.attr("disabled", true);
  //
  var CodProveedor  = $('#SelProveedor').val();
  var CodDocumento  = $('#SelDocumento').val();
  var CodAlmacen  = $('#SelAlmacen').val();
  // Serializar Detalle articulos
  var CompraDetalleSerializado = '';
  var CodProducto = '', Cantidad, SubTotal;
  TbCompraDetalleCuerpo.children('tr').each(function (i) {
    CodProducto = $(this).data('codproducto');
    Cantidad = this.cells[3].children[0].value
    SubTotal = this.cells[5].children[0].value
    CompraDetalleSerializado += CodProducto + '|' + Cantidad + '|' + SubTotal + '~';
  });
  CompraDetalleSerializado = CompraDetalleSerializado.substring(0, CompraDetalleSerializado.length - 1);
  //
  var Procedimiento = 'ProcCompra';
  var Parametros = FechaMySQL(FechaCompra) + '|' + CodProveedor + '|' + CodDocumento + '|' +
      Serie + '|' + Numero + '|' + Comentario + '|' + CodUsuario + '|' + CodAlmacen;
  var Indice = 20;
  var URL = URL_BASE + 'Compra/ProcCompraTran';
  //
  var Data = {
    Procedimiento: Procedimiento,
    Parametros: Parametros,
    ParametrosDetalle: CompraDetalleSerializado,
    Indice: Indice,
  };
  //
  $.post(URL, Data, function(Data) {
    //
    var CodResultado = Data.CodResultado,
        DesResultado = Data.DesResultado;
    //
    if (CodResultado == 1) {
      // $('#BtnCerrar').trigger('click');
      $('#DivCompra').modal('hide');
      ListaCompra();
      // Limpia
      TxtComentario.val('');
      TbCompraDetalleCuerpo.empty();
      TxtSerie.val('');
      TxtNumero.val('');
      toastr.success(DesResultado, 'Éxito');
    } else {
      toastr.error(DesResultado, 'Error');
    }
    // Habilita botón
    BtnGuardar.removeAttr("disabled");
  }, "JSON");
}

function CodigoCompra(CodCompra) {
  CodCompraAnular = CodCompra;
}

function AnularCompra(CodCompra) {
  var MotivoAnulacion = TxtMotivoAnulacion.val();
  if (MotivoAnulacion == '') {
    toastr.warning('Debe ingresar motivo!');
    TxtMotivoAnulacion.focus();
    return;
  }
  // Bloquear el Botón SI
  BtnAnularSI.attr("disabled", true);

  var Procedimiento = 'ProcCompra';
  var Parametros = CodCompraAnular + '|' + CodUsuario + '|' + MotivoAnulacion;
  var Indice = 30;
  var URL = URL_BASE + 'Compra/ProcCompraAnularTran';
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
      $('#DivAnularCompra').modal('hide');
      ListaCompra();
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
function split(val) {
  return val.split(/,\s*/);
}
</script>

