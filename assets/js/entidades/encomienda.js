function registroEncomienda(){
  if($('#selectBus').val()== "0-0"){
    $.notify("Debe seleccionar una unidad con despacho.", "error" );
    return;
  }
  $('#txtDocCliente').val('')
  $('#txtNombresenc').val('')
  $('#txtapellidosenc').val('')
  $('#txtdireccionenc').val('')
  $('#btnguardaclienteencm').addClass('hidden')

  $('#txtapellidosenc').attr('data-codcliente','')

  $('#modalEncomienda').modal('show');
  $("#modalEncomienda").draggable({
      handle: ".modal-header"
  });
  $('#tbencomiendafact tbody').empty();
  $('#tbencomiendafact tbody').append(
    '<tr>'+
      '<td><input type="number" style="text-align:right;" value="0" onkeyup="calcularTotales();" class="form-control" /></td>'+
      '<td><input type="text"  class="form-control" /></td>'+
      '<td><input type="number" style="text-align:right;" onkeyup="calcularTotales();" value="0.00" class="form-control" /></td>'+
      '<td><input type="number" style="text-align:right;" class="form-control disabled" value="0.00" disabled="disabled"  readonly /></td>'+
      '<td><button type="button" class="btn btn-primary" onclick="agregarRowencomienda($(this).parent().parent().parent(), $(this));" >+</button></td>'+
    '</tr>');

  getSerieDocumento();
}

function agregarRowencomienda(element, thiselement){

  thiselement.remove();
  var tbodyelement = element;
  var strHTmlRow =
  '<tr>'+
    '<td><input type="number" style="text-align:right;" value="0" onkeyup="calcularTotales();" class="form-control" /></td>'+
    '<td><input type="text" class="form-control" /></td>'+
    '<td><input type="number" style="text-align:right;" value="0.00"  onkeyup="calcularTotales();" class="form-control" /></td>'+
    '<td><input type="number" style="text-align:right;"  class="form-control disabled" value="0.00" disabled="disabled"  readonly /></td>'+
    '<td><button type="button" class="btn btn-primary" onclick="agregarRowencomienda($(this).parent().parent().parent(), $(this));" >+</button></td>'+
  '</tr>';
  tbodyelement.append(strHTmlRow);
}

function registrarEncomienda(){

  var parametros =  $('#txtnroDocumentoenc').val() + '|' +
                    $('#txtNroSerieenc').val() + '|' +
                    $("#txtNroSerieenc option:selected").text().split('-')[1] + '|' +
                    $('#txtapellidosenc').attr('data-codcliente') + '|' +
                    $('#txtfechaenc').val() + '|' +
                    $('#txtDocCliente').val() + '|' +
                    $('#txtdireccionenc').val() + '|' +
                    $('#txtSubtotalenc').text() + '|' +
                    $('#txtigvenc').text() + '|' +
                    $('#txttotalenc').text() + '|' +
                    codigoUsuario + '|' +
                    $('#selectBus').val().split('-')[0]  + '|' +
                    $('#selectRutaencomienda').val() + '|' +
                    $('#txtencargado').val();


  var indice  = 20;
  var procedimiento = "ProcFacturacion";

  $.post(URL_BASE+'Registros/procGeneral', {parametros: parametros,indice: indice,nombreProcedimiento:procedimiento}, function (respuesta) {

        console.log("respuesta registra");
        console.log(respuesta);
        var codRespuesta = respuesta[0].CodResultado;
        var codigoAuxiliar = 0;
        $.notify(respuesta[0].DesResultado,(respuesta[0].CodResultado == 1  ? "success" : "error" ) );
        if(Number(codRespuesta) == 1){
          codigoAuxiliar = respuesta[0].CodAuxiliar;
          guardarDetalleFactura(codigoAuxiliar, $("#txtNroSerieenc option:selected").text());
        }

  },"JSON");
}


function guardarDetalleFactura(codigoAuxiliar, serieimp){

  var codigofactura = codigoAuxiliar;


    $.each($('#tbencomiendafact tbody > tr'),function(){

      var cantidaddet = $(this).find('td').eq(0).children().val();
      var descripciondet = $(this).find('td').eq(1).children().val();
      var preciodet = $(this).find('td').eq(2).children().val();
      var valordet = $(this).find('td').eq(3).children().val();


      var parametros =  codigoAuxiliar + '|' + descripciondet   + '|' +
                         cantidaddet + '|' +
                        preciodet + '|'+
                        valordet;

      var indice  = 20;
      var procedimiento = "ProcFacturacionDetalle";

      $.post(URL_BASE+'Registros/procGeneral', {parametros: parametros,
                                                nombreProcedimiento: procedimiento,
                                                indice: indice}, function (respuesta) {

            console.log("guarda detalle");
            console.log(respuesta);
      },"JSON");

    });
    getDataSunatEncomienda(codigoAuxiliar, serieimp);
}


function calcularTotales(){

var subTotal = 0;
var igvmonto = 0;
var totalmonto = 0;
  $.each($('#tbencomiendafact tbody > tr'),function(){
    var cantidad = $(this).find('td').eq(0).children().val();
    var descripcion = $(this).find('td').eq(1).children().val();
    var precio = $(this).find('td').eq(2).children().val();
    var montovalor = 0;

    cantidad = (cantidad.length == 0 ? 0 : cantidad);
    precio = (precio.length == 0 ? 0 : precio);

    montovalor = Number(cantidad) * Number(precio);
    var elementValor = $(this).find('td').eq(3).children().val(montovalor.toFixed(2));
  //  subTotal += montovalor;
    totalmonto += montovalor;
  })
  subTotal += (totalmonto / 1.18);

  igvmonto = totalmonto - subTotal;

  $('#txtSubtotalenc').text(subTotal.toFixed(2));
  $('#txtigvenc').text(igvmonto.toFixed(2));
  $('#txttotalenc').text(totalmonto.toFixed(2));

}

function completaClienteencomienda(event){
    var code = event.which;

    if(code == 13){
        $.post(URL_BASE+'Registros/getCliente', {dni: $('#txtDocCliente').val() == '' ? 0 : $('#txtDocCliente').val()}, function (respuesta) {
          console.log(respuesta);
            $('#txtNombresenc, #txtapellidosenc','#txtrsocialenc').val('');
                if(respuesta.length != 0){

                    $('#txtNombresenc').val(respuesta[0]["Nombres"])
                    $('#txtapellidosenc').val(respuesta[0]["ApellidoPaterno"]+ ' ' + respuesta[0]["ApellidoMaterno"])
                    $('#txtapellidosenc').attr('data-codcliente',respuesta[0]["CodCliente"] )
                    $('#txtdireccionenc').val(respuesta[0]["Direccion"])
                    $('#txtrsocialenc').val(respuesta[0]["razon_social"])

                    $('#btnguardaclienteencm').addClass('hidden')

                }else {
                  $('#txtNombresenc').val('');
                  $('#txtapellidosenc').val('');
                  $('#txtrsocialenc').val('');
                  $('#txtdireccionenc').val('');


                  $('#txtapellidosenc').attr('data-codcliente','' )
                  $('#btnguardaclienteencm').removeClass('hidden')
                  $('#txtNombresenc').focus();

                }
        },"JSON");
    }
}

function getSerieDocumento(){
      var parametros =  $('#txtnroDocumentoenc').val();
      var indice  = 20;
      var procedimiento = "getSerieDocumentoByDocumento";
      $.post(URL_BASE+'Registros/getSerieDocumentoByDocumento', {codigoserie: parametros}, function (respuesta) {

            console.log("respuesta post");
            console.log(respuesta);
            if($('#txtnroDocumentoenc').val() == 1){
              $('#lblnrodocENC').text('RUC');
              $('#sectionrsocialenc').removeAttr('hidden','hidden');
            }else {
              $('#lblnrodocENC').text('DNI');
              $('#sectionrsocialenc').attr('hidden');
            }
            $('#txtNroSerieenc').selectpicker('destroy', true);
            $('#txtNroSerieenc').empty();
            $.each(respuesta, function(){
              var numeroActual = 0;

              $('#txtNroSerieenc').append('<option value="'+this.CodDocumentoSerie+'">'+ this.SerieDocumento + '-' + pad((Number(this.Actual)+1),7) +'</option>');
            });
            $('#txtNroSerieenc').selectpicker({
                style: 'btn-info',
                size: 4
            });

      },"JSON");
}


function getDatosParaImpresionFactura(codAuiliar, numeracionboleto,codqr){

  var parametros =  codAuiliar;
  var indice  = 11;
  var procedimiento = "ProcFacturacion";

  $.post(URL_BASE+'Registros/procGeneral', {parametros: parametros,
                                            nombreProcedimiento: procedimiento,
                                            indice: indice}, function (respuesta) {

        console.log("data impresin");
        console.log(respuesta);
        var jsondataimp  = respuesta[0];

        if($('#txtnroDocumentoenc').val() == 1){
          $('#txtfacboletaenc').text("FACTURA ");
        }
        if($('#txtnroDocumentoenc').val() == 2){
          $('#txtfacboletaenc').text("BOLETA ");
        }

          $('#numeracionBoletoenc').text(numeracionboleto);
          $('#txtrazonenc').text(jsondataimp.Nombres);
          $('#txtrucdnienc').text(jsondataimp.NumeroDocumento);
          $('#txtdireccionencimp').text(jsondataimp.Direccion);
          $('#txtfechaencimp').text(jsondataimp.Fecha);
          $('#subtotalencimp').text(jsondataimp.Subtotal);
          $('#ignencimp').text(jsondataimp.Igv);
          $('#txttotalencimp').text(jsondataimp.Total);
          $('#txtnombreusuarioencomiend').text(nombreusuario);
          $('#txtrutaencomienda').text(jsondataimp.Ruta);
          $('#txtdestinatarioencomienda').text(jsondataimp.Destinatario);
        getDatosDetalleImpresionFactura(codAuiliar, codqr);
  },"JSON");
}

function getDataSunatEncomienda(codaux, serie){

  var parametros =  codaux;
  var indice  = 1;
  var procedimiento = "procfacturacion";
  $.post(URL_BASE+'Registros/procGeneral', {parametros: parametros,
                                            nombreProcedimiento: procedimiento,
                                            indice: indice}, function (respuesta) {
console.log('ge data sunt enc', respuesta)

                                              var data_sunat_v2 =   [
                                                  {
                                                      "name": "tipo_comprobante","value": respuesta[0].TipoDocumento
                                                  },
                                                  {
                                                      "name": "serie_comprobante","value": respuesta[0].NumeroDocumento.split('-')[0]
                                                  },
                                                  {
                                                      "name": "numero_comprobante","value": respuesta[0].NumeroDocumento.split('-')[1]
                                                  },
                                                  {
                                                      "name": "fecha_comprobante","value":  respuesta[0].FechaEmision
                                                  },
                                                  {
                                                      "name": "codmoneda_comprobante","value":  respuesta[0].Moneda
                                                  },
                                                  {
                                                      "name": "tipo_comprobante_modificado","value":  respuesta[0].TipoDocumento
                                                  },
                                                  {
                                                      "name": "num_comprobante_modificado","value": respuesta[0].NumeroDocumento
                                                  },
                                                  {
                                                      "name": "notadebito_motivo_id","value": "01"
                                                  },
                                                  {
                                                      "name": "notacredito_motivo_id","value": "01"
                                                  },
                                                  {
                                                      "name": "cliente_tipodocumento","value":  respuesta[0].TipoDocumentoIdentidad
                                                  },
                                                  {
                                                      "name": "cliente_numerodocumento","value": respuesta[0].NumeroDocumentoIdentidad
                                                  },
                                                  {
                                                      "name": "cliente_nombre","value": respuesta[0].RazonSocial
                                                  },
                                                  {
                                                      "name": "cliente_pais","value":  respuesta[0].Pais//verificar
                                                  },
                                                  {
                                                      "name": "cliente_ciudad","value": ""
                                                  },
                                                  {
                                                      "name": "cliente_direccion","value":  respuesta[0].Direccion
                                                  },
                                                  {
                                                      "name": "observacion_documento","value": ""
                                                  },
                                                  {
                                                      "name": "txt_subtotal_comprobante","value": respuesta[0].ValorUnitarioItem
                                                  },
                                                  {
                                                      "name": "txt_igv_comprobante","value": respuesta[0].MontoIgvItem
                                                  },
                                                  {
                                                      "name": "txt_total_comprobante","value": respuesta[0].ValorMonto
                                                  },
                                                  {
                                                      "name": "txt_total_letras","value": "SON SEIS  "
                                                  },
                                                  {
                                                      "name": "datadetalle",
                                                      "value": "[{\"txtITEM\":1,\"txtUNIDAD_MEDIDA_DET\":\"ZZ\",\"txtCANTIDAD_DET\":\""+ Number(respuesta[0].CantidadItem)+"\",\"txtPRECIO_DET\":\""+respuesta[0].ValorUnitarioItem+"\",\"txtSUB_TOTAL_DET\":\""+ respuesta[0].ValorVentaItem + "\",\"txtPRECIO_TIPO_CODIGO\":\""+ "01" + "\",\"txtIGV\":\""+ respuesta[0].MontoIgvItem + "\",\"txtISC\":\"" + "0" + "\",\"txtIMPORTE_DET\":\""+ respuesta[0].ValorVentaItem.trim() +"\",\"txtCOD_TIPO_OPERACION\":\""+ respuesta[0].CodigoIgvItem +"\",\"txtCODIGO_DET\":\""+ respuesta[0].CodigoDatoItem.trim() +"\",\"txtDESCRIPCION_DET\":\""+ respuesta[0].DescripcionDatoItem.trim() +"\",\"txtPRECIO_SIN_IGV_DET\":"+ respuesta[0].ValorVentaItem.trim() + "}]"
                                                  }
                                              ];

                                console.log("data_sunat_v33",data_sunat_v2);

                                              var documentonumero = respuesta[0].NumeroDocumento;
                                              var docfechaemision = respuesta[0].FechaEmision;
                                              var doctipoDocumento =  respuesta[0].TipoDocumento;
                                              var docMoneda = respuesta[0].Moneda;
                                              var docTipoTransaccion = respuesta[0].TipoTransaccion;

                                              var emisorDocNumero =  respuesta[0].NumeroDocumentoEmisor;
                                              var emisorDocTipo =  respuesta[0].TipoDocumentoEmisor;
                                              var emisorDatosRazonSocial =  respuesta[0].RazonSocialEmisor;
                                              var emisorDatosNomComercial =  respuesta[0].NombreComercialEmisor == null ? '': respuesta[0].NombreComercialEmisor;

                                              var emisorUbiUbigeo = respuesta[0].UbigeoEmisor;
                                              var emisorUbiDireccion = respuesta[0].DireccionEmisor;
                                              var emisorUbiDepartamento = respuesta[0].DepartamentoEmisor;
                                              var emisorUbiProvincia = respuesta[0].ProvinciaEmisor;
                                              var emisorUbiDistrito = respuesta[0].DistritoEmisor;
                                              var emisorUbiUrbanizacion = '';
                                              var emisorUbiPais = respuesta[0].PaisEmisor;

                                              var clienteDocNumero = respuesta[0].NumeroDocumentoIdentidad;
                                              var clienteDocTipo = respuesta[0].TipoDocumentoIdentidad;

                                              var clienteDatosRazonSocial = respuesta[0].RazonSocial;
                                              var clienteDatosNombreComercial = respuesta[0].NombreComercial;//verificar

                                              var clienteUbicUbigeo = '';//verificar
                                              var clienteUbicDireccion = respuesta[0].Direccion;//verificar
                                              var clienteUbicUrb = '';//verificar
                                              var clienteUbicProvincia = '';//verificar
                                              var clienteUbicDepartament = '';//verificar
                                              var clienteUbicDistrito = '';//verificar
                                              var clienteUbicPais = respuesta[0].Pais;//verificar

                                              /*montos*/
                                              var montoId = respuesta[0].IdMonto;
                                              var montoValorPagable =  respuesta[0].ValorMonto;

                                              var notasId = respuesta[0].IdNota;
                                              var notasValor = "CIEN SOLES Y 00 10 CENTAVOS";

                                              var impuestoId = respuesta[0].IdImpuesto;
                                              var impuestoMonto = respuesta[0].MontoImpuesto;
                                              var impuestoNombre = respuesta[0].NombreImpuesto;
                                              var impuestoCodigo = respuesta[0].CodigoImpuesto;

                                              /*item*/
                                              var itemId = respuesta[0].IdItem;
                                              var itemCantidad = respuesta[0].CantidadItem;
                                              var itemUnidad = respuesta[0].UnidadItem;
                                              var itemValorVenta = respuesta[0].ValorVentaItem;
                                              var itemPrecioUnitario = respuesta[0].PrecioUnitarioItem;

                                              var igvMontoItem = respuesta[0].MontoIgvItem;
                                              var igvCodigoItem = respuesta[0].CodigoIgvItem;//verificar

                                              var itemDatoDescrip = respuesta[0].DescripcionDatoItem;
                                              var itemCodDato = respuesta[0].CodigoDatoItem;//verificar

                                              var itemDatoValorUnitario = respuesta[0].ValorUnitarioItem;
                                              var itemDatoDescuento = respuesta[0].DescuentoItem;
                                              var itemDatoItemCodigo = respuesta[0].CodigoDescuentoItem;//verificar

                                              /*total*/
                                              var totalDescuento = respuesta[0].TotalDescuento;
                                              var totalCargo = respuesta[0].TotalCargo;
                                              var totalPagable = respuesta[0].TotalPagable;

                                                var jsonDataSend = {
                                                    "documento": {
                                                      "numero": documentonumero,//
                                                      "fecha_emision":docfechaemision,//
                                                      "tipo_factura":doctipoDocumento,//
                                                      "moneda":docMoneda,
                                                      "tipo_transaccion":docTipoTransaccion//
                                                    },
                                                    "emisor":{
                                                      "documento":{
                                                        "numero":emisorDocNumero,
                                                        "tipo":emisorDocTipo
                                                      },
                                                      "datos":{
                                                        "razon_social":emisorDatosRazonSocial,
                                                        "nombre_comercial":emisorDatosNomComercial
                                                      },
                                                      "ubicacion":{
                                                        "ubigeo":emisorUbiUbigeo,
                                                        "direccion":emisorUbiDireccion,
                                                        "departamento":emisorUbiDepartamento,
                                                        "provincia":emisorUbiProvincia,
                                                        "distrito":emisorUbiDistrito,
                                                        "urbanizacion":emisorUbiUrbanizacion,
                                                        "pais":emisorUbiPais
                                                      }
                                                    },
                                                    "cliente":{
                                                      "documento":{
                                                        "numero":clienteDocNumero,
                                                        "tipo":clienteDocTipo
                                                      },
                                                      "datos":{
                                                        "razon_social":clienteDatosRazonSocial,
                                                        "nombre_comercial":clienteDatosNombreComercial
                                                      },
                                                      "ubicacion":{
                                                        "ubigeo":clienteUbicUbigeo,
                                                        "direccion":clienteUbicDireccion,
                                                        "urbanizacion":clienteUbicUrb,
                                                        "provincia":clienteUbicProvincia,
                                                        "departamento":clienteUbicDepartament,
                                                        "distrito":clienteUbicDistrito,
                                                        "pais":clienteUbicPais
                                                      }
                                                    },
                                                    "montos":[{
                                                                "id":montoId,
                                                                "valor":{
                                                                  "pagable":montoValorPagable
                                                                }
                                                              }
                                                            ],
                                                  "notas":[
                                                    {"id":notasId,"valor":notasValor}
                                                  ],
                                                  "impuestos":[
                                                    {"id":impuestoId,"monto":impuestoMonto,"nombre":impuestoNombre,"codigo":impuestoCodigo}
                                                  ],
                                                  "items":[
                                                    {
                                                      "id":itemId,
                                                      "cantidad":itemCantidad,
                                                      "unidad":itemUnidad,
                                                      "valor_venta":itemValorVenta,
                                                      "precio_unitario":{
                                                        "facturado":itemPrecioUnitario
                                                      },
                                                      "igv":{
                                                        "monto":igvMontoItem,
                                                        "codigo":igvCodigoItem
                                                      },
                                                      "datos":{
                                                        "descripcion":itemDatoDescrip,
                                                        "codigo":itemCodDato
                                                      },
                                                      "valor_unitario":itemDatoValorUnitario,
                                                      "descuento":itemDatoDescuento,
                                                      "codigo":itemDatoItemCodigo
                                                    }
                                                  ],
                                                  "total":{
                                                    "descuento":totalDescuento,
                                                    "cargo":totalCargo,
                                                    "pagable":totalPagable
                                                  }
                                                };

                                                var stringSend = JSON.stringify(jsonDataSend);
                                                enviarDataSunatEncomienda(stringSend, codaux, serie, data_sunat_v2);
                                              //getDatosParaImpresionFactura(codaux, serie);
  },'json')
}

function enviarDataSunatEncomienda(data, codigo, numeracion, datasunatv2){

  $.ajax({
        url : 'http://localhost/sis_facturacion/controllers/procesar_data.php',
        method :  'POST',
        dataType : "json",
        data: datasunatv2
    }).then(function(data){
      console.log("DATA SUNAT RESPONSE  _v2->", data);
    }), function(reason){
    	console.log(reason);
    };
return;


  $.post(URL_BASE+'Registros/enviarDatatoAPI', {serializadoJSON: data}, function (respuesta) {
      console.log("respuesta de sunat ENCOM", respuesta);
      if(Number(respuesta.response.status) == 200){
        $('#modalEncomienda').modal('hide');
        var qr = respuesta.response.result.codeQr;
        getDatosParaImpresionFactura(codigo, numeracion, qr);
        //console.log("CODE QR",qrbytearr)
        //imprimirVoucher(codboleto, qrbytearr);
      }else{
        alert("OCURRIO UN ERROR CONTACTARSE CON EL ADMINISTRADOR DEL SISTEMA");
      }

  },'JSON');
}

function getDatosDetalleImpresionFactura(codigo, qr){

  var parametros =  codigo;
  var indice  = 12;
  var procedimiento = "ProcFacturacion";
  $.post(URL_BASE+'Registros/procGeneral', {parametros: parametros,
                                            nombreProcedimiento: procedimiento,
                                            indice: indice}, function (respuesta) {

        console.log("tabla imp");
        console.log(respuesta);
        $('#tbdetfacenc tbody').empty();
        var strTablaDetalle = '';

        $.each(respuesta,function(i){
          strTablaDetalle +=  '<tr>'+
                                  '<td>'+ (i+1) +'</td>'+
                                  '<td>'+ this.Descripcion +'</td>'+
                                  '<td>'+ this.Cantidad +'</td>'+
                                  '<td>'+ this.Valor +'</td>'+
                              '</tr>';
        });
        $('#tbdetfacenc tbody').append(strTablaDetalle);


qr = "data:image/png;base64," + qr;
              $('#imgcodigoqrEnc').attr("src","");
            $('#imgcodigoqrEnc').attr("src", qr );

            $('#imgcodigoqrEnc').on('load', function() {
              $("#impresionFacturaEncomienda").printArea();
              //$("#divBoletoVenta").dialog('close');
              //obtenerBoletosVendidos($('#txtFecha').val(), $('#selectBus').val().split('-')[1]);
            });

  },"JSON");

}
