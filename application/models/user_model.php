 <?php
class User_model extends CI_Model
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
    
    
    public function showAll()
    {
        $this->db->select('u.*,r.id as idrol, t.idturno, t.nombreturno,  r.rol as rolnombre');    
        $this->db->from('users u');
        $this->db->join('users_rol ur', 'u.id = ur.id_user');
        $this->db->join('rol r', 'ur.id_rol = r.id'); 
        $this->db->join('turno t', 't.idturno = u.idturno'); 
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
     public function showAllCalidad()
    {
        $this->db->select('u.id as idusuario,u.name');    
        $this->db->from('users u');
        $this->db->join('users_rol ur', 'u.id = ur.id_user');
        $this->db->join('rol r', 'ur.id_rol = r.id'); 
        $this->db->where('r.id',2);
        $this->db->where('u.activo',1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    public function showAllBodega()
    {
        $this->db->select('u.id as idusuario,u.name');    
        $this->db->from('users u');
        $this->db->join('users_rol ur', 'u.id = ur.id_user');
        $this->db->join('rol r', 'ur.id_rol = r.id'); 
        $this->db->where('r.id',4);
        $this->db->where('u.activo',1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    public function showAllPacking()
    {
        $this->db->select('u.id as idusuario,u.name');    
        $this->db->from('users u');
        $this->db->join('users_rol ur', 'u.id = ur.id_user');
        $this->db->join('rol r', 'ur.id_rol = r.id'); 
        $this->db->where('r.id',3);
        $this->db->where('u.activo',1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    public function showAllContar()
    {
        $this->db->select('u.*,r.id as idrol, r.rol as rolnombre');    
        $this->db->from('users u');
        $this->db->join('users_rol ur', 'u.id = ur.id_user');
        $this->db->join('rol r', 'ur.id_rol = r.id'); 
        $query = $this->db->get(); 
         return $query->result(); 
    }
 

    public function addUser($data)
    {
        $this->db->insert('users', $data);
        $insert_id = $this->db->insert_id(); 
        return  $insert_id;
    }
    
    
    public function updateUser($id, $field)
    {
        $this->db->where('id', $id);
        $this->db->update('users', $field);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
        
    }
      public function updateUserRol($id, $field)
    {
        $this->db->where('id_user', $id);
        $this->db->update('users_rol', $field);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
        
    }
      public function passwordupdateUser($id, $field)
    {
        $this->db->where('id', $id);
        $this->db->update('users', $field);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
        
    }
    public function deleteUser($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('users');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
        
    }
       public function validarUsuarioRegistrado($usuario )
    {
        # code...
        $this->db->select('u.*');    
        $this->db->from('users u');
        $this->db->where('u.usuario', $usuario); 
        $query = $this->db->get();
        //$query = $this->db->get('permissions');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function searchUser($match)
    {
        $field = array(
            'u.usuario',
            'u.name'
        );
        $this->db->select('u.*,r.id as idrol, r.rol as rolnombre');    
        $this->db->from('users u');
        $this->db->join('users_rol ur', 'u.id = ur.id_user');
        $this->db->join('rol r', 'ur.id_rol = r.id'); 
        $this->db->like('concat(' . implode(',', $field) . ')', $match);
        $query = $this->db->get(); 
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
     public function addUserRol($data)
    {
        return $this->db->insert('users_rol', $data);
    }  
    function detalleUsuario($idusuario) {
        $this->db->select('u.id as idusuario,u.name, u.usuario');
        $this->db->from('users u');
        $this->db->where('u.id', $idusuario);
        $query = $this->db->get();
        return $query->first_row();
    }

}
?> 