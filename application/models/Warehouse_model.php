<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Warehouse_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function __destruct() {
        $this->db->close();
    }

    public function getDataPallets() {
        $this->db->select('pc.idpalletcajas,pc.idtransferancia,pc.pallet,pc.idcajas,pc.idestatus, p.idparte,c.nombre,p.numeroparte,tc.cantidad, tr.descripcion, s.nombrestatus, pc.idestatus,pb.nombreposicion');
        $this->db->from('palletcajas pc');
        $this->db->join('tblcantidad  tc', 'tc.idcantidad = pc.idcajas');
        $this->db->join('tblrevision  tr', 'tr.idrevision = tc.idrevision');
        $this->db->join('tblmodelo  tm', 'tm.idmodelo = tr.idmodelo');
        $this->db->join('parte  p', 'tm.idparte = p.idparte');
        $this->db->join('cliente  c', 'c.idcliente = p.idcliente');
        $this->db->join('status  s', 's.idestatus = pc.idestatus');
        $this->db->join('parteposicionbodega  ppb', 'pc.idpalletcajas = ppb.idpalletcajas');
        $this->db->join('posicionbodega  pb', 'ppb.idposicion = pb.idposicion');
        $this->db->where('pc.idestatus', 8);
        $query = $this->db->get();
        
        return $query->num_rows() > 0 ? $query->result() : FALSE ; 
    }

    public function getDataEntry($first_date='',$second_date=''){
        $this->db->select('pc.idpalletcajas,pc.idtransferancia,pc.pallet,pc.idcajas,pc.idestatus, p.idparte,c.nombre,p.numeroparte,tc.cantidad, tr.descripcion, s.nombrestatus, pc.idestatus,pb.nombreposicion');
        $this->db->from('palletcajas pc');
        $this->db->join('tblcantidad  tc', 'tc.idcantidad = pc.idcajas');
        $this->db->join('tblrevision  tr', 'tr.idrevision = tc.idrevision');
        $this->db->join('tblmodelo  tm', 'tm.idmodelo = tr.idmodelo');
        $this->db->join('parte  p', 'tm.idparte = p.idparte');
        $this->db->join('cliente  c', 'c.idcliente = p.idcliente');
        $this->db->join('status  s', 's.idestatus = pc.idestatus');
        $this->db->join('parteposicionbodega  ppb', 'pc.idpalletcajas = ppb.idpalletcajas');
        $this->db->join('posicionbodega  pb', 'ppb.idposicion = pb.idposicion');
        $this->db->where('pc.idestatus', 8);
        
        if (!empty($first_date) && !empty($second_date)) {
            $this->db->where('ppb.fecharegistro >=', $first_date);
            $this->db->where('ppb.fecharegistro <=', $second_date);
        }
        $this->db->where('pc.idestatus', 8);
        $this->db->where('ppb.ordensalida', 0);
        
        $query = $this->db->get();
        
        return $query->num_rows() > 0 ? $query->result() : FALSE ; 
    }

    public function getDataExits($first_date='',$second_date='',$tipo=''){
        $this->db->select('pc.idpalletcajas,pc.idestatus,pc.idtransferancia,c.nombre,p.numeroparte,
            tc.cantidad,tr.descripcion,s.nombrestatus,pb.nombreposicion,os.idordensalida,
            sal.numerosalida,sal.orden,sal.finalizado');
        $this->db->from('palletcajas pc');
        $this->db->join('tblcantidad tc','tc.idcantidad = pc.idcajas');
        $this->db->join('tblrevision tr ','tr.idrevision = tc.idrevision');
        $this->db->join('tblmodelo tm ',' tm.idmodelo = tr.idmodelo');
        $this->db->join('parte p ',' tm.idparte = p.idparte');
        $this->db->join('cliente c ',' c.idcliente = p.idcliente');
        $this->db->join('status s ',' s.idestatus = pc.idestatus');
        $this->db->join('parteposicionbodega ppb ',' pc.idpalletcajas = ppb.idpalletcajas');
        $this->db->join('posicionbodega pb ',' ppb.idposicion = pb.idposicion');
        $this->db->join('ordensalida os ',' pc.idpalletcajas = os.idpalletcajas');
        $this->db->join('salida sal ',' os.idsalida = sal.idsalida');
        
        if (!empty($first_date) && !empty($second_date) && $tipo != 0) {
            $this->db->where('os.fecharegistro >=', $first_date);
            $this->db->where('os.fecharegistro <=', $second_date);
            $this->db->where('os.tipo', $tipo);
        }else if(!empty($first_date) && !empty($second_date)){
            $this->db->where('os.fecharegistro >=', $first_date);
            $this->db->where('os.fecharegistro <=', $second_date);
        }else{
            //
        }
        $this->db->where('pc.idestatus', 8);
        $this->db->where('ppb.ordensalida', 1);
        
        $query = $this->db->get();
        
        return $query->num_rows() > 0 ? $query->result() : FALSE ; 
    }    

}