<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Revision extends CI_Controller
{

    function __construct()
    {
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
         $this->load->model('revision_model', 'revision');
        $this->load->library('permission');

    }
    public function ver($idmodelo) {
        $detalle = $this->revision->detalleRevision($idmodelo);
         $para = $detalle->nombre." > ".$detalle->numeroparte." > ".$detalle->modelo." > "."Revisión";
        $data=array('idmodelo'=>$idmodelo,'text'=>$para);
         $this->load->view('header');
        $this->load->view('revision/index',$data);
        $this->load->view('footer');
    }
      public function addRevision() {
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
            $revision = $this->input->post('descripcion'); 
             $datavalidar= $this->revision->validadExistenciaRevision($idmodelo,$revision); 
            if ($datavalidar == FALSE) {

                $data = array(
                    'idmodelo' => $idmodelo,
                    'descripcion' => $revision,
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
            $revision = $this->input->post('descripcion');
            $datavalidar = $this->revision->validadExistenciaRevisionUpdate($idrevision, $revision);
            if ($datavalidar == FALSE) {

                $data = array(
                    'descripcion' => $revision,
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
    /*public function registrar() {
        $idmodelo=$this->input->post('idmodelo');
        $descripcion =$this->input->post('revision');
        $datavalidar= $this->revision->validadExistenciaRevision($idmodelo,$descripcion); 
        if($datavalidar == FALSE){
            
             $data =array(
                 'idmodelo'=>$idmodelo,
                 'descripcion'=>$descripcion,
                 'idusuario' => $this->session->user_id,
                 'fecharegistro' => date('Y-m-d H:i:s')
             );
             $this->revision->addRevision($data);
             echo '1';
        }else{
            //El numero de modelo ya existe
            echo '2';
        }
    }
    public function detalleRevision() {
          $idrevision=$this->input->post('employee_id');
           $result= $this->revision->detalleRevision($idrevision); 
           echo json_encode($result);
    }
      public function modificar() {
        $idrevision=$this->input->post('employee_id');
        $revision=$this->input->post('revision');
        $datavalidar= $this->revision->validadExistenciaRevisionUpdate($idrevision,$revision); 
        if($datavalidar == FALSE){
            
             $data =array( 
                 'descripcion'=>$revision,
                 'idusuario' => $this->session->user_id,
                 'fecharegistro' => date('Y-m-d H:i:s')
             );
             $this->revision->updateRevision($idrevision,$data);
             echo '1';
        }else{
            //El numero de modelo ya existe
            echo '2';
        }
    }*/

        public function showAll() {
        //Permission::grant(uri_string());
        $idmodelo = $this->input->get('idmodelo');
        $query = $this->revision->showAll($idmodelo);
        if ($query) {
            $result['revisiones'] = $this->revision->showAll($idmodelo);
        }
        echo json_encode($result);
    }

    public function searchRevision() {
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
