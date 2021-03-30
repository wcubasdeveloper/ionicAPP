<link href="<?=base_url()?>assets/csoftcontent/js/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
<script src="<?=base_url()?>assets/csoftcontent/js/plugins/bootstrap-select/bootstrap-select.min.js"></script>
<link href="<?=base_url()?>assets/csoftcontent/js/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
<script src="<?=base_url()?>assets/csoftcontent/js/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="<?=base_url()?>assets/csoftcontent/js/plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script>
<script src="<?=base_url()?>assets/plugins/tablefilter/jquery.uitablefilter.js"></script>

<link href="<?=base_url()?>assets/plugins/datatables/datatables.min.css" rel="stylesheet" />
<script src="<?=base_url()?>assets/plugins/datatables/datatables.min.js"></script>

<?php
    $CodUsuario = $_SESSION['codusuario'];
    $RutaProyecto = base_url();
?>
<style>
  .ImgCargando{width:100%;height:140px;border:1px solid gray;cursor:pointer;}
  /* .ImgCargando:hover{border:2px solid #E7E7E7; } */
</style>
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
        <h2>(<strong id="cantProductos">-</strong>) <?=$Titulo?>  <i title="Agregar nuevo producto" onclick="abrirDialogRegistra();" style="cursor:pointer;color:#1ab394" class="fa fa-plus"></i> </h2>
     
    </div>
    <div class="col-lg-4">

    </div>
</div>


  <div class="row wrapper border-bottom white-bg page-heading form-group">
    <label class="col-lg-2 col-form-label" style="padding-top: 26px;" >Tipo Producto</label>
    <div class="col-lg-4" style="padding-top: 17px;" >
      <select id="SelProductoTipoConsulta" class="form-control">
        
      </select>  
    </div>


    <div class="col-lg-6" style="padding-top: 17px;" >
    </div>
  </div>

  <br>
  <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12 sectionProductos" >
      <br>
      <div class="table-responsive">
        <table class="table table-bordered" id="tbproductos">
          <thead>
            <tr>
              <th>N</th>
              <th>TIPO</th>
              <th>CÓDIGO</th>
              <th>MARCA</th>
              <th>NOMBRE</th>
              <th style="text-align:right;" >COSTO</th>
              <th style="text-align:right;" >VENTA</th>
              <th style="text-align:right;">STOCK MIN</th>
              <th style="text-align:right;">CAT</th>
              <th style="text-align:right;">U.MED</th>
              <th style="text-align:right;display:none;">COMISIÓN</th>
              <th style="width:40px;"></th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
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
      <div>
        <div>
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
  <div class="modal-dialog" role="document" style="min-width:80%;">
    <div class="modal-content">
      <div class="modal-header ui-draggable-handle">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 style="font-weight:100" id="etiquetamodal" data-codproducto="" data-tipomodal="" >-</h4>
      </div>
      <div id="ContenidoDialog">
        <div id="divCrearChip">
          <!-- <form id="FrmProducto" class="" enctype="multipart/form-data" method="post"> -->
            <div class="modal-body">

            <div class="tabs-container">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="active"><a class="nav-link active" data-toggle="tab" href="#tab-1">Información</a></li>
                            <li style="display:none;"><a class="nav-link" data-toggle="tab" href="#tab-2">Presentación</a></li>
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" id="tab-1" class="tab-pane active">
                                <div class="panel-body">
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
                                              <input id="txtcodigo"  onkeypress="return Util.SoloNumero(event, this);"  type="text" value="" class="form-control" required="">
                                            </div>
                                          </div>
                                        </div>
                                      </div>

                                      <div class="row clearfix">
                                        <div class="col-md-4 form-control-label">
                                          <label for="txtRubroProducto">Rubro:</label>
                                        </div>
                                        <div class="col-md-8">
                                          <div class="form-group">
                                            <div class="form-line">
                                              <select id="selectRubro" onchange="cambioRubro();" class="form-control" >
                                                
                                              </select>
                                            </div>
                                          </div>
                                        </div>
                                      </div>


                                      <div class="row clearfix" hidden>
                                        <div class="col-md-4 form-control-label">
                                          <label for="TxtCodigoBarra">Código Barras:</label>
                                        </div>
                                        <div class="col-md-8">
                                          <div class="form-group">
                                            <div class="form-line">
                                              <input id="TxtCodigoBarra" type="text" value="" class="form-control" required="">
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
                                               
                                              </select>
                                            </div>
                                          </div>
                                        </div>
                                      </div>

                                      <div class="row clearfix">
                                        <div class="col-md-4 form-control-label">
                                          <label for="SelProductoTipo">Marca:</label>
                                        </div>
                                        <div class="col-md-8">
                                          <div class="form-group">
                                            <div class="form-line">
                                              <select id="selectMarcaProducto" class="form-control m-b">
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
                                              <form id="FrmProductoSubirImagen" class="" enctype="multipart/form-data" method="post">
                                                <p id="filedrag" class="text-center" onclick="document.getElementById('FileImagenProducto').click();">
                                                  <img id="ImgCargando" class="ImgCargando"/>
                                                </p>
                                                <input type="file" accept="image/png,image/gif,image/jpeg" id="FileImagenProducto" name="file" style="display:none;"/>
                                                <div id="progress"></div>
                                                <button type="submit" class="btn btn-w-m btn-primary" >Subir Imagen</button>
                                              </form>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row clearfix">
                                    <div class="col-md-2 form-control-label">
                                      <label for="txtnombre">Nombre:</label>
                                    </div>
                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <div class="form-line">
                                          <input id="txtnombre"  type="text" value="" class="form-control" required="" >
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row clearfix">
                                    <div class="col-md-6">
                                      <div class="row clearfix">
                                        <div class="col-md-4 form-control-label">
                                          <label for="txtpcosto">P.Costo:</label>
                                        </div>
                                        <div class="col-md-8">
                                          <div class="form-group">
                                            <div class="form-line">
                                              <input id="txtpcosto" onkeypress="return Util.SoloDecimal(event, this);"  type="text" value="" class="form-control" required="" >
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>

                                    <div class="col-md-4" hidden >
                                      <div class="row clearfix">
                                        <div class="col-md-6 form-control-label">
                                          <label for="txtpventa">P.Venta(Inc.IGV):</label>
                                        </div>
                                        <div class="col-md-6">
                                          <div class="form-group">
                                            <div class="form-line">
                                              <input id="txtpventa" onkeypress="return Util.SoloDecimal(event, this);"  type="text" value="" class="form-control" required="" >
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>

                                    <div class="col-md-4" hidden >

                                      <div class="row clearfix">
                                        <div class="col-md-5 form-control-label">
                                          <label for="ChkComision">Comisión:</label>
                                        </div>
                                        <div class="col-md-1">
                                          <div class="form-group">
                                            <div class="form-line">
                                              <input type="checkbox" id="ChkComision">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-md-5">
                                          <div class="form-group">
                                            <div class="form-line">
                                              <input id="TxtComisionImporte" onkeypress="return Util.SoloDecimal(event, this);"  type="text" value="" class="form-control" readonly>
                                            </div>
                                          </div>
                                        </div>
                                      </div>

                                    </div>
                                  </div>
                                  <div class="row clearfix">
                                    <div class="col-md-2 form-control-label">
                                      <label for="txtstockmin">Stock Min:</label>
                                    </div>
                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <div class="form-line">
                                          <input id="txtstockmin"  type="text" onkeypress="return Util.SoloNumero(event, this);" value="" class="form-control" required="" >
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                </div>
                        </div>

                            <div role="tabpanel" id="tab-2" class="tab-pane" style="display:none;">
                                <div class="panel-body">
                                  <div class="row clearfix">
                                      <div class="col-md-2 form-control-label">
                                        <label for="txtCantidadPresentacion">Cantidad :</label>
                                      </div>

                                      <div class="col-md-3">
                                        <div class="form-group">
                                          <div class="form-line">
                                            <input id="txtCantidadPresentacion" onkeypress="return Util.SoloDecimal(event, this);"  type="text" value="" class="form-control" required="" >
                                          </div>
                                        </div>
                                      </div>

                                  </div>

                                  <div class="row clearfix">
                                      <div class="col-md-2 form-control-label">
                                        <label for="txtUMPresentacion">U.Medida :</label>
                                      </div>

                                      <div class="col-md-3">
                                        <div class="form-group">
                                          <div class="form-line">
                                            <select class="form-control m-b" name="" id="txtUMPresentacion" >
                                            </select>
                                          </div>
                                        </div>
                                      </div>

                                  </div>

                                </div>
                            </div>
                        </div>
            </div>
              

            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-w-m btn-primary" onclick="guardarProducto();" >Guardar</button>
              <button type="button" class="btn btn-w-m btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
          <!-- </form> -->
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal Formula-->
<div class="modal fade" id="ModalVerFormula" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header ui-draggable-handle">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 style="font-weight:100" id="etiquetamodal" data-codproducto="" data-tipomodal="" >-</h4>
      </div>
      <div class="modal-body">
        <div class="body">
          <form class="form-vertical">
            <div class="row clearfix">
              <div class="col-md-3 form-control-label">
                <label for="">Producto:</label>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <div class="form-line">
                    <input id="TxtNomProducto" disabled="disabled" type="text" class="form-control">
                  </div>
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-md-8">
                <div class="form-group">
                  <div class="form-line">
                    <select id="SelProductoInsumo" data-live-search="true"></select>
                  </div>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <div class="form-line">
                    <input id="TxtProductoCantidad" type="text" onkeypress="return Util.SoloDecimal(event, this);" class="form-control">
                    <span id="spanUMPresentacion"></span>
                  </div>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <div class="form-line">
                    <button id="BtnAgregarProducto" class="btn btn-sm btn-primary pull-right m-t-n-xs" type="button" onclick="AgregarProductoInsumo()"><strong>Agregar</strong></button>
                  </div>
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-md-12">
                <div class="form-group">
                  <table class="table table-bordered" id="TbProductoFormula">
                    <thead>
                      <tr>
                        <th class="col-md-1">N</th>
                        <th class="col-md-6">PRODUCTO</th>
                        <th class="col-md-2">UM</th>
                        <th class="col-md-2">CANTIDAD</th>
                        <th class="col-md-2">UM PRES.</th>
                        <th class="col-md-2">CANT. PRESENTACION</th>
                        <th class="col-md-1"></th>
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
        <button type="button" class="btn btn-w-m btn-primary" >Guardar</button>
        <button type="button" class="btn btn-w-m btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

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
  var FrmProductoSubirImagen = $('#FrmProductoSubirImagen');
  var TxtCodigoBarra = $('#TxtCodigoBarra');
  
  var CodProductoGeneral;
  var CodUsuario = '<?php echo $CodUsuario;?>';
  var RutaProyecto = '<?php echo $RutaProyecto;?>';
  //
  
  $(document).ready(function(){
    // $('#txtBuscar').keyup(function () {
    //   $.uiTableFilter($('#tbproductos'), this.value);
    // });
    getSelectRubro();
    getTipoExistencia();
    getMarcaProducto();
    listaProductos();
    getUnidadMedida();
    //cargarUnidadMedidaPresentacion();
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
    FrmProductoSubirImagen.submit(function(e){
      e.preventDefault();
      SubirImagen(this);
    });
  });
function SubirImagen(Form){
  // $('#file').val() > 0
  if ($('#FileImagenProducto').val() == '') {
    toastr.warning('Seleccionar imagen!');
    return;
  }
  var URL = URL_BASE + 'Registros/SubirImagenProducto';
  var formData = new FormData(Form);
  formData.append('CodProducto', CodProductoGeneral);
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
      // console.log(data);
      // return;
      Data = JSON.parse(data);
      var CodResultado = Data[0].CodResultado,
          DesResultado = Data[0].DesResultado;
      //
      if (CodResultado == 1) {
        listaProductos();
        //
        toastr.success(DesResultado, 'Éxito');
      } else {
        toastr.error(DesResultado, 'Error');
      }
    }
  });
}

function getMarcaProducto(){
  $('#selectMarcaProducto').empty();

  var Procedimiento = 'ProcProductoMarca';
  var Parametros = '';
  var Indice = 11;
  var URL = URL_BASE + 'Registros/procGeneral';
  var Data = {
    parametros: Parametros,
    indice: Indice,
    nombreProcedimiento: Procedimiento
  };
  //
  $.post(URL, Data, function (Data) {
    //
    //
    var OptionHTML = '';
    //
    $.each(Data, function(i) {
      OptionHTML += '<option  value="' + this.CodProductoMarca +'" >' + this.NomProductoMarca + '</option>';
    });
    $('#selectMarcaProducto').append(OptionHTML);
    // toastr.success('Registros cargados correctamente', 'Nota')
  }, "JSON");

}

function listaProductos(fecha){


  if ( $.fn.DataTable.isDataTable('#tbproductos') ) {
    $('#tbproductos').DataTable().destroy();
  }

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
          '<td>' + this.NomProductoMarca + '</td>'+
          '<td>' + this.NomProducto + '</td>'+
          '<td style="text-align:right;">' + this.PrecioCosto + '</td>'+
          '<td style="text-align:right;" >' + this.PrecioVenta + '</td>'+
          '<td  style="text-align:right;" >' + this.StockMinimo + '</td>'+
          '<td  style="text-align:right;" >' + this.NombreCategoria+ '</td>'+
          '<td  style="text-align:right;" >' + this.NomProductoUM+ '</td>'+
          '<td  style="text-align:right;display:none;" >' + (this.Comision == 1 ? this.ComisionImporte : '--') + '</td>' +
          '<td>' +
            '<button '+
            ' data-cod="'+this.CodProducto+'" '+
            ' data-codigo="'+this.CodigoProducto+'" '+
            ' data-nombre="'+this.NomProducto+'" '+
            ' data-pcosto="'+this.PrecioCosto+'" '+
            ' data-pventa="'+this.PrecioVenta+'" '+
            ' data-codproductomarca="'+this.CodProductoMarca+'" '+
            ' data-comision="'+ this.Comision +'" '+
            ' data-codproductorubro="'+this.CodProductoRubro+'" '+

            ' data-stockmin="'+this.StockMinimo +'" '+
            ' data-codcategoria="'+this.CodProductoCategoria+'" '+
            ' data-codproductoum = "' + this.CodProductoUM + '" ' +
            ' data-codproductoexistencia = "' + this.CodProductoExistencia + '" ' +
            ' data-comisionimporte = "' + this.ComisionImporte + '" ' +
            ' data-rutaimagen = "' + this.RutaImagen + '" ' +
            ' data-codigobarra = "' + this.CodigoBarra + '" ' +
            ' data-codigoumpresentacion = "' + this.CodProductoUMPresentacion + '" ' +
            ' data-cantidadpresentacion = "' + this.CantidadPresentacion + '" ' +
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

  // $('#tbproductos').DataTable();

  $('#tbproductos').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );

  $('.sectionProductos').find('input').attr('placeholder','Nombre del producto')
  
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
      OptionHTML += '<option  data-umpresentacion="'+ this.Abreviatura+'" value="' + this.CodProducto +'" >' + this.NomProducto + '</option>';
    });
    SelProductoInsumo.append(OptionHTML);
    SelProductoInsumo.selectpicker("refresh");
    /*
    var umPresentacion = $('#SelProductoInsumo').find(':selected').data('data-umpresentacion');
    console.log("UMPRESENTACION", umPresentacion);
    */
  },'JSON');
}

function setUnidadMedidaPresentacion(elemento){
  console.log(elemento.find(':selected').data('data-umpresentacion'));
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
        '<td>' + this.NomProductoUMPresentacion + '</td>'+
        '<td>' + this.CantidadPresentacion + '</td>'+
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
      toastr.error(DesResultado, 'Error');
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
      toastr.error(DesResultado, 'Error');
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

function limpiarInputProducto(){
  $('#TxtCodigoBarra').val('');
  $("#selectCategoria").val($("#selectCategoria option:first").val());
  $("#selectUnidadMedida").val($("#selectUnidadMedida option:first").val());
  $("#SelProductoTipo").val($("#SelProductoTipo option:first").val());
  
  $('#txtnombre').val('');
  $('#txtpcosto').val('');
  $('#txtpventa').val('');
  $('#ChkComision').prop('checked', false);
  $('#TxtComisionImporte').val('0.00');
  $('#txtCantidadPresentacion').val('0.00');
  $('#txtUMPresentacion').val(0);
  

}

function getCorrelativoCodigo(){
  limpiarInputProducto();
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
  $('#SelProductoTipo').empty();
  $("#SelProductoTipoConsulta option").clone().appendTo("#SelProductoTipo");
  $('#SelProductoTipo option[value="0"]').remove();

  var URL = URL_BASE + 'Registros/procGeneral';
  var Procedimiento = "ProcProductoRubro";
  var abrevRubro = $('#selectRubro').find(':selected').attr('data-abrevrubro');
  //
  $.post(URL, {
    parametros: abrevRubro,
    indice: 11,
    nombreProcedimiento: Procedimiento
  }, function (respuesta) {
    //
    var codigoProducto = '';
    if(respuesta.length > 0){
      codigoProducto = respuesta[0].CodigoProducto;
    }
    //
    //
    $('#txtcodigo').val(codigoProducto);
    $('#modalProducto').modal('show');
  },'JSON'); 

  
  //getCorrelativoCodigo();
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
  var CodigoBarra = TxtCodigoBarra.val();
  var CantidadPresentacion = $('#txtCantidadPresentacion').val();
  var UMPresentacion = $('#txtUMPresentacion').val();
  var RutaImagen = '';
  var marcaProducto = $('#selectMarcaProducto').val();
  var rubroProducto = $('#selectRubro').val();
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

  // if(pventaProducto == ""){
  //   toastr.warning('Debe ingresar un el precio de venta del producto!');
  //   $('#txtpventa').focus();
  //   return;
  // }

  if(stockminProducto == ""){
    toastr.warning('Debe ingresar un el stock min del producto!');
    $('#txtstockmin').focus();
    return;
  }

  var tipomodal = $('#etiquetamodal').attr('data-tipomodal');
  var Parametros = '';

  if(tipomodal == 'modifica') {
    var codProducto = $('#etiquetamodal').attr("data-codproducto");
    Parametros =  codProducto +'|'+
      codigoProducto + '|' +
      nombreProducto + '|' +
      pcostoProducto + '|' +
      pventaProducto + '|' +
      EstadoCheckComision + '|' +
      stockminProducto + '|' +
      categoria + '|' +
      unidmedida + '|' +
      RutaImagen + '|' +
      ComisionImporte + '|' +
      CodigoBarra + '|' + 
      CantidadPresentacion + '|' + 
      UMPresentacion + '|' + marcaProducto ;
  } else {

    Parametros = codigoProducto + '|' +
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
      ComisionImporte + '|' +
      CodigoBarra + '|' + 
      CantidadPresentacion + '|' + 
      UMPresentacion + '|' + 
      marcaProducto + '|' + 
      rubroProducto;
  }

  var URL = URL_BASE + 'Registros/procGeneral';
  var Procedimiento = "ProcProducto";
  var Indice = (tipomodal == 'modifica' ? 30 :20);
  //

  $.post(URL, {
    parametros: Parametros,
    indice: Indice,
    nombreProcedimiento: Procedimiento
  }, function (respuesta) {
    var codresultado = Number(respuesta[0].CodResultado);
    var desresultado = respuesta[0].DesResultado;
    //
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
  CodProductoGeneral = codproducto;
  var codigo = element.attr('data-codigo');
  var nombre = element.attr('data-nombre');
  var codProductoMarca = element.attr('data-codproductomarca');
  var pcosto = element.attr('data-pcosto');
  var pventa = element.attr('data-pventa');
  var categoriamodifica =  element.attr('data-codcategoria');
  var CodProductoUM = element.attr('data-codproductoum');
  var CodProductoExistencia = element.attr('data-codproductoexistencia');
  var Comision = element.attr('data-comision');
  var ComisionImporte = element.attr('data-comisionimporte');
  var stockmin = element.attr('data-stockmin');
  var RutaImagen = element.attr('data-rutaimagen');
  var CodigoBarra = element.attr('data-codigobarra');
  var CantidadPresentacion = element.attr('data-cantidadpresentacion');
  var CodProductoUMPresentacion = element.attr('data-codigoumpresentacion');
  var codProductoRubro = element.attr('data-codproductorubro');
  //
  $('#modalProducto').modal('show');
  $('#etiquetamodal').text("Modificar producto.");
  $('#etiquetamodal').attr("data-tipomodal",'modifica');
  $('#etiquetamodal').attr("data-codproducto",codproducto);
  //
  $('#txtcodigo').val(codigo);
  $('#txtnombre').val(nombre);
  $('#txtpcosto').val(pcosto);
  $('#txtpventa').val(pventa);
  ChkComision.prop("checked",(Comision == 1? true:false));
  $('#txtstockmin').val(stockmin);
  $('#selectCategoria').val(categoriamodifica);
  $('#selectUnidadMedida').val(CodProductoUM);
  $('#selectMarcaProducto').val(codProductoMarca);
  $('#selectRubro').val(codProductoRubro);
  
  

  SelProductoTipo.val(CodProductoExistencia);
  TxtComisionImporte.val(ComisionImporte);
  var t = new Date(); 
  if (!RutaImagen == '') {
    $('#ImgCargando').attr('src', RutaProyecto + 'assets/images/' + RutaImagen + '?t=' + t.getTime());
  } else {
    $('#ImgCargando').attr('src', RutaProyecto + 'assets/images/ArticuloSinImagen.png');
  }
  TxtCodigoBarra.val(CodigoBarra);
  $('#txtCantidadPresentacion').val(CantidadPresentacion);
  $('#txtUMPresentacion').val(CodProductoUMPresentacion);
}

function cargarUnidadMedidaPresentacion(){

  var URL = URL_BASE + 'Registros/procGeneral';
  var Procedimiento = "ProcProductoFormula";
  //
  $.post(URL, {
    parametros: '',
    indice: 12,
    nombreProcedimiento: Procedimiento
  }, function (respuesta) {
    $('#txtUMPresentacion').empty();
    $.each(respuesta, function(){
      $('#txtUMPresentacion').append('<option value="'+this.CodProductoUM+'">'+ this.NomProductoUM+'</option>');
    });
    $('#txtUMPresentacion').append('<option value="0" selected >'+ '-- Seleccionar UM ---' +'</option>');
  },'JSON');  
}


function getSelectRubro(){

  var URL = URL_BASE + 'Registros/procGeneral';
  var Procedimiento = "ProcProductoRubro";
  //
  $.post(URL, {
    parametros: '',
    indice: 10,
    nombreProcedimiento: Procedimiento
  }, function (respuesta) {
    $('#selectRubro').empty();
    //
    $.each(respuesta, function(){
      $('#selectRubro').append('<option value="'+ this.CodProductoRubro +'" data-abrevrubro="'+ this.AbrevProductoRubro + '" value="'+this.CodProductoUM+'">'+ this.NomProductoRubro +'</option>');
    });
    consultarCodigoProducto();
    //
  },'JSON');  

}


function  consultarCodigoProducto(){
  var URL = URL_BASE + 'Registros/procGeneral';
  var Procedimiento = "ProcProductoRubro";
  var abrevRubro = $('#selectRubro').find(':selected').attr('data-abrevrubro');
  //
  $.post(URL, {
    parametros: abrevRubro,
    indice: 11,
    nombreProcedimiento: Procedimiento
  }, function (respuesta) {
    //
    var codigoProducto = '';
    if(respuesta.length > 0){
      codigoProducto = respuesta[0].CodigoProducto;
    }
    //
    //
    $('#txtcodigo').val(codigoProducto);
  },'JSON'); 
}

function cambioRubro(){
  var URL = URL_BASE + 'Registros/procGeneral';
  var Procedimiento = "ProcProductoRubro";
  var abrevRubro = $('#selectRubro').find(':selected').attr('data-abrevrubro');
  //
  $.post(URL, {
    parametros: abrevRubro,
    indice: 11,
    nombreProcedimiento: Procedimiento
  }, function (respuesta) {
    //
    var codigoProducto = '';
    if(respuesta.length > 0){
      codigoProducto = respuesta[0].CodigoProducto;
    }
    //
    $('#modalProducto').modal('show');
    $('#txtcodigo').val(codigoProducto);
  },'JSON'); 
}

function getTipoExistencia(){

  var URL = URL_BASE + 'Registros/procGeneral';
  var Procedimiento = "ProcProductoExistencia";
  //
  $.post(URL, {
    parametros: '',
    indice: 11,
    nombreProcedimiento: Procedimiento
  }, function (respuesta) {
    //
    $('#SelProductoTipoConsulta').empty();
    $.each(respuesta, function(){
      $('#SelProductoTipoConsulta').append('<option value="'+this.CodProductoExistencia+'">'+ this.NomProductoExistencia+'</option>');
    });
    $('#SelProductoTipoConsulta').append('<option value="0" selected >'+ '-- Todos ---' +'</option>');
  },'JSON');  
}
</script>

<script src="<?=base_url()?>assets/csoftcontent/js/SubirArchivo.js"></script>
