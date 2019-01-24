<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Parte extends CI_Controller
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
        $this->load->model('parte_model', 'parte');
         $this->load->model('user_model', 'usuario');
        $this->load->library('permission');

    }
    public function index()
    {
       // Permission::grant(uri_string());
        $this->load->view('header');
        $this->load->view('parte/index');
        $this->load->view('footer');
    }
       public function packing($id)
    {
        $usuarioscalidad=$this->usuario->showAllCalidad();
        $detalleparte= $this->parte->detalleParteId($id);
       $data=array(
        'usuarioscalidad'=>$usuarioscalidad,
        'detalleparte'=>$detalleparte,
        'idparte'=>$id
       );
        $this->load->view('header');
        $this->load->view('parte/packing',$data);
        $this->load->view('footer');
    }
    public function enviarCalidad()
    {
        # code...
         $data     = array(
                        'idparte' => $this->input->post('idparte'),
                        'modelo' => $this->input->post('modelo'),
                        'revision' => $this->input->post('revision'),
                        'pallet' => $this->input->post('numeropallet'),
                        'cantidad' => $this->input->post('cantidadcaja'),
                        'linea' => $this->input->post('linea'),
                        'idestatus' => 1,
                        'idoperador' => $this->input->post('usuariocalidad'),
                        'idusuario' => $this->session->user_id,
                        'fecharegistro' => date('Y-m-d H:i:s')

                    );
              $iddetalleparte  = $this->parte->addDetalleParte($data);
               $datastatus     = array(
                        'iddetalleparte' => $iddetalleparte,
                        'idstatus' => 1,
                        'idoperador' => $this->input->post('usuariocalidad'),
                        'idusuario' => $this->session->user_id,
                        'fecharegistro' => date('Y-m-d H:i:s')

                    );
               $this->parte->addDetalleEstatusParte($datastatus);
               redirect('parte/');

    }
    public function verEnviados()
    {
        # code...
         $this->load->view('header');
        $this->load->view('parte/enviados');
        $this->load->view('footer');
    }
    public function showAll()
    {
         //Permission::grant(uri_string());
        $query = $this->parte->showAll();
        if ($query) {
            $result['partes'] = $this->parte->showAll();
        }
        echo json_encode($result);
    }
    public function showAllEnviados()
    {
         //Permission::grant(uri_string());
        $query = $this->parte->showAllEnviados($this->session->user_id);
        if ($query) {
            $result['detallestatus'] = $this->parte->showAllEnviados($this->session->user_id);
        }
        echo json_encode($result);
    }
    public function test(){
                $idclente =1;
              $numeroparte = 'NOS';
              $resuldovalidacion = $this->parte->validarClienteParte($idclente,$numeroparte);
              var_dump($resuldovalidacion);
    }

       public function addPart()

    {
         //Permission::grant(uri_string());
        $config = array(

            array(
                'field' => 'numeroparte',
                'label' => 'Número de parte',
                'rules' => 'trim|required',
                'errors' => array(
                    'required' => 'Campo obligatorio.'
                )
            ),array(
                'field' => 'idcliente',
                'label' => 'Cliente',
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
                 'numeroparte' => form_error('numeroparte'),
                 'idcliente' => form_error('idcliente')
            );

        } else {
             $idcliente = $this->input->post('idcliente');
              $numeroparte = $this->input->post('numeroparte');
              $resuldovalidacion = $this->parte->validarClienteParte($idcliente,$numeroparte);
              if($resuldovalidacion==FALSE){

                $data     = array(
                        'numeroparte' => $this->input->post('numeroparte'),
                        'idcliente' => $this->input->post('idcliente'),
                        'idusuario' => $this->session->user_id,
                        'activo' => 1,
                        'fecharegistro' => date('Y-m-d H:i:s')

                    );
                    $this->parte->addParte($data);

              }else{
                    $result['error'] = true;
                    $result['msg']   = array(
                        'smserror' => "El número de cliente ya se encuentra registrado."
                    );
              }


        }
        echo json_encode($result);
    }


}
?>
