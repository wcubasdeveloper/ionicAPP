<?php

$data = ['name' => 'generateToken','param' => ['user' => 'LATINOSAC', 'password' => '19032018@LATINO']];

$endPoint = 'http://api.tecnosolutions.com.pe/';

// Pasamos el arreglo data y el endpoint
$response = credenciales($data , $endPoint);

// Verificamos si el status es true
/*
if ($response['status'])
{
	$tipo = '01'; //Tipo de comprobante electrónico

	if ($tipo == '01' || $tipo == '03') {
		$invoice = getInvoice();
		$method = 'invoice';
	}
	if ($tipo == '07') {
		$invoice = getCreditNote();
		$method = 'creditnote';
	}
	if ($tipo == '08') {
		$invoice = getDebitNote();
		$method = 'debitnote';
	}
	if ($tipo == 'RA') {
		$invoice = getVoidedDocuments();
		$method = 'voideddocuments';
	}
	if ($tipo == 'RC') {
		$invoice = summarydocuments();
		$method = 'summarydocuments';
	}

	$ruc = $invoice['emisor']['documento']['numero'];
	$numero = $invoice['documento']['numero'];

	$nombreArchivo = $ruc.'-'.$tipo.'-'.$numero;

	$request = ['name' => $method, 'param' => $invoice];
	$request = json_encode($request);
	$token = $response['token'];
	$response = SendAPI($request, $token, $endPoint);

	if (isset($response['response']['status']))
	{
		if ($response['response']['status'] == 200)
		{
			$result = $response['response']['result'];

			writeFile($result, $nombreArchivo);
		}
	}
	echo "<pre>";
	print_r($response);
	echo "</pre>";
}
else{
	echo "<pre>";
	print_r($response);
	echo "</pre>";
	exit;
}
*/
// Nos autentificamos para generar un token de seguridad en realtime
function credenciales($request , $endPoint)
{
	$loginApi = json_encode($request);

	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $endPoint);
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_HTTPHEADER, ['content-type: application/json']);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $loginApi);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

	$result = curl_exec($curl);
	$error = curl_error($curl);

	if (curl_errno($curl))
	{
		echo "Curl Error: ".$error;
		exit;
	}

	$response = json_decode($result, true);
	curl_close($curl);

	if (isset($response['response']['result']['response']))
	{
		if ($response['response']['result']['response'])
		{
			return array('status' => true, 'token' => $response['response']['result']['token']);
		}

		return array('status' => false , 'message' => $response['response']['result']['message']);
	}

	return array('status' => false , 'message' => $response['error']['message']);
}

// Enviamos el comprobante electrónico, junto con el token  y el endpoint
function SendAPI($request, $token , $endPoint)
{
	$curl = curl_init();
	curl_setopt_array($curl,
		array(
			CURLOPT_URL => $endPoint,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => $request,
			CURLOPT_HTTPHEADER => array(
				"authorization: Bearer $token",
				"content-type: application/json"
			)
		)
	);

	$response = curl_exec($curl);
	/*echo "<pre>";
	print_r($response);
	echo "</pre>";
	exit;*/
	$error = curl_error($curl);

	if (curl_errno($curl))
	{
		echo "Curl Error: ".$error;
		exit;
	}

	$response = json_decode($response, true);

	curl_close($curl);

	return $response;
}

// Escribemos los archivos de la API
function writeFile($fileBase64 , $nombreArchivo)
{
	if (!empty($fileBase64['xml']))
	{
		$xmlZip = base64_decode($fileBase64['xml']);
		$archivo = fopen('data/'.$nombreArchivo.'.zip', "w+");
		fputs($archivo, $xmlZip);
		fclose($archivo);

		//Creamos un objeto de la clase ZipArchive()
		$enzipado = new ZipArchive();

		//Abrimos el archivo a descomprimir
		$enzipado->open('data/'.$nombreArchivo.'.zip');
		//Extraemos el contenido del archivo dentro de la carpeta especificada
		$extraido = $enzipado->extractTo("data/");
	}

	if (!empty($fileBase64['cdr']))
	{
		$cdrZip = base64_decode($fileBase64['cdr']);
		$archivo = fopen('data/R-'.$nombreArchivo.'.zip', "w+");
		fputs($archivo, $cdrZip);
		fclose($archivo);

		//Creamos un objeto de la clase ZipArchive()
		$enzipado = new ZipArchive();

		//Abrimos el archivo a descomprimir
		$enzipado->open('data/R-'.$nombreArchivo.'.zip');
		//Extraemos el contenido del archivo dentro de la carpeta especificada
		$extraido = $enzipado->extractTo("data/");
	}

	return true;
}

// Estructura para Boletas y Notas de Crédito
function getInvoice()
{
	$dataInvoince = array(
	    'documento' => array(
	        'numero'           => 'F001-00000001', //(FACTURA - F) (BOLETA - B)
	        'fecha_emision'    => '2018-03-19',
	        'tipo_factura'     => '01', // FACTURA 01 - BOLETA 03
	        'moneda'           => 'PEN',
	        'tipo_transaccion' => '01', //POR DEFECTO 01 - VENTA INTERNA
	    ),
	    'emisor'    => array(
	        'documento' => array('numero' => '20461499717', 'tipo' => '6'),//'10436146677'
	        'datos'     => array(
	            'razon_social'     => 'CORPORACION SUPER LATINO S.A.',
	            'nombre_comercial' => '',
	        ),
	        'ubicacion' => array(
				'ubigeo'       => '150135',
				'direccion'    => 'AV. CARLOS ALBERTO IZAGUIRRE MZA. A LOTE. 11',
				'departamento' => 'SAN MARTIN DE PORRES',
				'provincia'    => 'LIMA',
				'distrito'     => 'LIMA',
				'urbanizacion' => '',
				'pais'         => 'PE',
	        )
	    ),
	    'cliente'   => array(
	        'documento' => array('numero' => '20455108757', 'tipo' => '6'),
	        'datos'     => array(
	            'razon_social'     => 'FERNANDO CARMELO MAMANI BLAS',
	            'nombre_comercial' => '',
	        ),
	        'ubicacion' => array(
	            'ubigeo'       => '040101',
	            'direccion'    => 'Mercado 3 de Octubre Av-Brasil, B4, Comité 1 - JLB y Rivero',
	            'urbanizacion' => 'Urb. Santa Rosa - La Victoria',
	            'provincia'    => 'Chiclayo',
	            'departamento' => 'Lambayeque',
	            'distrito'     => 'José Leonardo Ortiz',
	            'pais'         => 'PE',
	        ),
	    ),
	    'montos'    => array(
	        array(
	            'id'    => '2005',
	            'valor' => array('pagable' => '0.00'),
	        ),
	        array(
	            'id'    => '1001',
	            'valor' => array('pagable' => '160.00'),
	        ),
	        array(
	            'id'    => '1002',
	            'valor' => array('pagable' => '0.00'),
	        ),
	        array(
	            'id'    => '1003',
	            'valor' => array('pagable' => '0.00'),
	        ),
	    ),
	    //Leyendas
	    'notas'     => array(
	        array('id' => '1000', 'valor' => 'CIEN SOLES Y 00/100'),
	    ),
	    'impuestos' => array(
	        array(
	            'id' => '1000',
	            'monto' => '24.40' ,
	            'nombre' => 'IGV',
	            'codigo' => 'VAT'
	        )
	    ),
	    'items'     => array(
	        array(
	            'id'              => '1',
	            'cantidad'        => '1.00',
	            'unidad'          => 'ZZ', //   NIU - UNIDADES / ZZ - SERVICIOS
	            'valor_venta'     => '50.85',
	            'precio_unitario' => array('facturado' => '60.00'),
	            'igv'             => array('monto' => '9.15', 'codigo' => '10'),
	            'datos'           => array('descripcion' => 'FORMATEO DE LAPTOP', 'codigo' => 'ALM'),
	            'valor_unitario'  => '50.85',
	            'descuento'       => '0.00',
	            'codigo'          => '10',
	        ),
	        array(
	            'id'              => '2',
	            'cantidad'        => '5.00',
	            'unidad'          => 'NIU', //   NIU - UNIDADES / ZZ - SERVICIOS
	            'valor_venta'     => '84.75',
	            'precio_unitario' => array('facturado' => '20.00'),
	            'igv'             => array('monto' => '15.25', 'codigo' => '10'),
	            'datos'           => array('descripcion' => 'TECLADO PARA LAPTOP', 'codigo' => 'TL012'),
	            'valor_unitario'  => '16.95',
	            'descuento'       => '0.00',
	            'codigo'          => '10',
	        ),
	    ),
	    'total'     => array(
	        'descuento' => '0.00',
	        'cargo'     => '0.00',
	        'pagable'   => '160.00',
	    ),
	);

	return $dataInvoince;
}

// Estructura para Notas de Crédito
function getCreditNote()
{
	$document = array(
	    'documento' => array(
	        'numero'        => 'B003-00000008',
	        'fecha_emision' => '2018-03-19',
	        'moneda'        => 'PEN',
	    ),
	    'emisor'    => array(
	        'documento' => array('numero' => '10436146677', 'tipo' => '6'),
	        'datos'     => array(
	            'razon_social'     => 'COMERCIAL JOHANA SA',
	            'nombre_comercial' => 'COMERCIAL JOHANA'),
	        'ubicacion' => array(
	            'ubigeo'       => '060101',
	            'direccion'    => 'LOS LAURES 476',
	            'urbanizacion' => 'Urb. Santa Rosa - La Victoria',
	            'provincia'    => 'Chiclayo',
	            'departamento' => 'Lambayeque',
	            'distrito'     => 'José Leonardo Ortiz',
	            'pais'         => 'PE'),
	    ),
	    'cliente'   => array(
	        'documento' => array('numero' => '10440716348', 'tipo' => '6'),
	        'datos'     => array(
	            'razon_social'     => 'COMERCIAL DE PRUEBA SAC',
	            'nombre_comercial' => 'COMERCIAL DE PRUEBA',
	        ),
	        'ubicacion' => array(
	            //'ubigeo'       => '040101',
	            'direccion'    => 'Mercado 3 de Octubre Av-Brasil, B4, Comité 1 - JLB y Rivero',
	            /*'urbanizacion' => 'Urb. Santa Rosa - La Victoria',
	            'provincia'    => 'Chiclayo',
	            'departamento' => 'Lambayeque',
	            'distrito'     => 'José Leonardo Ortiz',*/
	            'pais'         => 'PE'
	        ),
	    ),
	    'facturas'  => array(
	        array(
	            'tipo'         => '03', // 01 = FACTURA | 03 = BOLETA
	            'serie_numero' => 'B003-00000003',
	            'motivo'       => array(
	                'codigo'      => '01',
	                'descripcion' => 'CLIENTE NO ESTA SATISFECHO CON EL FUNCIONAMIENTO DE LA COCINA',
	            ),
	        ),
	    ),
	    'montos'    => array(
	        array(
	            'id'         => '2005',
	            'valor'      => array('pagable' => '25.00'),
	            'porcentaje' => '0.00',
	        ),
	        array(
	            'id'         => '1001',
	            'valor'      => array('pagable' => '21.19'),
	            'porcentaje' => '10',
	        ),
	    ),
	    'notas'     => array(
	        array('id' => '1000', 'nombre' => '', 'valor' => 'VEINTICINCO CON 00/100'),
	    ),
	    'impuestos' => array(array('monto' => '3.81' ,'id'=>'1000' , 'nombre' =>'IGV' , 'codigo'=>'VAT')),
	    'items'     => array(
	        array(
	            'id'              => '1',
	            'cantidad'        => '1',
	            'unidad'          => 'NIU',
	            'valor_venta'     => '4.24',
	            'precio_unitario' => array('facturado' => '5'),
	            'igv'             => array('monto' => '0.76', 'codigo' => '10'),
	            'datos'           => array('descripcion' => 'Avena 3 Ositos 1 Kg' , 'codigo' => 'GLG199'),
	            'valor_unitario'  => '4.24',
	            'codigo'          => 'GLG199'
	        ),
	        array(
	            'id'              => '2',
	            'cantidad'        => '2',
	            'unidad'          => 'NIU',
	            'valor_venta'     => '16.92',
	            'precio_unitario' => array('facturado' => '10'),
	            'igv'             => array('monto' => '3.05', 'codigo' => '10'),
	            'datos'           => array('descripcion' => 'Avena 3 Ositos 1 Kg' , 'codigo' => 'GLG199'),
	            'valor_unitario'  => '4.24',
	            'codigo'          => 'GLG199'
	        ),
	    ),
	    'total'     => array(
	        'descuento' => '0.00',
	        'cargo'     => '0.00',
	        'pagable'   => '8.47',
	    ),
	);

	return $document;
}

//Estructura para Notas de Débito
function getDebitNote()
{
	$document = array(
	    'documento' => array(
	        'numero'        => 'B003-00000006',
	        'fecha_emision' => '2018-03-19',
	        'moneda'        => 'PEN',
	    ),
	    'emisor'    => array(
	        'documento' => array('numero' => '10436146677', 'tipo' => '6'),
	        'datos'     => array(
	            'razon_social'     => 'DESARROLLO DE SISTEMAS INTEGRADOS DE GESTIÓN',
	            'nombre_comercial' => 'DESARROLLO DE SISTEMAS INTEGRADOS DE GESTIÓN'),
	        'ubicacion' => array(
	            'ubigeo'       => '040101',
	            'direccion'    => 'Mercado 3 de Octubre Av-Brasil, B4, Comité 1 - JLB y Rivero',
	            'urbanizacion' => 'Urb. Santa Rosa - La Victoria',
	            'provincia'    => 'Chiclayo',
	            'departamento' => 'Lambayeque',
	            'distrito'     => 'José Leonardo Ortiz',
	            'pais'         => 'PE'),
	    ),
	    'cliente'   => array(
	        'documento' => array('numero' => '20455108757', 'tipo' => '6'),
	        'datos'     => array(
	            'razon_social'     => 'FERNANDO CARMELO MAMANI BLAS',
	            'nombre_comercial' => 'DESARROLLO DE SISTEMAS INTEGRADOS DE GESTIÓN',
	        ),
	        'ubicacion' => array(
	            'ubigeo'       => '040101',
	            'direccion'    => 'Mercado 3 de Octubre Av-Brasil, B4, Comité 1 - JLB y Rivero',
	            'urbanizacion' => 'Urb. Santa Rosa - La Victoria',
	            'provincia'    => 'Chiclayo',
	            'departamento' => 'Lambayeque',
	            'distrito'     => 'José Leonardo Ortiz',
	            'pais'         => 'PE',
	        ),
	    ),
	    'facturas'  => array(
	        array(
	            'tipo'         => '03',
	            'serie_numero' => 'B003-00000002',
	            'motivo'       => array(
	                'codigo'      => '01',
	                'descripcion' => 'INTERESES POR MORA',
	            ),
	        ),
	    ),
	    'montos'    => array(
	        array(
	            'id'         => '1001',
	            'valor'      => array('pagable' => '100.00')
	        )
	    ),
	    'notas'     => array(
	        array('id' => '1000', 'nombre' => '', 'valor' => 'CIEN SOLES CON 00/100')
	    ),
	    'impuestos' => array(
	        array('monto' => '15.25' ,'id'=>'1000' , 'nombre' =>'IGV' , 'codigo'=>'VAT')
	    ),
	    'items'     => array(
	        array(
	            'id'              => '002',
	            'cantidad'        => '1',
	            'unidad'          => 'NIU',
	            'valor_venta'     => '84.75',
	            'precio_unitario' => array('facturado' => '100.00'),
	            'igv'             => array('monto' => '15.25', 'codigo' => '10'),
	            'datos'           => array('codigo' => 'P0SS14', 'descripcion' => 'INTERES POR MORA'),
	            'valor_unitario'  => '84.75'),
	    ),
	    'total' => array(
	        'descuento' => '0.00',
	        'cargo'     => '0.00',
	        'pagable'   => '100.00'
	    )
	);
	return $document;
}

// Estructura para comunicación de baja
function getVoidedDocuments()
{
	$document = array(
	    'emisor'    => array(
	        'documento' => array(
	            'numero' => '10436146677',
	            'tipo'   => '6'),
	        'datos' => array('razon_social' => 'DESARROLLO DE SISTEMAS INTEGRADOS DE GESTIÓN')
	    ),
	    'documento' => array(
	        'tipo'             => 'RA',
	        'numero'           => '20180319-1',
	        'fecha_referencia' => '2018-03-19',
	        'fecha_emision'    => '2018-03-19'
	    ),
	    'items'     => array(
	        array(
	            'id'        => '1',
	            'documento' => array(
	                'tipo'   => '01',
	                'serie'  => 'F001',
	                'numero' => '00000001',
	            ),
	            'motivo'    => 'ANULACION DE LA FACTURA 1 - ERROR DE DIGITACIÓN EN EL SISTEMA',
	        )
	    )
	);

	return $document;
}

// Estructura para resumenes diario
function summarydocuments()
{
	$document = array(
	    'emisor'    => array(
	        'documento' => array(
	            'numero' => '10436146677',
	            'tipo'   => '6'),
	        'datos'     => array(
	            'razon_social' => 'DESARROLLO DE SISTEMAS INTEGRADOS DE GESTIÓN')
	    ),
	    'documento' => array(
	        'tipo'             => 'RC',
	        'numero'           => '20180319-2',
	        'fecha_referencia' => '2018-03-17',
	        'fecha_emision'    => '2018-03-19',
	    ),
	    'items'     => array(
	        array(
	            'id'        => '1',
	            'rango'     => array(
	                'tipo'   => '03',
	                'serie'  => 'B003',
	                'numero' => '00000001',
	                'moneda' => 'PEN',
	            ),
	            'cliente' => array(
	            	'numero' => '12345678',
	            	'tipo'	 => '1'
	            ),
	            'estado' => array('codigo' => 1),
	            'total'     => array('venta' => '685.00'),
	            'montos'    => array(
	                array('valor' => '580.51', 'codigo' => '01'), // Catalogo N° 11
	                // array('valor' => '0.00', 'codigo' => '02'),
	                // array('valor' => '0.00', 'codigo' => '03'),
	            ),
	            'cargos'    => array(
	                // array('valor' => '0.00', 'indicador' => 'true'),
	            ),
	            'impuestos' => array( //Catalogo N° 05
	            	array('id' => '1000', 'monto' => '104.49', 'nombre' => 'IGV', 'codigo' => 'VAT'),
	                array('id' => '2000', 'monto' => '0.00', 'nombre' => 'ISC', 'codigo' => 'EXC'),
	                array('id' => '9999', 'monto' => '0.00', 'nombre' => 'OTROS', 'codigo' => 'OTH')
	            ),
	        ),
	        array(
	            'id'        => '2',
	            'rango'     => array(
	                'tipo'   => '03',
	                'serie'  => 'B003',
	                'numero' => '00000002',
	                'moneda' => 'PEN',
	            ),
	            'cliente' => array(
	            	'numero' => '87654321',
	            	'tipo'	 => '1'
	            ),
	            'estado' => array('codigo' => 1),
	            'total'     => array('venta' => '760.00'),
	            'montos'    => array(
	                array('valor' => '644.07', 'codigo' => '01'),
	                // array('valor' => '0.00', 'codigo' => '02'),
	                // array('valor' => '0.00', 'codigo' => '03'),
	            ),
	            'cargos'    => array(
	                // array('valor' => '0.00', 'indicador' => 'true'),
	            ),
	            'impuestos' => array(
	            	array('id' => '1000', 'monto' => '115.93', 'nombre' => 'IGV', 'codigo' => 'VAT'),
	                array('id' => '2000', 'monto' => '0.00', 'nombre' => 'ISC', 'codigo' => 'EXC'),
	                array('id' => '9999', 'monto' => '0.00', 'nombre' => 'OTROS', 'codigo' => 'OTH')
	            ),
	        ),
	        array(
	            'id'        => '3',
	            'rango'     => array(
	                'tipo'   => '07',
	                'serie'  => 'B003',
	                'numero' => '00000005',
	                'moneda' => 'PEN',
	            ),
	            'cliente' => array(
	            	'numero' => '23456789',
	            	'tipo'	 => '1'
	            ),
	            'boletas' => array( //Boletas afectadas
	            	'tipo'   => '03',
	                'serie'  => 'B003',
	                'numero' => '00000001'
	            ),
	            'estado' => array('codigo' => 2),
	            'total'     => array('venta' => '430'),
	            'montos'    => array(
	                // array('valor' => '0.00', 'codigo' => '01'),
	                array('valor' => '430.00', 'codigo' => '02'),
	                // array('valor' => '0.00', 'codigo' => '03'),
	            ),
	            'cargos'    => array(
	                // array('valor' => '0.00', 'indicador' => 'true'),
	            ),
	            'impuestos' => array(
	            	array('id' => '1000', 'monto' => '0.00', 'nombre' => 'IGV', 'codigo' => 'VAT'),
	                array('id' => '2000', 'monto' => '0.00', 'nombre' => 'ISC', 'codigo' => 'EXC'),
	                array('id' => '9999', 'monto' => '0.00', 'nombre' => 'OTROS', 'codigo' => 'OTH')
	            ),
	        ),
	        array(
	            'id'        => '4',
	            'rango'     => array(
	                'tipo'   => '03',
	                'serie'  => 'B003',
	                'numero' => '00000004',
	                'moneda' => 'PEN',
	            ),
	            'cliente' => array(
	            	'numero' => '34567890',
	            	'tipo'	 => '1'
	            ),
	            'estado' => array('codigo' => 1),
	            'total'     => array('venta' => '0.00'),
	            'montos'    => array(
	                // array('valor' => '0.00', 'codigo' => '01'),
	                // array('valor' => '0.00', 'codigo' => '02'),
	                // array('valor' => '0.00', 'codigo' => '03'),
	                array('valor' => '2440.00', 'codigo' => '05')
	            ),
	            'cargos'    => array(
	                // array('valor' => '0.00', 'indicador' => 'true'),
	            ),
	            'impuestos' => array(
	            	array('id' => '1000', 'monto' => '0.00', 'nombre' => 'IGV', 'codigo' => 'VAT'),
	                array('id' => '2000', 'monto' => '0.00', 'nombre' => 'ISC', 'codigo' => 'EXC'),
	                array('id' => '9999', 'monto' => '0.00', 'nombre' => 'OTROS', 'codigo' => 'OTH')
	            ),
	        ),
	        array(
	            'id'        => '5',
	            'rango'     => array(
	                'tipo'   => '08',
	                'serie'  => 'B003',
	                'numero' => '00000006',
	                'moneda' => 'PEN',
	            ),
	            'cliente' => array(
	            	'numero' => '45678901',
	            	'tipo'	 => '01'
	            ),
	            'boletas' => array(// Documentos Afectados
	            	'tipo'   => '03',
	                'serie'  => 'B003',
	                'numero' => '00000002'
	            ),
	            'estado' => array('codigo' => 2),
	            'total'     => array('venta' => '7.00'),
	            'montos'    => array(
	                array('valor' => '5.93', 'codigo' => '01'),
	                // array('valor' => '0.00', 'codigo' => '02'),
	                // array('valor' => '0.00', 'codigo' => '03'),
	            ),
	            'cargos'    => array(
	                // array('valor' => '0.00', 'indicador' => 'true'),
	            ),
	            'impuestos' => array(
	            	array('id' => '1000', 'monto' => '1.07', 'nombre' => 'IGV', 'codigo' => 'VAT'),
	                array('id' => '2000', 'monto' => '0.00', 'nombre' => 'ISC', 'codigo' => 'EXC'),
	                array('id' => '9999', 'monto' => '0.00', 'nombre' => 'OTROS', 'codigo' => 'OTH')
	            )
	        )
	    )
	);

	return $document;
}
// echo "<pre>";
// echo $data = json_encode($request , JSON_PRETTY_PRINT);
// echo "</pre>";
?>
