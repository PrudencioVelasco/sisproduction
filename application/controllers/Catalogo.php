<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Catalogo extends CI_Controller
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
        $this->load->model('user_model', 'user');
        $this->load->model('client_model', 'cliente');
        $this->load->model('turno_model', 'turno');
        $this->load->model('motivorechazo_model', 'motivo');
        $this->load->model('ubicacion_model', 'ubicacion');
        $this->load->model('admin_model', 'adminmodel');
        $this->load->library('permission');
        

    }
    public function index()
    {
        $totalusuarios = count($this->user->showAll()); 
        $totalcliente = count($this->cliente->showAll());
        $totalturno = count($this->turno->showAll());
        $totalubicacion = count($this->ubicacion->showAll());
        $totalmotivo = count($this->motivo->showAll());
        $data = array(
        'totalusuario'=>$totalusuarios,
        'totalcliente'=>$totalcliente,
        'totalturno'=>$totalturno,
        'totalubicacion'=>$totalubicacion,
        'totalmotivo'=>$totalmotivo);
        $this->load->view('header');
        $this->load->view('catalogo/index',$data);
        $this->load->view('footer');
       
    }
    
}
?>