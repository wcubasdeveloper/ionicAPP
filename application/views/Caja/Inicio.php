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
        <h2>Caja&nbsp;&nbsp;&nbsp;<strong id="StnCantidadRegistros">-</strong>
          <input id="TxtFechaOperacion" readonly class="FechaUI" style="width:130px;"/>
          <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="button" data-toggle="modal" data-target="#DivCajaGestion" ><strong>Abrir caja</strong></button>
        </h2>
      </div>
   </div>
   <br>
   <div class="row wrapper border-bottom white-bg page-heading">
      <div class="col-lg-12">
        <br>
        <div class="table-responsive">
          <table class="table table-bordered" id="TbCajaGestion">
            <thead>
              <tr>
                <th>N</th>
                <th>TIENDA</th>
                <th>CAJA</th>
                <th>USUARIO</th>
                <th>F.INICIO</th>
                <th>F.FIN</th>
                <th>SALDO INI</th>
                <!-- <th>IMP.INGRESO</th> -->
                <!-- <th>IMP.EGRESO</th> -->
                <th>IMP.RECUENTO</th>
                <th>ESTADO</th>
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
<!-- Modal Abrir Caja-->
<div class="modal fade" id="DivCajaGestion" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document" style="width:750px;">
      <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title" id="defaultModalLabel">Abrir Caja</h4>
          </div>
          <div class="modal-body">
            <div class="body">
              <form class="form-vertical">
                <div class="row clearfix">
                  <div class="col-md-3 form-control-label">
                    <label for="SelTienda">Tienda</label>
                  </div>
                  <div class="col-md-9">
                    <div class="form-group">
                      <div class="form-line">
                        <select id="SelTienda" class="form-control m-b"></select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row clearfix">
                  <div class="col-md-3 form-control-label">
                    <label for="SelCaja">Caja</label>
                  </div>
                  <div class="col-md-9">
                    <div class="form-group">
                      <div class="form-line">
                        <select id="SelCaja" class="form-control m-b"></select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row clearfix">
                  <div class="col-md-3 form-control-label">
                    <label for="TxtSaldoInicial">Saldo Inicial</label>
                  </div>
                  <div class="col-md-9">
                    <div class="form-group">
                      <div class="form-line">
                        <input onclick="this.select()" id="TxtSaldoInicial" class="form-control Decimal" value="0.00"/>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" id="BtnGuardar" class="btn btn-w-m btn-primary" onclick="AbrirCaja();">Abrir</button>
            <button type="button" id="BtnCerrar" class="btn btn-w-m btn-danger" data-dismiss="modal">Salir</button>
          </div>
      </div>
  </div>
</div>
<!-- Modal Cerrar caja-->
<div class="modal fade" id="DivCerrarCaja" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document" style="width:750px;">
      <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title" id="defaultModalLabel">Cerrar Caja</h4>
          </div>
          <div class="modal-body">
            <div class="body">
              <form class="form-vertical">
                <div class="row clearfix">
                  <div class="col-md-12 table-wrapper-scroll-y">
                    <div class="form-group">
                      <table class="table table-bordered" id="TbCajaGestionRecuento">
                        <thead>
                          <tr>
                            <td>DENOMINACIÓN</td>
                            <td>CANTIDAD</td>
                            <td>IMPORTE</td>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>0.10</td>
                            <td><input data-valor="0.10" onkeyup="CalculaImporte(this);" class="Decimal"/></td>
                            <td><input data-valor="0.10" onkeyup="CalculaCantidad(this);" class="Decimal"/></td>
                          </tr>
                          <tr>
                            <td>0.20</td>
                            <td><input data-valor="0.20" onkeyup="CalculaImporte(this);" class="Decimal"/></td>
                            <td><input data-valor="0.20" onkeyup="CalculaCantidad(this);" class="Decimal"/></td>
                          </tr>
                          <tr>
                            <td>0.50</td>
                            <td><input data-valor="0.50" onkeyup="CalculaImporte(this);" class="Decimal"/></td>
                            <td><input data-valor="0.50" onkeyup="CalculaCantidad(this);" class="Decimal"/></td>
                          </tr>
                          <tr>
                            <td>1.00</td>
                            <td><input data-valor="1.00" onkeyup="CalculaImporte(this);" class="Decimal"/></td>
                            <td><input data-valor="1.00" onkeyup="CalculaCantidad(this);" class="Decimal"/></td>
                          </tr>
                          <tr>
                            <td>2.00</td>
                            <td><input data-valor="2.00" onkeyup="CalculaImporte(this);" class="Decimal"/></td>
                            <td><input data-valor="2.00" onkeyup="CalculaCantidad(this);" class="Decimal"/></td>
                          </tr>
                          <tr>
                            <td>5.00</td>
                            <td><input data-valor="5.00" onkeyup="CalculaImporte(this);" class="Decimal"/></td>
                            <td><input data-valor="5.00" onkeyup="CalculaCantidad(this);" class="Decimal"/></td>
                          </tr>
                          <tr>
                            <td>10.00</td>
                            <td><input data-valor="10.00" onkeyup="CalculaImporte(this);" class="Decimal"/></td>
                            <td><input data-valor="10.00" onkeyup="CalculaCantidad(this);" class="Decimal"/></td>
                          </tr>
                          <tr>
                            <td>20.00</td>
                            <td><input data-valor="20.00" onkeyup="CalculaImporte(this);" class="Decimal"/></td>
                            <td><input data-valor="20.00" onkeyup="CalculaCantidad(this);" class="Decimal"/></td>
                          </tr>
                          <tr>
                            <td>50.00</td>
                            <td><input data-valor="50.00" onkeyup="CalculaImporte(this);" class="Decimal"/></td>
                            <td><input data-valor="50.00" onkeyup="CalculaCantidad(this);" class="Decimal"/></td>
                          </tr>
                          <tr>
                            <td>100.00</td>
                            <td><input data-valor="100.00" onkeyup="CalculaImporte(this);" class="Decimal"/></td>
                            <td><input data-valor="100.00" onkeyup="CalculaCantidad(this);" class="Decimal"/></td>
                          </tr>
                          <tr>
                            <td>200.00</td>
                            <td><input data-valor="200.00" onkeyup="CalculaImporte(this);" class="Decimal"/></td>
                            <td><input data-valor="200.00" onkeyup="CalculaCantidad(this);" class="Decimal"/></td>
                          </tr>
                        </tbody>
                        <tfoot>
                          <tr>
                            <td></td>
                            <td><input readonly id="TotalCantidad"/></td>
                            <td><input readonly id="TotalImporte"/></td>
                          <tr>
                        </tfoot>
                      </table>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" id="BtnCerrarCaja" class="btn btn-w-m btn-primary" onclick="CerrarCaja();">Cerrar Caja</button>
            <button type="button" id="BtnCerrar" class="btn btn-w-m btn-danger" data-dismiss="modal">Salir</button>
          </div>
      </div>
  </div>
</div>
<!-- Modal Ver Recuento-->
<div class="modal fade" id="DivRecuento" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document" style="width:750px;">
      <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title" id="defaultModalLabel">Detalle de Recuento</h4>
          </div>
          <div class="modal-body">
            <div class="body">
              <form class="form-vertical">
                <div class="row clearfix">
                  <div class="col-md-12 table-wrapper-scroll-y">
                    <div class="form-group">
                      <table class="table table-bordered" id="TbRecuento">
                        <thead>
                          <tr>
                            <td>N</td>
                            <td>DENOMINACIÓN</td>
                            <td>CANTIDAD</td>
                            <td style="text-align:right">IMPORTE</td>
                          </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                          <tr>
                            <td></td>
                            <td></td>
                            <td id="TdTotalCantidad"></td>
                            <td id="TdTotalImporte" style="text-align:right"></td>
                          <tr>
                        </tfoot>
                      </table>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" id="BtnCerrar" class="btn btn-w-m btn-danger" data-dismiss="modal">Salir</button>
          </div>
      </div>
  </div>
</div>

<script type="text/javascript">
//
  var TxtFechaOperacion = $('#TxtFechaOperacion');
  var TbCajaGestionCuerpo = $('#TbCajaGestion tbody');
  var TbCajaGestionRecuentoCuerpo = $('#TbCajaGestionRecuento tbody');
  var TbRecuentoCuerpo = $('#TbRecuento tbody');
  var SelTienda = $("#SelTienda");
  var SelCaja = $("#SelCaja");
  var BtnGuardar = $("#BtnGuardar");
  var TxtMotivoAnulacion = $('#TxtMotivoAnulacion');
  var BtnCerrarCaja = $('#BtnCerrarCaja');
  var CodCajaGestionGeneral = 0;
  var TxtSaldoInicial = $('#TxtSaldoInicial');
  /********************* */

// $(".Decimal").inputmask('Regex', {regex: "^[0-9]{1,6}(\\.\\d{1,2})?$"});

/** */
//

  $(document).ajaxStart(function(event, jqXHR, settings) {
    $('#msjload').fadeIn();
  });
  $(document).ajaxComplete(function(event, jqXHR, settings) {
    $('#msjload').fadeOut();
  });
  $(document).ready(function(){
    TxtFechaOperacion.val(FechaHoraHoy(1)).change(function(){
      ListarCajaGestion();
    });
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
    ListarCajaGestion();
    ListaCaja();
    ListaTienda();
  });
var CodUsuario = '<?php echo $CodUsuario;?>';
//
function ListarCajaGestion() {
  var FechaOperacion = FechaMySQL(TxtFechaOperacion.val());
  var Procedimiento = 'ProcCajaGestion';
  var Parametros = FechaOperacion;
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
    TbCajaGestionCuerpo.empty();
    var FilasHTML = '';
    var CantidadFilas = Data.length;
    //
    $.each(Data, function(i) {
      FilasHTML += '<tr data-codcajagestion="' + this.CodCajaGestion +'" >' +
        '<td>' + (i + 1) + '</td>' +
        '<td>' + this.NomTienda + '</td>' +
        '<td>' + this.NomCaja + '</td>' +
        '<td>' + this.NomUsuario + '</td>' +
        '<td>' + this.FechaHoraInicio + '</td>' +
        '<td>' + this.FechaHoraFin + '</td>' +
        '<td>' + this.SaldoInicial + '</td>' +
        // '<td>' + this.ImporteIngreso + '</td>' +
        // '<td>' + this.ImporteEgreso + '</td>' +
        '<td>' + this.ImporteRecuento + '</td>' +
        '<td>' + this.NomEstado + '</td>' +
        '<td>';
      if (this.CodEstado == 9) {
        FilasHTML += '<button data-codcajagestion="' + this.CodCajaGestion + '"' +
            ' type="button"class="btn btn-warning btn-xs" data-toggle="modal" data-target="#DivRecuento" onclick="VerRecuento(' + this.CodCajaGestion + ')"><i class="fa fa-edit"></i></button>' +
          '&nbsp;&nbsp;';
      }
      if (this.CodEstado == 8) {
        FilasHTML += '<button type="button" class="btn btn-xs" data-toggle="modal" data-target="#DivCerrarCaja" onclick="CodigoCajaGestion(' + this.CodCajaGestion + ');"><i class="fa fa-inbox"></i></button>';
      }
      FilasHTML += '</td>' +
      '</tr>';
    });
    TbCajaGestionCuerpo.append(FilasHTML);
    $('#StnCantidadRegistros').text(CantidadFilas);
    // toastr.success('Registros cargados correctamente', 'Nota')
  }, "JSON");
}
function VerRecuento(CodCajaGestion) {
  var Procedimiento = 'ProcCajaGestion';
  var Parametros = CodCajaGestion;
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
    TbRecuentoCuerpo.empty();
    var FilasHTML = '';
    var CantidadFilas = Data.length;
    var TotalCantidad = 0, TotalImporte = 0;
    //
    $.each(Data, function(i) {
      FilasHTML += '<tr>' +
        '<td>' + (i + 1) + '</td>' +
        '<td>' + this.Denominacion + '</td>' +
        '<td>' + this.Cantidad + '</td>' +
        '<td style="text-align:right">' + this.Importe + '</td>' +
      '</tr>';
      TotalCantidad += parseInt(this.Cantidad);
      TotalImporte += parseFloat(this.Importe);
    });
    TbRecuentoCuerpo.append(FilasHTML);
    $('#TdTotalCantidad').text(TotalCantidad);
    $('#TdTotalImporte').text(TotalImporte.toFixed(2));
    // toastr.success('Registros cargados correctamente', 'Nota')
  }, "JSON");
}
function ListaCaja() {
  var Procedimiento = 'ProcCajaGestion';
  var Parametros = '';
  var Indice = 15;
  var URL = URL_BASE + 'Registros/procGeneral';
  var Data = {
    parametros: Parametros,
    indice: Indice,
    nombreProcedimiento: Procedimiento
  };
  //
  SelCaja.empty();
  //
  $.post(URL, Data, function (Data) {
    var OptionHTML = '';
    //
    $.each(Data, function(i) {
      OptionHTML += '<option value="' + this.CodCaja +'" >' + this.NomCaja + ' | ' + this.SaldoActual + '</option>';
    });
    SelCaja.append(OptionHTML);

  },'JSON');
}
function ListaTienda() {
  var Procedimiento = 'ProcTienda';
  var Parametros = '';
  var Indice = 10;
  var URL = URL_BASE + 'Registros/procGeneral';
  var Data = {
    parametros: Parametros,
    indice: Indice,
    nombreProcedimiento: Procedimiento
  };
  //
  SelTienda.empty();
  //
  $.post(URL, Data, function (Data) {
    var OptionHTML = '';
    //
    $.each(Data, function(i) {
      OptionHTML += '<option value="' + this.CodTienda +'" >' + this.NomTienda + '</option>';
    });
    SelTienda.append(OptionHTML);
  },'JSON');
}
function AbrirCaja() {
  //
  var FechaOperacion = TxtFechaOperacion.val();
  var CodTienda = SelTienda.val();
  var CodCaja = SelCaja.val();
  var SaldoInicial = TxtSaldoInicial.val();
  if (SaldoInicial == '') {
    SaldoInicial = 0;
  }
  //Bloquea botón al guardar
  BtnGuardar.attr("disabled", true);
  //
  var Procedimiento = 'ProcCajaGestion';
  var Parametros = CodUsuario + '|' + FechaMySQL(FechaOperacion) + '|' + CodCaja + '|' + CodTienda + '|' + SaldoInicial;
  var Indice = 20;
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
      // $('#BtnCerrar').trigger('click');
      var nomAlmacen =  Data[0].NomAlmacen;
      var nomTienda=  Data[0].NomTienda;
	    setDataSesion(nomTienda, nomAlmacen, DesResultado );
      // Limpia
      
    } else {
      toastr.error(DesResultado, 'Error');
    }
    // Habilita botón
    BtnGuardar.removeAttr("disabled");
  }, "JSON");
}
function CodigoCajaGestion(CodCajaGestion) {
  CodCajaGestionGeneral = CodCajaGestion;
}
function setDataSesion(nomTienda, nomAlmacen, mensaje){

  var URL = URL_BASE + 'Registros/actualizarDataGlobal';
  //
  $.post(URL,  {
    nombreTienda: nomTienda,
    nombreAlmacen: nomAlmacen,
  }, function() {
    
    $('#txtNombreTiendaGeneral').text(nomTienda);
    $('#txtNombreAlmacenGeneral').text(nomAlmacen);

    $('#DivCajaGestion').modal('hide');
      ListarCajaGestion();
      ListaTienda();
      ListaCaja();
      toastr.success(mensaje, 'Éxito');
  });

}
function limpiarDataCaja(){

  var URL = URL_BASE + 'Registros/limpiarDataCaja';
  //
  $.post(URL, {}, function(DataRpta) {
  	console.log("limpiar data");
    $('#txtNombreTiendaGeneral').text('');
    $('#txtNombreAlmacenGeneral').text('');
  });

}
function CerrarCaja(CodCajaGestion) {
  // Bloquear el Botón SI
  BtnCerrarCaja.attr("disabled", true);
  //
  var RecuentoSerializa = '';
  TbCajaGestionRecuentoCuerpo.children('tr').each(function() {
    RecuentoSerializa += $(this.cells[1].children[0]).data('valor') + '*' + this.cells[1].children[0].value + '*' + this.cells[2].children[0].value + '~';
  });
  RecuentoSerializa = RecuentoSerializa.substring(0, RecuentoSerializa.length - 1);
  //
  var Procedimiento = 'ProcCajaGestion';
  var Parametros = CodCajaGestionGeneral + '|' + RecuentoSerializa  + '|' + COD_USUARIO;
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
      $('#DivCerrarCaja').modal('hide');
      ListarCajaGestion();
      ListaCaja();
      // Limpia
      TbCajaGestionRecuentoCuerpo.children('tr').each(function() {
        this.cells[1].children[0].value = '';
        this.cells[2].children[0].value = '';
      });
      limpiarDataCaja();
      toastr.success(DesResultado, 'Éxito');
    } else {
      toastr.error(DesResultado, 'Error');
    }
    // Habilita botón
    BtnCerrarCaja.removeAttr("disabled");
  }, "JSON");
}
function CalculaImporte(Input) {
  var Cantidad = parseFloat(Input.value == '' ? 0 : Input.value);
  var Valor = parseFloat($(Input).data('valor'));
  var InputImporte = Input.parentNode.parentNode.cells[2].children[0];
  InputImporte.value = (Cantidad * Valor).toFixed(2);
  CalculaTotales();
}
function CalculaCantidad(Input) {
  var Importe = parseFloat(Input.value == '' ? 0 : Input.value);
  var Valor = parseFloat($(Input).data('valor'));
  var InputCantidad = Input.parentNode.parentNode.cells[1].children[0];
  InputCantidad.value = parseInt(Importe / Valor);
  CalculaTotales();
}
function CalculaTotales() {
  var TotalCantidad = 0, TotalImporte = 0;
  var Cantidad, Importe;
  // Recorre tabla
  TbCajaGestionRecuentoCuerpo.children('tr').each(function() {
    Cantidad = this.cells[1].children[0].value;
    if (Cantidad != '') {
      TotalCantidad += parseInt(Cantidad);
    }
    //
    Importe = this.cells[2].children[0].value;
    if (Importe != '') {
      TotalImporte += parseFloat(Importe);
    }
  });
  $('#TotalCantidad').val(TotalCantidad);
  $('#TotalImporte').val(TotalImporte.toFixed(2));
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