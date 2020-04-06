<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Hold extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!isset($_SESSION['user_id'])) {
            $this->session->set_flashdata('flash_data', 'You don\'t have access! ss');
            return redirect('Login');
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
        $this->load->library('permission');
        $this->load->library('session');
    }

    public function index() {
        Permission::grant(uri_string());
        $data['datatransferencia'] = $this->hold->listaNumeroParteTransferencia();

        $this->load->view('header');
        $this->load->view('hold/index',$data);
        $this->load->view('footer');
    }
    public function detalle($idpalletcajas) {
        Permission::grant(uri_string());
        $detalle = $this->hold->selectCantidades($idpalletcajas);
        $cantidad = $detalle->cantidad;

        $data['informacion'] = $this->hold->detalleParteTransferencia($idpalletcajas);
        $data['cantidades'] = $this->hold->listaCantidades($idpalletcajas,$cantidad);
        //var_dump($this->hold->detalleParteTransferencia($idpalletcajas));
        $this->load->view('header');
        $this->load->view('hold/detalle', $data);
        $this->load->view('footer');
    }
    public function sendAllQuality(){
        Permission::grant(uri_string());
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
//Permission::grant(uri_string());
$config = array(
            array(
                'field' => 'ccajas',
                'label' => 'ccajas',
                'rules' => 'trim|required|is_natural',
                'errors' => array(
                    'required' => 'La cantidad de cajas es campo Obligatorio',
                    'is_natural'=> 'Solo número positivo.'
                )
            )
        );
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE){

            $errors = validation_errors();

            echo json_encode(['error'=>$errors]);


        }else{
        $cantidadcajas = $this->input->post('cantidadcajas');
        $nueva_cantidadcajas = $this->input->post('ccajas');
        if($nueva_cantidadcajas < $cantidadcajas){
        $idpalletcajas = $this->input->post('idpalletcajas');
        //$idcantidad = $this->input->post('idnuevacantidad');
        //$idcajas = $this->input->post('idcajas');
        //$cantidad = $this->input->post('cantidad');
        $idtransferencia = $this->input->post('idtransferencia');
        $idrevision = $this->input->post('idrevision');
        //$pallet = $this->input->post('pallet');
        $idusuario = $_SESSION['user_id'];
        $datava = $this->hold->validadCantidadCajas($idrevision,$nueva_cantidadcajas);
        if($datava != FALSE){

        $data = array(
            'idcajas' => $datava->idcantidad,
            'idestatus' => 1,
        );

        $result = $this->hold->updateSendQuality($idpalletcajas,$data);
    }else{
        $data = array(
            'idrevision'=>$idrevision,
            'cantidad'=>$nueva_cantidadcajas,
            'idusuario'=> $idusuario,
            'fecharegistro' => date('Y-m-d H:i:s')
        );
        $nueva_idcantidad = $this->hold->addCantidad($data);

        $data = array(
            'idcajas' => $nueva_idcantidad,
            'idestatus' => 1,
        );

        $result = $this->hold->updateSendQuality($idpalletcajas,$data);
    }

        if ($result) {
            //$resultQuantity = $this->hold->selectCantidades($idcantidad);

            $cantidadHold = $nueva_cantidadcajas - $cantidadcajas;

            $dataTrash = array(
                'idpalletcajas' => $idpalletcajas,
                'idtransferencia' => $idtransferencia,
                'pallet' => 1,
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
       // echo json_encode(['success'=>'Se modifico la información con Exito']);

    }else{
          echo json_encode(['error'=>'La cantidad de cajas debe de ser menor.']);
    }
}

    }

    public function sendTrash(){
Permission::grant(uri_string());
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
        Permission::grant(uri_string());
        $id = $this->input->post('id');
        $result = $this->hold->selectCantidades($id);
        echo $result->cantidad;
    }
}

?>
