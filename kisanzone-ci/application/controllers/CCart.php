<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CCart extends CI_Controller{
    
    function  __construct(){
        parent::__construct();
        
        // Load cart library
        $this->load->library('cart');
    }
    
    // Load shopping cart view to user
    function index(){
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