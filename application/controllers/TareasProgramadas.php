<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User class.
 *
 * @extends CI_Controllercvvmm,,mn
 */
class  TareasProgramadas extends CI_Controller {

  public function __construct() {

		parent::__construct();
	    $this->load->helper(array('url'));
        $this->load->model('general_model');
	}
  
  public function CorteStock(){// tareaprogramada 6:00 AM
    $nombreProcedimiento = "ProcProductoStock";
    $parametros ="";
    $indice = 20;
    $resultado = $this->general_model->ProcGeneral($nombreProcedimiento, $parametros, $indice);
    echo json_encode($resultado);
  }

  public function CierreCajaAutomatico(){// tareaprogramada 6:00 AM
    $nombreProcedimiento = "ProcCajaGestion";
    $parametros ="";
    $indice = 31;
    $resultado = $this->general_model->ProcGeneral($nombreProcedimiento, $parametros, $indice);
    echo json_encode($resultado);
  }

}
