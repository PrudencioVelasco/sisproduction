<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Transferencia_model extends CI_Model {
    
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
        $this->db->select('t.idtransferancia, u.name as nombre, t.folio, t.fecharegistro');    
        $this->db->from('users u');
        $this->db->join('transferencia  t', 't.idusuario = u.id');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function addUser($data)
    {
        $this->db->insert('users', $data);
        $insert_id = $this->db->insert_id(); 
        return  $insert_id;
    }
    
    
    public function updateUser($id, $field)
    {
        $this->db->where('id', $id);
        $this->db->update('users', $field);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
        
    }
 
}