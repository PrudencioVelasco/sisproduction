 <?php
class Cantidad_model extends CI_Model
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
    
    
    public function showAll($idrevision)
    {
        $this->db->select('c.idcantidad, r.descripcion, c.cantidad');    
        $this->db->from('tblcantidad c');
        $this->db->join('tblrevision r', 'r.idrevision=c.idrevision'); 
         $this->db->where('c.idrevision',$idrevision);
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
       public function validadExistenciaCantidadUpdate($idcantidad,$cantidad) {
          $this->db->select('c.idcantidad, r.descripcion, c.cantidad');    
        $this->db->from('tblcantidad c');
        $this->db->join('tblrevision r', 'r.idrevision=c.idrevision'); 
        $this->db->where('c.cantidad', $cantidad);
         $this->db->where('c.idcantidad !=', $idcantidad);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function addCantidad($data)
    {
        $this->db->insert('tblcantidad', $data);
        $insert_id = $this->db->insert_id(); 
        return  $insert_id;
    }
    
    
    public function updateCantidad($id, $field)
    {
        $this->db->where('idcantidad', $id);
        $this->db->update('tblcantidad', $field);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
        
    }
    public    function detalleCantidad($id) {
        $this->db->select('c.*');
        $this->db->from('tblcantidad c');
        $this->db->where('c.idcantidad', $id);
        $query = $this->db->get();
        return $query->first_row();
    }

}
?> 