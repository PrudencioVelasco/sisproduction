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
        $this->load->library('session');
        $this->load->model('user_model', 'usuario');
        $this->load->library('permission');
    }
  
    public function transferencia() {
        Permission::grant(uri_string());
        $usuario = $this->usuario->showAllPacking();
        $data = array('usuarios' => $usuario);
        $this->load->view('header');
        $this->load->view('reporte/transferencia', $data);
        $this->load->view('footer');
    }
    public function procesofinal()
    {
        # code...
         $data  = array(
            'partes'=>$this->reporte->allNumeroPartes()
             );
        $this->load->view('header');
        $this->load->view('reporte/procesofinal',$data);
        $this->load->view('footer');
    }
    public function procesos()
    {
        # code...
       // var_dump($this->reporte->allNumeroPartes());
        $data  = array(
            'partes'=>$this->reporte->allNumeroPartes(),
            'procesos' => $this->reporte->allProcesos(),
            'maquinas'=>$this->reporte->allMaquinas()
             );
         $this->load->view('header');
        $this->load->view('reporte/procesos',$data);
        $this->load->view('footer');
    }
    public function buscar_reporte_proceso_final()
    {
        # code...
         $idlamina = $this->input->post('idlamina'); 
         $fechainicio = $this->input->post('fechainicio');
        $nueva_fecha_inicio = $fechainicio.":00";
        $fechafin = $this->input->post('fechafin'); 
         $nueva_fecha_fin = $fechafin.":00";
        $idproceso = $this->input->post('idproceso');
        $datareporte =  $this->reporte->busqueda_proceso_final($nueva_fecha_inicio,$nueva_fecha_fin,$idlamina,$idproceso);
        //var_dump($datareporte);
       $data  = array(
            'partes'=>$this->reporte->allNumeroPartes(),
            'datareporte'=>$datareporte
             );
         $this->load->view('header');
        $this->load->view('reporte/procesofinal',$data);
        $this->load->view('footer');
    }
    public function buscar_reporte_proceso()
    {
        # code...

        $idlamina = $this->input->post('idlamina');
        //$idparte = $this->input->post('idparte');
        $fechainicio = $this->input->post('fechainicio');
        $fechafin = $this->input->post('fechafin'); 
        $idmaquina = $this->input->post('idmaquina');
        $idproceso = $this->input->post('idproceso');
        //$idparte = $this->input->post('idparte');
        //$idparte = $this->input->post('idparte');

       $datareporte =  $this->reporte->busqueda_proceso($fechainicio,$fechafin,$idlamina,$idproceso,$idmaquina);
       $data  = array(
            'partes'=>$this->reporte->allNumeroPartes(),
            'procesos' => $this->reporte->allProcesos(),
            'maquinas'=>$this->reporte->allMaquinas(),
            'datareporte'=>$datareporte
             );
         $this->load->view('header');
        $this->load->view('reporte/procesos',$data);
        $this->load->view('footer');

    }

    public function buscar() {
        # code...
        Permission::grant(uri_string());
        
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
            //var_dump($result);
            $data = array('result' => $result,'modulo'=>$modulo);
            $this->load->view('header');
            $this->load->view('reporte/transferencia', $data);
            $this->load->view('footer');
       
       
    }
 

}
