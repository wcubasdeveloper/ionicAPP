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

  .sectionselectproducto button{
    width: 300px !important;
  }
  #TbAlmacenMovimiento{
    font-size:11px;
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
          <h2>(<strong id="StnCantidadRegistros">-</strong>) Almacen - Movimientos <i title="Agregar nuevo movimiento"  onclick="NuevoAlmacenMovimiento()"   style="cursor:pointer;color:#1ab394" class="fa fa-plus"></i> </h2>
      
      </div>
      <div class="col-lg-4">

      </div>
  </div>

  <div class="row wrapper border-bottom white-bg page-heading form-group">

    <div class="form-group col-lg-2" style="padding-top: 17px;">
      <label>Almacén</label> 
      <!-- <input type="email" placeholder="Enter email" class="form-control"> -->
      <select class="form-control" id="SelAlmacenConsulta"></select>
    </div>

    <div class="form-group col-lg-4" style="padding-top: 17px;" >
      <label>Tipo movimiento</label> 
      <select id="SelAlmacenMovimientoConsulta" class="form-control m-b">
        <option value="0">-- TODOS --</option>
        <option value="4">INGRESO POR PRODUCCIÓN</option>
        <option value="1">INVENTARIO INICIAL</option>
        <option value="7">SALIDA POR CONSUMO</option>
        <option value="8">SALIDA POR MANTENIMIENTO</option>
      </select>
    </div>

    <!-- <label class="col-lg-2 col-form-label" style="padding-top: 26px;" >Tipo movimiento</label>
    <div class="col-lg-2" style="padding-top: 17px;" >
      <select class="form-control" id="SelAlmacenConsulta"></select>
    </div> -->
    <div class="form-group col-lg-2" style="padding-top: 17px;">
      <label>Fecha inicio</label> 
      <input id="TxtFechaInicio" placeholder="Fecha inicio" readonly class="FechaUI form-control" style="width:130px;"/>
    </div>

    <div class="form-group col-lg-2" style="padding-top: 17px;" >
      <label>Fecha fin</label> 
      <input id="TxtFechaFin"  readonly placeholder="Fecha fin" class="FechaUI form-control" style="width:130px;"/>
    </div>

    <div class="col-lg-2" style="padding-top: 17px;" > 
      <label> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</label> 
      <button class="form-control btn btn-sm btn-success pull-right m-t-n-xs" style="background-color: #1c84c6;border-color: #1c84c6;color:white" type="button" onclick="ListaAlmacenMovimiento()"><strong>Consulta</strong></button>
    </div>
  </div>


   <br>
   <div class="row wrapper border-bottom white-bg page-heading">
      <div class="col-lg-12">
        <br>
        <div class="table-responsive">
          <table class="table table-bordered" id="TbAlmacenMovimiento">
            <thead>
              <tr>
                <th>N</th>
                <th>FECHA</th>
                <th>PAD</th>
                <th>SOLICITANTE</th>
                
                <th>DOCUMENTO</th>
                <th>ALMACEN</th>
                <th>MOTIVO</th>
                <th>U.CREACIÓN</th>
                <th>F.CREACIÓN</th>
                <th>ESTADO</th>
                <th>TOTAL</th>
                <th style="width:45px;"></th>
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
<div class="modal fade" id="DivAlmacenMovimiento" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="defaultModalLabel">Registrar Movimiento</h4>
      </div>
      <div class="modal-body">
        <div class="body">
          <form class="form-vertical">

            <div class="row clearfix">
              <div class="col-md-3 form-control-label">
                <label for="TxtFechaAlmacenMovimiento">Fecha:</label>
              </div>
              <div class="col-md-7">
                <div class="form-group">
                  <div class="form-line">
                    <input id="TxtFechaAlmacenMovimiento" readonly type="text" value="" class="form-control FechaUI" required="">
                  </div>
                </div>
              </div>
            </div>



            
            <div class="row clearfix">
              <div class="col-md-3 form-control-label">
                <label for="SelAlmacenMovimientoMotivo">Motivo:</label>
              </div>
              <div class="col-md-7">
                <div class="form-group">
                  <div class="form-line">
                    <select id="SelAlmacenMovimientoMotivo" onchange="changeSelectMovimientoMotivo();" class="form-control m-b">
                
                    </select>
                  </div>
                </div>
              </div>
            </div>

            <div class="row clearfix">
              <div class="col-md-3 form-control-label">
                <label for="SelAlmacen">Almacen:</label>
              </div>
              <div class="col-md-7">
                <div class="form-group">
                  <div class="form-line">
                    <select id="SelAlmacen" class="form-control m-b"></select>
                  </div>
                </div>
              </div>
            </div>


            <div class="row clearfix sectionsolicitante" >
              <div class="col-md-3 form-control-label">
                <label for="selectSolicitante">Solicitante:</label>
              </div>
              <div class="col-md-7">
                <div class="form-group">
                  <div class="form-line">
                    <select id="selectSolicitante" class="form-control m-b">
                      <option value="4">INGRESO POR PRODUCCIÓN</option>
                      <option value="1">INVENTARIO INICIAL</option>
                      <option value="7">SALIDA POR CONSUMO</option>

                    </select>
                  </div>
                </div>
              </div>
            </div>

            <div class="row clearfix sectionpadron">
              <div class="col-md-3 form-control-label">
                <label for="selectPadron">Padrón:</label>
              </div>
              <div class="col-md-7">
                <div class="form-group">
                  <div class="form-line">
                    <select id="selectPadron" class="form-control m-b">
                     
                    </select>
                  </div>
                </div>
              </div>
            </div>

            <div class="row clearfix">
              <div class="col-md-3 form-control-label">
                <label for="TxtComentario">Comentario:</label>
              </div>
              <div class="col-md-7">
                <div class="form-group">
                  <div class="form-line">
                    <textarea id="TxtComentario" class="form-control rounded-0" rows="3" placeholder="Ingrese texto..."></textarea>
                  </div>
                </div>
              </div>
            </div>
            <div class="row clearfix" style="padding-bottom: 10px;" >

              <div class="col-md-3 form-control-label">
                <label for="TxtProducto">Producto:</label>
              </div>

              <div class="col-md-7 sectionselectproducto" >
                <div class="input-group" >
                  <div class="form-line">
                    <select id="SelProducto"  class="form-control" data-live-search="true" ></select>
                    <input id="TxtProducto" type="text" onkeyup="AgregarProductoEnter(event);" style="display:none;" class="form-control">
                  </div>
                </div>
              </div>

              <div class="col-md-2" >
                  <div class="input-group"  >
                      <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="button" data-toggle="modal" onclick="AgregarProducto()"><strong>Agregar</strong></button>
                  </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-md-12 table-wrapper-scroll-y">
                <div class="form-group">
                  <table class="table table-bordered" id="TbAlmacenMovimientoDetalle">
                    <thead>
                      <tr>
                        <th class="col-md-1">N</th>
                        <th class="col-md-7">PRODUCTO</th>
                        <th class="col-md-1">UM</th>
                        <th class="col-md-2">CANTIDAD</th>
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
          <button type="button" id="BtnGuardar" class="btn btn-w-m btn-primary" onclick="GuardarAlmacenMovimiento();">Guardar</button>
          <button type="button" id="BtnCerrar" class="btn btn-w-m btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal Ver Detalle de Almacen Movimiento-->
<div class="modal fade" id="DivVerAlmacenMovimiento" tabindex="-1" role="dialog">
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
                    <label class="DatoLimpiar" id="LblFechaAlmacenMovimiento"></label>
                  </div>
                </div>
              </div>
            </div>

            <div class="row clearfix sectionpadron">
              <div class="col-md-3 form-control-label">
                <label>Padrón:</label>
              </div>
              <div class="col-md-7">
                <div class="form-group">
                  <div class="form-line">
                    <label class="DatoLimpiar" id="LblPadron"></label>
                  </div>
                </div>
              </div>
            </div>

            <div class="row clearfix sectionsolicitante">
              <div class="col-md-3 form-control-label">
                <label>Solicitante:</label>
              </div>
              <div class="col-md-7">
                <div class="form-group">
                  <div class="form-line">
                    <label class="DatoLimpiar" id="LblSolicitante"></label>
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
                    <label class="DatoLimpiar" id="LblNomAlmacenMovimientoMotivo"></label>
                   
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
                  <table class="table table-bordered" id="TbAlmacenMovimientoDetalleVista">
                    <thead>
                      <tr>
                        <th class="col-md-1">N</th>
                        <th class="col-md-6">PRODUCTO</th>
                        <th class="col-md-2">U.MED</th>
                        <th class="col-md-3">CANTIDAD</th>
                        <th style="display:none;" ></th>
                        <th class="col-md-3">TOTAL</th>
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
      <div class="modal-footer sectionguardaeditar">
        <button type="button" class="btn btn-w-m btn-primary" disabled onclick="guardarModificacion();">Guardar</button>
        <button type="button" class="btn btn-w-m btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal Anular Almacen Movimiento-->
<div class="modal fade" id="DivAnularAlmacenMovimiento" tabindex="-1" role="dialog">
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
            <button id="BtnAnularSI" type="button" class="btn btn-w-m btn-primary" onclick="AnularAlmacenMovimiento();">SI</button>
            <button type="button" class="btn btn-w-m btn-danger" data-dismiss="modal">NO</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Modal modificar Almacen Movimiento-->
<div class="modal fade" id="DivModificarAlmacenMovimiento" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header ui-draggable-handle">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 style="font-weight:100" >Modificar registro</h4>
      </div>
      <div>
        <div>
          <div class="modal-body">
            <div class="body">
              <form class="form-vertical">
                  <div class="row clearfix">
                    <div class="col-md-12 form-control-label">
                      <h4>Motivo</h4>
                      <textarea id="txtMotivoanulacion" class="form-control" rows="2" id="comment"></textarea>
                    </div>
                  </div>
              </form>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-w-m btn-primary" onclick="modificarAlmacenMovimiento();">SI</button>
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
var TbAlmacenMovimientoCuerpo = $('#TbAlmacenMovimiento tbody');
var TbAlmacenMovimientoDetalleVistaCuerpo = $('#TbAlmacenMovimientoDetalleVista tbody');
var TbAlmacenMovimientoDetalleCuerpo = $('#TbAlmacenMovimientoDetalle tbody');
var SelAlmacen = $('#SelAlmacen');
var SelProducto = $("#SelProducto");
var TxtProducto = $("#TxtProducto");
var TxtFechaAlmacenMovimiento = $("#TxtFechaAlmacenMovimiento");
var TxtComentario = $("#TxtComentario");
var BtnGuardar = $("#BtnGuardar");
var TxtMotivoAnulacion = $('#TxtMotivoAnulacion');
var BtnAnularSI = $('#BtnAnularSI');
var SelAlmacenConsulta = $('#SelAlmacenConsulta');
var CodAlmacenMovimientoAnular = 0;

$(document).ajaxStart(function(event, jqXHR, settings) {
	$('#msjload').fadeIn();
});
$(document).ajaxComplete(function(event, jqXHR, settings) {
	$('#msjload').fadeOut();
});
$(document).ready(function(){
 
  TxtFechaInicio.val(FechaHoraHoy(1));
  TxtFechaFin.val(FechaHoraHoy(1));
  TxtFechaAlmacenMovimiento.val(FechaHoraHoy(1));
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
  ListaProducto();
  getSelectTipoMovimiento();
});

var CodUsuario = '<?php echo $CodUsuario;?>';
function ListaAlmacenMovimiento() {

  if ( $.fn.DataTable.isDataTable('#TbAlmacenMovimiento') ) {
    $('#TbAlmacenMovimiento').DataTable().destroy();
  }

  var CodAlmacen = SelAlmacenConsulta.val();
  var FechaInicio = FechaMySQL(TxtFechaInicio.val());
  var FechaInicio = FechaMySQL(TxtFechaInicio.val());
  var FechaFin = FechaMySQL(TxtFechaFin.val());
  var selectTipoMovimiento = $('#SelAlmacenMovimientoConsulta').val();

  var Procedimiento = 'ProcAlmacenMovimiento';
  var Parametros = FechaInicio + '|' + FechaFin + '|' + CodAlmacen + '|' + selectTipoMovimiento;
  var Indice = 10;
  var URL = URL_BASE +'Registros/procGeneral';
  var Data = {
    parametros: Parametros,
    indice: Indice,
    nombreProcedimiento: Procedimiento
  };
  //
  $.post(URL, Data, function (Data) {
    
    TbAlmacenMovimientoCuerpo.empty();
    var FilasHTML = '';
    var CantidadFilas = Data.length;
    //
    $.each(Data, function(i) {
      FilasHTML += '<tr data-codalmacenmovimiento="' + this.CodAlmacenMovimiento +'" >' +
        '<td>' + (i + 1) + '</td>' +
        '<td>' + this.FechaAlmacenMovimiento  + '</td>' +
        '<td>' + this.PadronUnidad + '</td>' +
        '<td>' + this.NombrePersona + '</td>' +
        '<td>' + this.Documento + '</td>' +
        '<td>' + this.NomAlmacen + '</td>' +
        '<td>' + this.NomAlmacenMovimientoMotivo + '</td>' +
        '<td>' + this.NomUsuario + '</td>' +
        '<td>' + this.FechaCreacion + '</td>' +
        '<td>' + (this.NomEstado == "ANULADO"  ? '<span class="label label-danger">'+ this.NomEstado+'</span>' : '<span class="label label-primary">' + this.NomEstado + '</span>' ) + '</td>' +
        '<td>' + this.Total + '</td>' +
        '<td>' +
          '<button data-editar="'+ this.Editar +'"  data-codalmacenmovimiento="' + this.CodAlmacenMovimiento + '"' +
            ' type="button" '+  (this.NomEstado == 'ANULADO' ? ' disabled="disabled" ' : '  '  ) +' class="btn btn-warning btn-xs" onclick="VerAlmacenMovimiento($(this))"><i class="fa fa-edit"></i></button>' +
          '&nbsp;&nbsp;'+
          // '<button type="button" ' + (this.NomEstado == 'ANULADO' ? ' disabled="disabled" ' : '  '  ) +' class="btn btn-danger btn-xs"  onclick="abrirModalModificacion(' + this.CodAlmacenMovimiento + ', $(this));"><i class="fa fa-trash"></i></button>' +
          '<button type="button" ' + (this.NomEstado == 'ANULADO' ? ' disabled="disabled" ' : '  '  ) +' class="btn btn-danger btn-xs" data-toggle="modal" data-target="#DivAnularAlmacenMovimiento" onclick="CodigoAlmacenMovimiento(' + this.CodAlmacenMovimiento + ');"><i class="fa fa-trash"></i></button>' +
        '</td>' +
      '</tr>';
    });
    TbAlmacenMovimientoCuerpo.append(FilasHTML);
    $('#StnCantidadRegistros').text(CantidadFilas);

    $('#TbAlmacenMovimiento').DataTable( {
        "paging": false,
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );

    // toastr.success('Registros cargados correctamente', 'Nota')
  }, "JSON");
}

function abrirModalModificacion(elemento){
  console.log("DDDD");
}

function getSelectTipoMovimiento(){
  $('#SelAlmacenMovimientoConsulta').empty();
  //
  var Procedimiento = 'ProcAlmacenMovimiento';
  var Parametros = 0;
  var Indice = 11;
  var URL = URL_BASE +'Registros/procGeneral';
  var Data = {
    parametros: '0|0',
    indice: Indice,
    nombreProcedimiento: Procedimiento
  };
  $.post(URL, Data, function (Data) {
    var OptionHTML = '';
    //
    $.each(Data, function(i) {
      OptionHTML += '<option data-editar="'+ this.Editar +'" value="' + this.Codigo +'" >' + this.Nombre + '</option>';
    });
    OptionHTML += '<option value="0" selected="selected" >-- TODOS --</option>';
    $('#SelAlmacenMovimientoConsulta').append(OptionHTML);
    ListaAlmacenMovimiento();
  },'JSON');
}

function VerAlmacenMovimiento(element) {
  var CodAlmacenMovimiento = element.attr('data-codalmacenmovimiento');
  var editarFormulario = Number(element.attr('data-editar'));

  //
  var Procedimiento = 'ProcAlmacenMovimiento';
  var Parametros = CodAlmacenMovimiento;
  var Indice = 12;
  var URL = URL_BASE +'Registros/procGeneral';
  var Data = {
    parametros: Parametros,
    indice: Indice,
    nombreProcedimiento: Procedimiento
  };
  //
  if(editarFormulario == 1){
    $('.sectionguardaeditar').css({'display':'block'});
  }else{
    $('.sectionguardaeditar').css({'display':'none'});
  }

  // LimpiarLabels
  $('.DatoLimpiar').html('');
  TbAlmacenMovimientoDetalleVistaCuerpo.empty();
  //
  $.post(URL, Data, function (Data) {
  
    //
    var FechaAlmacenMovimiento = Data[0].FechaAlmacenMovimiento,
        Documento = Data[0].Documento,
        NomAlmacen = Data[0].NomAlmacen,
        NomAlmacenMovimientoMotivo = Data[0].NomAlmacenMovimientoMotivo,
        NomUsuario = Data[0].NomUsuario,
        FechaCreacion = Data[0].FechaCreacion,
        NomEstado = Data[0].NomEstado,
        NombrePersona = Data[0].NombrePersona,
        PadronUnidad = Data[0].PadronUnidad;
    //

    if(PadronUnidad.length == 0){
      $('.sectionpadron').css({'display':'none'})
    }else{
      $('.sectionpadron').css({'display':'block'})
    }

    if(NombrePersona.length == 0){
      $('.sectionsolicitante').css({'display':'none'})
    }else{
      $('.sectionsolicitante').css({'display':'block'})
    }



    $('#LblFechaAlmacenMovimiento').html(FechaAlmacenMovimiento);
    $('#LblDocumento').html(Documento);
    $('#LblNomAlmacen').html(NomAlmacen);
    $('#LblNomAlmacenMovimientoMotivo').html(NomAlmacenMovimientoMotivo);
    $('#LblNomUsuario').html(NomUsuario);
    $('#LblFechaCreacion').html(FechaCreacion);
    $('#LblNomEstado').html(NomEstado);
    $('#LblNomEstado').html(NomEstado);
    $('#LblNomEstado').html(NomEstado);
    $('#LblPadron').html(PadronUnidad);
    $('#LblSolicitante').html(NombrePersona);
    $('#DivVerAlmacenMovimiento').modal('show');

  }, "JSON");
  // Consulta Detalle de almacen
  Procedimiento = 'ProcAlmacenMovimientoDetalle';
  Parametros = CodAlmacenMovimiento;
  Indice = 10;
  URL = URL_BASE +'Registros/procGeneral';
  Data = {
    parametros: Parametros,
    indice: Indice,
    nombreProcedimiento: Procedimiento
  };
  $.post(URL, Data, function (Data) {
    var FilasHTML = '';
    console.log("detalle", Data);
    //
    $.each(Data, function(i) {
      var cantidad = (this.Cantidad ? Number(this.Cantidad) : 0);
      FilasHTML += '<tr data-codalmacmovdet="'+ this.CodAlmacenMovimientoDetalle +'" >'+
        '<td>' + (i + 1) + '</td>'+
        '<td>' + this.NomProducto  + '</td>'+
        '<td>' + this.NomProductoUM  + '</td>'+
        '<td>' +  (editarFormulario == 1 ? '<input type="text" maxlength="8" readonly class="form-control" '+ ( Number(this.NumeroEntero) == 1 ? ' onkeypress="return Util.SoloNumero(event, this);" ' : ' onkeypress="return Util.SoloDecimal(event, this);" ' ) +'  value="'+ ( Number(this.NumeroEntero) == 1 ? cantidad.toFixed(0)  : cantidad.toFixed(2)) + '" />' : cantidad)  + '</td>'+
        // '<td>' + '<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#DivAnularAlmacenMovimiento" onclick="modificarMovimiento();"><i class="fa fa-times"></i></button>' + '</td>'+
        '<td>' + this.PrecioCostoTotal  + '</td>'+
      '</tr>';
    });
    //
    TbAlmacenMovimientoDetalleVistaCuerpo.append(FilasHTML);
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
      OptionHTML += '<option data-um="'+ this.NomProductoUM+'"  data-numeroentero="'+ this.NumeroEntero+'" value="' + this.CodProducto +'" >' + this.NomProducto + '</option>';
    });
    //
    SelProducto.append(OptionHTML);
    SelProducto.selectpicker("refresh");
  },'JSON');
}

function ListaPadron() {
  $('#selectPadron').empty();
  var Procedimiento = 'ProcUnidad';
  var Parametros = 0;
  var Indice = 10;
  var URL = URL_BASE +'Registros/procGeneral';
  var Data = {
    parametros: '',
    indice: Indice,
    nombreProcedimiento: Procedimiento
  };
  $.post(URL, Data, function (Data) {

    var OptionHTML = '';
    //
    $.each(Data, function(i) {
      OptionHTML += '<option value="' + this.CodUnidad +'" >' + this.PadronUnidad + '</option>';
    });
    $('#selectPadron').append(OptionHTML);
    // SelProducto.selectpicker("refresh");
    ListarSolicitante();
  },'JSON');
}

function verificarChangeMotivo(tipoMovimiento, mostrarpadron){
  
  switch(Number(tipoMovimiento)) {
  case 1: //INGRESO
    $('.sectionsolicitante').css('display','none');
    break;
  case 2: //SALIDA
    $('.sectionsolicitante').css('display','block');
    break;
  default:
    break;
  }  

  switch(Number(mostrarpadron)) {
  case 0: //OCULTA
    $('.sectionpadron').css('display','none');
    break;
  case 1: //MUESTRA
    $('.sectionpadron').css('display','block');
    break;
  default:
    break;
  }  
  let CodAlmacenMovimientoMotivo = $('#SelAlmacenMovimientoMotivo').val();
  switch(Number(CodAlmacenMovimientoMotivo)) {
    case 6: // SALIDA POR DEVOLUCION
      $('.sectionpadron').css('display','none');
    
      break;
    case 7: // SALIDA POR CONSUMO BUS
    
      break;
    case 8: // SALIDA POR CONSUMO TALLER
    
      break;
  default:
    break;
  }
  
}


function changeSelectMovimientoMotivo(){
  //
  var tipoMovimientoMotivo = $('#SelAlmacenMovimientoMotivo').find(':selected').attr('data-tipomovimiento');
  var mostrarpadron =  $('#SelAlmacenMovimientoMotivo').find(':selected').attr('data-mostrarpadron');
  //
  
  verificarChangeMotivo(tipoMovimientoMotivo, mostrarpadron);
}

function ListarSolicitante() {
  //$('#SelAlmacenMovimientoMotivo').empty();
  $('#selectSolicitante').empty();
  //
  //$("#SelAlmacenMovimientoConsulta option").clone().appendTo("#SelAlmacenMovimientoMotivo");
  //
  var Procedimiento = 'ProcPersona';
  var Parametros = '6|2';
  var Indice = 15;
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
      OptionHTML += '<option value="' + this.CodPersona +'" >' + this.NomPersona + '</option>';
    });
    $('#selectSolicitante').append(OptionHTML);
    getTipoMovientoActivo();
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
    var OptionHTML = '', OptionHTML2 = '<option value="0">TODOS</option>';
    //
    $.each(Data, function(i) {
      OptionHTML += '<option value="' + this.CodAlmacen +'" >' + this.NomAlmacen + '</option>';
    });
    OptionHTML2 += OptionHTML;
    SelAlmacen.append(OptionHTML);
    SelAlmacenConsulta.append(OptionHTML2);
    //

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
      return;
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

function AgregarProducto() {
 
var CodProducto = SelProducto.val();
var NomProducto = SelProducto.find(':selected').text();
var esnumeroEntero = SelProducto.find(':selected').attr('data-numeroentero');
var unidadMedidaProducto =   SelProducto.find(':selected').attr('data-um');
//

//
var ProductoRepetido = 0;
 // Verifica si el producto ya está en la lista, Aumenta Cantidad 1
 TbAlmacenMovimientoDetalleCuerpo.children('tr').each(function(i) {
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
   //toastr.warning('El producto ya se encuentra en la lista!');
   return;
 }
 //
 esnumeroEntero = 0;//DECIMAL COMENTAR
 var Cantidad = '<input type="text" onClick="this.select()" '+ ( Number(esnumeroEntero) == 1 ? ' onkeypress="return Util.SoloNumero(event, this);" ' : ' onkeypress="return Util.SoloDecimal(event, this);" ' ) +' onkeyup="verficaIngreso($(this));" style="width:90px;text-align:center;" maxlength="7" value="1" />';

 var FilaHTML = '';
 var NroFila = TbAlmacenMovimientoDetalleCuerpo.children('tr').length + 1;
 FilaHTML = '<tr data-codproducto="' + CodProducto + '">' +
   '<td>' + NroFila + '</td>' +
   '<td>' + NomProducto + '</td>' +
   '<td>' + unidadMedidaProducto + '</td>' +
   '<td>' + Cantidad + '</td>' +
   '<td><button type="button" class="btn btn-danger btn-xs" onclick="QuitarFila(this.parentNode.parentNode);"><i class="fa fa-trash"></i></button></td>' +
 '</tr>'
 TbAlmacenMovimientoDetalleCuerpo.append(FilaHTML);
}

function AgregarProducto___(CodProducto, NomProducto) {
 
  // var CodProducto = SelProducto.val();
  // var NomProducto = SelProducto.find(':selected').text();
  var ProductoRepetido = 0;
  // Verifica si el producto ya está en la lista, Aumenta Cantidad 1
  TbAlmacenMovimientoDetalleCuerpo.children('tr').each(function(i) {
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
  var Cantidad = '<input type="number" onClick="this.select()" onkeyup="verficaIngreso($(this));" style="width:90px;text-align:center;" min="1" value="1"/>';
  var FilaHTML = '';
  var NroFila = TbAlmacenMovimientoDetalleCuerpo.children('tr').length + 1;
  FilaHTML = '<tr data-codproducto="' + CodProducto + '">' +
    '<td>' + NroFila + '</td>' +
    '<td>' + NomProducto + '</td>' +
    '<td>' + Cantidad + '</td>' +
    '<td><button type="button" class="btn btn-danger btn-xs" onclick="QuitarFila(this.parentNode.parentNode);"><i class="fa fa-trash"></i></button></td>' +
  '</tr>'
  TbAlmacenMovimientoDetalleCuerpo.append(FilaHTML);

}

function verficaIngreso(elemento){
  
  if(elemento.val() == '0' || elemento.val().length == 0 ){
    elemento.val(1).select().focus();
  }
}

function QuitarFila(Fila) {
  $(Fila).remove();
  // Reordenar Nro Item
  TbAlmacenMovimientoDetalleCuerpo.children('tr').each(function (i) {
    this.cells[0].innerHTML = (i + 1);
  });
}

function getTipoMovientoActivo(){
  $('#SelAlmacenMovimientoMotivo').empty();
  //
  var Procedimiento = 'ProcAlmacenMovimiento';
  var Parametros = 0;
  var Indice = 11;
  var URL = URL_BASE +'Registros/procGeneral';
  var Data = {
    parametros: '0|1',
    indice: Indice,
    nombreProcedimiento: Procedimiento
  };
  $.post(URL, Data, function (Data) {
    var OptionHTML = '';
    //
    $.each(Data, function(i) {
      OptionHTML += '<option data-mostrarpadron="'+ this.MostrarUnidad +'" data-tipomovimiento="'+ this.CodTipoMovimiento +'" data-editar="'+ this.Editar +'" value="' + this.Codigo +'" >' + this.Nombre + '</option>';
    });
    $('#SelAlmacenMovimientoMotivo').append(OptionHTML);
    var tipoMovimientoMotivo = $('#SelAlmacenMovimientoMotivo').find(':selected').attr('data-tipomovimiento');
    var mostrarpadron =  $('#SelAlmacenMovimientoMotivo').find(':selected').attr('data-mostrarpadron');
    
    verificarChangeMotivo(tipoMovimientoMotivo, mostrarpadron);
    $('#TxtProducto').val('');
    $('#DivAlmacenMovimiento').modal('show');
  },'JSON');

}

function NuevoAlmacenMovimiento() {
  ListaPadron();
}

function GuardarAlmacenMovimiento() {
  //
  var FechaAlmacenMovimiento  = TxtFechaAlmacenMovimiento.val();
  var Comentario = TxtComentario.val();
  
  var PadronUnidad = (!$('.sectionpadron').is(":visible") ? 0 : $('#selectPadron').val());
  var Solicitante = (!$('.sectionsolicitante').is(":visible") ? 0 : $('#selectSolicitante').val());

  //
  if(FechaAlmacenMovimiento == ""){
    toastr.warning('Debe ingresar Fecha, hasta el colocar plugin!');
    TxtFechaAlmacenMovimiento.focus();
    return;
  }
  //
  if(Comentario == ""){
    toastr.warning('Debe ingresar comentario!');
    TxtComentario.focus();
    return;
  }
  //
  if (TbAlmacenMovimientoDetalleCuerpo.children('tr').length == 0) {
    toastr.warning('Debe agregar por lo menos 1 producto!');
    return;
  }
  //Bloquea botón al guardar
  BtnGuardar.attr("disabled", true);
  //
  var CodAlmacen  = $('#SelAlmacen').val();
  var CodAlmacenMovimientoMotivo  = $('#SelAlmacenMovimientoMotivo').val();
  // Serializar Detalle articulos
  var AlmacenMovimientoDetalleSerializado = '';
  var CodProducto = '', Cantidad;
  TbAlmacenMovimientoDetalleCuerpo.children('tr').each(function (i) {
    CodProducto = $(this).data('codproducto');
    Cantidad = this.cells[3].children[0].value
    //
    AlmacenMovimientoDetalleSerializado += CodProducto + '|' + Cantidad + '~';
  });
  //
  AlmacenMovimientoDetalleSerializado = AlmacenMovimientoDetalleSerializado.substring(0, AlmacenMovimientoDetalleSerializado.length - 1);
  //
  var Procedimiento = 'ProcAlmacenMovimiento';
  var Parametros = FechaMySQL(FechaAlmacenMovimiento) + '|' + CodAlmacen + '|' + CodAlmacenMovimientoMotivo + '|' +
      CodUsuario + '|' + Comentario + '|0|0|' + PadronUnidad + "|" +  Solicitante;
  
  var Indice = 20;
  var URL = URL_BASE + 'Almacen/ProcAlmacenMovimientoTran';
  var Data = {
    Procedimiento: Procedimiento,
    Parametros: Parametros,
    ParametrosDetalle: AlmacenMovimientoDetalleSerializado,
    Indice: Indice,
  };

  
  $.post(URL, Data, function(Data) {
    //
    var CodResultado = Data.CodResultado,
        DesResultado = Data.DesResultado;
    //
    if (CodResultado == 1) {
      // $('#BtnCerrar').trigger('click');
      $('#DivAlmacenMovimiento').modal('hide');
      ListaAlmacenMovimiento();
      // Limpia
      TxtComentario.val('');
      TbAlmacenMovimientoDetalleCuerpo.empty();
      toastr.success(DesResultado, 'Éxito');
    } else {
      toastr.success(DesResultado, 'Error');
    }
    // Habilita botón
    BtnGuardar.removeAttr("disabled");
  }, "JSON");

}

function CodigoAlmacenMovimiento(CodAlmacenMovimiento) {
  CodAlmacenMovimientoAnular = CodAlmacenMovimiento;
}

function AnularAlmacenMovimiento(CodAlmacenMovimiento) {
  var MotivoAnulacion = TxtMotivoAnulacion.val();
  //
  if (MotivoAnulacion == '') {
    toastr.warning('Debe ingresar motivo!');
    TxtMotivoAnulacion.focus();
    return;
  }
  // Bloquear el Botón SI
  BtnAnularSI.attr("disabled", true);
  var tipoAccion = 10;
  var Procedimiento = 'ProcAlmacenMovimiento';
  var Parametros = CodAlmacenMovimientoAnular + '|' + CodUsuario + '|' + MotivoAnulacion + '|'  + tipoAccion;
  //var Indice = 30;
  var Indice = 31;
  //var URL = URL_BASE + 'Almacen/ProcAlmacenMovimientoAnularTran';
  var URL = URL_BASE + 'Registros/procGeneral';
  var Data = {
    parametros: Parametros,
    indice: Indice,
    nombreProcedimiento: Procedimiento
  };
  //
  $.post(URL, Data, function(Data) {
    //
    var CodResultado = Data[0].CodResultado,
        DesResultado = Data[0].DesResultado;
    //
    if (CodResultado == 1) {
      // $('#BtnCerrar').trigger('click');
      $('#DivAnularAlmacenMovimiento').modal('hide');
      ListaAlmacenMovimiento();
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

function guardarModificacion(){
  var serializado = "";
  $.each($('#TbAlmacenMovimientoDetalleVista tbody > tr'),function(){
    
    var codalmacmovdet = $(this).attr('data-codalmacmovdet');
    var cantidad = $(this).find('td').eq(3).find('input').val();
    
    serializado += codalmacmovdet + '|' + cantidad + '~';
  });
  serializado = serializado.substring(0, serializado.length - 1);
  
  //
  Procedimiento = 'ProcAlmacenMovimientoDetalle';
  Parametros = serializado;
  Indice = 30;
  URL = URL_BASE +'Registros/procGuardaMovimientoDetalle';
  Data = {
    parametros: Parametros,
    indice: Indice,
    nombreProcedimiento: Procedimiento
  };
  $.post(URL, Data, function (Data) {
    var CodResultado = Number(Data.CodResultado),
        DesResultado = Data.DesResultado;
    //
    if (CodResultado == 1) {
      $('#DivVerAlmacenMovimiento').modal('hide');
      // Limpia
      toastr.success(DesResultado, 'Éxito');
    } else {
      toastr.error(DesResultado, 'Error');
    }
  }, "JSON");
}
</script>