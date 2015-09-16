<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_latih extends Admin_Controller {

	function __construct(){
        parent::__construct();
		$this->load->model('mangga/data_latih_model');
	}
	public function index($menu='',$msg=''){
		$data['menu']=$menu;
		$data['priv'] = $this->menu_model->get_priv($menu,$this->session->userdata('kode_group'));
		$data['msg'] = $msg;
		$data['data_latih'] = $this->data_latih_model->All();
		$this->load->view('mangga/data-latih/page',$data);
	}
	function new_data($menu=''){
		$data['menu'] = $menu;
		$this->load->model('mangga/mangga_model');
		$data['mangga'] = $this->mangga_model->All();
		$this->load->view('mangga/data-latih/new',$data);
	}
	function save(){
		$data = $_POST['dta'];
		/* $data['means_g']	= ($data['means_g']-25.7141)/(204.9292-25.7141);
		$data['varian_g']	= ($data['varian_g']-157.1063)/(18604.4907-157.1063);
		$data['standev_g']	= ($data['standev_g']-12.5342)/(136.3983-12.5342);
		$data['circularity']= $data['circularity'];
		$data['compactness']= ($data['compactness']-32.4717)/(940.0924-32.4717); */
		$fitur = array(
			'kode_mangga' 	=> $data['jenis_mangga'],
			'mean_g' 		=> $data['means_g'],
			'dev_g' 		=> $data['standev_g'],
			'momen_g' 		=> $data['varian_g'],
			'circularity' 	=> $data['circularity'],
			'compactness' 	=>$data['compactness'],
			'nama_file' 	=> $data['file'],
			'history' 		=>$data['history']
		);
		$this->data_latih_model->save($fitur);
	}
	public function hapus($menu='',$id=''){
		if($this->security->xss_clean($id)){
			$foto = $this->data_latih_model->get_foto($this->my_encrypt->decode($id));
			if(isset($foto)){
				unlink('./assets/data-latih/'.$foto);
			}
			$result = $this->data_latih_model->delete($this->my_encrypt->decode($id));
			if($result){
				$pesan = 1;
				redirect(base_url('mangga/data_latih/index/'.$menu.'/'.$pesan));
			}else{
				$pesan = 0;
				redirect(base_url('mangga/data_latih/index/'.$menu.'/'.$pesan));
			}
		}
	}
}
?>