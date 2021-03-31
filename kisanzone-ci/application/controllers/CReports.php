<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CReports Extends CI_Controller{

    function  __construct(){
        parent::__construct();

        // the admin is not logged in, redirected to login page!
        if (empty($this->session->userdata('admin_id')))
        {
            redirect(base_url().'CAdminManage/index'); 
        }

        // // Load cart library
        // $this->load->library('cart');
    }

    public function index(){
       echo "not in use";
    }

    // Fetch records for product inventory
    public function productsInventory(){

        $this->load->model('CKzProductsModel');

        // Create array object
        $data = array();

        // Fetch all active products
        $data['rows'] = $this->CKzProductsModel->productsInventory();

        $this->load->view('admin/reports/productsInventory', $data);
    }

    // Fetch records for users inventory
    public function usersInventory(){

        $this->load->model('CKzCustomersModel');

        // Create array object
        $data = array();

        // Fetch all active products
        $data['rows'] = $this->CKzCustomersModel->usersInventory();

        $this->load->view('admin/reports/usersInventory', $data);
    }

    // Fetch records for Monthly sale of products
    public function monthlySaleOfProducts(){
        $this->load->model('CKzProductsModel');

        // Create array object
        $data = array();

        // Fetch all active records
        $data['rows'] = $this->CKzProductsModel->monthlySaleOfProducts();

        $this->load->view('admin/reports/monthlySaleOfProducts', $data);
    }

    // Fetch records for Categorywise monthly sale of products
    public function categorywiseMonthlySaleOfProducts(){
        $this->load->model('CKzProductsModel');

        // Create array object
        $data = array();

        // Fetch all active records
        $data['rows'] = $this->CKzProductsModel->categorywiseMonthlySaleOfProducts();

        $this->load->view('admin/reports/categorywiseMonthlySaleOfProducts', $data);
    }

    // Fetch records for Users Feedback
    public function usersFeedback(){
        $this->load->model('CKzContactUsModel');

        // Create array object
        $data = array();

        // Fetch all records
        $data['rows'] = $this->CKzContactUsModel->fetchUsersFeedback();

        $this->load->view('admin/reports/usersFeedback', $data);
    }

    // Fetch records for orderes
    public function ordersList(){
        $this->load->model('CKzOrdersModel');

        // Create array object
        $data = array();

        // Fetch all records
        $data['rows'] = $this->CKzOrdersModel->fetchOrdersListForAdmin();

        $this->load->view('admin/reports/ordersList', $data);
    }

    // Fetch records of cancelled orders
    public function cancelledOrdersList(){
        $this->load->model('CKzOrdersModel');

        $data = array();

        // Fetch all records
        $data['rows'] = $this->CKzOrdersModel->fetchCancelledOrdersListForAdmin();

        $this->load->view('admin/reports/cancelledOrdersList', $data);
    }    
    
    // Fetch records of most viewed products
    public function mostViewedProducts(){
        $this->load->model('CKzRecentlyViewedProductsModel');

        // Create array object
        $data = array();

        // Fetch all active products
        $data['rows'] = $this->CKzRecentlyViewedProductsModel->fetchMostViewedProductsRows();
        
        $this->load->view('admin/reports/mostViewedProducts', $data);
    }
}
?>