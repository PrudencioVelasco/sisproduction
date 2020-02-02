<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Devolucion extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!isset($_SESSION['user_id'])) {
            $this->session->set_flashdata('flash_data', 'You don\'t have access! ss');
            return redirect('login');
        }
        $this->load->helper('url');
        $this->load->model('almacen_model', 'almacen');
        $this->load->model('linea_model', 'linea');
        $this->load->model('cantidad_model', 'cantidad');
        $this->load->model('transferencia_model', 'transferencia');
        $this->load->model('revision_model', 'revision');
        $this->load->model('modelo_model', 'modelo');
        $this->load->model('palletcajasproceso_model', 'palletcajasproceso');
         $this->load->model('devolucion_model', 'devolucion');
        $this->load->library('permission');
        $this->load->library('session');
    }

    public function agregar()
    {
        # code...
        Permission::grant(uri_string());
        $folio = $this->transferencia->obtenerUltimoFolio();
        $numerofolio = $folio->folio;
        $nuevo = $numerofolio + 1;
        $data = array(
            'folio' => $nuevo,
            'idusuario' => $this->session->user_id,
            'fecharegistro' => date('Y-m-d H:i:s')
        );
        $idtransferencia = $this->transferencia->addTransferencia($data);
        $data_devolucion = array(
            'idtransferencia'=>$idtransferencia,
            'idusuario' => $this->session->user_id,
            'fecharegistro' => date('Y-m-d H:i:s')
        );
        $this->devolucion->addDevolucion($data_devolucion);
        redirect('transferencia/');
    }
    public function detalle($id, $folio) {
        # code...
        //Permission::grant(uri_string());
        $datalinea = $this->linea->showAllLinea();
        $datatransferencia = $this->transferencia->listaNumeroParteTransferencia($id);
       
        $data = array(
            'id' => $id,
            'folio' => $folio,
            'datalinea' => $datalinea,
            'datatransferencia' => $datatransferencia);
        $this->load->view('header');
        $this->load->view('transferencia/devolucion', $data);
        $this->load->view('footer');
    }
    

}

?>
