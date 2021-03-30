(function () {
    var Imagen = $id('ImgCargando');
    var fileselect = $id('FileImagenPedido'),
		filedrag = $id('filedrag'),
		// submitbutton = $id('submitbutton'),
        o = $id("progress");
    function $id(id) {
        return document.getElementById(id);
    }
    function Output(msg) {
        var m = $id("messages");
        m.innerHTML = msg + m.innerHTML;
    }
    function FileDragHover(e) {
        e.stopPropagation();
        e.preventDefault();
        e.target.className = (e.type == "dragover" ? "hover" : "");
    }
    function FileSelectHandler(e) {
        // cancel event and hover styling
        FileDragHover(e);
        // fetch FileList object
        var files = e.target.files || e.dataTransfer.files;
        // process all File objects
        for (var i = 0, f; f = files[i]; i++) {
            ParseFile(f);
            var reader = new FileReader();
                reader.onload = function (e) {
                Imagen.setAttribute('src', e.target.result);
                    // filedrag.style.border = 'none';
            }
            reader.readAsDataURL(f);
            // ImgEmpresa.attr('src', RutaProyecto + 'Archivos/Empresa/Logo.jpg?' + Hora.getTime());
            // UploadFile(f);
        }
    }
    // output file information
    function ParseFile(file) {
        /*Output(
        "<p>File information: <strong>" + file.name +
        "</strong> type: <strong>" + file.type +
        "</strong> size: <strong>" + file.size +
        "</strong> bytes</p>"
        );*/

        /*Muestra Imagen en 'Blanco' hasta que termine de subir la imagen*/

        // Imagen.setAttribute('src', RutaProyecto + 'Archivos/Compartido/ImgCargando.jpg');
        // Imagen.style.display = 'Block';
        // filedrag.style.border = '2px dashed #555';
        o.style.display = 'Block';
        // if (file.type.indexOf("image") == 0) {
        //     var reader = new FileReader();
        //     reader.onload = function (e) {
        //         Output(
        //             "<p><strong>" + file.name + ":</strong><br />" +
        //             '<img src="' + e.target.result + '" /></p>'
        //         );
        //     }
        //     reader.readAsDataURL(file);
        // }

        // display text
        if (file.type.indexOf("text") == 0) {
            var reader = new FileReader();
            reader.onload = function (e) {
                Output(
					"<p><strong>" + file.name + ":</strong></p><pre>" +
					e.target.result.replace(/</g, "&lt;").replace(/>/g, "&gt;") +
					"</pre>"
				);
            }
            reader.readAsText(file);
        }

    }


    // upload JPEG files
    function UploadFile(file) {
        // following line is not necessary: prevents running on SitePoint servers
        if (location.host.indexOf("sitepointstatic") >= 0) return

        var xhr = new XMLHttpRequest();
        //if (xhr.upload && file.type == "image/jpeg" && file.size <= $id("MAX_FILE_SIZE").value) {
            
        if (xhr.upload /*&& file.type == "image/jpeg"*/) {
        // create progress bar
            var progress = o.appendChild(document.createElement('p'));
            //progress.appendChild(document.createTextNode("Cargando " + file.name));


            // progress bar
            xhr.upload.addEventListener("progress", function (e) {
                var pc = parseInt(100 - (e.loaded / e.total * 100));
                progress.style.backgroundPosition = pc + "% 0";
                // if (pc == 0) { /*Cuando termina, Muestra la Imagen cargada*/
                    if (file.type.indexOf("image") == 0) {
                        var reader = new FileReader();
                        reader.onload = function (e) {
                            Imagen.setAttribute('src', e.target.result);
                            // filedrag.style.border = 'none';
                        }
                        reader.readAsDataURL(file);
                        var Hora = new Date();
                        // ImgEmpresa.attr('src', RutaProyecto + 'Archivos/Empresa/Logo.jpg?' + Hora.getTime());
                        $('#progress').html('');
                    }
                // }
            }, false);

            // file received/failed
            xhr.onreadystatechange = function (e) {
                //            alert(xhr.readyState);
                if (xhr.readyState == 4) {
                    progress.className = (xhr.status == 200 ? "Cargó" : "Error");
                }
            };

            // start upload
            xhr.open("POST", $id("FrmPedido").action, true);
            /*Cabeceras*/
            xhr.setRequestHeader("X-File-Name", file.name);
            xhr.setRequestHeader("X-File-Size", file.size);
            xhr.setRequestHeader("X-File-Type", file.type);
            xhr.setRequestHeader("CodPedido", CodPedidoGeneral);
            xhr.send(file);
        }
    }


    // initialize
    function Init() {
        // file select
        fileselect.addEventListener('change', FileSelectHandler, false);

        // is XHR2 available?
        var xhr = new XMLHttpRequest();
        if (xhr.upload) {
            // file drop
            filedrag.addEventListener('dragover', FileDragHover, false);
            filedrag.addEventListener('dragleave', FileDragHover, false);
            filedrag.addEventListener('drop', FileSelectHandler, false);
            filedrag.style.display = 'block';

            // remove submit button
            // submitbutton.style.display = 'none';
        }

    }

    // call initialization file
    if (window.File && window.FileList && window.FileReader) {
        Init();
    }


})();