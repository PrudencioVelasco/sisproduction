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
        $this->load->model('salida_model', 'salida');
        $this->load->library('permission');
        $this->load->library('session');
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
    
    public function searchOrden() {
        Permission::grant(uri_string());
        $value = $this->input->post('text');
        $query = $this->orden->searchOrden($value);
        if ($query) {
            $result['salidas'] = $query;
        }

        echo json_encode($result);
    }
    
    public function marcar($idpalletcajas,$idsalida){
              Permission::grant(uri_string());     
                  $dataupdate = array(
                        'salida' => 1
                    );

                    $this->orden->updateEstatusPosicion($dataupdate, $idpalletcajas);
        
        redirect('orden/detalle/'.$idsalida);
    }

    public function detalle($idsalida) {
        Permission::grant(uri_string());
       $datadetallesalida = $this->salida->detalleSalida($idsalida);
        $datadetalleorden = $this->salida->detallesDeOrdenPallet($idsalida);
        $datadetalleordenpar = $this->salida->detallesDeOrdenParciales($idsalida);
        //var_dump($datadetalleordenpar);
        $detallepallet = $this->salida->detallepallet($idsalida);
        $detalleparciales = $this->salida->detalleparciales($idsalida); 
        $data = array(
            'detallesalida' => $datadetallesalida,
            'detalleorden' => $datadetalleorden,
            'detalleordenparciales' => $datadetalleordenpar,
            'idsalida' => $idsalida,
            'detallepallet' => $detallepallet,
            'detalleparciales' => $detalleparciales);

        $this->load->view('header');
        $this->load->view('orden/detalle', $data);
        $this->load->view('footer');
    }

    public function test()
    {
        # code...
         $data = $this->orden->listaDeNumeroParteSalida('MAY69380803', $idsalida, $idpalletcajas,'160');
    }
   
   
    public function validar() {
        Permission::grant(uri_string());
        $numeroparte = trim($_POST['codigo']);
        $cantidad = preg_replace('/\D/', '', trim($_POST['cantidad']));
        $idpalletcajas = $_POST["idpalletcajas"];
        $idsalida = $_POST["idsalida"];
        $data = $this->orden->listaDeNumeroParteSalida($numeroparte, $idsalida, $idpalletcajas,$cantidad);

        if ($data != FALSE) {
            $dataupdate = array(
                'salida' => 1
            );

            $this->orden->updateEstatusPosicion($dataupdate, $idpalletcajas);
            echo 1;
        } else {
            //Ya se lleno  la orden, y todavia sigue escaneando
            echo 0;
        }
    }

}

?>