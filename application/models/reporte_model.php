<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reporte_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
    public function __destruct()
    {
        $this->db->close();
    }
    public function packingTodos($estatus,$fechainicio,$fechafin)
    {
        $query =$this->db->query(' SELECT 
 c.nombre, 
 p.numeroparte, 
 dp.folio, 
 l.nombrelinea, 
 dp.modelo, 
 dp.revision, 
 SUM(pc.cajas) AS sumacajas, 
 COUNT(pc.pallet) AS sumapallet, 
 FORMAT(( SUM(pc.cajas) / COUNT(pc.pallet)  ) ,0)AS cajasporpallet,
 u.name as nombreusuario,
 s.nombrestatus,
 pcp.fecharegistro
 FROM parte p INNER JOIN detalleparte dp ON  p.idparte = dp.idparte
 INNER JOIN cliente c ON p.idcliente  = c.idcliente
 INNER JOIN palletcajas pc ON pc.iddetalleparte = dp.iddetalleparte
 INNER JOIN linea l ON dp.idlinea = l.idlinea
 INNER JOIN palletcajasproceso pcp ON pcp.idpalletcajas = pc.idpalletcajas
 INNER JOIN users u ON pcp.idusuario = u.id
  INNER JOIN status  s ON pcp.idestatus = s.idestatus
 WHERE pcp.idestatus = '.$estatus.'
 AND date(pcp.fecharegistro) BETWEEN "'.$fechainicio.'"and "'.$fechafin.'"
 GROUP BY p.numeroparte, pc.cajas');
         return $query->result();
    }
    public function packingPorUsuario($usuario,$estatus,$fechainicio,$fechafin)
    {
        $query =$this->db->query('select dp.iddetalleparte, dp.folio, p.numeroparte, dp.modelo, dp.revision, dp.pallet, dp.cantidad, dp.linea, u.name nombreusuario, s.nombrestatus, MAX(de.iddetallestatus) as iddetallestatusmax, de.fecharegistro
         from parte p, detalleparte dp, users u, detallestatus de, status s
         where p.idparte = dp.idparte
         and de.idusuario = u.id
         and de.iddetalleparte = dp.iddetalleparte
         and de.idstatus = s.idestatus
         and de.idusuario = '.$usuario.'
         and s.idestatus in ('.$estatus.')
         and date(de.fecharegistro) BETWEEN "'.$fechainicio.'"and "'.$fechafin.'"
         GROUP BY de.iddetalleparte DESC;');
         return $query->result();
    }
    public function calidadTodos($estatus,$fechainicio,$fechafin)
    {
        $query =$this->db->query('select dp.iddetalleparte, dp.folio, p.numeroparte, dp.modelo, dp.revision, dp.pallet, dp.cantidad, dp.linea, u.name nombreusuario, s.nombrestatus, MAX(de.iddetallestatus) as iddetallestatusmax, de.fecharegistro
         from parte p, detalleparte dp, users u, detallestatus de, status s
         where p.idparte = dp.idparte
         and de.idoperador = u.id
         and de.iddetalleparte = dp.iddetalleparte
         and de.idstatus = s.idestatus
         and s.idestatus in ('.$estatus.')
        and date(de.fecharegistro) BETWEEN "'.$fechainicio.'"and "'.$fechafin.'"
         GROUP BY de.iddetalleparte DESC;');
         return $query->result();
    }
    public function calidadPorUsuario($usuario,$estatus,$fechainicio,$fechafin)
    {
        $query =$this->db->query('select dp.iddetalleparte, dp.folio, p.numeroparte, dp.modelo, dp.revision, dp.pallet, dp.cantidad, dp.linea, u.name nombreusuario, s.nombrestatus, MAX(de.iddetallestatus) as iddetallestatusmax, de.fecharegistro
         from parte p, detalleparte dp, users u, detallestatus de, status s
         where p.idparte = dp.idparte
         and de.idoperador = u.id
         and de.iddetalleparte = dp.iddetalleparte
         and de.idstatus = s.idestatus
         and de.idoperador = '.$usuario.'
         and s.idestatus in ('.$estatus.')
         and de.fecharegistro >="'.$fechainicio.'"
         and de.fecharegistro <="'.$fechafin.'"
         GROUP BY de.iddetalleparte DESC;');
         return $query->result();
    }


}
