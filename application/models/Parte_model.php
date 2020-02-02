<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Parte_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function __destruct()
    {
        $this->db->close();
    }

    public function showAll()
    {
        $this->db->select('p.idparte,c.idcliente,p.idcategoria, ca.nombrecategoria, p.numeroparte,c.nombre,u.name, p.activo');
        $this->db->from('parte p');
        $this->db->join('cliente c', 'p.idcliente=c.idcliente');
        $this->db->join('tblcategoria ca', 'p.idcategoria=ca.idcategoria');
        $this->db->join('users u', 'p.idusuario=u.id');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function  searchPartes($match)
    {
        $field = array(
            'p.numeroparte',
            'c.nombre',
            'ca.nombrecategoria'
        );

        $this->db->select('p.idparte,c.idcliente, p.numeroparte,c.nombre,u.name,ca.nombrecategoria, p.idcategoria, p.activo');
        $this->db->from('parte p');
        $this->db->join('cliente c', 'p.idcliente=c.idcliente');
        $this->db->join('tblcategoria ca', 'p.idcategoria=ca.idcategoria');
        $this->db->join('users u', 'p.idusuario=u.id');
        $this->db->like('concat(' . implode(',', $field) . ')', $match);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
public function palletReporte($iddetalleparte){
       $query =$this->db->query("SELECT p.numeroparte, c.nombre, dp.modelo,
COUNT(pc.pallet) AS totalpallet, 
(SUM(pc.cajas)  / COUNT(pc.pallet) ) AS cajasporpallet,
SUM(pc.cajas) AS totalcajas FROM parte p
INNER JOIN detalleparte dp  ON p.idparte = dp.idparte
INNER JOIN palletcajas pc ON dp.iddetalleparte = pc.iddetalleparte 
INNER JOIN cliente c ON c.idcliente = p.idcliente
WHERE dp.iddetalleparte = '$iddetalleparte'
GROUP by pc.cajas"); 
         if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
}
    public function showAllEnviados($idusuario)
    {
       $query =$this->db->query("SELECT p.idparte,d.iddetalleparte, p.numeroparte, d.folio, d.modelo, d.revision, l.idlinea,l.nombrelinea, DATE_FORMAT(d.fecharegistro,'%d/%m/%Y %h:%i %p' ) as fecharegistro,
 (SELECT  COUNT(pc.pallet)  FROM  palletcajas pc WHERE pc.iddetalleparte = d.iddetalleparte) as totalpallet,
 (SELECT  SUM(pc2.cajas)  FROM  palletcajas pc2 WHERE pc2.iddetalleparte = d.iddetalleparte) as totalcajas,
 (SELECT COUNT(pc3.idestatus)  FROM palletcajas pc3 WHERE pc3.iddetalleparte = d.iddetalleparte AND pc3.idestatus = 1) AS totalenviado,
 (SELECT COUNT(pc4.idestatus)  FROM palletcajas pc4 WHERE pc4.iddetalleparte = d.iddetalleparte AND pc4.idestatus = 8) AS totalfinalizado,
 (SELECT COUNT(pc5.idestatus)  FROM palletcajas pc5 WHERE pc5.iddetalleparte = d.iddetalleparte AND pc5.idestatus = 3) AS totalcancelado,
  (SELECT COUNT(pc6.idestatus)  FROM palletcajas pc6 WHERE pc6.iddetalleparte = d.iddetalleparte AND pc6.idestatus = 4) AS totalenviadocalidad,
   (SELECT COUNT(pc7.idestatus)  FROM palletcajas pc7 WHERE pc7.iddetalleparte = d.iddetalleparte AND pc7.idestatus = 12) AS enhold
 FROM parte p, detalleparte d, linea l
 WHERE p.idparte = d.idparte
 AND l.idlinea = d.idlinea
  ORDER BY d.fecharegistro DESC
  ");
      
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    public function buscarEnviados($text){
              $query =$this->db->query("SELECT p.idparte,
       d.iddetalleparte,
       p.numeroparte,
       d.folio,
       d.modelo,
       d.revision,
       l.idlinea,
       l.nombrelinea,
       Date_format(d.fecharegistro, '%d/%m/%Y %h:%i %p') AS fecharegistro,
       (SELECT Count(pc.pallet)
        FROM   palletcajas pc
        WHERE  pc.iddetalleparte = d.iddetalleparte)     AS totalpallet,
       (SELECT Sum(pc2.cajas)
        FROM   palletcajas pc2
        WHERE  pc2.iddetalleparte = d.iddetalleparte)    AS totalcajas,
       (SELECT Count(pc3.idestatus)
        FROM   palletcajas pc3
        WHERE  pc3.iddetalleparte = d.iddetalleparte
               AND pc3.idestatus = 1)                    AS totalenviado,
       (SELECT Count(pc4.idestatus)
        FROM   palletcajas pc4
        WHERE  pc4.iddetalleparte = d.iddetalleparte
               AND pc4.idestatus = 8)                    AS totalfinalizado,
       (SELECT Count(pc5.idestatus)
        FROM   palletcajas pc5
        WHERE  pc5.iddetalleparte = d.iddetalleparte
               AND pc5.idestatus = 3)                    AS totalcancelado,
       (SELECT Count(pc6.idestatus)
        FROM   palletcajas pc6
        WHERE  pc6.iddetalleparte = d.iddetalleparte
               AND pc6.idestatus = 4)                    AS totalenviadocalidad,
       (SELECT Count(pc7.idestatus)
        FROM   palletcajas pc7
        WHERE  pc7.iddetalleparte = d.iddetalleparte
               AND pc7.idestatus = 12)                   AS enhold
FROM   parte p,
       detalleparte d,
       linea l
WHERE  p.idparte = d.idparte
       AND l.idlinea = d.idlinea
       AND ( d.folio LIKE '%$text%'
              OR p.numeroparte LIKE '%$text%'
              OR d.modelo LIKE '%$text%'
              OR d.revision LIKE '%$text%'
              OR d.iddetalleparte IN (SELECT pcv.iddetalleparte
                                      FROM   palletcajas pcv,
                                             detalleparte dpv,
                                             parte pv
                                      WHERE  pv.idparte = dpv.idparte
                                             AND dpv.iddetalleparte =
                                                 pcv.iddetalleparte
                                             AND Concat(pv.numeroparte, '_',
                                                 pcv.idpalletcajas)
                                                 LIKE
                                                 '%$text%') )
ORDER  BY d.fecharegistro DESC");
             return $query->result();

            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            } 
    }
    public function cantidadesPartes($iddetalleparte){
        $this->db->select('pc.pallet, pc.cajas');
        $this->db->from('detalleparte dp');
        $this->db->join('palletcajas pc', 'dp.iddetalleparte=pc.iddetalleparte');
        $this->db->where('dp.iddetalleparte',$iddetalleparte);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        } 
    }
    public function detalleDelDetallaParte($iddetalle)
    {
        // code...
        $this->db->select('d.iddetalleparte,
        p.idparte,
        d.folio,
        c.idcliente,
        p.numeroparte,
        c.nombre,
        u.name,
        t.nombreturno,
        t.horainicial,
        t.horafinal, 
        u.usuario,
        d.fecharegistro,
        d.pallet,
        d.modelo,
        d.revision,
        d.cantidad,
        l.idlinea,
        l.nombrelinea, 
        CONCAT(p.numeroparte) AS codigo');
        $this->db->from('parte p');
        $this->db->join('cliente c', 'p.idcliente=c.idcliente');
        $this->db->join('detalleparte d', 'p.idparte=d.idparte');
        $this->db->join('users u', 'd.idusuario=u.id');
        $this->db->join('linea l', 'd.idlinea=l.idlinea');
        $this->db->join('turno t', 't.idturno=u.idturno');
        //$this->db->join('status s', 's.idestatus=d.idestatus');
        //$this->db->join('detallestatus ds', 'ds.iddetalleparte=d.iddetalleparte');
        $this->db->where('d.iddetalleparte',$iddetalle);
        $query = $this->db->get();

        return $query->first_row();
    }

    public function searchEnviados($match,$idusuario)
    {
        $field = array(
            'p.numeroparte',
            's.nombrestatus',
            'd.fecharegistro',
            'd.revision'
        );

        $this->db->select('
        p.idparte,
        c.idcliente,
        s.idestatus,
        p.numeroparte,
        c.nombre,
        u.name,
        uo.name as nombreoperador,
        d.fecharegistro,
        d.pallet,
        d.cantidad,
        s.nombrestatus');
        $this->db->from('parte p');
        $this->db->join('cliente c', 'p.idcliente=c.idcliente');
        $this->db->join('detalleparte d', 'p.idparte=d.idparte');
        $this->db->join('users u', 'd.idusuario=u.id');
        $this->db->join('users uo', 'd.idoperador=uo.id');
        $this->db->join('status s', 's.idestatus=d.idestatus');
        $this->db->join('detallestatus ds', 'ds.iddetalleparte=d.iddetalleparte');
        $this->db->where('d.idusuario',$idusuario);
        $this->db->where('d.idestatus',1);
        $this->db->like('concat(' . implode(',', $field) . ')', $match);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function validarClienteParte($idcliente,$numeroparte)
    {
        //Funcion para validar al registra un numero de parte que no
        //este registrado con el mismo cliente
        $this->db->select('p.*');
        $this->db->from('parte p');
        $this->db->where('p.idcliente',$idcliente);
        $this->db->where('TRIM(p.numeroparte)',$numeroparte);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    public function validarClientePartePorIdParte($idparte,$idcliente,$numeroparte)
    {
        //Funcion para validar al registra un numero de parte que no
        //este registrado con el mismo cliente
        $this->db->select('p.*');
        $this->db->from('parte p');
        $this->db->where('p.idcliente',$idcliente);
        $this->db->where('TRIM(p.numeroparte)',$numeroparte);
        $this->db->where('p.idparte !=',$idparte);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    public function detalleParteId($idparte)
    {
        $this->db->select('p.idparte,c.idcliente, p.numeroparte,c.nombre,u.name, p.activo');
        $this->db->from('parte p');
        $this->db->join('cliente c', 'p.idcliente=c.idcliente');
        $this->db->join('users u', 'p.idusuario=u.id');
        $this->db->where('p.idparte', $idparte);
        $query = $this->db->get();

        return $query->first_row();
    }

    public function motivosCancelacionCalidad($iddetalleparte)
    {
        $this->db->select('d.comentariosrechazo, d.fecharegistro');
        $this->db->from('detallestatus d');
        $this->db->where('d.iddetalleparte', $iddetalleparte);
        $this->db->where('d.idstatus', 3);
        $this->db->order_by("d.fecharegistro", "desc");
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function addParte($data)
    {
        return $this->db->insert('parte', $data);
    }
   

    public function addDetalleParte($data)
    {
        $this->db->insert('detalleparte', $data);
        return $this->db->insert_id();
    }

    public function addDetalleEstatusParte($data)
    {
        return $this->db->insert('detallestatus', $data);
    }

    public function updateDetalleParte($id, $field)
    {
        $this->db->where('iddetalleparte', $id);
        $this->db->update('detalleparte', $field);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function updateParte($id, $field)
    {
        $this->db->where('idparte', $id);
        $this->db->update('parte', $field);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    
       public function updatePalletCajas($id, $field)
    {
        $this->db->where('idpalletcajas', $id);
        $this->db->update('palletcajas', $field);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

}
