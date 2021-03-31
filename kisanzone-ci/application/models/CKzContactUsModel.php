<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CKzContactUsModel extends CI_Model{

    // This method will insert record in contact_us table
    function create($formArray)
    {
        $this->db->insert('contact_us', $formArray);
    }

    // This method will fetch all records of contact_us table
    function fetchUsersFeedback(){
        $rows = $this->db->select('contact_id, name, email, mobile,subject, description, created_date')
                    ->from('contact_us')
                    ->order_by('contact_id','desc')
                    ->get()->result_array();
        return $rows;
    }

}

?>