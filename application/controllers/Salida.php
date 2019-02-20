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
    }

    public function index() {
        Permission::grant(uri_string());
        $this->load->view('header');
        $this->load->view('salida/index');
        $this->load->view('footer');
    }

    public function showAll() {
        Permission::grant(uri_string());
        $query = $this->salida->showAllSalidas();
        if ($query) {
            $result['salidas'] = $this->salida->showAllSalidas();
        }
        echo json_encode($result);

        // code...
    }

    public function showAllParte() {
        Permission::grant(uri_string());
        $query = $this->salida->showPartesBodega();
        if ($query) {
            $result['partes'] = $this->salida->showPartesBodega();
        }
        echo json_encode($result);

        // code...
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
        Permission::grant(uri_string());
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

    public function detalleSalida($idsalida) {
        // code...
        Permission::grant(uri_string());
        $datadetallesalida = $this->salida->detalleSalida($idsalida);
        $datadetalleorden = $this->salida->detallesDeOrden($idsalida);
        $data = array(
            'detallesalida' => $datadetallesalida,
            'detalleorden' => $datadetalleorden,
            'idsalida' => $idsalida);
        $this->load->view('header');
        $this->load->view('salida/detalle', $data);
        $this->load->view('footer');
    }

    public function validaranumeroparte() {
        Permission::grant(uri_string());
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

    function eliminarParteOrden($idordensalida, $idsalida) {
Permission::grant(uri_string());
        $this->salida->eliminarParteOrden($idordensalida);
        redirect('/salida/detalleSalida/' . $idsalida);
    }

    public function terminarOrdenSalida() {
        // code...
        Permission::grant(uri_string());
        $idsalida = $this->input->post('idsalida');
        $dataupdate = array(
            'finalizado' => 1,
            'idusuario' => $this->session->user_id,
            'fecharegistro' => date('Y-m-d H:i:s'));
        $this->salida->updateSalida($idsalida, $dataupdate);
        redirect('/salida/detalleSalida/' . $idsalida);
    }

    public function searchPartes() {
        Permission::grant(uri_string());
        $value = $this->input->post('text');
        $query = $this->salida->searchPartes($value);
        if ($query) {
            $result['partes'] = $query;
        }

        echo json_encode($result);
    }

    function agregarParteOrdenDetallado($iddetalleparte, $idsalida) {
Permission::grant(uri_string());
        $datadetallesalida = $this->salida->detalleSalida($idsalida);
        $datadetalleorden = $this->salida->detallesDeOrden($idsalida);
        $datadetalleparte = $this->salida->showPartesDetalle($iddetalleparte);

        $data = array(
            'detallesalida' => $datadetallesalida,
            'detalleorden' => $datadetalleorden,
            'idsalida' => $idsalida,
            'detalleparte' => $datadetalleparte);
        $this->load->view('header');
        $this->load->view('salida/detalle', $data);
        $this->load->view('footer');
    }

    public function agregarParteOrden() {

Permission::grant(uri_string());
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

    public function generarPDFOrden($idsalida) {
        Permission::grant(uri_string());
        $this->load->library('tcpdf'); 
        $detalle= $this->salida->detalleSalidaOrden($idsalida); 
        $lista= $this->salida->partesIncluidasOrden($idsalida); 
        var_dump($lista);
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
    <td width="310" colspan="3" rowspan="4" align="center" class="borde-l borde-r borde-b" style="font-size:11px">CALLE RUBULIDA NO 33 PARQUE INDUSTRIAL PALACO MEXICALI</td>
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
    <td width="130" class="bordes">&nbsp;</td>
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
    
    $sumapallet = 0;
    $sumatotal= 0;
    $sumaparcial = 0;
    foreach($lista as $det){
    
     // $sumacajas+=$det->caja * $det->pallet;
      $sumapallet+=$det->pallet;
     
      $html.='<tr>
      <td width="130" align="center" style="font-size:9px">&nbsp;'.$det->numeroparte.'&nbsp;</td>
      <td width="180" colspan="2" align="center" style="font-size:9px">&nbsp;'.$det->modelo.'&nbsp;</td>';
     if($det->pallet > 0){ 
      $html.='<td width="45" align="right" style="font-size:9px">&nbsp;'.number_format($det->pallet).'&nbsp;&nbsp;</td>';
     }else{
      $html.='<td width="45" align="right" style="font-size:9px"> </td>';
     }
     if($det->pallet > 0){ 
      $html.='<td width="45" align="right" style="font-size:9px">&nbsp;'.number_format($det->caja).'&nbsp;&nbsp;</td>';
    }else{
      $html.='<td width="45" align="right" style="font-size:9px"></td>';
     }
     if($det->pallet == 0){ 
      $html.='<td width="45" align="right" style="font-size:9px">0&nbsp;&nbsp;</td>';
    }else{
      $html.='<td width="45" align="right" style="font-size:9px"></td>';
    }
      if($det->pallet == 0){ 
      $html.='<td width="45" align="right" style="font-size:9px">'.number_format($det->caja).'&nbsp;&nbsp;</td>';
      }else{
        $html.='<td width="45" align="right" style="font-size:9px"></td>';
      }
      if($det->pallet == 0){
        $sumatotal+=$det->caja;
        $html.='<td width="45" align="right" style="font-size:9px">'.number_format($det->caja).'&nbsp;&nbsp;</td>';
      }else{
         $sumatotal+=$det->caja * $det->pallet;
        $html.='<td width="45" align="right" style="font-size:9px">'.number_format($det->caja * $det->pallet).'&nbsp;&nbsp;</td>';
      }
      
        $html.='<td width="45" style="font-size:9px">&nbsp;</td>
      <td width="45" style="font-size:9px">&nbsp;</td>
      <td width="160" style="font-size:9px">&nbsp;</td>
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
    <td width="45" align="right" style="font-size:9px">'.number_format($sumatotal).'&nbsp;&nbsp;</td>
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
    <td width="565" colspan="9">&nbsp;</td>
    
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
