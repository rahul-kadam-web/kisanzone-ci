<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CKzOrdersModel extends CI_Model{

    /*
     * Insert order data in the database
     * @param data array
     */
    public function insertOrder($data){
                
        // Insert order data
        $insert = $this->db->insert('orders', $data);

        // Return the status
        return $insert?$this->db->insert_id():false;
    }

    // This method will fecth orders record
    function fetchOrdersListForAdmin(){
        try{
            $result = $this->db->select('o.order_id, oi.order_item_id, o.cus_id, oi.pro_id, oi.quantity, oi.sub_total, o.created_date')
                    ->from('orders o')
                    ->join('order_items oi','oi.order_id = o.order_id')
                    ->where('oi.status',1)
                    ->order_by('o.created_date','desc')         
                    ->get()->result_array();
            return $result;
        }catch(Exception $e){
            return false;
        }   
    }

    // This method will fecth cancelled orders record
    function fetchCancelledOrdersListForAdmin(){
        try{
            $result = $this->db->select('o.order_id, oi.order_item_id, o.cus_id, oi.pro_id, oi.quantity, oi.sub_total, o.modified_date')
                    ->from('orders o')
                    ->join('order_items oi','oi.order_id = o.order_id')
                    ->where('oi.status',0)
                    ->order_by('o.modified_date','asc')         
                    ->get()->result_array();
            return $result;
        }catch(Exception $e){
            return false;
        }   
    }

    // This method will fetch orders of particular customer
    function fetchOrders($intCustomerId){
        $result = $this->db->select('p.pro_id, p.image, p.name, p.price, c.category_name, b.brand_name, o.grand_total, o.created_date, oi.order_id, oi.quantity, oi.sub_total, oi.status, cust.address, cust.city, cust.state, cust.pin')
                    ->from('products p')
                    ->join('category c','p.cat_id = c.cat_id')
                    ->join('brand b','p.brand_id = b.brand_id')
                    ->join('order_items oi','oi.pro_id = p.pro_id')
                    ->join('orders o','oi.order_id = o.order_id')
                    ->join('customers cust','o.cus_id = cust.cus_id')
                    ->where('o.cus_id',$intCustomerId)
                    ->where('o.status', 1)
                    ->order_by('o.created_date','desc')         
                    ->get()->result_array();
        return $result;
    }

    // This method will cancel order and update quantity, status,  grand_total and modified date
    function cancelOrder($cancelOrderData){
        try{
            $this->db->where('order_id',$cancelOrderData['order_id'])
                    ->where('pro_id',$cancelOrderData['pro_id']);
            $this->db->update('order_items',
                array('status' => "0")
            );

            $this->db->where('order_id',$cancelOrderData['order_id']);
            $this->db->update('orders',
                array('grand_total' => $cancelOrderData['price'],
                'modified_date' => $cancelOrderData['modified_date']
                )
            );

            $this->db->where('pro_id',$cancelOrderData['pro_id']);
            $this->db->update('products',
                array('quantity' => $cancelOrderData['quantity'])
            );

            return true;
        }
        catch(Exception $e){
            return false;
        }
    }


}

?>