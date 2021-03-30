function Util() {
}

Util.prototype.ConvertirAMatriz = function (Datos, SeparadorColumna, SeparadorFila) {

    var Filas = String(Datos).split('*'); /*Datos a vector*/
    var CantFilas = Filas.length - 1;
    var Matriz = new Array(CantFilas);
    for (j = 0; j <= CantFilas; j++) {
        Matriz[j] = String(Filas[j]).split('|'); /*Vector dato a vector bidimensional*/
    }
    return Matriz;
}

Util.prototype.LimpiarCajas = function (Div) { //Limpia todas las cajas del DIV
    $(':input', Div).each(function () {
        var type = this.type;
        var tag = this.tagName.toLowerCase();
        if (type == 'text' || type == 'password' || type == 'number' || tag == 'textarea')
            this.value = '';
    });
}


Util.prototype.deshabilitarbotom = function (elemboton) { //Limpia todas las cajas del DIV
    elemboton.attr('disabled', 'disabled').addClass('disabled');
}

Util.prototype.habilitarbotom = function (elemboton) { //Limpia todas las cajas del DIV
    elemboton.removeAttr('disabled').removeClass('disabled');
}


Util.prototype.obtenerTodosLosDiasDeLaSemana = function (fecha) { //Recibe una fecha y devuelve la semana por dias en un array

    var diasSemana = [];

    Date.prototype.addDays = function (days) {
        var dat = new Date(this.valueOf());
        dat.setDate(dat.getDate() + days);
        return dat;
    }
    var curr = new Date('03-05-2017');
    var nroDiaEnLaSemana = curr.getDay()
    if (nroDiaEnLaSemana == 0) {
        curr = curr.addDays(-1)
    }
    //console.log(curr)
    var first = curr.getDate() - curr.getDay();

    for (var i = 1; i <= 7; i++) {
        var next = new Date(curr.getTime());
        next.setDate(first + i);
        //alert(next.toString());
        diasSemana.push(next);
    }

    return diasSemana;
}



Util.prototype.CargarSelect = function (json, cb, OpcTodos) { //Limpia todas las cajas del DIV
    cb.empty();
    //
    $.each(json, function (indice, record) {
        cb.append('<option  value="' + record.Codigo + '"> ' + record.Nombre + '</option>');
    });
    if (OpcTodos == 1) { // Todos
        cb.append('<option value="0" selected >--Todos--</option>');
    }
}

Util.prototype.CargarSelectVigencia = function (json, cb) { //Limpia todas las cajas del DIV
    cb.empty();
    //
    $.each(json, function (indice, record) {
        cb.append('<option data-AniosVigencia="' + record.AniosVigencia + '" value="' + record.Codigo + '"> ' + record.Nombre + '</option>');
    });
}

Util.prototype.CargarSelectUnidad = function (json, cb, OpcTodos) { //Limpia todas las cajas del DIV
    cb.empty();
    $.each(json, function (indice, record) {
        cb.append('<option  value="' + record.CodUnidad + '"> ' + record.PlacaUnidad + '</option>');
    });
    if (OpcTodos == 1) { // Todos
        cb.append('<option value="0" selected >--Todos--</option>');
    }
}

Util.prototype.CargarSelectOpcTodos = function (json, cb) { //Limpia todas las cajas del DIV

    cb.empty();
    $.each(json, function (indice, record) {
        cb.append('<option value="' + record.Codigo + '"> ' + record.Nombre + '</option>');
    });
}

Util.prototype.DimensionarContenedor = function (IdContenedor, width, height) { //dimensiona un contenedor

    var divContenedor = document.querySelector("#" + IdContenedor);
    divContenedor.style.width = width;
    divContenedor.style.height = height;
}

Util.prototype.SerializarData = function (strNombreIdTabla){ //dimensiona un contenedor
    var trString = '';
    var tr = document.getElementById(strNombreIdTabla).rows;
    var td = null;

    for (var i = 0; i < tr.length; ++i) {
        td = tr[i].cells;
        for (var j = 0; j < td.length; ++j) {
            trString = trString + td[j].innerHTML + '*';
        }
        trString = trString.substring(0, trString.length - 1);
        trString = trString + '|';
    }
    trString = trString.substring(0, trString.length - 1);

    return trString;
}



Util.prototype.Hora = function () {

    var tiempo;
    var fecha = new Date()
    var hora = fecha.getHours()
    var minuto = fecha.getMinutes()
    var segundo = fecha.getSeconds()

    if (hora < 10) { hora = "0" + hora }
    if (minuto < 10) { minuto = "0" + minuto }
    if (segundo < 10) { segundo = "0" + segundo }

    var horita = hora + ":" + minuto + ":" + segundo
    document.getElementById('SpanHora').innerHTML = horita
    tiempo = setTimeout('Util.prototype.Hora()', 1000)
}



Util.prototype.Horav2 = function () {

    var Url = NombreAplicacion + '/./Usuario/getHora';
    var segundosCount = 0;
    var minutosPost = 0;
    var horaPost = 0;

    $.post(Url, {}, function (rpta) {
        segundosCount = (rpta.split(' ')[1]).split(':')[2];
        minutosPost = (rpta.split(' ')[1]).split(':')[1];
        horaPost = (rpta.split(' ')[1]).split(':')[0];
        UpdateTime(segundosCount, minutosPost, horaPost);
        document.getElementById('SpanHora').innerHTML = (rpta.split(' ')[1]);
    });
}

var contadorReloj;
function UpdateTime(valor,minutos,hora) {
    var countdownElement = document.getElementById('countdown'),
        seconds = Number(valor),
        second = 0,
        interval;
        interval = setInterval(function () {
        contadorReloj = (seconds + second);
        document.getElementById('SpanHora').innerHTML = hora + ':' + minutos + ':' + (contadorReloj < 10 ? '0' + contadorReloj : contadorReloj);
        if (contadorReloj == 59) {
            clearInterval(interval);
            Util.prototype.Horav2();
        }
        second++;
    }, 1000);
}

//Util.prototype.animacion_simple = function () {

//    // Mostramos la foto 1
//    $(".foto1").fadeIn(tiempo_fade);
//    // Cuando pasen otros 3000 milisegundos, ocultamos la foto 1 y mostramos la foto 2
//    setTimeout(function () {
//        // Ocultamos la foto 1
//        $(".foto1").fadeOut(tiempo_fade);
//        // Mostramos la foto 2
//        $(".foto2").fadeIn(tiempo_fade);
//    }, tiempo_entre_img);
//    // Cuando pasen otros 3000 milisegundos, ocultamos la foto 2 y mostramos la foto 3
//    setTimeout(function () {
//        // Ocultamos la foto 2
//        $(".foto2").fadeOut(tiempo_fade);
//        // Mostramos la foto 3
//        $(".foto3").fadeIn(tiempo_fade);
//    }, tiempo_entre_img * 2);
//    // Cuando pasen otros 3000 milisegundos, ocultamos la foto 3 y volvemos a iniciar la animación
//    setTimeout(function () {
//        // Ocultamos la foto 2
//        $(".foto3").fadeOut(tiempo_fade);
//        // Mostramos la foto 3
//        $(".foto4").fadeIn(tiempo_fade);
//    }, tiempo_entre_img * 3);
//    // Cuando pasen otros 3000 milisegundos, ocultamos la foto 3 y volvemos a iniciar la animación
//    setTimeout(function () {
//        // Ocultamos la foto 2
//        $(".foto4").fadeOut(tiempo_fade);
//        // Mostramos la foto 3
//        $(".foto5").fadeIn(tiempo_fade);
//    }, tiempo_entre_img * 4);
//    // Cuando pasen otros 3000 milisegundos, ocultamos la foto 3 y volvemos a iniciar la animación
//    setTimeout(function () {
//        // Ocultamos la foto 3
//        $(".foto5").fadeOut(tiempo_fade);
//        // Iniciamos otra vez la animación
//        Util.prototype.animacion_simple();
//    }, tiempo_entre_img * 5);
//}


Util.prototype.animacion_simple = function () {


    $(".foto1").fadeIn(tiempo_fade);

    setTimeout(function () {

        $(".foto1").fadeOut(tiempo_fade);

        $(".foto2").fadeIn(tiempo_fade);
    }, tiempo_entre_img);

    setTimeout(function () {

        $(".foto2").fadeOut(tiempo_fade);

        Util.prototype.animacion_simple();
    }, tiempo_entre_img * 2);

}

Util.prototype.animacion = function () {

    $('.fadein img:gt(0)').hide();
    setInterval(function () {
        $('.fadein :first-child').fadeOut().next('img').fadeIn().end().appendTo('.fadein');
    }, 2500);
}

Util.prototype.Modal = function (Div, alto, ancho, modal, AutoOpen, resizable, draggable, titulo, X, Y) {

    if (X == null) { X = 'center'; }
    if (Y == null) { Y = 'center'; }
    Div.dialog({
        height: alto,
        width: ancho,
        modal: modal,
        autoOpen: AutoOpen,
        //position: [10, 100],
        //position: { my: '10', at: '10', of: 'window' },
        closeOnEscape: true,
        resizable: resizable,
        draggable: draggable,
        title: titulo,
        open: function () {

            //var Boton = getDialogButton('dialogMensajeConfirmacion', 'Aceptar');
            //console.log('prrnrni ' + Boton);
            //alert(Boton.text());
//            alert("abierto");
            //console.log(this);
            //console.log("botton");
            //console.log($(this).parents('.ui-dialog-buttonpane button:eq(0)').html())
                //.focus();
        }
    });
}

//function getDialogButton(dialog_selector, button_name) {
//    var buttons = $(dialog_selector + ' .ui-dialog-buttonpane button');
//    for (var i = 0; i < buttons.length; ++i) {
//        var jButton = $(buttons[i]);
//        if (jButton.text() == button_name) {
//            return jButton;
//        }
//    }

//    return null;
//}

Util.prototype.BloquearPantalla = function () {
    $.blockUI({
        message: 'Espere un momento...',
        css: {
            border: 'none',
            padding: '15px',
            backgroundColor: '#000',
            '-webkit-border-radius': '10px',
            '-moz-border-radius': '10px',
            opacity: .5,
            color: '#fff'
        }
    });
}

Util.prototype.DesbloquearPantalla = function () {
    $.unblockUI();
}



Util.prototype.obtenerFechaLocal = function (fecha, formato) {

    var dias = "", mes = "", anio = "";
    var days = ["Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado"];
    var meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Setiembre", "Octubre", "Noviembre", "Diciembre"];
    if (fecha != undefined) {
        var indiceDia = fecha.getDate();
        var indiceMes = fecha.getMonth() + 1;
        var anio = fecha.getFullYear();

        if (indiceDia < 10) { //del 0 al 8 --> 1 al 9
            dias = "0" + (indiceDia);
        } else {
            dias = "" + indiceDia;
        }

        if (indiceMes < 10) {
            mes = "0" + indiceMes;
        } else {
            mes = "" + indiceMes;
        }
        if (formato == 1) {
            return dias + "/" + mes + "/" + anio;
        } else if (formato == 2) {
            return anio + "" + mes + "" + dias;
        } else if (formato == 3) {
            //            return days[fecha.getDay()] + " " + dias + " de " + meses[indiceMes - 1];
            return dias + ' ' + days[fecha.getDay()];// " " + dias + " de " + meses[indiceMes - 1];
        }
    }
    return "";
}
Util.prototype.MostrarMensaje = function (Mensaje, tipoMensaje) {

    switch (tipoMensaje) {
        case 0:
            tipoMensaje = "red";
            break;
        case 1:
            tipoMensaje = "green";
            break;
        case 2:
            tipoMensaje = "rgb(243, 137, 27)";
            break;
        case 4:
            tipoMensaje = "blue";
            break;
        default:
            break;
    }

    $("#DivMensaje").cftoaster({
        content: Mensaje,
        backgroundColor: tipoMensaje
    });
}
Util.prototype.ObtieneNomArchivoCargado = function (NombreArchivo) {
    NombreArchivo.split(/[\\\/]/g).pop();
}

Util.prototype.ObtenerFechaActual = function () {

    var Fecha = new Date();
    var Dia = Fecha.getDate();
    var Mes = (Fecha.getMonth() + 1);
    var Año = Fecha.getFullYear()
    Dia = ((Dia < 10) ? '0' + Dia : Dia);
    Mes = ((Mes < 10) ? '0' + Mes : Mes);
    Fecha = Dia + '/' + Mes + '/' + Año;

    return Fecha;

}

Util.prototype.ObtenerFechaHoraActual = function () {
    var Fecha = new Date();
    var Dia = Fecha.getDate();
    var Mes = (Fecha.getMonth() + 1);
    var Año = Fecha.getFullYear();
    var hora = Fecha.getHours();
    var minuto = Fecha.getMinutes();

    Dia = ((Dia < 10) ? '0' + Dia : Dia);
    Mes = ((Mes < 10) ? '0' + Mes : Mes);
    hora = ((hora < 10) ? '0' + hora : hora);
    minuto = ((minuto < 10) ? '0' + minuto : minuto);

    Fecha = Dia + '/' + Mes + '/' + Año + ' ' + hora + ':' + minuto;

    return Fecha;
}

Util.prototype.LoadingMobile = function (texto, mostrar) {

    if (mostrar == true) {
        mostrar = "show";
    } else {
        mostrar = "hide";
    }

    $.mobile.loading(mostrar, {
        text: texto,
        textVisible: true,
        theme: 'z',
        html: ""
    });
}


Util.prototype.MantenerSeleccion = function (idRowValue, strTabla) {

    var Tabla = document.getElementById(strTabla);
    for (var i = 1; i < Tabla.rows.length; i++) {
        var Fila = Tabla.rows[i];

        if (Fila.cells[0].textContent == idRowValue) {
            Fila.className = 'rowSelecionado';
        } else {
            Fila.className = '';
        }
    }
}

Util.prototype.Notificacion = function (Mensaje) {

    var htmlAlerta = '<div id="alerts">' + '' +
                    '<div><img src="http://citectran.com/citec/Images/logo/LogoCitectran2016_.png" align="top" style="width: 85px;" /></div>' +
                    '<li style="color: white;list-style-type: none;"><div>' + Mensaje + '</div>' +
                    '</li>' +
                    '</div>';

    $('#alertbox').fadeIn('slow').prepend(htmlAlerta);
    $('#alerts').delay(5000).fadeOut('slow');

}

Util.prototype.SumarFecha = function (Mensaje) {

    var today = new Date();
    // Sumar 7 días.
    new Date(today.getTime() + (365 * 7 * 24 * 3600 * 1000))
    //// Restar 5 días
    //new Date(today.getTime() - (5 * 24 * 3600 * 1000)),


}

Util.prototype.SoloDecimal = function (e, Txt, Salto) {

    key = e.keyCode ? e.keyCode : e.which

    if (key == 8) return true
    if (key > 47 && key < 58) {
        if (Txt.value == "") return true
        regexp = /.[0-9]{7}$/
        return !(regexp.test(Txt.value))
    }
    if (key == 46) {
        if (Txt.value == "") return false
        regexp = /^[0-9]+$/
        return regexp.test(Txt.value)
    }
    // evento para saltar al siguiente input con enter
    if (Salto) {
        if (key == 13) {
            var IdTxt = $(Txt).attr('id');
            var ArrayTxt = IdTxt.split('-');
            var CadenaTxt = ArrayTxt[0];
            var NumeroTxt = parseInt(ArrayTxt[1]) + 1;
            $('#' + CadenaTxt + '-' + NumeroTxt).selectRange(0, 9999);

        }
    }
    return false
}

Util.prototype.SoloNumero = function (Evento, Txt) {
    //Evento.preventDefault();
    var charCode = (Evento.which) ? Evento.which : Evento.keyCode
    if (charCode == 13) { return false;}
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    if (Txt.value.length == 20)
        return false;

    if (charCode == 13) {
        var IdTxt = $(Txt).attr('id');
        var ArrayTxt = IdTxt.split('-');
        var CadenaTxt = ArrayTxt[0];
        var NumeroTxt = parseInt(ArrayTxt[1]) + 1;
        var TxtValor = $('#' + CadenaTxt + '-' + NumeroTxt);
        //
        TxtValor.focus();
        // Valida si existe valor en el Input
        if (TxtValor.val() != null) {
            var CantidadSeleccionada = 3; // Seleccion 2 caracteres empezando de la derecha.
            SeleccionRangoInput(TxtValor, CantidadSeleccionada);
        }
    }
    return true;
}


Util.prototype.NoTab = function (e,txt) {

    var keyCode = e.keyCode || e.which;

    if (keyCode == 9) {
        e.preventDefault();
    }
}

Util.prototype.FormatYearTwo = function (Fecha){
    return Fecha.split('/')[0] + '/' + Fecha.split('/')[1] + '/' + Fecha.split('/')[2].substring(2);
}

Util.prototype.ExportarExcel = function (sistema,title,filename,strNombreTabla) {
    var opciones = {
        sistema: sistema,
        title: title,
        filename: filename
    };
    fnExcelReport(strNombreTabla, opciones);
}

/**
*@author fapaza
*Crea una una tabla con una cabecera
@nomTabla id de la tabla a exportar
@opciones Parametros que definen la caberca
    opciones.sistema = nombre del sistema (1era cabecera)
    opciones.title = titulo del reporte (2da cabecera)
*/
function fnExcelReport(nomTabla, opciones){
    //var tabla= $('#'+nomTabla);
    var nomSistema = 'SISTEMA WEB CITECTRAN';
    var nomTitulo = 'REPORTE ';
    var nomFileName = 'Reporte_exportado';

    if (opciones != undefined) {
        if (opciones.sistema != undefined) {
            nomSistema = opciones.sistema;
        }
        if (opciones.title != undefined) {
            nomTitulo = opciones.title;
        }
        if (opciones.filename != undefined) {
            nomFileName = opciones.filename;
        }
    }

    var tab_text = "<table border='2px'><tr bgcolor='#87AFC6'>";
    var textRange; var j = 0;
    var tablaHtml = document.getElementById(nomTabla);
    var fecAhora = new Date().toLocaleString();
    //"/Imagenes/Logos/TGA.png"
    var html = '<table>';
    html = html + '<tr><td rowspan="2" colspan="2" width="100px"><img style="width:100px;height:100px;" src="http://opentgps.com/images/logo_mini.png" alt=""/></td>' +
        '<td ><b>' + nomSistema + '</b></td>' +
        '<td ></td>' + '</tr>';
    html = html + '<tr><td rowspan="2">' + nomTitulo + '</td>' +
        '<td>FECHA</td>' + '</tr>';
    html = html + '<tr><td>' + fecAhora + '</td></tr>';
    html = html + '<tr><td colspan="4"></td></tr>';
    html = html + '<tr><td colspan="4"></td></tr>';
    html = html + '<tr><td colspan="4">';

    var tab = document.getElementById(nomTabla); // id of table
    //var tabCabecera = document.getElementById('tbCabecera');

    for (j = 0; j < tab.rows.length; j++) {
        tab_text = tab_text + tab.rows[j].innerHTML + "</tr>";
        //tab_text=tab_text+"</tr>";
    }


        tab_text = tab_text + "</table>";
        tab_text = tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
        //tab_text = tab_text.replace(/<img[^>]*>/gi, ""); // remove if u want images in your table
        tab_text = tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params
        tab_text = tab_text.replace(/<button[^>]*>|<\/button>/gi, ""); // reomves input params

    var ua = window.navigator.userAgent;
    var msie = ua.indexOf("MSIE ");
        html = html + tab_text + '</td></tr></table>';
        // sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(html));
    var data_type = 'data:application/vnd.ms-excel';
    var a = document.createElement('a');
        a.href = data_type + ', ' + encodeURIComponent(html);
        //setting the file name
        a.download = nomFileName + '.xls';
        //triggering the function
        a.click();


}

Util.prototype.conectarServicioLocal = function () {

    var connection;
    var host = "ws://" + urlServicioHora + "/svrHoraLocal/SimpleEventoDeServicio.ashx";

        connection = new WebSocket(host);
        connection.onopen = function () {
            // console.log("contecto correctamente");
        }
        connection.onmessage = function (message) {
            //console.log(message.data);
            var data = window.JSON.parse(message.data);
            //$("<li/>").html(data).appendTo($('#messages'));
            $('#SpanHora').html(message.data.replace("\"", '').replace("\"", ''));
            // console.log($('#SpanHora'));
        };
}



Util.prototype.GuardarJson = function (data, filename) {


    var currentdate = new Date();
    var datetime = filename + currentdate.getDate() + "/"
                    + (currentdate.getMonth() + 1) + "/"
                    + currentdate.getFullYear() + " "
                    + currentdate.getHours() + ":"
                    + currentdate.getMinutes() + ":"
                    + currentdate.getSeconds();

        if (!data) {
            console.error('Console.save: No data')
            return;
        }

        if (!datetime) datetime = 'console.json'

        if (typeof data === "object") {
            data = JSON.stringify(data, undefined, 4)
        }

        var blob = new Blob([data], { type: 'text/json' }),
            e = document.createEvent('MouseEvents'),
            a = document.createElement('a')

        a.download = datetime
        a.href = window.URL.createObjectURL(blob)
        a.dataset.downloadurl = ['text/json', a.download, a.href].join(':')
        e.initMouseEvent('click', true, false, window, 0, 0, 0, 0, 0, false, false, false, false, 0, null)
        a.dispatchEvent(e)


}

var dateTimeLoop;
Util.prototype.ActualizarHoraServidor = function (strHora){
    //console.log("hora servidor : " + strHora);
    dateTimeLoop = '';
    var fechaConvertida = new Date(Date.parse(strHora));
    var idIntervalo;
    var contDatetimeSeconds;
    var mes = (fechaConvertida.getMonth() + 1);
    var horaFechaFinal, horaActualFinal;
    fechaConvertida.setSeconds(fechaConvertida.getSeconds() + 1);
    //horaFechaFinal = (fechaConvertida.getDate() <= 9 ? '0' + fechaConvertida.getDate() : fechaConvertida.getDate()) + "/"
    //                            + (mes <= 9 ? '0' + mes : mes) + "/"
    //                            + fechaConvertida.getFullYear() + " "
    //                            + (fechaConvertida.getHours() <= 9 ? '0' + fechaConvertida.getHours() : fechaConvertida.getHours()) + ":"
    //                            + (fechaConvertida.getMinutes() <= 9 ? '0' + fechaConvertida.getMinutes() : fechaConvertida.getMinutes()) + ":"
    //                            + (fechaConvertida.getSeconds() <= 9 ? '0' + fechaConvertida.getSeconds() : fechaConvertida.getSeconds());

    horaActualFinal = (fechaConvertida.getHours() <= 9 ? '0' + fechaConvertida.getHours() : fechaConvertida.getHours()) + ":"
                                + (fechaConvertida.getMinutes() <= 9 ? '0' + fechaConvertida.getMinutes() : fechaConvertida.getMinutes()) + ":"
                                + (fechaConvertida.getSeconds() <= 9 ? '0' + fechaConvertida.getSeconds() : fechaConvertida.getSeconds());
    dateTimeLoop = fechaConvertida.getFullYear() + '/' + mes + '/' + fechaConvertida.getDate() + ' ' +
                    fechaConvertida.getHours() + ':' + fechaConvertida.getMinutes() + ':' + fechaConvertida.getSeconds();
    $('#SpanHora').text(horaActualFinal);
    idIntervalo = setTimeout("Util.prototype.ActualizarHoraServidor(dateTimeLoop)", 1000);
}


Util.prototype.InicializarArreglo = function (len, itm) {
    var arr1 = [itm],
    arr2 = [];
    while (len > 0) {
        if (len & 1) arr2 = arr2.concat(arr1);
        arr1 = arr1.concat(arr1);
        len >>>= 1;
    }
    return arr2;
}

Util.prototype.actualizarIndiceTabla = function (elementoTabla,posicionN) {
    var contadorRow = 0;
    //$.each($('#tbLineastelefonicas tbody > tr:visible'), function () {
    $.each(elementoTabla, function () {
        contadorRow++;
        var tdFind = $(this).find('td')[posicionN];
        $(tdFind).text(contadorRow)
        //console.log(tdFind);
    });
}


Util.prototype.setInformacionEnContenedor = function (elemento,tipo) {

    var gIdIntervalo;
    var tiempoSleep = 3000;
        $('.closealert').click();
    //var
    switch (tipo) {
        case 'informacion':
            elemento.append('<div class="alert alert-info fade in alert-dismissable" style="padding: 0;margin: 0;position: absolute;left: 0;right: 0;padding-top: 6px;padding-bottom: 6px;text-align: center;">' +
                                '<a href="#" class="close closealert" data-dismiss="alert" style="position: absolute;right: 9px;" aria-label="close" title="close">×</a>' +
                                '<section>Cargando <img src="../../../' + nombreSubdominio + '/Images/puntos-suspensivos.gif" /></section>' +
                            '</div>');
            break;
        case 'advertencia':
            elemento.append('<div class="alert alert-warning fade in alert-dismissable" style="padding: 0;margin: 0;position: absolute;left: 0;right: 0;padding-top: 6px;padding-bottom: 6px;text-align: center;">' +
                                '<a href="#" class="close closealert" data-dismiss="alert" style="position: absolute;right: 9px;" aria-label="close" title="close">×</a>' +
                                '<section>No se ha encontrado información en la base de datos.</section>' +
                            '</div>');
            break;
        case 'success':
            elemento.append('<div class="alert alert-success fade in alert-dismissable" style="padding: 0;margin: 0;position: absolute;left: 0;right: 0;padding-top: 6px;padding-bottom: 6px;text-align: center;">' +
                                '<a href="#" class="close closealert" data-dismiss="alert" style="position: absolute;right: 9px;" aria-label="close" title="close">×</a>' +
                                '<section>La información cargó correctamente.</section>' +
                            '</div>');
            tiempoSleep = 3000;
            clearTimeout(gIdIntervalo);
            gIdIntervalo = setTimeout(function () { $('.closealert').click(); }, tiempoSleep);
            break;
        case 'error':
            elemento.append('<div class="alert alert-danger fade in alert-dismissable" style="padding: 0;margin: 0;position: absolute;left: 0;right: 0;padding-top: 6px;padding-bottom: 6px;text-align: center;">' +
                                '<a href="#" class="close closealert" data-dismiss="alert" style="position: absolute;right: 9px;" aria-label="close" title="close">×</a>' +
                                '<section>Ocurrió un error al cargar la información.</section>' +
                            '</div>');
            break;
        case 'presionaprocesar':
            elemento.append('<div class="alert alert-info fade in alert-dismissable" style="padding: 0;margin: 0;position: absolute;left: 0;right: 0;padding-top: 6px;padding-bottom: 6px;text-align: center;">' +
                                '<a  href="#" class="close closealert" data-dismiss="alert" style="position: absolute;right: 9px;" aria-label="close" title="close">×</a>' +
                                '<section>Presionar el boton procesar</section>' +
                            '</div>');

            break;
        default:
    }
}
