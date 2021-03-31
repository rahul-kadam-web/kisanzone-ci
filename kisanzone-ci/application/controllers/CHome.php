<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CHome Extends CI_Controller{

    function  __construct(){
        parent::__construct();
        
        // Load cart library
        $this->load->library('cart');   
    }
    
    // Load welcome view to all user
    function index(){
        $this->load->model('CKzProductsModel');

        // Create array object
        $data = array();
        
        // Fetch products from the database
        $data['products'] = $this->CKzProductsModel->fetchProductsRows();
        
        // Get Customer Id
        $intCustomerId = $this->session->userdata('cus_id');

        // Check Customer id empty or not
        if(empty($intCustomerId)){
            $data['recently_viewed_products'] = null;
        }else{
            $this->load->model('CKzRecentlyViewedProductsModel');
            // Fetch recently viewed product of a customer
            $data['recently_viewed_products'] = $this->CKzRecentlyViewedProductsModel->fetchRecentlyViewedProductsRows($intCustomerId);
        }

        // Load the product list view
        $this->load->view('welcome', $data);

    }

    // Product details of a product
    function viewProductDetails($intProductId){
        $this->load->model('CKzProductsModel');
        
        // Create array object
        $data = array();
        
        // Fetch a product from the database to show particular product detail
        $data['products'] = $this->CKzProductsModel->fetchRow($intProductId);

        $this->load->view('viewProductDetails',$data);

    }

    

    // Load the about view
    public function about(){
        $this->load->view('about');
    }

    // Load the whyUs view
    public function whyUs(){
        $this->load->view('whyUs');
    }

    // Load the contact us view
    public function contactUs(){
        $this->load->view('contactUs');
    }

    // Save or Insert Contact us Record
    public function saveContactUs()
    {
     $this->load->model('CKzContactUsModel');

    //  Create array object
     $formArray = array();
     
     $formArray['name'] = $this->input->post('name');
     $formArray['email'] = $this->input->post('email');
     $formArray['mobile'] = $this->input->post('mobile');
     $formArray['subject'] = $this->input->post('subject');
     $formArray['description'] = $this->input->post('desc');

    //  insert feedback of a user
     $this->CKzContactUsModel->create($formArray);
    
    // Return response
     $response['status'] = 1;
     $response['msg'] = 'Your response has been saved successfully! We will reach to it shortly.';
     
     echo json_encode($response);
    
    }
}
?>