<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CProductsModel extends CI_Model{
    // This method will insert record in products table
    function create($formArray)
    {
        $this->db->insert('products', $formArray);
    }

    //This method will return all records from brand, category and product table
    function fetchAllProducts(){
        $result = $this->db->select('p.pro_id, p.name, p.image, p.price, p.quantity, p.description, p.cat_id, c.category_name, p.brand_id, b.brand_name, p.added_date, p.modified_date, p.status')
                    ->from('products p')
                    ->join('category c', 'c.cat_id=p.cat_id')
                    ->join('brand b', 'b.brand_id=p.brand_id')
                    ->order_by('p.pro_id','asc')         
                    ->get()->result_array(); 
        return $result;
    }

    // This method will fetch particular record from product, brand and category table
    function fetchRow($intProductId){
        $row = $this->db->select('p.pro_id, p.name, p.image, p.price, p.quantity, p.description, p.cat_id, c.category_name, p.brand_id, b.brand_name, p.added_date, p.modified_date, p.status')
                    ->from('products p')
                    ->join('category c', 'c.cat_id=p.cat_id')
                    ->join('brand b', 'b.brand_id=p.brand_id')
                    ->where('p.pro_id',$intProductId)
                    ->order_by('p.pro_id','asc')         
                    ->get()->row_array(); 
        return $row;
    }

    // This method will update particular record in products table
    function update($intProductId,$formArray){
        $this->db->where('pro_id',$intProductId);
        $row = $this->db->update('products',$formArray);
        //update products set ....
        return $intProductId;
    }

    // This method will delete particular record from products table
    function delete($intProductId){
        $this->db->where('pro_id',$intProductId);
        $row = $this->db->delete('products');
        //delete from products where pro_id=
        return $intProductId;
    }

    /*
     * Fetch products data from the product table for users
     */
    public function getProductsRows(){

        $rows = $this->db->select('c.category_name, p.pro_id, p.name, p.image, p.price, p.cat_id, p.status')
                    ->from('products p')
                    ->join('category c', 'c.cat_id=p.cat_id')
                    ->join('brand b', 'b.brand_id=p.brand_id')
                    ->where('p.status','1')
                    ->group_by('c.category_name, p.name, p.pro_id, p.image, p.price, p.cat_id, p.status')
                    ->get()->result_array();
        
        // Return fetched data
        return $rows;
    }

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