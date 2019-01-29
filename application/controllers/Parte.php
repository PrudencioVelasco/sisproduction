<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Parte extends CI_Controller {

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
public function tests()
{
  // code...
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

    public function detalleenvio($iddetalle)
    {
        //$usuarioscalidad=$this->usuario->showAllCalidad();
        //$detalleparte= $this->parte->detalleParteId($id);
        $usuarioscalidad=$this->usuario->showAllCalidad();
        $detalledeldetalleparte=$this->parte->detalleDelDetallaParte($iddetalle);
        $dataerror = array();
        if($detalledeldetalleparte->idestatus == 6){
            $dataerror=$this->parte->motivosCancelacionCalidad($iddetalle);
        }

        $data=array(
            'iddetalle'=>$iddetalle,
            'detalle'=>$detalledeldetalleparte,
            'usuarioscalidad'=>$usuarioscalidad,
            'dataerrores'=>$dataerror
        );

        //var_dump($detalledeldetalleparte);
        $this->load->view('header');
        $this->load->view('parte/detalleenviado',$data);
        $this->load->view('footer');
    }

    public function reenviarCalidad()
    {
        // code...
        $config = array(
          array(
                'field'   => 'modelo',
                'label'   => 'Modelo',
                'rules'   => 'required',
                'errors' => array(
                   'required' => 'Campo requerido.',
           )
             ),
          array(
                'field'   => 'revision',
                'label'   => 'Revision',
                'rules'   => 'required',
                'errors' => array(
                   'required' => 'Campo requerido.',
           )
             ),
          array(
                'field'   => 'numeropallet',
                'label'   => 'Número de pallet',
                'rules'   => 'required|integer',
                'errors' => array(
                   'required' => 'Campo requerido.',
                   'integer'=>'Solo numero'
           )
             ),
          array(
                'field'   => 'cantidadcaja',
                'label'   => 'Cantidad Caja',
                'rules'   => 'required|integer',
                'errors' => array(
                   'required' => 'Cantidad requerido.',
                   'integer' => 'Solo numero.'
           )
             )
             ,
          array(
                'field'   => 'linea',
                'label'   => 'Linea',
                'rules'   => 'required',
                'errors' => array(
                   'required' => 'Campo requerido.'
           )
             )
             ,
          array(
                'field'   => 'usuariocalidad',
                'label'   => 'Usuario de calidad',
                'rules'   => 'required',
                'errors' => array(
                   'required' => 'Campo requerido.'
           )
             )
       );

       $iddetalleparte=$this->input->post('iddetalleparte');
       $this->form_validation->set_rules($config);

       if ($this->form_validation->run() == TRUE)
       {
           $data = array(
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

            $this->parte->updateDetalleParte($iddetalleparte,$data);

            $datastatus = array(
                'iddetalleparte' => $iddetalleparte,
                'idstatus' => 1,
                'idoperador' => $this->input->post('usuariocalidad'),
                'idusuario' => $this->session->user_id,
                'fecharegistro' => date('Y-m-d H:i:s')
            );

            $this->parte->addDetalleEstatusParte($datastatus);
            redirect('parte/');
        } else {
            // code...
            $usuarioscalidad=$this->usuario->showAllCalidad();
            $detalledeldetalleparte=$this->parte->detalleDelDetallaParte($iddetalleparte);

            $dataerror = array();

            if($detalledeldetalleparte->idestatus == 6){
                $dataerror=$this->parte->motivosCancelacionCalidad($iddetalleparte);
            }

            $data = array(
                'iddetalle'=>$iddetalleparte,
                'detalle'=>$detalledeldetalleparte,
                'usuarioscalidad'=>$usuarioscalidad,
                'dataerrores'=>$dataerror
            );
            //var_dump($detalledeldetalleparte);
            $this->load->view('header');
            $this->load->view('parte/detalleenviado',$data);
            $this->load->view('footer');
        }
    }

    public function enviarCalidad()
    {
        $config = array(
            array(
                'field'   => 'modelo',
                'label'   => 'Modelo',
                'rules'   => 'required',
                'errors' => array(
                    'required' => 'Campo requerido.',
                    )
                ),
            array(
                'field'   => 'revision',
                'label'   => 'Revision',
                'rules'   => 'required',
                'errors' => array(
                    'required' => 'Campo requerido.',
                    )
                ),
            array(
                'field'   => 'numeropallet',
                'label'   => 'Número de pallet',
                'rules'   => 'required|integer',
                'errors' => array(
                    'required' => 'Campo requerido.',
                    'integer'=>'Solo numero'
                    )
                ),
            array(
                'field'   => 'cantidadcaja',
                'label'   => 'Cantidad Caja',
                'rules'   => 'required|integer',
                'errors' => array(
                    'required' => 'Cantidad requerido.',
                    'integer' => 'Solo numero.'
                    )
                ),
            array(
                'field'   => 'linea',
                'label'   => 'Linea',
                'rules'   => 'required',
                'errors' => array(
                    'required' => 'Campo requerido.'
                    )
                ),
            array(
                'field'   => 'usuariocalidad',
                'label'   => 'Usuario de calidad',
                'rules'   => 'required',
                'errors' => array(
                    'required' => 'Campo requerido.'
                    )
                )
            );
            $this->form_validation->set_rules($config);
            if ($this->form_validation->run() == TRUE) {
                $data = array(
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

                $iddetalleparte = $this->parte->addDetalleParte($data);
                $datastatus = array(
                    'iddetalleparte' => $iddetalleparte,
                    'idstatus' => 1,
                    'idoperador' => $this->input->post('usuariocalidad'),
                    'idusuario' => $this->session->user_id,
                    'fecharegistro' => date('Y-m-d H:i:s')
                );
                $this->parte->addDetalleEstatusParte($datastatus);
                redirect('parte/');
            } else {
                $id = $this->input->post('idparte');
                $usuarioscalidad = $this->usuario->showAllCalidad();
                $detalleparte = $this->parte->detalleParteId($id);
                $data = array(
                    'usuarioscalidad' => $usuarioscalidad,
                    'detalleparte' => $detalleparte,
                    'idparte' => $id
                );

                $this->load->view('header');
                $this->load->view('parte/packing',$data);
                $this->load->view('footer');
            }
    }

    public function verEnviados()
    {
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
            ),
            array(
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
            if($resuldovalidacion == FALSE){
                $data = array(
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

    public function updateParte()
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
            ),
            array(
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
            $idparte = $this->input->post('idparte');
            $resuldovalidacion = $this->parte->validarClientePartePorIdParte($idparte,$idcliente,$numeroparte);
            if($resuldovalidacion == FALSE){
                $data = array(
                    'numeroparte' => $this->input->post('numeroparte'),
                    'idcliente' => $this->input->post('idcliente'),
                    'idusuario' => $this->session->user_id,
                    'activo' => $this->input->post('activo'),
                    'fecharegistro' => date('Y-m-d H:i:s')
                );
                $this->parte->updateParte($idparte,$data);
            }else{
                $result['error'] = true;
                $result['msg']   = array(
                    'smserror' => "El número de cliente ya se encuentra registrado."
                );
            }
        }
        echo json_encode($result);
    }

    public function searchEnviados()
    {
        //Permission::grant(uri_string());
        $value = $this->input->post('text');
        $query = $this->parte->searchEnviados($value,$this->session->user_id);
        if ($query) {
            $result['detallestatus'] = $query;
        }
        echo json_encode($result);
    }

    public function searchParte()
    {
        //Permission::grant(uri_string());
        $value = $this->input->post('text');
        $query = $this->parte->searchPartes($value);
        if ($query) {
            $result['partes'] = $query;
        }
        echo json_encode($result);
    }
}
?>
