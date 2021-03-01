<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CManageKzProducts Extends CI_Controller{
    //Load list of products
    public function index(){
        $this->load->model('CProductsModel');
        // fetch all records of products table in $row
        $rows=$this->CProductsModel->fetchAllproducts();
        $data['rows']=$rows;
        
       $this->load->view('admin/product/listProduct',$data);
    }

    // load addProduct view
    function addProduct(){
        // load data for category select tag in addProduct view 
        $this->load->model('CCategoryModel');
        $rows_category=$this->CCategoryModel->fetchAllCategory();
        $data['rows_category']=$rows_category;

        // load data for brand select tag in addProduct view 
         $this->load->model('CBrandModel');
         $rows_brand=$this->CBrandModel->fetchAllBrand();
         $data['rows_brand']=$rows_brand;

        //loaded $data array passed to addProduct
        $this->load->view('admin/product/addProduct.php',$data);
    }

    // save or insert record in product table
    public function saveProduct(){
        // file configuration and restrictions to save
		$config['upload_path']          = './productImages/';
        $config['allowed_types']        = 'jpeg|jpg|png';

        //loading the file data to library
        $this->load->library('upload', $config);

        //initilizing config again
        $this->upload->initialize($config);

        // it check file uploaded or not
        if(!$this->upload->do_upload("file")){
            $error = array('error' => $this->upload->display_errors());
            $response['status']=0;
            $response['error']=$error;
            echo json_encode($response);
        }else{
            // $data = array('upload_data' => $this->upload->data()); // it will show all information about a file

            // Get data about the file
            $uploadData = $this->upload->data(); 
            // name of the file
            $filename = $uploadData['file_name']; 

             //save entries to db
            $this->load->model('CProductsModel');

            $formArray=array();
            $formArray['name']=$this->input->post('product');
            $formArray['price']=$this->input->post('price');
            $formArray['quantity']=$this->input->post('quantity');
            $formArray['brand_id']=$this->input->post('brand');
            $formArray['cat_id']=$this->input->post('category');
            $formArray['image']=$filename;
            $formArray['description']=$this->input->post('desc');
            $this->CProductsModel->create($formArray);

            // response to display operation success
            $response['status']=1;
            $response['name']=$formArray['name'];
            echo json_encode($response);
        }
     }

     // this will return edit form
     function getProduct($Id){
        // for display category in select tag
        $this->load->model('CCategoryModel');
        $rows_category=$this->CCategoryModel->fetchAllCategory();
        $data['rows_category']=$rows_category;

        // for display brand in select tag
        $this->load->model('CBrandModel');
        $rows_brand=$this->CBrandModel->fetchAllBrand();
         $data['rows_brand']=$rows_brand;

        //fetch particular record
        $this->load->model('CProductsModel');
        $row = $this->CProductsModel->fetchRow($Id);
        $data['row']=$row; 
        $html = $this->load->view('admin/product/editProduct.php',$data,true);

        // html response loaded 
        $response['html']=$html;
        echo json_encode($response);
     }

     // update particular record in products table
     function  updateProduct(){
        $this->load->model('CProductsModel');

        // to find record exists or not
        $intProductId= $this->input->post('pro_id');
        $row = $this->CProductsModel->fetchRow($intProductId);
        if(empty($row)){
            $response['status']=0;
            $response['msg']="Either Record deleted or not found!";
            echo json_encode($response);
            exit;
        }

        // file configuration and restrictions to save
		$config['upload_path']          = './productImages/';
        $config['allowed_types']        = 'jpeg|jpg|png';

        //loading the file data to library
        $this->load->library('upload', $config);

        //initilizing config again
        $this->upload->initialize($config);

        // its check file uploaded or not
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
            // name of the file
            $filename = $uploadData['file_name']; 

            //previous image to delete from folder
            $oldImage=$this->input->post('oldImage');
            $filePath="productImages/".$oldImage;
            if(file_exists($filePath)) {
            unlink($filePath);  //remove old file
            }

            //save entries to db
            date_default_timezone_set("Asia/Kolkata");
            $formArray=array();
            $formArray['name']=$this->input->post('product');
            $formArray['price']=$this->input->post('price');
            $formArray['quantity']=$this->input->post('quantity');
            $formArray['brand_id']=$this->input->post('brand');
            $formArray['cat_id']=$this->input->post('category');
            $formArray['image']=$filename;
            $formArray['modified_date']=date("Y-m-d h:i:sa");;
            $formArray['description']=$this->input->post('desc');
            $intProductIdResponse = $this->CProductsModel->update($intProductId,$formArray); 
            
            // fetch update record
            $row=$this->CProductsModel->fetchRow($intProductIdResponse);

            // particular record loaded in response to reflect changes in listView of product 
            $response['row']=$row; 
            // response to display success
            $response['status']=1;
            $response['msg']= "Record updated succeefully!";
            // updated image to load in view
            $response['newImage']=base_url().'productImages/'.$filename;
            echo json_encode($response);

        }
    }

    // update particular record without image
    function  updateProductWithoutImage(){
            $this->load->model('CProductsModel');

            // to find record exists or not
            $intProductId= $this->input->post('pro_id');
            $row = $this->CProductsModel->fetchRow($intProductId);
            if(empty($row)){
                $response['status']=0;
                $response['msg']="Either Record deleted or not found!";
                echo json_encode($response);
                exit;
            }
    
            //save entries to db
            date_default_timezone_set("Asia/Kolkata");
            $formArray=array();
            $formArray['name']=$this->input->post('product');
            $formArray['price']=$this->input->post('price');
            $formArray['quantity']=$this->input->post('quantity');
            $formArray['brand_id']=$this->input->post('brand');
            $formArray['cat_id']=$this->input->post('category');
            $formArray['modified_date']=date("Y-m-d h:i:sa");;
            $formArray['description']=$this->input->post('desc');
            $intProductIdResponse = $this->CProductsModel->update($intProductId,$formArray); 
            
            // to fetch updated record to reflect changes in view
            $row=$this->CProductsModel->fetchRow($intProductIdResponse);
            // fetched record loaded in response
            $response['row']=$row;  
            // response to display success
            $response['status']=1;
            $response['msg']= "Record updated succeefully!";
            echo json_encode($response);
     }

    // delete particular record from product table 
    function deleteProduct($intProductId){
        $this->load->model('CProductsModel');

        // to find record exist or not
        $row = $this->CProductsModel->fetchRow($intProductId);
        if(empty($row)){
            $response['status']=0;
            $response['msg']="Either Record deleted or not found!";
            echo json_encode($response);
            exit;
        }
        
        // delete record
        $this->CProductsModel->delete($intProductId);

        // response to display success
        $response['pro_id']=$intProductId;
        $response['status']= 1;
        $response['msg']= "Record deleted succeefully!";
        echo json_encode($response);
      }  
}
?>