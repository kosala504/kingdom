<?php

    /*************************************************
    *       Developer  :  kosala504@gmail.com        *
    *        Copyright © 2022 Kosala Hasantha        *
    **************************************************/

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Daily_tea_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }


    function get_daily_tea_list(){
        $this->db->select('transactions.trans_date,sum(transactions.tea_kg) as tea_kg,factory_tea.id,factory_tea.date,factory_tea.no_of_kilo');
        $this->db->from('transactions');
        $this->db->join('factory_tea','transactions.trans_date = factory_tea.date','inner');
        $this->db->where('MONTHNAME(trans_date)','April');
        $this->db->group_by('trans_date');
        $query=$this->db->get();
        return $query->result();
    }

    function get_price_by_id($priceID){
        $this->db->select('*');
        $this->db->from('factory_tea');
        $this->db->where('id', $priceID);
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

    function update_amount($postData){

        $oldData = $this->get_price_by_id($postData['id']);

            $data = array(
                'no_of_kilo' => $postData['amount'],
                'date' => $postData['date'],
            );
            $this->db->where('id', $postData['id']);
            $this->db->update('factory_tea', $data);

            $record = "(".$oldData[0]['no_of_kilo']." to ".$postData['amount'].")";

            $module = "Factory Tea Management";
            $activity = "Update the amount of ".$oldData[0]['no_of_kilo']." ".$record;
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

    function insert_amount($postData){
        $data = array(
            'date'       => $postData['date'],
            'no_of_kilo' => $postData['amount'],
        );
        $this->db->insert('factory_tea', $data);

        $module = "Factory Tea Management";
        $activity = "Add factory tea amount";
        $this->insert_log($activity, $module);
        return array('status' => 'success', 'message' => '');
        
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