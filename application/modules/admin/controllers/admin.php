<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct(){
        parent::__construct();
		$this->load->helper('url');
	}
	public function index(){
		$this->load->view('admin/header');
		$this->load->view('admin/navbar');
		$this->load->model('admin/menu_model');
		$this->load->view('admin/sidebar_menu');
		$this->load->view('admin/index');
	}
	public function login(){
		$this->load->view('admin/login');
	}
}