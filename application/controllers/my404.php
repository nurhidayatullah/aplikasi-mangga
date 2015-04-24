<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class My404 extends CI_Controller{
    function __construct(){
        parent::__construct(); 
        $this->load->helper('url');
    } 

    function index(){ 
        $this->output->set_status_header('404');
        $data['content'] = 'error_404';
        $this->load->view('404',$data);
    } 
}
?>