<?php

defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('America/Tijuana');
class Litho extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        
        if (!isset($_SESSION['user_id'])) {
            $this->session->set_flashdata('flash_data', 'You don\'t have access! ss');
            return redirect('login');
        } 
        
        $this->load->helper('url');
        $this->load->model('data_model');
        $this->load->model('litho_model', 'litho'); 
        $this->load->model('client_model', 'cliente'); 
        $this->load->library('permission');
        $this->load->library('session');
    }

    public function index()
    {
        $data = array(
            'data'=>$this->litho->showAllLitho(),
        );

        $this->load->view('header');
        $this->load->view('entradas/litho/index',$data);
        $this->load->view('footer');
    }

    public function detalle($idparte)
    {
        $data = array(
            'entradas'=>$this->litho->detalle_entradas($idparte),
            'salidas'=>$this->litho->detalle_salidas($idparte),
            'devoluciones'=>$this->litho->detalle_devoluciones($idparte)
        );

        $this->load->view('header');
        $this->load->view('entradas/litho/detalle',$data);
        $this->load->view('footer');

    }
    
    public function agregar_entrada()
    {
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
            ),
            array(
                'field' => 'transferencia',
                'label' => 'Transferencia',
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
                'transferencia'=> $this->input->post('transferencia'),
                'activo'=>1,
                'idusuario' => $this->session->user_id,
                'fecharegistro' => date('Y-m-d H:i:s')
            );
            $this->litho->addEntradaLitho($data);
            echo json_encode(['success'=>'Se agrego la entrada con Exito.']);
        }
    }

    public function agregar_salida()
    {
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
            ),
            array(
                'field' => 'transferencia',
                'label' => 'Transferencia',
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

            if($this->litho->totalentradas($idparte)){
                $total_entrada=0;
                $total_salida=0;
                $total_devolucion=0;
                foreach($this->litho->totalentradas($idparte) as $value){
                 $total_entrada+=$value->cantidad;   
             }
             if($this->litho->totalsalidas($idparte)){
                foreach($this->litho->totalsalidas($idparte) as $value){
                    $total_salida+=$value->cantidad;   
                }
            }
            if($this->litho->totaldevolucion($idparte)){
                foreach($this->litho->totaldevolucion($idparte) as $value){
                    $total_devolucion+=$value->cantidad;   
                }
            }
            $total_entrada = $total_entrada - $total_salida - $total_devolucion;
            
            if($cantidad <= $total_entrada ){
                $data = array(
                    'idparte'=> $this->input->post('idparte'),
                    'cantidad'=> $this->input->post('cantidad'),
                    'comentarios'=> $this->input->post('comentarios'),
                    'transferencia'=> $this->input->post('transferencia'),
                    'activo'=> 1,
                    'idusuario' => $this->session->user_id,
                    'fecharegistro' => date('Y-m-d H:i:s')
                );
                $this->litho->addSalidaLitho($data); 
                echo json_encode(['success'=>'Se agrego la salida con exito.']);

            }else{
                echo json_encode(['error'=>'No hay en existencia suficientes Laminas.']);

            }
        }else{
            echo json_encode(['error'=>'No hay en existencia suficientes Laminas.']);
        } 

    }

}

public function devolucion()
{
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
        ),
        array(
            'field' => 'transferencia',
            'label' => 'Transferencia',
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
        
        $total_entrada = 0;
        $total_salida = 0;
        $total_devolucion = 0;
        
        if($this->litho->totalentradas($idparte)){
            foreach($this->litho->totalentradas($idparte) as $value){
                $total_entrada+=$value->cantidad;   
            }
        }

        if($this->litho->totalsalidas($idparte)){
            foreach($this->litho->totalsalidas($idparte) as $value){
                $total_salida+=$value->cantidad;   
            }
        }
        if($this->litho->totaldevolucion($idparte)){
            foreach($this->litho->totaldevolucion($idparte) as $value){
                $total_devolucion+=$value->cantidad;   
            }
        }
        $total_stock = $total_entrada - $total_salida - $total_devolucion;

        if($cantidad <= $total_stock && $total_stock > 0){

            $data = array(
                'idparte'=> $this->input->post('idparte'),
                'cantidad'=> $this->input->post('cantidad'),
                'comentarios'=> $this->input->post('comentarios'),
                'transferencia'=> $this->input->post('transferencia'),
                'activo'=> 1,
                'idusuario' => $this->session->user_id,
                'fecharegistro' => date('Y-m-d H:i:s')
            );
            $this->litho->addDevolucionLitho($data);
            echo json_encode(['success'=>'Se agrego la devolucion con Exito.']);
        }else{
            echo json_encode(['error'=>'No hay en existencia suficientes Laminas.']);
        }

    }

}

public function actualizar_entrada()
{ 
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
        ),
        array(
            'field' => 'transferencia',
            'label' => 'Transferencia',
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
        $idlitho = $this->input->post('idlitho');

        $data = array(
            'cantidad'=> $this->input->post('cantidad'),
            'comentarios'=> $this->input->post('comentarios'),
            'transferencia'=> $this->input->post('transferencia'),
            'activo'=>1,
            'idusuario' => $this->session->user_id,
            'fecharegistro' => date('Y-m-d H:i:s')
        );

        $response = $this->litho->actualizarlitho($idlitho,$data);
        if($response){
            echo json_encode(['success'=>'Se actualizo la informacion con exito.']);
        }else{
            echo json_encode(['error'=>'No se pudo actualizar la informacion']);
        }
    }
}

public function actualizar_salida()
{
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
        ),
        array(
            'field' => 'transferencia',
            'label' => 'Transferencia',
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
        $idlithosalida = $this->input->post('idlithosalida'); 
        $idparte =  $this->input->post('idparte');
        $cantidad =  $this->input->post('cantidad');

        $total_entrada = 0;
        $total_salida = 0;
        $total_devolucion = 0;

        if($this->litho->totalentradas($idparte)){
            foreach($this->litho->totalentradas($idparte) as $value){
                $total_entrada+=$value->cantidad;   
            }
        }

        if($this->litho->totalsalidaswithout($idparte,$idlithosalida)){
            foreach($this->litho->totalsalidaswithout($idparte,$idlithosalida) as $value){
                $total_salida+=$value->cantidad;   
            }
        }

        if($this->litho->totaldevolucion($idparte)){
            foreach($this->litho->totaldevolucion($idparte) as $value){
                $total_devolucion+=$value->cantidad;   
            }
        }

        $total_1 = $total_salida + $total_devolucion;
        $total_stock = $total_entrada - $total_1;
        if ($cantidad > 0 && $cantidad <= $total_stock) {
            $data = array(
                'cantidad'=> $this->input->post('cantidad'),
                'comentarios'=> $this->input->post('comentarios'),
                'transferencia'=> $this->input->post('transferencia'),
                'activo'=>1,
                'idusuario' => $this->session->user_id,
                'fecharegistro' => date('Y-m-d H:i:s')
            );

            $response = $this->litho->actualizarlithosalida($idlithosalida,$data);
            if($response){
                echo json_encode(['success'=>'Se actualizo la informacion con exito.']);
            }else{
                echo json_encode(['error'=>'No se pudo actualizar la informacion']);
            }
        }else{
            echo json_encode(['error'=>'Ha excedido la cantidad de partes.']);
        }
    }
}

public function eliminar_parte()
{
    $idlitho = $this->input->post('idlitho');
    $idparte = $this->input->post('idparte');

    $data = $this->litho->buscar_fecha_parte_entrada($idlitho,$idparte);

    $date1 = new DateTime(date("Y-m-d H:i:s",time()));
    $date2 = new DateTime($data[0]->fecharegistro);

    $diff = $date2->diff($date1);

    $hours = $diff->h;
    $hours = $hours + ($diff->days*24);

    if($hours < 24){
        $response = $this->litho->eliminar($idlitho);
        if($response){
            echo json_encode(['response'=>true]);    
        }
    }else{
        echo json_encode(['response'=>'time']);
    }
    
}

public function eliminar_parte_salida()
{
    $idlithosalida = $this->input->post('idlithosalida');
    $idparte = $this->input->post('idparte');

    $data = $this->litho->buscar_fecha_parte_salidas($idlithosalida,$idparte);

    $date1 = new DateTime(date("Y-m-d H:i:s",time()));
    $date2 = new DateTime($data[0]->fecharegistro);

    $diff = $date2->diff($date1);

    $hours = $diff->h;
    $hours = $hours + ($diff->days*24);

    if($hours < 24){
        $response = $this->litho->eliminar_salida($idlithosalida);
        if($response){
            echo json_encode(['response'=>true]);    
        }
    }else{
        echo json_encode(['response'=>'time']);
    }
    
}

// Seccion DETALLE [Devoluciones]

public function actualizar_devolucion()
{
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
        ),
        array(
            'field' => 'transferencia',
            'label' => 'Transferencia',
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
        $idlithodevolucion = $this->input->post('idlithodevolucion'); 
        $idparte =  $this->input->post('idparte');
        $cantidad =  $this->input->post('cantidad');

        $total_entrada = 0;
        $total_salida = 0;
        $total_devolucion = 0;

        if($this->litho->totalentradas($idparte)){
            foreach($this->litho->totalentradas($idparte) as $value){
                $total_entrada+=$value->cantidad;   
            }
        }

        if($this->litho->totalsalidas($idparte)){
            foreach($this->litho->totalsalidas($idparte) as $value){
                $total_salida+=$value->cantidad;   
            }
        }

        if($this->litho->totaldevolucioneswithout($idparte,$idlithodevolucion)){
            foreach($this->litho->totaldevolucioneswithout($idparte,$idlithodevolucion) as $value){
                $total_devolucion+=$value->cantidad;   
            }
        }

        $total_1 = $total_salida + $total_devolucion;
        $total_stock = $total_entrada - $total_1;

        if ($cantidad > 0 && $cantidad <= $total_stock) {
            $data = array(
                'idparte'=> $this->input->post('idparte'),
                'cantidad'=> $this->input->post('cantidad'),
                'comentarios'=> $this->input->post('comentarios'),
                'transferencia'=> $this->input->post('transferencia'),
                'activo'=>1,
                'idusuario' => $this->session->user_id,
                'fecharegistro' => date('Y-m-d H:i:s')
            );

            $response = $this->litho->actualizarlithodevolucion($idlithodevolucion,$data);
            if($response){
                echo json_encode(['success'=>'Se actualizo la informacion con exito.']);
            }else{
                echo json_encode(['error'=>'No se pudo actualizar la informacion']);
            }
        }else{
            echo json_encode(['error'=>'Ha excedido la cantidad de partes.']);
        }
    }
}

public function eliminar_parte_devolucion()
{
    $idlithodevolucion = $this->input->post('idlithodevolucion');
    $idparte = $this->input->post('idparte');

    $data = $this->litho->buscar_fecha_parte_devolucion($idlithodevolucion,$idparte);

    $date1 = new DateTime(date("Y-m-d H:i:s",time()));
    $date2 = new DateTime($data[0]->fecharegistro);

    $diff = $date2->diff($date1);

    $hours = $diff->h;
    $hours = $hours + ($diff->days*24);

    if($hours < 24){
        $response = $this->litho->eliminar_devolucion($idlithodevolucion);
        if($response){
            echo json_encode(['response'=>true]);    
        }
    }else{
        echo json_encode(['response'=>'time']);
    }
    
}

}
?>
