<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Orden extends CI_Controller {

    function __construct() {
        parent::__construct();

        if (!isset($_SESSION['user_id'])) {
            $this->session->set_flashdata('flash_data', 'You don\'t have access! ss');
            return redirect('login');
        }
        $this->load->helper('url');
        $this->load->model('data_model');
        $this->load->model('client_model', 'client');
        $this->load->model('orden_model', 'orden');
        $this->load->library('permission');
    }

    public function index() {
        Permission::grant(uri_string());
        $this->load->view('header');
        $this->load->view('orden/index');
        $this->load->view('footer');
    }

    public function showAll() {
        Permission::grant(uri_string());
        $query = $this->orden->showAllSalidas();
        if ($query) {
            $result['salidas'] = $this->orden->showAllSalidas();
        }
        echo json_encode($result);

        // code...
    }

    public function detalle($idsalida) {
        $datadetallesalida = $this->orden->detalleSalida($idsalida);
        $datadetalleorden = $this->orden->detallesDeOrden($idsalida);
        //var_dump($datadetalleorden);
        $data = array(
            'detallesalida' => $datadetallesalida,
            'detalleorden' => $datadetalleorden,
            'idsalida' => $idsalida);

        $this->load->view('header');
        $this->load->view('orden/detalle', $data);
        $this->load->view('footer');
    }
    public function test(){
        $data = $this->orden->listaDeNumeroParteSalida(0,63);
        $i = 1;
        foreach($data as $value){
            if( $i <=1 ){

            }
            $i++;
        }
        
        var_dump($data);
        echo "<br>";
        $datae = $this->orden->validarOrdenSalida(2);
        var_dump($datae);
    }
    public function validar() {
        $item = $_POST['item'];
        $idsalida = $_POST["idsalida"];
        $porciones = explode("_", $item);
        $numeroparte =(isset($porciones[0])) ? 1 : 0;  
        $folio = (isset($porciones[1])) ? 1 : 0;  
        
        if(isset($numeroparte) && !empty($numeroparte) && isset($folio) && !empty($folio)){
            
            if($this->orden->validarOrdenSalida($idsalida) != FALSE){
                
                 $data = $this->orden->listaDeNumeroParteSalida(0,$folio);
                 foreach($data as $value){
                     $idpalletcajas = $value->idpalletcajas;
                     $dataupdate = array(
                         'salida'=>1
                     );
                     
                     $this->orden->updateEstatusPosicion($dataupdate,$idpalletcajas);
                }

            }else{
                //Ya se lleno  la orden, y todavia sigue escaneando
                echo 1;
            }
            
            
        }else{
            //0 el formato del codigo escaneado esta incorrecto.
            echo 0;
        }
        
    }
}

?>