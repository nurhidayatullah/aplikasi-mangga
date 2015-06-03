<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mangga extends Admin_Controller {

	function __construct(){
        parent::__construct();
		$this->load->model('mangga/mangga_model');
	}
	function index($menu='',$msg=''){
		$data['menu']=$menu;
		$data['priv'] = $this->menu_model->get_priv($menu,$this->session->userdata('kode_group'));
		$data['msg'] = $msg;
		$data['mangga'] = $this->mangga_model->All();
		$this->load->view('mangga/master-mangga/page',$data);
	}
	function biner(){
		$biner = array();
		$mangga = $this->mangga_model->get_biner();
		//print_r($mangga);
		for($x=0;$x<16;$x++){
			$str = "";
			for($y=strlen(decbin($x));$y<4;$y++){
				$str .= 0;
			}
			$nilai = $str.decbin($x);
			if (!in_array($nilai, $mangga)) {
				$biner[] = $nilai;
			}
		}
		return $biner;
	}
	public function hapus($menu='',$id=''){
		if($this->security->xss_clean($id)){
			$foto = $this->mangga_model->get_foto($this->my_encrypt->decode($id));
			if(isset($foto)){
				unlink('./assets/mangga/'.$foto);
			}
			$result = $this->mangga_model->delete($this->my_encrypt->decode($id));
			if($result){
				$pesan = 1;
				redirect(base_url('mangga/mangga/index/'.$menu.'/'.$pesan));
			}else{
				$pesan = 0;
				redirect(base_url('mangga/mangga/index/'.$menu.'/'.$pesan));
			}
		}
	}
	function new_data($menu=''){
		$data['menu'] = $menu;
		$data['msg'] = '';
		
		$data['biner'] = $this->biner();
		$this->load->view('mangga/master-mangga/new',$data);
	}
	function save(){
		$config['upload_path'] = './assets/mangga/';
		$config['allowed_types'] = 'jpg|png|jpeg';
		$this->load->library('upload', $config);
		if( ! $this->upload->do_upload('foto')){
			$data['msg'] = $this->upload->display_errors();
			$data['menu'] = $this->input->post('menu');
			$data['biner'] = $this->biner();
			$this->load->view('mangga/master-mangga/new',$data);
		}else{
			$upload = $this->upload->data();
			$this->load->library('form_validation');
			$this->form_validation->set_rules('nama', 'Nama', 'required|trim|xss_clean');
			$this->form_validation->set_rules('biner', 'Biner', 'required|trim|xss_clean');
			$url = $this->input->post('menu');
			if ($this->form_validation->run() == FALSE) { 
				$data['msg'] = "".validation_errors();
				$data['menu'] = $this->input->post('menu');
				$data['biner'] = $this->biner();
				$this->load->view('mangga/master-mangga/new',$data);
			}else{
				$data['nama_mangga'] = $this->input->post('nama');
				$data['biner'] = $this->input->post('biner');
				$data['foto'] = $upload['file_name'];
				$menu = $this->input->post('menu');
				$result = $this->mangga_model->add($data);
				if($result){
					$res = 1;
					redirect(base_url('mangga/mangga/index/'.$menu.'/'.$res));
				}else{
					$res = 0;
					redirect(base_url('mangga/mangga/index/'.$menu.'/'.$res));
				}
			}
		}
	}
}
?>