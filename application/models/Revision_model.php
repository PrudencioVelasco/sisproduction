 <?php
class Revision_model extends CI_Model
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
    
    
    public function showAll($idmodelo)
    {
        $this->db->select('r.idrevision,r.idmodelo, r.descripcion');    
        $this->db->from('tblmodelo m');
        $this->db->join('tblrevision r', 'r.idmodelo=m.idmodelo'); 
         $this->db->where('r.idmodelo',$idmodelo);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function validadExistenciaRevision($idmodelo,$revision) {
        $this->db->select('r.idrevision, m.descripcion, r.descripcion as descrevision');    
        $this->db->from('tblmodelo m');
        $this->db->join('tblrevision r', 'r.idmodelo=m.idmodelo'); 
        $this->db->where('r.idmodelo',$idmodelo);
         $this->db->where('TRIM(r.descripcion)', $revision);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
       public function validadExistenciaRevisionUpdate($idrevision,$revision,$idmodelo) {
        $this->db->select('r.idrevision, m.descripcion, r.descripcion as descrevision');    
        $this->db->from('tblmodelo m');
        $this->db->join('tblrevision r', 'r.idmodelo=m.idmodelo'); 
        $this->db->where('TRIM(r.descripcion)', $revision);
        $this->db->where('r.idmodelo', $idmodelo);
        $this->db->where('r.idrevision !=', $idrevision);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function addRevision($data)
    {
        $this->db->insert('tblrevision', $data);
        $insert_id = $this->db->insert_id(); 
        return  $insert_id;
    }
    
    
    public function updateRevision($id, $field)
    {
        $this->db->where('idrevision', $id);
        $this->db->update('tblrevision', $field);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
        
    }
    public    function detalleRevision($id) {
        $this->db->select('c.nombre, p.numeroparte, m.descripcion as modelo');
        $this->db->from('tblmodelo m');
        $this->db->join('parte p', 'p.idparte = m.idparte');
        $this->db->join('cliente c', 'c.idcliente = p.idcliente');
        $this->db->where('m.idmodelo', $id);
        $query = $this->db->get();
        return $query->first_row();
    }

        public function searchRevision($match,$idmodelo) {
        $field = array(
                 'r.descripcion'
        );
        $this->db->select('r.idrevision, r.descripcion');    
        $this->db->from('tblmodelo m');
        $this->db->join('tblrevision r', 'r.idmodelo=m.idmodelo'); 
        $this->db->where('r.idmodelo',$idmodelo);
        $this->db->like('concat(' . implode(',', $field) . ')', $match);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
     public function deleteRevision($id)
    {
        $this->db->where('idrevision', $id);
        $this->db->delete('tblrevision');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
        
    }

}
?> 