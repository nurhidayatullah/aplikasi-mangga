<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends Admin_Controller {
	function __construct(){
        parent::__construct();
		$this->load->model('admin/group_model');
		$this->load->model('admin/user_model');
		
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
	public function change_profile($msg=''){
		$data['msg'] = $msg;
		$data['user'] = $this->user_model->find($this->session->userdata('kode_user'));
		$this->load->view('admin/user/change-profile',$data);
	}
	function update_profile(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('first_name', 'First Name', 'required|trim|xss_clean');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required|trim|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|xss_clean|valid_email');
		$this->form_validation->set_rules('old-password', 'Old Password', 'required|trim|xss_clean');
		$this->form_validation->set_rules('new-password', 'New Password', 'required|trim|xss_clean');
		$this->form_validation->set_rules('re-new', 'Rewrite Password', 'required|trim|xss_clean');
		if ($this->form_validation->run() == FALSE) { 
			$pesan = $this->my_encrypt->encode(validation_errors());
			redirect(base_url('admin/user/change_profile/'.$pesan));
		}else{
			$user = $this->user_model->find($this->session->userdata('kode_user'));
			$old_password = $this->my_encrypt->encode($this->input->post('old-password'));
			foreach($user as $data){
				$old_pass = $data['password'];
			}
			if($old_password==$old_pass){
				$data['new_pass'] = $this->input->post('new-password');
				$data['re_new'] = $this->input->post('re-new');
				if($data['new_pass']==$data['re_new']){
					$data['first_name'] = $this->input->post('first_name');
					$data['last_name'] = $this->input->post('last_name');
					$data['email'] = $this->input->post('email');
					$data['update_at'] = date("Y-m-d H:s:i");
					$data['password'] = $this->my_encrypt->encode($data['new_pass']);
					$result = $this->user_model->update_profile($data); 
					if($result){
						redirect(base_url('admin/admin'));
					}else{
						$pesan = $this->my_encrypt->encode('Something wrong..');
						redirect(base_url('admin/user/change_profile/'.$pesan));
					}
				}else{
					$pesan = $this->my_encrypt->encode('Your Rewrite New Password Incorrect..');
					redirect(base_url('admin/user/change_profile/'.$pesan));
				}
			}else{
				$pesan = $this->my_encrypt->encode('Your Old Password Incorrect..');
				redirect(base_url('admin/user/change_profile/'.$pesan));
			}
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