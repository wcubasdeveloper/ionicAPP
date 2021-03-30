function procUnidad(url, parametros, indice){


     $.post(url, {parametros: parametros, indice: indice}, function (respuesta) {
        if (indice == 10) { //lista
          console.log(respuesta);
          $('#tbUnidad tbody').empty();
          var strTabla = '';
          $.each(respuesta,function(i){
              strTabla += '<tr  >' +
                          '<td>'+ (i+1) +'</td>' +
                          '<td>'+ this.NomUnidadTipo  +'</td>' +
                          '<td>'+ this.padron +'</td>' +
                          '<td>'+ this.placa  +'</td>' +
                          '<td>'+ this.Marca +'</td>' +
                          '<td>'+ this.Modelo  +'</td>' +
                          '<td>'+ this.Año +'</td>' +
                          '<td>'+ this.FechaCrea  +'</td>' +
                          '<td>'+ '<button style="width:100px;" type="button" class="btn bg-teal btn-block btn-xs waves-effect">ACTIVO</button>' +'</td>' +
                          '<td>' +
                            '<button type="button" onclick="eliminarunidad('+this.CodUnidad+')" class="btn bg-red btn-block btn-xs waves-effect"><i class="material-icons">delete</i></button>' +
                          '</td>' +

                          '</tr>';
          });
          $('#tbUnidad tbody').append(strTabla);

        }else if(indice == 20){
            $('#myModal').modal('hide');
          $.notify(respuesta[0].DesResultado,(respuesta[0].CodResultado == 1  ? "success" : "error" ) );
          listarUnidad();
          //$.notify("Do not press this button", "info");
          //$.notify("Access granted", "success");
        }else if (indice == 40){
          $.notify(respuesta[0].DesResultado,(respuesta[0].CodResultado == 1  ? "success" : "error" ) );
          listarUnidad();
        }

      },'json');
}

function listarUnidad(){
  procUnidad(URL_BASE+'Registros/procUnidad', '', 10);
}

function eliminarunidad(codunidad){
  var parametros = codunidad + '|'+ codigoUsuario;
    procUnidad(URL_BASE+'Registros/procUnidad', parametros, 40);
}

function registrarUnidad(codunidadTipo, padron, placa, marca, modelo, anio, codusuariocrea){
  procUnidad(URL_BASE+'Registros/procUnidad', codunidadTipo + '|' +
                                                      padron + '|' +
                                                      placa + '|' +
                                                      marca + '|' +
                                                      modelo + '|' +
                                                      anio + '|' + 1 , 20);
}
