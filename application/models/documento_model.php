<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Documento_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function __destruct() {
        $this->db->close();
    }
    public function showAllDocumentos()
    {
        $this->db->select('d.identificador,u.name,DATE_FORMAT(d.fecharegistro, "%d/%m/%Y") as fecha, SUM(CASE 
             WHEN d.subido = 1 THEN 1
             ELSE 0
           END) AS subido, SUM(CASE 
             WHEN d.subido = 0 THEN 1
             ELSE 0
           END) AS nosubido');    
        $this->db->from('tbldocumento d');
        $this->db->join('users u', 'u.id = d.idusuario'); 
        $this->db->group_by(array("d.identificador", "d.idusuario",'DATE(d.fecharegistro)'));  
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
      public function showAllDocumentosId($id)
    {
        $this->db->select('d.*,(select 
CASE
    WHEN count(*)  > 0 THEN "Okey"
     ELSE "No existe el cliente."
END
from cliente c where c.idcliente=d.cliente  ) as existenciacliente,
(select 
CASE
    WHEN count(*)  > 0 THEN "Okey"
     ELSE "No existe la categoria."
END
from posicionbodega pb where pb.nombreposicion=d.locacion  ) as existencialocacion,
(select 
CASE
    WHEN count(*)  > 0 THEN "Okey"
     ELSE "No existe la locacion."
END
from tblcategoria ca where ca.nombrecategoria=d.categoria  ) as existencategoria,
(select 
CASE
    WHEN count(*)  > 0 THEN "Okey"
     ELSE "No existe el numero parte."
END
from parte p where p.numeroparte=d.numeroparte  ) as existennumeroparte');    
        $this->db->from('tbldocumento d');
        $this->db->where('d.identificador', $id);  
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
  public function validarIdentificador($id)
    {
        $this->db->select('d.*');    
        $this->db->from('tbldocumento d');
         $this->db->where('d.identificador',$id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    public function updateDetalleParte($id, $data) {
        $this->db->where('iddetalleparte', $id);
        $this->db->update('detalleparte', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    // Agregar informacion a la tabla detalle status(Historial)
    public function insert($data) {
        return $this->db->insert('tbldocumento', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function searchPartes2($match, $user) {
        $field = array(
            'p.numeroparte'
        );

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
        d.cantidad,
        s.nombrestatus');
        $this->db->from('parte p');
        $this->db->join('cliente c', 'p.idcliente = c.idcliente');
        $this->db->join('detalleparte d', 'p.idparte = d.idparte');
        $this->db->join('users u', 'd.idusuario = u.id');
        $this->db->join('users uo ', 'd.idoperador = uo.id');
        $this->db->join('status s', 's.idestatus = d.idestatus');
        $this->db->where('d.idusuario', $user);
        $this->db->where('d.idestatus', 4);
        $this->db->or_where('d.idestatus', 6);
        $this->db->like('concat(' . implode(',', $field) . ')', $match);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

}
