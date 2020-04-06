<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Warehouse extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!isset($_SESSION['user_id'])) {
            $this->session->set_flashdata('flash_data', 'You don\'t have access! ss');
            return redirect('Login');
        }
        $this->load->helper('url');
        $this->load->library('permission');
        $this->load->library('session');
        $this->load->model('warehouse_model', 'almacen');
        $this->load->model('categorias_model', 'categorias');
         $this->load->model('lamina_model', 'lamina');
         $this->load->model('litho_model', 'litho');
    }

    public function index() {
        Permission::grant(uri_string());

        $this->load->view('header');
        $this->load->view('warehouse/index');
        $this->load->view('footer');
    }

    public function entry() {
        //Permission::grant(uri_string());
        $first_date = $this->input->post('fechainicio');
        $second_date = $this->input->post('fechafin');
        $categoria = $this->input->post('categoria');
        $parte = $this->input->post('parte');
        //$data['entries'] = $this->almacen->getDataEntry($first_date, $second_date);
        $datos = array(
            'entries' => $this->almacen->getDataEntry($first_date, $second_date, $categoria, $parte),
            'categorias' => $this->categorias->showAll()
        );
        $this->load->view('header');
        $this->load->view('warehouse/entry', $datos);
        $this->load->view('footer');
    }

    public function historial($id) {
      //  Permission::grant(uri_string());

        $data['entradas'] = $this->almacen->getDataEntradas($id);
        $data['salidasparciales'] = $this->almacen->getDataSalidaParcial($id);
        $data['salidaspallet'] = $this->almacen->getDataSalidaPallet($id);

        $this->load->view('header');
        $this->load->view('warehouse/detalle', $data);
        $this->load->view('footer');
    }

    public function historialposicion($idposicionbodega) {
       // Permission::grant(uri_string());

        $data['entradas'] = $this->almacen->getDataEntradasPosicion($idposicionbodega);
        $data['salidasparciales'] = $this->almacen->getDataSalidaParcialPosicion($idposicionbodega);
        $data['salidaspallet'] = $this->almacen->getDataSalidaPalletPosicion($idposicionbodega);

        $this->load->view('header');
        $this->load->view('warehouse/detalleposicion', $data);
        $this->load->view('footer');
    }

    public function exitWareHouse() {
       // Permission::grant(uri_string());
        $first_date = $this->input->post('fechainicio');
        $second_date = $this->input->post('fechafin');
        $tipo = $this->input->post('tipo');
        $categoria = $this->input->post('categoria');
        $parte = $this->input->post('parte');
        $salida = $this->input->post('salida');
        $exits = $this->almacen->getDataExits($first_date, $second_date, $tipo,$categoria,$parte,$salida);

        $render = "";
        $render .= '<table id="datatableexit" class="table">
        <thead>
        <tr>
        <th scope="col">No. Salida</th>
        <th scope="col">Cliente</th>
        <th scope="col">No. Parte</th>
        <th scope="col">Categoria</th>
        <th scope="col">Revisión</th>
        <th scope="col">CxP</th>
        <th scope="col">Pallet</th>
        <th scope="col">Cajas</th>
        <th scope="col">Tipo</th>
        <th scope="col">Fecha</th>';
        $render .= '</tr>';
        $render .= '</thead>';
        $render .= '<tbody>';
        if (isset($exits) && !empty($exits)) {
            foreach ($exits as $value) {
                $render .= '<tr>';
                $render .= '<td>' . $value->numerosalida . '</td>';
                $render .= '<td>' . $value->nombre . '</td>';
                $render .= '<td>' . $value->numeroparte . '</td>';
                $render .= '<td>' . $value->nombrecategoria . '</td>';
                $render .= '<td>' . $value->descripcion . '</td>';
              if($value->tipo == 0){
                      $render .= '<td style="color:red;">' . number_format( $value->cantidadxpallet) . '</td>';
                }else{
                      $render .= '<td style="color:red;"><strong>---</strong></td>';
                }

                if ($value->tipo == 0) {
                    $render .= '<td style="color:red;"><strong>' . number_format($value->totalpallet) . '</strong></td>';
                    $render .= '<td style="color:red;"><strong>' . number_format($value->totalcajaspallet) . '</strong></td>';
                }
                if ($value->tipo == 1) {
                    $render .= '<td style="color:red;"><strong>1</strong></td>';
                    $render .= '<td style="color:red;"><strong>' . number_format($value->totalcajasparciales) . '</strong></td>';
                }
                if($value->tipo == 0){
                      $render .= '<td><strong style="color:green;">PALLET</strong></td>';
                }else{
                      $render .= '<td><strong style="color:blue;">PARCIALES</strong></td>';
                }
                 $render .= '<td>' . $value->fecha . '</td>';
                $render .= '</tr>';
            }
        }
        $render .= '</tbody>
        </table>';

        $datos = array(
            'exits'=>$render,
            'categorias' => $this->categorias->showAll()
        );

        $this->load->view('header');
        $this->load->view('warehouse/exit', $datos);
        $this->load->view('footer');
    }

    public function wharehouse() {
       // Permission::grant(uri_string());
        $data['informacion'] = $this->almacen->getDataPallets();
        $data['posiciones'] = $this->almacen->getDataPalletsPosicion();
       // $data['laminas'] = $this->lamina->showAllLaminas();
       // $data['lithos'] = $this->litho->showAllLitho();

        $this->load->view('header');
        $this->load->view('warehouse/warehouse', $data);
        $this->load->view('footer');
    }

    public function detalle($idpalletcajas) {
      //  Permission::grant(uri_string());
        $data['informacion'] = $this->hold->detalleParteTransferencia($idpalletcajas);
        $data['cantidades'] = $this->hold->selectCantidades();

        $this->load->view('header');
        $this->load->view('hold/detalle', $data);
        $this->load->view('footer');
    }

    public function sendAllQuality() {
       // Permission::grant(uri_string());
        $idpalletcajas = $this->input->post('idpalletcajas');
        $data = array(
            'idestatus' => 1
        );

        $result = $this->hold->updateSendQuality($idpalletcajas, $data);

        if ($result) {
            echo $result;
        }
    }

    public function sendQuality() {
        //Permission::grant(uri_string());
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

        $result = $this->hold->updateSendQuality($idpalletcajas, $data);

        if ($result) {
            $resultQuantity = $this->hold->selectCantidades($idcantidad);

            $cantidadHold = $cantidad - $resultQuantity[0]->cantidad;

            $dataTrash = array(
                'idpalletcajas' => $idpalletcajas,
                'idtransferencia' => $idtransferencia,
                'pallet' => $pallet,
                'cajas' => $cantidadHold,
                'idstatus' => 12,
                'idusuario' => $idusuario,
                'fecha' => date('Y-m-d H:i:s')
            );

            $resultTrash = $this->hold->saveDataTblTrash($dataTrash);
            if ($result) {
                echo $resultTrash;
            }
        }
    }

    public function sendTrash() {
        //Permission::grant(uri_string());
        $idpalletcajas = $this->input->post('idpalletcajas');
        $cantidad = $this->input->post('cantidad');
        $idtransferencia = $this->input->post('idtransferencia');
        $pallet = $this->input->post('pallet');
        $idusuario = $_SESSION['user_id'];

        $dataPallet = array(
            'idestatus' => 13
        );

        $resultUpdate = $this->hold->updatePallet($idpalletcajas, $dataPallet);

        if ($resultUpdate) {
            $dataTrash = array(
                'idpalletcajas' => $idpalletcajas,
                'idtransferencia' => $idtransferencia,
                'pallet' => $pallet,
                'cajas' => $cantidad,
                'idstatus' => 12,
                'idusuario' => $idusuario,
                'fecha' => date('Y-m-d H:i:s')
            );

            $resultTrash = $this->hold->saveDataTblTrash($dataTrash);
            if ($resultTrash) {
                echo $resultTrash;
            }
        }
    }

    public function validQuantity() {
        $id = $this->input->post('id');
        $result = $this->hold->selectCantidades($id);
        echo $result[0]->cantidad;
    }

}

?>
