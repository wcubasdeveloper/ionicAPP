function procUnidadTipo(url, parametros, indice){

console.log({parametros: parametros, indice: indice});

     $.post(url, {parametros: parametros, indice: indice}, function (respuesta) {
        if (indice == 10) { //lista
          console.log(respuesta)
          $('#tbUnidadTipo tbody').empty();
          var strTabla = '';
          $.each(respuesta,function(i){
              strTabla += '<tr data-padron="'+ this.Padron +'"  data-placa="'+this.Placa+'" data-codunidad="'+this.CodUnidad+'" >' +
                          '<td>'+ (i+1) +'</td>' +
                          '<td>'+ this.NomUnidadTipo  +'</td>' +
                          '<td>'+ this.Asientos +'</td>' +
                          '<td>'+ '<button style="width:100px;" type="button" class="btn bg-teal btn-block btn-xs waves-effect">ACTIVO</button>' +'</td>' +
                          '<td>'+
                            '<button data-codunidadtipo="'+this.CodUnidadTipo+'" data-nomunidadtipo="'+this.NomUnidadTipo+'" data-nroasientos="'+this.Asientos+'" onclick="modificardatos($(this));" type="button" class="btn bg-orange btn-block btn-xs waves-effect"><i class="material-icons">settings</i></button>' +
                          '</td>' +
                          '<td>' +
                            '<button onclick="aunlarunidadtipo('+this.CodUnidadTipo+');" type="button" class="btn bg-red btn-block btn-xs waves-effect"><i class="material-icons">delete</i></button>' +
                          '</td>' +

                          '</tr>';
          });
          $('#tbUnidadTipo tbody').append(strTabla);

        }else if (indice == 15) {
          console.log(respuesta);
          $('#selectNombreTipo').empty();
          $.each(respuesta,function(i){
            $('#selectNombreTipo').append('<option value="'+ this.CodUnidadTipo +'" >'+ this.NomUnidadTipo +'</option>');

          });


        }
        else if(indice == 20){
          console.log("rpta guarda");
          console.log(respuesta)
            $('#myModal').modal('hide');
          $.notify(respuesta[0].DesResultado,(respuesta[0].CodResultado == 1  ? "success" : "error" ) );
          listarUnidadTipo();
          //$.notify("Do not press this button", "info");
          //$.notify("Access granted", "success");
        }else if(indice == 30){
          $('#myModal').modal('hide');
          $.notify(respuesta[0].DesResultado,(respuesta[0].CodResultado == 1  ? "success" : "error" ) );
          listarUnidadTipo();
        }else if(indice == 40){

          $.notify(respuesta[0].DesResultado,(respuesta[0].CodResultado == 1  ? "success" : "error" ) );
          listarUnidadTipo();
        }

      },'json');
}

function listarUnidadTipo(){
  procUnidadTipo(URL_BASE+'Registros/procUnidadTipo', '', 10);
}

function registrarUnidadTipo(nombreTipo, cantidadAsientos){
  procUnidadTipo(URL_BASE+'Registros/procUnidadTipo', nombreTipo + '|' +  cantidadAsientos , 20);
}
function actualizarunidadtipo(parametros){
  procUnidadTipo(URL_BASE+'Registros/procUnidadTipo', parametros , 30);
}

function aunlarunidadtipo(parametros){
procUnidadTipo(URL_BASE+'Registros/procUnidadTipo', parametros , 40);
}

function selectUnidadTipo(){
  procUnidadTipo(URL_BASE+'Registros/procUnidadTipoSelect', '', 15);
}
