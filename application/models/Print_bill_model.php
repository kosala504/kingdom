<?php

    /*************************************************
    *       Developer  :  kosala504@gmail.com        *
    *        Copyright © 2022 Kosala Hasantha        *
    **************************************************/

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Print_bill_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
    function get_tea_price(){
        $this->db->select('amount');
        $this->db->from('prices');
        $this->db->where('price_id','2');
        $query=$this->db->get();
        return $query->result();
    }

    function get_bill_details($postData){
        if($postData['part'] == 'part_1'){
            $min_value = '1';
            $max_value = '216';
        }else if($postData['part'] == 'part_2'){
            $min_value = '217';
            $max_value = '500';
        }
        $this->db->select('transactions.sup_id,suppliers.f_name,suppliers.l_name,sum(tea_kg) AS tea_kg,sum(tea_price) as tea,sum(ad_income) AS ad_income,sum(cash_adv) AS cash_adv,sum(welfare) AS welfare,sum(transport) as transport,sum(manure_kg) as man_kg,sum(manure) as man_tot,sum(made_kg) AS made_kg,sum(made_tea) AS made_tea,sum(kok_product) AS kok_p,sum(other_ded) AS other');
        $this->db->from('transactions');
        $this->db->join('suppliers', 'transactions.sup_id = suppliers.sup_id');
        $this->db->where('MONTHNAME(trans_date)',$postData['month']);
        $this->db->where('YEAR(trans_date)',$postData['year']);
        //$this->db->having('sup_id >','217');
        $this->db->where("transactions.sup_id BETWEEN '$min_value' AND '$max_value'");
        $this->db->having('sum(tea_kg) >','0');
        $this->db->group_by('suppliers.sup_id');
        $query=$this->db->get();
        return $query->result();
    }


}

/* End of file */