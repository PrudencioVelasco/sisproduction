<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Bodega extends CI_Controller {

    function __construct() {
        parent::__construct();

        if (!isset($_SESSION['user_id'])) {
            $this->session->set_flashdata('flash_data', 'You don\'t have access! ss');
            return redirect('login');
        }
        $this->load->helper('url');
        $this->load->model('data_model');
        $this->load->model('parte_model', 'parte');
        $this->load->model('user_model', 'usuario');
        $this->load->model('bodega_model', 'bodega');
        $this->load->model('calidad_model', 'calidad');
        $this->load->model('palletcajas_model', 'palletcajas');
        $this->load->model('palletcajasproceso_model', 'palletcajasproceso');
        $this->load->model('posicionbodega_model', 'posicionbodega');
        $this->load->library('permission');
    }

    public function index() {
        Permission::grant(uri_string());
        $this->load->view('header');
        $this->load->view('bodega/index');
        $this->load->view('footer');
    }

    public function showAllEnviados() {
        //Permission::grant(uri_string());
        $query = $this->bodega->showAllEnviados();
        if ($query) {
            $result['detallestatus'] = $this->bodega->showAllEnviados();
        }
        echo json_encode($result);
    }

    public function searchArrayKeyVal($sKey, $id, $array) {
        foreach ($array as $key => $val) {
            if ($val[$sKey] == $id) {
                return $key;
            }
        }
        return false;
    }

    public function searchParte() {
        Permission::grant(uri_string());
        $value = $this->input->post('text');
        $query = $this->bodega->buscar($value);
        if ($query) {
            $result['detallestatus'] = $query;
        }
        echo json_encode($result);
    }

    public function verDetalle($iddetalle) {
        Permission::grant(uri_string());
        $usuarioscalidad = $this->usuario->showAllCalidad();
        $detalledeldetalleparte = $this->parte->detalleDelDetallaParte($iddetalle);

        $arrayposicionesbodega = $this->posicionbodega->posicionesBodega();
        $datapalletcajas = $this->palletcajas->showAllId($iddetalle);
         
        $datapartebodega = $this->bodega->posicionPalletCajas($iddetalle);
        //var_dump($datapalletcajas);
        //    var_dump($arrayposicionesbodega);
        $dataerror = array();
        $dataposicionesparte = array();
        $dataposicionebodega = array();
        $dataerror = $this->parte->motivosCancelacionCalidad($iddetalle);
         $motivosrechazo = $this->bodega->motivosRechazo();
        $data = array(
            'iddetalle' => $iddetalle,
            'detalle' => $detalledeldetalleparte,
            'usuarioscalidad' => $usuarioscalidad,
            'dataerrores' => $dataerror,
            'posicionbodega' => $arrayposicionesbodega,
            'palletcajas' => $datapalletcajas,
            'dataposicionesparte' => $dataposicionesparte,
            'parteposicion' => $datapartebodega,
            'motivosrechazo'=>$motivosrechazo
        );
        //var_dump($detalledeldetalleparte);
        $this->load->view('header');
        $this->load->view('bodega/detalle', $data);
        $this->load->view('footer');
    }

    public function addPositionWereHouse() {
        $iddetalleparte = $_POST['iddetalleparte'];
        $data = $_POST['posicion'];
        $porciones = explode("-", $data);
        $idpalletcajas = $porciones[0];
        $idposicion = $porciones[1];
        $this->bodega->eliminarposicionesparte($idpalletcajas);
        $dataadd = array(
            'idpalletcajas' => $idpalletcajas,
            'numero' => 1,
            'idposicion' => $idposicion,
            'idusuario' => $this->session->user_id,
            'fecharegistro' => date('Y-m-d H:i:s')
        );
        //var_dump($dataadd);
        $this->bodega->addPalletPosicion($dataadd);
        $dataupdate = array(
            'idestatus' => 8
        );

        $this->bodega->updateEstatus($idpalletcajas, $dataupdate);
         
        // redirect('bodega/verDetalle/'.$iddetalleparte);
    }

    public function rechazarACalidad() {
         Permission::grant(uri_string());
        $iddetalleparte = $this->input->post('iddetalleparte');
        $motivorechazo = $this->input->post('motivorechazo');
        //$operador = $this->input->post('operador');
        $ids = $this->input->post('id');
        foreach ($ids as $value) { 

            if($this->bodega->validarAntesdeRechazar($value) == false){
                $this->bodega->eliminarposicionesparte($value);
            $data = array(
                'idestatus' => 6,
                'idusuario' => $this->session->user_id,
                'fecharegistro' => date('Y-m-d H:i:s')
            );
            $this->palletcajas->updatePalletCajas($value, $data);

             $datarechazo = array(
                    'idpalletcajas' => $value,
                    'idmotivorechazo' => $motivorechazo,
                    'idusuario' => $this->session->user_id,
                    'fecharegistro' => date('Y-m-d H:i:s')
                );
                $this->calidad->addMotivoRechazo($datarechazo);

              $datap = array(
                'idpalletcajas'=>$value,
                'idestatus' => 6,
                'idusuario' => $this->session->user_id,
                'fecharegistro' => date('Y-m-d H:i:s')
            );
            $this->palletcajasproceso->addPalletCajasProceso($datap);

              
        }
           
         }  
        
    }
        public function rechazarAPacking() {
         Permission::grant(uri_string());
        $iddetalleparte = $this->input->post('iddetalleparte');
        $motivorechazo = $this->input->post('motivorechazo');
        //$operador = $this->input->post('operador');
        $ids = $this->input->post('id');
        foreach ($ids as $value) { 

            if($this->bodega->validarAntesdeRechazar($value) == false){
                $this->bodega->eliminarposicionesparte($value);
            $data = array(
                'idestatus' => 3,
                'idusuario' => $this->session->user_id,
                'fecharegistro' => date('Y-m-d H:i:s')
            );
            $this->palletcajas->updatePalletCajas($value, $data);

             $datarechazo = array(
                    'idpalletcajas' => $value,
                    'idmotivorechazo' => $motivorechazo,
                    'idusuario' => $this->session->user_id,
                    'fecharegistro' => date('Y-m-d H:i:s')
                );
                $this->calidad->addMotivoRechazo($datarechazo);

              $datap = array(
                'idpalletcajas'=>$value,
                'idestatus' => 3,
                'idusuario' => $this->session->user_id,
                'fecharegistro' => date('Y-m-d H:i:s')
            );
            $this->palletcajasproceso->addPalletCajasProceso($datap);

              
        }
           
         }  
        
    }
    
      public function agregarAUbicacion() {
           Permission::grant(uri_string());
        $iddetalleparte = $this->input->post('iddetalleparte');
        $ubicacion = $this->input->post('ubicacion'); 
        $ids = $this->input->post('id');
          
          /*foreach ($ids as $valuede) { 
            if($this->bodega->validarAntesdeModificarPosicion($valuede) != false){ 
               $this->bodega->eliminarposicionesparte($valuede);
            } 
        }*/
          
        
        foreach ($ids as $value2) {
            if($this->bodega->validarAntesdeModificarPosicion($value2) == false){ 
                 $this->bodega->eliminarposicionesparte($valuede);
                    $dataadd = array(
                    'idpalletcajas' => $value2,
                    'numero' => 1,
                    'idposicion' => $ubicacion,
                    'idusuario' => $this->session->user_id,
                    'fecharegistro' => date('Y-m-d H:i:s')
                ); 
        $this->bodega->addPalletPosicion($dataadd);
    }
         }
          
         foreach ($ids as $valueproceso) {
             
            $data = array(
                'idpalletcajas'=>$valueproceso,
                'idestatus' => 8,
                'idusuario' => $this->session->user_id,
                'fecharegistro' => date('Y-m-d H:i:s')
            );
            $this->palletcajasproceso->addPalletCajasProceso($data);
            
        }
           foreach ($ids as $valueproceso2) {
             
            $data = array(
                'idpalletcajas'=>$valueproceso2,
                'idestatus' => 2,
                'idusuario' => $this->session->user_id,
                'fecharegistro' => date('Y-m-d H:i:s')
            );
            $this->palletcajasproceso->addPalletCajasProceso($data);
            
        }

        foreach ($ids as $value) {
              $dataupdate = array(
            'idestatus' => 8
        );

        $this->bodega->updateEstatus($value, $dataupdate);
         

        }

          
          
    }

    public function rechazar() {
        // code...
        Permission::grant(uri_string());
        $iddetalleparte = $this->input->post('iddetalleparte');
        $data = array(
            'idestatus' => 6,
            'idusuario' => $this->session->user_id,
            'fecharegistro' => date('Y-m-d H:i:s')
        );
        $this->parte->updateDetalleParte($iddetalleparte, $data);

        $datastatus = array(
            'iddetalleparte' => $iddetalleparte,
            'idstatus' => 6,
            'comentariosrechazo' => $this->input->post('motivo'),
            'idoperador' => $this->input->post('operador'),
            'idusuario' => $this->session->user_id,
            'fecharegistro' => date('Y-m-d H:i:s')
        );
        $this->parte->addDetalleEstatusParte($datastatus);
        redirect('bodega/');
    }



}

?>
