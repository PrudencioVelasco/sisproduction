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

    public function test() {
        $foo = (object) null; //create an empty object
        $foo->bar = "12345";
        var_dump($foo);
    }

    public function detalle($id_detalle) {
        $data = array(
            'ididentificador' => $id_detalle,
            'datos' => $this->documento->showAllDocumentosId($id_detalle)
        );
        // var_dump($data);
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
                $categoria = $allDataInSheet[$i]["J"];
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
        $checkbox1 = $this->input->post('table_records');
        $ididentificador = $this->input->post('ididentificador');
        if (isset($formdata['subir'])) {
            echo "1";
            foreach ($checkbox1 as $chk1) {
               echo $id= $chk1;
            }
        } else {
            echo "2";
            foreach ($checkbox1 as $chk1) {
                $id= $chk1;
            }
        }
    }

}

?>