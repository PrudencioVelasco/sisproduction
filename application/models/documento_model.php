<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Documento_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function __destruct() {
        $this->db->close();
    }

    public function showAllDocumentos() {
        $this->db->select('d.identificador,u.name,DATE_FORMAT(d.fecharegistro, "%d/%m/%Y") as fecha, SUM(CASE
             WHEN d.subido = 1 THEN 1
             ELSE 0
           END) AS subido, SUM(CASE
             WHEN d.subido = 0 THEN 1
             ELSE 0
           END) AS nosubido');
        $this->db->from('tbldocumento d');
        $this->db->join('users u', 'u.id = d.idusuario');
        $this->db->group_by(array("d.identificador", "d.idusuario", 'DATE(d.fecharegistro)'));
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function showAllDocumentosId($id) {
        $this->db->select("d.*,
    (SELECT
            CASE
                    WHEN COUNT(*) > 0 THEN 'Okey'
                    ELSE 'No existe el cliente.'
                END
        FROM
            cliente c
        WHERE
            c.idcliente = d.cliente) AS existenciacliente,
    (SELECT
            CASE
                    WHEN COUNT(*) > 0 THEN 'Okey'
                    ELSE 'No existe la Locación'
                END
        FROM
            posicionbodega pb
        WHERE
            pb.nombreposicion = d.locacion) AS existencialocacion,
    (SELECT
            CASE
                    WHEN COUNT(*) > 0 THEN 'Okey'
                    ELSE 'No existe la Categoria.'
                END
        FROM
            tblcategoria ca
        WHERE
            ca.idcategoria = d.categoria) AS existencategoria,
    (SELECT
            CASE
                    WHEN
                        COUNT(p.idparte) > 0
                            && COUNT(cat.idcategoria) > 0
                    THEN
                        'Okey'
                    ELSE 'Categoria no relacionada con el N° Parte.'
                END
        FROM
            parte p,
            tblcategoria cat
        WHERE
            p.idcategoria = cat.idcategoria
                AND p.numeroparte = d.numeroparte) AS existennumeroparte,
    (SELECT
            CASE
                    WHEN
                        COUNT(p.idparte) > 0
                            && COUNT(cli.idcliente) > 0
                    THEN
                        'Okey'
                    ELSE 'N° Parte no tiene relacion con Cliente'
                END
        FROM
            parte p,
            cliente cli
        WHERE
            p.idcliente = cli.idcliente
                AND p.numeroparte = d.numeroparte) AS existennumeropartecliente,
    (SELECT
            CASE
                    WHEN COUNT(modelo2.descripcion) > 0 THEN 'Okey'
                    ELSE 'No existe en modelo'
                END
        FROM
            parte p2,
            tblmodelo modelo2
        WHERE
            p2.idparte = modelo2.idparte
                AND TRIM(p2.numeroparte) = TRIM(d.numeroparte)
                AND TRIM(modelo2.descripcion) = TRIM(d.modelo)) numeropartemodelo,
    (SELECT
            CASE
                    WHEN COUNT(r2.descripcion) > 0 THEN 'Okey'
                    ELSE 'No existe la revision'
                END
        FROM
            parte p2,
            tblmodelo modelo2,
            tblrevision r2
        WHERE p2.idparte = modelo2.idparte
        AND modelo2.idmodelo = r2.idmodelo
        AND TRIM(p2.numeroparte) = TRIM(d.numeroparte)
        AND TRIM(modelo2.descripcion) = TRIM(d.modelo)
        AND TRIM(r2.descripcion) = TRIM(d.revision)) modelorevision
 ");
        $this->db->from('tbldocumento d');
        $this->db->where('d.identificador', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function validarIdentificador($id) {
        $this->db->select('d.*');
        $this->db->from('tbldocumento d');
        $this->db->where('d.identificador', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function validar_existencia_numeroparte($numeroparte) {
        $this->db->select('p.*');
        $this->db->from('parte p');
        $this->db->where('trim(p.numeroparte)', $numeroparte);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->first_row();
        } else {
            return false;
        }
    }

    public function validar_numeroparte_modelo($idparte, $modelo) {
        $this->db->select('m.*');
        $this->db->from('parte p');
        $this->db->join('tblmodelo m', 'p.idparte = m.idparte');
        $this->db->where('p.idparte', $idparte);
        $this->db->where('trim(m.descripcion)', $modelo);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->first_row();
        } else {
            return false;
        }
    }

    public function validar_modelo_revision($idmodelo, $revision) {
        $this->db->select('r.*');
        $this->db->from('tblmodelo m');
        $this->db->join('tblrevision r', 'm.idmodelo = r.idmodelo');
        $this->db->where('m.idmodelo', $idmodelo);
        $this->db->where('trim(r.descripcion)', $revision);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->first_row();
        } else {
            return false;
        }
    }

    public function validar_revision_cantidad($idrevision, $cantidad) {
        $this->db->select('c.*');
        $this->db->from('tblcantidad c');
        $this->db->where('c.idrevision', $idrevision);
        $this->db->where('trim(c.cantidad)', $cantidad);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->first_row();
        } else {
            return false;
        }
    }
    public function seleccion_locacion($locacion) {
        $this->db->select('pb.*');
        $this->db->from('posicionbodega pb');
        $this->db->where('pb.nombreposicion', $locacion);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->first_row();
        } else {
            return false;
        }
    }

    public function updateDocumento($id, $data) {
        $this->db->where('iddocumento', $id);
        $this->db->update('tbldocumento', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function detalleDocumento($id) {
        $this->db->select('d.*');
        $this->db->from('tbldocumento d');
        $this->db->where('d.iddocumento', $id);
        $query = $this->db->get();
        return $query->first_row();
    }

    // Agregar informacion a la tabla detalle status(Historial)
    public function insert($data) {
        return $this->db->insert('tbldocumento', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function addEntrada($data) {
        return $this->db->insert('tbllitho', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteregistro($id) {
        $this->db->where('iddocumento', $id);
        $this->db->delete('tbldocumento');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function deleteregistrosall($identificador) {
        $this->db->where('identificador', $identificador);
        $this->db->delete('tbldocumento');
        if ($this->db->affected_rows() > 0) {
            return true;
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
     public function addRevision($data)
    {
        $this->db->insert('tblrevision', $data);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }
     public function addModelo($data)
    {
        $this->db->insert('tblmodelo', $data);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }
     public function addParte($data)
    {
        $this->db->insert('parte', $data);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }
    public function addPartePosicionBodega($data)
    {
        $this->db->insert('parteposicionbodega', $data);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }

}
