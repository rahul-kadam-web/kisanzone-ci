<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CKzProductsModel extends CI_Model{
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
    public function fetchProductsRows(){

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



    // this method will return count of products record
    function fetchCount(){
        return $this->db->get('products')->num_rows();
    }

    // This method decrease quantity after order product
    function decreaseQuantityOfProductAfterOrder($intProductId, $intQuantity){
        $this->db->update('products',
            array('quantity' => $intQuantity),
            array('pro_id' => $intProductId)
        );
    }

    // This method will return inventory of product
    function productsInventory(){
        $rows = $this->db->select('p.pro_id, p.name, p.quantity, p.price, c.category_name, b.brand_name, p.added_date')
                    ->from('products p')
                    ->join('category c', 'c.cat_id=p.cat_id')
                    ->join('brand b', 'b.brand_id=p.brand_id')
                    ->where('p.status','1')
                    ->order_by('p.pro_id','asc')
                    ->get()->result_array();
        return $rows;
    }

    // This method return records of monthly sale of records
    function monthlySaleOfProducts(){
        $rows = $this->db->select("date_part('year',o.created_date at time zone 'iot') as year,to_char(o.created_date at time zone 'iot', 'Month') as month,sum(oi.quantity) as quantity, p.name as product_name, p.pro_id")
                    ->from("orders o")
                    ->join("order_items oi", "o.order_id=oi.order_id")
                    ->join("products p", "p.pro_id=oi.pro_id")
                    ->group_by("date_part('year',o.created_date at time zone 'iot'),to_char(o.created_date at time zone 'iot', 'Month'),p.name, p.pro_id")
                    ->get()->result_array();
        return $rows;
    }

     // This method return records of category wise monthly sale of records
    function categorywiseMonthlySaleOfProducts(){
        $rows = $this->db->select("c.category_name, date_part('year',o.created_date at time zone 'iot') as year,to_char(o.created_date at time zone 'iot', 'Month') as month,sum(oi.quantity) as quantity")
                    ->from("orders o")
                    ->join("order_items oi", "o.order_id=oi.order_id")
                    ->join("products p", "p.pro_id=oi.pro_id")
                    ->join("category c", "c.cat_id=p.cat_id")
                    ->group_by("c.category_name, date_part('year',o.created_date at time zone 'iot'),to_char(o.created_date at time zone 'iot', 'Month')")
                    ->get()->result_array();
        return $rows;
    }

 }

?>