<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Devolucion_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function __destruct()
    {
        $this->db->close();
    }

 

    public function addDevolucion($data)
    {
        $this->db->insert('tbldevolucion', $data);
        return $this->db->insert_id();
    }
 

}
