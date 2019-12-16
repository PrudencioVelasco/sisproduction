<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hold_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function __destruct() {
        $this->db->close();
    }

    public function selectCantidades($id)
    {

        $this->db->select('tc.*');
        $this->db->from('palletcajas pc');
        $this->db->join('tblcantidad tc ',' pc.idcajas = tc.idcantidad');
        $this->db->join('tblrevision tr ',' tc.idrevision = tr.idrevision');
        $this->db->where('pc.idpalletcajas',$id);
        $query = $this->db->get();
          return $query->first_row();
    }
     public function listaCantidades($idpalletcajas,$cantidad)
    {
        # code...
    $query = $this->db->query("SELECT ca.* FROM tblcantidad ca WHERE ca.idrevision in (
                                SELECT r.idrevision FROM tblrevision r, tblcantidad c, palletcajas pc
                                    WHERE pc.idcajas = c.idcantidad
                                    AND c.idrevision =r.idrevision
                                   
                                    AND pc.idpalletcajas = $idpalletcajas)
                                 AND ca.cantidad <= $cantidad
                                    "); 
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function listaNumeroParteTransferencia() {
        $this->db->select('pc.idpalletcajas,pc.idtransferancia,ttran.folio,c.nombre,p.numeroparte,tc.cantidad, tr.descripcion, s.nombrestatus, pc.idestatus');
        $this->db->from('palletcajas pc');
        $this->db->join('tbltransferencia  ttran', 'ttran.idtransferancia = pc.idtransferancia');
        $this->db->join('tblcantidad  tc', 'tc.idcantidad = pc.idcajas');
        $this->db->join('tblrevision  tr', 'tr.idrevision = tc.idrevision');
        $this->db->join('tblmodelo  tm', 'tm.idmodelo = tr.idmodelo');
        $this->db->join('parte  p', 'tm.idparte = p.idparte');
        $this->db->join('cliente  c', 'c.idcliente = p.idcliente');
        $this->db->join('status  s', 's.idestatus = pc.idestatus');
        $this->db->where('pc.idestatus', 12);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }


    public function validadCantidadCajas($cantidad,$idrevision)
    {
        # code...
    }

    public function detalleParteTransferencia($id) {
        $this->db->select('pc.idpalletcajas,pc.idtransferancia,pc.pallet,pc.idcajas,pc.idestatus, p.idparte,c.nombre,p.numeroparte,tc.cantidad,tr.idrevision, tr.descripcion, s.nombrestatus, pc.idestatus');
        $this->db->from('palletcajas pc');
        $this->db->join('tblcantidad  tc', 'tc.idcantidad = pc.idcajas');
        $this->db->join('tblrevision  tr', 'tr.idrevision = tc.idrevision');
        $this->db->join('tblmodelo  tm', 'tm.idmodelo = tr.idmodelo');
        $this->db->join('parte  p', 'tm.idparte = p.idparte');
        $this->db->join('cliente  c', 'c.idcliente = p.idcliente');
        $this->db->join('status  s', 's.idestatus = pc.idestatus');
        $this->db->where('pc.idpalletcajas', $id);
        $this->db->where('pc.idestatus', 12);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function updateSendQuality($id, $data) {
        $this->db->where('idpalletcajas', $id);
        $this->db->update('palletcajas', $data);

        return $this->db->affected_rows() > 0 ? TRUE : FALSE; 
    }

    public function saveDataTblTrash($data) {
        $this->db->insert('tbltrash', $data);
        return $this->db->affected_rows() > 0 ? TRUE : FALSE; 
    }

    public function updatePallet($id,$data){
        $this->db->where('idpalletcajas', $id);
        $this->db->update('palletcajas', $data);
        return $this->db->affected_rows() > 0 ? TRUE : FALSE; 
    }
}