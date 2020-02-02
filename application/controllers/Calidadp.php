<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Calidadp extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!isset($_SESSION['user_id'])) {
            $this->session->set_flashdata('flash_data', 'You don\'t have access! ss');
            return redirect('login');
        }
        $this->load->helper('url');
        $this->load->model('almacen_model', 'almacen');
        $this->load->model('linea_model', 'linea');
        $this->load->model('transferencia_model', 'transferencia');
        $this->load->model('revision_model', 'revision');
        $this->load->model('modelo_model', 'modelo');
        $this->load->model('calidadp_model', 'calidadp');
        $this->load->model('calidad_model', 'calidad');
        $this->load->model('user_model', 'usuario');
        $this->load->model('palletcajasproceso_model', 'palletcajasproceso');
        $this->load->library('permission');
    }

    public function index() {
        Permission::grant(uri_string());
        $query = $this->calidadp->showAll();
        $data = array(
            'datatransferencia' => $query
        );

        $this->load->view('header');
        $this->load->view('calidadp/index', $data);
        $this->load->view('footer');
    }

    public function detalle($idtransferencia, $folio) {
        //Permission::grant(uri_string()); 
        $motivosrechazo = $this->calidad->motivosRechazo();
        $datatransferencia = $this->transferencia->listaNumeroParteTransferencia($idtransferencia);
        $data = array(
            'id' => $idtransferencia,
            'folio' => $folio,
            'datatransferencia' => $datatransferencia,
            'motivosrechazo' => $motivosrechazo);
        $this->load->view('header');
        $this->load->view('calidadp/detalle', $data);
        $this->load->view('footer');
    }

    public function rechazopallet() {
        //Permission::grant(uri_string()); 
        $idpalletcajas = $this->input->post('idpalletcajas');
        $data = $this->calidadp->motivosrechazo($idpalletcajas);
        echo json_encode($data);
    }

    public function rechazopalletacalidad() {
        //Permission::grant(uri_string()); 
        $idpalletcajas = $this->input->post('idpalletcajas');
        $data = $this->calidadp->motivosrechazoacalidad($idpalletcajas);
        echo json_encode($data);
    }

    public function generarPDFEnvio($id) {
        //Permission::grant(uri_string());
        $this->load->library('tcpdf');
        $listapartes = $this->calidadp->palletReporte($id);
        $totalpallet = 0;
        $totalcajas = 0;
        $hora = date("h:i:s a");
        if ($listapartes != false) {

            foreach ($listapartes as $value) {
                $totalpallet = $totalpallet + $value->totalpallet;
                $totalcajas = $totalcajas + $value->totalcajas;
            }
        }

 $produccion="";
        $datav = $this->calidadp->validarExistenciaRetorno($id);
        if ($datav == FALSE) {
            # code...
            $produccion = "PRODUCCIÓN";
        } else {
            # code...
            $produccion = "RETORNO";
        }
        $detalle = $this->calidadp->detalleTransferencia($id);
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
    <td width="82" align="center" style="border-top:solid 1px #000000; font-size:20px; font-weight:bolder; border-right:solid #000 1px">' . $detalle->folio . '</td>
  </tr>
  <tr>
    <td class="textgeneral lineabajo">FECHA: ' . $fechaactual . '</td>
    <td>&nbsp;</td>
      <td colspan="3" align="center" class="textgeneral" style="border-top:solid 1px #000; border-right:solid 1px #000; border-left:solid 1px #000; border-bottom:solid 1px #000;">'.$produccion.'</td>
  </tr>
  <tr>
    <td class="textgeneral lineabajo">HORA: ' . $hora . '</td>
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
    <td width="120" align="center" valign="middle"  style="border-top:solid 1px #000000; border-bottom:solid 1px #000000; border-right:solid 1px #000000;">NUM. PARTE</td>
     <td width="50" align="center" valign="middle"  style="border-top:solid 1px #000000; border-bottom:solid 1px #000000; border-right:solid 1px #000000;">VERSIÓN</td>
    <td width="52" align="center" valign="middle" style="border-top:solid 1px #000000; border-bottom:solid 1px #000000; border-right:solid 1px #000000;">MODELO</td>
    <td width="66" align="center" valign="middle" style="border-top:solid 1px #000000; border-bottom:solid 1px #000000; border-right:solid 1px #000000;">CANTIDAD POR PALLET</td>
    <td width="60" align="center" valign="middle" style="border-top:solid 1px #000000; border-bottom:solid 1px #000000; border-right:solid 1px #000000;">TOTAL DE PALLET</td>
    <td width="60" align="center" valign="middle" style="border-top:solid 1px #000000; border-bottom:solid 1px #000000; border-right:solid 1px #000000;">CANTIDAD TOTAL</td>
    <td width="70" align="center" valign="middle" style="border-top:solid 1px #000000; border-bottom:solid 1px #000000; border-right:solid 1px #000000;">ALMACEN VERIFICACIÓN</td>
  </tr>
  ';
        foreach ($listapartes as $value) {
            $tbl .= '<tr>
    <td style="border-left:solid 1px
    #000000; border-bottom:solid 1px #000; font-size:8px; border-right:solid 1px #000;">&nbsp;' . $value->nombrecliente . '</td>
    <td style="border-bottom:solid 1px #000; font-size:8px;  border-right:solid 1px #000;">&nbsp;' . $value->numeroparte . '</td>
    <td style="border-bottom:solid 1px #000; font-size:8px;  border-right:solid 1px #000;">&nbsp;' . $value->descripcionrevision . '</td>
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
    <td colspan="3" align="right" class="textfooter" >WBKP-PR-FO-007</td>
  </tr>
 <tr>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td>&nbsp; </td>
    <td >&nbsp;</td>
    <td colspan="3" align="right" class="textfooter" >Rev. 01</td>
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
    <td colspan="2" class="textfooter" style="border-bottom:solid 1px #000; border-top:solid 1px #000; border-left:solid 1px #000; border-right:solid 1px #000; padding-left:5px;" >&nbsp;&nbsp;2DA INSPECCIÓN EXTERNA</td>
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

    public function etiquetaCalidad($idpalletcajas) { 
       //Permission::grant(uri_string());
       $detalle = $this->transferencia->detalleDelDetallaParte($idpalletcajas);
 
       $idtransferencia= $detalle->idtransferancia;
       $idcajas = $detalle->idcajas;
        $datausuario = $this->usuario->detalleUsuario($this->session->user_id);
        $totalpallet = 0;
        if($this->transferencia->totalpallet($idtransferencia,$idcajas) != false){
           $det =$this->transferencia->totalpallet($idtransferencia,$idcajas);
            $totalpallet=$det->total;
        }
        $hora = date("h:i:s a");
        $fecha = date("d-M-Y");
        $semana = date("W");
        $mes = date("F");
        $this->load->library('html2pdf');
        ob_start();
        error_reporting(E_ALL & ~E_NOTICE);
        ini_set('display_errors', 0);
        ini_set('log_errors', 1);

        $mipdf = new HTML2PDF('L', 'Letter', 'es', 'true', 'UTF-8');
        $mipdf->pdf->SetDisplayMode('fullpage');
        $mipdf->writeHTML('<page  format="130x182" >
    <style type="text/css">
			table {border-collapse:collapse}
			td 
				{
					border:0px solid black
				}
	</style>
	<br>
    <table border="1" align="center">
		<tr>
			<td   width="320" height="75" style="font-size:40px; font-family:arial; font-weight:bold; background: #; color:#fff; " rowspan="2" >OQC Passed</td>
			<td  width="315" align="center" style="font-size:20px; font-family:arial; font-weight:bold; background: ; color:#fff;  " >CUSTOMERS</td>
		</tr>
		
		<tr>
		
			<td  align="center"    style="font-size:50px; font-family:arial; font-weight:bold; background: #; " >' . $detalle->nombre . '</td>
		</tr>
		<tr>
			<td  align="" height="60px" style="font-size:60px; font-family:arial; font-weight:bold; background: #; color:#fff;" >PART NO</td>
			<td  align="" style="font-size:20px; font-family:arial; font-weight:bold; background: #; color:#fff;" >QUANTITY</td>
		</tr>
		<tr>
			<td  align="center" height="50px" style="font-size:30px; font-family:arial; font-weight:bold; background: #; " >' . $detalle->numeroparte . '</td>
			<td  align="center" style="font-size:50px; font-family:arial; font-weight:bold; background: #; " >' . $detalle->cantidad . '</td>
		</tr>
		<tr>
			<td  align="" height="50" style="font-size:20px; font-family:arial; font-weight:bold; background: #;color:#fff; " >MODEL</td>
			<td  align="" style="font-size:20px; font-family:arial; font-weight:bold; background: #;color:#fff; " >DATE</td>
		</tr>
		<tr>
			<td  align="center" height="40" style="font-size:40px; font-family:arial; font-weight:bold; background: #; " >' . $detalle->modelo . '</td>
			<td  align="center" style="font-size:35px; font-family:arial; font-weight:bold; background: #; " >' . $fecha . '</td>
		</tr>
		<tr>
			<td  align="" height="50" style="font-size:20px; font-family:arial; font-weight:bold; background: #; color:#fff; " >OQC INSPECTOR</td>
			<td  align="center" style="font-size:25px; font-family:arial; font-weight:bold; background: #; " ></td>
		</tr>
		<tr>
			<td  align="center" height="60" style="font-size:50px; font-family:arial; font-weight:bold; background: #;vertical-align:bottom; " >' . $datausuario->usuario . '</td>
			<td  align="center" style="font-size:30px; font-family:arial; font-weight:bold; background: #; " ></td>
		</tr>
		
		

	</table>

</page>');

        //$mipdf->pdf->IncludeJS('print(TRUE)');
        $mipdf->Output(APPPATH . 'pdfs\\' . 'Calidad' . date('Ymdgisv') . '.pdf', 'F');
        $mipdf->Output('Etiqueta_Calidad.pdf');
    }

    public function imprimirEtiquetaCalidad() {
        //Permission::grant(uri_string());
        $idpalletcajas = $this->input->post('idpalletcajas');
        $detalle = $this->transferencia->detalleDelDetallaParte($idpalletcajas);
        $datausuario = $this->usuario->detalleUsuario($this->session->user_id);

        $hora = date("h:i:s a");
        $fecha = date("d-M-Y");
        $semana = date("W");
        $mes = date("F");
        $this->load->library('html2pdf');
        ob_start();
        error_reporting(E_ALL & ~E_NOTICE);
        ini_set('display_errors', 0);
        ini_set('log_errors', 1);

        $mipdf = new HTML2PDF('L', 'Letter', 'es', 'true', 'UTF-8');
        $mipdf->pdf->SetDisplayMode('fullpage');
        $mipdf->writeHTML('<page  format="130x182" >
    <style type="text/css">
			table {border-collapse:collapse}
			td 
				{
					border:0px solid black
				}
	</style>
	<br>
    <table border="1" align="center">
		<tr>
			<td   width="320" height="75" style="font-size:40px; font-family:arial; font-weight:bold; background: #; color:#fff; " rowspan="2" >OQC Passed</td>
			<td  width="315" align="center" style="font-size:20px; font-family:arial; font-weight:bold; background: ; color:#fff;  " >CUSTOMERS</td>
		</tr>
		
		<tr>
		
			<td  align="center"    style="font-size:50px; font-family:arial; font-weight:bold; background: #; " >' . $detalle->nombre . '</td>
		</tr>
		<tr>
			<td  align="" height="60px" style="font-size:60px; font-family:arial; font-weight:bold; background: #; color:#fff;" >PART NO</td>
			<td  align="" style="font-size:20px; font-family:arial; font-weight:bold; background: #; color:#fff;" >QUANTITY</td>
		</tr>
		<tr>
			<td  align="center" height="50px" style="font-size:30px; font-family:arial; font-weight:bold; background: #; " >' . $detalle->numeroparte . '</td>
			<td  align="center" style="font-size:50px; font-family:arial; font-weight:bold; background: #; " >' . $cajas . '</td>
		</tr>
		<tr>
			<td  align="" height="50" style="font-size:20px; font-family:arial; font-weight:bold; background: #;color:#fff; " >MODEL</td>
			<td  align="" style="font-size:20px; font-family:arial; font-weight:bold; background: #;color:#fff; " >DATE</td>
		</tr>
		<tr>
			<td  align="center" height="40" style="font-size:40px; font-family:arial; font-weight:bold; background: #; " >' . $detalle->modelo . '</td>
			<td  align="center" style="font-size:35px; font-family:arial; font-weight:bold; background: #; " >' . $fecha . '</td>
		</tr>
		<tr>
			<td  align="" height="50" style="font-size:20px; font-family:arial; font-weight:bold; background: #; color:#fff; " >OQC INSPECTOR</td>
			<td  align="center" style="font-size:25px; font-family:arial; font-weight:bold; background: #; " ></td>
		</tr>
		<tr>
			<td  align="center" height="60" style="font-size:50px; font-family:arial; font-weight:bold; background: #;vertical-align:bottom; " >' . $datausuario->usuario . '</td>
			<td  align="center" style="font-size:30px; font-family:arial; font-weight:bold; background: #; " ></td>
		</tr>
		
		

	</table>

</page>');

      /*  //$mipdf->pdf->IncludeJS('print(TRUE)');
    $nombrepdf = APPPATH . 'pdfs\\' . 'Calidad' . date('Ymdgisv') . '.pdf';
       $mipdf->Output($nombrepdf, 'F');
        $cmd = "C:\\Program Files (x86)\\Adobe\\Acrobat Reader DC\\Reader\\AcroRd32.exe /t \"$nombrepdf\" \"Zebra ZT230\"";
        echo $cmd;*/

           $nombredelpdf = 'Calidad' . date('Ymdgisv') . '.pdf';
        $ruta = APPPATH . 'pdfs\\' .$nombredelpdf;
        $mipdf->Output($ruta, 'F');  
        echo $nombredelpdf;  
    }

}

?>
