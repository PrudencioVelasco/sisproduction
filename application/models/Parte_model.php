<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Parte_model extends CI_Model {

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
        $this->db->select('p.idparte,c.idcliente, p.numeroparte,c.nombre,u.name, p.activo');
        $this->db->from('parte p');
        $this->db->join('cliente c', 'p.idcliente=c.idcliente');
        $this->db->join('users u', 'p.idusuario=u.id');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
          public function showAllEnviados($idusuario)
    {
        $this->db->select('p.idparte,c.idcliente, s.idestatus, p.numeroparte,c.nombre,u.name,uo.name as nombreoperador,d.fecharegistro,d.pallet,d.cantidad,s.nombrestatus');
        $this->db->from('parte p');
        $this->db->join('cliente c', 'p.idcliente=c.idcliente');
        $this->db->join('detalleparte d', 'p.idparte=d.idparte');
         $this->db->join('users u', 'd.idusuario=u.id');
         $this->db->join('users uo', 'd.idoperador=uo.id');
        $this->db->join('status s', 's.idestatus=d.idestatus');
        $this->db->join('detallestatus ds', 'ds.iddetalleparte=d.iddetalleparte');
        $this->db->where('d.idusuario',$idusuario);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    public function validarClienteParte($idcliente,$numeroparte)
    {

        //Funcion para validar al registra un numero de parte que no
        //este registrado con el mismo cliente
        $this->db->select('p.*');
        $this->db->from('parte p');
        $this->db->where('p.idcliente',$idcliente);
        $this->db->where('p.numeroparte',$numeroparte);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }

    }
      public function detalleParteId($idparte)
    {
       $this->db->select('p.idparte,c.idcliente, p.numeroparte,c.nombre,u.name, p.activo');
        $this->db->from('parte p');
        $this->db->join('cliente c', 'p.idcliente=c.idcliente');
        $this->db->join('users u', 'p.idusuario=u.id');
         $this->db->where('p.idparte', $idparte);
        $query = $this->db->get();
         return $query->first_row();
    }

     public function addParte($data)
    {
        return $this->db->insert('parte', $data);
    }
     public function addDetalleParte($data)
    {
         $this->db->insert('detalleparte', $data);
        return $this->db->insert_id();
    }
     public function addDetalleEstatusParte($data)
    {
        return $this->db->insert('detallestatus', $data);
    }
  /*    public function showAllClientes()
    {
        $query = $this->db->get('cliente');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
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
    }*/

}
