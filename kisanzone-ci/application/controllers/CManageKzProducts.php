<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CManageKzProducts Extends CI_Controller{

    function  __construct(){
        parent::__construct();

        //the admin is not logged in, redirected to login page!
        if (empty($this->session->userdata('admin_id')))
        {
            redirect(base_url().'CAdminManage/index'); 
        }
    }


    // Load list of products
    public function index(){
        $this->load->model('CKzProductsModel');

        // fetch all records of products table in $row
        $rows=$this->CKzProductsModel->fetchAllproducts();

        $data['rows']=$rows;
        
       $this->load->view('admin/product/listProduct',$data);
    }

    // Load addProduct view
    function addProduct(){
        // Load data for category select tag in addProduct view 
        $this->load->model('CKzCategoryModel');

        // Fetch Category records
        $rows_category=$this->CKzCategoryModel->fetchAllCategory();
        $data['rows_category']=$rows_category;

        // Load data for brand select tag in addProduct view 
         $this->load->model('CKzBrandModel');

        //  Fetch Brands record
         $rows_brand=$this->CKzBrandModel->fetchAllBrand();
         $data['rows_brand']=$rows_brand;

        // Loaded $data array passed to addProduct
        $this->load->view('admin/product/addProduct.php',$data);
    }

    // Save or insert record in product table
    public function saveProduct(){
        // File configuration and restrictions to save
		$config['upload_path']          = './productImages/';
        $config['allowed_types']        = 'jpeg|jpg|png';

        // Loading the file data to library
        $this->load->library('upload', $config);

        // Initilizing config again
        $this->upload->initialize($config);

        // It check file uploaded or not
        if(!$this->upload->do_upload("file")){
            $error = array('error' => $this->upload->display_errors());
            $response['status']=0;
            $response['error']=$error;
            echo json_encode($response);
        }else{
            // $data = array('upload_data' => $this->upload->data()); // it will show all information about a file

            // Get data about the file
            $uploadData = $this->upload->data(); 
            // Name of the file
            $filename = $uploadData['file_name']; 

            // Save entries to db
            $this->load->model('CKzProductsModel');

            // Create array object
            $formArray=array();

            $formArray['name']=$this->input->post('product');
            $formArray['price']=$this->input->post('price');
            $formArray['quantity']=$this->input->post('quantity');
            $formArray['brand_id']=$this->input->post('brand');
            $formArray['cat_id']=$this->input->post('category');
            $formArray['image']=$filename;
            $formArray['description']=$this->input->post('desc');
            
            // Insert product record
            $this->CKzProductsModel->create($formArray);

            // Response to display record inserted
            $response['status']=1;
            $response['name']=$formArray['name'];
            echo json_encode($response);
        }
     }

     // This will return particular product record and edit form
     function getProduct($Id){
        // For display category in select tag
        $this->load->model('CKzCategoryModel');
        $rows_category=$this->CKzCategoryModel->fetchAllCategory();
        $data['rows_category']=$rows_category;

        // For display brand in select tag
        $this->load->model('CKzBrandModel');
        $rows_brand=$this->CKzBrandModel->fetchAllBrand();
         $data['rows_brand']=$rows_brand;

        // Fetch particular product record and passed to view
        $this->load->model('CKzProductsModel');
        $row = $this->CKzProductsModel->fetchRow($Id);
        $data['row']=$row; 
        $html = $this->load->view('admin/product/editProduct.php',$data,true);

        // Edit html form response loaded 
        $response['html']=$html;
        echo json_encode($response);
     }

     // Update particular record in products table
     function  updateProduct(){
        $this->load->model('CKzProductsModel');

        // To find record exists or not
        $intProductId= $this->input->post('pro_id');
        $row = $this->CKzProductsModel->fetchRow($intProductId);
        if(empty($row)){
            $response['status']=0;
            $response['msg']="Either Record deleted or not found!";
            echo json_encode($response);
            exit;
        }

        // File configuration and restrictions to save
		$config['upload_path']          = './productImages/';
        $config['allowed_types']        = 'jpeg|jpg|png';

        // Loading the file data to library
        $this->load->library('upload', $config);

        // Initilizing config again
        $this->upload->initialize($config);

        // Its check file uploaded or not
        if(!$this->upload->do_upload("file")){
            $error = array('error' => $this->upload->display_errors());
            $response['status']=0;
            $response['msg']=$error;
            echo json_encode($response);
        }else{
             
            // $data = array('upload_data' => $this->upload->data()); 
            // it will show all information about a file

            // Get data about the file
            $uploadData = $this->upload->data(); 
            // Name of the file
            $filename = $uploadData['file_name']; 

            // Previous image to delete from folder
            $oldImage=$this->input->post('oldImage');
            $filePath="productImages/".$oldImage;
            if(file_exists($filePath)) {
            unlink($filePath);  //remove old file
            }

            // Set timezone
            date_default_timezone_set("Asia/Kolkata");

            // Create array object
            $formArray=array();

            $formArray['name']=$this->input->post('product');
            $formArray['price']=$this->input->post('price');
            $formArray['quantity']=$this->input->post('quantity');
            $formArray['brand_id']=$this->input->post('brand');
            $formArray['cat_id']=$this->input->post('category');
            $formArray['image']=$filename;
            $formArray['modified_date']=date("Y-m-d h:i:sa");;
            $formArray['description']=$this->input->post('desc');

            // Insert product record
            $intProductIdResponse = $this->CKzProductsModel->update($intProductId,$formArray); 
            
            // Fetch updated record
            $row=$this->CKzProductsModel->fetchRow($intProductIdResponse);

            // Particular record loaded in response to reflect changes in listView of product 
            $response['row']=$row; 
            
            // Response to display record updated
            $response['status']=1;
            $response['msg']= "Record updated succeefully!";
            
            // Updated image to load in view
            $response['newImage']=base_url().'productImages/'.$filename;
            echo json_encode($response);

        }
    }

    // Update particular record without image
    function  updateProductWithoutImage(){
            $this->load->model('CKzProductsModel');

            // To find record exists or not
            $intProductId= $this->input->post('pro_id');
            $row = $this->CKzProductsModel->fetchRow($intProductId);
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

            $formArray['name']=$this->input->post('product');
            $formArray['price']=$this->input->post('price');
            $formArray['quantity']=$this->input->post('quantity');
            $formArray['brand_id']=$this->input->post('brand');
            $formArray['cat_id']=$this->input->post('category');
            $formArray['modified_date']=date("Y-m-d h:i:sa");;
            $formArray['description']=$this->input->post('desc');
            
            // Insert product
            $intProductIdResponse = $this->CKzProductsModel->update($intProductId,$formArray); 
            
            // To fetch updated record to reflect changes in view
            $row=$this->CKzProductsModel->fetchRow($intProductIdResponse);
            
            // Fetched record loaded in response
            $response['row']=$row;  
            
            // Response to display record updated
            $response['status']=1;
            $response['msg']= "Record updated succeefully!";
            echo json_encode($response);
     }

    // Delete particular record from product table 
    function deleteProduct($intProductId){
        $this->load->model('CKzProductsModel');

        // To find record exist or not
        $row = $this->CKzProductsModel->fetchRow($intProductId);
        if(empty($row)){
            $response['status']=0;
            $response['msg']="Either Record deleted or not found!";
            echo json_encode($response);
            exit;
        }
        
        // Delete record
        $this->CKzProductsModel->delete($intProductId);

        // response to display record deleted
        $response['pro_id']=$intProductId;
        $response['status']= 1;
        $response['msg']= "Record deleted succeefully!";
        echo json_encode($response);
      }  
}
?>