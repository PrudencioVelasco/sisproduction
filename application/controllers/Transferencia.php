<?php defined('BASEPATH') OR exit('No direct script access allowed');

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
        $this->load->model('transferencia_model', 'transferencia');
        $this->load->model('revision_model', 'revision');
        $this->load->model('modelo_model', 'modelo');
        //$this->load->library('permission');
    }

    public function index() {
        //Permission::grant(uri_string());
        $this->load->view('header');
        $this->load->view('transferencia/index');
        $this->load->view('footer');
    }

    public function showAll()
    { 
        $query = $this->transferencia->showAll();
        if ($query) {
            $result['transferencias'] = $this->transferencia->showAll();
        }
        echo json_encode($result);
    }
     
     public function detalle($id)
     {
         # code...
        $datalinea =$this->linea->showAllLinea();
        $data = array(
            'id' =>$id,
            'datalinea'=>$datalinea);
        $this->load->view('header');
        $this->load->view('transferencia/detalle',$data);
        $this->load->view('footer');
     }
     public function validar() {
         $option="";
         $numrtoparte = $this->input->post('numeroparte');
         $datavali = $this->transferencia->validarExistenciaNumeroParte($numrtoparte);
        if ($datavali != FALSE) {
            $datavalista = $this->transferencia->listaClientexNumeroParte($numrtoparte);
            foreach ($datavalista as $value) {
                  $option.="<option value='".$value->idparte."'>".$value->nombre."</option>";
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

}
?>
