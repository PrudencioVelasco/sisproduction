<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Calidadp_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function __destruct() {
        $this->db->close();
    }

    public function showAll() {
         $query = $this->db->query("SELECT tt.idtransferancia, tt.folio, u.name as nombre, tt.fecharegistro, 
                            (SELECT GROUP_CONCAT(DISTINCT s2.nombrestatus) estatusd FROM palletcajas pc2 INNER JOIN status s2  ON pc2.idestatus = s2.idestatus WHERE pc2.idtransferancia = tt. 	idtransferancia AND  pc2.idestatus   in (1,3,4,5,6,15,8,12) ) AS estatus,
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
        $query = $this->db->query("SELECT c.nombre as nombrecliente, tp.numeroparte, tm.descripcion as descripcionmodelo, tc.cantidad, tr.descripcion as descripcionrevision, count(pc.pallet) as totalpallet, sum( tc.cantidad) as totalcajas
                                FROM palletcajas pc 
                               INNER JOIN tblcantidad tc  ON pc.idcajas = tc.idcantidad
                               INNER JOIN tblrevision tr  ON tr.idrevision = tc.idrevision
                               INNER JOIN tblmodelo tm  ON tm.idmodelo = tr.idmodelo
                               INNER JOIN parte tp  ON tp.idparte = tm.idparte
                               INNER JOIN cliente c  ON c.idcliente = tp.idcliente
                               WHERE pc.idtransferancia= $idtransferencia
                               AND pc.idestatus not in (17,12)
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
        $this->db->select('mr.motivo, pce.notas');
        $this->db->from('palletcajasestatus pce');
        $this->db->join('motivorechazo  mr', 'mr.idmotivorechazo = pce.idmotivorechazo');
        $this->db->where('pce.idpalletcajas', $id);
        $this->db->order_by("pce.idpalletcajasestatus", "asc");
        $query = $this->db->get();
        return $query->first_row();
    }
     public function motivosrechazoacalidad($id) {
        $this->db->select('mr.motivo, pce.notas');
        $this->db->from('palletcajasestatus pce');
        $this->db->join('motivorechazo  mr', 'mr.idmotivorechazo = pce.idmotivorechazo');
        $this->db->where('pce.idpalletcajas', $id);
        $this->db->where('mr.idproceso', 3);
        $this->db->order_by("pce.idpalletcajasestatus", "asc");
        $query = $this->db->get();
        return $query->first_row();
    }


    
}
