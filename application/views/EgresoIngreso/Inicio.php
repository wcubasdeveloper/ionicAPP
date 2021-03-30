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
        <h2>Ingreso | Egreso &nbsp;&nbsp;&nbsp;<strong id="StnCantidadRegistros">-</strong>
        <input id="TxtFechaInicio" readonly class="FechaUI" style="width:130px;"/>
          <input id="TxtFechaFin" readonly class="FechaUI" style="width:130px;"/>
          <select id="SelCajaMovimientoTipo">
            <option value="0">TODOS</option>
            <option value="2">EGRESO</option>
            <option value="1">INGRESO</option>            
          </select>
          <button id="BtnNuevoEgresoIngreso" class="btn btn-sm btn-primary pull-right m-t-n-xs" type="button" data-toggle="modal" data-target="#DivEgresoIngresoModal" ><strong>Registrar Egreso/Ingreso</strong></button>
        </h2>
      </div>
   </div>
   <br>
   <div class="row wrapper border-bottom white-bg page-heading">
      <div class="col-lg-12">
        <br>
        <div class="table-responsive">
          <table class="table table-bordered" id="TbEgresosIngresos">
            <thead>
              <tr>
                <th>N</th>
                <th>FECHA</th>
                <th>DOCUMENTO</th>
                <th>PERSONA</th>
                <th class="text-right" >IMPORTE</th>
                <th>CONCEPTO</th>
                <th>USUARIO</th>
                <th>F.CREACIÓN</th>
                <th>ESTADO</th>
                <th>TIPO</th>
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
<!-- Modal Guardar Egreso - Ingreso-->
<div class="modal fade" id="DivEgresoIngresoModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document" style="width:450px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="EgresoIngresoModalTitulo">Registrar movimiento</h4>
      </div>
      <div class="modal-body">
        <div class="body">
          <form class="form-vertical">
            <div class="row clearfix">
              <div class="col-md-3 form-control-label">
                <label >Fecha</label>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <div class="form-line">
                    <input id="TxtFechaEgresoIngreso" type="text" value="" class="form-control FechaUI" required="">
                  </div>
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-md-3 form-control-label">
                <label >Persona</label>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <div class="form-line">
                    <select class="form-control m-b" id="SelPersona">
                    </select>
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
                    <select class="form-control m-b" id="SelCajaMovimientoTipoReg">
                        <option value="2">Egreso</option>
                        <option value="1">Ingreso</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-md-3 form-control-label">
                <label >Categoria</label>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <div class="form-line">
                    <select class="form-control m-b" id="SelCajaMovimientoCategoria"></select>
                  </div>
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-md-3 form-control-label">
                <label >Concepto</label>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <div class="form-line">
                    <select class="form-control m-b" id="SelConcepto">
                    </select>
                  </div>
                </div>
              </div>
            </div>

            <div class="row clearfix">
              <div class="col-md-3 form-control-label">
                <label >Importe</label>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <div class="form-line">
                    <input id="TxtImporte" type="text" style="text-align:right" onkeypress="return Util.SoloDecimal(event, this);" value="" class="form-control" required="">
                  </div>
                </div>
              </div>
            </div>

            <div class="row clearfix">
              <div class="col-md-3 form-control-label">
                <label >Comentario</label>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <div class="form-line">
                    <textarea id="TxtComentario" class="form-control" rows="2" ></textarea>
                  </div>
                </div>
              </div>
            </div>

          </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="BtnGuardar" class="btn btn-w-m btn-primary" onclick="registrarEgresoIngreso();">Guardar</button>
        <button type="button" id="BtnCerrar" class="btn btn-w-m btn-danger" data-dismiss="modal">Salir</button>
      </div>
      </div>
  </div>
</div>

<!-- Modal Anular Egreso Ingreso-->
<div class="modal fade" id="DivEgresoIngresoAnularModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header ui-draggable-handle">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 style="font-weight:100" >Anular registro</h4>
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
            <button id="BtnAnularSI" type="button" class="btn btn-w-m btn-primary" onclick="AnularEgresoIngreso();">SI</button>
            <button type="button" class="btn btn-w-m btn-danger" data-dismiss="modal" onclick="LimpiarModalAnularEgresoIngreso();">NO</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>

var TxtFechaInicio = $('#TxtFechaInicio');
var TxtFechaFin = $('#TxtFechaFin');
var SelCajaMovimientoTipo = $('#SelCajaMovimientoTipo');
var SelCajaMovimientoCategoria = $('#SelCajaMovimientoCategoria');

var TxtFechaEgresoIngreso = $('#TxtFechaEgresoIngreso');
var SelPersona = $('#SelPersona');
var SelCajaMovimientoTipoReg = $('#SelCajaMovimientoTipoReg');
var SelConcepto = $('#SelConcepto');
var TxtImporte = $('#TxtImporte');
var TxtComentario = $('#TxtComentario');
var TxtMotivoAnulacion = $('#TxtMotivoAnulacion');

var CodCajaMovimientoAnular = 0;


$(document).ajaxStart(function(event, jqXHR, settings) {
	$('#msjload').fadeIn();
});
$(document).ajaxComplete(function(event, jqXHR, settings) {
	$('#msjload').fadeOut();
});

$(document).ready(function(){
    TxtFechaInicio.val(PrimerDiaMes(FechaHoraHoy(1)));
    TxtFechaFin.val(FechaHoraHoy(1));
    TxtFechaEgresoIngreso.val(FechaHoraHoy(1));
    ListarCajaMovimientoCategoria();
    ListarPersona();

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
    SelCajaMovimientoTipoReg.change(function() {
      ListarCajaMovimientoCategoria();
    });
    SelCajaMovimientoCategoria.change(function() {
      ListarCajaMovimientoConcepto();
    });
    ListarEgresosIngresos();

    TxtFechaInicio.change(function(){
      ListarEgresosIngresos();
    })

    TxtFechaFin.change(function(){
      ListarEgresosIngresos();
    })

    SelCajaMovimientoTipo.change(function(){
      ListarEgresosIngresos();
    })
});

function ListarCajaMovimientoCategoria(){
    var CodCajaMovimientoTipo = SelCajaMovimientoTipoReg.val();
    var Procedimiento = 'ProcCajaMovimiento';
    var Parametros = CodCajaMovimientoTipo;
    var Indice = 13;
    var URL = URL_BASE + 'Registros/procGeneral';
    var Data = {
        parametros: Parametros,
        indice: Indice,
        nombreProcedimiento: Procedimiento
    };
    SelCajaMovimientoCategoria.empty();
    $.post(URL, Data, function (Data) {
        var OptionHTML = '';
        $.each(Data, function(i) {
          OptionHTML += '<option value="' + this.CodCajaMovimientoCategoria +'" >' + this.NomCajaMovimientoCategoria + '</option>';
        });
        SelCajaMovimientoCategoria.append(OptionHTML);
        ListarCajaMovimientoConcepto();
    },'JSON');
}
function ListarCajaMovimientoConcepto(){
    var CodCajaMovimientoCategoria = SelCajaMovimientoCategoria.val();
    var Procedimiento = 'ProcCajaMovimiento';
    var Parametros = CodCajaMovimientoCategoria;
    var Indice = 11;
    var URL = URL_BASE + 'Registros/procGeneral';
    var Data = {
        parametros: Parametros,
        indice: Indice,
        nombreProcedimiento: Procedimiento
    };
    SelConcepto.empty();
    $.post(URL, Data, function (Data) {
        var OptionHTML = '';
        $.each(Data, function(i) {
        OptionHTML += '<option value="' + this.CodCajaMovimientoConcepto +'" >' + this.NomCajaMovimientoConcepto + '</option>';
        });
        SelConcepto.append(OptionHTML);
        
    },'JSON');
}

function registrarEgresoIngreso(){
    if(TxtImporte.val() == ''){
        TxtImporte.focus().select();
        return;
    }

    if(TxtComentario.val() == ''){
        TxtComentario.focus().select();
        return;
    }

    var Procedimiento = 'ProcCajaMovimiento';
    var Parametros = FechaMySQL(TxtFechaEgresoIngreso.val()) + '|' + SelPersona.val() + '|' + SelConcepto.val() + '|' + TxtImporte.val() + '|' + TxtComentario.val() + '|' + COD_USUARIO + '|' + SelCajaMovimientoTipoReg.val() ;
    var Indice = 20;
    var URL = URL_BASE + 'Registros/procGeneral';
    var Data = {
        parametros: Parametros,
        indice: Indice,
        nombreProcedimiento: Procedimiento
    };

    $.post(URL, Data, function (Data) {
        var codResultado = Data[0].CodResultado;
        var desResultado = Data[0].DesResultado;
        if (codResultado == 1) {
            toastr.success(desResultado, 'Éxito');
            ListarEgresosIngresos();
            TxtImporte.val('');
            TxtComentario.val('');
            $('#DivEgresoIngresoModal').modal('hide');
        }else{
            toastr.error(desResultado, 'Error');
        }
        
    },'JSON');
}


function ListarEgresosIngresos() {
  var Procedimiento = 'ProcCajaMovimiento';
  var Parametros = FechaMySQL(TxtFechaInicio.val()) + '|' + FechaMySQL(TxtFechaFin.val()) + '|' + SelCajaMovimientoTipo.val();
  var Indice = 10;
  var URL = URL_BASE + 'Registros/procGeneral';
  var Data = {
    parametros: Parametros,
    indice: Indice,
    nombreProcedimiento: Procedimiento
  };
  //
  $.post(URL, Data, function (Data) {
    $('#TbEgresosIngresos tbody').empty();
    var FilasHTML = '';
    var CantidadFilas = Data.length;
    //
    $.each(Data, function(i) {
      FilasHTML += '<tr data-codasistencia="' + this.CodAsistencia +'" >' +
        '<td>' + (i + 1) + '</td>' +
        '<td>' + this.FechaCajaMovimiento + '</td>' +
        '<td>' + this.Documento + '</td>' +
        '<td>' + this.Persona + '</td>' +
        '<td class="text-right">' + this.ImporteMovimiento + '</td>' +
        '<td>' + this.NomCajaMovimientoConcepto + '</td>' +
        '<td>' + this.NomUsuario + '</td>' +
        '<td>' + this.FechaCreacion + '</td>' +
        '<td>' + this.NomEstado + '</td>' +
        '<td>' + this.NomCajaMovimientoTipo + '</td>' +
        '<td>' +
          '<button ' + (this.NomEstado == 'ANULADO' ? ' disabled="disabled" ': ' ' )+' type="button" data-toggle="modal" data-target="#DivEgresoIngresoAnularModal" class="btn btn-danger btn-xs" onclick="CodCajaGestionMovimientoAnular('+ this.CodCajaMovimiento +')" ><i class="fa fa-trash"></i></button>' +
        '</td>' +
      '</tr>';
    });
    $('#TbEgresosIngresos tbody').append(FilasHTML);
    $('#StnCantidadRegistros').text(CantidadFilas);
    // toastr.success('Registros cargados correctamente', 'Nota')
  }, "JSON");
}

function CodCajaGestionMovimientoAnular(CodCajaMovimiento){
  CodCajaMovimientoAnular = CodCajaMovimiento;
}

function AnularEgresoIngreso(){
  var comentario = TxtMotivoAnulacion.val();

  var Procedimiento = 'ProcCajaMovimiento';
  var Parametros = CodCajaMovimientoAnular + '|' + COD_USUARIO + '|' + comentario;
  var Indice = 30;
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
      ListarEgresosIngresos();
      TxtMotivoAnulacion.val('');
      $('#DivEgresoIngresoAnularModal').modal('hide');
      toastr.success(DesResultado, 'Éxito');
    } else {
      toastr.error(DesResultado, 'Error');
    }
  },'JSON');
}

function LimpiarModalAnularEgresoIngreso(){
  TxtMotivoAnulacion.val('');
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
    if (Hora < 3) {
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
function PrimerDiaMes(Fecha) {
  var FechaArray = Fecha.split('/');
  var Fecha = 1 + '/' + FechaArray[1] + '/' + FechaArray[2];
  return Fecha;
}
</script>