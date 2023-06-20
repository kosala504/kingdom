<?php

    /*************************************************
    *       Developer  :  kosala504@gmail.com        *
    *        Copyright © 2022 Kosala Hasantha        *
    **************************************************/

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Suppliers extends CI_Controller {

    public function __Construct() {
        parent::__Construct();
        if(!$this->session->userdata('logged_in')) {
            redirect(base_url());
        }
        $this->load->model('Suppliers_model');
        $this->load->library('csvimport');

    }

    public function index() {
        $data = array(
            'formTitle' => 'Supplier Management',
            'title' => 'Supplier Management',
            'suppliers' => $this->Suppliers_model->get_suppliers_list(),
        );

        $this->load->view('frame/header_view');
        $this->load->view('suppliers_list',$data);
    }
    
     private function ajax_checking(){
        if (!$this->input->is_ajax_request()) {
            redirect(base_url());
        }
    }
   

    public function add_supplier(){
        $this->ajax_checking();
        
        $postData = $this->input->post();
        $insert = $this->Suppliers_model->insert_supplier($postData);
        if($insert['status'] == 'success')
            $this->session->set_flashdata('success', 'Supplier '.$postData['l_name'].' has been successfully created!');

        echo json_encode($insert);
    }

    function update_supplier_details(){
        $this->ajax_checking();

        $postData = $this->input->post();
        $update = $this->Suppliers_model->update_supplier_details($postData);
        if($update['status'] == 'success')
            $this->session->set_flashdata('success', 'Supplier '.$postData['l_name'].'`s details have been successfully updated!');

        echo json_encode($update);
    }

    function delete_supplier(){  
        $this->ajax_checking();

        $postData = $this->input->post();
        $delete = $this->Suppliers_model->delete_supplier($postData);
        if($delete['status'] == 'success')
            $this->session->set_flashdata('success', 'Supplier '.$postData['l_name'].' has been successfully deleted!');

        echo json_encode($delete);
    }

}

/* End of file */
