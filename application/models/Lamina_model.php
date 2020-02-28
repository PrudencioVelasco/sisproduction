<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Lamina_model extends CI_Model {

    public function __construct() 
    {
        parent::__construct();
        $this->load->database();
    }

    public function __destruct() 
    {
        $this->db->close();
    }

    public function showAllLaminas() 
    {

        $query = $this->db->query(" SELECT 
    p.idparte,
    p.numeroparte,
    c.nombre,
    CASE
        WHEN LENGTH(m.descripcion) > 12 THEN CONCAT(SUBSTRING(m.descripcion, 1, 12), '...')
        ELSE m.descripcion
    END AS modelo,
    r.descripcion AS revision,
    r.idrevision,
    ca.nombrecategoria,
    (SELECT 
            COALESCE(SUM(la.cantidad), 0)
        FROM
            tbllamina la
        WHERE
            la.idparte = p.idparte AND la.activo = 1) AS totalentradas,
    (SELECT 
            COALESCE(SUM(lasa.cantidad), 0)
        FROM
            tbllaminasalida lasa
        WHERE
            lasa.idparte = p.idparte
                AND lasa.activo = 1) AS totalsalidas,
    (SELECT 
            COALESCE(SUM(lade.cantidad), 0)
        FROM
            tbllaminadevolucion lade
        WHERE
            lade.idparte = p.idparte
                AND lade.activo = 1) AS totalrevueltas,
    ((SELECT 
            COALESCE(SUM(la.cantidad), 0)
        FROM
            tbllamina la
        WHERE
            la.idparte = p.idparte AND la.activo = 1) - ((SELECT 
            COALESCE(SUM(lasa.cantidad), 0)
        FROM
            tbllaminasalida lasa
        WHERE
            lasa.idparte = p.idparte
                AND lasa.activo = 1) + (SELECT 
            COALESCE(SUM(lade.cantidad), 0)
        FROM
            tbllaminadevolucion lade
        WHERE
            lade.idparte = p.idparte
                AND lade.activo = 1))) AS totalexistencia
FROM
    parte p
        INNER JOIN
    tblmodelo m ON p.idparte = m.idparte
        INNER JOIN
    tblcategoria ca ON ca.idcategoria = p.idcategoria
        INNER JOIN
    tblrevision r ON r.idmodelo = m.idmodelo
        INNER JOIN
    cliente c ON c.idcliente = p.idcliente
WHERE
    ca.idcategoria IN (7)
GROUP BY r.idrevision");

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function detalle_parte($idparte)
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
    }

    public function detalle_entradas($idparte)
    {
        $this->db->select('p.idparte,l.idlamina, l.comentarios, c.idcliente,p.idcategoria, ca.nombrecategoria, p.numeroparte,c.nombre,u.name, l.cantidad, p.activo, m.descripcion as modelo, r.descripcion as revision,l.fecharegistro');
        $this->db->from('parte p');
        $this->db->join('cliente c', 'p.idcliente=c.idcliente');
        $this->db->join('tblcategoria ca', 'p.idcategoria=ca.idcategoria');
        $this->db->join('users u', 'p.idusuario=u.id');
        $this->db->join('tblmodelo m', 'm.idparte=p.idparte');
        $this->db->join('tblrevision r', 'm.idmodelo=r.idmodelo');
        $this->db->join('tbllamina l', 'l.idparte=p.idparte');
        $this->db->where('l.idparte',$idparte);
        $this->db->where('l.activo',1);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function detalle_salidas($idparte)
    {
        $this->db->select('p.idparte,c.idcliente,p.idcategoria, ca.nombrecategoria, p.numeroparte,c.nombre,u.name,s.idlaminasalida, s.cantidad,s.comentarios,s.idmaquina, p.activo, m.descripcion as modelo, r.descripcion as revision,s.fecharegistro');
        $this->db->from('parte p');
        $this->db->join('cliente c', 'p.idcliente=c.idcliente');
        $this->db->join('tblcategoria ca', 'p.idcategoria=ca.idcategoria');
        $this->db->join('users u', 'p.idusuario=u.id');
        $this->db->join('tblmodelo m', 'm.idparte=p.idparte');
        $this->db->join('tblrevision r', 'm.idmodelo=r.idmodelo');
        $this->db->join('tbllaminasalida s', 's.idparte=p.idparte');
        $this->db->where('p.idparte',$idparte);
        $this->db->where('s.activo',1);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function detalle_devoluciones($idparte)
    {
        $this->db->select('p.idparte,c.idcliente,p.idcategoria, ca.nombrecategoria, p.numeroparte,c.nombre,u.name, d.idlaminadevolucion,d.idparte,d.idcliente,d.cantidad,d.comentarios, p.activo, m.descripcion as modelo, r.descripcion as revision,d.fecharegistro');
        $this->db->from('parte p');
        $this->db->join('cliente c', 'p.idcliente=c.idcliente');
        $this->db->join('tblcategoria ca', 'p.idcategoria=ca.idcategoria');
        $this->db->join('users u', 'p.idusuario=u.id');
        $this->db->join('tblmodelo m', 'm.idparte=p.idparte');
        $this->db->join('tblrevision r', 'm.idmodelo=r.idmodelo');
        $this->db->join('tbllaminadevolucion d', 'd.idparte=p.idparte');
        $this->db->where('p.idparte',$idparte);
        $this->db->where('d.activo',1);
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function addEntradaLamina($data)
    {
        $this->db->insert('tbllamina', $data);
        $insert_id = $this->db->insert_id(); 
        
        return  $insert_id;
    }

    public function addSalidaLamina($data)
    {
        $this->db->insert('tbllaminasalida', $data);
        $insert_id = $this->db->insert_id(); 
        
        return  $insert_id;
    }

    public function addDevolucionLamina($data)
    {
        $this->db->insert('tbllaminadevolucion', $data);
        $insert_id = $this->db->insert_id(); 
        
        return  $insert_id;
    }

    public function showAllMaquinas() 
    {
        $this->db->select('m.*');
        $this->db->from('tblmaquina m'); 
        $this->db->where('m.activo',1); 
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function totalentradas($idparte)
    {
        $this->db->select('l.cantidad');
        $this->db->from('tbllamina l'); 
        $this->db->where('l.activo',1); 
        $this->db->where('l.idparte',$idparte); 
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function totalsalidas($idparte)
    {
        $this->db->select('l.cantidad');
        $this->db->from('tbllaminasalida l'); 
        $this->db->where('l.activo',1); 
        $this->db->where('l.idparte',$idparte); 
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    public function totaldevolucion($idparte) {
        $this->db->select('l.cantidad');
        $this->db->from('tbllaminadevolucion l'); 
        $this->db->where('l.activo',1); 
        $this->db->where('l.idparte',$idparte); 
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    //Seccion DETALLE [Salidas]
    public function actualizarlaminaentradas($idlamina,$data)
    {
        $this->db->where('idlamina', $idlamina);
        $this->db->update('tbllamina', $data);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    public function buscar_fecha_parte_entrada($idlamina,$idparte)
    {
        $this->db->select('fecharegistro');
        $this->db->from('tbllamina'); 
        $this->db->where('activo',1); 
        $this->db->where('idlamina',$idlamina);
        $this->db->where('idparte',$idparte); 
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function eliminar_entrada($idlamina)
    {
        $this->db->set('activo', 0);
        $this->db->where('idlamina', $idlamina);
        $this->db->update('tbllamina');

        return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }

    public function totalsalidaswithout($idparte,$idlaminasalida)
    {
        $this->db->select('l.cantidad');
        $this->db->from('tbllaminasalida l'); 
        $this->db->where('l.activo',1); 
        $this->db->where('l.idparte',$idparte);
        $this->db->where_not_in('l.idlaminasalida',$idlaminasalida);      
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function buscar_fecha_parte_salida($idlaminasalida,$idparte)
    {
        $this->db->select('fecharegistro');
        $this->db->from('tbllaminasalida'); 
        $this->db->where('activo',1); 
        $this->db->where('idlaminasalida',$idlaminasalida);
        $this->db->where('idparte',$idparte); 
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function eliminar_salida($idlaminasalida)
    {
        $this->db->set('activo', 0);
        $this->db->where('idlaminasalida', $idlaminasalida);
        $this->db->update('tbllaminasalida');

        return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }

    // Seccion DETALLE [Devoluciones]

    public function totaldevolucioneswithout($idparte,$idlaminadevolucion)
    {
        $this->db->select('d.cantidad');
        $this->db->from('tbllaminadevolucion d'); 
        $this->db->where('d.activo',1); 
        $this->db->where('d.idparte',$idparte);
        $this->db->where_not_in('d.idlaminadevolucion',$idlaminadevolucion);      
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function actualizarlaminadevolucion($idlaminadevolucion,$data)
    {
        $this->db->where('idlaminadevolucion', $idlaminadevolucion);
        $this->db->update('tbllaminadevolucion', $data);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function actualizarlaminasalida($idlaminasalida,$data)
{
  $this->db->where('idlaminasalida', $idlaminasalida);
  $this->db->update('tbllaminasalida', $data);
  
  if ($this->db->affected_rows() > 0) {
    return true;
  } else {
    return false;
  }

}

    public function buscar_fecha_parte_devolucion($idlaminadevolucion,$idparte)
    {
        $this->db->select('fecharegistro');
        $this->db->from('tbllaminadevolucion'); 
        $this->db->where('activo',1); 
        $this->db->where('idlaminadevolucion',$idlaminadevolucion);
        $this->db->where('idparte',$idparte); 
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function eliminar_devolucion($idlaminadevolucion)
    {
        $this->db->set('activo', 0);
        $this->db->where('idlaminadevolucion', $idlaminadevolucion);
        $this->db->update('tbllaminadevolucion');

        return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }

}
