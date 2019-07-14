<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Salida_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function __destruct() {
        $this->db->close();
    }

    public function showAllSalidas() {
        $this->db->select('s.idcliente,s.idsalida,s.numerosalida,s.po,s.notas,c.nombre,s.finalizado,u.name,s.fecharegistro');
        $this->db->from('salida s');
        $this->db->join('cliente c', 's.idcliente=c.idcliente');
        $this->db->join('users u', 's.idusuario=u.id');
        $this->db->order_by("s.fecharegistro", "desc");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function showAllPalletCajas($iddetalleparte, $idordensalida, $cajas) {
        $query = $this->db->query("SELECT pc.* FROM palletcajas pc, ordensalida os
WHERE pc.idpalletcajas = os.idpalletcajas
 AND os.idsalida = $idordensalida
     
                    AND pc.iddetalleparte = $iddetalleparte
                    AND pc.cajas = $cajas");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function showSumaCajas($iddetalleparte, $idordensalida, $cajas) {
        $query = $this->db->query("SELECT 
                                    COALESCE(SUM(os.caja),0) AS sumacajas, 
                                    COALESCE(SUM(pc.cajas),0) AS sumacajaspallet 
                                    FROM palletcajas pc, ordensalida os
                    WHERE pc.idpalletcajas = os.idpalletcajas
                    AND os.idsalida = $idordensalida
                    AND pc.iddetalleparte = $iddetalleparte
                    AND pc.cajas = $cajas");
        return $query->first_row();
    }

    public function showPartesBodega2($idcliente) {
        $query = $this->db->query(" SELECT  
          pc.idpalletcajas as iddetalleparte,
         pc.idtransferancia,

    tp.numeroparte,
    t.folio,
    pc.idcajas,
    tm.descripcion as modelo,
    tr.descripcion as revision, 
       DATE_FORMAT(t.fecharegistro,'%d/%m/%Y') as fecha,
    c.nombre,
    COUNT(pc.pallet) AS totalpallet,
    SUM(tc.cantidad) AS totalcajas,
     tc.cantidad AS cajasporpallet,
     
     (SELECT
    COALESCE(count(pc2.idcajas),0)
  FROM palletcajas pc2, ordensalida os
  WHERE  os.idpalletcajas = pc2.idpalletcajas
  AND pc2.idtransferancia = pc.idtransferancia
  AND pc2.idestatus = 8
  AND pc2.idcajas = pc.idcajas
  AND os.tipo = 0)  AS totalpalletsalido,
  
    (SELECT
    COALESCE(SUM(tc2.cantidad),0)
  FROM palletcajas pc2, ordensalida os, tblcantidad tc2
  WHERE  os.idpalletcajas = pc2.idpalletcajas
  AND tc2.idcantidad = pc2.idcajas
  AND pc2.idtransferancia = pc.idtransferancia
  AND pc2.idestatus = 8
    AND pc2.idcajas = pc.idcajas
  AND os.tipo = 0 )  AS cajassalidasporpallet,
  (SELECT
    COALESCE(SUM(os.caja),0)
  FROM palletcajas pc2, ordensalida os
  WHERE  os.idpalletcajas = pc2.idpalletcajas
  AND pc2.idtransferancia = pc.idtransferancia
  AND pc2.idestatus = 8
    AND pc2.idcajas = pc.idcajas
  AND os.tipo = 1  ) AS cajassalidasporparciales,
  
  
   ((SELECT
    COALESCE(SUM(tc2.cantidad),0)
  FROM palletcajas pc2, ordensalida os, tblcantidad tc2
  WHERE  os.idpalletcajas = pc2.idpalletcajas
  AND pc2.idtransferancia = pc.idtransferancia
    AND tc2.idcantidad = pc2.idcajas
    AND pc2.idcajas = pc.idcajas
  AND pc2.idestatus = 8
  AND os.tipo = 0 ) + (SELECT
    COALESCE(SUM(os.caja),0)
  FROM palletcajas pc2, ordensalida os
  WHERE  os.idpalletcajas = pc2.idpalletcajas
  AND pc2.idtransferancia = pc.idtransferancia
  AND pc2.idestatus = 8
  AND os.tipo = 1 ) ) as totalcajassalidas,
  
  
  (SUM(tc.cantidad) - ((SELECT
    COALESCE(SUM(tc2.cantidad),0)
  FROM palletcajas pc2, ordensalida os, tblcantidad tc2
  WHERE  os.idpalletcajas = pc2.idpalletcajas
  AND pc2.idtransferancia = pc.idtransferancia
   AND tc2.idcantidad = pc2.idcajas
   AND pc2.idcajas = pc.idcajas
  AND pc2.idestatus = 8
  AND os.tipo = 0 ) + (SELECT
    COALESCE(SUM(os.caja),0)
  FROM palletcajas pc2, ordensalida os
  WHERE  os.idpalletcajas = pc2.idpalletcajas
  AND pc2.idtransferancia = pc.idtransferancia
  AND pc2.idcajas = pc.idcajas
  AND pc2.idestatus = 8
  AND os.tipo = 1 ))) as totalcajasdisponibles,
  
  
  (COUNT(pc.pallet) - (SELECT
    COALESCE(count(tc2.cantidad),0)
  FROM palletcajas pc2, ordensalida os,  tblcantidad tc2
  WHERE  os.idpalletcajas = pc2.idpalletcajas
  AND pc2.idtransferancia = pc.idtransferancia
    AND tc2.idcantidad = pc2.idcajas
  AND pc2.idestatus = 8
    AND pc2.idcajas = pc.idcajas
  AND os.tipo = 0 ) ) AS totalpalletparacomparar 
FROM
    palletcajas pc
        INNER JOIN
    tblcantidad tc ON pc.idcajas = tc.idcantidad
        INNER JOIN
    tblrevision tr ON tr.idrevision = tc.idrevision
        INNER JOIN
    tblmodelo tm ON tm.idmodelo = tr.idmodelo
        INNER JOIN
    parte tp ON tp.idparte = tm.idparte
        INNER JOIN
    cliente c ON c.idcliente = tp.idcliente
        INNER JOIN
    parteposicionbodega ppb ON ppb.idpalletcajas = pc.idpalletcajas  
       INNER JOIN
    tbltransferencia t ON t.idtransferancia = pc.idtransferancia  
WHERE
    pc.idestatus = 8 AND c.idcliente = $idcliente
    GROUP BY pc.idcajas,
         t.idtransferancia");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function showPartesBodega() {
        $query = $this->db->query('SELECT
  dp.iddetalleparte,
  p.numeroparte,
  dp.folio,
  dp.modelo,
  dp.revision,
  l.nombrelinea AS linea,
  dp.fecharegistro,
  c.nombre,
  dp.modelo,
  COUNT(pc.pallet) AS totalpallet,
 FORMAT(COALESCE((SUM(pc.cajas) / COUNT(pc.pallet)), 0),0) AS cajasporpallet,
  SUM(pc.cajas) AS totalcajas
FROM parte p
INNER JOIN detalleparte dp
  ON p.idparte = dp.idparte
INNER JOIN palletcajas pc
  ON dp.iddetalleparte = pc.iddetalleparte
INNER JOIN cliente c
  ON c.idcliente = p.idcliente
INNER JOIN linea l
  ON l.idlinea = dp.idlinea
INNER JOIN parteposicionbodega ppb
  ON ppb.idpalletcajas = pc.idpalletcajas
WHERE pc.idestatus = 8
GROUP BY pc.cajas,
         dp.iddetalleparte
ORDER BY dp.fecharegistro DESC');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function listaPosiciones($idtransferencia, $idcajas) {
        $query = $this->db->query("SELECT ppb.idparteposicionbodega,ppb.idparteposicionbodega, ppb.idposicion, pb.nombreposicion, tc.cantidad as cajas, t.idtransferancia, pc.idpalletcajas
FROM
    palletcajas pc
        INNER JOIN
    tblcantidad tc ON pc.idcajas = tc.idcantidad
        INNER JOIN
    tblrevision tr ON tr.idrevision = tc.idrevision
        INNER JOIN
    tblmodelo tm ON tm.idmodelo = tr.idmodelo
        INNER JOIN
    parte tp ON tp.idparte = tm.idparte
        INNER JOIN
    cliente c ON c.idcliente = tp.idcliente 
       INNER JOIN
    tbltransferencia t ON t.idtransferancia = pc.idtransferancia  
  INNER JOIN
    parteposicionbodega ppb ON pc.idpalletcajas = ppb.idpalletcajas
      INNER JOIN
    posicionbodega pb ON ppb.idposicion = pb.idposicion
    WHERE pc.idestatus = 8 
    AND pc.idtransferancia = $idtransferencia
    AND pc.idcajas = $idcajas");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function listaPosicionesPallet($idtransferencia, $idcajas) {
        $query = $this->db->query("SELECT ppb.idparteposicionbodega,ppb.idparteposicionbodega, ppb.idposicion, pb.nombreposicion, tc.cantidad as cajas, t.idtransferancia, pc.idpalletcajas
FROM
    palletcajas pc
        INNER JOIN
    tblcantidad tc ON pc.idcajas = tc.idcantidad
        INNER JOIN
    tblrevision tr ON tr.idrevision = tc.idrevision
        INNER JOIN
    tblmodelo tm ON tm.idmodelo = tr.idmodelo
        INNER JOIN
    parte tp ON tp.idparte = tm.idparte
        INNER JOIN
    cliente c ON c.idcliente = tp.idcliente 
       INNER JOIN
    tbltransferencia t ON t.idtransferancia = pc.idtransferancia  
  INNER JOIN
    parteposicionbodega ppb ON pc.idpalletcajas = ppb.idpalletcajas
      INNER JOIN
    posicionbodega pb ON ppb.idposicion = pb.idposicion
    WHERE pc.idestatus = 8 
    AND pc.idtransferancia = $idtransferencia
    AND pc.idcajas = $idcajas");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function updateEstatusOrden($id, $field) {
        $this->db->where('idparteposicionbodega', $id);
        $this->db->update('parteposicionbodega', $field);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function updateEstatusPosicionBodega($id, $field) {
        $this->db->where('idpalletcajas', $id);
        $this->db->update('parteposicionbodega', $field);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function validarExistenciaParcialesNumeroParte($idtransferencia, $idcajas) {
        $query = $this->db->query("
SELECT  COALESCE(SUM(os.caja),0) AS cajassalidas,
(SELECT
    COALESCE(SUM(tc2.cantidad),0)
  FROM palletcajas pc2, tblcantidad tc2
  WHERE   pc2.idtransferancia = pc.idtransferancia
   AND tc2.idcantidad = pc2.idcajas
  AND pc2.idestatus = 8  )AS totalcajas

  

FROM
    palletcajas pc
        INNER JOIN
    tblcantidad tc ON pc.idcajas = tc.idcantidad
        INNER JOIN
    tblrevision tr ON tr.idrevision = tc.idrevision
        INNER JOIN
    tblmodelo tm ON tm.idmodelo = tr.idmodelo
        INNER JOIN
    parte tp ON tp.idparte = tm.idparte
        INNER JOIN
    cliente c ON c.idcliente = tp.idcliente 
       INNER JOIN
    tbltransferencia t ON t.idtransferancia = pc.idtransferancia  
  INNER JOIN
    parteposicionbodega ppb ON pc.idpalletcajas = ppb.idpalletcajas
    INNER JOIN  
    ordensalida os oN pc.idpalletcajas = os.idpalletcajas
    WHERE pc.idestatus = 8
    AND pc.idtransferancia = $idtransferencia
    AND pc.idcajas =$idcajas");
        //$query = $this->db->get();
        return $query->first_row();
    }

    public function validarExistenciaNumeroParte($idtransferencia, $idcajas) {
        $query = $this->db->query("SELECT
 COUNT(pc.pallet) AS totalstock, SUM(tc.cantidad) AS totalcajas 
FROM
    palletcajas pc
        INNER JOIN
    tblcantidad tc ON pc.idcajas = tc.idcantidad
        INNER JOIN
    tblrevision tr ON tr.idrevision = tc.idrevision
        INNER JOIN
    tblmodelo tm ON tm.idmodelo = tr.idmodelo
        INNER JOIN
    parte tp ON tp.idparte = tm.idparte
        INNER JOIN
    cliente c ON c.idcliente = tp.idcliente 
       INNER JOIN
    tbltransferencia t ON t.idtransferancia = pc.idtransferancia  
  INNER JOIN
    parteposicionbodega ppb ON pc.idpalletcajas = ppb.idpalletcajas
      INNER JOIN
    posicionbodega pb ON ppb.idposicion = pb.idposicion
    WHERE pc.idestatus = 8 
    AND pc.idtransferancia = $idtransferencia
    AND pc.idcajas = $idcajas
    AND ppb.ordensalida = 0
    AND ppb.salida=0");
        //$query = $this->db->get();
        return $query->first_row();
    }

    public function buscarNumeroParte($match) {
           $field = array(
            's.idsalida',
            's.numerosalida',
            'c.nombre',
            's.po',
            's.notas',
            's.finalizado',
            'u.name',
            's.fecharegistro'
        );

        $this->db->select('c.idcliente, s.idsalida,s.numerosalida,s.po,s.notas,c.nombre,s.finalizado,u.name,s.fecharegistro');
        $this->db->from('salida s');
        $this->db->join('cliente c', 's.idcliente=c.idcliente');
        $this->db->join('users u', 's.idusuario=u.id');
         $this->db->like('concat(' . implode(',', $field) . ')', $match);
        $this->db->order_by("s.fecharegistro", "desc");
       
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }



    public function showPartesDetalle($folio,$idcajas) {

       $this->db->select('p.idparte, pc.idtransferancia as  idtransferencia,  pc.idpalletcajas, c.nombre,p.numeroparte,tc.cantidad, tm.descripcion as modelo, tr.descripcion as revision, s.nombrestatus, pc.idestatus, tc.cantidad as cajasporpallet');
        $this->db->from('palletcajas pc');
        $this->db->join('tblcantidad  tc', 'tc.idcantidad = pc.idcajas');
        $this->db->join('tblrevision  tr', 'tr.idrevision = tc.idrevision');
        $this->db->join('tblmodelo  tm', 'tm.idmodelo = tr.idmodelo');
        $this->db->join('parte  p', 'tm.idparte = p.idparte');
        $this->db->join('cliente  c', 'c.idcliente = p.idcliente');
        $this->db->join('status  s', 's.idestatus = pc.idestatus');
        $this->db->where('pc.idtransferancia', $folio);
        $this->db->where('pc.idcajas', $idcajas);


       /* $this->db->select('p.idparte, dp.iddetalleparte,p.numeroparte,dp.folio,dp.iddetalleparte, dp.revision, dp.modelo');
        $this->db->from('parte p');
        $this->db->join('detalleparte dp', 'dp.idparte=p.idparte');
        $this->db->where('dp.iddetalleparte', $iddetalleparte);*/
        $query = $this->db->get();

        return $query->first_row();
    }

//Nuevas funciones para obtener la orden de salida
    public function obtenerOrdenNoParciales($idsalida) {
        $query = $this->db->query("SELECT
COUNT(pc.pallet) as totalpallet,
SUM( tc.cantidad) as sumacajas,
tp.numeroparte,
tm.descripcion as modelo,
tr.descripcion as revision,
os.po
FROM
    palletcajas pc
        INNER JOIN
    tblcantidad tc ON pc.idcajas = tc.idcantidad
        INNER JOIN
    tblrevision tr ON tr.idrevision = tc.idrevision
        INNER JOIN
    tblmodelo tm ON tm.idmodelo = tr.idmodelo
        INNER JOIN
    parte tp ON tp.idparte = tm.idparte
        INNER JOIN
    cliente c ON c.idcliente = tp.idcliente
        INNER JOIN
    parteposicionbodega ppb ON ppb.idpalletcajas = pc.idpalletcajas  
       INNER JOIN
    tbltransferencia t ON t.idtransferancia = pc.idtransferancia  
    INNER JOIN ordensalida os ON  os.idpalletcajas = pc.idpalletcajas
    WHERE    os.tipo = 0
    AND os.idsalida = '$idsalida'
    GROUP BY pc.idcajas");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function obtenerOrdenParciales($idsalida) {
        $query = $this->db->query("SELECT
COUNT(pc.pallet) as totalpallet,
SUM( os.caja) as sumacajas,
tp.numeroparte,
tm.descripcion as modelo,
tr.descripcion as revision,
os.po
FROM
    palletcajas pc
        INNER JOIN
    tblcantidad tc ON pc.idcajas = tc.idcantidad
        INNER JOIN
    tblrevision tr ON tr.idrevision = tc.idrevision
        INNER JOIN
    tblmodelo tm ON tm.idmodelo = tr.idmodelo
        INNER JOIN
    parte tp ON tp.idparte = tm.idparte
        INNER JOIN
    cliente c ON c.idcliente = tp.idcliente
        INNER JOIN
    parteposicionbodega ppb ON ppb.idpalletcajas = pc.idpalletcajas  
       INNER JOIN
    tbltransferencia t ON t.idtransferancia = pc.idtransferancia  
    INNER JOIN ordensalida os ON  os.idpalletcajas = pc.idpalletcajas
    WHERE    os.tipo = 1
    AND os.idsalida = '$idsalida'
    GROUP BY pc.idcajas");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

//Fin
    public function detalleparciales($idsalida) {
               $query = $this->db->query("SELECT tp.numeroparte,
                                    tm.descripcion as  modelo,
                                    os.tipo, sum(os.caja) AS sumacajas
                                    FROM palletcajas pc 
                               INNER JOIN tblcantidad tc  ON pc.idcajas = tc.idcantidad
                               INNER JOIN tblrevision tr  ON tr.idrevision = tc.idrevision
                               INNER JOIN tblmodelo tm  ON tm.idmodelo = tr.idmodelo
                               INNER JOIN parte tp  ON tp.idparte = tm.idparte
                               INNER JOIN cliente c  ON c.idcliente = tp.idcliente  
                                   INNER JOIN ordensalida os ON os.idpalletcajas = pc.idpalletcajas
                                   WHERE os.tipo=1
                                   AND os.idsalida=$idsalida
                                   GROUP BY  tp.numeroparte, tm.descripcion

                                   ");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        } 
    }
    public function detallepallet($idsalida) {
          $query = $this->db->query("SELECT tp.numeroparte,
                                    tm.descripcion as  modelo,
                                    os.tipo, sum( tc.cantidad) AS sumacajas, count(pc.pallet)  as totalpallet
                                    FROM palletcajas pc 
                               INNER JOIN tblcantidad tc  ON pc.idcajas = tc.idcantidad
                               INNER JOIN tblrevision tr  ON tr.idrevision = tc.idrevision
                               INNER JOIN tblmodelo tm  ON tm.idmodelo = tr.idmodelo
                               INNER JOIN parte tp  ON tp.idparte = tm.idparte
                               INNER JOIN cliente c  ON c.idcliente = tp.idcliente  
                                   INNER JOIN ordensalida os ON os.idpalletcajas = pc.idpalletcajas
                                   WHERE os.tipo=0
                                   AND os.idsalida=$idsalida
                                   GROUP BY  tp.numeroparte, tm.descripcion");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }   
    }
    public function detallesDeOrden($idsalida) {
        // code...
        $this->db->select('pc.idpalletcajas, o.idordensalida,s.idsalida, p.numeroparte,o.tipo, o.pallet,o.caja, tc.cantidad as cajaspallet, tm.descripcion as modelo, tr.descripcion as revision, pb.nombreposicion,ppb.salida');
        $this->db->from('salida s');
        $this->db->join('ordensalida o', 's.idsalida=o.idsalida');
        $this->db->join('palletcajas pc', 'o.idpalletcajas=pc.idpalletcajas');
        $this->db->join('tblcantidad  tc', 'tc.idcantidad = pc.idcajas');
        $this->db->join('tblrevision  tr', 'tr.idrevision = tc.idrevision');
        $this->db->join('tblmodelo  tm', 'tm.idmodelo = tr.idmodelo');
        $this->db->join('parte  p', 'tm.idparte = p.idparte');
        $this->db->join('cliente  c', 'c.idcliente = p.idcliente');
        $this->db->join('status  es', 'es.idestatus = pc.idestatus');
        $this->db->join('parteposicionbodega  ppb', 'ppb.idpalletcajas = o.idpalletcajas');
        $this->db->join('posicionbodega  pb', 'ppb.idposicion = pb.idposicion');
        $this->db->where('s.idsalida', $idsalida);
        //$this->db->where('pd.idestatus', 8);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
     public function detallesDeOrdenPallet($idsalida) {
        // code...
        $this->db->select('pc.idpalletcajas, o.idordensalida,s.idsalida, p.numeroparte,o.tipo, o.pallet,o.caja, tc.cantidad as cajaspallet, tm.descripcion as modelo, tr.descripcion as revision, pb.nombreposicion,ppb.salida');
        $this->db->from('salida s');
        $this->db->join('ordensalida o', 's.idsalida=o.idsalida');
        $this->db->join('palletcajas pc', 'o.idpalletcajas=pc.idpalletcajas');
        $this->db->join('tblcantidad  tc', 'tc.idcantidad = pc.idcajas');
        $this->db->join('tblrevision  tr', 'tr.idrevision = tc.idrevision');
        $this->db->join('tblmodelo  tm', 'tm.idmodelo = tr.idmodelo');
        $this->db->join('parte  p', 'tm.idparte = p.idparte');
        $this->db->join('cliente  c', 'c.idcliente = p.idcliente');
        $this->db->join('status  es', 'es.idestatus = pc.idestatus');
        $this->db->join('parteposicionbodega  ppb', 'ppb.idpalletcajas = o.idpalletcajas');
        $this->db->join('posicionbodega  pb', 'ppb.idposicion = pb.idposicion');
        $this->db->where('s.idsalida', $idsalida);
        $this->db->where('o.tipo', 0);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
     public function detallesDeOrdenParciales($idsalida) {
        // code...
        $this->db->select('pc.idpalletcajas, o.idordensalida,s.idsalida, p.numeroparte,o.tipo, o.pallet,o.caja, tc.cantidad as cajaspallet, tm.descripcion as modelo, tr.descripcion as revision, pb.nombreposicion,ppb.salida, sum(o.caja) as totalcajas');
        $this->db->from('salida s');
        $this->db->join('ordensalida o', 's.idsalida=o.idsalida');
        $this->db->join('palletcajas pc', 'o.idpalletcajas=pc.idpalletcajas');
        $this->db->join('tblcantidad  tc', 'tc.idcantidad = pc.idcajas');
        $this->db->join('tblrevision  tr', 'tr.idrevision = tc.idrevision');
        $this->db->join('tblmodelo  tm', 'tm.idmodelo = tr.idmodelo');
        $this->db->join('parte  p', 'tm.idparte = p.idparte');
        $this->db->join('cliente  c', 'c.idcliente = p.idcliente');
        $this->db->join('status  es', 'es.idestatus = pc.idestatus');
        $this->db->join('parteposicionbodega  ppb', 'ppb.idpalletcajas = o.idpalletcajas');
        $this->db->join('posicionbodega  pb', 'ppb.idposicion = pb.idposicion');
        $this->db->where('s.idsalida', $idsalida);
        $this->db->where('o.tipo', 1);
         $this->db->group_by('pc.idcajas'); 
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function addSalida($data) {
        $this->db->insert('salida', $data);
        return $this->db->insert_id();
    }

    public function addOrdenSalida($data) {
        return $this->db->insert('ordensalida', $data);
    }

    public function detalleSalida($idsalida) {
        // code...
        $this->db->select('s.idsalida,s.po, s.notas, s.numerosalida,c.idcliente,s.finalizado,c.nombre,u.name,s.fecharegistro');
        $this->db->from('salida s');
        $this->db->join('cliente c', 's.idcliente=c.idcliente');
        $this->db->join('users u', 's.idusuario=u.id');
        $this->db->where('s.idsalida', $idsalida);
        $query = $this->db->get();

        return $query->first_row();
    }

    /* public function validarExistenciaNumeroParte($numeroparte) {
      // code...
      $this->db->select('p.idparte,p.numeroparte,dp.modelo, dp.revision,dp.pallet, dp.cantidad, dp.linea');
      $this->db->from('detalleparte dp');
      $this->db->join('parte p', 'dp.idparte=p.idparte');
      $this->db->where('p.numeroparte', $numeroparte);
      $this->db->where('dp.idestatus', 8);
      $query = $this->db->get();
      return $query->first_row();
      } */

    public function posicionPalletBodega($iddetalleparte) {
        // code...
        $this->db->select('pb.numero,p.nombreposicion');
        $this->db->from('parteposicionbodega pb');
        $this->db->join('posicionbodega p', 'pb.idposicion=p.idposicion');
        $this->db->where('pb.iddetalleparte', $iddetalleparte);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function eliminarParteOrden($id) {

        $this->db->where('idordensalida', $id);
        return $this->db->delete('ordensalida');
    }

    public function updateSalida($id, $field) {
        $this->db->where('idsalida', $id);
        $this->db->update('salida', $field);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function searchPartes($match) {
        $field = array(
            'p.idparte',
            'dp.iddetalleparte',
            'p.numeroparte',
            'dp.folio',
            'dp.iddetalleparte',
            'dp.revision',
            'dp.modelo'
        );

        $this->db->select('p.idparte, dp.iddetalleparte,p.numeroparte,dp.folio,dp.iddetalleparte, dp.revision, dp.modelo');
        $this->db->from('parte p');
        $this->db->join('detalleparte dp', 'dp.idparte=p.idparte');
        $this->db->where('dp.idestatus', 8);
        $this->db->like('concat(' . implode(',', $field) . ')', $match);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function detalleSalidaOrden($idsalida) {
        $this->db->select('c.rfc, c.nombre, c.direccion,u.name,s.po,s.notas, s.idsalida, s.numerosalida, s.fecharegistro');
        $this->db->from('cliente c');
        $this->db->join('salida s', 'c.idcliente=s.idcliente');
        $this->db->join('users u', 's.idusuario=u.id');
        $this->db->where('s.idsalida', $idsalida);
        $query = $this->db->get();
        return $query->first_row();
    }

    public function partesIncluidasOrden($idsalida) {
        // code...
        $this->db->select('p.numeroparte,dp.modelo,dp.revision, os.pallet, os.caja');
        $this->db->from('detalleparte dp');
        $this->db->join('ordensalida os', 'dp.iddetalleparte=os.iddetalleparte');
        $this->db->join('parte p', 'p.idparte=dp.idparte');
        $this->db->where('os.idsalida', $idsalida);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

}
