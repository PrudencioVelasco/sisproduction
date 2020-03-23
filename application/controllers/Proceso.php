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
        'laminas'=>$this->proceso->allNumeroPartesLaminas(),
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
                'field' => 'cantidadrecibida',
                'label' => 'cantidadrecibida',
                'rules' => 'trim|required|is_natural',
                'errors' => array(
                    'required' => 'Cantidad Recibida es campo obligatorio.',
                    'is_natural'=> 'Solo número positivo.'
                )
            )
        );
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE){
            $errors = validation_errors();
            echo json_encode(['error'=>$errors]);


        }else{
            $cantidad_recibida =$this->input->post('cantidadrecibida');
            $cantidad_fg =$this->input->post('fg');
            $cantidad_inspeccion =$this->input->post('inspeccion');
            $cantidad_calidad =$this->input->post('calidad');
            $cantidad_scrap =$this->input->post('scrap');
            $iddetalle =$this->input->post('iddetalle');
            $maquina =$this->input->post('maquina');
            $identradaproceso =$this->input->post('identradaproceso');
            $total_error = ($cantidad_calidad + $cantidad_scrap);
            $total_sum = ($cantidad_inspeccion + $cantidad_calidad + $cantidad_scrap + $cantidad_fg);
            $validar = $this->proceso->detalleProcesoActivo($identradaproceso);
            if($validar == null){
            if($cantidad_recibida == $total_sum){

                //Averiguar si un PROCESO DE INSPECCION esta Activo

                $data_validar = $this->proceso->validar_existencia_proceso_activo($identradaproceso,7);
                if($data_validar){
                    //Si esta activo solo se debe de modificar las cantidades
                     if($cantidad_inspeccion > 0){
                      $data_update = array(
                          'cantidadsalida'=>$cantidad_fg,
                          'cantidadrecibida'=>$cantidad_recibida,
                          'cantidaderronea'=>$total_error,
                          'finalizado'=>1,
                          'fechaliberado'=> date('Y-m-d H:i:s')
                       );
                     $this->proceso->updateSeguimientoProceso($iddetalle,$data_update);
                     //Se eliminan todos los registros de Detalle SCRAP
                     $this->proceso->deleteDetalleScrap($iddetalle);
                     //Se registra nuevamente los registros de Detalle SCRAP
                      $data_fg  = array(
                        'identradadetalleproceso' => $iddetalle,
                        'idmotivoscrap' =>6,
                        'cantidad'=>$cantidad_fg
                       );
                       $this->proceso->addDetalleScrap($data_fg);
                       $data_inspeccion = array(
                         'identradadetalleproceso' => $iddetalle,
                         'idmotivoscrap' =>5,
                         'cantidad'=>$cantidad_inspeccion
                       );
                      $this->proceso->addDetalleScrap($data_inspeccion);
                      $data_calidad = array(
                        'identradadetalleproceso' => $iddetalle,
                        'idmotivoscrap' =>4,
                        'cantidad'=>$cantidad_calidad
                      );
                     $this->proceso->addDetalleScrap($data_calidad);
                     $data_scrap = array(
                       'identradadetalleproceso' => $iddetalle,
                       'idmotivoscrap' =>7,
                       'cantidad'=>$cantidad_scrap
                     );
                    $this->proceso->addDetalleScrap($data_scrap);
                      $data_update_next = array(
                      'cantidadentrada'=>$cantidad_inspeccion,
                      'fecharegistro'=> date('Y-m-d H:i:s'),
                      'fechaliberado'=> date('Y-m-d H:i:s')
                          );
                      $id_nuevo=$data_validar->identradadetalleproceso;
                      $this->proceso->updateSeguimientoProceso($id_nuevo,$data_update_next);
                        echo json_encode(['success'=>'Se envio la información con exito.']);
                    }else {
                      if($cantidad_inspeccion == 0){
                        //Si la cantidad de inspreccion es 0 se dara por finalizado el proceso
                            $data_update = array(
                              'cantidadsalida'=>$cantidad_fg,
                              'cantidadrecibida'=>$cantidad_recibida,
                              'cantidaderronea'=>$total_error,
                              'finalizadotodo'=>1,
                              'finalizado'=>1,
                              'fechaliberado'=> date('Y-m-d H:i:s')
                           );
                           $this->proceso->updateSeguimientoProceso($iddetalle,$data_update);
                           //Se eliminan todos los registros de Detalle SCRAP
                           $this->proceso->deleteDetalleScrap($iddetalle);
                           //Se registra nuevamente los registros de Detalle SCRAP
                            $data_fg  = array(
                              'identradadetalleproceso' => $iddetalle,
                              'idmotivoscrap' =>6,
                              'cantidad'=>$cantidad_fg
                             );
                             $this->proceso->addDetalleScrap($data_fg);
                             $data_inspeccion = array(
                               'identradadetalleproceso' => $iddetalle,
                               'idmotivoscrap' =>5,
                               'cantidad'=>$cantidad_inspeccion
                             );
                            $this->proceso->addDetalleScrap($data_inspeccion);
                            $data_calidad = array(
                              'identradadetalleproceso' => $iddetalle,
                              'idmotivoscrap' =>4,
                              'cantidad'=>$cantidad_calidad
                            );
                           $this->proceso->addDetalleScrap($data_calidad);
                           $data_scrap = array(
                             'identradadetalleproceso' => $iddetalle,
                             'idmotivoscrap' =>7,
                             'cantidad'=>$cantidad_scrap
                           );
                          $this->proceso->addDetalleScrap($data_scrap);
                      }
                    }

                }else{
                  if($cantidad_inspeccion > 0){
                    //Ciclo para saber si se agrega un nuevo registro para Instepeccion
                    //Se actualiza el proceso actual
                      $data_update = array(
                        'cantidadsalida'=>$cantidad_fg,
                        'cantidadrecibida'=>$cantidad_recibida,
                        'cantidaderronea'=>$total_error,
                        'finalizado'=>1,
                        'fechaliberado'=> date('Y-m-d H:i:s')
                     );
                         $this->proceso->updateSeguimientoProceso($iddetalle,$data_update);
                      //Se agregar un nuevo registro para inspeccion
                       $data_inicio = array(
                              'identradaproceso'=>$identradaproceso,
                              'iddetalleproceso'=>0,
                              'idmaquina'=>7,
                              'numerodetalleproceso'=>0,
                              'cantidadentrada'=>$cantidad_inspeccion,
                              'cantidadrecibida'=>$cantidad_recibida,
                              'cantidadsalida'=>0,
                              'cantidaderronea'=>0,
                              'descrap'=>1,
                              'finalizado'=>0,
                              'idusuario' => $this->session->user_id,
                              'fecharegistro' => date('Y-m-d H:i:s'),
                              'fechaliberado' => date('Y-m-d H:i:s')
                             );
                             $this->proceso->addInicioProceso($data_inicio);
                             //Se eliminan todos los registros de Detalle SCRAP
                             $this->proceso->deleteDetalleScrap($iddetalle);
                             //Se registra nuevamente los registros de Detalle SCRAP
                              $data_fg  = array(
                                'identradadetalleproceso' => $iddetalle,
                                'idmotivoscrap' =>6,
                                'cantidad'=>$cantidad_fg
                               );
                               $this->proceso->addDetalleScrap($data_fg);
                               $data_inspeccion = array(
                                 'identradadetalleproceso' => $iddetalle,
                                 'idmotivoscrap' =>5,
                                 'cantidad'=>$cantidad_inspeccion
                               );
                              $this->proceso->addDetalleScrap($data_inspeccion);
                              $data_calidad = array(
                                'identradadetalleproceso' => $iddetalle,
                                'idmotivoscrap' =>4,
                                'cantidad'=>$cantidad_calidad
                              );
                             $this->proceso->addDetalleScrap($data_calidad);
                             $data_scrap = array(
                               'identradadetalleproceso' => $iddetalle,
                               'idmotivoscrap' =>7,
                               'cantidad'=>$cantidad_scrap
                             );
                            $this->proceso->addDetalleScrap($data_scrap);
                              echo json_encode(['success'=>'Se envio la información con exito.']);
                  }else{
                    if($cantidad_inspeccion == 0){
                    //Se registra como finalizado el proceso porque ya no hay material para inspeccionar
                    $data_update = array(
                      'cantidadsalida'=>$cantidad_fg,
                        'cantidadrecibida'=>$cantidad_recibida,
                      'cantidaderronea'=>$total_error,
                      'finalizadotodo'=>1,
                      'finalizado'=>1,
                      'fechaliberado'=> date('Y-m-d H:i:s')
                   );
                       $this->proceso->updateSeguimientoProceso($iddetalle,$data_update);

                       //Se eliminan todos los registros de Detalle SCRAP
                       $this->proceso->deleteDetalleScrap($iddetalle);
                       //Se registra nuevamente los registros de Detalle SCRAP
                        $data_fg  = array(
                          'identradadetalleproceso' => $iddetalle,
                          'idmotivoscrap' =>6,
                          'cantidad'=>$cantidad_fg
                         );
                         $this->proceso->addDetalleScrap($data_fg);
                         $data_inspeccion = array(
                           'identradadetalleproceso' => $iddetalle,
                           'idmotivoscrap' =>5,
                           'cantidad'=>$cantidad_inspeccion
                         );
                        $this->proceso->addDetalleScrap($data_inspeccion);
                        $data_calidad = array(
                          'identradadetalleproceso' => $iddetalle,
                          'idmotivoscrap' =>4,
                          'cantidad'=>$cantidad_calidad
                        );
                       $this->proceso->addDetalleScrap($data_calidad);
                       $data_scrap = array(
                         'identradadetalleproceso' => $iddetalle,
                         'idmotivoscrap' =>7,
                         'cantidad'=>$cantidad_scrap
                       );
                      $this->proceso->addDetalleScrap($data_scrap);
                        echo json_encode(['success'=>'Se envio la información con exito.']);
                     }
                  }

                }


            }else{
               echo json_encode(['error'=>'Las cantidades debe de coicidir.']);
            }
          }else{
             echo json_encode(['error'=>'No se puede reenviar.']);
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
                    'field' => 'cantidadrecibida',
                    'label' => 'cantidadrecibida',
                    'rules' => 'trim|required|is_natural',
                    'errors' => array(
                        'required' => 'Cantidad Recibida es campo obligatorio.',
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
              if($this->input->post('cantidaderror') > 0 && $this->input->post('maquina') == 7){
                $iddetalle =$this->input->post('iddetalle');
                $maquina =$this->input->post('maquina');
                  $detalle = $this->proceso->detalle_proceso_maquina($iddetalle,$maquina);
                  if($detalle->finalizadotodo == 0){
                $config = array(
                   array(
                       'field' => 'porproveedor',
                       'label' => 'porproveedor',
                       'rules' => 'trim|required|is_natural',
                       'errors' => array(
                           'required' => 'Por Proveedor es campo obligatorio.',
                           'is_natural'=> 'Solo número positivo.'
                       )
                   ),
                   array(
                       'field' => 'retrabajo',
                       'label' => 'retrabajo',
                       'rules' => 'trim|required|is_natural',
                       'errors' => array(
                           'required' => 'Retrabajo es campo obligatorio.',
                           'is_natural'=> 'Solo número positivo.'
                       )
                   ),
                   array(
                       'field' => 'descuadre',
                       'label' => 'descuadre',
                       'rules' => 'trim|required|is_natural',
                       'errors' => array(
                           'required' => 'Descuadre es campo obligatorio.',
                           'is_natural'=> 'Solo número positivo.'
                       )
                   )
               );
               $this->form_validation->set_rules($config);

               if ($this->form_validation->run() == FALSE){
                   $errors = validation_errors();
                   echo json_encode(['error'=>$errors]);
                 }else{
                      $cantidad_error =$this->input->post('cantidaderror');
                      $cantidad_porproveedor =$this->input->post('porproveedor');
                      $cantidad_retrabajo =$this->input->post('retrabajo');
                      $cantidad_descuadre =$this->input->post('descuadre');
                      $suma_error = ($cantidad_porproveedor + $cantidad_retrabajo + $cantidad_descuadre);

                      if($cantidad_error == $suma_error){
                        $cantidad = $this->input->post('cantidad');
                        $cantidadok =$this->input->post('cantidadbien');
                        $cantidadrecibida =$this->input->post('cantidadrecibida');
                        $cantidaderror =$this->input->post('cantidaderror');
                        $iddetalle =$this->input->post('iddetalle');
                        $maquina =$this->input->post('maquina');
                        $identradaproceso =$this->input->post('identradaproceso');
                        $total_sum = ($cantidadok + $cantidaderror);

                        if($total_sum == $cantidadrecibida){

                $detalle = $this->proceso->detalle_proceso_maquina($iddetalle,$maquina);
                $numero = $detalle->numero;
                $idproceso = $detalle->idproceso;
                $detalle_siguiente = $this->proceso->siguiente_proceso($numero,$idproceso);
                $id = $detalle->identradadetalleproceso;
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
                                'cantidadrecibida'=>$cantidadrecibida,
                                'finalizado'=>1,
                                'fechaliberado'=> date('Y-m-d H:i:s')
                             );
                                 $this->proceso->updateSeguimientoProceso($iddetalle,$data_update);

                                 $this->proceso->deleteDetalleScrapEnviar($iddetalle);
                                   $data_detalle_scrap_proproveedor = array(
                                            'identradadetalleproceso'=>$iddetalle,
                                            'idmotivoscrap'=>1,
                                            'cantidad'=>$cantidad_porproveedor
                                        );
                                        $this->proceso->addDetalleScrap($data_detalle_scrap_proproveedor);
                                        $data_detalle_scrap_descuadre = array(
                                            'identradadetalleproceso'=>$iddetalle,
                                            'idmotivoscrap'=>2,
                                            'cantidad'=>$cantidad_descuadre
                                        );
                                        $this->proceso->addDetalleScrap($data_detalle_scrap_descuadre);
                                        $data_detalle_scrap_retrabajo = array(
                                            'identradadetalleproceso'=>$iddetalle,
                                            'idmotivoscrap'=>3,
                                            'cantidad'=>$cantidad_retrabajo
                                        );
                                     $this->proceso->addDetalleScrap($data_detalle_scrap_retrabajo);
                                 $detalle_next = $this->proceso->detalle_seguimiento_proceso($identradaproceso,$idnueva_maquina);

                                  $data_update_next = array(
                                'cantidadentrada'=>$cantidadok,
                                'fecharegistro'=> date('Y-m-d H:i:s'),
                                'fechaliberado'=> date('Y-m-d H:i:s')
                                    );
                                  $id_nuevo=$detalle_next->identradadetalleproceso;
                                  $this->proceso->updateSeguimientoProceso($id_nuevo,$data_update_next);
                                   echo json_encode(['success'=>'1 Se envios la información con exito.'+$iddetalle]);

                            }else{
                                //Ya no se pude  modificar porque el siguiente proceso ya esta finalizado
                                 echo json_encode(['error'=>'No se puede enviar nuevamente.']);

                            }

                        }else{
                            //Se registra en nuevo proceso y se actualiza los datos del anterios proceso
                             $data_update = array(
                                'cantidadsalida'=>$cantidadok,
                                'cantidaderronea'=>$cantidaderror,
                                'cantidadrecibida'=>$cantidadrecibida,
                                'finalizado'=>1,
                                'fechaliberado'=> date('Y-m-d H:i:s')
                             );
                                  $this->proceso->deleteDetalleScrapEnviar($iddetalle);
                                   $data_detalle_scrap_proproveedor = array(
                                            'identradadetalleproceso'=>$iddetalle,
                                            'idmotivoscrap'=>1,
                                            'cantidad'=>$cantidad_porproveedor
                                        );
                                        $this->proceso->addDetalleScrap($data_detalle_scrap_proproveedor);
                                        $data_detalle_scrap_descuadre = array(
                                            'identradadetalleproceso'=>$iddetalle,
                                            'idmotivoscrap'=>2,
                                            'cantidad'=>$cantidad_descuadre
                                        );
                                        $this->proceso->addDetalleScrap($data_detalle_scrap_descuadre);
                                        $data_detalle_scrap_retrabajo = array(
                                            'identradadetalleproceso'=>$iddetalle,
                                            'idmotivoscrap'=>3,
                                            'cantidad'=>$cantidad_retrabajo
                                        );
                                     $this->proceso->addDetalleScrap($data_detalle_scrap_retrabajo);

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


              echo json_encode(['success'=>'2 Se envioss la información con exito.'+$iddetalle]);
                        }
                }else{

                     //Ya no hay siguiente paso y finaliza el proceso
                    $finalizo_proceso = array(
                                'cantidadsalida'=>$cantidadok,
                                'cantidaderronea'=>$cantidaderror,
                                'cantidadrecibida'=>$cantidadrecibida,
                                'finalizado'=>1,
                                'fechaliberado'=> date('Y-m-d H:i:s')
                             );
                    $this->proceso->updateSeguimientoProceso($iddetalle,$finalizo_proceso);
                    $update_finalizo_proceso = array(
                                'finalizado'=>1
                             );

                     $this->proceso->updateEntrada($identradaproceso,$update_finalizo_proceso);

                     if($cantidaderror > 0){
                       $this->proceso->deleteDetalleScrapPorProceso($identradaproceso,3);
                       $this->proceso->deleteProceso($identradaproceso,3);
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
                      $idscrap = $this->proceso->addInicioProceso($data_inicio);
                        $this->proceso->deleteDetalleScrapEnviar($iddetalle);
                       $data_detalle_scrap_proproveedor = array(
                         'identradadetalleproceso'=>$idscrap,
                         'idmotivoscrap'=>1,
                         'cantidad'=>$cantidad_porproveedor
                       );
                       $this->proceso->addDetalleScrap($data_detalle_scrap_proproveedor);
                       $data_detalle_scrap_descuadre = array(
                         'identradadetalleproceso'=>$idscrap,
                         'idmotivoscrap'=>2,
                         'cantidad'=>$cantidad_descuadre
                       );
                       $this->proceso->addDetalleScrap($data_detalle_scrap_descuadre);
                       $data_detalle_scrap_retrabajo = array(
                         'identradadetalleproceso'=>$idscrap,
                         'idmotivoscrap'=>3,
                         'cantidad'=>$cantidad_retrabajo
                       );
                       $this->proceso->addDetalleScrap($data_detalle_scrap_retrabajo);
                     }else{

                       //Finaliza todo el proceso porque ya no hay errores
                       $update_finalizo_proceso2 = array(
                                   'finalizadotodo'=>1
                                );

                        $this->proceso->updateSeguimientoProceso($iddetalle,$update_finalizo_proceso2);
                   }



                     echo json_encode(['success'=>'3 Se envioss la información con exito.']);
                }



                        }else{
                           echo json_encode(['error'=>'Las cantidades debe de coicidir.']);
                        }

                      }else{
                         echo json_encode(['error'=>'Las cantidades de Material Mal deben de coicidir.']);
                      }
                 }
               }else{
                 echo json_encode(['error'=>'No se puede reenviar.']);
               }

              }else{
                $iddetalle =$this->input->post('iddetalle');
                $maquina =$this->input->post('maquina');
                $detalle = $this->proceso->detalle_proceso_maquina($iddetalle,$maquina);
                if($detalle->finalizadotodo == 0){
                $cantidad =$this->input->post('cantidad');
                $cantidadok =$this->input->post('cantidadbien');
                $cantidadrecibida =$this->input->post('cantidadrecibida');
                $cantidaderror =$this->input->post('cantidaderror');

                $identradaproceso =$this->input->post('identradaproceso');
                $total_sum = ($cantidadok + $cantidaderror);
                  $this->proceso->deleteDetalleScrapEnviar($iddetalle);
                if($total_sum == $cantidadrecibida){


        $numero = $detalle->numero;
        $idproceso = $detalle->idproceso;
        $detalle_siguiente = $this->proceso->siguiente_proceso($numero,$idproceso);
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
                        'cantidadrecibida'=>$cantidadrecibida,
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
                           echo json_encode(['success'=>'3 Se envio la información con exito.']);

                    }else{
                        //Ya no se pude  modificar porque el siguiente proceso ya esta finalizado
                         echo json_encode(['error'=>'No se puede modificar el Envio.']);

                    }

                }else{
                    //Se registra en nuevo proceso y se actualiza los datos del anterios proceso
                     $data_update = array(
                        'cantidadsalida'=>$cantidadok,
                        'cantidaderronea'=>$cantidaderror,
                        'cantidadrecibida'=>$cantidadrecibida,
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


      echo json_encode(['success'=>'4 Se envio la información con exito.']);
                }
        }else{
             //Ya no hay siguiente paso y finaliza el proceso
            $finalizo_proceso = array(
                        'cantidadsalida'=>$cantidadok,
                        'cantidaderronea'=>$cantidaderror,
                        'cantidadrecibida'=>$cantidadrecibida,
                        'finalizado'=>1,
                        'fechaliberado'=> date('Y-m-d H:i:s')
                     );
            $this->proceso->updateSeguimientoProceso($identradaproceso,$finalizo_proceso);
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
                'cantidadsalida'=>$cantidadok,
                'cantidadrecibida'=>$cantidadrecibida,
                'cantidaderronea'=>0,
                'descrap'=>0,
                'finalizado'=>0,
                'idusuario' => $this->session->user_id,
                'fecharegistro' => date('Y-m-d H:i:s'),
                'fechaliberado' => date('Y-m-d H:i:s')
               );
               $this->proceso->addInicioProceso($data_inicio);
             }else{
               //Elimina detalle SCRAP y lo de detalle proceso
               $this->proceso->deleteDetalleScrapPorProceso($identradaproceso,3);
               $this->proceso->deleteProceso($identradaproceso,3);
               //Finaliza todo el proceso porque ya no hay errores
               $update_finalizo_proceso2 = array(
                          'cantidadsalida'=>$cantidadok,
                          'cantidadrecibida'=>$cantidadrecibida,
                          'cantidaderronea'=>$cantidaderror,
                           'finalizadotodo'=>1,
                           'finalizado'=>1
                        );

                $this->proceso->updateSeguimientoProceso($iddetalle,$update_finalizo_proceso2);
           }


             echo json_encode(['success'=>'5 Se envio la información con exito.']);
        }



                }else{
                   echo json_encode(['error'=>'Las cantidades debe de coicidir.']);
                }

              }
            else{
               echo json_encode(['error'=>'No se puede reenviar.']);
            }
            }
        }
      }
    public function ascrap($id,$cantidad)
    {
        # code...

        $data = array(
            'finalizado'=>1,
            'todoascreap'=>1,
            'finalizadotodo'=>1,
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
