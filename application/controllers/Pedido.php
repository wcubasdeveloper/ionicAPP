<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User class.
 *
 * @extends CI_Controllercvvmm,,mn
 */
class  Pedido extends CI_Controller {

  public function __construct() {

		parent::__construct();
	  $this->load->helper(array('url'));
    $this->load->model('general_model');
    $data = ['name' => 'generateToken','param' => ['user' => 'LATINOSAC', 'password' => '19032018@LATINO']];
	}
  public function Inicio($Titulo){
    $this->load->library('session');
    if(empty($this->session->userdata('username'))){
        redirect('user/login');
    }
    $Layout = '/' . $_SESSION['Layout'];
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

  public function Registro($Titulo){
    $this->load->library('session');
    if(empty($this->session->userdata('username'))){
        redirect('user/login');
    }
    $Layout = '/' . $_SESSION['Layout'];
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
  public function ProcPedidoTran(){

    $Procedimiento = $this->input->post('Procedimiento');
    $Parametros = $this->input->post('Parametros');
    $ParametrosDetalle = $this->input->post('ParametrosDetalle');
    $Indice = $this->input->post('Indice');
    $resultado = $this->general_model->ProcPedidoTran($Procedimiento, $Parametros, $ParametrosDetalle, $Indice);
    echo json_encode($resultado);
  }
  public function ProcPedidoAnularTran(){

    $Procedimiento = $this->input->post('Procedimiento');
    $Parametros = $this->input->post('Parametros');
    $Indice = $this->input->post('Indice');

    $resultado = $this->general_model->ProcPedidoAnularTran($Procedimiento, $Parametros, $Indice);
    echo json_encode($resultado);
  }

  public function SubirImagenPedido(){

    $CodPedido= $this->input->post('CodPedido');

    $config['upload_path'] = "./assets/imagesPedido";
    $config['allowed_types'] = 'gif|jpg|png|jpeg';
    // $config['allowed_types'] = 'jpeg';
    $config['encrypt_name'] = False;
    $config['overwrite'] = True;
    $config['file_name'] = $CodPedido;//.$data['upload_data']["file_type"];
    $this->load->library('upload', $config);
    //
    $NombreGuardarBD = '';
    if($this->upload->do_upload("file")){
      // $data = array('upload_data' => $this->upload->data());
      $data = $this->upload->data();
      /*
            Array
      (
              [file_name]     => mypic.jpg
              [file_type]     => image/jpeg
              [file_path]     => /path/to/your/upload/
              [full_path]     => /path/to/your/upload/jpg.jpg
              [raw_name]      => mypic
              [orig_name]     => mypic.jpg
              [client_name]   => mypic.jpg
              [file_ext]      => .jpg
              [file_size]     => 22.2
              [is_image]      => 1
              [image_width]   => 800
              [image_height]  => 600
              [image_type]    => jpeg
              [image_size_str] => width="800" height="200"
      )
      */
      // if ($data['file_ext'] == '')
      $NombreGuardarBD = $CodPedido . $data['file_ext'];
      // echo '$NombreGuardarBD: ' . $NombreGuardarBD;
      // $title= $this->input->post('title');
      // $image= $data['upload_data']['file_name'];

      //$result= $this->upload_model->save_upload($title,$image);
      //echo json_decode($result);
      // echo json_decode("Imagen cargado correctamente");
      //echo "Imagen cargado correctamente";
    }
    $Procedimiento = 'ProcPedido';
    $Parametros = $CodPedido . '|' . $NombreGuardarBD;
    $Indice = 31;
    
    $Resultado = $this->general_model->ProcGeneral($Procedimiento, $Parametros, $Indice);
    echo json_encode($Resultado);
  }
}
