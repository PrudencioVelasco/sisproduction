<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rol_model extends CI_Model {

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
        $this->db->select('r.*');
        $this->db->from('rol r');
        $this->db->order_by('r.rol ASC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        } 
    }
     public function addRol($data)
    {
        return $this->db->insert('rol', $data);
    }
     public function updateRol($id, $field)
    {
        $this->db->where('id', $id);
        $this->db->update('rol', $field);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }

    }

      public function searchRol($match)
    {
        $field = array(
            'r.rol'
        );
        $this->db->select('r.*');
        $this->db->from('rol r');
        $this->db->like('concat(' . implode(',', $field) . ')', $match);
        $this->db->order_by('r.rol ASC');
          $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
      public function rolpermisos($id)
    {
        # code...
        $this->db->select('p.id,p.uri,p.description');
        $this->db->from('permissions p');
        $this->db->join('permission_rol pr', 'p.id = pr.permission_id');
        $this->db->join('rol r', 'pr.rol_id = r.id');
        $this->db->where('r.id', $id);
        $query = $this->db->get();
        //$query = $this->db->get('permissions');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    public function permisos()
    {
        # code...
        $this->db->select('p.id,p.uri,p.description');
        $this->db->from('permissions p');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
      public function permisoid($id,$idrol)
    {
        # code...
        $this->db->select('p.id,p.uri,p.description');
        $this->db->from('permissions p');
        $this->db->join('permission_rol pr', 'p.id = pr.permission_id');
        //$this->db->join('rol r', 'pr.rol_id = r.id');
        $this->db->where('pr.permission_id', $id);
        $this->db->where('pr.rol_id', $idrol);
        $this->db->order_by("p.description", "asc");
        $query = $this->db->get();
        //$query = $this->db->get('permissions');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
  public function addRolPermiso($data)
    {
        return $this->db->insert('permission_rol', $data);
    }
    public function eliminarPermisosRol($id)
    {
        $this->db->where('rol_id',$id);
        return $this->db->delete('permission_rol');
    }
}
