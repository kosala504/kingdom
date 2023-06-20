<?php

    /*************************************************
    *       Developer  :  kosala504@gmail.com        *
    *        Copyright © 2022 Kosala Hasantha        *
    **************************************************/

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Dashboard_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_tea_supply(){
        $month = date('m');
        $this->db->select_sum('tea_kg');
        $this->db->from('transactions');
        $this->db->where('MONTH(trans_date)', $month);
        $query=$this->db->get();
        return $query->result();
    }

    function get_tea_income(){
        $month = date('m');
        $this->db->select_sum('tea_price');
        $this->db->from('transactions');
        $this->db->where('MONTH(trans_date)', $month);
        $query=$this->db->get();
        return $query->result();
    }

    function get_monthly_supply(){
        $this->db->select('sum(tea_kg) AS tea_kg,MONTHNAME(trans_date) AS month');
        $this->db->from('transactions');
        $this->db->group_by('MONTHNAME(trans_date)');
        $this->db->order_by('trans_date');
        $query=$this->db->get();
        return $query->result();
    }

    function get_price_by_id($priceID){
        $this->db->select('*');
        $this->db->from('prices');
        $this->db->where('price_id', $priceID);
        $query=$this->db->get();
        return $query->result_array();
    }


}

/* End of file */