
<script src="<?=base_url()?>assets/plugins/tablefilter/jquery.uitablefilter.js"></script>
<link href="<?=base_url()?>assets/plugins/datatables/datatables.min.css" rel="stylesheet" />
<script src="<?=base_url()?>assets/plugins/datatables/datatables.min.js"></script>


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
          <h2>(<strong id="StnCantidadRegistros">-</strong>) <?=$Titulo?>  <i title="Agregar nuevo cliente" data-toggle="modal" data-target="#DivClienteModal"  style="cursor:pointer;color:#1ab394" class="fa fa-plus"></i> </h2>
      
      </div>
      <div class="col-lg-4">

      </div>
  </div>

  <br>
  <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
      <br>
      <div class="table-responsive">
        <table class="table table-bordered" id="TbCliente">
          <thead>
            <tr>
              <th>N</th>
              <th>NOMBRES</th>
              <th>A.PATERNO</th>
              <th>A.MATERNO</th>
              <th>DOC.</th>
              <th>NRO</th>
              <th>DIRECCIÓN</th>
              <th>USUARIO</th>
              <th>F.CREACION</th>
              <th>ESTADO</th>                     
              <th style="width:85px;"></th>
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
 <div class="modal fade" id="DivClienteAnularModal" role="dialog">
   <div class="modal-dialog">
     <div class="modal-content">
      <div class="modal-header ui-draggable-handle">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Eliminar Cliente</h4>
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
            <button type="button" class="btn btn-w-m btn-primary" onclick="EliminarCliente();"  >SI</button>
            <button type="button" class="btn btn-w-m btn-danger" data-dismiss="modal">NO</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal Cliente-->
 <div class="modal fade" id="DivClienteModal" role="dialog">
   <div class="modal-dialog">
     <div class="modal-content">
      <div class="modal-header ui-draggable-handle">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="ClienteModalTitulo"></h4>
      </div>
      <div id="ContenidoDialog">
        <div id="divCrearChip">
          <div class="modal-body">
            <div class="body">
              <form class="form-vertical">
                <div class="row clearfix">
                  <div class="col-md-3 form-control-label">
                    <label for="TxtNomCliente">Nombres:</label>
                  </div>
                  <div class="col-md-7">
                    <div class="form-group">
                      <div class="form-line">
                        <input id="TxtNomCliente" type="text" value="" class="form-control" required="" autofocus="">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row clearfix">
                  <div class="col-md-3 form-control-label">
                    <label for="TxtPaternoCliente">A.Paterno:</label>
                  </div>
                  <div class="col-md-7">
                    <div class="form-group">
                      <div class="form-line">
                        <input id="TxtPaternoCliente" type="text" value="" class="form-control" required="" autofocus="">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row clearfix">
                  <div class="col-md-3 form-control-label">
                    <label for="TxtMaternoCliente">A.Materno:</label>
                  </div>
                  <div class="col-md-7">
                    <div class="form-group">
                      <div class="form-line">
                        <input id="TxtMaternoCliente" type="text" value="" class="form-control" required="" autofocus="">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row clearfix">
                  <div class="col-md-3 form-control-label">
                    <label for="SelPersonaTipoDocumento">T.Documento:</label>
                  </div>
                  <div class="col-md-7">
                    <div class="form-group">
                      <div class="form-line">
                        <select id="SelPersonaTipoDocumento" class="form-control m-b" name="account">
                          <option value="1">DNI</option>
                          <option value="3">PASAPORTE</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row clearfix">
                  <div class="col-md-3 form-control-label">
                    <label for="TxtNumDocumento">Nro.Documento:</label>
                  </div>
                  <div class="col-md-7">
                    <div class="form-group">
                      <div class="form-line">
                        <input id="TxtNumDocumento" type="text" onkeypress="return Util.SoloNumero(event, this);" value="" class="form-control" required="" autofocus="">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row clearfix">
                  <div class="col-md-3 form-control-label">
                    <label for="TxtDireccionCliente">Dirección:</label>
                  </div>
                  <div class="col-md-7">
                    <div class="form-group">
                      <div class="form-line">
                        <input id="TxtDireccionCliente"  type="text" value="" class="form-control" required="" autofocus="">
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" id="BtnGuardar" class="btn btn-w-m btn-primary" onclick="GuardarCliente();"  >Guardar</button>
            <button type="button" id="BtnCerrar" class="btn btn-w-m btn-danger" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  //
  var TbClienteCuerpo = $('#TbCliente tbody');
  var TxtNomCliente = $('#TxtNomCliente');
  var TxtPaternoCliente = $('#TxtPaternoCliente');
  var TxtMaternoCliente = $('#TxtMaternoCliente');
  var SelPersonaTipoDocumento = $('#SelPersonaTipoDocumento');
  var TxtNumDocumento = $('#TxtNumDocumento');
  var TxtDireccionCliente = $('#TxtDireccionCliente');
  var BtnGuardar = $('#BtnGuardar');
  var ClienteModalTitulo = $('#ClienteModalTitulo');
  var TxtMotivoAnulacion = $('#TxtMotivoAnulacion');

  var CodUsuarioGeneral =  '<?php echo  $_SESSION['codusuario'];?>';
  var CodClienteGeneral = 0;
//
$(document).ready(function(){
  $('#txtBuscar').keyup(function () {
    $.uiTableFilter($('#TbCliente'), this.value);
  });
  //
  $('#BtnNuevo').click(function(){
    ClienteModalTitulo.text('Registrar Cliente');
  });
  //
  ListarCliente();
});

function ListarCliente(fecha){
  if ( $.fn.DataTable.isDataTable('#TbCliente') ) {
    $('#TbCliente').DataTable().destroy();
  }
  var Procedimiento = 'ProcCliente';
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
    TbClienteCuerpo.empty();
    var FilasHTML = '';
    var CantidadFilas = Data.length;
    //
    $.each(Data, function(i){
      FilasHTML += '<tr data-codcliente="' + this.CodCliente + '" >' +
        '<td>' + (i + 1) + '</td>' +
        '<td>' + this.PaternoCliente + '</td>' +
        '<td>' + this.MaternoCliente + '</td>' +
        '<td>' + this.NomCliente + '</td>' +
        '<td>' + this.NomPersonaTipoDocumento + '</td>' +
        '<td>' + this.NumDocumento + '</td>' +
        '<td>' + this.DireccionCliente + '</td>' +
        '<td>' + this.NomUsuario + '</td>' +
        '<td>' + this.FechaCreacion + '</td>' +
        '<td>' + this.NomEstado + '</td>' +
        '<td>' +
          '<button ' +
          ' data-codcliente="' + this.CodCliente + '"' +
          ' data-nomcliente="' + this.NomCliente + '"' +
          ' data-paternocliente="' + this.PaternoCliente + '"' +
          ' data-maternocliente="' + this.MaternoCliente + '"' +
          ' data-codpersonatipodocumento="' + this.CodPersonaTipoDocumento + '"' +
          ' data-numdocumento="' + this.NumDocumento + '" ' +
          ' data-direccioncliente="' + this.DireccionCliente + '" ' +
          ' data-nomusuario="' + this.NomUsuario + '" ' +
          ' data-fechacreacion="' + this.FechaCreacion + '" ' +
          ' data-nomestado="' + this.NomEstado + '" ' +
          ' type="button" data-toggle="modal" data-target="#DivClienteModal" class="btn btn-warning btn-xs" onclick="EditarCliente($(this))"><i class="fa fa-edit"></i></button>' +
          '&nbsp;&nbsp;'+
          '<button type="button" data-toggle="modal" data-target="#DivClienteAnularModal" class="btn btn-danger btn-xs" onclick="CodigoCliente('+ this.CodCliente +')" ><i class="fa fa-trash"></i></button>' +
        '</td>'+
      '</tr>';
    })
    TbClienteCuerpo.append(FilasHTML);
    $('#StnCantidadRegistros').text(CantidadFilas);

    $('#TbCliente').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
      //$.notify(respuesta[0].DesResultado,(respuesta[0].CodResultado == 1  ? "success" : "error" ) );
    toastr.success('Registros cargados correctamente', 'Nota')
  },"JSON");
}

function GuardarCliente(){
  var NomCliente = TxtNomCliente.val();
  var PaternoCliente = TxtPaternoCliente.val();
  var MaternoCliente = TxtMaternoCliente.val();
  var CodPersonaTipoDocumento  = SelPersonaTipoDocumento.val();
  var NumDocumento  = TxtNumDocumento.val();
  var DireccionCliente  = TxtDireccionCliente.val();

  if (NomCliente == "") {
    toastr.warning('Debe ingresar nombre del cliente!');
    TxtNomCliente.focus();
    return;
  }
  if (PaternoCliente == "") {
    toastr.warning('Debe ingresar apellido paterno!');
    TxtPaternoCliente.focus();
    return;
  }
  if (MaternoCliente == "") {
    toastr.warning('Debe ingresar apellido materno!');
    TxtMaternoCliente.focus();
    return;
  }
  if (NumDocumento == "") {
    toastr.warning('Debe ingresar apellido materno!');
    TxtNumDocumento.focus();
    return;
  }
  //Bloquea botón al guardar
  BtnGuardar.attr("disabled", true);
  //
  var Procedimiento = 'ProcCliente';
  var Parametros = '';
  var Indice = 0;
  //
  if (CodClienteGeneral == 0) { // Inserta
    Parametros = NomCliente + '|' + PaternoCliente + '|' + MaternoCliente + '|' + CodPersonaTipoDocumento + '|' + NumDocumento + '|' + CodUsuarioGeneral + '|' + DireccionCliente;
    Indice = 20;
  } else { // Edita
    Parametros = CodClienteGeneral + '|' +NomCliente + '|' + PaternoCliente + '|' + MaternoCliente + '|' + CodPersonaTipoDocumento + '|' + NumDocumento + '|' + DireccionCliente;
    Indice = 30;
  }
  //
  var URL = URL_BASE + 'Registros/procGeneral';
  var Data = {
    parametros: Parametros,
    indice: Indice,
    nombreProcedimiento: Procedimiento
  };
  //
  $.post(URL, Data, function(Data) {
    var CodResultado = Number(Data[0].CodResultado);
    var DesResultado = Data[0].DesResultado;
    //
    if (CodResultado == 1){
      CodClienteGeneral == 0;
      $('#DivClienteModal').modal('hide');
      toastr.success(DesResultado, 'Éxito');
      Limpiar();
      ListarCliente();
    } else{
      toastr.error(DesResultado, 'Error!')
    }
    // Habilita botón
    BtnGuardar.removeAttr("disabled");
  },"JSON");
}
function Limpiar(){
  TxtNomCliente.val('');
  TxtPaternoCliente.val('');
  TxtMaternoCliente.val('');
  TxtNumDocumento.val('');
  TxtDireccionCliente.val('');
}
function CodigoCliente(CodCliente) {
  CodClienteGeneral = CodCliente;
}
function EliminarCliente(){
  var MotivoAnulacion = TxtMotivoAnulacion.val();
  if (MotivoAnulacion == '') {
    toastr.warning('Debe ingresar motivo!');
    TxtMotivoAnulacion.focus();
    return;
  }

  // Bloquear el Botón SI
  // BtnAnularSI.attr("disabled", true);

  var Procedimiento = 'ProcCliente';
  var Parametros = CodClienteGeneral + '|' + CodUsuarioGeneral + '|' + MotivoAnulacion;
  var Indice = 40;
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
      $('#DivClienteAnularModal').modal('hide');
      ListarCliente();
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
function EditarCliente(Boton){
  ClienteModalTitulo.text('Editar Cliente');

  var CodCliente = Boton.attr('data-codcliente');
  CodClienteGeneral = CodCliente;
  var NomCliente = Boton.attr('data-nomcliente');
  var PaternoCliente = Boton.attr('data-paternoCliente');
  var MaternoCliente = Boton.attr('data-maternocliente');
  var NomPersonaTipoDocumento = Boton.attr('data-nompersonatipodocumento');
  var CodPersonaTipoDocumento = Boton.attr('data-codpersonatipodocumento');
  var NumDocumento = Boton.attr('data-numdocumento');
  var DireccionCliente = Boton.attr('data-direccioncliente');
  var NomUsuario = Boton.attr('data-nomusuario');
  var FechaCreacion = Boton.attr('data-fechacreacion');
  var NomEstado = Boton.attr('data-nomestado');
  //
  TxtNomCliente.val(NomCliente);
  TxtPaternoCliente.val(PaternoCliente);
  TxtMaternoCliente.val(MaternoCliente);
  SelPersonaTipoDocumento.val(CodPersonaTipoDocumento);
  TxtNumDocumento.val(NumDocumento);
  TxtDireccionCliente.val(DireccionCliente);

}
</script>