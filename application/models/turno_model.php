<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Turno_model extends CI_Model
{
    
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
        $this->db->select('t.*');
        $this->db->from('turno t');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
     public function showAllNextDay()
    {
        $this->db->select('t.*');
        $this->db->from('turno t');
        $this->db->where('t.siguientedia',1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    
         public function showAllArray()
    {
        $this->db->select('t.*');
        $this->db->from('turno t');
        $query = $this->db->get(); 
        return  $query->result();
         
    }
      public function obtenerTurnoId($idturno)
    {
        # code...
        $this->db->select('t.nombreturno, t.horainicial, t.horafinal, t.siguientedia');    
        $this->db->from('turno t');
         $this->db->where('t.idturno', $idturno);
        $query = $this->db->get(); 
         return $query->first_row();
    }
    public function obtenerTurno($hora)
    {
        $this->db->select('t.*');
        $this->db->from('turno t'); 
        $this->db->where("'".$hora."' BETWEEN t.horainicial AND  t.horafinal");
        $query = $this->db->get(); 
        return $query->first_row();
        
    }
    public function addTurno($data)
    {
        return $this->db->insert('turno', $data);
    }
    public function updateTurno($id, $field)
    {
        $this->db->where('idturno', $id);
        $this->db->update('turno', $field);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
        
    }
         public function obtenerTurnoDiaSiguiente($hora)
    {
        $this->db->select('t.*');
        $this->db->from('turno t'); 
        $this->db->where('t.horainicial <=',$hora);
        $this->db->where('t.siguientedia', 1);
         $this->db->where('t.activo', 1);
        $query = $this->db->get(); 
        return $query->first_row();
        
    }
    public function searchTurno($match)
    {
        $field = array(
            'nombreturno',
            'horainicial',
            'horafinal'
        );
        $this->db->like('concat(' . implode(',', $field) . ')', $match);
        $query = $this->db->get('turno');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
}
