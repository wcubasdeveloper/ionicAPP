function reproducirDispositivo(){
  reproductorActivo = true;

  /*oculta los marcadores*/
  $.each(arrMarcadorUnidad,function(){
      this.setVisible(false);
  });
  infowindowUnidadTrack.close();

  /*data del reproductor aqui viene el ajax*/

  var jsonDatareproductorTrack = dataReproductor;
  graficarRecorridoReproductor(jsonDatareproductorTrack);
}


function graficarRecorridoReproductor(data){

  var puntosPollinea = [];
  var bounds = new google.maps.LatLngBounds();
      $.each(data,function(i){
        var punto = new google.maps.LatLng(this.Latitud, this.Longitud);
            puntosPollinea.push(punto);
            bounds.extend(punto);
      });

     for (var i = 0; i < puntosPollinea.length - 1; i++){
       var PathStyle = new google.maps.Polyline({
                 path: [puntosPollinea[i], puntosPollinea[i+1]],
                 strokeColor: 'red',
                 strokeOpacity: 1,
                 strokeWeight: 3,
                 draggable : true,
                 map: mapalocalizador
             });
     }
     mapalocalizador.fitBounds(bounds);
}
