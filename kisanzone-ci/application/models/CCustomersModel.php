<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CCustomersModel extends CI_Model{

     // This method will insert record in customers table
     function create($formArray)
     {
         $this->db->insert('customers', $formArray);
     }

    // This method will fetch particular record to check in cutomers table
    function mobileAlreadyExistOrNot($strMobile){
        $this->db->where('mobile',$strMobile);
        $row = $this->db->get('customers')->row_array();
        //select * from customers where email=

        return $row;
    }

    // It will fetch particular record from customers table to verify customer
    function fetchLoginRow($formArray){
        $loginRow = $this->db->select('*')
                    ->from('customers')
                    ->where('mobile', $formArray['mobileNumber'])
                    ->where('status', 1)         
                    ->get()->row_array();
        if(!empty($loginRow)){
            // Verify the hash against the password entered 
            $verify = password_verify($formArray['password'], $loginRow['password']);
            if($verify){
                return $loginRow;
            }
        }else{
            return false;
        } 
    }

    // It will fetch particular record from customers table to load customer profile view
    function fetchCustomer($intCustomerId){
        $row = $this->db->select('*')
                    ->from('customers')
                    ->where('cus_id', $intCustomerId)
                    ->where('status', 1)         
                    ->get()->row_array();
        return $row;
    }

    //This method will update particular record in customers table
    function update($intId,$formArray){
        $this->db->where('cus_id',$intId);
        $row = $this->db->update('customers',$formArray);
        //update customers set ....
        return $intId;
    }

    // This method will fetch orders of particular customer
    function fetchOrders($intCustomerId){
        $result = $this->db->select('p.image, p.name, p.price, c.category_name, b.brand_name, o.created_date, oi.quantity, oi.sub_total, cust.address, cust.city, cust.state, cust.pin')
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

}

?>