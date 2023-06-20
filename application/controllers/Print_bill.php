<?php

    /******************************************
    *   Developer  :  kosala504@gmail.com    *
    *    Copyright © 2022 kosala hasantha    *
    *******************************************/

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Print_bill extends CI_Controller {

    public function __Construct() {
        parent::__Construct();
        if(!$this->session->userdata('logged_in')) {
            redirect(base_url());
        }
        $this->load->model('Print_bill_model');
    }

    public function index() {

        $postData = $this->input->post();
        $data['detail'] = $this->Print_bill_model->get_bill_details($postData);
        $data['tea_price'] = $this->Print_bill_model->get_tea_price();
        $data['bill_date'] = $postData['billing_date'];
        $this->load->view('print_bill',$data);
        
    }

    private function ajax_checking(){
        if (!$this->input->is_ajax_request()) {
            redirect(base_url());
        }
    }

}

/* End of file */
