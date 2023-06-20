<?php

    /*************************************************
    *       Developer  :  kosala504@gmail.com        *
    *        Copyright © 2022 Kosala Hasantha        *
    **************************************************/

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Price_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }


    function get_prices_list(){
        $this->db->select('*');
        $this->db->from('prices');
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

    function get_tea_kg($amount){
        $this->db->select('tea_kg');
        $this->db->from('transactions');
        $query=$this->db->get();
        if($query->num_rows()>0){ 
            $total = 0;
            $result = $query->result();
            foreach($result as $row) {
                $total = $row->tea_kg*$amount;
                return $total;
            } 
            
        }
    }

    function update_price($postData){

        $date_fixed = date(DATE_ATOM);
        $oldData = $this->get_price_by_id($postData['price_id']);

            $data = array(
                'amount' => $postData['amount'],
                'date_fixed' => $date_fixed,
            );
            $this->db->where('price_id', $postData['price_id']);
            $this->db->update('prices', $data);

            $record = "(".$oldData[0]['amount']." to ".$postData['amount'].")";

            $module = "Price Management";
            $activity = "update the rate of ".$oldData[0]['price_type']." ".$record;
            $this->insert_log($activity, $module);
            return array('status' => 'success', 'message' => $record);
        

    }


    function update_price_tea($postData){
        $month=$postData['month'];
        $year=$postData['year'];
        $amt = $postData['amount'];

        $this->db->query("UPDATE `transactions` SET `tea_price` = tea_kg*$amt WHERE MONTHNAME(trans_date)='$month' && YEAR(trans_date)='$year'");

        return array('status' => 'success', 'message' => 'success');
    
    }

    function update_price_transport($postData){
        $month=$postData['month'];
        $year=$postData['year'];
        $amt = $postData['amount'];

        $this->db->query("UPDATE `transactions` SET `transport` = tea_kg*$amt WHERE MONTHNAME(trans_date)='$month' && YEAR(trans_date)='$year'");

        return array('status' => 'success', 'message' => 'success');
        
    }

    function insert_log($activity, $module){
        $id = $this->session->userdata('user_id');

        $data = array(
            'fk_user_id' => $id,
            'activity' => $activity,
            'module' => $module,
            'created_at' => date('Y\-m\-d\ H:i:s A')
        );
        $this->db->insert('activity_log', $data);
    }

}

/* End of file */