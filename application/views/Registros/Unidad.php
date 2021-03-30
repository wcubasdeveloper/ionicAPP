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
          <h2>(<strong id="cantUnidad">-</strong>) <?=$Titulo?>  <i title="Agregar nuevo "  style="cursor:pointer;color:#1ab394" onclick="abrirModalGuardar();" class="fa fa-plus"></i> </h2>
      
      </div>
      <div class="col-lg-4">

      </div>
  </div>


   <br>
   <div class="row wrapper border-bottom white-bg page-heading">
      <div class="col-lg-12">
        <br>
        <div class="table-responsive">
          <table class="table table-bordered" id="TbUnidadGestion">
            <thead>
              <tr>
                <th style="width:20px">N</th>
                <th>PADRON</th>
                <th>PLACA</th>
                <th>PROPIETARIO</th>
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
<!-- Modal Guardar Unidad-->
<div class="modal fade" id="DivUnidadModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document" style="width:750px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="UnidadModalTitulo">Nueva unidad</h4>
      </div>
      <div class="modal-body">
        <div class="body">
          <div class="form-vertical">

            <div class="row clearfix">
              
              <div class="col-md-3 form-control-label">
                <label for="txtPadron">Padrón</label>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <div class="form-line">
                    <input id="txtPadron" type="text" value="" class="form-control" required="">
                  </div>
                </div>
              </div>

              <div class="col-md-3 form-control-label">
                <label for="txtUnidad">Unidad</label>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <div class="form-line">
                    <input id="txtUnidad" type="text" value="" maxlength="7" class="form-control" required="">
                  </div>
                </div>
              </div>

            </div>

            <div class="row clearfix">
              
              <div class="col-md-3 form-control-label">
                <label for="txtPropietario">Propietario</label>
              </div>
              <div class="col-md-5">
                <div class="form-group">
                  <div class="form-line">
                    <input id="txtPropietario" type="text" value="" class="form-control" required="">
                  </div>
                </div>
              </div>

              <div class="col-md-3 form-control-label">
                <label for="chckPropiedadEMP">Propiedad EMP</label>
              </div>
              <div class="col-md-1">
                <div class="form-group">
                  <div class="form-line">
                    <input id="chckPropiedadEMP" type="checkbox" />
                  </div>
                </div>
              </div>

            </div>


          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="BtnGuardar" class="btn btn-w-m btn-primary" onclick="GuardarUnidad();">Guardar</button>
        <button type="button" id="BtnCerrar" class="btn btn-w-m btn-danger" data-dismiss="modal">Salir</button>
      </div>
      </div>
  </div>
</div>

<!-- Modal Confirmacion-->
<div class="modal fade" id="DivUnidadAnularModal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header ui-draggable-handle">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 style="font-weight:100" >Anula Unidad</h4>
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
            <button type="button" class="btn btn-w-m btn-primary" onclick="AnularUnidad();">SI</button>
            <button type="button" class="btn btn-w-m btn-danger" data-dismiss="modal">NO</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
//
  var TbUnidadCuerpo = $('#TbUnidadGestion tbody');
  var TxtNomUnidad = $("#TxtNomUnidad");
  var TxtDireccionUnidad = $("#TxtDireccionUnidad");
  var SelAlmacen = $("#SelAlmacen");
  var BtnGuardar = $("#BtnGuardar");
  var TxtMotivoAnulacion = $('#TxtMotivoAnulacion');
  var UnidadModalTitulo = $('#UnidadModalTitulo');
  var CodUnidadGeneral = 0;
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
  //$('#txtUnidad').inputmask("aaa-999", { placeholder: "___-___" });
  //
  $('#BtnNuevo').click(function(){
    UnidadModalTitulo.text('Registrar Unidad');
  });
  //
  ListarUnidad();
});
var CodUsuario = '<?php echo $CodUsuario;?>';
//
function ListarUnidad() {
    //
  if ( $.fn.DataTable.isDataTable('#TbUnidadGestion') ) {
    $('#TbUnidadGestion').DataTable().destroy();
  }

  var Procedimiento = 'ProcUnidad';
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
    TbUnidadCuerpo.empty();
    var FilasHTML = '';
    var CantidadFilas = Data.length;
    //
    $.each(Data, function(i) {
      FilasHTML += '<tr data-codUnidadgestion="' + this.CodUnidad +'" >' +
        '<td>' + (i + 1) + '</td>' +
        '<td>' + this.PadronUnidad + '</td>' +
        '<td>' + this.PlacaUnidad + '</td>' +
        '<td>' + this.Propietario + '</td>' +
        '<td class="text-center" >' + '<input class="checkPropiedad" type="checkbox"  '+ ( Number(this.PropiedadEmpresa) == 1 ? ' checked ' : '' )+'  />' + '</td>' +
      '</tr>';
    });
    //
    TbUnidadCuerpo.append(FilasHTML);
    //$('.checkPropiedad').iCheck('check');
    $('#cantUnidad').text(CantidadFilas);
    $('#TbUnidadGestion').DataTable({
        "paging": false,
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
    // toastr.success('Registros cargados correctamente', 'Nota')
  }, "JSON");
}

function abrirModalGuardar(){
    $('#txtPadron').val('');
    $('#txtUnidad').val('');
    $('#txtPropietario').val('');
    $('#chckPropiedadEMP').prop('checked', false);
    $('#DivUnidadModal').modal('show');
}

function GuardarUnidad() {
  //
  var NomUnidad = TxtNomUnidad.val();
  //Bloquea botón al guardar
  BtnGuardar.attr("disabled", true);
  //
  var Procedimiento = 'ProcUnidad';
  var txtPadron = $('#txtPadron').val();
  var txtUnidad = $('#txtUnidad').val();
  var txtPropietario = $('#txtPropietario').val();
  var checkPropiedadEmpresa = ($('#chckPropiedadEMP').is(':checked') ? 1 : 0);
  //

  var Parametros = txtPadron + '|' + txtUnidad + '|' + txtPropietario + '|' + checkPropiedadEmpresa;
  var Indice = 20;
  //
  var URL = URL_BASE + 'Registros/procGeneral';
  var Data = {
    parametros: Parametros,
    indice: Indice,
    nombreProcedimiento: Procedimiento
  };

  $.post(URL, Data, function(Data) {
    //
    var CodResultado = Data[0].CodResultado,
        DesResultado = Data[0].DesResultado;
    //
    if (CodResultado == 1) { 
      //
      $('#DivUnidadModal').modal('hide');
      ListarUnidad();
      // Limpia
      toastr.success(DesResultado, 'Éxito');
    } else {
      toastr.error(DesResultado, 'Error');
    }
    // Habilita botón
    BtnGuardar.removeAttr("disabled");
  }, "JSON");
}
function CodigoUnidad(CodUnidad) {
  CodUnidadGeneral = CodUnidad;
}
function AnularUnidad() {
  var MotivoAnulacion = TxtMotivoAnulacion.val();
  if (MotivoAnulacion == '') {
    toastr.warning('Debe ingresar motivo!');
    TxtMotivoAnulacion.focus();
    return;
  }
  // Bloquear el Botón SI
  // BtnAnularSI.attr("disabled", true);

  var Procedimiento = 'ProcUnidad';
  var Parametros = CodUnidadGeneral + '|' + CodUsuario + '|' + MotivoAnulacion;
  var Indice = 30;
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
      $('#DivUnidadAnularModal').modal('hide');

 

      ListarUnidad();
      // Limpia
      TxtMotivoAnulacion.val('');
      toastr.success(DesResultado, 'Éxito');
    } else {
      toastr.error(DesResultado, 'Error');
    }
    // Habilita botón
    // BtnAnularSI.removeAttr("disabled");
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
</script>

