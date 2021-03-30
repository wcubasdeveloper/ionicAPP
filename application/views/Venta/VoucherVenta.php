

  <link href="<?=base_url()?>assets/csoftcontent/css/plugins/selectize/selectize.bootstrap3.css"rel="stylesheet">
  <link href="<?=base_url()?>assets/csoftcontent/css/plugins/selectize/selectize.default.css"rel="stylesheet">
  <script src="<?=base_url()?>assets/csoftcontent/js/plugins/selectize/selectize.js"></script>
  <script src="<?=base_url()?>assets/csoftcontent/js/plugins/print/Print.js"></script>
<div id="impresionBoleto" style="width:300px;display:none;" >
    <div style="width:300px">
        <h4 id="NomEmpresa" style="text-align:center;"> </h4>
        <h4 id="RucEmpresa" style="text-align:center;" > </h4>
        <p id="DireccionEmpresa" style="text-align:center;" > </p>
        <h3 id="NomDocumento" tyle="text-align:center;" > </h3>
        <h3 id="Documento" style="text-align:center;"> </h3>
        <br>
        <table>
            <thead>
                <tr>
                    <td>Fecha Emision</td>
                    <td id="FechaEmision"></td>
                </tr>
                <tr>
                    <td>Hora</td>
                    <td id="HoraEmision"></td>
                </tr>
                <tr>
                    <td>Caja</td>
                    <td id="NomCaja"></td>
                </tr>
                <tr>
                    <td>Tipo Moneda</td>
                    <td id="TipoMoneda"></td>
                </tr>
                <tr>
                    <td>Cliente</td>
                    <td id="Cliente"></td>
                </tr>
            </thead>
        </table>
        <br>
        <hr>
        <table id="TbVentaDetalle">
          <thead>
            <tr>
              <th>N</th>
              <th>PRODUCTO</th>
              <th>CANT</th>
              <th>P.UNIT</th>
              <th>TOTAL</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
        <table>
            <thead>
                <tr>
                    <td>Subtotal</td>
                    <td>S/.</td>
                    <td id="SubTotal" style="text-align:right;" ></td>
                </tr>
                <tr>
                    <td>IGV 18%</td>
                    <td>S/</td>
                    <td id="IGV" style="text-align:right;"></td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td>S/</td>
                    <td id="Total" style="text-align:right;"></td>
                </tr>

                <tr>
                    <td></td>
                    <td style="padding-top:20px;" id="sectionQr"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAATQAAAE0AQMAAACYT13cAAAABlBMVEX///8AAABVwtN+AAAElUlEQVRoge2aS5bjOAwEcQPc/5a4AYaITFXPbHrTi5xF+7nKshT2E0l8EqCr/j7+7LG7M7vvoLbnHc577Z6t94YTDwhy72/6Pftx2/eB4d1M9fvIACQ5nemufth7eX93/+9DbyRrIMv1nX3vuOrJZcrfHP8fuDr2PW7Jj3onzNSNKMudHUwf0bfovVB1p+5L/mMvAQ4/+t3j3/4W4Igx73kGencvq8CD7rg+JsWdgb65PTcqQtJ5/N38hSJ8yfMc43Dud+6QqrssXzrzaEZVQQ5Xevf73l941CjOZFfDaCw3x42ieLH4dw7PJrZfWP+xhRRXxfVzdIJ2QffZLYMiDSU5Fn+JigpI39FNfY+sI8ethnBhXBYxWOwS2N8xLkmNpebloqguBJliHneBwhrmWf+E1fxMS5zxLeVzTpkHGkOL8rew//CD9Ixb0xdJLrkmjoVcq7MdwUY6JljZvkbJ+Xbez478ga1hcnyJEEL62UAw8qbBmD6NkKcsvVC4us/TkS2ZAEc+r7i6YhjlhTYvpzHVUDqzzNGGMcBd5ph6222KGgakuy0xOV5BRpkFvM+U3wzT758QYlO01xQ/10gfEiuOQh0YgihYpA9hziVqTumNLuTAGZaGUrM0hx+LVkDSMiRNJsWC1Aqc5LcZR4QzxnDI5Di004DiQ5xLTq5EXWqAJt11Y/ci3GlQqmrdLfykIRFEWB0FlObRBJMAzVJ1uFwKc3QtzdLEYwLkCLekplsrJNJbk9jIqTjDytFsi6wdT9K9pHuKaIPwugJikpsrH57q98GeLGhYmLlJU2RHerMCjNc4pj6TW7qpu+YK7ErZo+yeHSi/oaeZP6wER3JnmT3K13orUyPzpjwwJke+ZIFfSqso22CUaR06lHP5T7ye4lszp8cpr7Uu26vpgghzVcZNoVrq/pRnJhhiu6v0QxwgkrpWdR7AEdzt/5zikq6Ol6j2pbk34ICwqyCEHSTClrYd2HhzrnK+OD3FrPyZVW8Q6bGrDrrwfEOLKe17fbsSqdzlyebojXxzPcCh9GqxrG2BnyZWL+iFBbtU9opepNfe2kxqI1ANJTns3dwUvaj2lYLUvW96ny3Atp+ZQW9lUfWwUqwk7neXO1UFIhk1nU8a7HkIFOTWoW1s3FrXjCkV9pJokN18XXfPa2oKQrqBq/to5IQ4zbPcTWs2FVk2qbsjPfk+Ia80nCYdOF104kg1jml86McHpRxRoLod0yUS5EoIiy6kQIaN4YJjvKv9pAYKcGtRudREw1Yq7+njLLdckh2PL4blt/Wam1P6nBt0KcuRjWujs5yALtau97W3sKLfuw6iiJ0KO9yFohAvo1yzkz7qhSxthTuHedCqjnIlLzqDJSnrhx1UeZJk368oQhxlqH8HgC60m4+7Sj/94hDH2aOPQtEyEKy3faWCnC63DtCLqAlmeLR/XEluqIyp5bFV/yDP/jXe0QlyWnHNKmMphfJSANUuRZZzbee+wweo5fDT7wxySMVV4w0rWCx0rX86ymkA5GkOyNsWZ59nBbn1Nph6CrzYq2rcMuwk9/fxJ49/AFlzFx4JIgMdAAAAAElFTkSuQmCC" id="imgcodigoqr" width="250" height="250" />
                    </td>
                    <td></td>
                </tr>
            </thead>
        </table>
        <hr>
        <table>
            <thead>
                <tr>
                    <td>Usuario</td>
                    <td>:</td>
                    <td id="NomUsuario" style="text-align:center;">admin</td>
                </tr>

            </thead>
        </table>
    </div>
 </div>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
        <table>
            <thead>
                <tr>
                    <td>Subtotal</td>
                    <td>S/.</td>
                    <td id="SubTotal" style="text-align:right;" ></td>
                </tr>
                <tr>
                    <td>IGV 18%</td>
                    <td>S/</td>
                    <td id="IGV" style="text-align:right;"></td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td>S/</td>
                    <td id="Total" style="text-align:right;"></td>
                </tr>

                <tr>
                    <td></td>
                    <td style="padding-top:20px;" id="sectionQr"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAATQAAAE0AQMAAACYT13cAAAABlBMVEX///8AAABVwtN+AAAElUlEQVRoge2aS5bjOAwEcQPc/5a4AYaITFXPbHrTi5xF+7nKshT2E0l8EqCr/j7+7LG7M7vvoLbnHc577Z6t94YTDwhy72/6Pftx2/eB4d1M9fvIACQ5nemufth7eX93/+9DbyRrIMv1nX3vuOrJZcrfHP8fuDr2PW7Jj3onzNSNKMudHUwf0bfovVB1p+5L/mMvAQ4/+t3j3/4W4Igx73kGencvq8CD7rg+JsWdgb65PTcqQtJ5/N38hSJ8yfMc43Dud+6QqrssXzrzaEZVQQ5Xevf73l941CjOZFfDaCw3x42ieLH4dw7PJrZfWP+xhRRXxfVzdIJ2QffZLYMiDSU5Fn+JigpI39FNfY+sI8ethnBhXBYxWOwS2N8xLkmNpebloqguBJliHneBwhrmWf+E1fxMS5zxLeVzTpkHGkOL8rew//CD9Ixb0xdJLrkmjoVcq7MdwUY6JljZvkbJ+Xbez478ga1hcnyJEEL62UAw8qbBmD6NkKcsvVC4us/TkS2ZAEc+r7i6YhjlhTYvpzHVUDqzzNGGMcBd5ph6222KGgakuy0xOV5BRpkFvM+U3wzT758QYlO01xQ/10gfEiuOQh0YgihYpA9hziVqTumNLuTAGZaGUrM0hx+LVkDSMiRNJsWC1Aqc5LcZR4QzxnDI5Di004DiQ5xLTq5EXWqAJt11Y/ci3GlQqmrdLfykIRFEWB0FlObRBJMAzVJ1uFwKc3QtzdLEYwLkCLekplsrJNJbk9jIqTjDytFsi6wdT9K9pHuKaIPwugJikpsrH57q98GeLGhYmLlJU2RHerMCjNc4pj6TW7qpu+YK7ErZo+yeHSi/oaeZP6wER3JnmT3K13orUyPzpjwwJke+ZIFfSqso22CUaR06lHP5T7ye4lszp8cpr7Uu26vpgghzVcZNoVrq/pRnJhhiu6v0QxwgkrpWdR7AEdzt/5zikq6Ol6j2pbk34ICwqyCEHSTClrYd2HhzrnK+OD3FrPyZVW8Q6bGrDrrwfEOLKe17fbsSqdzlyebojXxzPcCh9GqxrG2BnyZWL+iFBbtU9opepNfe2kxqI1ANJTns3dwUvaj2lYLUvW96ny3Atp+ZQW9lUfWwUqwk7neXO1UFIhk1nU8a7HkIFOTWoW1s3FrXjCkV9pJokN18XXfPa2oKQrqBq/to5IQ4zbPcTWs2FVk2qbsjPfk+Ia80nCYdOF104kg1jml86McHpRxRoLod0yUS5EoIiy6kQIaN4YJjvKv9pAYKcGtRudREw1Yq7+njLLdckh2PL4blt/Wam1P6nBt0KcuRjWujs5yALtau97W3sKLfuw6iiJ0KO9yFohAvo1yzkz7qhSxthTuHedCqjnIlLzqDJSnrhx1UeZJk368oQhxlqH8HgC60m4+7Sj/94hDH2aOPQtEyEKy3faWCnC63DtCLqAlmeLR/XEluqIyp5bFV/yDP/jXe0QlyWnHNKmMphfJSANUuRZZzbee+wweo5fDT7wxySMVV4w0rWCx0rX86ymkA5GkOyNsWZ59nBbn1Nph6CrzYq2rcMuwk9/fxJ49/AFlzFx4JIgMdAAAAAElFTkSuQmCC" id="imgcodigoqr" width="250" height="250" />
                    </td>
                    <td></td>
                </tr>
            </thead>
        </table>
        <hr>
        <table>
            <thead>
                <tr>
                    <td>Usuario</td>
                    <td>:</td>
                    <td id="NomUsuario" style="text-align:center;">admin</td>
                </tr>

            </thead>
        </table>
    </div>
 </div>
<script>
    ConsultaVoucherVenta(51);
    //
    function ConsultaVoucherVenta(CodVenta) {
        var Procedimiento = 'ProcVenta';
        var Parametros = CodVenta;
        var Indice = 17;
        var URL = URL_BASE +'Registros/procGeneral';
        var Data = {
            parametros: Parametros,
            indice: Indice,
            nombreProcedimiento: Procedimiento
        };
        $.post(URL, Data, function (Data) {
        var NomUsuario = '<?php echo $_SESSION['username'];?>';
        //
        $('#NomUsuario').text(NomUsuario);
        $('#NomEmpresa').text(Data[0].NomEmpresa);
        $('#RucEmpresa').text(Data[0].RucEmpresa);
        $('#DireccionEmpresa').text(Data[0].DireccionEmpresa);
        $('#NomDocumento').text(Data[0].NomDocumento);
        $('#Documento').text(Data[0].Documento);
        $('#FechaEmision').text(Data[0].FechaEmision);
        $('#HoraEmision').text(Data[0].HoraEmision);
        $('#NomCaja').text(Data[0].NomCaja);
        $('#TipoMoneda').text(Data[0].TipoMoneda);
        $('#Cliente').text(Data[0].Cliente);
        $('#SubTotal').text(Data[0].SubTotal);
        $('#IGV').text(Data[0].IGV);
        $('#Total').text(Data[0].Total);
        // Detalle
        var DetalleVenta = ConvertirAMatriz(Data[0].Detalle);
        var CantidadFilas = DetalleVenta.length, TablaHTML = '', SumaTotal = 0;
        //
        for (var i = 0; i < CantidadFilas; i++){
            N = DetalleVenta[i][0];
            Producto = DetalleVenta[i][1];
            Cantidad = DetalleVenta[i][2];
            Precio = DetalleVenta[i][3];
            Total = DetalleVenta[i][4];
            ImporteTotal = parseFloat(Total);
            //
            TablaHTML +=
            '<tr>' +
                '<td>' + N + '</td>' +
                '<td>' + Producto + '</td>' +
                '<td>' + Cantidad + '</td>' +
                '<td>' + Precio + '</td>' +
                '<td>' + Total + '</td>' +
            '</tr>';
            //
            SumaTotal += ImporteTotal;
        }
        $('#TbVentaDetalle tbody').append(TablaHTML);
        $('#impresionBoleto').printArea()
        },'JSON');
    }
    function ConvertirAMatriz(Datos, SeparadorColumna = '|', SeparadorFila = '~') {
        var Filas = String(Datos).split(SeparadorFila);
        var CantFilas = Filas.length - 1;
        var Matriz = new Array(CantFilas);
        for (j = 0; j <= CantFilas; j++) {
        Matriz[j] = String(Filas[j]).split(SeparadorColumna);
        }
        return Matriz;
    }
 </script>