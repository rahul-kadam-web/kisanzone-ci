<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CManageKzCategory Extends CI_Controller{
    // load list of category
    public function index(){
        $this->load->model('CCategoryModel');
        // fetch all records of category in $rows varibale
        $rows=$this->CCategoryModel->fetchAllCategory();
        $data['rows']=$rows;

        $this->load->view('admin/category/listCategory.php',$data);
    }

    // save or insert particular record in category table
    public function saveCategory(){
        $this->load->model('CCategoryModel');

        $formArray=array();
        $formArray['category_name']=$this->input->post('category');
        $this->CCategoryModel->create($formArray);

        //response to display success operation
        $response['status']=1;
        $response['category_name']=$formArray['category_name'];
        echo json_encode($response);
     }

     // load addCategory view
     public function addCategory(){
       //Load the addBrand view
       $this->load->view('admin/category/addCategory.php');
     }

     // this will return edit form
     function getCategory($intId){
      $this->load->model('CCategoryModel');

      // fetch particular record
      $row = $this->CCategoryModel->fetchRow($intId);
      $data['row']=$row; 
      $html = $this->load->view('admin/category/editCategory.php',$data,true);

      //response in html to load edit view
      $response['html']=$html;
      echo json_encode($response);
   }

   // this will update particular record
   function  updateCategory(){
    $this->load->model('CCategoryModel');

    // to find record exists or not
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

    // fetch updated record
    $row=$this->CCategoryModel->fetchRow($intCatIdResponse);

    // response  to display success and change in view
    $response['row']=$row;
    $response['status']=1;
    $response['msg']= "Record updated succeefully!";
    echo json_encode($response);
 }

//  delete particular record from from category table 
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

  // delete method call
  $this->CCategoryModel->delete($intCatId);

  // response to display success and make changes in view
  $response['cat_id']=$intCatId;
  $response['status']= 1;
  $response['msg']= "Record deleted succeefully!";
  echo json_encode($response);
}
}
?>