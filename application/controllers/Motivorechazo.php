<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Motivorechazo extends CI_Controller {

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
        $this->load->model('motivorechazo_model', 'motivo');
        $this->load->library('permission');
        $this->load->library('session');
    }

    public function index() {
        Permission::grant(uri_string());
        $this->load->view('header');
        $this->load->view('motivo/index');
        $this->load->view('footer');
    }

    public function showAll() {
        //Permission::grant(uri_string());
        $query = $this->motivo->showAll();
        if ($query) {
            $result['motivos'] = $this->motivo->showAll();
        }
        echo json_encode($result);
    }
     public function showAllProcesos() {
        //Permission::grant(uri_string());
        $query = $this->motivo->showAllProcesos(); 
        echo json_encode($query);
    }

   

    public function addMotivo() {
       // Permission::grant(uri_string());
        $config = array(
            array(
                'field' => 'motivo',
                'label' => 'motivo',
                'rules' => 'trim|required',
                'errors' => array(
                    'required' => 'Campo obligatorio.'
                )
            ),
             array(
                'field' => 'idproceso',
                'label' => 'idproceso',
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
                'motivo' => form_error('motivo'),
                'idproceso' => form_error('idproceso')
            );
        } else {
            $idproceso = $this->input->post('idproceso');
            $nombre = trim($this->input->post('motivo'));
            $validar = $this->motivo->validadAddMotivo($idproceso,$nombre);
            if($validar == FALSE){
            $data = array(
                'motivo' => $this->input->post('motivo'),
                'idproceso' => $this->input->post('idproceso'),
                'activo' => 1
            );
            $this->motivo->addMotivo($data);
            }else{
                $result['error'] = true;
                $result['msg'] = array(
                    'msgerror' => "La Motivo ya se encuentra resgistrada."
                );

            }
        }
        echo json_encode($result);
    }

    public function updateMotivo() {
        //Permission::grant(uri_string());
        $config = array(
            array(
                'field' => 'motivo',
                'label' => 'motivo',
                'rules' => 'trim|required',
                'errors' => array(
                    'required' => 'Campo obligatorio.'
                )
            ),
             array(
                'field' => 'idproceso',
                'label' => 'idproceso',
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
                'motivo' => form_error('motivo'),
                'idproceso' => form_error('idproceso')
            );
        } else {
            $id = $this->input->post('idmotivorechazo');
            $idproceso = $this->input->post('idproceso');
            $nombre = trim($this->input->post('motivo'));
            $validar = $this->motivo->validadMotivoUpdate($id,$idproceso,$nombre);
            if($validar == FALSE){
            $data = array(
                'motivo' => $this->input->post('motivo'), 
                'idproceso' => $this->input->post('idproceso'), 
                'activo' => $this->input->post('activo')
            );
            if ($this->motivo->updateMotivo($id, $data)) {
                $result['error'] = false;
                $result['success'] = 'User updated successfully';
            }
        }else{
             $result['error'] = true;
                $result['msg'] = array(
                    'msgerror' => "La Motivo ya se encuentra resgistrada."
                );
            }
        }
        echo json_encode($result);
    }

    public function searchMotivo() {
        //Permission::grant(uri_string());
        $value = $this->input->post('text');
        $query = $this->motivo->searchMotivo($value);
        if ($query) {
            $result['motivos'] = $query;
        }

        echo json_encode($result);
    }

}

?>