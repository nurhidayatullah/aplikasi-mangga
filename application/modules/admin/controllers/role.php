<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Role extends Admin_Controller {
	function __construct(){
        parent::__construct();
		$this->load->model('admin/group_model');
		$this->load->model('admin/user_model');
		$this->load->model('admin/role_model');
	}
	public function index($menu='',$msg=''){
		$data['priv'] = $this->menu_model->get_priv($menu,$this->session->userdata('kode_group'));
		$data['role'] = $this->role_model->All();
		$this->load->view('role/page_role',$data);
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