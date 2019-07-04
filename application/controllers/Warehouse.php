<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Warehouse extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!isset($_SESSION['user_id'])) {
            $this->session->set_flashdata('flash_data', 'You don\'t have access! ss');
            return redirect('login');
        }
        $this->load->helper('url');

        $this->load->model('warehouse_model', 'almacen');
    }

    public function index() {
        //Permission::grant(uri_string());
        //$data['datatransferencia'] = $this->hold->listaNumeroParteTransferencia();

        $this->load->view('header');
        $this->load->view('warehouse/index');
        $this->load->view('footer');
    }

    public function entry() {
        //Permission::grant(uri_string());
        $first_date = $this->input->post('fechainicio');
        $second_date = $this->input->post('fechafin');
        
        $data['entries'] = $this->almacen->getDataEntry($first_date,$second_date);

        $this->load->view('header');
        $this->load->view('warehouse/entry',$data);
        $this->load->view('footer');
    }

    public function exitWareHouse() {
        //Permission::grant(uri_string());
        $first_date = $this->input->post('fechainicio');
        $second_date = $this->input->post('fechafin');
        $tipo = $this->input->post('tipo');

        $exits = $this->almacen->getDataExits($first_date,$second_date,$tipo);

        $render = "";
        $render .='<table id="datatableexit" class="table">
        <thead>
        <tr>
        <th scope="col">No. Salida</th>
        <th scope="col">Cliente</th>
        <th scope="col">No. Parte</th>
        <th scope="col">Revision</th>
        <th scope="col">Cantidad</th>
        <th scope="col">Posicion</th>';
        if ($tipo == '1') {
            $render .='<th scope="col">Cajas</th>';
        }
        $render .='</tr>';
        $render .='</thead>';
        $render .='<tbody>';
        if (isset($exits) && !empty($exits)){
            foreach ($exits as $value){
                $render .='<tr>';
                $render .='<td>'.$value->numerosalida .'</td>';
                $render .='<td>'. $value->nombre .'</td>';
                $render .='<td>'. $value->numeroparte .'</td>';
                $render .='<td>'.$value->descripcion .'</td>';
                $render .='<td>'.$value->cantidad .'</td>';
                $render .='<td>'.$value->nombreposicion .'</td>';
                if ($tipo == '1') {
                    $render .='<td>'.$value->caja .'</td>';
                }
                $render .='</tr>';
            }
        } 
        $render .= '</tbody>
        </table>';
        $data['exits'] = $render;

        $this->load->view('header');
        $this->load->view('warehouse/exit',$data);
        $this->load->view('footer');
    }

    public function wharehouse() {
    //Permission::grant(uri_string());
        $data['informacion'] = $this->almacen->getDataPallets();

        $this->load->view('header');
        $this->load->view('warehouse/warehouse',$data);
        $this->load->view('footer');
    }

    public function detalle($idpalletcajas) {

        $data['informacion'] = $this->hold->detalleParteTransferencia($idpalletcajas);
        $data['cantidades'] = $this->hold->selectCantidades();

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
