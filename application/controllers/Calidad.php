<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Calidad extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!isset($_SESSION['user_id'])) {
            $this->session->set_flashdata('flash_data', 'You don\'t have access! ss');
            return redirect('login');
        }
        $this->load->helper('url');
        $this->load->model('data_model');
        $this->load->model('calidad_model', 'calidad');
        $this->load->model('user_model', 'usuario');
        $this->load->library('form_validation');
        $this->load->library('permission');
        $this->load->library('tcpdf');
        $this->load->model('palletcajas_model', 'palletcajas');
    }

    public function index() {
        Permission::grant(uri_string());
        $this->load->view('header');
        $this->load->view('calidad/index');
        $this->load->view('footer');
    }

    // Informacion de la parte recibida por id en Modulo[Calidad]
    public function detalleenvio($iddetalle) {
        Permission::grant(uri_string());
        $usuariosbodega = $this->calidad->allUsersBodega();
        $detalledeldetalleparte = $this->calidad->detalleDelDetallaParte($iddetalle);
        $palletcajas = $this->palletcajas->showAllId($iddetalle);
        //var_dump($palletcajas);
        //$dataerror = array();
        // if($detalledeldetalleparte->idestatus == 6){
        $dataerror = $this->calidad->motivosCancelacionBodega($iddetalle);
        //}
        //  echo $iddetalle;
//var_dump($dataerror);
//var_dump($dataerror);
        $data = array(
            'iddetalle' => $iddetalle,
            'detalle' => $detalledeldetalleparte,
            'usuariosbodega' => $usuariosbodega,
            'dataerrores' => $dataerror,
            'palletcajas' => $palletcajas
        );

        $this->load->view('header');
        $this->load->view('calidad/detalle_recibido', $data);
        $this->load->view('footer');
    }

    public function quitarPalletCajas($idpalletcaja, $iddetalleparte) {
        $this->palletcajas->eliminarPalletCajas($idpalletcaja);
        redirect('calidad/detalleenvio/' . $iddetalleparte);
    }

    // Informacion de la parte recibida por id en Modulo[Calidad]
    public function enviadosBodega() {
        Permission::grant(uri_string());
        $this->load->view('header');
        $this->load->view('calidad/enviados');
        $this->load->view('footer');
    }

    // Enviar informacion de la parte al siguiente Modulo[Bodega]
    public function enviarBodega() {
        Permission::grant(uri_string());
        $usuariosbodega = $this->input->post('usuariobodega');
        $idoperador = $this->input->post('idoperador');
        $iddetalleparte = $this->input->post('iddetalleparte');
        $estatus = $this->input->post('estatus');

        if ($estatus == "6") {
            $data = array(
                'idestatus' => 4,
                'idoperador' => $usuariosbodega,
                'idusuario' => $this->session->user_id,
                'fecharegistro' => date('Y-m-d H:i:s')
            );
            // Actualizar la informacion de la tabla [idoperador][idstatus]
            $actualizacionParte = $this->calidad->updateDetalleParte($iddetalleparte, $data);

            if ($actualizacionParte) {

                $datastatus1 = array(
                    'iddetalleparte' => $iddetalleparte,
                    'idstatus' => 4,
                    'idoperador' => $usuariosbodega,
                    'idusuario' => $this->session->user_id,
                    'fecharegistro' => date('Y-m-d H:i:s')
                );

                //Agregar la informacion a la tabla detalle status[Historial]
                $agregarEnvioBodega = $this->calidad->addDetalleEstatusParte($datastatus1);

                if ($agregarEnvioBodega) {

                    $datastatus2 = array(
                        'iddetalleparte' => $iddetalleparte,
                        'idstatus' => 2,
                        'idoperador' => $idoperador,
                        'idusuario' => $this->session->user_id,
                        'fecharegistro' => date('Y-m-d H:i:s')
                    );

                    //Agregar la informacion de finalizacion del proceso anterior a la tabla detalle statu[Historial]
                    $finalizarProceso = $this->calidad->addDetalleEstatusParte($datastatus2);

                    if ($finalizarProceso) {
                        echo json_encode("ok");
                    }
                }
            }
        } else {
            $data = array(
                'idestatus' => 4,
                'idoperador' => $usuariosbodega,
                'idusuario' => $this->session->user_id,
                'fecharegistro' => date('Y-m-d H:i:s')
            );
            // Actualizar la informacion de la tabla [idoperador][idstatus]
            $actualizacionParte = $this->calidad->updateDetalleParte($iddetalleparte, $data);

            if ($actualizacionParte) {

                $datastatus1 = array(
                    'iddetalleparte' => $iddetalleparte,
                    'idstatus' => 4,
                    'idoperador' => $usuariosbodega,
                    'idusuario' => $this->session->user_id,
                    'fecharegistro' => date('Y-m-d H:i:s')
                );

                //Agregar la informacion a la tabla detalle status[Historial]
                $agregarEnvioBodega = $this->calidad->addDetalleEstatusParte($datastatus1);

                if ($agregarEnvioBodega) {

                    $datastatus2 = array(
                        'iddetalleparte' => $iddetalleparte,
                        'idstatus' => 2,
                        'idoperador' => $idoperador,
                        'idusuario' => $this->session->user_id,
                        'fecharegistro' => date('Y-m-d H:i:s')
                    );

                    //Agregar la informacion de finalizacion del proceso anterior a la tabla detalle statu[Historial]
                    $finalizarProceso = $this->calidad->addDetalleEstatusParte($datastatus2);

                    if ($finalizarProceso) {
                        echo json_encode("ok");
                    }
                }
            }
        }
    }

    public function enviarBodegaNew() {
        $iddetalleparte = $this->input->post('iddetalleparte');
        $operador = $this->input->post('usuariobodega');
        $ids = $this->input->post('id');
        foreach ($ids as $value) {
            $data = array(
                'idestatus' => 4,
                'idoperador' => $operador,
                'idusuario' => $this->session->user_id,
                'fecharegistro' => date('Y-m-d H:i:s')
            );
            $this->palletcajas->updatePalletCajas($value, $data);
        }
        //redirect('detalleenvio/'.$iddetalleparte);
    }

    public function rechazarAPackingNew() {
        $iddetalleparte = $this->input->post('iddetalleparte');
        $motivorechazo = $this->input->post('motivorechazo');
        $operador = $this->input->post('idoperador');
        $ids = $this->input->post('id');
        foreach ($ids as $value) {
            $data = array(
                'idestatus' => 3,
                'idoperador' => $operador,
                'idusuario' => $this->session->user_id,
                'fecharegistro' => date('Y-m-d H:i:s')
            );
            $this->palletcajas->updatePalletCajas($value, $data);
        }
        $datarechazo = array(
            'iddetalleparte' => $iddetalleparte,
            'idstatus' => 3,
            'comentariosrechazo' => $motivorechazo,
            'idoperador' => $operador,
            'idusuario' => $this->session->user_id,
            'fecharegistro' => date('Y-m-d H:i:s')
        );
        $this->calidad->addRechazoParte($datarechazo);
    }

    // Mostrar todas las partes enviados de Modulo[Packing]
    public function showAllEnviados() {
        Permission::grant(uri_string());
        //Parametro 7 Indica el estatus enviado a bodega

        $query = $this->calidad->showAllEnviados($this->session->user_id);
        if ($query) {
            $result['detallestatus'] = $this->calidad->showAllEnviados($this->session->user_id);
        }
        echo json_encode($result);
    }

    public function searchParte() {
        Permission::grant(uri_string());
        $value = $this->input->post('text');
        $query = $this->calidad->buscar($value, $this->session->user_id);
        if ($query) {
            $result['detallestatus'] = $query;
        }
        echo json_encode($result);
    }

    // Mostrar todas las partes enviados de Modulo[Packing]
    public function getAllEnviados() {
        Permission::grant(uri_string());
        //Parametro 7 Indica el estatus enviado a bodega
        $query = $this->calidad->showAllEnviados2($this->session->user_id);
        if ($query) {
            $result['detallestatus'] = $this->calidad->showAllEnviados2($this->session->user_id);
        }
        echo json_encode($result);
    }

    public function getSearchPart() {
        Permission::grant(uri_string());
        $value = $this->input->post('text');
        //Parametro 7 Indica el estatus enviado a bodega
        $query = $this->calidad->searchPartes2($value, $this->session->user_id);
        if ($query) {
            $result['detallestatus'] = $query;
        }
        echo json_encode($result);
    }

    public function rechazarParte() {
        Permission::grant(uri_string());
        $idoperador = $this->input->post('idoperador');
        $iddetalleparte = $this->input->post('iddetalleparte');
        $comentario = $this->input->post('comentario');

        $data = array(
            'idestatus' => 3,
            'idusuario' => $this->session->user_id,
            'fecharegistro' => date('Y-m-d H:i:s')
        );
        // Actualizar la informacion de la tabla [idoperador][idstatus]
        $actualizacionParte = $this->calidad->updateDetalleParte($iddetalleparte, $data);
        if ($actualizacionParte) {
            //Permission::grant(uri_string());
            $data = array(
                'iddetalleparte' => $iddetalleparte,
                'idstatus' => 3,
                'idoperador' => $idoperador,
                'comentariosrechazo' => $comentario,
                'idusuario' => $this->session->user_id,
                'fecharegistro' => date('Y-m-d H:i:s')
            );

            //Agregar Motivo de rechazo de la parte [Historial]
            $resultado = $this->calidad->addRechazoParte($data);

            if ($resultado) {
                echo json_encode("ok");
            }
        }
    }

    //Generar Reporte
    public function generarPDFEnvio($id) {
        Permission::grant(uri_string());
        // code...
        $dataoperadoralmacenamiento = $this->calidad->usuarioDeAlmacen($id);
        $datauseralma = $this->usuario->detalleUsuario($dataoperadoralmacenamiento->idoperador);
        echo $nombreoperadoralmacen = $datauseralma->name;
        $datauser = $this->usuario->detalleUsuario($this->session->user_id);
        $nombreusuario = $datauser->name;
        $lista = $this->calidad->cantidadesPartes($id);
        $totalpallet = 0;
        $totalcajas = 0;
        if ($lista != false) {

            foreach ($lista as $value) {
                $totalpallet++;
                $totalcajas = $totalcajas + $value->cajas;
            }
        }

        $detalle = $this->calidad->detalleDelDetallaParte($id);
        //var_dump($detalle);
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
        //Codigo para quitar el header y footer junto con sus enpaginado
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
//Fin del enpaginado
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
    <td width="100" align="center" style="border-left:solid 1px #000000; border-right:solid 1px #000000; border-top:solid 1px #000"><p class="textgeneral">TRANSFERENCIA NUMERO</p></td>
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
    <td colspan="3" class="textgeneral lineabajo">HECHA POR: ' . $nombreusuario . '</td>
    </tr>
    <tr>
    <td class="textgeneral lineabajo">TURNO: ' . $detalle->nombreturno . '</td>
    <td>&nbsp;</td>
    <td colspan="3" class="textgeneral lineabajo">RECIBIDA POR: ' . $nombreoperadoralmacen . '</td>
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
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;font-size:9px;">&nbsp;' . $totalcajas / $totalpallet . '</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;font-size:9px;">&nbsp;' . $totalpallet . '</td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000;font-size:9px;">&nbsp;' . ($totalcajas / $totalpallet) * ($totalpallet) . '</td>
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
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000; font-size:9px; margin-top:20px;">&nbsp;' . $totalpallet . ' </td>
    <td style="border-bottom:solid 1px #000; border-right:solid 1px #000; font-size:9px;">&nbsp;' . ($totalcajas / $totalpallet) * ($totalpallet) . '</td>
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

}

?>
