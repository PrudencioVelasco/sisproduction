<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Palletcajasproceso_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function __destruct() {
        $this->db->close();
    }

  public function addPalletCajasProceso($data)
    {
        $this->db->insert('palletcajasproceso', $data);
        return $this->db->insert_id();
    }

}
