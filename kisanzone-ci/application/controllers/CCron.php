<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CCron Extends CI_Controller{

    // This method will call 
    public function index(){
        // It check is it cli request?
        if(!$this->input->is_cli_request())
        {
            echo "Only be accessed from the command line";
            return;
        }

        $this->load->model('CKzRecentlyViewedProductsModel');

        // Update recently_view_products table for 
        // if customers have recently viewed records
        // then set status = 0 for those records .... 
        // which are viewed products previously by customers
        $boolResponse = $this->CKzRecentlyViewedProductsModel->updateRecentlyViewedProductsForCron();
        if($boolResponse){
            echo "Success!";
        }else{
            echo "Error";
        }
    }
  
}
?>