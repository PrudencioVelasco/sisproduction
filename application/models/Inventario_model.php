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
        $query = $this->db->query('SELECT c.nombre,
                                           p.numeroparte,
                                           (SELECT COALESCE(Sum(dp2.pallet), 0)
                                            FROM   detalleparte dp2
                                            WHERE  dp2.idparte = p.idparte)     totalpallet,
                                           (SELECT COALESCE(Sum(dp3.cantidad * dp3.pallet), 0)
                                            FROM   detalleparte dp3
                                            WHERE  dp3.idparte = p.idparte)     totalcajas,
                                           (SELECT COALESCE(Sum(os.pallet), 0)
                                            FROM   detalleparte dp4,
                                                   ordensalida os
                                            WHERE  dp4.iddetalleparte = os.iddetalleparte
                                                   AND dp4.idparte = p.idparte) AS totalpalletsalida,
                                           (SELECT COALESCE(Sum(CASE
                                                                  WHEN os.pallet = 0 THEN os.caja
                                                                  WHEN os.pallet > 0 THEN os.pallet * os.caja
                                                                  ELSE 0
                                                                END), 0)
                                            FROM   detalleparte dp4,
                                                   ordensalida os
                                            WHERE  dp4.iddetalleparte = os.iddetalleparte
                                                   AND dp4.idparte = p.idparte) AS totalcajassalida
                                    FROM   parte p,
                                           detalleparte dp,
                                           cliente c
                                    WHERE  p.idparte = dp.idparte
                                           AND p.idcliente = c.idcliente
                                           AND dp.idestatus = 8
                                    GROUP  BY p.idparte');
        return $query->result();
    }

}
