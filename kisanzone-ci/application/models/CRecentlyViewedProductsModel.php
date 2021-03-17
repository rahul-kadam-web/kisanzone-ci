<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CRecentlyViewedProductsModel extends CI_Model{
    
    // To insert record in recently_viewed_products table
    function create($formArray)
    {
        try{
            $row = $this->db->select('*')
                        ->from('recently_viewed_products')
                        ->where('cus_id', $formArray['cus_id'])
                        ->where('pro_id', $formArray['pro_id'])
                        ->get()->result_array();
            
            if(!empty($row)){
                $this->db->where('cus_id',$formArray['cus_id']);
                $this->db->where('pro_id',$formArray['pro_id']);
                $row = $this->db->delete('recently_viewed_products');
            }

            $this->db->insert('recently_viewed_products', $formArray);
            return true;
        }catch(Exception $e){
            return false;
        }
    }

     //This method will return all recently viewed records
     function getRecentlyViewedProductsRows($intCustomerId){
        $result = $this->db->select('p.pro_id, p.name, p.image, p.price')
                    ->from('products p')
                    ->join('recently_viewed_products rvp','rvp.pro_id = p.pro_id')
                    ->where('rvp.cus_id', $intCustomerId)
                    ->order_by('rvp.viewed_date','desc')
                    ->limit(5)         
                    ->get()->result_array(); 
        return $result;
    }

    
}

?>