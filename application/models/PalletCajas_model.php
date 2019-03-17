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
        $this->db->select('pc.idpalletcajas,pc.pallet,pc.cajas,es.nombrestatus, es.idestatus');
        $this->db->from('palletcajas pc');
        $this->db->join('detalleparte dp', 'dp.iddetalleparte=pc.iddetalleparte');
        $this->db->join('status es', 'pc.idestatus=es.idestatus');
        $this->db->where('pc.iddetalleparte',$id);
        $query = $this->db->get();
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
