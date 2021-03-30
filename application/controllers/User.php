<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User class.
 *
 * @extends CI_Controller
 */
class User extends CI_Controller {
  /**
   * __construct function.
   *
   * @access public
   * @return void
   */
  public function __construct() {
    parent::__construct();
    $this->load->library('session');
    //$this->load->library(array('session'));
    $this->load->helper(array('url'));
    $this->load->model('user_model');
    $this->load->model('cliente_model');
    $this->load->model('General_model');
    $this->load->library('email');

  }

  public function login() {
  //$data["contenido"] = "About My Website.......";
    $this->load->helper('form');

    if (!empty($this->session->userdata('username'))){
      redirect($this->config->base_url().'Inicio/Inicio');
    } else{
      $this->load->view('/header');
      $this->load->view('/user/login/login.php');
    }
  }

  
  public function ingresar() {
    $this->load->helper('form');
    $username = $this->input->post('usuario');
    $password = $this->input->post('password');
    $data = new stdClass();
    $parametros = $username."|".$password;
    $indice = 11;
    $resultado = $this->user_model->procUsuarios($parametros,$indice);
    $codResultado = (int)array_values($resultado)[0];
    $desResultado = (string)array_values($resultado)[1];
    $codauxiliar = '';
    $CodCajaGestionActual = '';
    $Layout = '';
    $CodPersona = '';

    if ($codResultado == 1) {							// user login ok
      $codauxiliar =	(string)array_values($resultado)[2];
      $CodCajaGestionActual =	(string)array_values($resultado)[3];
      $Layout =	(string)array_values($resultado)[5];
      $CodPersona =	(string)array_values($resultado)[6];
      $UltimaVista =	(string)array_values($resultado)[7];
      $CodUsuarioTipo =	(string)array_values($resultado)[8];
      $AbrevEmpresa =	(string)array_values($resultado)[9];
      $NombreTienda =	(string)array_values($resultado)[10];
      $NombreAlmacen =	(string)array_values($resultado)[11];
      $VendedorUsuarioPedido =	array_values($resultado)[12];
      // $codauxiliar =	(string)array_values($resultado)[2];
            //$_SESSION['username']     = $username;
      $this->session->set_userdata(array(
        'user_id'  => $username,
        'username' => $username,
        'codusuario' => $codauxiliar,
        'CodCajaGestionActual' => $CodCajaGestionActual,
        'Layout' => $Layout,
        'CodPersona' => $CodPersona,
        'UltimaVista' => $UltimaVista,
        'CodUsuarioTipo' => $CodUsuarioTipo,
        'AbrevEmpresa' => $AbrevEmpresa,
        'NombreTienda'=> $NombreTienda,
        'NombreAlmacen' => $NombreAlmacen,
        'MenuHTML' => '',
        'VendedorUsuarioPedido' => $VendedorUsuarioPedido
        // 'groupid'  => $user->groupid,
        // 'date'     => $user->date_cr,
        // 'serial'   => $user->serial,
        // 'rec_id'   => $user->rec_id,
        // 'status'   => TRUE
      ));
      
  //     var_dump("la sesion");

      $_SESSION['username'] =  $username;


      /** Carga Menu por Tipo */
      $Procedimiento = 'ProcMenu';
      $Parametros = $CodUsuarioTipo;
      $Indice = 11;
      //
      $this->db->reconnect();
      $Resultado = $this->General_model->ProcGeneral2($Procedimiento, $Parametros, $Indice);
      //
      $_SESSION['MenuHTML'] = $this->AgregarMenu($Resultado);

      /** Fin Menu */
      //var_dump($this->config->base_url() . $UltimaVista);
      //exit();

      redirect($this->config->base_url() . $UltimaVista);
      /*
      $this->load->view('layout_principal');
      $this->load->view('Mapa/index',$data);
      $this->load->view('footer');*/
    } else {

      // $Procedimiento = 'ProcMenu';
      // $Parametros = 1;
      // $Indice = 10;
      // $this->db->reconnect();
      // $Data = $this->General_model->ProcGeneral2($Procedimiento, $Parametros, $Indice);
      // //
      
      // echo $this->AgregarMenu($Data);

      
      // return;
      $data->error = $desResultado;
      $this->load->view('/header');
      $this->load->view('/user/login/login', $data);
    }

  }
  public function AgregarMenu($Data) {
    $HTMLMenu = '<ul class="nav navbar-nav">';
    foreach($Data as $Fila) {
      if ($Fila['CodMenu'] == $Fila['CodMenuPadre']) {
        // Padres de si mismo
        $HTMLMenu .= "<li class=\"dropdown\"><a aria-expanded=\"false\" role=\"button\" href='" . base_url() . "{$Fila['URLMenu']}' class=\"dropdown-toggle\" data-toggle=\"dropdown\">{$Fila['NomMenu']} <span class=\"caret\"></span></a>";
        //
        $HTMLMenu .= '<ul role="menu" class="dropdown-menu">';
        //
        $HTMLMenu .= $this->AgregarSubMenu($Data, $Fila['CodMenu']);
        $HTMLMenu .= '</ul>';

        $HTMLMenu .= '</li>';
      }
    }
    $HTMLMenu .= '</ul>';
    return $HTMLMenu;
  }
  public function AgregarSubMenu($Data, $CodMenuPadre) {
    $HTMLMenu = '';
    foreach($Data as $Fila) {
      //
      if (($Fila['CodMenuPadre'] == $CodMenuPadre) && ($Fila['CodMenu'] != $Fila['CodMenuPadre'])) {
        $HTMLMenu .= "<li><a href='" . base_url() . "{$Fila['URLMenu']}" . "/" . $Fila['Titulo'] . "'>{$Fila['NomMenu']}</a>";
        //
        $HTMLMenu .= '<ul role="menu" class="dropdown-menu">';
        //
        $HTMLMenu .= $this->AgregarSubMenu($Data, $Fila['CodMenu']);
        $HTMLMenu .= '</ul>';
        $HTMLMenu .= '</li>';
      }
    }
    return $HTMLMenu;
  }

  /**
   * logout function.
   *
   * @access public
   * @return void
   */
  public function logout() {

    $user_data = $this->session->all_userdata();
    foreach ($user_data as $key => $value) {
      if ($key != 'user_id' && $key != 'username') {
        $this->session->unset_userdata($key);
      }
    }
    $this->session->sess_destroy();
    redirect('/');
  }

}