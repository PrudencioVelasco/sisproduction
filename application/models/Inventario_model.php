<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Inventario_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function __destruct() {
        $this->db->close();
    }

    public function showAll() {
        $query = $this->db->query('select c.nombre, p.numeroparte,
                                    (select COALESCE(sum(dp2.pallet),0) from detalleparte dp2 where dp2.idparte=p.idparte) totalpallet,
                                    (select COALESCE(sum(dp3.cantidad),0) from detalleparte dp3 where dp3.idparte=p.idparte) totalcajas,
                                    (select COALESCE(sum(os.pallet),0) from detalleparte dp4, ordensalida os
                                    where dp4.iddetalleparte = os.iddetalleparte and dp4.idparte = p.idparte) as totalpalletsalida,
                                    (select COALESCE(sum(os.caja),0) from detalleparte dp4, ordensalida os
                                    where dp4.iddetalleparte = os.iddetalleparte and dp4.idparte = p.idparte) as totalcajassalida
                                    from parte p, detalleparte dp, cliente c
                                    where p.idparte=dp.idparte
                                    and p.idcliente = c.idcliente
                                    and dp.idestatus = 8
                                    group by p.idparte');
        return $query->result();
    }

}
