<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Group extends CI_Controller {

	function __construct(){
        parent::__construct();
		$this->load->helper('url');
		$this->load->library('my_encrypt');
		$this->load->model('admin/group_model');
		$this->load->helper('security');
	}
	public function index($msg=''){
		$data['msg'] = $msg;
		$data['group'] = $this->group_model->All();
		$this->load->view('admin/group/page_group',$data);
	}
	function new_data(){
		$this->load->view('admin/group/new');
	}
	public function save(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim|xss_clean');
		if ($this->form_validation->run() == FALSE) { 
			$pesan['pesan'] = "error input : ".validation_errors();
			$pesan['jenis'] = 0;
			redirect(base_url('admin/group/index/'.$pesan));
		}else{
			$data['nama_group'] = $this->input->post('nama');
			$data['create_at'] = date("Y-m-d H:s:i");
			$result = $this->group_model->save($data); 
			if($result){
				$pesan = 1;
				redirect(base_url('admin/group/index/'.$pesan));
			}else{
				$pesan = 0;
				redirect(base_url('admin/group/index/'.$pesan));
			}
		}
	}
	public function edit($id=''){
		if($this->security->xss_clean($id)){
			$data['group'] = $this->group_model->find($this->my_encrypt->decode($id));
			$this->load->view('admin/group/edit',$data);
		}
	}
	public function hapus($id=''){
		if($this->security->xss_clean($id)){
			$result = $this->group_model->delete($this->my_encrypt->decode($id));
			if($result){
				$pesan = 1;
				redirect(base_url('admin/group/index/'.$pesan));
			}else{
				$pesan = 0;
				redirect(base_url('admin/group/index/'.$pesan));
			}
		}
	}
	public function update($id){
		$id = $this->my_encrypt->decode($id);
		if($this->security->xss_clean($id)){
			$this->load->library('form_validation'); 
			$this->form_validation->set_rules('nama', 'Nama', 'required|trim|xss_clean');
			if ($this->form_validation->run() == FALSE) { 
				$pesan['pesan'] = "error input : ".validation_errors();
				$pesan['jenis'] = 0;
				redirect(base_url('admin/group/index/'.$pesan));
			}else{
				$data['kode_group'] = $id;
				$data['nama_group'] = $this->input->post('nama');
				$data['update_at'] = date("Y-m-d H:s:i");
				$result = $this->group_model->update($data); 
				if($result){
					$pesan = 1;
					redirect(base_url('admin/group/index/'.$pesan));
				}else{
					$pesan = 0;
					redirect(base_url('admin/group/index/'.$pesan));
				}
			}
		}
	}
}
?>