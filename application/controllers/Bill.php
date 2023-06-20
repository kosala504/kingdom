<?php

    /******************************************
    *   Developer  :  kosala504@gmail.com    *
    *    Copyright © 2022 kosala hasantha    *
    *******************************************/

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Bill extends CI_Controller {

    public function __Construct() {
        parent::__Construct();
        if(!$this->session->userdata('logged_in')) {
            redirect(base_url());
        }
    }

    public function index() {
        $this->load->view('frame/header_view');
        $this->load->view('bill');
    }


}

/* End of file */
