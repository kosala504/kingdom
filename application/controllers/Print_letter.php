<?php

    /******************************************
    *   Developer  :  kosala504@gmail.com    *
    *    Copyright © 2022 kosala hasantha    *
    *******************************************/

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Print_letter extends CI_Controller {

    public function __Construct() {
        parent::__Construct();
        if(!$this->session->userdata('logged_in')) {
            redirect(base_url());
        }
        $this->load->model('Print_letter_model');
    }

    public function index() {
        $postData = $this->input->post();
        $data['detail'] = $this->Print_letter_model->get_balance($postData);
        $data['banks'] = $this->Print_letter_model->get_bank();
        $data['let_date'] = $postData['billing_date'];
        $data['let_month'] = $postData['month'];

        if($data['banks'] = "Cash") {
            $this->load->view('print_cash_letter',$data);
        }
        else{
            $this->load->view('print_letter',$data);
        }
        
    }

    private function ajax_checking(){
        if (!$this->input->is_ajax_request()) {
            redirect(base_url());
        }
    }

}

/* End of file */
