<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Linea extends CI_Controller {

    function __construct() {
        parent::__construct();

        if (!isset($_SESSION['user_id'])) {
            $this->session->set_flashdata('flash_data', 'You don\'t have access! ss');
            return redirect('login');
        }
        $this->load->helper('url');
        $this->load->model('data_model');
        $this->load->model('user_model', 'user');
        $this->load->model('turno_model', 'turno');
        $this->load->model('modelo_model', 'modelo');
        $this->load->model('linea_model', 'linea');
        $this->load->library('permission');
        $this->load->library('session');
    }
   public function index() { 
       Permission::grant(uri_string());
        $this->load->view('header');
        $this->load->view('linea/index');
        $this->load->view('footer');
    }

    public function addLinea() {
        Permission::grant(uri_string());
        $config = array(
            array(
                'field' => 'nombrelinea',
                'label' => 'Modelo',
                'rules' => 'trim|required|integer',
                'errors' => array(
                    'required' => 'Campo obligatorio.',
                     'integer' => 'Solo numero.'
                )
            )
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
            $result['error'] = true;
            $result['msg'] = array(
                'nombrelinea' => form_error('nombrelinea')
            );
        } else {
             
            $nombrelinea = $this->input->post('nombrelinea');
            $datavalidar = $this->linea->validadExistenciaNombreLinea($nombrelinea);
            if ($datavalidar == FALSE) {

                $data = array(
                    'nombrelinea' => $nombrelinea
                );
                $this->linea->addLinea($data);
            } else {
                //El numero de modelo ya existe
                $result['error'] = true;
                $result['msg'] = array(
                    'msgerror' => "La linea ya esta registrado."
                );
            }
        }
        echo json_encode($result);
    }

    /*public function detalleModelo() {
        $idmodelo = $this->input->post('employee_id');
        $result = $this->modelo->detalleModelo($idmodelo);
        echo json_encode($result);
    }*/

    public function updateLinea() {
        Permission::grant(uri_string());
        $config = array(
            array(
                'field' => 'nombrelinea',
                'label' => 'Modelo',
               'rules' => 'trim|required|integer',
                'errors' => array(
                    'required' => 'Campo obligatorio.',
                     'integer' => 'Solo numero.'
                )
            )
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
            $result['error'] = true;
            $result['msg'] = array(
                'nombrelinea' => form_error('nombrelinea')
            );
        } else {
            $idlinea = $this->input->post('idlinea');
            $nombrelinea = $this->input->post('nombrelinea');
            $datavalidar = $this->linea->validadExistenciaLineaUpdate($idlinea, $nombrelinea);
            if ($datavalidar == FALSE) {

                $data = array(
                    'nombrelinea' => $nombrelinea
                    
                );
                $this->linea->updateLinea($idlinea, $data);
            } else {
                //El numero de modelo ya existe
                $result['error'] = true;
                $result['msg'] = array(
                    'msgerror' => "La linea ya esta registrado."
                );
            }
        }
        echo json_encode($result);
    }

 

    public function showAll() {
        Permission::grant(uri_string()); 
        $query = $this->linea->showAllLinea();
        if ($query) {
            $result['lineas'] = $this->linea->showAllLinea();
        }
        echo json_encode($result);
    }

    public function searchLinea() {
        $value = $this->input->post('text'); 
        $query = $this->linea->searchLinea($value);
        if (!empty($query)) {
            $result['lineas'] = $query;
        }else{
             $result['lineas'] = null;
        }


        echo json_encode($result);
    }

}

?>
