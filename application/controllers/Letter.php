<?php

    /******************************************
    *   Developer  :  kosala504@gmail.com    *
    *    Copyright © 2022 kosala hasantha    *
    *******************************************/

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Letter extends CI_Controller {

    public function __Construct() {
        parent::__Construct();
        if(!$this->session->userdata('logged_in')) {
            redirect(base_url());
        }
        $this->load->model('Print_letter_model');
    }

    public function index() {
        $this->load->view('frame/header_view');
        $data['banks'] = $this->Print_letter_model->get_bank();
        $this->load->view('letter',$data);
    }


}

/* End of file */
