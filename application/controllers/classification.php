<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Classification extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
	}
	
	function index($biner=null){
		$data['content'] = "klasifikasi";
		$menu = array(
			array('name'=>'Home','url'=>base_url(),'class'=>''),
			array('name'=>'Classification','url'=>base_url('classification'),'class'=>'active'),
		);
		$data['menu'] = $menu;
		
		$this->load->model('mangga/mangga_model');
		$salah = array(
			'nama_mangga'	=>'Not Found',
			'foto'			=>'lady.png',
			'keterangan'	=>'Jenis daun tidak dikenali.'
		);
		if($biner){
			$mangga = $this->mangga_model->getDataByBiner(substr($biner,1,5));
			$result = ($mangga) ? $mangga : $salah;
		}
		$data['data'] = ($biner)?$result:null;
		$this->load->view('index',$data);
	}
	
	function get_vektor(){
		$this->load->model('voted/pelatihan_model');
		$v = $this->pelatihan_model->get_vektor();
		echo json_encode($v);
	}
	function upload(){
		$config['upload_path'] = './assets/data-uji/';
		$config['allowed_types'] = 'jpg|png|jpeg';
		$this->load->library('upload', $config);
		if($this->upload->do_upload()){
			$upload = $this->upload->data();
			list($width, $height, $type, $attr) = getimagesize($upload['full_path']);
			$conf['image_library'] = 'gd2';
			$conf['source_image'] = $upload['full_path'];
			$conf['create_thumb'] = FALSE;
			if($width > 1000 || $height > 1000){
				$tinggi = $height % 1000;
				$conf['height'] = ($tinggi>500)?round($tinggi/2):($tinggi+500)/2;
				$lebar = $width % 1000;
				$conf['width'] = ($lebar>500)?round($lebar/2):($lebar+500)/2;
			}else{
				$conf['width'] = ($width>500)?round($width/2):($width+500)/2;
				$conf['height'] = ($height>500)?round($height/2):($height+500)/2;
			}
			$conf['maintain_ratio'] = TRUE;
			$this->load->library('image_lib', $conf);
			$this->load->library('image_proc');
			$upload['status'] = 1;
			$upload['jenis'] = $this->input->post('jenis');
			$this->image_lib->resize();
			$this->image_proc->read_file($upload['full_path']);
			$this->image_proc->norm();
			$this->image_proc->set_area();
			$this->image_proc->set_keliling();
			$upload['circularity'] = $this->image_proc->get_circularity();
			$upload['compactness'] = $this->image_proc->get_compactness();
			echo json_encode($upload);
		}else{
			$error = $this->upload->display_errors();
			$data['status'] = 0;
			$data['pesan'] = "<div class='alert alert-danger'>
			<button class='close' data-dismiss='alert'>x</button><strong>Gagal ! </strong>".$error." 
			</div>";
			echo json_encode($data);
		}
	}
	function calculate(){
		$data = $_POST['dta'];
		$vektor = $_POST['vektor'];
		$data_uji = array($data['means_g'],$data['varian_g'],$data['standev_g'],$data['compactness'],$data['circularity']);
		$this->load->library('voted_perceptron');
		$out = $this->voted_perceptron->classifier($data_uji,$vektor);
		$result = "1";
		$res = "";
		foreach($out as $o){
			if($o==-1){
				$result.='0';
				$res .="-1";
			}else if($o==1){
				$result .='1';
				$res .="1";
			}
		}
		$this->load->model('mangga/mangga_model');
		$log = array(
			'mean_g'=>$data['means_g'],
			'momen_g'=>$data['varian_g'],
			'dev_g'=>$data['standev_g'],
			'circularity'=>$data['circularity'],
			'compactness'=>$data['compactness'],
			'output'=>$res,
			'nama_file'=>$data['file']
		);
		$this->mangga_model->saveLog($log);
		echo $result;
	}
}
?>