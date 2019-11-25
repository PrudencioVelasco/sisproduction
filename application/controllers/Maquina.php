<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Maquina extends CI_Controller {

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
        $this->load->model('maquina_model', 'maquina');
        $this->load->library('permission');
        $this->load->library('session');
    }
   public function index() { 
      // Permission::grant(uri_string());
        $this->load->view('header');
        $this->load->view('maquina/index');
        $this->load->view('footer');
    }

    public function addMaquina() {
        //Permission::grant(uri_string());
        $config = array(
            array(
                'field' => 'nombremaquina',
                'label' => 'Modelo',
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
                'nombremaquina' => form_error('nombremaquina')
            );
        } else {
             
            $nombremaquina = $this->input->post('nombremaquina');
            $datavalidar = $this->maquina->validadExistenciaNombreMaquina($nombremaquina);
            if ($datavalidar == FALSE) {

                $data = array(
                    'nombremaquina' => $nombremaquina,
                    'activo' => 1,
                    'idusuario' => $this->session->user_id,
                    'fecharegistro' => date('Y-m-d H:i:s')
                );
                $this->maquina->addMaquina($data);
            } else {
                //El numero de modelo ya existe
                $result['error'] = true;
                $result['msg'] = array(
                    'msgerror' => "La maquina ya esta registrado."
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

    public function updateMaquina() {
        //Permission::grant(uri_string());
        $config = array(
            array(
                'field' => 'nombremaquina',
                'label' => 'Maquina',
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
                'nombremaquina' => form_error('nombremaquina')
            );
        } else {
            $idmaquina = $this->input->post('idmaquina');
            $nombremaquina = $this->input->post('nombremaquina');
            $datavalidar = $this->linea->validadExistenciaMaquinaUpdate($idmaquina, $nombremaquina);
            if ($datavalidar == FALSE) {

                $data = array(
                    'nombremaquina' => $nombremaquina,
                      'activo' => $this->input->post('activo'),
                    'idusuario' => $this->session->user_id,
                    'fecharegistro' => date('Y-m-d H:i:s')
                    
                );
                $this->maquina->updateMaquina($idmaquina, $data);
            } else {
                //El numero de modelo ya existe
                $result['error'] = true;
                $result['msg'] = array(
                    'msgerror' => "La maquina ya esta registrado."
                );
            }
        }
        echo json_encode($result);
    }

 

    public function showAll() {
        //Permission::grant(uri_string()); 
        $query = $this->maquina->showAllMaquina();
        if ($query) {
            $result['maquinas'] = $this->maquina->showAllMaquina();
        }
        echo json_encode($result);
    }

    public function searchMaquina() {
        $value = $this->input->post('text'); 
        $query = $this->maquina->searchMaquina($value);
        if (!empty($query)) {
            $result['maquinas'] = $query;
        }else{
             $result['maquinas'] = null;
        }


        echo json_encode($result);
    }

}

?>
