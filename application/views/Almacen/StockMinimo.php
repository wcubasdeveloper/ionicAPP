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
                  <strong><?= str_replace("%20"," ",$Titulo);?></strong>
              </li>
          </ol>
          <h2>(<strong id="StnCantidadRegistros">-</strong>) Stock</h2>
      
      </div>
      <div class="col-lg-4">

      </div>
  </div>

  <div class="row wrapper border-bottom white-bg page-heading form-group">
    <label class="col-lg-2 col-form-label" style="padding-top: 26px;" >Seleccionar almacén</label>
    <div class="col-lg-2" style="padding-top: 17px;" >
      <select class="form-control" id="SelAlmacen"></select>
    </div>

    <div class="col-lg-8" style="padding-top: 17px;" >
      <button class="btn btn-sm btn-success pull-right m-t-n-xs" type="button" onclick="ConsultaStockMinimo()"><strong>Consulta</strong></button>
    </div>
  </div>


  <br>
  <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
      <br>
      <div class="table-responsive">
        <table class="table table-bordered" id="TbStockMinimo">
          <thead>
            <tr>
              <th>N</th>
              <th>ALMACÉN</th>
              <th>CATEGORIA</th>
              <th>CODIGO</th>
              <th>PRODUCTO</th>
              <th>F.ACTUALIZA</th>
              <th style="width:40px;text-align:right" >STOCK MIN</th>
              <th style="width:40px;text-align:right" >P.UNIT</th>
              <th style="width:40px;text-align:right" >STOCK ACT</th>
              <th style="width:40px;text-align:right" >TOTAL</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
            <tfoot>
              <tr>
                <th colspan="8" >TOTAL</th>
                <th id="txtTotalStockActual" >0</th>
                <th id="txtTotalTotal" >0.00</th>
              </tr>
            </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">

TbStockMinimoCuerpo = $('#TbStockMinimo tbody');
SelAlmacen = $('#SelAlmacen');
//
$(document).ajaxStart(function(event, jqXHR, settings) {
	$('#msjload').fadeIn();
});

$(document).ajaxComplete(function(event, jqXHR, settings) {
	$('#msjload').fadeOut();
});

$(document).ready(function(){
  ConsultaStockMinimo();
  ListaAlmacen();
});
var CodUsuario = '<?php echo $CodUsuario;?>';
//
function ConsultaStockMinimo() {

  if ( $.fn.DataTable.isDataTable('#TbStockMinimo') ) {
    $('#TbStockMinimo').DataTable().destroy();
  }

  var CodAlmacen = SelAlmacen.val();
  var Procedimiento = 'ProcProducto';
  var Parametros = CodAlmacen;
  var Indice = 14;
  var URL = URL_BASE + 'Registros/procGeneral';
  var Data = {
    parametros: Parametros,
    indice: Indice,
    nombreProcedimiento: Procedimiento
  };
  //
  $.post(URL, Data, function (Data) {
    //
    TbStockMinimoCuerpo.empty();
    var FilasHTML = '';
    var CantidadFilas = Data.length;
    //
    var totalStock =  0;
    var totalTotal = 0;
    $.each(Data, function(i) {
      var total = this.PrecioCosto * this.StockActual;
      total = total.toFixed(2);
      FilasHTML += '<tr>' +
        '<td>' + (i + 1) + '</td>' +
        '<td>' + this.NomAlmacen  + '</td>' +
        '<td>' + this.NomProductoCategoria  + '</td>' +
        '<td>' + this.CodigoProducto  + '</td>' +
        '<td>' + this.NomProducto + '</td>' +
        '<td class="text-right" >' + this.FechaActualizacion + '</td>' +
        '<td class="text-right" >' + this.StockMinimo + '</td>' +
        '<td class="text-right" >' + this.PrecioCosto + '</td>' +
        '<td class="text-right" >' + this.StockActual + '</td>' +
        '<td class="text-right" >' + total + '</td>' +
      '</tr>';

      totalStock += Number(this.StockActual);
      totalTotal += Number(total);
    });
    TbStockMinimoCuerpo.append(FilasHTML);
    $('#StnCantidadRegistros').text(CantidadFilas);
    $('#txtTotalStockActual').text(totalStock.toFixed(2));
    $('#txtTotalTotal').text(totalTotal.toFixed(2));
    $('#TbStockMinimo').DataTable( {
        "paging": false,
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );


    // toastr.success('Registros cargados correctamente', 'Nota')
  }, "JSON");
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
    var OptionHTML = '<option value="0">TODOS</option>';
    //
    $.each(Data, function(i) {
      OptionHTML += '<option value="' + this.CodAlmacen +'" >' + this.NomAlmacen + '</option>';
    });
    SelAlmacen.append(OptionHTML);
  },'JSON');
}
</script>

