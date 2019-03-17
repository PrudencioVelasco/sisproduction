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

    public function showAllEnviados($idusuario)
{
             $query =$this->db->query("SELECT p.idparte, d.iddetalleparte, p.numeroparte, d.folio, d.modelo, d.revision, d.linea, DATE_FORMAT(d.fecharegistro,'%d/%m/%Y %h:%i %p' ) as fecharegistro,
 (SELECT  COUNT(pc.pallet)  FROM  palletcajas pc WHERE pc.iddetalleparte = d.iddetalleparte) as totalpallet,
 (SELECT  SUM(pc2.cajas)  FROM  palletcajas pc2 WHERE pc2.iddetalleparte = d.iddetalleparte) as totalcajas,
 (SELECT COUNT(pc3.idestatus)  FROM palletcajas pc3 WHERE pc3.iddetalleparte = d.iddetalleparte AND pc3.idestatus = 4) AS totalenviado,
 (SELECT COUNT(pc4.idestatus)  FROM palletcajas pc4 WHERE pc4.iddetalleparte = d.iddetalleparte AND pc4.idestatus = 8) AS enalmacen,
 (SELECT COUNT(pc5.idestatus)  FROM palletcajas pc5 WHERE pc5.iddetalleparte = d.iddetalleparte AND pc5.idestatus = 6) AS rechazadoacalidad,
 (SELECT COUNT(pc5.idestatus)  FROM palletcajas pc5 WHERE pc5.iddetalleparte = d.iddetalleparte AND pc5.idestatus = 3) AS rechazadoapacking,
 (SELECT COUNT(pc9.idpalletcajas)  FROM palletcajas pc9 WHERE pc9.iddetalleparte = d.iddetalleparte AND pc9.idoperador = '$idusuario') AS mostrar
 FROM parte p, detalleparte d
 WHERE p.idparte = d.idparte
 ORDER BY d.fecharegistro DESC");
       //  return $query->result();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
}
    public function buscar($idusuario,$text){
                     $query =$this->db->query("SELECT p.idparte, d.iddetalleparte, p.numeroparte, d.folio, d.modelo, d.revision, d.linea, DATE_FORMAT(d.fecharegistro,'%d/%m/%Y %h:%i %p' ) as fecharegistro,
 (SELECT  COUNT(pc.pallet)  FROM  palletcajas pc WHERE pc.iddetalleparte = d.iddetalleparte) as totalpallet,
 (SELECT  SUM(pc2.cajas)  FROM  palletcajas pc2 WHERE pc2.iddetalleparte = d.iddetalleparte) as totalcajas,
 (SELECT COUNT(pc3.idestatus)  FROM palletcajas pc3 WHERE pc3.iddetalleparte = d.iddetalleparte AND pc3.idestatus = 4) AS totalenviado,
 (SELECT COUNT(pc4.idestatus)  FROM palletcajas pc4 WHERE pc4.iddetalleparte = d.iddetalleparte AND pc4.idestatus = 8) AS enalmacen,
 (SELECT COUNT(pc5.idestatus)  FROM palletcajas pc5 WHERE pc5.iddetalleparte = d.iddetalleparte AND pc5.idestatus = 6) AS rechazadoacalidad,
 (SELECT COUNT(pc5.idestatus)  FROM palletcajas pc5 WHERE pc5.iddetalleparte = d.iddetalleparte AND pc5.idestatus = 3) AS rechazadoapacking,
 (SELECT COUNT(pc9.idpalletcajas)  FROM palletcajas pc9 WHERE pc9.iddetalleparte = d.iddetalleparte AND pc9.idoperador = '$idusuario') AS mostrar
 FROM parte p, detalleparte d
 WHERE p.idparte = d.idparte
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
    /*
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
*/
    
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
}
