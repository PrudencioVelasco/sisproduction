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
        $this->db->select('m.idmodelo,'
               . 'p.idparte,'
                . 'p.numeroparte,'
                . 'c.abreviatura as cliente,'
                . 'm.descripcion,'
                . 'm.nombrehoja,'
                . 'm.fulloneimpresion,'
                . 'm.colorlinea,'
                . 'm.diucutno,'
                . 'm.platonumero,'
                . 'm.normascompartidas,'
                . 'm.salida,'
                . 'm.combinacion,'
                . 'm.color');    
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
 
    public function validadExistenciaModelo($modelo,$idparte) {
        $this->db->select('m.idmodelo,p.numeroparte, c.abreviatura as cliente, m.descripcion ');
        $this->db->from('tblmodelo m');
        $this->db->join('parte p', 'p.idparte = m.idparte');
        $this->db->join('users u', 'm.idusuario = u.id');
        $this->db->join('cliente c', 'c.idcliente = p.idcliente');
        $this->db->where('TRIM(m.descripcion)', $modelo);
         $this->db->where('p.idparte', $idparte);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
       public function validadExistenciaModeloUpdate($idmodelo,$modelo,$idparte) {
        $this->db->select('m.idmodelo,p.numeroparte, c.abreviatura as cliente, m.descripcion ');
        $this->db->from('tblmodelo m');
        $this->db->join('parte p', 'p.idparte = m.idparte');
        $this->db->join('users u', 'm.idusuario = u.id');
        $this->db->join('cliente c', 'c.idcliente = p.idcliente');
        $this->db->where('TRIM(m.descripcion)', $modelo);
         $this->db->where('m.idparte', $idparte);
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
        $this->db->select('c.nombre, p.numeroparte');
        $this->db->from('parte p');
        $this->db->join('cliente c', 'c.idcliente = p.idcliente');
        $this->db->where('p.idparte', $id);
        $query = $this->db->get();
        return $query->first_row();
    }
 
    public function searchModelo($match,$idparte) {
        $field = array(
                 'p.numeroparte',
                 'c.abreviatura',
                 'm.descripcion',
                 'm.nombrehoja',
                 'm.fulloneimpresion',
                 'm.colorlinea',
                 'm.diucutno',
                 'm.platonumero',
                 'm.normascompartidas',
                 'm.salida',
                 'm.combinacion',
                 'm.color'
        );
        $this->db->select('m.idmodelo,'
                . 'p.numeroparte,'
                . 'c.abreviatura as cliente,'
                . 'm.descripcion,'
                . 'm.nombrehoja,'
                . 'm.fulloneimpresion,'
                . 'm.colorlinea,'
                . 'm.diucutno,'
                . 'm.platonumero,'
                . 'm.normascompartidas,'
                . 'm.salida,'
                . 'm.combinacion,'
                . 'm.color');
        $this->db->from('tblmodelo m');
        $this->db->join('parte p', 'p.idparte = m.idparte');
        $this->db->join('users u', 'm.idusuario = u.id');
        $this->db->join('cliente c', 'c.idcliente = p.idcliente');
        $this->db->where('m.idparte', $idparte);
        $this->db->like('concat(' . implode(',', $field) . ')', $match);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
     public function deleteModelo($id)
    {
        $this->db->where('idmodelo', $id);
        $this->db->delete('tblmodelo');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
        
    }

}
?> 