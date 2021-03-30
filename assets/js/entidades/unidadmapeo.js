function procUnidadMapeo(url, parametros, indice){

//console.log({parametros: parametros, indice: indice});

     $.post(url, {parametros: parametros, indice: indice}, function (respuesta) {
        if (indice == 10) { //lista

            armarAsientos(66,respuesta);

        }else if(indice == 11){

          var jsonPisoUno = [];
          var jsonPisoDos = [];

          console.log("--- ---");
          console.log(jsonPisoUno)
          $.each(respuesta,function(i){

            if(this.Piso == 1){
              jsonPisoUno.push({
                  CodUnidad: this.CodUnidad,
                  Columna:this.Columna,
                  Fila: this.Fila,
                  Numero: this.Numero,
                  Piso:this.Piso,
                  position : this.position
              });
            }else{
              jsonPisoDos.push({
                  CodUnidad: this.CodUnidad,
                  Columna:this.Columna,
                  Fila: this.Fila,
                  Numero: this.Numero,
                  Piso:this.Piso,
                  position : this.position
              });
            }
          });

          console.log("len piso 1 :" + jsonPisoUno.length)

          console.log("len piso 2: " +jsonPisoUno.length )

          armarAsientos(jsonPisoUno.length * 2,jsonPisoUno)
          armarAsientoSegundoPiso(jsonPisoDos.length * 2,jsonPisoDos);

          var cantidadAsientosDisponibles = 0;

          var nasientopisodos = $('#holder li.seat').length;
          var nasientopisouno = $('#holder2 li.seat').length;
          cantidadAsientosDisponibles = 0;
          cantidadAsientosDisponibles = (nasientopisodos + nasientopisouno) - 0;

          //console.log("---->",$('#holder .seat').length);
          $('#lblcantidadDisponibles').text('( '+cantidadAsientosDisponibles + ' )');

        }else if (indice == 15) {
          console.log(respuesta);
          $('#selectNombreTipo').empty();
          $.each(respuesta,function(i){
            $('#selectNombreTipo').append('<option value="'+ this.CodUnidadTipo +'" >'+ this.NomUnidadTipo +'</option>');

          });


        }else if(indice == 20){

          console.log("rpta del guardar")
          console.log(respuesta);
            //$('#myModal').modal('hide');
          $.notify(respuesta[0].DesResultado,(respuesta[0].CodResultado == 1  ? "success" : "error" ) );

          $("#divBoletoVenta").dialog("close");

          listarAsientosxUnidades($('#selectBus').val() + '|' + $('#selectPiso').val(),10);
          //listarUnidadTipo();
          //$.notify("Do not press this button", "info");
          //$.notify("Access granted", "success");
        }else if(indice == 30){

          console.log("rpta del actualizar")
          console.log(respuesta);
          $.notify(respuesta[0].DesResultado,(respuesta[0].CodResultado == 1  ? "success" : "error" ) );
          $('#dialogeditarasient').modal('hide');
          listarAsientosxUnidades($('#selectBus').val() + '|' + $('#selectPiso').val(),10);

        }else if(indice == 40){

          console.log("rpta del eliminar")
          console.log(respuesta);
          $.notify(respuesta[0].DesResultado,(respuesta[0].CodResultado == 1  ? "success" : "error" ) );
          $('#dialogeditarasient').modal('hide');
          listarAsientosxUnidades($('#selectBus').val() + '|' + $('#selectPiso').val(),10);
        }


      },'json');
}

function listarAsientosxUnidades(parametros){
  /*console.log("lista asientos  x unidades")
  console.log(parametros)*/
  procUnidadMapeo(URL_BASE+'Registros/procUnidadMapeo', parametros, 10);
}

function actualizarasientomapeopost(parametros){

    procUnidadMapeo(URL_BASE+'Registros/procUnidadMapeo', parametros , 30);
}

function eliminarasientomapeoPost(parametros){
  procUnidadMapeo(URL_BASE+'Registros/procUnidadMapeo', parametros , 40);
}

function guardaAsientoMapeo(parametros){

  procUnidadMapeo(URL_BASE+'Registros/procUnidadMapeo', parametros , 20);
}

function listarMapeoGeneral(parametros){

  procUnidadMapeo(URL_BASE+'Registros/procUnidadMapeo', parametros, 11);
}
