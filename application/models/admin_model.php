<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
    public function __destruct()
    {
        $this->db->close();
    }
     public function produccionDetalla() {
     
        $query = $this->db->query('SELECT p.numeroparte,
                                   Coalesce(Sum(dp.pallet), 0) totalpallet,
                                   Coalesce(Sum(dp.pallet * dp.cantidad), 0) totalcajas,
                                   Date_format(dp.fecharegistro, "%b") mes
                            FROM   parte p,
                                   detalleparte dp
                            WHERE  p.idparte = dp.idparte
                                   AND dp.idestatus = 8
                                   AND Cast(dp.fecharegistro AS date) >= Date_add(Now(), INTERVAL -6 month)
                            GROUP  BY Month(dp.fecharegistro),
                                      p.idparte ');
        return $query->result();
    }
       public function produccionTotal() {
     
        $query = $this->db->query('SELECT Coalesce(Sum(dp.pallet), 0)         totalpallet,
                                           Coalesce(Sum(dp.pallet * dp.cantidad), 0)       totalcajas,
                                           Date_format(dp.fecharegistro, "%b") mes
                                    FROM   parte p,
                                           detalleparte dp
                                    WHERE  p.idparte = dp.idparte
                                           AND dp.idestatus = 8
                                           AND Cast(dp.fecharegistro AS date) >= Date_add(Now(), INTERVAL -6 month)
                                    GROUP  BY Month(dp.fecharegistro)  ');
        return $query->result();
    }
    
}
