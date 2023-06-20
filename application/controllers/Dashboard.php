<?php

    /******************************************
    *   Developer  :  kosala504@gmail.com    *
    *    Copyright © 2022 kosala hasantha    *
    *******************************************/

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Dashboard extends CI_Controller {

    public function __Construct() {
        parent::__Construct();
        if(!$this->session->userdata('logged_in')) {
            redirect(base_url());
        }
        $this->load->model('Dashboard_model');
    }

    public function index() {
        $data = array(
            'tea_supply' => $this->Dashboard_model->get_tea_supply(),
            'tea_income' => $this->Dashboard_model->get_tea_income(),
            'tea_monthly' => $this->Dashboard_model->get_monthly_supply(),
        );

        $this->load->view('frame/header_view');
        $this->load->view('dashboard',$data);
    }


}

/* End of file */
