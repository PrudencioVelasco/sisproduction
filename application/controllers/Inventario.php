<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Inventario extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        if (!isset($_SESSION['user_id'])) {
            $this->session->set_flashdata('flash_data', 'You don\'t have access! ss');
            return redirect('Login');
        }
        $this->load->helper('url');
        $this->load->model('data_model');
        $this->load->model('parte_model', 'parte');
        $this->load->model('user_model', 'usuario');
        $this->load->model('inventario_model', 'inventario');
        $this->load->model('posicionbodega_model', 'posicionbodega');
        $this->load->library('permission');
        $this->load->library('session');

    }
     public function index() {
         Permission::grant(uri_string());
        $queryentradas = $this->inventario->showAllEntradas();
         $querysalidacompleta = $this->inventario->showAllSalidasCompletos();
         $querysalidaparciales = $this->inventario->showAllSalidasParciales();
        $data=array(
        'entradas'=>$queryentradas,
        'salidascompletos'=>$querysalidacompleta,
        'salidasparciales'=>$querysalidaparciales
        );
        $this->load->view('header');
        $this->load->view('inventario/index',$data);
        $this->load->view('footer');
    }

    public function showAll()
    {
        Permission::grant(uri_string());
        $query = $this->inventario->showAll();
        if ($query) {
            $result['inventarios'] = $this->inventario->showAll();
        }
        echo json_encode($result);
    }
    public function searchDate(){
        Permission::grant(uri_string());
        $date1 = date("Y-m-d", strtotime($_POST['date1']));
        $date2 = date("Y-m-d", strtotime($_POST['date2']));
        $query = $this->inventario->searchEntradasDate($date1,$date2);
        $i=1;
        $sumapallet = 0;
        $sumacajas = 0;
        if($query != false){
        foreach($query as $row){
            $sumapallet+=$row->totalpallet;
            $sumacajas+=$row->totalcajas;
            echo '<tr>';
                echo '<td>'.$i++.'</td>';
                echo '<td>'.$row->nombre.'</td>';
                echo '<td>'.$row->numeroparte.'</td>';
                echo '<td>'.number_format($row->totalpallet).'</td>';
                echo '<td>'.number_format($row->totalcajas).'</td>';
            echo '</tr>';

        }
             echo '<tr>
                                           <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><strong>'.number_format($sumapallet).'</strong></td>
                                            <td><strong>'.number_format($sumacajas).'</strong></td>
                                            <td></td>
                                        </tr>';
    }else{
        echo '<tr>';
            echo '<td colspan="5"><center><h3><strong>Sin resultados</strong></h3></center></td>';
        echo '</tr>';
    }
    }

    public function searchDatePallet(){
        Permission::grant(uri_string());
        $date3 = date("Y-m-d", strtotime($_POST['date3']));
        $date4 = date("Y-m-d", strtotime($_POST['date4']));

               $query = $this->inventario->showAllDateSalidasCompletos($date3,$date4);
        $i=1;
        $sumapallet = 0;
        $sumacajas = 0;
        if($query != false){
        foreach($query as $row){
            $sumapallet+=$row->totalpallet;
            $sumacajas+=$row->totalcajas;
            echo '<tr>';
                echo '<td>'.$i++.'</td>';
                echo '<td>'.$row->nombre.'</td>';
                echo '<td>'.$row->numeroparte.'</td>';
                echo '<td>'.number_format($row->totalpallet).'</td>';
                echo '<td>'.number_format($row->totalcajas).'</td>';
            echo '</tr>';

        }
             echo '<tr>
                                           <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><strong>'.number_format($sumapallet).'</strong></td>
                                            <td><strong>'.number_format($sumacajas).'</strong></td>
                                            <td></td>
                                        </tr>';
    }else{
        echo '<tr>';
            echo '<td colspan="5"><center><h3><strong>Sin resultados</strong></h3></center></td>';
        echo '</tr>';
    }
    }

    public function searchDateParciales(){
        Permission::grant(uri_string());
        $date5 = date("Y-m-d", strtotime($_POST['date5']));
        $date6 = date("Y-m-d", strtotime($_POST['date6']));
        $query = $this->inventario->showAllDateSalidasParciales($date5,$date6);
        if($query != false){
            $i=1;
            $sumacajas = 0;
            foreach($query as $row){
            $sumacajas+=$value->totalcajas;
            echo '<tr>';
                echo '<td>'.$i++.'</td>';
                echo '<td>'.$row->nombre.'</td>';
                echo '<td>'.$row->numeroparte.'</td>';
                echo '<td>'.number_format($row->totalcajas).'</td>';
            echo '</tr>';

            }
            echo ' <tr>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td><strong>'.number_format($sumacajas).'</strong></td>
                                 <td></td>
                              </tr>';

             }else{
        echo '<tr>';
            echo '<td colspan="4"><center><h3><strong>Sin resultados</strong></h3></center></td>';
        echo '</tr>';
    }
    }

}
?>
