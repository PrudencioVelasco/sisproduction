<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends CI_Controller {

    function __construct() {
        parent::__construct();

        if (!isset($_SESSION['user_id'])) {
            $this->session->set_flashdata('flash_data', 'You don\'t have access! ss');
            return redirect('login');
        }
        $this->load->helper('url');
        $this->load->model('data_model');
        $this->load->model('client_model', 'client');
        $this->load->library('permission');
        $this->load->library('session');
    }

    public function index() {
        Permission::grant(uri_string());
        $this->load->view('header');
        $this->load->view('cliente/index');
        $this->load->view('footer');
    }

    public function showAll() {
        Permission::grant(uri_string());
        $query = $this->client_model->showAll();
        if ($query) {
            $result['clientes'] = $this->client_model->showAll();
        }
        echo json_encode($result);
    }

    public function showAllClientesActivos() {
       Permission::grant(uri_string());
        $query = $this->client_model->showAllClientesActivos();

        echo json_encode($query);
    }

    public function showAllClientes() {
        Permission::grant(uri_string());
        $query = $this->client_model->showAllClientes();
        echo json_encode($query);
    }

    public function addClient() {
        Permission::grant(uri_string());
        $config = array(
            array(
                'field' => 'rfc',
                'label' => 'rfc',
                'rules' => 'trim|required',
                'errors' => array(
                    'required' => 'Campo obligatorio.'
                )
            ),
            array(
                'field' => 'nombre',
                'label' => 'nombre',
                'rules' => 'trim|required',
                'errors' => array(
                    'required' => 'Campo obligatorio.'
                )
            ),
            array(
                'field' => 'abreviatura',
                'label' => 'abreviatura',
                'rules' => 'trim|required',
                'errors' => array(
                    'required' => 'Campo obligatorio.'
                )
            ),  array(
                'field' => 'clave',
                'label' => 'clave',
                'rules' => 'trim|required',
                'errors' => array(
                    'required' => 'Campo obligatorio.'
                )
            ), array(
                'field' => 'direccion',
                'label' => 'direccion',
                'rules' => 'trim|required',
                'errors' => array(
                    'required' => 'Campo obligatorio.'
                )
            ), array(
                'field' => 'direccionfacturacion',
                'label' => 'direccionfacturacion',
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
                'rfc' => form_error('rfc'),
                'nombre' => form_error('nombre'),
                'abreviatura' => form_error('abreviatura'),
                'clave' => form_error('clave'),
                'direccion' => form_error('direccion'),
                'direccionfacturacion' => form_error('direccionfacturacion')
            );
        } else {
            $data = array(
                'rfc' => $this->input->post('rfc'),
                'nombre' => $this->input->post('nombre'),
                'abreviatura' => $this->input->post('abreviatura'),
                'clave' => $this->input->post('clave'),
                'direccion' => $this->input->post('direccion'),
                'direccionfacturacion' => $this->input->post('direccionfacturacion'),
                'activo' => 1,
                'idusuario' => $this->session->user_id,
                'fecha' => date('Y-m-d H:i:s')
            );
            $this->client_model->addClient($data);
        }
        echo json_encode($result);
    }

    public function updateClient() {
        Permission::grant(uri_string());
        $config = array(
            array(
                'field' => 'rfc',
                'label' => 'rfc',
                'rules' => 'trim|required',
                'errors' => array(
                    'required' => 'Campo obligatorio.'
                )
            ),
            array(
                'field' => 'nombre',
                'label' => 'nombre',
                'rules' => 'trim|required',
                'errors' => array(
                    'required' => 'Campo obligatorio.'
                )
            ),array(
                'field' => 'abreviatura',
                'label' => 'abreviatura',
                'rules' => 'trim|required',
                'errors' => array(
                    'required' => 'Campo obligatorio.'
                )
            ),array(
                'field' => 'clave',
                'label' => 'clave',
                'rules' => 'trim|required',
                'errors' => array(
                    'required' => 'Campo obligatorio.'
                )
            ), array(
                'field' => 'direccion',
                'label' => 'direccion',
                'rules' => 'trim|required',
                'errors' => array(
                    'required' => 'Campo obligatorio.'
                )
            ), array(
                'field' => 'direccionfacturacion',
                'label' => 'direccionfacturacion',
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
                'rfc' => form_error('rfc'),
                'nombre' => form_error('nombre'),
                'abreviatura' => form_error('abreviatura'),
                'clave' => form_error('clave'),
                'direccion' => form_error('direccion'),
                'direccionfacturacion' => form_error('direccionfacturacion')
            );
        } else {
            $id = $this->input->post('idcliente');
            $data = array(
                'rfc' => $this->input->post('rfc'),
                'nombre' => $this->input->post('nombre'),
                 'abreviatura' => $this->input->post('abreviatura'),
                'clave' => $this->input->post('clave'),
                'direccion' => $this->input->post('direccion'),
                'direccionfacturacion' => $this->input->post('direccionfacturacion'),
                'activo' => $this->input->post('activo'),
                'idusuario' => $this->session->user_id,
                'fecha' => date('Y-m-d H:i:s'),
            );
            if ($this->client_model->updateClient($id, $data)) {
                $result['error'] = false;
                $result['success'] = 'User updated successfully';
            }
        }
        echo json_encode($result);
    }

    public function searchClient() {
        Permission::grant(uri_string());
        $value = $this->input->post('text');
        $query = $this->client_model->searchClient($value);
        if ($query) {
            $result['clientes'] = $query;
        }

        echo json_encode($result);
    }

}

?>