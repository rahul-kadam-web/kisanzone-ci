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
        $this->load->model('CProductsModel');

        $data = array();
        
        // Fetch products from the database
        $data['products'] = $this->CProductsModel->getProductsRows();
        
        
        $cus_id = $this->session->userdata('cus_id');
        if(empty($cus_id)){
            $data['recently_viewed_products'] = null;
        }else{
        $this->load->model('CRecentlyViewedProductsModel');
        $data['recently_viewed_products'] = $this->CRecentlyViewedProductsModel->getRecentlyViewedProductsRows($cus_id);
        }
        // Load the product list view
        $this->load->view('welcome', $data);
    }

    //product details on user click
    function viewProductDetails($intProductId){
        $this->load->model('CProductsModel');
        
        $data = array();
        
        // Fetch a product from the database to show particular product detail
        $data['products'] = $this->CProductsModel->fetchRow($intProductId);
        $this->load->view('viewProductDetails',$data);
    }

    // it will add item to cart
    function addToCart($proID){
        $this->load->model('CProductsModel');
        
        // Fetch specific product by ID
        $product = $this->CProductsModel->fetchRow($proID);
        
        // Add product to the cart
        $data = array(
            'id'    => $product['pro_id'],
            'qty'    => 1,
            'price'    => $product['price'],
            'name'    => $product["name"],
            'image' => $product['image']
        );
        $this->cart->insert($data);
        
        // Redirect to the cart page
        redirect(base_url().'CCart');
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

    // Save Contact us Record
    public function saveContactUs()
    {
     $this->load->model('CContactUsModel');

     $formArray = array();
     
     $formArray['name'] = $this->input->post('name');
     $formArray['email'] = $this->input->post('email');
     $formArray['mobile'] = $this->input->post('mobile');
     $formArray['subject'] = $this->input->post('subject');
     $formArray['description'] = $this->input->post('desc');

    //  Storing response of user
     $this->CContactUsModel->create($formArray);
    
    // Loading response
     $response['status'] = 1;
     $response['msg'] = 'Your response has been saved successfully! We will reach to it shortly.';
     echo json_encode($response);
    }
}
?>