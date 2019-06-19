 <?php
class Modelo_model extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    
    
    public function __destruct()
    {
        $this->db->close();
    }
    
    
    public function showAll($idparte)
    {
        $this->db->select('m.idmodelo,p.numeroparte, c.abreviatura as cliente, m.descripcion ');    
        $this->db->from('tblmodelo m');
        $this->db->join('parte p', 'p.idparte = m.idparte');
        $this->db->join('users u', 'm.idusuario = u.id'); 
         $this->db->join('cliente c', 'c.idcliente = p.idcliente'); 
         $this->db->where('m.idparte',$idparte);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
//     public function showAllCalidad()
//    {
//        $this->db->select('u.id as idusuario,u.name');    
//        $this->db->from('users u');
//        $this->db->join('users_rol ur', 'u.id = ur.id_user');
//        $this->db->join('rol r', 'ur.id_rol = r.id'); 
//        $this->db->where('r.id',2);
//        $this->db->where('u.activo',1);
//        $query = $this->db->get();
//        if ($query->num_rows() > 0) {
//            return $query->result();
//        } else {
//            return false;
//        }
//    }
//    public function showAllBodega()
//    {
//        $this->db->select('u.id as idusuario,u.name');    
//        $this->db->from('users u');
//        $this->db->join('users_rol ur', 'u.id = ur.id_user');
//        $this->db->join('rol r', 'ur.id_rol = r.id'); 
//        $this->db->where('r.id',4);
//        $this->db->where('u.activo',1);
//        $query = $this->db->get();
//        if ($query->num_rows() > 0) {
//            return $query->result();
//        } else {
//            return false;
//        }
//    }
//    public function showAllPacking()
//    {
//        $this->db->select('u.id as idusuario,u.name');    
//        $this->db->from('users u');
//        $this->db->join('users_rol ur', 'u.id = ur.id_user');
//        $this->db->join('rol r', 'ur.id_rol = r.id'); 
//        $this->db->where('r.id',3);
//        $this->db->where('u.activo',1);
//        $query = $this->db->get();
//        if ($query->num_rows() > 0) {
//            return $query->result();
//        } else {
//            return false;
//        }
//    }
    public function validadExistenciaModelo($modelo) {
        $this->db->select('m.idmodelo,p.numeroparte, c.abreviatura as cliente, m.descripcion ');
        $this->db->from('tblmodelo m');
        $this->db->join('parte p', 'p.idparte = m.idparte');
        $this->db->join('users u', 'm.idusuario = u.id');
        $this->db->join('cliente c', 'c.idcliente = p.idcliente');
        $this->db->where('m.descripcion', $modelo);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
       public function validadExistenciaModeloUpdate($idmodelo,$modelo) {
        $this->db->select('m.idmodelo,p.numeroparte, c.abreviatura as cliente, m.descripcion ');
        $this->db->from('tblmodelo m');
        $this->db->join('parte p', 'p.idparte = m.idparte');
        $this->db->join('users u', 'm.idusuario = u.id');
        $this->db->join('cliente c', 'c.idcliente = p.idcliente');
        $this->db->where('m.descripcion', $modelo);
         $this->db->where('m.idmodelo !=', $idmodelo);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function addModelo($data)
    {
        $this->db->insert('tblmodelo', $data);
        $insert_id = $this->db->insert_id(); 
        return  $insert_id;
    }
    
    
    public function updateModelo($id, $field)
    {
        $this->db->where('idmodelo', $id);
        $this->db->update('tblmodelo', $field);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
        
    }
    public    function detalleModelo($id) {
        $this->db->select('m.*');
        $this->db->from('tblmodelo m');
        $this->db->where('m.idmodelo', $id);
        $query = $this->db->get();
        return $query->first_row();
    }
//        
//      public function updateUserRol($id, $field)
//    {
//        $this->db->where('id_user', $id);
//        $this->db->update('users_rol', $field);
//        if ($this->db->affected_rows() > 0) {
//            return true;
//        } else {
//            return false;
//        }
//        
//    }
//      public function passwordupdateUser($id, $field)
//    {
//        $this->db->where('id', $id);
//        $this->db->update('users', $field);
//        if ($this->db->affected_rows() > 0) {
//            return true;
//        } else {
//            return false;
//        }
//        
//    }
//    public function deleteUser($id)
//    {
//        $this->db->where('id', $id);
//        $this->db->delete('users');
//        if ($this->db->affected_rows() > 0) {
//            return true;
//        } else {
//            return false;
//        }
//        
//    }
//       public function validarUsuarioRegistrado($usuario )
//    {
//        # code...
//        $this->db->select('u.*');    
//        $this->db->from('users u');
//        $this->db->where('u.usuario', $usuario); 
//        $query = $this->db->get();
//        //$query = $this->db->get('permissions');
//        if ($query->num_rows() > 0) {
//            return $query->result();
//        } else {
//            return false;
//        }
//    }
//
//    public function searchUser($match)
//    {
//        $field = array(
//            'u.usuario',
//            'u.name'
//        );
//        $this->db->select('u.*,r.id as idrol, r.rol as rolnombre');    
//        $this->db->from('users u');
//        $this->db->join('users_rol ur', 'u.id = ur.id_user');
//        $this->db->join('rol r', 'ur.id_rol = r.id'); 
//        $this->db->like('concat(' . implode(',', $field) . ')', $match);
//        $query = $this->db->get(); 
//        if ($query->num_rows() > 0) {
//            return $query->result();
//        } else {
//            return false;
//        }
//    }
//     public function addUserRol($data)
//    {
//        return $this->db->insert('users_rol', $data);
//    }  
//    function detalleUsuario($idusuario) {
//        $this->db->select('u.id as idusuario,u.name, u.usuario');
//        $this->db->from('users u');
//        $this->db->where('u.id', $idusuario);
//        $query = $this->db->get();
//        return $query->first_row();
//    }

}
?> 