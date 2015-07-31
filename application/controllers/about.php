<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class About extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
	}
	
	function index(){
		$data['content'] = "about";
		$menu = array(
			array('name'=>'Home','url'=>base_url(),'class'=>''),
			array('name'=>'Classification','url'=>base_url('classification'),'class'=>''),
			array('name'=>'About Us','url'=>base_url('about'),'class'=>'active'),
		);
		$data['menu'] = $menu;
		$this->load->view('index',$data);
	}
}
?>