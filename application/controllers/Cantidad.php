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
        $this->load->library('session');

    }

    public function ver($idrevision)
    {
        # code...
        Permission::grant(uri_string()); 
        $detalle = $this->cantidad->detalleCantidad($idrevision);
         $para = $detalle->nombre." > ".$detalle->numeroparte." > ".$detalle->modelo." > ".$detalle->revision." > "."Cantidad";

         $data=array('idrevision'=>$idrevision,'text'=>$para);
         $this->load->view('header');
        $this->load->view('cantidad/index',$data);
        $this->load->view('footer');
    }
 
  public function addCantidad() {
      Permission::grant(uri_string()); 
        $config = array(
            array(
                'field' => 'cantidad',
                'label' => 'Modelo',
                'rules' => 'trim|required|integer',
                'errors' => array(
                    'required' => 'Campo obligatorio.',
                    'integer'=>'Solo número.'
                )
            )
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
            $result['error'] = true;
            $result['msg'] = array(
                'cantidad' => form_error('cantidad')
            );
        } else {
            $idrevision = $this->input->post('idrevision');
            $cantidad = $this->input->post('cantidad'); 
             $datavalidar= $this->revision->validadExistenciaRevision($idrevision,$cantidad); 
        if($datavalidar == FALSE){
            
             $data =array(
                 'idrevision'=>$idrevision,
                 'cantidad'=>$cantidad,
                 'idusuario' => $this->session->user_id,
                 'fecharegistro' => date('Y-m-d H:i:s')
             );
             $this->cantidad->addCantidad($data);
            } else {
                //El numero de modelo ya existe
                $result['error'] = true;
                $result['msg'] = array(
                    'msgerror' => "La Cantidad ya esta registrado."
                );
            }
        }
        echo json_encode($result);
    }
    public function updateCantidad() {
        Permission::grant(uri_string()); 
        $config = array(
            array(
                'field' => 'cantidad',
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
                'cantidad' => form_error('cantidad')
            );
        } else {
            $idcantidad = $this->input->post('idcantidad');
            $cantidad = $this->input->post('cantidad');
           $datavalidar= $this->cantidad->validadExistenciaCantidadUpdate($idcantidad,$cantidad); 
        if($datavalidar == FALSE){
            
             $data =array( 
                 'cantidad'=>$cantidad,
                 'idusuario' => $this->session->user_id,
                 'fecharegistro' => date('Y-m-d H:i:s')
             );
             $this->cantidad->updateCantidad($idcantidad,$data);
            } else {
                //El numero de modelo ya existe
                $result['error'] = true;
                $result['msg'] = array(
                    'msgerror' => "La Cantidad ya esta registrado."
                );
            }
        }
        echo json_encode($result);
    }

/*
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
    }*/

     public function showAll() {
        Permission::grant(uri_string());
        $idrevision = $this->input->get('idrevision');
        $query = $this->cantidad->showAll($idrevision);
        if ($query) {
            $result['cantidades'] = $this->cantidad->showAll($idrevision);
        }
        echo json_encode($result);
    }

    public function searchCantidad() {
        Permission::grant(uri_string()); 
        $value = $this->input->post('text');
        $idrevision = $this->input->post('idrevision');
        $query = $this->cantidad->searchCantidad($value, $idrevision);
        if ($query) {
            $result['cantidades'] = $query;
        }

        echo json_encode($result);
    }

}
?>
