<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('login_model'); 
            $this->load->model('user_model', 'user');  

    }

public function logins()
{
    # code...
}
	public function index()
	{
        
     if($this->session->user_id) {
echo "string";
           redirect('admin');
            //return redirect('sitio/index');
        }else if($_POST) { 
echo "string";
           /* $data = [
                'usuario' => $this->input->post('usuario'),
                'password' => md5($this->input->post('password')),
                //'password' => $this->input->post('password'),
            ];
            $result = $this->login_model->login($data);
           
            if(!empty($result)) {
                $this->session->set_userdata([
                    'user_id' => $result->id,
                    'idusuario' => $result->idusuario,
                    'usuario' => $result->usuario,
                    'name' => $result->name,
                    'rol' => $result->rol
                ]);
               redirect('admin');
            } else {
                $this->session->set_flashdata('err', 'Usuario o Passeord Incorrecto.');
                  $this->load->view('admin/login');
            }
        */
       
    }
    else{
      $this->load->view('admin/login');
    }
      
  
	}
	
 
	public function logout() {  
      // creamos un array con las variables de sesión en blanco
    $datasession = array('usuario_id' => '', 'logged_in' => '');
    // y eliminamos la sesión
    $this->session->unset_userdata($datasession);
    // redirigimos al controlador principal 
    $logout=$this->session->sess_destroy();
    
      redirect('login');
       
       
    }

   
}
