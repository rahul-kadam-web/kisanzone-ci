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
        // Redirect to cart if the cart is empty
        if($this->cart->total_items() <= 0){
            redirect('CCart/');
        }

        // Get a customer id from session
        $intCustomerId = $this->session->userdata('cus_id');

        // Get toatl price from cart
        $price = $this->cart->total();

        // Call to placeOrder() function and passing a customer id
        $intOrderId = $this->placeOrder($intCustomerId);
                    
        // If the order submission is successful
        if($intOrderId){
            // set timezone
            date_default_timezone_set("Asia/Kolkata"); 

            $this->load->model('CKzCustomersModel');

            // Get customer record
            $row = $this->CKzCustomersModel->fetchCustomer($intCustomerId);

            // Loading configuration file of email
            $this->load->config('email');
           
            // Set parameters
            $from = $this->config->item('smtp_user');
            $to = $row['email'];
            $subject = 'Your order placed for ...';
            $message = '<!DOCTYPE html>
            <html>
            <body>
               <div>
                   <div style="background-color: #3a4468; border-radius: 10px; padding: 10px; color: white; margin-left: 40px; margin-right: 40px;">
                       <h2 style="display:inline-block; margin-left: 30px">Kisanzone</h2>
                       <h3 style="display:inline-block; float:right; margin-right: 30px;">Order placed!</h3>
                   </div>
                       <div style="border-radius: 10px; padding: 10px; margin-left: 50px; margin-right: 50px;">
                           <div>
                               <div style="display:inline-block;">
                                       <p> Hii <b> '.$row['fname'].' 	</b> <br>	 Your order has been successfully placed! </p>
                               </div>
                               <div style="display:inline-block; float: right">
                                       <p> <b>Order placed on: </b> '. date("Y-m-d").' <br><b>Order id:	</b> '.$intOrderId.'</p>
                               </div>
                           </div>
                           <p style="text-align: center"><b> Amount Payble:	</b>&#8377;'.$price.'</p>
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

            // Return response
            echo json_encode($response);

            // Set flash session 
            $this->session->set_flashdata('success_msg', 'Order placed successfully.');
            
            // Unset session
            if(!empty($this->session->flashdata('error_msg'))){
                $this->session->unset_userdata('error_msg');
            }
        }else{
            // set flash session
            $this->session->set_flashdata('error_msg', 'Order submission failed, please try again.');
            
            // Unset session
            if(!empty($this->session->flashdata('success_msg'))){
                $this->session->unset_userdata('success_msg');
            }
        }
        
        // Redirect to orders page  
        redirect(base_url().'CCustomers/getOrders');
    }
    
    //  Place order
    function placeOrder($intCustomerId){
        $this->load->model('CKzProductsModel');
        $this->load->model('CKzOrdersModel');
        $this->load->model('CKzOrderItemsModel');

        // Insert order data
        $ordData = array(
            'cus_id' => $intCustomerId,
            'grand_total' => $this->cart->total()
        );

        $intInsertOrder = $this->CKzOrdersModel->insertOrder($ordData);
        
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

                // Decrease product quantity
                $productRow = $this->CKzProductsModel->fetchRow($item['id']);
                $this->CKzProductsModel->decreaseQuantityOfProductAfterOrder($productRow['pro_id'], ($productRow['quantity']-$item['qty']));
            }
            
            if(!empty($ordItemData)){
                // Insert order items
                $boolInsertOrderItems = $this->CKzOrderItemsModel->insertOrderItems($ordItemData);
                
                // If order items inserted
                if($boolInsertOrderItems){
                    // Remove items from the cart
                    $this->cart->destroy();
                    
                    // Return order ID
                    return $intInsertOrder;
                }
            }
        }
        // If not inserted 
        return false;
    }
    
}