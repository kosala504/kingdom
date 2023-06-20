<?php

    /*************************************************
    *       Developer  :  kosala504@gmail.com        *
    *        Copyright © 2022 Kosala Hasantha        *
    **************************************************/

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Transactions extends CI_Controller {

    public function __Construct() {
        parent::__Construct();
        if(!$this->session->userdata('logged_in')) {
            redirect(base_url());
        }
        $this->load->model('Transactions_model');
        $this->load->library('csvimport');

    }

    public function index() {
        $data = array(
            'formTitle' => 'Transactions Management',
            'title' => 'Transactions',
            'transactions' => $this->Transactions_model->get_transactions_list(),
            'tea_price' => $this->Transactions_model->get_tea_price(),
            'transport' => $this->Transactions_model->get_transport_price(),
            'suppliers' => $this->Transactions_model->get_suppliers_list(),


        );

        $this->load->view('frame/header_view');
        $this->load->view('transactions_list',$data);
    }
    
     private function ajax_checking(){
        if (!$this->input->is_ajax_request()) {
            redirect(base_url());
        }
    }
   

    public function add_transaction(){
        $this->ajax_checking();
        
        $postData = $this->input->post();
        $insert = $this->Transactions_model->insert_transaction($postData);
        if($insert['status'] == 'success')
            $this->session->set_flashdata('success','Transaction successful!');

        echo json_encode($insert);
    }

    function update_transaction(){
        $this->ajax_checking();

        $postData = $this->input->post();
        $update = $this->Transactions_model->update_transaction($postData);
        if($update['status'] == 'success')
            $this->session->set_flashdata('success', 'Transaction #'.$postData['trans_id'].' have been successfully updated!');

        echo json_encode($update);
    }

    function delete_transaction(){  
        $this->ajax_checking();

        $postData = $this->input->post();
        $delete = $this->Transactions_model->delete_transaction($postData);
        if($delete['status'] == 'success')
            $this->session->set_flashdata('success', 'Transaction #'.$postData['trans_id'].' has been successfully deleted!');

        echo json_encode($delete);
    }

    function import()
    {
        $tea = $this->Transactions_model->get_tea_price();
        $trans = $this->Transactions_model->get_transport_price();
        $t_pr = 0;
        foreach($tea as $row)
        {
            $t_pr =  $row->amount;
        }
        $tran = 0;
        foreach($trans as $row)
        {
            $tran =  $row->amount;
        }
        $file_data = $this->csvimport->get_array($_FILES["csv_file"]["tmp_name"]);

        $tea_kilo = 0;
        foreach($file_data as $row)
        {
            $tea_kilo = $row["tea_kg"];
            $data[] = array(
                'trans_id'    =>  $row["Trans id"],
                'sup_id'      =>  $row["Sup id"],
                'sup_name'    =>  $row["Sup Name"],
                'trans_date'  =>  $row["trans_date"],
                'tea_kg'      =>  $row["tea_kg"],
                'tea_price'   =>  $t_pr*$tea_kilo,
                'ad_income'   =>  $row["ad_income"],
                'cash_adv'    =>  $row["cash_adv"],
                'welfare'     =>  $row["welfare"],
                'transport'   =>  $tran*$tea_kilo,
                'manure_kg'   =>  $row["manure_kg"],
                'manure'      =>  $row["manure"],
                'made_kg'     =>  $row["made_kg"],
                'made_tea'    =>  $row["made_tea"],
                'kok_product' =>  $row["kok_product"],
                'other_ded'   =>  $row["other_ded"]
            );
        }
        $insert_csv = $this->Transactions_model->insert($data);
        if($insert_csv['status'] == 'success')
            $this->session->set_flashdata('success', 'Transactions have been successfully imported!');
        else{
            $this->session->set_flashdata('error', 'Transactions importing failed!');
        }

        echo json_encode($insert_csv);
    }

}

/* End of file */
