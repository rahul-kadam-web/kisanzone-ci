<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CCustomers Extends CI_Controller{

    function  __construct(){
        parent::__construct();
        
        // Load cart library
        $this->load->library('cart');
    }
    
    //load login view
    function index(){
        $this->load->view('login');
    }

    //Load the signup view
    public function signup(){
        $this->load->view('signup');
    }

    // It check Mobile Laready exist or not
    function mobileAlreadyExistOrNot(){
        $this->load->model('CCustomersModel');

        // Store the cipher method 
        $ciphering = "AES-128-CTR"; 
  
        // Use OpenSSl Encryption method 
        $iv_length = openssl_cipher_iv_length($ciphering); 
        $options = 0; 
  
        // Non-NULL Initialization Vector for encryption 
        $encryption_iv = '1234567891011121'; 
  
        // Store the encryption key 
        $encryption_key = "Kisanzone";  

        // Encrypted mobile number
        $mobile = openssl_encrypt($this->input->post('mobile'), $ciphering,$encryption_key, $options, $encryption_iv);
        
        $row = $this->CCustomersModel->mobileAlreadyExistOrNot($mobile);
        
        // if $row not empty mean mobile number is exist and return response
        if(!empty($row)){
            $response['status']=1;
            echo json_encode($response);
        }else{
            $response['status']=0;
            echo json_encode($response);
        }
    }

     // save or insert record to customer table
    public function saveCustomer(){
        $this->load->model('CCustomersModel');

        // Store the cipher method 
        $ciphering = "AES-128-CTR"; 
  
        // Use OpenSSl Encryption method 
        $iv_length = openssl_cipher_iv_length($ciphering); 
        $options = 0; 
  
        // Non-NULL Initialization Vector for encryption 
        $encryption_iv = '1234567891011121'; 
  
        // Store the encryption key 
        $encryption_key = "Kisanzone";  

        $formArray=array();
        $formArray['fname']=$this->input->post('fName');
        $formArray['lname']=$this->input->post('lName');
        $formArray['email']=$this->input->post('email');

        // Encrypted mobile number 
        $encryptionMobileNumber = openssl_encrypt($this->input->post('mobile'), $ciphering,$encryption_key, $options, $encryption_iv);
        $formArray['mobile']= $encryptionMobileNumber;
        $formArray['password']=password_hash($this->input->post('password'),PASSWORD_DEFAULT);
        $formArray['pin']=$this->input->post('pin');
        $formArray['verified_otp']=$this->input->post('verifiedOtp');
        $formArray['state']=$this->input->post('state');
        $formArray['city']=$this->input->post('city');
        $formArray['address']=$this->input->post('address');
        $this->CCustomersModel->create($formArray);

        // Success response through session  
        $this->session->set_flashdata('success', 'Your account registration has been successful. Please login to your account.');

        // Response to show registration completed
        $response['status']=1;
        echo json_encode($response);
    }

    // Send otp to verify mobile number
    function sendOtp(){
        $mobile = $this->input->post('mobile');
        $otp = $this->input->post('otp');

        //  SMS details
        $fields = array(
            "sender_id" => "FSTSMS",
            "message" => "#####Kisanzone##### Your verification code is $otp",
            "language" => "english",
            "route" => "p",
            "numbers" => "$mobile",
            "flash" => "1"
        );
        
        // It will initialize a new session and return a cURL handle
        $curl = curl_init();
        
        // It is useful for setting a large number of cURL options without repetitively calling curl_setopt()
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://www.fast2sms.com/dev/bulk",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => json_encode($fields),
          CURLOPT_HTTPHEADER => array(
            "authorization: 8ZMI9Vgyd6qCuRnPbBhrslw7T3cxjezStOJipQam1XEvfY04FH1orTVZgJPh0xmQYwWn45adFu3SbCBA",
            "accept: */*",
            "cache-control: no-cache",
            "content-type: application/json"
          ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        // Closes a cURL session and frees all resources
        curl_close($curl);
        
        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }
    }

    function login(){
        $this->load->model('CCustomersModel');

        // Store the cipher method 
        $ciphering = "AES-128-CTR"; 
  
        // Use OpenSSl Encryption method 
        $iv_length = openssl_cipher_iv_length($ciphering); 
        $options = 0; 
  
        // Non-NULL Initialization Vector for encryption 
        $encryption_iv = '1234567891011121'; 
  
        // Store the encryption key 
        $encryption_key = "Kisanzone"; 
        
        $formArray=array();

        // Use openssl_encrypt() function to encrypt the mobile number because encrypted mobile number was stored in customers table 
        $formArray['mobileNumber'] = openssl_encrypt($this->input->post('mobile'), $ciphering,$encryption_key, $options, $encryption_iv);
        $formArray['password'] = $this->input->post('password');

        $row = $this->CCustomersModel->fetchLoginRow($formArray);

        // It check Is $row empty  aand return response to show login status
        if(empty($row)){
            $response['status'] = 0; 
            $response['msg'] = 'Login failed!';
            echo json_encode($response);
        }else{
            //declaring session  
            $this->session->set_userdata(array('user'=>$row['fname'],
            'cus_id' => $row['cus_id']));

            $response['status']= 1;
            $response['msg'] = 'Login successful!';
            echo json_encode($response);  
        }
        
    }

    // Load customerProfile view
    function customerProfile(){
        // the user is not logged in, redirected to login !
        if (empty($this->session->userdata('cus_id')))
        {
            redirect(base_url().'CCustomers/index');
        }

        $this->load->model('CCustomersModel');

        // Store the cipher method 
        $ciphering = "AES-128-CTR"; 
  
        // Use OpenSSl Encryption method 
        $iv_length = openssl_cipher_iv_length($ciphering); 
        $options = 0; 
          
        // Non-NULL Initialization Vector for encryption 
        $encryption_iv = '1234567891011121'; 
          
        // Store the encryption key 
        $encryption_key = "Kisanzone";

        // Getting customerID
        $intCustomerId = $this->session->userdata('cus_id');

        $row = $this->CCustomersModel->fetchCustomer($intCustomerId);
        
        // Decrypted mobile number
        $mobile = openssl_decrypt($row['mobile'], $ciphering,$encryption_key, $options, $encryption_iv);
        $row['mobile'] = $mobile;

        $data = array();

        $data['row'] = $row;
        $this->load->view('customerProfile', $data);
    }

    // It will update logged in customer profile
    function updateCustomer(){
        // the user is not logged in, redirected to login !
        if (empty($this->session->userdata('cus_id')))
        {
            redirect(base_url().'CCustomers/index');
        }

        $this->load->model('CCustomersModel');

        // Store the cipher method 
        $ciphering = "AES-128-CTR"; 
  
        // Use OpenSSl Encryption method 
        $iv_length = openssl_cipher_iv_length($ciphering); 
        $options = 0; 
  
        // Non-NULL Initialization Vector for encryption 
        $encryption_iv = '1234567891011121'; 
  
        // Store the encryption key 
        $encryption_key = "Kisanzone";  

        date_default_timezone_set("Asia/Kolkata");

        $formArray=array();

        $intCustomerId = $this->input->post('cus_id');
        $formArray['fname']=$this->input->post('fName');
        $formArray['lname']=$this->input->post('lName');
        $formArray['email']=$this->input->post('email');

        // Use openssl_encrypt() function to encrypt the data 
        $encryptionMobileNumber = openssl_encrypt($this->input->post('mobile'), $ciphering,$encryption_key, $options, $encryption_iv);
        
        $formArray['mobile']= $encryptionMobileNumber;
        $formArray['pin']=$this->input->post('pin');
        $formArray['verified_otp']=$this->input->post('verifiedOtp');
        $formArray['state']=$this->input->post('state');
        $formArray['city']=$this->input->post('city');
        $formArray['address']=$this->input->post('address');
        $formArray['modified_date'] = date("Y-m-d h:i:sa");
        
        $this->CCustomersModel->update($intCustomerId,$formArray);

        // Response to show profile update status
        $response['status']=1;
        echo json_encode($response);
    }

    // It will return logged in user's ordered details
    function getOrders(){
        // the user is not logged in, redirected to login !
        if (empty($this->session->userdata('cus_id')))
        {
            redirect(base_url().'CCustomers/index');
        }

        $this->load->model('CCustomersModel');

        $data = array();
        
        $data['orderRows'] = $this->CCustomersModel->fetchOrders($this->session->userdata('cus_id'));
        //print_r($orderRows);
        $this->load->view('orders', $data);
    }

    
    // Destroy session
    function logout(){
        $this->session->sess_destroy();
        redirect(base_url().'CHome/index');
    }
    
}
?>