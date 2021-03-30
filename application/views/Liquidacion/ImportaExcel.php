<link href="<?=base_url()?>assets/csoftcontent/js/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
<script src="<?=base_url()?>assets/csoftcontent/js/plugins/bootstrap-select/bootstrap-select.min.js"></script>
<link href="<?=base_url()?>assets/csoftcontent/js/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
<script src="<?=base_url()?>assets/csoftcontent/js/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="<?=base_url()?>assets/csoftcontent/js/plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script>
<script src="<?=base_url()?>assets/plugins/tablefilter/jquery.uitablefilter.js"></script>

<link href="<?=base_url()?>assets/plugins/datatables/datatables.min.css" rel="stylesheet" />
<script src="<?=base_url()?>assets/plugins/datatables/datatables.min.js"></script>

<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css" id="theme-styles">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


<?php
    $CodUsuario = $_SESSION['codusuario'];
    $RutaProyecto = base_url();
?>

<div class="row">
<div class="row wrapper border-bottom white-bg page-heading">
  
    <div class="col-lg-8">
        <ol class="breadcrumb" style="padding-top: 15px;">
            <li class="breadcrumb-item">
                <a href="<?=base_url()?>/Inicio/inicio">Inicio</a>
            </li>
            <li class="active breadcrumb-item">
                <strong><?=str_replace("%20", " ", $Titulo); ?></strong>
            </li>
        </ol>
        <h2>(<strong id="cantidadRegistros">-</strong>) <?=str_replace("%20", " ", $Titulo); ?> </h2>
    </div>
    <div class="col-lg-4">
    </div>
</div>

  <div class="row wrapper border-bottom white-bg page-heading form-group">
  
    <div class="form-group col-lg-2" style="padding-top: 17px;">
      <label>Fecha consulta</label> 
      <input id="txtfechaConsulta" onchange="cambioFechaConsulta();"  placeholder="Fecha consulta" readonly class="FechaUI form-control" style="width:130px;"/>
    </div>

    <div class="form-group col-lg-2" style="padding-top: 17px;">
      <label> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</label> 
      <button class="btn btn-primary btn-sm form-control" style="background-color:#18a689;color:white;" onclick="consultarData();" type="submit">Consultar</button>
    </div>
    <div class="form-group col-lg-6" style="padding-top: 17px;">

    </div>

    <div class="form-group col-lg-2" style="padding-top: 17px;">
        <label> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</label>       
        <form id="formCargarArchivos" enctype="multipart/form-data" hidden>
            <input type="file" name="programacionArchivo" onchange="subirArchivoTemp($(this))" id="archivoSubido" accept=".xlsx"><br />
            <br />
        </form>
        <button  class="btn btn-primary btn-sm form-control" style="background-color:#18a689;color:white;" onclick="abrirFile();" id="btn_registrar" type="submit">Subir matriz <i class="fa fa-upload"></i></button>
    </div>

  </div>

  <br>
  <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12 sectionProductos" >
      <br>
      <div class="table-responsive">
        <table class="table table-bordered" id="tbMatrizExcel">
          <thead>
            <tr>
              <th style="width:20px;" >N</th>
              <th>FECHA</th>
              <th>USUARIO CARGA</th>
              <th>FECHA CARGA</th>
              <th style="width:50px;" >ESTADO</th>
              <th style="width:20px;" ></th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.7.7/xlsx.core.min.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/xls/0.7.4-a/xls.core.min.js"></script>  
<script>

var TxtFechaInicio = $('#TxtFechaInicio');
var fechaConsulta = $('#txtfechaConsulta');

$(document).ready(function(){
    TxtFechaInicio.val(PrimerDiaMes(FechaHoraHoy(1)));
    fechaConsulta.val(FechaHoraHoy(1));
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
    consultarData();
});

function abrirModalSubir(){
    $('#divSubirArchivo').modal('show');
}

function cambioFechaConsulta(){
    if ( $.fn.DataTable.isDataTable('#tbMatrizExcel') ) {
        $('#tbMatrizExcel').DataTable().destroy();
    }
    $('#tbMatrizExcel tbody').empty();
    
    $('#tbMatrizExcel caption').remove();
    var htmlTabla = '<caption style="caption-side: top-right;text-align: center; color: red;">'+ " Presionar el botón consultar "+'</caption>';
    $('#tbMatrizExcel').append(htmlTabla);
    $('#tbMatrizExcel').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
}

$("#formCargarArchivos").on("submit", function (e) {
    e.preventDefault();
    var formularioDatos = new FormData(document.getElementById("formCargarArchivos"));
    //var URL = URL_BASE + 'Liquidacion/subirArchivo';
    //var fechaRegistra = $('#TxtFechaInicio').val();
    var fechaRegistra = "";

    //var URL = URL_BASE + 'Liquidacion/subirArchivo/?fechaconsulta=' +FechaMySQL(fechaRegistra);
    var URL = URL_BASE + 'Liquidacion/subirArchivo';
    //
    $('#btn_registrar').prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Subiendo...');
    //
    $.ajax({
        //url: URL_ACTION_UPLOAD_FILE + '/?correo_para=' + $('#correo_para').val(),
        url: URL,
        type: "post",
        // dataType: "json",
        dataType: "text",
        data: formularioDatos,
        cache: false,
        contentType: false,
        processData: false
    }).done(function (respuesta) {

        var splitRpta = respuesta.split('{');
        var rptaJSONstring = '{' + splitRpta[1];
        var rptaJSON = JSON.parse(rptaJSONstring);
        // console.log("ddd", rptaJSON);
        var codRespuesta = Number(rptaJSON.CodResultado);
        var desRespuesta = rptaJSON.DesResultado;
        
        Swal.fire({
                icon: (codRespuesta == 1 ? 'success' : 'warning'),
                title: desRespuesta,
                showConfirmButton: false,
                timer: 2000
        });

        consultarData();
        $('#btn_registrar').prop('disabled', false).html('Subir matriz <i class="fa fa-upload"></i>');
     
    }).fail(function (data) {
        console.log("dadsadsad",data);
        //Validaciones.ValidarSession();
    });
})

    function consultarExcelsSubidos(){
        // CALL ProcExcelImporta('2021-02-19', 10);

        //console.log("consulta de excels");
        // var fechaConsulta = 
        var Procedimiento = "ProcExcelImporta";
        var Indice = 0;
        var URL = URL_BASE + 'Registros/procGeneral';
        var Data = {
            parametros: Parametros,
            indice: Indice,
            nombreProcedimiento: Procedimiento
        };
        //
        $.post(URL, Data, function (Data) {

        });

    }

    function abrirFile() {
        $('#archivoSubido').click();
    }

    function subirArchivoTemp(element) {
        var uploadField = document.getElementById("archivoSubido");

            if (uploadField.files[0].size > 5000000) {
                Swal.fire({
                        icon: 'info',
                        title: "Debe cargar un archivo para enviar la información.",
                        showConfirmButton: false,
                        timer: 3000
                });
                return false;
            };

        var nombreArchivo = element.val().split("\\").pop();
        var extension = nombreArchivo.substr((nombreArchivo.lastIndexOf('.') + 1));
        var formularioDatos = new FormData(document.getElementById("formCargarArchivos"));
          
        //
        if (extension == 'xlsx') { //DOCX
            if ($('#archivoSubido').val().length == 0) {
                Swal.fire({
                    icon: 'info',
                    title: "Debe cargar un archivo para enviar la información.",
                    showConfirmButton: false,
                    timer: 2000
                });
                return false;
            }

            Swal.fire({
                title: '¿Estás seguro de cargar el archivo?',
                // html:
                // '<br><p><strong>Seleccionar fecha registro</strong></p><input  id="TxtFechaInicio" style="text-align: center;" name="fechainicio" readonly class="swal2-input FechaUI form-control">',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    
                    $("#formCargarArchivos").submit();
                }
            });

            $('#TxtFechaInicio').datepicker({
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
            $('#TxtFechaInicio').val(FechaHoraHoy(1));
            
        } else {
            Swal.fire({
                type: 'info',
                title: 'El archivo ' + nombreArchivo + ' no tiene el formato correcto debe ser XLSX.',
                showConfirmButton: false,
                timer: 2500
            })
        }
}



function consultarData(){
    
    $('#tbMatrizExcel caption').text(''); 
  if ( $.fn.DataTable.isDataTable('#tbMatrizExcel') ) {
    $('#tbMatrizExcel').DataTable().destroy();
  }
  var Procedimiento = 'ProcExcelImporta';
  var Parametros = '';
  var Indice = 10;
  var URL = URL_BASE + 'Registros/procGeneral';
  var Data = {
    parametros: FechaMySQL(fechaConsulta.val()),
    indice: Indice,
    nombreProcedimiento: Procedimiento
  };
  //

  $.post(URL, Data, function (Data) {
 
    $('#tbMatrizExcel tbody').empty();
    var FilasHTML = '';
    //
    $('#cantidadRegistros').text(Data.length);
    $.each(Data, function(i){
      FilasHTML += '<tr data-codexcel="' + this.CodExcelImporta + '" >' +
        '<td>' + (i + 1) + '</td>' +
        '<td>' + this.Fecha + '</td>' +
        '<td>' + this.NomUsuario + '</td>' +
        '<td>' + this.FechaCrea + '</td>' +
        '<td>' + (this.NomEstado == "ANULADO"  ? '<span class="label label-danger">'+ this.NomEstado+'</span>' : '<span class="label label-primary">' + this.NomEstado + '</span>' ) + '</td>' +
        '<td style="text-align: center;" >' + '<a target="_blank" href="'+ URL_BASE + '/filesmatriz/'+ this.NombreArchivo  +'" ><i style="color: #119a15; font-size: 17px;cursor:pointer;" class="fa fa-file-excel-o"></i></a>' + '</td>' +
      '</tr>';
    })
    $('#tbMatrizExcel tbody').append(FilasHTML);

    $('#tbMatrizExcel').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
      //$.notify(respuesta[0].DesResultado,(respuesta[0].CodResultado == 1  ? "success" : "error" ) );
    toastr.success('Registros cargados correctamente', 'Nota')
  },"JSON");
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
function split(val) {
  return val.split(/,\s*/);
}

function guardarModificacion(){

}

</script>