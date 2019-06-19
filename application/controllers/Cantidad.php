<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cantidad extends CI_Controller
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
         $this->load->model('cantidad_model', 'cantidad');
        $this->load->library('permission');

    }
 
    public function registrar() {
        $idrevision=$this->input->post('idrevision');
        $cantidad =$this->input->post('cantidad');
        $datavalidar= $this->revision->validadExistenciaRevision($idrevision,$cantidad); 
        if($datavalidar == FALSE){
            
             $data =array(
                 'idrevision'=>$idrevision,
                 'cantidad'=>$cantidad,
                 'idusuario' => $this->session->user_id,
                 'fecharegistro' => date('Y-m-d H:i:s')
             );
             $this->cantidad->addCantidad($data);
             echo '1';
        }else{
            //El numero de modelo ya existe
            echo '2';
        }
    }
    public function detalleCantidad() {
          $idcantidad=$this->input->post('employee_id');
           $result= $this->cantidad->detalleCantidad($idcantidad); 
           echo json_encode($result);
    }
      public function modificar() {
        $idcantidad=$this->input->post('employee_id');
        $cantidad=$this->input->post('cantidad');
        $datavalidar= $this->cantidad->validadExistenciaCantidadUpdate($idcantidad,$cantidad); 
        if($datavalidar == FALSE){
            
             $data =array( 
                 'cantidad'=>$cantidad,
                 'idusuario' => $this->session->user_id,
                 'fecharegistro' => date('Y-m-d H:i:s')
             );
             $this->cantidad->updateCantidad($idcantidad,$data);
             echo '1';
        }else{
            //El numero de modelo ya existe
            echo '2';
        }
    }

}
?>
