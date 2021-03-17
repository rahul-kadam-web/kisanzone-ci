<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CAdminModel extends CI_Model{
    // This method will insert record in admin table
    function create($formArray)
    {        
        try {
            $boolResponse = $this->db->insert('admin', $formArray);
            return $boolResponse;
        }
        catch (Exception $e) {
            // echo $e->getMessage();
            return false;
        }
    }

     // This method will fetch particular record to check email in admin table
     function emailAlreadyExistOrNot($strEmail){
        $this->db->where('email',$strEmail);
        $row = $this->db->get('admin')->row_array();
        //select * from admin where email=

        return $row;
    }

    // It will fetch particular record from admin table to verify admin
    function fetchAdminLoginRow($formArray){
        $adminLoginRow = $this->db->select('*')
                    ->from('admin')
                    ->where('username', $formArray['username'])
                    ->where('status', 1)         
                    ->get()->row_array();
        if(!empty($adminLoginRow)){
            // Verify the hash against the password entered 
            $verify = password_verify($formArray['password'], $adminLoginRow['password']);
            if($verify){
                return $adminLoginRow;
            }
        }else{
            return false;
        } 
    }
   
}

?>