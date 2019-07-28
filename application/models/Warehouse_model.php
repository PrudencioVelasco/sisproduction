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

        $query = $this->db->query("
            select r.idrevision, cl.nombre, p.numeroparte, m.descripcion as nombremodelo, r.descripcion as nombrerevision,
            (select sum(c2.cantidad) from parteposicionbodega ppb2, palletcajas pc2, tblcantidad c2 
            WHERE ppb2.idpalletcajas = pc2.idpalletcajas AND pc2.idcajas = c2.idcantidad  AND c2.idrevision = r.idrevision AND ppb2.ordensalida = 0 AND ppb2.salida = 0)  as total,
            (select 

            COALESCE(sum(
            CASE 
            WHEN os.tipo  = 1 THEN os.caja 
            ELSE 0
            END),0)
            from parteposicionbodega ppb2, palletcajas pc2, tblcantidad c2, ordensalida os
            WHERE ppb2.idpalletcajas = pc2.idpalletcajas AND pc2.idcajas = c2.idcantidad AND pc2.idpalletcajas = os.idpalletcajas  AND c2.idrevision = r.idrevision AND ppb2.ordensalida = 1)  as totalsalidaparciales,
            (select 

            COALESCE(sum(
            CASE 
            WHEN os.tipo  = 0 THEN c2.cantidad 
            ELSE 0
            END),0)
            from parteposicionbodega ppb2, palletcajas pc2, tblcantidad c2, ordensalida os
            WHERE ppb2.idpalletcajas = pc2.idpalletcajas AND pc2.idcajas = c2.idcantidad AND pc2.idpalletcajas = os.idpalletcajas  AND c2.idrevision = r.idrevision AND ppb2.ordensalida = 1)  as totalsalidapallet
            from palletcajas pc 
            inner join tblcantidad c on c.idcantidad = pc.idcajas
            inner join tblrevision r on r.idrevision =  c.idrevision
            inner join tblmodelo m  on m.idmodelo = r.idmodelo
            inner join parte p on p.idparte = m.idparte
            inner join cliente cl on cl.idcliente = p.idcliente
            inner join parteposicionbodega ppb on ppb.idpalletcajas = pc.idpalletcajas
            group by r.idrevision");

        return $query->result();
    }

    public function getDataEntry($first_date='',$second_date=''){
        $this->db->select('pc.idpalletcajas,pc.idtransferancia,pc.pallet,pc.idcajas,pc.idestatus, p.idparte,c.nombre,p.numeroparte,count(tc.idcantidad) as totalpallet,tc.cantidad as cantidadxpallet, sum(tc.cantidad) as cantidad, tr.descripcion, s.nombrestatus, pc.idestatus,pb.nombreposicion');
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
            $this->db->where('date(ppb.fecharegistro) >=', $first_date);
            $this->db->where('date(ppb.fecharegistro) <=', $second_date);
        }
        //$this->db->where('pc.idestatus', 8);
        //$this->db->where('ppb.ordensalida', 0);
         $this->db->group_by('tc.idcantidad'); 
        $query = $this->db->get();
        
        return $query->num_rows() > 0 ? $query->result() : FALSE ; 
    }

    public function getDataExits($first_date='',$second_date='',$tipo=''){
        $this->db->select('pc.idpalletcajas,pc.idestatus,pc.idtransferancia,c.nombre,p.numeroparte,
            sum(tc.cantidad) as cantidad,count(tc.idcantidad) as totalpallet,tc.cantidad as cantidadxpallet,tr.descripcion,s.nombrestatus,pb.nombreposicion,os.caja,os.idordensalida,
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
        
        if (!empty($first_date) && !empty($second_date) && $tipo == "0") {
            $this->db->where('date(os.fecharegistro) >=', $first_date);
            $this->db->where('date(os.fecharegistro) <=', $second_date);
            //$this->db->where('os.tipo', $tipo);
        }else if(!empty($first_date) && !empty($second_date) && $tipo == "1"){
            $this->db->where('date(os.fecharegistro) >=', $first_date);
            $this->db->where('date(os.fecharegistro) <=', $second_date);
            $this->db->where('os.tipo', 0);
        }else if(!empty($first_date) && !empty($second_date) && $tipo == "2"){
            $this->db->where('date(os.fecharegistro) >=', $first_date);
            $this->db->where('date(os.fecharegistro) <=', $second_date);
            $this->db->where('os.tipo', 1);
        }
        $this->db->where('pc.idestatus', 8);
        $this->db->where('ppb.ordensalida', 1);
        $this->db->group_by('tc.idcantidad'); 
        
        $query = $this->db->get();
        
        return $query->num_rows() > 0 ? $query->result() : FALSE ; 
    }

    public function getDataEntradas($id){
        $query = $this->db->query("
            SELECT pc.idpalletcajas, pc.idtransferancia, pc.pallet, pc.idcajas, pc.idestatus,
            pc.fecharegistro, p.idparte, c.nombre, p.numeroparte, tc.cantidad, tr.descripcion,
            s.nombrestatus, pc.idestatus, pb.nombreposicion, ppb.ordensalida, ppb.salida
            FROM palletcajas pc
            JOIN tblcantidad tc ON tc.idcantidad = pc.idcajas 
            JOIN tblrevision tr ON tr.idrevision = tc.idrevision
            JOIN tblmodelo tm ON tm.idmodelo = tr.idmodelo 
            JOIN parte p ON tm.idparte = p.idparte 
            JOIN cliente c ON c.idcliente = p.idcliente 
            JOIN status s ON s.idestatus = pc.idestatus 
            JOIN parteposicionbodega ppb ON pc.idpalletcajas = ppb.idpalletcajas 
            JOIN posicionbodega pb ON ppb.idposicion = pb.idposicion
            WHERE tr.idrevision = $id AND ppb.ordensalida = 0 AND ppb.salida = 0 
            ORDER BY pc.idpalletcajas ASC ");

        return $query->result();
    } 

    public function getDataSalidaParcial($id){
        $query = $this->db->query("
            SELECT pc.idpalletcajas, pc.idtransferancia, pc.pallet, pc.idcajas, pc.idestatus, 
            pc.fecharegistro, p.idparte, c.nombre, p.numeroparte, tc.cantidad, tr.descripcion, 
            s.nombrestatus, pc.idestatus, pb.nombreposicion, ppb.ordensalida, ppb.salida,os.caja
            FROM palletcajas pc 
            JOIN tblcantidad tc ON tc.idcantidad = pc.idcajas 
            JOIN tblrevision tr ON tr.idrevision = tc.idrevision 
            JOIN tblmodelo tm ON tm.idmodelo = tr.idmodelo
            JOIN parte p ON tm.idparte = p.idparte
            JOIN cliente c ON c.idcliente = p.idcliente 
            JOIN STATUS s ON s.idestatus = pc.idestatus
            JOIN parteposicionbodega ppb ON pc.idpalletcajas = ppb.idpalletcajas
            JOIN posicionbodega pb ON ppb.idposicion = pb.idposicion 
            JOIN ordensalida os ON pc.idpalletcajas = os.idpalletcajas
            JOIN salida sal ON os.idsalida = sal.idsalida
            WHERE tr.idrevision = $id AND os.tipo = 1 AND ppb.ordensalida = 1
            ORDER BY pc.idpalletcajas ASC");

        return $query->result();
    }

    public function getDataSalidaPallet($id){
        $query = $this->db->query("
            SELECT pc.idpalletcajas, pc.idtransferancia, pc.pallet, pc.idcajas, pc.idestatus, 
            pc.fecharegistro, p.idparte, c.nombre, p.numeroparte, tc.cantidad, tr.descripcion, 
            s.nombrestatus, pc.idestatus, pb.nombreposicion, ppb.ordensalida, ppb.salida,tc.cantidad
            FROM palletcajas pc 
            JOIN tblcantidad tc ON tc.idcantidad = pc.idcajas 
            JOIN tblrevision tr ON tr.idrevision = tc.idrevision 
            JOIN tblmodelo tm ON tm.idmodelo = tr.idmodelo
            JOIN parte p ON tm.idparte = p.idparte
            JOIN cliente c ON c.idcliente = p.idcliente 
            JOIN STATUS s ON s.idestatus = pc.idestatus
            JOIN parteposicionbodega ppb ON pc.idpalletcajas = ppb.idpalletcajas
            JOIN posicionbodega pb ON ppb.idposicion = pb.idposicion 
            JOIN ordensalida os ON pc.idpalletcajas = os.idpalletcajas
            JOIN salida sal ON os.idsalida = sal.idsalida
            WHERE tr.idrevision = $id AND os.tipo = 0
            ORDER BY pc.idpalletcajas ASC");

        return $query->result();
    }    

}