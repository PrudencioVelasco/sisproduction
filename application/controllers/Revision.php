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
 
    public function registrar() {
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
    }

}
?>
