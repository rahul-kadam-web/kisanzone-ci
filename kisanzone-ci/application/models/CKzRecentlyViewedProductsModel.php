<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CKzRecentlyViewedProductsModel extends CI_Model{
    
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
     function fetchRecentlyViewedProductsRows($intCustomerId){
        $result = $this->db->select('p.pro_id, p.name, p.image, p.price')
                    ->from('products p')
                    ->join('recently_viewed_products rvp','rvp.pro_id = p.pro_id')
                    ->where('rvp.cus_id', $intCustomerId)
                    ->order_by('rvp.viewed_date','desc')
                    ->limit(5)         
                    ->get()->result_array(); 
        return $result;
    }

    // This method update status of recently viewed product  
    function updateRecentlyViewedProductsForCron()
    {
        try{
            $this->db->query("update recently_viewed_products 
            set status = 0
            where recently_viewed_products.viewed_date not in(select t2.viewed_date 
                from recently_viewed_products t2
                where recently_viewed_products.cus_id=t2.cus_id
                order by t2.viewed_date desc
                fetch first 3 row only
               )");
               return true;
        }catch(Exception $e){
            return false;
        }
       
    }

    //This method will return most viewed records
    function fetchMostViewedProductsRows(){
        try{
            $result = $this->db->select('rvp.pro_id, p.name, count(rvp.pro_id)')
                    ->from('recently_viewed_products rvp')
                    ->join('products p','rvp.pro_id = p.pro_id')
                    ->group_by('rvp.pro_id, p.name')
                    ->get()->result_array(); 
            return $result;
        }catch(Exception $e){
            return false;
        }
        
    }
}

?>