<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User_model class.
 *
 * @extends CI_Model
 */
class General_model extends CI_Model {

	/**
	 * __construct function.
	 *
	 * @access public
	 * @return void
	 */
	public function __construct() {

		parent::__construct();
		$this->load->database();

	}

	public function guardarDetalleMovimientoTran($Procedimiento, $parametrosDetalle, $indice){
		$ServidorBD = $this->db->hostname;
		$UsuarioBD = $this->db->username;
		$ClaveBD = $this->db->password;
		$BaseDatos = $this->db->database;
		$Fila = '';

		$link = mysqli_connect($ServidorBD, $UsuarioBD, $ClaveBD, $BaseDatos);
		mysqli_autocommit($link, FALSE);
		$tildes = $link->query("SET NAMES 'utf8'"); //Para que se muestren las tildes correctamente
		//
		$arrDataEnviada =  explode("~",$parametrosDetalle);
	
		foreach ($arrDataEnviada as &$Fila) {
		  $FilaArray = explode('|', $Fila);
		  $coddetalle = $FilaArray[0];
		  $cantidad = $FilaArray[1];
		  //
	
		  $ParamDetalle = $coddetalle . '|' . $cantidad;
		  $Query = 'CALL ' . $Procedimiento . ' ("' . $ParamDetalle . '", ' . $indice . ')';

	
		  $InsertarMovimientoDetalle = mysqli_query($link, $Query);
			
		  if (!$InsertarMovimientoDetalle) {
				mysqli_rollback($link);
				$Query = "SELECT 0 AS CodResultado, 'Ocurrió un error detalle'  AS DesResultado;";
				$Respuesta = mysqli_query($link, $Query);
				$Resultado = mysqli_fetch_assoc($Respuesta);
				//
				return $Resultado;
			}
		}
		//
		$Query = 'SELECT 1 AS CodResultado, "Actualizó con exito!" AS DesResultado;';
		$Respuesta = mysqli_query($link, $Query);
		$Resultado = mysqli_fetch_assoc($Respuesta);
		//
		mysqli_commit($link);
		mysqli_close($link);
		//
		return $Resultado;
	}

	public function ProcGuardaExcelTran($Procedimiento, $Parametros, $parametrosDetalle, $fechaRegistro, $codUsuario, $indice){
		$ServidorBD = $this->db->hostname;
		$UsuarioBD = $this->db->username;
		$ClaveBD = $this->db->password;
		$BaseDatos = $this->db->database;
		$Fila = '';

		$link = mysqli_connect($ServidorBD, $UsuarioBD, $ClaveBD, $BaseDatos);
		mysqli_autocommit($link, FALSE);
		$tildes = $link->query("SET NAMES 'utf8'"); //Para que se muestren las tildes correctamente
		//
		$Query = "CALL " . $Procedimiento . " ('" . $Parametros . "', " . $indice . ");";
		$InsertarCabeceraExcel = mysqli_query($link, $Query);
		//
		if (!$InsertarCabeceraExcel) {
			mysqli_rollback($link);
			$Query = "SELECT 0 AS CodResultado, 'Ocurrió un error al registrar " . $Query . "'  AS DesResultado;";
			$Respuesta = mysqli_query($link, $Query);
			// var_dump("result");
			// var_dump($Respuesta);

			$Resultado = mysqli_fetch_assoc($Respuesta);
			//
			return $Resultado;
		}

		$Query = 'SELECT	LAST_INSERT_ID();';
		$InsertarCabeceraExcel = mysqli_query($link, $Query);
		$Resultado = mysqli_fetch_row($InsertarCabeceraExcel);
		// Obtiene maestro correlativo
		$CodCabecera = $Resultado[0];
		//
		$Fila;
		$Columna;
		$FilaArray;

		if (!$parametrosDetalle == '') {
			$ParametrosDetalleArray = explode('~', $parametrosDetalle);
			foreach ($ParametrosDetalleArray as &$Fila) {
			
				if(strlen($Fila) > 0){
					$FilaArray = explode('|', $Fila);
					//
					$posicion = $FilaArray[0];
					
					$fecha = $FilaArray[1];
					$padron = $FilaArray[2];
					$conductor = $FilaArray[3];
					$produc = $FilaArray[4];
					$vta = $FilaArray[5];
					$prorra = $FilaArray[6];
					$h_cond = $FilaArray[7];
					$cama_ant = $FilaArray[8];
					$cama_hoy = $FilaArray[9];
					$combus = $FilaArray[10];
					$cotizacion = $FilaArray[11];
					$duenio = $FilaArray[12];
					$fr_ant = $FilaArray[13];
					$fr_hoy = $FilaArray[14];
					$GNV = $FilaArray[15];
					$limpie = $FilaArray[16];
					$man = $FilaArray[17];
					$otros = $FilaArray[18];
					$policia = $FilaArray[19];
	
					$peaje = $FilaArray[20];
					$taller = $FilaArray[21];
					$repues = $FilaArray[22];
					$tranbor = $FilaArray[23];
					$ure = $FilaArray[24];
					$v_cond = $FilaArray[25];
					$apt_plana = $FilaArray[26];
					$contometro = $FilaArray[27];
					$g_oper = $FilaArray[28];
					$n_op = $FilaArray[29];
	
					$admin = $FilaArray[30];
					$aportpapel = $FilaArray[31];
					$apoyo = $FilaArray[32];
					$aznar = $FilaArray[33];
					$caja = $FilaArray[34];
					$capital = $FilaArray[35];
					$apte_admn = $FilaArray[36];
					$cg = $FilaArray[37];
					$cupo = $FilaArray[38];
					$deficit = $FilaArray[39];
	
					$fnavi = $FilaArray[40];
					$gps = $FilaArray[41];
					$letra = $FilaArray[42];
					$lla = $FilaArray[43];
					$mltriesfo = $FilaArray[44];
					$mot = $FilaArray[45];
					$pa = $FilaArray[46];
					$petroleo = $FilaArray[47];
					$psj_urbano = $FilaArray[48];
					$rc = $FilaArray[49];
	
					$sg = $FilaArray[50];
					$soat = $FilaArray[51];
					$aurea_adm = $FilaArray[52];
					$laborales = $FilaArray[53];
					$b_cond = $FilaArray[54];
					$ap_t_pland = $FilaArray[55];
					$ap_terr = $FilaArray[56];
					$g_admin = $FilaArray[57];
					$n_admin = $FilaArray[58];
					$tot_gasto = $FilaArray[59];
					$nero = $FilaArray[60];
					
	
	
					//
				
					$ParametroDetalle = $CodCabecera . '|' .  $posicion . '|' . $fecha . '|' . $padron . '|' . $conductor . '|' . $produc . '|' . $vta . '|' . $prorra . '|' . $h_cond . '|' . $cama_ant . '|' . $cama_hoy . '|'. 
														$combus . '|' . $cotizacion . '|' . $duenio . '|' . $fr_ant . '|' . $fr_hoy . '|' . $GNV . '|' . $limpie . '|' . $man . '|' . $otros . '|' . $policia . '|' . 
														$peaje . '|' . $taller . '|' . $repues . '|' . $tranbor . '|' . $ure . '|' . $v_cond . '|' . $apt_plana . '|' . $contometro . '|' . $g_oper . '|' . $n_op . '|' . 
														$admin . '|' . $aportpapel . '|' . $apoyo . '|' . $aznar . '|' . $caja . '|' . $capital . '|' . $apte_admn . '|' . $cg . '|' . $cupo . '|' . $deficit . '|' . 
														$fnavi . '|' . $gps . '|' . $letra . '|' . $lla . '|' . $mltriesfo . '|' . $mot . '|' . $pa . '|' . $petroleo . '|' . $psj_urbano . '|' . $rc . '|' . 
														$sg . '|' . $soat . '|' . $aurea_adm . '|' . $laborales . '|' . $b_cond . '|' . $ap_t_pland . '|' . $ap_terr . '|' . $g_admin . '|' . $n_admin . '|' . $tot_gasto . '|' . $nero;
														
					$IndiceDetalle = 21;
					$Query = 'CALL ' . $Procedimiento . ' ("' . $ParametroDetalle . '", ' . $IndiceDetalle . ')';

					$InsertarExcelDetalle = mysqli_query($link, $Query);
					//
					$CodExcelDetalle = 0;
					//var_dump("InsertarExcelDetalle");
					//var_dump($InsertarExcelDetalle);
					//
					if (!$InsertarExcelDetalle) {
						mysqli_rollback($link);
						$Query = "SELECT 0 AS CodResultado, 'Ocurrió un error detalle " . $CodVenta . "' AS DesResultado;";
						$Respuesta = mysqli_query($link, $Query);
						$Resultado = mysqli_fetch_assoc($Respuesta);
						//
						return $Resultado;
					}
	
					$Query = 'SELECT	LAST_INSERT_ID();';
					$InsertarExcelDetalle = mysqli_query($link, $Query);
					$Resultado = mysqli_fetch_row($InsertarExcelDetalle);
					// Obtiene maestro correlativo
					$CodExcelDetalle = $Resultado[0];
	
					if ($CodExcelDetalle == 0) {
						mysqli_rollback($link);
						$Query = "SELECT 0 AS CodResultado, 'Ocurrió un error detalle 2' AS DesResultado;";
						$Respuesta = mysqli_query($link, $Query);
						$Resultado = mysqli_fetch_assoc($Respuesta);
						//
						return $Resultado;
					}
				}
			}
			//
			$Procedimiento = 'ProcLiquidacion';
			$Parametros =  $fechaRegistro . '|' . $codUsuario . '|0';
			$indice = 20;
			$Query = "CALL " . $Procedimiento . " ('" . $Parametros . "', " . $indice . ");";
		
			$actualizaData = mysqli_query($link, $Query);

			//
			if ($actualizaData == 0) {
				mysqli_rollback($link);
				$Query = "SELECT 0 AS CodResultado, 'Ocurrió un error detalle 2' AS DesResultado;";
				$Respuesta = mysqli_query($link, $Query);
				$Resultado = mysqli_fetch_assoc($Respuesta);
				//
				return $Resultado;
			}
			//
			$Query = 'SELECT 1 AS CodResultado, "Registró con exito! ' . $CodCabecera . '" AS DesResultado, ' . $CodCabecera . ' AS CodAuxiliar;';
			$Respuesta = mysqli_query($link, $Query);
			$Resultado = mysqli_fetch_assoc($Respuesta);

			mysqli_commit($link);
			mysqli_close($link);
			return $Resultado;
		}
	}

	public function ProcVentaTran($Procedimiento, $Parametros, $ParametrosDetalle, $Indice) {
		$ServidorBD = $this->db->hostname;
		$UsuarioBD = $this->db->username;
		$ClaveBD = $this->db->password;
		$BaseDatos = $this->db->database;
		$Fila = '';
		//
		$link = mysqli_connect($ServidorBD, $UsuarioBD, $ClaveBD, $BaseDatos);
		//
		mysqli_autocommit($link, FALSE);
		$tildes = $link->query("SET NAMES 'utf8'"); //Para que se muestren las tildes correctamente
		//
		$CodUsuario = explode('|', $Parametros)[8];
		$Query = '
		SELECT	CodCajaGestionActual
		FROM	TbUsuario
		WHERE	CodUsuario = ' . $CodUsuario . ';';
		// // $Respuesta = mysqli_query($link, $Query);
		// // $Resultado = mysqli_fetch_row($Respuesta);
		$CodCajaGestionActual = 0;//$Resultado[0];

		// 
		// if ($CodCajaGestionActual == '' || $CodCajaGestionActual == 0) {
		// 	mysqli_rollback($link);
		// 	$Query = "SELECT 0 AS CodResultado, 'No tiene caja abierta. Abra su caja!' AS DesResultado;";
		// 	$Respuesta = mysqli_query($link, $Query);
		// 	$Resultado = mysqli_fetch_assoc($Respuesta);
		// 	return $Resultado;
		// }
		
		// Obtiene CodTienda
		// // $Query = '
		// // SELECT	CodTienda
		// // FROM		TbCajaGestion
		// // WHERE		CodCajaGestion = ' . $CodCajaGestionActual . ';';
		// // $Respuesta = mysqli_query($link, $Query);
		// // $Resultado = mysqli_fetch_row($Respuesta);
		$CodTienda = 0;//$Resultado[0];
		// Obtiene CodAlmacen
		// // $Query = '
		// // SELECT	CodAlmacen
		// // FROM		TbTienda
		// // WHERE		CodTienda = ' . $CodTienda . ';';
		// // $Respuesta = mysqli_query($link, $Query);
		// // $Resultado = mysqli_fetch_row($Respuesta);
		$CodAlmacen = 1;//$Resultado[0];  // DURITO, VALIDAR LUEGO 
		//
		$Query = "CALL " . $Procedimiento . " ('" . $Parametros . "', " . $Indice . ");";
	
		$InsertarVenta = mysqli_query($link, $Query);
		//
		
		//
		if (!$InsertarVenta) {
			mysqli_rollback($link);
			$Query = "SELECT 0 AS CodResultado, 'Ocurrió un error al registrar " . $Query . "'  AS DesResultado;";
			$Respuesta = mysqli_query($link, $Query);
			// var_dump("result");
			// var_dump($Respuesta);

			$Resultado = mysqli_fetch_assoc($Respuesta);
			//
			return $Resultado;
		}
		//
		$Query = 'SELECT	LAST_INSERT_ID();';
		$InsertarVenta = mysqli_query($link, $Query);
		$Resultado = mysqli_fetch_row($InsertarVenta);
		// Obtiene maestro correlativo
		$CodVenta = $Resultado[0];
		// Registra detalle
		$Fila;
		$Columna;
		$FilaArray;
		// Deserializa Detalle
		if (!$ParametrosDetalle == '') {
			$ParametrosDetalleArray = explode('~', $ParametrosDetalle);
			foreach ($ParametrosDetalleArray as &$Fila) {
				//
				$FilaArray = explode('|', $Fila);
				$CodProducto = $FilaArray[0];
				$Cantidad = $FilaArray[1];
				$SubTotal = $FilaArray[2];
				$TieneCalculo = $FilaArray[3];
				$CalculoProducto = $FilaArray[4];
				// Valida Stock
				$Stock = 0;
				//
				$Query = '
				SELECT	CodProductoExistencia
				FROM		TbProducto
				WHERE		CodProducto = ' . $CodProducto . ';';
				$ConsultaProducto = mysqli_query($link, $Query);
				$Resultado = mysqli_fetch_row($ConsultaProducto);
				$CodProductoExistencia = $Resultado[0];
				//
				if ($CodProductoExistencia == 1) { // Stockiable
					$Query = '
					SELECT	IFNULL(TPS.Stock, 0), TP.NomProducto
					FROM		TbProductoStock TPS INNER JOIN TbProducto TP
					ON			TPS.CodProducto = TP.CodProducto
					WHERE		TPS.CodAlmacen = ' . $CodAlmacen . '
					AND			TPS.CodProducto = ' . $CodProducto . ';';
					$ConsultaStock = mysqli_query($link, $Query);
					$Resultado = mysqli_fetch_row($ConsultaStock);
					$Stock = $Resultado[0];
					$NomProducto = $Resultado[1];
					//
					if ($Cantidad > $Stock) {
						mysqli_rollback($link);
						$Query = "SELECT 0 AS CodResultado, 'Stock insuficiente del producto: " . $NomProducto . ". Stock actual: " . $Stock . "' AS DesResultado;";
						$Respuesta = mysqli_query($link, $Query);
						$Resultado = mysqli_fetch_assoc($Respuesta);
						//
						return $Resultado;
					}
				}
				//
				$Procedimiento = 'ProcVentaDetalle';
				$Parametros = $CodVenta . '|' . $CodProducto . '|' . $Cantidad . '|' . $SubTotal . '|' . $TieneCalculo . '|' . $CalculoProducto;
				$Indice = 20;
				$Query = 'CALL ' . $Procedimiento . ' ("' . $Parametros . '", ' . $Indice . ')';
				$InsertarVentaDetalle = mysqli_query($link, $Query);
				//
				$CodVentaDetalle = 0;
				//
				if (!$InsertarVentaDetalle) {
					mysqli_rollback($link);
					$Query = "SELECT 0 AS CodResultado, 'Ocurrió un error detalle " . $CodVenta . "' AS DesResultado;";
					$Respuesta = mysqli_query($link, $Query);
					$Resultado = mysqli_fetch_assoc($Respuesta);
					//
					return $Resultado;
				}
				$Query = 'SELECT	LAST_INSERT_ID();';
				$InsertarVentaDetalle = mysqli_query($link, $Query);
				$Resultado = mysqli_fetch_row($InsertarVentaDetalle);
				// Obtiene maestro correlativo
				$CodVentaDetalle = $Resultado[0];
				//
				if ($CodVentaDetalle == 0) {
					mysqli_rollback($link);
					$Query = "SELECT 0 AS CodResultado, 'Ocurrió un error detalle 2' AS DesResultado;";
					$Respuesta = mysqli_query($link, $Query);
					$Resultado = mysqli_fetch_assoc($Respuesta);
					//
					return $Resultado;
				}
			}
		}
		// Actualiza montos en cabecera
		$Procedimiento = 'ProcVenta';
		$Parametros = $CodVenta;
		$Indice = 30;
		$Query = "CALL " . $Procedimiento . " ('" . $Parametros . "', " . $Indice . ");";
		$ActualizarMonto = mysqli_query($link, $Query);
		//
		$Query = 'SELECT 1 AS CodResultado, "Registró con exito! ' . $CodVenta . '" AS DesResultado, ' . $CodVenta . ' AS CodAuxiliar;';
		$Respuesta = mysqli_query($link, $Query);
		$Resultado = mysqli_fetch_assoc($Respuesta);
		//
		mysqli_commit($link);
		mysqli_close($link);
		return $Resultado;
	}

	public function ProcGuardarDetallePedidoTran($Procedimiento, $Parametros, $Indice) {
		$ServidorBD = $this->db->hostname;
		$UsuarioBD = $this->db->username;
		$ClaveBD = $this->db->password;
		$BaseDatos = $this->db->database;
		$Fila = '';
		//
		$link = mysqli_connect($ServidorBD, $UsuarioBD, $ClaveBD, $BaseDatos);
		//
		mysqli_autocommit($link, FALSE);
		$tildes = $link->query("SET NAMES 'utf8'"); //Para que se muestren las tildes correctamente
		// Verifica si el mótivo es Ingreso por Inventario
		$CodPedido = explode('|', $Parametros)[0];
	
		//
		$Query = "CALL " . $Procedimiento . " ('" . $Parametros . "', " . $Indice . ");";
		$Respuesta = mysqli_query($link, $Query);
		
		//
		if ($CodEstado == 3) {
			mysqli_rollback($link);
			$Query = "SELECT 0 AS CodResultado, 'Ya está anulado' AS DesResultado;";
			$Respuesta = mysqli_query($link, $Query);
			$Resultado = mysqli_fetch_assoc($Respuesta);
			//
			return $Resultado;
		}
		//
		$Query = "CALL " . $Procedimiento . " ('" . $Parametros . "', " . $Indice . ");";
		$AnularVenta = mysqli_query($link, $Query);
		//
		if (!$AnularVenta) {
			mysqli_rollback($link);
			$Query = "SELECT 0 AS CodResultado, 'No se pudo anular la venta' AS DesResultado;";
			$Respuesta = mysqli_query($link, $Query);
			$Resultado = mysqli_fetch_assoc($Respuesta);
			//
			return $Resultado;
		}
		// Obtiene Movimiento de almacén relacionado a la Venta
		$Query = '
		SELECT	CodAlmacenMovimiento
		FROM		TbAlmacenMovimiento
		WHERE		CodVenta = ' . $CodVenta;
		//
		$Respuesta = mysqli_query($link, $Query);
		$Resultado = mysqli_fetch_row($Respuesta);
		$CodAlmacenMovimiento = $Resultado[0];
		//
		$Procedimiento = 'ProcAlmacenMovimiento';
		$Parametros = $CodAlmacenMovimiento . '|' . $CodUsuarioAccion . '|' . $MotivoAnulacion;
		$Indice = 30;
		$Query = "CALL " . $Procedimiento . " ('" . $Parametros . "', " . $Indice . ");";
		$AnularAlmacenMovimiento = mysqli_query($link, $Query);
		//
		if (!$AnularAlmacenMovimiento) {
			mysqli_rollback($link);
			$Query = "SELECT 0 AS CodResultado, 'No se pudo Anular el Movimiento Almacen' AS DesResultado;";
			$Respuesta = mysqli_query($link, $Query);
			$Resultado = mysqli_fetch_assoc($Respuesta);
			//
			return $Resultado;
		}
		//
		$Query = 'SELECT 1 AS CodResultado, "Anuló con exito!" AS DesResultado;';
		$Respuesta = mysqli_query($link, $Query);
		$Resultado = mysqli_fetch_assoc($Respuesta);
		//
		mysqli_commit($link);
		mysqli_close($link);
		return $Resultado;
	}

	public function ProcVentaAnularTran($Procedimiento, $Parametros, $Indice) {
		$ServidorBD = $this->db->hostname;
		$UsuarioBD = $this->db->username;
		$ClaveBD = $this->db->password;
		$BaseDatos = $this->db->database;
		$Fila = '';
		//
		$link = mysqli_connect($ServidorBD, $UsuarioBD, $ClaveBD, $BaseDatos);
		//
		mysqli_autocommit($link, FALSE);
		$tildes = $link->query("SET NAMES 'utf8'"); //Para que se muestren las tildes correctamente
		// Verifica si el mótivo es Ingreso por Inventario
		$CodVenta = explode('|', $Parametros)[0];
		$CodUsuarioAccion = explode('|', $Parametros)[1];
		$MotivoAnulacion = explode('|', $Parametros)[2];
		//
		$Query = '
		SELECT	CodEstado
		FROM		TbVenta
		WHERE		CodVenta = ' . $CodVenta;
		//
		$Respuesta = mysqli_query($link, $Query);
		$Resultado = mysqli_fetch_row($Respuesta);
		$CodEstado = $Resultado[0];
		//
		if ($CodEstado == 3) {
			mysqli_rollback($link);
			$Query = "SELECT 0 AS CodResultado, 'Ya está anulado' AS DesResultado;";
			$Respuesta = mysqli_query($link, $Query);
			$Resultado = mysqli_fetch_assoc($Respuesta);
			//
			return $Resultado;
		}
		//
		$Query = "CALL " . $Procedimiento . " ('" . $Parametros . "', " . $Indice . ");";
		$AnularVenta = mysqli_query($link, $Query);
		//
		if (!$AnularVenta) {
			mysqli_rollback($link);
			$Query = "SELECT 0 AS CodResultado, 'No se pudo anular la venta' AS DesResultado;";
			$Respuesta = mysqli_query($link, $Query);
			$Resultado = mysqli_fetch_assoc($Respuesta);
			//
			return $Resultado;
		}
		// Obtiene Movimiento de almacén relacionado a la Venta
		$Query = '
		SELECT	CodAlmacenMovimiento
		FROM		TbAlmacenMovimiento
		WHERE		CodVenta = ' . $CodVenta;
		//
		$Respuesta = mysqli_query($link, $Query);
		$Resultado = mysqli_fetch_row($Respuesta);
		$CodAlmacenMovimiento = $Resultado[0];
		//
		$Procedimiento = 'ProcAlmacenMovimiento';
		$Parametros = $CodAlmacenMovimiento . '|' . $CodUsuarioAccion . '|' . $MotivoAnulacion;
		$Indice = 30;
		$Query = "CALL " . $Procedimiento . " ('" . $Parametros . "', " . $Indice . ");";
		$AnularAlmacenMovimiento = mysqli_query($link, $Query);
		//
		if (!$AnularAlmacenMovimiento) {
			mysqli_rollback($link);
			$Query = "SELECT 0 AS CodResultado, 'No se pudo Anular el Movimiento Almacen' AS DesResultado;";
			$Respuesta = mysqli_query($link, $Query);
			$Resultado = mysqli_fetch_assoc($Respuesta);
			//
			return $Resultado;
		}
		//
		$Query = 'SELECT 1 AS CodResultado, "Anuló con exito!" AS DesResultado;';
		$Respuesta = mysqli_query($link, $Query);
		$Resultado = mysqli_fetch_assoc($Respuesta);
		//
		mysqli_commit($link);
		mysqli_close($link);
		return $Resultado;
	}

	public function ProcGeneral($nombreProcedimiento, $parametros, $indice){

				$rpta = "";
		try {
				$query = $this->db->query("call ".$nombreProcedimiento." ('".$parametros."',".$indice.")");
				//$query = $this->db->query("call ProcUsuario ('rolando|123|12',11)");
				//return $query;
				$row = $query->result_array();
				$rpta = $row;
		} catch (Exception $e) {
				$rpta = $e->getMessage();
		}

		return $rpta;
	}
	public function ProcGeneral2($Procedimiento, $Parametros, $Indice) {
				$rpta = "";
		try {
				$query = $this->db->query("CALL " . $Procedimiento . "('" . $Parametros . "', " . $Indice . ")");
				$row = $query->result_array();
				$rpta = $row;
		} catch (Exception $e) {
				$rpta = $e->getMessage();
		}
		//
		return $rpta;
	}
	public function ProcAlmacenMovimientoTran($Procedimiento, $Parametros, $ParametrosDetalle, $Indice) {
		$ServidorBD = $this->db->hostname;
		$UsuarioBD = $this->db->username;
		$ClaveBD = $this->db->password;
		$BaseDatos = $this->db->database;
		$Fila = '';
		//
		$link = mysqli_connect($ServidorBD, $UsuarioBD, $ClaveBD, $BaseDatos);
		//
		mysqli_autocommit($link, FALSE);
		$tildes = $link->query("SET NAMES 'utf8'"); //Para que se muestren las tildes correctamente
		//
		$Query = "CALL " . $Procedimiento . " ('" . $Parametros . "', " . $Indice . ");"; 
		$InsertarAlmacenMovimiento = mysqli_query($link, $Query);
		//
		if (!$InsertarAlmacenMovimiento) {
			mysqli_rollback($link);
			$Query = "SELECT 0 AS CodResultado, 'Ocurrió un error 2.' AS DesResultado;";
			$Respuesta = mysqli_query($link, $Query);
			$Resultado = mysqli_fetch_assoc($Respuesta);
			//
			return $Resultado;
		}
		//
		$Query = 'SELECT	LAST_INSERT_ID();'; 
		$InsertarAlmacenMovimiento = mysqli_query($link, $Query);
		$Resultado = mysqli_fetch_row($InsertarAlmacenMovimiento);
		// Obtiene maestro correlativo
		$CodAlmacenMovimiento = $Resultado[0];
		// Registra detalle
		$Fila;
		$Columna;
		$FilaArray;
		// Deserializa Detalle
		if ($ParametrosDetalle != '') {
			$ParametrosDetalleArray = explode('~', $ParametrosDetalle);
			foreach ($ParametrosDetalleArray as &$Fila) {
				//
				$FilaArray = explode('|', $Fila);
				$CodProducto = $FilaArray[0];
				$Cantidad = $FilaArray[1];
				//
				$Procedimiento = 'ProcAlmacenMovimientoDetalle';
				$Parametros = $CodAlmacenMovimiento . '|' . $CodProducto . '|' . $Cantidad. '|0';
				$Indice = 20;
				$Query = 'CALL ' . $Procedimiento . ' ("' . $Parametros . '", ' . $Indice . ')';
				$InsertarAlmacenMovimientoDetalle = mysqli_query($link, $Query);
				//
				$CodAlmacenMovimientoDetalle = 0;
				//
				if (!$InsertarAlmacenMovimientoDetalle) {
					mysqli_rollback($link);
					$Query = "SELECT 0 AS CodResultado, 'Ocurrió un error detalle' AS DesResultado;";
					$Respuesta = mysqli_query($link, $Query);
					$Resultado = mysqli_fetch_assoc($Respuesta);
					//
					return $Resultado;
				}
				
				$Query = 'SELECT	LAST_INSERT_ID();'; 
				$InsertarAlmacenMovimientoDetalle = mysqli_query($link, $Query);
				$Resultado = mysqli_fetch_row($InsertarAlmacenMovimientoDetalle);
				// Obtiene maestro correlativo
				$CodAlmacenMovimientoDetalle = $Resultado[0];
				//
				if ($CodAlmacenMovimientoDetalle == 0) {
					mysqli_rollback($link);
					$Query = "SELECT 0 AS CodResultado, 'Ocurrió un error detalle 2' AS DesResultado;";
					$Respuesta = mysqli_query($link, $Query);
					$Resultado = mysqli_fetch_assoc($Respuesta);
					//
					return $Resultado;
				}
			}
		}
		//
		$Query = 'SELECT 1 AS CodResultado, "Registró con exito!" AS DesResultado;';
		$Respuesta = mysqli_query($link, $Query);
		$Resultado = mysqli_fetch_assoc($Respuesta);
		//
		mysqli_commit($link);
		mysqli_close($link);
		return $Resultado;
	}
	public function ProcAlmacenMovimientoAnularTran($Procedimiento, $Parametros, $Indice) {
		$ServidorBD = $this->db->hostname;
		$UsuarioBD = $this->db->username;
		$ClaveBD = $this->db->password;
		$BaseDatos = $this->db->database;
		$Fila = '';
		//
		$link = mysqli_connect($ServidorBD, $UsuarioBD, $ClaveBD, $BaseDatos);
		//
		mysqli_autocommit($link, FALSE);
		$tildes = $link->query("SET NAMES 'utf8'"); //Para que se muestren las tildes correctamente
		// Verifica si el mótivo es Ingreso por Inventario
		$CodAlmacenMovimiento = explode('|', $Parametros)[0];
		//
		$Query = '
		SELECT	CodAlmacenMovimientoMotivo, CodEstado
		FROM 	TbAlmacenMovimiento
		WHERE	CodAlmacenMovimiento = ' . $CodAlmacenMovimiento;
		//

		$Respuesta = mysqli_query($link, $Query);
		$Resultado = mysqli_fetch_row($Respuesta);
		$CodAlmacenMovimientoMotivo = $Resultado[0];
		$CodEstado = $Resultado[1];
		//
		if ($CodAlmacenMovimientoMotivo == 2) {
			
			mysqli_rollback($link);
			$Query = "SELECT 0 AS CodResultado, 'No se puede anular el ingreso por Compra, hacerlo desde Compras.' AS DesResultado;";
			
			$Respuesta = mysqli_query($link, $Query);
			$Resultado = mysqli_fetch_assoc($Respuesta);
			//
			return $Resultado;
		}
		
		if ($CodEstado != 1) {
			mysqli_rollback($link);
			$Query = "SELECT 0 AS CodResultado, 'Ya está anulado' AS DesResultado;";
			$Respuesta = mysqli_query($link, $Query);
			$Resultado = mysqli_fetch_assoc($Respuesta);
			//
			return $Resultado;
		}
		//
		$Query = "CALL " . $Procedimiento . " ('" . $Parametros . "', " . $Indice . ");";
		$AnularAlmacenMovimiento = mysqli_query($link, $Query);
		//
		if (!$AnularAlmacenMovimiento) {
			mysqli_rollback($link);
			$Query = "SELECT 0 AS CodResultado, 'Ocurrió un error 2.' AS DesResultado;";
			$Respuesta = mysqli_query($link, $Query);
			$Resultado = mysqli_fetch_assoc($Respuesta);
			//
			return $Resultado;
		}
		//
		$Query = 'SELECT 1 AS CodResultado, "Anuló con exito!" AS DesResultado;';
		$Respuesta = mysqli_query($link, $Query);
		$Resultado = mysqli_fetch_assoc($Respuesta);
		//
		mysqli_commit($link);
		mysqli_close($link);
		return $Resultado;
	}
	
	public function ProcCompraTran($Procedimiento, $Parametros, $ParametrosDetalle, $Indice) {
		$ServidorBD = $this->db->hostname;
		$UsuarioBD = $this->db->username;
		$ClaveBD = $this->db->password;
		$BaseDatos = $this->db->database;
		$Fila = '';
		//
		$link = mysqli_connect($ServidorBD, $UsuarioBD, $ClaveBD, $BaseDatos);
		//
		mysqli_autocommit($link, FALSE);
		$tildes = $link->query("SET NAMES 'utf8'"); //Para que se muestren las tildes correctamente
		//
		$CodUsuario = explode('|', $Parametros)[6];

		/*
		$Query = '
		SELECT	CodCajaGestionActual
		FROM		TbUsuario
		WHERE		CodUsuario = ' . $CodUsuario . ';';
		$Respuesta = mysqli_query($link, $Query);
		$Resultado = mysqli_fetch_row($Respuesta);
		$CodCajaGestionActual = $Resultado[0];

		*/

		//
		
		/* validacion caja
		if ($CodCajaGestionActual == '' || $CodCajaGestionActual == 0) {
			mysqli_rollback($link);
			$Query = "SELECT 0 AS CodResultado, 'No tiene caja abierta. Abra su caja!' AS DesResultado;";
			$Respuesta = mysqli_query($link, $Query);
			$Resultado = mysqli_fetch_assoc($Respuesta);
			//
			return $Resultado;
		}
		*/
		
		//
		$Query = "CALL " . $Procedimiento . " ('" . $Parametros . "', " . $Indice . ");"; 
		$InsertarCompra = mysqli_query($link, $Query);
		
		if (!$InsertarCompra) {
			mysqli_rollback($link);
			$Query = "SELECT 0 AS CodResultado, 'Ocurrió un error al registrar " . $Parametros . "'  AS DesResultado;";
			$Respuesta = mysqli_query($link, $Query);
			$Resultado = mysqli_fetch_assoc($Respuesta);
			//
			return $Resultado;
		}
		//
		$Query = 'SELECT	LAST_INSERT_ID();'; 
		$InsertarCompra = mysqli_query($link, $Query);
		$Resultado = mysqli_fetch_row($InsertarCompra);
		// Obtiene maestro correlativo
		$CodCompra = $Resultado[0];
		// Registra detalle
		$Fila;
		$Columna;
		$FilaArray;
		// Deserializa Detalle
		if (!$ParametrosDetalle == '') {
			$ParametrosDetalleArray = explode('~', $ParametrosDetalle);
			foreach ($ParametrosDetalleArray as &$Fila) {
				//
				$FilaArray = explode('|', $Fila);
				$CodProducto = $FilaArray[0];
				$Cantidad = $FilaArray[1];
				$SubTotal = $FilaArray[2];
				//
				$Procedimiento = 'ProcCompraDetalle';
				$Parametros = $CodCompra . '|' . $CodProducto . '|' . $Cantidad . '|' . $SubTotal;
				$Indice = 20;
				$Query = 'CALL ' . $Procedimiento . ' ("' . $Parametros . '", ' . $Indice . ')';
				$InsertarCompraDetalle = mysqli_query($link, $Query);
				//
				$CodCompraDetalle = 0;
				//
				if (!$InsertarCompraDetalle) {
					mysqli_rollback($link);
					$Query = "SELECT 0 AS CodResultado, 'Ocurrió un error detalle " . $CodCompra . "' AS DesResultado;";
					$Respuesta = mysqli_query($link, $Query);
					$Resultado = mysqli_fetch_assoc($Respuesta);
					//
					return $Resultado;
				}
				$Query = 'SELECT	LAST_INSERT_ID();'; 
				$InsertarCompraDetalle = mysqli_query($link, $Query);
				$Resultado = mysqli_fetch_row($InsertarCompraDetalle);
				// Obtiene maestro correlativo
				$CodCompraDetalle = $Resultado[0];
				//
				if ($CodCompraDetalle == 0) {
					mysqli_rollback($link);
					$Query = "SELECT 0 AS CodResultado, 'Ocurrió un error detalle 2' AS DesResultado;";
					$Respuesta = mysqli_query($link, $Query);
					$Resultado = mysqli_fetch_assoc($Respuesta);
					//
					return $Resultado;
				}
			}
		}
		// Actualiza montos en cabecera
		$Procedimiento = 'ProcCompra';
		$Parametros = $CodCompra;
		$Indice = 21;
		$Query = "CALL " . $Procedimiento . " ('" . $Parametros . "', " . $Indice . ");"; 
		$ActualizarMonto = mysqli_query($link, $Query);
		//
		$Query = 'SELECT 1 AS CodResultado, "Registró con exito!' . $CodCompra . '" AS DesResultado;';
		$Respuesta = mysqli_query($link, $Query);
		$Resultado = mysqli_fetch_assoc($Respuesta);
		//
		mysqli_commit($link);
		mysqli_close($link);
		return $Resultado;
	}
	public function ProcCompraAnularTran($Procedimiento, $Parametros, $Indice) {
		$ServidorBD = $this->db->hostname;
		$UsuarioBD = $this->db->username;
		$ClaveBD = $this->db->password;
		$BaseDatos = $this->db->database;
		$Fila = '';
		//
		$link = mysqli_connect($ServidorBD, $UsuarioBD, $ClaveBD, $BaseDatos);
		//
		mysqli_autocommit($link, FALSE);
		$tildes = $link->query("SET NAMES 'utf8'"); //Para que se muestren las tildes correctamente
		// Verifica si el mótivo es Ingreso por Inventario
		$CodCompra = explode('|', $Parametros)[0];
		$CodUsuarioAccion = explode('|', $Parametros)[1];
		$MotivoAnulacion = explode('|', $Parametros)[2];
		//
		$Query = '
		SELECT	CodEstado
		FROM		TbCompra
		WHERE		CodCompra = ' . $CodCompra;
		//
		$Respuesta = mysqli_query($link, $Query);
		$Resultado = mysqli_fetch_row($Respuesta);
		$CodEstado = $Resultado[0];
		//
		if ($CodEstado == 3) {
			mysqli_rollback($link);
			$Query = "SELECT 0 AS CodResultado, 'Ya está anulado' AS DesResultado;";
			$Respuesta = mysqli_query($link, $Query);
			$Resultado = mysqli_fetch_assoc($Respuesta);
			//
			return $Resultado;
		}
		//
		$Query = "CALL " . $Procedimiento . " ('" . $Parametros . "', " . $Indice . ");";
		$AnularVenta = mysqli_query($link, $Query);
		//
		if (!$AnularVenta) {
			mysqli_rollback($link);
			$Query = "SELECT 0 AS CodResultado, 'No se pudo anular la venta' AS DesResultado;";
			$Respuesta = mysqli_query($link, $Query);
			$Resultado = mysqli_fetch_assoc($Respuesta);
			//
			return $Resultado;
		}
		// Obtiene Movimiento de almacén relacionado a la Venta
		$Query = '
		SELECT	CodAlmacenMovimiento
		FROM		TbAlmacenMovimiento
		WHERE		CodCompra = ' . $CodCompra;
		//
		$Respuesta = mysqli_query($link, $Query);
		$Resultado = mysqli_fetch_row($Respuesta);
		$CodAlmacenMovimiento = $Resultado[0];
		//
		$Procedimiento = 'ProcAlmacenMovimiento';
		$Parametros = $CodAlmacenMovimiento . '|' . $CodUsuarioAccion . '|' . $MotivoAnulacion;
		$Indice = 30;
		$Query = "CALL " . $Procedimiento . " ('" . $Parametros . "', " . $Indice . ");";
		$AnularAlmacenMovimiento = mysqli_query($link, $Query);
		//
		if (!$AnularAlmacenMovimiento) {
			mysqli_rollback($link);
			$Query = "SELECT 0 AS CodResultado, 'No se pudo Anular el Movimiento Almacen' AS DesResultado;";
			$Respuesta = mysqli_query($link, $Query);
			$Resultado = mysqli_fetch_assoc($Respuesta);
			//
			return $Resultado;
		}
		//
		$Query = 'SELECT 1 AS CodResultado, "Anuló con exito!" AS DesResultado;';
		$Respuesta = mysqli_query($link, $Query);
		$Resultado = mysqli_fetch_assoc($Respuesta);
		//
		mysqli_commit($link);
		mysqli_close($link);
		return $Resultado;
	}

	public function ProcPedidoTran($Procedimiento, $Parametros, $ParametrosDetalle, $Indice) {
		$ServidorBD = $this->db->hostname;
		$UsuarioBD = $this->db->username;
		$ClaveBD = $this->db->password;
		$BaseDatos = $this->db->database;
		$Fila = '';
		//
		$link = mysqli_connect($ServidorBD, $UsuarioBD, $ClaveBD, $BaseDatos);
		//
		mysqli_autocommit($link, FALSE);
		$tildes = $link->query("SET NAMES 'utf8'"); //Para que se muestren las tildes correctamente
		//
		$CodUsuario = explode('|', $Parametros)[4];
		$Query = "CALL " . $Procedimiento . " ('" . $Parametros . "', " . $Indice . ");";
		$InsertarPedido = mysqli_query($link, $Query);
		//
		if (!$InsertarPedido) {
			mysqli_rollback($link);
			$Query = "SELECT 0 AS CodResultado, 'Ocurrió un error al registrar " . $Parametros . "'  AS DesResultado;";
			$Respuesta = mysqli_query($link, $Query);
			$Resultado = mysqli_fetch_assoc($Respuesta);
			//
			return $Resultado;
		}
		//
		$Query = 'SELECT	LAST_INSERT_ID();'; 
		$InsertarPedido = mysqli_query($link, $Query);
		$Resultado = mysqli_fetch_row($InsertarPedido);
		// Obtiene maestro correlativo
		$CodPedido = $Resultado[0];
		// Registra detalle
		$Fila;
		$Columna;
		$FilaArray;
		// Deserializa Detalle
		if (!$ParametrosDetalle == '') {
			$ParametrosDetalleArray = explode('~', $ParametrosDetalle);
			foreach ($ParametrosDetalleArray as &$Fila) {
				//
				$FilaArray = explode('|', $Fila);
				$CodProducto = $FilaArray[0];
				$Cantidad = $FilaArray[1];
				//
				$Procedimiento = 'ProcPedidoDetalle';
				$Parametros = $CodPedido . '|' . $CodProducto . '|' . $Cantidad . '|' . $CodUsuario;
				$Indice = 20;
				$Query = 'CALL ' . $Procedimiento . ' ("' . $Parametros . '", ' . $Indice . ')';
				$InsertarPedidoDetalle = mysqli_query($link, $Query);
				//
				$CodPedidoDetalle = 0;
				//
				if (!$InsertarPedidoDetalle) {
					mysqli_rollback($link);
					$Query = "SELECT 0 AS CodResultado, 'Ocurrió un error detalle " . $CodPedido . "' AS DesResultado;";
					$Respuesta = mysqli_query($link, $Query);
					$Resultado = mysqli_fetch_assoc($Respuesta);
					//
					return $Resultado;
				}
				$Query = 'SELECT	LAST_INSERT_ID();'; 
				$InsertarPedidoDetalle = mysqli_query($link, $Query);
				$Resultado = mysqli_fetch_row($InsertarPedidoDetalle);
				// Obtiene maestro correlativo
				$CodPedidoDetalle = $Resultado[0];
				//
				if ($CodPedidoDetalle == 0) {
					mysqli_rollback($link);
					$Query = "SELECT 0 AS CodResultado, 'Ocurrió un error detalle 2' AS DesResultado;";
					$Respuesta = mysqli_query($link, $Query);
					$Resultado = mysqli_fetch_assoc($Respuesta);
					//
					return $Resultado;
				}
			}
		}
		// Actualiza montos en cabecera
		$Procedimiento = 'ProcPedido';
		$Parametros = $CodPedido;
		$Indice = 21;
		$Query = "CALL " . $Procedimiento . " ('" . $Parametros . "', " . $Indice . ");"; 
		$ActualizarMonto = mysqli_query($link, $Query);
		//
		$Query = 'SELECT 1 AS CodResultado, "Registró con exito!' . $CodPedido . '" AS DesResultado;';
		$Respuesta = mysqli_query($link, $Query);
		$Resultado = mysqli_fetch_assoc($Respuesta);
		//
		mysqli_commit($link);
		mysqli_close($link);
		return $Resultado;
	}
	public function ProcPedidoAnularTran($Procedimiento, $Parametros, $Indice) {
		$ServidorBD = $this->db->hostname;
		$UsuarioBD = $this->db->username;
		$ClaveBD = $this->db->password;
		$BaseDatos = $this->db->database;
		$Fila = '';
		//
		$link = mysqli_connect($ServidorBD, $UsuarioBD, $ClaveBD, $BaseDatos);
		//
		mysqli_autocommit($link, FALSE);
		$tildes = $link->query("SET NAMES 'utf8'"); //Para que se muestren las tildes correctamente
		//
		$CodPedido = explode('|', $Parametros)[0];
		//
		$Query = '
		SELECT	CodEstado, IFNULL(CodVenta, 0)
		FROM 	TbPedido
		WHERE	CodPedido = ' . $CodPedido;
		//
		$Respuesta = mysqli_query($link, $Query);
		$Resultado = mysqli_fetch_row($Respuesta);
		$CodEstado = $Resultado[0];
		$CodVenta = $Resultado[1];
		//
		if ($CodEstado != 1) {
			mysqli_rollback($link);
			$Query = "SELECT 0 AS CodResultado, 'Ya está anulado' AS DesResultado;";
			$Respuesta = mysqli_query($link, $Query);
			$Resultado = mysqli_fetch_assoc($Respuesta);
			//
			return $Resultado;
		}
		if ($CodVenta != 0) {
			mysqli_rollback($link);
			$Query = "SELECT 0 AS CodResultado, 'Ya se completó la venta' AS DesResultado;";
			$Respuesta = mysqli_query($link, $Query);
			$Resultado = mysqli_fetch_assoc($Respuesta);
			//
			return $Resultado;
		}
		//
		$Query = "CALL " . $Procedimiento . " ('" . $Parametros . "', " . $Indice . ");";
		$AnularPedido = mysqli_query($link, $Query);
		//
		if (!$AnularPedido) {
			mysqli_rollback($link);
			$Query = "SELECT 0 AS CodResultado, 'Ocurrió un error al anular " . $Indice ."' AS DesResultado;";
			$Respuesta = mysqli_query($link, $Query);
			$Fila = mysqli_fetch_assoc($Respuesta);
			//
			return $Fila;
		}
		//
		$Query = 'SELECT 1 AS CodResultado, "Anuló con exito!" AS DesResultado;';
		$Respuesta = mysqli_query($link, $Query);
		$Resultado = mysqli_fetch_assoc($Respuesta);
		//
		mysqli_commit($link);
		mysqli_close($link);
		return $Resultado;
	}

	public function ProcAlmacenTrasladoTran($Procedimiento, $Parametros, $ParametrosDetalle, $Indice) {
		$ServidorBD = $this->db->hostname;
		$UsuarioBD = $this->db->username;
		$ClaveBD = $this->db->password;
		$BaseDatos = $this->db->database;
		$Fila = '';
		//
		$link = mysqli_connect($ServidorBD, $UsuarioBD, $ClaveBD, $BaseDatos);
		//
		mysqli_autocommit($link, FALSE);
		$tildes = $link->query("SET NAMES 'utf8'"); //Para que se muestren las tildes correctamente
		//
		$CodAlmacenOrigen = explode('|', $Parametros)[0];
		$CodAlmacenDestino = explode('|', $Parametros)[1];
		$MotivoTraslado = explode('|', $Parametros)[2];
		$CodUsuarioAccion = explode('|', $Parametros)[3];
		//
		$Query = "CALL " . $Procedimiento . " ('" . $Parametros . "', " . $Indice . ");";
		$InsertarAlmacenTraslado = mysqli_query($link, $Query);
		//
		if (!$InsertarAlmacenTraslado) {
			mysqli_rollback($link);
			$Query = "SELECT 0 AS CodResultado, 'Ocurrió un error al registrar " . $Parametros . "'  AS DesResultado;";
			$Respuesta = mysqli_query($link, $Query);
			$Resultado = mysqli_fetch_assoc($Respuesta);
			//
			return $Resultado;
		}
		//
		$Query = 'SELECT	LAST_INSERT_ID();';
		$InsertarAlmacenTraslado = mysqli_query($link, $Query);
		$Resultado = mysqli_fetch_row($InsertarAlmacenTraslado);
		// Obtiene maestro correlativo
		$CodAlmacenTraslado = $Resultado[0];
		// Registra Salida del Almacen Origen
		$CodAlmacenMovimientoMotivo = 6;
		$CodDocumento = 5;
		$Parametros = $CodAlmacenOrigen . '|' . $CodAlmacenMovimientoMotivo . '|' . $CodUsuarioAccion . '|' . $MotivoTraslado .  '|' . $CodAlmacenTraslado . '|' . $CodDocumento;
		$Indice = 21;
		$Query = "CALL ProcAlmacenMovimiento('" . $Parametros . "', " . $Indice . ");";
		$InsertarSalidaAlmacen = mysqli_query($link, $Query);
		//
		if (!$InsertarSalidaAlmacen) {
			mysqli_rollback($link);
			$Query = "SELECT 0 AS CodResultado, 'Ocurrió un error al InsertarSalidaAlmacen " . $Parametros . "'  AS DesResultado;";
			$Respuesta = mysqli_query($link, $Query);
			$Resultado = mysqli_fetch_assoc($Respuesta);
			//
			return $Resultado;
		}
		//
		$Query = 'SELECT	LAST_INSERT_ID();';
		$InsertarSalidaAlmacen = mysqli_query($link, $Query);
		$Resultado = mysqli_fetch_row($InsertarSalidaAlmacen);
		// Obtiene maestro correlativo
		$CodAlmacenMovimientoOrigen = $Resultado[0];
		//
		// Registra Ingreso del Almacen Destino
		$CodAlmacenMovimientoMotivo = 5;
		$CodDocumento = 4;
		$Parametros = $CodAlmacenDestino . '|' . $CodAlmacenMovimientoMotivo . '|' . $CodUsuarioAccion . '|' . $MotivoTraslado .  '|' . $CodAlmacenTraslado . '|' . $CodDocumento;
		$Indice = 21;
		$Query = "CALL ProcAlmacenMovimiento('" . $Parametros . "', " . $Indice . ");";
		$InsertarIngresoAlmacen = mysqli_query($link, $Query);
		//
		if (!$InsertarIngresoAlmacen) {
			mysqli_rollback($link);
			$Query = "SELECT 0 AS CodResultado, 'Ocurrió un error al InsertarIngresoAlmacen " . $Parametros . "'  AS DesResultado;";
			$Respuesta = mysqli_query($link, $Query);
			$Resultado = mysqli_fetch_assoc($Respuesta);
			//
			return $Resultado;
		}
		//
		$Query = 'SELECT	LAST_INSERT_ID();';
		$InsertarIngresoAlmacen = mysqli_query($link, $Query);
		$Resultado = mysqli_fetch_row($InsertarIngresoAlmacen);
		// Obtiene maestro correlativo
		$CodAlmacenMovimientoDestino = $Resultado[0];

		// Registra detalle
		$Fila;
		$Columna;
		$FilaArray;
		// Deserializa Detalle
		if (!$ParametrosDetalle == '') {
			$ParametrosDetalleArray = explode('~', $ParametrosDetalle);
			foreach ($ParametrosDetalleArray as &$Fila) {
				//
				$FilaArray = explode('|', $Fila);
				$CodProducto = $FilaArray[0];
				$Cantidad = $FilaArray[1];
				// Valida Stock
				$Stock = 0;

				$Query = '
				SELECT	IFNULL(Stock, 0)
				FROM		TbProductoStock
				WHERE		CodAlmacen = ' . $CodAlmacenOrigen . '
				AND			CodProducto = ' . $CodProducto . ';';
				$InsertarVenta = mysqli_query($link, $Query);
				$Resultado = mysqli_fetch_row($InsertarVenta);
				$Stock = $Resultado[0];
				//
				if ($Cantidad > $Stock) {
					mysqli_rollback($link);
					$Query = "SELECT 0 AS CodResultado, 'Stock insuficiente. Stock actual: " . $Stock . "' AS DesResultado;";
					$Respuesta = mysqli_query($link, $Query);
					$Resultado = mysqli_fetch_assoc($Respuesta);
					//
					return $Resultado;
				}
				//
				$Procedimiento = 'ProcAlmacenTrasladoDetalle';
				$Parametros = $CodAlmacenTraslado . '|' . $CodProducto . '|' . $Cantidad;
				$Indice = 20;
				$Query = 'CALL ' . $Procedimiento . ' ("' . $Parametros . '", ' . $Indice . ')';
				$InsertarAlmacenTrasladoDetalle = mysqli_query($link, $Query);
				//
				$CodAlmacenTrasladoDetalle = 0;
				//
				if (!$InsertarAlmacenTrasladoDetalle) {
					mysqli_rollback($link);
					$Query = "SELECT 0 AS CodResultado, 'Ocurrió un error detalle Traslado Inserta " . $CodAlmacenTraslado . "' AS DesResultado;";
					$Respuesta = mysqli_query($link, $Query);
					$Resultado = mysqli_fetch_assoc($Respuesta);
					//
					return $Resultado;
				}
				$Query = 'SELECT	LAST_INSERT_ID();';
				$InsertarAlmacenTrasladoDetalle = mysqli_query($link, $Query);
				$Resultado = mysqli_fetch_row($InsertarAlmacenTrasladoDetalle);
				// Obtiene maestro correlativo
				$CodAlmacenTrasladoDetalle = $Resultado[0];
				//
				if ($CodAlmacenTrasladoDetalle == 0) {
					mysqli_rollback($link);
					$Query = "SELECT 0 AS CodResultado, 'Ocurrió un error detalle Traslado Ultimo Id ' AS DesResultado;";
					$Respuesta = mysqli_query($link, $Query);
					$Resultado = mysqli_fetch_assoc($Respuesta);
					//
					return $Resultado;
				}
				//
				$Procedimiento = 'ProcAlmacenMovimientoDetalle';
				$Parametros = $CodAlmacenMovimientoOrigen . '|' . $CodProducto . '|' . $Cantidad;
				$Indice = 20;
				$Query = 'CALL ' . $Procedimiento . ' ("' . $Parametros . '", ' . $Indice . ')';
				$InsertarAlmacenMovimientoDetalleOrigen = mysqli_query($link, $Query);
				//
				$CodAlmacenMovimientoDetalleOrigen = 0;
				//
				if (!$InsertarAlmacenMovimientoDetalleOrigen) {
					mysqli_rollback($link);
					$Query = "SELECT 0 AS CodResultado, 'Ocurrió un error detalle MovimientoDetalle " . $CodAlmacenTraslado . "' AS DesResultado;";
					$Respuesta = mysqli_query($link, $Query);
					$Resultado = mysqli_fetch_assoc($Respuesta);
					//
					return $Resultado;
				}
				$Query = 'SELECT	LAST_INSERT_ID();';
				$InsertarAlmacenMovimientoDetalleOrigen = mysqli_query($link, $Query);
				$Resultado = mysqli_fetch_row($InsertarAlmacenMovimientoDetalleOrigen);
				// Obtiene maestro correlativo
				$CodAlmacenMovimientoDetalleOrigen = $Resultado[0];
				//
				if ($CodAlmacenMovimientoDetalleOrigen == 0) {
					mysqli_rollback($link);
					$Query = "SELECT 0 AS CodResultado, 'Ocurrió un error detalle MovimientoDetalle Id ' AS DesResultado;";
					$Respuesta = mysqli_query($link, $Query);
					$Resultado = mysqli_fetch_assoc($Respuesta);
					//
					return $Resultado;
				}
				//
				$Procedimiento = 'ProcAlmacenMovimientoDetalle';
				$Parametros = $CodAlmacenMovimientoDestino . '|' . $CodProducto . '|' . $Cantidad;
				$Indice = 20;
				$Query = 'CALL ' . $Procedimiento . ' ("' . $Parametros . '", ' . $Indice . ')';
				$InsertarAlmacenMovimientoDetalleDestino = mysqli_query($link, $Query);
				//
				$CodAlmacenMovimientoDetalleDestino = 0;
				//
				if (!$InsertarAlmacenMovimientoDetalleDestino) {
					mysqli_rollback($link);
					$Query = "SELECT 0 AS CodResultado, 'Ocurrió un error detalle MovimientoDetalle " . $CodAlmacenTraslado . "' AS DesResultado;";
					$Respuesta = mysqli_query($link, $Query);
					$Resultado = mysqli_fetch_assoc($Respuesta);
					//
					return $Resultado;
				}
				$Query = 'SELECT	LAST_INSERT_ID();';
				$InsertarAlmacenMovimientoDetalleDestino = mysqli_query($link, $Query);
				$Resultado = mysqli_fetch_row($InsertarAlmacenMovimientoDetalleDestino);
				// Obtiene maestro correlativo
				$CodAlmacenMovimientoDetalleDestino = $Resultado[0];
				//
				if ($CodAlmacenMovimientoDetalleDestino == 0) {
					mysqli_rollback($link);
					$Query = "SELECT 0 AS CodResultado, 'Ocurrió un error detalle MovimientoDetalle Id ' AS DesResultado;";
					$Respuesta = mysqli_query($link, $Query);
					$Resultado = mysqli_fetch_assoc($Respuesta);
					//
					return $Resultado;
				}
			}
		}
		//
		$Query = 'SELECT 1 AS CodResultado, "Registró con exito!" AS DesResultado;';
		$Respuesta = mysqli_query($link, $Query);
		$Resultado = mysqli_fetch_assoc($Respuesta);
		//
		mysqli_commit($link);
		mysqli_close($link);
		return $Resultado;
	}
	public function ProcAlmacenTrasladoAnularTran($Procedimiento, $Parametros, $Indice) {
		$ServidorBD = $this->db->hostname;
		$UsuarioBD = $this->db->username;
		$ClaveBD = $this->db->password;
		$BaseDatos = $this->db->database;
		$Fila = '';
		//
		$link = mysqli_connect($ServidorBD, $UsuarioBD, $ClaveBD, $BaseDatos);
		//
		mysqli_autocommit($link, FALSE);
		$tildes = $link->query("SET NAMES 'utf8'"); //Para que se muestren las tildes correctamente
		// Verifica si el mótivo es Ingreso por Inventario
		$CodAlmacenTraslado = explode('|', $Parametros)[0];
		$CodUsuarioAccion = explode('|', $Parametros)[1];
		$MotivoAnulacion = explode('|', $Parametros)[2];
		//
		$Query = '
		SELECT	CodEstado
		FROM		TbAlmacenTraslado
		WHERE		CodAlmacenTraslado = ' . $CodAlmacenTraslado;
		//
		$Respuesta = mysqli_query($link, $Query);
		$Resultado = mysqli_fetch_row($Respuesta);
		$CodEstado = $Resultado[0];
		//
		if ($CodEstado == 3) {
			mysqli_rollback($link);
			$Query = "SELECT 0 AS CodResultado, 'Ya está anulado' AS DesResultado;";
			$Respuesta = mysqli_query($link, $Query);
			$Resultado = mysqli_fetch_assoc($Respuesta);
			//
			return $Resultado;
		}
		//
		$Query = "CALL " . $Procedimiento . " ('" . $Parametros . "', " . $Indice . ");";
		$AnularAlmacenTraslado = mysqli_query($link, $Query);
		//
		if (!$AnularAlmacenTraslado) {
			mysqli_rollback($link);
			$Query = "SELECT 0 AS CodResultado, 'No se pudo anular' AS DesResultado;";
			$Respuesta = mysqli_query($link, $Query);
			$Resultado = mysqli_fetch_assoc($Respuesta);
			//
			return $Resultado;
		}
		//
		$Query = '
		SELECT	CodAlmacenMovimiento
		FROM		TbAlmacenMovimiento
		WHERE		CodAlmacenMovimientoMotivo = 5
		AND			CodEstado = 1
		AND			CodAlmacenTraslado = ' . $CodAlmacenTraslado;
		//
		$Respuesta = mysqli_query($link, $Query);
		$Resultado = mysqli_fetch_row($Respuesta);
		$CodAlmacenMovimientoDestino = $Resultado[0];
		//
		if (!$CodAlmacenMovimientoDestino == null) {
			$Procedimiento = 'ProcAlmacenMovimiento';
			$Parametros = $CodAlmacenMovimientoDestino . '|' . $CodUsuarioAccion . '|' . $MotivoAnulacion;
			$Indice = 30;
			$Query = "CALL " . $Procedimiento . " ('" . $Parametros . "', " . $Indice . ");";
			$AnularAlmacenMovimientoDestino = mysqli_query($link, $Query);
			//
			if (!$AnularAlmacenMovimientoDestino) {
				mysqli_rollback($link);
				$Query = "SELECT 0 AS CodResultado, 'No se pudo Anular el Movimiento Almacen Destino' AS DesResultado;";
				$Respuesta = mysqli_query($link, $Query);
				$Resultado = mysqli_fetch_assoc($Respuesta);
				//
				return $Resultado;
			}
			//
			$Query = '
			SELECT	CodAlmacenMovimiento
			FROM		TbAlmacenMovimiento
			WHERE		CodAlmacenMovimientoMotivo = 6
			AND			CodEstado = 1
			AND			CodAlmacenTraslado = ' . $CodAlmacenTraslado;
			//
			$Respuesta = mysqli_query($link, $Query);
			$Resultado = mysqli_fetch_row($Respuesta);
			$CodAlmacenMovimientoOrigen = $Resultado[0];
			//
			if (!$CodAlmacenMovimientoOrigen == null) {
				$Procedimiento = 'ProcAlmacenMovimiento';
				$Parametros = $CodAlmacenMovimientoOrigen . '|' . $CodUsuarioAccion . '|' . $MotivoAnulacion;
				$Indice = 30;
				$Query = "CALL " . $Procedimiento . " ('" . $Parametros . "', " . $Indice . ");";
				$AnularAlmacenMovimientoOrigen = mysqli_query($link, $Query);
				//
				if (!$AnularAlmacenMovimientoOrigen) {
					mysqli_rollback($link);
					$Query = "SELECT 0 AS CodResultado, 'No se pudo Anular el Movimiento Almacen Origen' AS DesResultado;";
					$Respuesta = mysqli_query($link, $Query);
					$Resultado = mysqli_fetch_assoc($Respuesta);
					//
					return $Resultado;
				}
			}
		}
		//
		$Query = 'SELECT 1 AS CodResultado, "Anuló con exito!" AS DesResultado;';
		$Respuesta = mysqli_query($link, $Query);
		$Resultado = mysqli_fetch_assoc($Respuesta);
		//
		mysqli_commit($link);
		mysqli_close($link);
		return $Resultado;
	}

	public function ProcSQL($q){
		
						$rpta = "";
				try {
						$query = $this->db->query($q);
						//$query = $this->db->query("call ProcUsuario ('rolando|123|12',11)");
						//return $query;
						$row = $query->result_array();
						$rpta = $row;
				} catch (Exception $e) {
						$rpta = $e->getMessage();
				}
				return $rpta;
	}

	public function ProcActualizaUltimaVista($Vista) {
		$rpta = "";
		$CodUsuario = $_SESSION['codusuario'];
    $Parametros = $CodUsuario . '|' . $Vista;
		try {
			$query = $this->db->query("call ProcUsuario ('" . $Parametros . "', 31)");
		} catch (Exception $e) {
		}
		return $rpta;
	}
}