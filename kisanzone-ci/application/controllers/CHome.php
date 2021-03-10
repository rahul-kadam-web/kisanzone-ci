<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CHome Extends CI_Controller{

    function  __construct(){
        parent::__construct();
        
        // Load cart library
        $this->load->library('cart');
        
    }
    
    // Load welcone view
    function index(){
        $this->load->model('CProductsModel');

        $data = array();
        
        // Fetch products from the database
        $data['products'] = $this->CProductsModel->getProductsRows();
        
        // Load the product list view
        $this->load->view('welcome', $data);
    }

    //product details on user click
    function viewProductDetails($intProductId){
        $this->load->model('CProductsModel');
        
        $data = array();
        
        // Fetch products from the database
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
}
?>