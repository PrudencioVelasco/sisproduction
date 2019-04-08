<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Almacen extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!isset($_SESSION['user_id'])) {
            $this->session->set_flashdata('flash_data', 'You don\'t have access! ss');
            return redirect('login');
        }
        $this->load->helper('url');
        $this->load->model('almacen_model', 'almacen');
        //$this->load->library('permission');
    }

    public function index() {
        //Permission::grant(uri_string());
        $this->load->view('header');
        $this->load->view('almacen/index');
        $this->load->view('footer');
    }

    public function getAllPallets() {
        //Permission::grant(uri_string());

        $query = $this->almacen->getAllPallets();
        if ($query) {
            $result['detallestatus'] = $this->almacen->getAllPallets();
        }
        echo json_encode($result);
    }

    public function search() {
        //Permission::grant(uri_string());
        $value = $this->input->post('text');
        $query = $this->almacen->search($value);
        if ($query) {
            $result['detallestatus'] = $query;
        }
        echo json_encode($result);
    }

    public function detallepallet($idpallet) {
        //Permission::grant(uri_string());
    
        $data['information'] = $this->almacen->detallepallet($idpallet);
    
        $this->load->view('header');
        $this->load->view('almacen/detalle_pallet', $data);
        $this->load->view('footer');
    }
}
?>
