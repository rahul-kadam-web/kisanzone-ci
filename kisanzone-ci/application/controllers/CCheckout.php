<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CCheckout extends CI_Controller{
    
    function  __construct(){
        parent::__construct();

        // the user is not logged in, redirected to login page!
        if (empty($this->session->userdata('cus_id')))
        {
            redirect(base_url().'CCustomers/index'); 
        }

        // Load cart library
        $this->load->library('cart');
    }

    // It will place order
    function index(){
        // Redirect if the cart is empty
        if($this->cart->total_items() <= 0){
            redirect('CCart/');
        }

        // Get a customer id from session
        $intCustomerId = $this->session->userdata('cus_id');
        
        // Call to placeOrder() function and passing a customer id
        $boolOrder = $this->placeOrder($intCustomerId);
                    
            // If the order submission is successful
            if($boolOrder){
                $this->session->set_flashdata('success_msg', 'Order placed successfully.');
                if(!empty($this->session->flashdata('error_msg'))){
                    $this->session->unset_userdata('error_msg');
                }
            }else{
                $this->session->set_flashdata('error_msg', 'Order submission failed, please try again.');
                if(!empty($this->session->flashdata('success_msg'))){
                    $this->session->unset_userdata('success_msg');
                }
            }
        
        // Redirect to orders page  
        redirect(base_url().'CCustomers/getOrders');
    }
    
    //  Place order
    function placeOrder($intCustomerId){
        $this->load->model('CProductsModel');

        // Insert order data
        $ordData = array(
            'cus_id' => $intCustomerId,
            'grand_total' => $this->cart->total()
        );
        $intInsertOrder = $this->CProductsModel->insertOrder($ordData);
        
        // If order data is inserted
        if($intInsertOrder){
            // Retrieve cart data from the session
            $cartItems = $this->cart->contents();
            
            // Cart items
            $ordItemData = array();

            $i=0;
            foreach($cartItems as $item){
                $ordItemData[$i]['order_id']     = $intInsertOrder;
                $ordItemData[$i]['pro_id']     = $item['id'];
                $ordItemData[$i]['quantity']     = $item['qty'];
                $ordItemData[$i]['sub_total']     = $item["subtotal"];
                $i++;
            }
            
            if(!empty($ordItemData)){
                // Insert order items
                $boolInsertOrderItems = $this->CProductsModel->insertOrderItems($ordItemData);
                
                // If order items inserted
                if($boolInsertOrderItems){
                    // Remove items from the cart
                    $this->cart->destroy();
                    
                    // Return order ID
                    return $boolInsertOrderItems;
                }
            }
        }
        // If not inserted 
        return false;
    }
    
}