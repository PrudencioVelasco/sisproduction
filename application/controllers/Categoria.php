<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Categoria extends CI_Controller {

    function __construct() {
        parent::__construct();

        if (!isset($_SESSION['user_id'])) {
            $this->session->set_flashdata('flash_data', 'You don\'t have access! ss');
            return redirect('login');
        }
        $this->load->helper('url');
        $this->load->model('data_model');
        $this->load->model('categorias_model', 'categorias');
        $this->load->library('permission');
        $this->load->library('session');
    }

    public function index() {
        Permission::grant(uri_string());
        $this->load->view('header');
        $this->load->view('categoria/index');
        $this->load->view('footer');
    }
//
    public function showAll() {
        Permission::grant(uri_string());
        $query = $this->categorias->showAll();
        if ($query) {
            $result['categorias'] = $this->categorias->showAll();
        }
        echo json_encode($result);
    }

    public function showAllCategoriasActivos() {
       //Permission::grant(uri_string());
        $query = $this->categorias->showAllCategoriasActivos();

        echo json_encode($query);
    }

//    public function showAllClientes() {
//        Permission::grant(uri_string());
//        $query = $this->client_model->showAllClientes();
//        echo json_encode($query);
//    }
//
    public function addCategoria() {
        //Permission::grant(uri_string());
        $config = array(
            array(
                'field' => 'nombrecategoria',
                'label' => 'nombrecategoria',
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
                'nombrecategoria' => form_error('nombrecategoria')
            );
        } else {
            $data = array(
                'nombrecategoria' => $this->input->post('nombrecategoria'), 
                'activo' => 1,
                'idusuario' => $this->session->user_id,
                'fecha' => date('Y-m-d H:i:s')
            );
            $this->categorias->addCategoria($data);
        }
        echo json_encode($result);
    }
//
    public function updateCategoria() {
        Permission::grant(uri_string());
        $config = array(
            array(
                'field' => 'nombrecategoria',
                'label' => 'nombrecategoria',
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
                'nombrecategoria' => form_error('nombrecategoria')
            );
        } else {
            $id = $this->input->post('idcategoria');
            $data = array(
                'nombrecategoria' => $this->input->post('nombrecategoria'),
                'activo' => $this->input->post('activo'),
                'idusuario' => $this->session->user_id,
                'fecha' => date('Y-m-d H:i:s'),
            );
            if ($this->categorias->updateCategoria($id, $data)) {
                $result['error'] = false;
                $result['success'] = 'User updated successfully';
            }
        }
        echo json_encode($result);
    }
//
    public function searchCategoria() {
        Permission::grant(uri_string());
        $value = $this->input->post('text');
        $query = $this->categorias->searchCategoria($value);
        if ($query) {
            $result['categorias'] = $query;
        }

        echo json_encode($result);
    }

}

?>