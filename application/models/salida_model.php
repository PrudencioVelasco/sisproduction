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
        $this->db->select('s.idsalida,s.numerosalida,c.nombre,s.finalizado,u.name,s.fecharegistro');
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

    public function showPartesBodega2() {
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
  SUM(pc.cajas) AS totalcajas,
   (SELECT
    COALESCE(count(pc2.cajas),0)
  FROM palletcajas pc2, ordensalida os
  WHERE  os.idpalletcajas = pc2.idpalletcajas
  AND pc2.iddetalleparte = pc.iddetalleparte
  AND pc2.idestatus = 8
  AND os.tipo = 0
  AND pc2.cajas = pc.cajas)  AS totalpalletsalido,
    (SELECT
    COALESCE(SUM(pc2.cajas),0)
  FROM palletcajas pc2, ordensalida os
  WHERE  os.idpalletcajas = pc2.idpalletcajas
  AND pc2.iddetalleparte = pc.iddetalleparte
  AND pc2.idestatus = 8
  AND os.tipo = 0
  AND pc2.cajas = pc.cajas)  AS cajassalidasporpallet,
   (SELECT
    COALESCE(SUM(os.caja),0)
  FROM palletcajas pc2, ordensalida os
  WHERE  os.idpalletcajas = pc2.idpalletcajas
  AND pc2.iddetalleparte = pc.iddetalleparte
  AND pc2.idestatus = 8
  AND os.tipo = 1
  AND pc2.cajas = pc.cajas)  AS cajassalidasporparciales,
  
  ((SELECT
    COALESCE(SUM(pc2.cajas),0)
  FROM palletcajas pc2, ordensalida os
  WHERE  os.idpalletcajas = pc2.idpalletcajas
  AND pc2.iddetalleparte = pc.iddetalleparte
  AND pc2.idestatus = 8
  AND os.tipo = 0
  AND pc2.cajas = pc.cajas) + (SELECT
    COALESCE(SUM(os.caja),0)
  FROM palletcajas pc2, ordensalida os
  WHERE  os.idpalletcajas = pc2.idpalletcajas
  AND pc2.iddetalleparte = pc.iddetalleparte
  AND pc2.idestatus = 8
  AND os.tipo = 1
  AND pc2.cajas = pc.cajas) ) as totalcajassalidas,
  (SUM(pc.cajas) - ((SELECT
    COALESCE(SUM(pc2.cajas),0)
  FROM palletcajas pc2, ordensalida os
  WHERE  os.idpalletcajas = pc2.idpalletcajas
  AND pc2.iddetalleparte = pc.iddetalleparte
  AND pc2.idestatus = 8
  AND os.tipo = 0
  AND pc2.cajas = pc.cajas) + (SELECT
    COALESCE(SUM(os.caja),0)
  FROM palletcajas pc2, ordensalida os
  WHERE  os.idpalletcajas = pc2.idpalletcajas
  AND pc2.iddetalleparte = pc.iddetalleparte
  AND pc2.idestatus = 8
  AND os.tipo = 1
  AND pc2.cajas = pc.cajas))) as totalcajasdisponibles,
  (COUNT(pc.pallet) - (SELECT
    COALESCE(count(pc2.cajas),0)
  FROM palletcajas pc2, ordensalida os
  WHERE  os.idpalletcajas = pc2.idpalletcajas
  AND pc2.iddetalleparte = pc.iddetalleparte
  AND pc2.idestatus = 8
  AND os.tipo = 0
  AND pc2.cajas = pc.cajas) ) AS totalpalletparacomparar
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

    public function listaPosiciones($iddetalleparte, $cajas) {
        $query = $this->db->query("SELECT  pc.idpalletcajas,ppb.idparteposicionbodega,ppb.idparteposicionbodega, ppb.idposicion, pb.nombreposicion,pc.cajas  
FROM parte p, detalleparte dp, palletcajas pc, parteposicionbodega ppb, posicionbodega pb
WHERE p.idparte = dp.idparte
AND dp.iddetalleparte = pc.iddetalleparte
AND pc.idpalletcajas = ppb.idpalletcajas
AND ppb.idposicion = pb.idposicion
AND pc.idestatus = 8 
AND pc.cajas = $cajas
AND dp.iddetalleparte  = $iddetalleparte");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function listaPosicionesPallet($iddetalleparte, $cajas) {
        $query = $this->db->query("SELECT  pc.idpalletcajas,ppb.idparteposicionbodega,ppb.idparteposicionbodega, ppb.idposicion, pb.nombreposicion,pc.cajas  
FROM parte p, detalleparte dp, palletcajas pc, parteposicionbodega ppb, posicionbodega pb
WHERE p.idparte = dp.idparte
AND dp.iddetalleparte = pc.iddetalleparte
AND pc.idpalletcajas = ppb.idpalletcajas
AND ppb.idposicion = pb.idposicion
AND pc.idestatus = 8 
AND pc.cajas = $cajas
AND dp.iddetalleparte  = $iddetalleparte");
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

    public function validarExistenciaParcialesNumeroParte($iddetalleparte, $cajas) {
        $query = $this->db->query("SELECT
  COALESCE(SUM(os.caja),0) AS cajassalidas,
  (SELECT
    COALESCE(SUM(pc2.cajas),0)
  FROM palletcajas pc2
  WHERE pc2.iddetalleparte = $iddetalleparte
  AND pc2.idestatus = 8
  AND pc2.cajas = $cajas)  AS totalcajas

FROM parte p,
     detalleparte dp,
     palletcajas pc,
     parteposicionbodega ppb,
     ordensalida os
WHERE p.idparte = dp.idparte
AND dp.iddetalleparte = pc.iddetalleparte
AND pc.idpalletcajas = ppb.idpalletcajas
AND pc.idpalletcajas = os.idpalletcajas
AND pc.idestatus = 8
AND pc.cajas = $cajas
AND dp.iddetalleparte = $iddetalleparte");
        //$query = $this->db->get();
        return $query->first_row();
    }

    public function validarExistenciaNumeroParte($iddetalleparte, $cajas) {
        $query = $this->db->query("SELECT COUNT(p.numeroparte) AS totalstock, SUM(pc.cajas) AS totalcajas 
                                FROM parte p, detalleparte dp, palletcajas pc, parteposicionbodega ppb
                                WHERE p.idparte = dp.idparte
                                AND dp.iddetalleparte = pc.iddetalleparte
                                AND pc.idpalletcajas = ppb.idpalletcajas
                                AND pc.idestatus = 8
                                AND ppb.ordensalida = 0
                                AND ppb.salida=0
                                AND pc.cajas = $cajas
                                AND dp.iddetalleparte = $iddetalleparte");
        //$query = $this->db->get();
        return $query->first_row();
    }

    public function buscarNumeroParte($match) {
           $field = array(
            's.idsalida',
            's.numerosalida',
            'c.nombre',
            's.finalizado',
            'u.name',
            's.fecharegistro'
        );

        $this->db->select('s.idsalida,s.numerosalida,c.nombre,s.finalizado,u.name,s.fecharegistro');
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

    public function showPartesDetalle($iddetalleparte) {
        $this->db->select('p.idparte, dp.iddetalleparte,p.numeroparte,dp.folio,dp.iddetalleparte, dp.revision, dp.modelo');
        $this->db->from('parte p');
        $this->db->join('detalleparte dp', 'dp.idparte=p.idparte');
        $this->db->where('dp.iddetalleparte', $iddetalleparte);
        $query = $this->db->get();

        return $query->first_row();
    }

//Nuevas funciones para obtener la orden de salida
    public function obtenerOrdenNoParciales($idsalida) {
        $query = $this->db->query("SELECT  	COUNT(pc.pallet) as totalpallet, SUM( pc.cajas) as sumacajas ,
  (SELECT p.numeroparte FROM detalleparte dp, parte p WHERE dp.idparte = p.idparte AND dp.iddetalleparte = pc.iddetalleparte) as numeroparte,
  (SELECT dp.modelo FROM detalleparte dp WHERE dp.iddetalleparte = pc.iddetalleparte) as modelo
  FROM ordensalida os, palletcajas pc
  WHERE os.idpalletcajas = pc.idpalletcajas
  AND os.idsalida = '$idsalida'
  AND os.tipo = 0
  GROUP BY pc.iddetalleparte");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function obtenerOrdenParciales($idsalida) {
        $query = $this->db->query("SELECT  	SUM( os.caja) as sumacajas ,
  (SELECT p.numeroparte FROM detalleparte dp, parte p WHERE dp.idparte = p.idparte AND dp.iddetalleparte = pc.iddetalleparte) as numeroparte,
  (SELECT dp.modelo FROM detalleparte dp WHERE dp.iddetalleparte = pc.iddetalleparte) as modelo
  FROM ordensalida os, palletcajas pc
  WHERE os.idpalletcajas = pc.idpalletcajas
  AND os.idsalida = '$idsalida'
  AND os.tipo = 1
  GROUP BY pc.iddetalleparte");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

//Fin
    public function detalleparciales($idsalida) {
               $query = $this->db->query("SELECT p.numeroparte,
 dp.modelo,
 os.tipo,sum( os.caja) AS sumacajas
 FROM parte p 
INNER JOIN detalleparte dp ON p.idparte = dp.idparte
INNER JOIN palletcajas pc ON pc.iddetalleparte = dp.iddetalleparte
INNER JOIN ordensalida os ON os.idpalletcajas = pc.idpalletcajas
WHERE os.tipo=1
AND os.idsalida=$idsalida
GROUP BY  p.numeroparte, dp.modelo");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        } 
    }
    public function detallepallet($idsalida) {
          $query = $this->db->query("SELECT p.numeroparte,
                                    dp.modelo,
                                    os.tipo,sum( pc.cajas) AS sumacajas,count(pc.idpalletcajas) as totalpallet
                                    FROM parte p 
                                   INNER JOIN detalleparte dp ON p.idparte = dp.idparte
                                   INNER JOIN palletcajas pc ON pc.iddetalleparte = dp.iddetalleparte
                                   INNER JOIN ordensalida os ON os.idpalletcajas = pc.idpalletcajas
                                   WHERE os.tipo=0
                                   AND os.idsalida=$idsalida
                                   GROUP BY  p.numeroparte, dp.modelo");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }   
    }
    public function detallesDeOrden($idsalida) {
        // code...
        $this->db->select('pc.idpalletcajas, o.idordensalida,s.idsalida, p.numeroparte,o.tipo, o.pallet,o.caja, pc.cajas as cajaspallet, dp.modelo,dp.revision');
        $this->db->from('salida s');
        $this->db->join('ordensalida o', 's.idsalida=o.idsalida');
        $this->db->join('palletcajas pc', 'o.idpalletcajas=pc.idpalletcajas');
        $this->db->join('detalleparte dp', 'dp.iddetalleparte=pc.iddetalleparte');
        $this->db->join('parte p', 'p.idparte=dp.idparte');
        $this->db->join('users u', 'o.idusuario=u.id');
        $this->db->where('s.idsalida', $idsalida);
        //$this->db->where('pd.idestatus', 8);
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
        $this->db->select('s.idsalida,s.numerosalida,s.finalizado,c.nombre,u.name,s.fecharegistro');
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
        $this->db->select('c.rfc, c.nombre, c.direccion,u.name, s.idsalida, s.numerosalida, s.fecharegistro');
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
