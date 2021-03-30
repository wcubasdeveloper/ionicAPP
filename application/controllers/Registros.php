<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');

/**
 * User class.
 *
 * @extends CI_Controllercvvmm,,mn
 */
class  Registros extends CI_Controller {

  public function __construct() {

		parent::__construct();
	  $this->load->helper(array('url'));
	  $this->router->fetch_method();
    $this->load->model('general_model');
    $this->load->library('session');
    $data = ['name' => 'generateToken','param' => ['user' => 'LATINOSAC', 'password' => '19032018@LATINO']];

    //include APPPATH . 'third_party/app/index.php';
    /*
		$this->load->helper(array('url'));
    $this->load->model('Unidad_model');
    $this->load->model('UnidadTrack_model');*/
	}
	
public function procGeneralWebHook(){

    $parametros = $this->input->get('parametros'); //cambiar por post
    $nombreProcedimiento = $this->input->get('nombreProcedimiento'); //cambiar por post
    $indice    = $this->input->get('indice'); // cambiar por post

    $resultado = $this->general_model->ProcGeneral($nombreProcedimiento, $parametros, $indice);
    echo json_encode($resultado);
    //echo $resultado;
  }
  
  public function procGeneral(){

    $parametros = $this->input->post('parametros'); //cambiar por post
    $nombreProcedimiento = $this->input->post('nombreProcedimiento'); //cambiar por post
    $indice    = $this->input->post('indice'); // cambiar por post

    $resultado = $this->general_model->ProcGeneral($nombreProcedimiento, $parametros, $indice);
    echo json_encode($resultado);
    //echo $resultado;
  }


  public function procGuardaMovimientoDetalle(){

    $parametros = $this->input->post('parametros'); //cambiar por post
    $nombreProcedimiento = $this->input->post('nombreProcedimiento'); //cambiar por post
    $indice    = $this->input->post('indice'); // cambiar por post

    $resultadoRegistro =  $this->general_model->guardarDetalleMovimientoTran($nombreProcedimiento, $parametros, $indice);
  
    
    //$resultado = $this->general_model->ProcGeneral($nombreProcedimiento, $parametros, $indice);
    echo json_encode($resultadoRegistro);
    //echo $resultado;
  }


  public function producto($Titulo){
    $nombreusuario = $_SESSION['username'];
    /***** desarrollo *****/
    if(empty($nombreusuario)){
      redirect('user/login');
    }
    /* producción
    if(empty($this->session->userdata('username'))){
        redirect('user/login');
    }
    */
    
    $datos["nomusuario"] = $nombreusuario;
    $datos["categorias"] = $this->general_model->ProcSQL("SELECT * FROM `TbProductoCategoria`;");
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
    $this->load->view('/' . $Vista,$datos);
    $this->load->view('/footer');
  }

  public function importarMatriz($Titulo){
    $nombreusuario = $_SESSION['username'];
    /***** desarrollo *****/
    if(empty($nombreusuario)){
      redirect('user/login');
    }
    /* producción
    if(empty($this->session->userdata('username'))){
        redirect('user/login');
    }
    */

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

  public function persona($Titulo){
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
    $this->load->view('/' . $Vista,$datos);
    $this->load->view('/footer');
  }
  
  
  public function cliente($Titulo){
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
    $this->load->view('/Registros/cliente',$datos);
    $this->load->view('/footer');
  }

  public function actualizarDataGlobal(){
    $this->load->library('session');
  
    $nombreTienda   = $this->input->post('nombreTienda');
    $nombreAlmacen  = $this->input->post('nombreAlmacen');    
    $this->session->set_userdata('NombreTienda', $nombreTienda);
    $this->session->set_userdata('NombreAlmacen', $nombreAlmacen);
    
  }
  

   public function limpiarDataCaja(){

    $this->load->library('session');
    $this->session->set_userdata('NombreTienda', '');
    $this->session->set_userdata('NombreAlmacen', '');
  }

  public function SubirImagenProducto(){

    $CodProducto = $this->input->post('CodProducto');

    $config['upload_path'] = "./assets/images";
    $config['allowed_types'] = 'gif|jpg|png|jpeg';
    // $config['allowed_types'] = 'jpeg';
    $config['encrypt_name'] = False;
    $config['overwrite'] = True;
    $config['file_name'] = $CodProducto;//.$data['upload_data']["file_type"];
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
      $NombreGuardarBD = $CodProducto . $data['file_ext'];
      // echo '$NombreGuardarBD: ' . $NombreGuardarBD;
      // $title= $this->input->post('title');
      // $image= $data['upload_data']['file_name'];

      //$result= $this->upload_model->save_upload($title,$image);
      //echo json_decode($result);
      // echo json_decode("Imagen cargado correctamente");
      //echo "Imagen cargado correctamente";
    }
    $Procedimiento = 'ProcProducto';
    $Parametros = $CodProducto . '|' . $NombreGuardarBD;
    $Indice = 31;

    $Resultado = $this->general_model->ProcGeneral($Procedimiento, $Parametros, $Indice);
    echo json_encode($Resultado);
  }
  public function Proveedor($Titulo){
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
    $this->load->view('/' . $Vista,$datos);
    $this->load->view('/footer');
  }
  public function Usuario($Titulo){
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
    $this->load->view('/' . $Vista,$datos);
    $this->load->view('/footer');
  }

  public function Categoria($Titulo){
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
    $this->load->view('/' . $Vista,$datos);
    $this->load->view('/footer');
  }

  public function Unidad($Titulo){
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
    $this->load->view('/' . $Vista,$datos);
    $this->load->view('/footer');
  }


  public function ProductoRubro($Titulo){
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
    $this->load->view('/' . $Vista,$datos);
    $this->load->view('/footer');
  }


  public function Marca($Titulo){
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
    $this->load->view('/' . $Vista,$datos);
    $this->load->view('/footer');
  }

  public function Prueba(){

    $this->load->view('/Registros/Prueba');
  }
}