<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Aplikasi_mangga extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
	}
	
	function index(){
		$data['content'] = "home";
		$menu = array(
			array('name'=>'Home','url'=>base_url(),'class'=>'active'),
			array('name'=>'Classification','url'=>base_url('classification'),'class'=>''),
		);
		$data['menu'] = $menu;
		$this->load->view('index',$data);
	}
}
?>