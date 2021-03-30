<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');

/**
 * User class.
 *
 * @extends CI_Controllercvvmm,,mn
 */
class  Liquidacion extends CI_Controller {

  public function __construct() {

	  parent::__construct();
	  $this->load->helper(array('url'));
    $this->router->fetch_method();
    $this->load->library('session');
    //$this->load->library('excel');
    $this->load->model('general_model');
    $data = ['name' => 'generateToken','param' => ['user' => 'LATINOSAC', 'password' => '19032018@LATINO']];
  }

  
  public function importaExcel($Titulo){
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

  public function matrizProduccion($Titulo){
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

  public function produccion(){
    echo "hola";
  }
  
  public function subirArchivo(){
    //
    $this->load->library('excel');
    $fechaRegistro = "";//$this->input->get('fechaconsulta'); 
    $codigoUsuario = $_SESSION['codusuario'];
    $resultJSON = "";
    //
    if(isset($_FILES["programacionArchivo"])){
      //
      $file = $_FILES["programacionArchivo"]["tmp_name"];
      $target_dir = "filesmatriz/";
      $file = $_FILES['programacionArchivo']['name'];
      $path = pathinfo($file);
      $filename = $path['filename'];
      $ext = $path['extension'];
      $temp_name = $_FILES['programacionArchivo']['tmp_name'];
      $nuevo_nombre_archivo = "matriz_produccion_" . date("dmYHis", strtotime('-6 hours')).".".$ext;
      $path_filename_ext = $target_dir.$nuevo_nombre_archivo;
      //
      move_uploaded_file($temp_name, $path_filename_ext);
      $objReader = new PHPExcel_Reader_Excel2007();
      $objReader->setReadDataOnly(true);
      $objPHPExcel = $objReader->load($path_filename_ext);
      //
      $sheet = $objPHPExcel->getSheet(0); 
      $highestRow = $sheet->getHighestRow(); 
      $highestColumn = $sheet->getHighestColumn();
      $parametroDetalle = "";
      //
      $fechaDelExcel = $sheet->getCell("C3")->getValue();
      $arrFechaEspacio= explode(' ', $fechaDelExcel);  
      $fechaFormatoExcel = $arrFechaEspacio[1];
      //
      $arrFecha = explode('/', $fechaFormatoExcel);  
      //
      $DiaExcel = $arrFecha[0];
      $MesExcel = $arrFecha[1];
      $AnioExcel = $arrFecha[2];
      //
      $fechaFormateada =  $AnioExcel .'-'. $MesExcel . '-' . $DiaExcel;
      //
      $fechaRegistro = $fechaFormateada;

      for ($row = 7; $row <= $highestRow; $row++){ 
        if($sheet->getCell("A".$row)->getValue() != "TOTALES"){
          $fechaExcel =  $sheet->getCell("B".$row)->getFormattedValue();
          $fechaGuarda = PHPExcel_Shared_Date::ExcelToPHP( $fechaExcel );
          $fechaMysql  = date('Y-m-d', $fechaGuarda);
        
          $parametroDetalle .=  $sheet->getCell("A".$row)->getValue()."|".
                                $fechaMysql."|".
                                $sheet->getCell("C".$row)->getValue()."|".
                                $sheet->getCell("D".$row)->getValue()."|".
                                $sheet->getCell("E".$row)->getValue()."|".
                                $sheet->getCell("F".$row)->getValue()."|".
                                $sheet->getCell("G".$row)->getValue()."|".
                                $sheet->getCell("H".$row)->getValue()."|".
                                $sheet->getCell("I".$row)->getValue()."|".
                                $sheet->getCell("J".$row)->getValue()."|".
                                $sheet->getCell("K".$row)->getValue()."|".
                                $sheet->getCell("L".$row)->getValue()."|".
                                $sheet->getCell("M".$row)->getValue()."|".
                                $sheet->getCell("N".$row)->getValue()."|".
                                $sheet->getCell("O".$row)->getValue()."|".
                                $sheet->getCell("P".$row)->getValue()."|".
                                $sheet->getCell("Q".$row)->getValue()."|".
                                $sheet->getCell("R".$row)->getValue()."|".
                                $sheet->getCell("S".$row)->getValue()."|".
                                $sheet->getCell("T".$row)->getValue()."|".
                                $sheet->getCell("U".$row)->getValue()."|".
                                $sheet->getCell("V".$row)->getValue()."|".
                                $sheet->getCell("W".$row)->getValue()."|".
                                $sheet->getCell("X".$row)->getValue()."|".
                                $sheet->getCell("Y".$row)->getValue()."|".
                                $sheet->getCell("Z".$row)->getValue()."|".
                                $sheet->getCell("AA".$row)->getValue()."|".
                                $sheet->getCell("AB".$row)->getValue()."|".
                                $sheet->getCell("AC".$row)->getValue()."|".
                                $sheet->getCell("AD".$row)->getValue()."|".
                                $sheet->getCell("AE".$row)->getValue()."|".
                                $sheet->getCell("AF".$row)->getValue()."|".
                                $sheet->getCell("AG".$row)->getValue()."|".
                                $sheet->getCell("AH".$row)->getValue()."|".
                                $sheet->getCell("AI".$row)->getValue()."|".
                                $sheet->getCell("AJ".$row)->getValue()."|".
                                $sheet->getCell("AK".$row)->getValue()."|".
                                $sheet->getCell("AL".$row)->getValue()."|".
                                $sheet->getCell("AM".$row)->getValue()."|".
                                $sheet->getCell("AN".$row)->getValue()."|".
                                $sheet->getCell("AO".$row)->getValue()."|".
                                $sheet->getCell("AP".$row)->getValue()."|".
                                $sheet->getCell("AQ".$row)->getValue()."|".
                                $sheet->getCell("AR".$row)->getValue()."|".
                                $sheet->getCell("AS".$row)->getValue()."|".
                                $sheet->getCell("AT".$row)->getValue()."|".
                                $sheet->getCell("AU".$row)->getValue()."|".
                                $sheet->getCell("AV".$row)->getValue()."|".
                                $sheet->getCell("AW".$row)->getValue()."|".
                                $sheet->getCell("AX".$row)->getValue()."|".
                                $sheet->getCell("AY".$row)->getValue()."|".
                                $sheet->getCell("AZ".$row)->getValue()."|".
                                $sheet->getCell("BA".$row)->getValue()."|".
                                $sheet->getCell("BB".$row)->getValue()."|".
                                $sheet->getCell("BC".$row)->getValue()."|".
                                $sheet->getCell("BD".$row)->getValue()."|".
                                $sheet->getCell("BE".$row)->getValue()."|".
                                $sheet->getCell("BF".$row)->getValue()."|".
                                $sheet->getCell("BG".$row)->getValue()."|".
                                $sheet->getCell("BH".$row)->getValue()."|".
                                $sheet->getCell("BI".$row)->getValue()."~";
        }
      }
      
      $resultado = $this->general_model->ProcGuardaExcelTran("ProcExcelImporta", $fechaRegistro.'|'.$codigoUsuario.'|'.$nuevo_nombre_archivo, $parametroDetalle , $fechaRegistro, $codigoUsuario, 20);
      $resultJSON =  json_encode($resultado);

    }else{
      $resultJSON =  '{"CodResultado":"0","DesResultado":"Ocurrió un error al cargar el archivo.","CodAuxiliar":"0"}';
     
    }

      echo $resultJSON;
  }


}
