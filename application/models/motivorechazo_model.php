<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Motivorechazo_model extends CI_Model {

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
        $this->db->select('mr.idmotivorechazo, mr.motivo, mr.activo, p.idproceso, p.nombreproceso');
        $this->db->from('motivorechazo mr');
        $this->db->join('proceso p', 'p.idproceso=mr.idproceso'); 
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
       public function showAllProcesos()
    {
        $query = $this->db->get('proceso');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    
     public function addMotivo($data)
    {
        return $this->db->insert('motivorechazo', $data);
    }  
     public function updateMotivo($id, $field)
    {
        $this->db->where('idmotivorechazo', $id);
        $this->db->update('motivorechazo', $field);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
        
    }
   
      public function searchMotivo($match)
    {
        $field = array(
            'mr.motivo',
            'p.nombreproceso'
        );
        $this->db->select('mr.idmotivorechazo, mr.motivo, mr.activo, p.idproceso, p.nombreproceso');
        $this->db->from('motivorechazo mr');
        $this->db->join('proceso p', 'p.idproceso=mr.idproceso'); 
        $this->db->like('concat(' . implode(',', $field) . ')', $match);
        $query = $this->db->get(); 
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    
}
