<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Hold extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!isset($_SESSION['user_id'])) {
            $this->session->set_flashdata('flash_data', 'You don\'t have access! ss');
            return redirect('login');
        }
        $this->load->helper('url');
        $this->load->model('almacen_model', 'almacen');
        $this->load->model('linea_model', 'linea');
        $this->load->model('transferencia_model', 'transferencia');
        $this->load->model('revision_model', 'revision');
        $this->load->model('modelo_model', 'modelo');
        $this->load->model('calidadp_model', 'calidadp');
        $this->load->model('calidad_model', 'calidad');
        $this->load->model('hold_model', 'hold');
        $this->load->model('palletcajasproceso_model', 'palletcajasproceso');
        //$this->load->library('permission');
    }

    public function index() {
        //Permission::grant(uri_string());
        $data['datatransferencia'] = $this->hold->listaNumeroParteTransferencia();

        $this->load->view('header');
        $this->load->view('hold/index',$data);
        $this->load->view('footer');
    }
    public function detalle($idpalletcajas) {

        $data['informacion'] = $this->hold->detalleParteTransferencia($idpalletcajas);
        $data['cantidades'] = $this->hold->selectCantidades($idpalletcajas);

        $this->load->view('header');
        $this->load->view('hold/detalle', $data);
        $this->load->view('footer');
    }
    public function sendAllQuality(){
        $idpalletcajas = $this->input->post('idpalletcajas');
        $data = array(
            'idestatus' => 1
        );

        $result = $this->hold->updateSendQuality($idpalletcajas,$data);

        if ($result) {
            echo $result;
        }
    }
    public function sendQuality(){

        $idpalletcajas = $this->input->post('idpalletcajas');
        $idcantidad = $this->input->post('idnuevacantidad');
        $cantidad = $this->input->post('cantidad');
        $idtransferencia = $this->input->post('idtransferencia');
        $pallet = $this->input->post('pallet');
        $idusuario = $_SESSION['user_id'];

        $data = array(
            'idcajas' => $idcantidad, 
            'idestatus' => 1,
        );

        $result = $this->hold->updateSendQuality($idpalletcajas,$data);

        if ($result) {
            $resultQuantity = $this->hold->selectCantidades($idcantidad);

            $cantidadHold = $cantidad - $resultQuantity[0]->cantidad;

            $dataTrash = array(
                'idpalletcajas' => $idpalletcajas, 
                'idtransferencia' => $idtransferencia,
                'pallet' => $pallet,
                'cajas' => $cantidadHold,
                'idstatus' => 12,
                'idusuario'=> $idusuario,
                'fecha' => date('Y-m-d H:i:s')
            );

            $resultTrash = $this->hold->saveDataTblTrash($dataTrash);
            if ($result) {
                echo $resultTrash;
            }
        }

    }

    public function sendTrash(){

        $idpalletcajas = $this->input->post('idpalletcajas');
        $cantidad = $this->input->post('cantidad');
        $idtransferencia = $this->input->post('idtransferencia');
        $pallet = $this->input->post('pallet');
        $idusuario = $_SESSION['user_id'];

        $dataPallet = array(
            'idestatus' => 13
        );

        $resultUpdate = $this->hold->updatePallet($idpalletcajas,$dataPallet);

        if ($resultUpdate) {
            $dataTrash = array(
                'idpalletcajas' => $idpalletcajas, 
                'idtransferencia' => $idtransferencia,
                'pallet' => $pallet,
                'cajas' => $cantidad,
                'idstatus' => 12,
                'idusuario'=> $idusuario,
                'fecha' => date('Y-m-d H:i:s')
            );

            $resultTrash = $this->hold->saveDataTblTrash($dataTrash);
            if ($resultTrash) {
                echo $resultTrash;
            }   
        }
    }

    public function validQuantity(){
        $id = $this->input->post('id');
        $result = $this->hold->selectCantidades($id);
        echo $result[0]->cantidad;
    }
}

?>
