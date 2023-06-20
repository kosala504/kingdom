<?php

    /*************************************************
    *       Developer  :  kosala504@gmail.com        *
    *        Copyright © 2022 Kosala Hasantha        *
    **************************************************/

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Prices extends CI_Controller {

    public function __Construct() {
        parent::__Construct();
        if(!$this->session->userdata('logged_in')) {
            redirect(base_url());
        }
        $this->load->model('Price_model');

    }

    public function index() {
        $data = array(
            'formTitle' => 'Rates Management',
            'title' => 'Rates Management',
            'prices' => $this->Price_model->get_prices_list(),
        );

        $this->load->view('frame/header_view');
        $this->load->view('price_list',$data);
    }
    
     private function ajax_checking(){
        if (!$this->input->is_ajax_request()) {
            redirect(base_url());
        }
    }
   
    function update_price(){
        $this->ajax_checking();

        $postData = $this->input->post();
        $update = $this->Price_model->update_price($postData);
        if($postData['price_id'] == 2){
            $trans = $this->Price_model->update_price_tea($postData);
            if($trans['status'] == 'success')
            $this->session->set_flashdata('success', 'Rate of '.$postData['price_type'].' have been successfully updated!');
        }
        if($postData['price_id'] == 1){
            $trans = $this->Price_model->update_price_transport($postData);
            if($trans['status'] == 'success')
            $this->session->set_flashdata('success', 'Rate of '.$postData['price_type'].' have been successfully updated!');
        }
        if($update['status'] == 'success')
            $this->session->set_flashdata('success', 'Rate of '.$postData['price_type'].' have been successfully updated!');

        echo json_encode($update);
    }

}

/* End of file */
