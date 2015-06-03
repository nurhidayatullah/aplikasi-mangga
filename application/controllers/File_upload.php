<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class File_upload extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		$this->load->library('image_proc');
	}
	function upload(){
		$config['upload_path'] = './assets/data-latih/';
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
				$conf['height'] = round($tinggi/2);
				$lebar = $width % 1000;
				$conf['width'] = round($lebar/2);
			}else{
				$conf['width'] = round($width/2);
				$conf['height'] = round($height/2);
			}
			$conf['maintain_ratio'] = TRUE;
			$this->load->library('image_lib', $conf);
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
	function get_data(){
		$data = $_POST['dt'];
		$x = json_decode($data);
		$this->image_proc->read_file($x->full_path);
		$histogram = $this->image_proc->histogram();
		$means = $this->image_proc->get_means($histogram);
		$varian = $this->image_proc->get_varian($means);
		$deviasi = $this->image_proc->get_deviasi($varian);
		$fitur = array(
			'jenis_mangga' => $x->jenis,
			'means_g' => round($means['G'],4),
			'standev_g' => round($deviasi['G'],4),
			'varian_g' => round($varian['G'],4),
			'circularity' => round($x->circularity,4),
			'compactness' => round($x->compactness,4),
			'file' => $x->file_name
		);
		echo json_encode($fitur);
	}
}
?>
