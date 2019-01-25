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
    public function  searchPartes($match)
{
  $field = array(
      'p.numeroparte',
      'c.nombre'
  );
    $this->db->select('p.idparte,c.idcliente, p.numeroparte,c.nombre,u.name, p.activo');
    $this->db->from('parte p');
    $this->db->join('cliente c', 'p.idcliente=c.idcliente');
    $this->db->join('users u', 'p.idusuario=u.id');
    $this->db->like('concat(' . implode(',', $field) . ')', $match);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
        return $query->result();
    } else {
        return false;
    }
}
          public function showAllEnviados($idusuario)
    {
        $this->db->select('d.iddetalleparte,p.idparte,c.idcliente, s.idestatus, p.numeroparte,c.nombre,u.name,uo.name as nombreoperador,d.fecharegistro,d.pallet,d.cantidad,s.nombrestatus');
        $this->db->from('parte p');
        $this->db->join('cliente c', 'p.idcliente=c.idcliente');
        $this->db->join('detalleparte d', 'p.idparte=d.idparte');
         $this->db->join('users u', 'd.idusuario=u.id');
         $this->db->join('users uo', 'd.idoperador=uo.id');
        $this->db->join('status s', 's.idestatus=d.idestatus');
        $this->db->where('d.idusuario',$idusuario);
        $this->db->order_by("d.fecharegistro", "desc");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    public function detalleDelDetallaParte($iddetalle)
    {
      // code...
      $this->db->select('d.iddetalleparte,
      p.idparte,
      c.idcliente,
      s.idestatus,
      p.numeroparte,
      c.nombre,
      u.name,
      uo.name as nombreoperador,
      d.fecharegistro,
      d.pallet,
      d.modelo,
      d.revision,
      d.cantidad,
      d.linea,
      d.idoperador,
      s.nombrestatus');
      $this->db->from('parte p');
      $this->db->join('cliente c', 'p.idcliente=c.idcliente');
      $this->db->join('detalleparte d', 'p.idparte=d.idparte');
      $this->db->join('users u', 'd.idusuario=u.id');
      $this->db->join('users uo', 'd.idoperador=uo.id');
      $this->db->join('status s', 's.idestatus=d.idestatus');
      $this->db->join('detallestatus ds', 'ds.iddetalleparte=d.iddetalleparte');
      $this->db->where('d.iddetalleparte',$iddetalle);
      $query = $this->db->get();
       return $query->first_row();
    }
    public function searchEnviados($match,$idusuario)
    {
        $field = array(
            'p.numeroparte',
            's.nombrestatus',
            'd.fecharegistro',
            'd.revision'
        );
        $this->db->select('p.idparte,c.idcliente, s.idestatus, p.numeroparte,c.nombre,u.name,uo.name as nombreoperador,d.fecharegistro,d.pallet,d.cantidad,s.nombrestatus');
        $this->db->from('parte p');
        $this->db->join('cliente c', 'p.idcliente=c.idcliente');
        $this->db->join('detalleparte d', 'p.idparte=d.idparte');
        $this->db->join('users u', 'd.idusuario=u.id');
        $this->db->join('users uo', 'd.idoperador=uo.id');
        $this->db->join('status s', 's.idestatus=d.idestatus');
        $this->db->join('detallestatus ds', 'ds.iddetalleparte=d.iddetalleparte');
        $this->db->where('d.idusuario',$idusuario);
        $this->db->like('concat(' . implode(',', $field) . ')', $match);
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
    public function motivosCancelacionCalidad($iddetalleparte)
    {
      $this->db->select('d.comentariosrechazo, d.fecharegistro');
      $this->db->from('detallestatus d');
      $this->db->where('d.iddetalleparte', $iddetalleparte);
      $this->db->where('d.idstatus', 6);
      $query = $this->db->get();
      if ($query->num_rows() > 0) {
          return $query->result();
      } else {
          return false;
      }
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
    public function updateDetalleParte($id, $field)
    {
        $this->db->where('iddetalleparte', $id);
        $this->db->update('detalleparte', $field);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }

    }


}
