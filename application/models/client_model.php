<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client_model extends CI_Model {

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
        $query = $this->db->get('cliente');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
      public function showAllClientes()
    {
        $query = $this->db->get('cliente');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
       public function validadIdCliente($idcliente)
    {
        $this->db->select('c.*');
        $this->db->from('cliente c'); 
        $this->db->where('c.idcliente', $idcliente);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
       public function validadExistenciaRFCUpdate($rfc,$idcliente) {
        $this->db->select('c.*');
        $this->db->from('cliente c'); 
        $this->db->where('TRIM(c.rfc)', $rfc); 
         $this->db->where('c.idcliente !=', $idcliente);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

       public function validarRFCCliente($nombre)
    {
        $this->db->select('c.*');
        $this->db->from('cliente c'); 
        $this->db->where('trim(c.rfc)', $nombre);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    public function detalleCliente($idcliente) {
        // code...
        $this->db->select('c.*');
        $this->db->from('cliente c'); 
        $this->db->where('c.idcliente', $idcliente);
        $query = $this->db->get();

        return $query->first_row();
    }

       public function showAllClientesContar()
    {
        $query = $this->db->get('cliente'); 
        return $query->result();
        
    }
     public function showAllClientesActivos()
    {
        # code...
        $this->db->select('c.*');    
        $this->db->from('cliente c'); 
        $this->db->where('c.activo', 1);
        $query = $this->db->get();
        //$query = $this->db->get('permissions');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
      
     public function addClient($data)
    {
        return $this->db->insert('cliente', $data);
    }  
     public function updateClient($id, $field)
    {
        $this->db->where('idcliente', $id);
        $this->db->update('cliente', $field);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
        
    }
   
      public function searchClient($match)
    {
        $field = array(
            'nombre'
        );
        $this->db->like('concat(' . implode(',', $field) . ')', $match);
        $query = $this->db->get('cliente');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    
}
