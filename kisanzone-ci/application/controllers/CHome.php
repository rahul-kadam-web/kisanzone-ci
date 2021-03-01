<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CHome Extends CI_Controller{

    function  __construct(){
        parent::__construct();
        
        // Load cart library
        $this->load->library('cart');
        
        // Load product model
        $this->load->model('product');
    }
    
    //load welcone view
    function index(){
        $data = array();
        
        // Fetch products from the database
        $data['products'] = $this->product->getRows();
        
        // Load the product list view
        $this->load->view('welcome', $data);
    }

    // it will add item to cart
    function addToCart($proID){
        
        // Fetch specific product by ID
        $product = $this->product->getRows($proID);
        
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

    public function about(){
        //Load the about view
        $this->load->view('about');
    }

    public function login(){
        //Load the login view
        $this->load->view('login');
    }

    public function signup(){
        //Load the signup view
        $this->load->view('signup');
    }

    public function whyUs(){
        //load the whyUs view
        $this->load->view('whyUs');
    }

    public function contactUs(){
        //Load the contact us view
        $this->load->view('contactUs');
    }
}
?>