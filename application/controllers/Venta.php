<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User class.
 *
 * @extends CI_Controllercvvmm,,mn
 */
class  Venta extends CI_Controller {

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
	
  public function ProcVentaTran(){

    $Procedimiento = $this->input->post('Procedimiento');
    $Parametros = $this->input->post('Parametros');
    $ParametrosDetalle = $this->input->post('ParametrosDetalle');
    $Indice = $this->input->post('Indice');

    $resultado = $this->general_model->ProcVentaTran($Procedimiento, $Parametros, $ParametrosDetalle, $Indice);
    echo json_encode($resultado);
  }
  public function ProcVentaAnularTran(){

    $Procedimiento = $this->input->post('Procedimiento');
    $Parametros = $this->input->post('Parametros');
    $Indice = $this->input->post('Indice');

    $resultado = $this->general_model->ProcVentaAnularTran($Procedimiento, $Parametros, $Indice);
    echo json_encode($resultado);
  }
	
  public function Registro($Titulo){
    $this->load->library('session');
    if(empty($this->session->userdata('username'))){
        redirect('user/login');
    }
    $datos["nomusuario"] = $this->session->userdata('username');
    $datos["clientes"] = $this->general_model->ProcSQL("SELECT * FROM `TbCliente`  WHERE `CodEstado` = 1;");
    $datos["vendedores"] = $this->general_model->ProcSQL("SELECT	CodPersona, Alias FROM `TbPersona` WHERE `CodPersonaTipo` = 1 AND	`CodEstado` = 1;");
    $datos["fpagos"] = $this->general_model->ProcSQL("SELECT * FROM `TbFormaPago`;");
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
    $this->load->view('/Venta/_impresionvoucher');
    $this->load->view('/' . $Vista, $datos);
    $this->load->view('/footer');
  }
  public function VoucherVenta(){
    $this->load->library('session');
    if(empty($this->session->userdata('username'))){
        redirect('user/login');
    }
    $datos["nomusuario"] = $this->session->userdata('username');

    $this->load->view('/layout_principal');
    $this->load->view('/Venta/VoucherVenta');
    $this->load->view('/footer');
  }
  
  public function ReporteDetallado($Titulo){
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
    $this->load->view('/Venta/_impresionvoucher');
    $this->load->view('/' . $Vista);
    $this->load->view('/footer');
  }
  public function RegistroDiario($Titulo){
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
  public function Voucher(){
    $this->load->library('session');
    if(empty($this->session->userdata('username'))){
        redirect('user/login');
    }
    $datos["nomusuario"] = $this->session->userdata('username');
    //
    $this->load->view('/Venta/Voucher');
  }
}