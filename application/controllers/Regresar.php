<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Regresar extends CI_Controller {

    function __construct()
    {
        parent::__construct();

        if (!isset($_SESSION['user_id'])) {
            $this->session->set_flashdata('flash_data', 'You don\'t have access! ss');
            return redirect('login');
        }

        $this->load->helper('url');
        $this->load->model('data_model');
        $this->load->model('almacen_model', 'almacen');
        $this->load->model('linea_model', 'linea');
        $this->load->model('cantidad_model', 'cantidad');
        $this->load->model('transferencia_model', 'transferencia');
        $this->load->model('posicionbodega_model', 'posicionbodega');
        $this->load->model('revision_model', 'revision');
        $this->load->model('modelo_model', 'modelo');
        $this->load->model('palletcajasproceso_model', 'palletcajasproceso');
        $this->load->model('return_model', 'return');
        $this->load->library('permission');
        $this->load->library('session');
    }

    public function index()
    {
        Permission::grant(uri_string());
        $query = $this->transferencia->showAllAjuste();
        ///var_dump($query);
        $data = array(
            'datatransferencia' => $query
        );

        $this->load->view('header');
        $this->load->view('catSistema/regreso/index',$data);
        $this->load->view('footer');
    }
        public function agregar_regresar() {
        //Permission::grant(uri_string());
        $folio = $this->transferencia->obtenerUltimoFolio();
        $numerofolio = $folio->folio;
        $nuevo = $numerofolio + 1;
        $data = array(
            'folio' => $nuevo,
            'idusuario' => $this->session->user_id,
            'fecharegistro' => date('Y-m-d H:i:s')
        );
       $idtransferencia =  $this->transferencia->addTransferencia($data);
       $data_ajuste = array(
        'idtransferencia'=>$idtransferencia,
        'idusuario' => $this->session->user_id,
        'fecharegistro' => date('Y-m-d H:i:s')
       );
       $this->transferencia->addAjusteTransferencia($data_ajuste);
        redirect('Regresar/');
    }
      public function detalle($id, $folio) {
        # code...
        //Permission::grant(uri_string());
        $datalinea = $this->linea->showAllLinea();
        $datatransferencia = $this->return->listaNumeroParteTransferencia($id);

        $data = array(
            'id' => $id,
            'folio' => $folio,
            'datalinea' => $datalinea,
            'datatransferencia' => $datatransferencia,
            'posiciones'=>$this->posicionbodega->posicionesBodegaActivo());
        $this->load->view('header');
        $this->load->view('catSistema/regreso/detalle',$data);
        $this->load->view('footer');
    }
  public function soloNumeros($laCadena) {
        //Permission::grant(uri_string());
        $carsValidos = "0123456789";
        for ($i = 0; $i < strlen($laCadena); $i++) {
            if (strpos($carsValidos, substr($laCadena, $i, 1)) === false) {
                return false;
            }
        }
        return true;
    }
     public function registrar() {
        //Permission::grant(uri_string());
        $numeroparte = $this->input->post('numeroparte');
        //$cliente = $this->input->post('cliente');
        $modelo = $this->input->post('modelo');
        $revision = $this->input->post('revision');
        $linea = $this->input->post('linea');
        $cajas = $this->input->post('cajasxpallet');
        $cantidad = $this->input->post('cantidad');
        $idposicion = $this->input->post('idposicion');
        $idtransferencia = $this->input->post('idtransferencia');
        if ((isset($numeroparte) && !empty($numeroparte))   && (isset($modelo) && !empty($modelo)) && (isset($revision) && !empty($revision)) && (isset($linea) && !empty($linea)) && (isset($cajas) && !empty($cajas)) && (isset($cantidad) && !empty($cantidad))) {

            if ($this->soloNumeros($cantidad) == true && $this->soloNumeros($cajas) == true) {
                $result = $this->transferencia->validadCantidadVersion($revision,$cajas);
                if($result != false ){
                    $idcantidad = $result->idcantidad;
                    for ($i = 1; $i <= $cantidad; $i++) {
                        $data = array(
                            'idtransferancia' => $idtransferencia,
                            'pallet' => 1,
                            'idcajas' => $idcantidad,
                            'idlinea' => $linea,
                            'idestatus' => 8,
                            'idusuario' => $this->session->user_id,
                            'fecharegistro' => date('Y-m-d H:i:s')
                        );
                      $idpalletcajas =  $this->transferencia->addPalletCajas($data);

                     $data_posicion_bodega = array(
                        'idpalletcajas'=>$idpalletcajas,
                        'numero'=>1,
                        'idposicion'=>$idposicion,
                        'ordensalida'=>0,
                        'salida'=>0,
                        'idusuario' => $this->session->user_id,
                        'fecharegistro' => date('Y-m-d H:i:s')
                     );
                     $this->posicionbodega->addPartePosicionBodega($data_posicion_bodega);

                     $data_detalle_pallet = array(
                        'idpalletcajas'=>$idpalletcajas,
                        'idusuario' => $this->session->user_id,
                        'fecharegistro' => date('Y-m-d H:i:s')
                     );
                     $this->return->addDetalleTransferencia($data_detalle_pallet);
                }
            }else{

                $dataadd = array(
                    'idrevision'=>$revision,
                    'cantidad'=>$cajas,
                    'idusuario' => $this->session->user_id,
                    'fecharegistro' => date('Y-m-d H:i:s')
                );
                $idcantidad = $this->cantidad->addCantidad($dataadd);
                for ($i = 1; $i <= $cantidad; $i++) {
                        $data = array(
                            'idtransferancia' => $idtransferencia,
                            'pallet' => 1,
                            'idcajas' => $idcantidad,
                            'idlinea' => $linea,
                            'idestatus' => 8,
                            'idusuario' => $this->session->user_id,
                            'fecharegistro' => date('Y-m-d H:i:s')
                        );
                      $idpalletcajas =  $this->transferencia->addPalletCajas($data);

                     $data_posicion_bodega = array(
                        'idpalletcajas'=>$idpalletcajas,
                        'numero'=>1,
                        'idposicion'=>$idposicion,
                        'ordensalida'=>0,
                        'salida'=>0,
                        'idusuario' => $this->session->user_id,
                        'fecharegistro' => date('Y-m-d H:i:s')
                     );
                     $this->posicionbodega->addPartePosicionBodega($data_posicion_bodega);

                     $data_detalle_pallet = array(
                        'idpalletcajas'=>$idpalletcajas,
                        'idusuario' => $this->session->user_id,
                        'fecharegistro' => date('Y-m-d H:i:s')
                     );
                     $this->return->addDetalleTransferencia($data_detalle_pallet);
                }

            }

            } else {
                //Solo numero las cantidades
                echo "2";
            }
        } else {
            //Todos los campos requeridos
            echo "1";
        }
    }



public function eliminar($idpalletcajas,$idtransferencia,$folio)
{
    # code...

    if ($this->return->deletePartePosicion($idpalletcajas)) {
        # code...
        $this->return->deleteDetalleTransferencia($idpalletcajas);
        $this->return->deletePalletCaja($idpalletcajas);
    }

     redirect('regresar/detalle/'.$idtransferencia.'/'.$folio);
}
public function eliminar_transferencia($idtransferencia,$folio)
{
        if($this->return->allParteTransferencia($idtransferencia) == false){
        $this->return->deleteAjusteCaja($idtransferencia);
        $this->return->deleteTransferencia($idtransferencia);
        }


     redirect('Regresar/');
}

 public function seleccionarModelo() {
        $idmodelo = $this->input->post('idmodelo');
        $option = "";

        $datavalista = $this->transferencia->listaRevisionxNumeroParte($idmodelo);
        if($datavalista != false){
        foreach ($datavalista as $value) {
            $option .= "<option value='" . $value->idrevision . "'>" . $value->descripcion . "</option>";
        }
        echo $option;
            }else{
                echo 1;

            }
    }

    public function seleccionarRevision() {
        $idrevision = $this->input->post('idrevision');
        $option = "";
        $datavalista = $this->transferencia->listaCantidadxNumeroParte($idrevision);
        foreach ($datavalista as $value) {
            $option .= "<option value='" . $value->idcantidad . "'>" . $value->cantidad . "</option>";
        }
        echo $option;
    }


public function validar() {
        $option = "";
        $numrtoparte = trim($this->input->post('numeroparte'));
        $datavali = $this->transferencia->validarExistenciaNumeroParte($numrtoparte);
        if ($datavali != FALSE) {
            $idparte = $datavali->idparte;
           $datavalista = $this->transferencia->listaModeloxNumeroParte($idparte);
            if($datavalista){
            foreach ($datavalista as $value) {
            $option .= "<option value='" . $value->idmodelo . "'>" . $value->descripcion . "</option>";
            }
            echo $option;
        }else{
            echo 2;
        }


        } else {
            //El numero de parte de existe.
            echo 1;
        }
    }






 }


?>
