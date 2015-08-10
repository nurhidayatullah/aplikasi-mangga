<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Pelatihan extends CI_Controller{
	var $id = 26;
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('login');
		$this->loged = $this->login->ceck_login();
		if(!$this->loged){
			redirect(base_url('admin/login'));
		}
		$this->load->model('admin/menu_model');
	}
	function index($menu='',$msg=''){
		$data['menu'] = $this->id;
		$data['priv'] = $this->menu_model->get_priv($this->id,$this->session->userdata('kode_group'));
		$data['msg'] = $msg;
		$data['k'] = 1;
		$this->load->view('admin/header');
		$this->load->view('admin/navbar');
		$this->load->model('admin/menu_model');
		$this->load->view('admin/sidebar_menu');
		$this->load->model('log_model');
		$last = $this->log_model->getLast();
		if($last){
			$data['tanggal'] 	= $last['tanggal'];
			$data['epoch'] 		= $last['last'];
		}else{
			$data['tanggal'] 	= 'never';
			$data['epoch'] 		= '0';
		}
		$this->load->view('voted/pelatihan',$data);
	}
	function get_data_latih(){
		$this->load->model('mangga/data_latih_model');
		$data = $this->data_latih_model->get_json_data_latih();
		echo $data;
	}
	function kosongkan($menu='',$msg=''){
		$this->load->model('voted/pelatihan_model');
		$data = $this->pelatihan_model->kosongkan();
		$this->load->model('log_model');
		$log = $this->log_model->kosongkan();
		
		redirect(base_url('voted/pelatihan/index/'.$menu));
	}
	function get_vektor(){
		$this->load->model('voted/pelatihan_model');
		$v = $this->pelatihan_model->vektor_awal();
		echo json_encode($v);
	}
	
	function save(){
		$v = $_POST['v'];
		$data['last_epoch'] = $_POST['epoch'];
		$data['tanggal'] 	= date('Y-m-d H:i:s');
		$this->load->model('log_model');
		$this->log_model->save($data);
		
		$this->load->model('voted/pelatihan_model');
		$i = 0;
		foreach($v as $data){
			$val = array(
						'v11'=>$data[0],'v12'=>$data[1],'v13'=>$data[2],
						'v21'=>$data[3],'v22'=>$data[4],'v23'=>$data[5],
						'v31'=>$data[6],'v32'=>$data[7],'v33'=>$data[8],
						'v41'=>$data[9],'v42'=>$data[10],'v43'=>$data[11],
						'v51'=>$data[12],'v52'=>$data[13],'v53'=>$data[14],'c'=>$data[15]
					);
			if($i>0){
				$v = $this->pelatihan_model->save($val);
			}
			$i++;
		}
	}
	
	function train(){
		$data = $_POST['data_latih'];
		$v = $_POST['v'];
		$data_latih = array($data['mean_g'],$data['momen_g'],$data['dev_g'],$data['compactness'],$data['circularity']);//data latih
		$label = $data['target']; 								// target
		$c = $v[count($v)-1];									// bobot voting
		$a = 0;
		for($x=0;$x<strlen($data['target']);$x++){				// vektor
			$kolom = (count($v)-1)/strlen($data['target']);
			for($y = 0; $y < $kolom; $y++){
				$vektor[$x][$y] = $v[$a];
				$a++;
			}
		}
		
		$this->load->library('voted_perceptron');
		$out = $this->voted_perceptron->train($data_latih,$label,$vektor,$c);
		$v_new = array();
		if(isset($out['v'])){	//jika ada perubahan vektor
			foreach($out['v'] as $v_baru){
				foreach($v_baru as $vx){
					array_push($v_new,$vx);
				}
			}
			array_push($v_new,$out['c']);
		}else{					// jika tidak ada perubahan
			foreach($vektor as $v_baru){
				foreach($v_baru as $vx){
					array_push($v_new,$vx);
				}
			}
			array_push($v_new,$out['c']);
		}	
		echo json_encode($v_new);
	}
}
?>
