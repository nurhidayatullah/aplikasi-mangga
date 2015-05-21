<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Role extends CI_Controller {
	function __construct(){
        parent::__construct();
		$this->load->helper('url');
		$this->load->library('my_encrypt');
		$this->load->helper('security');
		$this->load->model('admin/group_model');
		$this->load->model('admin/user_model');
		$this->load->model('admin/role_model');
	}
	function detail($group){
		if($this->security->xss_clean($group)){
			$group = $this->my_encrypt->decode($group);
			$data['role'] = $this->group_model->find_role($group);
			$this->load->view('admin/group/detail',$data);
		}
	}
	function add($id,$value){
		if($this->security->xss_clean($id)){
			$kode_rule = $this->my_encrypt->decode($id);
			$data['itambah'] = $value;
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
			$data['iupdate'] = $value;
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
			$data['idelete'] = $value;
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
				$data['itambah'] = 0;
				$data['iupdate'] = 0;
				$data['idelete'] = 0;
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