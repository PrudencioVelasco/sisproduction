<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Inventario extends CI_Controller
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
        $this->load->model('inventario_model', 'inventario');
        $this->load->model('posicionbodega_model', 'posicionbodega');
        $this->load->library('permission');

    }
    public function index()
    {
       // Permission::grant(uri_string());
        $this->load->view('header');
        $this->load->view('inventario/index');
        $this->load->view('footer');
        
    }
    
}
?>
