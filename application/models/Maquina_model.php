<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Maquina_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function __destruct() {
        $this->db->close();
    }

    public function showAllMaquina() {
        $this->db->select('m.idmaquina, m.nombremaquina, m.activo');
        $this->db->from('tblmaquina m'); 
         $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
        public function searchMaquina($match) {
        $field = array(
                 'm.nombremaquina',
        );
        $this->db->select('m.idmaquina, m.nombremaquina, m.activo');
        $this->db->from('tblmaquina m');
        $this->db->like('concat(' . implode(',', $field) . ')', $match);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
   
     public function addMaquina($data)
    {
        $this->db->insert('tblmaquina', $data);
        $insert_id = $this->db->insert_id(); 
        return  $insert_id;
    }
    
    
    public function updateMaquina($id, $field)
    {
        $this->db->where('idmaquina', $id);
        $this->db->update('tblmaquina', $field);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
        
    }

       public function validadExistenciaNombreMaquina($nombremaquina) {
        $this->db->select('m.idmaquina, m.nombremaquina, m.activo');
        $this->db->from('tblmaquina m');
        $this->db->where('m.nombremaquina', $nombremaquina); 
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
       public function validadExistenciaMaquinaUpdate($idmaquina,$nombremaquina) {
        $this->db->select('m.idmaquina, m.nombremaquina, m.activo');
        $this->db->from('tblmaquina m');
        $this->db->where('m.nombremaquina', $nombremaquina); 
         $this->db->where('m.idmaquina !=', $idmaquina);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

}
