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
}
?>
