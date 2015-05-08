<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_Controller extends MY_Controller {
	function __construct(){
        parent::__construct();
		$this->load->helper('url');
		$this->load->library('my_encrypt');
		$this->load->helper('security');
		$this->load->library('session');
		$this->load->model('login');
		$this->loged = $this->login->ceck_login();
		if(!$this->loged){
			redirect(base_url('admin/login'));
		}
		$this->load->view('admin/header');
		$this->load->view('admin/navbar');
		$this->load->model('admin/menu_model');
		$this->load->view('admin/sidebar_menu');
	}
}
?>