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
        $this->db->select('r.idrevision, m.descripcion, r.descripcion as descrevision');    
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
        $this->db->where('r.descripcion', $revision);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
       public function validadExistenciaRevisionUpdate($idrevision,$revision) {
        $this->db->select('r.idrevision, m.descripcion, r.descripcion as descrevision');    
        $this->db->from('tblmodelo m');
        $this->db->join('tblrevision r', 'r.idmodelo=m.idmodelo'); 
        $this->db->where('r.descripcion', $revision);
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
        $this->db->select('r.*');
        $this->db->from('tblrevision r');
        $this->db->where('r.idrevision', $id);
        $query = $this->db->get();
        return $query->first_row();
    }

}
?> 