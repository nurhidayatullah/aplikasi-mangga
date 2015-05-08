<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Group extends CI_Controller {

	function __construct(){
        parent::__construct();
		$this->load->helper('url');
		$this->load->library('my_encrypt');
		$this->load->model('admin/group_model');
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
		$data['menu']=$menu;
		$data['priv'] = $this->menu_model->get_priv($menu,$this->session->userdata('kode_group'));
		$data['msg'] = $msg;
		$data['group'] = $this->group_model->All();
		$this->load->view('admin/group/page_group',$data);
	}
	function new_data($menu=''){
		$data['menu'] = $menu;
		$this->load->view('admin/group/new',$data);
	}
	public function save(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim|xss_clean');
		$menu = $this->input->post('menu');
		if ($this->form_validation->run() == FALSE) { 
			$pesan['pesan'] = "error input : ".validation_errors();
			$pesan['jenis'] = 0;
			redirect(base_url('admin/group/index/'.$menu.'/'.$pesan));
		}else{
			$data['nama_group'] = $this->input->post('nama');
			$data['create_at'] = date("Y-m-d H:s:i");
			$result = $this->group_model->save($data); 
			if($result){
				$pesan = 1;
				redirect(base_url('admin/group/index/'.$menu.'/'.$pesan));
			}else{
				$pesan = 0;
				redirect(base_url('admin/group/index/'.$menu.'/'.$pesan));
			}
		}
	}
	public function edit($menu='',$id=''){
		if($this->security->xss_clean($id)){
			$data['menu'] = $menu;
			$data['group'] = $this->group_model->find($this->my_encrypt->decode($id));
			$this->load->view('admin/group/edit',$data);
		}
	}
	public function hapus($menu='',$id=''){
		if($this->security->xss_clean($id)){
			$result = $this->group_model->delete($this->my_encrypt->decode($id));
			if($result){
				$pesan = 1;
				redirect(base_url('admin/group/index/'.$menu.'/'.$pesan));
			}else{
				$pesan = 0;
				redirect(base_url('admin/group/index/'.$menu.'/'.$pesan));
			}
		}
	}
	public function update($id){
		$id = $this->my_encrypt->decode($id);
		if($this->security->xss_clean($id)){
			$this->load->library('form_validation'); 
			$this->form_validation->set_rules('nama', 'Nama', 'required|trim|xss_clean');
			$menu = $this->input->post('menu');
			if ($this->form_validation->run() == FALSE) { 
				$pesan['pesan'] = "error input : ".validation_errors();
				$pesan['jenis'] = 0;
				redirect(base_url('admin/group/index/'.$menu.'/'.$pesan));
			}else{
				$data['kode_group'] = $id;
				$data['nama_group'] = $this->input->post('nama');
				$data['update_at'] = date("Y-m-d H:s:i");
				$result = $this->group_model->update($data); 
				if($result){
					$pesan = 1;
					redirect(base_url('admin/group/index/'.$menu.'/'.$pesan));
				}else{
					$pesan = 0;
					redirect(base_url('admin/group/index/'.$menu.'/'.$pesan));
				}
			}
		}
	}
}
?>