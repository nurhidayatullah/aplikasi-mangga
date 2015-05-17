<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class File_upload extends CI_Controller{
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
			$this->load->library('image_proc');
			$this->image_proc->norm($upload['file_path'],$upload['file_name']);
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
		$this->load->library('image_proc');
		$histogram = $this->image_proc->histogram($x->file_path,$x->file_name);
		$means = $this->image_proc->get_means($histogram);
		$varian = $this->image_proc->get_varian($x->file_path,$x->file_name,$means);
		$deviasi = $this->image_proc->get_deviasi($varian);
		$this->image_proc->set_keliling($x->full_path);
		$this->image_proc->set_area($x->full_path);
		$circularity = $this->image_proc->get_circularity($x->file_path,$x->file_name);
		$compactness = $this->image_proc->get_compactness($x->full_path);
		$fitur = array(
			'jenis_mangga' => $x->jenis,
			'means_r' => $means['R'],
			'means_g' => $means['G'],
			'means_b' => $means['B'],
			'standev_r' => $deviasi['R'],
			'standev_g' => $deviasi['G'],
			'standev_b' => $deviasi['B'],
			'circularity' => $circularity,
			'compactness' =>$compactness,
			'file' => $x->file_name
		);
	//	$result = $this->beras_model->Add($fitur);
		if(1){
			$hasil = 1;
		}else{
			$hasil = 0;
		}
		echo json_encode($hasil);
	}
}
?>
