<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Calidad extends CI_Controller {
    
    function __construct()
    {
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
    }
    
    public function index()
    {
        // Permission::grant(uri_string());
        $this->load->view('header');
        $this->load->view('calidad/index');
        $this->load->view('footer');
    }
    
    
    // Informacion de la parte recibida por id en Modulo[Calidad]
    public function detalleenvio($iddetalle)
    {
        $usuariosbodega = $this->calidad->allUsersBodega();
        $detalledeldetalleparte=$this->calidad->detalleDelDetallaParte($iddetalle);
        
        $data=array(
            'iddetalle'=>$iddetalle,
            'detalle'=>$detalledeldetalleparte,
            'usuariosbodega'=>$usuariosbodega
        );
        
        $this->load->view('header');
        $this->load->view('calidad/detalle_recibido',$data);
        $this->load->view('footer');
    }
    
    // Informacion de la parte recibida por id en Modulo[Calidad]
    public function enviadosBodega()
    {    
        $this->load->view('header');
        $this->load->view('calidad/enviados');
        $this->load->view('footer');
    }    
    
    // Enviar informacion de la parte al siguiente Modulo[Bodega]
    public function enviarBodega()
    {
        $usuariosbodega = $this->input->post('usuariobodega');
        $idoperador = $this->input->post('idoperador');
        $iddetalleparte = $this->input->post('iddetalleparte');
        
        //echo json_encode( array('bodega' => $usuariosbodega,'idoperador' => $idoperador,'iddetalle' => $iddetalleparte ));
        $data = array(
            'idestatus' => 4,
            'idoperador' => $usuariosbodega,
            'idusuario' => $this->session->user_id,
            'fecharegistro' => date('Y-m-d H:i:s')
        );
        // Actualizar la informacion de la tabla [idoperador][idstatus]
        $actualizacionParte = $this->calidad->updateDetalleParte($iddetalleparte,$data);

        if($actualizacionParte){

            $datastatus1 = array(
                'iddetalleparte' => $iddetalleparte,
                'idstatus' => 4,
                'idoperador' => $usuariosbodega,
                'idusuario' => $this->session->user_id,
                'fecharegistro' => date('Y-m-d H:i:s')
            );
    
            //Agregar la informacion a la tabla detalle status[Historial]
            $agregarEnvioBodega = $this->calidad->addDetalleEstatusParte($datastatus1);
            
            if($agregarEnvioBodega){

                $datastatus2 = array(
                    'iddetalleparte' => $iddetalleparte,
                    'idstatus' => 2,
                    'idoperador' => $idoperador,
                    'idusuario' => $this->session->user_id,
                    'fecharegistro' => date('Y-m-d H:i:s')
                );
        
                //Agregar la informacion de finalizacion del proceso anterior a la tabla detalle statu[Historial]
                $finalizarProceso = $this->calidad->addDetalleEstatusParte($datastatus2);

                if($finalizarProceso){
                    echo json_encode("ok");
                }
            }
        }

    }

    // Mostrar todas las partes enviados de Modulo[Packing]
    public function showAllEnviados()
    {
        //Permission::grant(uri_string());
        //Parametro 7 Indica el estatus enviado a bodega
        $query = $this->calidad->showAllEnviados($this->session->user_id);
        if ($query) {
            $result['detallestatus'] = $this->calidad->showAllEnviados($this->session->user_id);
        }
        echo json_encode($result);
    }

    // Mostrar todas las partes enviados de Modulo[Packing]
    public function getAllEnviados()
    {
        //Permission::grant(uri_string());
        //Parametro 7 Indica el estatus enviado a bodega
        $query = $this->calidad->showAllEnviados($this->session->user_id,4);
        if ($query) {
            $result['detallestatus'] = $this->calidad->showAllEnviados($this->session->user_id,4);
        }
        echo json_encode($result);
    }

    public function searchParte()
    {
        //Permission::grant(uri_string());
        $value = $this->input->post('text');
        $query = $this->calidad->searchPartes($value,$this->session->user_id);
        if ($query) {
            $result['detallestatus'] = $query;
        }
        echo json_encode($result);
    }

    public function getSearchPart()
    {
        //Permission::grant(uri_string());
        $value = $this->input->post('text');
        //Parametro 7 Indica el estatus enviado a bodega
        $query = $this->calidad->searchPartes($value,$this->session->user_id,4);
        if ($query) {
            $result['detallestatus'] = $query;
        }
        echo json_encode($result);
    }    

    public function rechazarParte()
    {
        $idoperador = $this->input->post('idoperador');
        $iddetalleparte = $this->input->post('iddetalleparte');
        $comentario = $this->input->post('comentario');

        $data = array(
            'idestatus' => 3,
            'idusuario' => $this->session->user_id,
            'fecharegistro' => date('Y-m-d H:i:s')
        );
        // Actualizar la informacion de la tabla [idoperador][idstatus]
        $actualizacionParte = $this->calidad->updateDetalleParte($iddetalleparte,$data);
        if($actualizacionParte){
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
            
            if($resultado){
                echo json_encode("ok");
            }
        }

    }
}
?>
