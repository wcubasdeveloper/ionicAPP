<link href="<?=base_url()?>assets/csoftcontent/js/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
<script src="<?=base_url()?>assets/csoftcontent/js/plugins/bootstrap-select/bootstrap-select.min.js"></script>
<link href="<?=base_url()?>assets/csoftcontent/js/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
<script src="<?=base_url()?>assets/csoftcontent/js/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="<?=base_url()?>assets/csoftcontent/js/plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script>
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
      <div class="col-lg-12">
        <h2>Asistencias&nbsp;&nbsp;&nbsp;<strong id="StnCantidadRegistros">-</strong>
          <input id="TxtFechaInicio" readonly class="FechaUI" style="width:130px;"/>
          <input id="TxtFechaFin" readonly class="FechaUI" style="width:130px;"/>
          <button id="BtnNuevo" onclick="abrirModalRegistroAsistencia();" class="btn btn-sm btn-primary pull-right m-t-n-xs" type="button"  ><strong>Registrar Asistencia</strong></button>
        </h2>
      </div>
   </div>
   <br>
   <div class="row wrapper border-bottom white-bg page-heading">
      <div class="col-lg-12" id="DivPersonaProgramacion">
        <br>
        <div class="table-responsive">
          <table class="table table-bordered" id="TbAsistenciaPersona">
            <thead>
              <tr>
                <th>N</th>
                <th>EMPLEADO</th>
                <th>F.HORA INICIO</th>
                <th>F.HORA FIN</th>
                <th>TIPO</th>
                <th style="width:20px;"></th>
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
<!-- Modal Guardar ProductoCategoria-->
<div class="modal fade" id="DivProductoCategoriaModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document" style="width:750px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="ProductoCategoriaModalTitulo">Registrar asistencia</h4>
      </div>
      <div class="modal-body">
        <div class="body">
          <form class="form-vertical">
            <div class="row clearfix">
              <div class="col-md-3 form-control-label">
                <label >Persona</label>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <div class="form-line">
                    <select class="form-control m-b" id="selectCodPersona"></select>
                  </div>
                </div>
              </div>
            </div>


            <div class="row clearfix">
              <div class="col-md-3 form-control-label">
                <label >Tipo</label>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <div class="form-line">
                    <select class="form-control m-b" id="selectCodAsistenciaTipo">
                    </select>
                  </div>
                </div>
              </div>
            </div>

            <!-- <div class="row clearfix" style="display:none;">
              <div class="col-md-3 form-control-label">
                <label >Hora Ingreso</label>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <div class="form-line">
                    <input id="txtFechaHoraAccion" type="text" value="" class="form-control FechaUI" required="" disabled="disabled" >
                  </div>
                </div>
              </div>
            </div> -->

            <div class="row clearfix">
              <div class="col-md-3 form-control-label">
                <label >Comentario</label>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <div class="form-line">
                    <textarea id="txtComentario" class="form-control" rows="2" ></textarea>
                  </div>
                </div>
              </div>
            </div>

          </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="BtnGuardar" class="btn btn-w-m btn-primary" onclick="registrarAsistencia();">Guardar</button>
        <button type="button" id="BtnCerrar" class="btn btn-w-m btn-danger" data-dismiss="modal">Salir</button>
      </div>
      </div>
  </div>
</div>

<!-- Modal Guardar ProductoCategoria-->
<div class="modal fade" id="DivRegistroProduccionModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document" style="width:500px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="ProductoCategoriaModalTitulo">Registrar producción</h4>
      </div>
      <div class="modal-body">
        <div class="body">
          <form class="form-vertical">
            <div class="row clearfix">
              <div class="col-md-3 form-control-label">
                <label >F.Operación</label>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <div class="form-line">
                    <input id="txtFechaRegistroProduccion" type="text"  class="form-control" style="text-align:center; width: 50%" readonly/>
                  </div>
                </div>
              </div>
            </div>

            <div class="row clearfix">
              <div class="col-md-3 form-control-label">
                <label >Empleado</label>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <div class="form-line">
                    <input id="txtEmpleadoRP" type="text"  class="form-control" style="text-align:left" readonly/>
                  </div>
                </div>
              </div>
            </div>

            <div class="row clearfix">
              <div class="col-md-3 form-control-label">
                <label >F.Hora Inicio</label>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <div class="form-line">
                    <input id="txtFInicioRP" type="text"  class="form-control" style="text-align:center; width: 50%" readonly/>
                  </div>
                </div>
              </div>
            </div>

            <div class="row clearfix">
              <div class="col-md-3 form-control-label">
                <label >F.Hora Fin</label>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <div class="form-line">
                    <input id="txtFFinRP" type="text"  class="form-control" style="text-align:center; width: 50%" readonly/>
                  </div>
                </div>
              </div>
            </div>

            <div class="row clearfix">
              <div class="col-md-3 form-control-label">
                <label >Básico</label>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <div class="form-line">
                    <input id="txtBasico" type="text"  class="form-control" style="text-align:right; width: 50%" onkeypress="return Util.SoloDecimal(event, this);" onclick="$(this).select()" onblur="volver2Decimales($(this))"/>
                  </div>
                </div>
              </div>
            </div>

            <div class="row clearfix">
              <div class="col-md-3 form-control-label">
                <label >Comisión</label>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <div class="form-line">
                    <input id="txtComision" type="text"  class="form-control" style="text-align:right; width: 50%" onkeypress="return Util.SoloDecimal(event, this);" onclick="$(this).select()" onblur="volver2Decimales($(this))"/>
                  </div>
                </div>
              </div>
            </div>

          </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="BtnGuardar" class="btn btn-w-m btn-primary" onclick="registrarProduccion();">Guardar</button>
        <button type="button" id="BtnCerrar" class="btn btn-w-m btn-danger" data-dismiss="modal">Salir</button>
      </div>
      </div>
  </div>
</div>

<!-- Modal Confirmacion-->
<div class="modal fade" id="DivProductoCategoriaAnularModal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header ui-draggable-handle">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 style="font-weight:100" >Anula Categoria</h4>
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
            <button type="button" class="btn btn-w-m btn-primary" onclick="AnularProductoCategoria();">SI</button>
            <button type="button" class="btn btn-w-m btn-danger" data-dismiss="modal">NO</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  var TxtFechaInicio = $('#TxtFechaInicio');
  var TxtFechaFin = $('#TxtFechaFin');
  var DivPersonaProgramacion = $('#DivPersonaProgramacion');

  $(document).ajaxStart(function(event, jqXHR, settings) {
    $('#msjload').fadeIn();
  });
  $(document).ajaxComplete(function(event, jqXHR, settings) {
    $('#msjload').fadeOut();
  });

  $(document).ready(function(){
    TxtFechaInicio.val(FechaHoraHoy(1)).change(function(){
      ListarAsistencias();
    });
    TxtFechaFin.val(FechaHoraHoy(1)).change(function(){
      ListarAsistencias();
    });
    ListarPersona();
    ListarAsistencias();
    cargarTipoAsistencia();
    
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
    }).inputmask('dd/mm/yyyy', { placeholder: '__/__/____ __:__' });
    //
    ListarPersonaProgramacion();
  });
  function ListarPersonaProgramacion() {
    var Procedimiento = 'ProcPersonaProgramacion';
    var Parametros = FechaMySQL($('#TxtFechaInicio').val()) + '|' + FechaMySQL($('#TxtFechaFin').val()) + '|0';
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
      $('#TbAsistenciaPersona tbody').empty();
      var FilasHTML = '';
      var CantidadFilas = Data.length;
      //
      $.each(Data, function(i) {
        FilasHTML += '<tr data-codpersona="'+ this.CodPersona+'" data-codasistenciatipo="'+ this.CodAsistenciaTipo+'" data-codasistencia="' + this.CodAsistencia +'" >' +
          '<td>' + (i + 1) + '</td>' +
          '<td>' + this.Empleado + '</td>' +
          '<td>' + this.FechaHoraInicio + '</td>' +
          '<td>' + this.FechaHoraFin + '</td>' +
          '<td>' + this.NomAsistenciaTipo + '</td>' +
          '<td>' +
            '<button type="button"  class="btn btn-'+ (this.FechaHoraFin == '' ? 'warning' : 'primary')+' btn-xs" onclick="'+  (this.FechaHoraFin == '' ? ' ' : ' disabled="disabled" ')  +'registrarSalida($(this).parent().parent())" ' + (this.FechaHoraFin == '' ? ' ' : ' disabled="disabled" ') +' ><i class="fa fa-clock-o"></i></button>' +
          '</td>' +
          '<td>' +
            '<button type="button" title="Registrar producción" class="btn btn-primary btn-xs" onclick="abrirModalRegistroProduccion($(this).parent().parent());"><i class="fa fa-money" aria-hidden="true"></i></button>' +
          '</td>' +
        '</tr>';
      });
      $('#TbAsistenciaPersona tbody').append(FilasHTML);
      $('#StnCantidadRegistros').text(CantidadFilas);
      // toastr.success('Registros cargados correctamente', 'Nota')
    }, "JSON");
    var Html = 
    '<div class="row">' +
    ' <div class="col-md-2">' +
    '  <div class="ibox-content text-center">' +
    '     <h1>' + 'A LA MRDD' + '</h1>' +
    '     <div class="m-b-sm">' +
    '       <img alt="image" class="img-circle" src="img/a8.jpg">' +
    '     </div>' +
    '       <p class="font-bold">Consectetur adipisicing</p>' +
    '     <div class="text-center">' +
    '       <a class="btn btn-xs btn-white"><i class="fa fa-thumbs-up"></i> Like </a>' +
    '       <a class="btn btn-xs btn-primary"><i class="fa fa-heart"></i> Love</a>' +
    '     </div>' +
    '   </div>' +
    ' </div>' +
    '</div>';
    DivPersonaProgramacion.html(Html);
  }
  function abrirModalRegistroAsistencia(){
    $('#txtComentario').val('');
    var fechaHoraHoy = FechaHoraHoy(2);
    $('#txtFechaHoraAccion').val(fechaHoraHoy);
    $('#DivProductoCategoriaModal').modal('show');
  }
  function abrirModalRegistroProduccion(tr){
    var fecha = FechaMySQL(tr.find('td').eq(2).text().split(' ')[0]);
    var codPersona = tr.attr('data-codpersona');
    var codAsistencia = tr.attr('data-codasistencia');

    var empleado = tr.find('td').eq(1).text();
    var fHoraInicio = tr.find('td').eq(2).text();
    var fHoraFin = tr.find('td').eq(3).text();

    var Procedimiento = 'ProcPersonaComision';
    var Parametros = codPersona + '|' + fecha;
    var Indice = 11;
    var URL = URL_BASE + 'Registros/procGeneral';
    var Data = {
      parametros: Parametros,
      indice: Indice,
      nombreProcedimiento: Procedimiento
    };
    //
    $.post(URL, Data, function (Data) {
      
      var basico = (Data[0].Importe == null || Data[0].Importe == '' ? Number(0) : Number(Data[0].Importe));
      var comision = (Data[1].Importe == null || Data[1].Importe == '' ? Number(0) : Number(Data[1].Importe));
      $('#txtFechaRegistroProduccion').val('');
      $('#txtEmpleadoRP').val('');
      $('#txtFInicioRP').val('');
      $('#txtFFinRP').val('');
      $('#txtBasico').val('');
      $('#txtComision').val('');
      
      var fechaHoraHoy = FechaHoraHoy(1);
      $('#txtFechaRegistroProduccion').val(fechaHoraHoy);
      $('#txtBasico').val(basico.toFixed(2));
      $('#txtEmpleadoRP').val(empleado);
      $('#txtEmpleadoRP').attr('data-codpersona', codPersona);
      $('#txtEmpleadoRP').attr('data-codasistencia', codAsistencia);
      $('#txtFInicioRP').val(fHoraInicio);
      $('#txtFFinRP').val(fHoraFin);
      $('#txtComision').val(comision.toFixed(2));
      $('#DivRegistroProduccionModal').modal('show');
      
    },'JSON');

    
  }
  function volver2Decimales(element){
    element.val(Number(element.val()).toFixed(2));
  }
  function registrarProduccion(){
    //Comprobando que no esten vacios los inputs
    if($('#txtBasico').val() == ''){
      $('#txtBasico').focus();
      return;
    }

    if($('#txtComision').val() == ''){
      $('#txtComision').focus();
      return;
    }

    //Obteniendo los parrametros para la cadena 
    var fechaOperacion = FechaMySQL($('#txtFechaRegistroProduccion').val());
    var codPersona = $('#txtEmpleadoRP').attr('data-codpersona');
    var codPersonaPagoConceptoBasico = 1;
    var codPersonaPagoConceptoComision = 2;
    var importePagoBasico = Number($('#txtBasico').val());
    var importePagoComision = Number($('#txtComision').val());
    var codUsuarioAccion = COD_USUARIO;
    var codAsistencia = $('#txtEmpleadoRP').attr('data-codasistencia');
    
    //Armando la cadena para BASICO
    var cadenaBasico = fechaOperacion + '|' + codPersona + '|' + codPersonaPagoConceptoBasico + '|' + importePagoBasico.toFixed(2) + '|' + codUsuarioAccion + '|' + codAsistencia;
    //Armando la cadena para COMISION
    var cadenaComision = fechaOperacion + '|' + codPersona + '|' + codPersonaPagoConceptoComision + '|' + importePagoComision.toFixed(2) + '|' + codUsuarioAccion + '|' + codAsistencia;

    //Guardando el BASICO
    guardarBasico(cadenaBasico, cadenaComision)

  }
  function guardarBasico(cadenaBasico, cadenaComision){
    var Procedimiento = 'ProcPersonaPago';
    var Parametros = cadenaBasico;
    var Indice = 20;
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
        guardarComision(cadenaComision);
        
      } else {
        toastr.error(DesResultado, 'Error');
      }
    },'JSON');
  }
  function guardarComision(cadenaComision){
    var Procedimiento = 'ProcPersonaPago';
    var Parametros = cadenaComision;
    var Indice = 20;
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
        toastr.success(DesResultado, 'Éxito');
        $('#DivRegistroProduccionModal').modal('hide');
        ListarAsistencias();
      } else {
        toastr.error(DesResultado, 'Error');
      }
    },'JSON');
  }
  function registrarAsistencia(){
      var Procedimiento = 'ProcAsistencia';
      var Parametros =  $('#selectCodPersona').val() + '|' + 
                        $('#selectCodAsistenciaTipo').val() + '|' + 
                        COD_USUARIO + '|' +
                        $('#txtComentario').val() ;
      var Indice = 20;
      var URL = URL_BASE + 'Registros/procGeneral';
      var Data = {
          parametros: Parametros,
          indice: Indice,
          nombreProcedimiento: Procedimiento
      };
    //
      $.post(URL, Data, function (Data) {
          var codResultado = Data[0].CodResultado;
          var desResultado = Data[0].DesResultado;
          if (codResultado == 1) {
              toastr.success(desResultado, 'Éxito');
              ListarAsistencias();
              $('#DivProductoCategoriaModal').modal('hide');
          }else{
              toastr.error(DesResultado, 'Error');
          }
          
      },'JSON');
  }
  function ListarAsistencias() {
    var Procedimiento = 'ProcAsistencia';
    var Parametros = FechaMySQL($('#TxtFechaInicio').val()) + '|' + FechaMySQL($('#TxtFechaFin').val()) + '|0';
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
      $('#TbAsistenciaPersona tbody').empty();
      var FilasHTML = '';
      var CantidadFilas = Data.length;
      //
      $.each(Data, function(i) {
        FilasHTML += '<tr data-codpersona="'+ this.CodPersona+'" data-codasistenciatipo="'+ this.CodAsistenciaTipo+'" data-codasistencia="' + this.CodAsistencia +'" >' +
          '<td>' + (i + 1) + '</td>' +
          '<td>' + this.Empleado + '</td>' +
          '<td>' + this.FechaHoraInicio + '</td>' +
          '<td>' + this.FechaHoraFin + '</td>' +
          '<td>' + this.NomAsistenciaTipo + '</td>' +
          '<td>' +
            '<button type="button"  class="btn btn-'+ (this.FechaHoraFin == '' ? 'warning' : 'primary')+' btn-xs" onclick="'+  (this.FechaHoraFin == '' ? ' ' : ' disabled="disabled" ')  +'registrarSalida($(this).parent().parent())" ' + (this.FechaHoraFin == '' ? ' ' : ' disabled="disabled" ') +' ><i class="fa fa-clock-o"></i></button>' +
          '</td>' +
          '<td>' +
            '<button type="button" title="Registrar producción" class="btn btn-primary btn-xs" onclick="abrirModalRegistroProduccion($(this).parent().parent());"><i class="fa fa-money" aria-hidden="true"></i></button>' +
          '</td>' +
        '</tr>';
      });
      $('#TbAsistenciaPersona tbody').append(FilasHTML);
      $('#StnCantidadRegistros').text(CantidadFilas);
      // toastr.success('Registros cargados correctamente', 'Nota')
    }, "JSON");
  }
  function registrarSalida(elemento){

    var codAsistenciaTipo = elemento.attr('data-codasistenciatipo');
    var codPersona = elemento.attr('data-codpersona');
    var comentario = '';
    // FilasHTML += '<tr data-codpersona="'+ this.CodPersona+'" data-codasistenciatipo="'+ this.CodAsistenciaTipo+'" data-codasistencia="' + this.CodAsistencia +'" >' +

    var Procedimiento = 'ProcAsistencia';
    var Parametros = codPersona + '|' + codAsistenciaTipo + '|' + COD_USUARIO + '|' + comentario;
    var Indice = 20;
    var URL = URL_BASE + 'Registros/procGeneral';
    var Data = {
      parametros: Parametros,
      indice: Indice,
      nombreProcedimiento: Procedimiento
    };
    //
    $.post(URL, Data, function (Data) {
      var codResultado = Data[0].CodResultado;
      var desResultado = Data[0].DesResultado;
      if (codResultado == 1) {
          toastr.success(desResultado, 'Éxito');
          ListarAsistencias();
      }else{
          toastr.error(DesResultado, 'Error');
      }
    }, "JSON");
  }
  function cargarTipoAsistencia() {
    var Procedimiento = 'ProcAsistencia';
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
        $('#selectCodAsistenciaTipo').empty();
        $.each(Data, function(){
            $('#selectCodAsistenciaTipo').append('<option value="'+ this.CodAsistenciaTipo+'">' + this.NomAsistenciaTipo + '</option>');
        })
    }, "JSON");
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
      $('#selectCodPersona').empty();
      var OptionHTML = '';
      //
      $.each(Data, function(i) {
        OptionHTML += '<option value="' + this.CodPersona +'" >' + this.NomPersona + '</option>';
      });
      $('#selectCodPersona').append(OptionHTML);
      
    },'JSON');
  }

</script>