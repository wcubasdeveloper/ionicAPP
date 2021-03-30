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
          <h2>(<strong id="cantRubro">-</strong>) <?=$Titulo?>  <i title="Agregar Nuevo Rubro"  onclick="abrirModalRegistra();"  style="cursor:pointer;color:#1ab394" class="fa fa-plus"></i> </h2>
      
      </div>
      <div class="col-lg-4">

      </div>
  </div>


   <br>
   <div class="row wrapper border-bottom white-bg page-heading">
      <div class="col-lg-12">
        <br>
        <div class="table-responsive">
          <table class="table table-bordered" id="TbProductoRubroGestion">
            <thead>

            <!-- AbrevProductoRubro: "RD"
CodProductoRubro: "3"
NomProductoRubro: "REPUESTO DE DIRECCION" -->

              <tr>
                <th style="width:20px">N</th>
                <th>RUBRO</th>
                <th>ABREV</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
   </div>
</div>
<!-- Modal Guardar ProductoRubro-->
<div class="modal fade" id="DivProductoRubroModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document" style="width:750px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="ProductoRubroModalTitulo">Nuevo Rubro</h4>
      </div>
      <div class="modal-body">
        <div class="body">
          <div class="form-vertical">
            <div class="row clearfix">
             
              <div class="col-md-2 form-control-label">
                <label for="txtNombreRubro">Rubro</label>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <div class="form-line">
                    <input id="txtNombreRubro" type="text" value="" class="form-control" required="">
                  </div>
                </div>
              </div>

              <div class="col-md-2 form-control-label">
                <label for="txtAbrevRubro">Abreviatura</label>
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <div class="form-line">
                    <input id="txtAbrevRubro" type="text" maxlength="2" value="" class="form-control" required="">
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="BtnGuardar" class="btn btn-w-m btn-primary" onclick="GuardarProductoRubro();">Guardar</button>
        <button type="button" id="BtnCerrar" class="btn btn-w-m btn-danger" data-dismiss="modal">Salir</button>
      </div>
      </div>
  </div>
</div>

<!-- Modal Confirmacion-->
<div class="modal fade" id="DivProductoRubroAnularModal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header ui-draggable-handle">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 style="font-weight:100" >Anula Rubro</h4>
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
            <button type="button" class="btn btn-w-m btn-primary" onclick="AnularProductoRubro();">SI</button>
            <button type="button" class="btn btn-w-m btn-danger" data-dismiss="modal">NO</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
//
  var TbProductoRubroCuerpo = $('#TbProductoRubroGestion tbody');
  var TxtNomProductoRubro = $("#TxtNomProductoRubro");
  var TxtDireccionProductoRubro = $("#TxtDireccionProductoRubro");
  var SelAlmacen = $("#SelAlmacen");
  var BtnGuardar = $("#BtnGuardar");
  var TxtMotivoAnulacion = $('#TxtMotivoAnulacion');
  var ProductoRubroModalTitulo = $('#ProductoRubroModalTitulo');
  var CodProductoRubroGeneral = 0;
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
    ProductoRubroModalTitulo.text('Registrar ProductoRubro');
  });
  //
  ListarProductoRubro();
});
var CodUsuario = '<?php echo $CodUsuario;?>';
//
function ListarProductoRubro() {

  if ( $.fn.DataTable.isDataTable('#TbProductoRubroGestion') ) {
    $('#TbProductoRubroGestion').DataTable().destroy();
  }

  var Procedimiento = 'ProcProductoRubro';
  var Parametros = '';
  var Indice = 10;
  var URL = URL_BASE + 'Registros/procGeneral';
  var Data = {
    parametros: Parametros,
    indice: Indice,
    nombreProcedimiento: Procedimiento
  };
  //
  $.post(URL, Data, function (Data) {
    //
    TbProductoRubroCuerpo.empty();
    var FilasHTML = '';
    var CantidadFilas = Data.length;

    //
    $.each(Data, function(i) {
      FilasHTML += '<tr data-codrubro="' + this.CodProductoRubro +'" >' +
        '<td>' + (i + 1) + '</td>' +
        '<td>' + this.NomProductoRubro + '</td>' +
        '<td>' + this.AbrevProductoRubro + '</td>' +
      '</tr>';
    });
    TbProductoRubroCuerpo.append(FilasHTML);
    $('#cantRubro').text(CantidadFilas);
    $('#TbProductoRubroGestion').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );

    // toastr.success('Registros cargados correctamente', 'Nota')
  }, "JSON");
}

function abrirModalRegistra(){
  $('#txtNombreRubro').val('');
  $('#txtAbrevRubro').val('');
  $('#DivProductoRubroModal').modal('show');
}

function GuardarProductoRubro() {
  //
  var NomProductoRubro = $('#txtNombreRubro').val();
  var abrevRubro =  $('#txtAbrevRubro').val();
  //Bloquea botón al guardar
  BtnGuardar.attr("disabled", true);
  //
  var Procedimiento = 'ProcProductoRubro';
  var Parametros = '';
  var Indice = 0;
  //
  if (CodProductoRubroGeneral == 0) { // Inserta
    Parametros = NomProductoRubro + '|' + abrevRubro;
    Indice = 20;
  }
  // else { // Edita
  //   Parametros = CodProductoRubroGeneral + '|' + NomProductoRubro + '|' + DireccionProductoRubro + '|' + CodAlmacen + '|' + CodUsuario;
  //   Indice = 30;
  // }
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
      CodProductoRubroGeneral = 0;    
      //
      $('#DivProductoRubroModal').modal('hide');
      ListarProductoRubro();
      // Limpia
      toastr.success(DesResultado, 'Éxito');
    } else {
      toastr.error(DesResultado, 'Error');
    }
    // Habilita botón
    BtnGuardar.removeAttr("disabled");
  }, "JSON");
}
function CodigoProductoRubro(CodProductoRubro) {
  CodProductoRubroGeneral = CodProductoRubro;
}
function AnularProductoRubro() {
  var MotivoAnulacion = TxtMotivoAnulacion.val();
  if (MotivoAnulacion == '') {
    toastr.warning('Debe ingresar motivo!');
    TxtMotivoAnulacion.focus();
    return;
  }
  // Bloquear el Botón SI
  // BtnAnularSI.attr("disabled", true);

  var Procedimiento = 'ProcProductoRubro';
  var Parametros = CodProductoRubroGeneral + '|' + CodUsuario + '|' + MotivoAnulacion;
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
      $('#DivProductoRubroAnularModal').modal('hide');

 

      ListarProductoRubro();
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

