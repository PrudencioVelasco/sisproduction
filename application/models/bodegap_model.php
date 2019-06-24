<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Bodegap_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function __destruct() {
        $this->db->close();
    }

    public function showAll() {
         $query = $this->db->query("SELECT tt.idtransferancia, tt.folio, u.name as nombre, tt.fecharegistro, 
                            (SELECT GROUP_CONCAT(DISTINCT s2.nombrestatus) estatusd FROM palletcajas pc2 INNER JOIN status s2  ON pc2.idestatus = s2.idestatus WHERE pc2.idtransferancia = tt. 	idtransferancia AND  pc2.idestatus   in (4,5,6,8) ) AS estatus,
                            (SELECT GROUP_CONCAT(DISTINCT s2.nombrestatus) estatusd FROM palletcajas pc2 INNER JOIN status s2  ON pc2.idestatus = s2.idestatus WHERE pc2.idtransferancia = tt. 	idtransferancia ) AS estatusall
                            FROM   tbltransferencia tt   
                            INNER JOIN users u ON u.id = tt.idusuario"); 
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
      public function palletReporte($idtransferencia) {
        $query = $this->db->query("SELECT c.nombre as nombrecliente, tp.numeroparte, tm.descripcion as descripcionmodelo, tc.cantidad, tr.descripcion as descripcionrevision, count(pc.pallet) as totalpallet, sum( tc.cantidad) as totalcajas
                                FROM palletcajas pc 
                               INNER JOIN tblcantidad tc  ON pc.idcajas = tc.idcantidad
                               INNER JOIN tblrevision tr  ON tr.idrevision = tc.idrevision
                               INNER JOIN tblmodelo tm  ON tm.idmodelo = tr.idmodelo
                               INNER JOIN parte tp  ON tp.idparte = tm.idparte
                               INNER JOIN cliente c  ON c.idcliente = tp.idcliente
                               WHERE pc.idtransferancia= $idtransferencia
                               AND pc.idestatus = 4
                               GROUP by pc.idcajas");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
     public function detalleTransferencia($idtransferencia) {
        $this->db->select('tt.folio, tt.fecharegistro, u.name , t.nombreturno, t.horainicial, t.horafinal');
        $this->db->from('tbltransferencia tt');
        $this->db->join('users u', 'u.id = tt.idusuario');
        $this->db->join('turno t', 't.idturno=u.idturno');
        $this->db->where('tt.idtransferancia', $idtransferencia); 
        $query = $this->db->get();
        return $query->first_row();
    }

    public function motivosrechazo($id) {
        $this->db->select('mr.motivo');
        $this->db->from('palletcajasestatus pce');
        $this->db->join('motivorechazo  mr', 'mr.idmotivorechazo = pce.idmotivorechazo');
        $this->db->where('pce.idpalletcajas', $id); 
         $this->db->where('mr.idproceso', 3); 
        $this->db->order_by("pce.idpalletcajasestatus", "asc");
        $query = $this->db->get();
        return $query->first_row();
    }
        public function motivosRechazoBodega() {
        $this->db->select('mr.idmotivorechazo, mr.motivo');
        $this->db->from('motivorechazo mr');
        $this->db->where('mr.idproceso', 3);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
        public function listaNumeroParteTransferencia($idtransferencia) {
          $query = $this->db->query("SELECT pc.idpalletcajas, c.nombre, p.numeroparte, tc.cantidad, tr.descripcion, s.nombrestatus, pc.idestatus,
                        (SELECT po.nombreposicion FROM parteposicionbodega ppb JOIN posicionbodega po ON ppb.idposicion = po.idposicion WHERE ppb.idpalletcajas = pc.idpalletcajas LIMIT 1) as  posicion
                        FROM palletcajas pc 
                        JOIN tblcantidad tc ON tc.idcantidad = pc.idcajas 
                        JOIN tblrevision tr ON tr.idrevision = tc.idrevision 
                        JOIN tblmodelo tm ON tm.idmodelo = tr.idmodelo 
                        JOIN parte p ON tm.idparte = p.idparte 
                        JOIN cliente c ON c.idcliente = p.idcliente 
                        JOIN status s ON s.idestatus = pc.idestatus 
                        WHERE pc.idtransferancia = $idtransferencia
                        AND pc.idestatus != 17"); 
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }


//    public function addTransferencia($data) {
//        $this->db->insert('tbltransferencia', $data);
//        $insert_id = $this->db->insert_id();
//        return $insert_id;
//    }
//
//    public function updateUser($id, $field) {
//        $this->db->where('id', $id);
//        $this->db->update('users', $field);
//        if ($this->db->affected_rows() > 0) {
//            return true;
//        } else {
//            return false;
//        }
//    }
//
//    public function validarExistenciaNumeroParte($numeroparte) {
//        $this->db->select('p.idparte, p.numeroparte');
//        $this->db->from('parte p');
//        $this->db->where('p.numeroparte', $numeroparte);
//        $this->db->where('p.activo', 1);
//        $query = $this->db->get();
//        if ($query->num_rows() > 0) {
//            return $query->result();
//        } else {
//            return false;
//        }
//    }
//
//    public function listaClientexNumeroParte($numeroparte) {
//        $this->db->select('p.idparte, c.nombre');
//        $this->db->from('parte p');
//        $this->db->join('cliente  c', 'c.idcliente = p.idcliente');
//        $this->db->where('p.numeroparte', $numeroparte);
//        $this->db->where('p.activo', 1);
//        $query = $this->db->get();
//        if ($query->num_rows() > 0) {
//            return $query->result();
//        } else {
//            return false;
//        }
//    }
//
//    public function listaModeloxNumeroParte($idparte) {
//        $this->db->select('m.idmodelo, m.descripcion');
//        $this->db->from('tblmodelo m');
//        $this->db->where('m.idparte', $idparte);
//        $query = $this->db->get();
//        if ($query->num_rows() > 0) {
//            return $query->result();
//        } else {
//            return false;
//        }
//    }
//
//    public function listaRevisionxNumeroParte($idmodelo) {
//        $this->db->select('r.idrevision, r.descripcion');
//        $this->db->from('tblrevision r');
//        $this->db->where('r.idmodelo', $idmodelo);
//        $query = $this->db->get();
//        if ($query->num_rows() > 0) {
//            return $query->result();
//        } else {
//            return false;
//        }
//    }
//
//    public function listaCantidadxNumeroParte($idrevision) {
//        $this->db->select('c.idcantidad, c.cantidad');
//        $this->db->from('tblcantidad c');
//        $this->db->where('c.idrevision', $idrevision);
//        $query = $this->db->get();
//        if ($query->num_rows() > 0) {
//            return $query->result();
//        } else {
//            return false;
//        }
//    }
//
//    public function listaNumeroParteTransferencia($idtransferencia) {
//        $this->db->select('pc.idpalletcajas, c.nombre,p.numeroparte,tc.cantidad, tr.descripcion, s.nombrestatus, pc.idestatus');
//        $this->db->from('palletcajas pc');
//        $this->db->join('tblcantidad  tc', 'tc.idcantidad = pc.idcajas');
//        $this->db->join('tblrevision  tr', 'tr.idrevision = tc.idrevision');
//        $this->db->join('tblmodelo  tm', 'tm.idmodelo = tr.idmodelo');
//        $this->db->join('parte  p', 'tm.idparte = p.idparte');
//        $this->db->join('cliente  c', 'c.idcliente = p.idcliente');
//        $this->db->join('status  s', 's.idestatus = pc.idestatus');
//        $this->db->where('pc.idtransferancia', $idtransferencia);
//        $this->db->where('pc.idestatus !=', 17);
//        $query = $this->db->get();
//        if ($query->num_rows() > 0) {
//            return $query->result();
//        } else {
//            return false;
//        }
//    }
//
//    public function validarEnvioCalidad($idpalletcajas, $numeroetiqueta, $numerocaja) {
//        $this->db->select('pc.idpalletcajas, c.nombre,p.numeroparte,tc.cantidad, tr.descripcion, s.nombrestatus, pc.idestatus');
//        $this->db->from('palletcajas pc');
//        $this->db->join('tblcantidad  tc', 'tc.idcantidad = pc.idcajas');
//        $this->db->join('tblrevision  tr', 'tr.idrevision = tc.idrevision');
//        $this->db->join('tblmodelo  tm', 'tm.idmodelo = tr.idmodelo');
//        $this->db->join('parte  p', 'tm.idparte = p.idparte');
//        $this->db->join('cliente  c', 'c.idcliente = p.idcliente');
//        $this->db->join('status  s', 's.idestatus = pc.idestatus');
//        $this->db->where('pc.idpalletcajas', $idpalletcajas);
//        $this->db->where('p.numeroparte', $numeroetiqueta);
//        $this->db->where('p.numeroparte', $numerocaja);
//        $this->db->where('pc.idestatus !=', 17);
//        //$this->db->where('p.activo', 1);
//        $query = $this->db->get();
//        if ($query->num_rows() > 0) {
//            return $query->result();
//        } else {
//            return false;
//        }
//    }
//
//    public function updateEnvio($id, $field) {
//        $this->db->where('idpalletcajas', $id);
//        $this->db->update('palletcajas', $field);
//        if ($this->db->affected_rows() > 0) {
//            return true;
//        } else {
//            return false;
//        }
//    }
//
//    public function motivosrechazo($id) {
//        $this->db->select('mr.motivo');
//        $this->db->from('palletcajasestatus pce');
//        $this->db->join('motivorechazo  mr', 'mr.idmotivorechazo = pce.idmotivorechazo');
//        $this->db->where('pce.idpalletcajas', $id);
//        $this->db->order_by("pce.idpalletcajasestatus", "asc");
//        $query = $this->db->get();
//        return $query->first_row();
//    }
//
//    public function palletReporte($idtransferencia) {
//        $query = $this->db->query("SELECT c.nombre as nombrecliente, tp.numeroparte, tm.descripcion as descripcionmodelo, tc.cantidad, tr.descripcion as descripcionrevision, count(pc.pallet) as totalpallet, sum( tc.cantidad) as totalcajas
//                                FROM palletcajas pc 
//                               INNER JOIN tblcantidad tc  ON pc.idcajas = tc.idcantidad
//                               INNER JOIN tblrevision tr  ON tr.idrevision = tc.idrevision
//                               INNER JOIN tblmodelo tm  ON tm.idmodelo = tr.idmodelo
//                               INNER JOIN parte tp  ON tp.idparte = tm.idparte
//                               INNER JOIN cliente c  ON c.idcliente = tp.idcliente
//                               WHERE pc.idtransferancia= $idtransferencia
//                               GROUP by pc.idcajas");
//        if ($query->num_rows() > 0) {
//            return $query->result();
//        } else {
//            return false;
//        }
//    }
//    
//      public function detalleTransferencia($idtransferencia) {
//        $this->db->select('tt.folio, tt.fecharegistro, u.name , t.nombreturno, t.horainicial, t.horafinal');
//        $this->db->from('tbltransferencia tt');
//        $this->db->join('users u', 'u.id = tt.idusuario');
//        $this->db->join('turno t', 't.idturno=u.idturno');
//        $this->db->where('tt.folio', $idtransferencia); 
//        $query = $this->db->get();
//        return $query->first_row();
//    }
//       public function obtenerUltimoFolio() {
//        $this->db->select('tt.folio');
//        $this->db->from('tbltransferencia tt'); 
//        $this->db->order_by("tt.folio", "desc");
//        $query = $this->db->get();
//        return $query->first_row();
//    }
//    
//       public function listaPalletCajas($idtransferencia) {
//        $this->db->select('pc.*');
//        $this->db->from('palletcajas pc');
//        $this->db->where('pc.idtransferancia', $idtransferencia);
//        $query = $this->db->get();
//        if ($query->num_rows() > 0) {
//            return $query->result();
//        } else {
//            return false;
//        }
//    }
//      public function deleteTransferencia($id)
//    {
//        $this->db->where('idtransferancia', $id);
//        $this->db->delete('tbltransferencia');
//        if ($this->db->affected_rows() > 0) {
//            return true;
//        } else {
//            return false;
//        }
//        
//    }
    
}
