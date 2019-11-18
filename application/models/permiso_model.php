<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permiso_model extends CI_Model {

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
        $query = $this->db->get('permissions');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
     public function addPermiso($data)
    {
        return $this->db->insert('permissions', $data);
    }  
     public function updatePermiso($id, $field)
    {
        $this->db->where('id', $id);
        $this->db->update('permissions', $field);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
        
    }
   
      public function searchPermiso($match)
    {
        $field = array(
            'uri',
            'description'
        );
        $this->db->like('concat(' . implode(',', $field) . ')', $match);
        $query = $this->db->get('permissions');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
  }
