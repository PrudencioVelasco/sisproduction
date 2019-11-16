<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Modelo extends CI_Controller {

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
        $this->load->library('permission');
        $this->load->library('session');
    }
   public function ver($idparte) { 
       Permission::grant(uri_string());
        $detalle = $this->modelo->detalleModelo($idparte); 
        $para = $detalle->nombre." > ".$detalle->numeroparte." > "."Modelo";
        $data=array( 
            'idparte'=>$idparte,
            'paso'=>$para
        );
        $this->load->view('header');
        $this->load->view('modelo/index',$data);
        $this->load->view('footer');
    }

    public function addModelo() {
        Permission::grant(uri_string());
        $config = array(
            array(
                'field' => 'descripcion',
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
                'descripcion' => form_error('descripcion')
            );
        } else {
            $idparte = $this->input->post('idparte');
            $modelo = $this->input->post('descripcion');
            $datavalidar = $this->modelo->validadExistenciaModelo($modelo, $idparte);
            if ($datavalidar == FALSE) {

                $data = array(
                    'idparte' => $idparte,
                    'descripcion' => $modelo,
                    'nombrehoja' => $this->input->post('nombrehoja'),
                    'customer' => "",
                    'fulloneimpresion' => $this->input->post('fulloneimpresion'),
                    'colorlinea' => $this->input->post('colorlinea'),
                    'diucutno' => $this->input->post('diucutno'),
                    'platonumero' => $this->input->post('platonumero'),
                    'color' => $this->input->post('color'),
                    'blanksize' => $this->input->post('blanksize'),
                    'sheetsize' => $this->input->post('sheetsize'),
                    'score' => $this->input->post('score'),
                    'normascompartidas' => $this->input->post('normascompartidas'),
                    'salida' => $this->input->post('salida'),
                    'combinacion' => $this->input->post('combinacion'),
                    'idusuario' => $this->session->user_id,
                    'fecharegistro' => date('Y-m-d H:i:s')
                );
                $this->modelo->addModelo($data);
            } else {
                //El numero de modelo ya existe
                $result['error'] = true;
                $result['msg'] = array(
                    'msgerror' => "El modelo ya esta registrado."
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

    public function updateModelo() {
        Permission::grant(uri_string());
        $config = array(
            array(
                'field' => 'descripcion',
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
                'descripcion' => form_error('descripcion')
            );
        } else {
            $idmodelo = $this->input->post('idmodelo');
            $modelo = $this->input->post('descripcion');
            $datavalidar = $this->modelo->validadExistenciaModeloUpdate($idmodelo, $modelo);
            if ($datavalidar == FALSE) {

                $data = array(                     
                   'descripcion' => $modelo,
                    'nombrehoja' => $this->input->post('nombrehoja'),
                    'customer' => "",
                    'fulloneimpresion' => $this->input->post('fulloneimpresion'),
                    'colorlinea' => $this->input->post('colorlinea'),
                    'diucutno' => $this->input->post('diucutno'),
                    'platonumero' => $this->input->post('platonumero'),
                    'color' => $this->input->post('color'),
                    'blanksize' => $this->input->post('blanksize'),
                    'sheetsize' => $this->input->post('sheetsize'),
                    'score' => $this->input->post('score'),
                    'normascompartidas' => $this->input->post('normascompartidas'),
                    'salida' => $this->input->post('salida'),
                    'combinacion' => $this->input->post('combinacion'),
                    'idusuario' => $this->session->user_id,
                    'fecharegistro' => date('Y-m-d H:i:s')
                );
                $this->modelo->updateModelo($idmodelo, $data);
            } else {
                //El numero de modelo ya existe
                $result['error'] = true;
                $result['msg'] = array(
                    'msgerror' => "El modelo ya esta registrado."
                );
            }
        }
        echo json_encode($result);
    }

 

    public function showAll() {
        Permission::grant(uri_string());
        $idparte = $this->input->get('idparte');
        $query = $this->modelo->showAll($idparte);
        if ($query) {
            $result['modelos'] = $this->modelo->showAll($idparte);
        }
        echo json_encode($result);
    }

    public function searchModelo() {
        $value = $this->input->post('text');
        $idparte = $this->input->post('idparte');
        $query = $this->modelo->searchModelo($value, $idparte);
        if ($query) {
            $result['modelos'] = $query;
        }

        echo json_encode($result);
    }

}

?>
