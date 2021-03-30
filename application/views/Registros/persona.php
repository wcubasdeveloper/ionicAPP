<!-- <link href="<?=base_url()?>assets/csoftcontent/js/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" /> -->
<!-- <script src="<?=base_url()?>assets/csoftcontent/js/plugins/bootstrap-select/bootstrap-select.min.js"></script> -->
<link href="<?=base_url()?>assets/csoftcontent/js/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
<script src="<?=base_url()?>assets/csoftcontent/js/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="<?=base_url()?>assets/csoftcontent/js/plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script>

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
          <h2>(<strong id="cantPersonas">-</strong>) <?=$Titulo?>  <i title="Agregar nueva categoría"  onclick="abrirDialogRegistra();"  style="cursor:pointer;color:#1ab394" class="fa fa-plus"></i> </h2>
      
      </div>
      <div class="col-lg-4">

      </div>
  </div>

  <br>
  <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
      <br>
      <div class="table-responsive">
        <table class="table table-bordered" id="tbPersonas">
          <thead>
            <tr>
              <th>N</th>
              <th>CODIGO</th>
              <th>NOMBRES</th>
              <th>T.DOCU</th>
              <th>N.DOCU</th>
              <th>TIPO</th>
              <th>BÁSICO</th>
              <th style="text-align:right;">COMISION %</th>
              <th style="width:92px;">ACCIONES</th>
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
      <div class="modal-body">
        <div class="body">
          <form class="form-vertical">
            <div class="row clearfix">
              <div class="col-md-12 form-control-label">
                <input type="hidden" id="codigopersonaelimina">
                <h4>Motivo</h4>
                <textarea id="txtmotivoelimina" class="form-control" rows="2" id="comment"></textarea>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-w-m btn-primary" onclick="eliminarpersona();"  >SI</button>
        <button type="button" class="btn btn-w-m btn-danger" data-dismiss="modal">NO</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal persona-->
<div class="modal fade" id="modalpersona" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header ui-draggable-handle">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="etiquetamodal" data-codpersona="" data-tipomodal="" >-</h4>
      </div>
      <div id="ContenidoDialog">
        <div id="divCrearChip">
          <div class="modal-body">
            <div class="body">
              <form class="form-vertical">
                <div class="row clearfix">
                  <div class="col-md-3 form-control-label">
                    <label for="email_address_2">Código:</label>
                  </div>
                  <div class="col-md-7">
                    <div class="form-group">
                      <div class="form-line">
                        <input id="txtcodigo" onkeypress="return Util.SoloNumero(event, this);"  type="text" value="" class="form-control" required="" autofocus="">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row clearfix">
                  <div class="col-md-3 form-control-label">
                    <label for="email_address_2">Nombres:</label>
                  </div>
                  <div class="col-md-7">
                    <div class="form-group">
                      <div class="form-line">
                        <input id="txtnombres"  type="text" value="" class="form-control" required="" autofocus="">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row clearfix">
                  <div class="col-md-3 form-control-label">
                      <label for="email_address_2">A.Paterno:</label>
                  </div>
                  <div class="col-md-7">
                    <div class="form-group">
                      <div class="form-line">
                        <input id="txtapepat"  type="text" value="" class="form-control" required="" autofocus="">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row clearfix">
                  <div class="col-md-3 form-control-label">
                    <label for="email_address_2">A.Materno:</label>
                  </div>
                  <div class="col-md-7">
                    <div class="form-group">
                      <div class="form-line">
                        <input id="txtapemat"  type="text" value="" class="form-control" required="" autofocus="">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row clearfix">
                  <div class="col-md-3 form-control-label">
                    <label for="email_address_2">Alias:</label>
                  </div>
                  <div class="col-md-7">
                    <div class="form-group">
                      <div class="form-line">
                        <input id="TxtAlias" type="text" value="" class="form-control" required="" autofocus="">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row clearfix">
                  <div class="col-md-3 form-control-label">
                    <label for="email_address_2">T.Documento:</label>
                  </div>
                  <div class="col-md-7">
                    <div class="form-group">
                      <div class="form-line">
                        <select id="txtselecttipodocu" class="form-control m-b" name="account">
                          <option value="1">DNI</option>
                          <option value="2">C.EXTRANJERIA</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row clearfix">
                  <div class="col-md-3 form-control-label">
                    <label for="email_address_2">N.Documento:</label>
                  </div>
                  <div class="col-md-7">
                    <div class="form-group">
                      <div class="form-line">
                        <input id="txtnumdocumento"  type="text" onkeypress="return Util.SoloDecimal(event, this);" value="" class="form-control" required="" autofocus="">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row clearfix">
                  <div class="col-md-3 form-control-label">
                    <label for="email_address_2">Tipo:</label>
                  </div>
                  <div class="col-md-7">
                    <div class="form-group">
                      <div class="form-line">
                        <select id="txttipodocumento" class="form-control m-b" name="account">
                          <option value="1">TIPO 1</option>
                          <option value="2">TIPO 2</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row clearfix">
                  <div class="col-md-3 form-control-label">
                    <label for="email_address_2">Básico:</label>
                  </div>
                  <div class="col-md-7">
                    <div class="form-group">
                      <div class="form-line">
                        <input id="txtbasico"  type="text" onkeypress="return Util.SoloDecimal(event, this);" value="" class="form-control" required="" autofocus="">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row clearfix">
                  <div class="col-md-3 form-control-label">
                    <label for="email_address_2">Comision:</label>
                  </div>
                  <div class="col-md-7">
                    <div class="form-group">
                      <div class="form-line">
                        <input type="checkbox" id="ChkComision" onclick="verificartxtcomision($(this));">
                        <input id="txtcomisionporcentaje" onkeypress="return Util.SoloDecimal(event, this);" onkeyup="verificarporcentaje($(this));" style="width: 100px;display: -webkit-inline-box;display:none;" type="text" value="" class="form-control">
                        <strong id="lblporcentaje" style="display:none;">%</strong>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-w-m btn-primary" onclick="guardarpersona();"  >Guardar</button>
            <button type="button" class="btn btn-w-m btn-danger" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal persona Programacion-->
<div class="modal fade" id="ModalPersonaProgramacion" role="dialog">
  <div class="modal-dialog" style="min-width:70%;">
    <div class="modal-content">
      <div class="modal-header ui-draggable-handle">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="HTituloModalPersona" data-codpersona="" data-tipomodal="" >Programación</h4>
      </div>
      <div class="modal-body">
        <div class="body">
          <div class="row clearfix">
            <div class="col-md-2 form-control-label">
              <label for="TxtHoraInicio">Horario Trabajo:</label>
            </div>
            <div class="col-md-2">
              <input id="TxtHoraInicio" type="text" value="" class="form-control HoraUI">
            </div>
            <div class="col-md-2">
              <input id="TxtHoraFin" type="text" value="" class="form-control HoraUI">
            </div>
            <div class="col-md-2">
              <button class="btn btn-sm btn-primary" type="button" onclick="GuardarPersonaHorario();"><strong>Guardar Horario</strong></button>
            </div>
          </div>
          <br />
          <div class="row clearfix">
            <div class="col-md-2 form-control-label">
              <label for="TxtFechaInicioProgra">Fecha Inicio:</label>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <div class="form-line">
                  <input id="TxtFechaInicioProgra" type="text" value="" class="form-control FechaUI" required="" >
                </div>
              </div>
            </div>
            <div class="col-md-2 form-control-label">
              <label for="TxtFechaFinProgra">Fecha Fin:</label>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <div class="form-line">
                  <input id="TxtFechaFinProgra" type="text" value="" class="form-control FechaUI" required="" >
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <div class="form-line">
                  <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit" onclick="GuardarPersonaProgramacion();"><strong>Programar Asistencia</strong></button>
                </div>
              </div>
            </div>
          </div>
          <div class="row clearfix">
            <div class="col-lg-12">
              <br>
              <div class="table-responsive">
                <table class="table table-bordered" id="TbPersonaProgramacion">
                  <thead>
                    <tr>
                      <th>N</th>
                      <th>FECHA</th>
                      <th>H.INI.P</th>
                      <th>H.FIN.P</th>
                      <th>H.INI.R</th>
                      <th>H.FIN.R</th>
                      <th>MIN.TARDE</th>
                      <th>IMP.DSCTO</th>
                      <th>IMP.BASIC</th>
                      <th>IMP.COMIS</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-w-m btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  var TxtAlias = $('#TxtAlias');
  var ModalPersonaProgramacion = $('#ModalPersonaProgramacion');
  var CuerpoTbPersonaProgramacion = $('#TbPersonaProgramacion tbody');
  var TxtFechaInicioProgra = $('#TxtFechaInicioProgra');
  var TxtFechaFinProgra = $('#TxtFechaFinProgra');
  var TxtHoraInicio = $('#TxtHoraInicio');
  var TxtHoraFin = $('#TxtHoraFin');
  var CodPersonaGeneral = 0;

  $(document).ready(function(){
    listaPersonas();
    cargarTipoPersona();
    //
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
    $('.HoraUI').inputmask('hh:mm', { placeholder: '__:__' });
    //
    TxtFechaInicioProgra.val(FechaHoraHoy(1));
    TxtFechaFinProgra.val(FechaHoraHoy(1));
  });

  function listaPersonas(fecha){

    if ( $.fn.DataTable.isDataTable('#tbPersonas') ) {
      $('#tbPersonas').DataTable().destroy();
    }

    var parametros = '';
    var indice = 10;
    var nomproc = "ProcPersona";

    $.post(URL_BASE+'Registros/procGeneral', {parametros: parametros,
        indice: indice,nombreProcedimiento:nomproc}, function (respuesta) {


      $('#tbPersonas tbody').empty();
      var htmlStrTabla = '';
      var cantidadPersonas = respuesta.length;

      $.each(respuesta,function(i){
        htmlStrTabla += '<tr data-codpersona="'+ this.CodPersona+'" >'+
            '<td>' + (i + 1) + '</td>'+
            '<td>' + this.CodigoInterno + '</td>'+
            '<td>' + this.Nombres + '</td>'+
            '<td style="text-align:right;">' + this.TipoDocumento + '</td>'+
            '<td style="text-align:right;" >' + this.NumDocumento + '</td>'+
            '<td style="text-align:right;" >' + this.NomPersonaTipo + '</td>'+
            '<td style="text-align:right;" >' + this.BasicoDiario + '</td>'+
            '<td style="text-align:right;" >' + this.ComisionPorcentaje + '</td>'+
            '<td>' +
              '<button data-toggle="tooltip" dat-placement="top" title="Prueba"'+
              ' data-cod="'+this.CodPersona+'" '+
              ' data-codigo="'+this.CodigoInterno+'" '+
              ' data-nombre="'+this.NomPersona+'" '+
              ' data-apepat="'+this.PaternoPersona+'" '+
              ' data-apemat="'+this.MaternoPersona+'" '+
              ' data-tdocumento="'+this.CodPersonaTipoDocumento+'" '+
              ' data-numdocumento="'+this.NumDocumento+'" '+
              ' data-tipopersona="'+ this.CodPersonaTipo +'" '+
              ' data-basico="'+ this.BasicoDiario +'" '+
              ' data-porcentajecomision="' + this.ComisionPorcentaje +'" '+
              ' data-alias="' + this.Alias +'" '+
              ' data-horainicio="' + this.HoraInicio +'" '+
              ' data-horafin="' + this.HoraFin +'" '+
              ' type="button" class="btn btn-warning btn-xs" onclick="actualizarPersona($(this))"><i class="fa fa-edit"></i></button>' +
              '&nbsp;'+
              '<button type="button" class="btn btn-danger btn-xs" onclick="abrirmodalConfirmacion(' + this.CodPersona + ')" ><i class="fa fa-trash"></i></button>' +
              '&nbsp;'+
              '<button type="button" data-horainicio="' + this.HoraInicio + '" data-horafin="' + this.HoraFin + '" class="btn btn-warning btn-xs" onclick="AbrirModalPersonaProgramacion(' + this.CodPersona + ', this)" ><i class="fa fa-clock-o"></i></button>' +
            '</td>'+
          '</tr>';
        })
      $('#tbPersonas tbody').append(htmlStrTabla);
      $('#cantPersonas').text(cantidadPersonas);
      $('#tbPersonas').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
        //$.notify(respuesta[0].DesResultado,(respuesta[0].CodResultado == 1  ? "success" : "error" ) );
      toastr.success('Registros cargados correctamente', 'Nota')
    },"JSON");
  }

  function abrirDialogRegistra(){

    $('#txtcodigo').val('');
    $('#txtnombres').val('');
    $('#txtapepat').val('');
    $('#txtapemat').val('');

    $("#txtselecttipodocu").val($("#txtselecttipodocu option:first").val());
    $('#txtnumdocumento').val('');
    $("#txttipodocumento").val($("#txttipodocumento option:first").val());
    $('#txtbasico').val('');

    $('#etiquetamodal').text("Registrar persona.");
    $('#etiquetamodal').attr("data-tipomodal",'registra');

    $('#ChkComision').prop('checked',false);
    $('#txtcomisionporcentaje').val('').css('display','none');
    $('#lblporcentaje').css('display','none');
    TxtAlias.val('');

    $('#modalpersona').modal('show');
    //$("#modalpersona").draggable({
      //  handle: ".modal-header"
    //});
  }

  function guardarpersona(){

    var codigo  = $('#txtcodigo').val();
    var nombres  = $('#txtnombres').val();
    var apepat  = $('#txtapepat').val();
    var apemat  = $('#txtapemat').val();
    var Alias = TxtAlias.val();
    var tipodocu  = $('#txtselecttipodocu').val();
    var numerodocu  = $('#txtnumdocumento').val();
    var tipopersona  = $('#txttipodocumento').val();
    var basico  = $('#txtbasico').val();
    var porcentajecomision  = $('#txtcomisionporcentaje').val();

    if(codigo == ""){
      toastr.warning('Debe ingresar un el código del persona!');
      $('#txtcodigo').focus();
      return;
    }

    if(nombres == ""){
      toastr.warning('Debe ingresar un el nombres de la persona!');
      $('#txtnombre').focus();
      return;
    }

    var tipomodal = $('#etiquetamodal').attr('data-tipomodal');
    var parametros = '';

    if(tipomodal == 'modifica'){
      var codpersona = $('#etiquetamodal').attr("data-codpersona");
      parametros =  codpersona +'|'+
        codigo + '|' +
        nombres + '|' +
        apepat + '|' +
        apemat + '|' +
        tipodocu + '|' +
        numerodocu+ '|' +
        tipopersona+ '|' +
        basico + '|' +
        porcentajecomision + '|' +
        Alias + '|' +
        COD_USUARIO;
    } else { // INSERTA
      parametros = codigo + '|' +
        nombres + '|' +
        apepat + '|' +
        apemat + '|' +
        tipodocu + '|' +
        numerodocu + '|' +
        tipopersona + '|' +
        COD_USUARIO + '|' +
        basico + '|' +
        porcentajecomision + '|' +
        Alias;
    }

    var indice = (tipomodal == 'modifica' ? 30 :20);
    var nomproc = "ProcPersona";

    $.post(URL_BASE+'Registros/procGeneral', {
      parametros: parametros,
      indice: indice,
      nombreProcedimiento:nomproc
    }, function (respuesta) {
      var codresultado = Number(respuesta[0].CodResultado);
      var desresultado = respuesta[0].DesResultado;

      if(codresultado == 1){
        $('#modalpersona').modal('hide');
        toastr.success(desresultado, 'Éxito');
        listaPersonas();
      }else{
        toastr.error(desresultado, 'Error!')
      }
    },"JSON");
  }

  function abrirmodalConfirmacion(codpersona){
    $('#txtmotivoelimina').val('')
    $('#codigopersonaelimina').val(codpersona);
    $('#modalConfirmacion').modal('show');
  }

  function AbrirModalPersonaProgramacion(CodPersona, Boton) {
    var HoraInicio = $(Boton).data('horainicio');
    var HoraFin = $(Boton).data('horafin');
    CodPersonaGeneral = CodPersona;
    //
    TxtHoraInicio.val(HoraInicio);
    TxtHoraFin.val(HoraFin);
    //
    ListaPersonaProgramacion(CodPersona);
    ModalPersonaProgramacion.modal('show');
  }

  function ListaPersonaProgramacion(CodPersona){
    var Parametros = CodPersona;
    var Procedimiento = "ProcPersonaProgramacion";
    var Indice = 10;
    var URL = URL_BASE + 'Registros/procGeneral';
    var Data = {
      parametros: Parametros,
      indice: Indice,
      nombreProcedimiento: Procedimiento
    }
    //
    $.post(URL, Data, function (respuesta) {
      //
      CuerpoTbPersonaProgramacion.empty();
      var htmlStrTabla = '';
      var cantidadPersonas = respuesta.length;
      var FechaInicioProgra, FechaFinProgra;
      //
      $.each(respuesta, function(i) {
        htmlStrTabla += '<tr>'+
          '<td>' + (i + 1) + '</td>'+
          '<td>' + this.Fecha + '</td>'+
          '<td>' + this.HoraInicioProgra + '</td>'+
          '<td>' + this.HoraFinProgra + '</td>'+
          '<td>' + this.HoraInicioReal + '</td>'+
          '<td>' + this.HoraFinReal + '</td>'+
          '<td>' + this.MinutosTarde + '</td>'+
          '<td>' + this.ImporteDescuento + '</td>'+
          '<td>' + this.ImporteBasico + '</td>'+
          '<td>' + this.ImporteComision + '</td>'+
        '</tr>';
        FechaInicioProgra = this.FechaInicioProgra;
        FechaFinProgra = this.FechaFinProgra;
      });
      CuerpoTbPersonaProgramacion.append(htmlStrTabla);
      TxtFechaInicioProgra.val(FechaInicioProgra);
      TxtFechaFinProgra.val(FechaFinProgra);
      // toastr.success('Registros cargados correctamente', 'Nota')
    },"JSON");
  }
  function GuardarPersonaHorario() {
    var HoraInicio = TxtHoraInicio.val();
    var HoraFin = TxtHoraFin.val();

    if (HoraInicio == "") {
      toastr.warning('Falta hora inicio!');
      TxtFechaInicioProgra.focus();
      return;
    }
    if (HoraFin == "") {
      toastr.warning('Falta hora fin!');
      TxtFechaFinProgra.focus();
      return;
    }
    //
    var Procedimiento = 'ProcPersona';
    var Parametros = CodPersonaGeneral + '|' + HoraInicio + '|' + HoraFin + '|' + COD_USUARIO;
    var Indice = 31;
    var URL = URL_BASE + 'Registros/procGeneral';
    var Data = {
      parametros: Parametros,
      indice: Indice,
      nombreProcedimiento: Procedimiento
    }
    //
    $.post(URL, Data, function (Data) {
      var CodResultado = Number(Data[0].CodResultado);
      var DesResultado = Data[0].DesResultado;

      if (CodResultado == 1) {
        toastr.success(DesResultado, 'Éxito');
      } else {
        toastr.error(DesResultado, 'Error!')
      }
    },"JSON");
  }
  function GuardarPersonaProgramacion(){
    var FechaInicioProgra = TxtFechaInicioProgra.val();
    var FechaFinProgra = TxtFechaFinProgra.val();

    if (FechaInicioProgra == "") {
      toastr.warning('Falta fecha inicio!');
      TxtFechaInicioProgra.focus();
      return;
    }
    if (FechaFinProgra == "") {
      toastr.warning('Falta fecha fin!');
      TxtFechaFinProgra.focus();
      return;
    }
    FechaInicioProgra = FechaMySQL(FechaInicioProgra)
    FechaFinProgra = FechaMySQL(FechaFinProgra)
    //
    var Procedimiento = 'ProcPersonaProgramacion';
    var Parametros = CodPersonaGeneral + '|' + FechaInicioProgra + '|' + FechaFinProgra + '|' + COD_USUARIO;
    var Indice = 20;
    var URL = URL_BASE + 'Registros/procGeneral';
    var Data = {
      parametros: Parametros,
      indice: Indice,
      nombreProcedimiento: Procedimiento
    }
    //
    $.post(URL, Data, function (Data) {
      var CodResultado = Number(Data[0].CodResultado);
      var DesResultado = Data[0].DesResultado;

      if (CodResultado == 1) {
        toastr.success(DesResultado, 'Éxito');
        ListaPersonaProgramacion(CodPersonaGeneral);
      } else {
        toastr.error(DesResultado, 'Error!')
      }
    },"JSON");
  }

  function eliminarpersona(){
    var Personaseleccionado = $('#codigopersonaelimina').val();
    var motivoEliminar= $('#txtmotivoelimina').val();

    if(motivoEliminar == ""){
      toastr.warning('Debe ingresar un motivo para eliminar el registro!');
      return;
    }

    var parametros = Personaseleccionado + '|' +
                    1 + '|' +
                    motivoEliminar;
    var indice = 40;
    var nomproc = "Procpersona";

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
          listaPersonas();
        }else{
          toastr.error(desresultado, 'Error!')
        }
    },"JSON");
  }

  function actualizarPersona(element){

    var codpersona = element.attr('data-cod');
    var codigo = element.attr('data-codigo');
    var nombre = element.attr('data-nombre');
    var apepat = element.attr('data-apepat');
    var apemat = element.attr('data-apemat');
    var tipodocu = element.attr('data-tdocumento');
    var numdocu = element.attr('data-numdocumento');
    var tipopersona = element.attr('data-tipopersona');
    var basico = element.attr('data-basico');
    var dataporcentajecomision = element.attr('data-porcentajecomision');
    var Alias = element.attr('data-alias');
    $('#modalpersona').modal('show');
    $('#etiquetamodal').text("Modificar persona");
    $('#etiquetamodal').attr("data-tipomodal",'modifica');
    $('#etiquetamodal').attr("data-codpersona",codpersona);

    $('#txtcodigo').val(codigo);
    $('#txtnombres').val(nombre);
    $('#txtapepat').val(apepat);
    $('#txtapemat').val(apemat);
    $('#txtselecttipodocu').val(tipodocu);
    $('#txtnumdocumento').val(numdocu);
    $('#txttipodocumento').val(tipopersona);
    $('#txtbasico').val(basico);
    TxtAlias.val(Alias);

    dataporcentajecomision = Number(dataporcentajecomision);
    if(dataporcentajecomision == 0){
      $('#ChkComision').prop('checked',false);
      $('#txtcomisionporcentaje').css('display','none');
      $('#lblporcentaje').css('display','none');
    }else{
      $('#ChkComision').prop('checked',true);
      $('#txtcomisionporcentaje').css('display','-webkit-inline-box').val(dataporcentajecomision.toFixed(2));
      $('#lblporcentaje').css('display','');
    }


  }

  function cargarTipoPersona(){
    var parametros = '';
    var indice = 11;
    var nomproc = "Procpersona";
    $.post(URL_BASE+'Registros/procGeneral', {
      parametros: parametros,
      indice: indice,
      nombreProcedimiento:nomproc
    }, function (respuesta) {
      $('#txttipodocumento').empty();
      $.each(respuesta,function(){
          $('#txttipodocumento').append('<option value="'+this.Codigo+'" >'+this.Nombre+'</option>');
      })
    },"JSON")
  }

  function verificartxtcomision(elementocheck){
    var ischeckedcomision = elementocheck.is(':checked');
    if(ischeckedcomision){
      $('#txtcomisionporcentaje').css('display','-webkit-inline-box').focus();
      $('#lblporcentaje').css('display','');
    }else{
      $('#txtcomisionporcentaje').css('display','none');
      $('#lblporcentaje').css('display','none');

    }
  }

  function verificarporcentaje(elemento){
    var numeroingresado = Number(elemento.val());
    if(numeroingresado > 100){
      elemento.val(100)
    }
  }
  function FechaMySQL(Fecha) {
    var FechaArray = Fecha.split('/');
    var Fecha = FechaArray[2] + '-' + FechaArray[1] + '-' + FechaArray[0];
    return Fecha;
  }
</script>