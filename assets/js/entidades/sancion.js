function procSancion(url, parametros, indice){

     $.post(url, {parametros: parametros, indice: indice,}, function (respuesta) {
        if (indice == 10) { //lista

          $('#tbListaSancion tbody').empty();
          var strTabla = '';
          $.each(respuesta,function(i){
              strTabla += '<tr>' +
                          '<td>'+ (i+1) +'</td>' +
                          '<td>'+ this.CodigoSancion +'</td>' +
                          '<td>'+ this.NomSancion +'</td>' +
                          '<td>'+
                            '<span class="badge ' + (this.CodEstado == '1' ? 'bg-green' :'bg-red') + '" style="width: 80px;">' + this.NomEstado + '</span>' +
                          '</td>' +
                          '<td>'+ this.NomUsuario +'</td>' +
                          '<td>'+ this.FechaCreacion +'</td>' +
                          '</tr>';
          });
          $('#tbListaSancion tbody').append(strTabla);
        }
      },'json');
}

function listarSanciones(parametros){
  procSancion(URL_BASE+'Registros/procSancion', '', 10);
}
