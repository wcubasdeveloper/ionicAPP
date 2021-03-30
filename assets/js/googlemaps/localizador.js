var arrMarcadorUnidad = [];
var arrInfowindow = [];

function dibujarObjetoTrackEnMapa(dataTrackUnidades){
  clearOverlays(arrMarcadorUnidad);
  arrMarcadorUnidad.splice(0,arrMarcadorUnidad.length)
    $.each(dataTrackUnidades,function(i){
      var position = new google.maps.LatLng(this.Latitud, this.Longitud);
      if(arrMarcadorUnidad[i]){ //ACtualiza Posicion
          arrMarcadorUnidad[i].setPosition(position);
          arrMarcadorUnidad[i].htmlInfowindow = getHtmlInfowindow(this);
          infowindowUnidadTrack.setContent(arrMarcadorUnidad[i].htmlInfowindow);
      }else{ //Crea Marcador
        var marcador = utilMap.CrearMarcador(this.Latitud,this.Longitud,base_url+'/assets/images/mapa/icons/unidad/car.png','hola',true,mapalocalizador)
        marcador.htmlInfowindow = getHtmlInfowindow(this);
        marcador.codunidad = this.CodUnidad;
        marcador.addListener('click', function() {
            var markClickeado = this;
            infowindowUnidadTrack.setContent(this.htmlInfowindow);
            infowindowUnidadTrack.open(mapalocalizador, this);

         });
        arrMarcadorUnidad.push(marcador);
      }
        arrMarcadorUnidad[i].setMap(mapalocalizador);
    });

   timer = setTimeout('getRegistroTrackUnidades()', intervalo);
}

function clearOverlays(clearArray) {
    if (clearArray) {
        for (i in clearArray) {
            clearOverlay(clearArray[i]); //.setMap(null);
        }
    }
}

function clearOverlay(overlay) {
    overlay.setMap(null);
}
