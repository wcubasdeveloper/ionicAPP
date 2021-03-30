<div id="impresionBoleto" style="display:none">
<style>
    h1, h4, td, th {
        font-family: Arial, Helvetica, sans-serif;
        margin-top: 4px !important;
        margin-bottom: 2px !important;
    }
    .N {
        padding: 2px !important;
        width: 20px;
        float: left;
        text-align: center;
        font-family: Arial, Helvetica, sans-serif !important;
    }
    .Descripcion {
        padding: 2px !important;
        width: 272px;
        float: left;
        font-family: Arial, Helvetica, sans-serif !important;
        overflow:hidden;
        white-space:nowrap;
        /* text-overflow: ellipsis; */
    }
    .Sangria {
        padding: 2px !important;
        width: 84px;
        float: left;
    }
    .Cantidad {
        padding: 2px !important;
        width: 60px;
        float: left;
        text-align: center;
        font-family: Arial, Helvetica, sans-serif !important;
    }
    .PUnit {
        padding: 2px !important;
        width: 60px;
        float: left;
        text-align: right;
        font-family: Arial, Helvetica, sans-serif !important;
    }
    .Total {
        padding: 2px !important;
        width: 80px;
        float: left;
        text-align: right;
        font-family: Arial, Helvetica, sans-serif !important;
    }
    .Bold {
        font-weight: bold;
    }
    #DivVentaDetalle {
        font-family: Arial, Helvetica, sans-serif !important;
    }
    .Importe {
        text-align:right;
    }
</style>

<div style="width:300px" style="width:300px;display: none;font-size:17px !important;font-family: 'Arial Black', Gadget, sans-serif !important;">
    <h1 id="NomEmpresa" style="text-align:center;"></h1>
    <h4 id="RucEmpresa" style="text-align:center;" ></h4>
    <h4 id="DireccionEmpresa" style="text-align:center;"></h4>
    <h4 id="NomDocumento" style="text-align:center;"></h4>
    <h4 id="Documento" style="text-align:center;"></h4>
    <br>
    <table>
        <thead>
            <tr>
                <td style="width:120px;">Fecha Emisión</td>
                <td style="width:10px;">:</td>
                <td id="FechaEmision" style="width:120px;"></td>
            </tr>
            <tr>
                <td>Hora</td>
                <td>:</td>
                <td id="HoraEmision"></td>
            </tr>
            <tr>
                <td>Caja</td>
                <td>:</td>
                <td id="NomCaja"></td>
            </tr>
            <tr>
                <td>Tipo Moneda</td>
                <td>:</td>
                <td id="TipoMoneda"></td>
            </tr>
            <tr>
                <td>Cliente</td>
                <td>:</td>
                <td id="Cliente"></td>
            </tr>
        </thead>
    </table>
    <br>
    <!-- Cabecera -->
    <!-- <div class="N Bold" style="float:left;">N</div>
    <div class="Descripcion Bold">-----------------PRODUCTO----------------</div>
    <div class="Sangria Bold"></div>
    <div class="Cantidad Bold">CANT</div>
    <div class="PUnit Bold">P.UNIT</div>
    <div class="Total Bold">TOTAL</div> -->
    <!-- Detalle -->
    <!-- <div id="DivVentaDetalle">
    </div> -->
    <table id="DivVentaDetalle">
        <thead>
            <tr>
                <th>N</th>
                <th>PRODUCTO</th>
                <th>CANT</th>
                <th>P.UNIT</th>
                <th>TOTAL</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
    <br>
    <table style="width:300px;">
        <thead>
            <tr>
                <td style="width:220px; text-align:right;">Subtotal</td>
                <td style="width:10px;"></td>
                <td style="width:20px;">S/.</td>
                <td id="SubTotal" class="Importe"></td>
            </tr>
            <tr>
                <td style="width:220px; text-align:right;">IGV 18%</td>
                <td style="width:10px;"></td>
                <td>S/</td>
                <td id="IGV" style="text-align:right;"></td>
            </tr>
            <tr>
                <td style="width:220px; text-align:right;">Total</td>
                <td style="width:20px;"></td>
                <td>S/</td>
                <td id="Total" class="Importe"></td>
            </tr>
            <!-- <tr>
                <td></td>
                <td style="padding-top:20px;" id="sectionQr"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAATQAAAE0AQMAAACYT13cAAAABlBMVEX///8AAABVwtN+AAAElUlEQVRoge2aS5bjOAwEcQPc/5a4AYaITFXPbHrTi5xF+7nKshT2E0l8EqCr/j7+7LG7M7vvoLbnHc577Z6t94YTDwhy72/6Pftx2/eB4d1M9fvIACQ5nemufth7eX93/+9DbyRrIMv1nX3vuOrJZcrfHP8fuDr2PW7Jj3onzNSNKMudHUwf0bfovVB1p+5L/mMvAQ4/+t3j3/4W4Igx73kGencvq8CD7rg+JsWdgb65PTcqQtJ5/N38hSJ8yfMc43Dud+6QqrssXzrzaEZVQQ5Xevf73l941CjOZFfDaCw3x42ieLH4dw7PJrZfWP+xhRRXxfVzdIJ2QffZLYMiDSU5Fn+JigpI39FNfY+sI8ethnBhXBYxWOwS2N8xLkmNpebloqguBJliHneBwhrmWf+E1fxMS5zxLeVzTpkHGkOL8rew//CD9Ixb0xdJLrkmjoVcq7MdwUY6JljZvkbJ+Xbez478ga1hcnyJEEL62UAw8qbBmD6NkKcsvVC4us/TkS2ZAEc+r7i6YhjlhTYvpzHVUDqzzNGGMcBd5ph6222KGgakuy0xOV5BRpkFvM+U3wzT758QYlO01xQ/10gfEiuOQh0YgihYpA9hziVqTumNLuTAGZaGUrM0hx+LVkDSMiRNJsWC1Aqc5LcZR4QzxnDI5Di004DiQ5xLTq5EXWqAJt11Y/ci3GlQqmrdLfykIRFEWB0FlObRBJMAzVJ1uFwKc3QtzdLEYwLkCLekplsrJNJbk9jIqTjDytFsi6wdT9K9pHuKaIPwugJikpsrH57q98GeLGhYmLlJU2RHerMCjNc4pj6TW7qpu+YK7ErZo+yeHSi/oaeZP6wER3JnmT3K13orUyPzpjwwJke+ZIFfSqso22CUaR06lHP5T7ye4lszp8cpr7Uu26vpgghzVcZNoVrq/pRnJhhiu6v0QxwgkrpWdR7AEdzt/5zikq6Ol6j2pbk34ICwqyCEHSTClrYd2HhzrnK+OD3FrPyZVW8Q6bGrDrrwfEOLKe17fbsSqdzlyebojXxzPcCh9GqxrG2BnyZWL+iFBbtU9opepNfe2kxqI1ANJTns3dwUvaj2lYLUvW96ny3Atp+ZQW9lUfWwUqwk7neXO1UFIhk1nU8a7HkIFOTWoW1s3FrXjCkV9pJokN18XXfPa2oKQrqBq/to5IQ4zbPcTWs2FVk2qbsjPfk+Ia80nCYdOF104kg1jml86McHpRxRoLod0yUS5EoIiy6kQIaN4YJjvKv9pAYKcGtRudREw1Yq7+njLLdckh2PL4blt/Wam1P6nBt0KcuRjWujs5yALtau97W3sKLfuw6iiJ0KO9yFohAvo1yzkz7qhSxthTuHedCqjnIlLzqDJSnrhx1UeZJk368oQhxlqH8HgC60m4+7Sj/94hDH2aOPQtEyEKy3faWCnC63DtCLqAlmeLR/XEluqIyp5bFV/yDP/jXe0QlyWnHNKmMphfJSANUuRZZzbee+wweo5fDT7wxySMVV4w0rWCx0rX86ymkA5GkOyNsWZ59nBbn1Nph6CrzYq2rcMuwk9/fxJ49/AFlzFx4JIgMdAAAAAElFTkSuQmCC" id="imgcodigoqr" width="250" height="250" />
                </td>
                <td></td>
            </tr> -->
        </thead>
    </table>
    <br>
    <table  style="width:300px;">
        <thead>
            <tr>
                <td>Usuario</td>
                <td>:</td>
                <td id="NomUsuario">admin</td>
            </tr>
            <tr>
                <td>Vendedor</td>
                <td>:</td>
                <td id="NomVendedor"></td>
            </tr>
        </thead>
    </table>
</div>
</div>