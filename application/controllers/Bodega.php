<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Bodega extends CI_Controller
{

    function __construct()
    {
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
        $this->load->library('permission');

    }
    public function index()
    {
       // Permission::grant(uri_string());
        $this->load->view('header');
        $this->load->view('bodega/index');
        $this->load->view('footer');
    }
    public function showAllEnviados()
    {
         //Permission::grant(uri_string());
        $query = $this->bodega->showAllEnviados($this->session->user_id);
        if ($query) {
            $result['detallestatus'] = $this->bodega->showAllEnviados($this->session->user_id);
        }
        echo json_encode($result);
    }
    public function verDetalle($iddetalle)
    {
      $usuarioscalidad=$this->usuario->showAllCalidad();
      $detalledeldetalleparte=$this->parte->detalleDelDetallaParte($iddetalle);
      $dataerror = array();
      if($detalledeldetalleparte->idestatus == 6){
        $dataerror=$this->parte->motivosCancelacionCalidad($iddetalle);
      }

     $data=array(
      'iddetalle'=>$iddetalle,
      'detalle'=>$detalledeldetalleparte,
      'usuarioscalidad'=>$usuarioscalidad,
      'dataerrores'=>$dataerror
     );
     //var_dump($detalledeldetalleparte);
      $this->load->view('header');
      $this->load->view('bodega/detalle',$data);
      $this->load->view('footer');
    }
}
?>
