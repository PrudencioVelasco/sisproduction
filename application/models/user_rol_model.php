<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_rol_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
 
	public function __destruct()
	{
		$this->db->close();
	}
	
  public function addUserRol($data)
    {
        return $this->db->insert('users_rol', $data);
    }  
   
}
