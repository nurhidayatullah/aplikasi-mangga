<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu extends Admin_Controller {

	function __construct(){
        parent::__construct();
	}
	public function index($menu='',$msg=''){
		$data['url'] = $menu;
		$data['priv'] = $this->menu_model->get_priv($menu,$this->session->userdata('kode_group'));
		$data['menu'] = $this->menu_model->All();
		$this->load->view('admin/menu/page_menu',$data);
	}
	public function new_data($url=''){
		$data['url'] = $url;
		$data['menu'] = $this->menu_model->get_parent(0);
		$this->load->view('admin/menu/new',$data);
	}
	public function edit($url='',$id=''){
		if($this->security->xss_clean($id)){
			$data['url'] = $url;
			$data['menu'] = $this->menu_model->get_parent(0);
			$data['data'] = $this->menu_model->getById($this->my_encrypt->decode($id));
			$this->load->view('admin/menu/edit',$data);
		}
	}
	function save(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim|xss_clean');
		$this->form_validation->set_rules('controller', 'Controller', 'trim|xss_clean');
		$url = $this->input->post('url');
		if ($this->form_validation->run() == FALSE) { 
			$pesan['pesan'] = "error input : ".validation_errors();
			$pesan['jenis'] = $this->my_encrypt->encode(0);
			redirect(base_url('admin/menu/index/'.$url.'/'.$pesan));
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
				redirect(base_url('admin/menu/index/'.$url.'/'.$pesan));
			}else{
				$pesan = $this->my_encrypt->encode(0);
				redirect(base_url('admin/menu/index/'.$url.'/'.$pesan));
			}
		}
	}
	function update(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim|xss_clean');
		$this->form_validation->set_rules('kode', 'Kode', 'required|trim|xss_clean');
		$this->form_validation->set_rules('controller', 'Controller', 'trim|xss_clean');
		$url = $this->input->post('url');
		if ($this->form_validation->run() == FALSE) { 
			$pesan['pesan'] = "error input : ".validation_errors();
			$pesan['jenis'] = $this->my_encrypt->encode(0);
			redirect(base_url('admin/menu/index/'.$url.'/'.$pesan));
		}else{
			$child = $this->input->post('child');
			if(!empty($child)){
				$data['kode_parent'] = $this->input->post('parent');
			}else{
				$data['kode_parent'] = 0;
			}
			$data['nama_menu'] = $this->input->post('nama');
			$data['kode_menu'] = $this->input->post('kode');
			$data['controller'] = $this->input->post('controller');
			$data['update_at'] = date("Y-m-d H:s:i");
			$menu = $this->menu_model->update($data); 
			if($menu){
				$pesan = $this->my_encrypt->encode(1);
				redirect(base_url('admin/menu/index/'.$url.'/'.$pesan));
			}else{
				$pesan = $this->my_encrypt->encode(0);
				redirect(base_url('admin/menu/index/'.$url.'/'.$pesan));
			}
		}
	}
	public function hapus($url='',$id=''){
		if($this->security->xss_clean($id)){
			$result = $this->menu_model->delete($this->my_encrypt->decode($id));
			if($result){
				$pesan = $this->my_encrypt->encode(1);
				redirect(base_url('admin/menu/index/'.$url.'/'.$pesan));
			}else{
				$pesan = $this->my_encrypt->encode(0);
				redirect(base_url('admin/menu/index/'.$url.'/'.$pesan));
			}
		}
	}
}
?>