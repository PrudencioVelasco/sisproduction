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
    public function allTransferenciaPacking($fechainicio,$fechafin)
    {
        $query =$this->db->query('SELECT * FROM viewprocesopallet
                                WHERE (CONVERT(fecha, DATE) BETWEEN "'.$fechainicio.'" AND "'.$fechafin.'")
                                AND idestatus IN (1,3,8)');
         return $query->result();
    }
     public function allTransferenciaCalidad($fechainicio,$fechafin)
    {
        $query =$this->db->query('SELECT * FROM viewprocesopallet
                                WHERE (CONVERT(fecha, DATE) BETWEEN "'.$fechainicio.'" AND "'.$fechafin.'")
                                AND idestatus IN (4,5,6,8)');
         return $query->result();
    }
     public function allTransferenciaBodega($fechainicio,$fechafin)
    {
        $query =$this->db->query('SELECT * FROM viewprocesopallet
                                WHERE (CONVERT(fecha, DATE) BETWEEN "'.$fechainicio.'" AND "'.$fechafin.'")
                                AND idestatus IN (4,8)');
         return $query->result();
    }


     public function allProcesos() { 
        $query = $this->db->query("SELECT  p.idproceso, p.nombreproceso,
(SELECT  
                            GROUP_CONCAT(CONCAT_WS('.- ', dp.numero, m.nombremaquina) ORDER BY dp.numero ASC SEPARATOR ', ')
                            FROM tbldetalle_proceso dp
                            INNER JOIN tblmaquina m ON dp.idmaquina = m.idmaquina
                            WHERE dp.idproceso = p.idproceso  AND dp.activo = 1  group by dp.idproceso ORDER BY dp.numero ASC) as pasos
 FROM tblproceso p");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
     
    }


       public function allMaquinas() {
        $this->db->select('m.idmaquina, m.nombremaquina');
        $this->db->from('tblmaquina m'); 
        //$this->db->where('p.nombreproceso', $nombreproceso); 
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }


   public function allNumeroPartes(){
                 $this->db->select('p.idparte, c.idcliente,p.idcategoria, ca.nombrecategoria, p.numeroparte,c.nombre,u.name,  p.activo, m.descripcion as modelo, r.descripcion as revision');
                $this->db->from('parte p');
                $this->db->join('cliente c', 'p.idcliente=c.idcliente');
                $this->db->join('tblcategoria ca', 'p.idcategoria=ca.idcategoria');
                $this->db->join('users u', 'p.idusuario=u.id');
                $this->db->join('tblmodelo m', 'm.idparte=p.idparte');
                $this->db->join('tblrevision r', 'm.idmodelo=r.idmodelo'); 
                $query = $this->db->get();
                if ($query->num_rows() > 0) {
                     return $query->result();
                } else {
                    return false;
                }
            }

    public function busqueda_proceso($finicio = '',$ffin = '',$lamina = '',$proceso = '',$maquina = '')
    {
        # code...
        $this->db->select("ep.identradaproceso, p.idproceso, p.nombreproceso, d.finalizado, ep.finalizado as finalizadoproceso,
(SELECT pa.numeroparte FROM parte pa WHERE pa.idparte = ep.idparte) as numeroparte,
(SELECT pa2.numeroparte FROM parte pa2 WHERE pa2.idparte = ep.idlamina) as lamina,
(SELECT   GROUP_CONCAT(CONCAT_WS('.- ', dp.numero, m.nombremaquina) ORDER BY dp.numero ASC SEPARATOR ', ')
                            FROM tbldetalle_proceso dp
                            INNER JOIN tblmaquina m ON dp.idmaquina = m.idmaquina
                            WHERE dp.idproceso = p.idproceso  AND dp.activo = 1  group by dp.idproceso ORDER BY dp.numero ASC) as pasos,
                            (
SELECT CONCAT_WS('.- ', edp.numerodetalleproceso, ma.nombremaquina)   FROM tblentradadetalleproceso edp, tblmaquina ma WHERE edp.identradaproceso = ep.identradaproceso
AND ma.idmaquina = edp.idmaquina ORDER by  edp.identradadetalleproceso DESC LIMIT 1) as procesoactual,


d.cantidadentrada, d.cantidadsalida, d.cantidaderronea, d.fecharegistro, d.fechaliberado,
(SELECT maq.nombremaquina FROM tblmaquina maq, tbldetalle_proceso dpr WHERE dpr.idmaquina =maq.idmaquina AND  dpr.iddetalle = d.iddetalleproceso ) AS maquinaactual,
d.numerodetalleproceso AS numerodelproceso");
        $this->db->from('tblproceso p'); 
        $this->db->join('tblentrada_proceso ep', 'p.idproceso = ep.idproceso');
         $this->db->join('tblentradadetalleproceso d', 'd.identradaproceso = ep.identradaproceso');
        //$this->db->where('p.nombreproceso', $nombreproceso); 

        if (!empty($finicio) && !empty($ffin)) {
            $this->db->where('date(ep.fecharegistro) >=', $finicio);
            $this->db->where('date(ep.fecharegistro) <=', $ffin); 
        } 
         if (!empty($lamina)) { 
            $this->db->where('(ep.idparte = '.$lamina.' or ep.idlamina = '.$lamina.')'); 
        }
         if (!empty($proceso)) { 
           $this->db->where('ep.idproceso', $proceso);
        } 
        if (!empty($maquina)) { 
           $this->db->where('d.idmaquina', $maquina);
        } 
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }

    }


    

}
