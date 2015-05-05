<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu extends CI_Controller {

	function __construct(){
        parent::__construct();
		$this->load->helper('url');
		$this->load->library('my_encrypt');
		$this->load->helper('security');
		$this->load->view('admin/header');
		$this->load->view('admin/navbar');
		$this->load->model('admin/menu_model');
		$this->load->view('admin/sidebar_menu');
		$this->load->model('admin/menu_model');
	}
	public function index($msg=''){
		$data['msg'] = $this->my_encrypt->decode($msg);
		$data['menu'] = $this->menu_model->All();
		$this->load->view('admin/menu/page_menu',$data);
	}
	public function hapus($id){
		if($this->security->xss_clean($id)){
			$result = $this->menu_model->delete($this->my_encrypt->decode($id));
			if($result){
				$pesan = $this->my_encrypt->encode(1);
				redirect(base_url('admin/menu/index/'.$pesan));
			}else{
				$pesan = $this->my_encrypt->encode(0);
				redirect(base_url('admin/menu/index/'.$pesan));
			}
		}
	}
}
?>