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
    max-height: 400px;
    overflow-y: auto;
    -ms-overflow-style: -ms-autohiding-scrollbar;
  }
  .table-wrapper-scroll-y table td {
    padding: 4px !important;
    vertical-align: middle !important;
  }
  .table-wrapper-scroll-y table td > input {
    text-align: right !important;
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
          <h2>(<strong id="cantidadRegistros">-</strong>) <?=$Titulo?>   </h2>
      
      </div>
      <div class="col-lg-4">

      </div>
  </div>


   <br>
   <div class="row wrapper border-bottom white-bg page-heading">
      <div class="col-lg-12">
        <br>
        <div class="table-responsive">
          <table class="table table-bordered" id="TbPendientesAnulacion">
            <thead>
              <tr>
                <th style="width:20px">N</th>
                <th>F. MOVIMIENTO</th>
                <th>PRODUCTO</th>
                <th>CANTIDAD</th>
                <th>CANT. NUEVA</th>
                <th>USUARIO</th>
                <th>MOTIVO PENDIENT</th>
                <th>ESTADO</th>
                <th>F. ANULACION</th>
                <th style="width:20px;"></th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
   </div>
</div>
<!-- Modal Guardar ProductoPendientesAnulacion-->
<div class="modal fade" id="DivProductoPendientesAnulacionModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document" style="width:750px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="ProductoPendientesAnulacionModalTitulo">Nueva PendientesAnulacion</h4>
      </div>
      <div class="modal-body">
        <div class="body">
          <div class="form-vertical">
            <div class="row clearfix">
              <div class="col-md-3 form-control-label">
                <label for="TxtNomProductoPendientesAnulacion">Nombre PendientesAnulacion</label>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <div class="form-line">
                    <input id="TxtNomProductoPendientesAnulacion" type="text" value="" class="form-control" required="">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="BtnGuardar" class="btn btn-w-m btn-primary" onclick="GuardarProductoPendientesAnulacion();">Guardar</button>
        <button type="button" id="BtnCerrar" class="btn btn-w-m btn-danger" data-dismiss="modal">Salir</button>
      </div>
      </div>
  </div>
</div>



<!-- Modal Confirmacion-->
<div class="modal fade" id="divModalElimina" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header ui-draggable-handle">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 style="font-weight:100" >Registrar anulación</h4>
        <input type="hidden" id="txtcodMovimientoAlmacen" />
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
            <button type="button" class="btn btn-w-m btn-primary" onclick="confirmarAnulacion();">SI</button>
            <button type="button" class="btn btn-w-m btn-danger" data-dismiss="modal">NO</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
//
  var TbProductoPendientesAnulacionCuerpo = $('#TbPendientesAnulacion tbody');
  var TxtNomProductoPendientesAnulacion = $("#TxtNomProductoPendientesAnulacion");
  var TxtDireccionProductoPendientesAnulacion = $("#TxtDireccionProductoPendientesAnulacion");
  var SelAlmacen = $("#SelAlmacen");
  var BtnGuardar = $("#BtnGuardar");
  var TxtMotivoAnulacion = $('#TxtMotivoAnulacion');
  var ProductoPendientesAnulacionModalTitulo = $('#ProductoPendientesAnulacionModalTitulo');
  var CodProductoPendientesAnulacionGeneral = 0;
  //
  var CodUsuario = '<?php echo $CodUsuario;?>';

  /********************* */

$(document).ajaxStart(function(event, jqXHR, settings) {
	$('#msjload').fadeIn();
});
$(document).ajaxComplete(function(event, jqXHR, settings) {
	$('#msjload').fadeOut();
});
$(document).ready(function(){
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
  //
  $('#BtnNuevo').click(function(){
    ProductoPendientesAnulacionModalTitulo.text('Registrar ProductoPendientesAnulacion');
  });
  //
  ListarPendientesAnulacion();
});
var CodUsuario = '<?php echo $CodUsuario;?>';
//
function ListarPendientesAnulacion() {

  if ( $.fn.DataTable.isDataTable('#TbPendientesAnulacion') ) {
    $('#TbPendientesAnulacion').DataTable().destroy();
  }
//   CALL ProcAlmacenMovimiento('0', 14);

  var Procedimiento = 'ProcAlmacenMovimiento';
  var Parametros = '0';
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
    
    //
    TbProductoPendientesAnulacionCuerpo.empty();
    var FilasHTML = '';
    var CantidadFilas = Data.length;

    //
    $.each(Data, function(i) {
      FilasHTML += '<tr  >' +
        '<td>' + (i + 1) + '</td>' +
        '<td>' + this.FechaAlmacenMovimiento + '</td>' +
        '<td>' + this.NomProducto + '</td>' +
        '<td>' + this.Cantidad + '</td>' +

        '<td>' + (this.CantidadNueva ? this.CantidadNueva: '' ) + '</td>' +
        '<td>' + this.NomUsuario + '</td>' +
        '<td>' + this.MotivoPendiente + '</td>' +
        '<td>' + this.NomEstado + '</td>' +
        '<td>' + this.FechaPendienteAnula + '</td>' +
        '<td>' +
          '<button data-codalmacenmovimiento="' + this.CodAlmacenMovimiento +'"  type="button"   class="btn btn-danger btn-xs" onclick="abrirModalElimina('+ this.CodAlmacenMovimiento +')" ><i class="fa fa-trash"></i></button>' +
        '</td>' +
      '</tr>';
    });
    TbProductoPendientesAnulacionCuerpo.append(FilasHTML);
    $('#cantidadRegistros').text(CantidadFilas);
    $('#TbPendientesAnulacion').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
    // toastr.success('Registros cargados correctamente', 'Nota')
  }, "JSON");
}

function abrirModalElimina(codMovimientoAlmacen){
  $('#txtcodMovimientoAlmacen').val(codMovimientoAlmacen);
  $('#divModalElimina').modal('show');
}

function confirmarAnulacion(){

  // CALL ProcAlmacenMovimiento('1|1|Error', 30);
  var MotivoAnulacion = $('#TxtMotivoAnulacion').val();
  if (MotivoAnulacion == '') {
    toastr.warning('Debe ingresar motivo!');
    TxtMotivoAnulacion.focus();
    return;
  }

  var codMovimientoAlmacen =  $('#txtcodMovimientoAlmacen').val();
  var indice = 30;
  var Procedimiento = 'ProcAlmacenMovimiento';
  var URL = URL_BASE + 'Almacen/ProcAlmacenMovimientoAnularTran';
  var Parametros = codMovimientoAlmacen + '|' + CodUsuario + '|' + MotivoAnulacion;
  var Data = {
    Parametros: Parametros,
    Indice: indice,
    Procedimiento: Procedimiento
  };

  $.post(URL, Data, function(Data) {
    var CodResultado = Data.CodResultado,
        DesResultado = Data.DesResultado;

    if (CodResultado == 1) {
      // $('#BtnCerrar').trigger('click');
      $('#divModalElimina').modal('hide');
      ListarPendientesAnulacion();
      // Limpia
      TxtMotivoAnulacion.val('');
      toastr.success(DesResultado, 'Éxito');
    } else {
      toastr.error(DesResultado, 'Error');
    }
  },'JSON');
}

function CodigoProductoPendientesAnulacion(CodProductoPendientesAnulacion) {
  CodProductoPendientesAnulacionGeneral = CodProductoPendientesAnulacion;
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
</script>

