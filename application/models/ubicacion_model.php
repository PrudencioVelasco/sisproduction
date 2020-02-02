<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ubicacion_model extends CI_Model {

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
        $query = $this->db->get('posicionbodega');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
   
     public function addUbicacion($data)
    {
        return $this->db->insert('posicionbodega', $data);
    }  
    public function validadAddNombre($nombre) {
        $this->db->select('p.*');
        $this->db->from('posicionbodega p'); 
        $this->db->where('trim(p.nombreposicion)', $nombre); 
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
      public function validadExistenciaUpdate($id,$nombre) {
        $this->db->select('p.*');
        $this->db->from('posicionbodega p'); 
        $this->db->where('trim(p.nombreposicion)', $nombre); 
         $this->db->where('p.idposicion !=', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

     public function updateUbicacion($id, $field)
    {
        $this->db->where('idposicion', $id);
        $this->db->update('posicionbodega', $field);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
        
    }
   
      public function searchUbicacion($match)
    {
        $field = array(
            'nombreposicion'
        );
        $this->db->like('concat(' . implode(',', $field) . ')', $match);
        $query = $this->db->get('posicionbodega');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    
}
