<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User class.
 *
 * @extends CI_Controllercvvmm,,mn
 */
class  Caja extends CI_Controller {

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
  public function Inicio($Titulo){
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
  public function MovimientoDiario($Titulo){
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
