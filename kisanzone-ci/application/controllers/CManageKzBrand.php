<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CManageKzBrand Extends CI_Controller{

    function  __construct(){
        parent::__construct();

        //if admin is not logged in, redirected to login page!
        if (empty($this->session->userdata('admin_id')))
        {
            redirect(base_url().'CAdminManage/index'); 
        }
    }

    // Load list of brand
    public function index(){
        $this->load->model('CKzBrandModel');
        
        // Create array object  
        $data = array();

        // fetch all records from brand table
        $rows=$this->CKzBrandModel->fetchAllBrand(); 

        $data['rows']=$rows;

        $this->load->view('admin/brand/listBrand',$data);
    }

    // Save or insert record to brand table
    public function saveBrand(){
        $this->load->model('CKzBrandModel');

        // Create array object
        $formArray=array();
        
        $formArray['brand_name']=$this->input->post('brand');
        $this->CKzBrandModel->create($formArray);

        // Response to display record inserted
        $response['status']=1;
        $response['brand_name']=$formArray['brand_name'];
        echo json_encode($response);
     }

    // Load addBrand view to add record
    public function addBrand(){
       $this->load->view('admin/brand/addBrand');
     }

     // This will get particular brand record and return edit form
     function getBrand($intId){
        $this->load->model('CKzBrandModel');
        
        // Fetch a brand record
        $row = $this->CKzBrandModel->fetchRow($intId);

        $data['row']=$row;
        
        // Edit form view
        $html = $this->load->view('admin/brand/editBrand.php',$data,true);

        // Loaded html response
        $response['html']=$html;
        echo json_encode($response);
     }

    //  Update particular record of brand table
     function  updateBrand(){
        $this->load->model('CKzBrandModel');

        // To find record exists or not
        $intBrandId= $this->input->post('brand_id');
        $row = $this->CKzBrandModel->fetchRow($intBrandId);
        if(empty($row)){
            $response['status']=0;
            $response['msg']="Either Record deleted or not found!";
            echo json_encode($response);
            exit;
        }
        
        // Set timezone
        date_default_timezone_set("Asia/Kolkata");

        // Create array object
        $formArray=array();

        $formArray['brand_name']=$this->input->post('brand_name');
        $formArray['modified_date']= date("Y-m-d h:i:sa");
        
        // Update record and return brand_id
        $intBrandIdResponse = $this->CKzBrandModel->update($intBrandId,$formArray);

        // Get record(updated)
        $row = $this->CKzBrandModel->fetchRow($intBrandIdResponse);

        // Response to show record updated
        $response['row']=$row;
        $response['status']=1;
        $response['msg']= "Record updated succeefully!";
        echo json_encode($response);
     }

     // Delete particular record 
     function deleteBrand($intBrandId){
        $this->load->model('CKzBrandModel');

        // to find record exists or not 
        $row = $this->CKzBrandModel->fetchRow($intBrandId);
        if(empty($row)){
            $response['status']=0;
            $response['msg']="Either Record deleted or not found!";
            echo json_encode($response);
            exit;
        }

        // If found then delete it
        $this->CKzBrandModel->delete($intBrandId);

        // Response to display record deleted
        $response['brand_id']=$intBrandId;
        $response['status']= 1;
        $response['msg']= "Record deleted succeefully!";
        echo json_encode($response);
     }

}
?>