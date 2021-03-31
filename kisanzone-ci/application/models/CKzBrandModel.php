<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CKzBrandModel extends CI_Model{

    // This method will insert record in brand table
    function create($formArray)
    {
        $this->db->insert('brand', $formArray);
    }

    // This method will return all records of brand table
    function fetchAllBrand(){
        $result = $this->db
                    ->order_by('brand_id','asc')
                    ->get('brand')
                    ->result_array();
        //select * from brand order by brand_id asc
        return $result;
    }

    // This method will fetch particular record of brand table
    function fetchRow($intId){
        $this->db->where('brand_id',$intId);
        $row = $this->db->get('brand')->row_array();
        //select * from brand where brand_id='$intId'
        return $row;
    }

    // This method will update particular record
    function update($intId,$formArray){
        $this->db->where('brand_id',$intId);
        $row = $this->db->update('brand',$formArray);
        //update brand set .... where brand_id=
        return $intId; //return intId
    }

    // This method will delete particular record
    function delete($intId){
        $this->db->where('brand_id',$intId);
        $row = $this->db->delete('brand');
        //delete from brand where brand_id=
        return $intId; //return intId
    }

    // This method will return count of brand records
    function fetchCount(){
        return $this->db->get('brand')->num_rows();
    }
}

?>