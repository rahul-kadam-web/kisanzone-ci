<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CCategoryModel extends CI_Model{
    // to insert record in category table
    function create($formArray)
    {
        $this->db->insert('category', $formArray);
    }

    //This method will return all records from category table
    function fetchAllCategory(){
        $result = $this->db
                    ->order_by('cat_id','asc')
                    ->get('category')
                    ->result_array();
        //select * from category order by id asc
        return $result;
    }

    // It will fetch particular record from category table
    function fetchRow($intId){
        $this->db->where('cat_id',$intId);
        $row = $this->db->get('category')->row_array();
        //select * from brand where brand_id='$id'
        return $row;
    }

    //This method will update particular record from category table
    function update($intId,$formArray){
        $this->db->where('cat_id',$intId);
        $row = $this->db->update('category',$formArray);
        //update brand set ....
        return $intId;
    }

    // This method  will delete particular record from category table
    function delete($intId){
        $this->db->where('cat_id',$intId);
        $row = $this->db->delete('category');
        //delete from brand where brand_id=
        return $intId;
    }
}

?>