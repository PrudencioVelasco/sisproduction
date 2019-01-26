<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Calidad_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function __destruct()
    {
        $this->db->close();
    }

    public function showAllEnviados($idusuario)
    {
        $this->db->select('d.iddetalleparte,p.idparte,c.idcliente, s.idestatus, p.numeroparte,c.nombre,u.name,uo.name as nombreoperador,d.fecharegistro,d.pallet,d.cantidad,s.nombrestatus');
        $this->db->from('parte p');
        $this->db->join('cliente c', 'p.idcliente=c.idcliente');
        $this->db->join('detalleparte d', 'p.idparte=d.idparte');
        $this->db->join('users u', 'd.idusuario=u.id');
        $this->db->join('users uo', 'd.idoperador=uo.id');
        $this->db->join('status s', 's.idestatus=d.idestatus');
        $this->db->where('d.idusuario',$idusuario);
        $this->db->where('d.idestatus',1); 
        $this->db->order_by("d.fecharegistro", "desc");
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
        c.idcliente,
        s.idestatus,
        p.numeroparte,
        c.nombre,
        u.id,
        u.name,
        uo.name as nombreoperador,
        d.fecharegistro,
        d.pallet,
        d.modelo,
        d.revision,
        d.cantidad,
        d.linea,
        d.idoperador,
        s.nombrestatus');
        $this->db->from('parte p');
        $this->db->join('cliente c', 'p.idcliente=c.idcliente');
        $this->db->join('detalleparte d', 'p.idparte=d.idparte');
        $this->db->join('users u', 'd.idusuario=u.id');
        $this->db->join('users uo', 'd.idoperador=uo.id');
        $this->db->join('status s', 's.idestatus=d.idestatus');
        $this->db->join('detallestatus ds', 'ds.iddetalleparte=d.iddetalleparte');
        $this->db->where('d.iddetalleparte',$iddetalle);
        $query = $this->db->get();
        
        return $query->first_row();
    }

    public function searchPartes($match,$user)
    {
        $field = array(
            'p.numeroparte'
        );

        $this->db->select('d.iddetalleparte,
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
        $this->db->join('cliente c','p.idcliente = c.idcliente');
        $this->db->join('detalleparte d' ,'p.idparte = d.idparte');
        $this->db->join('users u','d.idusuario = u.id');
        $this->db->join('users uo ','d.idoperador = uo.id');
        $this->db->join('status s' ,'s.idestatus = d.idestatus');
        $this->db->where('d.idusuario',$user); 
        $this->db->where('d.idestatus', 1); 
        $this->db->like('concat(' . implode(',', $field) . ')', $match);
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

    // Usuarios Bodega
    public function allUsersBodega()
    {
        $this->db->select('u.id as idusuario,u.name');    
        $this->db->from('users u');
        $this->db->join('users_rol ur','u.id = ur.id_user');
        $this->db->join('rol r', 'ur.id_rol = r.id');  
        $this->db->where('r.id', 3); 
        $this->db->where('u.activo' , 1);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    // Actualizar la informacion de la tabla detalle parte[idoperador][idstatus]
    public function updateDetalleParte($id, $data)
    {
        $this->db->where('iddetalleparte', $id);
        $this->db->update('detalleparte', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    // Agregar informacion a la tabla detalle status(Historial)
    public function addDetalleEstatusParte($data)
    {
        return $this->db->insert('detallestatus', $data);
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }
    
    public function addRechazoParte($data)
    {
        return $this->db->insert('detallestatus', $data);
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }
}