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
          <h2>(<strong id="StnCantidadRegistros">-</strong>) <?=$Titulo?>  <i title="Crear proveedor" data-toggle="modal" data-target="#DivProveedorModal"  style="cursor:pointer;color:#1ab394" class="fa fa-plus"></i> </h2>
      
      </div>
      <div class="col-lg-4">

      </div>
  </div>


   <br>
   <div class="row wrapper border-bottom white-bg page-heading">
      <div class="col-lg-12">
        <br>
        <div class="table-responsive">
          <table class="table table-bordered" id="TbProveedorGestion">
            <thead>
              <tr>
                <th>N</th>
                <th>PROVEEDOR</th>
                <th>RUC</th>
                <th>DIRECCIÓN</th>
                <th>EMAIL</th>
                <th>CELULAR</th>
                <th>USUARIO</th>
                <th>F.CREACION</th>
                <th>ESTADO</th>
                <th style="width:80px;" ></th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
   </div>
</div>
<!-- Modal Guardar Proveedor-->
<div class="modal fade" id="DivProveedorModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document" style="width:750px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="ProveedorModalTitulo">Nuevo Proveedor</h4>
      </div>
      <div class="modal-body">
        <div class="body">
          <form class="form-vertical">

          <div class="row clearfix">
              <div class="col-md-3 form-control-label">
                <label for="TxtRUCProveedor">RUC:</label>
              </div>
              <div class="col-md-8">
                <div class="form-group">
                  <div class="form-line">
                    <input id="TxtRUCProveedor"  type="text" value="" class="form-control" required="">
                  </div>
                </div>
              </div>

              <div class="col-md-1">
                <div class="form-group">
                  <div class="form-line">
                  <img class="img-responsive" title="Consultar a sunat" style="width: 29px;cursor:pointer;" src="https://lh3.googleusercontent.com/GQledqJp_TWOHXWiYnGjpXvVIDnaHmjxWFwwp2lw7eBJiPNwC6wqpjtO7NAgo3pHCKs=w300" onclick="consultaRestSUNAT($('#TxtRUCProveedor').val())" />
                  </div>
                </div>
              </div>
            </div>

            <div class="row clearfix">
              <div class="col-md-3 form-control-label">
                <label for="TxtNomProveedor">Razón Social</label>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <div class="form-line">
                    <input id="TxtNomProveedor" type="text" value="" class="form-control" required="">
                  </div>
                </div>
              </div>
            </div>

            <div class="row clearfix">
              <div class="col-md-3 form-control-label">
                <label for="TxtDireccionProveedor">Dirección</label>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <div class="form-line">
                    <input id="TxtDireccionProveedor" type="text" value="" class="form-control" required="">
                  </div>
                </div>
              </div>
            </div>


            <div class="row clearfix">
              <div class="col-md-3 form-control-label">
                <label for="TxtDireccionProveedor">Email</label>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <div class="form-line">
                    <input id="txtEmailProveedor" type="text" value="" class="form-control" required="">
                  </div>
                </div>
              </div>
            </div>

            
            <div class="row clearfix">
              <div class="col-md-3 form-control-label">
                <label for="TxtDireccionProveedor">Celular</label>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <div class="form-line">
                    <input id="txtCelularProveedor" type="text" value="" class="form-control" required="">
                  </div>
                </div>
              </div>
            </div>

          </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="BtnGuardar" class="btn btn-w-m btn-primary" onclick="GuardarProveedor();">Guardar</button>
        <button type="button" id="BtnCerrar" class="btn btn-w-m btn-danger" data-dismiss="modal">Salir</button>
      </div>
      </div>
  </div>
</div>

<!-- Modal Confirmacion-->
<div class="modal fade" id="DivProveedorAnularModal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header ui-draggable-handle">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 style="font-weight:100" >Elimina Proveedor</h4>
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
            <button type="button" class="btn btn-w-m btn-primary" onclick="EliminarProveedor();">SI</button>
            <button type="button" class="btn btn-w-m btn-danger" data-dismiss="modal">NO</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
//
  var TbProveedorCuerpo = $('#TbProveedorGestion tbody');
  var TxtNomProveedor = $("#TxtNomProveedor");
  var TxtRUCProveedor = $("#TxtRUCProveedor");
  var TxtDireccionProveedor = $("#TxtDireccionProveedor");
  var BtnGuardar = $("#BtnGuardar");
  var TxtMotivoAnulacion = $('#TxtMotivoAnulacion');
  var ProveedorModalTitulo = $('#ProveedorModalTitulo');
  var CodProveedorGeneral = 0;
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
    ProveedorModalTitulo.text('Registrar Proveedor');
  });
  //
  ListarProveedor();
});
var CodUsuario = '<?php echo $CodUsuario;?>';
//
function ListarProveedor() {

  if ( $.fn.DataTable.isDataTable('#TbProveedorGestion') ) {
    $('#TbProveedorGestion').DataTable().destroy();
  }

  var Procedimiento = 'ProcProveedor';
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
    TbProveedorCuerpo.empty();
    var FilasHTML = '';
    var CantidadFilas = Data.length;
    //
    $.each(Data, function(i) {
      FilasHTML += '<tr>' +
        '<td>' + (i + 1) + '</td>' +
        '<td>' + this.NomProveedor + '</td>' +
        '<td>' + this.RUCProveedor + '</td>' +
        '<td>' + this.DireccionProveedor + '</td>' +
        '<td>' + this.email + '</td>' +
        '<td>' + this.celular + '</td>' +

        '<td>' + this.NomUsuario + '</td>' +
        '<td>' + this.FechaCreacion + '</td>' +
        '<td>' + this.NomEstado + '</td>' +
        '<td style="width:75px" >' +
          '<button ' +
          ' data-codproveedor="' + this.CodProveedor + '"' +
          ' data-nomproveedor="' + this.NomProveedor + '"' +
          ' data-rucproveedor="' + this.RUCProveedor + '"' +
          ' data-emailproveedor="' + this.email + '"' +
          ' data-celularproveedor="' + this.celular + '"' +
          ' data-direccionproveedor="' + this.DireccionProveedor + '"' +
          ' type="button" data-toggle="modal" data-target="#DivProveedorModal" class="btn btn-warning btn-xs" onclick="EditarProveedor($(this))"><i class="fa fa-edit"></i></button>' +
          '&nbsp;&nbsp;'+
          '<button type="button" data-toggle="modal" data-target="#DivProveedorAnularModal" class="btn btn-danger btn-xs" onclick="CodigoProveedor('+ this.CodProveedor +')" ><i class="fa fa-trash"></i></button>' +
        '</td>' +
      '</tr>';
    });
    TbProveedorCuerpo.append(FilasHTML);
    $('#StnCantidadRegistros').text(CantidadFilas);
    $('#TbProveedorGestion').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
    // toastr.success('Registros cargados correctamente', 'Nota')
  }, "JSON");
}
function GuardarProveedor() {
  //
  var NomProveedor = TxtNomProveedor.val();
  var RUCProveedor = TxtRUCProveedor.val();
  var DireccionProveedor = TxtDireccionProveedor.val();
  var emailProveedor = $('#txtEmailProveedor').val();
  var celularProveedor = $('#txtCelularProveedor').val();
  //
  if (NomProveedor == "") {
    toastr.warning('Debe ingresar nombre del proveedor!');
    TxtNomProveedor.focus();
    return;
  }
  if (RUCProveedor == "") {
    toastr.warning('Debe ingresar ruc!');
    TxtRUCProveedor.focus();
    return;
  }
  //Bloquea botón al guardar
  BtnGuardar.attr("disabled", true);
  //
  var Procedimiento = 'ProcProveedor';
  var Parametros = '';
  var Indice = 0;
  //
  if (CodProveedorGeneral == 0) { // Inserta
    Parametros = NomProveedor + '|' + RUCProveedor + '|' + DireccionProveedor + '|' + CodUsuario + '|' + emailProveedor + '|' + celularProveedor ;
    Indice = 20;
  } else { // Edita
    Parametros = CodProveedorGeneral + '|' + NomProveedor + '|' + RUCProveedor + '|' + DireccionProveedor + '|' +   emailProveedor + '|' + celularProveedor ;
    Indice = 30;
  }
  
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
      CodProveedorGeneral == 0;    
      //
      $('#DivProveedorModal').modal('hide');
      Limpiar();
      ListarProveedor();
      // Limpia
      toastr.success(DesResultado, 'Éxito');
    } else {
      toastr.error(DesResultado, 'Error');
    }
    // Habilita botón
    BtnGuardar.removeAttr("disabled");
  }, "JSON");
}
function Limpiar(){
  TxtNomProveedor.val('');
  TxtRUCProveedor.val('');
  TxtDireccionProveedor.val('');
}
function EditarProveedor(Fila){
  ProveedorModalTitulo.text('Editar Proveedor');
  var CodProveedor = Fila.attr('data-codProveedor');
  CodProveedorGeneral = CodProveedor;
  var NomProveedor = Fila.attr('data-nomProveedor');
  var RUCProveedor = Fila.attr('data-rucproveedor');
  var DireccionProveedor = Fila.attr('data-direccionProveedor');
  var emailProveedor = Fila.attr('data-emailProveedor');
  var celularProveedor = Fila.attr('data-celularProveedor');

  //
  $('#TxtNomProveedor').val(NomProveedor);
  $('#TxtRUCProveedor').val(RUCProveedor);
  $('#TxtDireccionProveedor').val(DireccionProveedor);
  $('#txtEmailProveedor').val(emailProveedor);
  $('#txtCelularProveedor').val(celularProveedor);
  
  

}
function CodigoProveedor(CodProveedor) {
  CodProveedorGeneral = CodProveedor;
}
function EliminarProveedor() {
  var MotivoAnulacion = TxtMotivoAnulacion.val();
  if (MotivoAnulacion == '') {
    toastr.warning('Debe ingresar motivo!');
    TxtMotivoAnulacion.focus();
    return;
  }
  // Bloquear el Botón SI
  // BtnAnularSI.attr("disabled", true);

  var Procedimiento = 'ProcProveedor';
  var Parametros = CodProveedorGeneral + '|' + CodUsuario + '|' + MotivoAnulacion;
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
      $('#DivProveedorAnularModal').modal('hide');
      ListarProveedor();
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

function consultaRestSUNAT(rucConsulta) {
    
        if(rucConsulta.length == 0){
          toastr.warning('Debe ingresar el nro de RUC!');
          $('#TxtRUCProveedor').focus();
          return;
        }
        var URL = "http://apiconsultadatos.e-docperu.com/public/api/v1/ruc/" + rucConsulta + '?token=abcxyz';
        var Data = {
        };
        //
        $.get(URL, Data, function (Data) {
            console.log("RPTA SUNAT", Data);
            //toastr.clear();
            var razonSocial = Data.razonSocial;
            var direccion = Data.direccion;
            var departamento = Data.departamento;
            var provincia = Data.provincia;
            var distrito = Data.distrito;
            var estado = Data.estado;
            var condicion = Data.condicion;

            $('#TxtNomProveedor').val(razonSocial);
            $('#TxtDireccionProveedor').val(direccion + ' ' +departamento + '-' + provincia + ' ' + distrito);
            return;
            var strHTMLInfo = '<table>' +
                                '<tr>' +
                                    '<td>RUC</td>' +
                                    '<td>:</td>' +
                                    '<td>' + rucConsulta + '</td>' +
                                '</tr>' +
                                '<tr>' +
                                    '<td>Razón</td>' +
                                    '<td>:</td>' +
                                    '<td>' + razonSocial + '</td>' +
                                '</tr>' +
                                '<tr>' +
                                    '<td>Dirección</td>' +
                                    '<td>:</td>' +
                                    '<td>' + direccion + '</td>' +
                                '</tr>' +
                                '<tr>' +
                                    '<td>Departamento</td>' +
                                    '<td>:</td>' +
                                    '<td>' + departamento + '</td>' +
                                '</tr>' +
                                '<tr>' +
                                    '<td>Provincia</td>' +
                                    '<td>:</td>' +
                                    '<td>' + provincia + '</td>' +
                                '</tr>' +
                                '<tr>' +
                                    '<td>Distrito</td>' +
                                    '<td>:</td>' +
                                    '<td>' + distrito + '</td>' +
                                '</tr>' +
                                '<tr>' +
                                    '<td>Estado</td>' +
                                    '<td>:</td>' +
                                    '<td>' + estado + '</td>' +
                                '</tr>' +
                                '<tr>' +
                                    '<td>Condición</td>' +
                                    '<td>:</td>' +
                                    '<td>' + condicion + '</td>' +
                                '</tr>' +

                               '</table>';

            Util.MostrarMensaje(strHTMLInfo, 1, true);
        }, 'JSON')
    }
</script>

