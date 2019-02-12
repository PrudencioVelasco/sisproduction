<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Inventario_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function __destruct()
    {
        $this->db->close();
    }

    public function showAll()
    {
        $query =$this->db->query('SELECT c.nombre,
                                        p.numeroparte,
                                        (SELECT COALESCE(Sum(dp.pallet), 0) totalpallet
                                         FROM   detalleparte dp
                                         WHERE  dp.idestatus = 8
                                                AND dp.idparte = p.idparte) AS totalpallet,
                                        (SELECT COALESCE(Sum(dp.cantidad), 0) totalpallet
                                         FROM   detalleparte dp
                                         WHERE  dp.idestatus = 8
                                                AND dp.idparte = p.idparte) AS totalcajas
                                 FROM   parte p,
                                        cliente c
                                 WHERE  p.idcliente = c.idcliente');
        return $query->result();
    }
 

}
