<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Role extends CI_Controller {

	function __construct(){
        parent::__construct();
		$this->load->helper('url');
		$this->load->library('my_encrypt');
		$this->load->model('admin/group_model');
		$this->load->model('admin/user_model');
		$this->load->model('admin/role_model');
		$this->load->helper('security');
		$this->load->view('admin/header');
		$this->load->view('admin/navbar');
		$this->load->model('admin/menu_model');
		$this->load->view('admin/sidebar_menu');
		
	}
	function index(){
		$data['role'] = $this->role_model->All();
		$this->load->view('role/page_role',$data);
	}
	function add($id,$value){
		if($this->security->xss_clean($id)){
			$kode_rule = $this->my_encrypt->decode($id);
			$data['add'] = $value;
			$data['update_at'] = date("Y-m-d H:s:i");
			$result = $this->role_model->update($data,$kode_rule);
			if($result){
				echo $value;
			}
		}
	}
	function edit($id,$value){
		if($this->security->xss_clean($id)){
			$kode_rule = $this->my_encrypt->decode($id);
			$data['edit'] = $value;
			$data['update_at'] = date("Y-m-d H:s:i");
			$result = $this->role_model->update($data,$kode_rule);
			if($result){
				echo $value;
			}
		}
	}
	function delete($id,$value){
		if($this->security->xss_clean($id)){
			$kode_rule = $this->my_encrypt->decode($id);
			$data['delete'] = $value;
			$data['update_at'] = date("Y-m-d H:s:i");
			$result = $this->role_model->update($data,$kode_rule);
			if($result){
				echo $value;
			}
		}
	}
	function view($id,$value){
		if($this->security->xss_clean($id)){
			$kode_rule = $this->my_encrypt->decode($id);
			$data['view'] = $value;
			if($data['view']==0){
				$data['add'] = 0;
				$data['edit'] = 0;
				$data['delete'] = 0;
				$data['update_at'] = date("Y-m-d H:s:i");
				$result = $this->role_model->update($data,$kode_rule);
				if($result){
					echo $value;
				}
			}else{
				$data['update_at'] = date("Y-m-d H:s:i");
				$result = $this->role_model->update($data,$kode_rule);
				if($result){
					echo $value;
				}
			}
			
		}
	}
}
?>