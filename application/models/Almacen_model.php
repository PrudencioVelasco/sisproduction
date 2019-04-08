<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Almacen_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function __destruct()
    {
        $this->db->close();
    }

    public function getAllPallets()
    {
        $query =$this->db->query("SELECT 
        p.idparte, 
        c.nombre AS nombrecliente, 
        p.numeroparte, 
        (SELECT SUM(pc.pallet) FROM palletcajas pc WHERE pc.iddetalleparte = dp.iddetalleparte AND pc.idestatus = 8) AS totalpallet, 
        (SELECT SUM(pc1.cajas) FROM palletcajas pc1 WHERE pc1.iddetalleparte = dp.iddetalleparte AND pc1.idestatus = 8) AS totalcajas 
        FROM parte p 
        INNER JOIN detalleparte dp ON p.idparte = dp.idparte 
        INNER JOIN cliente c ON c.idcliente = p.idcliente");

        return ($query->num_rows() > 0) ? $query->result() : FALSE;
    
    }

    public function search($text)
    {
        $query =$this->db->query("SELECT 
        p.idparte, 
        c.nombre AS nombrecliente, 
        p.numeroparte, 
        (SELECT SUM(pc.pallet) FROM palletcajas pc WHERE pc.iddetalleparte = dp.iddetalleparte AND pc.idestatus = 8) AS totalpallet, 
        (SELECT SUM(pc1.cajas) FROM palletcajas pc1 WHERE pc1.iddetalleparte = dp.iddetalleparte AND pc1.idestatus = 8) AS totalcajas 
        FROM parte p 
        INNER JOIN detalleparte dp ON p.idparte = dp.idparte 
        INNER JOIN cliente c ON c.idcliente = p.idcliente
        WHERE p.numeroparte LIKE '%$text%' OR c.nombre LIKE '%$text%'");

        return ($query->num_rows() > 0) ? $query->result() : FALSE;
    
    }

    public function detallepallet($idparte)
    {
        $query = $this->db->query("SELECT
        parte.idparte,
        parte.numeroparte,
        detalleparte.folio,
        detalleparte.modelo,
        palletcajas.pallet,
        palletcajas.cajas,
        palletcajas.idestatus,
        posicionbodega.nombreposicion
        FROM parte AS parte
        INNER JOIN detalleparte AS detalleparte ON parte.idparte = detalleparte.idparte
        INNER JOIN palletcajas AS palletcajas ON detalleparte.iddetalleparte = palletcajas.iddetalleparte 
        INNER JOIN parteposicionbodega AS partposbodega ON palletcajas.idpalletcajas = partposbodega.idpalletcajas 
        INNER JOIN posicionbodega AS posicionbodega ON partposbodega.idposicion = posicionbodega.idposicion 
        WHERE parte.idparte = '$idparte' AND palletcajas.idestatus = 8");

        return ($query->num_rows() > 0) ? $query->result() : FALSE;
    } 
}