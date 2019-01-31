<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Salida extends CI_Controller {

    function __construct() {
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
        $this->load->model('salida_model', 'salida');
        $this->load->model('posicionbodega_model', 'posicionbodega');
        $this->load->library('permission');
    }

    public function index() {
        // Permission::grant(uri_string());
        $this->load->view('header');
        $this->load->view('salida/index');
        $this->load->view('footer');
    }

    public function showAll() {
        $query = $this->salida->showAllSalidas();
        if ($query) {
            $result['salidas'] = $this->salida->showAllSalidas();
        }
        echo json_encode($result);

        // code...
    }

    public function generarCodigo($longitud) {
        $key = '';
        $pattern = '1234567890';
        $max = strlen($pattern) - 1;
        for ($i = 0; $i < $longitud; $i++)
            $key .= $pattern{mt_rand(0, $max)};
        return $key;
    }

    public function addSalida() {
        //Permission::grant(uri_string());
        $config = array(
            array(
                'field' => 'idcliente',
                'label' => 'cliente',
                'rules' => 'trim|required',
                'errors' => array(
                    'required' => 'Campo obligatorio.'
                )
            )
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
            $result['error'] = true;
            $result['msg'] = array(
                'idcliente' => form_error('idcliente')
            );
        } else {
            $data = array(
                'numerosalida' => $this->generarCodigo(7),
                'idcliente' => $this->input->post('idcliente'),
                'idusuario' => $this->session->user_id,
                'fecharegistro' => date('Y-m-d H:i:s')
            );
            $this->salida->addSalida($data);
        }
        echo json_encode($result);
    }

    public function detalleSalida($idsalida) {
        // code...
        $datadetallesalida = $this->salida->detalleSalida($idsalida);
        $datadetalleorden = $this->salida->detallesDeOrden($idsalida);
        $data = array(
            'detallesalida' => $datadetallesalida,
            'detalleorden' => $datadetalleorden,
            'idsalida' => $idsalida);
        $this->load->view('header');
        $this->load->view('salida/detalle', $data);
        $this->load->view('footer');
    }

    public function validaranumeroparte() {
        // code...
        $numeroparte = $_POST['numeroparte'];
        //var_dump($this->salida->validarExistenciaNumeroParte($numeroparte));
        if ($this->salida->validarExistenciaNumeroParte($numeroparte) == NULL) {

            echo "0";
        } else {
            $datadetalle = $this->salida->validarExistenciaNumeroParte($numeroparte);
            echo $datadetalle->idparte;
        }
    }

    public function agregarParteOrden() {
        // code...
        $numeroparte = $_POST['numeroparte'];
        $cantidadpallet = $_POST['cantidadpallet'];
        $cantidadcaja = $_POST['cantidadcaja'];
        $revision = $_POST['revision'];
        $idsalida = $_POST['idsalida'];
        $datadetalle = $this->salida->validarExistenciaNumeroParte($numeroparte);
        $id = $datadetalle->idparte;

        $datainsert = array(
            'idsalida' => $idsalida,
            'idparte' => $id,
            'pallet' => $cantidadpallet,
            'caja' => $cantidadcaja,
            'revision' => $revision,
            'idusuario' => $this->session->user_id,
            'fecharegistro' => date('Y-m-d H:i:s'));
        $this->salida->addOrdenSalida($datainsert);
    }
    function eliminarParteOrden() {
        $idordensalida = $_POST['idordensalida'];
        $this->salida->eliminarParteOrden($idordensalida);
    }
}

?>
