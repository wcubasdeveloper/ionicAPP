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

  .ImgCargando{
    width:100%;
    height:300px;
    border:1px solid gray;
    cursor:pointer;
    }

</style>
<?php
    $CodUsuario = $_SESSION['codusuario'];
    $CodPersona = $_SESSION['CodPersona'];
    $VendedorUsuarioPedido = $_SESSION['VendedorUsuarioPedido'];
?>
<div class="row">
   <div class="row wrapper border-bottom white-bg page-heading">
      <div class="col-lg-12">
        <h2>Mis Pedidos&nbsp;&nbsp;&nbsp;<strong id="StnCantidadRegistros">-</strong>
          <input id="TxtFechaInicio" readonly class="FechaUI" style="width:130px;"/>
          <input id="TxtFechaFin" readonly class="FechaUI" style="width:130px;"/>
          <button class="btn btn-sm btn-success m-t-n-xs" type="button" onclick="ListaPedido();" ><strong>Consultar</strong></button>
          <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="button" data-toggle="modal" data-target="#DivPedido" ><strong>Nuevo</strong></button>
        </h2>
      </div>
   </div>
   <br>
   <div class="row wrapper border-bottom white-bg page-heading">
      <div class="col-lg-12">
        <br>
        <div class="table-responsive">
          <table class="table table-bordered" id="TbPedido">
            <thead>
              <tr>
                <th class="tdN">N</th>
                <th style="width:60px;text-align:center">NRO</th>
                <th class="tdFecha">FECHA</th>
                <th style="width:55px;">HORA</th>
                <th>VENDEDOR</th>
                <th>CLIENTE</th>
                <th style="width:95px;">CONDICIÓN</th>
                <th style="width:60px;text-align:right">CANT.</th>
                <th style="width:80px;text-align:right">SUBTOTAL</th>
                <th style="width:60px;text-align:right">IGV</th>
                <th style="width:80px;text-align:right">TOTAL</th>
                <th style="width:88px;">ESTADO</th>
                <!-- <th style="width:40px;"></th> -->
                <!-- <th style="width:40px;"></th> -->
                <!-- <th style="width:40px;"></th> -->
                <th style="width:64px;"></th>
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
          <?php if ($VendedorUsuarioPedido == 0) {?>
            <div class="row clearfix">
              <div class="col-md-3 form-control-label">
                <label for="SelPersonaVendedor">Vendedor:</label>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <div class="form-line">
                    <select id="SelPersonaVendedor" class="form-control m-b" data-live-search="true"></select>
                  </div>
                </div>
              </div>
            </div>
          <?php }?>
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
<!-- Modal Editar Pedido-->
<div class="modal fade" id="DivEditarPedido" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document" style="min-width:80%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="defaultModalLabel">Editar Pedido</h4>
      </div>
      <div class="modal-body">
        <div class="body">
          <form class="form-vertical">   
          <div class="row clearfix">
              <div class="col-md-3 form-control-label">
                <label for="TxtFechaPedidoEditar">Fecha:</label>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <div class="form-line">
                    <input id="TxtFechaPedidoEditar" readonly type="text" value="" class="form-control" required="" disabled>
                  </div>
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-md-3 form-control-label">
                <label for="SelClienteEditar">Cliente:</label>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <div class="form-line">
                    <select id="SelClienteEditar" class="form-control m-b" data-live-search="true" disabled></select>
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
                    <select id="SelProductoEditar" data-live-search="true"></select>
                    <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="button" data-toggle="modal" onclick="AgregarProductoEdicion()"><strong>Agregar</strong></button>
                  </div>
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-md-12 table-wrapper-scroll-y">
                <div class="form-group">
                  <table class="table table-bordered" id="TbPedidoDetalleEdicion">
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
                        <td id="TdSubTotalEdicion" style="text-align:right;font-size:16px;font-weight:bold;"></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td colspan="3"></td>
                        <td style="text-align:right;font-size:16px;"><b>IGV</b></td>
                        <td id="TdIGVEdicion" style="text-align:right;font-size:16px;font-weight:bold;"></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td colspan="3"></td>
                        <td style="text-align:right;font-size:16px;"><b>TOTAL</b></td>
                        <td id="TdTotalEdicion" style="text-align:right;font-size:16px;font-weight:bold;"></td>
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
        <!-- <button type="button" id="BtnGuardar" class="btn btn-w-m btn-primary" onclick="GuardarPedido();">Guardar</button> -->
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
                <label>NRO.PEDIDO:</label>
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
                <label>FECHA:</label>
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
                <label>CLIENTE:</label>
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
                <label>DOC.VENTA:</label>
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
                <label for="">VENDEDOR:</label>
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
                <label for="">F.REGISTRO:</label>
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
                <label for="">ESTADO:</label>
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
              <div class="col-md-3 form-control-label">
                <label for="">COMENTARIO:</label>
              </div>
              <div class="col-md-7">
                <div class="form-group">
                  <div class="form-line">
                    <label class="DatoLimpiar" id="LblComentario"></label>
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
                    <label>SUBTOTAL</label>
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
                    <label>TOTAL</label>
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

<!-- Modal Eliminar Producto Edicion-->
<div class="modal fade" id="DivEliminarProductoEdicion" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header ui-draggable-handle">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 style="font-weight:100" >Eliminar producto</h4>
      </div>
      <div>
        <div>
          <div class="modal-body">
            <div class="body">
              <form class="form-vertical">
                  <div class="row clearfix">
                      <div class="col-md-12 form-control-label">
                        <h4>Clave</h4>
                        <input id="TxtClaveAnulacionPE" class="form-control" rows="2" type="password" id="clavePE" />
                      </div>
                  </div>
                  <div class="row clearfix">
                      <div class="col-md-12 form-control-label">
                        <h4>Motivo</h4>
                        <textarea id="TxtMotivoAnulacionPE" class="form-control" rows="2" id="commentPE"></textarea>
                      </div>

                  </div>
              </form>
            </div>
          </div>
          <div class="modal-footer">
            <button id="BtnAnularSI" type="button" class="btn btn-w-m btn-primary" onclick="EliminarProductoEdicion();">SI</button>
            <button type="button" class="btn btn-w-m btn-danger" data-dismiss="modal" onclick="LimpiarMdlAnulacionProducto();">NO</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal Agregar Imagen Producto Edicion-->
<div class="modal fade" id="DivAgregarImagen" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header ui-draggable-handle">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 style="font-weight:100" >Agregar Imagen</h4>
      </div>
      <div>
        <div>
          <div class="modal-body">
            <div class="body">
              
                <form id="FrmPedidoSubirImagen" enctype="multipart/form-data" method="post">
                  <p id="filedrag" class="text-center" onclick="document.getElementById('FileImagenPedido').click();">
                    <img id="ImgCargando" class="ImgCargando"/>
                  </p>
                  <input type="file" accept="image/png,image/gif,image/jpeg" id="FileImagenPedido" name="file" style="display:none;"/>
                  <div id="progress"></div>
                  <div style="text-align: center;">
                    <button type="submit" class="btn btn-w-m btn-primary" >Subir Imagen</button>
                  </div>
                </form>
              
            </div>
          </div>
          <!-- <div class="modal-footer">
            
            <button type="button" class="btn btn-w-m btn-danger" data-dismiss="modal" >Cancelar</button>
          </div> -->
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
  var TbPedidoDetalleEdicionCuerpo = $('#TbPedidoDetalleEdicion tbody');
  var TbPedidoDetallePie = $('#TbPedidoDetalle tfoot');
  var TbPedidoDetalleEdicionPie = $('#TbPedidoDetalleEdicion tfoot');
  var SelCliente = $("#SelCliente");
  var SelClienteEditar = $("#SelClienteEditar");
  var SelDocumentoVenta = $("#SelDocumentoVenta");
  var SelProducto = $("#SelProducto");
  var SelProductoEditar = $("#SelProductoEditar");
  var TxtFechaPedido = $("#TxtFechaPedido");
  var TxtFechaPedidoEditar = $("#TxtFechaPedidoEditar");
  var TxtComentario = $("#TxtComentario");
  var BtnGuardar = $("#BtnGuardar");
  var TxtMotivoAnulacion = $('#TxtMotivoAnulacion');
  var TxtClaveAnulacionPE = $('#TxtClaveAnulacionPE');
  var TxtMotivoAnulacionPE = $('#TxtMotivoAnulacionPE');
  var BtnAnularSI = $('#BtnAnularSI');
  var TdSubTotal = $('#TdSubTotal');
  var TdIGV = $('#TdIGV');
  var TdTotal = $('#TdTotal');
  var TdSubTotalEdicion = $('#TdSubTotalEdicion');
  var TdIGVEdicion = $('#TdIGVEdicion');
  var TdTotalEdicion = $('#TdTotalEdicion');
  var SelVentaCondicion = $('#SelVentaCondicion');
  var FrmPedidoSubirImagen = $('#FrmPedidoSubirImagen');
  var DivAgregarImagen = $('#DivAgregarImagen');
  var ImgCargando = $('#ImgCargando');
  var SelPersonaVendedor = $('#SelPersonaVendedor');
  var LblComentario = $('#LblComentario');

  var CodPedidoGeneral = 0;
  var FilaPE = 0;
  /********************* */

  // $(".Decimal").inputmask('Regex', {regex: "^[0-9]{1,6}(\\.\\d{1,2})?$"});

  $(document).ajaxStart(function(event, jqXHR, settings) {
    $('#msjload').fadeIn();
  });
  $(document).ajaxComplete(function(event, jqXHR, settings) {
    $('#msjload').fadeOut();
  });
  //
  var CodUsuario = '<?php echo $CodUsuario;?>';
  var CodPersona = '<?php echo $CodPersona;?>';
  var VendedorUsuarioPedido = '<?php echo $VendedorUsuarioPedido;?>';
  //
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
    ListaPedido();
    ListaProducto();
    ListaCliente();
    //
    if (VendedorUsuarioPedido == 0) {
      ListarVendedor();
    }

    FrmPedidoSubirImagen.submit(function(e){
        e.preventDefault();
        SubirImagen(this);
    });
  });
  //
  function ListaPedido() {
    var FechaInicio = TxtFechaInicio.val();
    var FechaFin = TxtFechaFin.val();
    var Procedimiento = 'ProcPedido';
    var Parametros = CodPersona + '|' + FechaMySQL(FechaInicio) + '|' + FechaMySQL(FechaFin);
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
      TbPedidoCuerpo.empty();
      TbPedidoPie.empty();
      var FilasHTML = '', PieHTML = '';
      var CantidadFilas = Data.length, Total = 0;
      //
      $.each(Data, function(i) {
        FilasHTML += '<tr data-codPedido="' + this.CodPedido +'" >' +
          '<td>' + (i + 1) + '</td>' +
          '<td onclick="VerPedido(' + this.CodPedido + ')" style="text-align:center;" class="Link" data-toggle="modal" data-target="#DivVerPedido">' + this.NroPedidoVendedor + '</td>' +
          '<td>' + this.Fecha + '</td>' +
          '<td>' + this.Hora + '</td>' +
          '<td>' + this.Alias + '</td>' +
          '<td>' + this.Cliente + '</td>' +
          '<td>' + this.NomVentaCondicion + '</td>' +
          '<td style="text-align:right;">' + this.CantidadProductos + '</td>' +
          '<td style="text-align:right;">' + this.SubTotal + '</td>' +
          '<td style="text-align:right;">' + this.IGV + '</td>' +
          '<td style="text-align:right;">' + this.Total + '</td>' +
          '<td>' + this.NomEstado + '</td>' +
          '<td style="vertical-align: middle;" >' +
            // '<button  type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#DivAgregarImagen" onclick="CodigoPedido(' + this.CodPedido + ');"><i class="fa fa-camera"></i></button>' +
            // ' <div onclick="galeriaPedido(event,this)" class="lightBoxGallery" id="imgpedido'+this.CodPedido+'"><a href="'+  URL_BASE + 'assets/imagesPedido/'+(this.URLImagen ? this.URLImagen : 'noimagen.png' )  + '" title="Click para ver imagen"><img width="30" src="'+ URL_BASE + 'assets/imagesPedido/'+ (this.URLImagen ? this.URLImagen : 'noimagen.png' ) +'" alt="Imagen del pedido"></a>' +
            //   '<div id="blueimp-gallery" class="blueimp-gallery" style="display: none;"><div class="slides" style="width: 98352px;"></div><h3 class="title">Image del pedido</h3><a class="prev">‹</a><a class="next">›</a><a class="close">×</a><a class="play-pause"></a><ol class="indicator"></ol></div>' +
            // '</div>' +
            ' <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#DivEditarPedido" onclick="ListarPedidoEditar(' + this.CodPedido +')"><i class="fa fa-plus"></i></button>' +
            ' <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#DivAnularPedido" onclick="CodigoPedido(' + this.CodPedido + ');"><i class="fa fa-trash"></i></button>' +
          '</td>' +       
        '</tr>';
        if (this.CodEstado == 1) {
          Total += parseFloat(this.Total);
        }
      });
      PieHTML = '<tr>' +
          '<td colspan=10></td>' +
          '<td style="text-align:right;font-size:16px;font-weight:bold;">' + Total.toFixed(2) + '</td>'+
          '<td colspan=5></td>' +
        '</tr>'
      TbPedidoCuerpo.append(FilasHTML);
      TbPedidoPie.append(PieHTML);
      $('#StnCantidadRegistros').text(CantidadFilas);
      // toastr.success('Registros cargados correctamente', 'Nota')
    }, "JSON");
  }
  function ListarVendedor() {
    var Procedimiento = 'ProcPersona';
    var Parametros = '1|1'; //'TipoVendedor|CampoAMostrar'
    var Indice = 15;
    var URL = URL_BASE + 'Registros/procGeneral';
    var Data = {
      parametros: Parametros,
      indice: Indice,
      nombreProcedimiento: Procedimiento
    };
    $.post(URL, Data, function (Data) {
      //
      var OptionHTML = '';
      $.each(Data, function(i) {
        OptionHTML += '<option value="' + this.CodPersona +'" >' + this.NomPersona + '</option>';
      });
      SelPersonaVendedor.append(OptionHTML);
      SelPersonaVendedor.selectpicker("refresh");
    },'JSON');
  }
  function galeriaPedido(event,elemento){

    event = event || window.event;
        var target = event.target || event.srcElement,
            link = target.src ? target.parentNode : target,
            options = {index: link, event: event},
            links = elemento.getElementsByTagName('a');
        blueimp.Gallery(links, options);
  }
  function VerPedido(CodPedido) {
    var Procedimiento = 'ProcPedido';
    var Parametros = CodPedido;
    var Indice = 11;
    var URL = URL_BASE +'Registros/procGeneral';
    var Data = {
      parametros: Parametros,
      indice: Indice,
      nombreProcedimiento: Procedimiento
    };
    // LimpiarLabels
    $('.DatoLimpiar').html('');
    TbPedidoDetalleVistaCuerpo.empty();
    //
    var MatrizPedidoDetalle, CantidadMatriz, FilasHTML;
    //
    $.post(URL, Data, function (Data) {
      //
      var Cliente = Data[0].Cliente,
          NroPedidoVendedor = Data[0].NroPedidoVendedor,
          FechaPedido = Data[0].FechaPedido,
          FechaCreacion = Data[0].FechaCreacion,
          NomEstado = Data[0].NomEstado,
          NomDocumento = Data[0].NomDocumento,
          NomVentaCondicion = Data[0].NomVentaCondicion,
          SubTotal = Data[0].SubTotal,
          IGV = Data[0].IGV,
          Total = Data[0].Total,
          CantidadProductos = Data[0].CantidadProductos,
          Vendedor = Data[0].Vendedor,
          Detalle = Data[0].Detalle,
          Comentario = Data[0].Comentario;
      //
      $('#LblNroPedidoVendedor').html(NroPedidoVendedor);
      $('#LblFechaPedido').html(FechaPedido);
      $('#LblCliente').html(Cliente);
      $('#LblVendedor').html(Vendedor);
      $('#LblDocumentoVenta').html(NomDocumento + ' - ' + NomVentaCondicion);
      $('#LblSubTotal').html(SubTotal);
      $('#LblIGV').html(IGV);
      $('#LblTotal').html(Total);
      $('#LblFechaCreacion').html(FechaCreacion);
      $('#LblNomEstado').html(NomEstado);
      LblComentario.html(Comentario);
      //
      MatrizPedidoDetalle = ConvertirAMatriz(Detalle, '|', '~'),
      CantidadMatriz = MatrizPedidoDetalle.length,
      FilasHTML = '';
      //
      for (i = 0; i < CantidadMatriz; i++) {
        FilasHTML += '<tr>'+
          '<td>' + (i + 1) + '</td>'+
          '<td>' + MatrizPedidoDetalle[i][1]  + '</td>'+
          '<td style="text-align:right;">' + MatrizPedidoDetalle[i][2] + '</td>'+
          '<td style="text-align:right;">' + MatrizPedidoDetalle[i][3] + '</td>'+
          '<td style="text-align:right;">' + MatrizPedidoDetalle[i][4] + '</td>'+
        '</tr>';
      }
      TbPedidoDetalleVistaCuerpo.append(FilasHTML);
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
        OptionHTML += '<option data-precioventa="' + this.PrecioVenta + '" value="' + this.CodProducto +'" >' + this.NomProducto + '</option>';
      });
      SelProducto.append(OptionHTML);
      SelProducto.selectpicker("refresh");

      SelProductoEditar.append(OptionHTML);
      SelProductoEditar.selectpicker("refresh");
    },'JSON');
  }
  function ListaCliente() {
    var Procedimiento = 'ProcCliente';
    var Parametros = 0;
    var Indice = 11;
    var URL = URL_BASE + 'Registros/procGeneral';
    var Data = {
      parametros: Parametros,
      indice: Indice,
      nombreProcedimiento: Procedimiento
    };
    $.post(URL, Data, function (Data) {
      var OptionHTML = '<option value="0" >Seleccione cliente</option>';
      //
      $.each(Data, function(i) {
        OptionHTML += '<option value="' + this.CodCliente +'" >' + this.Cliente + '|' + this.DireccionCliente + '</option>';
      });
      SelCliente.append(OptionHTML);
      SelCliente.selectpicker("refresh");
      SelClienteEditar.append(OptionHTML);
      SelClienteEditar.selectpicker("refresh");
    },'JSON');
  }
  function AgregarProducto() {
    var CodProducto = SelProducto.val();
    var NomProducto = SelProducto.find(':selected').text();
    var PrecioVenta = SelProducto.find(':selected').data('precioventa');
    var ProductoRepetido = 0;
    // Verifica si el producto ya está en la lista.
    TbPedidoDetalleCuerpo.children('tr').each(function(i) {
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
    var Cantidad = '<input type="number" style="width:90px;" onClick="this.select()" onkeyup="CalcularSubTotal(this.parentNode.parentNode);" min="1" value="1"/>';
    var SubTotal = PrecioVenta;
    var FilaHTML = '';
    var NroFila = TbPedidoDetalleCuerpo.children('tr').length + 1;
    FilaHTML = '<tr data-codproducto="' + CodProducto + '">' +
      '<td>' + NroFila + '</td>' +
      '<td>' + NomProducto + '</td>' +
      '<td style="text-align:right;">' + Cantidad + '</td>' +
      '<td style="text-align:right;">' + SubTotal + '</td>' +
      '<td style="text-align:right;">' + SubTotal + '</td>' +
      '<td><button type="button" class="btn btn-danger btn-xs" onclick="QuitarFila(this.parentNode.parentNode);"><i class="fa fa-trash"></i></button></td>' +
    '</tr>'
    TbPedidoDetalleCuerpo.append(FilaHTML);
    var Fila = TbPedidoDetalleCuerpo.children('tr')[TbPedidoDetalleCuerpo.children('tr').length - 1];
    $(Fila.cells[2].children[0]).select();
    CalcularTotales();
  }
  function AgregarProductoEdicion() {
    var CodProducto = SelProductoEditar.val();
    var NomProducto = SelProductoEditar.find(':selected').text();
    var PrecioVenta = SelProductoEditar.find(':selected').data('precioventa');
    var ProductoRepetido = 0;
    // Verifica si el producto ya está en la lista.
    TbPedidoDetalleEdicionCuerpo.children('tr').each(function(i) {
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
    var Cantidad = '<input type="number" style="width:90px;" onClick="this.select()" onkeyup="CalcularSubTotalEdicion(this.parentNode.parentNode, event);" min="1" value="1"/>';
    var SubTotal = PrecioVenta;
    var FilaHTML = '';
    var NroFila = TbPedidoDetalleEdicionCuerpo.children('tr').length + 1;
    FilaHTML = '<tr data-codproducto="' + CodProducto + '">' +
      '<td>' + NroFila + '</td>' +
      '<td>' + NomProducto + '</td>' +
      '<td style="text-align:right;">' + Cantidad + '</td>' +
      '<td style="text-align:right;">' + SubTotal + '</td>' +
      '<td style="text-align:right;">' + SubTotal + '</td>' +
      '<td><button type="button" class="btn btn-danger btn-xs" onclick="QuitarFilaEdicion(this.parentNode.parentNode);"><i class="fa fa-trash"></i></button></td>' +
    '</tr>'
    TbPedidoDetalleEdicionCuerpo.append(FilaHTML);
    var Fila = TbPedidoDetalleEdicionCuerpo.children('tr')[TbPedidoDetalleEdicionCuerpo.children('tr').length - 1];
    $(Fila.cells[2].children[0]).select();
    CalcularTotalesEdicion();
  }
  function CalcularSubTotal(Fila) {
    var Cantidad = parseFloat(Fila.cells[2].children[0].value);
    var PrecioUnitario = parseFloat(Fila.cells[3].innerHTML);
    if (isNaN(Cantidad) == 1 ) { return; }
    if (isNaN(PrecioUnitario) == 1 ) { return; }
    //
    var SubTotal = Cantidad * PrecioUnitario;
    // Setea en la fila el PrecioCosto
    Fila.cells[4].innerHTML = SubTotal.toFixed(2);
    CalcularTotales();
  }
  function CalcularTotales() {
    var SubTotal = 0, IGV = 0, Total = 0;
    TbPedidoDetalleCuerpo.children('tr').each(function (i) {
      //
      Total += parseFloat(this.cells[4].innerHTML);
    });
    // IGV Incluido
    SubTotal = Total / 1.18;
    IGV = Total - SubTotal;

    TdSubTotal.html(SubTotal.toFixed(2));
    TdIGV.html(IGV.toFixed(2));
    TdTotal.html(Total.toFixed(2));
  }
  //Funciones para la edición
  function CalcularSubTotalEdicion(Fila, e) {
    var Cantidad = parseFloat(Fila.cells[2].children[0].value);
    var PrecioUnitario = parseFloat(Fila.cells[3].innerHTML);
    if (isNaN(Cantidad) == 1 ) { return; }
    if (isNaN(PrecioUnitario) == 1 ) { return; }
    //
    var SubTotal = Cantidad * PrecioUnitario;
    // Setea en la fila el PrecioCosto
    Fila.cells[4].innerHTML = SubTotal.toFixed(2);
    CalcularTotalesEdicion();

    if(e.which == 13){
      GuardarNuevoProductoEdicion(Fila);
    }
  }
  function CalcularTotalesEdicion() {
    var SubTotal = 0, IGV = 0, Total = 0;
    TbPedidoDetalleEdicionCuerpo.children('tr').each(function (i) {
      //
      Total += parseFloat(this.cells[4].innerHTML);
    });
    // IGV Incluido
    SubTotal = Total / 1.18;
    IGV = Total - SubTotal;

    TdSubTotalEdicion.html(SubTotal.toFixed(2));
    TdIGVEdicion.html(IGV.toFixed(2));
    TdTotalEdicion.html(Total.toFixed(2));
  }
  function QuitarFilaEdicion(Fila) {
    $(Fila).remove();
    // Reordenar Nro Item
    TbPedidoDetalleEdicionCuerpo.children('tr').each(function (i) {
      this.cells[0].innerHTML = (i + 1);
    });
    CalcularTotalesEdicion();
  }
  function ListarPedidoEditar(codPedidoEditar) {
    TxtFechaPedidoEditar.attr('data-codpedido', codPedidoEditar);

    //
    var Procedimiento = 'ProcPedido';
    var Parametros = codPedidoEditar;
    var Indice = 11;
    var URL = URL_BASE + 'Registros/procGeneral';
    var Data = {
      parametros: Parametros,
      indice: Indice,
      nombreProcedimiento: Procedimiento
    };
    $.post(URL, Data, function (Data) {
      TbPedidoDetalleEdicionCuerpo.empty();
      var jsonData = Data[0];
      //Cargar el Cliente
      $('#SelClienteEditar option[value="'+ jsonData.CodCliente +'"]').prop('selected', true);
      SelClienteEditar.selectpicker("refresh"); 
      //Cargar Fecha
      TxtFechaPedidoEditar.val(jsonData.FechaCreacion);
      //armando el detalle 
      
      var objDetalle = [];
      var detalle = jsonData.Detalle;
      var strCuerpo = '';
      detalle = detalle.split('~');
      $.each(detalle, function(i){
        var pedido ={        
          codProducto: (this.split('|')[0].split(',')[1] == null ? this.split('|')[0] : this.split('|')[0].split(',')[1]),
          nomProducto: this.split('|')[1],
          cantidadProducto: this.split('|')[2],
          precioProducto: this.split('|')[3],
          totalPedido: this.split('|')[4],
          codPedidoProducto: this.split('|')[5],
        }
        objDetalle.push(pedido);
      })

      $.each(objDetalle, function(j){
          strCuerpo += '<tr data-codproducto="'+ this.codProducto +'" data-codpedidoproducto="'+ this.codPedidoProducto +'">'+
                          '<td>' + (j + 1) + '</td>' +
                          '<td>' + this.nomProducto + '</td>' +
                          '<td style="text-align: right">' + this.cantidadProducto + '</td>' +
                          '<td style="text-align: right">' + this.precioProducto + '</td>' +
                          '<td style="text-align: right">' + this.totalPedido + '</td>' +
                          '<td>'+
                            '<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#DivEliminarProductoEdicion" onclick="filaProductoEdicion(this.parentNode.parentNode)"><i class="fa fa-trash"></i></button>' +
                          '</td>' +
                      '</tr>';
      })
      
      TbPedidoDetalleEdicionCuerpo.append(strCuerpo);
      CalcularTotalesEdicion();

    },'JSON');
  }
  function GuardarNuevoProductoEdicion(Fila){
    var codPedido = TxtFechaPedidoEditar.attr('data-codpedido');
    var codProducto = $(Fila).attr('data-codproducto');
    var cantidadProd = $(Fila).find('td').eq(2).find('input').val();
    var Procedimiento = 'ProcPedidoDetalle';
    var Parametros = codPedido + '|' + codProducto + '|' + cantidadProd + '|' +  COD_USUARIO + '|1';
    var Indice = 20;
    var URL = URL_BASE + 'Registros/procGeneral';
    var Data = {
      parametros: Parametros,
      indice: Indice,
      nombreProcedimiento: Procedimiento
    };
    $.post(URL, Data, function (Data) {
      var CodResultado = Data[0].CodResultado,
          DesResultado = Data[0].DesResultado;
      //
      if (CodResultado == 1) {
        ListarPedidoEditar(codPedido);
        ListaPedido();
        toastr.success(DesResultado, 'Éxito');
      } else {
        toastr.error(DesResultado, 'Error');
      }
    },'JSON')
  }
  function EliminarProductoEdicion(){
    if(TxtClaveAnulacionPE.val() == ''){
      TxtClaveAnulacionPE.focus().select();
      return;
    }

    if(TxtMotivoAnulacionPE.val() == ''){
      TxtMotivoAnulacionPE.focus().select();
      return;
    }
    
    var codPedido = TxtFechaPedidoEditar.attr('data-codpedido');
    var codPedidoProducto =  $(FilaPE).attr('data-codPedidoProducto');
    var motivo = TxtMotivoAnulacionPE.val();
    var clave = TxtClaveAnulacionPE.val();
    var Procedimiento = 'ProcPedidoDetalle';
    var Parametros = codPedidoProducto + '|' + COD_USUARIO  + '|' + motivo + '|' +  clave;
    var Indice = 30;
    var URL = URL_BASE + 'Registros/procGeneral';
    var Data = {
      parametros: Parametros,
      indice: Indice,
      nombreProcedimiento: Procedimiento
    };

    $.post(URL, Data, function (Data) {
      var CodResultado = Data[0].CodResultado,
          DesResultado = Data[0].DesResultado;
      //
      if (CodResultado == 1) {
        ListarPedidoEditar(codPedido);
        ListarPedido();
        $('#DivEliminarProductoEdicion').modal('hide');
        toastr.success(DesResultado, 'Éxito');
      } else {
        toastr.error(DesResultado, 'Error');
      }
    },'JSON')
  }
  function LimpiarMdlAnulacionProducto(){
    TxtClaveAnulacionPE.val('');
    TxtMotivoAnulacionPE.val('');
  }
  //***********************/
  function QuitarFila(Fila) {
    $(Fila).remove();
    // Reordenar Nro Item
    TbPedidoDetalleCuerpo.children('tr').each(function (i) {
      this.cells[0].innerHTML = (i + 1);
    });
    CalcularTotales();
  }
  function GuardarPedido() {
    //
    var FechaPedido = TxtFechaPedido.val();
    var CodCliente = SelCliente.val();
    var CodDocumentoVenta = SelDocumentoVenta.val();
    var Comentario = TxtComentario.val();
    var CodVentaCondicion = SelVentaCondicion.val();
    //
    if (VendedorUsuarioPedido == 0) {
      CodPersona = SelPersonaVendedor.val();
    }
    // var CodAlmacen = $('#SelAlmacen').val();
    //
    if(Comentario == ""){
      toastr.warning('Debe ingresar comentario!');
      TxtComentario.focus();
      return;
    }
    if (CodCliente == 0) {
      toastr.warning('Seleccione Cliente!');
      return;
    }
    var ValidacionDetalle = 1;
    var InputFocus;
    TbPedidoDetalleCuerpo.children('tr').each(function (i) {
      //
      var Cantidad = this.cells[2].children[0].value;
      // var SubTotal = this.cells[4].children[0].value;
      if (Cantidad == '') { ValidacionDetalle = 0; InputFocus = this.cells[2].children[0]; return; }
      // if (SubTotal == '') { ValidacionDetalle = 0; InputFocus = this.cells[4].children[0]; return; }
    });
    if (ValidacionDetalle == 0) {
      $(InputFocus).focus();
      toastr.warning('El campo no debe estar vacio');
      return;
    }
    //Bloquea botón al guardar
    BtnGuardar.attr("disabled", true);
    //
    // Serializar Detalle articulos
    var PedidoDetalleSerializado = '';
    var CodProducto, Cantidad, SubTotal;
    TbPedidoDetalleCuerpo.children('tr').each(function (i) {
      CodProducto = $(this).data('codproducto');
      Cantidad = this.cells[2].children[0].value
      // SubTotal = this.cells[4].children[0].value
      PedidoDetalleSerializado += CodProducto + '|' + Cantidad + '~';
    });
    PedidoDetalleSerializado = PedidoDetalleSerializado.substring(0, PedidoDetalleSerializado.length - 1);
    //
    var Procedimiento = 'ProcPedido';
    var Parametros = FechaMySQL(FechaPedido) + '|' + CodPersona + '|' + CodCliente + '|' + CodDocumentoVenta + '|' +
      CodUsuario + '|' + Comentario + '|' + CodVentaCondicion;
    var Indice = 20;
    var URL = URL_BASE + 'Pedido/ProcPedidoTran';
    var Data = {
      Procedimiento: Procedimiento,
      Parametros: Parametros,
      ParametrosDetalle: PedidoDetalleSerializado,
      Indice: Indice,
    };

    $.post(URL, Data, function(Data) {
      //
      var CodResultado = Data.CodResultado,
          DesResultado = Data.DesResultado;
      //
      if (CodResultado == 1) {
        // $('#BtnCerrar').trigger('click');
        $('#DivPedido').modal('hide');
        ListaPedido();
        // Limpia
        TxtComentario.val('');
        TbPedidoDetalleCuerpo.empty();
        TdSubTotal.empty();
        TdIGV.empty();
        TdTotal.empty();
        //
        toastr.success(DesResultado, 'Éxito');
      } else {
        toastr.error(DesResultado, 'Error');
      }
      // Habilita botón
      BtnGuardar.removeAttr("disabled");
    }, "JSON");
  }
  function CodigoPedido(CodPedido) {
    CodPedidoGeneral = CodPedido;
  }
  function filaProductoEdicion(Fila){
    FilaPE = Fila;
  }
  function AnularPedido() {
    var MotivoAnulacion = TxtMotivoAnulacion.val();
    if (MotivoAnulacion == '') {
      toastr.warning('Debe ingresar motivo!');
      TxtMotivoAnulacion.focus();
      return;
    }
    // Bloquear el Botón SI
    BtnAnularSI.attr("disabled", true);

    var Procedimiento = 'ProcPedido';
    var Parametros = CodPedidoGeneral + '|' + CodUsuario + '|' + MotivoAnulacion;
    var Indice = 30;
    var URL = URL_BASE + 'Pedido/ProcPedidoAnularTran';
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
        $('#DivAnularPedido').modal('hide');
        ListaPedido();
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
  //Subir Imagen
  function SubirImagen(Form){
    // $('#file').val() > 0
    if ($('#FileImagenPedido').val() == '') {
      toastr.warning('Seleccionar imagen!');
      return;
    }
    var URL = URL_BASE + 'Pedido/SubirImagenPedido';
    var formData = new FormData(Form);
    formData.append('CodPedido', CodPedidoGeneral);
    //
    $.ajax({
      url: URL,
      type: "post",
      data: formData,
      processData: false,
      contentType: false,//'application/json',
      cache: false,
      async: true,
      success: function(data){
        console.log(data);
        // return;
        Data = JSON.parse(data);
        var CodResultado = Data[0].CodResultado,
            DesResultado = Data[0].DesResultado;
        //
        if (CodResultado == 1) {
          ImgCargando.removeAttr('src');
          ListaPedido();
          DivAgregarImagen.modal('hide');
          //
          toastr.success(DesResultado, 'Éxito');
        } else {
          toastr.error(DesResultado, 'Error');
        }
      }
    });
  }
  function ConvertirAMatriz(Datos, SeparadorColumna, SeparadorFila) {
    var Filas = String(Datos).split(SeparadorFila); /*Datos a vector*/
    var CantFilas = Filas.length - 1;
    var Matriz = new Array(CantFilas);
    for (j = 0; j <= CantFilas; j++) {
        Matriz[j] = String(Filas[j]).split(SeparadorColumna); /*Vector dato a vector bidimensional*/
    }
    return Matriz;
  }
</script>

<script src="<?=base_url()?>assets/csoftcontent/js/SubirArchivoPedido.js"></script>