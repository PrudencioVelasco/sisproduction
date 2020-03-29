<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Catalogo extends CI_Controller {

    function __construct() {
        parent::__construct();

        if (!isset($_SESSION['user_id'])) {
            $this->session->set_flashdata('flash_data', 'You don\'t have access! ss');
            return redirect('login');
        }
        $this->load->helper('url');
        $this->load->model('data_model');
        $this->load->model('user_model', 'user');
        $this->load->model('client_model', 'cliente');
        $this->load->model('turno_model', 'turno');
        $this->load->model('parte_model', 'parte');
        $this->load->model('motivorechazo_model', 'motivo');
        $this->load->model('ubicacion_model', 'ubicacion');
        $this->load->model('linea_model', 'linea');
        $this->load->model('admin_model', 'adminmodel');
        $this->load->model('categorias_model', 'categorias');
        $this->load->model('documento_model', 'documento');
        $this->load->model('transferencia_model', 'transferencia');
        $this->load->library('permission');
        $this->load->library('session');
        $this->load->library('excel');
    }

    public function index() {
        Permission::grant(uri_string());
        $totalusuarios = count($this->user->showAll());
        $totalcliente = count($this->cliente->showAll());
        $totalturno = count($this->turno->showAll());
        $totalnumeroparte = count($this->parte->showAll());
        $totalubicacion = count($this->ubicacion->showAll());
        $totalmotivo = count($this->motivo->showAll());
        $totallinea = count($this->linea->showAllLinea());
        $totalcategorias = count($this->categorias->showAll());
        $data = array(
            'totalusuario' => $totalusuarios,
            'totalcliente' => $totalcliente,
            'totalturno' => $totalturno,
            'totalubicacion' => $totalubicacion,
            'totalnumeroparte' => $totalnumeroparte,
            'totallinea' => $totallinea,
            'totalcategorias' => $totalcategorias,
            'totalmotivo' => $totalmotivo);
        $this->load->view('header');
        $this->load->view('catalogo/index', $data);
        $this->load->view('footer');
    }

    public function subir() {
        //$datos= $this->documento->showAllDocumentos();
        //var_dump($datos);
        $data = array(
            'datos' => $this->documento->showAllDocumentos()
        );
        $this->load->view('header');
        $this->load->view('CatSistema/inventario/index', $data);
        $this->load->view('footer');
    }
    public function partes() {
        $this->load->view('header');
        $this->load->view('CatSistema/inventario/partes');
        $this->load->view('footer');
    }
    public function detalle($id_detalle) {
        $data = array(
            'ididentificador' => $id_detalle,
            'datos' => $this->documento->showAllDocumentosId($id_detalle)
        );
    //var_dump($this->documento->showAllDocumentosId($id_detalle));
        $this->load->view('header');
        $this->load->view('CatSistema/inventario/detalle', $data);
        $this->load->view('footer');
    }

    public function comparar() {

        $validate = array(
            array(
                'field' => 'identificador',
                'label' => 'Numero identificador',
                'rules' => 'trim|required|xss_clean|callback_identificador_exists',
                'errors' => array(
                    'required' => 'Campo obligatorio.'
                )
            )
        );

        $this->form_validation->set_rules($validate);
        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'datos' => $this->documento->showAllDocumentos()
            );
            $this->load->view('header');
            $this->load->view('CatSistema/inventario/index', $data);
            $this->load->view('footer');
        } else {
            $identificador = $this->input->post('identificador');
            $mi_archivo = 'mi_archivo';
            $config['upload_path'] = "archivos/";
            $config['file_name'] = 'Invetario ' . date("Y-m-d his");
            $config['allowed_types'] = "*";
            $config['max_size'] = "50000";
            $config['max_width'] = "2000";
            $config['max_height'] = "2000";

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload($mi_archivo)) {
                //*** ocurrio un error
                $data['uploadError'] = $this->upload->display_errors();
                echo $this->upload->display_errors();
                return;
            }

            $data['uploadSuccess'] = $this->upload->data();
            $ruta = $data['uploadSuccess']['full_path'];
            $inputFileName = $ruta;
            $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
            $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
            $arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel sheet
            $datos = array();
            for ($i = 2; $i <= $arrayCount; $i++) {
                $numeroparte = $allDataInSheet[$i]["A"];
                $modelo = $allDataInSheet[$i]["B"];
                $revision = $allDataInSheet[$i]["C"];
                $cantidad_cajas = $allDataInSheet[$i]["D"];
                $total_pallet = $allDataInSheet[$i]["E"];
                $cliente = $allDataInSheet[$i]["F"];
                $proveedor = $allDataInSheet[$i]["G"];
                $locacion = $allDataInSheet[$i]["H"];
                $categoria = $allDataInSheet[$i]["I"];
                if (!empty($cantidad_cajas) && $cantidad_cajas > 0 && !empty($modelo)) {
                    $data_insert = array(
                        'identificador' => $identificador,
                        'numeroparte' => $numeroparte,
                        'modelo' => $modelo,
                        'revision' => $revision,
                        'cantidadcajas' => $cantidad_cajas,
                        'cantidadpallet' => $total_pallet,
                        'cliente' => $cliente,
                        'proveedor' => $proveedor,
                        'locacion' => $locacion,
                        'fechaentrada' => "",
                        'categoria' => $categoria,
                        'idusuario' => $this->session->user_id,
                        'fecharegistro' => date('Y-m-d H:i:s')
                    );
                    $this->documento->insert($data_insert);
                }

                /*  //Validar que no tengan el total en 0
                  if (!empty($cantidad_cajas) && $cantidad_cajas > 0) {
                  //Validar si el cliente existe en la Base de datos
                  if (!empty($cantidad_cajas) && $this->cliente->validadIdCliente($cliente) != false) {

                  } else {
                  //El cliente no existe en la Base de Datos o
                  //En la columna de cliente esta vacio
                  $datos[$i] = array();
                  $datos[$i]['numeroparte'] = $numeroparte;
                  $datos[$i]['modelo'] = $modelo;
                  $datos[$i]['revision'] = $revision;
                  $datos[$i]['totalcajas'] = $cantidad_cajas;
                  $datos[$i]['totalpallet'] = $total_pallet;
                  $datos[$i]['cliente'] = $cliente;
                  $datos[$i]['proveedor'] = $proveedor;
                  $datos[$i]['locacion'] = $locacion;
                  $datos[$i]['fechaentrada'] ="";
                  $datos[$i]['categoria'] = $categoria;
                  }
                  } else {
                  //La calumna de cantidad de cajas esta vacia o tiene como total
                  //de registros como 0
                  $datos[$i] = array();
                  $datos[$i]['numeroparte'] = $numeroparte;
                  $datos[$i]['modelo'] = $modelo;
                  $datos[$i]['revision'] = $revision;
                  $datos[$i]['totalcajas'] = $cantidad_cajas;
                  $datos[$i]['totalpallet'] = $total_pallet;
                  $datos[$i]['cliente'] = $cliente;
                  $datos[$i]['proveedor'] = $proveedor;
                  $datos[$i]['locacion'] = $locacion;
                  $datos[$i]['fechaentrada'] ="";
                  $datos[$i]['categoria'] = $categoria;

                  } */
            }
            $data = array(
                'datos' => $this->documento->showAllDocumentos()
            );
            $this->load->view('header');
            $this->load->view('CatSistema/inventario/index', $data);
            $this->load->view('footer');
            // Crea un nuevo objeto PHPExcel
            // load excel library
            /*
              $listInfo = $this->cliente->showAllClientes();

              $object = new PHPExcel();
              $object->setActiveSheetIndex(0);
              $table_columns = array('Numero de parte', 'Modelo', 'Revision', 'Total cajas', 'Total pallet', 'Cliente', 'Proveedor', 'Locacion', 'Fecha entrada almacen', 'Categoria');
              $column = 1;
              foreach ($table_columns as $dd) {
              $object->getActiveSheet()->setCellValueByColumnAndRow($column, 0, $dd);
              $column++;
              }

              $object->setActiveSheetIndex(0)
              ->setCellValue('A1', 'Numero de parte')
              ->setCellValue('B1', 'Modelo')
              ->setCellValue('C1', 'Revision')
              ->setCellValue('D1', 'Total cajas')
              ->setCellValue('E1', 'Total pallet')
              ->setCellValue('F1', 'Cliente')
              ->setCellValue('G1', 'Proveedor')
              ->setCellValue('H1', 'Locacion')
              ->setCellValue('I1', 'Fecha entrada almacen')
              ->setCellValue('J1', 'Categoria')
              ->setCellValue('k1', 'Categoria');

              $row_no = 2;
              foreach ($datos as $value) {
              $object->getActiveSheet()->setCellValueByColumnAndRow(0, $row_no, $value["numeroparte"]);
              $object->getActiveSheet()->setCellValueByColumnAndRow(1, $row_no, $value["modelo"]);
              $object->getActiveSheet()->setCellValueByColumnAndRow(2, $row_no, $value["revision"]);
              $object->getActiveSheet()->setCellValueByColumnAndRow(3, $row_no, $value["totalcajas"]);
              $object->getActiveSheet()->setCellValueByColumnAndRow(4, $row_no, $value["totalpallet"]);
              $object->getActiveSheet()->setCellValueByColumnAndRow(5, $row_no, $value["cliente"]);
              $object->getActiveSheet()->setCellValueByColumnAndRow(6, $row_no, $value["proveedor"]);
              $object->getActiveSheet()->setCellValueByColumnAndRow(7, $row_no, $value["locacion"]);
              $object->getActiveSheet()->setCellValueByColumnAndRow(8, $row_no, $value["fechaentrada"]);
              $object->getActiveSheet()->setCellValueByColumnAndRow(9, $row_no, $value["categoria"]);
              $object->getActiveSheet()->setCellValueByColumnAndRow(10, $row_no, $value["categoria"]);
              $row_no++;
              }
              ob_end_clean();
              header('Content-Type: application/vnd.ms-excel'); //mime type
              header("Content-Disposition: attachment; filename=\"filename.xls\"");
              header("Cache-Control: max-age=0");
              $objWriter = PHPExcel_IOFactory::createWriter($object, 'Excel5');
              $objWriter->save('php://output');
             */
        }
    }

    public function compararparte() {


            $identificador = $this->input->post('identificador');
            $mi_archivo = 'mi_archivo';
            $config['upload_path'] = "archivos/";
            $config['file_name'] = 'Invetario ' . date("Y-m-d his");
            $config['allowed_types'] = "*";
            $config['max_size'] = "50000";
            $config['max_width'] = "2000";
            $config['max_height'] = "2000";

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload($mi_archivo)) {
                //*** ocurrio un error
                $data['uploadError'] = $this->upload->display_errors();
                echo $this->upload->display_errors();
                return;
            }

            $data['uploadSuccess'] = $this->upload->data();
            $ruta = $data['uploadSuccess']['full_path'];
            $inputFileName = $ruta;
            $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
            $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
            $arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel sheet
            $datos = array();
            for ($i = 2; $i <= $arrayCount; $i++) {
                $numeroparte = trim($allDataInSheet[$i]["A"]);
                $modelo = trim($allDataInSheet[$i]["B"]);
                $revision = trim($allDataInSheet[$i]["C"]);
                $cantidad = trim($allDataInSheet[$i]["D"]);
                //VALIDAR EXISTE DE NUMERO DE PARTE
                $validar_parte = $this->documento->validar_existencia_numeroparte($numeroparte);
                if($validar_parte){
                  //EXISTE REGISTRADO EL NUMERO DE PARTE
                  $idnumeroparte = $validar_parte->idparte;
                  //VALIDAR SI EXISTE EL MODELO
                  $validar_modelo = $this->documento->validar_numeroparte_modelo($idnumeroparte,$modelo);
                  if ($validar_modelo) {
                    //EXISTE EL MODELO
                    $idmodelo = $validar_modelo->idmodelo;
                    //VALIDAR SI EXISTE LA REVISION
                    $validar_revision = $this->documento->validar_modelo_revision($idmodelo,$revision);
                    if ($validar_revision) {
                      //LA REVISION YA ESTA DADO DE ALATA
                      $idrevision = $validar_revision->idrevision;
                      $data_entrada  = array(
                        'idcategoria' =>6,
                        'idrevision'=>$idrevision,
                        'cantidad'=>$cantidad,
                        'comentarios'=>"",
                        'transferencia'=>"",
                        'activo'=>1,
                        'idusuario' => $this->session->user_id,
                        'fecharegistro' => date('Y-m-d H:i:s')
                      );

                        $this->documento->addEntrada($data_entrada);
                    } else {
                      //LA REVISION NO ESTA DADO DE ALTA
                      $data_revision = array(
                          'idmodelo' => $idmodelo,
                          'descripcion' => $revision,
                          'idusuario' => $this->session->user_id,
                          'fecharegistro' => date('Y-m-d H:i:s')
                      );
                      $idrevision = $this->documento->addRevision($data_revision);
                      $data_entrada  = array(
                        'idcategoria' =>6,
                        'idrevision'=>$idrevision,
                        'cantidad'=>$cantidad,
                        'comentarios'=>"",
                        'transferencia'=>"",
                        'activo'=>1,
                        'idusuario' => $this->session->user_id,
                        'fecharegistro' => date('Y-m-d H:i:s')
                      );

                        $this->documento->addEntrada($data_entrada);
                    }

                  } else {
                    //NO EXISTE EL MODELO Y SE AGREGARA
                    $data_modelo = array(
                        'idparte' => $idnumeroparte,
                        'descripcion' => $modelo,
                        'nombrehoja' => "",
                        'customer' => "",
                        'fulloneimpresion' => "",
                        'colorlinea' => "",
                        'diucutno' => "",
                        'platonumero' => "",
                        'color' => "",
                        'blanksize' => "",
                        'sheetsize' => "",
                        'score' => "",
                        'normascompartidas' => "",
                        'salida' => "",
                        'combinacion' =>"",
                        'medida' => "",
                        'combinacion' => "",
                        'idusuario' => $this->session->user_id,
                        'fecharegistro' => date('Y-m-d H:i:s')
                    );
                    $idmodelo = $this->documento->addModelo($data_modelo);
                    $validar_revision = $this->documento->validar_modelo_revision($idmodelo,$revision);
                    if ($validar_revision) {
                      //LA REVISION YA ESTA DADO DE ALATA
                      $idrevision = $validar_revision->idrevision;
                      $data_entrada  = array(
                        'idcategoria' =>6,
                        'idrevision'=>$idrevision,
                        'cantidad'=>$cantidad,
                        'comentarios'=>"",
                        'transferencia'=>"",
                        'activo'=>1,
                        'idusuario' => $this->session->user_id,
                        'fecharegistro' => date('Y-m-d H:i:s')
                      );

                        $this->documento->addEntrada($data_entrada);
                    } else {
                      //LA REVISION NO ESTA DADO DE ALTA
                      $data_revision = array(
                          'idmodelo' => $idmodelo,
                          'descripcion' => $revision,
                          'idusuario' => $this->session->user_id,
                          'fecharegistro' => date('Y-m-d H:i:s')
                      );
                      $idrevision = $this->documento->addRevision($data_revision);
                      $data_entrada  = array(
                        'idcategoria' =>6,
                        'idrevision'=>$idrevision,
                        'cantidad'=>$cantidad,
                        'comentarios'=>"",
                        'transferencia'=>"",
                        'activo'=>1,
                        'idusuario' => $this->session->user_id,
                        'fecharegistro' => date('Y-m-d H:i:s')
                      );

                        $this->documento->addEntrada($data_entrada);
                    }
                  }

                }else{
                  //NO EXISTE EL NUMERO DE PARTE Y SE AGREGARA
                  $data_parte = array(
                    'numeroparte'=>$numeroparte,
                    'idcliente'=>1,
                    'idcategoria'=>6,
                    'idusuario' => $this->session->user_id,
                    'activo'=>1,
                    'fecharegistro' => date('Y-m-d H:i:s')
                  );
                  $idnumeroparte = $this->documento->addParte($data_parte);
                  //VALIDAR SI EXISTE EL MODELO
                  $validar_modelo = $this->documento->validar_numeroparte_modelo($idnumeroparte,$modelo);
                  if ($validar_modelo) {
                    //EXISTE EL MODELO
                    $idmodelo = $validar_modelo->idmodelo;
                    //VALIDAR SI EXISTE LA REVISION
                    $validar_revision = $this->documento->validar_modelo_revision($idmodelo,$revision);
                    if ($validar_revision) {
                      //LA REVISION YA ESTA DADO DE ALATA
                      $idrevision = $validar_revision->idrevision;
                      $data_entrada  = array(
                        'idcategoria' =>6,
                        'idrevision'=>$idrevision,
                        'cantidad'=>$cantidad,
                        'comentarios'=>"",
                        'transferencia'=>"",
                        'activo'=>1,
                        'idusuario' => $this->session->user_id,
                        'fecharegistro' => date('Y-m-d H:i:s')
                      );

                        $this->documento->addEntrada($data_entrada);
                    } else {
                      //LA REVISION NO ESTA DADO DE ALTA
                      $data_revision = array(
                          'idmodelo' => $idmodelo,
                          'descripcion' => $revision,
                          'idusuario' => $this->session->user_id,
                          'fecharegistro' => date('Y-m-d H:i:s')
                      );
                      $idrevision = $this->documento->addRevision($data_revision);
                      $data_entrada  = array(
                        'idcategoria' =>6,
                        'idrevision'=>$idrevision,
                        'cantidad'=>$cantidad,
                        'comentarios'=>"",
                        'transferencia'=>"",
                        'activo'=>1,
                        'idusuario' => $this->session->user_id,
                        'fecharegistro' => date('Y-m-d H:i:s')
                      );

                        $this->documento->addEntrada($data_entrada);
                    }

                  } else {
                    //NO EXISTE EL MODELO Y SE AGREGARA
                    $data_modelo = array(
                        'idparte' => $idnumeroparte,
                        'descripcion' => $modelo,
                        'nombrehoja' => "",
                        'customer' => "",
                        'fulloneimpresion' => "",
                        'colorlinea' => "",
                        'diucutno' => "",
                        'platonumero' => "",
                        'color' => "",
                        'blanksize' => "",
                        'sheetsize' => "",
                        'score' => "",
                        'normascompartidas' => "",
                        'salida' => "",
                        'combinacion' =>"",
                        'medida' => "",
                        'combinacion' => "",
                        'idusuario' => $this->session->user_id,
                        'fecharegistro' => date('Y-m-d H:i:s')
                    );
                    $idmodelo = $this->documento->addModelo($data_modelo);
                    $validar_revision = $this->documento->validar_modelo_revision($idmodelo,$revision);
                    if ($validar_revision) {
                      //LA REVISION YA ESTA DADO DE ALATA
                      $idrevision = $validar_revision->idrevision;
                      $data_entrada  = array(
                        'idcategoria' =>6,
                        'idrevision'=>$idrevision,
                        'cantidad'=>$cantidad,
                        'comentarios'=>"",
                        'transferencia'=>"",
                        'activo'=>1,
                        'idusuario' => $this->session->user_id,
                        'fecharegistro' => date('Y-m-d H:i:s')
                      );

                        $this->documento->addEntrada($data_entrada);
                    } else {
                      //LA REVISION NO ESTA DADO DE ALTA
                      $data_revision = array(
                          'idmodelo' => $idmodelo,
                          'descripcion' => $revision,
                          'idusuario' => $this->session->user_id,
                          'fecharegistro' => date('Y-m-d H:i:s')
                      );
                      $idrevision = $this->documento->addRevision($data_revision);
                      $data_entrada  = array(
                        'idcategoria' =>6,
                        'idrevision'=>$idrevision,
                        'cantidad'=>$cantidad,
                        'comentarios'=>"",
                        'transferencia'=>"",
                        'activo'=>1,
                        'idusuario' => $this->session->user_id,
                        'fecharegistro' => date('Y-m-d H:i:s')
                      );

                        $this->documento->addEntrada($data_entrada);
                    }
                  }
                }

            }
            $this->load->view('header');
            $this->load->view('CatSistema/inventario/partes');
            $this->load->view('footer');

    }

    function identificador_exists($identificador) {

        $user_check = $this->documento->validarIdentificador($identificador);

        if ($user_check != false) {
            $this->form_validation->set_message('identificador_exists', 'El identificador ya existe.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function operacion() {
        $formdata = $this->input->post();

        $ididentificador = $this->input->post('ididentificador');
        if (isset($formdata['subir'])) {
          $checkbox1 = $this->input->post('table_records');
            $datos = array();
            //Subir
            $i = 0;
            foreach ($checkbox1 as $chk1) {
                $i++;
                $id = $chk1;
                $row = $this->documento->detalleDocumento($id);
                $numeroparte = trim($row->numeroparte);
                $modelo = trim($row->modelo);
                $idcliente = trim($row->cliente);
                $idcategoria = trim($row->categoria);
                $revision = trim($row->revision);
                $locacion2 = trim($row->locacion);
                $cantidad_cajas = trim($row->cantidadcajas);
                $validar_numero_parte = $this->documento->validar_existencia_numeroparte($numeroparte);
                //var_dump($validar_numero_parte);
                if ($validar_numero_parte) {
                    //El numero de parte existe
                    $idparte = $validar_numero_parte->idparte;
                    $detalle_parte_modelo = $this->documento->validar_numeroparte_modelo($idparte, $modelo);
                    if ($detalle_parte_modelo) {
                        //El mode existe
                        $idmodelo = $detalle_parte_modelo->idmodelo;
                        $datelle_modelo_revision = $this->documento->validar_modelo_revision($idmodelo, $revision);
                        if ($datelle_modelo_revision) {
                            //La revision si existe
                            //var_dump($datelle_modelo_revision);
                            $idrevision = $datelle_modelo_revision->idrevision;
                            $detalle_revision_cantidad = $this->documento->validar_revision_cantidad($idrevision, $cantidad_cajas);
                            if ($detalle_revision_cantidad) {
                                //Si existe la cantidad
                                $idcantidad = $detalle_revision_cantidad->idcantidad;
                                $datos[$i] = array();
                                $datos[$i]['idcantidad'] = $idcantidad;
                                 $datos[$i]['locat'] = $locacion2;
                            } else {
                                //No existe la cantidad
                                $data_insert_cantidad = array(
                                    'idrevision' => $idrevision,
                                    'cantidad' => $cantidad_cajas,
                                    'idusuario' => $this->session->user_id,
                                    'fecharegistro' => date('Y-m-d H:i:s')
                                );
                                $idcantidad = $this->documento->addCantidad($data_insert_cantidad);
                                $datos[$i] = array();
                                $datos[$i]['idcantidad'] = $idcantidad;
                                $datos[$i]['locat'] = $locacion2;
                            }
                        } else {
                            //La revision no existe
                            $data_insert_revision = array(
                                'idmodelo' => $idmodelo,
                                'descripcion' => $revision,
                                'idusuario' => $this->session->user_id,
                                'fecharegistro' => date('Y-m-d H:i:s')
                            );
                            $idrevision = $this->documento->addRevision($data_insert_revision);
                            $data_insert_cantidad = array(
                                'idrevision' => $idrevision,
                                'cantidad' => $cantidad_cajas,
                                'idusuario' => $this->session->user_id,
                                'fecharegistro' => date('Y-m-d H:i:s')
                            );
                            $idcantidad = $this->documento->addCantidad($data_insert_cantidad);
                            $datos[$i] = array();
                            $datos[$i]['idcantidad'] = $idcantidad;
                            $datos[$i]['locat'] = $locacion2;
                        }
                    } else {
                        //El modelo NO existe
                        $data_insert_modelo = array(
                            'idparte' => $idparte,
                            'descripcion' => $modelo,
                            'nombrehoja' => "",
                            'customer' => "",
                            'fulloneimpresion' => "",
                            'colorlinea' => "",
                            'diucutno' => "",
                            'platonumero' => "",
                            'color' => "",
                            'blanksize' => "",
                            'sheetsize' => "",
                            'score' => "",
                            'normascompartidas' => "",
                            'salida' => "",
                            'combinacion' => "",
                            'idusuario' => $this->session->user_id,
                            'fecharegistro' => date('Y-m-d H:i:s')
                        );
                        $idmodelo = $this->documento->addModelo($data_insert_modelo);
                        $data_insert_revision = array(
                            'idmodelo' => $idmodelo,
                            'descripcion' => $revision,
                            'idusuario' => $this->session->user_id,
                            'fecharegistro' => date('Y-m-d H:i:s')
                        );
                        $idrevision = $this->documento->addRevision($data_insert_revision);
                        $data_insert_cantidad = array(
                            'idrevision' => $idrevision,
                            'cantidad' => $cantidad_cajas,
                            'idusuario' => $this->session->user_id,
                            'fecharegistro' => date('Y-m-d H:i:s')
                        );
                        $idcantidad = $this->documento->addCantidad($data_insert_cantidad);
                        $datos[$i] = array();
                        $datos[$i]['idcantidad'] = $idcantidad;
                        $datos[$i]['locat'] = $locacion2;
                    }
                } else {
                    //El numero de parte NO existe

                    $data_insert_parte = array(
                      'numeroparte'=>$numeroparte,
                      'idcliente'=>$idcliente,
                      'idcategoria'=>$idcategoria,
                      'idusuario' => $this->session->user_id,
                      'activo'=>1,
                      'fecharegistro' => date('Y-m-d H:i:s'));
                    $idparte = $this->documento->addParte($data_insert_parte);
                    $data_insert_modelo = array(
                            'idparte' => $idparte,
                            'descripcion' => $modelo,
                            'nombrehoja' => "",
                            'customer' => "",
                            'fulloneimpresion' => "",
                            'colorlinea' => "",
                            'diucutno' => "",
                            'platonumero' => "",
                            'color' => "",
                            'blanksize' => "",
                            'sheetsize' => "",
                            'score' => "",
                            'normascompartidas' => "",
                            'salida' => "",
                            'combinacion' => "",
                            'idusuario' => $this->session->user_id,
                            'fecharegistro' => date('Y-m-d H:i:s')
                        );
                        $idmodelo = $this->documento->addModelo($data_insert_modelo);
                        $data_insert_revision = array(
                            'idmodelo' => $idmodelo,
                            'descripcion' => $revision,
                            'idusuario' => $this->session->user_id,
                            'fecharegistro' => date('Y-m-d H:i:s')
                        );
                        $idrevision = $this->documento->addRevision($data_insert_revision);
                        $data_insert_cantidad = array(
                            'idrevision' => $idrevision,
                            'cantidad' => $cantidad_cajas,
                            'idusuario' => $this->session->user_id,
                            'fecharegistro' => date('Y-m-d H:i:s')
                        );
                        $idcantidad = $this->documento->addCantidad($data_insert_cantidad);
                        $datos[$i] = array();
                        $datos[$i]['idcantidad'] = $idcantidad;
                        $datos[$i]['locat'] = $locacion2;



                }
            }
            //Crear una Transferencia
            $folio = $this->transferencia->obtenerUltimoFolio();
            $numerofolio = $folio->folio;
            $nuevo = $numerofolio + 1;
            $date_insert_transferencia = array(
                'folio'=>$nuevo,
                'idusuario' => $this->session->user_id,
                'fecharegistro' => date('Y-m-d H:i:s')
            );
           $idtransferencia =  $this->transferencia->addTransferencia($date_insert_transferencia);
           //var_dump($datos);
           foreach($datos as $value){
                $data_insert_detalle_transferencia = array(
                    'idtransferancia'=>$idtransferencia,
                    'pallet'=>1,
                    'idcajas'=>$value["idcantidad"],
                    'idlinea'=>1,
                    'idestatus'=>8,
                    'idusuario' => $this->session->user_id,
                    'fecharegistro' => date('Y-m-d H:i:s')
                );
                $idpalletcajas =  $this->transferencia->addPalletCajas($data_insert_detalle_transferencia);
               // echo $value['locat'];
                //Insertar locacion pallet
                $detalle_locacion  = $this->documento->seleccion_locacion($value['locat']);
                $idposicion_bodega = $detalle_locacion->idposicion;
                $data_insert_locacion = array(
                    'idpalletcajas'=>$idpalletcajas,
                    'numero'=>1,
                    'idposicion'=>$idposicion_bodega,
                    'ordensalida'=>0,
                    'salida'=>0,
                    'idusuario' => $this->session->user_id,
                    'fecharegistro' => date('Y-m-d H:i:s')
                );
                $this->documento->addPartePosicionBodega($data_insert_locacion);

                $data_update_documento= array(
                    'subido'=>1
                );
                $this->documento->updateDocumento($id,$data_update_documento);

            }

        } else {
          $checkbox1 = $this->input->post('table_records_delete');
            //Eliminar
            foreach ($checkbox1 as $chk1) {
                $id = $chk1;
                $this->documento->deleteregistro($id);
            }
        }

        $data = array(
            'ididentificador' => $ididentificador,
            'datos' => $this->documento->showAllDocumentosId($ididentificador)
        );
    //var_dump($this->documento->showAllDocumentosId($id_detalle));
        $this->load->view('header');
        $this->load->view('CatSistema/inventario/detalle', $data);
        $this->load->view('footer');

    }

    public function modificar() {
        $id = $this->input->post('id');
        $ididentificador = $this->input->post('ididentificador');
        $data_update = array(
            'numeroparte' => $this->input->post('numeroparte'),
            'modelo' => $this->input->post('modelo'),
            'revision' => $this->input->post('revision'),
            'cantidadcajas' => $this->input->post('cantidadcajas'),
            'cantidadpallet' => $this->input->post('cantidadpallet'),
            'cliente' => $this->input->post('cliente'),
            'proveedor' => $this->input->post('proveedor'),
            'locacion' => $this->input->post('locacion'),
            'categoria' => $this->input->post('categoria'),
            'idusuario' => $this->session->user_id,
            'fecharegistro' => date('Y-m-d H:i:s')
        );
        $data = array(
            'ididentificador' => $ididentificador,
            'datos' => $this->documento->showAllDocumentosId($ididentificador)
        );
        $this->documento->updateDocumento($id, $data_update);
        // var_dump($data);
        $this->load->view('header');
        $this->load->view('CatSistema/inventario/detalle', $data);
        $this->load->view('footer');
    }

    public function eliminar_all($identificador)
    {
        # code...
        $this->documento->deleteregistrosall($identificador);
        $data = array(
            'datos' => $this->documento->showAllDocumentos()
        );
        $this->load->view('header');
        $this->load->view('CatSistema/inventario/index', $data);
        $this->load->view('footer');
    }

}

?>
