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
/*
		$query = $this->db->query('SELECT * FROM products;');
		return  $row = $query->row_array();
*/

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
		if ($CodAlmacenMovimientoMotivo != 1) {
			mysqli_rollback($link);
			$Query = "SELECT 0 AS CodResultado, 'Solo se puede anular el tipo INGRESO POR INVENTARIO.' AS DesResultado;";
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
	/** */
	
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
		$Query = "CALL " . $Procedimiento . " ('" . $Parametros . "', " . $Indice . ");"; 
		$InsertarCompra = mysqli_query($link, $Query);
		//
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
		//
		$CodCompra = explode('|', $Parametros)[0];
		//
		$Query = '
		SELECT	CodEstado
		FROM 	TbCompra
		WHERE	CodCompra = ' . $CodCompra;
		//
		$Respuesta = mysqli_query($link, $Query);
		$Resultado = mysqli_fetch_row($Respuesta);
		$CodEstado = $Resultado[0];
		//
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
		$AnularCompra = mysqli_query($link, $Query);
		//
		if (!$AnularCompra) {
			mysqli_rollback($link);
			$Query = "SELECT 0 AS CodResultado, 'Ocurrió un error 2.' AS DesResultado;";
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

}
