<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Calidad extends CI_Controller {
    
    function __construct()
    {
        parent::__construct();
        if (!isset($_SESSION['user_id'])) {
            $this->session->set_flashdata('flash_data', 'You don\'t have access! ss');
            return redirect('login');
        }
        $this->load->helper('url');
        $this->load->model('data_model');
        $this->load->model('calidad_model', 'calidad');
        $this->load->model('user_model', 'usuario');
        $this->load->library('form_validation'); 
        $this->load->library('permission');
    }
    
    public function index()
    {
        // Permission::grant(uri_string());
        $this->load->view('header');
        $this->load->view('calidad/index');
        $this->load->view('footer');
    }
    
    /*public function packing($id)
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
    }*/
    
    // Informacion de la parte recibida por id en Modulo[Calidad]
    public function detalleenvio($iddetalle)
    {
        $usuariosbodega = $this->calidad->allUsersBodega();
        $detalledeldetalleparte=$this->calidad->detalleDelDetallaParte($iddetalle);
        
        $data=array(
            'iddetalle'=>$iddetalle,
            'detalle'=>$detalledeldetalleparte,
            'usuariosbodega'=>$usuariosbodega
        );
        
        $this->load->view('header');
        $this->load->view('calidad/detalle_recibido',$data);
        $this->load->view('footer');
    }
    
    /*public function reenviarBodega()
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
            redirect('calidad/');
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
            $this->load->view('calidad/detalle_recibido',$data);
            $this->load->view('footer');
        }
    }*/
    
    // Enviar informacion de la parte al siguiente Modulo[Bodega]
    public function enviarBodega()
    {
        $usuariosbodega = $this->input->post('usuariobodega');
        $idoperador = $this->input->post('idoperador');
        $iddetalleparte = $this->input->post('iddetalleparte');
        
        //echo json_encode( array('bodega' => $usuariosbodega,'idoperador' => $idoperador,'iddetalle' => $iddetalleparte ));
        $data = array(
            'idestatus' => 4,
            'idoperador' => $usuariosbodega,
            'idusuario' => $this->session->user_id,
            'fecharegistro' => date('Y-m-d H:i:s')
        );
        // Actualizar la informacion de la tabla [idoperador][idstatus]
        $actualizacionParte = $this->calidad->updateDetalleParte($iddetalleparte,$data);

        if($actualizacionParte){

            $datastatus1 = array(
                'iddetalleparte' => $iddetalleparte,
                'idstatus' => 4,
                'idoperador' => $usuariosbodega,
                'idusuario' => $this->session->user_id,
                'fecharegistro' => date('Y-m-d H:i:s')
            );
    
            //Agregar la informacion a la tabla detalle status[Historial]
            $agregarEnvioBodega = $this->calidad->addDetalleEstatusParte($datastatus1);
            
            if($agregarEnvioBodega){

                $datastatus2 = array(
                    'iddetalleparte' => $iddetalleparte,
                    'idstatus' => 2,
                    'idoperador' => $idoperador,
                    'idusuario' => $this->session->user_id,
                    'fecharegistro' => date('Y-m-d H:i:s')
                );
        
                //Agregar la informacion de finalizacion del proceso anterior a la tabla detalle statu[Historial]
                $finalizarProceso = $this->calidad->addDetalleEstatusParte($datastatus2);

                if($finalizarProceso){
                    echo json_encode("ok");
                }
            }
        }

    }
    
    /*public function verEnviados()
    {
        $this->load->view('header');
        $this->load->view('parte/enviados');
        $this->load->view('footer');
    }*/

    /*public function showAll()
    {
        //Permission::grant(uri_string());
        $query = $this->parte->showAll();
        if ($query) {
            $result['partes'] = $this->parte->showAll();
        }
        echo json_encode($result);
    }*/

    // Mostrar todos las partes enviados de Modulo[Packing]
    public function showAllEnviados()
    {
        //Permission::grant(uri_string());
        $query = $this->calidad->showAllEnviados($this->session->user_id);
        if ($query) {
            $result['detallestatus'] = $this->calidad->showAllEnviados($this->session->user_id);
        }
        echo json_encode($result);
    }

    /*public function test()
    {
        $idclente = 1;
        $numeroparte = 'NOS';
        $resuldovalidacion = $this->parte->validarClienteParte($idclente,$numeroparte);
        var_dump($resuldovalidacion);
    }*/
    
    /*public function addPart()
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
    }*/

    public function searchEnviados()
    {
        //Permission::grant(uri_string());
        $value = $this->input->post('text');
        $query = $this->calidad->searchEnviados($value,$this->session->user_id);
        if ($query) {
            $result['detallestatus'] = $query;
        }
        echo json_encode($result);
    }

    /*public function searchParte()
    {
        //Permission::grant(uri_string());
        $value = $this->input->post('text');
        $query = $this->calidad->searchPartes($value);
        if ($query) {
            $result['partes'] = $query;
        }
        echo json_encode($result);
    }*/
}
?>
