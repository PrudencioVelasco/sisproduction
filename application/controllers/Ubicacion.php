<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ubicacion extends CI_Controller {

    function __construct() {
        parent::__construct();

        if (!isset($_SESSION['user_id'])) {
            $this->session->set_flashdata('flash_data', 'You don\'t have access! ss');
            return redirect('login');
        }
        $this->load->helper('url');
        $this->load->model('data_model');
        $this->load->model('client_model', 'client');
        $this->load->model('ubicacion_model', 'ubicacion');
        $this->load->library('permission');
        $this->load->library('session');
    }

    public function index() {
        Permission::grant(uri_string());
        $this->load->view('header');
        $this->load->view('ubicacion/index');
        $this->load->view('footer');
    }

    public function showAll() {
        Permission::grant(uri_string());
        $query = $this->ubicacion->showAll();
        if ($query) {
            $result['ubicaciones'] = $this->ubicacion->showAll();
        }
        echo json_encode($result);
    }

   

    public function addUbicacion() {
        Permission::grant(uri_string());
        $config = array(
            array(
                'field' => 'nombreposicion',
                'label' => 'nombreposicion',
                'rules' => 'trim|required',
                'errors' => array(
                    'required' => 'Campo obligatorio.'
                )
            )
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
            $result['error'] = true;
            $result['msg'] = array(
                'nombreposicion' => form_error('nombreposicion')
            );
        } else {
            $data = array(
                'nombreposicion' => $this->input->post('nombreposicion'),
                'activo' => 1
            );
            $this->ubicacion->addUbicacion($data);
        }
        echo json_encode($result);
    }

    public function updateUbicacion() {
       Permission::grant(uri_string());
        $config = array(
            array(
                'field' => 'nombreposicion',
                'label' => 'nombreposicion',
                'rules' => 'trim|required',
                'errors' => array(
                    'required' => 'Campo obligatorio.'
                )
            )
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
            $result['error'] = true;
            $result['msg'] = array(
                'nombreposicion' => form_error('nombreposicion')
            );
        } else {
            $id = $this->input->post('idposicion');
            $data = array(
                'nombreposicion' => $this->input->post('nombreposicion'), 
                'activo' => $this->input->post('activo')
            );
            if ($this->ubicacion->updateUbicacion($id, $data)) {
                $result['error'] = false;
                $result['success'] = 'User updated successfully';
            }
        }
        echo json_encode($result);
    }

    public function searchUbicacion() {
       Permission::grant(uri_string());
        $value = $this->input->post('text');
        $query = $this->ubicacion->searchUbicacion($value);
        if ($query) {
            $result['ubicaciones'] = $query;
        }

        echo json_encode($result);
    }

}

?>