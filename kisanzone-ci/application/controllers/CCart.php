<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CCart extends CI_Controller{
    
    function  __construct(){
        parent::__construct();
        
        // Load cart library
        $this->load->library('cart');
    }
    
    // it will add item to cart
    function addToCart($proID){
        $this->load->model('CKzProductsModel');
        
        // Fetch specific product by ID
        $product = $this->CKzProductsModel->fetchRow($proID);
        
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

    // Load shopping cart view to customer
    function index(){
        // Create array object
        $data = array();
        
        // Retrieve cart data from the session using contents() function
        $data['cartItems'] = $this->cart->contents();
        
        $this->load->view('cart/index', $data);
    }
    
    // Update quantity of item in shopping cart 
    function updateItemQty(){
        $update = 0;
        
        // Get cart item info
        $rowid = $this->input->get('rowid');
        $qty = $this->input->get('qty');
        
        // Update item in the cart
        if(!empty($rowid) && !empty($qty)){
            $data = array(
                'rowid' => $rowid,
                'qty'   => $qty
            );
            $update = $this->cart->update($data);
        }
        
        // Return response
        echo $update?'ok':'err';
    }
    
    // Remove item from cart
    function removeItem($rowid){
        $remove = $this->cart->remove($rowid);
        
        // Redirect to the cart page
        redirect('CCart/');
    }
    
}