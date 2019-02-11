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
        $query =$this->db->query('select  c.nombre,p.numeroparte,
        (select  sum(dp.pallet) totalpallet from  detalleparte dp
        where  dp.idestatus = 8 and dp.idparte = p.idparte)  as totalpallet,
        (select  sum(dp.cantidad) totalpallet from  detalleparte dp
        where  dp.idestatus = 8 and dp.idparte = p.idparte)  as totalcajas
        from parte p, cliente c 
        where p.idcliente = c.idcliente');
        return $query->result();
    }
 

}
