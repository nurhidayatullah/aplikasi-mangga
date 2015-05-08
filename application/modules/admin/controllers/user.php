<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
	function __construct(){
        parent::__construct();
		$this->load->helper('url');
		$this->load->library('my_encrypt');
		$this->load->model('admin/group_model');
		$this->load->model('admin/user_model');
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
	public function index($menu='',$msg=''){
		$data['menu'] = $menu;
		$data['priv'] = $this->menu_model->get_priv($menu,$this->session->userdata('kode_group'));
		$data['msg'] = $this->my_encrypt->decode($msg);
		$data['user'] = $this->user_model->All();
		$this->load->view('admin/user/page_user',$data);
	}
	function new_data($menu=''){
		$data['menu'] = $menu;
		$data['group'] = $this->group_model->All();
		$this->load->view('admin/user/new',$data);
	}
	public function save(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('first_name', 'First Name', 'required|trim|xss_clean');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required|trim|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|xss_clean|valid_email');
		$this->form_validation->set_rules('group', 'Group', 'required');
		$menu = $this->input->post('menu');
		if ($this->form_validation->run() == FALSE) { 
			$pesan['pesan'] = "error input : ".validation_errors();
			$pesan['jenis'] = $this->my_encrypt->encode(0);
			redirect(base_url('admin/user/index/'.$menu."/".$pesan));
		}else{
			$data['first_name'] = $this->input->post('first_name');
			$data['last_name'] = $this->input->post('last_name');
			$data['email'] = $this->input->post('email');
			$data['kode_group'] = $this->input->post('group');
			$data['create_at'] = date("Y-m-d H:s:i");
			$data['active'] = 0;
			$data['password'] = $this->my_encrypt->encode('12345');
			$result = $this->user_model->save($data); 
			if($result){
				$pesan = $this->my_encrypt->encode(1);
				redirect(base_url('admin/user/index/'.$menu."/".$pesan));
			}else{
				$pesan = $this->my_encrypt->encode(0);
				redirect(base_url('admin/user/index/'.$menu."/".$pesan));
			}
		}
	}
	public function edit($menu='',$id=''){
		if($this->security->xss_clean($id)){
			$data['menu'] = $menu;
			$data['user'] = $this->user_model->find($this->my_encrypt->decode($id));
			$data['group'] = $this->group_model->All();
			$this->load->view('admin/user/edit',$data);
		}
	}
	public function hapus($menu='',$id=''){
		if($this->security->xss_clean($id)){
			$result = $this->user_model->delete($this->my_encrypt->decode($id));
			$data['menu'] = $menu;
			if($result){
				$pesan = $this->my_encrypt->encode(1);
				redirect(base_url('admin/user/index/'.$data['menu']."/".$pesan));
			}else{
				$pesan = $this->my_encrypt->encode(0);
				redirect(base_url('admin/user/index/'.$data['menu']."/".$pesan));
			}
		}
	}
	public function actived($id,$val){
		$id = $this->my_encrypt->decode($id);
		if($this->security->xss_clean($id)){
			$data['kode_user'] = $id;
			$data['active'] = $val;
			$data['update_at'] = date("Y-m-d H:s:i");
			$result = $this->user_model->actived($data);
			echo $result;
		}
	}
	public function update($id){
		$id = $this->my_encrypt->decode($id);
		if($this->security->xss_clean($id)){
			$this->load->library('form_validation'); 
			$this->form_validation->set_rules('first_name', 'First Name', 'required|trim|xss_clean');
			$this->form_validation->set_rules('last_name', 'Last Name', 'required|trim|xss_clean');
			$this->form_validation->set_rules('email', 'Email', 'required|trim|xss_clean|valid_email');
			$this->form_validation->set_rules('group', 'Group', 'required');
			$menu = $this->input->post('menu');
			if ($this->form_validation->run() == FALSE) { 
				$pesan['pesan'] = "error input : ".validation_errors();
				$pesan['jenis'] = 0;
				redirect(base_url('admin/user/index/'.$menu.'/'.$pesan));
			}else{
				$data['kode_user'] = $id;
				$data['first_name'] = $this->input->post('first_name');
				$data['last_name'] = $this->input->post('last_name');
				$data['email'] = $this->input->post('email');
				$data['kode_group'] = $this->input->post('group');
				$data['update_at'] = date("Y-m-d H:s:i");
				$result = $this->user_model->update($data); 
				if($result){
					$pesan = $this->my_encrypt->encode(1);
					redirect(base_url('admin/user/index/'.$menu.'/'.$pesan));
				}else{
					$pesan = $this->my_encrypt->encode(0);
					redirect(base_url('admin/user/index/'.$menu.'/'.$pesan));
				}
			}
		}
	}
}
?>