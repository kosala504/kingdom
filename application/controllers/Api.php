<?php
	/******************************************
    *   Developer  :  kosala504@gmail.com    *
    *    Copyright © 2022 kosala hasantha    *
    *******************************************/

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Api extends CI_Controller {
	
	public function testApi(){
		$query = $this->db->query('select user_id,email,password,name,role from user where status="1"');
		echo json_encode($query->result());
	}
}
?>