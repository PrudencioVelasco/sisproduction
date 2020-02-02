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
        $this->db->select('c.idcantidad, r.descripcion, c.cantidad, r.idrevision');    
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

    public function validadExistenciaCantidad($idrevision,$cantidad) {
         $this->db->select('r.idrevision, c.cantidad, r.descripcion as descrevision');    
        $this->db->from('tblcantidad c');
        $this->db->join('tblrevision r', 'r.idrevision=c.idrevision'); 
         $this->db->where('c.idrevision',$idrevision);
        $this->db->where('TRIM(c.cantidad)', $cantidad);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
       public function validadExistenciaCantidadUpdate($idcantidad,$idrevision,$cantidad) {
          $this->db->select('c.idcantidad, r.descripcion, c.cantidad');    
        $this->db->from('tblcantidad c');
        $this->db->join('tblrevision r', 'r.idrevision=c.idrevision'); 
        $this->db->where('TRIM(c.cantidad)', $cantidad);
         $this->db->where('c.idcantidad !=', $idcantidad);
         $this->db->where('r.idrevision', $idrevision);
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
        $this->db->select('c.nombre, p.numeroparte, m.descripcion as modelo,r.descripcion as revision');
        $this->db->from('tblmodelo m');
        $this->db->join('parte p', 'p.idparte = m.idparte');
        $this->db->join('cliente c', 'c.idcliente = p.idcliente');
        $this->db->join('tblrevision r', 'r.idmodelo = m.idmodelo');
        $this->db->where('r.idrevision', $id);
        $query = $this->db->get();
        return $query->first_row();
    }

    public function searchCantidad($match,$idrevision) {
        $field = array(
                 'c.cantidad'
        );
          $this->db->select('c.idcantidad, r.descripcion, c.cantidad');   
        $this->db->from('tblcantidad c');
        $this->db->join('tblrevision r', 'r.idrevision=c.idrevision'); 
         $this->db->where('c.idrevision',$idrevision);
        $this->db->like('concat(' . implode(',', $field) . ')', $match);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
     public function deleteCantidad($id)
    {
        $this->db->where('idcantidad', $id);
        $this->db->delete('tblcantidad');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
        
    }


}
?> 