<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Bodega extends CI_Controller
{

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
        $this->load->model('bodega_model', 'bodega');
        $this->load->model('posicionbodega_model', 'posicionbodega');
        $this->load->library('permission');

    }
    public function index()
    {
       // Permission::grant(uri_string());
        $this->load->view('header');
        $this->load->view('bodega/index');
        $this->load->view('footer');
    }
    public function showAllEnviados()
    {
         //Permission::grant(uri_string());
        $query = $this->bodega->showAllEnviados($this->session->user_id);
        if ($query) {
            $result['detallestatus'] = $this->bodega->showAllEnviados($this->session->user_id);
        }
        echo json_encode($result);
    }
  public  function searchArrayKeyVal($sKey, $id, $array) {
   foreach ($array as $key => $val) {
       if ($val[$sKey] == $id) {
           return $key;
       }
   }
   return false;
}
    public function verDetalle($iddetalle)
    {
      $usuarioscalidad=$this->usuario->showAllCalidad();
      $detalledeldetalleparte=$this->parte->detalleDelDetallaParte($iddetalle);
      $arrayposicionesbodega= $this->posicionbodega->posicionesBodega();
      $dataerror = array();
      $dataposicionesparte=array();

      if ($this->bodega->posicionesDetalleBodega($iddetalle) != false) {
        // code...
        $dataposicionesparte = $this->bodega->posicionesDetalleBodega($iddetalle);
      }
      $dataposicionebodega =array();
      if($detalledeldetalleparte->idestatus == 6){
        $dataerror=$this->parte->motivosCancelacionCalidad($iddetalle);
      }
     $data=array(
      'iddetalle'=>$iddetalle,
      'detalle'=>$detalledeldetalleparte,
      'usuarioscalidad'=>$usuarioscalidad,
      'dataerrores'=>$dataerror,
      'posicionbodega'=>$arrayposicionesbodega,
      'dataposicionesparte'=>$dataposicionesparte
     );
     //var_dump($detalledeldetalleparte);
      $this->load->view('header');
      $this->load->view('bodega/detalle',$data);
      $this->load->view('footer');
    }

    public function rechazar()
    {
      // code...
      $iddetalleparte= $this->input->post('iddetalleparte');
      $data     = array(
                     'idestatus' => 6,
                     'idusuario' => $this->session->user_id,
                     'fecharegistro' => date('Y-m-d H:i:s')

                 );
            $this->parte->updateDetalleParte($iddetalleparte,$data);

            $datastatus     = array(
                     'iddetalleparte' => $iddetalleparte,
                     'idstatus' => 6,
                     'comentariosrechazo' => $this->input->post('motivo'),
                     'idoperador' => $this->input->post('operador'),
                     'idusuario' => $this->session->user_id,
                     'fecharegistro' => date('Y-m-d H:i:s')

                 );
           $this->parte->addDetalleEstatusParte($datastatus);
           redirect('bodega/');
    }
    public function insertarPosicion()
    {
  $iddetalleparte= $this->input->post('iddetalleparte');
  $this->bodega->eliminarposicionesparte($iddetalleparte);
      if ($this->input->post('numero1')) {
        $data = array(
          'iddetalleparte' => $this->input->post('iddetalleparte'),
          'numero'=> $this->input->post('pnumero1'),
          'idposicion' => $this->input->post('numero1'),
          'idusuario' => $this->session->user_id,
          'fecharegistro' => date('Y-m-d H:i:s')
       );

       $this->posicionbodega->addPartePosicionBodega($data);
      }
      if ($this->input->post('numero2')) {
        $data = array(
          'iddetalleparte' => $this->input->post('iddetalleparte'),
            'numero'=> $this->input->post('pnumero2'),
          'idposicion' => $this->input->post('numero2'),
          'idusuario' => $this->session->user_id,
          'fecharegistro' => date('Y-m-d H:i:s')
       );

       $this->posicionbodega->addPartePosicionBodega($data);
      }
      if ($this->input->post('numero3')) {
        $data = array(
          'iddetalleparte' => $this->input->post('iddetalleparte'),
            'numero'=> $this->input->post('pnumero3'),
          'idposicion' => $this->input->post('numero3'),
          'idusuario' => $this->session->user_id,
          'fecharegistro' => date('Y-m-d H:i:s')
       );

       $this->posicionbodega->addPartePosicionBodega($data);
      }
      if ($this->input->post('numero4')) {
        $data = array(
          'iddetalleparte' => $this->input->post('iddetalleparte'),
            'numero'=> $this->input->post('pnumero4'),
          'idposicion' => $this->input->post('numero4'),
          'idusuario' => $this->session->user_id,
          'fecharegistro' => date('Y-m-d H:i:s')
       );

       $this->posicionbodega->addPartePosicionBodega($data);
      }
      if ($this->input->post('numero5')) {
        $data = array(
          'iddetalleparte' => $this->input->post('iddetalleparte'),
            'numero'=> $this->input->post('pnumero5'),
          'idposicion' => $this->input->post('numero5'),
          'idusuario' => $this->session->user_id,
          'fecharegistro' => date('Y-m-d H:i:s')
       );

       $this->posicionbodega->addPartePosicionBodega($data);
      }
      if ($this->input->post('numero6')) {
        $data = array(
          'iddetalleparte' => $this->input->post('iddetalleparte'),
            'numero'=> $this->input->post('pnumero6'),
          'idposicion' => $this->input->post('numero6'),
          'idusuario' => $this->session->user_id,
          'fecharegistro' => date('Y-m-d H:i:s')
       );

       $this->posicionbodega->addPartePosicionBodega($data);
      }
      if ($this->input->post('numero7')) {
        $data = array(
          'iddetalleparte' => $this->input->post('iddetalleparte'),
            'numero'=> $this->input->post('pnumero7'),
          'idposicion' => $this->input->post('numero7'),
          'idusuario' => $this->session->user_id,
          'fecharegistro' => date('Y-m-d H:i:s')
       );

       $this->posicionbodega->addPartePosicionBodega($data);
      }
      if ($this->input->post('numero8')) {
        $data = array(
          'iddetalleparte' => $this->input->post('iddetalleparte'),
            'numero'=> $this->input->post('pnumero8'),
          'idposicion' => $this->input->post('numero8'),
          'idusuario' => $this->session->user_id,
          'fecharegistro' => date('Y-m-d H:i:s')
       );

       $this->posicionbodega->addPartePosicionBodega($data);
      }
      if ($this->input->post('numero9')) {
        $data = array(
          'iddetalleparte' => $this->input->post('iddetalleparte'),
            'numero'=> $this->input->post('pnumero9'),
          'idposicion' => $this->input->post('numero9'),
          'idusuario' => $this->session->user_id,
          'fecharegistro' => date('Y-m-d H:i:s')
       );

       $this->posicionbodega->addPartePosicionBodega($data);
      }
      if ($this->input->post('numero10')) {
        $data = array(
          'iddetalleparte' => $this->input->post('iddetalleparte'),
            'numero'=> $this->input->post('pnumero10'),
          'idposicion' => $this->input->post('numero10'),
          'idusuario' => $this->session->user_id,
          'fecharegistro' => date('Y-m-d H:i:s')
       );

       $this->posicionbodega->addPartePosicionBodega($data);
      }
      if ($this->input->post('numero11')) {
        $data = array(
          'iddetalleparte' => $this->input->post('iddetalleparte'),
            'numero'=> $this->input->post('pnumero11'),
          'idposicion' => $this->input->post('numero11'),
          'idusuario' => $this->session->user_id,
          'fecharegistro' => date('Y-m-d H:i:s')
       );

       $this->posicionbodega->addPartePosicionBodega($data);
      }
      if ($this->input->post('numero12')) {
        $data = array(
          'iddetalleparte' => $this->input->post('iddetalleparte'),
            'numero'=> $this->input->post('pnumero12'),
          'idposicion' => $this->input->post('numero12'),
          'idusuario' => $this->session->user_id,
          'fecharegistro' => date('Y-m-d H:i:s')
       );

       $this->posicionbodega->addPartePosicionBodega($data);
      }
      if ($this->input->post('numero13')) {
        $data = array(
          'iddetalleparte' => $this->input->post('iddetalleparte'),
            'numero'=> $this->input->post('pnumero13'),
          'idposicion' => $this->input->post('numero13'),
          'idusuario' => $this->session->user_id,
          'fecharegistro' => date('Y-m-d H:i:s')
       );

       $this->posicionbodega->addPartePosicionBodega($data);
      }
      if ($this->input->post('numero14')) {
        $data = array(
          'iddetalleparte' => $this->input->post('iddetalleparte'),
            'numero'=> $this->input->post('pnumero14'),
          'idposicion' => $this->input->post('numero14'),
          'idusuario' => $this->session->user_id,
          'fecharegistro' => date('Y-m-d H:i:s')
       );

       $this->posicionbodega->addPartePosicionBodega($data);
      }
      if ($this->input->post('numero15')) {
        $data = array(
          'iddetalleparte' => $this->input->post('iddetalleparte'),
            'numero'=> $this->input->post('pnumero15'),
          'idposicion' => $this->input->post('numero15'),
          'idusuario' => $this->session->user_id,
          'fecharegistro' => date('Y-m-d H:i:s')
       );

       $this->posicionbodega->addPartePosicionBodega($data);
      }
      if ($this->input->post('numero16')) {
        $data = array(
          'iddetalleparte' => $this->input->post('iddetalleparte'),
            'numero'=> $this->input->post('pnumero16'),
          'idposicion' => $this->input->post('numero16'),
          'idusuario' => $this->session->user_id,
          'fecharegistro' => date('Y-m-d H:i:s')
       );

       $this->posicionbodega->addPartePosicionBodega($data);
     }  if ($this->input->post('numero17')) {
          $data = array(
            'iddetalleparte' => $this->input->post('iddetalleparte'),
              'numero'=> $this->input->post('pnumero17'),
            'idposicion' => $this->input->post('numero17'),
            'idusuario' => $this->session->user_id,
            'fecharegistro' => date('Y-m-d H:i:s')
         );

         $this->posicionbodega->addPartePosicionBodega($data);
       }  if ($this->input->post('numero18')) {
            $data = array(
              'iddetalleparte' => $this->input->post('iddetalleparte'),
                'numero'=> $this->input->post('pnumero18'),
              'idposicion' => $this->input->post('numero18'),
              'idusuario' => $this->session->user_id,
              'fecharegistro' => date('Y-m-d H:i:s')
           );

           $this->posicionbodega->addPartePosicionBodega($data);
         }  if ($this->input->post('numero19')) {
              $data = array(
                'iddetalleparte' => $this->input->post('iddetalleparte'),
                  'numero'=> $this->input->post('pnumero19'),
                'idposicion' => $this->input->post('numero19'),
                'idusuario' => $this->session->user_id,
                'fecharegistro' => date('Y-m-d H:i:s')
             );

             $this->posicionbodega->addPartePosicionBodega($data);
            }
            if ($this->input->post('numero20')) {
                 $data = array(
                   'iddetalleparte' => $this->input->post('iddetalleparte'),
                     'numero'=> $this->input->post('pnumero20'),
                   'idposicion' => $this->input->post('numero20'),
                   'idusuario' => $this->session->user_id,
                   'fecharegistro' => date('Y-m-d H:i:s')
                );

                $this->posicionbodega->addPartePosicionBodega($data);
               }

               $datadetalleparte = $this->parte->detalleDelDetallaParte($iddetalleparte);
               if($datadetalleparte->idestatus != 8){
               $idoperador= $datadetalleparte->idoperador;
               $dataactualizar = array(
                 'idestatus' => 8,
                 'idusuario' => $this->session->user_id,
                 'fecharegistro' => date('Y-m-d H:i:s')
               );
                 $this->parte->updateDetalleParte($iddetalleparte,$dataactualizar);

               $dataupdateestatus=array(
                 'iddetalleparte'=>$iddetalleparte,
                 'idstatus'=>5,
                 'idoperador'=>$idoperador,
                 'idusuario' => $this->session->user_id,
                 'fecharegistro' => date('Y-m-d H:i:s')
               );
                 $this->parte->addDetalleEstatusParte($dataupdateestatus);
                 }
                  redirect('bodega/');
    }
}
?>
