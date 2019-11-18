<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Linea_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function __destruct() {
        $this->db->close();
    }

    public function showAllLinea() {
        $this->db->select('l.idlinea, l.nombrelinea');
        $this->db->from('linea l'); 
         $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
        public function searchLinea($match) {
        $field = array(
                 'l.nombrelinea',
        );
         $this->db->select('l.idlinea, l.nombrelinea');
        $this->db->from('linea l'); 
        $this->db->like('concat(' . implode(',', $field) . ')', $match);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
   
     public function addLinea($data)
    {
        $this->db->insert('linea', $data);
        $insert_id = $this->db->insert_id(); 
        return  $insert_id;
    }
    
    
    public function updateLinea($id, $field)
    {
        $this->db->where('idlinea', $id);
        $this->db->update('linea', $field);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
        
    }

       public function validadExistenciaNombreLinea($nombrelinea) {
        $this->db->select('l.idlinea, l.nombrelinea');
        $this->db->from('linea l'); 
        $this->db->where('l.nombrelinea', $modelo); 
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
       public function validadExistenciaLineaUpdate($idlinea,$nombrelinea) {
        $this->db->select('l.idlinea, l.nombrelinea');
        $this->db->from('linea l'); 
        $this->db->where('l.nombrelinea', $nombrelinea); 
         $this->db->where('l.idlinea !=', $idlinea);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

}
