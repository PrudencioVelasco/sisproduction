<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Load libruary for API
class Reporte extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		if(!isset($_SESSION['user_id'])) {
            $this->session->set_flashdata('flash_data', 'You don\'t have access! ss');
            return redirect('login');
        }
        $this->load->helper('url');
		$this->load->model('data_model');
        $this->load->model('rol_model','rol'); 
        $this->load->model('reporte_model','reporte'); 
        $this->load->model('user_model','usuario'); 
		$this->load->library('permission'); 
	}

	public function packing()
	{
         
          $usuario = $this->usuario->showAllPacking();
          $data = array('usuarios' => $usuario );
		  $this->load->view('header');
          $this->load->view('reporte/packing',$data);
          $this->load->view('footer');
    }
    public function buscar()
    {
        # code...
         $usuario= $this->input->post('usuario');
         $fechainicio= $this->input->post('fechainicio');
         $fechafin= $this->input->post('fechafin');
         $estatus= $this->input->post('estatus');
        if($usuario == "all"){
            $result=$this->reporte->packingTodos($estatus,$fechainicio,$fechafin);
            $usuario = $this->usuario->showAllPacking();
            //var_dump($result);
            $data = array('usuarios' => $usuario,'resultall'=>$result );
            $this->load->view('header');
            $this->load->view('reporte/packing',$data);
            $this->load->view('footer');
        }else{
            $result=$this->reporte->packingPorUsuario($usuario,$estatus,$fechainicio,$fechafin);
            $usuario = $this->usuario->showAllPacking();
            // var_dump($result);
            $data = array('usuarios' => $usuario,'resultusers'=>$result );
            $this->load->view('header');
            $this->load->view('reporte/packing',$data);
            $this->load->view('footer');
        }
    }
    public function calidad()
	{
          $usuario = $this->usuario->showAllCalidad();
          $data = array('usuarios' => $usuario );
		   $this->load->view('header');
           $this->load->view('reporte/calidad',$data);
           $this->load->view('footer');
    }
    public function buscarCalidad()
    {
        # code...
         $usuario= $this->input->post('usuario');
         $fechainicio= $this->input->post('fechainicio');
         $fechafin= $this->input->post('fechafin');
         $estatus= $this->input->post('estatus');
        if($usuario == "all"){
            $result=$this->reporte->calidadTodos($estatus,$fechainicio,$fechafin);
            $usuario = $this->usuario->showAllCalidad();
            //var_dump($result);
            $data = array('usuarios' => $usuario,'resultall'=>$result );
            $this->load->view('header');
            $this->load->view('reporte/calidad',$data);
            $this->load->view('footer');
        }else{
            $result=$this->reporte->calidadPorUsuario($usuario,$estatus,$fechainicio,$fechafin);
            $usuario = $this->usuario->showAllCalidad();
            // var_dump($result);
            $data = array('usuarios' => $usuario,'resultusers'=>$result );
            $this->load->view('header');
            $this->load->view('reporte/calidad',$data);
            $this->load->view('footer');
        }
    }
    public function bodega()
	{
          $usuario = $this->usuario->showAllBodega();
          $data = array('usuarios' => $usuario );
		   $this->load->view('header');
           $this->load->view('reporte/bodega',$data);
           $this->load->view('footer');
	}
    public function buscarBodega()
    {
        # code...
         $usuario= $this->input->post('usuario');
         $fechainicio= $this->input->post('fechainicio');
         $fechafin= $this->input->post('fechafin');
         $estatus= $this->input->post('estatus');
        if($usuario == "all"){
            $result=$this->reporte->calidadTodos($estatus,$fechainicio,$fechafin);
            $usuario = $this->usuario->showAllBodega();
            //var_dump($result);
            $data = array('usuarios' => $usuario,'resultall'=>$result );
            $this->load->view('header');
            $this->load->view('reporte/bodega',$data);
            $this->load->view('footer');
        }else{
            $result=$this->reporte->calidadPorUsuario($usuario,$estatus,$fechainicio,$fechafin);
            $usuario = $this->usuario->showAllBodega();
            // var_dump($result);
            $data = array('usuarios' => $usuario,'resultusers'=>$result );
            $this->load->view('header');
            $this->load->view('reporte/bodega',$data);
            $this->load->view('footer');
        }
    }
}
