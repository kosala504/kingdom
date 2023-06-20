<?php

    /*************************************************
    *       Developer  :  kosala504@gmail.com        *
    *        Copyright © 2022 Kosala Hasantha        *
    **************************************************/

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Suppliers_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function validate_sup_id($postData){
        $this->db->where('sup_id', $postData['sup_id']);
        $this->db->from('suppliers');
        $query=$this->db->get();

        if ($query->num_rows() == 0)
            return true;
        else
            return false;
    }

    function validate_email($postData){
        $this->db->where('email', $postData['email']);
        $this->db->from('suppliers');
        $query=$this->db->get();

        if ($query->result()){
            return true;
        }
        else if ($query->num_rows() == 0){
            return true;
        }
        else{
            return false;
        }
    }

    function validate_nic($postData){
        $this->db->where('nic', $postData['nic']);
        $this->db->from('suppliers');
        $query=$this->db->get();

        if ($query->num_rows() == 0)
            return true;
        else
            return false;
    }

    function get_suppliers_list(){
        $this->db->select('*');
        $this->db->from('suppliers');
        $query=$this->db->get();
        return $query->result();
    }

    function get_supplier_by_id($supID){
        $this->db->select('*');
        $this->db->from('suppliers');
        $this->db->where('sup_id', $supID);
        $query=$this->db->get();
        return $query->result_array();
    }

    function insert_supplier($postData){
        $validate = $this->validate_sup_id($postData);
        $val_email = $this->validate_email($postData);
        $val_nic = $this->validate_nic($postData);

        if($validate AND $val_email AND $val_nic){
            $data = array(
                'sup_id' => $postData['sup_id'],
                'state' => $postData['state'],
                'f_name' => $postData['f_name'],
                'l_name' => $postData['l_name'],
                'nic' => $postData['nic'],
                'address' => $postData['address'],
                'tel' => $postData['tel'],
                'email' => $postData['email'],
                'bank_name' => $postData['bank'],
                'bank_branch' => $postData['branch'],
                'acc_holder' => $postData['holder'],
                'acc_number' => $postData['acc_no'],
            );
            $this->db->insert('suppliers', $data);

            $module = "Supplier Management";
            $activity = "Add new supplier ".$postData['l_name'];
            $this->insert_log($activity, $module);
            return array('status' => 'success', 'message' => '');
        }else if($validate == false){
            return array('status' => 'exist', 'message' => '');
        }else if($val_email == false){
            return array('status' => 'exist_email', 'message' => '');
        }
        else if($val_nic == false){
            return array('status' => 'exist_nic', 'message' => '');
        }
        
    }

    function update_supplier_details($postData){

        $oldData = $this->get_supplier_by_id($postData['sup_id']);

        if($oldData[0]['email'] == $postData['email'])
            $validate = true;
        else
            $validate = $this->validate_email($postData);

        if($oldData[0]['nic'] == $postData['nic'])
            $vali_nic = true;
        else
            $vali_nic = $this->validate_nic($postData);

        if($validate AND $vali_nic){
            $data = array(
                'state' => $postData['state'],
                'f_name' => $postData['f_name'],
                'l_name' => $postData['l_name'],
                'nic' => $postData['nic'],
                'address' => $postData['address'],
                'tel' => $postData['tel'],
                'email' => $postData['email'],
                'bank_name' => $postData['bank'],
                'bank_branch' => $postData['branch'],
                'acc_holder' => $postData['holder'],
                'acc_number' => $postData['acc_no'],
            );
            $this->db->where('sup_id', $postData['sup_id']);
            $this->db->update('suppliers', $data);

            $record = "(".$oldData[0]['f_name']." to ".$postData['f_name'].", ".$oldData[0]['nic']." to ".$postData['nic'].")";

            $module = "Supplier Management";
            $activity = "update supplier ".$oldData[0]['l_name']."`s details ".$record;
            $this->insert_log($activity, $module);
            return array('status' => 'success', 'message' => $record);
        }else if($validate == false){
            return array('status' => 'exist', 'message' => '');
        }else if($vali_nic == false){
            return array('status' => 'exist_nic', 'message' => '');
        }

    }


    function delete_supplier($postData){
        $data = array(
                'l_name' => $postData['l_name'],
                'sup_id' => $postData['sup_id'],
            );
        $this->db->where('sup_id', $postData['sup_id']);
        $this->db->delete('suppliers');

        $module = "Supplier Management";
        $activity = "Delete supplier ".$postData['l_name'];
        $this->insert_log($activity, $module);
        return array('status' => 'success', 'message' => '');

    }
    
    function insert_log($activity, $module){
        $id = $this->session->userdata('user_id');

        $data = array(
            'fk_user_id' => $id,
            'activity' => $activity,
            'module' => $module,
            'created_at' => date('Y\-m\-d\ H:i:s A')
        );
        $this->db->insert('activity_log', $data);
    }

    function send_email($message,$subject,$sendTo){
        require_once APPPATH.'libraries/mailer/class.phpmailer.php';
        require_once APPPATH.'libraries/mailer/class.smtp.php';
        require_once APPPATH.'libraries/mailer/mailer_config.php';
        include APPPATH.'libraries/mailer/template/template.php';
        
        $mail = new PHPMailer(true);
        $mail->IsSMTP();
        try
        {
            $mail->SMTPDebug = 1;  
            $mail->SMTPAuth = true; 
            $mail->SMTPSecure = 'ssl'; 
            $mail->Host = HOST;
            $mail->Port = PORT;  
            $mail->Username = GUSER;  
            $mail->Password = GPWD;     
            $mail->SetFrom(GUSER, 'Administrator');
            $mail->Subject = "DO NOT REPLY - ".$subject;
            $mail->IsHTML(true);   
            $mail->WordWrap = 0;


            $hello = '<h1 style="color:#333;font-family:Helvetica,Arial,sans-serif;font-weight:300;padding:0;margin:10px 0 25px;text-align:center;line-height:1;word-break:normal;font-size:38px;letter-spacing:-1px">Hello, &#9786;</h1>';
            $thanks = "<br><br><i>This is autogenerated email please do not reply.</i><br/><br/>Thanks,<br/>Admin<br/><br/>";

            $body = $hello.$message.$thanks;
            $mail->Body = $header.$body.$footer;
            $mail->AddAddress($sendTo);

            if(!$mail->Send()) {
                $error = 'Mail error: '.$mail->ErrorInfo;
                return array('status' => false, 'message' => $error);
            } else { 
                return array('status' => true, 'message' => '');
            }
        }
        catch (phpmailerException $e)
        {
            $error = 'Mail error: '.$e->errorMessage();
            return array('status' => false, 'message' => $error);
        }
        catch (Exception $e)
        {
            $error = 'Mail error: '.$e->getMessage();
            return array('status' => false, 'message' => $error);
        }
        
    }

}

/* End of file */