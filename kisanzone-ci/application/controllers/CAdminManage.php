<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CAdminManage Extends CI_Controller{

    //Load the login view
    public function index(){
        $this->load->view('admin/adminLogin');
    }

    public function adminDashboard(){
        //the user is not logged in, redirected to login page!
        if (empty($this->session->userdata('admin_id')))
        {
            redirect(base_url().'CAdminManage/index'); 
        }

        // Load Models
        $this->load->model('CBrandModel');
        $this->load->model('CCategoryModel');
        $this->load->model('CProductsModel');
        $this->load->model('CCustomersModel');

        $data = array();

        //  Storing count of category, products, brands and customers to show on dashbaord
        $data['brand'] = $this->CBrandModel->fetchCount();
        $data['category'] = $this->CCategoryModel->fetchCount();
        $data['products'] = $this->CProductsModel->fetchCount();
        $data['customers'] = $this->CCustomersModel->fetchCount();

        $this->load->view('admin/dashboard', $data);
    }

    // Load login view for admin
    function adminLogin(){
        $this->load->model('CAdminModel');

        $formArray=array();
 
        $formArray['username'] = $this->input->post('username');
        $formArray['password'] = $this->input->post('password');

        //  this will fetch record if username and password match
        $row = $this->CAdminModel->fetchAdminLoginRow($formArray);

        // It check Is $row empty  aand return response to show login status
        if(empty($row)){
            $response['status'] = 0; 
            $response['msg'] = 'Login failed!';
        }else{
            //declaring session  
            $this->session->set_userdata(array('username'=>$row['username'],
            'admin_id' => $row['admin_id']));

            $response['status']= 1;
            $response['msg'] = 'Login successful!';
        }
        
        // Load response
        echo json_encode($response);  
        
    }

    // Destroy session
    function logout(){
        $this->session->sess_destroy();
        redirect(base_url().'CAdminManage/index');
    }
}
?>