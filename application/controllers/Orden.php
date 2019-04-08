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
                   
                  $dataupdate = array(
                        'salida' => 1
                    );

                    $this->orden->updateEstatusPosicion($dataupdate, $idpalletcajas);
        
        redirect('orden/detalle/'.$idsalida);
    }

    public function detalle($idsalida) {
        $datadetallesalida = $this->orden->detalleSalida($idsalida);
        $datadetalleorden = $this->orden->detallesDeOrden($idsalida);
        $datadetalleordenparciales = $this->orden->detallesDeOrdenParciales($idsalida);
        $detallepallet = $this->salida->detallepallet($idsalida);
        $detalleparciales = $this->salida->detalleparciales($idsalida);
        //var_dump($datadetalleordenparciales);
        $data = array(
            'detallesalida' => $datadetallesalida,
            'detalleorden' => $datadetalleorden,
            'detalleordenparciales'=>$datadetalleordenparciales,
            'idsalida' => $idsalida,
            'detallepallet' => $detallepallet,
            'detalleparciales' => $detalleparciales);

        $this->load->view('header');
        $this->load->view('orden/detalle', $data);
        $this->load->view('footer');
    }
   
    public function validar() {
        $item = $_POST['item'];
        $idsalida = $_POST["idsalida"];
        $porciones = explode("_", $item);
        $numeroparte = (isset($porciones[0])) ? $porciones[0] : 0;
        $folio = (isset($porciones[1])) ? $porciones[1] : 0;

        if (isset($numeroparte) && !empty($numeroparte) && isset($folio) && !empty($folio)) {

            if ($this->orden->validarOrdenSalida($idsalida) != FALSE) {

                $data = $this->orden->listaDeNumeroParteSalida(0, $folio,$idsalida);
                foreach ($data as $value) {
                    $idpalletcajas = $value->idpalletcajas;
                    $dataupdate = array(
                        'salida' => 1
                    );

                    $this->orden->updateEstatusPosicion($dataupdate, $idpalletcajas);
                    echo 2;
                }
            } else {
                //Ya se lleno  la orden, y todavia sigue escaneando
                echo 1;
            }
        } else {
            //0 el formato del codigo escaneado esta incorrecto.
            echo 0;
        }
    }

}

?>