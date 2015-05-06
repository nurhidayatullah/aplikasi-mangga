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
	public function new_data(){
		$data['menu'] = $this->menu_model->get_menu(0);
		$this->load->view('admin/menu/new',$data);
	}
	function save(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim|xss_clean');
		$this->form_validation->set_rules('controller', 'Controller', 'trim|xss_clean');
		if ($this->form_validation->run() == FALSE) { 
			$pesan['pesan'] = "error input : ".validation_errors();
			$pesan['jenis'] = $this->my_encrypt->encode(0);
			redirect(base_url('admin/menu/index/'.$pesan));
		}else{
			$child = $this->input->post('child');
			if(!empty($child)){
				$data['kode_parent'] = $this->input->post('parent');
			}else{
				$data['kode_parent'] = 0;
			}
			$data['nama_menu'] = $this->input->post('nama');
			$data['controller'] = $this->input->post('controller');
			$data['create_at'] = date("Y-m-d H:s:i");
			$menu = $this->menu_model->save($data); 
			$this->load->model('group_model');
			$this->load->model('role_model');
			$group = $this->group_model->All();
			$r = "";
			foreach($group as $x){
				$dt['kode_group'] = $x['kode_group'];
				$dt['kode_menu'] = $menu;
				$dt['create_at'] = date("Y-m-d H:s:i");
				$res = $this->role_model->save($dt);
				if($res){
					$r .= 1;
				}else{
					$r .= 0;
				}
			}
			$ck = strpos($r,"0");
			if($ck===FALSE){
				$pesan = $this->my_encrypt->encode(1);
				redirect(base_url('admin/menu/index/'.$pesan));
			}else{
				$pesan = $this->my_encrypt->encode(0);
				redirect(base_url('admin/menu/index/'.$pesan));
			}
		}
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