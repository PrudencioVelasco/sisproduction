<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Proceso extends CI_Controller {

    function __construct() {
        parent::__construct();

        if (!isset($_SESSION['user_id'])) {
            $this->session->set_flashdata('flash_data', 'You don\'t have access! ss');
            return redirect('login');
        }
        $this->load->helper('url');
        $this->load->model('data_model'); 
        $this->load->model('proceso_model', 'proceso');
        $this->load->library('permission');
        $this->load->library('session');
    }

    public function index() {
        Permission::grant(uri_string());
        $this->load->view('header');
        $this->load->view('proceso/principal');
        $this->load->view('footer');
    }
    public function proceso()
    {
        # code...
         $this->load->view('header');
        $this->load->view('proceso/index');
        $this->load->view('footer');
    }
   
 public function showAllProcesos() {
        
        $query = $this->proceso->showAllProcesos();
        if ($query) {
            $result['procesos'] = $this->proceso->showAllProcesos();
        }
        echo json_encode($result);
    }
 public function addProceso() {
        //Permission::grant(uri_string());
        $config = array(
            array(
                'field' => 'nombreproceso',
                'label' => 'Proceso',
                'rules' => 'trim|required',
                'errors' => array(
                    'required' => 'Campo obligatorio.', 
                )
            )
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
            $result['error'] = true;
            $result['msg'] = array(
                'nombreproceso' => form_error('nombreproceso')
            );
        } else {
             
            $nombreproceso = $this->input->post('nombreproceso');
            $datavalidar = $this->proceso->validadExistenciaNombreProceso($nombreproceso);
            if ($datavalidar == FALSE) {

                $data = array(
                    'nombreproceso' => $nombreproceso,
                    'activo' => 1,
                    'idusuario' => $this->session->user_id,
                    'fecharegistro' => date('Y-m-d H:i:s')
                );
                $this->proceso->addProceso($data);
            } else {
                //El numero de modelo ya existe
                $result['error'] = true;
                $result['msg'] = array(
                    'msgerror' => "El proceso ya esta registrado."
                );
            }
        }
        echo json_encode($result);
    }

public function updateProceso() {
        //Permission::grant(uri_string());
        $config = array(
            array(
                'field' => 'nombreproceso',
                'label' => 'Proceso',
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
                'nombreproceso' => form_error('nombreproceso')
            );
        } else {
            $idproceso = $this->input->post('idproceso');
             $activo = $this->input->post('activo');
            $nombreproceso = $this->input->post('nombreproceso');
            $datavalidar = $this->proceso->validadExistenciaProcesoUpdate($idproceso, $nombreproceso);
            if ($datavalidar == FALSE) {

                $data = array(
                    'nombreproceso' => $nombreproceso,
                    'activo' => $activo,
                    'idusuario' => $this->session->user_id,
                    'fecharegistro' => date('Y-m-d H:i:s')
                    
                );
                $this->proceso->updateProceso($idproceso, $data);
            } else {
                //El numero de modelo ya existe
                $result['error'] = true;
                $result['msg'] = array(
                    'msgerror' => "El proceso ya esta registrado."
                );
            }
        }
        echo json_encode($result);
    }
public function agregar_detalle()
    {
        # code...
        $idproceso = $this->input->post('idproceso');
        $idmaquina = $this->input->post('idmaquina');
        $data_det = $this->proceso->select_maximo_numero($idproceso);
        $validar = $this->proceso->validar_existencia_maquina($idmaquina,$idproceso);
        if($validar == FALSE){
        if($data_det){
            $numero_maximo = $data_det->numero;
            $data = array(
                'idproceso'=>$idproceso,
                'idmaquina'=>$idmaquina,
                'numero'=>$numero_maximo + 1,
                'activo'=>1,
                'idusuario' => $this->session->user_id,
                'fecharegistro' => date('Y-m-d H:i:s') 
            );
            $this->proceso->addDetalleProceso($data);

        }else{
            $data = array(
                'idproceso'=>$idproceso,
                'idmaquina'=>$idmaquina,
                'numero'=>1,
                'activo'=>1,
                'idusuario' => $this->session->user_id,
                'fecharegistro' => date('Y-m-d H:i:s') 
            );
            $this->proceso->addDetalleProceso($data);


        }
    redirect('proceso/ver/'.$idproceso); 

}else{
  
   redirect('proceso/ver/'.$idproceso); 
}

    }
public function ver($idproceso)
{
    # code...
    $data = array(
        'idproceso'=>$idproceso,
        'detalle'=>$this->proceso->detalle_proceso_activo($idproceso),
        'maquinas'=>$this->proceso->maquinas_activas()
    );
       $this->load->view('header');
        $this->load->view('proceso/detalle',$data);
        $this->load->view('footer');
}

public function eliminar()
{
    # code...
    $checkbox1 = $this->input->post('iddetalle');
    $idproceso = $this->input->post('idproceso');
    if(isset($checkbox1) && !empty($checkbox1)){
     foreach ($checkbox1 as $chk1) {
        $id = $chk1;
        $data = array(
            'activo'=>0
        );
        $this->proceso->updateEstatusDetalle($id,$data);
     }

 }

}

public function modificar_posicion()
{
    # code...
    //$page_id = $_POST["page_id_array"];
    //var_dump($_POST["page_id_array"]);
    $i=1;
    foreach ($_POST["page_id_array"] as $value) {
        # code...
       // echo $value;
          $data = array(
            'numero'=>$i++
            );
    // echo $_POST["page_id_array"][$i]."<br>";
     $this->proceso->updateDetalleProceso($value,$data);

    }
     

}

public function entrada()
{
    $data = array(
        'partes'=>$this->proceso->allNumeroPartes(),
        'procesos'=>$this->proceso->showAllProcesos(),
        'procesosiniciados'=>$this->proceso->allParteProcesos()
    );
     $this->load->view('header');
        $this->load->view('proceso/entrada',$data);
        $this->load->view('footer'); 
}
public function eliminar_entrada($identrada)
{
    # code...
    $validacion = $this->proceso->validar_activo_detalle_entrada($identrada);
    if($validacion == FALSE){
        
        $this->proceso->deleteDetalleEntradaPorId($identrada);
        $this->proceso->deleteEntradaPorId($identrada);
    }
    redirect('proceso/entrada/'); 

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
            ),array(
                'field' => 'metaproduccion',
                'label' => 'Meta de Produccion',
                'rules' => 'trim|required|is_natural',
                'errors' => array(
                    'required' => 'Cantidad campo obligatorio.', 
                    'is_natural'=> 'Solo número positivo.'
                )
            ),
             array(
                'field' => 'idlamina',
                'label' => 'Lamina',
                'rules' => 'trim|required',
                'errors' => array(
                    'required' => 'Lamina campo obligatorio.'
                )
            ),
              array(
                'field' => 'idparte',
                'label' => 'Parte',
                'rules' => 'trim|required',
                'errors' => array(
                    'required' => 'Numero Parte campo obligatorio.'
                )
            ),
               array(
                'field' => 'idproceso',
                'label' => 'Proceso',
                'rules' => 'trim|required',
                'errors' => array(
                    'required' => 'Proceso campo obligatorio.'
                )
            )
        );
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE){

            $errors = validation_errors();

            echo json_encode(['error'=>$errors]);


        }else{

            $idproceso = $this->input->post('idproceso');
            $data = array(
                'idparte'=> $this->input->post('idparte'),
                'idlamina'=> $this->input->post('idlamina'),
                'idproceso'=> $this->input->post('idproceso'),
                'metaproduccion'=> $this->input->post('metaproduccion'),
                'cantidad'=> $this->input->post('cantidad'),
                'finalizado'=> 0,
                'eliminado '=>0,
                'idusuario' => $this->session->user_id,
                'fecharegistro' => date('Y-m-d H:i:s')
            );
           $identrada =  $this->proceso->addEntradaProceso($data);
           $detalle = $this->proceso->detalle_proceso($idproceso);
           $numero_paso = $detalle->numero;
           $idmaquina = $detalle->idmaquina;
           $iddetalle = $detalle->iddetalle;

           $data_inicio = array(
            'identradaproceso'=>$identrada,
            'iddetalleproceso'=>$iddetalle,
            'idmaquina'=>$idmaquina,
            'numerodetalleproceso'=>$numero_paso,
            'cantidadentrada'=>$this->input->post('cantidad'),
            'cantidadsalida'=>0,
            'cantidaderronea'=>0, 
            'finalizado'=>0,
            'idusuario' => $this->session->user_id,
            'fecharegistro' => date('Y-m-d H:i:s'),
            'fechaliberado' => date('Y-m-d H:i:s')
           );
           $this->proceso->addInicioProceso($data_inicio);

           echo json_encode(['success'=>'Se agrego la entrada con Exito.']);

        }
}


public function trabajar($idmaquina)
{
    # code... 
    $data = array(
        'registros' =>$this->proceso->allProcesosTrabajar($idmaquina),
        //'scrap'=>$this->proceso->allProcesosScrap(),
        'maquina'=>$idmaquina,
        'detallemaquina'=>$this->proceso->detalle_maquina($idmaquina) );
   
      $this->load->view('header');
        $this->load->view('proceso/trabajar',$data);
        $this->load->view('footer');
}

 public function scrap()
    {
        # code...
         $data = array(
        //'registros' =>$this->proceso->allProcesosTrabajar($idmaquina),
        'registros'=>$this->proceso->allProcesosScrap(),
        'maquina'=>3);
   
      $this->load->view('header');
        $this->load->view('proceso/scrap',$data);
        $this->load->view('footer');
    }


public function test()
{
    # code...
    $detalle = $this->proceso->detalle_proceso_maquina(14,6);
    $numero = $detalle->numero;
    $idproceso = $detalle->idproceso;
    $detalle_siguiente = $this->proceso->siguiente_proceso($numero,$idproceso);
    var_dump($detalle_siguiente);
    if($detalle_siguiente){
        $idnueva_maquina = $detalle_siguiente->idmaquina;
            //Hay que validar si existe registro del siguiente proceso
            //Si es que existe validar si ya fue pasaso al siguiente nivel
            //para saber si se puede modificar
        $validar_det = $this->proceso->validar_existencia_proceso_detalle(18,$idnueva_maquina);
            if($validar_det){
                $finalizado = $validar_det->finalizado;

                //Existe ya registrado ese proceso
                if($finalizado == 0){
                    //Se puedo modificar todavia las cantidades
                }else{
                    //Ya no se pude  modificar porque el siguiente proceso ya esta finalizado

                }

            }else{
                //Se registra en nuevo proceso y se actualiza los datos del anterios proceso

            }
    }else{
        //Ya no hay siguiente paso y finaliza el proceso
    }
}
public function siguiente_proceso_scrap()
{
    # code...

      # code...
         $config = array(
            array(
                'field' => 'cantidadbien',
                'label' => 'cantidadbien',
                'rules' => 'trim|required|is_natural',
                'errors' => array(
                    'required' => 'Cantidad Buenas es campo obligatorio.', 
                    'is_natural'=> 'Solo número positivo.'
                )
            ),
            array(
                'field' => 'cantidaderror',
                'label' => 'cantidaderror',
                'rules' => 'trim|required|is_natural',
                'errors' => array(
                    'required' => 'Cantidad Malas es campo obligatorio.', 
                    'is_natural'=> 'Solo número positivo.'
                )
            )
        );
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE){

            $errors = validation_errors();

            echo json_encode(['error'=>$errors]);


        }else{
            $cantidad =$this->input->post('cantidad');
            $cantidadok =$this->input->post('cantidadbien');
            $cantidaderror =$this->input->post('cantidaderror');
            $iddetalle =$this->input->post('iddetalle');
            $maquina =$this->input->post('maquina');
            $identradaproceso =$this->input->post('identradaproceso');
            $total_sum = ($cantidadok + $cantidaderror);
            if($cantidad == $total_sum){ 

                //Averiguar si un PROCESO DE INSPECCION esta Activo

                $data_validar = $this->proceso->validar_existencia_proceso_activo($identradaproceso,7);
                if($data_validar){
                    //Si hay actvo solo se debe de modificar las cantidades

                      $data_update = array(
                    'cantidadsalida'=>$cantidadok,
                    'cantidaderronea'=>$cantidaderror,
                    'finalizado'=>1,
                    'fechaliberado'=> date('Y-m-d H:i:s')
                 );
                     $this->proceso->updateSeguimientoProceso($iddetalle,$data_update);

                      $data_update_next = array(
                    'cantidadentrada'=>$cantidadok, 
                    'fecharegistro'=> date('Y-m-d H:i:s'),
                    'fechaliberado'=> date('Y-m-d H:i:s')
                        );
                      $id_nuevo=$data_validar->identradadetalleproceso;
                      $this->proceso->updateSeguimientoProceso($id_nuevo,$data_update_next);
 echo json_encode(['success'=>'Se envio la información con exito.']);


                }else{
                      $data_update = array(
                    'cantidadsalida'=>$cantidadok,
                    'cantidaderronea'=>$cantidaderror,
                    'finalizado'=>1,
                    'fechaliberado'=> date('Y-m-d H:i:s')
                 );
                       $this->proceso->updateSeguimientoProceso($iddetalle,$data_update);
                    //Se agregar un nuevo registro
                     $data_inicio = array(
                            'identradaproceso'=>$identradaproceso,
                            'iddetalleproceso'=>0,
                            'idmaquina'=>7,
                            'numerodetalleproceso'=>0,
                            'cantidadentrada'=>$cantidadok,
                            'cantidadsalida'=>0,
                            'cantidaderronea'=>0, 
                            'descrap'=>1,
                            'finalizado'=>0,
                            'idusuario' => $this->session->user_id,
                            'fecharegistro' => date('Y-m-d H:i:s'),
                            'fechaliberado' => date('Y-m-d H:i:s')
                           );
                           $this->proceso->addInicioProceso($data_inicio);
                            echo json_encode(['success'=>'Se envio la información con exito.']);
                }


            }else{
               echo json_encode(['error'=>'Las cantidades debe de coicidir.']);
            }


        }
    }


 
public function siguiente_proceso()
{
    # code...
         $config = array(
            array(
                'field' => 'cantidadbien',
                'label' => 'cantidadbien',
                'rules' => 'trim|required|is_natural',
                'errors' => array(
                    'required' => 'Cantidad Buenas es campo obligatorio.', 
                    'is_natural'=> 'Solo número positivo.'
                )
            ),
            array(
                'field' => 'cantidaderror',
                'label' => 'cantidaderror',
                'rules' => 'trim|required|is_natural',
                'errors' => array(
                    'required' => 'Cantidad Malas es campo obligatorio.', 
                    'is_natural'=> 'Solo número positivo.'
                )
            )
        );
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE){

            $errors = validation_errors();

            echo json_encode(['error'=>$errors]);


        }else{
            $cantidad =$this->input->post('cantidad');
            $cantidadok =$this->input->post('cantidadbien');
            $cantidaderror =$this->input->post('cantidaderror');
            $iddetalle =$this->input->post('iddetalle');
            $maquina =$this->input->post('maquina');
            $identradaproceso =$this->input->post('identradaproceso');
            $total_sum = ($cantidadok + $cantidaderror);
            if($cantidad == $total_sum){ 

    $detalle = $this->proceso->detalle_proceso_maquina($iddetalle,$maquina);
    $numero = $detalle->numero;
    $idproceso = $detalle->idproceso;
    $detalle_siguiente = $this->proceso->siguiente_proceso($numero,$idproceso);
   // var_dump($detalle_siguiente);
    if($detalle_siguiente){
        $idnueva_maquina = $detalle_siguiente->idmaquina;
        $idnueva_numero_proceso = $detalle_siguiente->numero;
         $idnueva_detalle = $detalle_siguiente->iddetalle;
            //Hay que validar si existe registro del siguiente proceso
            //Si es que existe validar si ya fue pasaso al siguiente nivel
            //para saber si se puede modificar
        $validar_det = $this->proceso->validar_existencia_proceso_detalle($identradaproceso,$idnueva_maquina);
            if($validar_det){
                $finalizado = $validar_det->finalizado;

                //Existe ya registrado ese proceso
                if($finalizado == 0){
                    //Se puedo modificar todavia las cantidades
                     $data_update = array(
                    'cantidadsalida'=>$cantidadok,
                    'cantidaderronea'=>$cantidaderror,
                    'finalizado'=>1,
                    'fechaliberado'=> date('Y-m-d H:i:s')
                 );
                     $this->proceso->updateSeguimientoProceso($iddetalle,$data_update);

                     $detalle_next = $this->proceso->detalle_seguimiento_proceso($identradaproceso,$idnueva_maquina);

                      $data_update_next = array(
                    'cantidadentrada'=>$cantidadok, 
                    'fecharegistro'=> date('Y-m-d H:i:s'),
                    'fechaliberado'=> date('Y-m-d H:i:s')
                        );
                      $id_nuevo=$detalle_next->identradadetalleproceso;
                      $this->proceso->updateSeguimientoProceso($id_nuevo,$data_update_next);
                       echo json_encode(['success'=>'Se envio la información con exito.']);

                }else{
                    //Ya no se pude  modificar porque el siguiente proceso ya esta finalizado
                     echo json_encode(['success'=>'Se envio la información con exito.']);

                }

            }else{
                //Se registra en nuevo proceso y se actualiza los datos del anterios proceso
                 $data_update = array(
                    'cantidadsalida'=>$cantidadok,
                    'cantidaderronea'=>$cantidaderror,
                    'finalizado'=>1,
                    'fechaliberado'=> date('Y-m-d H:i:s')
                 );
                     $this->proceso->updateSeguimientoProceso($iddetalle,$data_update);
                         $data_inicio = array(
            'identradaproceso'=>$identradaproceso,
            'iddetalleproceso'=>$idnueva_detalle,
            'idmaquina'=>$idnueva_maquina,
            'numerodetalleproceso'=>$idnueva_numero_proceso,
            'cantidadentrada'=>$cantidadok,
            'cantidadsalida'=>0,
            'cantidaderronea'=>0, 
            'finalizado'=>0,
            'idusuario' => $this->session->user_id,
            'fecharegistro' => date('Y-m-d H:i:s'),
            'fechaliberado' => date('Y-m-d H:i:s')
           );
           $this->proceso->addInicioProceso($data_inicio);


  echo json_encode(['success'=>'Se envio la información con exito.']);
            }
    }else{
         //Ya no hay siguiente paso y finaliza el proceso
        $finalizo_proceso = array(
                   'cantidadsalida'=>$cantidadok,
                    'cantidaderronea'=>$cantidaderror,
                    'finalizado'=>1,
                    'fechaliberado'=> date('Y-m-d H:i:s')
                 );
$this->proceso->updateSeguimientoProceso($iddetalle,$finalizo_proceso);
         $update_finalizo_proceso = array(
                    'finalizado'=>1
                 );

         $this->proceso->updateEntrada($identradaproceso,$update_finalizo_proceso);

         if($cantidaderror > 0){
             $data_inicio = array(
            'identradaproceso'=>$identradaproceso,
            'iddetalleproceso'=>0,
            'idmaquina'=>3,
            'numerodetalleproceso'=>0,
            'cantidadentrada'=>$cantidaderror,
            'cantidadsalida'=>0,
            'cantidaderronea'=>0, 
            'descrap'=>0, 
            'finalizado'=>0,
            'idusuario' => $this->session->user_id,
            'fecharegistro' => date('Y-m-d H:i:s'),
            'fechaliberado' => date('Y-m-d H:i:s')
           );
           $this->proceso->addInicioProceso($data_inicio);

         }

       
         echo json_encode(['success'=>'Se envio la información con exito.']);
    }



            }else{
               echo json_encode(['error'=>'Las cantidades debe de coicidir.']);
            }


        }
    }

    public function ascrap($id,$cantidad)
    {
        # code...

        $data = array(
            'finalizado'=>1,
            'todoascreap'=>1,
            'cantidaderronea'=>$cantidad
        );
        $this->proceso->updateSeguimientoProceso($id,$data);
         $data = array(
        //'registros' =>$this->proceso->allProcesosTrabajar($idmaquina),
        'registros'=>$this->proceso->allProcesosScrap(),
        'maquina'=>3);
   
      $this->load->view('header');
        $this->load->view('proceso/scrap',$data);
        $this->load->view('footer');
    
    }

}

?>
