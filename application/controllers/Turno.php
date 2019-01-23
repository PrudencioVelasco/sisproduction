<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Turno extends CI_Controller
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
        $this->load->library('permission');
        
    }
    public function index()
    {
        Permission::grant(uri_string());
        $this->load->view('header');
        $this->load->view('turno/index');
        $this->load->view('footer');
    }
    
    public function showAll()
    {
        Permission::grant(uri_string());
        $query = $this->turno->showAll(); 
        if ($query) {
            $result['turnos'] = $this->turno->showAll();
        }
        echo json_encode($result);
    }
    
    
    
    public function addTurno()
    {
          Permission::grant(uri_string());
        $config = array( 
            array(
                'field' => 'nombreturno',
                'label' => 'Nombre del turno',
                'rules' => 'trim|required',
                'errors' => array(
                    'required' => 'Campo obligatorio.'
                )
            ),
            array(
                'field' => 'horainicial',
                'label' => 'Hora inicial',
                'rules' => 'trim|required',
                'errors' => array(
                    'required' => 'Campo obligatorio.'
                )
            ),
            array(
                'field' => 'horafinal',
                'label' => 'Hora final',
                'rules' => 'trim|required',
                'errors' => array(
                    'required' => 'Campo obligatorio.'
                )
            )
            ,
            array(
                'field' => 'siguientedia',
                'label' => 'Siguiente dia',
                'rules' => 'trim|required',
                'errors' => array(
                    'required' => 'Campo obligatorio.'
                )
            ) 
        );
        $resultnextday=$this->turno->showAllNextDay();
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
            $result['error'] = true;
            $result['msg']   = array( 
                'nombreturno' => form_error('nombreturno'),
                'horainicial' => form_error('horainicial'),
                'horafinal' => form_error('horafinal'),
                'siguientedia' => form_error('siguientedia')
            );
            
        } else if ($resultnextday != false) {
            # code...
               $result['error'] = true;
               $result['msg']   = array(
                        'smserror' => "Solo puede haber un registrdo como el siguiente dia.."
                    );
        } else { 
            
            $data     = array( 
                'nombreturno' => $this->input->post('nombreturno'),
                'horainicial' => $this->input->post('horainicial'),
                'horafinal' =>  $this->input->post('horafinal'),
                'siguientedia' =>  $this->input->post('siguientedia'),
                'activo' => 1,
                'idusuario' => $this->session->user_id,
                'fecha' => date('Y-m-d H:i:s')
                
            );
            
            $this->turno->addTurno($data);
        
            
        }
        echo json_encode($result);
    }
    
    public function updateTurno()
    {
       Permission::grant(uri_string());
        $config = array( 
            array(
                'field' => 'nombreturno',
                'label' => 'Nombre del turno',
                'rules' => 'trim|required',
                'errors' => array(
                    'required' => 'Campo obligatorio.'
                )
            ),
            array(
                'field' => 'horainicial',
                'label' => 'Hora inicial',
                'rules' => 'trim|required',
                'errors' => array(
                    'required' => 'Campo obligatorio.'
                )
            ),
            array(
                'field' => 'horafinal',
                'label' => 'Hora final',
                'rules' => 'trim|required',
                'errors' => array(
                    'required' => 'Campo obligatorio.'
                )
            ) 
            ,
            array(
                'field' => 'siguientedia',
                'label' => 'Siguiente dia',
                'rules' => 'trim|required',
                'errors' => array(
                    'required' => 'Campo obligatorio.'
                )
            ) 
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
            $result['error'] = true;
            $result['msg']   = array( 
                'nombreturno' => form_error('nombreturno'),
                'horainicial' => form_error('horainicial'),
                'horafinal' => form_error('horafinal'),
                 'siguientedia' => form_error('siguientedia')
            );
            
        } else {

            $id   = $this->input->post('idturno');
            

            $data     = array( 
                'nombreturno' => $this->input->post('nombreturno'),
                'horainicial' => $this->input->post('horainicial'),
                'horafinal' =>  $this->input->post('horafinal'),
                'siguientedia' =>  $this->input->post('siguientedia'),
                'activo' => $this->input->post('activo'),
                'idusuario' => $this->session->user_id,
                'fecha' => date('Y-m-d H:i:s')
                
            );
            if ($this->turno->updateTurno($id, $data)) {
                $result['error']   = false;
                $result['success'] = 'User updated successfully';
            }

            
        }
        echo json_encode($result);
    }
        public function searchTurno()
    {
        Permission::grant(uri_string());
        $value = $this->input->post('text');
        $query = $this->turno->searchTurno($value);
        if ($query) {
            $result['turnos'] = $query;
        }
        
        echo json_encode($result);
        
    }
    
}
?>