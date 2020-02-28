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
                            (SELECT GROUP_CONCAT(DISTINCT s2.nombrestatus) estatusd FROM palletcajas pc2 INNER JOIN status s2  ON pc2.idestatus = s2.idestatus WHERE pc2.idtransferancia = tt. 	idtransferancia ) AS estatusall,
                            (SELECT
                            COUNT(*)
                            FROM tbldevolucion d WHERE tt. idtransferancia =  d.idtransferencia ) AS devolucion
                            FROM   tbltransferencia tt   
                            INNER JOIN users u ON u.id = tt.idusuario"); 
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
      public function palletReporte($idtransferencia) {
        $query = $this->db->query("SELECT c.nombre as nombrecliente, tp.numeroparte, tm.descripcion as descripcionmodelo, tc.cantidad, tr.descripcion as descripcionrevision, pb.nombreposicion
                                FROM palletcajas pc 
                               INNER JOIN tblcantidad tc  ON pc.idcajas = tc.idcantidad
                               INNER JOIN tblrevision tr  ON tr.idrevision = tc.idrevision
                               INNER JOIN tblmodelo tm  ON tm.idmodelo = tr.idmodelo
                               INNER JOIN parte tp  ON tp.idparte = tm.idparte
                               INNER JOIN cliente c  ON c.idcliente = tp.idcliente
                               INNER JOIN parteposicionbodega ppb  ON ppb.idpalletcajas = pc.idpalletcajas
                               INNER JOIN posicionbodega pb  ON pb.idposicion = ppb.idposicion
                               WHERE pc.idtransferancia= $idtransferencia");
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
        $this->db->select('mr.motivo, pce.notas');
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
     public function motivosRechazoCalidad() {
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
 
     public function listaEntradas($idrevision = '') {
        $this->db->select('t.folio,pc.idpalletcajas, pc.idtransferancia, pc.pallet, pc.idcajas, pc.idestatus,
            ppb.fecharegistro,ppb.idparteposicionbodega, p.idparte, c.nombre, p.numeroparte, tc.cantidad, tr.descripcion,
             pc.idestatus, pb.nombreposicion, tm.descripcion as nombremodelo, ppb.ordensalida, ppb.salida');
        $this->db->from('palletcajas pc');
        $this->db->join('tblcantidad  tc', 'tc.idcantidad = pc.idcajas');
        $this->db->join('tblrevision  tr', 'tr.idrevision = tc.idrevision');
        $this->db->join('tblmodelo  tm', 'tm.idmodelo = tr.idmodelo');
        $this->db->join('parte  p', 'tm.idparte = p.idparte');
        $this->db->join('cliente  c', 'c.idcliente = p.idcliente');
        $this->db->join('parteposicionbodega  ppb', 'ppb.idpalletcajas = pc.idpalletcajas'); 
        $this->db->join('posicionbodega  pb', 'pb.idposicion = ppb.idposicion');
        $this->db->join('tbltransferencia  t', 't.idtransferancia = pc.idtransferancia'); 
        $this->db->where('tr.idrevision', $idrevision);
        $this->db->where('ppb.ordensalida', 0);
        $this->db->where('ppb.salida', 0);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
         public function listaEntradasUbicaciones($idposicion = '') {
        $this->db->select('t.folio,pc.idpalletcajas, pc.idtransferancia, pc.pallet, pc.idcajas, pc.idestatus,
            ppb.fecharegistro,ppb.idparteposicionbodega, p.idparte, c.nombre, p.numeroparte, tc.cantidad, tr.descripcion,
             pc.idestatus, pb.nombreposicion, tm.descripcion as nombremodelo, ppb.ordensalida, ppb.salida');
        $this->db->from('palletcajas pc');
        $this->db->join('tblcantidad  tc', 'tc.idcantidad = pc.idcajas');
        $this->db->join('tblrevision  tr', 'tr.idrevision = tc.idrevision');
        $this->db->join('tblmodelo  tm', 'tm.idmodelo = tr.idmodelo');
        $this->db->join('parte  p', 'tm.idparte = p.idparte');
        $this->db->join('cliente  c', 'c.idcliente = p.idcliente');
        $this->db->join('parteposicionbodega  ppb', 'ppb.idpalletcajas = pc.idpalletcajas'); 
        $this->db->join('posicionbodega  pb', 'pb.idposicion = ppb.idposicion');
        $this->db->join('tbltransferencia  t', 't.idtransferancia = pc.idtransferancia'); 
        $this->db->where('ppb.idposicion', $idposicion);
        $this->db->where('ppb.ordensalida', 0);
        $this->db->where('ppb.salida', 0);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
            public function listaComparaciones() {
        $this->db->select('');
        $this->db->from('palletcajas pc'); 
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

         public function listaUbicaciones() {
        $this->db->select('pc.*');
        $this->db->from('posicionbodega pc');  
        $this->db->where('pc.activo', 1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

   public function updatePosicion($id, $field)
    {
        $this->db->where('idparteposicionbodega', $id);
        $this->db->update('parteposicionbodega', $field);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
       public function updateBusqueda($id, $field)
    {
        $this->db->where('idbusqueda', $id);
        $this->db->update('tblbusqueda', $field);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
      public function addBusqueda($data)
    {
        $this->db->insert('tblbusqueda', $data);
        $insert_id = $this->db->insert_id(); 
        return  $insert_id;
    }
       public function addBusquedaDetalle($data)
    {
        $this->db->insert('tbldetalle_busqueda', $data);
        $insert_id = $this->db->insert_id(); 
        return  $insert_id;
    }

   public function listaNuerosPartes() {
        $this->db->select('p.numeroparte,c.nombre,
             CASE
        WHEN LENGTH(tm.descripcion) > 12 THEN CONCAT(SUBSTRING(tm.descripcion, 1, 12), "...")
        ELSE tm.descripcion
    END AS modelo,  tr.descripcion as revision, tr.idrevision');
        $this->db->from('parte  p');
        $this->db->join('tblmodelo  tm', 'tm.idparte = p.idparte'); 
        $this->db->join('tblrevision  tr', 'tr.idmodelo = tm.idmodelo');  
        $this->db->join('cliente  c', 'c.idcliente = p.idcliente');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
       public function listaBusqueda() {
        $this->db->select('b.*');
        $this->db->from('tblbusqueda  b'); 
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

   public function listaParteBusqueda($idbusqueda = '') {
        $this->db->select('p.numeroparte,c.nombre,
             CASE
        WHEN LENGTH(tm.descripcion) > 12 THEN CONCAT(SUBSTRING(tm.descripcion, 1, 12), "...")
        ELSE tm.descripcion
    END AS modelo,  tr.descripcion as revision, tr.idrevision, db.idbusqueda, db.cantidad, db.iddetallebusqueda');
        $this->db->from('parte  p');
        $this->db->join('tblmodelo  tm', 'tm.idparte = p.idparte'); 
        $this->db->join('tblrevision  tr', 'tr.idmodelo = tm.idmodelo');  
        $this->db->join('cliente  c', 'c.idcliente = p.idcliente');
        $this->db->join('tbldetalle_busqueda  db', 'db.idrevision = tr.idrevision');
        $this->db->where('db.idbusqueda',$idbusqueda);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
      

        }
    }
       public function listaParteBusquedaCantidad($idbusqueda = '') {
        $this->db->select('db.idbusqueda,pb.nombreposicion, sum(ca.cantidad) as total, tr.idrevision');
        $this->db->from('parte  p');
        $this->db->join('tblmodelo  tm', 'tm.idparte = p.idparte'); 
        $this->db->join('tblrevision  tr', 'tr.idmodelo = tm.idmodelo'); 
        $this->db->join('tblcantidad  ca', 'ca.idrevision = tr.idrevision');  
        $this->db->join('cliente  c', 'c.idcliente = p.idcliente');
        $this->db->join('tbldetalle_busqueda  db', 'db.idrevision = tr.idrevision');
        $this->db->join('palletcajas  pc', 'ca.idcantidad = pc.idcajas');
        $this->db->join('parteposicionbodega  pbb', 'pbb.idpalletcajas = pc.idpalletcajas');
        $this->db->join('posicionbodega  pb', 'pbb.idposicion = pb.idposicion');
        $this->db->where('db.idbusqueda',$idbusqueda);
        $this->db->where('pbb.ordensalida',0);
        $this->db->where('pbb.salida',0);
        $this->db->group_by('pb.idposicion');
        $this->db->group_by('tr.idrevision');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
      

        }
    }
    public function deleteParte($iddetallebusqueda='')
{
    # code...
     $this->db->where('iddetallebusqueda', $iddetallebusqueda);
        $this->db->delete('tbldetalle_busqueda');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
}

}