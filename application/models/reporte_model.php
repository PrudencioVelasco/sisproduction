<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reporte_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
    public function __destruct()
    {
        $this->db->close();
    }
    public function allTransferenciaPacking($fechainicio,$fechafin)
    {
        $query =$this->db->query('SELECT * FROM viewprocesopallet
                                WHERE (CONVERT(fecha, DATE) BETWEEN "'.$fechainicio.'" AND "'.$fechafin.'")
                                AND idestatus IN (1,2,3,8)');
         return $query->result();
    }
     public function allTransferenciaCalidad($fechainicio,$fechafin)
    {
        $query =$this->db->query('SELECT * FROM viewprocesopallet
                                WHERE (CONVERT(fecha, DATE) BETWEEN "'.$fechainicio.'" AND "'.$fechafin.'")
                                AND idestatus IN (4,5,6,8)');
         return $query->result();
    }
     public function allTransferenciaBodega($fechainicio,$fechafin)
    {
        $query =$this->db->query('SELECT * FROM viewprocesopallet
                                WHERE (CONVERT(fecha, DATE) BETWEEN "'.$fechainicio.'" AND "'.$fechafin.'")
                                AND idestatus IN (4,8)');
         return $query->result();
    }
    

}
