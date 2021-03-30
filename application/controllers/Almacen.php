<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User class.
 *
 * @extends CI_Controllercvvmm,,mn
 */
class  Almacen extends CI_Controller {

  public function __construct() {

		parent::__construct();
	  $this->load->helper(array('url'));
    $this->load->model('general_model');
    $data = ['name' => 'generateToken','param' => ['user' => 'LATINOSAC', 'password' => '19032018@LATINO']];

    //include APPPATH . 'third_party/app/index.php';
    /*
		$this->load->helper(array('url'));
    $this->load->model('Unidad_model');
    $this->load->model('UnidadTrack_model');*/
	}

  public function Ingreso($Titulo){
    $this->load->library('session');
    if(empty($this->session->userdata('username'))){
        redirect('user/login');
    }
    $datos["nomusuario"] = $this->session->userdata('username');
    //
    $Data['Titulo'] = $Titulo;
    $Controlador = $this->router->fetch_class();
    $Accion = $this->router->fetch_method();
    //
    $Vista = $Controlador . '/' . $Accion;
    // Actualiza Ultima Vista
    $this->general_model->ProcActualizaUltimaVista($Vista . '/' . $Titulo);
    //
    $this->load->view('/layout_principal', $Data);
    $this->load->view('/' . $Vista);
    $this->load->view('/footer');
  }
  
  public function Pendientes($Titulo){
    $this->load->library('session');
    if(empty($this->session->userdata('username'))){
        redirect('user/login');
    }
    $datos["nomusuario"] = $this->session->userdata('username');
    //
    $Data['Titulo'] = $Titulo;
    $Controlador = $this->router->fetch_class();
    $Accion = $this->router->fetch_method();
    //
    $Vista = $Controlador . '/' . $Accion;
    // Actualiza Ultima Vista
    $this->general_model->ProcActualizaUltimaVista($Vista . '/' . $Titulo);
    //
    $this->load->view('/layout_principal', $Data);
    $this->load->view('/' . $Vista);
    $this->load->view('/footer');
  }

  public function Kardex($Titulo){
    $this->load->library('session');
    if(empty($this->session->userdata('username'))){
        redirect('user/login');
    }
    $datos["nomusuario"] = $this->session->userdata('username');
    //
    $Data['Titulo'] = $Titulo;
    $Controlador = $this->router->fetch_class();
    $Accion = $this->router->fetch_method();
    //
    $Vista = $Controlador . '/' . $Accion;
    // Actualiza Ultima Vista
    $this->general_model->ProcActualizaUltimaVista($Vista . '/' . $Titulo);
    //
    $this->load->view('/layout_principal', $Data);
    $this->load->view('/' . $Vista);
    $this->load->view('/footer');
  }


  public function StockMinimo($Titulo){
    $this->load->library('session');
    if(empty($this->session->userdata('username'))){
        redirect('user/login');
    }
    $datos["nomusuario"] = $this->session->userdata('username');
    //
    $Data['Titulo'] = $Titulo;
    $Controlador = $this->router->fetch_class();
    $Accion = $this->router->fetch_method();
    //
    $Vista = $Controlador . '/' . $Accion;
    // Actualiza Ultima Vista
    $this->general_model->ProcActualizaUltimaVista($Vista . '/' . $Titulo);
    //
    $this->load->view('/layout_principal', $Data);
    $this->load->view('/' . $Vista);
    $this->load->view('/footer');
  }
  public function ProcAlmacenMovimientoTran(){

    $Procedimiento = $this->input->post('Procedimiento');
    $Parametros = $this->input->post('Parametros');
    $ParametrosDetalle = $this->input->post('ParametrosDetalle');
    $Indice = $this->input->post('Indice');
    $resultado = $this->general_model->ProcAlmacenMovimientoTran($Procedimiento, $Parametros, $ParametrosDetalle, $Indice);
    echo json_encode($resultado);
  }

  public function ReporteMovimiento($Titulo){
    $Titulo = str_replace("%20", " ", $Titulo);

    $this->load->library('session');
    if(empty($this->session->userdata('username'))){
        redirect('user/login');
    }
    $datos["nomusuario"] = $this->session->userdata('username');
    //
    $Data['Titulo'] = $Titulo;
    $Controlador = $this->router->fetch_class();
    $Accion = $this->router->fetch_method();
    //
    $Vista = $Controlador . '/' . $Accion;
    // Actualiza Ultima Vista
    $this->general_model->ProcActualizaUltimaVista($Vista . '/' . $Titulo);
    //
    $this->load->view('/layout_principal', $Data);
    $this->load->view('/' . $Vista);
    $this->load->view('/footer');
  }
  

  public function ProcAlmacenMovimientoAnularTran(){

    $Procedimiento = $this->input->post('Procedimiento');
    $Parametros = $this->input->post('Parametros');
    $Indice = $this->input->post('Indice');

    $resultado = $this->general_model->ProcAlmacenMovimientoAnularTran($Procedimiento, $Parametros, $Indice);
    echo json_encode($resultado);
  }
  public function ProcAlmacenTrasladoTran(){

    $Procedimiento = $this->input->post('Procedimiento');
    $Parametros = $this->input->post('Parametros');
    $ParametrosDetalle = $this->input->post('ParametrosDetalle');
    $Indice = $this->input->post('Indice');

    $resultado = $this->general_model->ProcAlmacenTrasladoTran($Procedimiento, $Parametros, $ParametrosDetalle, $Indice);
    echo json_encode($resultado);
  }
  public function Traslado($Titulo){
    $this->load->library('session');
    if(empty($this->session->userdata('username'))){
        redirect('user/login');
    }
    $datos["nomusuario"] = $this->session->userdata('username');
    //
    $Data['Titulo'] = $Titulo;
    $Controlador = $this->router->fetch_class();
    $Accion = $this->router->fetch_method();
    //
    $Vista = $Controlador . '/' . $Accion;
    // Actualiza Ultima Vista
    $this->general_model->ProcActualizaUltimaVista($Vista . '/' . $Titulo);
    //
    $this->load->view('/layout_principal', $Data);
    $this->load->view('/' . $Vista);
    $this->load->view('/footer');
  }
}
