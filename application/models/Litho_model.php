<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Litho_model extends CI_Model {

  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  public function __destruct()
  {
    $this->db->close();
  }

  public function showAllLitho()
  {
    $query = $this->db->query("
       SELECT
    r.idrevision,
    p.numeroparte,
    c.nombre,
    CASE
        WHEN LENGTH(m.descripcion) > 12 THEN CONCAT(SUBSTRING(m.descripcion, 1, 12), '...')
        ELSE m.descripcion
    END AS modelo,
    r.descripcion AS revision,
    ca.nombrecategoria,
    r.idrevision,
    (SELECT
            COALESCE(SUM(la.cantidad), 0)
        FROM
            tbllitho la
        WHERE
            la.idrevision = r.idrevision
                AND la.activo = 1) AS totalentradas,
    (SELECT
            COALESCE(SUM(lasa.cantidad), 0)
        FROM
            tbllithosalida lasa
        WHERE
            lasa.idrevision = r.idrevision
                AND lasa.activo = 1) AS totalsalidas,
    (SELECT
            COALESCE(SUM(lade.cantidad), 0)
        FROM
            tbllithodevolucion lade
        WHERE
            lade.idrevision = r.idrevision
                AND lade.activo = 1) AS totalrevueltas,
    ((SELECT
            COALESCE(SUM(la.cantidad), 0)
        FROM
            tbllitho la
        WHERE
            la.idrevision = r.idrevision
                AND la.activo = 1) - ((SELECT
            COALESCE(SUM(lasa.cantidad), 0)
        FROM
            tbllithosalida lasa
        WHERE
            lasa.idrevision = r.idrevision
                AND lasa.activo = 1) + (SELECT
            COALESCE(SUM(lade.cantidad), 0)
        FROM
            tbllithodevolucion lade
        WHERE
            lade.idrevision = r.idrevision
                AND lade.activo = 1))) AS totalexistencia
FROM
    parte p
        INNER JOIN
    tblmodelo m ON p.idparte = m.idparte
        INNER JOIN
    tblrevision r ON r.idmodelo = m.idmodelo
        INNER JOIN
    cliente c ON c.idcliente = p.idcliente
        INNER JOIN
    tblcategoria ca ON ca.idcategoria = p.idcategoria
    WHERE ca.idcategoria IN (11)
    GROUP BY r.idrevision");

    if ($query->num_rows() > 0) {
      return $query->result();
    } else {
      return false;
    }
  }
  public function showAllBolsa()
  {
    $query = $this->db->query("
       SELECT
    r.idrevision,
    p.numeroparte,
    c.nombre,
    CASE
        WHEN LENGTH(m.descripcion) > 12 THEN CONCAT(SUBSTRING(m.descripcion, 1, 12), '...')
        ELSE m.descripcion
    END AS modelo,
    r.descripcion AS revision,
    ca.nombrecategoria,
    r.idrevision,
    (SELECT
            COALESCE(SUM(la.cantidad), 0)
        FROM
            tbllitho la
        WHERE
            la.idrevision = r.idrevision
                AND la.activo = 1) AS totalentradas,
    (SELECT
            COALESCE(SUM(lasa.cantidad), 0)
        FROM
            tbllithosalida lasa
        WHERE
            lasa.idrevision = r.idrevision
                AND lasa.activo = 1) AS totalsalidas,
    (SELECT
            COALESCE(SUM(lade.cantidad), 0)
        FROM
            tbllithodevolucion lade
        WHERE
            lade.idrevision = r.idrevision
                AND lade.activo = 1) AS totalrevueltas,
    ((SELECT
            COALESCE(SUM(la.cantidad), 0)
        FROM
            tbllitho la
        WHERE
            la.idrevision = r.idrevision
                AND la.activo = 1) - ((SELECT
            COALESCE(SUM(lasa.cantidad), 0)
        FROM
            tbllithosalida lasa
        WHERE
            lasa.idrevision = r.idrevision
                AND lasa.activo = 1) + (SELECT
            COALESCE(SUM(lade.cantidad), 0)
        FROM
            tbllithodevolucion lade
        WHERE
            lade.idrevision = r.idrevision
                AND lade.activo = 1))) AS totalexistencia
FROM
    parte p
        INNER JOIN
    tblmodelo m ON p.idparte = m.idparte
        INNER JOIN
    tblrevision r ON r.idmodelo = m.idmodelo
        INNER JOIN
    cliente c ON c.idcliente = p.idcliente
        INNER JOIN
    tblcategoria ca ON ca.idcategoria = p.idcategoria
    WHERE ca.idcategoria IN (8)
    GROUP BY r.idrevision");

    if ($query->num_rows() > 0) {
      return $query->result();
    } else {
      return false;
    }
  }
  public function showAllManual() 
  {
    $query = $this->db->query("
       SELECT
    r.idrevision,
    p.numeroparte,
    c.nombre,
    CASE
        WHEN LENGTH(m.descripcion) > 12 THEN CONCAT(SUBSTRING(m.descripcion, 1, 12), '...')
        ELSE m.descripcion
    END AS modelo,
    r.descripcion AS revision,
    ca.nombrecategoria,
    r.idrevision,
    (SELECT
            COALESCE(SUM(la.cantidad), 0)
        FROM
            tbllitho la
        WHERE
            la.idrevision = r.idrevision
                AND la.activo = 1) AS totalentradas,
    (SELECT
            COALESCE(SUM(lasa.cantidad), 0)
        FROM
            tbllithosalida lasa
        WHERE
            lasa.idrevision = r.idrevision
                AND lasa.activo = 1) AS totalsalidas,
    (SELECT
            COALESCE(SUM(lade.cantidad), 0)
        FROM
            tbllithodevolucion lade
        WHERE
            lade.idrevision = r.idrevision
                AND lade.activo = 1) AS totalrevueltas,
    ((SELECT
            COALESCE(SUM(la.cantidad), 0)
        FROM
            tbllitho la
        WHERE
            la.idrevision = r.idrevision
                AND la.activo = 1) - ((SELECT
            COALESCE(SUM(lasa.cantidad), 0)
        FROM
            tbllithosalida lasa
        WHERE
            lasa.idrevision = r.idrevision
                AND lasa.activo = 1) + (SELECT
            COALESCE(SUM(lade.cantidad), 0)
        FROM
            tbllithodevolucion lade
        WHERE
            lade.idrevision = r.idrevision
                AND lade.activo = 1))) AS totalexistencia
FROM
    parte p
        INNER JOIN
    tblmodelo m ON p.idparte = m.idparte
        INNER JOIN
    tblrevision r ON r.idmodelo = m.idmodelo
        INNER JOIN
    cliente c ON c.idcliente = p.idcliente
        INNER JOIN
    tblcategoria ca ON ca.idcategoria = p.idcategoria
    WHERE ca.idcategoria IN (6)
    GROUP BY r.idrevision");

    if ($query->num_rows() > 0) {
      return $query->result();
    } else {
      return false;
    }
  }

  /*public function detalle_parte($idparte)
  {
    $this->db->select('p.idparte,c.idcliente,p.idcategoria, ca.nombrecategoria, p.numeroparte,c.nombre,u.name, p.activo, m.descripcion as modelo, r.descripcion as revision');
    $this->db->from('parte p');
    $this->db->join('cliente c', 'p.idcliente=c.idcliente');
    $this->db->join('tblcategoria ca', 'p.idcategoria=ca.idcategoria');
    $this->db->join('users u', 'p.idusuario=u.id');
    $this->db->join('tblmodelo m', 'm.idparte=m.idmodelo');
    $this->db->join('tblrevision r', 'm.idmodelo=r.idmodelo');
    $this->db->where('p.idparte',$idparte);
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
      return $query->first_row();
    } else {
      return false;
    }
  }*/

  public function detalle_entradas($idrevision)
  {

    $this->db->select('l.idrevision,l.idlitho, l.comentarios,l.transferencia ,c.idcliente,p.idcategoria, ca.nombrecategoria, p.numeroparte,c.nombre,u.name, l.cantidad, p.activo, m.descripcion as modelo, r.descripcion as revision,l.fecharegistro');
    $this->db->from('parte p');
    $this->db->join('cliente c', 'p.idcliente=c.idcliente');
    $this->db->join('tblcategoria ca', 'p.idcategoria=ca.idcategoria');
    $this->db->join('users u', 'p.idusuario=u.id');
    $this->db->join('tblmodelo m', 'm.idparte=p.idparte');
    $this->db->join('tblrevision r', 'm.idmodelo=r.idmodelo');
    $this->db->join('tbllitho l', 'l.idrevision=r.idrevision');
    $this->db->where('r.idrevision',$idrevision);
    $this->db->where('l.activo',1);
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
     return $query->result();
   } else {
    return false;
  }
}

public function detalle_salidas($idrevision)
{

  $this->db->select('s.idrevision,c.idcliente,p.idcategoria, ca.nombrecategoria, p.numeroparte,c.nombre,u.name, s.idlithosalida,s.cantidad,s.comentarios,s.transferencia, p.activo, m.descripcion as modelo, r.descripcion as revision,s.fecharegistro');
  $this->db->from('parte p');
  $this->db->join('cliente c', 'p.idcliente=c.idcliente');
  $this->db->join('tblcategoria ca', 'p.idcategoria=ca.idcategoria');
  $this->db->join('users u', 'p.idusuario=u.id');
  $this->db->join('tblmodelo m', 'm.idparte=p.idparte');
  $this->db->join('tblrevision r', 'm.idmodelo=r.idmodelo');
  $this->db->join('tbllithosalida s', 's.idrevision=r.idrevision');
  $this->db->where('s.idrevision',$idrevision);
  $this->db->where('s.activo',1);
  $query = $this->db->get();

  if ($query->num_rows() > 0) {
    return $query->result();
  } else {
    return false;
  }
}

public function detalle_devoluciones($idrevision)
{
  $this->db->select('d.idrevision,c.idcliente,p.idcategoria, ca.nombrecategoria, p.numeroparte,c.nombre,u.name, d.idlithodevolucion,d.cantidad,d.comentarios,d.transferencia, p.activo, m.descripcion as modelo, r.descripcion as revision,d.fecharegistro');
  $this->db->from('parte p');
  $this->db->join('cliente c', 'p.idcliente=c.idcliente');
  $this->db->join('tblcategoria ca', 'p.idcategoria=ca.idcategoria');
  $this->db->join('users u', 'p.idusuario=u.id');
  $this->db->join('tblmodelo m', 'm.idparte=p.idparte');
  $this->db->join('tblrevision r', 'm.idmodelo=r.idmodelo');
  $this->db->join('tbllithodevolucion d', 'd.idrevision=r.idrevision');
  $this->db->where('d.idrevision',$idrevision);
  $this->db->where('d.activo',1);
  $query = $this->db->get();
  if ($query->num_rows() > 0) {
    return $query->result();
  } else {
    return false;
  }
}

public function addEntradaLitho($data)
{
  $this->db->insert('tbllitho', $data);
  $insert_id = $this->db->insert_id();

  return  $insert_id;
}

public function addSalidaLitho($data)
{
  $this->db->insert('tbllithosalida', $data);
  $insert_id = $this->db->insert_id();

  return  $insert_id;
}

public function addDevolucionLitho($data)
{
  $this->db->insert('tbllithodevolucion', $data);
  $insert_id = $this->db->insert_id();

  return  $insert_id;
}

public function totalentradas($idrevision)
{
  $this->db->select('cantidad');
  $this->db->from('tbllitho');
  $this->db->where('activo',1);
  $this->db->where('idrevision',$idrevision);
  $query = $this->db->get();

  if ($query->num_rows() > 0) {
    return $query->result();
  } else {
    return false;
  }
}

public function totalsalidas($idrevision)
{
  $this->db->select('cantidad');
  $this->db->from('tbllithosalida');
  $this->db->where('activo',1);
  $this->db->where('idrevision',$idrevision);
  $query = $this->db->get();

  if ($query->num_rows() > 0) {
    return $query->result();
  } else {
    return false;
  }
}

public function totalsalidaswithout($idrevision,$idlithosalida)
{
  $this->db->select('cantidad');
  $this->db->from('tbllithosalida');
  $this->db->where('activo',1);
  $this->db->where('idrevision',$idrevision);
  $this->db->where_not_in('idlithosalida',$idlithosalida);
  $query = $this->db->get();

  if ($query->num_rows() > 0) {
    return $query->result();
  } else {
    return false;
  }
}

public function totaldevolucion($idrevision)
{
  $this->db->select('cantidad');
  $this->db->from('tbllithodevolucion');
  $this->db->where('activo',1);
  $this->db->where('idrevision',$idrevision);
  $query = $this->db->get();

  if ($query->num_rows() > 0) {
    return $query->result();
  } else {
    return false;
  }
}

public function verificartotalentradas($idparte,$idlitho)
{
  $this->db->select('l.cantidad');
  $this->db->from('tbllitho l');
  $this->db->where('l.activo',1);
  $this->db->where('l.idlitho',$idlitho);
  $query = $this->db->get();

  if ($query->num_rows() > 0) {
    return $query->result();
  } else {
    return false;
  }
}

public function actualizarlitho($idlitho,$data)
{
  $this->db->where('idlitho', $idlitho);
  $this->db->update('tbllitho', $data);

  if ($this->db->affected_rows() > 0) {
    return true;
  } else {
    return false;
  }
}

public function actualizarlithosalida($idlithosalida,$data)
{
  $this->db->where('idlithosalida', $idlithosalida);
  $this->db->update('tbllithosalida', $data);

  if ($this->db->affected_rows() > 0) {
    return true;
  } else {
    return false;
  }

}

public function eliminar($idlitho)
{
  $this->db->set('activo', 0);
  $this->db->where('idlitho', $idlitho);
  $this->db->update('tbllitho');

  return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
}

public function eliminar_salida($idlithosalida)
{
  $this->db->set('activo', 0);
  $this->db->where('idlithosalida', $idlithosalida);
  $this->db->update('tbllithosalida');

  return ($this->db->affected_rows() > 0) ? TRUE : FALSE;

}

public function buscar_fecha_parte_entrada($idlitho,$idrevision)
{
  $this->db->select('fecharegistro');
  $this->db->from('tbllitho');
  $this->db->where('activo',1);
  $this->db->where('idlitho',$idlitho);
  $this->db->where('idrevision',$idrevision);
  $query = $this->db->get();

  if ($query->num_rows() > 0) {
    return $query->result();
  } else {
    return false;
  }
}


public function buscar_fecha_parte_salidas($idlithosalida,$idrevision)
{
  $this->db->select('fecharegistro');
  $this->db->from('tbllithosalida');
  $this->db->where('activo',1);
  $this->db->where('idlithosalida',$idlithosalida);
  $this->db->where('idrevision',$idrevision);
  $query = $this->db->get();

  if ($query->num_rows() > 0) {
    return $query->result();
  } else {
    return false;
  }
}

// Seccion DETALLES [Devoluciones]
public function totaldevolucioneswithout($idrevision,$idlithodevolucion)
{
  $this->db->select('cantidad');
  $this->db->from('tbllithodevolucion');
  $this->db->where('activo',1);
  $this->db->where('idrevision',$idrevision);
  $this->db->where_not_in('idlithodevolucion',$idlithodevolucion);
  $query = $this->db->get();

  if ($query->num_rows() > 0) {
    return $query->result();
  } else {
    return false;
  }
}

public function actualizarlithodevolucion($idlithodevolucion,$data)
{
  $this->db->where('idlithodevolucion', $idlithodevolucion);
  $this->db->update('tbllithodevolucion', $data);

  if ($this->db->affected_rows() > 0) {
    return true;
  } else {
    return false;
  }

}

public function buscar_fecha_parte_devolucion($idlithodevolucion,$idrevision)
{
  $this->db->select('fecharegistro');
  $this->db->from('tbllithodevolucion');
  $this->db->where('activo',1);
  $this->db->where('idlithodevolucion',$idlithodevolucion);
  $this->db->where('idrevision',$idrevision);
  $query = $this->db->get();

  if ($query->num_rows() > 0) {
    return $query->result();
  } else {
    return false;
  }
}

public function eliminar_devolucion($idlithodevolucion)
{
  $this->db->set('activo', 0);
  $this->db->where('idlithodevolucion', $idlithodevolucion);
  $this->db->update('tbllithodevolucion');

  return ($this->db->affected_rows() > 0) ? TRUE : FALSE;

}

}
?>
