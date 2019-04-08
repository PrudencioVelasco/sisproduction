<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Calidad_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function __destruct() {
        $this->db->close();
    }

    public function showAllEnviados($idusuario) {
        $query = $this->db->query("SELECT p.idparte, d.iddetalleparte, p.numeroparte, d.folio, d.modelo, d.revision, l.idlinea, l.nombrelinea,DATE_FORMAT(d.fecharegistro,'%d/%m/%Y %h:%i %p' ) as fecharegistro,
 (SELECT  COUNT(pc.pallet)  FROM  palletcajas pc WHERE pc.iddetalleparte = d.iddetalleparte) as totalpallet,
 (SELECT  SUM(pc2.cajas)  FROM  palletcajas pc2 WHERE pc2.iddetalleparte = d.iddetalleparte) as totalcajas,
 (SELECT COUNT(pc7.idestatus)  FROM palletcajas pc7 WHERE pc7.iddetalleparte = d.iddetalleparte AND pc7.idestatus = 1) AS totalenviadoacalidad,
 (SELECT COUNT(pc3.idestatus)  FROM palletcajas pc3 WHERE pc3.iddetalleparte = d.iddetalleparte AND pc3.idestatus = 4) AS totalenviado,
 (SELECT COUNT(pc4.idestatus)  FROM palletcajas pc4 WHERE pc4.iddetalleparte = d.iddetalleparte AND pc4.idestatus = 8) AS totalfinalizado,
 (SELECT COUNT(pc5.idestatus)  FROM palletcajas pc5 WHERE pc5.iddetalleparte = d.iddetalleparte AND pc5.idestatus = 6) AS totalcancelado,
  (SELECT COUNT(pc6.idestatus)  FROM palletcajas pc6 WHERE pc6.iddetalleparte = d.iddetalleparte AND pc6.idestatus = 7) AS totalenviadoaalmacen,
    (SELECT COUNT(pc8.idestatus)  FROM palletcajas pc8 WHERE pc8.iddetalleparte = d.iddetalleparte AND pc8.idestatus = 3) AS rechazadoapacking,
    (SELECT COUNT(pc9.idestatus)  FROM palletcajas pc9 WHERE pc9.iddetalleparte = d.iddetalleparte AND pc9.idestatus = 12) AS enhold
 FROM parte p, detalleparte d, linea l
 WHERE p.idparte = d.idparte
 AND d.idlinea = l.idlinea 
 ORDER BY d.fecharegistro DESC");
        //  return $query->result();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function buscar($text, $idusuario) {
        $query = $this->db->query("SELECT p.idparte, d.iddetalleparte, p.numeroparte, d.folio, d.modelo, d.revision, l.idlinea, l.nombrelinea,DATE_FORMAT(d.fecharegistro,'%d/%m/%Y %h:%i %p' ) as fecharegistro,
 (SELECT  COUNT(pc.pallet)  FROM  palletcajas pc WHERE pc.iddetalleparte = d.iddetalleparte) as totalpallet,
 (SELECT  SUM(pc2.cajas)  FROM  palletcajas pc2 WHERE pc2.iddetalleparte = d.iddetalleparte) as totalcajas,
 (SELECT COUNT(pc7.idestatus)  FROM palletcajas pc7 WHERE pc7.iddetalleparte = d.iddetalleparte AND pc7.idestatus = 1) AS totalenviadoacalidad,
 (SELECT COUNT(pc3.idestatus)  FROM palletcajas pc3 WHERE pc3.iddetalleparte = d.iddetalleparte AND pc3.idestatus = 4) AS totalenviado,
 (SELECT COUNT(pc4.idestatus)  FROM palletcajas pc4 WHERE pc4.iddetalleparte = d.iddetalleparte AND pc4.idestatus = 8) AS totalfinalizado,
 (SELECT COUNT(pc5.idestatus)  FROM palletcajas pc5 WHERE pc5.iddetalleparte = d.iddetalleparte AND pc5.idestatus = 6) AS totalcancelado,
  (SELECT COUNT(pc6.idestatus)  FROM palletcajas pc6 WHERE pc6.iddetalleparte = d.iddetalleparte AND pc6.idestatus = 7) AS totalenviadoaalmacen,
    (SELECT COUNT(pc8.idestatus)  FROM palletcajas pc8 WHERE pc8.iddetalleparte = d.iddetalleparte AND pc8.idestatus = 3) AS rechazadoapacking,
    (SELECT COUNT(pc9.idestatus)  FROM palletcajas pc9 WHERE pc9.iddetalleparte = d.iddetalleparte AND pc9.idestatus = 12) AS enhold
 FROM parte p, detalleparte d, linea l
 WHERE p.idparte = d.idparte
 AND d.idlinea = l.idlinea 
  AND (d.folio LIKE '%$text%' OR p.numeroparte LIKE '%$text%' OR d.modelo LIKE '%$text%' OR d.revision LIKE '%$text%')
 ORDER BY d.fecharegistro DESC");
        //  return $query->result();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function cantidadesPartes($iddetalleparte) {
        $this->db->select('pc.pallet, pc.cajas');
        $this->db->from('detalleparte dp');
        $this->db->join('palletcajas pc', 'dp.iddetalleparte=pc.iddetalleparte');
        $this->db->where('dp.iddetalleparte', $iddetalleparte);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function motivosRechazo() {
        $this->db->select('mr.idmotivorechazo, mr.motivo');
        $this->db->from('motivorechazo mr');
        $this->db->where('mr.idproceso', 2);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function searchPartes($match, $user, $estatus = '') {
        $field = array(
            'p.numeroparte'
        );

        $this->db->select('d.iddetalleparte,
        d.folio,
        p.idparte,
        c.idcliente, 
        s.idestatus, 
        p.numeroparte,
        c.nombre,
        u.name,
        d.fecharegistro,
        d.pallet,
        d.cantidad,
        s.nombrestatus');
        $this->db->from('parte p');
        $this->db->join('cliente c', 'p.idcliente = c.idcliente');
        $this->db->join('detalleparte d', 'p.idparte = d.idparte');
        $this->db->join('users u', 'd.idusuario = u.id');
        $this->db->join('status s', 's.idestatus = d.idestatus');
        $this->db->where('d.idusuario', $user);
        if (!empty($estatus)) {
            $this->db->where('d.idestatus', $estatus);
        } else {
            $this->db->where('d.idestatus', 1);
        }
        $this->db->like('concat(' . implode(',', $field) . ')', $match);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function usuarioDeAlmacen($iddetalleparte) {
        $this->db->select('p.idoperador');
        $this->db->from('palletcajas p');
        $this->db->where('p.iddetalleparte', $iddetalleparte);
        $query = $this->db->get();
        return $query->first_row();
    }

    public function detalleDelDetallaParte($iddetalle) {
        // code...
        $this->db->select('d.iddetalleparte,
        d.folio,
        p.idparte,
        c.idcliente,
        s.idestatus,
        p.numeroparte,
        c.nombre,
        u.name,
        t.nombreturno,
        t.horainicial,
        t.horafinal,
        d.fecharegistro,
        d.pallet,
        d.modelo,
        d.revision,
        d.cantidad,
        l.idlinea,
        l.nombrelinea,
        s.nombrestatus');
        $this->db->from('parte p');
        $this->db->join('cliente c', 'p.idcliente=c.idcliente');
        $this->db->join('detalleparte d', 'p.idparte=d.idparte');
        $this->db->join('users u', 'd.idusuario=u.id');
        $this->db->join('turno t', 't.idturno=u.idturno');
        $this->db->join('status s', 's.idestatus=d.idestatus');
        $this->db->join('linea l', 'd.idlinea=l.idlinea');
        $this->db->where('d.iddetalleparte', $iddetalle);
        $query = $this->db->get();

        return $query->first_row();
    }

    public function detalleParteId($idparte) {
        $this->db->select('p.idparte,c.idcliente, p.numeroparte,c.nombre,u.name, p.activo');
        $this->db->from('parte p');
        $this->db->join('cliente c', 'p.idcliente=c.idcliente');
        $this->db->join('users u', 'p.idusuario=u.id');
        $this->db->where('p.idparte', $idparte);
        $query = $this->db->get();

        return $query->first_row();
    }

    // Usuarios Bodega
    public function allUsersBodega() {
        $this->db->select('u.id as idusuario,u.name');
        $this->db->from('users u');
        $this->db->join('users_rol ur', 'u.id = ur.id_user');
        $this->db->join('rol r', 'ur.id_rol = r.id');
        $this->db->where('r.id', 4);
        $this->db->where('u.activo', 1);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    // Actualizar la informacion de la tabla detalle parte[idoperador][idstatus]
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
    public function addDetalleEstatusParte($data) {
        return $this->db->insert('detallestatus', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function addRechazoParte($data) {
        return $this->db->insert('detallestatus', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function addMotivoRechazo($data) {
        return $this->db->insert('palletcajasestatus', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    // ENVIADOS Y FINALIZADOS

    public function showAllEnviados2($idusuario) {
        $this->db->select('d.iddetalleparte,p.idparte,c.idcliente, s.idestatus, p.numeroparte,c.nombre,u.name,uo.name as nombreoperador,d.fecharegistro,d.pallet,d.cantidad,s.nombrestatus');
        $this->db->from('parte p');
        $this->db->join('cliente c', 'p.idcliente=c.idcliente');
        $this->db->join('detalleparte d', 'p.idparte=d.idparte');
        $this->db->join('users u', 'd.idusuario=u.id');
        $this->db->join('users uo', 'd.idoperador=uo.id');
        $this->db->join('status s', 's.idestatus=d.idestatus');
        $this->db->where('d.idusuario', $idusuario);
        $this->db->where('d.idestatus', 4);
        $this->db->or_where('d.idestatus', 6);
        $this->db->order_by("d.fecharegistro", "desc");
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
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

    public function motivosCancelacionBodega($iddetalleparte) {
        $query = $this->db->query("SELECT ds.iddetalleparte, ds.comentariosrechazo, ds.fecharegistro, ds.idstatus 
 FROM detallestatus ds
 WHERE ds.iddetalleparte = '$iddetalleparte'
 AND ds.idstatus IN (3,6)
 ORDER BY ds.fecharegistro DESC");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

}
