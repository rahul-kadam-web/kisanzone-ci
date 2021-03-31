<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CKzOrderItemsModel extends CI_Model{

    
    /*
     * Insert order items data in the database
     * @param data array
     */
    public function insertOrderItems($data = array()) {
        
        // Insert order items
        $insert = $this->db->insert_batch('order_items', $data);

        // Return the status
        return $insert?true:false;
    }

}

?>