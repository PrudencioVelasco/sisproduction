<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('login_model');
        $this->load->library('session');
        $this->load->model('user_model', 'user');
    }


    public function index() {

        if ($this->session->user_id) {

            redirect('Admin');
            //return redirect('sitio/index');
        }   else {

            $this->load->view('admin/login');
        }
    }

    public function logout() {
        // creamos un array con las variables de sesión en blanco
        $datasession = array('usuario_id' => '', 'logged_in' => '');
        // y eliminamos la sesión
        $this->session->unset_userdata($datasession);
        // redirigimos al controlador principal
        $logout = $this->session->sess_destroy();

        redirect('Login');
    }

}
