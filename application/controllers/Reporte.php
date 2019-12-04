<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//Load libruary for API
class Reporte extends CI_Controller {

    function __construct() {
        parent::__construct();

        if (!isset($_SESSION['user_id'])) {
            $this->session->set_flashdata('flash_data', 'You don\'t have access! ss');
            return redirect('login');
        }
        $this->load->helper('url');
        $this->load->model('data_model');
        $this->load->model('rol_model', 'rol');
        $this->load->model('reporte_model', 'reporte');
        $this->load->library('session');
        $this->load->model('user_model', 'usuario');
        $this->load->library('permission');
    }
    
    public function transferencia() {
        Permission::grant(uri_string());
        $usuario = $this->usuario->showAllPacking();
        $data = array('usuarios' => $usuario);
        $this->load->view('header');
        $this->load->view('reporte/transferencia', $data);
        $this->load->view('footer');
    }
    public function procesofinal()
    {
        # code...
       $data  = array(
        'partes'=>$this->reporte->allNumeroPartes(),
        'maquinas'=>$this->reporte->maquinas_activas()
    );
       $this->load->view('header');
       $this->load->view('reporte/procesofinal',$data);
       $this->load->view('footer');
   }
   public function procesos()
   {
        # code...
       // var_dump($this->reporte->allNumeroPartes());
    $data  = array(
        'partes'=>$this->reporte->allNumeroPartes(),
        'procesos' => $this->reporte->allProcesos(),
        'maquinas'=>$this->reporte->allMaquinas()
    );
    $this->load->view('header');
    $this->load->view('reporte/procesos',$data);
    $this->load->view('footer');
}
public function buscar_reporte_proceso_final()
{

  $idlamina = $this->input->post('idlamina'); 
  $fechainicio = $this->input->post('fechainicio');
  $nueva_fecha_inicio = $fechainicio.":00";
  $fechafin = $this->input->post('fechafin'); 
  $nueva_fecha_fin = $fechafin.":00";
  $idproceso = $this->input->post('idproceso');
  $datareporte =  $this->reporte->busqueda_proceso_final($nueva_fecha_inicio,$nueva_fecha_fin,$idproceso);
        //var_dump($datareporte);
  $data  = array(
    'partes'=>$this->reporte->allNumeroPartes(),
    'datareporte'=>$datareporte,
    'maquinas'=>$this->reporte->maquinas_activas()
);
  $this->load->view('header');
  $this->load->view('reporte/procesofinal',$data);
  $this->load->view('footer');
}
public function buscar_reporte_proceso()
{
        # code...

    $idlamina = $this->input->post('idlamina');
        //$idparte = $this->input->post('idparte');
    $fechainicio = $this->input->post('fechainicio');
    $fechafin = $this->input->post('fechafin'); 
    $idmaquina = $this->input->post('idmaquina');
    $idproceso = $this->input->post('idproceso');
        //$idparte = $this->input->post('idparte');
        //$idparte = $this->input->post('idparte');

    $datareporte =  $this->reporte->busqueda_proceso($fechainicio,$fechafin,$idlamina,$idproceso,$idmaquina);
    $data  = array(
        'partes'=>$this->reporte->allNumeroPartes(),
        'procesos' => $this->reporte->allProcesos(),
        'maquinas'=>$this->reporte->allMaquinas(),
        'datareporte'=>$datareporte
    );
    $this->load->view('header');
    $this->load->view('reporte/procesos',$data);
    $this->load->view('footer');

}

public function buscar() {
        # code...
    Permission::grant(uri_string());
    
    $fechainicio = $this->input->post('fechainicio');
    $fechafin = $this->input->post('fechafin');
    $modulo = $this->input->post('modulo');
    $result="";
    if($modulo == "1"){
        $result = $this->reporte->allTransferenciaPacking($fechainicio,$fechafin);
        
    }elseif ($modulo=="2") {
        $result = $this->reporte->allTransferenciaCalidad($fechainicio,$fechafin);
    }elseif ($modulo=="3") {
        $result = $this->reporte->allTransferenciaBodega($fechainicio,$fechafin);
    }
            //var_dump($result);
    $data = array('result' => $result,'modulo'=>$modulo);
    $this->load->view('header');
    $this->load->view('reporte/transferencia', $data);
    $this->load->view('footer');
    
    
}

//Vista reporte por PACKING
public function reportepacking()
{
    $data  = array(
        'partes'=>$this->reporte->allNumeroPartes()
    );

    $this->load->view('header');
    $this->load->view('reporte/reportepacking',$data);
    $this->load->view('footer');   
}

// Reporte PACKING
public function buscar_reporte_packing()
{
    $idparte = $this->input->post('idparte'); 
    $fechainicio = $this->input->post('fechainicio');
    $nueva_fecha_inicio = $fechainicio.":00";
    $fechafin = $this->input->post('fechafin'); 
    $nueva_fecha_fin = $fechafin.":00";
    
    $datareporte =  $this->reporte->getAllInfoReporte($idparte,$nueva_fecha_inicio,$nueva_fecha_fin);
    //$users = $this->reporte->getAllUsers();
    //var_dump($datareporte);
    $data  = array(
        'partes'=>$this->reporte->allNumeroPartes(),
        //'usuarios'=>$users,
        'informacion'=>$datareporte,
        'fechainicio'=>$nueva_fecha_inicio,
        'fechafin'=>$nueva_fecha_fin,
        'idparte'=> $idparte
    );
    
    $this->load->view('header');
    $this->load->view('reporte/reportepacking',$data);
    $this->load->view('footer');
}

public function generar_pdf_packing()
{
    $this->load->library('tcpdf');

    $idparte = $this->input->post('idparte'); 
    $fechainicio = $this->input->post('fechai');
    $fechafin = $this->input->post('fechaf'); 

    $data = $this->reporte->getAllInfoReporte($idparte,$fechainicio,$fechafin);
    
    $mediadia = 20000;
    $diferencia = 0;
    $producciontotal = 0;
    $totalpallet = 0;


    foreach ($data as $value) {
        $producciontotal = $producciontotal + $value->totalcajas;
        $totalpallet = $totalpallet + $value->totalpallet; 
    }

    
    $diferencia_1= $mediadia -  $producciontotal;

    if($diferencia_1 < 0){
        $resultado = str_replace("-", "", $diferencia_1);
        $diferencia = "+".number_format($resultado);
    }else{
     $diferencia = number_format($diferencia_1);
 }
 

 $linkimge = base_url() . '/assets/images/woorilogo.png';
 $fechaactual = date("d/m/Y h:i:s");
 $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
 $pdf->SetTitle('Reporte');
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
 <table width="536" cellpadding="1" cellspacing="1">
 <tr>
 <td><p>Woori Bo Kwang Printing!</p></td>
 <td></td>
 <td><img align="right" class="imgtitle" width="90"  src="'.$linkimge.'"; /></td>
 </tr>
 </table>
 <table width="536" cellpadding="1" cellspacing="1">
 <tr>
 <th style=" border-bottom: 5px solid #000;"></th>
 </tr>
 </table>
 <br><br>
 <table width="536"  style="margin-top:10px" cellpadding="1" cellspacing="1" >
 <tr>
 <td><p style="font-size:10px;">Fecha: '.$fechaactual.'</p></td>
 <td><p style="font-size:10px;">Turno: Día/Noche</p></td>
 <td><p style="font-size:9px;">Realizado por: '.$_SESSION['name'].'</p></td>
 </tr>
 </table>
 <br><br>
 <table width="536"  style="margin-top:10px;  border: 1px solid #000000;" cellpadding="1" cellspacing="1">
 <tr>
 <td></td>
 <td><p style="font-size:9px; text-align: center;"><b>META POR DÍA:</b></p></td>
 <td><p style="font-size:9px; text-align: center;"><b>PRODUCCIÓN TOTAL DIA(F/G):</b></p></td>
 <td><p style="font-size:9px; text-align: center;"><b>DIFERENCIA:</b></p></td>
 <td><p style="font-size:9px; text-align: center;"><b>TOTAL DE PALLET:</b></p></td>
 <td></td>
 </tr>
 <tr>
 <td></td>
 <td ><p style="font-size:12px; text-align: center;">'.number_format($mediadia).'</p></td>
 <td ><p style="font-size:12px; text-align: center;">'.number_format($producciontotal).'</p></td>
 <td ><p style="font-size:12px; text-align: center;">'.$diferencia.'</p></td>
 <td ><p style="font-size:12px; text-align: center;">'.$totalpallet.'</p></td>
 <td></td>
 </tr>
 </table>
 <br><br>
 <table width="536" style="margin-top:10px; border: 1px solid #000000;" cellpadding="1" cellspacing="1">
 <tr>
 <td align="center" colspan="8"><p style="font-size:12px;"><b>REPORTE DE PRODUCCIÓN PACKING</b></p></td>
 </tr>

 <tr>
 <td width="90" align="center"><p style="font-size:10px;"><b>NÚM. DE PARTE</b></p></td>
 <td width="90" align="center"><p style="font-size:10px;"><b>MODELO</b></p></td>
 <td width="58" align="center"><p style="font-size:10px;"><b>REV.</b></p></td>
 <td width="58" align="center"><p style="font-size:10px;"><b>PLAN/P</b></p></td>
 <td width="58" align="center"><p style="font-size:10px;"><b>TIEMPO</b></p></td>
 <td width="58" align="center"><p style="font-size:10px;"><b>F/G</b></p></td>
 <td width="58" align="center"><p style="font-size:10px;"><b>CANT. POR PALLET</b></p></td>
 <td width="58" align="center"><p style="font-size:10px;"><b>TOTAL DE PALLET</b></p></td>
 </tr>';
 
 foreach ($data as $value) {
    $tbl .='<tr>
    <td><p style="font-size:7px;">'.$value->numeroparte.'</p></td>
    <td><p style="font-size:7px;">'.$value->modelo.'</p></td>
    <td><p style="font-size:9px;">'.trim($value->revision).'</p></td>
    <td><p style="font-size:9px;">---</p></td>
    <td><p style="font-size:9px;">LÍNEA '.$value->tiempo.'</p></td>
    <td><p style="font-size:9px;">'.number_format($value->totalcajas).'</p></td>
    <td><p style="font-size:9px;">'.number_format($value->cantidadcajaspallet).'</p></td>
    <td><p style="font-size:9px;">'.number_format($value->totalpallet).'</p></td>
    </tr>';
}

$tbl .= ' 
</table>';

$pdf->writeHTML($tbl, true, false, false, false, '');

ob_end_clean();

$pdf->Output('ReportePacking.pdf', 'D');

}
// Finaliza reporte PACKING

// Reporte CALIDAD
public function reportecalidad()
{
    $data  = array(
        'partes'=>$this->reporte->allNumeroPartes()
    );

    $this->load->view('header');
    $this->load->view('reporte/reportecalidad',$data);
    $this->load->view('footer');   
}

public function buscar_reporte_calidad()
{
    $idparte = $this->input->post('idparte'); 
    $fechainicio = $this->input->post('fechainicio');
    $nueva_fecha_inicio = $fechainicio.":00";
    $fechafin = $this->input->post('fechafin'); 
    $nueva_fecha_fin = $fechafin.":00";
    
    $datareporte =  $this->reporte->getAllInfoReporteCalidad($idparte,$nueva_fecha_inicio,$nueva_fecha_fin);
    //$users = $this->reporte->getAllUsers();
    
    $data  = array(
        'partes'=>$this->reporte->allNumeroPartes(),
        //'usuarios'=>$users,
        'informacion'=>$datareporte,
        'fechainicio'=>$nueva_fecha_inicio,
        'fechafin'=>$nueva_fecha_fin,
        'idparte'=> $idparte
    );
    
    $this->load->view('header');
    $this->load->view('reporte/reportecalidad',$data);
    $this->load->view('footer');
}

public function generar_pdf_calidad()
{
    $this->load->library('tcpdf');

    $idparte = $this->input->post('idparte'); 
    $fechainicio = $this->input->post('fechai');
    $fechafin = $this->input->post('fechaf'); 

    $data = $this->reporte->getAllInfoReporteCalidad($idparte,$fechainicio,$fechafin);
    
    $mediadia = 20000;
    $diferencia = 0;
    $producciontotal = 0;
    $totalpallet = 0;


    foreach ($data as $value) {
        $producciontotal = $producciontotal + $value->cantidadcajaspallet;
        $totalpallet = $totalpallet + $value->totalpallet; 
    }

    
    $diferencia_1= $mediadia -  $producciontotal;

    if($diferencia_1 < 0){
        $resultado = str_replace("-", "", $diferencia_1);
        $diferencia = "+".number_format($resultado);
    }else{
     $diferencia = number_format($diferencia_1);
 }
 

 $linkimge = base_url() . '/assets/images/woorilogo.png';
 $fechaactual = date("d/m/Y h:i:s");
 $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
 $pdf->SetTitle('Reporte');
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
 <table width="536" cellpadding="1" cellspacing="1">
 <tr>
 <td><p>Woori Bo Kwang Printing!</p></td>
 <td></td>
 <td><img align="right" class="imgtitle" width="90"  src="'.$linkimge.'"; /></td>
 </tr>
 </table>
 <table width="536" cellpadding="1" cellspacing="1">
 <tr>
 <th style=" border-bottom: 5px solid #000;"></th>
 </tr>
 </table>
 <br><br>
 <table width="536"  style="margin-top:10px" cellpadding="1" cellspacing="1" >
 <tr>
 <td><p style="font-size:10px;">Fecha: '.$fechaactual.'</p></td>
 <td><p style="font-size:10px;">Turno: Dia/Noche</p></td>
 <td><p style="font-size:9px;">Realizado por: '.$_SESSION['name'].'</p></td>
 </tr>
 </table>
 <br><br>
 <table width="536"  style="margin-top:10px;  border: 1px solid #000000;" cellpadding="1" cellspacing="1">
 <tr>
 <td></td>
 <td><p style="font-size:9px; text-align: center;"><b>META POR DIA:</b></p></td>
 <td><p style="font-size:9px; text-align: center;"><b>PRODUCCION TOTAL DIA(F/G):</b></p></td>
 <td><p style="font-size:9px; text-align: center;"><b>DIFERENCIA:</b></p></td>
 <td><p style="font-size:9px; text-align: center;"><b>TOTAL DE PALLET:</b></p></td>
 <td></td>
 </tr>
 <tr>
 <td></td>
 <td ><p style="font-size:12px; text-align: center;">'.number_format($mediadia).'</p></td>
 <td ><p style="font-size:12px; text-align: center;">'.number_format($producciontotal).'</p></td>
 <td ><p style="font-size:12px; text-align: center;">'.$diferencia.'</p></td>
 <td ><p style="font-size:12px; text-align: center;">'.$totalpallet.'</p></td>
 <td></td>
 </tr>
 </table>
 <br><br>
 <table width="536" style="margin-top:10px; border: 1px solid #000000;" cellpadding="1" cellspacing="1">
 <tr>
 <td align="center" colspan="8"><p style="font-size:12px;"><b>REPORTE DE PRODUCCION CALIDAD</b></p></td>
 </tr>

 <tr>
 <td width="90" align="center"><p style="font-size:10px;"><b>NÚM. DE PARTE</b></p></td>
 <td width="90" align="center"><p style="font-size:10px;"><b>MODELO</b></p></td>
 <td width="58" align="center"><p style="font-size:10px;"><b>REV.</b></p></td>
 <td width="58" align="center"><p style="font-size:10px;"><b>PLAN/P</b></p></td>
 <td width="58" align="center"><p style="font-size:10px;"><b>TIEMPO</b></p></td>
 <td width="58" align="center"><p style="font-size:10px;"><b>F/G</b></p></td>
 <td width="58" align="center"><p style="font-size:10px;"><b>CANT. POR PALLET</b></p></td>
 <td width="58" align="center"><p style="font-size:10px;"><b>TOTAL DE PALLET</b></p></td>
 </tr>';
 
 foreach ($data as $value) {
    $tbl .='<tr>
    <td><p style="font-size:7px;">'.$value->numeroparte.'</p></td>
    <td><p style="font-size:7px;">'.$value->modelo.'</p></td>
    <td><p style="font-size:9px;">'.trim($value->revision).'</p></td>
    <td><p style="font-size:9px;">---</p></td>
    <td><p style="font-size:9px;">LINEA '.$value->tiempo.'</p></td>
    <td><p style="font-size:9px;">'.number_format($value->totalcajas).'</p></td>
    <td><p style="font-size:9px;">'.number_format($value->cantidadcajaspallet).'</p></td>
    <td><p style="font-size:9px;">'.number_format($value->totalpallet).'</p></td>
    </tr>';
}

$tbl .= ' 
</table>';

$pdf->writeHTML($tbl, true, false, false, false, '');

ob_end_clean();

$pdf->Output('ReporteCalidad.pdf', 'D');

}

// Finaliza reporte CALIDAD

// Reporte ALMACEN
public function reportealmacen()
{
    $data  = array(
        'partes'=>$this->reporte->allNumeroPartes()
    );

    $this->load->view('header');
    $this->load->view('reporte/reportealmacen',$data);
    $this->load->view('footer');   
}

public function buscar_reporte_almacen()
{
    $idparte = $this->input->post('idparte'); 
    $fechainicio = $this->input->post('fechainicio');
    $nueva_fecha_inicio = $fechainicio.":00";
    $fechafin = $this->input->post('fechafin'); 
    $nueva_fecha_fin = $fechafin.":00";
    
    $datareporte =  $this->reporte->getAllInfoReporteAlmacen($idparte,$nueva_fecha_inicio,$nueva_fecha_fin);
    //$users = $this->reporte->getAllUsers();
    
    $data  = array(
        'partes'=>$this->reporte->allNumeroPartes(),
        //'usuarios'=>$users,
        'informacion'=>$datareporte,
        'fechainicio'=>$nueva_fecha_inicio,
        'fechafin'=>$nueva_fecha_fin,
        'idparte'=> $idparte
    );
    
    $this->load->view('header');
    $this->load->view('reporte/reportealmacen',$data);
    $this->load->view('footer');
}

public function generar_pdf_almacen()
{
    $this->load->library('tcpdf');

    $idparte = $this->input->post('idparte'); 
    $fechainicio = $this->input->post('fechai');
    $fechafin = $this->input->post('fechaf'); 

    $data = $this->reporte->getAllInfoReporteAlmacen($idparte,$fechainicio,$fechafin);
    
    $mediadia = 20000;
    $diferencia = 0;
    $producciontotal = 0;
    $totalpallet = 0;


    foreach ($data as $value) {
        $producciontotal = $producciontotal + $value->cantidadcajaspallet;
        $totalpallet = $totalpallet + $value->totalpallet; 
    }

    
    $diferencia_1= $mediadia -  $producciontotal;

    if($diferencia_1 < 0){
        $resultado = str_replace("-", "", $diferencia_1);
        $diferencia = "+".number_format($resultado);
    }else{
     $diferencia = number_format($diferencia_1);
 }
 

 $linkimge = base_url() . '/assets/images/woorilogo.png';
 $fechaactual = date("d/m/Y h:i:s");
 $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
 $pdf->SetTitle('Reporte');
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
 <table width="536" cellpadding="1" cellspacing="1">
 <tr>
 <td><p>Woori Bo Kwang Printing!</p></td>
 <td></td>
 <td><img align="right" class="imgtitle" width="90"  src="'.$linkimge.'"; /></td>
 </tr>
 </table>
 <table width="536" cellpadding="1" cellspacing="1">
 <tr>
 <th style=" border-bottom: 5px solid #000;"></th>
 </tr>
 </table>
 <br><br>
 <table width="536"  style="margin-top:10px" cellpadding="1" cellspacing="1" >
 <tr>
 <td><p style="font-size:10px;">Fecha: '.$fechaactual.'</p></td>
 <td><p style="font-size:10px;">Turno: Día/Noche</p></td>
 <td><p style="font-size:9px;">Realizado por: '.$_SESSION['name'].'</p></td>
 </tr>
 </table>
 <br><br>
 <table width="536"  style="margin-top:10px;  border: 1px solid #000000;" cellpadding="1" cellspacing="1">
 <tr>
 <td></td>
 <td><p style="font-size:9px; text-align: center;"><b>META POR DÍA:</b></p></td>
 <td><p style="font-size:9px; text-align: center;"><b>PRODUCCION TOTAL DÍA(F/G):</b></p></td>
 <td><p style="font-size:9px; text-align: center;"><b>DIFERENCIA:</b></p></td>
 <td><p style="font-size:9px; text-align: center;"><b>TOTAL DE PALLET:</b></p></td>
 <td></td>
 </tr>
 <tr>
 <td></td>
 <td ><p style="font-size:12px; text-align: center;">'.number_format($mediadia).'</p></td>
 <td ><p style="font-size:12px; text-align: center;">'.number_format($producciontotal).'</p></td>
 <td ><p style="font-size:12px; text-align: center;">'.$diferencia.'</p></td>
 <td ><p style="font-size:12px; text-align: center;">'.$totalpallet.'</p></td>
 <td></td>
 </tr>
 </table>
 <br><br>
 <table width="536" style="margin-top:10px; border: 1px solid #000000;" cellpadding="1" cellspacing="1">
 <tr>
 <td align="center" colspan="8"><p style="font-size:12px;"><b>REPORTE DE PRODUCCIÓN ALMACEN</b></p></td>
 </tr>

 <tr>
 <td width="90" align="center"><p style="font-size:10px;"><b>NÚM. DE PARTE</b></p></td>
 <td width="90" align="center"><p style="font-size:10px;"><b>MODELO</b></p></td>
 <td width="58" align="center"><p style="font-size:10px;"><b>REV.</b></p></td>
 <td width="58" align="center"><p style="font-size:10px;"><b>PLAN/P</b></p></td>
 <td width="58" align="center"><p style="font-size:10px;"><b>TIEMPO</b></p></td>
 <td width="58" align="center"><p style="font-size:10px;"><b>F/G</b></p></td>
 <td width="58" align="center"><p style="font-size:10px;"><b>CANT. POR PALLET</b></p></td>
 <td width="58" align="center"><p style="font-size:10px;"><b>TOTAL DE PALLET</b></p></td>
 </tr>';
 
 foreach ($data as $value) {
    $tbl .='<tr>
    <td><p style="font-size:7px;">'.$value->numeroparte.'</p></td>
    <td><p style="font-size:7px;">'.$value->modelo.'</p></td>
    <td><p style="font-size:9px;">'.trim($value->revision).'</p></td>
    <td><p style="font-size:9px;">---</p></td>
    <td><p style="font-size:9px;">LINEA '.$value->tiempo.'</p></td>
    <td><p style="font-size:9px;">'.number_format($value->totalcajas).'</p></td>
    <td><p style="font-size:9px;">'.number_format($value->cantidadcajaspallet).'</p></td>
    <td><p style="font-size:9px;">'.number_format($value->totalpallet).'</p></td>
    </tr>';
}

$tbl .= ' 
</table>';

$pdf->writeHTML($tbl, true, false, false, false, '');

ob_end_clean();

$pdf->Output('ReporteAlmacen.pdf', 'D');

}
// Finaliza reporte ALMACEN

}
