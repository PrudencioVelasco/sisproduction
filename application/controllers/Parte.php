<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Parte extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        if (!isset($_SESSION['user_id'])) {
            $this->session->set_flashdata('flash_data', 'You don\'t have access! ss');
            return redirect('login');
        }
        $this->load->helper('url');
        $this->load->model('data_model');
        $this->load->model('parte_model', 'parte');
        $this->load->model('user_model', 'usuario');
        $this->load->library('permission');
         
         
    }

    public function index()
    {
        // Permission::grant(uri_string());
        $this->load->view('header');
        $this->load->view('parte/index');
        $this->load->view('footer');
    }
    
   
    public function etiquetaPacking($id) {
        $detalle = $this->parte->detalleDelDetallaParte($id);
        $hora   = date("h:i a");
        $fecha  = date("j/n/Y");
        $dia    = date("j");
        $semana = date("W");
        $mes    = date("F");
        $this->load->library('html2pdf');
        ob_start();
        error_reporting(E_ALL & ~E_NOTICE);
        ini_set('display_errors', 0);
        ini_set('log_errors', 1); 
       
       $mipdf = new HTML2PDF('L', 'Letter', 'es', 'true', 'UTF-8');
        $mipdf->pdf->SetDisplayMode('fullpage');
        $mipdf->writeHTML('<page  format="400x165"  >
    <style type="text/css">
            table {border-collapse:collapse}
            td 
                {
                    border:0px  solid black
                }
    </style>
    <br>
    <table border="0" align="center">  
        <tr>
            <td  align="center" height="45" width="200"  style="font-size:35px; font-family:arial; font-weight:bold; background: #fff; color:#fff; " colspan="" >Customer</td>
            <td  align="center" width="220"  style="font-size:30px; font-family:arial; font-weight:bold; background: #fff; color:#fff; " colspan="" ></td>
            <td  align="center" width="220"  style="font-size:30px; font-family:arial; font-weight:bold; background: #fff; color:#fff;" colspan="">Pallet Quatity</td>    
            <td  align="center" width="220"  style="font-size:30px; font-family:arial; font-weight:bold; background: #fff; color:#fff;" colspan=""></td>
            <td  align="center" width="220"  style="font-size:30px; font-family:arial; font-weight:bold; background: #fff; color:#fff;" colspan="">Month</td>    
            <td  align="center" width="220"  style="font-size:30px; font-family:arial; font-weight:bold; background: #fff; color:#fff;" colspan="">Week</td>    
                
        </tr>

        <tr>
            <td align="center"  height="90"   valign="bottom" style="font-size:85px; font-family:arial; font-weight:bold;  " colspan="2"><b>'.$detalle->nombre.'</b></td>    
        
            
            <td align="center"  style="font-size:90px; font-family:arial; font-weight:bold;  " colspan=""><b> &nbsp; &nbsp; &nbsp;'.$detalle->cantidad.'</b></td>
                
            <td align="center" style="font-size:60px; font-family:arial; vertical-align: top;  font-weight:bold;  " colspan="2">&nbsp;&nbsp;&nbsp;' . $mes . '&nbsp;' . $dia . '  </td>
            
            <td align="center" style="font-size:90px; font-family:arial; font-weight:bold;  " colspan="" valign="bottom" >'.$semana.'</td>

        </tr>

        <tr>
            <td  align="center" width=""  height=""  style="font-size:30px; font-family:arial; font-weight:bold; background: #; color:#fff; "  rowspan="" ></td>
            <td  align="center" width=""style="font-size:30px; font-family:arial; font-weight:bold; background: #; color:#fff;" colspan=""></td>
            <td  align="center" width=""  style="font-size:30px; font-family:arial; font-weight:bold; background: #; color:#fff; "  rowspan="" ></td>
            <td  align="center" width=""style="font-size:30px; font-family:arial; font-weight:bold; background: #; color:#fff;" colspan=""></td>    
            <td  align="left" valign="top" style="font-size:35px; font-family:arial; font-weight:bold; background: #fff; color:#000; padding-top:-30px;" colspan="2"> &nbsp; '.$hora.'</td>

        </tr>

        <tr>
            <td  align="center" width="" height="50"  style="font-size:30px; font-family:arial; font-weight:bold; background: #fff; color:#fff; "  colspan="3" >Part Number</td>
            <td  align="center" width=""style="font-size:30px; font-family:arial; font-weight:bold; background: #fff; color:#fff;" colspan="3">Model Name</td>        
        </tr>

        <tr>
        <td align="center" height="60"  style="font-size:60px; vertical-align: top;  font-family:arial; font-weight:bold; overflow:auto;" colspan="3" >'.$detalle->numeroparte.'</td>
        <td align="center"  style="font-size:60px; font-family:arial; vertical-align: top;  font-weight:bold; overflow:auto;" colspan="3" > &nbsp; &nbsp; &nbsp;'.$detalle->modelo.'</td>

        </tr>

        <tr>
        <td align="" height="" style="font-size:25px; font-family:arial; font-weight:bold;  "  colspan="4" >
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2<br>
            <label align="center" > &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2</label>
        </td>
        <td align="center"  style="font-size:30px; font-family:arial; font-weight:bold; overflow:auto; background: #fff; color:#fff; " >Rev No.</td>
        <td align="center"  style="font-size:30px; font-family:arial; font-weight:bold; overflow:auto;background: #fff; color:#fff; "  >Pallet No.</td>
        </tr>

        <tr>
            <td  align="center" width=""  style="font-size:30px; font-family:arial; font-weight:bold; background: #fff; color:#fff; " colspan="" rowspan="2">ROHS</td>
            <td  align="center" height="70"width=""style="font-size:30px; font-family:arial; font-weight:bold; background: #fff; color:#fff;"    colspan="">Line No</td>    
            <td  align="center" width=""style="font-size:30px; font-family:arial; font-weight:bold; background: #fff; color:#fff;"    colspan="">Prod.</td>    
            <td  align="center" width=""style="font-size:30px; font-family:arial; font-weight:bold; background: #fff; color:#fff;"    colspan="">W/H</td>
            <td align="left" valign="bottom" style="font-size:50px; font-family:arial; vertical-align: ;font-weight:bold;  " colspan="">'.$detalle->revision.'</td>
            <td align="center" valign="bottom" style="font-size:50px; font-family:arial; font-weight:bold;  " colspan="">'.$detalle->pallet.'</td>    
        </tr>
        <tr>
            <td  align="right" height="60" width=""style="font-size:50px; font-family:arial; font-weight:bold; background: #fff; color:#000;"    colspan="">'.$detalle->linea.'</td>    
            <td  align="center" width=""style="font-size:30px; font-family:arial; font-weight:bold; background: #fff; color:#000;"    colspan=""></td>    
            <td  align="center" width=""style="font-size:30px; font-family:arial; font-weight:bold; background: #fff; color:#000;"    colspan=""></td>
            <td align="center" style="font-size:30px; font-family:arial; font-weight:bold; background: #fff; color:#fff;"  colspan=""></td>
            <td align="center" style="font-size:30px; font-family:arial; font-weight:bold; background: #fff; color:#fff;"  colspan="">WOORI USA</td>    
        </tr>

    </table>

</page>
');

        //$mipdf->pdf->IncludeJS('print(TRUE)');
        $mipdf->Output('Etiqueta_Packing.pdf');
    }

    public function generarPDFEnvio($id) {
         $this->load->library('tcpdf');
        $detalle = $this->parte->detalleDelDetallaParte($id);
        $operador = $detalle->nombreoperador;
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
    <td colspan="3" class="textgeneral lineabajo">RECIBIDA POR: ' . $operador . '</td>
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
  <tr>
    <td style="border-left:solid 1px
    #000000; border-bottom:solid 1px #000; border-right:solid 1px #000; font-size:9px;">&nbsp;' . $detalle->nombre . '</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;font-size:9px;">&nbsp;' . $detalle->numeroparte . '</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;font-size:9px;">&nbsp;' . $detalle->modelo . '</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;font-size:9px;">&nbsp;' . $detalle->cantidad . '</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;font-size:9px;">&nbsp;' . $detalle->pallet . '</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;font-size:9px;">&nbsp;' . ($detalle->cantidad * $detalle->pallet) . '</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;font-size:9px;">&nbsp;</td>
  </tr>

    <tr>
    <td style="border-left:solid 1px
    #000000; border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
  </tr>
    <tr>
    <td style="border-left:solid 1px
    #000000; border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
  </tr>
    <tr>
    <td style="border-left:solid 1px
    #000000; border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
  </tr>
    <tr>
    <td style="border-left:solid 1px
    #000000; border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
  </tr>
    <tr>
    <td style="border-left:solid 1px
    #000000; border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
  </tr>
  <tr>
    <td style="border-left:solid 1px
    #000000; border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
  </tr>
    <tr>
    <td style="border-left:solid 1px
    #000000; border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
  </tr>
    <tr>
    <td style="border-left:solid 1px
    #000000; border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
  </tr>
    <tr>
    <td style="border-left:solid 1px
    #000000; border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
  </tr>
    <tr>
    <td style="border-left:solid 1px
    #000000; border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
  </tr>
    <tr>
    <td style="border-left:solid 1px
    #000000; border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
  </tr>
    <tr>
    <td style="border-left:solid 1px
    #000000; border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
  </tr>
    <tr>
    <td style="border-left:solid 1px
    #000000; border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
  </tr>
    <tr>
    <td style="border-left:solid 1px
    #000000; border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
  </tr>
    <tr>
    <td style="border-left:solid 1px
    #000000; border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
  </tr>
    <tr>
    <td style="border-left:solid 1px
    #000000; border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
  </tr>
      <tr>
    <td style="border-left:solid 1px
    #000000; border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
  </tr>
    <tr>
    <td style="border-left:solid 1px
    #000000; border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
  </tr>
    <tr>
    <td style="border-left:solid 1px
    #000000; border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
  </tr>

    <tr>
    <td style="border-left:solid 1px
    #000000; border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
  </tr>
    <tr>
    <td style="border-left:solid 1px
    #000000; border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
  </tr>
    <tr>
    <td style="border-left:solid 1px
    #000000; border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
  </tr>
    <tr style=" background-color:#EAEAEA">
    <td style=" border-left:solid 1px
    #000000; border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;">&nbsp;</td>
    <td class="textfooter" style="border-bottom:solid 1px #000; border-right:solid 1px #000;">TOTAL:</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000; font-size:9px; margin-top:20px;">&nbsp;' . $detalle->pallet . ' </td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000; font-size:9px;">&nbsp;' . ($detalle->pallet * $detalle->cantidad) . '</td>
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

    public function packing($id)
    {
        $usuarioscalidad=$this->usuario->showAllCalidad();
        $detalleparte= $this->parte->detalleParteId($id);

        $data=array(
            'usuarioscalidad'=>$usuarioscalidad,
            'detalleparte'=>$detalleparte,
            'idparte'=>$id
        );

        $this->load->view('header');
        $this->load->view('parte/packing',$data);
        $this->load->view('footer');
    }

    public function detalleenvio($iddetalle)
    {
        //$usuarioscalidad=$this->usuario->showAllCalidad();
        //$detalleparte= $this->parte->detalleParteId($id);
        $usuarioscalidad=$this->usuario->showAllCalidad();
        $detalledeldetalleparte=$this->parte->detalleDelDetallaParte($iddetalle);
        $dataerror = array();
        if($detalledeldetalleparte->idestatus == 3){
            $dataerror=$this->parte->motivosCancelacionCalidad($iddetalle);
        }

        $data=array(
            'iddetalle'=>$iddetalle,
            'detalle'=>$detalledeldetalleparte,
            'usuarioscalidad'=>$usuarioscalidad,
            'dataerrores'=>$dataerror
        );

        //var_dump($detalledeldetalleparte);
        $this->load->view('header');
        $this->load->view('parte/detalleenviado',$data);
        $this->load->view('footer');
    }

    public function reenviarCalidad()
    {
        // code...
        $config = array(
          array(
                'field'   => 'modelo',
                'label'   => 'Modelo',
                'rules'   => 'required',
                'errors' => array(
                   'required' => 'Campo requerido.',
           )
             ),
          array(
                'field'   => 'revision',
                'label'   => 'Revision',
                'rules'   => 'required',
                'errors' => array(
                   'required' => 'Campo requerido.',
           )
             ),
          array(
                'field'   => 'numeropallet',
                'label'   => 'Número de pallet',
                'rules'   => 'required|integer',
                'errors' => array(
                   'required' => 'Campo requerido.',
                   'integer'=>'Solo numero'
           )
             ),
          array(
                'field'   => 'cantidadcaja',
                'label'   => 'Cantidad Caja',
                'rules'   => 'required|integer',
                'errors' => array(
                   'required' => 'Cantidad requerido.',
                   'integer' => 'Solo numero.'
           )
             )
             ,
          array(
                'field'   => 'linea',
                'label'   => 'Linea',
                'rules'   => 'required',
                'errors' => array(
                   'required' => 'Campo requerido.'
           )
             )
             ,
          array(
                'field'   => 'usuariocalidad',
                'label'   => 'Usuario de calidad',
                'rules'   => 'required',
                'errors' => array(
                   'required' => 'Campo requerido.'
           )
             )
       );

       $iddetalleparte=$this->input->post('iddetalleparte');
       $this->form_validation->set_rules($config);

       if ($this->form_validation->run() == TRUE)
       {
           $data = array(
               'modelo' => $this->input->post('modelo'),
               'revision' => $this->input->post('revision'),
               'pallet' => $this->input->post('numeropallet'),
               'cantidad' => $this->input->post('cantidadcaja'),
               'linea' => $this->input->post('linea'),
               'idestatus' => 1,
               'idoperador' => $this->input->post('usuariocalidad'),
               'idusuario' => $this->session->user_id,
               'fecharegistro' => date('Y-m-d H:i:s')
            );

            $this->parte->updateDetalleParte($iddetalleparte,$data);

            $datastatus = array(
                'iddetalleparte' => $iddetalleparte,
                'idstatus' => 1,
                'idoperador' => $this->input->post('usuariocalidad'),
                'idusuario' => $this->session->user_id,
                'fecharegistro' => date('Y-m-d H:i:s')
            );

            $this->parte->addDetalleEstatusParte($datastatus);
            redirect('parte/');
        } else {
            // code...
            $usuarioscalidad=$this->usuario->showAllCalidad();
            $detalledeldetalleparte=$this->parte->detalleDelDetallaParte($iddetalleparte);

            $dataerror = array();

            if($detalledeldetalleparte->idestatus == 6){
                $dataerror=$this->parte->motivosCancelacionCalidad($iddetalleparte);
            }

            $data = array(
                'iddetalle'=>$iddetalleparte,
                'detalle'=>$detalledeldetalleparte,
                'usuarioscalidad'=>$usuarioscalidad,
                'dataerrores'=>$dataerror
            );
            //var_dump($detalledeldetalleparte);
            $this->load->view('header');
            $this->load->view('parte/detalleenviado',$data);
            $this->load->view('footer');
        }
    }

    public function enviarCalidad()
    {
        $config = array(
            array(
                'field'   => 'modelo',
                'label'   => 'Modelo',
                'rules'   => 'required',
                'errors' => array(
                    'required' => 'Campo requerido.',
                    )
                ),
            array(
                'field'   => 'revision',
                'label'   => 'Revision',
                'rules'   => 'required',
                'errors' => array(
                    'required' => 'Campo requerido.',
                    )
                ),
            array(
                'field'   => 'numeropallet',
                'label'   => 'Número de pallet',
                'rules'   => 'required|integer',
                'errors' => array(
                    'required' => 'Campo requerido.',
                    'integer'=>'Solo numero'
                    )
                ),
            array(
                'field'   => 'cantidadcaja',
                'label'   => 'Cantidad Caja',
                'rules'   => 'required|integer',
                'errors' => array(
                    'required' => 'Cantidad requerido.',
                    'integer' => 'Solo numero.'
                    )
                ),
            array(
                'field'   => 'linea',
                'label'   => 'Linea',
                'rules'   => 'required',
                'errors' => array(
                    'required' => 'Campo requerido.'
                    )
                ),
            array(
                'field'   => 'usuariocalidad',
                'label'   => 'Usuario de calidad',
                'rules'   => 'required',
                'errors' => array(
                    'required' => 'Campo requerido.'
                    )
                )
            );
            $this->form_validation->set_rules($config);
            if ($this->form_validation->run() == TRUE) {
                $data = array(
                    'folio'=>0,
                    'idparte' => $this->input->post('idparte'),
                    'modelo' => $this->input->post('modelo'),
                    'revision' => $this->input->post('revision'),
                    'pallet' => $this->input->post('numeropallet'),
                    'cantidad' => $this->input->post('cantidadcaja'),
                    'linea' => $this->input->post('linea'),
                    'idestatus' => 1,
                    'idoperador' => $this->input->post('usuariocalidad'),
                    'idusuario' => $this->session->user_id,
                    'fecharegistro' => date('Y-m-d H:i:s')
                );

                $iddetalleparte = $this->parte->addDetalleParte($data);
                $dataupdatefolio=array(
                    'folio'=>$iddetalleparte
                );
                $this->parte->updateDetalleParte($iddetalleparte,$dataupdatefolio);
                $datastatus = array(
                    'iddetalleparte' => $iddetalleparte,
                    'idstatus' => 1,
                    'idoperador' => $this->input->post('usuariocalidad'),
                    'idusuario' => $this->session->user_id,
                    'fecharegistro' => date('Y-m-d H:i:s')
                );
                $this->parte->addDetalleEstatusParte($datastatus);
                redirect('parte/');
            } else {
                $id = $this->input->post('idparte');
                $usuarioscalidad = $this->usuario->showAllCalidad();
                $detalleparte = $this->parte->detalleParteId($id);
                $data = array(
                    'usuarioscalidad' => $usuarioscalidad,
                    'detalleparte' => $detalleparte,
                    'idparte' => $id
                );

                $this->load->view('header');
                $this->load->view('parte/packing',$data);
                $this->load->view('footer');
            }
    }

    public function verEnviados()
    {
        $this->load->view('header');
        $this->load->view('parte/enviados');
        $this->load->view('footer');
    }

    public function showAll()
    {
        //Permission::grant(uri_string());
        $query = $this->parte->showAll();
        if ($query) {
            $result['partes'] = $this->parte->showAll();
        }
        echo json_encode($result);
    }

    public function showAllEnviados()
    {
        //Permission::grant(uri_string());
        $query = $this->parte->showAllEnviados($this->session->user_id);
        if ($query) {
            $result['detallestatus'] = $this->parte->showAllEnviados($this->session->user_id);
        }
        echo json_encode($result);
    }


    public function addPart()
    {
        //Permission::grant(uri_string());
        $config = array(
            array(
                'field' => 'numeroparte',
                'label' => 'Número de parte',
                'rules' => 'trim|required',
                'errors' => array(
                    'required' => 'Campo obligatorio.'
                )
            ),
            array(
                'field' => 'idcliente',
                'label' => 'Cliente',
                'rules' => 'trim|required',
                'errors' => array(
                    'required' => 'Campo obligatorio.'
                )
            )
        );

        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
            $result['error'] = true;
            $result['msg']   = array(
                 'numeroparte' => form_error('numeroparte'),
                 'idcliente' => form_error('idcliente')
            );
        } else {
            $idcliente = $this->input->post('idcliente');
            $numeroparte = $this->input->post('numeroparte');
            $resuldovalidacion = $this->parte->validarClienteParte($idcliente,$numeroparte);
            if($resuldovalidacion == FALSE){
                $data = array(
                    'numeroparte' => $this->input->post('numeroparte'),
                    'idcliente' => $this->input->post('idcliente'),
                    'idusuario' => $this->session->user_id,
                    'activo' => 1,
                    'fecharegistro' => date('Y-m-d H:i:s')
                );
                $this->parte->addParte($data);
            }else{
                $result['error'] = true;
                $result['msg']   = array(
                    'smserror' => "El número de cliente ya se encuentra registrado."
                );
            }
        }
        echo json_encode($result);
    }

    public function updateParte()
    {
        //Permission::grant(uri_string());
        $config = array(
            array(
                'field' => 'numeroparte',
                'label' => 'Número de parte',
                'rules' => 'trim|required',
                'errors' => array(
                    'required' => 'Campo obligatorio.'
                )
            ),
            array(
                'field' => 'idcliente',
                'label' => 'Cliente',
                'rules' => 'trim|required',
                'errors' => array(
                    'required' => 'Campo obligatorio.'
                )
            )
        );

        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
            $result['error'] = true;
            $result['msg']   = array(
                 'numeroparte' => form_error('numeroparte'),
                 'idcliente' => form_error('idcliente')
            );
        } else {
            $idcliente = $this->input->post('idcliente');
            $numeroparte = $this->input->post('numeroparte');
            $idparte = $this->input->post('idparte');
            $resuldovalidacion = $this->parte->validarClientePartePorIdParte($idparte,$idcliente,$numeroparte);
            if($resuldovalidacion == FALSE){
                $data = array(
                    'numeroparte' => $this->input->post('numeroparte'),
                    'idcliente' => $this->input->post('idcliente'),
                    'idusuario' => $this->session->user_id,
                    'activo' => $this->input->post('activo'),
                    'fecharegistro' => date('Y-m-d H:i:s')
                );
                $this->parte->updateParte($idparte,$data);
            }else{
                $result['error'] = true;
                $result['msg']   = array(
                    'smserror' => "El número de cliente ya se encuentra registrado."
                );
            }
        }
        echo json_encode($result);
    }

    public function searchEnviados()
    {
        //Permission::grant(uri_string());
        $value = $this->input->post('text');
        $query = $this->parte->searchEnviados($value,$this->session->user_id);
        if ($query) {
            $result['detallestatus'] = $query;
        }
        echo json_encode($result);
    }

    public function searchParte()
    {
        //Permission::grant(uri_string());
        $value = $this->input->post('text');
        $query = $this->parte->searchPartes($value);
        if ($query) {
            $result['partes'] = $query;
        }
        echo json_encode($result);
    }

 

}
?>
