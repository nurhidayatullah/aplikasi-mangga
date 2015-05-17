<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_latih extends Admin_Controller {

	function __construct(){
        parent::__construct();
	}
	public function index($menu='',$msg=''){
		$data['menu']=$menu;
		$data['priv'] = $this->menu_model->get_priv($menu,$this->session->userdata('kode_group'));
		$data['msg'] = $msg;
	//	$data['group'] = $this->group_model->All();
		$this->load->view('mangga/data-latih/page',$data);
	}
	function new_data($menu=''){
		$data['menu'] = $menu;
		$this->load->view('mangga/data-latih/new',$data);
	}
	
}
?>