<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends CI_Controller
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
        $this->load->library('session');

    }
    public function index()
    {
        Permission::grant(uri_string());
        $this->load->view('header');
        $this->load->view('usuario/index');
        $this->load->view('footer');
    }

 

      
    public function allTurnos()
   {
         Permission::grant(uri_string());
       $query = $this->turno->showAll();
       echo json_encode($query);
   }

    public function showAll()
    {
        Permission::grant(uri_string());
        $query = $this->user_model->showAll();
        if ($query) {
            $result['users'] = $this->user_model->showAll();
        }
        echo json_encode($result);
    }



    public function addUser()
    {
          Permission::grant(uri_string());
        $config = array(
            array(
                'field' => 'usuario',
                'label' => 'Usuario',
                'rules' => 'trim|required',
                'errors' => array(
                    'required' => 'Campo obligatorio.'
                )
            ),
            array(
                'field' => 'name',
                'label' => 'Nombre',
                'rules' => 'trim|required',
                'errors' => array(
                    'required' => 'Campo obligatorio.'
                )
            ),
            array(
                'field' => 'password1',
                'label' => 'Password',
                'rules' => 'trim|required',
                'errors' => array(
                    'required' => 'Campo obligatorio.'
                )
            ),
            array(
                'field' => 'password2',
                'label' => 'Password 2',
                'rules' => 'trim|required|matches[password1]',
                'errors' => array(
                    'required' => 'Campo obligatorio.',
                    'matches' => 'Las Contrasenas no conciden.'
                )
            ),
            array(
                'field' => 'rol',
                'label' => 'Rol',
                'rules' => 'trim|required',
                'errors' => array(
                    'required' => 'Campo obligatorio.'
                )
            ),array(
                'field' => 'idturno',
                'label' => 'idturno',
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
                'usuario' => form_error('usuario'),
                'name' => form_error('name'),
                'password1' => form_error('password1'),
                'password2' => form_error('password2'),
                'rol' => form_error('rol'),
                'idturno' => form_error('idturno')
            );

        } else {
            $resuldovalidacion = $this->user_model->validarUsuarioRegistrado($this->input->post('usuario'));

            if (!empty($resuldovalidacion)) {
                $result['error'] = true;
                    $result['msg']   = array(
                        'smserror' => "El nombre de usuario ya se encuentran registrado."
                    );
            }else{
            $data     = array(
                'idturno' => $this->input->post('idturno'),
                'usuario' => $this->input->post('usuario'),
                'name' => $this->input->post('name'),
                'password' => md5($this->input->post('password1')),
                'activo' => 1,
                'fecha' => date('Y-m-d H:i:s')

            );
            $idrol=$this->input->post('rol');
            $id =$this->user_model->addUser($data);

            $datauserrol     = array(
                'id_rol' => $idrol,
                'id_user' => $id
            );
            $this->user_model->addUserRol($datauserrol);
        }

        }
        echo json_encode($result);
    }

    public function updateUser()
    {
        Permission::grant(uri_string());
        $config = array(
            array(
                'field' => 'usuario',
                'label' => 'Usuario',
                'rules' => 'trim|required',
                'errors' => array(
                    'required' => 'Campo obligatorio.'
                )
            ),
            array(
                'field' => 'name',
                'label' => 'Nombre',
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
                'usuario' => form_error('usuario'),
                'name' => form_error('name')
            );

        } else {
            $id   = $this->input->post('id');
            $data = array(
                'usuario' => $this->input->post('usuario'),
                'name' => $this->input->post('name'),
                'activo' => $this->input->post('activo')
            );
            if ($this->user->updateUser($id, $data)) {
                $result['error']   = false;
                $result['success'] = 'User updated successfully';
            }


              $datarol = array(
                'id_rol' => $this->input->post('idrol')
            );
            if ($this->user->updateUserRol($id, $datarol)) {
                $result['error']   = false;
                $result['success'] = 'User updated successfully';
            }


        }
        echo json_encode($result);
    }
      public function passwordupdateUser()
    {
         Permission::grant(uri_string());
        $config = array(
            array(
                'field' => 'password1',
                'label' => 'password1',
                'rules' => 'trim|required',
                'errors' => array(
                    'required' => 'Campo obligatorio.'
            )),
            array(
                'field' => 'password2',
                'label' => 'password2',
                'rules' => 'trim|required|matches[password1]',
                'errors' => array(
                    'required' => 'Campo obligatorio.',
                    'matches' => 'Las Contrasenas no conciden.'
                )
            )
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
            $result['error'] = true;
            $result['msg']   = array(
                'password1' => form_error('password1'),
                'password2' => form_error('password2')
            );

        } else {
            $id   = $this->input->post('id');
            $data = array(
                'password' => md5($this->input->post('password1'))
            );
            if ($this->user->passwordupdateUser($id, $data)) {
                $result['error']   = false;
                //$result['success'] = 'User updated successfully';
           }

        }
        echo json_encode($result);
    }
    public function deleteUser()
    {
          Permission::grant(uri_string());
        $id = $this->input->post('id');
        if ($this->user->deleteUser($id)) {
            $msg['error']   = false;
            $msg['success'] = 'User deleted successfully';
        } else {
            $msg['error'] = true;
        }
        echo json_encode($msg);

    }
    public function searchUser()
    {
        Permission::grant(uri_string());
        $value = $this->input->post('text');
        $query = $this->user->searchUser($value);
        if ($query) {
            $result['users'] = $query;
        }

        echo json_encode($result);

    }
    public function administrar()
    {
           Permission::grant(uri_string());
        $this->load->view('header');
        $this->load->view('usuario/administrar');
        $this->load->view('footer');
    }


}
?>
