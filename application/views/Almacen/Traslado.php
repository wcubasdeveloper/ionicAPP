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
  .botoncategoria{
    width:100%;
    padding-top: 30px;
    padding-bottom: 30px;
  }

  .botonProducto{
    width:100%;
    padding-top: 30px;
    padding-bottom: 30px;
  }

  .ibox {
      clear: both;
      margin-bottom: 9px;
      margin-top: 0;
      padding: 0;
  }
  .ui-autocomplete{
    border: 1px solid #f3f3f4;
    width:300px;
    padding-left: 9px;
    list-style: none;
    background-color: white;
    height: 300px !important;
    overflow: auto;
  }
  .ui-front {
    z-index: 10000;
    /* height: 100px; */
  }
</style>
<?php
    $CodUsuario = $_SESSION['codusuario'];
?>
<div class="row">
   <div class="row wrapper border-bottom white-bg page-heading">
      <div class="col-lg-12">
        <h2>Traslado &nbsp;&nbsp;&nbsp;<strong id="StnCantidadRegistros">-</strong>
          <input id="TxtFechaInicio" readonly class="FechaUI" style="width:130px;"/>
          <input id="TxtFechaFin" readonly class="FechaUI" style="width:130px;"/>
          <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="button" data-toggle="modal" data-target="#DivAlmacenTraslado"><strong>Nuevo</strong></button>
          <button class="btn btn-sm btn-success pull-right m-t-n-xs" type="button" onclick="ListaAlmacenTraslado()"><strong>Consulta</strong></button>
        </h2>
      </div>
   </div>
   <br>
   <div class="row wrapper border-bottom white-bg page-heading">
      <div class="col-lg-12">
        <br>
        <div class="table-responsive">
          <table class="table table-bordered" id="TbAlmacenTraslado">
            <thead>
              <tr>
                <th>N</th>
                <th>FECHA</th>
                <th>A.ORIGEN</th>
                <th>A.DESTINO</th>
                <th>MOTIVO</th>
                <th>U.CREACIÓN</th>
                <th>ESTADO</th>
                <th style="width:90px;">ACCIONES</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
   </div>
</div>
<!-- Modal Registrar Almacen Movimiento-->
<div class="modal fade" id="DivAlmacenTraslado" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="defaultModalLabel">Registrar Traslado</h4>
      </div>
      <div class="modal-body">
        <div class="body">
          <form class="form-vertical">
            <div class="row clearfix">
              <div class="col-md-3 form-control-label">
                <label for="SelAlmacenOrigen">Origen:</label>
              </div>
              <div class="col-md-7">
                <div class="form-group">
                  <div class="form-line">
                    <select id="SelAlmacenOrigen" class="form-control m-b"></select>
                  </div>
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-md-3 form-control-label">
                <label for="SelAlmacenDestino">Destino:</label>
              </div>
              <div class="col-md-7">
                <div class="form-group">
                  <div class="form-line">
                    <select id="SelAlmacenDestino" class="form-control m-b"></select>
                  </div>
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-md-3 form-control-label">
                <label for="TxtMotivoTraslado">Motivo:</label>
              </div>
              <div class="col-md-7">
                <div class="form-group">
                  <div class="form-line">
                    <textarea id="TxtMotivoTraslado" class="form-control rounded-0" rows="3" placeholder="Ingrese texto..."></textarea>
                  </div>
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-md-3 form-control-label">
                <label for="TxtProducto">Producto:</label>
              </div>
              <div class="col-md-7">
                <div class="input-group">
                  <div class="form-line">
                    <select id="SelProducto" style="display:none"></select>
                    <input id="TxtProducto" type="text" onkeyup="AgregarProductoEnter(event);" class="form-control">
                    <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="button" data-toggle="modal" onclick="AgregarProducto()"><strong>Agregar</strong></button>
                  </div>
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-md-12 table-wrapper-scroll-y">
                <div class="form-group">
                  <table class="table table-bordered" id="TbAlmacenTrasladoDetalle">
                    <thead>
                      <tr>
                        <th class="col-md-1">N</th>
                        <th class="col-md-7">PRODUCTO</th>
                        <th class="col-md-3">CANTIDAD</th>
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
          <button type="button" id="BtnGuardar" class="btn btn-w-m btn-primary" onclick="GuardarAlmacenTraslado();">Guardar</button>
          <button type="button" id="BtnCerrar" class="btn btn-w-m btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal Ver Detalle de Almacen Traslado-->
<div class="modal fade" id="DivVerAlmacenTraslado" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header ui-draggable-handle">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="defaultModalLabel">Detalle de ingreso</h4>
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
                    <label class="DatoLimpiar" id="LblFechaAlmacenTraslado"></label>
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
                <label for="">Almacen:</label>
              </div>
              <div class="col-md-7">
                <div class="form-group">
                  <div class="form-line">
                    <label class="DatoLimpiar" id="LblNomAlmacen"></label>
                  </div>
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-md-3 form-control-label">
                <label for="">Motivo:</label>
              </div>
              <div class="col-md-7">
                <div class="form-group">
                  <div class="form-line">
                    <label class="DatoLimpiar" id="LblNomAlmacenTrasladoMotivo"></label>
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
                  <table class="table table-bordered" id="TbAlmacenTrasladoDetalleVista">
                    <thead>
                      <tr>
                        <th class="col-md-1">N</th>
                        <th class="col-md-8">PRODUCTO</th>
                        <th class="col-md-3">CANTIDAD</th>
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
        <button type="button" class="btn btn-w-m btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal Anular Almacen Traslado-->
<div class="modal fade" id="DivAnularAlmacenTraslado" tabindex="-1" role="dialog">
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
            <button id="BtnAnularSI" type="button" class="btn btn-w-m btn-primary" onclick="AnularAlmacenTraslado();">SI</button>
            <button type="button" class="btn btn-w-m btn-danger" data-dismiss="modal">NO</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
//
var TxtFechaInicio = $('#TxtFechaInicio');
var TxtFechaFin = $('#TxtFechaFin');
var TbAlmacenTrasladoCuerpo = $('#TbAlmacenTraslado tbody');
var TbAlmacenTrasladoDetalleVistaCuerpo = $('#TbAlmacenTrasladoDetalleVista tbody');
var TbAlmacenTrasladoDetalleCuerpo = $('#TbAlmacenTrasladoDetalle tbody');
var SelAlmacenOrigen = $('#SelAlmacenOrigen');
var SelAlmacenDestino = $('#SelAlmacenDestino');
var SelProducto = $("#SelProducto");
var TxtProducto = $("#TxtProducto");
var TxtFechaAlmacenTraslado = $("#TxtFechaAlmacenTraslado");
var TxtMotivoTraslado = $("#TxtMotivoTraslado");
var BtnGuardar = $("#BtnGuardar");
var TxtMotivoAnulacion = $('#TxtMotivoAnulacion');
var BtnAnularSI = $('#BtnAnularSI');
var CodAlmacenTrasladoAnular = 0;

$(document).ajaxStart(function(event, jqXHR, settings) {
	$('#msjload').fadeIn();
});
$(document).ajaxComplete(function(event, jqXHR, settings) {
	$('#msjload').fadeOut();
});
$(document).ready(function(){
  TxtFechaInicio.val(PrimerDiaMes(FechaHoraHoy(1)));
  TxtFechaFin.val(FechaHoraHoy(1));
  TxtFechaAlmacenTraslado.val(FechaHoraHoy(1));
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
  //
  var widthbusqueda = TxtProducto.width();
  var AUTOCOMPLETE_SELECTED = false;
  var JSONProducto;
  TxtProducto.autocomplete({
    source: function (request, response) {
      $(".ui-menu-item").empty();
      var NomProducto = request.term;
      var t = new Date();
      // if (NomProducto.length > 1) { 
      //   var item = [];
      //   $.each(JSONProducto, function () {
      //     var producto = {
      //       value: this.NomProducto + ' (' + this.PrecioVenta +')',
      //       nombreproducto : this.NomProducto,
      //       codproducto : this.CodProducto,
      //       punit:this.PrecioVenta,
      //       id: this.CodProducto,
      //       attrDatosCompletos: this.NomProducto + '__',
      //       categoria : this.NomProductoCategoria,
      //       urlimg : (this.RutaImagen == null || this.RutaImagen == ''  ?  URL_BASE + 'assets/csoftcontent/img/default.svg' : URL_BASE + 'assets/images/' + this.RutaImagen + '?t=' + t.getTime())
      //     }
      //     item.push(producto);
      //   });
      //   // console.log(item);
      //   response(item);
      //   return;
      // }

      var Procedimiento = 'ProcProducto';
      var Parametros = request.term + '|1'; //1 es para el like
      var Indice = 19;
      var URL = URL_BASE + 'Registros/procGeneral';
      var Data = {
        parametros: Parametros,
        indice: Indice,
        nombreProcedimiento: Procedimiento
      };
      //
      // var t = new Date();
      $.post(URL, Data, function (Data) {
        JSONProducto = Data;
        var item = [];
        $.each(Data, function () {
          var producto = {
            value: this.NomProducto + ' (' + this.PrecioVenta +')',
            nombreproducto : this.NomProducto,
            codproducto : this.CodProducto,
            punit:this.PrecioVenta,
            id: this.CodProducto,
            attrDatosCompletos: this.NomProducto + '__',
            categoria : this.NomProductoCategoria,
            urlimg : (this.RutaImagen == null || this.RutaImagen == ''  ?  URL_BASE + 'assets/csoftcontent/img/default.svg' : URL_BASE + 'assets/images/' + this.RutaImagen + '?t=' + t.getTime())
          }
          item.push(producto);
        });
        response(item);
        widthbusqueda = TxtProducto.width();
        //$('.ui-autocomplete').css('z-index', '9999999');
      },'JSON')
    },
    select: function (event, ui) {
      // if (verificarProductosAgregados(ui.item.codproducto)) {
      //   toastr.warning('El producto ya ha sido agregado!');
      // } else {
        AgregarProducto(ui.item.codproducto, ui.item.nombreproducto)
      // }
    },
    create: function () {
      $('.ui-autocomplete').width(widthbusqueda);
      //$('.ui-autocomplete').css('width',widthbusqueda+'px !important');
      $(this).data('ui-autocomplete')._renderItem = function (ul, item) {
        return $('<li class="item-suggestions" style="margin: 4px;"></li>')
          .data("item.autocomplete", item)
          .append('<a class="suggest-item" style="display: flex;">' +
              '<img width="60" height="60" class="media-object" src="' + item.urlimg + '" alt="...">'+
              '<div class="name" style="padding-top: 6px;padding-left: 6px;" >' + item.label +
              '<p style="color: #1ab394;font-weight: 600;">' + item.categoria + '</p>'+
              '</div>' + '</a>'
          ).appendTo(ul);
      }
    }
  });
  //
  ListaAlmacen();
  ListaAlmacenTraslado();
  ListaProducto();
});
var CodUsuario = '<?php echo $CodUsuario;?>';
function ListaAlmacenTraslado() {
  var FechaInicio = FechaMySQL(TxtFechaInicio.val());
  var FechaInicio = FechaMySQL(TxtFechaInicio.val());
  var FechaFin = FechaMySQL(TxtFechaFin.val());
  var Procedimiento = 'ProcAlmacenTraslado';
  var Parametros = FechaInicio + '|' + FechaFin;
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
    TbAlmacenTrasladoCuerpo.empty();
    var FilasHTML = '';
    var CantidadFilas = Data.length;
    //
    $.each(Data, function(i) {
      FilasHTML += '<tr>' +
        '<td>' + (i + 1) + '</td>' +
        '<td>' + this.Fecha  + '</td>' +
        '<td>' + this.NomAlmacenOrigen + '</td>' +
        '<td>' + this.NomAlmacenDestino + '</td>' +
        '<td>' + this.MotivoTraslado + '</td>' +
        '<td>' + this.NomUsuario + '</td>' +
        '<td>' + this.NomEstado + '</td>' +
        '<td>' +
          '<button data-codalmacentraslado="' + this.CodAlmacenTraslado + '"' +
            ' type="button"class="btn btn-warning btn-xs" data-toggle="modal" data-target="#DivVerAlmacenTraslado" onclick="VerAlmacenTraslado($(this))"><i class="fa fa-edit"></i></button>' +
          '&nbsp;&nbsp;'+
          // '<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#DivAnularAlmacenTraslado" onclick="CodigoAlmacenTraslado(' + this.CodAlmacenTraslado + ');"><i class="fa fa-trash"></i></button>' +
        '</td>' +
      '</tr>';
    });
    TbAlmacenTrasladoCuerpo.append(FilasHTML);
    $('#StnCantidadRegistros').text(CantidadFilas);
    // toastr.success('Registros cargados correctamente', 'Nota')
  }, "JSON");
}
function VerAlmacenTraslado(element) {
  var CodAlmacenTraslado = element.attr('data-codAlmacenTraslado');
  var Procedimiento = 'ProcAlmacenTraslado';
  var Parametros = CodAlmacenTraslado;
  var Indice = 12;
  var URL = URL_BASE +'Registros/procGeneral';
  var Data = {
    parametros: Parametros,
    indice: Indice,
    nombreProcedimiento: Procedimiento
  };
  // LimpiarLabels
  $('.DatoLimpiar').html('');
  TbAlmacenTrasladoDetalleVistaCuerpo.empty();
  //
  $.post(URL, Data, function (Data) {
    //
    var FechaAlmacenTraslado = Data[0].FechaAlmacenTraslado,
        Documento = Data[0].Documento,
        NomAlmacen = Data[0].NomAlmacen,
        NomAlmacenTrasladoMotivo = Data[0].NomAlmacenTrasladoMotivo,
        NomUsuario = Data[0].NomUsuario,
        FechaCreacion = Data[0].FechaCreacion,
        NomEstado = Data[0].NomEstado;
    //
    $('#LblFechaAlmacenTraslado').html(FechaAlmacenTraslado);
    $('#LblDocumento').html(Documento);
    $('#LblNomAlmacen').html(NomAlmacen);
    $('#LblNomAlmacenTrasladoMotivo').html(NomAlmacenTrasladoMotivo);
    $('#LblNomUsuario').html(NomUsuario);
    $('#LblFechaCreacion').html(FechaCreacion);
    $('#LblNomEstado').html(NomEstado);
  }, "JSON");
  // Consulta Detalle de almacen
  Procedimiento = 'ProcAlmacenTrasladoDetalle';
  Parametros = CodAlmacenTraslado;
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
      '</tr>';
    });
    TbAlmacenTrasladoDetalleVistaCuerpo.append(FilasHTML);
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
      OptionHTML += '<option value="' + this.CodProducto +'" >' + this.NomProducto + '</option>';
    });
    SelProducto.append(OptionHTML);
    // SelProducto.selectpicker("refresh");
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
    SelAlmacenOrigen.append(OptionHTML);
    SelAlmacenDestino.append(OptionHTML);
    //
    ListaAlmacenTraslado();
  },'JSON');
}
function AgregarProductoEnter(e){
  // if($('#txtbusquedaproducto').val().length == 0){
  //       toastr.warning('Debe buscar un producto!');
  //       $('#txtbusquedaproducto').focus();
  //       return;
  //   }

  var codekey = e.which;
  if (Number(codekey) == 13) {
    var CodigoBarraProducto = TxtProducto.val();

    if (CodigoBarraProducto == '') {
      toastr.warning('Seleccione un producto!');
      TxtProducto.focus();
    }
    
    var Procedimiento = 'ProcProducto';
    var Parametros = CodigoBarraProducto + '|2'; //2 es para el igual 1 es para el like
    var Indice = 19;
    var URL = URL_BASE + 'Registros/procGeneral';
    var Data = {
      parametros: Parametros,
      indice: Indice,
      nombreProcedimiento: Procedimiento
    };
    
    $.post(URL, Data, function(Data) {
      if (Data.length == 0) {
        TxtProducto.val('');
        // toastr.warning('No existe el codigo de barras: ' + CodigoBarraProducto);
        return;
      }
      var CodProducto = Data[0].CodProducto;
      var NomProducto = Data[0].NomProducto;
      if (Data.length == 0) {
        TxtProducto.val('').focus();
      } else {
        TxtProducto.val('').focus();
        $('.ui-autocomplete').css('display', 'none');
        // if (verificarProductosAgregados(CodProducto)) {
        //   toastr.warning('El producto ya ha sido agregado!');
        // } else {
          AgregarProducto(CodProducto, NomProducto);
            // agregarProductoRow(respuesta[0].CodProducto, respuesta[0].PrecioVenta, respuesta[0].NomProducto)
        // }
      }
    },'JSON')

  }
}
function AgregarProducto(CodProducto, NomProducto) {
  // var CodProducto = SelProducto.val();
  // var NomProducto = SelProducto.find(':selected').text();
  var ProductoRepetido = 0;
  // Verifica si el producto ya está en la lista, Aumenta Cantidad 1
  TbAlmacenTrasladoDetalleCuerpo.children('tr').each(function(i) {
    var CodProductoTabla = $(this).data('codproducto');
    if (CodProducto == CodProductoTabla) {
      // Aumenta en 1
      var InputCantidad = this.cells[2].children[0];
      var CantidadActual = parseFloat(InputCantidad.value);
      InputCantidad.value = CantidadActual + 1;
      ProductoRepetido = 1;
      return;
    }
  });
  if (ProductoRepetido == 1) { //
    // toastr.warning('El producto ya se encuentra en la lista!');
    return;
  }
  var Cantidad = '<input type="number" onClick="this.select()" style="width:90px;text-align:center;" min="1" value="1"/>';
  var FilaHTML = '';
  var NroFila = TbAlmacenTrasladoDetalleCuerpo.children('tr').length + 1;
  FilaHTML = '<tr data-codproducto="' + CodProducto + '">' +
    '<td>' + NroFila + '</td>' +
    '<td>' + NomProducto + '</td>' +
    '<td>' + Cantidad + '</td>' +
    '<td><button type="button" class="btn btn-danger btn-xs" onclick="QuitarFila(this.parentNode.parentNode);"><i class="fa fa-trash"></i></button></td>' +
  '</tr>'
  TbAlmacenTrasladoDetalleCuerpo.append(FilaHTML);

}
function QuitarFila(Fila) {
  $(Fila).remove();
  // Reordenar Nro Item
  TbAlmacenTrasladoDetalleCuerpo.children('tr').each(function (i) {
    this.cells[0].innerHTML = (i + 1);
  });
}
function GuardarAlmacenTraslado() {
  //
  var CodAlmacenOrigen  = SelAlmacenOrigen.val();
  var CodAlmacenDestino  = SelAlmacenDestino.val();
  var FechaAlmacenTraslado  = TxtFechaAlmacenTraslado.val();
  var MotivoTraslado = TxtMotivoTraslado.val();
  //
  if (CodAlmacenOrigen == CodAlmacenDestino) {
    toastr.warning('El Almacen destino debe ser diferente al origen');
    CodAlmacenDestino.focus();
    return;
  }
  //
  if(MotivoTraslado == ""){
    toastr.warning('Debe ingresar comentario!');
    TxtMotivoTraslado.focus();
    return;
  }
  //
  if (TbAlmacenTrasladoDetalleCuerpo.children('tr').length == 0) {
    toastr.warning('Debe agregar por lo menos 1 producto!');
    return;
  }
  //Bloquea botón al guardar
  BtnGuardar.attr("disabled", true);
  //
  // Serializar Detalle articulos
  var AlmacenTrasladoDetalleSerializado = '';
  var CodProducto = '', Cantidad;
  TbAlmacenTrasladoDetalleCuerpo.children('tr').each(function (i) {
    CodProducto = $(this).data('codproducto');
    Cantidad = this.cells[2].children[0].value
    AlmacenTrasladoDetalleSerializado += CodProducto + '|' + Cantidad + '~';
  });
  AlmacenTrasladoDetalleSerializado = AlmacenTrasladoDetalleSerializado.substring(0, AlmacenTrasladoDetalleSerializado.length - 1);
  //
  var Procedimiento = 'ProcAlmacenTraslado';
  var Parametros = CodAlmacenOrigen + '|' + CodAlmacenDestino + '|' + MotivoTraslado + '|' + CodUsuario;
  var Indice = 20;
  var URL = URL_BASE + 'Almacen/ProcAlmacenTrasladoTran';
  var Data = {
    Procedimiento: Procedimiento,
    Parametros: Parametros,
    ParametrosDetalle: AlmacenTrasladoDetalleSerializado,
    Indice: Indice,
  };

  $.post(URL, Data, function(Data) {
    //
    var CodResultado = Data.CodResultado,
        DesResultado = Data.DesResultado;
    //
    if (CodResultado == 1) {
      // $('#BtnCerrar').trigger('click');
      $('#DivAlmacenTraslado').modal('hide');
      ListaAlmacenTraslado();
      // Limpia
      TxtMotivoTraslado.val('');
      TbAlmacenTrasladoDetalleCuerpo.empty();
      toastr.success(DesResultado, 'Éxito');
    } else {
      toastr.success(DesResultado, 'Error');
    }
    // Habilita botón
    BtnGuardar.removeAttr("disabled");
  }, "JSON");
}
function CodigoAlmacenTraslado(CodAlmacenTraslado) {
  CodAlmacenTrasladoAnular = CodAlmacenTraslado;
}
function AnularAlmacenTraslado(CodAlmacenTraslado) {
  var MotivoAnulacion = TxtMotivoAnulacion.val();
  if (MotivoAnulacion == '') {
    toastr.warning('Debe ingresar motivo!');
    TxtMotivoAnulacion.focus();
    return;
  }
  // Bloquear el Botón SI
  BtnAnularSI.attr("disabled", true);

  var Procedimiento = 'ProcAlmacenTraslado';
  var Parametros = CodAlmacenTrasladoAnular + '|' + CodUsuario + '|' + MotivoAnulacion;
  var Indice = 30;
  var URL = URL_BASE + 'Almacen/ProcAlmacenTrasladoAnularTran';
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
      $('#DivAnularAlmacenTraslado').modal('hide');
      ListaAlmacenTraslado();
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

