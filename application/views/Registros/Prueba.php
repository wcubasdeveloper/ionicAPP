
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<style>
  .ImgCargando{width:100%;height:180px;border:1px solid gray;cursor:pointer;}
  /* .ImgCargando:hover{border:2px solid #E7E7E7; } */
</style>

<form id="FrmProducto" class="" action="<?=base_url()?>Registros/SubirAchivo" enctype="multipart/form-data" method="post">
<div class="modal-body">
  <div class="body">
    <div class="row clearfix">
      <div class="col-md-6">
        <div class="row clearfix">
          <div class="col-md-4 form-control-label">
            <label for="txtcodigo">Código:</label>
          </div>
          <div class="col-md-8">
            <div class="form-group">
              <div class="form-line">
                <input id="txtcodigo" disabled="disabled" onkeypress="return Util.SoloNumero(event, this);"  type="text" value="" class="form-control" required="">
              </div>
            </div>
          </div>
        </div>
        <div class="row clearfix">
          <div class="col-md-4 form-control-label">
            <label for="selectCategoria">Categoria:</label>
          </div>
          <div class="col-md-8">
            <div class="form-group">
              <div class="form-line">
                <select class="form-control m-b" id="selectCategoria"  >
                <?php foreach($categorias as $categoria):?>
                  <option value="<?php echo $categoria['CodProductoCategoria'];?>"><?php echo $categoria['NomProductoCategoria'];?></option>
                <?php endforeach;?>
              </select>
              </div>
            </div>
          </div>
        </div>
        <div class="row clearfix">
          <div class="col-md-4 form-control-label">
            <label for="selectUnidadMedida">U.MED:</label>
          </div>
          <div class="col-md-8">
            <div class="form-group">
              <div class="form-line">
                <select class="form-control m-b" id="selectUnidadMedida" ></select>
              </div>
            </div>
          </div>
        </div>
        <div class="row clearfix">
          <div class="col-md-4 form-control-label">
            <label for="SelProductoTipo">Tipo:</label>
          </div>
          <div class="col-md-8">
            <div class="form-group">
              <div class="form-line">
                <select id="SelProductoTipo" class="form-control m-b">
                  <option value="1">ALMACENABLE</option>
                  <option value="2">CONSUMIBLE</option>
                  <option value="3">SERVICIO</option>
                  <option value="4">FÓRMULA</option>
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="row clearfix">
          <div class="col-md-4 form-control-label">
            <label for="ImgProducto">Imagen:</label>
          </div>
          <div class="col-md-8">
            <div class="form-group">
              <div class="form-line">
                <p id="filedrag" class="text-center" onclick="document.getElementById('fileselect').click();">
                  <img id="ImgCargando" class="ImgCargando fa fa-user-o big-icon" />
                </p>
                <input type="file" accept="image/*" id="fileselect" name="fileselect[]" style="display:none;"/>
                <div id="progress"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal-footer">
  <button type="submit" class="btn btn-w-m btn-primary" onclick="guardarProducto();"  >Guardar</button>
  <button type="button" class="btn btn-w-m btn-danger" data-dismiss="modal">Cerrar</button>
</div>
</form>

<script type="text/javascript">
  var TbProductoFormulaCuerpo = $('#TbProductoFormula tbody');
  var SelProductoInsumo = $("#SelProductoInsumo");
  var TxtProductoCantidad = $("#TxtProductoCantidad");
  var BtnAgregarProducto = $("#BtnAgregarProducto");
  var SelProductoTipoConsulta = $("#SelProductoTipoConsulta");
  var SelProductoTipo = $("#SelProductoTipo");
  var ChkComision =$('#ChkComision');
  var TxtComisionImporte = $('#TxtComisionImporte');
  var FrmProducto = $('#FrmProducto');
  
  var CodProductoGeneral;
  var CodUsuario = '<?php echo $CodUsuario;?>';
  var RutaProyecto = '<?php echo $RutaProyecto;?>';
  //
  $(document).ready(function(){
    listaProductos();
    getUnidadMedida();
    SelProductoTipoConsulta.change(function() {
      listaProductos();
    });
    ChkComision.change(function (){
      var EstadoCheckComision = 0;
      EstadoCheckComision = $(this).is(":checked");
      if (EstadoCheckComision == true) {
        TxtComisionImporte.removeAttr('readonly').focus();
      } else {
        TxtComisionImporte.attr('readonly', 'readonly').val('');
      }
    });
  });

function listaProductos(fecha){
  var CodProductoTipo = SelProductoTipoConsulta.val();
  var parametros = CodProductoTipo;
  var indice = 10;
  var nomproc = "ProcProducto";

  $.post(URL_BASE+'Registros/procGeneral', {parametros: parametros,
                                          indice: indice,nombreProcedimiento:nomproc}, function (respuesta) {
  $('#tbproductos tbody').empty();
  var htmlStrTabla = '';
  var cantidadProductos = respuesta.length;

  $.each(respuesta,function(i){
    htmlStrTabla += '<tr data-codproducto="'+ this.CodProducto+'" data-nomproducto="' + this.NomProducto + '">'+
          '<td>' + (i+1) + '</td>'+
          '<td>' + this.NomProductoExistencia + '</td>'+
          '<td>' + this.CodigoProducto + '</td>'+
          '<td>' + this.NomProducto + '</td>'+
          '<td style="text-align:right;">' + this.PrecioCosto + '</td>'+
          '<td style="text-align:right;" >' + this.PrecioVenta + '</td>'+
          '<td  style="text-align:right;" >' + this.StockMinimo + '</td>'+
          '<td  style="text-align:right;" >' + this.NombreCategoria+ '</td>'+
          '<td  style="text-align:right;" >' + this.NomProductoUM+ '</td>'+
          '<td  style="text-align:right;" >' + (this.Comision == 1 ? this.ComisionImporte : '--') + '</td>' +
          '<td>' +
            '<button '+
            ' data-cod="'+this.CodProducto+'" '+
            ' data-codigo="'+this.CodigoProducto+'" '+
            ' data-nombre="'+this.NomProducto+'" '+
            ' data-pcosto="'+this.PrecioCosto+'" '+
            ' data-pventa="'+this.PrecioVenta+'" '+
            ' data-comision="'+ this.Comision +'" '+
            ' data-stockmin="'+this.StockMinimo +'" '+
            ' data-codcategoria="'+this.CodProductoCategoria+'" '+
            ' data-codproductoum = "' + this.CodProductoUM + '" ' +
            ' data-codproductoexistencia = "' + this.CodProductoExistencia + '" ' +
            ' data-comisionimporte = "' + this.ComisionImporte + '" ' +
            ' data-rutaimagen = "' + this.RutaImagen + '" ' +
            ' type="button" class="btn btn-warning btn-xs" onclick="actualizarProducto($(this))"><i class="fa fa-edit"></i></button>' +
            '&nbsp;&nbsp;'+
            '<button type="button" class="btn btn-danger btn-xs" onclick="abrirmodalConfirmacion('+ this.CodProducto +')" ><i class="fa fa-trash"></i></button>' +
            '&nbsp;&nbsp;';
    if (this.CodProductoExistencia == 4) {
      htmlStrTabla += '<button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#ModalVerFormula" onclick="VerFormula(' + this.CodProducto + ', this.parentNode.parentNode)"><i class="fa fa-check"></i></button>' +
          '</td>';
    }
    htmlStrTabla += '</tr>';
    
  })
  $('#tbproductos tbody').append(htmlStrTabla);
  $('#cantProductos').text(cantidadProductos);
    //$.notify(respuesta[0].DesResultado,(respuesta[0].CodResultado == 1  ? "success" : "error" ) );
  toastr.success('Registros cargados correctamente', 'Nota')
  },"JSON");
}
function ComboProducto() {
  var CodProducto = CodProductoGeneral;
  var Procedimiento = 'ProcProductoFormula';
  var Parametros = CodProducto;
  var Indice = 11;
  var URL = URL_BASE +'Registros/procGeneral';
  var Data = {
    parametros: Parametros,
    indice: Indice,
    nombreProcedimiento: Procedimiento
  };
  SelProductoInsumo.empty();
  $.post(URL, Data, function (Data) {
    var OptionHTML = '';
    //
    $.each(Data, function(i) {
      OptionHTML += '<option value="' + this.CodProducto +'" >' + this.NomProducto + '</option>';
    });
    SelProductoInsumo.append(OptionHTML);
    SelProductoInsumo.selectpicker("refresh");
  },'JSON');
}
function VerFormula(CodProducto, Fila) {
  CodProductoGeneral = CodProducto;
  var NomProducto = $(Fila).data('nomproducto');
  //
  $('#TxtNomProducto').val(NomProducto);
  ListarProductoFormula();
  ComboProducto();
}
function ListarProductoFormula() {
  var Procedimiento = 'ProcProductoFormula';
  var Parametros = CodProductoGeneral;
  var Indice = 10;
  var URL = URL_BASE + 'Registros/procGeneral';
  var Data = {
    parametros: Parametros,
    indice: Indice,
    nombreProcedimiento: Procedimiento
  };
  //
  TbProductoFormulaCuerpo.empty();
  //
  $.post(URL, Data, function (Data) {
    var FilasHTML = '';
    //
    $.each(Data, function(i) {
      FilasHTML += '<tr>'+
        '<td>' + (i + 1) + '</td>'+
        '<td>' + this.Insumo  + '</td>'+
        '<td>' + this.NomProductoUM + '</td>'+
        '<td>' + this.Cantidad + '</td>'+
        '<td><button type="button" class="btn btn-danger btn-xs" onclick="EliminarProductoInsumo('+ this.CodProductoFormula +')" ><i class="fa fa-trash"></i></button></td>'+
      '</tr>';
    });
    TbProductoFormulaCuerpo.append(FilasHTML);
    //
  }, "JSON");
}
function EliminarProductoInsumo(CodProductoFamilia) {
  var Procedimiento = 'ProcProductoFormula';
  var Parametros = CodProductoFamilia + '|' + CodUsuario;
  var Indice = 40;
  var URL = URL_BASE + 'Registros/procGeneral';
  var Data = {
    parametros: Parametros,
    indice: Indice,
    nombreProcedimiento: Procedimiento
  };
  $.post(URL, Data, function (Data) {
    //
    var CodResultado = Data[0].CodResultado,
        DesResultado = Data[0].DesResultado;
    //
    if (CodResultado == 1) {
      // $('#BtnCerrar').trigger('click');
      ListarProductoFormula();
      ComboProducto();
      // Limpia
      toastr.success(DesResultado, 'Éxito');
    } else {
      toastr.success(DesResultado, 'Error');
    }
  },'JSON');
}
function AgregarProductoInsumo() {
  var Procedimiento = 'ProcProductoFormula';
  var CodProductoInsumo = SelProductoInsumo.val();
  var Cantidad = TxtProductoCantidad.val();
  if (CodProductoInsumo == null) { return; }
  if (Cantidad == '') {
    toastr.success('Ingresar cantidad', 'Error');
    TxtProductoCantidad.focus();
    return;
  }
  var Parametros = CodProductoGeneral + '|' + CodProductoInsumo + '|' + Cantidad + '|' + CodUsuario;
  var Indice = 20;
  var URL = URL_BASE + 'Registros/procGeneral';
  var Data = {
    parametros: Parametros,
    indice: Indice,
    nombreProcedimiento: Procedimiento
  };
  BtnAgregarProducto.attr("disabled", true);
  $.post(URL, Data, function (Data) {
    //
    var CodResultado = Data[0].CodResultado,
        DesResultado = Data[0].DesResultado;
    //
    if (CodResultado == 1) {
      // $('#BtnCerrar').trigger('click');
      ListarProductoFormula();
      ComboProducto();
      // Limpia
      toastr.success(DesResultado, 'Éxito');
    } else {
      toastr.success(DesResultado, 'Error');
    }
    // Habilita botón
    BtnAgregarProducto.removeAttr("disabled");
  },'JSON');
}
function getUnidadMedida(){
 var parametros = '';
 var indice = 18;
 var nomproc = "ProcProducto";
 $.post(URL_BASE+'Registros/procGeneral', {parametros: parametros,
                                           indice: indice,nombreProcedimiento:nomproc}, function (respuesta) {

                                             $('#selectUnidadMedida').empty();
                                             $.each(respuesta,function(){
                                               $('#selectUnidadMedida').append('<option value="'+this.CodProductoUM+'">'+this.NomProductoUM+'</option>');
                                             });
                                           },"JSON");
}
function getCorrelativoCodigo(){

  var parametros = '';
  var indice = 17;
  var nomproc = "ProcProducto";

  $.post(URL_BASE + 'Registros/procGeneral', {parametros: parametros,
    indice: indice, nombreProcedimiento:nomproc}, function (respuesta) {
    //
    var correlativoproducto = respuesta[0].CodigoProducto;
    var CodProductoExistencia = SelProductoTipoConsulta.val();
    //
    $('#txtcodigo').val(correlativoproducto);
    
    $('#etiquetamodal').text("Registrar producto.");
    $('#etiquetamodal').attr("data-tipomodal",'registra');
    SelProductoTipoConsulta.attr("data-tipomodal",'registra');
    if (CodProductoExistencia != 0) {
      SelProductoTipo.val(CodProductoExistencia);  
    }
    $('#modalProducto').modal('show');
  },"JSON");

}
function abrirDialogRegistra(){
  getCorrelativoCodigo();
}
function guardarProducto(){
  var codigoProducto  = $('#txtcodigo').val();
  var nombreProducto  = $('#txtnombre').val();
  var pcostoProducto  = $('#txtpcosto').val();
  var pventaProducto  = $('#txtpventa').val();
  var stockminProducto  = $('#txtstockmin').val();
  var categoria  = $('#selectCategoria').val();
  var unidmedida  = $('#selectUnidadMedida').val();
  var CodProductoExistencia  = $('#SelProductoTipo').val();
  var ComisionImporte = (TxtComisionImporte.val() == '' ? 0 : TxtComisionImporte.val());
  var EstadoCheckComision = (ChkComision.is(":checked") == true ? 1 : 0);
  var RutaImagen = '';
  //
  if (EstadoCheckComision == 1) { // Verifica que el Input no esté vacio.
    if (ComisionImporte == ""){
      toastr.warning('Debe ingresar importe comisión!');
      TxtComisionImporte.focus();
      return;
    }
    if (parseFloat(ComisionImporte) > parseFloat(pventaProducto)) {
      toastr.warning('La comisión no puede ser mayor al P.Venta!');
      TxtComisionImporte.select().focus();
      return;
    }
  }
  if (codigoProducto == ""){
    toastr.warning('Debe ingresar un el código del producto!');
    $('#txtcodigo').focus();
    return;
  }

  if (nombreProducto == ""){
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

  if(tipomodal == 'modifica') {
    var codProducto = $('#etiquetamodal').attr("data-codproducto");
    parametros =  codProducto +'|'+
      codigoProducto + '|' +
      nombreProducto + '|' +
      pcostoProducto + '|' +
      pventaProducto + '|' +
      EstadoCheckComision + '|' +
      stockminProducto + '|' +
      categoria + '|' +
      unidmedida + '|' +
      RutaImagen + '|' +
      ComisionImporte;
  } else {
    parametros = codigoProducto + '|' +
      nombreProducto + '|' +
      pcostoProducto + '|' +
      pventaProducto + '|' +
      1 + '|' +
      EstadoCheckComision + '|' +
      stockminProducto + '|' +
      categoria + '|' +
      unidmedida + '|' +
      CodProductoExistencia + '|' +
      RutaImagen + '|' +
      ComisionImporte;
  }

  var indice = (tipomodal == 'modifica' ? 30 :20);
  var nomproc = "ProcProducto";

  $.post(URL_BASE + 'Registros/procGeneral', {
    parametros: parametros,
    indice: indice,
    nombreProcedimiento:nomproc
  }, function (respuesta) {
    var codresultado = Number(respuesta[0].CodResultado);
    var desresultado = respuesta[0].DesResultado;

    if(codresultado == 1){
      $('#modalProducto').modal('hide');
      toastr.success(desresultado, 'Éxito');
      //
      $('#txtnombre').val('');
      $('#txtpcosto').val('');
      $('#txtpventa').val('');
      ChkComision.prop("checked", false);
      $('#txtstockmin').val('');
      //
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
  var categoriamodifica =  element.attr('data-codcategoria');
  var CodProductoUM =  element.attr('data-codproductoum');
  var CodProductoExistencia =  element.attr('data-codproductoexistencia');
  var Comision =  element.attr('data-comision');
  var ComisionImporte =  element.attr('data-comisionimporte');
  var stockmin = element.attr('data-stockmin');
  var RutaImagen =  element.attr('data-rutaimagen');
  //
  $('#modalProducto').modal('show');
  $('#etiquetamodal').text("Modificar producto.");
  $('#etiquetamodal').attr("data-tipomodal",'modifica');
  $('#etiquetamodal').attr("data-codproducto",codproducto);
  //
  //
  $('#txtcodigo').val(codigo);
  $('#txtnombre').val(nombre);
  $('#txtpcosto').val(pcosto);
  $('#txtpventa').val(pventa);
  ChkComision.prop("checked",(Comision == 1? true:false));
  $('#txtstockmin').val(stockmin);
  $('#selectCategoria').val(categoriamodifica);
  $('#selectUnidadMedida').val(CodProductoUM);
  SelProductoTipo.val(CodProductoExistencia);
  TxtComisionImporte.val(ComisionImporte);
}
</script>

<script src="<?=base_url()?>assets/csoftcontent/js/SubirArchivo.js"></script>
