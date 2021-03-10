<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CAdminManager Extends CI_Controller{

    //Load the dashboard view
    public function index(){
        $this->load->view('admin/dashboard');
    }
}
?>