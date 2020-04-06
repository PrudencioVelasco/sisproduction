<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Bodegap extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!isset($_SESSION['user_id'])) {
            $this->session->set_flashdata('flash_data', 'You don\'t have access! ss');
            return redirect('Login');
        }
        $this->load->helper('url');
        $this->load->model('almacen_model', 'almacen');
        $this->load->model('warehouse_model', 'warehouse');
        $this->load->model('linea_model', 'linea');
        $this->load->model('transferencia_model', 'transferencia');
        $this->load->model('revision_model', 'revision');
        $this->load->model('modelo_model', 'modelo');
        $this->load->model('calidadp_model', 'calidadp');
        $this->load->model('calidad_model', 'calidad');
        $this->load->model('bodegap_model', 'bodegap');
        $this->load->model('palletcajasproceso_model', 'palletcajasproceso');
        $this->load->model('posicionbodega_model', 'posicionbodega');
        $this->load->library('permission');
        $this->load->library('session');
    }

    public function index() {
        Permission::grant(uri_string());
        $query = $this->bodegap->showAll();
        $data = array(
            'datatransferencia'=>$query
        );

        $this->load->view('header');
        $this->load->view('bodegap/index',$data);
        $this->load->view('footer');
    }
    public function detalle($idtransferencia,$folio) {
         //Permission::grant(uri_string());
        $motivosrechazo = $this->bodegap->motivosRechazoBodega();
        $motivosrechazocalidad = $this->bodegap->motivosRechazoCalidad();
        $datatransferencia = $this->bodegap->listaNumeroParteTransferencia($idtransferencia);
        $arrayposicionesbodega = $this->posicionbodega->posicionesBodega();
        //var_dump($arrayposicionesbodega);
        $data = array(
            'id' => $idtransferencia,
            'folio'=>$folio,
            'datatransferencia' => $datatransferencia,
             'motivosrechazo'=>$motivosrechazo,
             'motivosrechazocalidad'=>$motivosrechazocalidad,
             'arrayposicionesbodega'=>$arrayposicionesbodega);
        $this->load->view('header');
        $this->load->view('bodegap/detalle', $data);
        $this->load->view('footer');
    }
    public function rechazopallet() {
        //Permission::grant(uri_string());
        $idpalletcajas = $this->input->post('idpalletcajas');
        $data = $this->bodegap->motivosrechazo($idpalletcajas);
        echo json_encode($data);
    }

 public function generarPDFEnvio($id) {
        //Permission::grant(uri_string());
        $this->load->library('tcpdf');
        $listapartes = $this->bodegap->palletReporte($id);
        //var_dump($listapartes);
        $totalpallet = 0;
        $totalcajas = 0;
        if ($listapartes != false) {

            foreach ($listapartes as $value) {
                $totalpallet =$totalpallet + 1;
                $totalcajas = $totalcajas + $value->cantidad;
            }
        }


        $detalle = $this->bodegap->detalleTransferencia($id);
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
    <td width="100" align="center" valign="middle"  style="border-top:solid 1px #000000; border-bottom:solid 1px #000000; border-right:solid 1px #000000;">NUM. PARTE</td>
    <td width="77" align="center" valign="middle" style="border-top:solid 1px #000000; border-bottom:solid 1px #000000; border-right:solid 1px #000000;">MODELO</td>
    <td width="66" align="center" valign="middle" style="border-top:solid 1px #000000; border-bottom:solid 1px #000000; border-right:solid 1px #000000;">CANTIDAD POR PALLET</td>
    <td width="67" align="center" valign="middle" style="border-top:solid 1px #000000; border-bottom:solid 1px #000000; border-right:solid 1px #000000;">TOTAL DE PALLET</td>
    <td width="66" align="center" valign="middle" style="border-top:solid 1px #000000; border-bottom:solid 1px #000000; border-right:solid 1px #000000;">CANTIDAD TOTAL</td>
    <td width="100" align="center" valign="middle" style="border-top:solid 1px #000000; border-bottom:solid 1px #000000; border-right:solid 1px #000000;">ALMACEN UBICACIÓN</td>
  </tr>
  ';
        foreach ($listapartes as $value) {
            $tbl .= '<tr>
    <td style="border-left:solid 1px
    #000000; border-bottom:solid 1px #000; font-size:8px; border-right:solid 1px #000;">&nbsp;' . $value->nombrecliente . '</td>
    <td style="border-bottom:solid 1px #000; font-size:8px;  border-right:solid 1px #000;">&nbsp;' . $value->numeroparte . '</td>
    <td style="border-bottom:solid 1px #000; font-size:8px;  border-right:solid 1px #000;">&nbsp;' . $value->descripcionmodelo . '</td>
    <td style="border-bottom:solid 1px #000; font-size:8px; border-right:solid 1px #000;">&nbsp;' . number_format($value->cantidad) . '</td>
    <td style="border-bottom:solid 1px #000; font-size:8px; border-right:solid 1px #000;">&nbsp;' . number_format(1) . '</td>
    <td style="border-bottom:solid 1px #000; font-size:8px; border-right:solid 1px #000;">&nbsp;' . number_format($value->cantidad) . '</td>
    <td style="border-bottom:solid 1px #000; font-size:8px; border-right:solid 1px #000;">'.$value->nombreposicion.'</td>
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

    public function admin()
    {
        $data = array(
            'informacion'=>$this->warehouse->getDataPallets(),
            'posiciones'=> $this->warehouse->getDataPalletsPosicion()
        );

        $this->load->view('header');
        $this->load->view('bodegap/admin/index',$data);
        $this->load->view('footer');
    }
    public function historial($idrevision='')
    {
        $entradas = $this->bodegap->listaEntradas($idrevision);
        $ubicaciones = $this->bodegap->listaUbicaciones();
         $data = array(
            'entradas'=>$entradas,
            'ubicaciones'=>$ubicaciones
            //'informacion'=>$this->warehouse->getDataPallets(),
            //'posiciones'=> $this->warehouse->getDataPalletsPosicion()
        );
         //var_dump($entradas);

        $this->load->view('header');
        $this->load->view('bodegap/admin/detalle',$data);
        $this->load->view('footer');
    }
    public function updateUbicacion()
    {
         {

        $config = array(
              array(
                'field' => 'idposicion',
                'label' => 'Asistencia',
                'rules' => 'trim|required',
                'errors' => array(
                    'required' => 'Debe de seleccionar la Ubicación.',
                )
            )
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
            $errors = validation_errors();
            echo json_encode(['error'=>$errors]);
        } else {
            $idposicion = $this->input->post('idposicion');
            $id = $this->input->post('id');
                $data = array(
                    'idposicion'=>$idposicion
                );
                $value = $this->bodegap->updatePosicion($id,$data);
                if($value){
                echo json_encode(['success'=>'Ok']);
                }else{
                    echo json_encode(['error'=>'Error... Intente mas tarde. ']);
                }

        }
       // echo json_encode($result);
    }
    }

    public function ubicacion($idposicion='')
    {
        $ubicaciones = $this->bodegap->listaUbicaciones();
        $data = array(
            'entradas'=> $this->bodegap->listaEntradasUbicaciones($idposicion),
            'ubicaciones'=>$ubicaciones
        );
        $this->load->view('header');
        $this->load->view('bodegap/admin/ubicacion',$data);
        $this->load->view('footer');
    }

    public function comparar()
    {
        $data = array(
            'busquedas'=>$this->bodegap->listaBusqueda()
        );
        $this->load->view('header');
        $this->load->view('bodegap/comparar/index',$data);
        $this->load->view('footer');
    }

    public function create_search()
    {
       $data = array(
        'nombrebusqueda'=>date("Ymd"),
        'idusuario' => $this->session->user_id,
        'fecharegistro' => date('Y-m-d H:i:s')
       );
       $idbusqueda = $this->bodegap->addBusqueda($data);
       $data_update =array(
        'nombrebusqueda'=>date("Ymd").$idbusqueda
       );
       $this->bodegap->updateBusqueda($idbusqueda,$data_update);
       redirect('Bodegap/comparar');
    }
    public function detalle_busqueda($idbusqueda='')
    {
        $listapartes = $this->bodegap->listaParteBusqueda($idbusqueda);
        $listacantidad = $this->bodegap->listaParteBusquedaCantidad($idbusqueda);
        //var_dump($listapartes);
        $data = array(
            'partes'=> $this->bodegap->listaNuerosPartes(),
            'listapartes'=>$listapartes,
            'listacantidad'=>$listacantidad,
            'idbusqueda'=>$idbusqueda
        );
        $this->load->view('header');
        $this->load->view('bodegap/comparar/detalle',$data);
        $this->load->view('footer');
    }

        public function addParte()
    {
            $idrevision = $this->input->post('idrevision');
            $cantidad = $this->input->post('cantidad');
            $idbusqueda = $this->input->post('idbusqueda');
            $data = array(
                'idbusqueda'=>$idbusqueda,
                'idrevision'=>$idrevision,
                'cantidad'=>$cantidad,
                'idusuario' => $this->session->user_id,
                'fecharegistro' => date('Y-m-d H:i:s')
            );
            $this->bodegap->addBusquedaDetalle($data);
            redirect('Bodegap/detalle_busqueda/'.$idbusqueda);
    }
    public function deleteParte($iddetallebusqueda='',$idbusqueda = '')
    {
        $this->bodegap->deleteParte($iddetallebusqueda);
        redirect('Bodegap/detalle_busqueda/'.$idbusqueda);
    }
}

?>
