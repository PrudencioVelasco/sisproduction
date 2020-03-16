<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Documentos_model extends CI_Model {

  public function __construct() 
  {
    parent::__construct();
    $this->load->database();
  }

  public function __destruct() 
  {
    $this->db->close();
  }

 public function showAllParte()
    {
        $this->db->select('p.idparte,p.numeroparte');
        $this->db->from('parte p'); 
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
     public function showAllTipoDocumento()
    {
        $this->db->select('td.idtipodocumento,td.nombretipo');
        $this->db->from('tbltipo_documento td'); 
        $this->db->where('td.idtipodocumento != 1'); 
        $this->db->order_by('td.nombretipo', 'ASC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
     public function showAllArea()
    {
        //$idarea = array(1,2,3); 
        $this->db->select('a.idarea,a.nombrearea');
        $this->db->from('tblarea a'); 
        //$this->db->where_in('p.idproceso', $idarea);
         $this->db->order_by('a.nombrearea', 'ASC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
     public function showAllModelo($idparte)
    {
        $this->db->select('p.idparte,p.numeroparte, m.idmodelo, m.descripcion');
        $this->db->from('parte p'); 
         $this->db->join('tblmodelo m', 'p.idparte = m.idparte');
        $this->db->where('m.idparte', $idparte);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
      public function showAllRevision($idmodelo)
    {
        $this->db->select('p.idparte,p.numeroparte, r.idrevision, r.descripcion');
        $this->db->from('parte p'); 
        $this->db->join('tblmodelo m', 'p.idparte = m.idparte');
        $this->db->join('tblrevision r', 'r.idmodelo = m.idmodelo');
        $this->db->where('r.idmodelo', $idmodelo);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

  public function getAllInfo() 
  {
    $query = $this->db->query("SELECT r.idrevision, p.numeroparte, c.nombre, m.descripcion AS modelo, r.descripcion AS revision,ca.nombrecategoria, r.idrevision,  s.nombre as nombredocumento, s.idtbldocumentospec as iddoc
      FROM parte  p 
      INNER JOIN tblmodelo m ON p.idparte = m.idparte
      INNER JOIN tblrevision r ON r.idmodelo = m.idmodelo
      INNER JOIN cliente c ON c.idcliente = p.idcliente
      INNER JOIN tblcategoria ca ON ca.idcategoria = p.idcategoria
      INNER JOIN tbldocumentospec s ON s.idrevision = r.idrevision
      WHERE s.activo = 1 ");

    if ($query->num_rows() > 0) {
      return $query->result();
    } else {
      return false;
    }
  }
    public function getAllProcedimientos() 
  {
        $this->db->select('sp.idspecsprocedimiento, td.nombretipo,a.nombrearea,td.idtipodocumento,sp.nombredocumento, sp.nombre, sp.codigo, sp.revision');
        $this->db->from('tblspecs_procedimientos sp'); 
        $this->db->join('tblarea a', 'sp.idarea = a.idarea');
        $this->db->join('tbltipo_documento td', 'td.idtipodocumento = sp.idtipodocumento'); 
        $this->db->where('sp.activo', 1); 
        $query = $this->db->get();
    if ($query->num_rows() > 0) {
      return $query->result();
    } else {
      return false;
    }
  }

  public function saveDocument($data){
    return $this->db->insert('tbldocumentospec', $data);
    if ($this->db->affected_rows() > 0) {
      return true;
    } else {
      return false;
    }
  }
    public function addSpecsProcedimiento($data){
    return $this->db->insert('tblspecs_procedimientos', $data);
    if ($this->db->affected_rows() > 0) {
      return true;
    } else {
      return false;
    }
  }

  public function getDataDocument($iddoc)
  {
    $this->db->select('documento,nombre');
    $this->db->from('tbldocumentospec');
    $this->db->where('idtbldocumentospec', $iddoc);
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
      return $query->result();
    } else {
      return false;
    }
  }

  public function updateDocument($idtbldocumentospec,$data)
  {
    $this->db->where('idtbldocumentospec', $idtbldocumentospec);
    $this->db->update('tbldocumentospec', $data);
    if ($this->db->affected_rows() > 0) {
      return true;
    } else {
      return false;
    }
  }

  public function deleteDocument($idtbldocumentospec,$data)
  {
    $this->db->where('idtbldocumentospec', $idtbldocumentospec);
    $this->db->update('tbldocumentospec', $data);
    if ($this->db->affected_rows() > 0) {
      return true;
    } else {
      return false;
    }
  }
   public function updateProcedimiento($id,$data)
  {
    $this->db->where('idspecsprocedimiento', $id);
    $this->db->update('tblspecs_procedimientos', $data);
    if ($this->db->affected_rows() > 0) {
      return true;
    } else {
      return false;
    }
  }

}
?>