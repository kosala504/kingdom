<?php

    /*************************************************
    *       Developer  :  kosala504@gmail.com        *
    *        Copyright © 2022 Kosala Hasantha        *
    **************************************************/

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Transactions_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_suppliers_list(){
        $this->db->select('*');
        $this->db->from('suppliers');
        $query=$this->db->get();
        return $query->result();
    }

    function get_tea_price(){
        $this->db->select('amount');
        $this->db->from('prices');
        $this->db->where('price_id',2);
        $query=$this->db->get();
        return $query->result();
    }

    function get_transport_price(){
        $this->db->select('amount');
        $this->db->from('prices');
        $this->db->where('price_id',1);
        $query=$this->db->get();
        return $query->result();
    }

    function get_transactions_list(){
        $this->db->select('*');
        $this->db->from('transactions');
        $this->db->order_by("trans_id","DESC");
        //$this->db->limit("100");
        $query=$this->db->get();
        return $query->result();
    }

    function get_transaction_by_id($transID){
        $this->db->select('*');
        $this->db->from('transactions');
        $this->db->where('trans_id', $transID);
        $query=$this->db->get();
        return $query->result_array();
    }

    function get_supplier_by_id($supID){
        $this->db->select('*');
        $this->db->from('suppliers');
        $this->db->where('sup_id', $supID);
        $query=$this->db->get();
        return $query->result_array();
    }

    function insert_transaction($postData){

        $sup_name = $this->get_supplier_by_id($postData['sup_id']);
        $data = array(
            'sup_id' => $postData['sup_id'],
            'sup_name' => $sup_name[0]['l_name'],
            'trans_date' => $postData['trans_date'],
            'tea_kg' => $postData['t_qty'],
            'tea_price' => $postData['t_tot'],
            'ad_income' => $postData['a_tot'],
            'cash_adv' => $postData['c_tot'],
            'welfare' => $postData['w_tot'],
            'transport' => $postData['tr_tot'],
            'manure_kg' => $postData['man_qty'],
            'manure' => $postData['mn_tot'],
            'made_kg' => $postData['mt_qty'],
            'made_tea' => $postData['mdt_tot'],
            'kok_product' => $postData['k_tot'],
            'other_ded' => $postData['o_tot'],
        );
        $this->db->insert('transactions', $data);

        $module = "Transaction Management";
        $activity = "Transaction done for supplier ".$data['sup_name'];
        $this->insert_log($activity, $module);
        return array('status' => 'success', 'message' => '');
        
    }

    function update_transaction($postData){

        $oldData = $this->get_transaction_by_id($postData['trans_id']);
        $sup_name = $this->get_supplier_by_id($postData['sup_id']);

            $data = array(
                'sup_id' => $postData['sup_id'],
                'sup_name' => $sup_name[0]['l_name'],
                'trans_date' => $postData['trans_date'],
                'tea_kg' => $postData['t_qty'],
                'tea_price' => $postData['t_tot'],
                'ad_income' => $postData['a_tot'],
                'cash_adv' => $postData['c_tot'],
                'welfare' => $postData['w_tot'],
                'transport' => $postData['tr_tot'],
                'manure_kg' => $postData['man_qty'],
                'manure' => $postData['mn_tot'],
                'made_kg' => $postData['mt_qty'],
                'made_tea' => $postData['mdt_tot'],
                'kok_product' => $postData['k_tot'],
                'other_ded' => $postData['o_tot'],
            );
            $this->db->where('trans_id', $postData['trans_id']);
            $this->db->update('transactions', $data);

            $record = "(Transaction id #".$oldData[0]['trans_id'].")";

            $module = "Transaction Management";
            $activity = "update transaction ".$oldData[0]['trans_id']." ".$record;
            $this->insert_log($activity, $module);
            return array('status' => 'success', 'message' => $record);

    }

    function delete_transaction($postData){
        $data = array(
                'trans_id' => $postData['trans_id'],
            );
        $this->db->where('trans_id', $postData['trans_id']);
        $this->db->delete('transactions');

        $module = "Transaction Management";
        $activity = "Delete transaction #".$postData['trans_id'];
        $this->insert_log($activity, $module);
        return array('status' => 'success', 'message' => '');

    }

    function insert($data)
    {
        $this->db->insert_batch('transactions', $data);
        $module = "Transaction Management";
        $activity = "Import transactions from app";
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