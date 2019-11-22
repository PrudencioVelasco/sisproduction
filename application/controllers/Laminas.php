<?php

defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('America/Tijuana');
class Laminas extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!isset($_SESSION['user_id'])) {
            $this->session->set_flashdata('flash_data', 'You don\'t have access! ss');
            return redirect('login');
        } 
        $this->load->helper('url');
        $this->load->model('data_model');
        $this->load->model('lamina_model', 'lamina'); 
        $this->load->model('client_model', 'cliente'); 
        $this->load->library('permission');
        $this->load->library('session');
    }

    public function index()
    {
        $data = array(
            'data'=>$this->lamina->showAllLaminas(),
            'maquinas'=>$this->lamina->showAllMaquinas(),
            'clientes'=>$this->cliente->showAllClientesActivos()
        );
        //var_dump($this->lamina->showAllMaquinas());
        $this->load->view('header');
        $this->load->view('entradas/lamina/index',$data);
        $this->load->view('footer');
    }
    public function detalle($idparte)
    {
        
        # code...
        $data = array(
            'datelle'=>$this->lamina->detalle_parte($idparte),
            'entradas'=>$this->lamina->detalle_entradas($idparte),
            'salidas'=>$this->lamina->detalle_salidas($idparte),
            'devoluciones'=>$this->lamina->detalle_devoluciones($idparte),
            'maquinas'=>$this->lamina->showAllMaquinas(),
            'clientes'=>$this->cliente->showAllClientesActivos()
        );
        //var_dump($this->lamina->detalle_entradas($idparte));
        $this->load->view('header');
        $this->load->view('entradas/lamina/detalle',$data);
        $this->load->view('footer');

    }
    public function agregar_entrada()
    {
        # code... 

        $config = array(
            array(
                'field' => 'cantidad',
                'label' => 'Cantidad',
                'rules' => 'trim|required|is_natural',
                'errors' => array(
                    'required' => 'Cantidad campo obligatorio.', 
                    'is_natural'=> 'Solo número positivo.'
                )
            ),
            array(
                'field' => 'comentarios',
                'label' => 'Comentarios',
                'rules' => 'trim|max_length[249]',
                'errors' => array(
                    'required' => 'Campo obligatorio.',
                    'max_length'=> 'Maximo 240 caracteres.'
                )
            )
        );
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE){

            $errors = validation_errors();

            echo json_encode(['error'=>$errors]);


        }else{

            $data = array(
                'idparte'=> $this->input->post('idparte'),
                'cantidad'=> $this->input->post('cantidad'),
                'comentarios'=> $this->input->post('comentarios'),
                'activo'=>1,
                'idusuario' => $this->session->user_id,
                'fecharegistro' => date('Y-m-d H:i:s')
            );
            $this->lamina->addEntradaLamina($data);

           echo json_encode(['success'=>'Se agrego la entrada con Exito.']);

        }

    }
    public function agregar_salida()
    {
        # code... 
        $config = array(
            array(
                'field' => 'cantidad',
                'label' => 'Cantidad',
                'rules' => 'trim|required|is_natural',
                'errors' => array(
                    'required' => 'Cantidad campo obligatorio.', 
                    'is_natural'=> 'Solo número positivo.'
                )
            ),
            array(
                'field' => 'comentarios',
                'label' => 'Comentarios',
                'rules' => 'trim|max_length[249]',
                'errors' => array(
                    'required' => 'Campo obligatorio.',
                    'max_length'=> 'Maximo 240 caracteres.'
                )
            )
        );
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE){

            $errors = validation_errors();

            echo json_encode(['error'=>$errors]);


        }else{
            $cantidad = $this->input->post('cantidad');
            $idparte = $this->input->post('idparte');
            if($this->lamina->totalentradas($idparte)){
                $total_entrada=0;
                $total_salida=0;
                $total_devolucion=0;
                foreach($this->lamina->totalentradas($idparte) as $value){
                 $total_entrada+=$value->cantidad;   
                }
                if($this->lamina->totalsalidas($idparte)){
                    foreach($this->lamina->totalsalidas($idparte) as $value){
                        $total_salida+=$value->cantidad;   
                       }
                }
                if($this->lamina->totaldevolucion($idparte)){
                    foreach($this->lamina->totaldevolucion($idparte) as $value){
                        $total_devolucion+=$value->cantidad;   
                       }
                }
                $total_entrada = $total_entrada - $total_salida - $total_devolucion;

                if($cantidad <= $total_entrada){

                    $data = array(
                        'idparte'=> $this->input->post('idparte'),
                        'idmaquina'=> $this->input->post('maquina'),
                        'cantidad'=> $this->input->post('cantidad'),
                        'comentarios'=> $this->input->post('comentarios'),
                        'activo'=>1,
                        'idusuario' => $this->session->user_id,
                        'fecharegistro' => date('Y-m-d H:i:s')
                    );
                    $this->lamina->addSalidaLamina($data); 
                   echo json_encode(['success'=>'Se agrego la entrada con Exito.']);

                }else{
                    //No hay suficiente para dar salida
                    echo json_encode(['error'=>'No hay suficientes Laminas.']);

                }
            }else{
                //No existe Stock disponibles
                echo json_encode(['error'=>'No hay suficientes Laminas.']);
            } 

        }

    }

    public function devolucion()
    {
        # code...

        $config = array( 
            array(
                'field' => 'cantidad',
                'label' => 'Cantidad',
                'rules' => 'trim|required|is_natural',
                'errors' => array(
                    'required' => 'Cantidad campo obligatorio.', 
                    'is_natural'=> 'Solo número positivo.'
                )
            ),
            array(
                'field' => 'comentarios',
                'label' => 'Comentarios',
                'rules' => 'trim|max_length[249]',
                'errors' => array(
                    'required' => 'Campo obligatorio.',
                    'max_length'=> 'Maximo 240 caracteres.'
                )
            )
        );
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE){

            $errors = validation_errors();

            echo json_encode(['error'=>$errors]);


        }else{
          $idparte =  $this->input->post('idparte');
          $cantidad =  $this->input->post('cantidad');
        $total_entrada=0;
        $total_salida=0;
        $total_devolucion=0;
        if($this->lamina->totalentradas($idparte)){
            foreach($this->lamina->totalentradas($idparte) as $value){
            $total_entrada+=$value->cantidad;   
            }
        }

        if($this->lamina->totalsalidas($idparte)){
            foreach($this->lamina->totalsalidas($idparte) as $value){
                $total_salida+=$value->cantidad;   
               }
        }
        if($this->lamina->totaldevolucion($idparte)){
            foreach($this->lamina->totaldevolucion($idparte) as $value){
                $total_devolucion+=$value->cantidad;   
               }
        }
        $total_stock = $total_entrada - ($total_salida - $total_devolucion);

        if($cantidad<=$total_stock && $total_stock > 0){

            $data = array(
                'idparte'=> $this->input->post('idparte'),
                'idcliente'=> $this->input->post('cliente'),
                'cantidad'=> $this->input->post('cantidad'),
                'comentarios'=> $this->input->post('comentarios'),
                'activo'=>1,
                'idusuario' => $this->session->user_id,
                'fecharegistro' => date('Y-m-d H:i:s')
            );
            $this->lamina->addDevolucionLamina($data);
            echo json_encode(['success'=>'Se agrego la entrada con Exito.']);
        }else{
            //No tienes en existencia
            echo json_encode(['error'=>'No hay suficientes Laminas.']);
        }

    }

    }
   

}

?>
