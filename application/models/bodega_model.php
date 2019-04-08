<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bodega_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function __destruct()
    {
        $this->db->close();
    }

    public function showAllEnviados()
{
             $query =$this->db->query("SELECT p.idparte, d.iddetalleparte, p.numeroparte, d.folio, d.modelo, d.revision, l.idlinea,l.nombrelinea, DATE_FORMAT(d.fecharegistro,'%d/%m/%Y %h:%i %p' ) as fecharegistro,
 (SELECT  COUNT(pc.pallet)  FROM  palletcajas pc WHERE pc.iddetalleparte = d.iddetalleparte) as totalpallet,
 (SELECT  SUM(pc2.cajas)  FROM  palletcajas pc2 WHERE pc2.iddetalleparte = d.iddetalleparte) as totalcajas,
 (SELECT COUNT(pc3.idestatus)  FROM palletcajas pc3 WHERE pc3.iddetalleparte = d.iddetalleparte AND pc3.idestatus = 4) AS totalenviado,
 (SELECT COUNT(pc4.idestatus)  FROM palletcajas pc4 WHERE pc4.iddetalleparte = d.iddetalleparte AND pc4.idestatus = 8) AS enalmacen,
 (SELECT COUNT(pc5.idestatus)  FROM palletcajas pc5 WHERE pc5.iddetalleparte = d.iddetalleparte AND pc5.idestatus = 6) AS rechazadoacalidad,
 (SELECT COUNT(pc5.idestatus)  FROM palletcajas pc5 WHERE pc5.iddetalleparte = d.iddetalleparte AND pc5.idestatus = 3) AS rechazadoapacking,
    (SELECT COUNT(pc9.idestatus)  FROM palletcajas pc9 WHERE pc9.iddetalleparte = d.iddetalleparte AND pc9.idestatus = 12) AS enhold,
    (SELECT COUNT(pc10.idestatus)  FROM palletcajas pc10 WHERE pc10.iddetalleparte = d.iddetalleparte AND pc10.idestatus = 1) AS enviadoacalidad
 FROM parte p, detalleparte d, linea l
 WHERE p.idparte = d.idparte
 AND l.idlinea = d.idlinea
 ORDER BY d.fecharegistro DESC");
       //  return $query->result();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
}
    public function buscar($idusuario,$text){
                     $query =$this->db->query("SELECT p.idparte, d.iddetalleparte, p.numeroparte, d.folio, d.modelo, d.revision, l.idlinea,l.nombrelinea, DATE_FORMAT(d.fecharegistro,'%d/%m/%Y %h:%i %p' ) as fecharegistro,
 (SELECT  COUNT(pc.pallet)  FROM  palletcajas pc WHERE pc.iddetalleparte = d.iddetalleparte) as totalpallet,
 (SELECT  SUM(pc2.cajas)  FROM  palletcajas pc2 WHERE pc2.iddetalleparte = d.iddetalleparte) as totalcajas,
 (SELECT COUNT(pc3.idestatus)  FROM palletcajas pc3 WHERE pc3.iddetalleparte = d.iddetalleparte AND pc3.idestatus = 4) AS totalenviado,
 (SELECT COUNT(pc4.idestatus)  FROM palletcajas pc4 WHERE pc4.iddetalleparte = d.iddetalleparte AND pc4.idestatus = 8) AS enalmacen,
 (SELECT COUNT(pc5.idestatus)  FROM palletcajas pc5 WHERE pc5.iddetalleparte = d.iddetalleparte AND pc5.idestatus = 6) AS rechazadoacalidad,
 (SELECT COUNT(pc5.idestatus)  FROM palletcajas pc5 WHERE pc5.iddetalleparte = d.iddetalleparte AND pc5.idestatus = 3) AS rechazadoapacking,
    (SELECT COUNT(pc9.idestatus)  FROM palletcajas pc9 WHERE pc9.iddetalleparte = d.iddetalleparte AND pc9.idestatus = 12) AS enhold,
    (SELECT COUNT(pc10.idestatus)  FROM palletcajas pc10 WHERE pc10.iddetalleparte = d.iddetalleparte AND pc10.idestatus = 1) AS enviadoacalidad
 FROM parte p, detalleparte d, linea l
 WHERE p.idparte = d.idparte
 AND l.idlinea = d.idlinea
  AND (d.folio LIKE '%$text%' OR p.numeroparte LIKE '%$text%' OR d.modelo LIKE '%$text%' OR d.revision LIKE '%$text%')
 ORDER BY d.fecharegistro DESC");
       //  return $query->result();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
public function posicionesDetalleBodega($iddetalleparte)
{
  $this->db->select('pd.idpalletcajas, pd.numero, pd.idposicion');
  $this->db->from('parteposicionbodega pd');
  $this->db->join('posicionbodega p', 'p.idposicion=pd.idposicion');
  $this->db->where('pd.iddetalleparte',$iddetalleparte);
  $query = $this->db->get();
  if ($query->num_rows() > 0) {
      return $query->result();
  } else {
      return false;
  }
}
public function posicionPalletCajas($iddetalleparte){
  $this->db->select('ppb.idparteposicionbodega, p.idposicion,p.nombreposicion');
  $this->db->from('parteposicionbodega ppb');
  $this->db->join('posicionbodega p', 'p.idposicion=ppb.idposicion');
  $this->db->join('palletcajas pc','pc.idpalletcajas=ppb.idpalletcajas');
  $this->db->where('pc.iddetalleparte',$iddetalleparte);
  $query = $this->db->get();
  if ($query->num_rows() > 0) {
      return $query->result();
  } else {
      return false;
  } 
}
public function eliminarposicionesparte($id)
{
    $this->db->where('idpalletcajas', $id);
    $this->db->delete('parteposicionbodega');
    if ($this->db->affected_rows() > 0) {
        return true;
    } else {
        return false;
    }

}
 
    
      public function addPalletPosicion($data)
    {
        $this->db->insert('parteposicionbodega', $data);
        return $this->db->insert_id();
    }
   public function updateEstatus($id, $field)
    {
        $this->db->where('idpalletcajas', $id);
        $this->db->update('palletcajas', $field);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }

    }
       public function addMotivoRechazo($data)
    {
        return $this->db->insert('palletcajasestatus', $data);
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }
    public function motivosRechazo(){
        $this->db->select('mr.idmotivorechazo, mr.motivo');
        $this->db->from('motivorechazo mr'); 
        $this->db->where('mr.idproceso',3);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        } 
    }
       public function validarRechazo($id){
        $this->db->select('pc.*');
        $this->db->from('palletcajas pc`'); 
        $this->db->where('pc.idpalletcajas',4);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        } 
    }

}
