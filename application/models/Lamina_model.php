<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Lamina_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function __destruct() {
        $this->db->close();
    }
 
            public function showAllLaminas() {
                $query = $this->db->query("SELECT p.idparte, p.numeroparte, c.nombre, m.descripcion AS modelo, r.descripcion AS revision,
                (SELECT COALESCE(SUM(la.cantidad),0) FROM tbllamina la WHERE la.idparte = p.idparte) as totalentradas,
                (SELECT COALESCE(SUM(lasa.cantidad),0) FROM tbllaminasalida lasa WHERE lasa.idparte = p.idparte) as totalsalidas,
                (SELECT COALESCE(SUM(lade.cantidad),0) FROM tbllaminadevolucion lade WHERE lade.idparte = p.idparte) as totalrevueltas,
                ((SELECT COALESCE(SUM(la.cantidad),0) FROM tbllamina la WHERE la.idparte = p.idparte) - (SELECT COALESCE(SUM(lasa.cantidad),0) FROM tbllaminasalida lasa WHERE lasa.idparte = p.idparte) - (SELECT COALESCE(SUM(lade.cantidad),0) FROM tbllaminadevolucion lade WHERE lade.idparte = p.idparte)) as totalexistencia
                 FROM parte  p 
                INNER JOIN tblmodelo m ON p.idparte = m.idparte
                INNER JOIN tblrevision r ON r.idmodelo = m.idmodelo
                INNER JOIN cliente c ON c.idcliente = p.idcliente");
                if ($query->num_rows() > 0) {
                    return $query->result();
                } else {
                    return false;
                }
            }
            public function detalle_parte($idparte){
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
           public function detalle_entradas($idparte){
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
     public function detalle_salidas($idparte){
                 $this->db->select('p.idparte,c.idcliente,p.idcategoria, ca.nombrecategoria, p.numeroparte,c.nombre,u.name, s.cantidad, p.activo, m.descripcion as modelo, r.descripcion as revision,s.fecharegistro');
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
    public function detalle_devoluciones($idparte){
                 $this->db->select('p.idparte,c.idcliente,p.idcategoria, ca.nombrecategoria, p.numeroparte,c.nombre,u.name, d.cantidad, p.activo, m.descripcion as modelo, r.descripcion as revision,d.fecharegistro');
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
            public function showAllMaquinas() {
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
            public function totalentradas($idparte) {
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
            public function totalsalidas($idparte) {
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
   

}
