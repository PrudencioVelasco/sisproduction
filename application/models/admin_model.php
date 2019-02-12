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
     
        $query = $this->db->query(' select p.numeroparte, COALESCE(sum(dp.pallet),0) totalpallet, COALESCE(sum(dp.cantidad),0) totalcajas, DATE_FORMAT(dp.fecharegistro, "%b") mes
                                    from parte p, detalleparte dp
                                    where p.idparte = dp.idparte
                                    and dp.idestatus = 8
                                    and  cast(dp.fecharegistro as date) >= date_add(NOW(), INTERVAL -6 MONTH) 
                                    GROUP BY month(dp.fecharegistro), p.idparte');
        return $query->result();
    }
       public function produccionTotal() {
     
        $query = $this->db->query('select COALESCE(sum(dp.pallet),0) totalpallet, COALESCE(sum(dp.cantidad),0) totalcajas, DATE_FORMAT(dp.fecharegistro, "%b") mes
from parte p, detalleparte dp
where p.idparte = dp.idparte
and dp.idestatus = 8
and  cast(dp.fecharegistro as date) >= date_add(NOW(), INTERVAL -6 MONTH) 
GROUP BY month(dp.fecharegistro)');
        return $query->result();
    }
    
}
