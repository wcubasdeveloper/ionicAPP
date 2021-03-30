<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User class.
 *
 * @extends CI_Controller
 */
class Inicio extends CI_Controller {

  public function __construct() {

		parent::__construct();
	  $this->load->helper(array('url'));
    $this->load->library('session');
    /*
		$this->load->helper(array('url'));
    $this->load->model('Unidad_model');
    $this->load->model('UnidadTrack_model');*/
	}

  public function index() {

    if (!empty($this->session->userdata('username'))){
      $this->load->view('/layout_principal');
      $this->load->view('/inicio/inicio');
      //$this->load->view('/footer');
    } else {
      redirect('user/login');
    }

  }

  public function Inicio() {
    $Layout = '/' . $_SESSION['Layout'];
    //
    if (!empty($this->session->userdata('username'))){
      $this->load->view($Layout);
      $this->load->view('/Inicio/inicio');
    //$this->load->view('/footer');
    } else {
      redirect('user/login');
    }
  }
}
