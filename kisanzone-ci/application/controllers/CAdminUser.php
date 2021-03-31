<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CAdminUser Extends CI_Controller{

    // Load the createAdminUser view
    public function index(){
       $this->load->view('manageAdmin/createAdminUser');
    }

    // This method will create new admin
    public function saveAdminUser(){
       $this->load->model('CKzAdminModel');

       // Create array object 
       $formArray = array();

       //  Converting text password to encrypted password
       $strPassword = password_hash($this->input->post('password'),PASSWORD_DEFAULT);
      
       $formArray['username'] = $this->input->post('username');
       $formArray['email'] = $this->input->post('email');
       $formArray['status'] = $this->input->post('status');
       $formArray['password'] = $strPassword;
        
       // Call to create method of model and return response
       $boolResponse = $this->CKzAdminModel->create($formArray);

        // send an credential to admin email if record saved
        // set response 
        if($boolResponse){
            // loading configuration file of email
           $this->load->config('email');
           
           // Set parameters
           $from = $this->config->item('smtp_user');
           $to = $this->input->post('email');
           $subject = $this->input->post('subject');
           $message = '<!DOCTYPE html><html><body><h3>You can access kisanzone admin panel using below credentials</h3><p><strong>Username : </strong>'.$this->input->post('username').'<br><strong>Password : </strong>'.$this->input->post('password').'</p><p><strong>Note </strong>: This mail is confidential. Do not share and forward.</p><p>Regards, <br> Kisanzone</p></body></html>';
   
           $this->email->set_newline("\r\n");
           $this->email->from($from,"Kisanzone");
           $this->email->to($to);
           $this->email->subject('Admin Credentials');
           $this->email->message($message);
        
            // if mail sent to admin mail    
            if ($this->email->send()) {
                $response['status'] = 1;
                $response['msg'] = 'Admin credential has successfully been sent.';
            } else { //if mail not sent to admin mail
                $response['status'] = 1;
                //show_error($this->email->print_debugger());
                $response['msg'] = 'But admin credential not sent due to some issue.';
            } 

        }else{
            $response['status'] = 0;
            $response['msg'] = 'Something went wrong! Please try later!';
        }

       echo json_encode($response);

    }

    // It check Mobile already exist or not
    function emailAlreadyExistOrNot(){
        $this->load->model('CKzAdminModel');

        // Call to emailAlreadyExistOrNot method of model and return response
        $row = $this->CKzAdminModel->emailAlreadyExistOrNot($this->input->post('email'));
        
        // if $row not empty mean mobile number is exist and return response
        if(!empty($row)){
            $response['status']=1;
            echo json_encode($response);
        }else{
            $response['status']=0;
            echo json_encode($response);
        }

    }

    // It check Username already exist or not
    function usernameAlreadyExistOrNot(){
        $this->load->model('CKzAdminModel');

        // Call to userAlreadyExistOrNot method of model and return response
        $row = $this->CKzAdminModel->usernameAlreadyExistOrNot($this->input->post('username'));
        
        // if $row not empty mean mobile number is exist and return response
        if(!empty($row)){
            $response['status']=1;
            echo json_encode($response);
        }else{
            $response['status']=0;
            echo json_encode($response);
        }

    }

}
?>