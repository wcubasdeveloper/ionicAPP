<style>
  #contenidoprincipal
  {
    padding-top: 5px;
  }
</style>


  <link href="<?=base_url()?>assets/csoftcontent/css/plugins/selectize/selectize.bootstrap3.css"rel="stylesheet">
  <link href="<?=base_url()?>assets/csoftcontent/css/plugins/selectize/selectize.default.css"rel="stylesheet">
  <link href="<?=base_url()?>assets/csoftcontent/css/plugins/ladda/ladda.min.css"rel="stylesheet">
  <link href="<?=base_url()?>assets/csoftcontent/css/plugins/ladda/ladda-themeless.min.css"rel="stylesheet">
  <script src="<?=base_url()?>assets/csoftcontent/js/plugins/selectize/selectize.js"></script>
  <script src="<?=base_url()?>assets/csoftcontent/js/plugins/print/Print.js"></script>
  <script src="<?=base_url()?>assets/csoftcontent/js/plugins/ladda/spin.min.js"></script>
  <script src="<?=base_url()?>assets/csoftcontent/js/plugins/ladda/ladda.min.js"></script>
  <script src="<?=base_url()?>assets/csoftcontent/js/plugins/ladda/ladda.jquery.min.js"></script>


<style media="screen">
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
    height: 400px !important;
    overflow: auto;
  }

  .selectize-control{
    width: 98% !important;
    padding-left: 13px !important;
  }
</style>

<audio id="audioventa">
  <source src="<?=base_url()?>assets/csoftcontent/audio/success.mp3" type="audio/mpeg">
  Your browser does not support the audio element.
</audio>

<div id="contenidoprincipalventa" class="row">
  <div class="col-lg-8">
        <div class="ibox">
          <div class="ibox-title" hidden="hidden">
            <!--<select id="selectTipoDocumento" class="form-control m-b" name="account">
              <option style="text-align:center;" value="2">BOLETA</option>
              <option value="3">FACTURA</option>
            </select>-->
          </div>
          <div class="ibox-content">
              <div class="input-group" style="display:none;">
                <input  type="text" class="form-control" name="producto" placeholder="Buscar Producto">
                <span class="input-group-addon"><i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;&nbsp;Venta</span>
              </div>
              <div class="input-group">
                <input id="txtbusquedaproducto" onclick="$(this).select();"  type="text" onkeyup="agregarProductoEnter(event)" class="form-control">
                <div class="input-group-btn">
                    <button tabindex="-1" class="btn btn-white" type="button">
                    <i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;<span id="textooperacion">Venta</span></button>
                    <button data-toggle="dropdown" class="btn btn-white dropdown-toggle" type="button" aria-expanded="false"><span class="caret"></span></button>
                    <button onclick="listarPedido();" title="Mostrar Pedidos pendientes" type="button" class="btn btn-primary">P</button>
                    <ul class="dropdown-menu pull-right">
                        <li><a href="#" onclick="cambiartipooperacion('devolucion');">Devolución</a></li>
                        <li><a href="#"  onclick="cambiartipooperacion('venta');" >Venta</a></li>
                        <li style="display:none;" ><a href="#">Something else here</a></li>
                        <li class="divider" style="display:none;"></li>
                    </ul>
                </div>
              </div>

          </div>
        </div>

    <div class="ibox">
      <div class="ibox-content"  style="padding: 0;">
      </div>
    </div>
    <div class="ibox">
      <div class="ibox-content" style="color: #4c5661;font-size: 16px">
        <table class="table table-striped" id="tbproductodetalle">
          <thead>
            <tr>
              <th style="width:20px;"></th>
              <th>PRODUCTO</th>
              <th style="width:80px;">CANT</th>
              <th style="width:80px;">P.VENTA</th>
              <th style="width:80px;">IMPORTE</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="col-lg-4">
    <div class="ibox">
      <div class="ibox-title" style="display: flex;" >
        <i title="Tipo de documento" class="fa fa-file-text-o" style="font-size: 21px; padding-top: 7px;color: #8383e0;cursor:pointer" ></i>
        <select  id="selectTipoDocumento" class="form-control m-b" name="account" style="margin-left: 13px;" >
        </select>
      </div>
      <div class="ibox-content" style="display: -webkit-box;" >
        <i title="Padrón" class="fa fa-user-o" style="font-size: 21px; padding-top: 7px;color: #8383e0;cursor:pointer;margin-left: -2px;"></i>
        <select name="fruits" id="selectCliente" placeholder="Buscar cliente" >
          <?php foreach($clientes as $cliente):?>
            <option data-value="s" value="<?php echo $cliente['CodCliente'];?>"><?php echo $cliente['NomCliente']." ".$cliente['PaternoCliente']." ".$cliente['MaternoCliente'];?></option>
          <?php endforeach;?>
        </select>
      </div>

      <div class="ibox-title" style="display: none;" >
        <i class="fa fa-id-card-o" title="Vendedor" aria-hidden="true" style="font-size: 21px; padding-top: 7px;color: #8383e0;cursor:pointer"  ></i>
        <select  id="selectVendedor" class="form-control m-b" name="account" title="Lista de vendedores" style="margin-left: 13px;" >
          <?php foreach($vendedores as $vendedor):?>
            <option value="<?php echo $vendedor['CodPersona'];?>"><?php echo $vendedor['Alias'];?></option>
          <?php endforeach;?>
        </select>
      </div>

      <div class="ibox-title" style="display: flex;" >
        <i class="fa fa-id-card-o" title="Seleccionar mecánico" aria-hidden="true" style="font-size: 21px; padding-top: 7px;color: #8383e0;cursor:pointer"  ></i>
        <select  id="selectMecanico" class="form-control m-b" name="account" title="Lista de Mecanicos" style="margin-left: 13px;" >
          <option>SELECCIONAR MECÁNICO</option>
        </select>
      </div>

      <div class="ibox-title"  style="display: flex;" >
        <i title="Forma de pago" class="fa fa-money" style="font-size: 21px; padding-top: 7px;color: #8383e0;cursor:pointer"  ></i>
        <select class="form-control m-b" id="selectformapago" style="margin-left: 13px;" >
          <?php foreach($fpagos as $fpago):?>
            <option value="<?php echo $fpago['CodFormaPago'];?>"><?php echo $fpago['NomFormaPago'];?></option>
          <?php endforeach;?>
        </select>
      </div>

      <div class="ibox-title"  style="display: flex;" >
        <i title="Seleccionar propietario" class="fa fa-user-o" style="font-size: 21px; padding-top: 7px;color: #8383e0;cursor:pointer"  ></i>
        <select class="form-control m-b"  style="margin-left: 13px;" >
          <option>SELECIONAR PROPIETARIO</option>
        </select>
      </div>

    </div>

    <div class="ibox">

      <div class="ibox-content" id="panelProductoVenta" style="padding: 0;">
<!--
        <div class="vote-item" style="padding-top: 4px;padding-bottom: 4px;">
          <div class="row">
              <div class="col-md-10">
                <div class="vote-actions" style="padding-top: 10px;">
                  <i class="fa fa-trash-o" style="color:red;font-size: 20px;"></i>

<div class="" style="color:red;background-color: #1c84c6;width: 14px;height: 14px;font-size: 10px;font-weight: bold;border-radius: 50%;position:  absolute;color: white;left:  0;top: 1px;">9</div>

                </div>


                <a href="#" class="vote-title" style="    font-size: 14px;">
                  Producto 1
                </a>
                <div class="vote-info">
                  <a href="#">Categoria</a>
                </div>
              </div>

                <div class="col-md-2">
                  <div class="vote-icon" style="font-size: 20px;color: #4c5661;">
                    <span>20.30</span>
                    </div>
                </div>
          </div>
        </div> !-->

      </div>
    </div>


  <div class="ibox" style="font-weight: bold;">
    <div class="ibox-content" style="color: #4c5661;font-size: 16px" >
      <div class="row">
        <div class="col-md-8">
          Subtotal
        </div>
        <div class="col-md-4" style="text-align:right;" id="txtsubtotalventa" >

        </div>
      </div>


      <div class="row">
        <div class="col-md-8">
          IGV (18%)
        </div>
        <div class="col-md-4" style="text-align:right;" id="totaligvventa" >

        </div>
      </div>

      <div class="row">
        <div class="col-md-8">
          Total
        </div>
        <div class="col-md-4" style="text-align:right;" id="totalventa" >

        </div>
      </div>

    </div>
  </div>

  <div class="ibox">
    <div class="ibox-content" style="color: #4c5661;font-size: 16px;text-align: right;" >
<button id="btnguardaventa" class="ladda-button btn btn-primary" onclick="guardarVenta()"  data-style="zoom-in">PAGAR</button>
    </div>
  </div>

  </div>

</div>


<div class="modal fade" id="DivFormulaModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document" style="width:250px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" >Cálculo</h4>
      </div>
      <div class="modal-body">
        <div class="body">
          <form class="form-vertical">
            <div class="row clearfix">
              <div class="col-md-3 form-control-label">
                <label for="txtBaseForm">Base:</label>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <div class="form-line">
                    <input id="txtBaseForm" type="text" value="" onkeypress="return Util.SoloDecimal(event, this);" class="form-control" required="">
                  </div>
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-md-3 form-control-label">
                <label for="txtalturaform">Altura:</label>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <div class="form-line">
                    <input id="txtalturaform" type="text" value="" maxlength="10" onkeypress="return Util.SoloDecimal(event, this);" class="form-control" required="">
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="BtnSetearFormula" class="btn btn-primary" onclick="confirmarFormula();"><i class="fa fa-check"></i></button>
        <button type="button" id="BtnCerrarFormula" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i></button>
      </div>
      </div>
  </div>
</div>



<div class="modal fade" id="divPedidos" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document" style="width:850px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Lista de pedidos</h4>
      </div>
      <div class="modal-body">
        <div class="body">
          <form class="form-vertical">
            <div class="row clearfix" style="height: 300px;overflow: auto;" >
              <table id="tbPedidos" class="table table-striped table-hover" >
                <thead>
                  <tr>
                    <th width="20">NRO.PED</th>
                    <th>VENDEDOR</th>
                    <th>FECHA</th>
                    <th>CLIENTE</th>
                    <th class="text-right" >CANT. PROD</th>
                    <th>COMENTARIO</th>
                    <th class="text-right">TOTAL</th>
                  </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                  <tr>
                    <th class="text-left" colspan="6">TOTAL</th>
                    <th class="text-right" id="txtTotalImportePedido" ></th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="BtnCerrar" class="btn btn-w-m btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
      </div>
  </div>
</div>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script type="text/javascript">
  var selectTipoDocumento = $('#selectTipoDocumento');
  var selectizeCliente = null;

  $('#contenidoprincipalventa').parent().removeClass('container');
  $('#contenidoprincipalventa').parent().parent().removeClass('wrapper wrapper-content');

  var SelVendedor = $('#selectVendedor');
  
  // SelVendedor.select2();

// selectizeCliente = $('#selectCliente').selectize({
//     create: true,
//     persist: false,
//     //labelField: "item",
//     //valueField: "item",
//     sortField: 'item',
//     searchField: 'item',
//     create:function (input) {
//         window.open(URL_BASE + 'Registros/cliente', '_blank');
//         return { value:123, text:input};
//       },
//       render: {
//     option_create: function(data, escape) {
//       return '<div class="create">Agregar nuevo padrón <strong>' + escape(data.input) + '</strong>&hellip;</div>';
//     }
//   },
// });

var EDITAR_PRECIO_VENTA = true;
var ES_PEDIDO = {
  AUX : false,
  COD_PEDIDO : 0
};
$(document).ready(function(){
  //getCategorias();
  activarBusqueda();
  ListarDocumentos();
});
function ListarDocumentos() {
  var URL = URL_BASE +'Registros/procGeneral';
  var Procedimiento = 'ProcDocumento';
  var Parametros = '';
  var Indice = 10;
  var Data = {
    parametros: Parametros,
    indice: Indice,
    nombreProcedimiento: Procedimiento
  };
  selectTipoDocumento.empty();
  $.post(URL, Data, function (Data) {
    var OptionHTML = '';
    //
    $.each(Data, function(i) {
      OptionHTML += '<option value="' + this.CodDocumento +'" >' + this.NomDocumento + '</option>';
    });
    selectTipoDocumento.append(OptionHTML);
  },'JSON');
}


var widthbusqueda = $('#txtbusquedaproducto').width();
var AUTOCOMPLETE_SELECTED = false;
function activarBusqueda(){
  $("#txtbusquedaproducto").autocomplete({
            source: function (request, response) {
                $(".ui-menu-item").empty();
                var parametros = request.term + '|' + 1;
                var indice = 19;
                var nomproc = "ProcProducto";
                $.post(URL_BASE+'Registros/procGeneral',
                {parametros: parametros,
                indice: indice,
                nombreProcedimiento:nomproc}
                , function (respuesta) {
                    var jsonData = respuesta;
                    var strCuerpo = '';
                    var item = [];
//                    console.log(respuesta);
                  

                    $.each(jsonData, function (i) {

               
                        var producto = {
                            value: this.NomProducto + ' (' + this.PrecioVenta +')',
                            nombreproducto : this.NomProducto,
                            tienecalculo : this.TieneCalculo,
                            //tienecalculo : (i % 2 == 0 ? true:false),
                            codproducto : this.CodProducto,
                            punit:this.PrecioVenta,
                            id: this.CodProducto,
                            attrDatosCompletos: this.NomProducto + '__',
                            categoria : this.NomProductoCategoria,
                            urlimg : (this.RutaImagen == null || this.RutaImagen == ''  ?  URL_BASE + 'assets/csoftcontent/img/default.svg' : URL_BASE + 'assets/images/' + this.RutaImagen  )
                        }
                        //console.log(this.NomProducto, producto.tienecalculo);
                        item.push(producto);
                    });
                    response(item);
                    widthbusqueda = $('#txtbusquedaproducto').width();
                    //$('.ui-autocomplete').css('z-index', '9999999');
                },'JSON')
            },
            select: function (event, ui) {
              if(verificarProductosAgregados(ui.item.codproducto)){
                  toastr.warning('El producto ya ha sido agregado!');
              }else{
                  ES_PEDIDO = {
                    AUX:false,
                    COD_PEDIDO :0
                  }
                  agregarProductoRow(ui.item.codproducto, ui.item.punit, ui.item.nombreproducto, ui.item.tienecalculo)
              }
            },
            create: function () {
              $('.ui-autocomplete').width(widthbusqueda)
              //$('.ui-autocomplete').css('width',widthbusqueda+'px !important');

               $(this).data('ui-autocomplete')._renderItem = function (ul, item) {
                   return $('<li class="item-suggestions" style="margin: 5px;"></li>')
                       .data("item.autocomplete", item)
                       .append('<a class="suggest-item" style="display: flex;">' +
                           '<img width="64" height="64" class="media-object" src="'+item.urlimg+'" alt="...">'+
                           '<div class="name" style="padding-top: 8px;padding-left: 8px;" >' +
                           item.label +
                           '<p style="color: #1ab394;font-weight: 600;">'+item.categoria+'</p>'+
                           '</div>' + '</a>'
                       ).appendTo(ul);
               }
           },
        });

}

function getCategorias(){
  var parametros = '';
  var indice = 11;
  var nomproc = "ProcProductoCategoria";

  $.post(URL_BASE+'Registros/procGeneral', {parametros: parametros,
                                            indice: indice,nombreProcedimiento:nomproc}, function (respuesta) {

                                              $('#panelcategoria').empty();
                                              var codcategoriafirst = respuesta[0].CodProductoCategoria
                                              var htmlcategoria = '';
                                              $.each(respuesta,function(){
                                                htmlcategoria +=    '<div  class="col-lg-11" style="margin: 0;padding: 0;padding-bottom: 1px;" >'+
                                                                      '<button onclick="getProductoxCategoria('+this.CodProductoCategoria+')" data-codcategoria="'+this.CodProductoCategoria+'" type="button" class="btn btn-w-m botoncategoria btn-success" >'+
                                                                            this.NomProductoCategoria+
                                                                            '</button>'+
                                                                    '</div>'
                                              });
                                              $('#panelcategoria').append(htmlcategoria);
                                              getProductoxCategoria(codcategoriafirst);
  },"JSON");
}

function getProductoxCategoria(codcategoria){
  var parametros = codcategoria;
  var indice = 13;
  var nomproc = "ProcProducto";

  $.post(URL_BASE+'Registros/procGeneral', {parametros: parametros,
                                            indice: indice,nombreProcedimiento:nomproc}, function (respuesta) {

                                              $('#panelproductos').empty();
                                              var htmlproductos = '';
                                              $.each(respuesta,function(){
                                                htmlproductos += '<div class="col-lg-3" style="margin: 0;padding: 0;" >'+
                                                                    '<button data-nomproducto="'+this.NomProducto+'" data-pventa="'+this.PrecioVenta+'" onclick="agregaProductoAventa($(this))" data-codproducto="'+this.CodProducto+'" type="button" class="btn btn-w-m btn-default botoncategoria" >'+
                                                                        this.NomProducto+
                                                                    '</button>'+
                                                                  '</div>';
                                              });
                                              $('#panelproductos').append(htmlproductos);
  },"JSON");
}


var PRODUCTOS_AGREGADOS = [];

function agregaProductoAventa(elemento){
  var codproducto = elemento.attr('data-codproducto');
  var nomproducto = elemento.attr('data-nomproducto');
  var precioventa = elemento.attr('data-pventa');
  var n_producto_agregado = 0;
  var item = {
      codproducto : codproducto,
      nomproducto : nomproducto,
      pventa : precioventa
  }
  PRODUCTOS_AGREGADOS.push(item);
  var item_html =
  n_producto_agregado = cantproductoagregado(codproducto);
  if(n_producto_agregado > 1){
    var subtotalproducto = n_producto_agregado*precioventa;
    $('#detcantidadprod_'+codproducto).text(n_producto_agregado);
    $('#detprecventa_'+codproducto).text(subtotalproducto.toFixed(2));
    calcularTotales();
    return;
  }

//document.getElementById("audioventa").play();
var srcAudio= $('#audioventa').attr('src');

var audioexito = new Audio();
  audioexito.src = "<?=base_url()?>assets/csoftcontent/audio/success.mp3";
  audioexito.play();

  var htmlAddProducto = '<div id="producto_det_'+codproducto+'"  data-codproducto="'+codproducto+'" class="vote-item" style="padding-top: 4px;padding-bottom: 4px;">'+
          '<div class="row">'+
              '<div class="col-md-9">'+
                '<div class="vote-actions" style="padding-top: 10px;">'+
                  '<i onClick="quitarProductoDelDetalle('+codproducto+')" class="fa fa-trash-o" style="color:red;font-size: 20px;cursor:pointer;"></i>'+
'<div class="" onclick="cambiarCantidadProducto($(this))" id="detcantidadprod_'+codproducto+'" style="color:red;background-color: #1c84c6;width: 14px;height: 14px;font-size: 10px;font-weight: bold;border-radius: 50%;position:  absolute;color: white;left:  0;top: 1px;">'+n_producto_agregado+'</div>'+
                '</div>'+
                '<a href="#" id="detnomproducto_'+codproducto+'" class="vote-title" style="    font-size: 14px;">'+
                  nomproducto +
                '</a>'+
                '<div class="vote-info">'+
                  '<a href="#">Categoria</a>'+
                '</div>'+
              '</div>'+
                '<div class="col-md-3">'+
                  '<div class="vote-icon" style="font-size: 20px;color: #4c5661;">'+
                    '<span class="subtotalproducto" id="detprecventa_'+codproducto+'" >'+precioventa+'</span>'+
                    '</div>'+
                '</div>'+
          '</div>'+
        '</div>';
$('#panelProductoVenta').prepend(htmlAddProducto);
calcularTotales();
}

function calcularTotales(){
  var subtotal_venta= 0;
  var igv_venta = 0;
  var total_venta = 0;
  $.each($('.subtotalproducto'),function(){
    total_venta += Number($(this).text())
  });
  subtotal_venta = (total_venta / 1.18);
  igv_venta = (total_venta - subtotal_venta);
  $('#txtsubtotalventa').text(subtotal_venta.toFixed(2))
  $('#totaligvventa').text(igv_venta.toFixed(2))
  $('#totalventa').text( (Number($('#txtsubtotalventa').text()) + Number($('#totaligvventa').text())).toFixed(2)  )

}

function cantproductoagregado(codproducto){
  var cantidadProductosAgregados= 0;
  $.each(PRODUCTOS_AGREGADOS,function(){
    if(Number(codproducto) == Number(this.codproducto))
    cantidadProductosAgregados++;
  });
  return Number(cantidadProductosAgregados);
}

function quitarProductoDelDetalle(codproducto){
 $('#producto_det_'+codproducto).remove();
 var nvoArreglo = PRODUCTOS_AGREGADOS;
 PRODUCTOS_AGREGADOS = [];
 $.each(nvoArreglo,function(i){
   if(Number(codproducto) == Number(this.codproducto)){

   }else{
     var producto = {
         codproducto : this.codproducto,
         nomproducto : this.nomproducto,
         pventa : this.pventa
     }
     PRODUCTOS_AGREGADOS.push(producto);
   }

 })

 calcularTotales();
}

function guardarVenta(){
  var spinbutton = Ladda.create( document.querySelector( '#btnguardaventa' ) );
  spinbutton.start();
  /* obteniendo cabecera */
  var strSerialiadoCabecera = '';
  var strSerialiadoDetalle = '';
  var codcajagestion = 1;
  var codalmacen = 1;
  var codcliente = $('#selectCliente').val();
  var codmesa = 1;
  var coddocumento =$('#selectTipoDocumento').val();
  var subtotalventa = $('#txtsubtotalventa').text();
  var totalIGVventa = $('#totaligvventa').text();
  var totalventa = $('#totalventa').text();
  var codusuariocreacion =  '<?php echo  $_SESSION['codusuario'];?>';
  var formapago = $('#selectformapago').val();
  var selectVendedor = $('#selectVendedor').val();
  var cantidadproductosdetalle = $('#tbproductodetalle tbody > tr').length;

if(cantidadproductosdetalle == 0){
  spinbutton.stop();
  toastr.error('Debe ingresar productos', 'Error!')
  return;
}
  /* obteniendo detalle */
    strSerialiadoCabecera =  codcajagestion + '|' +
                              codalmacen + '|' +
                              codcliente + '|' +
                              codmesa + '|' +
                              coddocumento + '|'+
                              subtotalventa + '|' +
                              totalIGVventa + '|' +
                              totalventa + '|' +
                              codusuariocreacion + '|' +
                              formapago + '|' +
                              selectVendedor + '|' +
                              ES_PEDIDO.COD_PEDIDO;
  //console.log('cod pedido', ES_PEDIDO.COD_PEDIDO)
  $.each($('#tbproductodetalle tbody > tr'),function(){
    var codproducto = $(this).attr('data-codproducto');
    var cantidad = $(this).find('td').eq(2).children().val();
    //var precioventa = $(this).attr('data-pventa');
    var precioventa = '';
	if(EDITAR_PRECIO_VENTA){
		precioventa = $(this).find('td').eq(3).children().val();
	}else{
		precioventa = $(this).attr('data-pventa');
	}
    //console.log('precioventa', precioventa);
    var TieneCalculo = $(this).attr('data-tienecalculo');
    var CalculoProducto = $(this).attr('data-calculoproducto');
    strSerialiadoDetalle += codproducto + '|' + cantidad  + '|' + precioventa + '|' + TieneCalculo + '|' + CalculoProducto +'~';
  });
  strSerialiadoDetalle = strSerialiadoDetalle.substring(0,strSerialiadoDetalle.length - 1);
  var parametros = strSerialiadoCabecera;
  var parametrosdetalle = strSerialiadoDetalle;
  var indice = 20;
  var nomproc = "ProcVenta";

  $.post(URL_BASE+'Venta/ProcVentaTran', {
    Procedimiento: nomproc,
    Parametros: parametros,
    ParametrosDetalle: parametrosdetalle,
    Indice: indice,
  }, function (respuesta) {
    //console.log('ES PEDIDO', ES_PEDIDO)
    console.log("guarda venta");
    console.log("rpta", respuesta);

    spinbutton.stop();
    if(respuesta.CodResultado == 1){
      //PRODUCTOS_AGREGADOS = [];
      $('#tbproductodetalle tbody').empty();
      //$('#panelProductoVenta').empty();
      $('#txtsubtotalventa').text('');
      $('#totaligvventa').text('');
      $('#totalventa').text('');
      //
      toastr.success(respuesta.DesResultado, 'Éxito');
      ConsultaVoucherVenta(respuesta.CodAuxiliar);
      ES_PEDIDO = {
        AUX:false,
        COD_PEDIDO :0
      }
      ListarDocumentos();
    }else{
      toastr.error(respuesta.DesResultado, 'Error!')

    }
  },"JSON");
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
        // TablaHTML +=
        //   '<div class="N" style="float:left;">' + N + '</div>' +
        //   '<div class="Descripcion">' + Producto + '</div>' +
        //   '<div class="Sangria"></div>' +
        //   '<div class="Cantidad">' + Cantidad + '</div>' +
        //   '<div class="PUnit">' + Precio + '</div>' +
        //   '<div class="Total">' + Total + '</div>';
        //

        TablaHTML +=
        '<tr>' +
            '<td>' + N + '</td>' +
            '<td>' + Producto + '</td>' +
            '<td>' + Cantidad + '</td>' +
            '<td style="text-align:right;">' + Precio + '</td>' +
            '<td style="text-align:right;">' + Total + '</td>' +
        '</tr>';

        SumaTotal += ImporteTotal;
      }
      $('#DivVentaDetalle tbody').html(TablaHTML);
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

/******************************** functines para la nueva venta *****************/
  function agregarProductoEnter(e){
    if($('#txtbusquedaproducto').val().length == 0){
        toastr.warning('Debe buscar un producto!');
        $('#txtbusquedaproducto').focus();
        return;
    }

    var codekey = e.which;
    if(Number(codekey) == 13){
      var parametros = $('#txtbusquedaproducto').val() + '|' + 2; //2 es para el igual 1 es para el like
      var indice = 19;
      var nomproc = "ProcProducto";
      $.post(URL_BASE+'Registros/procGeneral',{
        parametros: parametros,
        indice: indice,
        nombreProcedimiento:nomproc
      }
      , function (respuesta) {
        
        if(respuesta.length == 0){
            $('#txtbusquedaproducto').val('').focus();
            //toastr.warning('No hay información del producto!');
        }else{
          $('#txtbusquedaproducto').val('').focus();
          $('.ui-autocomplete').css('display','none');
          if(verificarProductosAgregados(respuesta[0].CodProducto)){
              toastr.warning('El producto ya ha sido agregado!');
          }else{
              agregarProductoRow(respuesta[0].CodProducto, respuesta[0].PrecioVenta, respuesta[0].NomProducto)
          }

        }
      },'JSON')

    }
  }

  function verificarProductosAgregados(codproducto){
    var rpta = false;
    $.each($('#tbproductodetalle tbody > tr'),function(){
      var codigoproducto = $(this).attr('data-codproducto');
      if(Number(codproducto) == Number(codigoproducto) ){
        rpta = true;
      }
    });
    return rpta;
  }
  function cambiartipooperacion(tipo){
      switch (tipo) {
        case 'venta':
          $('#textooperacion').text(tipo)
          break;
        case 'devolucion':
          $('#textooperacion').text('Devolución')
          break;
        default:
          break;
      }
  }

  function quitarproductorow(elemento){
    elemento.remove();
    calcularTotalesNuevo()
  }

  function agregarProductoRow(codproducto, punitario, nombre, tienecalculo, CalculoProducto){
    var precioUnitarioMuestra = null;
    if(Number(tienecalculo) == 1){
      mostrarIngresoFormula(codproducto, punitario, tienecalculo, nombre);
    }else{
      precioUnitarioMuestra = punitario;
      
      var htmlRowProducto  =  '<tr data-codproducto="' + codproducto + '" data-pventa="' + punitario + '" data-tienecalculo="0" data-calculoproducto="" >'+
        '<td>' + '<i onClick="quitarproductorow($(this).parent().parent());" class="fa fa-trash-o" style="color:red;cursor:pointer;"></i>' + '</td>' +
        '<td>' + nombre + '</td>' +
        '<td style="text-align:right" >' + '<input onclick="$(this).select()" class="cantidadprod" type="text" style="width:70px;text-align:right;" onkeyup="actualizarimporte($(this), $(this).parent().parent(), event)" onkeypress="return Util.SoloDecimal(event, this);" class="form-control input-sm" value="1">' + '</td>' +
        //'<td style="text-align:right" >' + Number(punitario).toFixed(2) + '</td>' +
        (EDITAR_PRECIO_VENTA ? '<td style="text-align:right" ><input onclick="$(this).select()" onkeypress="return Util.SoloDecimal(event, this);" onkeyup="actualizaPrecioVenta($(this).parent().parent(),$(this))" type="text" value="' + Number(punitario).toFixed(2) + '" style="width:70px;text-align:right;"  /></td>' : '<td style="text-align:right" >' + Number(punitario).toFixed(2) + '</td>') +
        '<td style="text-align:right" class="subtotalproducto">' + Number(punitario).toFixed(2) + '</td>' +
      '</tr>';

      $('#tbproductodetalle tbody').append(htmlRowProducto);
      $('.cantidadprod').focus().select();
      calcularTotalesNuevo();
    }
    
  }

function actualizaPrecioVenta(elementoTr, elemento){
  //console.log(elementoTr[0])
  var elementoSubtotal = elementoTr.find('td').eq(4);
  var cantidadProducto = Number(elementoTr.find('td').eq(2).find('input').val());
  var precioUnitario = Number(elemento.val());
  //console.log(cantidadProducto,precioUnitario)
  var subTotalProducto = (cantidadProducto * precioUnitario);
  elementoSubtotal.text(subTotalProducto.toFixed(2))
  calcularTotalesNuevo();
}
  function actualizarimporte(elemento, tr, e){
      var cantidad = elemento.val();
      //var pventa = tr.attr('data-pventa');
      var pventa = '';
      
	  if(EDITAR_PRECIO_VENTA){
      pventa = tr.find('td').eq(3).find('input').val();
    }else{
      pventa = tr.attr('data-pventa');
    }
      
      var subtotal = Number(cantidad) * Number(pventa);
      var elementsubtotal = tr.find('td').eq(4).text(subtotal.toFixed(2));
      calcularTotalesNuevo();
      var keycode = e.which;
      if(keycode == 13){
        $('#txtbusquedaproducto').focus().select();
      }
  }
  
  function calcularTotalesNuevo(){
    var subtotal_venta= 0;
    var igv_venta = 0;
    var total_venta = 0;
    $.each($('.subtotalproducto'),function(){
      total_venta += Number($(this).text())
    });
    subtotal_venta = (total_venta / 1.18);
    igv_venta = (total_venta - subtotal_venta);
    $('#txtsubtotalventa').text(subtotal_venta.toFixed(2))
    $('#totaligvventa').text(igv_venta.toFixed(2))
    $('#totalventa').text( (Number($('#txtsubtotalventa').text()) + Number($('#totaligvventa').text())).toFixed(2)  )
  }

  var AUX_TEMP_PROC_CALCULO = {
    codproducto : null,
    nombreproducto: null,
    precioventa : null,
    tienecalculo: null,
    CalculoProducto: null
  }

  function mostrarIngresoFormula(codproducto, pventa, flagcalculo, nombreproducto){
    AUX_TEMP_PROC_CALCULO = {
      codproducto: codproducto,
      precioventa: pventa,
      tienecalculo: flagcalculo,
      nombreproducto: nombreproducto
    }
    $('#txtBaseForm').val('').select();
    $('#txtalturaform').val('');
    $('#DivFormulaModal').modal('show');
    
  }
  var FACTOR_VIDRIO_TEMPLADO = 900;
  function confirmarFormula() {
    var base = Number($('#txtBaseForm').val());
    var altura = Number($('#txtalturaform').val());
    var precioFinal = ((base * altura)/FACTOR_VIDRIO_TEMPLADO * Number(AUX_TEMP_PROC_CALCULO.precioventa));
    precioFinal = Number(precioFinal).toFixed(2);
    
    AUX_TEMP_PROC_CALCULO.CalculoProducto = base + 'X' + altura + 'X' + FACTOR_VIDRIO_TEMPLADO;
    
    AUX_TEMP_PROC_CALCULO.nombreproducto = AUX_TEMP_PROC_CALCULO.nombreproducto + ' ' + AUX_TEMP_PROC_CALCULO.CalculoProducto;
    //
    var htmlProducto  =  '<tr data-codproducto="'+ AUX_TEMP_PROC_CALCULO.codproducto +'" data-pventa="'+ precioFinal+'" data-tienecalculo="' + AUX_TEMP_PROC_CALCULO.tienecalculo + '" data-calculoproducto="' + AUX_TEMP_PROC_CALCULO.CalculoProducto + '" >'+
        '<td>' + '<i onClick="quitarproductorow($(this).parent().parent());" class="fa fa-trash-o" style="color:red;cursor:pointer;"></i>' + '</td>' +
        '<td>' + AUX_TEMP_PROC_CALCULO.nombreproducto + '</td>' +
        '<td style="text-align:right" >' + '<input class="cantidadprod" type="text" style="width:70px;text-align:right;" onkeyup="actualizarimporte($(this), $(this).parent().parent(), event)" onkeypress="return Util.SoloDecimal(event, this);" class="form-control input-sm" value="1">' + '</td>' +
        '<td style="text-align:right" >' + precioFinal + '</td>' +
        '<td style="text-align:right" class="subtotalproducto">' + precioFinal + '</td>' +
    '</tr>';

    $('#tbproductodetalle tbody').append(htmlProducto);
    $('.cantidadprod').focus().select();
    calcularTotalesNuevo();

    $('#DivFormulaModal').modal('hide');
  }

  function listarPedido(){
    var Procedimiento = 'ProcPedido';
    var Parametros = '';
    var Indice = 13;
    var URL = URL_BASE + 'Registros/procGeneral';
    var Data = {
      parametros: Parametros,
      indice: Indice,
      nombreProcedimiento: Procedimiento
    };
  //
    $.post(URL, Data, function(Datos) {
      //console.log('datos..', Datos);
      $('#tbPedidos tbody').empty();
      var strHTMLpedidos = '';
      var totalImportePedido = 0;
      $.each(Datos, function(i){
        strHTMLpedidos += 
        '<tr style="cursor:pointer;" onclick="mostrarPedido('+ this.CodPedido +')" >'+
          '<td>' + this.NroPedido + '</td>' +
          '<td>' + this.Vendedor + '</td>' +
          '<td>' + this.FechaCreacion+ '</td>' +
          // '<td>' + this.NroPedidoVendedor+ '</td>' +
          '<td>' + this.Cliente+ '</td>' +
          '<td class="text-right" >' + this.CantidadProductos+ '</td>' +
          '<td>' + this.Comentario+ '</td>' +
          '<td class="text-right" >' + this.Total+ '</td>' +
        '</tr>';
        totalImportePedido += Number(this.Total);
      });
      $('#txtTotalImportePedido').text(totalImportePedido.toFixed(2));
      $('#tbPedidos tbody').append(strHTMLpedidos);
      $('#divPedidos').modal('show');
    },'JSON')
  } 

  function mostrarPedido(codPedido){
    var Procedimiento = 'ProcPedido';
    var Parametros = codPedido;
    var Indice = 11;
    var URL = URL_BASE + 'Registros/procGeneral';
    var Data = {
      parametros: Parametros,
      indice: Indice,
      nombreProcedimiento: Procedimiento
    };
  //
    $.post(URL, Data, function(Datos) {
      
      //console.log('Datos', Datos);
      //return;
      var detallePedido = Datos[0].Detalle;
      var codCliente = Number(Datos[0].CodCliente);
      var CodPersonaVendedor = Number(Datos[0].CodPersonaVendedor);

      var selCliente = selectizeCliente[0].selectize;
      selCliente.setValue(codCliente, false);

      SelVendedor.val(CodPersonaVendedor);

      //$('#selectCliente').val(14)
      $('#tbproductodetalle tbody').empty();
        var strHTMLDataItems = '';
        var fila = detallePedido.split('~');
        for(i=0; i < fila.length; i++){
          var celda = fila[i].split('|');
          var codproducto = celda[0];
          var producto = celda[1];
          var cantidad = celda[2];
          var preciounitario = celda[3];
          var importe = celda[4];

          strHTMLDataItems +=  '<tr data-codproducto="' + codproducto + '" data-pventa="' + preciounitario + '" data-tienecalculo="0" data-calculoproducto="" >'+
            '<td>' + '<i onClick="quitarproductorow($(this).parent().parent());" class="fa fa-trash-o" style="color:red;cursor:pointer;"></i>' + '</td>' +
            '<td>' + producto + '</td>' +
            '<td style="text-align:right" >' + '<input class="cantidadprod" type="text" style="width:70px;text-align:right;" onkeyup="actualizarimporte($(this), $(this).parent().parent(), event)" onkeypress="return Util.SoloDecimal(event, this);" class="form-control input-sm" value="'+ cantidad +'">' + '</td>' +
            //'<td style="text-align:right" >' + Number(preciounitario).toFixed(2) + '</td>' +
            (EDITAR_PRECIO_VENTA ? '<td style="text-align:right" ><input onclick="$(this).select()" onkeypress="return Util.SoloDecimal(event, this);" onkeyup="actualizaPrecioVenta($(this).parent().parent(),$(this))" type="text" value="' + Number(preciounitario).toFixed(2) + '" style="width:70px;text-align:right;"  /></td>' : '<td style="text-align:right" >' + Number(preciounitario).toFixed(2) + '</td>') +
            '<td style="text-align:right" class="subtotalproducto">' + Number(importe).toFixed(2) + '</td>' +
          '</tr>';
        }
        $('#divPedidos').modal('hide');
        $('#tbproductodetalle tbody').append(strHTMLDataItems);
        $('.cantidadprod').focus().select();
        calcularTotalesNuevo();
        ES_PEDIDO = {
          AUX:true,
          COD_PEDIDO :codPedido
        }
    },'JSON')
  }
</script>