<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Orden_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function __destruct() {
        $this->db->close();
    }

    public function showAllSalidas() {
        $this->db->select('s.idsalida,s.numerosalida,c.nombre,s.orden,u.name,s.fecharegistro');
        $this->db->from('salida s');
        $this->db->join('cliente c', 's.idcliente=c.idcliente');
        $this->db->join('users u', 's.idusuario=u.id');
        $this->db->where('s.finalizado',1);
        $this->db->order_by("s.fecharegistro", "desc");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
 public function searchOrden($match)
    {
        $field = array(
            's.idsalida',
            's.numerosalida',
            'c.nombre',
            's.orden',
            'u.name',
            's.fecharegistro'
        );
     $this->db->select('s.idsalida,s.numerosalida,c.nombre,s.orden,u.name,s.fecharegistro');
        $this->db->from('salida s');
        $this->db->join('cliente c', 's.idcliente=c.idcliente');
        $this->db->join('users u', 's.idusuario=u.id');
        $this->db->where('s.finalizado',1);
       $this->db->like('concat(' . implode(',', $field) . ')', $match); 
        $this->db->order_by("s.fecharegistro", "desc");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    public function detallePallet($id) {
        $this->db->select('dp.folio, pc.cajas');
        $this->db->from('parte p');
        $this->db->join('detalleparte dp', 'p.idparte=dp.idparte');
        $this->db->join('palletcajas pc', 'dp.iddetalleparte=pc.iddetalleparte');
        $this->db->where('pc.idpalletcajas', $id);
        $query = $this->db->get(); 
        return $query->first_row();
    }

    public function validarOrdenSalida($idsalida){
        $this->db->select('os.idsalida, os.idpalletcajas');
        $this->db->from('ordensalida os');
        $this->db->join('parteposicionbodega ppb', 'os.idpalletcajas=ppb.idpalletcajas');
        $this->db->where('os.idsalida',$idsalida);
        $this->db->where('ppb.ordensalida',1);
        $this->db->where('ppb.salida',0); 
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    public function listaDeNumeroParteSalida($numeroparte, $idsalida){
          $this->db->select('pc.idpalletcajas,pb.nombreposicion');
          $this->db->from('ordensalida os');
          $this->db->join('parteposicionbodega ppb', 'os.idpalletcajas=ppb.idpalletcajas');
          $this->db->join('posicionbodega pb', 'pb.idposicion=ppb.idposicion');
          $this->db->join('palletcajas pc', 'os.idpalletcajas=pc.idpalletcajas'); 
          $this->db->join('tblcantidad  tc', 'tc.idcantidad = pc.idcajas');
          $this->db->join('tblrevision  tr', 'tr.idrevision = tc.idrevision');
          $this->db->join('tblmodelo  tm', 'tm.idmodelo = tr.idmodelo');
          $this->db->join('parte  p', 'tm.idparte = p.idparte');
          $this->db->join('cliente  c', 'c.idcliente = p.idcliente'); 
          $this->db->where('p.numeroparte',$numeroparte); 
          $this->db->where('ppb.ordensalida',1);
          $this->db->where('ppb.salida',0);
          $this->db->where('os.idsalida',$idsalida);
          $this->db->where('os.tipo',0);
          $this->db->limit(1); 
          $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
    }
    
    public function updateEstatusPosicion($data,$idpalletcajas){
        $this->db->where('idpalletcajas', $idpalletcajas);
        $this->db->update('parteposicionbodega', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
      public function detalleSalida($idsalida) {
        // code...
        $this->db->select('s.idsalida,s.numerosalida,s.finalizado,c.nombre,u.name,s.fecharegistro');
        $this->db->from('salida s');
        $this->db->join('cliente c', 's.idcliente=c.idcliente');
        $this->db->join('users u', 's.idusuario=u.id');
        $this->db->where('s.idsalida', $idsalida);
        $query = $this->db->get();

        return $query->first_row();
    }
    
      public function detallesDeOrden($idsalida) {
        // code...
        $this->db->select('pc.idpalletcajas, o.idordensalida,s.idsalida, p.numeroparte,o.tipo, o.pallet,o.caja, pc.cajas as cajaspallet, dp.modelo,dp.revision,pb.nombreposicion, ppb.ordensalida, ppb.salida, dp.iddetalleparte, dp.folio');
        $this->db->from('salida s');
        $this->db->join('ordensalida o', 's.idsalida=o.idsalida');
        $this->db->join('palletcajas pc', 'o.idpalletcajas=pc.idpalletcajas');
        $this->db->join('detalleparte dp', 'dp.iddetalleparte=pc.iddetalleparte');
        $this->db->join('parte p', 'p.idparte=dp.idparte');
        $this->db->join('users u', 'o.idusuario=u.id');
        $this->db->join('parteposicionbodega as ppb','pc.idpalletcajas = ppb.idpalletcajas');
        $this->db->join('posicionbodega as pb','pb.idposicion = ppb.idposicion');
        $this->db->where('s.idsalida', $idsalida);
          $this->db->where('o.tipo', 0);
        //$this->db->where('pd.idestatus', 8);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
     public function detallesDeOrdenParciales($idsalida) {
        // code...
        $this->db->select('pc.idpalletcajas, o.idordensalida,s.idsalida, p.numeroparte,o.tipo, o.pallet, dp.modelo,dp.revision,pb.nombreposicion, ppb.ordensalida, ppb.salida, dp.iddetalleparte, dp.folio');
         $this->db->select_sum('o.caja');
        $this->db->from('salida s');
        $this->db->join('ordensalida o', 's.idsalida=o.idsalida');
        $this->db->join('palletcajas pc', 'o.idpalletcajas=pc.idpalletcajas');
        $this->db->join('detalleparte dp', 'dp.iddetalleparte=pc.iddetalleparte');
        $this->db->join('parte p', 'p.idparte=dp.idparte');
        $this->db->join('users u', 'o.idusuario=u.id');
        $this->db->join('parteposicionbodega as ppb','pc.idpalletcajas = ppb.idpalletcajas');
        $this->db->join('posicionbodega as pb','pb.idposicion = ppb.idposicion');
        $this->db->where('s.idsalida', $idsalida);
        $this->db->where('o.tipo', 1);
        $this->db->group_by(array("p.numeroparte", "dp.modelo"));  
        //$this->db->where('pd.idestatus', 8);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

}
