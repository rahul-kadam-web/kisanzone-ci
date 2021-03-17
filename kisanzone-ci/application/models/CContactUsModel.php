<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CContactUsModel extends CI_Model{
    // This method will insert record in contact_us table
    function create($formArray)
    {
        $this->db->insert('contact_us', $formArray);
    }

}

?>