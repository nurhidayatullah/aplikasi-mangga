<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	function __construct(){
        parent::__construct();
		$this->load->helper('url');
		$this->load->library('my_encrypt');
		$this->load->library('session');
		$this->load->model('login');
		$this->loged = $this->login->ceck_login();
	}
	public function index(){
		if($this->loged){
			$this->load->view('admin/header');
			$this->load->view('admin/navbar');
			$this->load->model('admin/menu_model');
			$this->load->view('admin/sidebar_menu');
			$this->load->view('admin/index');
		}else{
			redirect(base_url('admin/login'));
		}
	}
	public function login($msg=''){
		$data['msg'] = $this->my_encrypt->decode($msg);
		$this->load->view('admin/login',$data);
	}
	function do_login(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'required|email|trim|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'required|trim|xss_clean');
		if ($this->form_validation->run() == FALSE) { 
			$pesan = $this->my_encrypt->encode("error input : ".validation_errors());
			redirect(base_url('admin/login/'.$pesan));
		}else{
			$data['email'] = $this->input->post('email');
			$password = $this->input->post('password');
			$data['password'] = $this->my_encrypt->encode($password);
			$result = $this->login->do_login($data); 
			if(isset($result)){
				foreach($result as $data){
					$user['kode_user'] = $data['kode_user'];
					$user['first_name'] = $data['first_name'];
					$user['last_name'] = $data['last_name'];
					$user['email'] = $data['email'];
					$user['password'] = $data['password'];
					$user['kode_group'] = $data['kode_group'];
				}
				$this->session->set_userdata($user);
				redirect(base_url('admin'));
			}else{
				$pesan = $this->my_encrypt->encode('Password atau Email Salah');
				redirect(base_url('admin/login/'.$pesan));
			}
		}
	}
	function logout(){
		$this->session->sess_destroy();
		redirect(base_url('admin'));
	}
}