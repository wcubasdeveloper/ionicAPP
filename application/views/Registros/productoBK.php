<div class="row">
   <div class="row wrapper border-bottom white-bg page-heading">
      <div class="col-lg-12">
         <h2>Productos &nbsp;&nbsp;&nbsp;<strong id="cantProductos">-</strong><button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit" onclick="abrirDialogRegistra();"><strong>Nuevo</strong></button></h2>
      </div>

   </div>
   <br>
   <div class="row wrapper border-bottom white-bg page-heading">
      <div class="col-lg-12">
      <br>
            <table class="table table-bordered" id="tbproductos">
               <thead>
                  <tr>
                     <th>N</th>
                     <th>CODIGO</th>
                     <th>NOMBRE</th>
                     <th style="text-align:right;" >P.COSTO</th>
                     <th style="text-align:right;" >P.VENTA</th>
                     <th  style="text-align:right;">STOCK MIN</th>
                     <th style="width:90px;">ACCIONES</th>
                  </tr>
               </thead>
               <tbody>

               </tbody>
            </table>

      </div>
   </div>
</div>



<!-- Modal Confirmacion-->
 <div class="modal fade" id="modalConfirmacion" role="dialog">
   <div class="modal-dialog">

     <div class="modal-content">
       <div class="modal-header ui-draggable-handle">
         <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
         <h4 style="font-weight:100" >Eliminar registro</h4>
       </div>
       <div >
          <div >
                <div class="modal-body">
                  <div class="body">
                               <form class="form-vertical">
                                   <div class="row clearfix">
                                       <div class="col-md-12 form-control-label">
                                         <input type="hidden" id="codigoproductoelimina">
                                           <h4>Motivo</h4>
                                            <textarea id="txtmotivoelimina" class="form-control" rows="2" id="comment"></textarea>
                                       </div>

                                   </div>
                               </form>
                           </div>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-w-m btn-primary" onclick="eliminarProducto();"  >SI</button>
                  <button type="button" class="btn btn-w-m btn-danger" data-dismiss="modal">NO</button>
                </div>
          </div>
       </div>
     </div>
   </div>
 </div>


<!-- Modal Producto-->
 <div class="modal fade" id="modalProducto" role="dialog">
   <div class="modal-dialog">

     <div class="modal-content">
       <div class="modal-header ui-draggable-handle">
         <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
         <h4 style="font-weight:100" id="etiquetamodal" data-codproducto="" data-tipomodal="" >-</h4>
       </div>
       <div id="ContenidoDialog">
          <div id="divCrearChip">
                <div class="modal-body">
                  <div class="body">
                               <form class="form-vertical">

                                   <div class="row clearfix">
                                       <div class="col-md-3 form-control-label">
                                           <label for="email_address_2">Código:</label>
                                       </div>
                                       <div class="col-md-7">
                                           <div class="form-group">
                                               <div class="form-line">
                                                  <input id="txtcodigo" onkeypress="return Util.SoloNumero(event, this);"  type="text" value="" class="form-control" required="" autofocus="">
                                               </div>
                                           </div>
                                       </div>
                                   </div>

                                   <div class="row clearfix">
                                       <div class="col-md-3 form-control-label">
                                           <label for="email_address_2">Nombre:</label>
                                       </div>
                                       <div class="col-md-7">
                                           <div class="form-group">
                                               <div class="form-line">
                                                  <input id="txtnombre"  type="text" value="" class="form-control" required="" autofocus="">
                                               </div>
                                           </div>
                                       </div>
                                   </div>

                                   <div class="row clearfix">
                                       <div class="col-md-3 form-control-label">
                                           <label for="email_address_2">P.Costo:</label>
                                       </div>
                                       <div class="col-md-7">
                                           <div class="form-group">
                                               <div class="form-line">
                                                  <input id="txtpcosto" onkeypress="return Util.SoloDecimal(event, this);"  type="text" value="" class="form-control" required="" autofocus="">
                                               </div>
                                           </div>
                                       </div>
                                   </div>


                                   <div class="row clearfix">
                                       <div class="col-md-3 form-control-label">
                                           <label for="email_address_2">P.Venta:</label>
                                       </div>
                                       <div class="col-md-7">
                                           <div class="form-group">
                                               <div class="form-line">
                                                  <input id="txtpventa" onkeypress="return Util.SoloDecimal(event, this);"  type="text" value="" class="form-control" required="" autofocus="">
                                               </div>
                                           </div>
                                       </div>
                                   </div>

                                   <div class="row clearfix">
                                       <div class="col-md-3 form-control-label">
                                           <label for="email_address_2">Comisión:</label>
                                       </div>
                                       <div class="col-md-7">
                                           <div class="form-group">
                                               <div class="form-line">
                                                 <input type="checkbox"  id="checkcomision">
                                               </div>
                                           </div>
                                       </div>
                                   </div>


                                   <div class="row clearfix">
                                       <div class="col-md-3 form-control-label">
                                           <label for="email_address_2">Stock Min:</label>
                                       </div>
                                       <div class="col-md-7">
                                           <div class="form-group">
                                               <div class="form-line">
                                                  <input id="txtstockmin"  type="text" onkeypress="return Util.SoloNumero(event, this);" value="" class="form-control" required="" autofocus="">
                                               </div>
                                           </div>
                                       </div>
                                   </div>



                               </form>
                           </div>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-w-m btn-primary" onclick="guardarProducto();"  >Guardar</button>
                  <button type="button" class="btn btn-w-m btn-danger" data-dismiss="modal">Cerrar</button>
                </div>
          </div>
       </div>
     </div>
   </div>
 </div>

<script type="text/javascript">

$(document).ready(function(){
listaProductos();
});

function listaProductos(fecha){
  var parametros = '';
  var indice = 10;
  var nomproc = "ProcProducto";

  $.post(URL_BASE+'Registros/procGeneral', {parametros: parametros,
                                            indice: indice,nombreProcedimiento:nomproc}, function (respuesta) {

    $('#tbproductos tbody').empty();
    var htmlStrTabla = '';
    var cantidadProductos = respuesta.length;

console.log(respuesta)
    $.each(respuesta,function(i){
      htmlStrTabla += '<tr data-codproducto="'+ this.CodProducto+'" >'+
                        '<td>' + (i+1) + '</td>'+
                        '<td>' + this.CodigoProducto + '</td>'+
                        '<td>' + this.NomProducto + '</td>'+
                        '<td style="text-align:right;">' + this.PrecioCosto + '</td>'+
                        '<td style="text-align:right;" >' + this.PrecioVenta + '</td>'+
                        '<td  style="text-align:right;" >' + this.StockMinimo + '</td>'+
                        '<td>' +
                          '<button '+
                          ' data-cod="'+this.CodProducto+'" '+
                          ' data-codigo="'+this.CodigoProducto+'" '+
                          ' data-nombre="'+this.NomProducto+'" '+
                          ' data-pcosto="'+this.PrecioCosto+'" '+
                          ' data-pventa="'+this.PrecioVenta+'" '+
                          ' data-comision="'+ this.Comision +'" '+
                          ' data-stockmin="'+this.StockMinimo +'" '+
                          ' type="button" class="btn btn-warning btn-xs" onclick="actualizarProducto($(this))"><i class="fa fa-edit"></i></button>' +
                          '&nbsp;&nbsp;'+
                          '<button type="button" class="btn btn-danger btn-xs" onclick="abrirmodalConfirmacion('+ this.CodProducto +')" ><i class="fa fa-trash"></i></button>' +
                        '</td>'+
                      '</tr>';
    })
    $('#tbproductos tbody').append(htmlStrTabla);
    $('#cantProductos').text(cantidadProductos);
      //$.notify(respuesta[0].DesResultado,(respuesta[0].CodResultado == 1  ? "success" : "error" ) );
    toastr.success('Registros cargados correctamente', 'Nota')
  },"JSON");
}

function abrirDialogRegistra(){

  $('#txtcodigo').val('');
  $('#txtnombre').val('');
  $('#txtpcosto').val('');
  $('#txtpventa').val('');
  $('#checkcomision').prop("checked",false);
  $('#txtstockmin').val('');

  $('#etiquetamodal').text("Registrar producto.");
  $('#etiquetamodal').attr("data-tipomodal",'registra');
  $('#modalProducto').modal('show');
  //$("#modalProducto").draggable({
    //  handle: ".modal-header"
  //});
}

function guardarProducto(){

 var codigoProducto  = $('#txtcodigo').val();
 var nombreProducto  = $('#txtnombre').val();
 var pcostoProducto  = $('#txtpcosto').val();
 var pventaProducto  = $('#txtpventa').val();
 var comisionProducto  = ($('#checkcomision').is(':checked') ? 1 : 0 );
 var stockminProducto  = $('#txtstockmin').val();

if(codigoProducto == ""){
  toastr.warning('Debe ingresar un el código del producto!');
  $('#txtcodigo').focus();
  return;
}

if(nombreProducto == ""){
  toastr.warning('Debe ingresar un el nombre del producto!');
  $('#txtnombre').focus();
  return;
}

if(pcostoProducto == ""){
  toastr.warning('Debe ingresar un el precio de costo del producto!');
  $('#txtpcosto').focus();
  return;
}

if(pventaProducto == ""){
  toastr.warning('Debe ingresar un el precio de venta del producto!');
  $('#txtpventa').focus();
  return;
}

if(stockminProducto == ""){
  toastr.warning('Debe ingresar un el stock min del producto!');
  $('#txtstockmin').focus();
  return;
}

var tipomodal = $('#etiquetamodal').attr('data-tipomodal');
var parametros = '';

if(tipomodal == 'modifica'){

  var codProducto = $('#etiquetamodal').attr("data-codproducto");

  parametros =  codProducto +'|'+
                codigoProducto + '|' +
                nombreProducto + '|' +
                pcostoProducto + '|' +
                pventaProducto + '|' +
                comisionProducto + '|' +
                stockminProducto;

              }else{
                parametros = codigoProducto + '|' +
                nombreProducto + '|' +
                pcostoProducto + '|' +
                pventaProducto + '|' +
                1 + '|' +
                comisionProducto + '|' +
                stockminProducto;
              }

              console.log(parametros);
 var indice = (tipomodal == 'modifica' ? 30 :20);
 var nomproc = "ProcProducto";

   $.post(URL_BASE+'Registros/procGeneral', {
     parametros: parametros,
     indice: indice,
     nombreProcedimiento:nomproc
   }, function (respuesta) {
     var codresultado = Number(respuesta[0].CodResultado);
     var desresultado = respuesta[0].DesResultado;

     if(codresultado == 1){
       $('#modalProducto').modal('hide');
       toastr.success(desresultado, 'Éxito');
       listaProductos();
     }else{
       toastr.error(desresultado, 'Error!')
     }
  },"JSON");

}

function abrirmodalConfirmacion(codproducto){
  $('#txtmotivoelimina').val('')
  $('#codigoproductoelimina').val(codproducto);
  $('#modalConfirmacion').modal('show');
}

function eliminarProducto(){
  var productoSeleccionado = $('#codigoproductoelimina').val();
  var motivoEliminar= $('#txtmotivoelimina').val();

  if(motivoEliminar == ""){
    toastr.warning('Debe ingresar un motivo para eliminar el registro!');
    return;
  }

  var parametros = productoSeleccionado + '|' +
                   1 + '|' +
                   motivoEliminar;
  var indice = 40;
  var nomproc = "ProcProducto";

    $.post(URL_BASE+'Registros/procGeneral', {
      parametros: parametros,
      indice: indice,
      nombreProcedimiento:nomproc
    }, function (respuesta) {
      var codresultado = Number(respuesta[0].CodResultado);
      var desresultado = respuesta[0].DesResultado;

      if(codresultado == 1){
        $('#modalConfirmacion').modal('hide');
        toastr.success(desresultado, 'Éxito');
        listaProductos();
      }else{
        toastr.error(desresultado, 'Error!')
      }
   },"JSON");
}

function actualizarProducto(element){

  var codproducto = element.attr('data-cod');
  var codigo = element.attr('data-codigo');
  var nombre = element.attr('data-nombre');
  var pcosto = element.attr('data-pcosto');
  var pventa = element.attr('data-pventa');

 $('#modalProducto').modal('show');
 $('#etiquetamodal').text("Modificar producto.");
  $('#etiquetamodal').attr("data-tipomodal",'modifica');
  $('#etiquetamodal').attr("data-codproducto",codproducto);





var comision = Number(element.attr('data-comision'));
var stockmin = element.attr('data-stockmin');

$('#txtcodigo').val(codigo);
$('#txtnombre').val(nombre);
$('#txtpcosto').val(pcosto);
$('#txtpventa').val(pventa);
$('#checkcomision').prop("checked",(comision == 1? true:false));
$('#txtstockmin').val(stockmin);

}
</script>
