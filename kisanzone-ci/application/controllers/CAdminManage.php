<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CAdminManage Extends CI_Controller{

    //Load the login view
    public function index(){
        $this->load->view('admin/adminLogin');
    }

    // Load adminDashBoard View
    public function adminDashboard(){
        //the user is not logged in, redirected to login page!
        if (empty($this->session->userdata('admin_id')))
        {
            redirect(base_url().'CAdminManage/index'); 
        }

        // Load Models
        $this->load->model('CKzBrandModel');
        $this->load->model('CKzCategoryModel');
        $this->load->model('CKzProductsModel');
        $this->load->model('CKzCustomersModel');

        $data = array();

        //  Storing count of category, products, brands and customers to show on dashbaord
        $data['brand'] = $this->CKzBrandModel->fetchCount();
        $data['category'] = $this->CKzCategoryModel->fetchCount();
        $data['products'] = $this->CKzProductsModel->fetchCount();
        $data['customers'] = $this->CKzCustomersModel->fetchCount();

        // Load view with passed data
        $this->load->view('admin/dashboard', $data);
        
    }

    // Load login view for admin
    function adminLogin(){
        $this->load->model('CKzAdminModel');

        // Create array object
        $formArray = array();
 
        $formArray['username'] = $this->input->post('username');
        $formArray['password'] = $this->input->post('password');

        //  This will fetch customer record if username and password match
        $row = $this->CKzAdminModel->fetchAdminLoginRow($formArray);

        // It check Is $row empty and return response to show login status
        if(empty($row)){
            $response['status'] = 0; 
            $response['msg'] = 'Login failed!';
        }else{
            // Declare session  
            $this->session->set_userdata(array('username'=>$row['username'],
            'admin_id' => $row['admin_id']));

            $response['status']= 1;
            $response['msg'] = 'Login successful!';
        }
        
        // Response in json
        echo json_encode($response);  
        
    }

    // Destroy session and redirected to Admin login
    function logout(){
        $this->session->sess_destroy();
        redirect(base_url().'CAdminManage/index');
    }
}
?>