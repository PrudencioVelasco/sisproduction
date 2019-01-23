<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model
{
    private $_mongoDb;

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function login($data) {
        $usuario = $data['usuario'];
        $password = $data['password'];

        $this->db->select('u.id, u.idusuario, u.usuario, u.name, r.rol');    
        $this->db->from('users u');
        $this->db->join('users_rol ur', 'u.id = ur.id_user');
        $this->db->join('rol r', 'r.id = ur.id_rol');
        $this->db->where('u.usuario', $usuario);
        $this->db->where('u.password', $password);
        $this->db->where('u.activo', 1);
        $query = $this->db->get()->row();

        //$query = $this->db->get_where('users', array('usuario' => $usuario, 'password' => $password, 'activo' => 1))->row();
        return $query;
    }

    public function __destruct() {
        $this->db->close();
    }
}
