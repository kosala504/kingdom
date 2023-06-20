<?php

    /*************************************************
    *       Developer  :  kosala504@gmail.com        *
    *        Copyright © 2022 Kosala Hasantha        *
    **************************************************/

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Daily_tea extends CI_Controller {

    public function __Construct() {
        parent::__Construct();
        if(!$this->session->userdata('logged_in')) {
            redirect(base_url());
        }
        $this->load->model('Daily_tea_model');

    }

    public function index() {
        $data = array(
            'formTitle' => 'Daily Tea Supply Total Comparisan',
            'title' => 'Daily Tea Supply Total Comparisan',
            'daily_kg' => $this->Daily_tea_model->get_daily_tea_list(),
        );

        $this->load->view('frame/header_view');
        $this->load->view('daily_tea_list',$data);
    }
    
     private function ajax_checking(){
        if (!$this->input->is_ajax_request()) {
            redirect(base_url());
        }
    }
   
    function add_amount(){
        $this->ajax_checking();
        
        $postData = $this->input->post();
        $insert = $this->Daily_tea_model->insert_amount($postData);
        if($insert['status'] == 'success')
            $this->session->set_flashdata('success', 'Tea amount has been successfully added!');

        echo json_encode($insert);
    }

    function update_amount(){
        $this->ajax_checking();

        $postData = $this->input->post();
        $update = $this->Daily_tea_model->update_amount($postData);
        if($update['status'] == 'success')
            $this->session->set_flashdata('success', 'Amount successfully updated!');

        echo json_encode($update);
    }

}

/* End of file */
