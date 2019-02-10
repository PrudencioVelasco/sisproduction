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
        $query =$this->db->query('select dp.iddetalleparte, dp.folio, p.numeroparte, dp.modelo, dp.revision, dp.pallet, dp.cantidad, dp.linea, u.name nombreusuario, s.nombrestatus, MAX(de.iddetallestatus) as iddetallestatusmax, de.fecharegistro
         from parte p, detalleparte dp, users u, detallestatus de, status s
         where p.idparte = dp.idparte
         and de.idusuario = u.id
         and de.iddetalleparte = dp.iddetalleparte
         and de.idstatus = s.idestatus
         and s.idestatus in ('.$estatus.')
         and de.fecharegistro >="'.$fechainicio.'"
         and de.fecharegistro <="'.$fechafin.'"
         GROUP BY de.iddetalleparte DESC;');
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
         and de.fecharegistro >="'.$fechainicio.'"
         and de.fecharegistro <="'.$fechafin.'"
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
         and de.fecharegistro >="'.$fechainicio.'"
         and de.fecharegistro <="'.$fechafin.'"
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
