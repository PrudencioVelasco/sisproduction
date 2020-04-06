<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categorias_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function __destruct()
    {
        $this->db->close();
    }
//
        public function showAll()
    {
        $query = $this->db->get('tblcategoria');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

     public function showAllCategoriasActivos()
    {
        # code...
        $this->db->select('c.*');
        $this->db->from('tblcategoria c');
        $this->db->where('c.activo', 1);
        $this->db->order_by('c.nombrecategoria ASC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    public function validarExistenciaCategoria($nombrecategoria)
    {
        # code...
        $this->db->select('c.*');
        $this->db->from('tblcategoria c');
        $this->db->where('TRIM(c.nombrecategoria)', $nombrecategoria);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

     public function validarUpdateExistenciaCategoria($idcategoria,$nombrecategoria)
    {
        //Funcion para validar al registra un numero de parte que no
        //este registrado con el mismo cliente
        $this->db->select('c.*');
        $this->db->from('tblcategoria c');
        $this->db->where('TRIM(c.nombrecategoria)', $nombrecategoria);
        $this->db->where('c.idcategoria !=',$idcategoria);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
}
//
     public function addCategoria($data)
    {
        return $this->db->insert('tblcategoria', $data);
    }
     public function updateCategoria($id, $field)
    {
        $this->db->where('idcategoria', $id);
        $this->db->update('tblcategoria', $field);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }

    }
//
      public function searchCategoria($match)
    {
        $field = array(
            'nombrecategoria'
        );
        $this->db->like('concat(' . implode(',', $field) . ')', $match);
        $query = $this->db->get('tblcategoria');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

}
