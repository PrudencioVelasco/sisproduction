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
       $datadetallesalida = $this->salida->detalleSalida($idsalida);
        $datadetalleorden = $this->salida->detallesDeOrden($idsalida);
        $detallepallet = $this->salida->detallepallet($idsalida);
        $detalleparciales = $this->salida->detalleparciales($idsalida);
        $datos=$this->test1($idsalida);  
        $data = array(
            'detallesalida' => $datadetallesalida,
            'detalleorden' => $datadetalleorden,
            'idsalida' => $idsalida,
            'detallepallet' => $detallepallet,
            'detalleparciales' => $detalleparciales,
            'datosparte'=>$datos);

        $this->load->view('header');
        $this->load->view('orden/detalle', $data);
        $this->load->view('footer');
    }
    public function test1($idsalida) {

        
        $detalle = $this->salida->detalleSalida($idsalida);
        $idcliente = $detalle->idcliente;
        $query = $this->salida->showPartesBodega2($idcliente); 
        $array = array();
        $i = 0;
        if($query != false){
        foreach ($query as $row) {
            if ($row->totalcajasdisponibles > 0) {
                if ($row->cajassalidasporparciales > 0 && $row->totalpalletparacomparar > 1) {
                    //Si hay cajas salidas por parcilas
                    $array[$i] = array();
                    $array[$i]['idtransferancia'] = $row->idtransferancia;
                    $array[$i]['iddetalleparte'] = $row->iddetalleparte;
                    $array[$i]['numeroparte'] = $row->numeroparte;
                    $array[$i]['folio'] = $row->folio;
                    $array[$i]['modelo'] = $row->modelo;
                    $array[$i]['revision'] = $row->revision;
                    $array[$i]['idcajas'] = $row->idcajas;
                    //$array[$i]['linea'] = $row->linea;
                    $array[$i]['fecha'] = $row->fecha;
                    $array[$i]['nombre'] = $row->nombre;
                    $array[$i]['totalpallet'] = $row->totalpalletparacomparar;
                    $array[$i]['cajasporpallet'] = $row->cajasporpallet;
                    $array[$i]['totalcajas'] = $row->totalcajas;
                    $array[$i]['cajassalidas'] = $row->totalcajassalidas;
                    $array[$i]['test'] = 0;
                    $array[$i]['cajasdisponibles'] = $row->totalcajasdisponibles;
                    $i++;
                } else {
                    //Si son puros pallet
                    $array[$i] = array();
                    $array[$i]['idtransferancia'] = $row->idtransferancia;
                    $array[$i]['iddetalleparte'] = $row->iddetalleparte;
                    $array[$i]['numeroparte'] = $row->numeroparte;
                    $array[$i]['folio'] = $row->folio;
                    $array[$i]['modelo'] = $row->modelo;
                    $array[$i]['revision'] = $row->revision;
                    $array[$i]['idcajas'] = $row->idcajas;
                    //$array[$i]['linea'] = $row->linea;
                    $array[$i]['fecha'] = $row->fecha;
                    $array[$i]['nombre'] = $row->nombre;
                    $array[$i]['totalpallet'] = $row->totalpalletparacomparar;
                    $array[$i]['cajasporpallet'] = $row->cajasporpallet;
                    $array[$i]['totalcajas'] = $row->totalcajas;
                    $array[$i]['cajassalidas'] = $row->totalcajassalidas;
                    $array[$i]['test'] = 0;
                    $array[$i]['cajasdisponibles'] = $row->totalcajasdisponibles;
                    $i++;
                }
            }
        }
    }
        return $array;
    }
    public function validar() {
        $item = $_POST['item'];
        $idsalida = $_POST["idsalida"];
        $porciones = explode("_", $item);
        $numeroparte = (isset($porciones[0])) ? $porciones[0] : 0;
        $detalle = $this->orden->detallePallet((isset($porciones[1])) ? $porciones[1] : 0);
        $folio =$detalle->folio;
        $cajas = $detalle->cajas;

        if (isset($numeroparte) && !empty($numeroparte) && isset($folio) && !empty($folio)) {

            if ($this->orden->validarOrdenSalida($idsalida) != FALSE) {

                $data = $this->orden->listaDeNumeroParteSalida(0, $folio,$idsalida,$cajas);
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