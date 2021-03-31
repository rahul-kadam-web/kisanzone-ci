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
        $this->load->model('CKzCustomersModel');

        // Load the configuration file of mobile for encryption and decryption
        $this->load->config('mobile');

        // Encrypted mobile number
        $mobile = openssl_encrypt($this->input->post('mobile'), $this->config->item('ciphering'),$this->config->item('encryption_key'),$this->config->item('options'), $this->config->item('encryption_iv'));
        
        $row = $this->CKzCustomersModel->mobileAlreadyExistOrNot($mobile);
        
        // if $row not empty mean mobile number is exist and return response
        if(!empty($row)){
            $response['status']=1;
            echo json_encode($response);
        }else{
            $response['status']=0;
            echo json_encode($response);
        }
    }

    
     // Save or insert record to customer table
    public function saveCustomer(){
        $this->load->model('CKzCustomersModel');

        // loading configuration file of mobile for encryption and decryption
        $this->load->config('mobile');  

        // Create array object
        $formArray=array();

        $formArray['fname']=$this->input->post('fName');
        $formArray['lname']=$this->input->post('lName');
        $formArray['email']=$this->input->post('email');

        // Encrypted mobile number
        $encryptionMobileNumber = openssl_encrypt($this->input->post('mobile'), $this->config->item('ciphering'),$this->config->item('encryption_key'),$this->config->item('options'), $this->config->item('encryption_iv'));
       
        $formArray['mobile']= $encryptionMobileNumber;
        $formArray['password']=password_hash($this->input->post('password'),PASSWORD_DEFAULT);
        $formArray['pin']=$this->input->post('pin');
        $formArray['verified_otp']=$this->input->post('verifiedOtp');
        $formArray['state']=$this->input->post('state');
        $formArray['city']=$this->input->post('city');
        $formArray['address']=$this->input->post('address');
        $this->CKzCustomersModel->create($formArray);

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
        
        // Return response
        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }
    }

    // It's check authentication of customer
    function login(){
        $this->load->model('CKzCustomersModel');

        // Load the configuration file of mobile for encryption and decryption
        $this->load->config('mobile');
        
        // Create array object
        $formArray=array();

        // Use openssl_encrypt() function to encrypt the mobile number because encrypted mobile number was stored in customers table 
        $formArray['mobileNumber'] = openssl_encrypt($this->input->post('mobile'), $this->config->item('ciphering'),$this->config->item('encryption_key'),$this->config->item('options'), $this->config->item('encryption_iv'));
        $formArray['password'] = $this->input->post('password');

        $row = $this->CKzCustomersModel->fetchLoginRow($formArray);

        // It check Is $row empty  aand return response to show login status
        if(empty($row)){
            $response['status'] = 0; 
            $response['msg'] = 'Login failed!';
            echo json_encode($response);
        }else{
            // Declare user session  
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

        $this->load->model('CKzCustomersModel');

        // Load the configuration file of mobile for encryption and decryption
        $this->load->config('mobile');

        // Getting customerID
        $intCustomerId = $this->session->userdata('cus_id');

        // Get the particular customer record
        $row = $this->CKzCustomersModel->fetchCustomer($intCustomerId);
        
        // Decrypted mobile number
        $mobile = openssl_decrypt($row['mobile'],  $this->config->item('ciphering'),$this->config->item('encryption_key'),$this->config->item('options'), $this->config->item('encryption_iv'));
        $row['mobile'] = $mobile;

        // Create array object
        $data = array();

        // Assign
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

        $this->load->model('CKzCustomersModel');

        // Load the configuration file of mobile for encryption and decryption
         $this->load->config('mobile'); 

        // set timezone
        date_default_timezone_set("Asia/Kolkata");

        // Create array object
        $formArray=array();

        $intCustomerId = $this->input->post('cus_id');
        $formArray['fname']=$this->input->post('fName');
        $formArray['lname']=$this->input->post('lName');
        $formArray['email']=$this->input->post('email');

        // Use openssl_encrypt() function to encrypt the data 
        $encryptionMobileNumber = openssl_encrypt($this->input->post('mobile'), $this->config->item('ciphering'),$this->config->item('encryption_key'),$this->config->item('options'), $this->config->item('encryption_iv'));
        
        $formArray['mobile']= $encryptionMobileNumber;
        $formArray['pin']=$this->input->post('pin');
        $formArray['verified_otp']=$this->input->post('verifiedOtp');
        $formArray['state']=$this->input->post('state');
        $formArray['city']=$this->input->post('city');
        $formArray['address']=$this->input->post('address');
        $formArray['modified_date'] = date("Y-m-d h:i:sa");
        
        // Update customer record
        $this->CKzCustomersModel->update($intCustomerId,$formArray);

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

        $this->load->model('CKzOrdersModel');

        // Create array object
        $data = array();
        
        // Fetch all orders of particular customer
        $data['orderRows'] = $this->CKzOrdersModel->fetchOrders($this->session->userdata('cus_id'));
        //print_r($orderRows);
        $this->load->view('orders', $data);
    }

    // Insert recently viewed products if customer logged in
    function recentlyViewedProducts(){
        $this->load->model('CKzRecentlyViewedProductsModel');

        // Create array object
        $formArray = array();

        $formArray['cus_id'] = $this->input->post('cus_id');
        $formArray['pro_id'] = $this->input->post('pro_id');

        // Insert record
        $boolResponse = $this->CKzRecentlyViewedProductsModel->create($formArray);

        // Set response
        if($boolResponse){
            $response['status'] = 1;
        }else{
            $response['status'] = 0;
        }

        // Return response
        echo json_encode($response);

    }

    // Load forgotPassword view
    function forgotPassword(){
        $this->load->view('forgotPassword');
    }

    // Change Password
    function changePassword(){
        $this->load->model('CKzCustomersModel');

        // Load the configuration file of mobile for encryption and decryption
        $this->load->config('mobile');   

        // Set timezone
        date_default_timezone_set("Asia/Kolkata");

        // Create array object
        $formArray=array();

        // Encrypted mobile number 
        $encryptionMobileNumber = openssl_encrypt($this->input->post('mobile'), $this->config->item('ciphering'),$this->config->item('encryption_key'),$this->config->item('options'), $this->config->item('encryption_iv'));
        
        $formArray['mobile']= $encryptionMobileNumber;
        $formArray['verified_otp']=$this->input->post('otp');
        $formArray['password']=password_hash($this->input->post('password'),PASSWORD_DEFAULT);   
        $formArray['modified_date'] = date("Y-m-d h:i:sa");
        
        $this->CKzCustomersModel->changePassword($formArray);
        
        // Success response through session if password changed 
        $this->session->set_flashdata('success', 'Your password has changed successfully. Please login to your account.');

        // Response to show registration completed
        $response['status']=1;
        echo json_encode($response);
    }

    // Cancel order
    function cancelOrder(){
        // the user is not logged in, redirected to login !
        if (empty($this->session->userdata('cus_id')))
        {
            redirect(base_url().'CCustomers/index');
        }

        // Load model's
        $this->load->model('CKzCustomersModel');
        $this->load->model('CKzOrdersModel');
        $this->load->model('CKzProductsModel');

        // Fetch a record of product
        $row = $this->CKzProductsModel->fetchRow($this->input->get('pro_id'));

        // Set timezone
        date_default_timezone_set("Asia/Kolkata");

        // Create array object
        $cancelOrderData = array();

        $cancelOrderData['pro_id'] = $this->input->get('pro_id');
        $cancelOrderData['order_id'] = $this->input->get('order_id');
        $cancelOrderData['quantity'] = $this->input->get('quantity')+$row['quantity'];
        $cancelOrderData['price'] = $this->input->get('price');
        $cancelOrderData['cus_id'] = $this->session->userdata('cus_id');
        $cancelOrderData['modified_date'] = date("Y-m-d h:i:sa");

        $boolResponse = $this->CKzOrdersModel->cancelOrder($cancelOrderData);
        
        // Check order cancelled or not
        // If yes then send email as response
        if($boolResponse){
            // Set session
            $this->session->set_flashdata('success_msg', 'Your item cancelled successfully!');
            
            $this->load->model('CKzCustomersModel');

            // Fetch a customer records for details like name, email, etc
            $row = $this->CKzCustomersModel->fetchCustomer($this->session->userdata('cus_id'));

            // Load the configuration file of email
            $this->load->config('email');
           
            // Set parameters
            $from = $this->config->item('smtp_user');
            $to = $row['email'];
            $subject = 'Your order cancelled for ...';
            $message = '<!DOCTYPE html>
            <html>
            <body>
               <div>
                   <div style="background-color: #3a4468; border-radius: 10px; padding: 10px; color: white; margin-left: 40px; margin-right: 40px;">
                       <h2 style="display:inline-block; margin-left: 30px">Kisanzone</h2>
                       <h3 style="display:inline-block; float:right; margin-right: 30px;">Order Cancelled!</h3>
                   </div>
                       <div style="border-radius: 10px; padding: 10px; margin-left: 50px; margin-right: 50px;">
                           <div>
                               <div style="display:inline-block;">
                                       <p> Hii <b> '.$row['fname'].' ,	</b> <br>	 Your order has been cancelled! </p>
                               </div>
                               <div style="display:inline-block; float: right">
                                       <p> <b>Order cancelled on: </b> '. date("Y-m-d").' <br><b>Order id:	</b> '.$this->input->get('order_id').'</p>
                               </div>
                           </div>
                        </div>
               </div> 
           </body>
           </html>';
   
           $this->email->set_newline("\r\n");
           $this->email->from($from,"Kisanzone");
           $this->email->to($to);
           $this->email->subject($subject);
           $this->email->message($message);
        
            // if mail sent to admin mail    
            if ($this->email->send()) {
                $response['status'] = 1;
            } else { //if mail not sent to admin mail
                $response['status'] = 0;
                //show_error($this->email->print_debugger()); 
            }

            echo json_encode($response);

        }else{
            // Set session
            $this->session->set_flashdata('error_msg', 'Something went wrong, please try again.');
        }

        redirect(base_url().'CCustomers/getOrders');
        
    }

    // Destroy session
    function logout(){
        $this->session->sess_destroy();
        redirect(base_url().'CHome/index');
    }
    
}
?>