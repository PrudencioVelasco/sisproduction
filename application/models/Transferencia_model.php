<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Transferencia_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function __destruct() {
        $this->db->close();
    }

    public function showAll() {
        $this->db->select('t.idtransferancia, u.name as nombre, t.folio, t.fecharegistro');
        $this->db->from('users u');
        $this->db->join('tbltransferencia  t', 't.idusuario = u.id');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function addUser($data) {
        $this->db->insert('users', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    public function updateUser($id, $field) {
        $this->db->where('id', $id);
        $this->db->update('users', $field);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function validarExistenciaNumeroParte($numeroparte) {
        $this->db->select('p.idparte, p.numeroparte');
        $this->db->from('parte p');
        $this->db->where('p.numeroparte', $numeroparte);
        $this->db->where('p.activo', 1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function listaClientexNumeroParte($numeroparte) {
        $this->db->select('p.idparte, c.nombre');
        $this->db->from('parte p');
        $this->db->join('cliente  c', 'c.idcliente = p.idcliente');
        $this->db->where('p.numeroparte', $numeroparte);
        $this->db->where('p.activo', 1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function listaModeloxNumeroParte($idparte) {
        $this->db->select('m.idmodelo, m.descripcion');
        $this->db->from('tblmodelo m');
        $this->db->where('m.idparte', $idparte);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function listaRevisionxNumeroParte($idmodelo) {
        $this->db->select('r.idrevision, r.descripcion');
        $this->db->from('tblrevision r');
        $this->db->where('r.idmodelo', $idmodelo);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function listaCantidadxNumeroParte($idrevision) {
        $this->db->select('c.idcantidad, c.cantidad');
        $this->db->from('tblcantidad c');
        $this->db->where('c.idrevision', $idrevision);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

}
