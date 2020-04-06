<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Revision extends CI_Controller
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
         $this->load->model('turno_model', 'turno');
         $this->load->model('modelo_model', 'modelo');
         $this->load->model('revision_model', 'revision');
        $this->load->library('permission');
        $this->load->library('session');

    }
    public function ver($idmodelo) {
        Permission::grant(uri_string());
        $detalle = $this->revision->detalleRevision($idmodelo);
         $para = $detalle->nombre." > ".$detalle->numeroparte." > ".$detalle->modelo." > "."Revisión";
        $data=array('idmodelo'=>$idmodelo,'text'=>$para);
        $this->load->view('header');
        $this->load->view('revision/index',$data);
    }
      public function addRevision() {
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
            $revision = trim($this->input->post('descripcion'));
             $datavalidar= $this->revision->validadExistenciaRevision($idmodelo,$revision);
            if ($datavalidar == FALSE) {

                $data = array(
                    'idmodelo' => $idmodelo,
                    'descripcion' => $revision,
                    'activo' => 1,
                    'idusuario' => $this->session->user_id,
                    'fecharegistro' => date('Y-m-d H:i:s')
                );
               $this->revision->addRevision($data);
            } else {
                //El numero de modelo ya existe
                $result['error'] = true;
                $result['msg'] = array(
                    'msgerror' => "La revisión ya esta registrado."
                );
        }

    }
    echo json_encode($result);
}
    public function updateRevision() {
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
            $idrevision = $this->input->post('idrevision');
            $idmodelo = $this->input->post('idmodelo');
            $revision = trim($this->input->post('descripcion'));
            $activo = trim($this->input->post('activo'));
            $datavalidar = $this->revision->validadExistenciaRevisionUpdate($idrevision, $revision,$idmodelo);
            if ($datavalidar == FALSE) {

                $data = array(
                    'descripcion' => $revision,
                    'activo' => $activo,
                    'idusuario' => $this->session->user_id,
                    'fecharegistro' => date('Y-m-d H:i:s')
                );
                $this->revision->updateRevision($idrevision,$data);

            } else {
                //El numero de modelo ya existe
                $result['error'] = true;
                $result['msg'] = array(
                    'msgerror' => "La revision ya esta registrado."
                );
            }
        }
        echo json_encode($result);
    }

        public function showAll() {
        Permission::grant(uri_string());
        $idmodelo = $this->input->get('idmodelo');
        $query = $this->revision->showAll($idmodelo);
        if ($query) {
            $result['revisiones'] = $this->revision->showAll($idmodelo);
        }
        echo json_encode($result);
    }
    public function deleteRevision() {
        //Permission::grant(uri_string());
        $idrevision = $this->input->get('idrevision');
        $query = $this->revision->deleteRevision($idrevision);
        if ($query) {
            $result['revisiones'] = true;
        }
        echo json_encode($result);
    }

    public function searchRevision() {
        Permission::grant(uri_string());
        $value = $this->input->post('text');
        $idmodelo = $this->input->post('idmodelo');
        $query = $this->revision->searchRevision($value, $idmodelo);
        if ($query) {
            $result['revisiones'] = $query;
        }
        if (isset($result)) {
            echo json_encode($result);
        } else {
            $result['revisiones'] = NULL;
            echo json_encode($result);
        }
    }

}
?>
