<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Salida_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function __destruct() {
        $this->db->close();
    }

    public function showAllSalidas() {
        $this->db->select('s.idsalida,s.numerosalida,c.nombre,s.finalizado,u.name,s.fecharegistro');
        $this->db->from('salida s');
        $this->db->join('cliente c', 's.idcliente=c.idcliente');
        $this->db->join('users u', 's.idusuario=u.id');
        $this->db->order_by("s.fecharegistro", "desc");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function showPartesBodega() {
        $this->db->select('p.numeroparte,dp.folio,dp.iddetalleparte, dp.revision, dp.modelo');
        $this->db->from('parte p');
        $this->db->join('detalleparte dp', 'dp.idparte=p.idparte');
        $this->db->where('dp.idestatus', 8); 
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function detallesDeOrden($idsalida) {
        // code...
        $this->db->select('o.idordensalida, p.numeroparte,o.pallet,o.caja,o.revision');
        $this->db->from('salida s');
        $this->db->join('ordensalida o', 's.idsalida=o.idsalida');
        $this->db->join('parte p', 'p.idparte=o.idparte');
        $this->db->join('users u', 'o.idusuario=u.id');
        $this->db->where('s.idsalida', $idsalida);
        //$this->db->where('pd.idestatus', 8);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function addSalida($data) {
          $this->db->insert('salida', $data);
        return $this->db->insert_id();
    }

    public function addOrdenSalida($data) {
        return $this->db->insert('ordensalida', $data);
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

    public function validarExistenciaNumeroParte($numeroparte) {
        // code...
        $this->db->select('p.idparte,p.numeroparte,dp.modelo, dp.revision,dp.pallet, dp.cantidad, dp.linea');
        $this->db->from('detalleparte dp');
        $this->db->join('parte p', 'dp.idparte=p.idparte');
        $this->db->where('p.numeroparte', $numeroparte);
        $this->db->where('dp.idestatus', 8);
        $query = $this->db->get();
        return $query->first_row();
    }

    public function posicionPalletBodega($iddetalleparte) {
        // code...
        $this->db->select('pb.numero,p.nombreposicion');
        $this->db->from('parteposicionbodega pb');
        $this->db->join('posicionbodega p', 'pb.idposicion=p.idposicion');
        $this->db->where('pb.iddetalleparte', $iddetalleparte);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
     public function eliminarParteOrden($id)
    {
        $this->db->where('idordensalida',$id);
        return $this->db->delete('ordensalida');
    }
    public function updateSalida($id, $field)
    {
        $this->db->where('idsalida', $id);
        $this->db->update('salida', $field);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }

    }
}
