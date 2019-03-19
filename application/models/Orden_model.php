<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Orden_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function __destruct() {
        $this->db->close();
    }

    public function showAllSalidas() {
        $this->db->select('s.idsalida,s.numerosalida,c.nombre,s.orden,u.name,s.fecharegistro');
        $this->db->from('salida s');
        $this->db->join('cliente c', 's.idcliente=c.idcliente');
        $this->db->join('users u', 's.idusuario=u.id');
        $this->db->where('s.finalizado',1);
        $this->db->order_by("s.fecharegistro", "desc");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
      public function detalleSalida($idsalida) {
        // code...
        $this->db->select('s.idsalida,s.numerosalida,s.finalizado,c.nombre,u.name,s.fecharegistro');
        $this->db->from('salida s');
        $this->db->join('cliente c', 's.idcliente=c.idcliente');
        $this->db->join('users u', 's.idusuario=u.id');
        $this->db->where('s.idsalida', $idsalida);
        $query = $this->db->get();

        return $query->first_row();
    }
    
      public function detallesDeOrden($idsalida) {
        // code...
        $this->db->select('pc.idpalletcajas, o.idordensalida,s.idsalida, p.numeroparte,o.tipo, o.pallet,o.caja, pc.cajas as cajaspallet, dp.modelo,dp.revision,pb.nombreposicion');
        $this->db->from('salida s');
        $this->db->join('ordensalida o', 's.idsalida=o.idsalida');
        $this->db->join('palletcajas pc', 'o.idpalletcajas=pc.idpalletcajas');
        $this->db->join('detalleparte dp', 'dp.iddetalleparte=pc.iddetalleparte');
        $this->db->join('parte p', 'p.idparte=dp.idparte');
        $this->db->join('users u', 'o.idusuario=u.id');
        $this->db->join('parteposicionbodega as ppb','pc.idpalletcajas = ppb.idpalletcajas');
        $this->db->join('posicionbodega as pb','pb.idposicion = ppb.idposicion');
        $this->db->where('s.idsalida', $idsalida);
        //$this->db->where('pd.idestatus', 8);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

}