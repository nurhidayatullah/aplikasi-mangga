<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Classification extends CI_Controller{
	var $data;
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
			$mangga = $this->mangga_model->getDataByBiner(substr($biner,1,3));
			$data['id'] = $biner;
			$result = ($mangga) ? $mangga : $salah;
		}
		$data['data'] = ($biner)?$result:null;
		$this->load->view('index',$data);
	}
	
	function detail($biner = null){
		$data['content'] = "detail";
		$data['menu'] = array(
			array('name'=>'Home','url'=>base_url(),'class'=>''),
			array('name'=>'Classification','url'=>base_url('classification'),'class'=>'active'),
		);
		$id = substr($biner,4,10);
		$data['biner'] = $biner;
		$this->load->model('mangga/mangga_model');
		$data['data'] = $this->mangga_model->getDetailDataUji($id);
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
			$this->image_proc->read_file($upload['file_path'],$upload['file_name']);
			$upload['history'] = $upload['file_name'];
			$upload['history'] .= ','.$this->image_proc->norm();
			$upload['history'] .= ','.$this->image_proc->set_area();
			$upload['history'] .= ','.$this->image_proc->set_keliling();
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
		$data['means_g']	= ($data['means_g']-25.7141)/(204.9292-25.7141);
		$data['varian_g']	= ($data['varian_g']-157.1063)/(18604.4907-157.1063);
		$data['standev_g']	= ($data['standev_g']-12.5342)/(136.3983-12.5342);
		$data['circularity']= $data['circularity'];
		$data['compactness']= ($data['compactness']-32.4717)/(940.0924-32.4717);
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
			'nama_file'=>$data['file'],
			'history'=>$data['history']
		);
		$id = $this->mangga_model->saveLog($log);
		echo $result.$id;
	}
	function normalizationDataLatih(){
		// max mean_g 204.9292,momen 18604.4907,dev 136.3983,compactness 940.0924,circularity 0.4665
		// min mean 25.7141,momen 157.1063,dev 12.5342,compactness 32.4717, circularity 0.0134
		$this->load->model('mangga/data_latih_model');
		$data_latih = $this->data_latih_model->All();
		foreach($data_latih as $dt){
			$data['mean_g'] 	= ($dt['mean_g']-25.7141)/(204.9292-25.7141);
			$data['momen_g']	= ($dt['momen_g']-157.1063)/(18604.4907-157.1063);
			$data['dev_g']		= ($dt['dev_g']-12.5342)/(136.3983-12.5342);
			$data['circularity']= $dt['circularity'];
			$data['compactness']= ($dt['compactness']-32.4717)/(940.0924-32.4717);
			$id = $dt['kode_data'];
			$this->data_latih_model->updateData($data,$id,'data_latih');
		}
	}
	function normalizationDataUji(){
		// max mean_g 204.9292,momen 18604.4907,dev 136.3983,compactness 940.0924
		// min mean 25.7141,momen 157.1063,dev 12.5342,compactness 32.4717
		$this->load->model('mangga/data_latih_model');
		$data_latih = $this->data_latih_model->AllDataUji();
		foreach($data_latih as $dt){
			$data['mean_g'] 	= ($dt['mean_g']-25.7141)/(204.9292-25.7141);
			$data['momen_g']	= ($dt['momen_g']-157.1063)/(18604.4907-157.1063);
			$data['dev_g']		= ($dt['dev_g']-12.5342)/(136.3983-12.5342);
			$data['circularity']= $dt['circularity'];
			$data['compactness']= ($dt['compactness']-32.4717)/(940.0924-32.4717);
			$id = $dt['kode_data'];
			$this->data_latih_model->updateData($data,$id,'data_uji');
		}
	}
	function testing(){
		$this->load->model('mangga/data_latih_model');
		$data_latih = $this->data_latih_model->AllDataUji();
		$this->load->library('voted_perceptron');
		$this->load->model('voted/pelatihan_model');
		$vektor = $this->pelatihan_model->get_vektor();
		$benar = 0;
		foreach($data_latih as $dt){
			$data_uji = array($dt['mean_g'],$dt['momen_g'],$dt['dev_g'],$dt['compactness'],$dt['circularity']);
			$out = $this->voted_perceptron->classifier($data_uji,$vektor);
			$label = $dt['target'];
			$target = array();
			for($x = 0; $x < count($out); $x++){
				if($label){
					$target[$x] = ($label{$x}==1)?(int)$label{$x}:-1;
				}else{
					$target[$x] = ($out[$x]==1)?1:-1;
				}
				$out1[$x] = ($out[$x]==1)?1:0;
			}
			
			$class = array(
				'010'=>'Mangga Golek','011'=>'Mangga Manalagi',
				'100'=>'Mangga Madu','101'=>'Mangga Curut',
				'110'=>'Mangga Gadung','000'=>'Bukan Mangga','111'=>'Bukan Mangga'
				);

			$out_biner = implode($out1);
			$out = implode($out);
			$target = implode($target);
			//echo $target." ".$out."<br/>";
			$hasil = ($out==$target)?1:0;
			$result['data_id']	= $dt['kode_data'];
			$result['output']	= $out;
			$result['target']	= $target;
			$result['result']	= $hasil;
			$result['target_name'] = ($label)?$class[$label]:$class['000'];
			$result['output_name'] = (array_key_exists($out_biner,$class))?$class[$out_biner]:$class['000'];
			$this->data_latih_model->saveUji($result);
			$benar = ($hasil)?$benar+1:$benar;
		}
		echo "done <br/>";
		$akurasi = ($benar/count($data_latih))*100;
		echo 'Akurasi : '.$akurasi." % <br/>";
		echo 'Total Benar : '.$benar." Data <br/>";
		echo 'Total Data : '.count($data_latih)." Data <br/>";
		
	}
}
?>