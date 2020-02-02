<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Salida extends CI_Controller {

    function __construct() {
        parent::__construct();

        if (!isset($_SESSION['user_id'])) {
            $this->session->set_flashdata('flash_data', 'You don\'t have access! ss');
            return redirect('login');
        }
        $this->load->helper('url');
        $this->load->model('data_model');
        $this->load->model('parte_model', 'parte');
        $this->load->model('client_model', 'cliente');
        $this->load->model('user_model', 'usuario');
        $this->load->model('bodega_model', 'bodega');
        $this->load->model('salida_model', 'salida');
        $this->load->model('posicionbodega_model', 'posicionbodega');
        $this->load->library('permission');
        $this->load->library('session');
    }

    public function index() {
        Permission::grant(uri_string());
        $this->load->view('header');
        $this->load->view('salida/index');
        $this->load->view('footer');
    }

    public function showAll() {
        //Permission::grant(uri_string());
        $query = $this->salida->showAllSalidas();
        if ($query) {
            $result['salidas'] = $this->salida->showAllSalidas();
        }
        echo json_encode($result);

        // code...
    }

    public function showAllParte() {
        //Permission::grant(uri_string());
        $query = $this->salida->showPartesBodega();
        if ($query) {
            $result['partes'] = $this->salida->showPartesBodega();
        }
        echo json_encode($result);

        // code...
    }
    public function test3() {
        $query = $this->salida->showAllPalletCajas();
        $cantidad = 150;
        $contador = 0;
        
        var_dump($query);
        foreach ($query as $value) {
            if ($cantidad > 0) {
                 if($cantidad > $value->cajas){
                  $cantidad -= $value->cajas;
                  $contador++;
                 }else{
                     
                 }
                
            } 
           
        }
        echo $cantidad;
        echo $contador;
    }

    public function test5($idsalida) {
        $query = $this->salida->showPartesBodega2();
        $array = array();
        $i = 0;
        foreach ($query as $row) {
            if ($row->totalcajasdisponibles > 0) {
                if ($row->cajassalidasporparciales > 0 && $row->totalpalletparacomparar > 1) {
                    //Si hay cajas salidas por parcilas
                    $array[$i] = array();
                    $array[$i]['iddetalleparte'] = $row->iddetalleparte;
                    $array[$i]['numeroparte'] = $row->numeroparte;
                    $array[$i]['folio'] = $row->folio;
                    $array[$i]['modelo'] = $row->modelo;
                    $array[$i]['revision'] = $row->revision;
                    $array[$i]['linea'] = $row->linea;
                    $array[$i]['fecharegistro'] = $row->fecharegistro;
                    $array[$i]['nombre'] = $row->nombre;
                    $array[$i]['totalpallet'] = $row->totalpalletparacomparar;
                    $array[$i]['cajasporpallet'] = $row->cajasporpallet;
                    $array[$i]['totalcajas'] = $row->totalcajas;
                    $array[$i]['cajassalidas'] = $row->totalcajassalidas;
                    $array[$i]['test'] = 0;
                    $array[$i]['cajasdisponibles'] = $row->totalcajasdisponibles;
                    $i++;
                } else {
                    //Si son puros pallet
                    $array[$i] = array();
                    $array[$i]['iddetalleparte'] = $row->iddetalleparte;
                    $array[$i]['numeroparte'] = $row->numeroparte;
                    $array[$i]['folio'] = $row->folio;
                    $array[$i]['modelo'] = $row->modelo;
                    $array[$i]['revision'] = $row->revision;
                    $array[$i]['linea'] = $row->linea;
                    $array[$i]['fecharegistro'] = $row->fecharegistro;
                    $array[$i]['nombre'] = $row->nombre;
                    $array[$i]['totalpallet'] = $row->totalpalletparacomparar;
                    $array[$i]['cajasporpallet'] = $row->cajasporpallet;
                    $array[$i]['totalcajas'] = $row->totalcajas;
                    $array[$i]['cajassalidas'] = $row->totalcajassalidas;
                    $array[$i]['test'] = 0;
                    $array[$i]['cajasdisponibles'] = $row->totalcajasdisponibles;
                    $i++;
                }
            }
        }
        var_dump($query);
    }

    public function test1($idsalida) {
    //Permission::grant(uri_string());
        
        $detalle = $this->salida->detalleSalida($idsalida);
        $idcliente = $detalle->idcliente;
        $query = $this->salida->showPartesBodega2($idcliente); 
        $array = array();
        $i = 0;
        if($query != false){
        foreach ($query as $row) {
            if ($row->totalcajasdisponibles > 0) {
                if ($row->cajassalidasporparciales > 0 && $row->totalpalletparacomparar > 1) {
                    //Si hay cajas salidas por parcilas
                    $array[$i] = array();
                    $array[$i]['idtransferancia'] = $row->idtransferancia;
                    $array[$i]['iddetalleparte'] = $row->iddetalleparte;
                    $array[$i]['numeroparte'] = $row->numeroparte;
                    $array[$i]['folio'] = $row->folio;
                    $array[$i]['modelo'] = $row->modelo;
                    $array[$i]['revision'] = $row->revision;
                    $array[$i]['idcajas'] = $row->idcajas;
                    //$array[$i]['linea'] = $row->linea;
                    $array[$i]['fecha'] = $row->fecha;
                    $array[$i]['nombre'] = $row->nombre;
                    $array[$i]['totalpallet'] = $row->totalpalletparacomparar;
                    $array[$i]['cajasporpallet'] = $row->cajasporpallet;
                    $array[$i]['totalcajas'] = $row->totalcajas;
                    $array[$i]['cajassalidas'] = $row->totalcajassalidas;
                    $array[$i]['test'] = 0;
                    $array[$i]['cajasdisponibles'] = $row->totalcajasdisponibles;
                    $i++;
                } else {
                    //Si son puros pallet
                    $array[$i] = array();
                    $array[$i]['idtransferancia'] = $row->idtransferancia;
                    $array[$i]['iddetalleparte'] = $row->iddetalleparte;
                    $array[$i]['numeroparte'] = $row->numeroparte;
                    $array[$i]['folio'] = $row->folio;
                    $array[$i]['modelo'] = $row->modelo;
                    $array[$i]['revision'] = $row->revision;
                    $array[$i]['idcajas'] = $row->idcajas;
                    //$array[$i]['linea'] = $row->linea;
                    $array[$i]['fecha'] = $row->fecha;
                    $array[$i]['nombre'] = $row->nombre;
                    $array[$i]['totalpallet'] = $row->totalpalletparacomparar;
                    $array[$i]['cajasporpallet'] = $row->cajasporpallet;
                    $array[$i]['totalcajas'] = $row->totalcajas;
                    $array[$i]['cajassalidas'] = $row->totalcajassalidas;
                    $array[$i]['test'] = 0;
                    $array[$i]['cajasdisponibles'] = $row->totalcajasdisponibles;
                    $i++;
                }
            }
        }
    }
        return $array;
    }
  public function test2($idsalida) {
    //Permission::grant(uri_string());
        
        $detalle = $this->salida->detalleSalida($idsalida);
        $idcliente = $detalle->idcliente;
        $query = $this->salida->showPartesBodega3(); 
        $array = array();
        $i = 0;
        if($query != false){
        foreach ($query as $row) {
            if ($row->totalcajasdisponibles > 0) {
                if ($row->cajassalidasporparciales > 0 && $row->totalpalletparacomparar > 1) {
                    //Si hay cajas salidas por parcilas
                    $array[$i] = array();
                    $array[$i]['idtransferancia'] = $row->idtransferancia;
                    $array[$i]['iddetalleparte'] = $row->iddetalleparte;
                    $array[$i]['numeroparte'] = $row->numeroparte;
                    $array[$i]['folio'] = $row->folio;
                    $array[$i]['modelo'] = $row->modelo;
                    $array[$i]['revision'] = $row->revision;
                    $array[$i]['idcajas'] = $row->idcajas;
                    //$array[$i]['linea'] = $row->linea;
                    $array[$i]['fecha'] = $row->fecha;
                    $array[$i]['nombre'] = $row->nombre;
                    $array[$i]['totalpallet'] = $row->totalpalletparacomparar;
                    $array[$i]['cajasporpallet'] = $row->cajasporpallet;
                    $array[$i]['totalcajas'] = $row->totalcajas;
                    $array[$i]['cajassalidas'] = $row->totalcajassalidas;
                    $array[$i]['test'] = 0;
                    $array[$i]['cajasdisponibles'] = $row->totalcajasdisponibles;
                    $i++;
                } else {
                    //Si son puros pallet
                    $array[$i] = array();
                    $array[$i]['idtransferancia'] = $row->idtransferancia;
                    $array[$i]['iddetalleparte'] = $row->iddetalleparte;
                    $array[$i]['numeroparte'] = $row->numeroparte;
                    $array[$i]['folio'] = $row->folio;
                    $array[$i]['modelo'] = $row->modelo;
                    $array[$i]['revision'] = $row->revision;
                    $array[$i]['idcajas'] = $row->idcajas;
                    //$array[$i]['linea'] = $row->linea;
                    $array[$i]['fecha'] = $row->fecha;
                    $array[$i]['nombre'] = $row->nombre;
                    $array[$i]['totalpallet'] = $row->totalpalletparacomparar;
                    $array[$i]['cajasporpallet'] = $row->cajasporpallet;
                    $array[$i]['totalcajas'] = $row->totalcajas;
                    $array[$i]['cajassalidas'] = $row->totalcajassalidas;
                    $array[$i]['test'] = 0;
                    $array[$i]['cajasdisponibles'] = $row->totalcajasdisponibles;
                    $i++;
                }
            }
        }
    }
        return $array;
    }

    public function generarCodigo($longitud) {
        $key = '';
        $pattern = '1234567890';
        $max = strlen($pattern) - 1;
        for ($i = 0; $i < $longitud; $i++)
            $key .= $pattern{mt_rand(0, $max)};
        return $key;
    }

    public function addSalida() {
        //Permission::grant(uri_string());
        $config = array(
            array(
                'field' => 'idcliente',
                'label' => 'cliente',
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
                'idcliente' => form_error('idcliente')
            );
        } else {
            $rowcliente = $this->cliente->detalleCliente($this->input->post('idcliente'));
            $data = array(
                'po' => $this->input->post('po'),
                'notas' => $this->input->post('notas'),
                'idcliente' => $this->input->post('idcliente'),
                'finalizado' => 0,
                'idusuario' => $this->session->user_id,
                'fecharegistro' => date('Y-m-d H:i:s')
            );
            $idsalia = $this->salida->addSalida($data);
            $numerosalida = $rowcliente->abreviatura . "-" . date('Ymd') . "-" . $idsalia;
            $dataupdate = array(
                'numerosalida' => $numerosalida
            );
            $this->salida->updateSalida($idsalia, $dataupdate);
        }
        echo json_encode($result);
    }
        public function updateSalida() {
        //Permission::grant(uri_string());
        $config = array(
            array(
                'field' => 'idcliente',
                'label' => 'cliente',
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
                'idcliente' => form_error('idcliente')
            );
        } else {
            $idsalida = $this->input->post('idsalida');
            $rowcliente = $this->cliente->detalleCliente($this->input->post('idcliente'));
            $data = array(
                'po' => $this->input->post('po'),
                'notas' => $this->input->post('notas'),
                'idcliente' => $this->input->post('idcliente'), 
                'idusuario' => $this->session->user_id,
                'fecharegistro' => date('Y-m-d H:i:s')
            );
            $this->salida->updateSalida($idsalida, $data);

            $numerosalida = $rowcliente->abreviatura . "-" . date('Ymd') . "-" . $idsalida;
            $dataupdate = array(
                'numerosalida' => $numerosalida
            );

            $this->salida->updateSalida($idsalida, $dataupdate);
        }
        echo json_encode($result);
    }

    public function detalleSalida($idsalida) {
        // code...
       //Permission::grant(uri_string());
        $datadetallesalida = $this->salida->detalleSalida($idsalida);
        $datadetalleorden = $this->salida->detallesDeOrden($idsalida);
        $detallepallet = $this->salida->detallepallet($idsalida);
        $detalleparciales = $this->salida->detalleparciales($idsalida);
        $datos=$this->test1($idsalida);  
        $data = array(
            'detallesalida' => $datadetallesalida,
            'detalleorden' => $datadetalleorden,
            'idsalida' => $idsalida,
            'detallepallet' => $detallepallet,
            'detalleparciales' => $detalleparciales,
            'datosparte'=>$datos);
        $this->load->view('header');
        $this->load->view('salida/detalle', $data);
        $this->load->view('footer');
    }
       public function detalleSalidaMaster($idsalida) {
        // code...
       //Permission::grant(uri_string());
        $datadetallesalida = $this->salida->detalleSalida($idsalida);
        $datadetalleorden = $this->salida->detallesDeOrden($idsalida);
        $detallepallet = $this->salida->detallepallet($idsalida);
        $detalleparciales = $this->salida->detalleparciales($idsalida);
        $datos=$this->test2($idsalida);  
        $data = array(
            'detallesalida' => $datadetallesalida,
            'detalleorden' => $datadetalleorden,
            'idsalida' => $idsalida,
            'detallepallet' => $detallepallet,
            'detalleparciales' => $detalleparciales,
            'datosparte'=>$datos);
        $this->load->view('header');
        $this->load->view('salida/detallemaster', $data);
        $this->load->view('footer');
    }

    public function validaranumeroparte() {
        //Permission::grant(uri_string());
        // code...
        $numeroparte = $_POST['numeroparte'];
        //var_dump($this->salida->validarExistenciaNumeroParte($numeroparte));
        if ($this->salida->validarExistenciaNumeroParte($numeroparte) == NULL) {

            echo "0";
        } else {
            $datadetalle = $this->salida->validarExistenciaNumeroParte($numeroparte);
            echo $datadetalle->idparte;
        }
    }

    function eliminarParteOrden($idordensalida, $idsalida,$idpalletcajas) {
        //Permission::grant(uri_string());
        $this->salida->eliminarParteOrden($idordensalida);
        $data = array(
            'ordensalida'=>0
        );
        $this->salida->updateEstatusPosicionBodega($idpalletcajas,$data);
        redirect('/salida/detalleSalida/' . $idsalida);
    }

    public function terminarOrdenSalida() {
        // code...
        //Permission::grant(uri_string());
        $idsalida = $this->input->post('idsalida');
        $dataupdate = array(
            'finalizado' => 1,
            'idusuario' => $this->session->user_id,
            'fecharegistro' => date('Y-m-d H:i:s'));
        $this->salida->updateSalida($idsalida, $dataupdate);
        redirect('/salida/detalleSalida/' . $idsalida);
    }

    public function searchPartes() {
        //Permission::grant(uri_string());
        $value = $this->input->post('text');
        $query = $this->salida->buscarNumeroParte($value);
        if ($query) {
            $result['salidas'] = $query;
        }

        echo json_encode($result);
    }
    
    public function testnew() {
        $dataexistencia = $this->salida->validarExistenciaParcialesNumeroParte(82, 100);
        //$totalexistencia = $dataexistencia->totalstock;
        $totalexistenciacajas = $dataexistencia->totalcajas;
        var_dump($dataexistencia);
        $totalcajas = 1;

        if (($totalcajas <= ($totalexistenciacajas - $dataexistencia->cajassalidas))) {
            $lista = $this->salida->listaPosicionesPallet(82, 100);
            var_dump($lista);
            $suma = 0;
            $descontar = 0;
            foreach ($lista as $value) {
                if ($totalcajas <= $value->cajas) {
                    //Con un solo registro de llena el parcial
                    $id = $value->idparteposicionbodega;
                    $idpalletcajas = $value->idpalletcajas;
                    $data = array(
                        'ordensalida' => 1
                    );
                    $this->salida->updateEstatusOrden($id, $data);
                    $dataordensalida = array(
                        'idsalida' => 2,
                        'idpalletcajas' => $idpalletcajas,
                        'tipo' => 1,
                        'pallet' => 0,
                        'caja' => $totalcajas,
                        'revision' => '0',
                        'idusuario' => $this->session->user_id,
                        'fecharegistro' => date('Y-m-d H:i:s')
                    );
                    $this->salida->addOrdenSalida($dataordensalida);
                    break;
                } else {
                    if (($totalcajas - $suma) >= $value->cajas) {
                        $suma += $value->cajas;
                        $id = $value->idparteposicionbodega;
                        $idpalletcajas = $value->idpalletcajas;
                        $data = array(
                            'ordensalida' => 1
                        );
                        $this->salida->updateEstatusOrden($id, $data);
                        $dataordensalida = array(
                            'idsalida' => 2,
                            'idpalletcajas' => $idpalletcajas,
                            'tipo' => 1,
                            'pallet' => 0,
                            'caja' => $value->cajas,
                            'revision' => '0',
                            'idusuario' => $this->session->user_id,
                            'fecharegistro' => date('Y-m-d H:i:s')
                        );
                        $this->salida->addOrdenSalida($dataordensalida);
                    } else {
                        $id = $value->idparteposicionbodega;
                        $idpalletcajas = $value->idpalletcajas;
                        $data = array(
                            'ordensalida' => 1
                        );
                        $this->salida->updateEstatusOrden($id, $data);
                        $dataordensalida = array(
                            'idsalida' => 2,
                            'idpalletcajas' => $idpalletcajas,
                            'tipo' => 1,
                            'pallet' => 0,
                            'caja' => ($totalcajas - $suma),
                            'revision' => '0',
                            'idusuario' => $this->session->user_id,
                            'fecharegistro' => date('Y-m-d H:i:s')
                        );
                        $this->salida->addOrdenSalida($dataordensalida);
                        break;
                    }
                }
            }
        }
    }
    public function testpallet() {
        $idtransferecia = 8;
        $idcajas = 8;
         $lista = $this->salida->listaPosicionesPallet($idtransferecia, $idcajas);
         var_dump($lista);
    }
    public function agregarNumeroParteOrder() {
        //Permission::grant(uri_string());
        $idcajas = $this->input->post('idcajas');
          $idtransferecia = $this->input->post('idtransferecia');
        $iddetalleparte = $this->input->post('iddetalleparte'); 
        $idsalida = $this->input->post('idsalida');
        $numeropallet = $this->input->post('pallet');
        $numerocajas = $this->input->post('cajas');
        $po = $this->input->post('po');
        $tipo = $this->input->post('tipo');

        //Tipo de mensajes
        //0=No existe suficiente pantes en existencia.

        if ($tipo == "parciales") {
            if ($numerocajas != "") {
                if (is_numeric($numerocajas)) {
                    if ($numerocajas > 0) {
                        //Son parciales
                        $dataexistencia = $this->salida->validarExistenciaParcialesNumeroParte($idtransferecia, $idcajas);
                        echo $idcajas;
                        //$totalexistencia = $dataexistencia->totalstock;
                         $totalexistenciacajas = $dataexistencia->totalcajas;

                          $totalcajas = $numerocajas;

                        if (($totalcajas <= ($totalexistenciacajas - $dataexistencia->cajassalidas))) {
                            $lista = $this->salida->listaPosicionesPallet($idtransferecia, $idcajas);
                            $suma = 0;
                            $descontar = 0;
                            foreach ($lista as $value) {
                                if ($totalcajas <= $value->cajas) {
                                    //Con un solo registro de llena el parcial
                                    $id = $value->idparteposicionbodega;
                                    $idpalletcajas = $value->idpalletcajas;
                                    $data = array(
                                        'ordensalida' => 1
                                    );
                                    $this->salida->updateEstatusOrden($id, $data);
                                    $dataordensalida = array(
                                        'idsalida' => $idsalida,
                                        'idpalletcajas' => $idpalletcajas,
                                        'tipo' => 1,
                                        'pallet' => 1,
                                        'caja' => $totalcajas,
                                        'revision' => '0',
                                        'po'=>$po,
                                        'idusuario' => $this->session->user_id,
                                        'fecharegistro' => date('Y-m-d H:i:s')
                                    );
                                    $this->salida->addOrdenSalida($dataordensalida);
                                    
                                    break;
                                } else {
                                    if (($totalcajas - $suma) >= $value->cajas) {
                                        $suma += $value->cajas;
                                        $id = $value->idparteposicionbodega;
                                        $idpalletcajas = $value->idpalletcajas;
                                        $data = array(
                                            'ordensalida' => 1
                                        );
                                        $this->salida->updateEstatusOrden($id, $data);
                                        $dataordensalida = array(
                                            'idsalida' => $idsalida,
                                            'idpalletcajas' => $idpalletcajas,
                                            'tipo' => 0,
                                            'pallet' => 0,
                                            'caja' => $value->cajas,
                                            'revision' => '0',
                                            'po'=>$po,
                                            'idusuario' => $this->session->user_id,
                                            'fecharegistro' => date('Y-m-d H:i:s')
                                        );
                                        $this->salida->addOrdenSalida($dataordensalida);
                                        
                                    } else {
                                        if(($totalcajas - $suma) > 0){
                                        $id = $value->idparteposicionbodega;
                                        $idpalletcajas = $value->idpalletcajas;
                                        $data = array(
                                            'ordensalida' => 1
                                        );
                                        $this->salida->updateEstatusOrden($id, $data);
                                        $dataordensalida = array(
                                            'idsalida' => $idsalida,
                                            'idpalletcajas' => $idpalletcajas,
                                            'tipo' => 1,
                                            'pallet' => 0,
                                            'caja' => ($totalcajas - $suma),
                                            'revision' => '0',
                                            'po'=>$po,
                                            'idusuario' => $this->session->user_id,
                                            'fecharegistro' => date('Y-m-d H:i:s')
                                        );
                                        $this->salida->addOrdenSalida($dataordensalida);
                                        
                                    }
                                        break;
                                    }
                                }
                            }
                            echo 1;
                        } else {
                            //No existe stock de cajas
                            echo 13;
                        }
                    } else {
                        //Error: Solo debe de ser numero positivos o mayor a 0
                        echo 12;
                    }
                } else {
                    //Error: Solo debe de ser numero
                    echo 11;
                }
            } else {
                //Error: el campo de numero caja vinene vacio.
                echo 10;
            }
        } else if ($tipo == "pallet") {
            if ($numeropallet != "") {
                if (is_numeric($numeropallet)) {
                    if ($numeropallet > 0) {
                        $dataexistencia = $this->salida->validarExistenciaNumeroParte($idtransferecia, $idcajas);
                        $totalexistencia = $dataexistencia->totalstock;
                        $totalexistenciacajas = $dataexistencia->totalcajas;
                        //Son por Pallet
                        if ($totalexistencia >= $numeropallet) {
                            //Si existen existencia de numero de parte
                            $lista = $this->salida->listaPosiciones($idtransferecia, $idcajas);
                            $i = 0;
                            foreach ($lista as $value) {
                                $i++;
                                if ($i <= $numeropallet) {
                                    $id = $value->idparteposicionbodega;
                                    $idpalletcajas = $value->idpalletcajas;
                                    $data = array(
                                        'ordensalida' => 1
                                    );
                                    $this->salida->updateEstatusOrden($id, $data);
                                    $dataordensalida = array(
                                        'idsalida' => $idsalida,
                                        'idpalletcajas' => $idpalletcajas,
                                        'tipo' => 0,
                                        'pallet' => 1,
                                        'caja' => 0,
                                        'revision' => '0',
                                        'po'=>$po,
                                        'idusuario' => $this->session->user_id,
                                        'fecharegistro' => date('Y-m-d H:i:s')
                                    );
                                    $this->salida->addOrdenSalida($dataordensalida);
                                }
                            }
                            echo 1;
                        } else {
                            //No existen existencias de numero de parte
                            echo 13;
                        }
                    } else {
                        //Error: Solo debe de ser numero positivo o mayor a 0
                        echo 12;
                    }
                } else {
                    //Error: Solo es permito numero
                    echo 11;
                }
            } else {
                //Error: Campo es requerido
                echo 10;
            }
        } else {
            //El tipo no existe
        }
    }
     public function agregarNumeroParteOrderMaster() {
        //Permission::grant(uri_string());
        $idcajas = $this->input->post('idcajas');
          $idtransferecia = $this->input->post('idtransferecia');
        $iddetalleparte = $this->input->post('iddetalleparte'); 
        $idsalida = $this->input->post('idsalida');
        $numeropallet = $this->input->post('pallet');
        $numerocajas = $this->input->post('cajas');
        $po = $this->input->post('po');
        $tipo = $this->input->post('tipo');

        //Tipo de mensajes
        //0=No existe suficiente pantes en existencia.

        if ($tipo == "parciales") {
            if ($numerocajas != "") {
                if (is_numeric($numerocajas)) {
                    if ($numerocajas > 0) {
                        //Son parciales
                        $dataexistencia = $this->salida->validarExistenciaParcialesNumeroParte($idtransferecia, $idcajas);
                        echo $idcajas;
                        //$totalexistencia = $dataexistencia->totalstock;
                         $totalexistenciacajas = $dataexistencia->totalcajas;

                          $totalcajas = $numerocajas;

                        if (($totalcajas <= ($totalexistenciacajas - $dataexistencia->cajassalidas))) {
                            $lista = $this->salida->listaPosicionesPallet($idtransferecia, $idcajas);
                            $suma = 0;
                            $descontar = 0;
                            foreach ($lista as $value) {
                                if ($totalcajas <= $value->cajas) {
                                    //Con un solo registro de llena el parcial
                                    $id = $value->idparteposicionbodega;
                                    $idpalletcajas = $value->idpalletcajas;
                                    $data = array(
                                        'ordensalida' => 1
                                    );
                                    $this->salida->updateEstatusOrden($id, $data);
                                    $dataordensalida = array(
                                        'idsalida' => $idsalida,
                                        'idpalletcajas' => $idpalletcajas,
                                        'tipo' => 1,
                                        'pallet' => 1,
                                        'caja' => $totalcajas,
                                        'revision' => '0',
                                        'po'=>$po,
                                        'idusuario' => $this->session->user_id,
                                        'fecharegistro' => date('Y-m-d H:i:s')
                                    );
                                    $this->salida->addOrdenSalida($dataordensalida);
                                    
                                    break;
                                } else {
                                    if (($totalcajas - $suma) >= $value->cajas) {
                                        $suma += $value->cajas;
                                        $id = $value->idparteposicionbodega;
                                        $idpalletcajas = $value->idpalletcajas;
                                        $data = array(
                                            'ordensalida' => 1
                                        );
                                        $this->salida->updateEstatusOrden($id, $data);
                                        $dataordensalida = array(
                                            'idsalida' => $idsalida,
                                            'idpalletcajas' => $idpalletcajas,
                                            'tipo' => 0,
                                            'pallet' => 0,
                                            'caja' => $value->cajas,
                                            'revision' => '0',
                                            'po'=>$po,
                                            'idusuario' => $this->session->user_id,
                                            'fecharegistro' => date('Y-m-d H:i:s')
                                        );
                                        $this->salida->addOrdenSalida($dataordensalida);
                                        
                                    } else {
                                        if(($totalcajas - $suma) > 0){
                                        $id = $value->idparteposicionbodega;
                                        $idpalletcajas = $value->idpalletcajas;
                                        $data = array(
                                            'ordensalida' => 1
                                        );
                                        $this->salida->updateEstatusOrden($id, $data);
                                        $dataordensalida = array(
                                            'idsalida' => $idsalida,
                                            'idpalletcajas' => $idpalletcajas,
                                            'tipo' => 1,
                                            'pallet' => 0,
                                            'caja' => ($totalcajas - $suma),
                                            'revision' => '0',
                                            'po'=>$po,
                                            'idusuario' => $this->session->user_id,
                                            'fecharegistro' => date('Y-m-d H:i:s')
                                        );
                                        $this->salida->addOrdenSalida($dataordensalida);
                                        
                                    }
                                        break;
                                    }
                                }
                            }
                            echo 1;
                        } else {
                            //No existe stock de cajas
                            echo 13;
                        }
                    } else {
                        //Error: Solo debe de ser numero positivos o mayor a 0
                        echo 12;
                    }
                } else {
                    //Error: Solo debe de ser numero
                    echo 11;
                }
            } else {
                //Error: el campo de numero caja vinene vacio.
                echo 10;
            }
        } else if ($tipo == "pallet") {
            if ($numeropallet != "") {
                if (is_numeric($numeropallet)) {
                    if ($numeropallet > 0) {
                        $dataexistencia = $this->salida->validarExistenciaNumeroParte($idtransferecia, $idcajas);
                        $totalexistencia = $dataexistencia->totalstock;
                        $totalexistenciacajas = $dataexistencia->totalcajas;
                        //Son por Pallet
                        if ($totalexistencia >= $numeropallet) {
                            //Si existen existencia de numero de parte
                            $lista = $this->salida->listaPosiciones($idtransferecia, $idcajas);
                            $i = 0;
                            foreach ($lista as $value) {
                                $i++;
                                if ($i <= $numeropallet) {
                                    $id = $value->idparteposicionbodega;
                                    $idpalletcajas = $value->idpalletcajas;
                                    $data = array(
                                        'ordensalida' => 1
                                    );
                                    $this->salida->updateEstatusOrden($id, $data);
                                    $dataordensalida = array(
                                        'idsalida' => $idsalida,
                                        'idpalletcajas' => $idpalletcajas,
                                        'tipo' => 0,
                                        'pallet' => 1,
                                        'caja' => 0,
                                        'revision' => '0',
                                        'po'=>$po,
                                        'idusuario' => $this->session->user_id,
                                        'fecharegistro' => date('Y-m-d H:i:s')
                                    );
                                    $this->salida->addOrdenSalida($dataordensalida);
                                }
                            }
                            echo 1;
                        } else {
                            //No existen existencias de numero de parte
                            echo 13;
                        }
                    } else {
                        //Error: Solo debe de ser numero positivo o mayor a 0
                        echo 12;
                    }
                } else {
                    //Error: Solo es permito numero
                    echo 11;
                }
            } else {
                //Error: Campo es requerido
                echo 10;
            }
        } else {
            //El tipo no existe
        }
    }
    
    
    public function test4() {
         $dataexistencia = $this->salida->validarExistenciaNumeroParte(22, 33);
    }
    

    public   function agregarParteOrdenDetallado($idtransferecia,$idcajas, $idsalida) {
       //Permission::grant(uri_string());
        //echo $idtransferecia;
        $datadetallesalida = $this->salida->detalleSalida($idsalida);
        $datadetalleorden = $this->salida->detallesDeOrden($idsalida);
        $datadetalleparte = $this->salida->showPartesDetalle($idtransferecia,$idcajas);
        $detallepallet = $this->salida->detallepallet($idsalida);
        $detalleparciales = $this->salida->detalleparciales($idsalida); 
         $datos=$this->test1($idsalida); 
        // var_dump($datos);
        

        
        //var_dump($datadetalleparte);
        $data = array(
            'datosparte'=>$datos,
            'detallesalida' => $datadetallesalida,
            'detalleorden' => $datadetalleorden,
            'cajasporpallet' =>$datadetalleparte->cajasporpallet,
            'idsalida' => $idsalida,
            'idtransferecia'=>$idtransferecia,
            'idcajas'=>$idcajas,
            'detalleparte' => $datadetalleparte,
            'idsalida' => $idsalida,
            'detalleparciales' => $detalleparciales);
        $this->load->view('header');
        $this->load->view('salida/detalle', $data);
        $this->load->view('footer');
    }
    public   function agregarParteOrdenDetalladoMaster($idtransferecia,$idcajas, $idsalida) {
       //Permission::grant(uri_string());
        //echo $idtransferecia;
        $datadetallesalida = $this->salida->detalleSalida($idsalida);
        $datadetalleorden = $this->salida->detallesDeOrden($idsalida);
        $datadetalleparte = $this->salida->showPartesDetalle($idtransferecia,$idcajas);
        $detallepallet = $this->salida->detallepallet($idsalida);
        $detalleparciales = $this->salida->detalleparciales($idsalida); 
         $datos=$this->test2($idsalida); 
        // var_dump($datos);
        

        
        //var_dump($datadetalleparte);
        $data = array(
            'datosparte'=>$datos,
            'detallesalida' => $datadetallesalida,
            'detalleorden' => $datadetalleorden,
            'cajasporpallet' =>$datadetalleparte->cajasporpallet,
            'idsalida' => $idsalida,
            'idtransferecia'=>$idtransferecia,
            'idcajas'=>$idcajas,
            'detalleparte' => $datadetalleparte,
            'idsalida' => $idsalida,
            'detalleparciales' => $detalleparciales);
        $this->load->view('header');
        $this->load->view('salida/detallemaster', $data);
        $this->load->view('footer');
    }

    public function agregarParteOrden() {

//Permission::grant(uri_string());
        $datainsert = array(
            'idsalida' => $this->input->post('idsalida'),
            'iddetalleparte' => $this->input->post('iddetalleparte'),
            'pallet' => $this->input->post('pallet'),
            'caja' => $this->input->post('cajas'),
            'revision' => '0',
            'idusuario' => $this->session->user_id,
            'fecharegistro' => date('Y-m-d H:i:s'));
        $this->salida->addOrdenSalida($datainsert);
        redirect('/salida/detalleSalida/' . $this->input->post('idsalida'));
    }
    public function deleteSalida()
    {
        # code...
        $idsalida = $this->input->get('idsalida');
        $query = $this->salida->deleteSalida($idsalida);
        if ($query) {
            $result['salidas'] = true;
        } 
        echo json_encode($result);
    }
    public function generarPDFOrden($idsalida) {
        //Permission::grant(uri_string());
        $this->load->library('tcpdf'); 
        $detalle= $this->salida->detalleSalidaOrden($idsalida); 
        $lista= array();
        $listapallet = $this->salida->obtenerOrdenNoParciales($idsalida); 
        $listaparciales = $this->salida->obtenerOrdenParciales($idsalida);
        $sumatotalcajas = 0;
        $sumatotalpallet = 0;
        
        foreach($listapallet as $valuepal){
            $sumatotalcajas = $sumatotalcajas + $valuepal->sumacajas;
            $sumatotalpallet = $sumatotalpallet + $valuepal->totalpallet;
        }
        foreach($listaparciales as $valuepar){
             $sumatotalcajas = $sumatotalcajas + $valuepar->sumacajas;
        }
        
        $nombrecliente =  $detalle->nombre;
        $direccioncliente = $detalle->direccion; 
        $fecha = date('d-m-Y',strtotime($detalle->fecharegistro));
        $hora =  date('h:i A',strtotime($detalle->fecharegistro));
        $numerosalida = $detalle->numerosalida;
        $numerotransferencia = $detalle->idsalida;
        // create new PDF document
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Nicola Asuni');
        $pdf->SetTitle('Generar Orden de Salida');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// remove default header/footer
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        $pdf->AddPage('L', 'A4');

// create some HTML content
$html = '
<style type="text/css">
    .bordes{
		border-top:solid 1px #000; border-right:solid 1px #000; border-left:solid 1px #000; border-bottom:solid 1px #000;
		}
	.borde-t{
		border-top:solid 1px #000; 
		}
	.borde-r{
		border-right:solid 1px #000;
		}
    .borde-b{
		border-bottom:solid 1px #000;
		}
	.borde-l{
		border-left:solid 1px #000;
		}
			.color{
		background-color:#999;
		}
    </style> 
<table width="780" cellpadding="1" cellspacing="1">
  <tr>
    <td width="310" class="color bordes" colspan="3" align="center" style="font-size:9px">FROM</td>
    <td width="150">&nbsp;</td>
    <td width="80">&nbsp;</td>
    <td width="80" align="center" class="color bordes" style="font-size:9px">DATE</td>
    <td width="160" colspan="2" class="color bordes" align="center" style="font-size:9px">TRANSFER SHEET</td>
  </tr>
  <tr>
    <td width="310" colspan="3" rowspan="4" align="center" class="borde-l borde-r borde-b" style="font-size:11px">CALLE RUBILINA NO 33 PARQUE INDUSTRIAL PALACO MEXICALI</td>
    <td width="150">&nbsp;</td>
    <td width="80">&nbsp;</td>
    <td width="80" class="borde-l borde-r borde-b" align="center" style="font-size:9px">'.$fecha.'</td>
    <td width="160" colspan="2" class="borde-r" align="center" style="font-size:9px">'.$numerosalida.'</td>
  </tr>
  <tr>
    <td width="150">&nbsp;</td>
    <td width="80">&nbsp;</td>
	<td width="80" align="center"  class="borde-l borde-r" style="font-size:9px">'.$hora.'</td>
    <td width="160" colspan="2" class="borde-r">&nbsp;</td>
    
  </tr>
  <tr>
    <td width="150">&nbsp;</td>
    <td width="80" align="center" style="font-size:9px">SHIP TO:</td>
<td width="240" colspan="3" class="color bordes" align="center" style="font-size:9px">'.$nombrecliente.'</td>
  </tr>
  <tr>
    <td width="150">&nbsp;</td>
    <td width="80" align="center" style="font-size:9px">ADDRESS:</td>
<td width="240" colspan="3" rowspan="3" align="center" class="borde-r borde-l borde-b" style="font-size:12px">'.$direccioncliente.'</td>
  </tr>
  <tr>
    <td width="130"  class="color bordes" align="center" style="font-size:9px">P.O Number</td>
    <td  width="90" class="color bordes" align="center" style="font-size:9px">Terms</td>
    <td width="90" class="color bordes" align="center" style="font-size:9px">CNT</td>
    <td width="150">&nbsp;</td>
    <td width="80">&nbsp;</td>
  </tr>
  <tr>
    <td width="130" class="bordes" align="center">'.$detalle->po.'</td>
    <td width="90" class="bordes">&nbsp;</td>
    <td width="90" class="bordes" align="center">'.$numerotransferencia.'</td>
    <td width="150">&nbsp;</td>
    <td width="80">&nbsp;</td>
  </tr>
</table>
<br/><br/>
<table width="780" border="1">
  <tr>
    <td width="130" align="center" class="color" style="font-size:9px">Item Code</td>
    <td width="180" colspan="2" align="center" class="color" style="font-size:9px">Description</td>
    <td width="90" colspan="2" class="color">&nbsp;</td>
    <td width="90" colspan="2" align="center" class="color" style="font-size:9px">Partial</td>
    <td width="45" align="center" class="color" style="font-size:9px">Total</td>
    <td width="250" colspan="3"  align="center"  class="color"  style="font-size:9px">TARMIMAS FAVOR DE RETORNAR A WOORI</td>
    </tr>
    ';
    foreach($listapallet as $valurpal){
        $html.='<tr>
                <td width="130" align="center" style="font-size:9px">&nbsp;'.$valurpal->numeroparte.'</td>
                <td width="180" colspan="2" align="center" style="font-size:9px">&nbsp;'.$valurpal->modelo.'</td>
                <td width="45" align="center" style="font-size:9px">'. number_format($valurpal->totalpallet).'</td>
                <td width="45" align="center" style="font-size:9px">'.number_format($valurpal->sumacajas / $valurpal->totalpallet).'</td>
                <td width="45" align="right" style="font-size:9px">&nbsp;</td>
                <td width="45" align="right" style="font-size:9px">&nbsp;</td>
                <td width="45" align="center" style="font-size:9px">&nbsp;'.number_format($valurpal->sumacajas).'</td>
                <td width="45">'.$valuepal->po.'</td>
                <td width="45">&nbsp;</td>
                <td width="160">&nbsp;</td>
              </tr>'; 
    }
         foreach($listaparciales as $valurpar){
        $html.='<tr>
                <td width="130" align="center" style="font-size:9px">&nbsp;'.$valurpar->numeroparte.'</td>
                <td width="180" colspan="2" align="center" style="font-size:9px">&nbsp;'.$valurpar->modelo.'</td>
                <td width="45" align="center" style="font-size:9px"></td>
                <td width="45" align="center" style="font-size:9px"></td>
                <td width="45" align="center" style="font-size:9px">1</td>
                <td width="45" align="center" style="font-size:9px">'.number_format($valurpar->sumacajas).'</td>
                <td width="45" align="center" style="font-size:9px">&nbsp;'.number_format($valurpar->sumacajas).'</td>
                <td width="45">'.$valuepar->po.'</td>
                <td width="45">&nbsp;</td>
                <td width="160">&nbsp;</td>
              </tr>'; 
    }

    $html.=' 
  <tr>
    <td width="130" align="center" style="font-size:9px">&nbsp;</td>
    <td width="180" colspan="2" align="center" style="font-size:9px">&nbsp;</td>
    <td width="45" align="right" style="font-size:9px">&nbsp;</td>
    <td width="45" align="right" style="font-size:9px">&nbsp;</td>
    <td width="45" align="right" style="font-size:9px">&nbsp;</td>
    <td width="45" align="right" style="font-size:9px">&nbsp;</td>
    <td width="45" align="right" style="font-size:9px">&nbsp;</td>
    <td width="45">&nbsp;</td>
    <td width="45">&nbsp;</td>
    <td width="160">&nbsp;</td>
  </tr>

  <tr>
    <td width="130" align="center" style="font-size:9px">&nbsp;</td>
    <td width="180" colspan="2" align="center" style="font-size:9px">&nbsp;</td>
    <td width="45" align="right" style="font-size:9px">&nbsp;</td>
    <td width="45" align="right" style="font-size:9px">&nbsp;</td>
    <td width="45" align="right" style="font-size:9px">&nbsp;</td>
    <td width="45" align="center" style="font-size:9px">Total</td>
    <td width="45" align="center" style="font-size:9px">'.number_format($sumatotalcajas).'&nbsp;&nbsp;</td>
    <td width="45">&nbsp;</td>
    <td width="45">&nbsp;</td>
    <td width="160">&nbsp;</td>
  </tr>
  <tr>
    <td width="220" colspan="2" class="color" style="font-size:9px">&nbsp;Dato de salida</td>
    <td width="90" style="font-size:9px" class="color" align="center">Hora de salida</td>
    <td width="475" colspan="8" class="color" style="font-size:9px;"> &nbsp;Elaboro</td>
  </tr>
  <tr>
    <td width="130" style="font-size:9px" align="center">Nombre chofer</td>
    <td width="90" style="font-size:9px" align="center">Fecha</td>
    <td width="90" style="font-size:9px">&nbsp;</td>
	<td width="475" colspan="8" style="font-size:10px">&nbsp;'.$detalle->name.'</td>
  </tr>
  <tr>
    <td width="130" style="font-size:9px">&nbsp;</td>
    <td width="90" style="font-size:9px">&nbsp;</td>
    <td width="565" colspan="9">'.$detalle->notas.'</td>
    
  </tr>
</table>
<br /><br />
<table width="780" cellpadding="1" cellspacing="1">
  <tr>
    <td align="right" style="font-size:9px">WBKP-AL-FO-004</td>
  </tr>
    <tr>
    <td align="right" style="font-size:9px">Rev. 00</td>
  </tr>
</table>
';

// output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');
//Close and output PDF document
        ob_end_clean();
        $pdf->Output('My-File-Name.pdf', 'I');
    }

}

?>
