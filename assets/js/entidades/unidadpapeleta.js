function procunidadpapeleta(url, parametros, indice){

     $.post(url, {parametros: parametros, indice: indice,}, function (respuesta) {
        if (indice == 16) { //lista

          var totalimp = 0;
          var totagasto = 0;
          var totaldcto = 0;
          var tdtotal = 0;

          $('#tbunidadpapeleta caption').html("<h3>Papeletas de la unidad " + UNIDAD_SELECT  + ' <i onclick="" title="Exportar" style="cursor:pointer;" class="fa fa-file-excel-o" aria-hidden="true"></i></h3>');
          $('#tbunidadpapeleta tbody').empty();
          var strTabla = '';
          $.each(respuesta,function(i){
              strTabla += '<tr >' +
                          '<td>'+ (i+1) +'</td>' +
                          '<td>'+ this.Documento +'</td>' +
                          '<td>'+ this.FechaInfraccion +'</td>' +
                          '<td class="text-right" >'+ this.Importe +'</td>' +
                          '<td class="text-right" >'+ this.Gasto +'</td>' +
                          '<td class="text-right" >'+ this.Descuento +'</td>' +
                          '<td class="text-right" >'+ this.TotalPagar +'</td>' +
                          '<td>'+ this.CodigoFalta + ' <i title="'+this.Infraccion+'" style="cursor:pointer;" class="fa fa-file-text-o" aria-hidden="true"></i>' +'</td>' +
                          '<td>'+ this.Licencia +'</td>' +
                          '<td>'+ this.FechaHoraConsulta +'</td>' +
                          '</tr>';

                          totalimp += Number(this.Importe);
                          totagasto += Number(this.Gasto);
                          totaldcto += Number(this.Descuento);
                          tdtotal += Number(this.TotalPagar);
          });

          $('#totalimp').text(totalimp.toFixed(2));
          $('#totagasto').text(totagasto.toFixed(2));
          $('#totaldcto').text(totaldcto.toFixed(2));
          $('#tdtotal').text(tdtotal.toFixed(2));

          if (respuesta.length == 0) {
            strTabla += '<tr >' +
                        '<td colspan="10" style="text-align:center;">No se ha encontrado informaciòn.</td>' +
                        '</tr>';

          }

          $('#tbunidadpapeleta tbody').append(strTabla);

        }else if(indice == 18){

            $('#tbresumenpapeletas tbody').empty();
            var strTabla = '';
            $.each(respuesta,function(i){
                strTabla += '<tr data-estado="'+ this.Estado +'" onclick="verDetalle($(this));" >' +
                            '<td>'+ (i+1) +'</td>' +
                            '<td>'+ this.Estado +'</td>' +
                            '<td class="text-right" >'+ this.Cantidad +'</td>';
            });
              $('#tbresumenpapeletas tbody').append(strTabla);
        }else if(indice == 19){

          $('#tbunidadpapeleta caption').html('<h3>Papeletas en estado : '+ ROW_SELECT+' <i onclick="" title="Exportar" style="cursor:pointer;" class="fa fa-file-excel-o" aria-hidden="true"></i></h3>');
          $('#tbunidadpapeleta tbody').empty();
          var strTabla = '';
          var totalimp = 0;
          var totagasto = 0;
          var totaldcto = 0;
          var tdtotal = 0;

          $.each(respuesta,function(i){
              strTabla += '<tr >' +
                          '<td>'+ (i+1) +'</td>' +
                          '<td>'+ this.Unidad +'</td>' +
                          '<td>'+ this.Documento +'</td>' +
                          '<td>'+ this.FechaInfraccion +'</td>' +
                          '<td class="text-right" >'+ this.Importe +'</td>' +
                          '<td class="text-right" >'+ this.Gasto +'</td>' +
                          '<td class="text-right" >'+ this.Descuento +'</td>' +
                          '<td class="text-right" >'+ this.TotalPagar +'</td>' +
                          '<td>'+ this.CodigoFalta + ' <i title="'+this.Infraccion+'" style="cursor:pointer;" class="fa fa-file-text-o" aria-hidden="true"></i>' +'</td>' +
                          '<td>'+ this.Licencia +'</td>' +
                          '<td>'+ this.FechaHoraConsulta +'</td>' +
                          '</tr>';

                          totalimp += Number(this.Importe);
                          totagasto += Number(this.Gasto);
                          totaldcto += Number(this.Descuento);
                          tdtotal += Number(this.TotalPagar);
          });
          $('#tbunidadpapeleta tbody').append(strTabla);
          $('#totalimp').text(totalimp.toFixed(2));
          $('#totagasto').text(totagasto.toFixed(2));
          $('#totaldcto').text(totaldcto.toFixed(2));
          $('#tdtotal').text(tdtotal.toFixed(2));
        }

      },'json');
}

function listapapeletaporunidad(parametros){

  procunidadpapeleta(URL_BASE+'Registros/ProcUnidadPapeleta', parametros, 16);
}

function resumenPorEstado(parametros){
  procunidadpapeleta(URL_BASE+'Registros/ProcUnidadPapeleta', parametros, 18);
}

function listaPapeletasPorEstado(parametros){
  procunidadpapeleta(URL_BASE+'Registros/ProcUnidadPapeleta', parametros, 19);
}
