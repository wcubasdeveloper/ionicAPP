

function Util() {

    //this.Coordenadas = Coordenadas;
    //this.ColorLinea = ColorLinea;
    //this.ColorFondo = ColorFondo;
    //this.Grosor = Grosor;
    //this.Editable = Editable;
    //this.Movible = Movible;
    //this.Div = TxtDistancia;
    //this.Sup = null;

    //this.mapa = mapa;
}

//crea marcador

Util.prototype.crearMapa = function (strContenedor,optionsMap) { // retorna label alado de algun control del mapa
    var mapa =new google.maps.Map(document.getElementById(strContenedor),optionsMap);
    return mapa;
}
//crea marcador
Util.prototype.CrearDiv = function (latitud, longitud,htmlContenido, draggable,idDiv) { // retorna label alado de algun control del mapa
    var pos = new google.maps.LatLng(latitud, longitud);
    var marker = new RichMarker({
        position: pos,
        map: map,
        flat: true,
        anchor: RichMarkerPosition.MIDDLE,
        draggable: draggable,
        content: htmlContenido
    });
    return marker;
}

Util.prototype.CrearMarcador = function (lat, lng, imagen, title, draggable, mapalocalizador) { // retorna marcador de google map

    var pos = new google.maps.LatLng(lat, lng);

    var marcador = new google.maps.Marker({
        map: mapalocalizador,
        position: pos,
        icon: imagen,
        title: title,
        draggable: draggable
    });
        return marcador;
}

Util.prototype.crearMarcadorGrupo = function (arrayGrupo) {

    var gm = google.maps;
    var iw = new gm.InfoWindow();
    var usualColor = 'eebb22';
    var spiderfiedColor = 'ffee22';
    var oms = new OverlappingMarkerSpiderfier(map,
    { markersWontMove: true, markersWontHide: true });


    var shadow = new gm.MarkerImage(
           'https://www.google.com/intl/en_ALL/mapfiles/shadow50.png',
           new gm.Size(37, 34),  // size   - for sprite clipping
           new gm.Point(0, 0),   // origin - ditto
           new gm.Point(10, 34)  // anchor - where to meet map location
        );

    var iconWithColor = function (color) {
        //return 'https://chart.googleapis.com/chart?chst=d_map_xpin_letter&chld=pin|+|' +
        //  color + '|000000|ffff00';
        return "../images/iconos/imagen19_19.png";
    }

    var iconoNormal = function (color) {
        //return 'https://chart.googleapis.com/chart?chst=d_map_xpin_letter&chld=pin|+|' +
        //  color + '|000000|ffff00';
        return "../images/iconos/multiUsuario32.png";
    }

    //oms.addListener('click', function (marker) {
    //    iw.open(map, marker);
    //});

    oms.addListener('spiderfy', function (markers) {
        for (var i = 0; i < markers.length; i++) {
            markers[i].setIcon(iconWithColor(spiderfiedColor));
            markers[i].setShadow(null);
        }
        iw.close();
    });

    oms.addListener('unspiderfy', function (markers) {
        for (var i = 0; i < markers.length; i++) {
            markers[i].setIcon(iconoNormal(iconoNormal));
            markers[i].setShadow(shadow);
        }
    });

    $.each(arrayGrupo, function () {
        oms.addMarker(this);
    });
    //console.log(oms);
    //return oms;
}

Util.prototype.CrearLabel = function (latitud, longitud, texto) { //

    var pos = new google.maps.LatLng(latitud, longitud);

    var mapLabel = new MapLabel({
        text: texto,
        position: new google.maps.LatLng(pos),
        map: map,
        fontSize: 35,
        align: 'right'
    });

    return mapLabel;
}
//crea circulo
Util.prototype.CrearCirculo = function (lat, lng, radio, editable, draggable, color, bordeColor, toolTip){ // retorna control circle de google map



    var titulo = toolTip;
    if (titulo == null || titulo == '') {
        titulo = "...";
    }else{
        titulo = toolTip;
    }

    var posicion = new google.maps.LatLng(lat,lng);

    var circulo = new google.maps.Circle({
        strokeColor: color,
        strokeOpacity: 0.8,
        fillColor: color,
        fillOpacity: 0.35,

        center: posicion,
        radius: radio,
        map: this.mapa,
        strokeWeight: 2,
        //strokeColor: color,
        title: titulo,
        //fillColor: color,
        editable: editable,
        draggable: draggable
    });

        google.maps.event.addListener(circulo, 'mouseover', function () {
            this.getMap().getDiv().setAttribute('title', this.get('title'));
        });

        google.maps.event.addListener(circulo, 'mouseout', function () {
            this.getMap().getDiv().removeAttribute('title');
        });

        return circulo;
}

//crea rectangulo
Util.prototype.CrearRectangulo = function (norte,sur,este,oeste,editable, draggable) { // retorna un elemento tipo rectangulo de google map

    var rectangulo = new google.maps.Rectangle({
        map: this.mapa,
        bounds: {
            north: -12.036299 ,
            south: -12.033948,
            east: -77.046776,
            west: -77.074242
        },
        editable: editable,
        draggable:draggable
    });

    return rectangulo;
}
//crea polygono
Util.prototype.CrearPolygono = function (paths, editable, draggable,color) {

    var Polygono = new google.maps.Polygon({
        paths: paths,
        editable: editable,
        draggable : draggable
    });

    Polygono.setMap(this.mapa);
    return Polygono;
} // retorna un elemento tipo polygono de google map

//crea infobubble
Util.prototype.CrearInfoBuble = function (position, html, maxWidth) { // retorna un elemento tipo infobuble de google map

    var contentString = '<div id="content">' +
        '<h1>Uluru</h1>' +
        '<p><b>Uluru</b>, also referred to as <b>Ayers Rock</b>, is a large ' +
        'sandstone rock formation in the southern part of the ' +
        'Northern Territory, central Australia. It lies 335&#160;km (208&#160;mi) ' +
        'south west of the nearest large town, Alice Springs; 450&#160;km ' +
        '(280&#160;mi) by road. Kata Tjuta and Uluru are the two major ' +
        'features of the Uluru - Kata Tjuta National Park. Uluru is ' +
        'sacred to the Pitjantjatjara and Yankunytjatjara, the ' +
        'Aboriginal people of the area. It has many springs, waterholes, ' +
        'rock caves and ancient paintings. Uluru is listed as a World ' +
        'Heritage Site.</p>' +
        '<p>Attribution: Uluru, <a href="http://en.wikipedia.org/w/index.php?title=Uluru&oldid=297882194">' +
        'http://en.wikipedia.org/w/index.php?title=Uluru</a> ' +
        '(last visited June 22, 2009).</p>' +
        '</div>';
    var div = document.createElement('DIV');
    var marcador = Superposicion.prototype.CrearMarcador(position, null, '.', false);
    var htmlContenido = '<div style="width:150px;height:150px;">d</div>'

    var infoBubble = new InfoBubble({
        maxWidth: 500,
        content: htmlContenido,
        borderWidth: 1,
        padding: 0,
        borderRadius: 5
   });

   //infoBubble.open(this.mapa,marcador);
   //infoBubble.addTab('Uluru', contentString);

    return infoBubble;
}

//crea infoWindow
Util.prototype.CrearInfoWindow = function (posicion, editable, draggable) { //// retorna un elemento tipo infowindow con stret view de google map

   var street = new google.maps.StreetViewPanorama(document.getElementById("street"), {

        position: posicion,
        zoomControl: false,
        enableCloseButton: false,
        zoomControl: false,
        enableCloseButton: false,
        addresControl: false,
        panControl: false,
        LinksControl: false
    });

    var infow = new google.maps.InfoWindow({ content: document.getElementById("street")});
    var myLatLng = posicion;
    var marker = new google.maps.Marker({
        position: myLatLng,
        map: this.mapa,
    });

    infow.open(map, marker);
    map.setCenter(myLatLng);
}

Util.prototype.CrearInfoWindowSinStreet = function (lat, lng, editable, contenidoHTML) { // retorna un elemento tipo infowindow de google map


    var posicion = new google.maps.LatLng(lat, lng);
    var infow = new google.maps.InfoWindow({ content: contenidoHTML });
    var myLatLng = posicion;
    var marker = new google.maps.Marker({
        position: myLatLng,
        map: this.mapa,
    });


        infow.open(map, marker);
        map.setCenter(myLatLng);

    return marker;
}

Util.prototype.CrearPolylinea = function (paths, editable, draggable) { // retorna un elemento polylinea teniendo como parametro un path de google map

    var ObjPolylinea = new google.maps.Polyline({
        path: paths,
        editable: editable,
        draggable: draggable,
        //geodesic: true,
        strokeColor: '#039623',
        strokeOpacity: 0.4,
        //icons: [{
        //    icon: {path: google.maps.SymbolPath.FORWARD_CLOSED_ARROW},
        //    offset: '100%'
        //}],
        strokeWeight: 5
    });

    ObjPolylinea.setMap(this.mapa);
    return ObjPolylinea;
}

Util.prototype.PolygonCenter = function (poly) { // retorna un punto latlng del centro del polygono

    var lowx,
        highx,
        lowy,
        highy,
        lats = [],
        lngs = [],
        vertices = poly.getPath();

    for (var i = 0; i < vertices.length; i++) {
        lngs.push(vertices.getAt(i).lng());
        lats.push(vertices.getAt(i).lat());
    }

        lats.sort();
        lngs.sort();
        lowx = lats[0];
        highx = lats[vertices.length - 1];
        lowy = lngs[0];
        highy = lngs[vertices.length - 1];
        center_x = lowx + ((highx - lowx) / 2);
        center_y = lowy + ((highy - lowy) / 2);
        return (new google.maps.LatLng(center_x, center_y));
}
