<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//Load libruary for API
class Reporte extends CI_Controller {

    function __construct() {
        parent::__construct();

        if (!isset($_SESSION['user_id'])) {
            $this->session->set_flashdata('flash_data', 'You don\'t have access! ss');
            return redirect('login');
        }
        $this->load->helper('url');
        $this->load->model('data_model');
        $this->load->model('rol_model', 'rol');
        $this->load->model('reporte_model', 'reporte');
        
        $this->load->model('user_model', 'usuario');
        $this->load->library('permission');
    }
  
    public function transferencia() {
        //Permission::grant(uri_string());
        $usuario = $this->usuario->showAllPacking();
        $data = array('usuarios' => $usuario);
        $this->load->view('header');
        $this->load->view('reporte/transferencia', $data);
        $this->load->view('footer');
    }

    public function buscar() {
        # code...
        //Permission::grant(uri_string());
        
           $fechainicio = $this->input->post('fechainicio');
           $fechafin = $this->input->post('fechafin');
            $modulo = $this->input->post('modulo');
            $result="";
            if($modulo == "1"){
                $result = $this->reporte->allTransferenciaPacking($fechainicio,$fechafin);
                
            }elseif ($modulo=="2") {
                $result = $this->reporte->allTransferenciaCalidad($fechainicio,$fechafin);
            }elseif ($modulo=="3") {
                $result = $this->reporte->allTransferenciaBodega($fechainicio,$fechafin);
            }
            $data = array('result' => $result,'modulo'=>$modulo);
            $this->load->view('header');
            $this->load->view('reporte/transferencia', $data);
            $this->load->view('footer');
       
       
    }
 

}
