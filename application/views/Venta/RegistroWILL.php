<style>
  #contenidoprincipal
  {
    padding-top: 5px;
  }
</style>


  <link href="<?=base_url()?>assets/csoftcontent/css/plugins/selectize/selectize.bootstrap3.css"rel="stylesheet">
  <link href="<?=base_url()?>assets/csoftcontent/css/plugins/selectize/selectize.default.css"rel="stylesheet">
  <script src="<?=base_url()?>assets/csoftcontent/js/plugins/selectize/selectize.js"></script>
  <script src="<?=base_url()?>assets/csoftcontent/js/plugins/print/Print.js"></script>


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
</style>

<audio id="audioventa">
  <source src="<?=base_url()?>assets/csoftcontent/audio/success.mp3" type="audio/mpeg">
  Your browser does not support the audio element.
</audio>

<div id="contenidoprincipalventa" class="row">
  <div class="col-lg-8">
    <div class="tabs-container">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#tab-1" aria-expanded="true">Productos</a></li>
            <li class="" style="display:none"><a data-toggle="tab" href="#tab-2" aria-expanded="false">Ventas</a></li>
        </ul>
        <div class="tab-content">
            <div id="tab-1" class="tab-pane active">
                <div class="panel-body">
                  <div class="col-lg-2" style="margin: 0;padding: 0;" id="panelcategoria" >

                    <div class="col-lg-11" style="margin: 0;padding: 0;padding-bottom: 1px;" >
                      <button type="button" class="btn btn-w-m botoncategoria btn-success" >Categoria 1</button>
                    </div>

                  </div>

                  <div class="col-lg-10" style="margin: 0;padding: 0;" id="panelproductos" >
                    <div class="col-lg-3" style="margin: 0;padding: 0;" >
                      <button type="button" class="btn btn-w-m btn-default botoncategoria" >Producto 1</button>
                    </div>
                  </div>
                </div>
            </div>
            <div id="tab-2" class="tab-pane">
                <div class="panel-body">
                  <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Username</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>1</td>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Larry</td>
                        <td>the Bird</td>
                        <td>@twitter</td>
                    </tr>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
  </div>

  <div class="col-lg-4">
    <div class="ibox">
      <div class="ibox-title">
        <select  id="selectTipoDocumento" class="form-control m-b" name="account"></select>
      </div>
      
      <div class="ibox-title">

        
                <select class="form-control m-b" id="selectformapago"  >
            <?php foreach($fpagos as $fpago):?>
<option value="<?php echo $fpago['CodFormaPago'];?>"><?php echo $fpago['NomFormaPago'];?></option>
<?php endforeach;?>
          </select>
          
      </div>
      
      <div class="ibox-content">
          <select name="fruits" id="selectCliente" placeholder="Buscar cliente" >
            <?php foreach($clientes as $cliente):?>
<option data-value="s" value="<?php echo $cliente['CodCliente'];?>"><?php echo $cliente['NomCliente']." ".$cliente['PaternoCliente']." ".$cliente['MaternoCliente'];?></option>
<?php endforeach;?>

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


  <div class="ibox">
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
      <button id="BtnPagar" type="button" class="btn btn-w-m btn-primary"onclick="guardarVenta()">PAGAR</button>
    </div>
  </div>

  </div>

</div>



<script type="text/javascript">
  var selectTipoDocumento = $('#selectTipoDocumento');
  var BtnPagar = $('#BtnPagar');

$('#contenidoprincipalventa').parent().removeClass('container')
$('#contenidoprincipalventa').parent().parent().removeClass('wrapper wrapper-content')

$('#selectCliente').selectize({
    create: true,
    persist: false,
    //labelField: "item",
    //valueField: "item",
    sortField: 'item',
    searchField: 'item',
    create:function (input){
            alert(8);
             return { value:123, text:input};
         },
         render: {
    option_create: function(data, escape) {
      return '<div class="create">Agregar nuevo cliente <strong>' + escape(data.input) + '</strong>&hellip;</div>';
    }
  },
});

$(document).ready(function(){
  ListarDocumentos();
getCategorias();
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

//console.log('n_producto_agregado',n_producto_agregado);
  var htmlAddProducto = '<div id="producto_det_'+codproducto+'"  data-codproducto="'+codproducto+'" class="vote-item" style="padding-top: 4px;padding-bottom: 4px;">'+
          '<div class="row">'+
              '<div class="col-md-9">'+
                '<div class="vote-actions" style="padding-top: 10px;">'+
                  '<i onClick="quitarProductoDelDetalle('+codproducto+')" class="fa fa-trash-o" style="color:red;font-size: 20px;cursor:pointer;"></i>'+
'<div class="" id="detcantidadprod_'+codproducto+'" style="color:red;background-color: #1c84c6;width: 14px;height: 14px;font-size: 10px;font-weight: bold;border-radius: 50%;position:  absolute;color: white;left:  0;top: 1px;">'+n_producto_agregado+'</div>'+
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
if(PRODUCTOS_AGREGADOS.length == 0){
  toastr.error('Debe ingresar productos', 'Error!')
  return;
}
  BtnPagar.attr('disabled', 'disabled');
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
                              formapago;
  $.each($('#panelProductoVenta > .vote-item'),function(){
//    var codproducto = $(this).find('.vote-item');
    //console.log($(this)[0])
    var codproducto = $(this).attr('data-codproducto');
    var cantidad = $('#detcantidadprod_' + codproducto).text();
    var precioventa = $('#detprecventa_' + codproducto).text();
    //console.log(codproducto + '|' + cantidad  + '|' + precioventa);
    strSerialiadoDetalle += codproducto + '|' + cantidad  + '|' + precioventa +'~';
  });
  strSerialiadoDetalle = strSerialiadoDetalle.substring(0,strSerialiadoDetalle.length - 1);
  //console.log('strSerialiadoCabecera-',strSerialiadoCabecera);
  //console.log('strSerialiadoDetalle-',strSerialiadoDetalle);

  var parametros = strSerialiadoCabecera;
  var parametrosdetalle = strSerialiadoDetalle;
  var indice = 20;
  var nomproc = "ProcVenta";

  $.post(URL_BASE+'Venta/ProcVentaTran', {
    Procedimiento:nomproc,
    Parametros: parametros,
    ParametrosDetalle : parametrosdetalle,
    Indice: indice,
  }, function (respuesta) {
    console.log(respuesta);
    //console.log('rpta venta',respuesta);
    if(respuesta.CodResultado == 1){
      PRODUCTOS_AGREGADOS = [];
      $('#panelProductoVenta').empty();
      $('#txtsubtotalventa').text('');
      $('#totaligvventa').text('');
      $('#totalventa').text('');
      //
      toastr.success(respuesta.DesResultado, 'Éxito');
      ConsultaVoucherVenta(respuesta.CodAuxiliar);
      ListarDocumentos();
    } else{
      toastr.error(respuesta.DesResultado, 'Error!')

    }
    BtnPagar.removeAttr('disabled');
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
        '<tr>' +
            '<td>' + N + '</td>' +
            '<td>' + Producto + '</td>' +
            '<td>' + Cantidad + '</td>' +
            '<td style="text-align:right;">' + Precio + '</td>' +
            '<td style="text-align:right;">' + Total + '</td>' +
        '</tr>';
        //
        SumaTotal += ImporteTotal;
      }
      $('#TbVentaDetalle tbody').append(TablaHTML);
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

</script>