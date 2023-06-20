<?php

    /*************************************************
    *       Developer  :  kosala504@gmail.com        *
    *        Copyright © 2022 Kosala Hasantha        *
    **************************************************/

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Print_letter_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
    function get_acc_details(){
        $this->db->select('*');
        $this->db->from('suppliers');
        $this->db->where('price_id','2');
        $query=$this->db->get();
        return $query->result();
    }

    function get_balance($postData){
        $this->db->select('transactions.sup_id,suppliers.state,suppliers.bank_name,suppliers.bank_branch,suppliers.acc_holder,suppliers.acc_number,sum(tea_kg) AS tea_kg,sum(tea_price) as tea,sum(ad_income) AS ad_income,sum(cash_adv) AS cash_adv,sum(welfare) AS welfare,sum(transport) as transport,sum(manure_kg) as man_kg,sum(manure) as man_tot,sum(made_kg) AS made_kg,sum(made_tea) AS made_tea,sum(kok_product) AS kok_p,sum(other_ded) AS other');
        $this->db->from('transactions');
        $this->db->join('suppliers', 'transactions.sup_id = suppliers.sup_id');
        $this->db->where('MONTHNAME(trans_date)',$postData['month']);
        $this->db->where('YEAR(trans_date)',$postData['year']);
        $this->db->where('bank_name',$postData['bank']);
        //$this->db->having('sup_id >','208');
        $this->db->having('sum(tea_kg) >','0');
        $this->db->having('sum((tea_price+ad_income)-(cash_adv+welfare+transport+manure+made_tea+kok_product+other_ded)) >','0');
        $this->db->group_by('suppliers.sup_id');
        $this->db->group_by('suppliers.bank_name');
        $query=$this->db->get();
        return $query->result();
    }

    function get_bank(){
        $this->db->select('bank_name');
        $this->db->from('suppliers');
        //$this->db->where('acc_number!=','0');
        $this->db->group_by('bank_name');
        $query=$this->db->get();
        return $query->result();
    }


}

/* End of file */