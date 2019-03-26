<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class PalletCajas_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function __destruct() {
        $this->db->close();
    }

    public function showAllId($id) {
        $query =$this->db->query("SELECT pc.idpalletcajas,
       pc.pallet,
       pc.cajas,
       s.nombrestatus,
       s.idestatus,
       (SELECT pb.nombreposicion
        FROM   parteposicionbodega ppb,
               posicionbodega pb
        WHERE  ppb.idposicion = pb.idposicion
               AND ppb.idpalletcajas = pc.idpalletcajas) AS posicion,
		(SELECT ppb2.ordensalida FROM parteposicionbodega ppb2 
		WHERE ppb2.idpalletcajas = pc.idpalletcajas) orden,
        (SELECT ppb3.salida FROM parteposicionbodega ppb3
		WHERE ppb3.idpalletcajas = pc.idpalletcajas) salida
FROM   detalleparte dp,
       palletcajas pc,
       status s
WHERE  dp.iddetalleparte = pc.iddetalleparte
       AND pc.idestatus = s.idestatus
       AND dp.iddetalleparte = '$id'");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
      public function addPalletCajas($data)
    {
        return $this->db->insert('palletcajas', $data);
    }
      public function eliminarPalletCajas($id)
    {
        $this->db->where('idpalletcajas', $id);
        $this->db->delete('palletcajas');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
        
    }
     public function updatePalletCajas($id, $data)
    {
        $this->db->where('idpalletcajas', $id);
        $this->db->update('palletcajas', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

}
