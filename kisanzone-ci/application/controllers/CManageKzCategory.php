<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CManageKzCategory Extends CI_Controller{

    function  __construct(){
        parent::__construct();

        //the user is not logged in, redirected to login page!
        if (empty($this->session->userdata('admin_id')))
        {
            redirect(base_url().'CAdminManage/index'); 
        }
    }


    // Load list of category
    public function index(){
        $this->load->model('CCategoryModel');
        // fetch all records of category in $rows varibale
        $rows=$this->CCategoryModel->fetchAllCategory();
        $data['rows']=$rows;

        $this->load->view('admin/category/listCategory.php',$data);
    }

    // Save or insert particular record in category table
    public function saveCategory(){
        $this->load->model('CCategoryModel');

        $formArray=array();
        
        $formArray['category_name']=$this->input->post('category');
        // $formArray passed to create 
        $this->CCategoryModel->create($formArray);

        // Response to display record inserted
        $response['status']=1;
        $response['category_name']=$formArray['category_name'];
        echo json_encode($response);
     }

     // Load addCategory view
     public function addCategory(){
       $this->load->view('admin/category/addCategory.php');
     }

     // This will return particular record of category and edit form
     function getCategory($intId){
      $this->load->model('CCategoryModel');

      // Fetch particular record
      $row = $this->CCategoryModel->fetchRow($intId);
      $data['row']=$row; 
      $html = $this->load->view('admin/category/editCategory.php',$data,true);

      //Response in html to load edit view
      $response['html']=$html;
      echo json_encode($response);
   }

   // This will update particular record
   function  updateCategory(){
    $this->load->model('CCategoryModel');

    // To find record exists or not
    $intCatId= $this->input->post('cat_id');
    $row = $this->CCategoryModel->fetchRow($intCatId);
    if(empty($row)){
        $response['status']=0;
        $response['msg']="Either Record deleted or not found!";
        echo json_encode($response);
        exit;
    }

    
    date_default_timezone_set("Asia/Kolkata");
    $formArray=array();
    $formArray['category_name']=$this->input->post('category_name');
    $formArray['modified_date']= date("Y-m-d h:i:sa");
    $intCatIdResponse = $this->CCategoryModel->update($intCatId,$formArray);

    // To fetch updated record
    $row=$this->CCategoryModel->fetchRow($intCatIdResponse);

    // response  to display record updated
    $response['row']=$row;
    $response['status']=1;
    $response['msg']= "Record updated succeefully!";
    echo json_encode($response);
 }

// Delete particular record from from category table 
 function deleteCategory($intCatId){
  $this->load->model('CCategoryModel');

  // to find record exists or not
  $row = $this->CCategoryModel->fetchRow($intCatId);
  if(empty($row)){
      $response['status']=0;
      $response['msg']="Either Record deleted or not found!";
      echo json_encode($response);
      exit;
  }

  // Delete method call
  $this->CCategoryModel->delete($intCatId);

  // Response to display record deleted
  $response['cat_id']=$intCatId;
  $response['status']= 1;
  $response['msg']= "Record deleted succeefully!";
  echo json_encode($response);
}
}
?>