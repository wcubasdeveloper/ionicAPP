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
  .Link{
    color: blue;
  }
  .Link:hover{
    text-decoration: underline;
    cursor: pointer;
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
          <h2>(<strong id="StnCantidadRegistros">-</strong>) <?=$Titulo?>  
          <i title="Agregar nuevo usuario" data-toggle="modal" data-target="#DivUsuarioModal"  style="cursor:pointer;color:#1ab394" class="fa fa-plus"></i> </h2>
      
      </div>
      <div class="col-lg-4">

      </div>
  </div>

  
   <br>
   <div class="row wrapper border-bottom white-bg page-heading">
      <div class="col-lg-12">
        <br>
        <div class="table-responsive">
          <table class="table table-bordered" id="TbUsuarioGestion">
            <thead>
              <tr>
                <th>N</th>
                <th>EMPLEADO</th>
                <th>USUARIO</th>
                <th>TIPO</th>
                <th>U.CREACIÓN</th>
                <th>F.CREACION</th>
                <th>ESTADO</th>
                <th>CAJA</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
   </div>
</div>
<!-- Modal Guardar Usuario-->
<div class="modal fade" id="DivUsuarioModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document" style="width:750px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="UsuarioModalTitulo"></h4>
      </div>
      <div class="modal-body">
        <div class="body">
          <form class="form-vertical">
            <div class="row clearfix">
              <div class="col-md-3 form-control-label">
                <label for="SelPersona">Persona</label>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <div class="form-line">
                    <select id="SelPersona" class="form-control m-b"></select>
                  </div>
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-md-3 form-control-label">
                <label for="SelUsuarioTipo">Tipo</label>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <div class="form-line">
                    <select id="SelUsuarioTipo" class="form-control m-b"></select>
                  </div>
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-md-3 form-control-label">
                <label for="TxtNomUsuario">Usuario:</label>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <div class="form-line">
                    <input id="TxtNomUsuario" type="text" value="" class="form-control" required="">
                  </div>
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-md-3 form-control-label">
                <label for="TxtClaveUsuario">Clave:</label>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <div class="form-line">
                    <input id="TxtClaveUsuario" type="password" value="" class="form-control" required="">
                  </div>
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-md-3 form-control-label">
                <label for="TxtClaveUsuarioConfirmacion">Confirmación:</label>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <div class="form-line">
                    <input id="TxtClaveUsuarioConfirmacion" type="password" value="" class="form-control" required="">
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="BtnGuardar" class="btn btn-w-m btn-primary" onclick="GuardarUsuario();">Guardar</button>
        <button type="button" id="BtnCerrar" class="btn btn-w-m btn-danger" data-dismiss="modal">Salir</button>
      </div>
      </div>
  </div>
</div>
<!-- Modal Cambiar clave Usuario-->
<div class="modal fade" id="DivUsuarioCambiarClaveModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document" style="width:750px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Cambiar Clave</h4>
      </div>
      <div class="modal-body">
        <div class="body">
          <form class="form-vertical" autocomplete="off">
            <div class="row clearfix">
              <div class="col-md-3 form-control-label">
                <label>Persona</label>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <div class="form-line">
                    <label class="DatoLimpiar" id="LblEmpleado"></label>
                  </div>
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-md-3 form-control-label">
                <label for="SelUsuarioTipo2">Tipo</label>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <div class="form-line">
                    <select id="SelUsuarioTipo2" class="form-control m-b"></select>
                  </div>
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-md-3 form-control-label">
                <label>Usuario</label>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <div class="form-line">
                    <label class="DatoLimpiar" id="LblNomUsuario"></label>
                  </div>
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-md-3 form-control-label">
                <label for="TxtClaveUsuario2">Clave:</label>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <div class="form-line">
                    <input id="TxtClaveUsuario2" type="password" value="" class="form-control" required="">
                  </div>
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-md-3 form-control-label">
                <label for="TxtClaveUsuarioConfirmacion2">Confirmación:</label>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <div class="form-line">
                    <input id="TxtClaveUsuarioConfirmacion2" type="password" value="" class="form-control" required="">
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="BtnGuardar2" class="btn btn-w-m btn-primary" onclick="GuardarCambiarClaveUsuario();">Guardar</button>
        <button type="button" id="BtnCerrar2" class="btn btn-w-m btn-danger" data-dismiss="modal">Salir</button>
      </div>
      </div>
  </div>
</div>
<!-- Modal Confirmacion-->
<div class="modal fade" id="DivUsuarioAnularModal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header ui-draggable-handle">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 style="font-weight:100" >Anula Usuario</h4>
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
            <button type="button" class="btn btn-w-m btn-primary" onclick="AnularUsuario();">SI</button>
            <button type="button" class="btn btn-w-m btn-danger" data-dismiss="modal">NO</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Modal Permisos-->
<div class="modal fade" id="DivUsuarioTipoMenuModal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header ui-draggable-handle">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="UsuarioTituloPermiso">Editar permisos</h4>
      </div>
      <div>
        <div class="modal-body">
          <div class="body">
            <form class="form-vertical">
              <div class="row clearfix">
                <div id="DivPermisos" class="col-md-12 form-control-label">
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
//
  var TbUsuarioCuerpo = $('#TbUsuarioGestion tbody');
  var SelPersona = $("#SelPersona");
  var SelUsuarioTipo = $("#SelUsuarioTipo");
  var TxtNomUsuario = $("#TxtNomUsuario");
  var TxtClaveUsuario = $("#TxtClaveUsuario");
  var TxtClaveUsuarioConfirmacion = $("#TxtClaveUsuarioConfirmacion");
  var TxtClaveUsuario2 = $("#TxtClaveUsuario2");
  var TxtClaveUsuarioConfirmacion2 = $("#TxtClaveUsuarioConfirmacion2");
  var BtnGuardar = $("#BtnGuardar");
  var BtnGuardar2 = $("#BtnGuardar2");
  var TxtMotivoAnulacion = $('#TxtMotivoAnulacion');
  var UsuarioModalTitulo = $('#UsuarioModalTitulo');
  var LblEmpleado = $('#LblEmpleado');
  var LblNomUsuario = $('#LblNomUsuario');
  var LblNomUsuarioTipo = $('#LblNomUsuarioTipo');
  var DivPermisos = $('#DivPermisos');
  var SelUsuarioTipo2 = $('#SelUsuarioTipo2');
  var CodUsuarioGeneral = 0;
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
    UsuarioModalTitulo.text('Registrar Usuario');
  });
  //
  ListarUsuario();
  ListarPersona();
  ListarUsuarioTipo();
});
var CodUsuario = '<?php echo $CodUsuario;?>';
//
function ListarUsuario() {
  if ( $.fn.DataTable.isDataTable('#TbUsuarioGestion') ) {
    $('#TbUsuarioGestion').DataTable().destroy();
  }

  var Procedimiento = 'ProcUsuario';
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
    TbUsuarioCuerpo.empty();
    var FilasHTML = '';
    var CantidadFilas = Data.length;
    //
    $.each(Data, function(i) {
      FilasHTML += '<tr>' +
        '<td>' + (i + 1) + '</td>' +
        '<td>' + this.Empleado + '</td>' +
        '<td>' + this.NomUsuario + '</td>' +
        '<td class="Link" data-toggle="modal" data-codusuariotipo=' + this.CodUsuarioTipo + ' data-nomusuariotipo="' + this.NomUsuarioTipo + '" data-target="#DivUsuarioTipoMenuModal" onclick="EditarPermisos(this)">' + this.NomUsuarioTipo + '</td>' +
        '<td>' + this.NomUsuarioCreacion + '</td>' +
        '<td>' + this.FechaCreacion + '</td>' +
        '<td>' + this.NomEstado + '</td>' +
        '<td>' + this.NomEstadoCaja + '</td>' +
        '<td>' +
          '<button ' +
          ' data-codusuario="' + this.CodUsuario + '"' +
          ' data-nomusuario="' + this.NomUsuario + '"' +
          ' data-Nomusuariotipo="' + this.NomUsuarioTipo + '"' +
          ' data-empleado="' + this.Empleado + '"' +
          ' data-codusuariotipo="' + this.CodUsuarioTipo + '"' +
          ' type="button" data-toggle="modal" data-target="#DivUsuarioCambiarClaveModal" class="btn btn-warning btn-xs" onclick="CambiarClaveUsuario($(this))"><i class="fa fa-edit"></i></button>' +
          '&nbsp;&nbsp;'+
          '<button type="button" data-toggle="modal" data-target="#DivUsuarioAnularModal" class="btn btn-danger btn-xs" onclick="CodigoUsuario(' + this.CodUsuario + ')" ><i class="fa fa-trash"></i></button>' +
        '</td>' +
      '</tr>';
    });
    TbUsuarioCuerpo.append(FilasHTML);
    $('#StnCantidadRegistros').text(CantidadFilas);
    $('#TbUsuarioGestion').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );

    //
  }, "JSON");
}
function EditarPermisos(Td) {
  var CodUsuarioTipo = $(Td).data('codusuariotipo');
  var NomUsuarioTipo = $(Td).data('nomusuariotipo');
  // Setea título
  $('#UsuarioTituloPermiso').text('Editar permisos de ' + NomUsuarioTipo);
  // Consulta Lista de permisos
  
  var Procedimiento = 'ProcMenu';
  var Parametros = CodUsuarioTipo;
  var Indice = 10;
  var URL = URL_BASE + 'Registros/procGeneral';
  var Data = {
    parametros: Parametros,
    indice: Indice,
    nombreProcedimiento: Procedimiento
  };
  //
  $.post(URL, Data, function (Data) {
    var MenuHTML = '<ul>', Checked = '';
    //
    $.each(Data, function(i) {
      if (this.CodMenu == this.CodMenuPadre) {
        if (this.CodEstado == 1) {
          Checked = 'checked="checked"';
        } else {
          Checked = '';
        }
        //
        MenuHTML += '<li><input class="check" ' + Checked + ' type="checkbox" id="' + this.CodMenu + '" data-codusuariotipomenu="' + this.CodUsuarioTipoMenu + '"><label for="' + this.CodMenu + '">' + this.NomMenu + '</label></li>';
        //
        MenuHTML += '<ul>';
        //
        MenuHTML += AgregarSubMenu(Data, this.CodMenuPadre);
        //
        MenuHTML += '</ul>';
        //
        MenuHTML += '</li>';
      }
    });
    DivPermisos.html(MenuHTML);
    //
    $('.check').change(function() {
      //
      var CodUsuarioTipoMenu = $(this).data('codusuariotipomenu');
      var CodEstado = $(this).is(':checked');

      var Procedimiento = 'ProcMenu';
      var Parametros = CodUsuarioTipoMenu + '|' + ($(this).is(':checked') == true ? 1 : 2);
      var Indice = 32;
      var URL = URL_BASE + 'Registros/procGeneral';
      var Data = {
        parametros: Parametros,
        indice: Indice,
        nombreProcedimiento: Procedimiento
      };
      //
      $.post(URL, Data, function (Data) {
        var CodResultado = Data[0].CodResultado,
            DesResultado = Data[0].DesResultado;
        //
        if (CodResultado == 1) {
          // $(this).prop('checked', (CodEstado == 1 ? true : false));
          toastr.success(DesResultado, 'Éxito');
        } else {
          // alert((CodEstado == 1 ? false : true));
          // $(this).prop('checked', (CodEstado == 1 ? false : true));
          toastr.error(DesResultado, 'Error');
        }
        //
      },'JSON');
    });

  },'JSON');
}
function AgregarSubMenu(Data, CodMenuPadre) {
  var MenuHTML = '', Checked = '';
  $.each(Data, function(i) {
    //
    if ((this.CodMenuPadre == CodMenuPadre) && (this.CodMenu != this.CodMenuPadre)) {
      if (this.CodEstado == 1) {
        Checked = 'checked="checked"';
      } else {
        Checked = '';
      }
      //
      MenuHTML += '<li><input class="check" ' + Checked + ' type="checkbox" id="' + this.CodMenu + '" data-codusuariotipomenu="' + this.CodUsuarioTipoMenu + '"><label for="' + this.CodMenu + '">' + this.NomMenu + '</label>';
      //
      MenuHTML += '<ul>';
      //
      MenuHTML += AgregarSubMenu(Data, this.CodMenu);
      MenuHTML += '</ul>';
      MenuHTML += '</li>';
    }
  });
  return MenuHTML;
}
function ListarPersona() {
  var Procedimiento = 'ProcPersona';
  var Parametros = '1,2,3,4,5';
  var Indice = 12;
  var URL = URL_BASE + 'Registros/procGeneral';
  var Data = {
    parametros: Parametros,
    indice: Indice,
    nombreProcedimiento: Procedimiento
  };
  //
  $.post(URL, Data, function (Data) {
    var OptionHTML = '';
    //
    $.each(Data, function(i) {
      OptionHTML += '<option value="' + this.CodPersona +'" >' + this.NomPersona + '</option>';
    });
    SelPersona.append(OptionHTML);
    // SelAlmacen.selectpicker("refresh");
  },'JSON');
}
function ListarUsuarioTipo() {
  var Procedimiento = 'ProcUsuario';
  var Parametros = '';
  var Indice = 12;
  var URL = URL_BASE + 'Registros/procGeneral';
  var Data = {
    parametros: Parametros,
    indice: Indice,
    nombreProcedimiento: Procedimiento
  };
  //
  $.post(URL, Data, function (Data) {
    var OptionHTML = '';
    //
    $.each(Data, function(i) {
      OptionHTML += '<option value="' + this.CodUsuarioTipo +'" >' + this.NomUsuarioTipo + '</option>';
    });
    SelUsuarioTipo.append(OptionHTML);
    SelUsuarioTipo2.append(OptionHTML);
    // SelAlmacen.selectpicker("refresh");
  },'JSON');
}
function GuardarUsuario() {
  //
  var CodPersona = SelPersona.val();
  var CodUsuarioTipo = SelUsuarioTipo.val();
  var NomUsuario = TxtNomUsuario.val();
  var ClaveUsuario = TxtClaveUsuario.val();
  var ClaveUsuarioConfirmacion = TxtClaveUsuarioConfirmacion.val();
  //
  if (ClaveUsuario != ClaveUsuarioConfirmacion) {
    toastr.warning('La clave no coincide!');
    TxtClaveUsuario.focus();
    return;
  }
  //Bloquea botón al guardar
  BtnGuardar.attr("disabled", true);
  //
  var Procedimiento = 'ProcUsuario';
  var Parametros = CodPersona + '|' + NomUsuario + '|' + ClaveUsuario + '|' + CodUsuarioTipo + '|' + COD_USUARIO;
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
      CodUsuarioGeneral = 0;    
      //
      $('#DivUsuarioModal').modal('hide');
      ListarUsuario();
      ListarPersona();
      // Limpia
      TxtNomUsuario.val('');
      TxtClaveUsuario.val('');
      TxtClaveUsuarioConfirmacion.val('');


      toastr.success(DesResultado, 'Éxito');
    } else {
      toastr.error(DesResultado, 'Error');
    }
    // Habilita botón
    BtnGuardar.removeAttr("disabled");
  }, "JSON");
}
function CambiarClaveUsuario(Fila){
  UsuarioModalTitulo.text('Cambiar Clave');
  var CodUsuario = Fila.attr('data-codusuario');
  CodUsuarioGeneral = CodUsuario;
  var Empleado = Fila.attr('data-empleado');
  var NomUsuario = Fila.attr('data-nomusuario');
  var CodUsuarioTipo = Fila.attr('data-codusuariotipo');
  //
  LblEmpleado.text(Empleado);
  LblNomUsuario.text(NomUsuario);
  SelUsuarioTipo2.val(CodUsuarioTipo);
}
function GuardarCambiarClaveUsuario() {
  //
  var ClaveUsuario = TxtClaveUsuario2.val();
  var ClaveUsuarioConfirmacion = TxtClaveUsuarioConfirmacion2.val();
  var CodUsuarioTipo = SelUsuarioTipo2.val();
  //
  if ((ClaveUsuario != ClaveUsuarioConfirmacion) && (ClaveUsuario != '' || ClaveUsuarioConfirmacion != '')) {
    toastr.warning('La clave no coincide!');
    TxtClaveUsuario.focus();
    return;
  }
  //Bloquea botón al guardar
  BtnGuardar2.attr("disabled", true);
  //
  var Procedimiento = 'ProcUsuario';
  var Parametros = CodUsuarioGeneral + '|' + ClaveUsuario + '|' + CodUsuarioTipo;
  var Indice = 32;
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
      CodUsuarioGeneral = 0;    
      //
      $('#DivUsuarioCambiarClaveModal').modal('hide');
      ListarUsuario();
      // Limpia
      TxtClaveUsuario2.val('');
      TxtClaveUsuarioConfirmacion2.val('');
      toastr.success(DesResultado, 'Éxito');
    } else {
      toastr.error(DesResultado, 'Error');
    }
    // Habilita botón
    BtnGuardar2.removeAttr("disabled");
  }, "JSON");
}
function CodigoUsuario(CodUsuario) {
  CodUsuarioGeneral = CodUsuario;
}
function AnularUsuario() {
  var MotivoAnulacion = TxtMotivoAnulacion.val();
  if (MotivoAnulacion == '') {
    toastr.warning('Debe ingresar motivo!');
    TxtMotivoAnulacion.focus();
    return;
  }
  // Bloquear el Botón SI
  // BtnAnularSI.attr("disabled", true);

  var Procedimiento = 'ProcUsuario';
  var Parametros = CodUsuarioGeneral + '|' + CodUsuario + '|' + MotivoAnulacion;
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
      $('#DivUsuarioAnularModal').modal('hide');
      ListarUsuario();
      ListarPersona();
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

