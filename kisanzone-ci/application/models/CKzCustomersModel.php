<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CKzCustomersModel extends CI_Model{

     // This method will insert record in customers table
     function create($formArray)
     {
         $this->db->insert('customers', $formArray);
     }

    // This method will fetch particular record to check mobile name exist or not in cutomers table
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

    // This method will change password
    function changePassword($formArray){
        $this->db->where('mobile',$formArray['mobile']);
        $row = $this->db->update('customers',$formArray);
        return true;
    }

    // This method will return count of customer records
    function fetchCount(){
        return $this->db->get('customers')->num_rows();
    }

    // This method will return all customers 
    public function usersInventory(){
        $rows = $this->db->select('cus_id, fname, lname, email, mobile, city, state, address, created_date')
                    ->from('customers')
                    ->order_by('cus_id','asc')
                    ->get()->result_array();
        return $rows;
    }

}

?>