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
    max-height: 200px;
    overflow-y: auto;
    -ms-overflow-style: -ms-autohiding-scrollbar;
  }
  .table-wrapper-scroll-y table td {
    padding: 4px !important;
    vertical-align: middle !important;
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
          <h2>(<strong id="StnCantidadRegistros">-</strong>) <?=$Titulo?>  </h2>
      
      </div>
      <div class="col-lg-4">

      </div>
  </div>


  <div class="row wrapper border-bottom white-bg page-heading form-group">
    <div class="form-group col-lg-2" style="padding-top: 17px;">
      <label>Almacén</label> 
      <select class="form-control" id="SelAlmacen"></select>
    </div>

    <div class="form-group col-lg-3" style="padding-top: 17px;">
      <label>Producto</label> 
      <select id="SelProducto" data-live-search="true"></select>
    </div>

    <div class="col-lg-2 sectionfechasconsulta" style="padding-top: 17px;display:none;" > 
      <label>F.Inicio</label> 
      <input id="TxtFechaInicio" readonly class="FechaUI form-control" style="width:130px;"/>
    </div>

    <div class="col-lg-2 sectionfechasconsulta" style="padding-top: 17px;display:none;" > 
      <label>F.Fin</label> 
      <input id="TxtFechaFin" readonly class="FechaUI form-control" style="width:130px;"/>
    </div>

    <div class="col-lg-1" style="padding-top: 17px;" > 

    </div>

    <div class="col-lg-2" style="padding-top: 17px;" > 
      <label> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</label> 
      <button class="form-control btn btn-sm btn-success pull-right m-t-n-xs" style="background-color: #1c84c6;border-color: #1c84c6;color:white" type="button" onclick="ConsultaKardex()"><strong>Consulta</strong></button>
    </div>
  </div>


   <br>
   <div class="row wrapper border-bottom white-bg page-heading">
      <div class="col-lg-12">
        <br>
        <div class="table-responsive">
          <table class="table table-bordered" id="TbKardexProducto">
            <thead>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
   </div>
</div>

<script type="text/javascript">
//
var TbKardexProductoCabecera = $('#TbKardexProducto thead');
var TbKardexProductoCuerpo = $('#TbKardexProducto tbody');
var TxtFechaInicio = $('#TxtFechaInicio');
var TxtFechaFin = $('#TxtFechaFin');
var SelAlmacen = $("#SelAlmacen");
var SelProducto = $("#SelProducto");
//
$(document).ajaxStart(function(event, jqXHR, settings) {
	$('#msjload').fadeIn();
});

$(document).ajaxComplete(function(event, jqXHR, settings) {
	$('#msjload').fadeOut();
});

$(document).ready(function(){
  TxtFechaInicio.val(FechaHoraHoy(1));
  TxtFechaFin.val(FechaHoraHoy(1));
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
  SelProducto.change(function() {
    var CodProducto = this.value;
    if (CodProducto == 0) {
      // Oculta Fechas
      $('.sectionfechasconsulta').hide();
      // TxtFechaInicio.hide();
      // TxtFechaFin.hide();
    } else {
      $('.sectionfechasconsulta').show();
      // TxtFechaInicio.show();
      // TxtFechaFin.show();
    }
  });
  ListaProducto();
  ListaAlmacen();
});
var CodUsuario = '<?php echo $CodUsuario;?>';
function ConsultaKardex() {
  var CodAlmacen = SelAlmacen.val(); 
  var CodProducto = SelProducto.val(); 
  var FechaInicio =  FechaMySQL(TxtFechaInicio.val());
  var FechaFin = FechaMySQL(TxtFechaFin.val());
  var Procedimiento = 'ProcProducto';
  var Parametros = '';
  var Indice;
  if (CodProducto == 0) {
    Parametros = CodAlmacen;
    Indice = 16;
  } else {
    Parametros = CodAlmacen + '|' + CodProducto + '|' + FechaInicio + '|' + FechaFin;
    Indice = 15;
  }
  var URL = URL_BASE +'Registros/procGeneral';
  var Data = {
    parametros: Parametros,
    indice: Indice,
    nombreProcedimiento: Procedimiento
  };
  //
  $.post(URL, Data, function (Data) {
    //
    console.log("data", Data);
    //
    var selectProducto = $('#SelProducto').val();
    TbKardexProductoCabecera.empty();
    TbKardexProductoCuerpo.empty();
    var CantidadFilas = Data.length;
    var FilaCabecera = '';
    //
    if (CodProducto == 0) {
      FilaCabecera = '<tr>' +
        '<th>N</th>' +
        '<th>ALMACÉN</th>' +
        '<th>CATEGORIA</th>' +
        '<th>PRODUCTO</th>' +
        '<th class="text-right"  >INGRESO</th>' +
        '<th class="text-right"  >SALIDA</th>' +
        '<th class="text-right"  >SALDO</th>' +
      '</tr>';
    } else {
      FilaCabecera = '<tr>' +
        '<th>N</th>' +
        '<th>FECHA</th>' +
        '<th>USUARIO</th>' +
        '<th>ALMACÉN</th>' +
        '<th>DESCRIPCIÓN</th>' +
        '<th>CODIGO</th>' +
        '<th>PRODUCTO</th>' +
        '<th class="text-right" >COSTO</th>' +
        '<th class="text-right"  >CANTIDAD</th>' +
        '<th class="text-right"  >SALDO</th>' +
      '</tr>';
    }
    TbKardexProductoCabecera.append(FilaCabecera);
    //
    var FilasHTML = '';
    //
    $.each(Data, function(i) {
      if (CodProducto == 0) {
        FilasHTML += '<tr>' +
          '<td>' + (i + 1) + '</td>' +
          '<td>' + this.NomAlmacen  + '</td>' +
          '<td>' + this.NomProductoCategoria  + '</td>' +
          '<td>' + this.NomProducto + '</td>' +
          '<td class="text-right"  >' + this.TotalIngreso + '</td>' +
          '<td class="text-right"  >' + this.TotalSalida + '</td>' +
          '<td class="text-right"  >' + this.Stock + '</td>' +
        '</tr>';
      } else {
        FilasHTML += '<tr>' +
          '<td>' + (i + 1) + '</td>' +
          '<td>' + this.FechaAlmacenMovimiento  + '</td>' +
          '<td>' + this.Usuario + '</td>' +
          '<td>' + this.NomAlmacen + '</td>' +
          '<td>' + this.Movimiento + '</td>' +
          '<td>' + this.Codigo + '</td>' +
          '<td>' + this.Descripcion + '</td>' +
          '<td class="text-right"  >' + this.PrecioCosto + '</td>' +
          '<td class="text-right"  >' + this.Cantidad + '</td>' +
          '<td class="text-right"  >' + this.Saldo + '</td>' +
        '</tr>';
      }
    });
    TbKardexProductoCuerpo.append(FilasHTML);
    $('#StnCantidadRegistros').text(CantidadFilas);
    // toastr.success('Registros cargados correctamente', 'Nota')
  }, "JSON");
}
function ListaProducto() {
  var Procedimiento = 'ProcProducto';
  var Parametros = 0;
  var Indice = 12;
  var URL = URL_BASE +'Registros/procGeneral';
  var Data = {
    parametros: Parametros,
    indice: Indice,
    nombreProcedimiento: Procedimiento
  };
  $.post(URL, Data, function (Data) {
    var OptionHTML = '<option value="0">TODOS</option>';
    //
    $.each(Data, function(i) {
      OptionHTML += '<option value="' + this.CodProducto +'" >' + this.NomProducto + '</option>';
    });
    SelProducto.append(OptionHTML);
    SelProducto.selectpicker("refresh");
  },'JSON');
}
function ListaAlmacen() {
  var Procedimiento = 'ProcAlmacenMovimiento';
  var Parametros = 0;
  var Indice = 13;
  var URL = URL_BASE + 'Registros/procGeneral';
  var Data = {
    parametros: Parametros,
    indice: Indice,
    nombreProcedimiento: Procedimiento
  };
  $.post(URL, Data, function (Data) {
    var OptionHTML = '<option value="0">TODOS</option>';
    //
    $.each(Data, function(i) {
      OptionHTML += '<option value="' + this.CodAlmacen +'" >' + this.NomAlmacen + '</option>';
    });
    SelAlmacen.append(OptionHTML);
  },'JSON');
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

