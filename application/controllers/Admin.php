<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends CI_Controller
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
        $this->load->library('permission');
        

    }
    public function index()
    {
       
        $this->load->view('header');
        $this->load->view('admin/principal');
        $this->load->view('footer');
       
    }
    
}
?>