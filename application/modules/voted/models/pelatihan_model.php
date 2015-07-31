<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pelatihan_model extends CI_Model {
	
	function vektor_awal(){
		$query = $this->db->get('pelatihan');
		if($query->num_rows()>0){
			$v = array();
			foreach($query->result_array()as $data){
				$v = array(
						array(
							(double)$data['v11'],(double)$data['v12'],(double)$data['v13'],
							(double)$data['v21'],(double)$data['v22'],(double)$data['v23'],
							(double)$data['v31'],(double)$data['v32'],(double)$data['v33'],
							(double)$data['v41'],(double)$data['v42'],(double)$data['v43'],
							(double)$data['v51'],(double)$data['v52'],(double)$data['v53'],(int)$data['c']
							)
						);
			}
			return $v;
		}else{
			$val = array('v11'=>0,'v12'=>0,'v13'=>0,
					'v21'=>0,'v22'=>0,'v23'=>0,
					'v31'=>0,'v32'=>0,'v33'=>0,
					'v41'=>0,'v42'=>0,'v43'=>0,
					'v51'=>0,'v52'=>0,'v53'=>0,'c'=>0
				);
			$this->db->insert('pelatihan', $val);
			$v = array(array_fill(0,16,0));
			return (($this->db->affected_rows()>0)?$v:FALSE);
		}
	}
	
	function get_vektor(){
		$query = $this->db->get('pelatihan');
		if($query->num_rows()>0){
			$result = array();$x = 0;
			foreach($query->result_array() as $data){
				$result[$x] = array(
					array($data['v11'],$data['v21'],$data['v31'],$data['v41'],$data['v51']),
					array($data['v12'],$data['v22'],$data['v32'],$data['v42'],$data['v52']),
					array($data['v13'],$data['v23'],$data['v33'],$data['v43'],$data['v53']),
					$data['c']
				);
				$x++;
			}
			return $result;
		}
		return NULL;
	}
	function kosongkan(){
		$this->db->truncate('pelatihan'); 
		return (($this->db->affected_rows()>0)?$v:FALSE);
	}
	function getBobotVoting(){
		$this->db->select('kode_vektor,c');
		$query = $this->db->get('pelatihan');
		if($query->num_rows()>0){
			$x=0;
			foreach($query->result_array()as $data){
				$k[$x] = (int)$data['kode_vektor'];
				$c[$x] = (int)$data['c'];
				$x++;
			}
			return array($k,$c);
		}else{
			return array();
		}
	}
	
	function save($data){
		$this->db->insert('pelatihan', $data);
		return (($this->db->affected_rows()>0)?TRUE:FALSE);
	}
}
?>