<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        if (!isset($_SESSION['user_id'])) {
            $this->session->set_flashdata('flash_data', 'You don\'t have access! ss');
            return redirect('Login');
        }
        $this->load->helper('url');
        $this->load->model('data_model');
        $this->load->model('user_model', 'user');
         $this->load->model('admin_model', 'adminmodel');
        $this->load->library('permission');
        $this->load->library('session');


    }
    public function index()
    {
       $datadetallada = $this->adminmodel->produccionDetalla();
         $datatotal = $this->adminmodel->produccionTotal();
       $data = array('datadetallada'=>$datadetallada,'datatotal'=>$datatotal);
        $this->load->view('header');
        $this->load->view('admin/principal',$data);
        $this->load->view('footer');

    }


}
?>
