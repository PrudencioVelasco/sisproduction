<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Proceso_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function __destruct() {
        $this->db->close();
    }

    public function showAllProcesos() {
        $this->db->select("p.idproceso, p.activo, p.fecharegistro,  p.nombreproceso,(SELECT  
                            GROUP_CONCAT(CONCAT_WS('.- ', dp.numero, m.nombremaquina) ORDER BY dp.numero ASC SEPARATOR ', ')
                            FROM tbldetalle_proceso dp
                            INNER JOIN tblmaquina m ON dp.idmaquina = m.idmaquina 
                            WHERE dp.idproceso = p.idproceso AND dp.activo = 1   group by dp.idproceso ORDER BY dp.numero ASC) as pasos");
        $this->db->from('tblproceso p'); 
         $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    public function allParteProcesos()
    {
      # code... 
        $query = $this->db->query("SELECT e.idparte,e.metaproduccion, e.idlamina, e.fecharegistro, e.identradaproceso, p.numeroparte as numeroparte, p2.numeroparte as lamina, pr.nombreproceso, e.cantidad,
(SELECT  
                            GROUP_CONCAT(CONCAT_WS('.- ', dp.numero, m.nombremaquina) ORDER BY dp.numero ASC SEPARATOR ', ')
                            FROM tbldetalle_proceso dp
                            INNER JOIN tblmaquina m ON dp.idmaquina = m.idmaquina
                            WHERE dp.idproceso = pr.idproceso  AND dp.activo = 1  group by dp.idproceso ORDER BY dp.numero ASC) as pasos,
(
SELECT CONCAT_WS('.- ', edp.numerodetalleproceso, ma.nombremaquina)   FROM tblentradadetalleproceso edp, tblmaquina ma WHERE edp.identradaproceso = e.identradaproceso
AND ma.idmaquina = edp.idmaquina AND edp.idmaquina != 3 ORDER by  edp.identradadetalleproceso DESC LIMIT 1) as procesoactual,

(SELECT edp2.cantidadentrada  FROM tblentradadetalleproceso edp2 WHERE edp2.identradaproceso = e.identradaproceso ORDER by  edp2.identradadetalleproceso ASC LIMIT 1) as cantidadentrada,
(SELECT edp3.cantidadsalida   FROM tblentradadetalleproceso edp3 WHERE edp3.identradaproceso = e.identradaproceso ORDER by  edp3.identradadetalleproceso ASC LIMIT 1) as cantidadsalida,
(SELECT edp4.cantidaderronea  FROM tblentradadetalleproceso edp4 WHERE edp4.identradaproceso = e.identradaproceso ORDER by  edp4.identradadetalleproceso ASC LIMIT 1) as cantidadmal

 FROM tblentrada_proceso e 
INNER JOIN parte p ON p.idparte = e.idparte
INNER JOIN parte p2 ON p2.idparte = e.idlamina
INNER JOIN tblproceso pr ON pr.idproceso = e.idproceso
WHERE e.eliminado = 0 ORDER BY e.fecharegistro ASC");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
     
    }
       /* public function searchLinea($match) {
        $field = array(
                 'l.nombrelinea',
        );
         $this->db->select('l.idlinea, l.nombrelinea');
        $this->db->from('linea l'); 
        $this->db->like('concat(' . implode(',', $field) . ')', $match);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }*/
   
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

     public function addProceso($data)
    {
        $this->db->insert('tblproceso', $data);
        $insert_id = $this->db->insert_id(); 
        return  $insert_id;
    }
     public function addEntradaProceso($data)
    {
        $this->db->insert('tblentrada_proceso', $data);
        $insert_id = $this->db->insert_id(); 
        return  $insert_id;
    }
    public function addDetalleProceso($data)
    {
        $this->db->insert('tbldetalle_proceso', $data);
        $insert_id = $this->db->insert_id(); 
        return  $insert_id;
    }
     public function addInicioProceso($data)
    {
        $this->db->insert('tblentradadetalleproceso', $data);
        $insert_id = $this->db->insert_id(); 
        return  $insert_id;
    }
    
    
    public function updateProceso($id, $field)
    {
        $this->db->where('idproceso', $id);
        $this->db->update('tblproceso', $field);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
        
    }
     public function updateEstatusDetalle($id, $field)
    {
        $this->db->where('iddetalle', $id);
        $this->db->update('tbldetalle_proceso', $field);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
        
    }
    public function updateDetalleProceso($id, $field)
    {
        $this->db->where('iddetalle', $id);
        $this->db->update('tbldetalle_proceso', $field);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
        
    }
      public function updateEntrada($id, $field)
    {
        $this->db->where('identradaproceso', $id);
        $this->db->update('tblentrada_proceso', $field);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
        
    }
      public function updateSeguimientoProceso($id, $field)
    {
        $this->db->where('identradadetalleproceso', $id);
        $this->db->update('tblentradadetalleproceso', $field);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
        
    }

 public function select_maximo_numero($idproceso) {
        $this->db->select('d.numero');
        $this->db->from('tbldetalle_proceso d'); 
        $this->db->where('d.idproceso', $idproceso);
        $this->db->where('d.activo', 1);
        $this->db->order_by('d.numero', 'desc');  
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
             return $query->first_row();
        } else {
            return false;
        }
    }
    public function validar_existencia_maquina($idmaquina,$idproceso) {
        $this->db->select('d.*');
        $this->db->from('tbldetalle_proceso d'); 
        $this->db->where('d.idmaquina', $idmaquina);
        $this->db->where('d.idproceso', $idproceso);
        $this->db->where('d.activo', 1); 
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
             return $query->first_row();
        } else {
            return false;
        }
    }


       public function validadExistenciaNombreProceso($nombreproceso) {
        $this->db->select('p.idproceso, p.nombreproceso');
        $this->db->from('tblproceso p'); 
        $this->db->where('p.nombreproceso', $nombreproceso); 
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
       public function validadExistenciaProcesoUpdate($idproceso,$nombreproceso) {
         $this->db->select('p.idproceso, p.nombreproceso');
        $this->db->from('tblproceso p'); 
        $this->db->where('p.nombreproceso', $nombreproceso); 
         $this->db->where('p.idproceso !=', $idproceso);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function detalle_proceso_activo($idproceso)
        {
          $this->db->select('dp.iddetalle, dp.numero, m.nombremaquina');
          $this->db->from('tbldetalle_proceso dp');
          $this->db->join('tblmaquina m', 'm.idmaquina=dp.idmaquina');
          $this->db->where('dp.idproceso',$idproceso);
          $this->db->where('dp.activo',1);
          $this->db->order_by("dp.numero", "asc");
          $query = $this->db->get();
          if ($query->num_rows() > 0) {
              return $query->result();
          } else {
              return false;
          }
        }
         public function validar_activo_detalle_entrada($identrada)
        {
          $this->db->select('e.*');
          $this->db->from('tblentradadetalleproceso e'); 
          $this->db->where('e.identradaproceso',$identrada);
          $this->db->where('e.finalizado',1); 
          $query = $this->db->get();
          if ($query->num_rows() > 0) {
              return $query->result();
          } else {
              return false;
          }
        }
         public function detalle_proceso($idproceso)
        {
          $this->db->select('dp.iddetalle, m.idmaquina, dp.numero, m.nombremaquina');
          $this->db->from('tbldetalle_proceso dp');
          $this->db->join('tblmaquina m', 'm.idmaquina=dp.idmaquina');
          $this->db->where('dp.idproceso',$idproceso);
          //$this->db->where('dp.activo',1);
          $this->db->order_by("dp.numero", "asc");
          $query = $this->db->get();
          if ($query->num_rows() > 0) {
              return $query->first_row();
          } else {
              return false;
          }
        }

           public function maquinas_activas()
        {
          $this->db->select('m.*');
          $this->db->from('tblmaquina m'); 
          $this->db->where('m.activo',1); 
          $query = $this->db->get();
          if ($query->num_rows() > 0) {
              return $query->result();
          } else {
              return false;
          }
        }

            public function allProcesosTrabajar($idmaquina)
    {
      # code... 
        $query = $this->db->query("SELECT 
          edp.identradadetalleproceso as id,
 e.idparte,
    e.idlamina,
    e.identradaproceso,
    p.numeroparte AS numeroparte,
    p2.numeroparte AS lamina,
    pr.nombreproceso,
    e.cantidad,
    edp.cantidadentrada,
       edp.cantidadsalida,
       edp.cantidaderronea as cantidadmal,
       edp.idmaquina as tuturno,
       edp.finalizado,
        edp.descrap,
 (SELECT 
            GROUP_CONCAT(CONCAT_WS('.- ', dp.numero, m.nombremaquina)
                    ORDER BY dp.numero ASC
                    SEPARATOR ', ')
        FROM
            tbldetalle_proceso dp
                INNER JOIN
            tblmaquina m ON dp.idmaquina = m.idmaquina
        WHERE
            dp.idproceso = pr.idproceso
                AND dp.activo = 1
        GROUP BY dp.idproceso
        ORDER BY dp.numero ASC) AS pasos,
       
       (SELECT ma.nombremaquina FROM tblmaquina ma WHERE ma.idmaquina = edp.idmaquina) as procesoactual
        
 FROM tblentrada_proceso e 
INNER JOIN parte p ON p.idparte = e.idparte
INNER JOIN parte p2 ON p2.idparte = e.idlamina
INNER JOIN tblproceso pr ON pr.idproceso = e.idproceso
INNER JOIN tblentradadetalleproceso edp ON e.identradaproceso = edp.identradaproceso
WHERE e.eliminado = 0
AND edp.idmaquina = $idmaquina");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
     
    }

         public function allProcesosScrap($idmaquina = 3)
    {
      # code... 
        $query = $this->db->query("SELECT 
edp.identradadetalleproceso as id,
 e.idparte,
    e.idlamina,
    e.identradaproceso,
    p.numeroparte AS numeroparte,
    p2.numeroparte AS lamina,
    pr.nombreproceso,
    e.cantidad,
    edp.cantidadentrada,
       edp.cantidadsalida,
       edp.cantidaderronea as cantidadmal,
       edp.idmaquina as tuturno,
       edp.finalizado,
       edp.descrap,
 (SELECT 
            GROUP_CONCAT(CONCAT_WS('.- ', dp.numero, m.nombremaquina)
                    ORDER BY dp.numero ASC
                    SEPARATOR ', ')
        FROM
            tbldetalle_proceso dp
                INNER JOIN
            tblmaquina m ON dp.idmaquina = m.idmaquina
        WHERE
            dp.idproceso = pr.idproceso
                AND dp.activo = 1
        GROUP BY dp.idproceso
        ORDER BY dp.numero ASC) AS pasos,
       
       (SELECT ma.nombremaquina FROM tblmaquina ma WHERE ma.idmaquina = edp.idmaquina) as procesoactual
        
 FROM tblentrada_proceso e 
INNER JOIN parte p ON p.idparte = e.idparte
INNER JOIN parte p2 ON p2.idparte = e.idlamina
INNER JOIN tblproceso pr ON pr.idproceso = e.idproceso
INNER JOIN tblentradadetalleproceso edp ON e.identradaproceso = edp.identradaproceso
WHERE e.eliminado = 0 
AND idmaquina = 3");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
     
    }

     public function detalle_proceso_maquina($id,$maquina)
        {
          $this->db->select('p.idproceso,dp.numero');
          $this->db->from('tblentradadetalleproceso d');
          $this->db->join('tblentrada_proceso e', 'e.identradaproceso=d.identradaproceso');
          $this->db->join('tblproceso p', 'p.idproceso=e.idproceso');
          $this->db->join('tbldetalle_proceso dp', 'dp.idproceso=p.idproceso');
          $this->db->where('d.identradadetalleproceso',$id);
          $this->db->where('dp.idmaquina',$maquina);
          //$this->db->where('dp.activo',1);
          //$this->db->order_by("dp.numero", "asc");
          $query = $this->db->get();
          if ($query->num_rows() > 0) {
              return $query->first_row();
            //return $query->result();
          } else {
              return false;
          }
        }
        public function detalle_seguimiento_proceso($identrada,$maquina)
        {
          # code...
           $this->db->select('d.*');
          $this->db->from('tblentradadetalleproceso d'); 
          $this->db->where('d.identradaproceso',$identrada);
          $this->db->where('d.idmaquina',$maquina);
          //$this->db->where('dp.activo',1);
          //$this->db->order_by("dp.numero", "asc");
          $query = $this->db->get();
          if ($query->num_rows() > 0) {
              return $query->first_row();
            //return $query->result();
          } else {
              return false;
          }

        }

        public function siguiente_proceso($numero,$idproceso)
        {
          # code...
               $query = $this->db->query("SELECT * FROM tbldetalle_proceso where numero = 
(select min(numero) from tbldetalle_proceso where numero > $numero and idproceso = 1 and activo =1)
and   idproceso = $idproceso and activo =1");
        if ($query->num_rows() > 0) {
        return $query->first_row();
        } else {
            return false;
        }
        }

         public function validar_existencia_proceso_detalle($identradaproceso,$idmaquina)
        {
          $this->db->select('dp.*');
          $this->db->from('tblentradadetalleproceso dp');
          //$this->db->join('tblmaquina m', 'm.idmaquina=dp.idmaquina');
          $this->db->where('dp.identradaproceso',$identradaproceso);
           $this->db->where('dp.idmaquina',$idmaquina);
          //$this->db->where('dp.activo',1);
          //$this->db->order_by("dp.numero", "asc");
          $query = $this->db->get();
          if ($query->num_rows() > 0) {
              return $query->first_row();
          } else {
              return false;
          }
        }
          public function validar_existencia_proceso_activo($identradaproceso,$idmaquina)
        {
          $this->db->select('dp.*');
          $this->db->from('tblentradadetalleproceso dp');
          //$this->db->join('tblmaquina m', 'm.idmaquina=dp.idmaquina');
          $this->db->where('dp.identradaproceso',$identradaproceso);
          $this->db->where('dp.idmaquina',$idmaquina);
          $this->db->where('dp.finalizado',0);
          //$this->db->order_by("dp.numero", "asc");
          $query = $this->db->get();
          if ($query->num_rows() > 0) {
              return $query->first_row();
          } else {
              return false;
          }
        }

        public function detalle_maquina($idmaquina)
        {
          # code...
          $this->db->select('m.*');
          $this->db->from('tblmaquina m');  
          $this->db->where('m.idmaquina',$idmaquina); 
          $query = $this->db->get();
          if ($query->num_rows() > 0) {
              return $query->first_row();
          } else {
              return false;
          }
        }
public function deleteDetalleEntradaPorId($id)
    {
        $this->db->where('identradaproceso', $id);
        $this->db->delete('tblentradadetalleproceso');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
        
    }
    public function deleteEntradaPorId($id)
    {
        $this->db->where('identradaproceso', $id);
        $this->db->delete('tblentrada_proceso');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
        
    }


}
