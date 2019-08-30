<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Transferencia extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!isset($_SESSION['user_id'])) {
            $this->session->set_flashdata('flash_data', 'You don\'t have access! ss');
            return redirect('login');
        }
        $this->load->helper('url');
        $this->load->model('almacen_model', 'almacen');
        $this->load->model('linea_model', 'linea');
        $this->load->model('cantidad_model', 'cantidad');
        $this->load->model('transferencia_model', 'transferencia');
        $this->load->model('revision_model', 'revision');
        $this->load->model('modelo_model', 'modelo');
        $this->load->model('palletcajasproceso_model', 'palletcajasproceso');
        //$this->load->library('permission');
    }

    public function index() {
        //Permission::grant(uri_string());
        $query = $this->transferencia->showAll();
        $data = array(
            'datatransferencia' => $query
        ); 
        $this->load->view('header');
        $this->load->view('transferencia/index', $data);
        $this->load->view('footer');
    }

    public function showAll() {
        $query = $this->transferencia->showAll();
        if ($query) {
            $result['transferencias'] = $this->transferencia->showAll();
        }
        echo json_encode($result);
    }

    public function detalle($id, $folio) {
        # code...
        $datalinea = $this->linea->showAllLinea();
        $datatransferencia = $this->transferencia->listaNumeroParteTransferencia($id);
       
        $data = array(
            'id' => $id,
            'folio' => $folio,
            'datalinea' => $datalinea,
            'datatransferencia' => $datatransferencia);
        $this->load->view('header');
        $this->load->view('transferencia/detalle', $data);
        $this->load->view('footer');
    }

    public function validar() {
        $option = "";
        $numrtoparte = $this->input->post('numeroparte');
        $datavali = $this->transferencia->validarExistenciaNumeroParte($numrtoparte);
        if ($datavali != FALSE) {
            $idparte = $datavali->idparte;
           $datavalista = $this->transferencia->listaModeloxNumeroParte($idparte);
        foreach ($datavalista as $value) {
            $option .= "<option value='" . $value->idmodelo . "'>" . $value->descripcion . "</option>";
        }
            echo $option;
        } else {
            //El numero de parte de existe.
            echo 1;
        }
    }

    public function seleccionarCliente() {
        $idparte = $this->input->post('idparte');
        $option = "";
        $datavalista = $this->transferencia->listaModeloxNumeroParte($idparte);
        foreach ($datavalista as $value) {
            $option .= "<option value='" . $value->idmodelo . "'>" . $value->descripcion . "</option>";
        }
        echo $option;
    }

    public function seleccionarModelo() {
        $idmodelo = $this->input->post('idmodelo');
        $option = "";
        $datavalista = $this->transferencia->listaRevisionxNumeroParte($idmodelo);
        foreach ($datavalista as $value) {
            $option .= "<option value='" . $value->idrevision . "'>" . $value->descripcion . "</option>";
        }
        echo $option;
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

    public function enviaracalidad() {
        $numerocaja = $this->input->post('numerocaja');
        $numeroetiqueta = $this->input->post('numeroetiqueta');
        $ids = $this->input->post('id');
        foreach ($ids as $value) {
            $datavalidar = $this->transferencia->validarEnvioCalidad($value, $numeroetiqueta, $numerocaja);
            if ($datavalidar != false) {
                $data = array(
                    'idestatus' => 1
                );
                $this->transferencia->updateEnvio($value, $data);

                $dataproceso = array(
                    'idpalletcajas' => $value,
                    'idestatus' => 1,
                    'idusuario' => $this->session->user_id,
                    'fecharegistro' => date('Y-m-d H:i:s')
                );
                $this->palletcajasproceso->addPalletCajasProceso($dataproceso);
                echo "1";
            } else {

                //No coinciden las etiquetas
                echo "0";
            }
        }
    }

    public function rechazopallet() {
        $idpalletcajas = $this->input->post('idpalletcajas');
        $data = $this->transferencia->motivosrechazo($idpalletcajas);
        echo json_encode($data);
    }

    public function soloNumeros($laCadena) {
        $carsValidos = "0123456789";
        for ($i = 0; $i < strlen($laCadena); $i++) {
            if (strpos($carsValidos, substr($laCadena, $i, 1)) === false) {
                return false;
            }
        }
        return true;
    }

    public function registrar() {
        $numeroparte = $this->input->post('numeroparte');
        //$cliente = $this->input->post('cliente');
        $modelo = $this->input->post('modelo');
        $revision = $this->input->post('revision');
        $linea = $this->input->post('linea');
        $cajas = $this->input->post('cajasxpallet');
        $cantidad = $this->input->post('cantidad');
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
                            'idestatus' => 14,
                            'idusuario' => $this->session->user_id,
                            'fecharegistro' => date('Y-m-d H:i:s')
                        );
                        $this->transferencia->addPalletCajas($data);
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
                            'idestatus' => 14,
                            'idusuario' => $this->session->user_id,
                            'fecharegistro' => date('Y-m-d H:i:s')
                        );
                        $this->transferencia->addPalletCajas($data);
                }

            }

            } else {
                echo "2";
            }
        } else {
            //El numero de parte  es requerido.
            echo "1";
        }
    }

    public function eliminarpallet() {
        $ids = $this->input->post('id');
        $contador = 0;
        foreach ($ids as $value) {

            $val = $this->transferencia->validarEliminacion($value);

            if ($value != false) {
                $data = array(
                    'idestatus' => 17
                );
                $this->transferencia->updateEnvio($value, $data);

                $dataproceso = array(
                    'idpalletcajas' => $value,
                    'idestatus' => 17,
                    'idusuario' => $this->session->user_id,
                    'fecharegistro' => date('Y-m-d H:i:s')
                );
                $this->palletcajasproceso->addPalletCajasProceso($dataproceso);
            } else {
                $contador++;
            }
        }
        if ($contador > 0) {
            echo "0";
        } else {
            echo "1";
        }
    }

    public function generarPDFEnvio($id) {
        //Permission::grant(uri_string());
        $this->load->library('tcpdf');
        $listapartes = $this->transferencia->palletReporte($id);
        $totalpallet = 0;
        $totalcajas = 0;
        if ($listapartes != false) {

            foreach ($listapartes as $value) {
                $totalpallet = $totalpallet + $value->totalpallet;
                $totalcajas = $totalcajas + $value->totalcajas;
            }
        }


        $detalle = $this->transferencia->detalleTransferencia($id);
        $horario = $detalle->horainicial . " - " . $detalle->horafinal;
        $linkimge = base_url() . '/assets/images/woorilogo.png';
        $fechaactual = date('d/m/Y');
        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetTitle('Generar documento de envio.');
        $pdf->SetHeaderMargin(30);
        $pdf->SetTopMargin(20);
        $pdf->setFooterMargin(20);
        $pdf->SetAutoPageBreak(true);
        $pdf->SetAuthor('Author');
        $pdf->SetDisplayMode('real', 'default');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        $pdf->AddPage();

        $tbl = '
<style type="text/css">
.textgeneral{
	font-size:8px;
	color:#000;
	font-weight:bold;
	font-family:Verdana, Geneva, sans-serif
	}
	.textfooter{
	font-size:8px;
	color:#000;
	font-weight:bold;
	font-family:Verdana, Geneva, sans-serif
	}

.lineabajo{
	border-bottom:solid 1px #000000;
	}
.imgtitle{ width:120px;}

</style>

<table width="536"   cellpadding="1" cellspacing="1" >
  <tr>
    <td align="center" class="textgeneral"><center><img  align="center" class="imgtitle" src="' . $linkimge . '"; /></center></td>
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td width="234" align="center" class="textgeneral"><strong>Transferencia de producto terminado</strong></td>
    <td width="22">&nbsp;</td>
    <td width="96">&nbsp;</td>
    <td width="100" align="center" style="border-left:solid 1px #000000; border-right:solid 1px #000000; border-top:solid 1px #000"><p class="textgeneral">TRANSFERENCIA NÚMERO</p></td>
    <td width="82" align="center" style="border-top:solid 1px #000000; border-right:solid #000 1px">' . $detalle->folio . '</td>
  </tr>
  <tr>
    <td class="textgeneral lineabajo">FECHA: ' . $fechaactual . '</td>
    <td>&nbsp;</td>
      <td colspan="3" align="center" class="textgeneral" style="border-top:solid 1px #000; border-right:solid 1px #000; border-left:solid 1px #000; border-bottom:solid 1px #000;">PRODUCCIÓN</td>
  </tr>
  <tr>
    <td class="textgeneral lineabajo">HORA: ' . $horario . '</td>
    <td>&nbsp;</td>
    <td colspan="3" class="textgeneral lineabajo">HECHA POR: ' . $detalle->name . '</td>
  </tr>
  <tr>
    <td class="textgeneral lineabajo">TURNO: ' . $detalle->nombreturno . '</td>
    <td>&nbsp;</td>
    <td colspan="3" class="textgeneral lineabajo">RECIBIDA POR:  </td>
  </tr>
</table>
<br><br>
<table width="536"  style="margin-top:10px" cellpadding="1" cellspacing="1">
  <tr class="textgeneral">
    <td width="58" align="center" valign="middle" style="border:solid 1px #000000">CLIENTE</td>
    <td width="125" align="center" valign="middle"  style="border-top:solid 1px #000000; border-bottom:solid 1px #000000; border-right:solid 1px #000000;">NUM. PARTE</td>
    <td width="52" align="center" valign="middle" style="border-top:solid 1px #000000; border-bottom:solid 1px #000000; border-right:solid 1px #000000;">MODELO</td>
    <td width="66" align="center" valign="middle" style="border-top:solid 1px #000000; border-bottom:solid 1px #000000; border-right:solid 1px #000000;">CANTIDAD POR PALLET</td>
    <td width="67" align="center" valign="middle" style="border-top:solid 1px #000000; border-bottom:solid 1px #000000; border-right:solid 1px #000000;">TOTAL DE PALLET</td>
    <td width="66" align="center" valign="middle" style="border-top:solid 1px #000000; border-bottom:solid 1px #000000; border-right:solid 1px #000000;">CANTIDAD TOTAL</td>
    <td width="100" align="center" valign="middle" style="border-top:solid 1px #000000; border-bottom:solid 1px #000000; border-right:solid 1px #000000;">ALMACEN VERIFICACIÓN</td>
  </tr>
  ';
        foreach ($listapartes as $value) {
            $tbl .= '<tr>
    <td style="border-left:solid 1px
    #000000; border-bottom:solid 1px #000; font-size:8px; border-right:solid 1px #000;">&nbsp;' . $value->nombrecliente . '</td>
    <td style="border-bottom:solid 1px #000; font-size:8px;  border-right:solid 1px #000;">&nbsp;' . $value->numeroparte . '</td>
    <td style="border-bottom:solid 1px #000; font-size:8px;  border-right:solid 1px #000;">&nbsp;' . $value->descripcionmodelo . '</td>
    <td style="border-bottom:solid 1px #000; font-size:8px; border-right:solid 1px #000;">&nbsp;' . number_format($value->cantidad) . '</td>
    <td style="border-bottom:solid 1px #000; font-size:8px; border-right:solid 1px #000;">&nbsp;' . number_format($value->totalpallet) . '</td>
    <td style="border-bottom:solid 1px #000; font-size:8px; border-right:solid 1px #000;">&nbsp;' . number_format($value->totalcajas) . '</td>
    <td style="border-bottom:solid 1px #000; font-size:8px; border-right:solid 1px #000;">&nbsp;</td>
  </tr>';
        }
        $tbl .= ' 
    
    <tr style=" background-color:#EAEAEA">
    <td style=" border-left:solid 1px
    #000000; border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td class="textfooter" style="border-bottom:solid 1px #000; border-right:solid 1px #000;">TOTAL:</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000; font-size:9px; margin-top:20px;">&nbsp;' . $totalpallet . ' </td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000; font-size:9px;">&nbsp;' . number_format(($totalcajas / $totalpallet) * ($totalpallet)) . '</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
  </tr>
 <tr>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td>&nbsp; </td>
    <td >&nbsp;</td>
    <td colspan="2" align="right" class="textfooter" >WBKP-PR-FO-007</td>
  </tr>
 <tr>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td>&nbsp; </td>
    <td >&nbsp;</td>
    <td colspan="2" align="right" class="textfooter" >Rev. 01</td>
  </tr>
    <tr>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td>&nbsp; </td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" class="textfooter" >Inspección 100% por:</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" class="textfooter"style="border-right:solid 1px #000; border-left:solid 1px #000; border-top:solid 1px #000; padding-left:5px;"  >&nbsp;&nbsp;RESPONSABLE DE PACKING</td>
    <td colspan="4" class="lineabajo" >&nbsp;</td>
    <td >&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" class="textfooter" style="border-right:solid 1px #000; border-left:solid 1px #000; border-top:solid 1px #000; padding-left:5px;" >&nbsp;&nbsp;INSPECTOR OQC</td>
    <td colspan="4" class="lineabajo" >&nbsp;</td>
    <td >&nbsp;</td>
  </tr>
    <tr>
    <td colspan="2" class="textfooter" style="border-right:solid 1px #000; border-left:solid 1px #000; border-top:solid 1px #000; padding-left:5px;" >&nbsp;&nbsp;RESPONSABLE DE ALMACEN</td>
    <td colspan="4" class="lineabajo" >&nbsp;</td>
    <td >&nbsp;</td>
  </tr>
    <tr>
    <td colspan="2" class="textfooter" style="border-bottom:solid 1px #000; border-top:solid 1px #000; border-left:solid 1px #000; border-right:solid 1px #000; padding-left:5px;" >&nbsp;&nbsp;2DA INSTAPECCION EXTERNA</td>
    <td colspan="4" class="lineabajo" >&nbsp;</td>
    <td >&nbsp;</td>
  </tr>
    <tr>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td colspan="4" align="center" class="textfooter" >NOMBRE/FIRMA</td>
    <td >&nbsp;</td>
  </tr>

  </table>
 ';

        $pdf->writeHTML($tbl, true, false, false, false, '');

        ob_end_clean();


        $pdf->Output('My-File-Name.pdf', 'I');
    }

    public function agregar() {
        $folio = $this->transferencia->obtenerUltimoFolio();
        $numerofolio = $folio->folio;
        $nuevo = $numerofolio + 1;
        $data = array(
            'folio' => $nuevo,
            'idusuario' => $this->session->user_id,
            'fecharegistro' => date('Y-m-d H:i:s')
        );
        $this->transferencia->addTransferencia($data);
        redirect('transferencia/');
    }

    public function eliminar($id) {

        $vali = $this->transferencia->listaPalletCajas($id);
        if ($vali == false) {
            $this->transferencia->deleteTransferencia($id);
        }
        redirect('transferencia/');
    }

    public function set_barcode($code) {

        //load library
        $this->load->library('zend');
        //load in folder Zend
        $this->zend->load('Zend/Barcode');
        //generate barcode 
        $file = Zend_Barcode::draw('code128', 'image', array('text' => $code, 'factor' => 1.5, 'stretchText' => true), array());
        $code = time();
        $barcodeRealPath = $_SERVER['DOCUMENT_ROOT'] . '/sisproduction/assets/cache/' . $code . '.png';

        // header('Content-Type: image/png');
        $store_image = imagepng($file, $barcodeRealPath);
        return base_url() . 'assets/cache/' . $code . '.png';
    }
       public function set_barcode_cliente($code) {

        //load library
        $this->load->library('zend');
        //load in folder Zend
        $this->zend->load('Zend/Barcode');
        //generate barcode 
        $file = Zend_Barcode::draw('code128', 'image', array('text' => $code, 'factor' => 1.5, 'stretchText' => true), array());
        $code = time();
        $barcodeRealPath = $_SERVER['DOCUMENT_ROOT'] . '/sisproduction/assets/barcodecliente/' . $code . '.png';

        // header('Content-Type: image/png');
        $store_image = imagepng($file, $barcodeRealPath);
        return base_url() . 'assets/barcodecliente/' . $code . '.png';
    }
       public function set_barcode_cantidad($code) {

        //load library
        $this->load->library('zend');
        //load in folder Zend
        $this->zend->load('Zend/Barcode');
        //generate barcode 
        $file = Zend_Barcode::draw('code128', 'image', array('text' => $code, 'factor' => 1.5, 'stretchText' => true), array());
        $code = time();
        $barcodeRealPath = $_SERVER['DOCUMENT_ROOT'] . '/sisproduction/assets/barcodecantidad/' . $code . '.png';

        // header('Content-Type: image/png');
        $store_image = imagepng($file, $barcodeRealPath);
        return base_url() . 'assets/barcodecantidad/' . $code . '.png';
    }

    public function etiquetaPacking($idpalletcajas) {
        // Permission::grant(uri_string());
        date_default_timezone_set("America/Tijuana");
        $detalle = $this->transferencia->detalleDelDetallaParte($idpalletcajas); 
        $barcode = $this->set_barcode($detalle->numeroparte);
        $barcodecliente = $this->set_barcode_cliente($detalle->clave);
        $barcodecantidad= $this->set_barcode_cantidad($detalle->cantidad);
        $hora = date("h:i a");
        $fecha = date("j/n/Y");
        $dia = date("j");
        $semana = date("W");
        $mes = date("F");
        $this->load->library('html2pdf');
        ob_start();


        $mipdf = new HTML2PDF('L', 'Letter', 'es', 'true', 'UTF-8');
        $mipdf->pdf->SetDisplayMode('fullpage');
        $mipdf->writeHTML('<page  format="400x165"  >
 <style type="text/css">
            table {border-collapse:collapse}
            td 
                {
                    border:0px  solid black;
                }
    </style>

    <br>
    <table border="1" align="center">  
        <tr>
            <td  align="center" height="45" width="200"  style="font-size:35px; font-family:arial; font-weight:bold; background: #fff; color:#fff; " colspan="" >Customer</td>
            <td  align="center" width="220"  style="font-size:30px; font-family:arial; font-weight:bold; background: #fff; color:#fff; " colspan="" ></td>
            <td  align="center" width="220"  style="font-size:30px; font-family:arial; font-weight:bold; background: #fff; color:#fff;" colspan="">Pallet Quatity</td>    
            <td  align="center" width="220"  style="font-size:30px; font-family:arial; font-weight:bold; background: #fff; color:#fff;" colspan=""></td>
            <td  align="center" width="220"  style="font-size:30px; font-family:arial; font-weight:bold; background: #fff; color:#fff;" colspan="">Month</td>    
            <td  align="center" width="220"  style="font-size:30px; font-family:arial; font-weight:bold; background: #fff; color:#fff;" colspan="">Week</td>    
                
        </tr>

        <tr>
            <td align="center"  height="90"   valign="bottom" colspan="2"><img src="' . $barcodecliente . '" style="height:80px;" /><b style="font-size:40px; font-family:arial; font-weight:bold;  " >' . $detalle->nombre . '</b></td>    
        
            
            <td align="center" width="250"  style="font-size:60px; font-family:arial; font-weight:bold;  " colspan=""><img src="' . $barcodecantidad . '" style="height:80px;" /><b>' . $detalle->cantidad . '</b></td>
                
            <td align="center" style="font-size:60px; font-family:arial; vertical-align: top;  font-weight:bold;  " colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;' . $mes . '&nbsp;' . $dia . '</td>
            
            <td align="center" style="font-size:90px; font-family:arial; font-weight:bold;  " colspan="" valign="bottom" >' . $semana . '</td>

        </tr>

        <tr>
            <td  align="center" width=""  height=""  style="font-size:30px; font-family:arial; font-weight:bold; background: #; color:#fff; "  rowspan="" ></td>
            <td  align="center" width=""style="font-size:30px; font-family:arial; font-weight:bold; background: #; color:#fff;" colspan=""></td>
            <td  align="center" width=""  style="font-size:30px; font-family:arial; font-weight:bold; background: #; color:#fff; "  rowspan="" ></td>
            <td  align="center" width=""style="font-size:30px; font-family:arial; font-weight:bold; background: #; color:#fff;" colspan=""></td>    
            <td  align="left" valign="top" style="font-size:35px; font-family:arial; font-weight:bold; background: #fff; color:#000;" colspan="2"> &nbsp; ' . $hora . ' </td>

        </tr>

        <tr>
            <td  align="center" width="" height="50"  style="font-size:30px; font-family:arial; font-weight:bold; background: #fff; color:#fff; "  colspan="3" >Part Number</td>
            <td  align="center" width=""style="font-size:30px; font-family:arial; font-weight:bold; background: #fff; color:#fff;" colspan="3">Model Name</td>        
        </tr>

        <tr>
        <td colspan="3" rowspan="2" align="center"  style="font-size:30px;  font-family:arial; font-weight:bold; overflow:auto; height:145px; "  >' . $detalle->numeroparte . ' <br><img src="' . $barcode . '" style="height:117px;" /> </td>
        <td height="60" colspan="3" align="center"  style="font-size:60px; font-family:arial; vertical-align: top;  font-weight:bold; overflow:auto;" > &nbsp; &nbsp; &nbsp;' . $detalle->modelo . '</td>

        </tr>

        <tr>
        <td align="" height="" style="font-size:25px; font-family:arial; font-weight:bold;  " >&nbsp;</td>
        <td align="center"  style="font-size:30px; font-family:arial; font-weight:bold; overflow:auto; background: #fff; color:#fff; " >Rev No.</td>
        <td align="center"  style="font-size:30px; font-family:arial; font-weight:bold; overflow:auto;background: #fff; color:#fff; "  >Pallet No.</td>
        </tr>

        <tr>
            <td  align="center" width=""  style="font-size:30px; font-family:arial; font-weight:bold; background: #fff; color:#fff; " colspan="" rowspan="2">ROHS</td>
            <td  align="center" height="70"width=""style="font-size:30px; font-family:arial; font-weight:bold; background: #fff; color:#fff;"    colspan="">Line No</td>    
            <td  align="center" width=""style="font-size:30px; font-family:arial; font-weight:bold; background: #fff; color:#fff;"    colspan="">Prod.</td>    
            <td  align="center" width=""style="font-size:30px; font-family:arial; font-weight:bold; background: #fff; color:#fff;"    colspan="">W/H</td>
            <td align="center" valign="bottom" style="font-size:50px; font-family:arial; vertical-align: ;font-weight:bold; padding-top:15px; " colspan="">' . $detalle->revision . '</td>
            <td align="center" valign="bottom" style="font-size:50px; font-family:arial; font-weight:bold; padding-top:15px; " colspan="">1</td>    
        </tr>
        <tr>
            <td  align="center" height="60" width=""style="font-size:50px; font-family:arial; font-weight:bold; background: #fff; color:#000;padding-top:15px;"    colspan="">' . $detalle->nombrelinea . '</td>    
            <td  align="center" width=""style="font-size:30px; font-family:arial; font-weight:bold; background: #fff; color:#000;"    colspan=""></td>    
            <td  align="center" width=""style="font-size:30px; font-family:arial; font-weight:bold; background: #fff; color:#000;"    colspan=""></td>
            <td align="center" style="font-size:30px; font-family:arial; font-weight:bold; background: #fff; color:#fff;"  colspan=""></td>
            <td align="center" style="font-size:30px; font-family:arial; font-weight:bold; background: #fff; color:#fff;"  colspan="">WOORI USA</td>    
        </tr>

    </table>
</page>
');

        //$mipdf->pdf->IncludeJS('print(TRUE)');
        $mipdf->Output(APPPATH . 'pdfs\\' . 'Packing' . date('Ymdgisv') . '.pdf', 'F');
        $mipdf->Output('Etiqueta_Packing.pdf');
    }
    public function imprimirEtiquetaPacking() {
        
            date_default_timezone_set("America/Tijuana");
             $idpalletcajas = $this->input->post('idpalletcajas');
        $detalle = $this->transferencia->detalleDelDetallaParte($idpalletcajas); 
        $barcode = $this->set_barcode($detalle->numeroparte);
        $hora = date("h:i a");
        $fecha = date("j/n/Y");
        $dia = date("j");
        $semana = date("W");
        $mes = date("F");
        $this->load->library('html2pdf');
        ob_start();


        $mipdf = new HTML2PDF('L', 'Letter', 'es', 'true', 'UTF-8');
        $mipdf->pdf->SetDisplayMode('fullpage');
        $mipdf->writeHTML('<page  format="400x165"  >
 <style type="text/css">
            table {border-collapse:collapse}
            td 
                {
                    border:0px  solid black;
                }
    </style>

    <br>
    <table border="1" align="center">  
        <tr>
            <td  align="center" height="45" width="200"  style="font-size:35px; font-family:arial; font-weight:bold; background: #fff; color:#fff; " colspan="" >Customer</td>
            <td  align="center" width="220"  style="font-size:30px; font-family:arial; font-weight:bold; background: #fff; color:#fff; " colspan="" ></td>
            <td  align="center" width="220"  style="font-size:30px; font-family:arial; font-weight:bold; background: #fff; color:#fff;" colspan="">Pallet Quatity</td>    
            <td  align="center" width="220"  style="font-size:30px; font-family:arial; font-weight:bold; background: #fff; color:#fff;" colspan=""></td>
            <td  align="center" width="220"  style="font-size:30px; font-family:arial; font-weight:bold; background: #fff; color:#fff;" colspan="">Month</td>    
            <td  align="center" width="220"  style="font-size:30px; font-family:arial; font-weight:bold; background: #fff; color:#fff;" colspan="">Week</td>    
                
        </tr>

        <tr>
            <td align="center"  height="90"   valign="bottom" style="font-size:50px; font-family:arial; font-weight:bold;  " colspan="2"><b>' . $detalle->nombre . '</b></td>    
        
            
            <td align="center" width="250"  style="font-size:80px; font-family:arial; font-weight:bold;  " colspan=""><b>' . $detalle->cantidad . '</b></td>
                
            <td align="center" style="font-size:60px; font-family:arial; vertical-align: top;  font-weight:bold;  " colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;' . $mes . '&nbsp;' . $dia . '</td>
            
            <td align="center" style="font-size:90px; font-family:arial; font-weight:bold;  " colspan="" valign="bottom" >' . $semana . '</td>

        </tr>

        <tr>
            <td  align="center" width=""  height=""  style="font-size:30px; font-family:arial; font-weight:bold; background: #; color:#fff; "  rowspan="" ></td>
            <td  align="center" width=""style="font-size:30px; font-family:arial; font-weight:bold; background: #; color:#fff;" colspan=""></td>
            <td  align="center" width=""  style="font-size:30px; font-family:arial; font-weight:bold; background: #; color:#fff; "  rowspan="" ></td>
            <td  align="center" width=""style="font-size:30px; font-family:arial; font-weight:bold; background: #; color:#fff;" colspan=""></td>    
            <td  align="left" valign="top" style="font-size:35px; font-family:arial; font-weight:bold; background: #fff; color:#000;" colspan="2"> &nbsp; ' . $hora . ' </td>

        </tr>

        <tr>
            <td  align="center" width="" height="50"  style="font-size:30px; font-family:arial; font-weight:bold; background: #fff; color:#fff; "  colspan="3" >Part Number</td>
            <td  align="center" width=""style="font-size:30px; font-family:arial; font-weight:bold; background: #fff; color:#fff;" colspan="3">Model Name</td>        
        </tr>

        <tr>
        <td colspan="3" rowspan="2" align="center"  style="font-size:25px;  font-family:arial; font-weight:bold; overflow:auto; height:120px; "  >' . $detalle->numeroparte . ' <br><img src="' . $barcode . '" style="height:123px;" /> </td>
        <td height="60" colspan="3" align="center"  style="font-size:60px; font-family:arial; vertical-align: top;  font-weight:bold; overflow:auto;" > &nbsp; &nbsp; &nbsp;' . $detalle->modelo . '</td>

        </tr>

        <tr>
        <td align="" height="" style="font-size:25px; font-family:arial; font-weight:bold;  " >&nbsp;</td>
        <td align="center"  style="font-size:30px; font-family:arial; font-weight:bold; overflow:auto; background: #fff; color:#fff; " >Rev No.</td>
        <td align="center"  style="font-size:30px; font-family:arial; font-weight:bold; overflow:auto;background: #fff; color:#fff; "  >Pallet No.</td>
        </tr>

        <tr>
            <td  align="center" width=""  style="font-size:30px; font-family:arial; font-weight:bold; background: #fff; color:#fff; " colspan="" rowspan="2">ROHS</td>
            <td  align="center" height="70"width=""style="font-size:30px; font-family:arial; font-weight:bold; background: #fff; color:#fff;"    colspan="">Line No</td>    
            <td  align="center" width=""style="font-size:30px; font-family:arial; font-weight:bold; background: #fff; color:#fff;"    colspan="">Prod.</td>    
            <td  align="center" width=""style="font-size:30px; font-family:arial; font-weight:bold; background: #fff; color:#fff;"    colspan="">W/H</td>
            <td align="center" valign="bottom" style="font-size:50px; font-family:arial; vertical-align: ;font-weight:bold; padding-top:15px; " colspan="">' . $detalle->revision . '</td>
            <td align="center" valign="bottom" style="font-size:50px; font-family:arial; font-weight:bold; padding-top:15px; " colspan="">1</td>    
        </tr>
        <tr>
            <td  align="center" height="60" width=""style="font-size:50px; font-family:arial; font-weight:bold; background: #fff; color:#000;padding-top:15px;"    colspan="">' . $detalle->nombrelinea . '</td>    
            <td  align="center" width=""style="font-size:30px; font-family:arial; font-weight:bold; background: #fff; color:#000;"    colspan=""></td>    
            <td  align="center" width=""style="font-size:30px; font-family:arial; font-weight:bold; background: #fff; color:#000;"    colspan=""></td>
            <td align="center" style="font-size:30px; font-family:arial; font-weight:bold; background: #fff; color:#fff;"  colspan=""></td>
            <td align="center" style="font-size:30px; font-family:arial; font-weight:bold; background: #fff; color:#fff;"  colspan="">WOORI USA</td>    
        </tr>

    </table>
</page>
');
   $nombredelpdf = 'Packing' . date('Ymdgisv') . '.pdf';
        $ruta = APPPATH . 'pdfs\\' .$nombredelpdf;
        $mipdf->Output($ruta, 'F'); 
       //echo "C:\\\\wamp64\\\\www\\\\sisproduction\\\\application\\\\pdfs\\\\Packing2019081093609000.pdf";
        echo $nombredelpdf;  
        

        /*$nombrepdf = APPPATH . 'pdfs\\' . 'Packing' . date('Ymdgisv') . '.pdf';
        $mipdf->Output($nombrepdf, 'F');
        $cmd = "C:\\Program Files (x86)\\Adobe\\Acrobat Reader DC\\Reader\\AcroRd32.exe /t \"$nombrepdf\" \"Zebra 90XiIII Plus\"";
        echo $cmd;*/
    }
}

?>
