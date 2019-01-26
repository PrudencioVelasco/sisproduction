<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class posicionbodega_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function __destruct()
    {
        $this->db->close();
    }

        public function posicionesBodega()
    {
        $query = $this->db->get('tblposicionbodega');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }


}
