<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Return_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function __destruct()
    {
        $this->db->close();
    }

    public function addDetalleTransferencia($data) {
        $this->db->insert('tbldetalle_transferencia', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

     public function deletePartePosicion($id)
    {
        $this->db->where('idpalletcajas', $id);
        $this->db->where('ordensalida', 0);
        $this->db->where('salida', 0);
        $this->db->delete('parteposicionbodega');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
        
    }
      public function deletePalletCaja($id)
    {
        $this->db->where('idpalletcajas', $id);
        $this->db->delete('palletcajas');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
        
    }
     public function deleteDetalleTransferencia($id)
    {
        $this->db->where('idpalletcajas', $id);
        $this->db->delete('tbldetalle_transferencia');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
        
    }

        public function listaNumeroParteTransferencia($idtransferencia) {
        $this->db->select('pc.idpalletcajas, c.nombre,p.numeroparte,tc.cantidad, tr.descripcion, s.nombrestatus, pc.idestatus');
        $this->db->from('palletcajas pc');
        $this->db->join('tblcantidad  tc', 'tc.idcantidad = pc.idcajas');
        $this->db->join('tblrevision  tr', 'tr.idrevision = tc.idrevision');
        $this->db->join('tblmodelo  tm', 'tm.idmodelo = tr.idmodelo');
        $this->db->join('parte  p', 'tm.idparte = p.idparte');
        $this->db->join('cliente  c', 'c.idcliente = p.idcliente');
        $this->db->join('status  s', 's.idestatus = pc.idestatus');
        $this->db->join('tbldetalle_transferencia  dt', 'dt.idpalletcajas = pc.idpalletcajas');
        $this->db->where('pc.idtransferancia', $idtransferencia);
        $this->db->where('pc.idestatus !=', 17);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }




}
